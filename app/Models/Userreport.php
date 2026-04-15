<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Auth;
use DB;


class Userreport extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];
    protected $table = "userreports";
 
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
    

    public function reportReason()
    {
        return $this->belongsTo(Reportreason::class, 'reason_id');
    }

    
    public static function getLists($search)
    {
        try {
            return self::query()
                ->selectRaw('item_id, COUNT(*) as total_reports, MAX(created_at) as created_at')
                ->with(['item.user']) // item + user
                ->groupBy('item_id')
                
                ->when(
                    !empty($search['name']),
                    fn($query) =>
                    $query->whereHas('item', function ($q) use ($search) {
                        $q->where('title', 'like', "%" . trim($search['name']) . "%");
                    })
                )

                ->latest()
                ->paginate($search['pageno'] ?? config('constant.pagination'))
                ->withQueryString();

        } catch (\Exception $e) {
            return [
                'status'  => false,
                'message' => "{$e->getMessage()} at line {$e->getLine()}"
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

}