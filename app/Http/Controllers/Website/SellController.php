<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Category;
use App\Models\CategoryCustomField;
use App\Models\CategoryCustomFieldOption;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Area;
use App\Models\Item;
use App\Models\ItemImage;
use App\Models\ItemCustomField;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SellController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', 1)->where('parent_id',0)
            ->orderBy('name')
            ->get();

        $firstCategory = $categories->first();

        return view('website.sell.index', compact('categories', 'firstCategory'));
    }


    /* =====================================
       AJAX: Get Subcategories
    ===================================== */
    public function getSubcategories($categoryId)
    {
        $category = Category::with('subcategories')
            ->where('id', $categoryId)
            ->where('status', 1)
            ->first();

        if (!$category) {
            return response()->json([
                'status' => false
            ]);
        }

        return response()->json([
            'status' => true,
            'category' => $category->name,
            'category_id' => $category->id,
            'subcategories' => $category->subcategories
        ]);
    }


    public function addSellListing($categoryId, $subcategoryId)
    {
        $subcategory = Category::where('id', $subcategoryId)
            ->where('parent_id', $categoryId)
            ->firstOrFail();

        $customFields = CategoryCustomField::where('category_id', $subcategoryId)
            ->where('is_active', 1)
            ->orderBy('sort_order')
            ->get();

        foreach ($customFields as $field) {
            $field->options = CategoryCustomFieldOption::where('custom_field_id', $field->id)
                ->orderBy('sort_order')
                ->get();
        }

        return view('website.sell.add_listing', compact(
            'subcategory',
            'customFields'
        ));
    }


    public function store(Request $request)
    {
        $subcategoryId = $request->subcategory_id;

        // Basic Validation
        $rules = [
            'title' => 'required|string|max:70',
            'description' => 'required|string|max:4000',
            'price' => 'required|numeric|min:1',
            'images' => 'required',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'area' => 'required|string|max:70',
            'city' => 'nullable|string|max:70',
            'state' => 'nullable|string|max:70',
            'country' => 'nullable|string|max:70',
            'pincode' => 'nullable|string|max:10',
        ];

        // Dynamic Custom Field Validation
        $customFields = CategoryCustomField::where('category_id', $subcategoryId)
            ->where('is_active', 1)
            ->get();

        foreach ($customFields as $field) {

            $fieldKey = "custom_fields." . $field->id;

            $fieldRules = [];

            if ($field->is_required) {
                $fieldRules[] = 'required';
            }

            if ($field->field_type == 'text') {
                $fieldRules[] = 'string';
            }

            if ($field->min_length) {
                $fieldRules[] = 'min:' . $field->min_length;
            }

            if ($field->max_length) {
                $fieldRules[] = 'max:' . $field->max_length;
            }

            $rules[$fieldKey] = implode('|', $fieldRules);
        }

        $request->validate($rules);

        DB::beginTransaction();

        try {

            $baseSlug = Str::slug($request->title);

            $slug = $baseSlug;
            $count = 1;

            while (Item::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $count;
                $count++;
            }


            // Save Item
            $listing = Item::create([
                'user_id' => auth()->id(),
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'slug' => $slug,
                'created_at' => now(),
                'updated_at' => now(),
                'area' => $request->area,
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country,
                'pincode' => $request->pincode,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);

            // Save Custom Fields
            if ($request->custom_fields) {
                foreach ($request->custom_fields as $fieldId => $value) {

                    ItemCustomField::create([
                        'item_id' => $listing->id,
                        'custom_field_id' => $fieldId,
                        'value' => is_array($value)
                            ? json_encode($value)
                            : $value
                    ]);
                }
            }

            // Upload Images
            if ($request->hasFile('images')) {

                foreach ($request->file('images') as $image) {

                    $filename = time().'_'.$image->getClientOriginalName();
                    $image->move(public_path('uploads/item_image'), $filename);

                    ItemImage::create([
                        'item_id' => $listing->id,
                        'image'   => 'uploads/item_image/'.$filename
                    ]);
                }
            }

            DB::commit();

            return redirect()->back()->with('success', 'Listing Posted Successfully');

        } catch (\Exception $e) {

            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
 

    public function sellListing(Request $request)
    {
        $limit = 6;

        $query = Item::with(['latestImage'])
            ->withCount([
                'favorites as favorite_count' => function($q){
                    $q->whereNull('deleted_at');
                }
            ])
            ->where('user_id', Auth::guard('web')->user()->id);

        // Status filter
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // Sorting
        if ($request->sort == 'price_high') {
            $query->orderBy('price', 'desc');
        } elseif ($request->sort == 'price_low') {
            $query->orderBy('price', 'asc');
        } elseif ($request->sort == 'oldest') {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $items = $query->limit($limit)->get();

        return view('website.sell.listing', compact('items'));
    }


    public function loadMoreItems(Request $request)
    {
        $offset = $request->offset ?? 0;
        $limit = 6;

        $query = Item::with(['images'])
            ->withCount([
                'favorites as favorite_count' => function($q){
                    $q->whereNull('deleted_at');
                }
            ])
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc');

        $items = $query->skip($offset)
                       ->take($limit)
                       ->get();

        return view('website.sell.partials.item_card', compact('items'))->render();
    }
   
}