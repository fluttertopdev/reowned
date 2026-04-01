<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use DB;


class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];
    protected $table = "items";


    /* =========================
       RELATIONS
    ==========================*/

    public function images()
    {
        return $this->hasMany(ItemImage::class, 'item_id');
    }

    public function latestImage()
    {
        return $this->hasOne(ItemImage::class, 'item_id')->latestOfMany();
    }

    public function customFields()
    {
        return $this->hasMany(ItemCustomField::class, 'item_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(Category::class, 'subcategory_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public static function getLists($search)
    {
        try {
            return self::query()
                ->when(!empty($search['title']), fn($query) =>
                    $query->where('title', 'like', '%' . trim($search['title']) . '%')
                )
                ->when(isset($search['status']) && $search['status'] !== '', fn($query) =>
                    $query->where('status', $search['status'])
                )
                ->when(isset($search['user_id']) && $search['user_id'] !== '', fn($query) =>
                    $query->where('user_id', $search['user_id'])
                )
                ->with('latestImage')
                ->with('user')
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


    public static function updateColumn($id)
    {
        try {
            $data = self::where('id', $id)->first();

            // Assuming 'status' is an ENUM column with values '0' and '1'
            $newStatus = ($data->status == '1') ? '0' : '1';

            $data->update(['status' => $newStatus]);

            return ['status' => true, 'message' => __('lang.admin_data_change_msg')];
        } catch (\Exception $e) {
            return ['status' => false, 'message' => $e->getMessage() . ' ' . $e->getLine() . ' ' . $e->getFile()];
        }
    }

}
