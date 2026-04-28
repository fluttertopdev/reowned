<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;
use App\Models\Itempackage;
use App\Models\Adspackages;
use App\Models\UserPayment;
use DB;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
       $payments = UserPayment::with(['itemPackage', 'adPackage'])
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        $userPackages = \App\Models\UserPackage::where('user_id', auth()->id())
            ->where('is_active', 1)
            ->get();
            

        $payments->getCollection()->transform(function ($payment) use ($userPackages) {

            $package = $userPackages->first(function ($pkg) use ($payment) {
                return 
                    (!is_null($payment->ad_package_id) && $pkg->ad_package_id == $payment->ad_package_id) ||
                    (!is_null($payment->item_package_id) && $pkg->item_package_id == $payment->item_package_id);
            });

            $payment->matched_package = $package;

            return $payment;
        });

        return view('website.transaction.index', compact('payments'));
    }
   
}