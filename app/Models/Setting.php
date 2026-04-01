<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use anlutro\LaravelSettings\Facade as ContentSetting;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value'];


    public static function updateContent($data)
    {
      try{

        $obj = new self;
        unset($data['_token']);
        $page_name = (isset($data['page_name'])) ? $data['page_name'] : '';
        unset($data['page_name']);


        if ($page_name != '') {

            if ($page_name == 'payment_methods') {
                $payment_method = (isset($data['payment_method'])) ? $data['payment_method'] : '';

                if ($payment_method == 'razorpay') {
                    $razorpay_key = (isset($data['razorpay_key'])) ? $data['razorpay_key'] : '';
                    $razorpay_secret = (isset($data['razorpay_secret'])) ? $data['razorpay_secret'] : '';
                    $enable_razorpay = (isset($data['enable_razorpay'])) ? 1 : 0;

                    // Update Razorpay settings in Setting
                    Setting::updateOrCreate(['key' => 'razorpay_key'], ['value' => $razorpay_key]);
                    Setting::updateOrCreate(['key' => 'razorpay_secret'], ['value' => $razorpay_secret]);
                    Setting::updateOrCreate(['key' => 'enable_razorpay'], ['value' => $enable_razorpay]);
                } elseif ($payment_method == 'stripe') {
                    $stripe_key = (isset($data['stripe_key'])) ? $data['stripe_key'] : '';
                    $stripe_secret_key = (isset($data['stripe_secret_key'])) ? $data['stripe_secret_key'] : '';
                    $enable_stripe = (isset($data['enable_stripe'])) ? 1 : 0;

                    // Update Stripe settings in Setting
                    Setting::updateOrCreate(['key' => 'stripe_key'], ['value' => $stripe_key]);
                    Setting::updateOrCreate(['key' => 'stripe_secret_key'], ['value' => $stripe_secret_key]);
                    Setting::updateOrCreate(['key' => 'enable_stripe'], ['value' => $enable_stripe]);
                } elseif ($payment_method == 'paypal') {
                    $paypal_client_id = (isset($data['paypal_client_id'])) ? $data['paypal_client_id'] : '';
                    $paypal_secret_key = (isset($data['paypal_secret_key'])) ? $data['paypal_secret_key'] : '';
                    $enable_paypal = (isset($data['enable_paypal'])) ? 1 : 0;

                    // Update Paypal settings in Setting
                    Setting::updateOrCreate(['key' => 'paypal_client_id'], ['value' => $paypal_client_id]);
                    Setting::updateOrCreate(['key' => 'paypal_secret_key'], ['value' => $paypal_secret_key]);
                    Setting::updateOrCreate(['key' => 'enable_paypal'], ['value' => $enable_paypal]);
                } elseif ($payment_method == 'cod') {
                    $enable_cod = (isset($data['enable_cod'])) ? 1 : 0;

                    // Update COD settings in Setting
                    Setting::updateOrCreate(['key' => 'enable_cod'], ['value' => $enable_cod]);
                }
            }


            if ($page_name == 'company-setting') {

                if(isset($data['logo']) && $data['logo']!=''){
                    $uploadImage = \Helpers::uploadFiles($data['logo'],'setting/');
                    if($uploadImage['status']==true){
                        $data['logo'] = $uploadImage['file_name'];
                    }
                }

                if(isset($data['footer_logo']) && $data['footer_logo']!=''){
                    $uploadImage = \Helpers::uploadFiles($data['footer_logo'],'setting/');
                    if($uploadImage['status']==true){
                        $data['footer_logo'] = $uploadImage['file_name'];
                    }
                }


                if(isset($data['favicon']) && $data['favicon']!=''){
                    $uploadImage = \Helpers::uploadFiles($data['favicon'],'setting/');
                    if($uploadImage['status']==true){
                        $data['favicon'] = $uploadImage['file_name'];
                    }
                }

            }

            if($page_name=='google-login'){
                if (isset($data['enable_google_login'])) {
                    if($data['enable_google_login']=='on'){
                    $data['enable_google_login'] = 1;
                    }else{
                    $data['enable_google_login'] = $data['enable_google_login'];
                    }
                }else{
                    $data['enable_google_login'] = 0;
                } 

                $google_data = $obj::where('key', 'google_client_id')->first();
                $google_client_id = $google_data->value;
                
                // Check if the last 5 characters match
                if (substr($google_client_id, -5) == substr($data['google_client_id'], -5)) {
                    $data['google_client_id'] = $google_client_id;
                }
                
                
                $google_data = $obj::where('key', 'google_client_secret')->first();
                $google_client_secret = $google_data->value;
                
                // Check if the last 5 characters match
                if (substr($google_client_secret, -5) == substr($data['google_client_secret'], -5)) {
                    $data['google_client_secret'] = $google_client_secret;
                }   
            }

            // Here we are inserting data into the database
            foreach ($data as $key => $value) {
                $exist = $obj->where('key',$key)->first();
                if ($exist) {
                    $id = $obj->where('id',$exist->id)->update(array('value'=>$value));
                }else{
                    $obj->insert(array('key'=>$key,'value'=>$value));
                }
            }

            $settingsc = $obj->all();
            foreach ($settingsc as $row) {
                ContentSetting::set($row->key, $row->value);
            }
            ContentSetting::save();

            $envFilePath = base_path('.env');
            $replacementPairs = array();

            if(isset($data['google_client_id']) && $data['google_client_id']!=''){
                
                $google_data = $obj::where('key', 'google_client_id')->first();
                $google_client_id = $google_data->value;
                $replacementPairs['GOOGLE_CLIENT_ID'] =  $google_client_id;
            }
            if(isset($data['google_client_secret']) && $data['google_client_secret']!=''){
                $google_data = $obj::where('key', 'google_client_secret')->first();
                $google_client_secret = $google_data->value;
                $replacementPairs['GOOGLE_CLIENT_SECRET'] = $google_client_secret;
            }
            if(isset($data['google_redirect_url']) && $data['google_redirect_url']!=''){
                $replacementPairs['GOOGLE_REDIRECT_URL'] = $data['google_redirect_url'];
            }
            
            $envContents = file_get_contents($envFilePath);
            if(count($replacementPairs)>0){
                foreach ($replacementPairs as $key => $value) {
                    $search = "{$key}=";
                    $replacement = "{$key}={$value}";
                    $envContents = preg_replace("/^{$key}=.*/m", $replacement, $envContents);
                }
                
                file_put_contents($envFilePath, $envContents);
            }    


            return ['status' => true, 'message' => __('lang.admin_data_update_msg')];
        }

      }catch (\Exception $e)
      {
         return ['status' => false, 'message' => $e->getMessage() . ' '. $e->getLine() . ' '. $e->getFile()];
      }
   }
}
