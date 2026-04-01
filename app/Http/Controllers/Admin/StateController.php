<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Country;
use App\Models\State;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CountryImport;
use App\Imports\StateImport;
use Session;

class StateController extends Controller
{


    public function index(Request $request)
    {

        try {
            $data['result'] = State::getLists($request->all());
            $data['countries'] = Country::pluck('name', 'id');
            return view('admin.state.list', $data);
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }


    public function form(Request $request, $id = null)
    {
        $countries = Country::pluck('name', 'id');
        $data = $id ? State::find($id) : null;

        return view('admin.state.create', compact('data', 'countries'));
    }


    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:states,name',
            'country_id' => 'required',

        ]);

        $validatedData['name'] = htmlspecialchars(strip_tags($validatedData['name']), ENT_QUOTES, 'UTF-8'); // Prevent XSS
        try {
            // Save the sanitized data
            $added = State::addUpdate($validatedData);

            if ($added['status'] == true) {
                Session::flash('success', $added['message']);


                return redirect()->route('state.index')->with('success', $added['message']);
            } else {
                return redirect()->back()->with('error', $added['message']);
            }
        } catch (\Exception $ex) {


            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }


    public function update(Request $request)
    {



        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:states,name,' . $request->id,
            'country_id' => 'required',

        ]);
        // **Sanitize Inputs**
        $validatedData['name'] = htmlspecialchars(strip_tags($validatedData['name']), ENT_QUOTES, 'UTF-8'); // Prevent XSS


        try {
            $updated = State::addUpdate($validatedData, $request->input('id'));
            if ($updated['status'] == true) {
                return redirect()->route('state.index')->with('success', $updated['message']);
            } else {
                return redirect()->back()->with('error', $updated['message']);
            }
        } catch (\Exception $ex) {
            dd($ex->getMessage());
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }

    public function bulkUpload(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls',
        ]);

        try {
            // Import only states
            Excel::import(new StateImport, $request->file('excel_file'));

            return redirect()->route('state.index')->with('success', 'States imported successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Import failed: ' . $e->getMessage());
        }
    }








    public function destroy($id)
    {
        try {
            $deleted = State::deleteRecord($id);

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
            $updated = State::updateStatus($id);

            return redirect()->back()->with($updated['status'] ? 'success' : 'error', $updated['message']);
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }
}
