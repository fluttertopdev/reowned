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

        return view('website.transaction.index', compact('payments'));
    }
   
}

