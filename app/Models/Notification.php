<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Auth;
use DB;


class Notification extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];
    protected $table = "notifications";

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public static function getLists($search)
    {
        try {
            return self::query()
                ->with('user:id,name') // Eager load user and select only id & name
                ->when(
                    !empty($search['name']),
                    fn($query) =>
                    $query->where('title', 'like', "%" . trim($search['name']) . "%")
                )
                ->when(
                    isset($search['status']) && $search['status'] !== '',
                    fn($query) =>
                    $query->where('status', $search['status'])
                )
                ->latest('id')
                ->paginate($search['pageno'] ?? config('constant.pagination'))
                ->withQueryString();
        } catch (\Exception $e) {
            return [
                'status'  => false,
                'message' => "{$e->getMessage()} at line {$e->getLine()} in file {$e->getFile()}"
            ];
        }
    }


    public static function addUpdate($data, $id = 0)
    {
        try {
            unset($data['_token']);
            
            // Ensure user_id and item_id are arrays
            $userIds = is_array($data['user_id']) ? $data['user_id'] : [$data['user_id']];
            $itemIds = is_array($data['item_id']) ? $data['item_id'] : [$data['item_id']];

            // Validate and handle image upload (only once)
            if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
                $uploadImage = \Helpers::uploadFiles($data['image'], 'notification/');
                if ($uploadImage['status'] == true) {
                    $data['image'] = $uploadImage['file_name'];
                }
            }

            // Insert separate rows for each user-item combination
            foreach ($userIds as $userId) {
                foreach ($itemIds as $itemId) {
                    $insertData = [
                        'title' => $data['title'],
                        'staff_id' => $data['staff_id'] ?? null,
                        'image' => $data['image'] ?? null,
                        'msg' => $data['msg'],
                        'user_id' => $userId,
                        'item_id' => $itemId,
                        'created_at' => now(),
                    ];

                    self::insert($insertData);
                }
            }

            return ['status' => true, 'message' => __('lang.admin_data_add_msg')];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => "{$e->getMessage()} at line {$e->getLine()} in file {$e->getFile()}"
            ];
        }
    }

    public static function deleteRecord($id)
    {
        try {
            $obj = new self;
            $obj->where('id', $id)->delete();
            return ['status' => true, 'message' => __('lang.admin_data_delete_msg')];
        } catch (\Exception $e) {
            return ['status' => false, 'message' => $e->getMessage() . ' ' . $e->getLine() . ' ' . $e->getFile()];
        }
    }



    public static function updateStatus($id)
    {
        try {
            $data = Notification::findOrFail($id);
            $data->update(['status' => !$data->status]);

            return ['status' => true, 'message' => __('lang.admin_data_change_msg')];
        } catch (\Exception $e) {
            \Log::error("Error in updateStatusColumn: {$e->getMessage()}", ['line' => $e->getLine(), 'file' => $e->getFile()]);
            return ['status' => false, 'message' => __('lang.admin_data_error_msg')];
        }
    }


    // this is for staff
    public static function staffGetLists($search)
    {
        try {
            // Get the logged-in user's ID using the 'staff' guard
            $userId = Auth::guard('staff')->id(); // use 'staff' guard
            
            return self::query()
                ->when(
                    !empty($search['name']),
                    fn($query) => $query->where('title', 'like', "%" . trim($search['name']) . "%")
                )
                ->when(
                    isset($search['status']) && $search['status'] !== '',
                    fn($query) => $query->where('status', $search['status'])
                )
                // Add condition to filter by logged-in user's ID
                ->when(
                    $userId,
                    fn($query) => $query->where('staff_id', $userId) // assuming 'user_id' is the column you want to filter by
                )
                ->latest('id')
                ->paginate($search['pageno'] ?? config('constant.pagination'))
                ->withQueryString();
        } catch (\Exception $e) {
            return [
                'status'  => false,
                'message' => "{$e->getMessage()} at line {$e->getLine()} in file {$e->getFile()}"
            ];
        }
    }
}
