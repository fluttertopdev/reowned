<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use DB;

class Cms extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];
    protected $table = "cms_contents";


    public function translation()
    {
        return $this->hasOne(CmsTranslation::class)
            ->where('language_code', app()->getLocale());
    }

    public function getPageNameAttribute($value)
    {
        return $this->translation->page_name ?? $value;
    }

    public function getDescriptionAttribute($value)
    {
        return $this->translation->description ?? $value;
    }

    public static function getLists($search)
    {
        try {
            return self::query()
                ->when(!empty($search['name']), fn($query) => 
                    $query->where('page_name', 'like', '%' . trim($search['name']) . '%')
                )
                ->when(isset($search['status']) && $search['status'] !== '', fn($query) => 
                    $query->where('status', $search['status'])
                )
                ->latest('id')
                ->paginate($search['pageno'] ?? config('constant.pagination'))
                ->withQueryString(); // Retains query parameters in pagination
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

            $data[$id ? 'updated_at' : 'created_at'] = now(); 

            if ($id == 0) {
                self::create($data);
                return ['status' => true, 'message' => __('lang.admin_data_add_msg')];
            } 
            
            self::where('id', $id)->update($data); 
            return ['status' => true, 'message' => __('lang.admin_data_update_msg')];

        } catch (\Exception $e) {
            dd($e->getMessage());
            return [
                'status'  => false,
                'message' => "{$e->getMessage()} at line {$e->getLine()} in file {$e->getFile()}"
            ];
        }
    }


    public static function deleteRecord($id)
    {
        try {
            self::destroy($id);
            return ['status' => true, 'message' => __('lang.admin_data_delete_msg')];
        } catch (\Exception $e) {
            \Log::error("Error in deleteRecord: {$e->getMessage()}", ['line' => $e->getLine(), 'file' => $e->getFile()]);
            return ['status' => false, 'message' => __('lang.admin_data_error_msg')];
        }
    }

    public static function updateStatus($id)
    {
        try {
            $data = Cms::findOrFail($id);
            $data->update(['status' => !$data->status]); // Toggle status

            return ['status' => true, 'message' => __('lang.admin_data_change_msg')];
        } catch (\Exception $e) {
            \Log::error("Error in updateStatusColumn: {$e->getMessage()}", ['line' => $e->getLine(), 'file' => $e->getFile()]);
            return ['status' => false, 'message' => __('lang.admin_data_error_msg')];
        }
    }
}
