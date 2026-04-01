<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class VerificationBadgeController extends Controller
{
    public function index()
    {
        $user = Auth::guard('web')->user();
        return view('website.verification_badge.index', compact('user'));
    }


    public function upload(Request $request)
    {
        $user = Auth::guard('web')->user();

        $request->validate([
            'id_proof_front' => 'nullable|mimes:jpg,jpeg,png,svg,pdf|max:4096',
            'id_proof_back'  => 'nullable|mimes:jpg,jpeg,png,svg,pdf|max:4096',
        ],[
            'mimes' => 'Allowed file types: JPG, JPEG, PNG, SVG, PDF',
            'max'   => 'File size must not exceed 4MB'
        ]);

        if ($request->hasFile('id_proof_front')) {

            $file = $request->file('id_proof_front');
            $filename = time().'_front_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/user'), $filename);

            $user->id_proof_front = $filename;
        }

        if ($request->hasFile('id_proof_back')) {

            $file = $request->file('id_proof_back');
            $filename = time().'_back_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/user'), $filename);

            $user->id_proof_back = $filename;
        }

        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Documents uploaded successfully.'
        ]);
    }
   
}

