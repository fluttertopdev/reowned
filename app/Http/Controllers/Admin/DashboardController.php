<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller; // Ensure Controller is properly imported
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use App\Models\Category;
use App\Models\ContactUs;
use App\Models\Item;
use Auth;

class DashboardController extends Controller
{

    use AuthorizesRequests, ValidatesRequests;

    public function index(Request $request)
    {
        $categoryCount = Category::where('parent_id', 0)->count();
        $userCount = User::where('type','user')->count();
        $itemCount = Item::count();
        $contactusCount = ContactUs::count();
        $result= Item::getLists($request->all());
        $data['users'] = User::where('type','user')->get();

        return view('admin.dashboard.index', compact('categoryCount','contactusCount', 'result','userCount','itemCount'),$data);
    }

    public function adminProfile(Request $request)
    {
        try {
            $data['row'] = User::getProfile();
            return view('admin.dashboard.profile', $data);
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }

    public function updateAdminProfile(Request $request)
    {
        try {
            // Sanitize input fields
            $data = $request->all();
            $data['name'] = trim(strip_tags($data['name'])); // Remove HTML tags and trim spaces

            // Update profile with sanitized data
            $profileUpdated = User::updateProfile($data, $request->input('id'));

            if ($profileUpdated['status'] == true) {
                return redirect()->back()->with('success', $profileUpdated['message']);
            } else {
                return redirect()->back()->with('error', $profileUpdated['message']);
            }
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }

    public function adminLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
       return redirect()->route('login.index')->with('success', __('lang.admin_logged_out'));

    }
}