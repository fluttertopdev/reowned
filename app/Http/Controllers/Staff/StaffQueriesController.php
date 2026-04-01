<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Userquerie;
use Session;

class StaffQueriesController extends Controller
{

    public function queriesOverview(Request $request)
    {

        try {
            $data['result'] = Userquerie::getLists($request->all());

            


            return view('staff.userqueries.list', $data);
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }


    public function form(Request $request, $id = null)
{
    $data = Userquerie::with('user')->find($id);

    return view('staff.userqueries.view', compact('data'));
}

    public function staffdelete($id)
    {
        try {
            $deleted = Userquerie::deleteRecord($id);

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
