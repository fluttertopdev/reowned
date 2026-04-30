<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Item;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function accountDetail(Request $request,$id)
    {
        $userId = $id;
        $user = Auth::guard('web')->user();
        $user_id = $user->id ?? 0;

        //  self profile redirect (as per your logic)
        if($userId == $user_id){
            return redirect('/')
                ->with('error', __('lang.website.account_not_exists'));
        }

        $profileUser = User::find($userId);

        if(!$profileUser){
            return redirect('/')
                ->with('error', __('lang.website.account_not_exists'));
        }

        //  check owner
        $isOwner = ($userId == $user_id);

        // LOCATION SESSION
        $lat     = session('user_lat');
        $lng     = session('user_lng');
        $radius  = session('radius', 20);

        $city    = session('city');
        $state   = session('state');
        $pincode = session('pincode');
        $area    = session('area');

        $query = Item::where('status',1)
            ->where('user_id', $userId)
            ->with(['latestImage'])
            ->withExists(['favorites as is_favorite' => function($q) use ($user_id){
                $q->where('user_id',$user_id);
            }]);

        /**
         *  APPLY LOCATION FILTER ONLY IF NOT OWNER
         */
        if(!$isOwner){

            if($lat && $lng){

                $query->select('items.*')
                    ->selectRaw("
                        (6371 * acos(
                            cos(radians(?)) 
                            * cos(radians(latitude)) 
                            * cos(radians(longitude) - radians(?)) 
                            + sin(radians(?)) 
                            * sin(radians(latitude))
                        )) AS distance
                    ", [$lat, $lng, $lat])

                    ->having("distance", "<=", $radius)
                    ->orderBy("distance", "asc");

            } else {

                if($city) $query->where('city', $city);
                if($state) $query->where('state', $state);
                if($pincode) $query->where('pincode', $pincode);
                if($area) $query->where('area', 'like', '%'.$area.'%');
            }
        }

        // total count (IMPORTANT: clone query)
        $totalItemCount = (clone $query)->count();

        // initial data
        $allItemData = $query->orderBy('views','DESC')
            ->limit(8)
            ->get();

        return view('website.user.account_detail', compact('profileUser','allItemData','totalItemCount'));
    }


    public function loadItems(Request $request)
    {
        $user = Auth::guard('web')->user();
        $userId = $user->id ?? 0;

        $profileUserId = $request->user_id;
        $isOwner = ($profileUserId == $userId);

        $offset = $request->offset ?? 0;
        $limit = 8;
        $sort = $request->sort ?? 'newest';

        // LOCATION SESSION
        $lat     = session('user_lat');
        $lng     = session('user_lng');
        $radius  = session('radius', 20);

        $city    = session('city');
        $state   = session('state');
        $pincode = session('pincode');
        $area    = session('area');

        $query = Item::where('status',1)
            ->where('user_id', $profileUserId)
            ->with(['latestImage'])
            ->withExists(['favorites as is_favorite' => function($q) use ($userId){
                $q->where('user_id',$userId);
            }]);

        /**
         *  APPLY LOCATION FILTER ONLY IF NOT OWNER
         */
        if(!$isOwner){

            if($lat && $lng){

                $query->select('items.*')
                    ->selectRaw("
                        (6371 * acos(
                            cos(radians(?)) 
                            * cos(radians(latitude)) 
                            * cos(radians(longitude) - radians(?)) 
                            + sin(radians(?)) 
                            * sin(radians(latitude))
                        )) AS distance
                    ", [$lat, $lng, $lat])

                    ->having("distance", "<=", $radius)
                    ->orderBy("distance", "asc");

            } else {

                if($city) $query->where('city', $city);
                if($state) $query->where('state', $state);
                if($pincode) $query->where('pincode', $pincode);
                if($area) $query->where('area', 'like', '%'.$area.'%');
            }
        }

        /**
         *  SORTING (after location)
         */
        if($sort == "price_low"){
            $query->orderBy('price','ASC');
        }
        elseif($sort == "price_high"){
            $query->orderBy('price','DESC');
        }
        elseif($sort == "oldest"){
            $query->orderBy('created_at','ASC');
        }
        else{
            $query->orderBy('created_at','DESC');
        }

        $items = $query->offset($offset)->limit($limit)->get();

        $html = view('website.partial.item_card_list_account', compact('items'))->render();

        return response()->json([
            'html' => $html,
            'count' => $items->count()
        ]);
    }

    public function doSignup(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|min:3|max:255',
            'email'    => 'required|email:rfc,dns|max:100|unique:users,email',
            'mobile'   => 'required|digits:10|regex:/^[0-9]+$/|unique:users,phone',
            'password' => 'required|min:8'
        ],[
            'mobile.digits' => __('lang.website.phone_number_must_be_exactly_10_digits'),
            'mobile.regex'  => __('lang.website.phone_number_must_contain_only_numbers')
        ]);

        DB::beginTransaction();

        try {

            $token = Str::random(64);

            $user = User::create([
                'name'      => $request->name,
                'email'     => $request->email,
                'phone'     => $request->mobile,
                'password'  => Hash::make($request->password),
                'type'      => 'user',
                'status'    => 1,
                'is_verified' => 0,
                'email_verification_token' => $token,
                'email_verification_expires_at' => Carbon::now()->addHours(24),
            ]);

            $verificationLink = route('user.verify-email', $token);

            // Send Mail
            \Helpers::sendEmail(
                'emails.verify-email',
                [
                    'name' => $user->name,
                    'verificationLink' => $verificationLink
                ],
                $user->email,
                $user->name,
                'Verify Your Email - Reowned'
            );

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => __('lang.website.registration_successful_check_email')
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            Log::error('Signup Email Error: '.$e->getMessage());

            return response()->json([
                'status' => false,
                'message' => __('lang.website.registration_failed_email_sending_failed')
            ], 500);
        }
    }

    public function checkEmail(Request $request)
    {
        $exists = User::where('email', $request->email)->exists();

        return response()->json([
            'exists' => $exists
        ]);
    }


    public function verifyEmail($token)
    {
        $user = User::where('email_verification_token', $token)->first();

        if (!$user) {
            return redirect('/')->with('error', __('lang.website.invalid_verification_link'));
        }

        if ($user->email_verification_expires_at < now()) {
            return redirect('/')->with('error', __('lang.website.verification_link_expired'));
        }

        if ($user->is_verified == 1) {
            return redirect('/')->with('success', __('lang.website.account_already_verified'));
        }

        $user->update([
            'is_verified' => 1,
            'status' => 1,
            'email_verified_at' => now(),
            'email_verification_token' => null,
            'email_verification_expires_at' => null,
        ]);

        return redirect('/')->with('success', __('lang.website.account_verified_successfully'));
    }


    public function doLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => __('lang.website.email_not_registered')
            ], 422);
        }

        if ($user->deleted_at != null) {
            return response()->json([
                'status' => false,
                'message' => __('lang.website.account_has_been_deleted')
            ], 403);
        }

        if ($user->type !== 'user') {
            return response()->json([
                'status' => false,
                'message' => __('lang.website.unauthorized_access')
            ], 403);
        }

        if ($user->is_verified != 1) {
            return response()->json([
                'status' => false,
                'message' => __('lang.website.please_verify_your_email_first')
            ], 403);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => __('lang.website.incorrect_password')
            ], 422);
        }

        Auth::guard('web')->login($user);

        return response()->json([
            'status' => true,
            'message' => __('lang.website.login_successful')
        ]);
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/')->with('success', __('lang.website.logged_out_successfully'));
    }


    public function deleteAccount(Request $request)
    {
        $user = Auth::guard('web')->user();

        if (!$user) {
            return redirect('/')->with('error', __('lang.website.user_not_found'));
        }

        // Soft delete
        $user->delete();

        // Logout user
        Auth::guard('web')->logout();

        // Invalidate session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', __('lang.website.account_deleted_successfully'));
    }


    public function redirectToGoogle()
    {
        if(setting('enable_google_login') != 1){
            abort(403, __('lang.website.google_login_disabled'));
        }

        return Socialite::driver('google')->redirect();
    }


    public function handleGoogleCallback()
    {
        try {

            $googleUser = Socialite::driver('google')->user();

            // 1️⃣ Check if user exists with google_id
            $user = User::where('google_id', $googleUser->id)->first();

            // 2️⃣ If not, check email
            if(!$user){
                $user = User::where('email', $googleUser->email)->first();
            }

            // 3️⃣ If user exists, update google_id
            if($user){

                if(!$user->google_id){
                    $user->google_id = $googleUser->id;
                    $user->save();
                }

            }else{

                $avatarPath = null;

                if($googleUser->avatar){

                    $folder = public_path('uploads/user/');

                    if(!file_exists($folder)){
                        mkdir($folder,0777,true);
                    }

                    $avatarUrl = str_replace('=s96-c','=s400-c',$googleUser->avatar);

                    $imageContents = file_get_contents($avatarUrl);

                    $fileName = 'user_'.time().'_'.Str::random(5).'.jpg';

                    file_put_contents($folder.$fileName,$imageContents);

                    $avatarPath = 'uploads/user/'.$fileName;
                }

                // 4️⃣ Create new user
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => bcrypt(Str::random(16)),
                    'type' => 'user',
                    'status' => 1,
                    'is_verified' => 1,
                    'google_id' => $googleUser->id,
                    'avatar' => $avatarPath
                ]);
            }

            Auth::guard('web')->login($user);

            return redirect('/')->with('success', __('lang.website.login_successful'));

        } catch (\Exception $e) {

            \Log::error('Google Login Error: '.$e->getMessage());

            return redirect('/')->with('error', __('lang.website.google_login_failed'));
        }
    }


    public function doForgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        DB::beginTransaction();

        try {
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => __('lang.website.email_not_found')
                ]);
            }

            // Generate OTP
            $otp = rand(100000, 999999);

            $user->update([
                'otp' => $otp,
                'otp_expires_at' => Carbon::now()->addMinutes(10),
            ]);

            // Send Email
            \Helpers::sendEmail(
                'emails.forgot-password',
                [
                    'name' => $user->name,
                    'otp' => $otp,
                    'customMessage' => __('lang.website.reset_password_email_message')
                ],
                $user->email,
                $user->name,
                __('lang.website.reset_password_subject')
            );

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => __('lang.website.otp_sent')
            ]);

        } catch (\Exception $e) {

            DB::rollBack();
            Log::error('Forgot Password OTP Error: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => __('lang.website.something_went_wrong')
            ], 500);
        }
    }


    public function resetPasswordWithOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6',
            'password' => 'required|min:6|confirmed'
        ]);

        try {
            $user = User::where('email', $request->email)
                ->where('otp', $request->otp)
                ->first();

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => __('lang.website.invalid_otp')
                ]);
            }

            // Check expiry
            if (Carbon::now()->gt($user->otp_expires_at)) {
                return response()->json([
                    'status' => false,
                    'message' => __('lang.website.otp_expired')
                ]);
            }

            // Update password
            $user->update([
                'password' => Hash::make($request->password),
                'otp' => null,
                'otp_expires_at' => null,
            ]);

            return response()->json([
                'status' => true,
                'message' => __('lang.website.password_reset_success')
            ]);

        } catch (\Exception $e) {

            Log::error('Reset Password Error: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => __('lang.website.something_went_wrong')
            ], 500);
        }
    }

   
}

