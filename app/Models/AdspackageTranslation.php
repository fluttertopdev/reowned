<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

class AdspackageTranslation extends Model
{

    use HasFactory;

    protected $guarded = ['id'];
    protected $table = "adpackages_translations";
}
