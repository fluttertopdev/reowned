<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class ModelHasPermission extends Model
{
    use HasFactory;

    protected $table = 'model_has_permissions';
    public $timestamps = false;
    protected $primaryKey = null;
    public $incrementing = false;

    protected $fillable = [
        'permission_id',
        'model_type',
        'model_id',
    ];

    /**
     * Relationship with the Permission model
     */
    public function permission()
    {
        return $this->belongsTo(Permission::class, 'permission_id');
    }

    /**
     * Relationship with the User model (or any other model using permissions)
     */
    public function user()
    {
        return $this->morphTo();
    }
}
