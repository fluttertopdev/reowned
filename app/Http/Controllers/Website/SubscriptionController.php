<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Razorpay\Api\Api;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Webhook;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Facades\Log;
use App\Models\Itempackage;
use App\Models\Adspackages;
use App\Models\UserPayment;
use DB;

class SubscriptionController extends Controller
{
    public function index(Request $request)
    {
        $data['itemPackages'] = Itempackage::where('status',1)->get();
        $data['adsPackages'] = Adspackages::where('status',1)->get();

        return view('website.subscription.index',$data);
    }
    
    // Razorpay
    public function createOrder(Request $request)
    {
        try {
            $package = null;

            if ($request->type === 'ads') {
                $package = Adspackages::where('id', $request->item_package_id)
                                      ->where('status', 1)
                                      ->first();
            } elseif ($request->type === 'item') {
                $package = Itempackage::where('id', $request->item_package_id)
                                      ->where('status', 1)
                                      ->first();
            }

            if (!$package) {
                return response()->json(['error' => 'Invalid package'], 400);
            }

            $amount = $package->final_price * 100;

            $api = new Api(setting('razorpay_key'), setting('razorpay_secret'));

            $order = $api->order->create([
                'receipt' => Str::random(10),
                'amount' => $amount,
                'currency' => 'INR'
            ]);

            session([
                'package_id' => $package->id,
                'package_type' => $request->type,
                'amount' => $amount
            ]);

            return response()->json([
                'order_id' => $order['id'],
                'amount' => $amount
            ]);

        } catch (\Exception $e) {
            Log::error('Razorpay Order Error: '.$e->getMessage());

            return response()->json([
                'error' => 'Unable to create order'
            ], 500);
        }
    }

    // Razorpay
    public function verifyPayment(Request $request)
    {
        try {

            $api = new Api(setting('razorpay_key'), setting('razorpay_secret'));

            $attributes = [
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature
            ];

            $api->utility->verifyPaymentSignature($attributes);

            // Get session data
            $packageId = session('package_id');
            $type = session('package_type');
            $amount = session('amount');

            // Fetch correct model
            if ($type === 'ads') {
                $package = Adspackages::find($packageId);
            } else {
                $package = Itempackage::find($packageId);
            }

            if (!$package) {
                return response()->json(['success' => false], 400);
            }

            // Security check
            if ($amount != ($package->final_price * 100)) {
                Log::error('Amount mismatch (tampering)');
                return response()->json(['success' => false], 400);
            }

            // Calculate expiry
            $this->storePayment([
                'user_id' => auth()->id(),
                'package_id' => $packageId,
                'type' => $type,
                'gateway' => 'razorpay',
                'transaction_id' => $request->razorpay_payment_id,
                'order_id' => $request->razorpay_order_id,
                'amount' => $package->final_price,
                'status' => 'success',
                'response' => $request->all()
            ]);

            $this->assignUserPackage(auth()->id(), $package, $type);

            return response()->json(['success' => true]);

        } catch (\Exception $e) {

            Log::error('Razorpay Verification Failed: '.$e->getMessage());

            return response()->json(['success' => false], 400);
        }
    }

