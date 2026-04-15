<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::guard('web')->user();
        return view('website.profile.index', compact('user'));
    }


    public function update(Request $request)
    {
        $user = Auth::guard('web')->user();

        $request->validate([
            'name'  => 'required|string|min:3|max:255',
            'email' => 'required|email:rfc,dns|max:100|unique:users,email,' . $user->id,
            'phone' => 'required|digits:10|regex:/^[0-9]+$/|unique:users,phone,' . $user->id,
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'address' => 'nullable|string|max:500',
        ], [
            'phone.digits' => __('lang.website.phone_must_be_exactly_10_digits'),
            'phone.regex'  => __('lang.website.phone_must_contain_only_numbers'),
            'image.mimes'  => __('lang.website.image_must_be_jpg_jpeg_or_png_only'),
            'image.max'    => __('lang.website.image_size_must_not_exceed_2mb')
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();

            $file->move(public_path('uploads/user'), $filename);

            $user->image = $filename;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->enable_notificaton = $request->has('enable_notificaton') ? 1 : 0;

        $user->save();

        return response()->json([
            'status' => true,
            'message' => __('lang.website.profile_updated_successfully')
        ]);
    }
   
}