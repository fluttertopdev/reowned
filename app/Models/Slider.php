<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use DB;


class Slider extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];
    protected $table = "sliders";


    public static function getLists($search)
    {
        try {
            return self::query()
                ->leftJoin('categories', function ($join) {
                    $join->on('sliders.value', '=', 'categories.id')
                         ->where('sliders.type', 'category');
                })
                ->leftJoin('items', function ($join) {
                    $join->on('sliders.value', '=', 'items.id')
                         ->where('sliders.type', 'item');
                })
                ->select(
                    'sliders.*',
                    'categories.name as category_name',
                    'items.title as item_name'
                )
                ->when(
                    isset($search['name']) && $search['name'] !== '',
                    function ($query) use ($search) {
                        $query->where(function ($q) use ($search) {
                            $q->where('sliders.type', 'like', "%{$search['name']}%")
                              ->orWhere('categories.name', 'like', "%{$search['name']}%")
                              ->orWhere('items.name', 'like', "%{$search['name']}%");
                        });
                    }
                )
                ->when(
                    isset($search['status']) && $search['status'] !== '',
                    fn($query) => $query->where('sliders.status', $search['status'])
                )
                ->latest('sliders.id')
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

            if (isset($data['image']) && $data['image'] != '') {
                $uploadImage = \Helpers::uploadFiles($data['image'], 'slider/');
                if ($uploadImage['status'] == true) {
                    $data['image'] = $uploadImage['file_name'];
                }
            }

            if ($id == 0) {
                $data['created_at'] = date('Y-m-d H:i:s');
                $package_id = $obj->insertGetId($data);
                return ['status' => true, 'message' => __('lang.admin_data_add_msg')];
            } else {
                $data['updated_at'] = date('Y-m-d H:i:s');
                $obj->where('id', $id)->update($data);
                return ['status' => true, 'message' => __('lang.admin_data_update_msg')];
            }
        } catch (\Exception $e) {
              dd( $e->getMessage());
            return ['status' => false, 'message' => $e->getMessage() . ' ' . $e->getLine() . ' ' . $e->getFile()];
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
            $data = Slider::findOrFail($id);
            $data->update(['status' => !$data->status]);

            return ['status' => true, 'message' => __('lang.admin_data_change_msg')];
        } catch (\Exception $e) {
            \Log::error("Error in updateStatusColumn: {$e->getMessage()}", ['line' => $e->getLine(), 'file' => $e->getFile()]);
            return ['status' => false, 'message' => __('lang.admin_data_error_msg')];
        }
    }
}