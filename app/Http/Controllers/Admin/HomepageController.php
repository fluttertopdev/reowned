<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Item;
use Session;


class HomepageController extends Controller
{

    public function index(Request $request)
    {

        try {
            $data['result'] = Slider::getLists($request->all());
            return view('admin.slider.list', $data);
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }



   public function form(Request $request, $id = null)
    {

        $category = Category::where('status', '1')->get();
        $item = Item::where('status', '1')->get();
        $data = $id ? Slider::find($id) : null;

        return view('admin.slider.create', compact('data', 'category','item'));
    }

    public function store(Request $request)
    {



        // Validate the request
        $validatedData = $request->validate([
            'type' => 'required',
            'value' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

          try {

            $added = Slider::addUpdate($validatedData);

            if ($added['status'] == true) {
                Session::flash('success', $added['message']);


               return redirect()->route('slider.index')->with('success', $added['message']);

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
            'type' => 'required',
            'value' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $updated = Slider::addUpdate($validatedData, $request->input('id'));
            if ($updated['status'] == true) {

                return redirect()->route('slider.index')->with('success', $updated['message']);

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
            $deleted = Slider::deleteRecord($id);

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
            $updated = Slider::updateStatus($id);

            return redirect()->back()->with($updated['status'] ? 'success' : 'error', $updated['message']);
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }
}
