<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Adspackages;
use App\Models\Itempackage;
use App\Models\Userpackage;
use App\Models\UserPayment;
use App\Models\User;
use Session;

class CustomersController extends Controller
{

    public function index(Request $request)
    {
        try {
            $data['result'] = User::getLists($request->all(),'');
            return view('admin.customers.list', $data);
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
        return view('admin.customers.form', compact('data'));
    }

    
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:adpackages',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits_between:7,15',
            'address' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           
        ]);
        // **Sanitize Inputs**
        $validatedData['name'] = htmlspecialchars(strip_tags($validatedData['name']), ENT_QUOTES, 'UTF-8'); // Prevent XSS
        $validatedData['address'] = htmlspecialchars(strip_tags($validatedData['address']), ENT_QUOTES, 'UTF-8'); // Prevent XSS

        try {
            $updated = User::addUpdate($validatedData, $request->input('id'));
            if ($updated['status'] == true) {
              
                 return redirect()->route('customer.index')->with('success', $updated['message']);
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


    public function adsPackage(Request $request, $id)
    {
        try {
            $data['result'] = Adspackages::getLists($request->all(), 1);

            return view('admin.customers.adspackage', $data);
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }


    public function assignPackage(Request $request)
    {
        try {
            $selectedPackageId = $request->input('selected_ids')[0] ?? null;
            $userId = $request->input('user_ids')[0] ?? null;

            if (!$selectedPackageId || !$userId) {
                return redirect()->back()->with('error', __('lang.admin_invalid_data_provided'));
            }

            // Get package
            $package = \DB::table('adpackages')->where('id', $selectedPackageId)->first();

            if (!$package) {
                return redirect()->back()->with('error', __('lang.admin_package_not_found'));
            }

            // Assign package
            $this->assignUserPackage($userId, $package, 'ads');

            // Store payment (manual admin entry)
            $this->storeAdminPayment($userId, $package, 'ads');
            

            return redirect()->route('customer.index')
                ->with('success', __('lang.admin_package_assigned_successfully'));

        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }


    public function itemPackage(Request $request, $id)
    {
        try {
            $data['result'] = Itempackage::getLists($request->all(), 1);

            return view('admin.customers.itempackage', $data);
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }


    public function assignItemPackage(Request $request)
    {
        try {
            $selectedPackageId = $request->input('selected_ids')[0] ?? null;
            $userId = $request->input('user_ids')[0] ?? null;

            if (!$selectedPackageId || !$userId) {
                return redirect()->back()->with('error', __('lang.admin_invalid_data_provided'));
            }

            // Get Item Package
            $package = \DB::table('item_packages')->where('id', $selectedPackageId)->first();

            if (!$package) {
                return redirect()->back()->with('error', __('lang.admin_item_package_not_found'));
            }

            \DB::beginTransaction();

            // Assign package
            $this->assignUserPackage($userId, $package, 'item');

            // Store payment (Admin Manual Entry)
            $this->storeAdminPayment($userId, $package, 'item', ['note' => 'Item package assigned by admin manually']);
            
            \DB::commit();

            return redirect()->route('customer.index')
                ->with('success', __('lang.admin_item_package_assigned_successfully'));

        } catch (\Exception $ex) {
            \DB::rollBack();
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }


    public function userPackage(Request $request,$id)
    {
        try {
            $userId = $id;
            $data['result'] = Userpackage::getLists($request->all(),$userId);
            return view('admin.customers.packagesview', $data);
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }

    // ============================Common Function==========================
    private function assignUserPackage($userId, $package, $type)
    {
        $startDate = now();

        if ($package->days === 'limited') {
            $endDate = now()->addDays($package->no_of_days);
        } else {
            $endDate = null;
        }

        \DB::table('user_packages')
            ->where('user_id', $userId)
            ->where('is_active', 1)
            ->update([
                'is_active' => 0,
                'updated_at' => now()
            ]);

        return \DB::table('user_packages')->insert([
            'user_id' => $userId,
            'item_package_id' => $type === 'item' ? $package->id : null,
            'ad_package_id' => $type === 'ads' ? $package->id : null,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'total_limit' => $package->item === 'limited' ? $package->no_of_item : null,
            'used_limit' => 0,
            'is_active'  => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }


    private function storeAdminPayment($userId, $package, $type, $extra = [])
    {
        return $this->storePayment([
            'user_id' => $userId,
            'package_id' => $package->id,
            'type' => $type,

            'gateway' => 'bank_transfer',
            'transaction_id' => null,
            'order_id' => null,

            'amount' => $package->price,
            'currency' => 'INR',

            'status' => 'success',

            'response' => array_merge([
                'note' => 'Assigned by admin manually',
                'assigned_by' => auth()->id()
            ], $extra)
        ]);
    }

    private function storePayment($data)
    {
        return \DB::table('user_payments')->insert([
            'user_id' => $data['user_id'],
            'item_package_id' => $data['type'] === 'item' ? $data['package_id'] : null,
            'ad_package_id' => $data['type'] === 'ads' ? $data['package_id'] : null,

            'payment_gateway' => $data['gateway'],
            'transaction_id' => $data['transaction_id'] ?? null,
            'order_id' => $data['order_id'] ?? null,

            'amount' => $data['amount'],
            'currency' => $data['currency'] ?? 'INR',

            'payment_status' => $data['status'],

            'gateway_response' => json_encode($data['response'] ?? null),

            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
    
}
