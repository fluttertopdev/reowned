<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Adspackages;
use App\Models\Itempackage;
use App\Models\User;
use App\Models\Item;
use App\Models\Userpackage;
use App\Models\UserPayment;
use Session;
use App\Exports\SellersExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class SellerController extends Controller
{

    public function index(Request $request)
    {
        try {
            $data['result'] = User::getLists($request->all(),'id_proof_front');
            return view('admin.seller.list', $data);
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }


    public function form(Request $request, $id = null)
    {
        $data = null;

        if ($id) {
            $data = User::find($id);
        }

        return view('admin.seller.form', compact('data'));
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:adpackages',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits_between:7,15',
            'address' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'id_proof_front' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'id_proof_back' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // **Sanitize Inputs**
        $validatedData['name'] = htmlspecialchars(strip_tags($validatedData['name']), ENT_QUOTES, 'UTF-8'); // Prevent XSS
        $validatedData['address'] = htmlspecialchars(strip_tags($validatedData['address']), ENT_QUOTES, 'UTF-8'); // Prevent XSS

        try {
            $updated = User::addUpdate($validatedData, $request->input('id'));
            if ($updated['status'] == true) {

                return redirect()->route('seller.index')->with('success', $updated['message']);
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
            $deleted = User::deleteRecord($id);

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
            $updated = User::updateStatus($id);

            return redirect()->back()->with($updated['status'] ? 'success' : 'error', $updated['message']);
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }


    public function exportExcel()
    {
        $fileName = 'sellers_' . date('Ymd_His') . '.xlsx';
        return Excel::download(new SellersExport, $fileName);
    }


    public function exportPdf()
    {
        $sellers = User::where('type', 'user')
            ->select('name', 'email', 'phone', 'status', 'address')
            ->get();

        $pdf = Pdf::loadView('admin.seller.export_pdf', compact('sellers'));

        $fileName = 'sellers_' . date('Ymd_His') . '.pdf';

        return $pdf->download($fileName);
    }


    public function viewDetails(Request $request, $id)
    {
        $param['user_id'] = $id;
        $itemData = Item::getLists($param);
        $result = Userpackage::getLists($request->all(),$id);
        $transactionData = UserPayment::getLists($param);

        return view('admin.seller.view', compact('result','itemData','transactionData'));
    }
}
