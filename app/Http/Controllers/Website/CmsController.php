<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cms;

class CmsController extends Controller
{
    public function index(Request $request,$slug)
    {
        try{        
            $data['row'] = Cms::where('slug',$slug)->first();

            if($data['row'] == ''){
                return redirect('/');
            }
            return view('website.cms.index',$data);    
        }
        catch(\Exception $ex){
            return redirect()->back()->with('error', $ex->getMessage() . ' '. $ex->getLine() . ' '. $ex->getFile()); 
        }
    }
   
}

