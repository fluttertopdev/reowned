<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Area;
use App\Models\Item;
use App\Models\User;
use Session;

class ItemController extends Controller
{

    public function index(Request $request)
    {
        try {
            $data['result'] = Item::getLists($request->all());
            $data['users'] = User::where('type','user')->get();
            return view('admin.item.list', $data);
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }


    public function form(Request $request, $id = null)
    {
        $countries = Country::pluck('name', 'id');
        $data = $id ? Item::find($id) : null;

        return view('admin.item.form', compact('data', 'countries'));
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


    public function updateStatus($id)
    {
        try {
            $updated = Item::updateColumn($id);
            if ($updated['status'] == true) {
                return redirect()->back()->with('success', $updated['message']);
            } else {
                return redirect()->back()->with('error', $updated['message']);
            }
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }

}
