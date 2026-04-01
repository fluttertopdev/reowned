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
            'phone.digits' => 'Phone must be exactly 10 digits',
            'phone.regex'  => 'Phone must contain only numbers',
            'image.mimes'  => 'Image must be jpg, jpeg or png only',
            'image.max'    => 'Image size must not exceed 2MB'
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
            'message' => 'Profile updated successfully.'
        ]);
    }
   
}