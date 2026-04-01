<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CityImport;
use App\Imports\StateImport;
use Session;

class CityController extends Controller
{


    public function index(Request $request)
    {

        try {
            $data['result'] = City::getLists($request->all());
            $data['countries'] = Country::pluck('name', 'id');
            return view('admin.city.list', $data);
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }



    public function form(Request $request, $id = null)
    {
        $countries = Country::pluck('name', 'id');
        $data = $id ? City::find($id) : null;

        return view('admin.city.create', compact('data', 'countries'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:cities,name',
            'country_id' => 'required',
            'state_id' => 'required',
             'latitude' => 'required',
            'longitude' => 'required',




        ]);

          $validatedData['name'] = trim(strip_tags($validatedData['name']));
            $validatedData['latitude'] = trim(strip_tags($validatedData['latitude']));
             $validatedData['longitude'] = trim(strip_tags($validatedData['longitude']));
        try {
            // Save the sanitized data
            $added = City::addUpdate($validatedData);

            if ($added['status'] == true) {
                Session::flash('success', $added['message']);


                return redirect()->route('city.index')->with('success', $added['message']);
            } else {
                return redirect()->back()->with('error', $added['message']);
            }
        } catch (\Exception $ex) {


            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }

    public function bulkUpload(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls',
        ]);

        try {



            Excel::import(new CityImport, $request->file('excel_file'));

            return redirect()->route('city.index')->with('success', 'States and Cities imported successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Import failed: ' . $e->getMessage());
        }
    }


    public function update(Request $request)
    {



        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:cities,name,' . $request->id,
            'state_id' => 'required',
            'country_id' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',

        ]);
         $validatedData['name'] = trim(strip_tags($validatedData['name']));
            $validatedData['latitude'] = trim(strip_tags($validatedData['latitude']));
             $validatedData['longitude'] = trim(strip_tags($validatedData['longitude']));


        try {
            $updated = City::addUpdate($validatedData, $request->input('id'));
            if ($updated['status'] == true) {
                return redirect()->route('city.index')->with('success', $updated['message']);
            } else {
                return redirect()->back()->with('error', $updated['message']);
            }
        } catch (\Exception $ex) {
            dd($ex->getMessage());
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }








    public function destroy($id)
    {
        try {
            $deleted = City::deleteRecord($id);

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
            $updated = City::updateStatus($id);

            return redirect()->back()->with($updated['status'] ? 'success' : 'error', $updated['message']);
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }


    public function getStates(Request $request)
    {
        $states = State::where('country_id', $request->country_id)->pluck('name', 'id');
        return response()->json($states);
    }
}
