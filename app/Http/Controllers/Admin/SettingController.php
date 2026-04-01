<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Settings\GeneralSettings;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\App;


class SettingController extends Controller
{
    public function index()
    {
        $data['result'] = Setting::get();

        return view('admin.setting.index', $data);
    }


    public function update(Request $request)
    {

        $updated = Setting::updateContent($request->all());

        if ($updated['status']) {
            return redirect()->back()->with('success', $updated['message']);
        } else {
            return redirect()->back()->with('error', $updated['message']);
        }
    }

     public function setLanguage(Request $request){
        $post = $request->all();
        if (array_key_exists($post['lang'], Config::get('languages'))) {
            if (isset($post['lang'])) {

                App::setLocale($post['lang']);
                Session::put('admin_locale', $post['lang']);
                setcookie('admin_lang_code',$post['lang'],time()+60*60*24*365);
            }
        }
        return redirect()->back();
    }


}
