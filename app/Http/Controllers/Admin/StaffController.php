<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Session;

class StaffController extends Controller
{

    public function index(Request $request)
    {
        try {
            $data['result'] = User::getStaffLists($request->all());
            return view('admin.staff.list', $data);
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }


    public function form(Request $request, $id = null)
    {
        $data = null;
        $roles = Role::where('status',1)->where('name','!=','admin')->orWhere('name','!=','admin')->get();
        if ($id) {
            $data = User::find($id);
        }

        return view('admin.staff.create', compact('data','roles'));
    }


    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:users,name',
            'email' => 'required|email|max:255|unique:users,email',
            'phone' => 'required|string|min:10|unique:users,phone|regex:/^[0-9]+$/',
            'password' => 'required|min:8|confirmed',
            'type' => 'required',
            'role_id' => 'required',
        ], [
            'phone.size' => 'The phone number must be exactly 12 digits.',
            'phone.regex' => 'The phone number must contain only numbers.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 8 characters long.',
            'password.confirmed' => 'The password confirmation does not match.',
        ]);

        // **Sanitize Inputs**
        $validatedData['name'] = htmlspecialchars(strip_tags($validatedData['name']), ENT_QUOTES, 'UTF-8'); // Prevent XSS

        try {
            // Save the sanitized data
            $added = User::addUpdateStaff($validatedData);

            if ($added['status'] == true) {
                Session::flash('success', $added['message']);
                return redirect()->route('staff.index')->with('success', $added['message']);
            } else {
                return redirect()->back()->with('error', $added['message']);
            }
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' at line ' . $ex->getLine() . ' in ' . $ex->getFile());
        }
    }


    public function update(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:users,name,' . $request->id,
            'email' => 'required|email|max:255|unique:users,email,' . $request->id,
            'phone' => [
                'required',
                'string',
                'min:10',
                'unique:users,phone,' . $request->id,
                'regex:/^[0-9]+$/'
            ],
            'password' => 'required|min:8|confirmed',
            'type' => 'required',
            'role_id' => 'required',

        ], [
            'phone.size' => 'The phone number must be exactly 12 digits.',
            'phone.regex' => 'The phone number must contain only numbers.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 8 characters long.',
            'password.confirmed' => 'The password confirmation does not match.',
        ]);
        // **Sanitize Inputs**
        $validatedData['name'] = htmlspecialchars(strip_tags($validatedData['name']), ENT_QUOTES, 'UTF-8'); // Prevent XSS

        try {
            $updated = User::addUpdateStaff($validatedData, $request->input('id'));
            if ($updated['status'] == true) {
                return redirect()->route('staff.index')->with('success', $updated['message']);
            } else {
                return redirect()->back()->with('error', $updated['message']);
            }
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }


    public function destroy($id)
    {
        try {
            $deleted = User::deleteRecord($id);

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
            $updated = User::updateStatus($id);

            return redirect()->back()->with($updated['status'] ? 'success' : 'error', $updated['message']);
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }
}
