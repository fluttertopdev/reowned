<?php

namespace App\Models; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Userpackage extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = "user_packages";

    // User relation
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Item package
    public function itemPackage()
    {
        return $this->belongsTo(Itempackage::class, 'item_package_id');
    }

    // Ads package
    public function adPackage()
    {
        return $this->belongsTo(Adspackages::class, 'ad_package_id');
    }


    public static function getLists($filters = [] , $userId = null)
    {
        $query = self::with(['user', 'itemPackage', 'adPackage'])
            ->whereNull('deleted_at');

        if($userId != null){
            $query->where('user_id',$userId);
        }

        // Search by name/email
        if (!empty($filters['name'])) {
            $search = $filters['name'];

            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");
            });
        }

        if (!empty($filters['type'])) {
            if ($filters['type'] == 'item') {
                $query->whereNotNull('item_package_id');
            } elseif ($filters['type'] == 'ads') {
                $query->whereNotNull('ad_package_id');
            }
        }

        // Pagination
        $perPage = $filters['pageno'] ?? 10;

        return $query->latest()->paginate($perPage);
    }
}