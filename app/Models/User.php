<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Mail\ExampleMail;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles,SoftDeletes;

    protected $guard_name = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
        'type',
        'image',
        'country_code',
        'phone',
        'status',
        'is_verified',
        'otp_count',
        'otp',
        'role_id',
        'otp_expires_at',
        'address',
        'id_proof_front',
        'id_proof_back',
        'enable_notificaton',
        'enable_contact_info',
        'login_type',
        'email_verification_token',
        'email_verification_expires_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = ['deleted_at'];

    public function items()
    {
        return $this->hasMany(Item::class, 'user_id', 'id');
    }

    public function payments()
    {
        return $this->hasMany(UserPayment::class, 'user_id');
    }


    public static function getProfile()
    {
        try {
            $obj = new self;
            $id = Auth::user()->id;
            $data = $obj->where('id', $id)->firstOrFail();
            return $data;
        } catch (\Exception $e) {
            return ['status' => false, 'message' => $e->getMessage() . ' ' . $e->getLine() . ' ' . $e->getFile()];
        }
    }


    public static function updateProfile($data, $id)
    {
        try {
            unset($data['_token']);

            // Handle image upload
            if (isset($data['image']) && !empty($data['image'])) {
                $uploadImage = \Helpers::uploadFiles($data['image'], 'user/');
                if ($uploadImage['status'] === true) {
                    $data['image'] = $uploadImage['file_name'];
                }
            }

            // Handle password hashing
            if (!empty($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            } else {
                unset($data['password']);
            }


            // Update timestamp
            $data['updated_at'] = now(); // Use Laravel's helper

            // Update user profile
            self::where('id', $id)->update($data);

            return ['status' => true, 'message' => __('Profile updated successfully')];
        } catch (\Exception $e) {

            return ['status' => false, 'message' => $e->getMessage() . ' ' . $e->getLine() . ' ' . $e->getFile()];
        }
    }


    public static function doForgetPassword($data)
    {
         
        try {
            $obj = new Self;

            $credentials = $data['email'];

            $user = $obj->where('email', $data['email'])
                        ->where('type', $data['type'])
                        ->first();

            if (!$user) {
                return ['status' => false, 'message' => __('No user found with this email and type')];
            }

           

            $otp = rand(1000, 9999);
            $details = [
                'subject' => 'Forgot Password',
                'message' => 'We received a request to reset your password. Your OTP is ' . $otp,
            ];

            // Send Email
            Mail::to($credentials)->send(new ExampleMail($details));

            // Store OTP in database
            User::where('id', $user->id)->update([
                'otp' => $otp,
                'otp_expires_at' => now()->addDay(), // OTP expires in 1 day
            ]);

            return ['status' => true, 'message' => __('OTP is sent to your email')];

        } catch (\Exception $e) {
            return ['status' => false, 'message' => $e->getMessage() . ' on line ' . $e->getLine() . ' in file ' . $e->getFile()];
        }
    }

    public static function adminResetpassword($data)
    {
        try {
            $obj = new Self;

            // Find user by OTP and check if OTP is not expired
            $user = $obj->where('otp', $data['otp'])
                ->where('otp_expires_at', '>=', now()) // Check OTP expiry
                ->first();

            if (!$user) {
                return ['status' => false, 'message' => ' OTP has expired.'];
            }

            // If password is provided, update it
            if (!empty($data['password'])) {
                $user->update([
                    'password' => bcrypt($data['password']),
                    'otp' => 0, // Reset OTP after successful password reset
                    'otp_expires_at' => null, // Clear OTP expiry time
                ]);

                return ['status' => true, 'message' => 'Password reset successfully.'];
            }

            return ['status' => false, 'message' => 'Password is required.'];
        } catch (\Exception $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }


    // this is for staff
    public static function staffGetProfile()
    {
        try {
            $obj = new self;
            $id = Auth::guard('staff')->user()->id;
            $data = $obj->where('id', $id)->firstOrFail();
            return $data;
        } catch (\Exception $e) {
            return [
                'status' => false, 
                'message' => $e->getMessage() . ' ' . $e->getLine() . ' ' . $e->getFile()
            ];
        }
    }


    // Get List
    public static function getLists($search,$type=null)
    {
        try {
            return self::query()
                ->when(
                    !empty($search['name']),
                    fn($query) =>
                    $query->where(function ($q) use ($search) {
                        $q->where('name', 'like', "%" . trim($search['name']) . "%")
                          ->orWhere('email', 'like', "%" . trim($search['name']) . "%");
                    })
                )
                ->when(
                    isset($search['status']) && $search['status'] !== '',
                    fn($query) =>
                    $query->where('status', $search['status'])
                )
                ->when(
                    isset($type) && $type!=null,
                    fn($query) =>
                    $query->whereNotNull('id_proof_front')
                )
                ->where('type', 'user')
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
            $obj = new self;
            unset($data['_token']);

            // Validate and handle image upload
            if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
                $uploadImage = \Helpers::uploadFiles($data['image'], 'user/');
                if ($uploadImage['status'] == true) {
                    $data['image'] = $uploadImage['file_name'];
                }
            }

             if (isset($data['id_proof_front']) && $data['id_proof_front'] instanceof \Illuminate\Http\UploadedFile) {
                $uploadImage = \Helpers::uploadFiles($data['id_proof_front'], 'user/');
                if ($uploadImage['status'] == true) {
                    $data['id_proof_front'] = $uploadImage['file_name'];
                }
            }


             if (isset($data['id_proof_back']) && $data['id_proof_back'] instanceof \Illuminate\Http\UploadedFile) {
                $uploadImage = \Helpers::uploadFiles($data['id_proof_back'], 'user/');
                if ($uploadImage['status'] == true) {
                    $data['id_proof_back'] = $uploadImage['file_name'];
                }
            }

            if ($id == 0) {
                // Insert new record
                $data['created_at'] = now();
                $package_id = $obj->insertGetId($data);
                return ['status' => true, 'message' => __('lang.admin_data_add_msg')];
            } else {
                // Update existing record
                $data['updated_at'] = now();
                $obj->where('id', $id)->update($data);
                return ['status' => true, 'message' => __('lang.admin_data_update_msg')];
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
            $data = User::findOrFail($id);
            $data->update(['status' => !$data->status]);

            return ['status' => true, 'message' => __('lang.admin_data_change_msg')];
        } catch (\Exception $e) {
            \Log::error("Error in updateStatusColumn: {$e->getMessage()}", ['line' => $e->getLine(), 'file' => $e->getFile()]);
            return ['status' => false, 'message' => __('lang.admin_data_error_msg')];
        }
    }

    // =============================Staff==============================
    public static function getStaffLists($search)
    {
        try {
            return self::query()
                ->where('type', 'staff') // Added condition to filter only 'staff'
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


    public static function addUpdateStaff($data, $id = 0)
    {
        try {
            unset($data['_token']);

            // Hash password only if it's set
            if (!empty($data['password'])) {
                $data['password'] = bcrypt($data['password']);
            } else {
                unset($data['password']);
            }

            $data['type'] = 'staff';
            $data[$id ? 'updated_at' : 'created_at'] = now();

            if ($id == 0) {
                $user = self::create($data);

                if (!empty($data['role_id'])) {
                    $role = \Spatie\Permission\Models\Role::find($data['role_id']);
                    if ($role) {
                        $user->assignRole($role);
                    }
                }
                return ['status' => true, 'message' => __('lang.admin_data_add_msg')];
            }

            $user = self::findOrFail($id);
            $user->update($data);

            if (!empty($data['role_id'])) {
                $role = \Spatie\Permission\Models\Role::find($data['role_id']);
                if ($role) {
                    $user->syncRoles([$role]);
                }
            }
            return ['status' => true, 'message' => __('lang.admin_data_update_msg')];

        } catch (\Exception $e) {
            return [
                'status'  => false,
                'message' => "{$e->getMessage()} at line {$e->getLine()} in file {$e->getFile()}"
            ];
        }
    }

}
