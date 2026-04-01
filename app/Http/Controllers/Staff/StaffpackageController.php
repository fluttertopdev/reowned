<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Adspackages;
use App\Models\Itempackage;
use Session;

class StaffpackageController extends Controller
{

    public function advertisementpackageOverview(Request $request)
    {

        try {
            $data['result'] = Adspackages::staffGetLists($request->all());


            return view('staff.packages.adspackage.list', $data);
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }


    public function advertisementpackageForm(Request $request, $id = null)
    {
        $data = null;

        if ($id) {
            $data = Adspackages::find($id);
        }

        return view('staff.packages.adspackage.create', compact('data'));
    }


    public function advertisementpackageStore(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:adpackages',
            'price' => 'required|numeric',
            'discount' => 'required|numeric',
             'user_id' => 'nullable',
            'days' => 'required|numeric',
            'item_limit' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
        ]);





        // **Sanitize Inputs**
        $validatedData['name'] = htmlspecialchars(strip_tags($validatedData['name']), ENT_QUOTES, 'UTF-8'); // Prevent XSS

        try {
            // Save the sanitized data
            $added = Adspackages::addUpdate($validatedData);

            if ($added['status'] == true) {
                Session::flash('success', $added['message']);

                
            return redirect()->route('staffAdvertisementpackage.index')->with('success', $added['message']);

            } else {
                return redirect()->back()->with('error', $added['message']);
            }
        } catch (\Exception $ex) {


            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }






    public function advertisementpackageUpdate(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:adpackages,name,' . $request->id,
            'price' => 'required|numeric',
            'discount' => 'required|numeric',
             'user_id' => 'nullable',
            'days' => 'required|numeric',
            'item_limit' => 'required|numeric',
            'image' => 'nullable',
            'description' => 'required',
        ]);
        // **Sanitize Inputs**
        $validatedData['name'] = htmlspecialchars(strip_tags($validatedData['name']), ENT_QUOTES, 'UTF-8'); // Prevent XSS

        try {
            $updated = Adspackages::addUpdate($validatedData, $request->input('id'));
            if ($updated['status'] == true) {
            
                 return redirect()->route('staffAdvertisementpackage.index')->with('success', $updated['message']);
            } else {
                return redirect()->back()->with('error', $updated['message']);
            }
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }


    public function advertisementpackageDestroy($id)
    {
        try {
            $deleted = Adspackages::deleteRecord($id);

            if ($deleted['status'] == true) {
                return redirect()->back()->with('success', $deleted['message']);
            } else {
                return redirect()->back()->with('error', $deleted['message']);
            }
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }


    public function advertisementpackageUpdateStatus($id)
    {
        try {
            $updated = Adspackages::updateStatus($id);

            return redirect()->back()->with($updated['status'] ? 'success' : 'error', $updated['message']);
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }


    

    




    // item listing packages

    public function itemPackagesOverview(Request $request)
    {

        try {
            $data['result'] = Itempackage::staffGetLists($request->all());


            return view('staff.packages.itempackage.list', $data);
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }



    public function staffitemPackagesform(Request $request, $id = null)
    {
        $data = null;

        if ($id) {
            $data = Itempackage::find($id);
        }
        return view('staff.packages.itempackage.create', compact('data'));
    }


    public function staffitemPackagesstore(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:item_packages',
            'price' => 'required|numeric',
            'discount' => 'required|numeric',
             'user_id'=>'nullable',
            'days' => 'required',
            'item' => 'required',
            'no_of_days' => 'nullable|numeric',
            'no_of_item' => 'nullable|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
        ]);

     

        // **Sanitize Inputs**
        $validatedData['name'] = htmlspecialchars(strip_tags($validatedData['name']), ENT_QUOTES, 'UTF-8'); // Prevent XSS

        try {
            // Save the sanitized data
            $added = Itempackage::addUpdate($validatedData);

            if ($added['status'] == true) {
                Session::flash('success', $added['message']);

             
            return redirect()->route('staffitemPackages.index')->with('success', $added['message']);
            } else {
                return redirect()->back()->with('error', $added['message']);
            }
        } catch (\Exception $ex) {


            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }








    public function staffitemPackagesUpdate(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:item_packages,name,' . $request->id,
            'price' => 'required|numeric',
            'discount' => 'required|numeric',
            'user_id'=>'nullable',
            'days' => 'required',
            'item' => 'required',
            'no_of_days' => 'nullable|numeric',
            'no_of_item' => 'nullable|numeric',
            'image' => 'nullable',
            'description' => 'required',
        ]);
        // **Sanitize Inputs**
        $validatedData['name'] = htmlspecialchars(strip_tags($validatedData['name']), ENT_QUOTES, 'UTF-8'); // Prevent XSS

        try {
            $updated = Itempackage::addUpdate($validatedData, $request->input('id'));
            if ($updated['status'] == true) {
        
                 return redirect()->route('staffitemPackages.index')->with('success', $updated['message']);
            } else {
                return redirect()->back()->with('error', $updated['message']);
            }
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }



    public function staffitemPackagesStatus($id)
    {
        try {
            $updated = Itempackage::updateStatus($id);

           

     return redirect()->route('staffitemPackages.index')->with('success', $updated['message']);
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }



    public function staffitemPackagesDestroy($id)
    {
        try {
            $deleted = Itempackage::deleteRecord($id);

            if ($deleted['status'] == true) {
                return redirect()->back()->with('success', $deleted['message']);
            } else {
                return redirect()->back()->with('error', $deleted['message']);
            }
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }



    
    }
