<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use DB;


class Faq extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];
    protected $table = "faqs";

    public function translation()
    {
        return $this->hasOne(FaqTranslation::class, 'faq_id')
            ->where('language_code', app()->getLocale());
    }

    public function getTitleAttribute($value)
    {
        return optional($this->translation)->title ?? $value;
    }

    public function getDescriptionAttribute($value)
    {
        $translated = optional($this->translation)->description ?? $value;

        return html_entity_decode($translated);
    }


    public static function getLists($search)
    {
        try {
            return self::query()
                ->when(!empty($search['name']), fn($query) => 
                    $query->where('title', 'like', "%".trim($search['name'])."%")
                )
                ->when(isset($search['status']) && $search['status'] !== '', fn($query) => 
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
            $data = Faq::findOrFail($id);
            $data->update(['status' => !$data->status]); 

            return ['status' => true, 'message' => __('lang.admin_data_change_msg')];
        } catch (\Exception $e) {
            \Log::error("Error in updateStatusColumn: {$e->getMessage()}", ['line' => $e->getLine(), 'file' => $e->getFile()]);
            return ['status' => false, 'message' => __('lang.admin_data_error_msg')];
        }
    }

}
