<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Auth;
use DB;

class UserPayment extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];
    protected $table = "user_payments";

    public function itemPackage()
    {
        return $this->belongsTo(Itempackage::class, 'item_package_id');
    }

    public function adPackage()
    {
        return $this->belongsTo(Adspackages::class, 'ad_package_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getPackageNameAttribute()
    {
        return $this->itemPackage->name 
            ?? $this->adPackage->name 
            ?? 'N/A';
    }

    public static function getLists($filters = [])
    {
        $query = self::with('user')->latest();

        // Search by user name
        if (!empty($filters['name'])) {
            $query->whereHas('user', function ($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['name'] . '%');
            });
        }

        if (!empty($filters['user_id'])) {
            $query->where('user_id', $filters['user_id']);
        }

        // Filter by payment gateway
        if (!empty($filters['payment_gateway'])) {
            $query->where('payment_gateway', $filters['payment_gateway']);
        }

        // Pagination
        $perPage = $filters['pageno'] ?? 10;

        return $query->paginate($perPage);
    }

}
