<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class ContactUs extends Model
{
    use HasFactory;

    /**
     * Fetch list of categories from here
    **/
    public static function getLists($search)
    {
        try {

            $obj = new self;

            $pagination = isset($search['pageno']) ? $search['pageno'] : config('constants.pagination');

            if(isset($search['name']) && !empty($search['name'])){

                $keyword = $search['name'];

                $obj = $obj->where(function($q) use ($keyword){

                    $q->where(DB::raw('LOWER(name)'), 'like', '%'.strtolower($keyword).'%')
                      ->orWhere(DB::raw('LOWER(email)'), 'like', '%'.strtolower($keyword).'%')
                      ->orWhere(DB::raw('LOWER(subject)'), 'like', '%'.strtolower($keyword).'%')
                      ->orWhere(DB::raw('LOWER(message)'), 'like', '%'.strtolower($keyword).'%');

                });

            }

            $data = $obj->latest('created_at')
                        ->paginate($pagination)
                        ->appends(request()->query());

            return $data;

        }
        catch (\Exception $e) {

            return [
                'status' => false,
                'message' => $e->getMessage().' '.$e->getLine().' '.$e->getFile()
            ];

        }
    }

    /**
     * Add or update category
    **/
    public static function replyQuery($data,$id)
    {
        try {

            $contact = self::find($id);

            if(!$contact){
                return ['status'=>false,'message'=>'Contact not found'];
            }

            if(empty($data['reply'])){
                return ['status'=>false,'message'=>'Reply message is required'];
            }

            $dataArr = [
                'name' => $contact->name,
                'text' => $data['reply']
            ];

            \Helpers::sendEmail(
                'emails.reply',
                $dataArr,
                $contact->email,
                $contact->name,
                setting('name').' reply for your query.',
                setting('name').' App',
                setting('from_email'),
                ''
            );

            return [
                'status' => true,
                'message' => "Reply sent successfully."
            ];

        }
        catch (\Exception $e) {

            return [
                'status' => false,
                'message' => $e->getMessage().' '.$e->getLine().' '.$e->getFile()
            ];

        }
    }
}
