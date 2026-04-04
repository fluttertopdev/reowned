<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

class Message extends Model
{
    protected $fillable = [
        'conversation_id','sender_id','message','file','type'
    ];

    public function sender(){
        return $this->belongsTo(User::class,'sender_id');
    }
}