<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
         return view('website.notification.index');
    }
   
}

