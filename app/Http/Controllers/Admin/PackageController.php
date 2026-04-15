<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Adspackages;
use App\Models\Itempackage;
use App\Models\Language;
use App\Models\AdspackageTranslation;
use App\Models\ItempackageTranslation;
use Session;
use App\Exports\PackageExport;
use App\Exports\ItemPackageExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class PackageController extends Controller
{

    // =================== Ads Packages =====================
    public function index(Request $request)
    {
        try {
            $data['result'] = Adspackages::getLists($request->all());

            return view('admin.packages.adspackage.list', $data);
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }


    public function form(Request $request, $id = null)
    {
        $data = null;

        if ($id) {
            $data = Adspackages::find($id);
        }

        return view('admin.packages.adspackage.create', compact('data'));
    }


    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:item_packages',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric',
            'days' => 'required',
            'item' => 'required',
            'no_of_days' => 'nullable|numeric',
            'no_of_item' => 'nullable|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
        ]);



        // **Sanitize Inputs**
        $validatedData['name'] = htmlspecialchars(strip_tags($validatedData['name']), ENT_QUOTES, 'UTF-8'); // Prevent XSS

        try {
            // Save the sanitized data
            $added = Adspackages::addUpdate($validatedData);

            if ($added['status'] == true) {
                Session::flash('success', $added['message']);

                // Check if parent_id is not 0, redirect to subcategory page
                return redirect('admin/advertisement-package')->with('success', $added['message']);
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
            'name' => 'required|string|max:255|unique:item_packages,name,' . $request->id,
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric',
            'days' => 'required',
            'item' => 'required',
            'no_of_days' => 'nullable|numeric',
            'no_of_item' => 'nullable|numeric',
            'image' => 'nullable',
            'description' => 'required',
        ]);
        // **Sanitize Inputs**
        $validatedData['name'] = htmlspecialchars(strip_tags($validatedData['name']), ENT_QUOTES, 'UTF-8'); // Prevent XSS

        try {
            $updated = Adspackages::addUpdate($validatedData, $request->input('id'));
            if ($updated['status'] == true) {
                return redirect('admin/advertisement-package')->with('success', $updated['message']);
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
            $deleted = Adspackages::deleteRecord($id);

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
            $updated = Adspackages::updateStatus($id);

            return redirect()->back()->with($updated['status'] ? 'success' : 'error', $updated['message']);
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }


    public function translation($id)
    {
        $Adspackages = Adspackages::find($id);
        $languages = Language::where('status', 1)->get();

        foreach ($languages as $language) {
            // dd($language);
            $language->details = AdspackageTranslation::where('adspackage_id', $id)->where('language_code', $language->code)->first();

            if (!$language->details) {
                $faqData = [
                    'adspackage_id' => $id,
                    'language_code' => $language->code,
                    'name' => $Adspackages->name,
                    'description' => $Adspackages->description,

                    'created_at' => date("Y-m-d H:i:s")
                ];
                AdspackageTranslation::create($faqData);
                $language->details = AdspackageTranslation::where('adspackage_id', $id)
                    ->where('language_code', $language->code)
                    ->first();
            }
        }
        return view('admin.packages.adspackage.translation', compact('Adspackages', 'languages'));
    }


    public function updateTranslate($id, Request $request)
    {
        $customMessages = [];

        foreach ($request->input('language_code', []) as $index => $languageCode) {
            $customMessages["name.$index.required"] = "The name for language ($languageCode) is required.";
            $customMessages["description.$index.required"] = "The description for language ($languageCode) is required.";
        }

        $request->validate([
            'language_code' => 'required|array',
            'language_code.*' => 'required|string',
            'name' => 'required|array',
            'name.*' => 'required|string|max:255',
            'description' => 'required|array',
            'description.*' => 'required|string',
        ], $customMessages);

        $input = $request->all();

        for ($i = 0; $i < count($input['language_code']); $i++) {
            $translationId = $input['translation_id'][$i] ?? null;


            $name = trim(strip_tags($input['name'][$i]));  // Remove extra spaces & HTML tags
            $description = trim(htmlspecialchars($input['description'][$i], ENT_QUOTES, 'UTF-8')); // Prevent XSS

            $adspackageTranslationData = [
                'language_code' => $input['language_code'][$i],
                'name' => $name,
                'description' => $description,
                'updated_at' => now(),
            ];

            if ($translationId) {
                AdspackageTranslation::where('id', $translationId)->update($adspackageTranslationData);
            } else {
                $adspackageTranslationData['adspackage_id'] = $id;
                AdspackageTranslation::create($adspackageTranslationData);
            }
        }

        return redirect(url('admin/advertisement-package'))->with('success', __('lang.admin_translation_updated'));
    }


    public function exportExcel()
    {
        $fileName = 'adspackages_' . date('Ymd_His') . '.xlsx';
        return Excel::download(new PackageExport, $fileName);
    }


    public function exportPdf()
    {
        $packages = Adspackages::select(
            'name',
            'price',
            'discount',
            'final_price',
            'days',
            'no_of_days',
            'item',
            'no_of_item',
            'status',
            'created_at'
        )->get();

        $pdf = Pdf::loadView('admin.packages.adspackage.export_pdf', compact('packages'));

        $fileName = 'adspackages_' . date('Ymd_His') . '.pdf';

        return $pdf->download($fileName);
    }

    // ===================Item listing packages======================
    public function itemPackages(Request $request)
    {
        try {
            $data['result'] = Itempackage::getLists($request->all());
            return view('admin.packages.itempackage.list', $data);
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }


    public function itemPackagesform(Request $request, $id = null)
    {
        $data = null;

        if ($id) {
            $data = Itempackage::find($id);
        }
        return view('admin.packages.itempackage.create', compact('data'));
    }


    public function storeListingPackage(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:item_packages',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric',
            'days' => 'required',
            'item' => 'required',
            'no_of_days' => 'nullable|numeric',
            'no_of_item' => 'nullable|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
        ]);



        // **Sanitize Inputs**
        $validatedData['name'] = htmlspecialchars(strip_tags($validatedData['name']), ENT_QUOTES, 'UTF-8'); // Prevent XSS

        try {
            // Save the sanitized data
            $added = Itempackage::addUpdate($validatedData);

            if ($added['status'] == true) {
                Session::flash('success', $added['message']);

                // Check if parent_id is not 0, redirect to subcategory page
                return redirect('admin/item-listing-package')->with('success', $added['message']);
            } else {
                return redirect()->back()->with('error', $added['message']);
            }
        } catch (\Exception $ex) {


            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }


    public function itemlistingPackageUpdate(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:item_packages,name,' . $request->id,
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric',
            'days' => 'required',
            'item' => 'required',
            'no_of_days' => 'nullable|numeric',
            'no_of_item' => 'nullable|numeric',
            'image' => 'nullable',
            'description' => 'required',
        ]);
        // **Sanitize Inputs**
        $validatedData['name'] = htmlspecialchars(strip_tags($validatedData['name']), ENT_QUOTES, 'UTF-8'); // Prevent XSS

        try {
            $updated = Itempackage::addUpdate($validatedData, $request->input('id'));
            if ($updated['status'] == true) {
                return redirect('admin/item-listing-package')->with('success', $updated['message']);
            } else {
                return redirect()->back()->with('error', $updated['message']);
            }
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }



    public function updateListingPackageStatus($id)
    {
        try {
            $updated = Itempackage::updateStatus($id);

            return redirect()->back()->with($updated['status'] ? 'success' : 'error', $updated['message']);
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }



    public function destroyListingPackage($id)
    {
        try {
            $deleted = Itempackage::deleteRecord($id);

            if ($deleted['status'] == true) {
                return redirect()->back()->with('success', $deleted['message']);
            } else {
                return redirect()->back()->with('error', $deleted['message']);
            }
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }



    public function itemPackagetranslation($id)
    {
        $itempackages = Itempackage::find($id);
        $languages = Language::where('status', 1)->get();

        foreach ($languages as $language) {
            // dd($language);
            $language->details = ItempackageTranslation::where('itempackage_id', $id)->where('language_code', $language->code)->first();

            if (!$language->details) {
                $faqData = [
                    'itempackage_id' => $id,
                    'language_code' => $language->code,
                    'name' => $itempackages->name,
                    'description' => $itempackages->description,

                    'created_at' => date("Y-m-d H:i:s")
                ];
                ItempackageTranslation::create($faqData);
                $language->details = ItempackageTranslation::where('itempackage_id', $id)
                    ->where('language_code', $language->code)
                    ->first();
            }
        }
        return view('admin.packages.itempackage.translation', compact('itempackages', 'languages'));
    }


    public function itemPackageupdateTranslate($id, Request $request)
    {
        $customMessages = [];

        foreach ($request->input('language_code', []) as $index => $languageCode) {
            $customMessages["name.$index.required"] = "The name for language ($languageCode) is required.";
            $customMessages["description.$index.required"] = "The description for language ($languageCode) is required.";
        }

        $request->validate([
            'language_code' => 'required|array',
            'language_code.*' => 'required|string',
            'name' => 'required|array',
            'name.*' => 'required|string|max:255',
            'description' => 'required|array',
            'description.*' => 'required|string',
        ], $customMessages);

        $input = $request->all();

        for ($i = 0; $i < count($input['language_code']); $i++) {
            $translationId = $input['translation_id'][$i] ?? null;


            $name = trim(strip_tags($input['name'][$i]));  // Remove extra spaces & HTML tags
            $description = trim(htmlspecialchars($input['description'][$i], ENT_QUOTES, 'UTF-8')); // Prevent XSS

            $itempackageTranslationData = [
                'language_code' => $input['language_code'][$i],
                'name' => $name,
                'description' => $description,
                'updated_at' => now(),
            ];

            if ($translationId) {
                ItempackageTranslation::where('id', $translationId)->update($itempackageTranslationData);
            } else {
                $itempackageTranslationData['itempackage_id'] = $id;
                ItempackageTranslation::create($itempackageTranslationData);
            }
        }

        return redirect(url('admin/item-listing-package'))->with('success', __('lang.admin_translation_updated'));
    }


    public function exportItemExcel()
    {
        $fileName = 'itempackages_' . date('Ymd_His') . '.xlsx';
        return Excel::download(new ItemPackageExport, $fileName);
    }


    public function exportItemPdf()
    {
        $packages = Itempackage::select(
            'name',
            'price',
            'discount',
            'final_price',
            'days',
            'no_of_days',
            'item',
            'no_of_item',
            'status',
            'created_at'
        )->get();

        $pdf = Pdf::loadView('admin.packages.itempackage.export_pdf', compact('packages'));

        $fileName = 'itempackages_' . date('Ymd_His') . '.pdf';

        return $pdf->download($fileName);
    }

}
