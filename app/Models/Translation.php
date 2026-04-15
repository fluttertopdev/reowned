<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Translation extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = "keyword_translations";

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id', 'id');
    }


    /**
     * Fetch list  from here
    **/
    public static function getLists($search)
    {
        try {
            $query = self::query();

            foreach (['value', 'group', 'language_id'] as $field) {
                if (!empty($search[$field])) {
                    $query->where($field, 'like', "%".trim($search[$field])."%");
                }
            }

            $pagination = $search['perpage'] ?? config('constant.pagination');
            $pageNumber = request('page', 1);

            return $query->latest('created_at')->paginate($pagination, ['*'], 'page', $pageNumber)->appends(request()->except('page'));
        }
        catch (\Exception $e) {
            return ['status' => false, 'message' => $e->getMessage() . ' '. $e->getLine() . ' '. $e->getFile()];
        }
    }

    /**
     * Add or update
    **/
    public static function addUpdate($data, $id = 0)
    {
        try {
            unset($data['_token']);

            $languages = Language::where('status', 1)->get();

            // INSERT / UPDATE
            if ($id == 0) {
                foreach ($languages as $language) {
                    Translation::create([
                        'language_id' => $language->id,
                        'group'       => $data['group'],
                        'keyword'     => $data['keyword'],
                        'key'         => $data['keyword'],
                        'value'       => $data['value'],
                        'created_at'  => now(),
                    ]);
                }
            } else {
                $translation = Translation::find($data['id']);
                if ($translation) {
                    $translation->value = $data['value'];
                    $translation->save();
                }
            }

            // GENERATE FILES
            foreach ($languages as $lang) {

                $translations = Translation::where('language_id', $lang->id)->get();

                $finalArray = [];

                foreach ($translations as $row) {

                    $value = $row->value;

                    // Only WEBSITE group nested
                    if ($row->group == 'website') {
                        $finalArray['website'][$row->keyword] = $value;
                    } else {
                        // All other groups flat
                        $finalArray[$row->keyword] = $value;
                    }
                }

                // Convert to PHP file format safely
                $fileContent = "<?php\n\nreturn " . var_export($finalArray, true) . ";";

                $path = resource_path('lang/' . $lang->code);

                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }

                file_put_contents($path . '/lang.php', $fileContent);
            }

            return ['status' => true, 'message' => $id == 0 ? __('lang.admin_data_add_msg') : __('lang.admin_data_update_msg')];

        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => $e->getMessage() . ' ' . $e->getLine() . ' ' . $e->getFile()
            ];
        }
    }

}
