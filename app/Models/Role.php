<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as Roles;
use Spatie\Permission\Models\Permission;


class Role extends Model
{
    use HasFactory;
    protected $table = "roles";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_name','status'
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }


    /**
     * Fetch list  from here
    **/
    public static function getLists($search)
    {
        try 
        {
            $obj = new self;
            $pagination = (isset($search['perpage']))?$search['perpage']:config('constant.pagination');  
            if(isset($search['status']) && $search['status']!='')
            {
                $obj = $obj->where('status',$search['status']);
            }
            $data = $obj->whereIn('guard_name', ['admin', 'staff'])->latest('created_at')->paginate($pagination)->appends('perpage', $pagination);
            return $data;
        }
        catch (\Exception $e) 
        {
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

            // detect guard dynamically
            $guard = $data['guard_name'] ?? 'admin'; 
            // default admin if not passed

            if ($id == 0) {

                $role = Roles::create([
                    'name' => $data['name'],
                    'guard_name' => $guard
                ]);

                if ($role && isset($data['permission'])) {

                    $permissions = Permission::whereIn('id', $data['permission'])
                        ->where('guard_name', $guard)
                        ->get();

                    $role->syncPermissions($permissions);
                }

                return [
                    'status' => true,
                    'message' => __('lang.admin_data_add_msg')
                ];
            }

            else {

                $role = Roles::findOrFail($id);

                $role->update([
                    'name' => $data['name']
                ]);

                if (isset($data['permission'])) {

                    $permissions = Permission::whereIn('id', $data['permission'])
                        ->where('guard_name', $guard)
                        ->get();

                    $role->syncPermissions($permissions);
                }

                return [
                    'status' => true,
                    'message' => __('lang.admin_data_update_msg')
                ];
            }

        } catch (\Exception $e) {

            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Delete particular entry
     **/
    public static function deleteRecord($id)
    {
        try {
            $obj = new self;
            Roles::where('id', $id)->delete();
            return ['status' => true, 'message' => __('lang.admin_data_delete_msg')];
        } catch (\Exception $e) {
            return ['status' => false, 'message' => $e->getMessage() . ' ' . $e->getLine() . ' ' . $e->getFile()];
        }
    }
        
    
}
