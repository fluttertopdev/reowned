<?php

use App\Models\User;
use GuzzleHttp\Client;
use App\Models\Homepage;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Language;
use App\Models\RoleHasPermission;
use App\Models\Permission;
use App\Models\Cms;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Helpers
{
    /*
     * function for check price response
     */
    public static function commonCurrencyFormate()
    {
        return setting('currency');
    }

    public static function getAllLangList()
    {
        $list  = Language::where('status', 1)->get();
        return $list;
    }

    public static function getAssignedPermissions()
    {
        return Session::get('permissions', []);
    }

    /*
     * function for check null response
     */
    public static function checkNull($val = null)
    {
        if ($val == '' || $val == null) {
            return '--';
        } else {
            return $val;
        }
    }

    /*
     * function for common date format with time
     */
    public static function commonDateFormateWithTime($value = null)
    {
        if (isset($value) && !empty($value) && ($value != '0000-00-00' && $value != '0000-00-00 00:00:00' && $value != '1970-01-01')) {
            $value = trim($value);
            return date('d-m-Y h:i A', strtotime($value));
        } else {
            return 'NA';
        }
    }


    /*
     * function for common date format
     */
    public static function commonDateFormate($value = null)
    {
        if (isset($value) && !empty($value) && ($value != '0000-00-00' && $value != '0000-00-00 00:00:00' && $value != '1970-01-01')) {
            $value = trim($value);
            return date('d-m-Y', strtotime($value));
        } else {
            return 'NA';
        }
    }

    /*
     * function for common time format
     */
    public static function commonTimeFormate($value = null)
    {
        if (isset($value) && !empty($value) && ($value != '0000-00-00' && $value != '0000-00-00 00:00:00' && $value != '1970-01-01')) {
            $value = trim($value);
            return date('g:i A', strtotime($value));
        } else {
            return 'NA';
        }
    }

    /**
     * Upload file
     **/
    public static function uploadFiles($file, $folderName)
    {
        try {
            // Get the uploaded file
            $image = $file;

            // Generate a unique name for the file
            $rand = rand('9999', '1000');
            $imageName = $rand . time() . '.' . $image->extension();

            // Move the file to the public folder
            $image->move(public_path('uploads/' . $folderName), $imageName);

            // Return the path to the uploaded image
            $imagePath = 'uploads/' . $folderName . '/' . $imageName;

            return [
                'status' => true,
                'message' => config('constant.common.messages.success_image'),
                'file_name' => $imageName, // Fix this line
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => $e->getMessage() . ' ' . $e->getLine() . ' ' . $e->getFile(),
            ];
        }
    }


    /**
     * Check Role has selected that permission
     **/
    public static function checkRoleHasPermission($role_id, $permission_id)
    {
        // $language = setting('preferred_site_language');
        $permission = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $role_id)
            ->where("role_has_permissions.permission_id", $permission_id)->count();
        if ($permission > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    // for convert key
    public static function maskApiKey($key)
    {
        if ($key && strlen($key) >= 5) {
            return str_repeat('*', strlen($key) - 5) . substr($key, -5);
        } else {
            return '';
        }
    }

    // for get version
    public static function getVersion($filePath)
    {
        return json_decode(file_get_contents($filePath), true)['version'];
    }

    // for get language direction
    public static function getLanguageDirection($langCode)
    {
        $lang = Language::where('code', $langCode)->first();
        if ($lang) {
            $direction = $lang->position;
        } else {
            $direction = 'ltr';
        }
        return $direction;
    }


    public static function staffgetAssignedPermissions()
    {
        $user = Auth::guard('staff')->user(); // Get the logged-in staff user

        if (!$user) {
            return [];
        }

        // Get role_id from the user
        $roleId = $user->role_id; // Assuming `role_id` is a column in users table

        // Get all permission IDs from RoleHasPermission for this role
        $permissionIds = RoleHasPermission::where('role_id', $roleId)->pluck('permission_id');

        // Fetch permission names using the IDs
        $permissions = Permission::whereIn('id', $permissionIds)->pluck('name')->toArray();

        return $permissions;
    }

    // this is for get status type
    public static function getStatusType()
    {
        return [
            '1' => __('lang.admin_active_label'),
            '0' => __('lang.admin_deactive_label'),
        ];
    }


    /**
     * function for send email
     */
    public static function sendEmail(
        $template,
        $data,
        $toEmail,
        $toName,
        $subject,
        $fromName = '',
        $fromEmail = '',
        $attachment = ''
    ) {

        try {

            // Dynamically configure mail settings
            config([
                'mail.default' => setting('mailer'),
                'mail.mailers.smtp.host' => setting('host'),
                'mail.mailers.smtp.port' => setting('port'),
                'mail.mailers.smtp.username' => setting('username'),
                'mail.mailers.smtp.password' => setting('password'),
                'mail.mailers.smtp.encryption' => setting('encryption'),
                'mail.from.address' => setting('from_email_address'),
                'mail.from.name' => setting('from_name'),
            ]);

            // If not passed manually, use system settings
            $fromEmail = $fromEmail ?: setting('from_email_address');
            $fromName  = $fromName ?: setting('from_name');

            \Mail::send($template, $data, function ($message) use (
                $toEmail,
                $toName,
                $subject,
                $fromName,
                $fromEmail,
                $attachment
            ) {

                $message->to($toEmail, $toName)
                        ->subject($subject)
                        ->from($fromEmail, $fromName);

                if ($attachment != '') {
                    $message->attach($attachment);
                }
            });

            return 1;

        } catch (\Exception $ex) {
            dd($ex->getMessage());
            \Log::error('Mail Error: ' . $ex->getMessage());
            return 0;
        }
    }

    public static function getCmsForSite(){
        return Cms::with('translation')
        ->where('status',1)
        ->get();
    }


    public static function getUserActivePackage($userId)
    {
        return DB::table('user_packages')
            ->where('user_id', $userId)
            ->where('is_active', 1)
            ->where(function ($q) {
                $q->whereNull('end_date')
                  ->orWhereDate('end_date', '>=', now());
            })
            ->first();
    }

    public static function canUserPostItem($userId)
    {
        $package = DB::table('user_packages')
            ->where('user_id', $userId)
            ->where('is_active', 1)
            ->whereNotNull('item_package_id')
            ->where(function ($q) {
                $q->whereNull('end_date')
                  ->orWhereDate('end_date', '>=', now());
            })
            ->first();

        if (!$package) {
            return [
                'status' => false,
                'message' => __('lang.website.please_purchase_item_plan_first'),
                'code' => 'NO_PLAN'
            ];
        }

        if (!is_null($package->total_limit) && $package->used_limit >= $package->total_limit) {
            return [
                'status' => false,
                'message' => __('lang.website.item_limit_exhausted'),
                'code' => 'LIMIT_OVER'
            ];
        }

        return [
            'status' => true,
            'code' => 'OK',
            'package' => $package
        ];
    }
}
