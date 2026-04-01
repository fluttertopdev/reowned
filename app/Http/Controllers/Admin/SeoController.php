<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Adspackages;
use App\Models\Notification;
use App\Models\User;
use App\Models\Item;
use App\Models\Seosetting;

use Session;

class SeoController extends Controller
{

    public function index(Request $request)
    {

        try {
            $data['result'] = Seosetting::getLists($request->all());


            return view('admin.seosetting.list', $data);
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }



    public function form(Request $request, $id = null)
    {

        $data = $id ? Seosetting::find($id) : null;

        return view('admin.seosetting.create', compact('data'));
    }


    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'title' => 'required|string',
            'page' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'keyword' => 'required',
            'description' => 'required',

        ]);



        // **Sanitize Inputs**
        $validatedData['title'] = htmlspecialchars(strip_tags($validatedData['title']), ENT_QUOTES, 'UTF-8'); // Prevent XSS
        $validatedData['description'] = htmlspecialchars(strip_tags($validatedData['description']), ENT_QUOTES, 'UTF-8'); // Prevent XSS
        $validatedData['page'] = htmlspecialchars(strip_tags($validatedData['page']), ENT_QUOTES, 'UTF-8'); // Prevent XSS
        try {
            // Save the sanitized data
            $added = Seosetting::addUpdate($validatedData);

            if ($added['status'] == true) {
                Session::flash('success', $added['message']);


                return redirect()->route('seo.index')->with('success', $added['message']);
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
            'title' => 'required|string',
            'page' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'keyword' => 'required',
            'description' => 'required',
        ]);
        // **Sanitize Inputs**
        $validatedData['title'] = htmlspecialchars(strip_tags($validatedData['title']), ENT_QUOTES, 'UTF-8'); // Prevent XSS
        $validatedData['description'] = htmlspecialchars(strip_tags($validatedData['description']), ENT_QUOTES, 'UTF-8'); // Prevent XSS
        $validatedData['page'] = htmlspecialchars(strip_tags($validatedData['page']), ENT_QUOTES, 'UTF-8'); // Prevent XSS

        try {
            $updated = Seosetting::addUpdate($validatedData, $request->input('id'));
            if ($updated['status'] == true) {

                return redirect()->route('seo.index')->with('success', $updated['message']);
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
            $deleted = Seosetting::deleteRecord($id);

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
            $updated = Seosetting::updateStatus($id);

            return redirect()->back()->with($updated['status'] ? 'success' : 'error', $updated['message']);
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }








    // item listing packages




}
