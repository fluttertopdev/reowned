<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Auth;
use DB;


class Review extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];
    protected $table = "reviews";
 
 public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

public function item()
{
    return $this->belongsTo(Item::class, 'item_id');
}



 public static function getLists($search)
{
    try {
        return self::query()
            ->with(['user', 'item']) // Eager load related models
            ->when(
                !empty($search['name']),
                fn($query) =>
                $query->where(function ($q) use ($search) {
                    $q->whereHas('user', function ($uq) use ($search) {
                        $uq->where('name', 'like', "%" . trim($search['name']) . "%");
                    })
                    ->orWhereHas('item', function ($iq) use ($search) {
                        $iq->where('name', 'like', "%" . trim($search['name']) . "%");
                    });
                })
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
