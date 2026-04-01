<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Area;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CityImport;
use App\Imports\StateImport;
use App\Imports\AreaImport;

use Session;

class AreaController extends Controller
{


    public function index(Request $request)
    {

        try {
            $data['result'] = Area::getLists($request->all());
            return view('admin.area.list', $data);
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }



    public function form(Request $request, $id = null)
    {
        $countries = Country::pluck('name', 'id');
        $data = $id ? Area::find($id) : null;

        return view('admin.area.create', compact('data', 'countries'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:areas,name',
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',

        ]);



        $validatedData['name'] = htmlspecialchars(strip_tags($validatedData['name']), ENT_QUOTES, 'UTF-8'); // Prevent XSS
        try {
            // Save the sanitized data
            $added = Area::addUpdate($validatedData);

            if ($added['status'] == true) {
                Session::flash('success', $added['message']);


                return redirect()->route('area.index')->with('success', $added['message']);
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

            Excel::import(new AreaImport, $request->file('excel_file'));

            return redirect()->route('area.index')->with('success', 'States, Cities, and Areas imported successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Import failed: ' . $e->getMessage());
        }
    }


    public function update(Request $request)
    {



        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:areas,name,' . $request->id,
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',

        ]);
        // **Sanitize Inputs**
        $validatedData['name'] = htmlspecialchars(strip_tags($validatedData['name']), ENT_QUOTES, 'UTF-8'); // Prevent XSS


        try {
            $updated = Area::addUpdate($validatedData, $request->input('id'));
            if ($updated['status'] == true) {
                return redirect()->route('area.index')->with('success', $updated['message']);
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
            $deleted = Area::deleteRecord($id);

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
            $updated = Area::updateStatus($id);

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

    public function getCities(Request $request)
    {
        $cities = City::where('state_id', $request->state_id)->pluck('name', 'id');
        return response()->json($cities);
    }
}
