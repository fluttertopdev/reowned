<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Adspackages;
use App\Models\Notification;
use App\Models\User;
use App\Models\Item;

use Session;

class NotificationController extends Controller
{

    public function index(Request $request)
    {
        try {
            $data['result'] = Notification::getLists($request->all());

            return view('admin.notification.list', $data);
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }


    public function form(Request $request, $id = null)
    {
        $users = User::where('type', 'user')->pluck('name', 'id');
         $item = Item::where('status', '1')->pluck('name', 'id');
        $data = $id ? Notification::find($id) : null;

        return view('admin.notification.create', compact('data', 'users','item'));
    }


    public function store(Request $request)
    {
        // Validate the request
       $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'msg' => 'required|string',
            'user_id' => 'required|array', // Ensure it's an array for multiple users
            'item_id' => 'required|array', // Ensure it's an array for multiple items
        ]);



        // **Sanitize Inputs**
        $validatedData['title'] = htmlspecialchars(strip_tags($validatedData['title']), ENT_QUOTES, 'UTF-8'); // Prevent XSS
         $validatedData['msg'] = htmlspecialchars(strip_tags($validatedData['msg']), ENT_QUOTES, 'UTF-8'); // Prevent XSS

        try {
            // Save the sanitized data
            $added = Notification::addUpdate($validatedData);

            if ($added['status'] == true) {
                Session::flash('success', $added['message']);


              return redirect()->route('notification.index')->with('success', $added['message']);

            } else {
                return redirect()->back()->with('error', $added['message']);
            }
        } catch (\Exception $ex) {


            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }


    public function destroy($id)
    {
        try {
            $deleted = Notification::deleteRecord($id);

            if ($deleted['status'] == true) {
                return redirect()->back()->with('success', $deleted['message']);
            } else {
                return redirect()->back()->with('error', $deleted['message']);
            }
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }


    public function updateStatus($id)
    {
        try {
            $updated = Notification::updateStatus($id);

            return redirect()->back()->with($updated['status'] ? 'success' : 'error', $updated['message']);
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }


    public function bulkDelete(Request $request)
    {
        if (!auth()->user()->can('delete-notification')) {
            abort(403);
        }

        $ids = $request->ids;

        if (!empty($ids)) {
            \App\Models\Notification::whereIn('id', $ids)->delete();

            return response()->json([
                'status' => true,
                'message' => __('lang.record_deleted_successfully')
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => __('lang.something_went_wrong')
        ]);
    }

}
