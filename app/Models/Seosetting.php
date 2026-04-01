<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use DB;


class Seosetting extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];
    protected $table = "seo_settings";

    public static function getLists($search)
    {
        try {
            return self::query()
                ->when(
                    !empty($search['name']),
                    fn($query) =>
                    $query->where('title', 'like', "%" . trim($search['name']) . "%")
                )
                ->when(
                    isset($search['status']) && $search['status'] !== '',
                    fn($query) =>
                    $query->where('status', $search['status'])
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
                $uploadImage = \Helpers::uploadFiles($data['image'], 'seo/');
                if ($uploadImage['status'] == true) {
                    $data['image'] = $uploadImage['file_name'];
                }
            }


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
            $data = Seosetting::findOrFail($id);
            $data->update(['status' => !$data->status]);

            return ['status' => true, 'message' => __('lang.admin_data_change_msg')];
        } catch (\Exception $e) {
            \Log::error("Error in updateStatusColumn: {$e->getMessage()}", ['line' => $e->getLine(), 'file' => $e->getFile()]);
            return ['status' => false, 'message' => __('lang.admin_data_error_msg')];
        }
    }
}
