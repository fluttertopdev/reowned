<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Auth;
use DB;

class Adspackages extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];
    protected $table = "adpackages";

    public function payments()
    {
        return $this->hasMany(UserPayment::class, 'ad_package_id');
    }

    public function translation()
    {
        return $this->hasOne(AdspackageTranslation::class, 'adspackage_id')
            ->where('language_code', app()->getLocale());
    }

    public function getNameAttribute($value)
    {
        return optional($this->translation)->name ?? $value;
    }

    public function getDescriptionAttribute($value)
    {
        $translated = optional($this->translation)->description ?? $value;

        return html_entity_decode($translated);
    }

    public static function getLists($search, $status = null)
    {
        try {
            return self::query()

                // Name Search
                ->when(
                    !empty($search['name']),
                    fn($query) =>
                    $query->where('name', 'like', "%" . trim($search['name']) . "%")
                )

                // Status from search filter
                ->when(
                    isset($search['status']) && $search['status'] !== '',
                    fn($query) =>
                    $query->where('status', $search['status'])
                )

                // If status param is NOT NULL → force status = 1
                ->when(
                    !is_null($status),
                    fn($query) =>
                    $query->where('status', 1)
                )

                ->latest('id')
                ->paginate($search['pageno'] ?? config('constant.pagination'))
                ->withQueryString();

        } catch (\Exception $e) {
            return [
                'status'  => false,
                'message' => "{$e->getMessage()} at line {$e->getLine()} in file {$e->getFile()}"
            ];
        }
    }


    public static function addUpdate($data, $id = 0)
    {
        try {
            $obj = new self;
            unset($data['_token']);

            // Validate and handle image upload
            if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
                $uploadImage = \Helpers::uploadFiles($data['image'], 'packages/');
                if ($uploadImage['status'] == true) {
                    $data['image'] = $uploadImage['file_name'];
                }
            }


            $price = isset($data['price']) ? (float) $data['price'] : 0;
            $data['discount'] = isset($data['discount']) ? (float) $data['discount'] : 0;



            $data['final_price'] = $price - (($data['discount'] / 100) * $price);

            if ($id == 0) {
                // Insert new record
                $data['created_at'] = now();
                $package_id = $obj->insertGetId($data);
                return ['status' => true, 'message' => __('lang.admin_data_add_msg')];
            } else {
                // Update existing record
                $data['updated_at'] = now();
                $obj->where('id', $id)->update($data);
                return ['status' => true, 'message' => __('lang.admin_data_update_msg')];
            }
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => "{$e->getMessage()} at line {$e->getLine()} in file {$e->getFile()}"
            ];
        }
    }



    public static function deleteRecord($id)
    {
        try {
            $obj = new self;
            $obj->where('id', $id)->delete();
            return ['status' => true, 'message' => __('lang.admin_data_delete_msg')];
        } catch (\Exception $e) {
            return ['status' => false, 'message' => $e->getMessage() . ' ' . $e->getLine() . ' ' . $e->getFile()];
        }
    }



    public static function updateStatus($id)
    {
        try {
            $data = Adspackages::findOrFail($id);
            $data->update(['status' => !$data->status]);

            return ['status' => true, 'message' => __('lang.admin_data_change_msg')];
        } catch (\Exception $e) {
            \Log::error("Error in updateStatusColumn: {$e->getMessage()}", ['line' => $e->getLine(), 'file' => $e->getFile()]);
            return ['status' => false, 'message' => __('lang.admin_data_error_msg')];
        }
    }

    // this is for staff for get ads packages 
    public static function staffGetLists($search)
    {
        try {
            // Get the logged-in user's ID using the 'staff' guard
            $userId = Auth::guard('staff')->id(); // use 'staff' guard
            
            return self::query()
                ->when(
                    !empty($search['name']),
                    fn($query) => $query->where('name', 'like', "%" . trim($search['name']) . "%")
                )
                ->when(
                    isset($search['status']) && $search['status'] !== '',
                    fn($query) => $query->where('status', $search['status'])
                )
                // Add condition to filter by logged-in user's ID
                ->when(
                    $userId,
                    fn($query) => $query->where('user_id', $userId) // assuming 'user_id' is the column you want to filter by
                )
                ->latest('id')
                ->paginate($search['pageno'] ?? config('constant.pagination'))
                ->withQueryString();
        } catch (\Exception $e) {
            return [
                'status'  => false,
                'message' => "{$e->getMessage()} at line {$e->getLine()} in file {$e->getFile()}"
            ];
        }
    }

}
