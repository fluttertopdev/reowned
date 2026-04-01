<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\FaqTranslation;
use App\Models\Language;
use Illuminate\Support\Str;

use Session;

class FaqController extends Controller
{

    public function index(Request $request)
    {

        try {
            $data['result'] = Faq::getLists($request->all());


            return view('admin.faq.list', $data);
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }



    public function create(Request $request)
    {


        return view('admin.faq.create');
    }

    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',

        ]);



        // **Sanitize Inputs**
        $validatedData['title'] = htmlspecialchars(strip_tags($validatedData['title']), ENT_QUOTES, 'UTF-8'); // Prevent XSS


        try {
            // Save the sanitized data
            $added = Faq::addUpdate($validatedData);

            if ($added['status'] == true) {
                Session::flash('success', $added['message']);

                // Check if parent_id is not 0, redirect to subcategory page
                return redirect('admin/faq')->with('success', $added['message']);
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
            $data = Faq::where('id', $id)->first();
            return view('admin.faq.create', compact('data'));
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }



    public function update(Request $request)
    {



        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',

        ]);
        // **Sanitize Inputs**
        $validatedData['title'] = htmlspecialchars(strip_tags($validatedData['title']), ENT_QUOTES, 'UTF-8'); // Prevent XSS


        try {
            $updated = Faq::addUpdate($validatedData, $request->input('id'));
            if ($updated['status'] == true) {
                return redirect('admin/faq')->with('success', $updated['message']);
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
            $deleted = Faq::deleteRecord($id);

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
            $updated = Faq::updateStatus($id);

            return redirect()->back()->with($updated['status'] ? 'success' : 'error', $updated['message']);
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }

    public function translation($id)
    {
        $faq = Faq::find($id);
        $languages = Language::where('status', 1)->get();

        foreach ($languages as $language) {
            // dd($language);
            $language->details = FaqTranslation::where('faq_id', $id)->where('language_code', $language->code)->first();

            if (!$language->details) {
                $faqData = [
                    'faq_id' => $id,
                    'language_code' => $language->code,
                    'title' => $faq->title,
                    'description' => $faq->description,

                    'created_at' => date("Y-m-d H:i:s")
                ];
                FaqTranslation::create($faqData);
                $language->details = FaqTranslation::where('faq_id', $id)
                    ->where('language_code', $language->code)
                    ->first();
            }
        }
        return view('admin.faq.translation', compact('faq', 'languages'));
    }


    public function updateTranslate($id, Request $request)
    {
        $customMessages = [];

        foreach ($request->input('language_code', []) as $index => $languageCode) {
            $customMessages["title.$index.required"] = "The title for language ($languageCode) is required.";
            $customMessages["description.$index.required"] = "The description for language ($languageCode) is required.";
        }

        $request->validate([
            'language_code' => 'required|array',
            'language_code.*' => 'required|string',
            'title' => 'required|array',
            'title.*' => 'required|string|max:255',
            'description' => 'required|array',
            'description.*' => 'required|string',
        ], $customMessages);

        $input = $request->all();

        for ($i = 0; $i < count($input['language_code']); $i++) {
            $translationId = $input['translation_id'][$i] ?? null;


            $title = trim(strip_tags($input['title'][$i]));  // Remove extra spaces & HTML tags
            $description = trim(htmlspecialchars($input['description'][$i], ENT_QUOTES, 'UTF-8')); // Prevent XSS

            $faqTranslationData = [
                'language_code' => $input['language_code'][$i],
                'title' => $title,
                'description' => $description,
                'updated_at' => now(),
            ];

            if ($translationId) {
                FaqTranslation::where('id', $translationId)->update($faqTranslationData);
            } else {
                $faqTranslationData['faq_id'] = $id;
                FaqTranslation::create($faqTranslationData);
            }
        }

        return redirect(url('admin/faq'))->with('success', 'Translation updated successfully.');
    }
}
