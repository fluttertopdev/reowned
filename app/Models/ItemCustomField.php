<?php

namespace App\Models; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class ItemCustomField extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = "item_custom_fields";


    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function field()
    {
        return $this->belongsTo(CategoryCustomField::class,'custom_field_id');
    }

}
