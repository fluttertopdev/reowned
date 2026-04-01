<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Translation;
use App\Models\Language;
use App\Http\Requests\Translation\StoreTranslationRequest;
use App\Http\Requests\Translation\UpdateTranslationRequest;

class TranslationController extends Controller
{


    public function index(Request $request, $language_id = null)
    {

        try {
            // Add language_id to filters if provided
            $filters = $request->all();
            if ($language_id) {
                $filters['language_id'] = $language_id;
            }

            // Retrieve translations with filters
            $data['result'] = Translation::getLists($filters);

            return view('admin.translation.list', $data);
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }

    public function create(Request $request, $id)
    {


        return view('admin.translation.create');
    }
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'keyword' => 'required|unique:keyword_translations,keyword',
            'group' => 'required',
            'value' => 'required|unique:keyword_translations,value',

        ]);
        try {

            $added = Translation::addUpdate($validatedData);
            if ($added['status']) {

                return redirect()->route('translation.index', $request->lang_id)->with('success', $added['message']);
            } else {
                return redirect()->back()->with('error', $added['message']);
            }
        } catch (\Exception $ex) {

            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }





    public function update(Request $request)
{
    try {
        $updated = Translation::addUpdate($request->all(), $request->input('id'));

        if ($updated['status']) {
            return response()->json(['success' => true, 'message' => 'Translation updated successfully.']);
        } else {
            return response()->json(['success' => false, 'message' => $updated['message']], 400); // Return JSON instead of redirect
        }
    } catch (\Exception $ex) {
        return response()->json([
            'success' => false,
            'message' => 'Error: ' . $ex->getMessage(),
            'line' => $ex->getLine(),
            'file' => $ex->getFile()
        ], 500); // Return JSON error instead of redirect
    }
}

}
