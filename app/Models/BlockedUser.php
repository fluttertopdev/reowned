<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

class BlockedUser extends Model
{
    protected $fillable = ['blocked_by','blocked_user_id'];

    public function blockedUser(){
        return $this->belongsTo(User::class,'blocked_user_id');
    }
}