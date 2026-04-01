<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the live news.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        try {
            $data['result'] = Role::getLists($request->all());
            $data['permission'] = Permission::select('group', DB::raw('group_concat(id) as ids'))
                ->groupBy('group')
                ->get();

            foreach ($data['permission'] as $row) {
                $row->permission = Permission::whereIn('id', explode(',', $row->ids))->get();
            }

            return view('admin.role.index',$data);            
        } 
        catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage(). '. $ex->getLine(). '. $ex->getFile());
        }
    }

    /**
     * Store a newly created live news in storage.
     *
     * @param  \App\Http\Requests\StoreRoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
           // If all validations pass, proceed with adding/updating the role
            $added = Role::addUpdate($request->all());

            if ($added['status']) {
                return redirect('admin/role')->with('success', $added['message']);
            } else {
                return redirect()->back()->with('error', $added['message']);
            }
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }


    
    public function update(Request $request)
    {
        try{
          
            $updated = Role::addUpdate($request->all(),$request->input('id'));
            if($updated['status']){
                return redirect('admin/role')->with('success', $updated['message']); 
            }
            else{
                return redirect()->back()->with('error', $updated['message']);
            } 
        }
        catch(\Exception $ex){
            return redirect()->back()->with('error', $ex->getMessage() . ' '. $ex->getLine() . ' '. $ex->getFile()); 
        }
    }

   

    public function destroy($id)
    {
        try{
            $deleted = Role::deleteRecord($id);
            if($deleted['status']){
                return redirect()->back()->with('success', $deleted['message']); 
            }
            else{
                return redirect()->back()->with('error', $deleted['message']);
            } 
        }
        catch(\Exception $ex){
            return redirect()->back()->with('error', $ex->getMessage() . ' '. $ex->getLine() . ' '. $ex->getFile()); 
        }
    }
   

}
