<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use App\Models\Category;
use App\Models\Adspackages;
use App\Models\Itempackage;
use App\Models\Item;
use Auth;

class StaffdashboardController extends Controller
{

    use AuthorizesRequests, ValidatesRequests;

   public function dashboardOverview(Request $request)
{
    // Ensure only authenticated staff can access this
    $user = auth()->guard('staff')->user();

   
      $result= Item::getLists($request->all());
    $categoryCount = Category::where('parent_id', 0)->where('user_id', $user->id)->count();
    $adspackages = Adspackages::where('user_id', $user->id)->count(); // Fixed missing user_id condition
    $itempackagCount = Itempackage::where('user_id', $user->id)->count(); // Use authenticated staff's user_id

    return view('staff.dashboard.index', compact('categoryCount', 'adspackages', 'itempackagCount','result'));
}


    public function staffProfile(Request $request)
    {
        try {
            $data['row'] = User::staffGetProfile();




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
    Auth::guard('staff')->logout();
  

    return redirect()->route('staffloginlogin.index')->with('success', 'You have been logged out.');
}

 
}
