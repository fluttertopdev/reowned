<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Language;
use App\Models\CategoryTranslation;
use App\Models\CategoryCustomField;
use App\Models\CategoryCustomFieldOption;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;
use Str;
use DB;

class CategoryController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Display a listing of the categories.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     **/
    public function index(Request $request)
    {
        try {
            $categoryId = $request->query('category');
            $data['result'] = Category::getLists($request->all(), $categoryId);

            return view('admin.category.list', $data);
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' at line ' . $ex->getLine() . ' in file ' . $ex->getFile());
        }
    }


    public function form(Request $request, $id = null)
    {
        $data = $id ? Category::findOrFail($id) : null;

        return view('admin.category.create', compact('data'));
    }


    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $validatedData = $request->validate([
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('categories')->whereNull('deleted_at')
                ],
                'slug' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('categories')->whereNull('deleted_at')
                ],
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'description' => 'required|string',
                'parent_id' => 'required|integer',
            ]);

            $validatedData['name'] = trim(strip_tags($validatedData['name']));

            $category = new Category();
            $category->fill($validatedData);

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time().'_'.$file->getClientOriginalName();
                $file->move(public_path('uploads/category'), $filename);
                $category->image = $filename;
            }

            $category->slug = $request->slug ?? null;

            $category->save();

            /*
            |----------------------------------------
            | Save Custom Fields (ONLY Subcategory)
            |----------------------------------------
            */
            if ($category->parent_id != 0 && $request->filled('custom_fields')) {

                $fields = json_decode($request->custom_fields, true);

                foreach ($fields as $index => $field) {

                    $customField = CategoryCustomField::create([
                        'category_id' => $category->id,
                        'field_name'  => $field['name'],
                        'field_type'  => $field['type'],
                        'min_length'  => $field['min'] ?? null,
                        'max_length'  => $field['max'] ?? null,
                        'is_required' => $field['required'] ?? 0,
                        'is_active'   => $field['active'] ?? 1,
                        'sort_order'  => $index
                    ]);

                    // Insert options
                    if (in_array($field['type'], ['dropdown','checkbox']) && !empty($field['options'])) {

                        foreach ($field['options'] as $optIndex => $option) {

                            CategoryCustomFieldOption::create([
                                'custom_field_id' => $customField->id,
                                'option_value'    => $option,
                                'sort_order'      => $optIndex
                            ]);
                        }
                    }
                }
            }

            DB::commit();

            return redirect()->route('category.index');

        } catch (\Exception $e) {

            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
    }



    /**
     * Update the specified category in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  id  $id
     * @return \Illuminate\Http\Response
     **/

    public function update(Request $request)
    {
        DB::beginTransaction();

        try {

            $validatedData = $request->validate([
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('categories')
                        ->ignore($request->id)
                        ->whereNull('deleted_at'),
                ],
                'slug' => 'required|string|max:255',
                'description' => 'required|string',
                'parent_id' => 'required|integer',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $category = Category::findOrFail($request->id);
            $category->fill($validatedData);

            if ($request->hasFile('image')) {

                if ($category->image && file_exists(public_path('uploads/category/'.$category->image))) {
                    unlink(public_path('uploads/category/'.$category->image));
                }

                $file = $request->file('image');
                $filename = time().'_'.$file->getClientOriginalName();
                $file->move(public_path('uploads/category'), $filename);
                $category->image = $filename;
            }

            $category->save();

            /*
            |----------------------------------------
            | Delete Old Custom Fields
            |----------------------------------------
            */
            $category->customFields()->delete();

            /*
            |----------------------------------------
            | Reinsert New Custom Fields
            |----------------------------------------
            */
            if ($category->parent_id != 0 && $request->filled('custom_fields')) {

                $fields = json_decode($request->custom_fields, true);

                foreach ($fields as $index => $field) {

                    $customField = CategoryCustomField::create([
                        'category_id' => $category->id,
                        'field_name'  => $field['name'],
                        'field_type'  => $field['type'],
                        'min_length'  => $field['min'] ?? null,
                        'max_length'  => $field['max'] ?? null,
                        'is_required' => $field['required'] ?? 0,
                        'is_active'   => $field['active'] ?? 1,
                        'sort_order'  => $index
                    ]);

                    if (in_array($field['type'], ['dropdown','checkbox']) && !empty($field['options'])) {

                        foreach ($field['options'] as $optIndex => $option) {

                            CategoryCustomFieldOption::create([
                                'custom_field_id' => $customField->id,
                                'option_value'    => $option,
                                'sort_order'      => $optIndex
                            ]);
                        }
                    }
                }
            }

            DB::commit();

            return redirect()->route('category.index');

        } catch (\Exception $e) {

            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
    }


    public function destroy($id)
    {
        try {
            $deleted = Category::deleteRecord($id);

            if ($deleted['status'] == true) {
                return redirect()->back()->with('success', $deleted['message']);
            } else {
                return redirect()->back()->with('error', $deleted['message']);
            }
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }

    public function updateStatus($id)
    {
        try {
            $updated = Category::updateStatus($id);
            if ($updated['status'] == true) {
                return redirect()->back()->with('success', $updated['message']);
            } else {
                return redirect()->back()->with('error', $updated['message']);
            }
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }
    }


    public function translation($id)
    {
        $category = Category::find($id);
        $languages = Language::where('status', 1)->get();

        foreach ($languages as $language) {
            $language->details = CategoryTranslation::where('category_id', $id)
                ->where('language_code', $language->code)
                ->first();

            // If translation does not exist, create it
            if (!$language->details) {
                $faqData = [
                    'category_id'   => $id,
                    'language_code' => $language->code,
                    'name'          => $category->name,
                    'description'   => $category->description,
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ];
                CategoryTranslation::create($faqData);
                $language->details = CategoryTranslation::where('category_id', $id)
                    ->where('language_code', $language->code)
                    ->first();
            }

            // If the language is the default language, update its name & description
            if ($language->is_default == 1) {
                $language->details->update([
                    'name'        => $category->name,
                    'description' => $category->description,
                    'updated_at'  => now(),
                ]);
            }
        }

        return view('admin.category.translation', compact('category', 'languages'));
    }


    public function updateTranslate($id, Request $request)
    {
        $customMessages = [];

        foreach ($request->input('language_code', []) as $index => $languageCode) {
            $customMessages["name.$index.required"] = "The name for language ($languageCode) is required.";
            $customMessages["description.$index.required"] = "The description for language ($languageCode) is required.";
        }

        $request->validate([
            'language_code' => 'required|array',
            'language_code.*' => 'required|string',
            'name' => 'required|array',
            'name.*' => 'required|string|max:255',
            'description' => 'required|array',
            'description.*' => 'required|string',
        ], $customMessages);

        $input = $request->all();

        for ($i = 0; $i < count($input['language_code']); $i++) {
            $translationId = $input['translation_id'][$i] ?? null;


            $name = trim(strip_tags($input['name'][$i]));  // Remove extra spaces & HTML tags
            $description = trim(htmlspecialchars($input['description'][$i], ENT_QUOTES, 'UTF-8')); // Prevent XSS

            $categoryTranslationData = [
                'language_code' => $input['language_code'][$i],
                'name' => $name,
                'description' => $description,
                'updated_at' => now(),
            ];

            if ($translationId) {
                CategoryTranslation::where('id', $translationId)->update($categoryTranslationData);
            } else {
                $categoryTranslationData['category_id'] = $id;
                CategoryTranslation::create($categoryTranslationData);
            }
        }

        return redirect(url('admin/category'))->with('success', __('lang.admin_translation_updated'));
    }


    public function sorting(Request $request)
    {
        try {

            foreach ($request->order as $order) {

                Category::where('id', $order['id'])
                    ->update([
                        'featured_position' => $order['position'],
                    ]);
            }

            return response([
                'status' => true,
                'message' => __('lang.admin_category_order_updated'),
                'data' => []
            ]);

        } catch (\Exception $ex) {

            return response([
                'status' => false,
                'message' => $ex->getMessage()
            ]);
        }
    }

    public function updateFeatured($id)
    {
        $category = Category::findOrFail($id);

        $category->is_featured = $category->is_featured == 1 ? 0 : 1;

        // If turning OFF → remove position
        if ($category->is_featured == 0) {
            $category->featured_position = null;
        }

        $category->save();

        return redirect()->back()->with('success', __('lang.admin_featured_status_updated'));
    }
}
