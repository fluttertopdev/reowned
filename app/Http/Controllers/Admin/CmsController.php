<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cms;
use App\Models\CmsTranslation;
use App\Models\Language;
use Illuminate\Support\Str;
use Session;


class CmsController extends Controller
{

    public function index(Request $request)
    {

        try {
            $data['result'] = Cms::getLists($request->all());


            return view('admin.cms.list', $data);
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }



    public function create(Request $request)
    {


        return view('admin.cms.create');
    }

    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'page_name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'description' => 'required',

        ]);



        // **Sanitize Inputs**
        $validatedData['page_name'] = htmlspecialchars(strip_tags($validatedData['page_name']), ENT_QUOTES, 'UTF-8'); // Prevent XSS
        $validatedData['slug'] = Str::slug(filter_var($validatedData['slug'], FILTER_SANITIZE_STRING)); // Ensure clean slug


        try {
            // Save the sanitized data
            $added = Cms::addUpdate($validatedData);

            if ($added['status'] == true) {
                Session::flash('success', $added['message']);

                // Check if parent_id is not 0, redirect to subcategory page
                return redirect('admin/cms')->with('success', $added['message']);
            } else {
                return redirect()->back()->with('error', $added['message']);
            }
        } catch (\Exception $ex) {


            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }


    public function edit(Request $request, $id)
    {
        try {
            $data = Cms::where('id', $id)->first();

            return view('admin.cms.create', compact('data'));
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }



    public function update(Request $request)
    {


        $validatedData = $request->validate([
            'page_name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'description' => 'required',

        ]);
        // **Sanitize Inputs**
        $validatedData['page_name'] = htmlspecialchars(strip_tags($validatedData['page_name']), ENT_QUOTES, 'UTF-8'); // Prevent XSS
        $validatedData['slug'] = Str::slug(filter_var($validatedData['slug'], FILTER_SANITIZE_STRING)); // Ensure clean slug


        try {
            $updated = Cms::addUpdate($validatedData, $request->input('id'));
            if ($updated['status'] == true) {
                return redirect('admin/cms')->with('success', $updated['message']);
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
            $deleted = Cms::deleteRecord($id);

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
            $updated = Cms::updateStatus($id);

            return redirect()->back()->with($updated['status'] ? 'success' : 'error', $updated['message']);
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }




        public function translation($id)
    {
        $cms = Cms::find($id);
        $languages = Language::where('status',1)->get();

        foreach ($languages as $language) {
           // dd($language);
            $language->details = CmsTranslation::where('cms_id',$id)->where('language_code',$language->code)->first();

            if (!$language->details) {
                $cmsData = [
                   'cms_id' => $id,
                    'language_code' => $language->code,
                    'page_name' => $cms->page_name,
                    'description' => $cms->description,

                    'created_at' => date("Y-m-d H:i:s")
                ];
                CmsTranslation::create($cmsData);
                $language->details = CmsTranslation::where('cms_id', $id)
                    ->where('language_code', $language->code)
                    ->first();
            }
        }
        return view('admin.cms.translation', compact('cms', 'languages'));
    }





   public function updateTranslate($id, Request $request)
{
    $customMessages = [];

    foreach ($request->input('language_code', []) as $index => $languageCode) {
        $customMessages["page_name.$index.required"] = "The page name for language ($languageCode) is required.";
        $customMessages["description.$index.required"] = "The description for language ($languageCode) is required.";
    }

    $request->validate([
        'language_code' => 'required|array',
        'language_code.*' => 'required|string',
        'page_name' => 'required|array',
        'page_name.*' => 'required|string|max:255',
        'description' => 'required|array',
        'description.*' => 'required|string',
    ], $customMessages);

    $input = $request->all();

    for ($i = 0; $i < count($input['language_code']); $i++) {
        $translationId = $input['translation_id'][$i] ?? null;

        $pageName = trim(strip_tags($input['page_name'][$i]));  // Remove extra spaces & HTML tags
        $description = trim(htmlspecialchars($input['description'][$i], ENT_QUOTES, 'UTF-8')); // Prevent XSS

        $cmsTranslationData = [
            'language_code' => $input['language_code'][$i],
            'page_name' => $pageName,
            'description' => $description,
            'updated_at' => now(),
        ];

        if ($translationId) {
            CmsTranslation::where('id', $translationId)->update($cmsTranslationData);
        } else {
            $cmsTranslationData['cms_id'] = $id;
            CmsTranslation::create($cmsTranslationData);
        }
    }

    return redirect(url('admin/cms'))->with('success', 'Translation updated successfully.');
}








}
