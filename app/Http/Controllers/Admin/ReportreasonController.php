<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reportreason;
use Session;

class ReportreasonController extends Controller
{

    public function index(Request $request)
    {

        try {
            $data['result'] = Reportreason::getLists($request->all());


            return view('admin.reportreason.list', $data);
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }


    public function form(Request $request, $id = null)
    {
        $data = null;

        if ($id) {
            $data = Reportreason::find($id);
        }

        return view('admin.reportreason.create', compact('data'));
    }


    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'reason' => 'required',
            
        ]);



        // **Sanitize Inputs**
        $validatedData['reason'] = htmlspecialchars(strip_tags($validatedData['reason']), ENT_QUOTES, 'UTF-8'); // Prevent XSS

        try {
            // Save the sanitized data
            $added = Reportreason::addUpdate($validatedData);

            if ($added['status'] == true) {
                Session::flash('success', $added['message']);

               return redirect()->route('reportreason.index')->with('success', $added['message']);

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
            'reason' => 'required',
            
        ]);
        // **Sanitize Inputs**
        $validatedData['reason'] = htmlspecialchars(strip_tags($validatedData['reason']), ENT_QUOTES, 'UTF-8'); // Prevent XSS

        try {
            $updated = Reportreason::addUpdate($validatedData, $request->input('id'));
            if ($updated['status'] == true) {
            
                  return redirect()->route('reportreason.index')->with('success', $updated['message']);
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
            $deleted = Reportreason::deleteRecord($id);

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
            $updated = Reportreason::updateStatus($id);

            return redirect()->back()->with($updated['status'] ? 'success' : 'error', $updated['message']);
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }
    
}
