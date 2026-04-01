<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\App;


class StaffsettingController extends Controller
{
   


   
     public function staffetLanguage(Request $request){
        $post = $request->all();
        if (array_key_exists($post['lang'], Config::get('languages'))) {
            if (isset($post['lang'])) {

                App::setLocale($post['lang']);
                Session::put('staff_locale', $post['lang']);
                setcookie('staff_lang_code',$post['lang'],time()+60*60*24*365);
            }
        }
        return redirect()->back();
    }


}
