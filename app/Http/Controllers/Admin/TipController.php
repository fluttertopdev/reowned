<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\Tips;
use App\Models\Language;
use App\Models\TipTranslation;
use Illuminate\Support\Str;

use Session;

class TipController extends Controller
{

    public function index(Request $request)
    {

        try {
            $data['result'] = Tips::getLists($request->all());


            return view('admin.tips.list', $data);
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }



    public function create(Request $request)
    {


        return view('admin.tips.create');
    }

    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'description' => 'required',

        ]);



        try {
            // Save the sanitized data
            $added = Tips::addUpdate($validatedData);

            if ($added['status'] == true) {
                Session::flash('success', $added['message']);

                // Check if parent_id is not 0, redirect to subcategory page
                return redirect('admin/tips')->with('success', $added['message']);
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
            $data = Tips::where('id', $id)->first();
            return view('admin.tips.create', compact('data'));
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }



    public function update(Request $request)
    {


        $validatedData = $request->validate([
            'description' => 'required',

        ]);
        // **Sanitize Inputs**


        try {
            $updated = Tips::addUpdate($validatedData, $request->input('id'));
            if ($updated['status'] == true) {
                return redirect('admin/tips')->with('success', $updated['message']);
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
            $deleted = Tips::deleteRecord($id);

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
            $updated = Tips::updateStatus($id);

            return redirect()->back()->with($updated['status'] ? 'success' : 'error', $updated['message']);
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }


    public function translation($id)
    {
        $tip = Tips::find($id);
        $languages = Language::where('status', 1)->get();

        foreach ($languages as $language) {
            // dd($language);
            $language->details = TipTranslation::where('tip_id', $id)->where('language_code', $language->code)->first();

            if (!$language->details) {
                $tipData = [
                    'tip_id' => $id,
                    'language_code' => $language->code,

                    'description' => $tip->description,
                    'created_at' => date("Y-m-d H:i:s")
                ];
                TipTranslation::create($tipData);
                $language->details = TipTranslation::where('tip_id', $id)
                    ->where('language_code', $language->code)
                    ->first();
            }
        }
        return view('admin.tips.translation', compact('tip', 'languages'));
    }


    public function updateTranslate($id, Request $request)
    {
        $input = $request->all();

        for ($i = 0; $i < count($input['language_code']); $i++) {
            $translationId = $input['translation_id'][$i] ?? null;
            $description = trim(htmlspecialchars($input['description'][$i], ENT_QUOTES, 'UTF-8')); // Prevent XSS

            $tipTranslationData = [
                'language_code' => $input['language_code'][$i],
                'description' => $description,
                'updated_at' => now(),
            ];

            if ($translationId) {
                TipTranslation::where('id', $translationId)->update($tipTranslationData);
            } else {
                $tipTranslationData['tip_id'] = $id;
                TipTranslation::create($tipTranslationData);
            }
        }

        return redirect(url('admin/tips'))->with('success', __('lang.admin_translation_updated'));
    }
}
