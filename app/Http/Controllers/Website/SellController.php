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
use Illuminate\Support\Facades\Crypt;

class SellController extends Controller
{
    
    // Category list
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
        $category = Category::where('id', $categoryId)
            ->where('status', 1)
            ->with(['subcategories' => function ($query) {
                $query->where('status', 1);
            }])
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

    // Add Listing form
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

    // Store Listing
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
                'status' => 0,
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

            return redirect()->back()->with('success', __('lang.website.listing_posted_successfully'));

        } catch (\Exception $e) {

            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
 
    // Listing
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
        // Status filter
        if ($request->status) {

            switch ($request->status) {

                case 'under_review':
                    $query->where('status', 0);
                    break;

                case 'live':
                    $query->where('status', 1)
                          ->where('is_sold', 0);
                    break;

                case 'rejected':
                    $query->where('status', 2);
                    break;

                case 'sold':
                    $query->where('status', 1)
                          ->where('is_sold', 1);
                    break;
            }
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

    // Load more
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

    // Edit
    public function sellEditListing($id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (\Exception $e) {
            abort(404); // invalid hash
        }

        $item = Item::with(['images', 'customFields'])->findOrFail($id);

        $subcategory = Category::where('id', $item->subcategory_id)->first();

        $customFields = CategoryCustomField::where('category_id', $item->subcategory_id)
            ->where('is_active', 1)
            ->orderBy('sort_order')
            ->get();

        foreach ($customFields as $field) {

            $field->options = CategoryCustomFieldOption::where('custom_field_id', $field->id)
                ->orderBy('sort_order')
                ->get();

            $existing = ItemCustomField::where('item_id', $item->id)
                ->where('custom_field_id', $field->id)
                ->first();

            if ($existing) {

                $decoded = json_decode($existing->value, true);

                if (json_last_error() === JSON_ERROR_NONE) {
                    // Always array
                    if (json_last_error() === JSON_ERROR_NONE) {
                        $field->value = is_array($decoded)
                            ? array_map('trim', $decoded)
                            : [trim($decoded)];
                    } else {
                        $field->value = [trim($existing->value)];
                    }
                } else {
                    $field->value = [$existing->value];
                }

            } else {
                $field->value = [];
            }
        }

        return view('website.sell.edit_listing', compact(
            'item',
            'subcategory',
            'customFields'
        ));
    }


    // Update
    public function update(Request $request)
    {
        try {
            $id = Crypt::decrypt($request->id);
        } catch (\Exception $e) {
            return back()->with('error', 'Invalid ID');
        }

        $item = Item::findOrFail($id);

        $subcategoryId = $request->subcategory_id;

        // Validation (same as store)
        $rules = [
            'title' => 'required|string|max:70',
            'description' => 'required|string|max:4000',
            'price' => 'required|numeric|min:1',
            'area' => 'required|string|max:70',
            'city' => 'nullable|string|max:70',
            'state' => 'nullable|string|max:70',
            'country' => 'nullable|string|max:70',
            'pincode' => 'nullable|string|max:10',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ];

        // Dynamic fields validation
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

            // Update item
            $item->update([
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'area' => $request->area,
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country,
                'pincode' => $request->pincode,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);

            // Update Custom Fields
            if ($request->custom_fields) {

                foreach ($request->custom_fields as $fieldId => $value) {

                    ItemCustomField::updateOrCreate(
                        [
                            'item_id' => $item->id,
                            'custom_field_id' => $fieldId
                        ],
                        [
                            'value' => is_array($value)
                                ? json_encode($value)
                                : $value
                        ]
                    );
                }
            }

            // Upload New Images (optional)
            if ($request->hasFile('images')) {

                foreach ($request->file('images') as $image) {

                    $filename = time().'_'.$image->getClientOriginalName();
                    $image->move(public_path('uploads/item_image'), $filename);

                    ItemImage::create([
                        'item_id' => $item->id,
                        'image'   => 'uploads/item_image/'.$filename
                    ]);
                }
            }

            DB::commit();

            return back()->with('success', __('lang.website.listing_update_success_msg'));

        } catch (\Exception $e) {

            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }


    // Mark as sold
    public function markAsSold($id)
    {
        try {
            $id = Crypt::decrypt($id);

            $item = Item::where('id', $id)
                        ->where('user_id', auth()->id())
                        ->firstOrFail();

            if ($item->is_sold == 1) {
                return back()->with('error', );
            }

            if ($item->status != 1) {
                return back()->with('error', __('lang.website.approved_items_can_be_marked_as_sold'));
            }

            $item->update([
                'is_sold' => 1
            ]);

            return back()->with('success', __('lang.website.item_marked_sold_success_msg'));

        } catch (\Exception $e) {
            return back()->with('error', __('lang.website.something_went_wrong'));
        }
    }
   
}