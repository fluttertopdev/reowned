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

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];
    protected $table = "categories";

    protected $casts = [
        'custom_fields' => 'array',
    ];

    public function customFields()
    {
        return $this->hasMany(CategoryCustomField::class, 'category_id');
    }

    public function subcategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')
                    ->where('status', 1)
                    ->orderBy('name');
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'subcategory_id');
    }

    public function translation()
    {
        return $this->hasOne(CategoryTranslation::class)
            ->where('language_code', app()->getLocale());
    }

    public function getNameAttribute($value)
    {
        return $this->translation->name ?? $value;
    }


    public static function getLists($search, $categoryId = null)
    {
        try {
            return self::query()
                ->with(['subcategories', 'parent']) // Load parent category
                ->when(
                    $categoryId,
                    fn($query) =>
                    $query->where('parent_id', $categoryId), // Fetch subcategories
                    fn($query) => $query->where('parent_id', 0) // Fetch only parent categories
                )
                ->when(
                    !empty($search['name']),
                    fn($query) =>
                    $query->where('name', 'like', "%{$search['name']}%")
                )
                ->when(
                    isset($search['status']) && $search['status'] !== '',
                    fn($query) =>
                    $query->where('status', $search['status'])
                )
                ->orderByDesc('is_featured')
                ->orderBy('featured_position', 'asc')
                ->orderByDesc('id')
                ->paginate($search['pageno'] ?? config('constant.pagination'))
                ->appends(request()->query());
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => "{$e->getMessage()} at line {$e->getLine()} in file {$e->getFile()}"
            ];
        }
    }


    public static function addUpdate($data, $id = 0)
    {
        try {
            $data = Arr::except($data, ['_token']);

            // Handle image upload
            if (!empty($data['image'])) {
                $uploadImage = \Helpers::uploadFiles($data['image'], 'category/');
                if ($uploadImage['status']) {
                    $data['image'] = $uploadImage['file_name'];
                }
            }
            $data['slug'] = Str::slug($data['name']);
            // Set timestamps automatically
            $data[$id ? 'updated_at' : 'created_at'] = now();

            // Use updateOrInsert for better efficiency
            if ($id) {

                self::where('id', $id)->update($data);
                return ['status' => true, 'message' => __('lang.admin_data_update_msg')];
            } else {
                self::insertGetId($data);
                return ['status' => true, 'message' => __('lang.admin_data_add_msg')];
            }
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
            self::destroy($id);
            return ['status' => true, 'message' => __('lang.admin_data_delete_msg')];
        } catch (\Exception $e) {
            Log::error("Error in deleteRecord: {$e->getMessage()}", ['line' => $e->getLine(), 'file' => $e->getFile()]);
            return ['status' => false, 'message' => __('lang.admin_data_error_msg')];
        }
    }



    public static function updateStatus($id)
    {
        try {
            $data = Category::findOrFail($id);
            $data->update(['status' => !$data->status]); // Toggle status

            return ['status' => true, 'message' => __('lang.admin_data_change_msg')];
        } catch (\Exception $e) {
            Log::error("Error in updateStatusColumn: {$e->getMessage()}", ['line' => $e->getLine(), 'file' => $e->getFile()]);
            return ['status' => false, 'message' => __('lang.admin_data_error_msg')];
        }
    }



    // this for staff

    public static function staffGetLists($search, $categoryId = null)
    {
        try {
            // Get the logged-in user's ID from the guard
            $userId = Auth::guard('staff')->id(); // Use appropriate guard for logged-in user

            return self::query()
                ->with(['subcategories', 'parent']) // Load parent category
                ->when(
                    $categoryId,
                    fn($query) =>
                    $query->where('parent_id', $categoryId), // Fetch subcategories
                    fn($query) => $query->where('parent_id', 0) // Fetch only parent categories
                )
                ->when(
                    !empty($search['name']),
                    fn($query) =>
                    $query->where('name', 'like', "%{$search['name']}%")
                )
                ->when(
                    isset($search['status']) && $search['status'] !== '',
                    fn($query) =>
                    $query->where('status', $search['status'])
                )
                // Filter by user ID if needed (for instance, only categories belonging to the logged-in user)
                ->when(
                    $userId, // Check if a user is authenticated
                    fn($query) => $query->where('user_id', $userId) // Filter categories by the user ID
                )
                ->latest('id')
                ->paginate($search['pageno'] ?? config('constant.pagination'))
                ->appends(request()->query());
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => "{$e->getMessage()} at line {$e->getLine()} in file {$e->getFile()}"
            ];
        }
    }
}
