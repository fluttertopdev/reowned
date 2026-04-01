<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller; // Ensure Controller is properly imported
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use App\Models\Category;
use App\Models\Blog;

use Auth;

class DashboardController extends Controller
{

    use AuthorizesRequests, ValidatesRequests;

    public function index(Request $request)
    {

        
        $categoryCount = Category::where('parent_id', 0)->count();
        $blogCount = Blog::count();

        return view('staff.dashboard.index', compact('categoryCount', 'blogCount'));
    }

    public function staffProfile(Request $request)
    {
        try {
            $data['row'] = User::getProfile();


            return view('staff.dashboard.profile', $data);
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }

    public function updateStaffprofile(Request $request)
    {
        try {
            $profileUpdated = User::updateProfile($request->all(), $request->input('id'));
            if ($profileUpdated['status'] == true) {
                return redirect()->back()->with('success', $profileUpdated['message']);
            } else {
                return redirect()->back()->with('error', $profileUpdated['message']);
            }
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }






    public function staffLogout(Request $request): RedirectResponse
    {
        Auth::logout(); // Log out the user

        $request->session()->invalidate(); // Invalidate session
        $request->session()->regenerateToken(); // Regenerate CSRF token

       return redirect()->route('login.index')->with('success', 'You have been logged out.');

    }
}
