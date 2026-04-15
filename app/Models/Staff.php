<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use DB;


class Staff extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];
    protected $table = "users";

    public static function getLists($search)
    {
        try {
            return self::query()
                ->where('type', 'staff') // Added condition to filter only 'staff'
                ->when(
                    !empty($search['name']),
                    fn($query) =>
                    $query->where('name', 'like', "%" . trim($search['name']) . "%")
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
            unset($data['_token']);

            // Hash password only if it's set
            if (!empty($data['password'])) {
                $data['password'] = bcrypt($data['password']);
            } else {
                unset($data['password']);
            }

            $data[$id ? 'updated_at' : 'created_at'] = now();

            if ($id == 0) {
                self::create($data);
                return ['status' => true, 'message' => __('lang.admin_data_add_msg')];
            }

            self::where('id', $id)->update($data);
            return ['status' => true, 'message' => __('lang.admin_data_update_msg')];

        } catch (\Exception $e) {
            return [
                'status'  => false,
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
            $data = Staff::findOrFail($id);
            $data->update(['status' => !$data->status]);

            return ['status' => true, 'message' => __('lang.admin_data_change_msg')];
        } catch (\Exception $e) {
            \Log::error("Error in updateStatusColumn: {$e->getMessage()}", ['line' => $e->getLine(), 'file' => $e->getFile()]);
            return ['status' => false, 'message' => __('lang.admin_data_error_msg')];
        }
    }
}
