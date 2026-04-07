<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Faq;
use Session;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $data = Faq::where('status',1)->get();
        return view('website.faq.index',compact('data'));
    }
   
}

