<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Userquerie;
use App\Models\Userreport;

use Session;

class UserReportController extends Controller
{

    public function index(Request $request)
    {

        try {
            $data['result'] = Userreport::getLists($request->all());

            


            return view('admin.userreport.list', $data);
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }


    public function form(Request $request, $id = null)
{
    $data = Userreport::with(['user', 'item', 'reportReason'])->find($id);


    return view('admin.userreport.view', compact('data'));
}

    public function destroy($id)
    {
        try {
            $deleted = Userreport::deleteRecord($id);

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
