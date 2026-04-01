<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Session;

class StaffcategoryController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Display a listing of the categories.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     **/


    public function categoryOverview(Request $request)
    {
        try {
            $categoryId = $request->query('category'); // Get category ID from the URL
            $data['result'] = Category::staffGetLists($request->all(), $categoryId);


            return view('staff.category.list', $data);
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' at line ' . $ex->getLine() . ' in file ' . $ex->getFile());
        }
    }


    public function staffCategoryform(Request $request, $id = null)
    {
        $data = $id ? Category::findOrFail($id) : null; // Pass NULL for create form

        return view('staff.category.create', compact('data'));
    }




    public function staffCategorystore(Request $request)
    {
        $validatedData = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories')->whereNull('deleted_at')
            ],
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string',
            'parent_id' => 'required|integer',
            'user_id'=>'nullable',
        ]);

        // **Sanitize Inputs**
        $validatedData['name'] = trim(strip_tags($validatedData['name']));

        try {
            // Save the sanitized data
            $added = Category::addUpdate($validatedData);

            if ($added['status'] == true) {
                Session::flash('success', $added['message']);

                // Check if parent_id is not 0, redirect to subcategory page
                if ($validatedData['parent_id'] != 0) {
                    return redirect()->route('staffCategory.index', ['category' => $validatedData['parent_id']])
                        ->with('success', $added['message']);
                }

                // Otherwise, redirect to category list page
                return redirect()->route('staffCategory.index')->with('success', $added['message']);
            } else {
                return redirect()->back()->with('error', $added['message']);
            }
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }





    /**
     * Update the specified category in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  id  $id
     * @return \Illuminate\Http\Response
     **/
    public function staffCategoryupdate(Request $request)
    {


        $validatedData = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories')->ignore($request->id)->whereNull('deleted_at'),
            ],
            'slug' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string',
            'parent_id' => 'required|integer',
             'user_id'=>'nullable',
        ]);

        // **Sanitize Inputs**
        $validatedData['name'] = trim(strip_tags($validatedData['name']));
        try {
            $updated = Category::addUpdate($validatedData, $request->input('id'));
            if ($updated['status'] == true) {
                Session::flash('success', $updated['message']);

                // Check if parent_id is not 0, redirect to subcategory page
                if ($validatedData['parent_id'] != 0) {
                    return redirect()->route('staffCategory.index', ['category' => $validatedData['parent_id']])
                        ->with('success', $updated['message']);
                }

                // Otherwise, redirect to category list page
                return redirect()->route('staffCategory.index')->with('success', $updated['message']);
            } else {
                return redirect()->back()->with('error', $updated['message']);
            }
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }


    public function staffCategorydestroy($id)
    {
        try {
            $deleted = Category::deleteRecord($id);

            if ($deleted['status'] == true) {
                return redirect()->back()->with('success', $deleted['message']);
            } else {
                return redirect()->back()->with('error', $deleted['message']);
            }
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }





    public function staffCategoryupdateStatus($id)
    {
        try {
            $updated = Category::updateStatus($id);
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
