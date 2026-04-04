<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

class Conversation extends Model
{
    protected $fillable = ['item_id','seller_id','buyer_id','last_message_at'];

    public function item(){
        return $this->belongsTo(Item::class);
    }

    public function buyer(){
        return $this->belongsTo(User::class,'buyer_id');
    }

    public function seller(){
        return $this->belongsTo(User::class,'seller_id');
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }

    public function lastMessage()
	{
	    return $this->hasOne(Message::class)->latestOfMany();
	}
}