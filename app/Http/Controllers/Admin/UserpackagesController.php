<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Userquerie;
use App\Models\Userpackage;
use App\Models\UserPayment;
use Session;
use App\Exports\UserPackageExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class UserpackagesController extends Controller
{

    // user package list
    public function index(Request $request)
    {
        try {
            $data['result'] = Userpackage::getLists($request->all(),null);
            return view('admin.packages.userpackages.list', $data);
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }
    
    // export to excel
    public function exportQueryExcel(Request $request)
    {
        $fileName = 'userpackages_' . date('Ymd_His') . '.xlsx';

        return Excel::download(
            new UserPackageExport($request->all()),
            $fileName
        );
    }

    // export to pdf
    public function exportQueryPdf(Request $request)
    {
        $query = Userpackage::with(['user', 'itemPackage', 'adPackage'])
            ->whereNull('deleted_at');

        // Filter by name/email
        if (!empty($request->name)) {
            $search = $request->name;

            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");
            });
        }

        $result = $query->latest()->get();

        $pdf = Pdf::loadView('admin.packages.userpackages.export_pdf', compact('result'));

        $fileName = 'userpackages_' . date('Ymd_His') . '.pdf';

        return $pdf->download($fileName);
    }


    // ===========================Transaction List=======================

    // transaction list
    public function transactionOverview(Request $request)
    {
        try {
            $data['result'] = UserPayment::getLists($request->all());

            // Payment gateway options
            $data['paymentMethods'] = [
                'razorpay' => 'Razorpay',
                'stripe'   => 'Stripe',
                'paypal'   => 'Paypal',
            ];

            return view('admin.packages.transactions.list', $data);
        } catch (\Exception $ex) {
            return redirect()->back()->with(
                'error',
                $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile()
            );
        }
    }

}