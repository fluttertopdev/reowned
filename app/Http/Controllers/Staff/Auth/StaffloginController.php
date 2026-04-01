<?php

namespace App\Http\Controllers\Staff\Auth;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller; // Ensure Controller is properly imported
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Models\User;


class StaffloginController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function getLoginView(Request $request)
    {
        
       
        return view('staff.auth.login');
    }

public function staffAuthenticate(Request $request): RedirectResponse
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required', 'min:8'],
    ]);

    // Attempt login using a different guard for staff
    if (Auth::guard('staff')->attempt($credentials)) {
        $user = Auth::guard('staff')->user();
        $roleid = $user->role_id;

        if ($user->type === 'staff') {
            $request->session()->regenerate();  // Ensure session is regenerated

            $role = Role::find($roleid);
            if (!$role) {
                return back()->with('error', 'Role not found.');
            }

            // Ensure the user has the role assigned
            if (!$user->hasRole($role->name)) {
                $allPermissions = Permission::pluck('name')->toArray();
                $role->syncPermissions($allPermissions);
                $user->assignRole($role);
            }

            return redirect()->intended(route('staffdashboard.index'));  // Ensure this route exists
        }

        Auth::guard('staff')->logout();
        return back()->with('error', 'Access denied. Only staff members can log in.');
    }

    return back()->with('error', 'The provided credentials do not match our records.');
}


    public function staffGetforgotpasswordView(Request $request)
    {

        return view('staff.auth.forgotpassword');
    }




       public function staffdoForgetPassword(Request $request)
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
        return redirect()->route('staffpassword.resetShow')->with('success', $user['message']);
    } else {
        return redirect()->back()->with('error', $user['message'] ?? 'Something went wrong. Please try again.');
    }
}



    public function staffgetResetpasswordView(Request $request)
    {
        return view('staff.auth.resetpassword');
    }



    public function staffresetPasswordpost(Request $request)
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


       return redirect()->route('staffloginlogin.index')->with('success', 'Password reset successfully');

        } else {
            return redirect()->back()
                ->with('error', $data['message']);
        }
    }
}
