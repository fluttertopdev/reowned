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
    public function accountDetail(Request $request)
    {
        $user = Auth::guard('web')->user();
        $userId = $user->id ?? 0;

        $query = Item::where('status',1)
            ->with(['latestImage'])
            ->withExists(['favorites as is_favorite' => function($q) use ($userId){
                $q->where('user_id',$userId);
            }]);

        $totalItemCount = $query->count();

        $allItemData = $query->orderBy('id','DESC')
            ->limit(8)
            ->get();

        return view('website.user.account_detail', compact('user','allItemData','totalItemCount'));
    }


    public function loadItems(Request $request)
    {
        $user = Auth::guard('web')->user();
        $userId = $user->id ?? 0;

        $offset = $request->offset ?? 0;
        $limit = 8;
        $sort = $request->sort ?? 'newest';

        $query = Item::where('status',1)
            ->with(['latestImage','area','city'])
            ->withExists(['favorites as is_favorite' => function($q) use ($userId){
                $q->where('user_id',$userId);
            }]);

        // Sorting
        if($sort == "low_to_high"){
            $query->orderBy('price','ASC');
        }
        elseif($sort == "high_to_low"){
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
            'mobile.digits' => 'Phone number must be exactly 10 digits.',
            'mobile.regex'  => 'Phone number must contain only numbers.'
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
                'message' => 'Registration successful! Please check your email.'
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            Log::error('Signup Email Error: '.$e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Registration failed! Email sending failed. Please try again later.'
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
            return redirect('/')->with('error', 'Invalid verification link.');
        }

        if ($user->email_verification_expires_at < now()) {
            return redirect('/')->with('error', 'Verification link expired.');
        }

        if ($user->is_verified == 1) {
            return redirect('/')->with('success', 'Account already verified.');
        }

        $user->update([
            'is_verified' => 1,
            'status' => 1,
            'email_verified_at' => now(),
            'email_verification_token' => null,
            'email_verification_expires_at' => null,
        ]);

        return redirect('/')->with('success', 'Your account has been verified successfully!');
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
                'message' => 'Email not registered.'
            ], 422);
        }

        if ($user->deleted_at != null) {
            return response()->json([
                'status' => false,
                'message' => 'This account has been deleted.'
            ], 403);
        }

        if ($user->type !== 'user') {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized access.'
            ], 403);
        }

        if ($user->is_verified != 1) {
            return response()->json([
                'status' => false,
                'message' => 'Please verify your email first.'
            ], 403);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Incorrect password.'
            ], 422);
        }

        Auth::guard('web')->login($user);

        return response()->json([
            'status' => true,
            'message' => 'Login successful!'
        ]);
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/')->with('success', 'Logged out successfully.');
    }


    public function deleteAccount(Request $request)
    {
        $user = Auth::guard('web')->user();

        if (!$user) {
            return redirect('/')->with('error', 'User not found.');
        }

        // Soft delete
        $user->delete();

        // Logout user
        Auth::guard('web')->logout();

        // Invalidate session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Your account has been deleted successfully.');
    }


    public function redirectToGoogle()
    {
        if(setting('enable_google_login') != 1){
            abort(403, 'Google login disabled');
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

            return redirect('/')->with('success','Login successful');

        } catch (\Exception $e) {

            \Log::error('Google Login Error: '.$e->getMessage());

            return redirect('/')->with('error','Google login failed');
        }
    }
   
}

