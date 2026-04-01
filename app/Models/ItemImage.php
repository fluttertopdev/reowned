<?php

namespace App\Models; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class ItemImage extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = "item_images";


    public function item()
    {
        return $this->belongsTo(Item::class);
    }

}
