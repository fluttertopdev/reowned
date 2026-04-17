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


    public function updateStatus($id, $status)
    {
        try {
            $updated = Item::updateColumn($id, $status);

            return back()->with($updated['status'] ? 'success' : 'error', $updated['message']);

        } catch (\Exception $ex) {
            return back()->with('error', $ex->getMessage());
        }
    }

}
