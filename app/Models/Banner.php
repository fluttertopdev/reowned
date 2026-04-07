<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use DB;


class Banner extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];
    protected $table = "banners";

    public static function addUpdate($data, $id = 0)
    {
        try {
            unset($data['_token']);

            $data[$id ? 'updated_at' : 'created_at'] = now();
            
            self::where('id', $id)->update($data); 
            return ['status' => true, 'message' => __('lang.admin_data_update_msg')];

        } catch (\Exception $e) {

            return [
                'status'  => false,
                'message' => "{$e->getMessage()} at line {$e->getLine()} in file {$e->getFile()}"
            ];
        }
    }

}
