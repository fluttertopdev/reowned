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
    public static function addUpdate($data, $id=0)
    {


        try 
        {
            $obj = new self;
            unset($data['_token']);
            if($id==0)
            {
                $languages = Language::where('status',1)->get();

               
                foreach ($languages as $language) 
                {
                    $translation = array(
                        'language_id'=>$language->id,
                        'group'=>$data['group'],
                        'keyword'=>$data['keyword'],
                        'key'=>$data['keyword'],
                        'value'=>$data['value'],
                        'created_at' =>date("Y-m-d H:i:s"),
                    );
                    Translation::insert($translation);
                    $fileName = 'lang.php';
                    $path = resource_path('/lang/'.$language->code); // Specify the path where you want to create the folder
                    $filePath = $path . '/'.$fileName;
                    if (!file_exists($path)) {
                        mkdir($path, 0777, true);
                    }
                    if (!file_exists($filePath)) {
                        file_put_contents($filePath, '<?php return [];');
                    }
                }
                foreach ($languages as $lang) {
                    $data = "<?php
                        return [
                            /*
                            |--------------------------------------------------------------------------
                            | Pagination Language Lines
                            |--------------------------------------------------------------------------
                            |
                            | The following language lines are used by the paginator library to build
                            | the simple pagination links. You are free to change them to anything
                            | you want to customize your views to better match your application.
                            |
                            */
                    ";
                    $translations = Translation::where('language_id',$lang->id)->get();
                    foreach ($translations as $row) {
                        $row->value = str_replace("'", "",$row->value);
                        $data .= "'".$row->keyword."' => '".$row->value."',\n";
                    }
                    $data .= "];";
                        
                    $fp = fopen('resources/lang/'.$lang->code.'/lang.php', 'w');
                    fwrite($fp, $data);
                    fclose($fp);
                }
                return ['status' => true, 'message' => "Data added successfully."];
            }
            else
            {
               
        $translation = Translation::find($data['id']);
    if ($translation) {
        $translation->value = $data['value'];
        $translation->save();

      
    }
                $languages = Language::where('status',1)->get();
                foreach ($languages as $lang) {
                    $data = "<?php
                        return [
                            /*
                            |--------------------------------------------------------------------------
                            | Pagination Language Lines
                            |--------------------------------------------------------------------------
                            |
                            | The following language lines are used by the paginator library to build
                            | the simple pagination links. You are free to change them to anything
                            | you want to customize your views to better match your application.
                            |
                            */
                    ";
                    $translations = Translation::where('language_id',$lang->id)->get(); 
                    foreach ($translations as $row) {
                        $row->value = str_replace("'", "",$row->value);
                        $data .= "'".$row->keyword."' => '".$row->value."',\n";
                    }
                    $data .= "];";
                        
                    $fp = fopen('resources/lang/'.$lang->code.'/lang.php', 'w');
                    fwrite($fp, $data);
                    fclose($fp);
                }
                return ['status' => true, 'message' => "Data updated successfully."];
            }
        } 
        catch (\Exception $e) 
        {

            return ['status' => false, 'message' => $e->getMessage() . ' '. $e->getLine() . ' '. $e->getFile()];
        }
    }
}
