<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Arr;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CategoryCustomField extends Model
{
    protected $fillable = [
        'category_id',
        'field_name',
        'field_type',
        'min_length',
        'max_length',
        'is_required',
        'is_active',
        'sort_order'
    ];

    public function options()
    {
        return $this->hasMany(CategoryCustomFieldOption::class, 'custom_field_id');
    }
}