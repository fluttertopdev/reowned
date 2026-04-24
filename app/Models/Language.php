<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\File;
use App\Models\LanguageCode;
use App\Models\Translation;
use DB;

class Language extends Model
{
    use HasFactory;

    use SoftDeletes;
    protected $guarded = ['id'];
    protected $table = "languages";

    /**
     * Fetch list  from here
    **/
    public static function getLists($search)
    {
        try {
            return self::query()
                ->when(
                    !empty($search['name']),
                    fn($query) =>
                    $query->where('name', 'like', "%" . trim($search['name']) . "%")
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
    
    // Addd/Update Code
    public static function addUpdate($data, $id = 0)
    {
        try {
            unset($data['_token']);
            $data['updated_at'] = now();

            // ✅ Get language code
            $code = LanguageCode::find($data['code_id']);
            if ($code) {
                $data['name'] = $code->name;
                $data['code'] = $code->code;
            }

            // ✅ Handle default language
            $data['is_default'] = isset($data['is_default']) && $data['is_default'] == 'on' ? 1 : 0;
            if ($data['is_default']) {
                Language::where('id', '!=', $id)->update(['is_default' => 0]);
            }

            // ✅ CREATE / UPDATE
            if ($id == 0) {
                $data['created_at'] = now();
                $language = Language::create($data);
                $entry_id = $language->id;

                // 🔥 COPY ENGLISH TRANSLATIONS ONLY ON CREATE
                $englishLanguage = Language::where('code', 'en')->first();

                if ($englishLanguage) {
                    $translations = Translation::where('language_id', $englishLanguage->id)->get();

                    foreach ($translations as $row) {
                        Translation::create([
                            'language_id' => $entry_id,
                            'group'       => $row->group,
                            'keyword'     => $row->keyword,
                            'key'         => $row->key,
                            'value'       => $row->value, // default EN value
                            'created_at'  => now(),
                        ]);
                    }
                }

            } else {
                Language::where('id', $id)->update($data);
                $entry_id = $id;
            }

            // ✅ GENERATE LANGUAGE FILE (SAME LOGIC AS TRANSLATION MODEL)
            $languages = Language::where('status', 1)->get();

            foreach ($languages as $lang) {

                $translations = Translation::where('language_id', $lang->id)->get();

                $finalArray = [];

                foreach ($translations as $row) {

                    $value = $row->value;

                    // 🔥 WEBSITE GROUP NESTED
                    if ($row->group == 'website') {
                        $finalArray['website'][$row->keyword] = $value;
                    } else {
                        // OTHER GROUPS FLAT
                        $finalArray[$row->keyword] = $value;
                    }
                }

                // ✅ SAFE FILE WRITE
                $fileContent = "<?php\n\nreturn " . var_export($finalArray, true) . ";";

                $path = resource_path('lang/' . $lang->code);

                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }

                file_put_contents($path . '/lang.php', $fileContent);
            }

            return [
                'status' => true,
                'message' => $id == 0 ? "Data added successfully." : "Data updated successfully."
            ];

        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => $e->getMessage() . ' Line: ' . $e->getLine()
            ];
        }
    }


    /**
     * Delete particular entry
    **/
    public static function deleteRecord($id)
    {
        try {
            self::destroy($id);
            return ['status' => true, 'message' => __('lang.admin_data_delete_msg')];
        } catch (\Exception $e) {
            \Log::error("Error in deleteRecord: {$e->getMessage()}", ['line' => $e->getLine(), 'file' => $e->getFile()]);
            return ['status' => false, 'message' => __('lang.admin_data_error_msg')];
        }
    }
    
    /**
     * Update Columns 
    **/
    public static function updateStatus($id)
    {
        try {
            $data = Language::findOrFail($id);

            $data->update(['status' => !$data->status]); // Toggle status

            return ['status' => true, 'message' => __('lang.admin_data_change_msg')];
        } catch (\Exception $e) {
            dd($e->getMessage());
            \Log::error("Error in updateStatusColumn: {$e->getMessage()}", ['line' => $e->getLine(), 'file' => $e->getFile()]);
            return ['status' => false, 'message' => __('lang.admin_data_error_msg')];
        }
    }
}