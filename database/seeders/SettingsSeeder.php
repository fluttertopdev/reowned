<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;
use anlutro\LaravelSettings\Facade as ContentSetting;
use Carbon\Carbon;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $now = Carbon::now();

        $settings = [

            // General
            ['key' => 'preferred_site_language', 'value' => 'en'],
            ['key' => 'name', 'value' => 'Reowned'],
            ['key' => 'email', 'value' => 'demo@example.com'],
            ['key' => 'currency', 'value' => '₹'],

            // Branding
            ['key' => 'logo', 'value' => 'default-logo.png'],
            ['key' => 'favicon', 'value' => 'default-favicon.png'],
            ['key' => 'footer_logo', 'value' => 'default-footer.png'],

            // Contact
            ['key' => 'contact_number1', 'value' => '9999999999'],
            ['key' => 'contact_number2', 'value' => '8888888888'],
            ['key' => 'address', 'value' => 'Demo address here'],

            // Payment - Razorpay
            ['key' => 'enable_razorpay', 'value' => '0'],
            ['key' => 'razorpay_key', 'value' => 'rzp_test_xxxxx'],
            ['key' => 'razorpay_secret', 'value' => 'secret_xxxxx'],

            // Payment - Stripe
            ['key' => 'enable_stripe', 'value' => '0'],
            ['key' => 'stripe_key', 'value' => 'pk_test_xxxxx'],
            ['key' => 'stripe_secret_key', 'value' => 'sk_test_xxxxx'],

            // Payment - PayPal
            ['key' => 'enable_paypal', 'value' => '0'],
            ['key' => 'paypal_client_id', 'value' => 'client_id_xxxxx'],
            ['key' => 'paypal_secret_key', 'value' => 'secret_xxxxx'],

            // Payment Method
            ['key' => 'payment_method', 'value' => 'stripe'],
            ['key' => 'enable_cod', 'value' => '1'],

            // Mail Config
            ['key' => 'mailer', 'value' => 'smtp'],
            ['key' => 'host', 'value' => 'smtp.mailtrap.io'],
            ['key' => 'port', 'value' => '2525'],
            ['key' => 'username', 'value' => 'demo_user'],
            ['key' => 'password', 'value' => 'demo_pass'],
            ['key' => 'encryption', 'value' => 'tls'],
            ['key' => 'from_name', 'value' => 'Reowned'],
            ['key' => 'from_email_address', 'value' => 'no-reply@example.com'],

            // Maintenance
            ['key' => 'enable_maintainance_mode', 'value' => '0'],
            ['key' => 'maintainance_title', 'value' => 'Site Under Maintenance'],
            ['key' => 'maintainance_short_text', 'value' => 'We will be back soon'],

            // Social Media
            ['key' => 'facebook', 'value' => 'https://facebook.com/'],
            ['key' => 'instagram', 'value' => 'https://instagram.com/'],
            ['key' => 'linkedin', 'value' => 'https://linkedin.com/'],
            ['key' => 'x_social_media', 'value' => 'https://x.com/'],

            // Google
            ['key' => 'enable_google_login', 'value' => '0'],
            ['key' => 'google_client_id', 'value' => 'google_client_id'],
            ['key' => 'google_client_secret', 'value' => 'google_secret'],
            ['key' => 'google_redirect_url', 'value' => 'http://localhost/auth/google/callback'],
            ['key' => 'google_map_key', 'value' => 'google_map_key'],
            
            // Adsense ad
            ['key' => 'enable_adsense_horizontal_ad', 'value' => '0'],
            ['key' => 'adsense_horizontal_ad_client', 'value' => ''],
            ['key' => 'adsense_horizontal_ad_slot', 'value' => ''],
            

        ];
         
        foreach ($settings as $setting) {

            $check = Setting::where('key', $setting['key'])->first();

            if (!$check) {
                Setting::insert([
                    'key' => $setting['key'],
                    'value' => $setting['value'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $settingsc = Setting::all();
        foreach ($settingsc as $row) {
            ContentSetting::set($row->key, $row->value);
        }
        ContentSetting::save();
      
    }
}