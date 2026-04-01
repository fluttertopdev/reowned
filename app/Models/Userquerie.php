<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Auth;
use DB;


class Userquerie extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];
    protected $table = "user_queries";
 
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function getLists($search)
    {
        try {
            return self::query()
                ->with('user') 
                ->when(
                    !empty($search['name']),
                    fn($query) =>
                    $query->whereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', "%" . trim($search['name']) . "%")
                          ->orWhere('email', 'like', "%" . trim($search['name']) . "%");
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
