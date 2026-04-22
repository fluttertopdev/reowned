<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reportreason;
use App\Models\ReasonTranslation;
use App\Models\Language;
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

    public function translation($id)
    {
        $reason = Reportreason::find($id);
        $languages = Language::where('status', 1)->get();

        foreach ($languages as $language) {
            // dd($language);
            $language->details = ReasonTranslation::where('reason_id', $id)->where('language_code', $language->code)->first();

            if (!$language->details) {
                $reasonData = [
                    'reason_id' => $id,
                    'language_code' => $language->code,
                    'reason' => $reason->reason,
                    'created_at' => date("Y-m-d H:i:s")
                ];
                ReasonTranslation::create($reasonData);
                $language->details = ReasonTranslation::where('reason_id', $id)
                    ->where('language_code', $language->code)
                    ->first();
            }
        }
        return view('admin.reportreason.translation', compact('reason', 'languages'));
    }


    public function updateTranslate($id, Request $request)
    {
        $input = $request->all();

        for ($i = 0; $i < count($input['language_code']); $i++) {
            $translationId = $input['translation_id'][$i] ?? null;
            $reason = trim(htmlspecialchars($input['reason'][$i], ENT_QUOTES, 'UTF-8')); // Prevent XSS

            $tipTranslationData = [
                'language_code' => $input['language_code'][$i],
                'reason' => $reason,
                'updated_at' => now(),
            ];

            if ($translationId) {
                ReasonTranslation::where('id', $translationId)->update($tipTranslationData);
            } else {
                $tipTranslationData['reason_id'] = $id;
                ReasonTranslation::create($tipTranslationData);
            }
        }

        return redirect(url('admin/report-reason'))->with('success', __('lang.admin_translation_updated'));
    }
    
}
