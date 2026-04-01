<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller; // Ensure Controller is properly imported
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class LoginController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function getLoginView(Request $request)
    {
        return view('admin.auth.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {

            $user = Auth::guard('admin')->user();

            if ($user->type === 'admin') {

                $request->session()->regenerate();

                return redirect()->intended(route('dashboard.index'));
            }

            Auth::guard('admin')->logout();

            return back()->with('error', 'Access denied. Only admins can log in.');
        }

        return back()->with('error', 'The provided credentials do not match our records.');
    }

    public function getForgotpasswordView(Request $request)
    {
        return view('admin.auth.forgotpassword');
    }


    public function doForgetPassword(Request $request)
    {
        // Validate email field
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.exists' => 'This email is not registered in our system.',
        ]);

        // Process forget password logic
        $user = User::doForgetPassword($request->all());

        if ($user['status'] == true) {
            return redirect()->route('password.resetShow')->with('success', $user['message']);
        } else {
            return redirect()->back()->with('error', $user['message'] ?? 'Something went wrong. Please try again.');
        }
    }


    public function getResetpasswordView(Request $request)
    {
        return view('admin.auth.resetpassword');
    }


    public function resetPasswordpost(Request $request)
    {
        // Validate OTP, password, and confirm password
        $request->validate([
            'otp' => 'required|digits:4|exists:users,otp',
            'password' => 'required|min:8|confirmed',
        ], [
            'otp.required' => 'The OTP field is required.',
            'otp.digits' => 'The OTP must be exactly 4 digits.',
            'otp.exists' => 'The OTP you entered is incorrect or expired.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 8 characters long.',
            'password.confirmed' => 'The password confirmation does not match.',
        ]);

        // Process password reset logic
        $data = User::adminResetpassword($request->all());

        if ($data['status'] == true) {
            return redirect()->route('login.index')->with('success', 'Password reset successfully');
        } else {
            return redirect()->back()
                ->with('error', $data['message']);
        }
    }
}