    // Stripe
    public function createStripeOrder(Request $request)
    {
        try {

            if (setting('currency') !== '$') {
                return response()->json([
                    'status' => false,
                    'message' => 'Stripe not available for this currency'
                ], 400);
            }

            Stripe::setApiKey(setting('stripe_secret_key'));

            $package = null;

            if ($request->type === 'ads') {
                $package = Adspackages::where('id', $request->item_package_id)
                                      ->where('status', 1)
                                      ->first();
            } elseif ($request->type === 'item') {
                $package = Itempackage::where('id', $request->item_package_id)
                                      ->where('status', 1)
                                      ->first();
            }

            if (!$package) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid package'
                ]);
            }

            // Trusted amount from DB
            $amount = $package->final_price;

            $session = Session::create([
                'payment_method_types' => ['card'],
                'mode' => 'payment',

                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $package->name,
                        ],
                        'unit_amount' => $amount * 100,
                    ],
                    'quantity' => 1,
                ]],

                // Pass metadata (VERY IMPORTANT 🔥)
                'metadata' => [
                    'package_id' => $package->id,
                    'type' => $request->type,
                    'user_id' => auth()->id()
                ],

                'success_url' => url('/stripe-success?session_id={CHECKOUT_SESSION_ID}'),
                'cancel_url' => url('/subscriptions?cancel=1'),
            ]);

            return response()->json([
                'id' => $session->id
            ]);

        } catch (\Exception $e) {

            Log::error('Stripe Order Error: '.$e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Payment initialization failed'
            ], 500);
        }
    }
    
    // Stripe
    public function verifyStripePayment(Request $request)
    {
        try {

            Stripe::setApiKey(setting('stripe_secret_key'));

            $session = StripeSession::retrieve($request->session_id);

            if ($session->payment_status === 'paid') {

                // Get metadata
                $packageId = $session->metadata->package_id;
                $type = $session->metadata->type;
                $userId = $session->metadata->user_id;

                // Fetch package again
                if ($type === 'ads') {
                    $package = Adspackages::find($packageId);
                } else {
                    $package = Itempackage::find($packageId);
                }

                if (!$package) {
                    return redirect()->route('subscriptions')->with('error', 'Invalid package');
                }

                // Calculate expiry
                $this->storePayment([
                    'user_id' => $userId,
                    'package_id' => $packageId,
                    'type' => $type,
                    'gateway' => 'stripe',
                    'transaction_id' => $session->payment_intent,
                    'order_id' => $session->id,
                    'amount' => $package->final_price,
                    'currency' => 'INR',
                    'status' => 'success',
                    'response' => $session
                ]);

                $this->assignUserPackage($userId, $package, $type);

                return redirect()->route('subscriptions')->with('success', 'Payment successful');
            }

            return redirect()->route('subscriptions')->with('error', 'Payment not completed');

        } catch (\Exception $e) {

            Log::error('Stripe Verify Error: '.$e->getMessage());

            return redirect()->route('subscriptions')->with('error', 'Payment verification failed');
        }
    }

    // Stripe
    public function handleWebhook(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $secret = env('STRIPE_WEBHOOK_SECRET');

        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $secret);

            if ($event->type == 'checkout.session.completed') {

                $session = $event->data->object;

                // Payment success (FINAL TRUSTED)
                // Save DB, activate subscription

            }

            return response()->json(['status' => 'success']);

        } catch (\Exception $e) {
            Log::error('Stripe Webhook Error: '.$e->getMessage());
            return response()->json(['error' => 'Webhook failed'], 400);
        }
    }

    //PayPal create order
    public function createPaypalOrder(Request $request)
    {
        try {

            $package = null;

            if ($request->type === 'ads') {
                $package = Adspackages::where('id', $request->item_package_id)
                                      ->where('status', 1)
                                      ->first();
            } elseif ($request->type === 'item') {
                $package = Itempackage::where('id', $request->item_package_id)
                                      ->where('status', 1)
                                      ->first();
            }

            if (!$package) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid package'
                ]);
            }

            // Amount from DB (NOT request)
            $amount = $package->final_price;

            $provider = $this->paypalClient();

            $order = $provider->createOrder([
                "intent" => "CAPTURE",
                "purchase_units" => [
                    [
                        "amount" => [
                            "currency_code" => "USD",
                            "value" => number_format($amount, 2, '.', '')
                        ]
                    ]
                ]
            ]);

            // store in session
            session([
                'package_id' => $package->id,
                'package_type' => $request->type,
                'amount' => $amount
            ]);

            return response()->json([
                'status' => true,
                'orderID' => $order['id']
            ]);

        } catch (\Exception $e) {

            \Log::error("PayPal Error: " . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    //PayPal capture
    public function capturePaypalPayment(Request $request)
    {
        try {

            $provider = $this->paypalClient();
            $response = $provider->capturePaymentOrder($request->orderID);

            \Log::info('PayPal Capture Response:', $response);

            if (isset($response['status']) && $response['status'] == 'COMPLETED') {

                // Get trusted session data
                $packageId = session('package_id');
                $type = session('package_type');
                $amount = session('amount');

                // Fetch package again (extra security)
                if ($type === 'ads') {
                    $package = Adspackages::find($packageId);
                } else {
                    $package = Itempackage::find($packageId);
                }

                if (!$package) {
                    return response()->json(['status' => false]);
                }

                // Final security check
                if ($amount != $package->final_price) {
                    \Log::error('PayPal amount mismatch');
                    return response()->json(['status' => false]);
                }

                // Calculate expiry
                $this->storePayment([
                    'user_id' => auth()->id(),
                    'package_id' => $packageId,
                    'type' => $type,
                    'gateway' => 'paypal',
                    'transaction_id' => $response['id'] ?? null,
                    'order_id' => $request->orderID,
                    'amount' => $amount,
                    'currency' => 'USD',
                    'status' => 'success',
                    'response' => $response
                ]);

                $this->assignUserPackage(auth()->id(), $package, $type);

                return response()->json([
                    'status' => true,
                    'message' => 'Payment successful'
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => 'Payment failed'
            ]);

        } catch (\Exception $e) {

            \Log::error('PayPal Capture Error: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    // PayPal webhook
    public function paypalWebhook(Request $request)
    {
        Log::info('PayPal Webhook:', $request->all());

        // Example event check
        if ($request->event_type == 'CHECKOUT.ORDER.APPROVED') {
            // Update payment status
        }

        return response()->json(['status' => 'success']);
    }

    // PayPal
    private function paypalClient()
    {
        $config = [
            'mode' => 'sandbox',

            'sandbox' => [
                'client_id' => trim(setting('paypal_client_id')),
                'client_secret' => trim(setting('paypal_secret_key')),
                'app_id' => 'APP-80W284485P519543T',
            ],

            'live' => [
                'client_id' => trim(setting('paypal_client_id')),
                'client_secret' => trim(setting('paypal_secret_key')),
                'app_id' => '',
            ],

            // 🔥 REQUIRED KEYS
            'payment_action' => 'sale',
            'currency' => 'USD',
            'notify_url' => '',
            'locale' => 'en_US',
            'validate_ssl' => true,
        ];

        $provider = new \Srmklive\PayPal\Services\PayPal;

        $provider->setApiCredentials($config);

        $provider->getAccessToken();

        return $provider;
    }

    // =========================Common Code==================
    private function assignUserPackage($userId, $package, $type)
    {
        $startDate = now();

        if ($package->days === 'limited') {
            $endDate = now()->addDays($package->no_of_days);
        } else {
            $endDate = null;
        }

        \DB::table('user_packages')
            ->where('user_id', $userId)
            ->where('is_active', 1)
            ->update([
                'is_active' => 0,
                'updated_at' => now()
            ]);

        return \DB::table('user_packages')->insert([
            'user_id' => $userId,
            'item_package_id' => $type === 'item' ? $package->id : null,
            'ad_package_id' => $type === 'ads' ? $package->id : null,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'total_limit' => $package->item === 'limited' ? $package->no_of_item : null,
            'used_limit' => 0,
            'is_active'  => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }


    private function storePayment($data)
    {
        return \DB::table('user_payments')->insert([
            'user_id' => $data['user_id'],
            'item_package_id' => $data['type'] === 'item' ? $data['package_id'] : null,
            'ad_package_id' => $data['type'] === 'ads' ? $data['package_id'] : null,

            'payment_gateway' => $data['gateway'],
            'transaction_id' => $data['transaction_id'] ?? null,
            'order_id' => $data['order_id'] ?? null,

            'amount' => $data['amount'],
            'currency' => $data['currency'] ?? 'INR',

            'payment_status' => $data['status'],

            'gateway_response' => json_encode($data['response'] ?? null),

            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
   
}