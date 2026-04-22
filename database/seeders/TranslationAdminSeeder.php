<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Translation;
use App\Models\Language;

class TranslationAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        $dp_translations = array(

            array(
                'keyword' => 'menu_dashboard',
                'value' => 'Dashboard'
            ),
            array(
                'keyword' => 'ads_listing',
                'value' => 'Ads Listing'
            ),
            array(
                'keyword' => 'categories',
                'value' => 'Categories'
            ),
            array(
                'keyword' => 'item_management',
                'value' => 'Item Management'
            ),
            array(
                'keyword' => 'tips',
                'value' => 'Tips'
            ),
            array(
                'keyword' => 'package_management',
                'value' => 'Package Management'
            ),
            array(
                'keyword' => 'advertisement_package',
                'value' => 'Advertisement Package'
            ),
            array(
                'keyword' => 'item_listing_package',
                'value' => 'Item Listing Package'
            ),
            array(
                'keyword' => 'blogs_management',
                'value' => 'Blogs Management'
            ),
            array(
                'keyword' => 'blogs',
                'value' => 'Blogs'
            ),
            array(
                'keyword' => 'tags',
                'value' => 'Tags'
            ),
            array(
                'keyword' => 'staff_management',
                'value' => 'Staff Management'
            ),
            array(
                'keyword' => 'staff',
                'value' => 'Staff'
            ),
            array(
                'keyword' => 'site_management',
                'value' => 'Site Management'
            ),
            array(
                'keyword' => 'cms',
                'value' => 'Cms'
            ),
            array(
                'keyword' => 'faq',
                'value' => 'Faq'
            ),
            array(
                'keyword' => 'slider',
                'value' => 'Slider'
            ),
            array(
                'keyword' => 'place_location_management',
                'value' => 'Place/Location Management'
            ),
            array(
                'keyword' => 'place_location',
                'value' => 'Place/Location'
            ),
            array(
                'keyword' => 'country',
                'value' => 'Country'
            ),
            array(
                'keyword' => 'state',
                'value' => 'State'
            ),
            array(
                'keyword' => 'city',
                'value' => 'City'
            ),
            array(
                'keyword' => 'area',
                'value' => 'Area'
            ),
            array(
                'keyword' => 'language_management',
                'value' => 'Language Management'
            ),
            array(
                'keyword' => 'language',
                'value' => 'Language'
            ),
            array(
                'keyword' => 'setting_management',
                'value' => 'Setting Management'
            ),
            array(
                'keyword' => 'setting',
                'value' => 'Setting'
            ),
            array(
                'keyword' => 'all_setting',
                'value' => 'All Setting'
            ),
            array(
                'keyword' => 'customers',
                'value' => 'Customers'
            ),
            array(
                'keyword' => 'item',
                'value' => 'Item'
            ),
            array(
                'keyword' => 'statistics',
                'value' => 'Statistics'
            ),
            array(
                'keyword' => 'my_profile',
                'value' => 'My Profile'
            ),
            array(
                'keyword' => 'logout',
                'value' => 'Logout'
            ),
            array(
                'keyword' => 'upload_new_photo',
                'value' => 'Upload New Photo'
            ),
            array(
                'keyword' => 'name',
                'value' => 'Name'
            ),
            array(
                'keyword' => 'email',
                'value' => 'Email'
            ),
            array(
                'keyword' => 'phone_number',
                'value' => 'Phone Number'
            ),
            array(
                'keyword' => 'password',
                'value' => 'Password'
            ),
            array(
                'keyword' => 'save',
                'value' => 'Save'
            ),
            array(
                'keyword' => 'category_list',
                'value' => 'Category List'
            ),
            array(
                'keyword' => 'page',
                'value' => 'Page'
            ),
            array(
                'keyword' => 'select_status',
                'value' => 'Select Status'
            ),
            array(
                'keyword' => 'reset',
                'value' => 'Reset'
            ),
            array(
                'keyword' => 'search',
                'value' => 'Search'
            ),
            array(
                'keyword' => 'add_category',
                'value' => 'Add Category'
            ),
            array(
                'keyword' => 'category',
                'value' => 'Category'
            ),
            array(
                'keyword' => 'subcategory',
                'value' => 'Subcategory'
            ),
            array(
                'keyword' => 'created_at',
                'value' => 'Created At'
            ),
            array(
                'keyword' => 'status',
                'value' => 'Status'
            ),
            array(
                'keyword' => 'actions',
                'value' => 'Actions'
            ),
            array(
                'keyword' => 'view',
                'value' => 'View'
            ),
            array(
                'keyword' => 'edit',
                'value' => 'Edit'
            ),
            array(
                'keyword' => 'delete',
                'value' => 'Delete'
            ),
            array(
                'keyword' => 'add_subcategory',
                'value' => 'Add Subcategory'
            ),
            array(
                'keyword' => 'translation',
                'value' => 'Translation'
            ),
            array(
                'keyword' => 'active',
                'value' => 'Active'
            ),
            array(
                'keyword' => 'deactive',
                'value' => 'Deactive'
            ),
            array(
                'keyword' => 'subcategory_list',
                'value' => 'Subcategory List'
            ),
            array(
                'keyword' => 'add',
                'value' => 'Add'
            ),
            array(
                'keyword' => 'category_name',
                'value' => 'Category Name'
            ),
            array(
                'keyword' => 'slug',
                'value' => 'Slug'
            ),
            array(
                'keyword' => 'description',
                'value' => 'Description'
            ),
            array(
                'keyword' => 'image',
                'value' => 'Image'
            ),
            array(
                'keyword' => 'image_preview',
                'value' => 'Image Preview'
            ),
            array(
                'keyword' => 'submit',
                'value' => 'Submit'
            ),
            array(
                'keyword' => 'back',
                'value' => 'Back'
            ),
            array(
                'keyword' => 'showing',
                'value' => 'Showing'
            ),
            array(
                'keyword' => 'tips_list',
                'value' => 'Tips List'
            ),
            array(
                'keyword' => 'add_tip',
                'value' => 'Add Tip'
            ),
            array(
                'keyword' => 'no_record_found',
                'value' => 'No Record Found'
            ),
            array(
                'keyword' => 'add_package',
                'value' => 'Add Package'
            ),
            array(
                'keyword' => 'price',
                'value' => 'Price'
            ),
            array(
                'keyword' => 'discount',
                'value' => 'Discount'
            ),
            array(
                'keyword' => 'final_price',
                'value' => 'Final Price'
            ),
            array(
                'keyword' => 'days',
                'value' => 'Days'
            ),
            array(
                'keyword' => 'limited',
                'value' => 'Limited'
            ),
            array(
                'keyword' => 'unlimited',
                'value' => 'Unlimited'
            ),
            array(
                'keyword' => 'no_days',
                'value' => 'No. Days'
            ),
            array(
                'keyword' => 'no_item',
                'value' => 'No. Item'
            ),
            array(
                'keyword' => 'add_blog',
                'value' => 'Add Blog'
            ),
            array(
                'keyword' => 'title',
                'value' => 'Title'
            ),
            array(
                'keyword' => 'tag',
                'value' => 'Tag'
            ),
            array(
                'keyword' => 'tag_list',
                'value' => 'Tag List'
            ),
            array(
                'keyword' => 'add_tag',
                'value' => 'Add Tag'
            ),
            array(
                'keyword' => 'staff_list',
                'value' => 'Staff List'
            ),
            array(
                'keyword' => 'add_staff',
                'value' => 'Add Staff'
            ),
            array(
                'keyword' => 'phone',
                'value' => 'Phone'
            ),
            array(
                'keyword' => 'update',
                'value' => 'Update'
            ),
            array(
                'keyword' => 'confirm_password',
                'value' => 'Confirm Password'
            ),
            array(
                'keyword' => 'cms_list',
                'value' => 'Cms List'
            ),
            array(
                'keyword' => 'add_cms',
                'value' => 'Add Cms'
            ),
            array(
                'keyword' => 'page_name',
                'value' => 'Page Name'
            ),
            array(
                'keyword' => 'faq_list',
                'value' => 'Faq List'
            ),
            array(
                'keyword' => 'question',
                'value' => 'Question'
            ),
            array(
                'keyword' => 'add_faq',
                'value' => 'Add Faq'
            ),
            array(
                'keyword' => 'answer',
                'value' => 'Answer'
            ),
            array(
                'keyword' => 'country_list',
                'value' => 'Country List'
            ),
            array(
                'keyword' => 'add_country',
                'value' => 'Add Country'
            ),
            array(
                'keyword' => 'upload',
                'value' => 'Upload'
            ),
            array(
                'keyword' => 'cancel',
                'value' => 'Cancel'
            ),
            array(
                'keyword' => 'bulk_upload_country',
                'value' => 'Bulk Upload Countries'
            ),
            array(
                'keyword' => 'state_list',
                'value' => 'State List'
            ),
            array(
                'keyword' => 'add_state',
                'value' => 'Add State'
            ),
            array(
                'keyword' => 'bulk_upload_states',
                'value' => 'Bulk Upload States'
            ),
            array(
                'keyword' => 'select_country',
                'value' => 'Select Country'
            ),
            array(
                'keyword' => 'city_list',
                'value' => 'City List'
            ),
            array(
                'keyword' => 'add_city',
                'value' => 'Add City'
            ),
            array(
                'keyword' => 'bulk_upload_city',
                'value' => 'Bulk Upload City'
            ),
            array(
                'keyword' => 'area_list',
                'value' => 'Area List'
            ),
            array(
                'keyword' => 'add_area',
                'value' => 'Add Area'
            ),
            array(
                'keyword' => 'select_state',
                'value' => 'Select State'
            ),
            array(
                'keyword' => 'bulk_upload_area',
                'value' => 'Bulk Upload Area'
            ),
            array(
                'keyword' => 'select_city',
                'value' => 'Select City'
            ),
            array(
                'keyword' => 'languages_list',
                'value' => 'Languages List'
            ),
            array(
                'keyword' => 'add_languages',
                'value' => 'Add Languages'
            ),
            array(
                'keyword' => 'language_code',
                'value' => 'Language Code'
            ),
            array(
                'keyword' => 'position',
                'value' => 'Position'
            ),
            array(
                'keyword' => 'default',
                'value' => 'Default'
            ),
            array(
                'keyword' => 'code',
                'value' => 'Code'
            ),
            array(
                'keyword' => 'yes',
                'value' => 'Yes'
            ),
            array(
                'keyword' => 'no',
                'value' => 'No'
            ),
            array(
                'keyword' => 'please_select',
                'value' => 'Please Select'
            ),
            array(
                'keyword' => 'translation_list',
                'value' => 'Translation List'
            ),
            array(
                'keyword' => 'value',
                'value' => 'Value'
            ),
            array(
                'keyword' => 'select_group',
                'value' => 'Select Group'
            ),
            array(
                'keyword' => 'add_translation',
                'value' => 'Add Translation'
            ),
            array(
                'keyword' => 'group_name',
                'value' => 'Group Name'
            ),
            array(
                'keyword' => 'group',
                'value' => 'Group'
            ),
            array(
                'keyword' => 'keyword',
                'value' => 'Keyword'
            ),
            array(
                'keyword' => 'general_settings',
                'value' => 'General Settings'
            ),
            array(
                'keyword' => 'company_setting',
                'value' => 'Company Setting'
            ),
            array(
                'keyword' => 'logo',
                'value' => 'Logo'
            ),
            array(
                'keyword' => 'favicon',
                'value' => 'Favicon'
            ),
            array(
                'keyword' => 'currency',
                'value' => 'Currency'
            ),
            array(
                'keyword' => 'admin_login',
                'value' => 'Admin Login'
            ),
            array(
                'keyword' => 'login',
                'value' => 'Login'
            ),
            array(
                'keyword' => 'forgot_password',
                'value' => 'Forgot Password?'
            ),
            array(
                'keyword' => 'forgot_password_text',
                'value' => 'Enter your email and we will send you instructions to reset your password'
            ),
            array(
                'keyword' => 'back_to_login',
                'value' => 'Back to Login'
            ),
            array(
                'keyword' => 'reset_password',
                'value' => 'Reset Password'
            ),
            array(
                'keyword' => 'reset_password_text',
                'value' => 'Your new password must be different from previously used passwords'
            ),
            array(
                'keyword' => 'otp',
                'value' => 'OTP'
            ),
            array(
                'keyword' => 'new_password',
                'value' => 'New Password'
            ),
            array(
                'keyword' => 'enter_otp',
                'value' => 'Enter OTP'
            ),
            array(
                'keyword' => 'set_new_password',
                'value' => 'Set New Password'
            ),
            array(
                'keyword' => 'data_change_msg',
                'value' => 'Status changed successfully'
            ),
            array(
                'keyword' => 'data_update_msg',
                'value' => 'Data updated successfully'
            ),
            array(
                'keyword' => 'data_add_msg',
                'value' => 'Data added successfully'
            ),
            array(
                'keyword' => 'data_delete_msg',
                'value' => 'Data deleted successfully'
            ),
            array(
                'keyword' => 'promotional_management',
                'value' => 'Promotional Management'
            ),
            array(
                'keyword' => 'send_notification',
                'value' => 'Send Notification'
            ),
            array(
                'keyword' => 'notification_list',
                'value' => 'Notification List'
            ),
            array(
                'keyword' => 'add_notification',
                'value' => 'Add Notification'
            ),
            array(
                'keyword' => 'select_user',
                'value' => 'Select User'
            ),
            array(
                'keyword' => 'select_item',
                'value' => 'Select Item'
            ),
            array(
                'keyword' => 'message',
                'value' => 'Message'
            ),
            array(
                'keyword' => 'mailer',
                'value' => 'Mailer'
            ),
            array(
                'keyword' => 'mailer_placeholder',
                'value' => 'Enter Mailer'
            ),
            array(
                'keyword' => 'host',
                'value' => 'Host'
            ),
            array(
                'keyword' => 'host_placeholder',
                'value' => 'Enter host'
            ),
            array(
                'keyword' => 'port',
                'value' => 'Port'
            ),
            array(
                'keyword' => 'port_placeholder',
                'value' => 'Enter port'
            ),
            array(
                'keyword' => 'username',
                'value' => 'Username'
            ),
            array(
                'keyword' => 'username_placeholder',
                'value' => 'Enter username'
            ),
            array(
                'keyword' => 'encryption',
                'value' => 'Encrytion'
            ),
            array(
                'keyword' => 'encryption_placeholder',
                'value' => 'Enter encryption'
            ),
            array(
                'keyword' => 'from_name',
                'value' => 'From Name'
            ),
            array(
                'keyword' => 'from_name_placeholder',
                'value' => 'Enter from name'
            ),
            array(
                'keyword' => 'from_email_address',
                'value' => 'From Email Address'
            ),
            array(
                'keyword' => 'from_email_address_placeholder',
                'value' => 'Enter From Email Address'
            ),
            array(
                'keyword' => 'maintainance_mode',
                'value' => 'Maintainance'
            ),
            array(
                'keyword' => 'enable_maintainance_mode_placeholder',
                'value' => 'Enable maintainance mode'
            ),
            array(
                'keyword' => 'maintainance_title',
                'value' => 'Maintainance Title'
            ),
            array(
                'keyword' => 'maintainance_title_placeholder',
                'value' => 'Enter Maintainance Title'
            ),
            array(
                'keyword' => 'maintainance_short_text',
                'value' => 'Maintainance Short Text'
            ),
            array(
                'keyword' => 'maintainance_short_text_placeholder',
                'value' => 'Enter Maintainance Short Text'
            ),
            array(
                'keyword' => 'slider_list',
                'value' => 'Slider list'
            ),
            array(
                'keyword' => 'add_slider',
                'value' => 'Add Slider'
            ),
            array(
                'keyword' => 'type',
                'value' => 'Type'
            ),
            array(
                'keyword' => 'external_link',
                'value' => 'External link'
            ),
            array(
                'keyword' => 'seo_setting',
                'value' => 'Seo Setting'
            ),
            array(
                'keyword' => 'seo_list',
                'value' => 'Seo List'
            ),
            array(
                'keyword' => 'add_seo',
                'value' => 'Add Seo'
            ),
            array(
                'keyword' => 'social_media',
                'value' => 'Social Media'
            ),
            array(
                'keyword' => 'instagram',
                'value' => 'Instagram'
            ),
            array(
                'keyword' => 'facebook',
                'value' => 'Facebook'
            ),
            array(
                'keyword' => 'linkedin',
                'value' => 'Linkedin'
            ),
            array(
                'keyword' => 'x_social_media',
                'value' => 'X Social Media'
            ),
            array(
                'keyword' => 'contact_number1',
                'value' => 'Contact Number 1'
            ),
            array(
                'keyword' => 'contact_number2',
                'value' => 'Contact Number 2'
            ),
            array(
                'keyword' => 'address',
                'value' => 'Address'
            ),
            array(
                'keyword' => 'staff_login',
                'value' => 'Staff login'
            ),
            array(
                'keyword' => 'subcategory_name',
                'value' => 'Subcategory Name'
            ),
            array(
                'keyword' => 'item_limit',
                'value' => 'Item Limit'
            ),
            array(
                'keyword' => 'download_dummy_excel',
                'value' => 'Download Dummy Excel'
            ),
            array(
                'keyword' => 'rolelist',
                'value' => 'Role List'
            ),
            array(
                'keyword' => 'roles',
                'value' => 'Role'
            ),
            array(
                'keyword' => 'id',
                'value' => 'Id'
            ),
            array(
                'keyword' => 'role_name',
                'value' => 'Role Name'
            ),
            array(
                'keyword' => 'create_role',
                'value' => 'Add Role'
            ),
            array(
                'keyword' => 'set_role_permission',
                'value' => 'Set Role Permissions'
            ),
            array(
                'keyword' => 'all_list',
                'value' => 'All List'
            ),
            array(
                'keyword' => 'all_delete',
                'value' => 'All Delete'
            ),
            array(
                'keyword' => 'all_add',
                'value' => 'All Add'
            ),
            array(
                'keyword' => 'all_update',
                'value' => 'All Update'
            ),
            array(
                'keyword' => 'role_name_placeholder',
                'value' => 'Enter role name'
            ),
            array(
                'keyword' => 'role_permissions',
                'value' => 'Role Permissions'
            ),
            array(
                'keyword' => 'add_role',
                'value' => 'Add Role'
            ),
            array(
                'keyword' => 'all_status_change',
                'value' => 'All Status Change'
            ),
            array(
                'keyword' => 'all_module',
                'value' => 'Module'
            ),
            array(
                'keyword' => 'all_permissions',
                'value' => 'Permissions'
            ),
            array(
                'keyword' => 'queries',
                'value' => 'User Queries'
            ),
            array(
                'keyword' => 'userqueries',
                'value' => 'User Queries'
            ),
            array(
                'keyword' => 'subject',
                'value' => 'Subject'
            ),
            array(
                'keyword' => 'sellermanagement',
                'value' => 'Seller Management'
            ),
            array(
                'keyword' => 'sellerverification',
                'value' => 'Seller Verification'
            ),
            array(
                'keyword' => 'idprooffront',
                'value' => 'Id Proof Front'
            ),
            array(
                'keyword' => 'reports_management',
                'value' => 'Report Management'
            ),
            array(
                'keyword' => 'reportreasons',
                'value' => 'Report Reasons'
            ),
            array(
                'keyword' => 'addreportreasons',
                'value' => 'Add Report Reasons'
            ),
            array(
                'keyword' => 'reason',
                'value' => 'Reason'
            ),
            array(
                'keyword' => 'customersmanagement',
                'value' => 'Customers Management'
            ),
            array(
                'keyword' => 'assignpackage',
                'value' => 'Assign Package'
            ),
            array(
                'keyword' => 'viewpackages',
                'value' => 'View Packages'
            ),
            array(
                'keyword' => 'userpackages',
                'value' => 'User Packages'
            ),
            array(
                'keyword' => 'recentitem',
                'value' => 'Recent Item'
            ),
            array(
                'keyword' => 'userreport',
                'value' => 'User Report'
            ),
            array(
                'keyword' => 'reviews',
                'value' => 'Seller Reviews'
            ),
            array(
                'keyword' => 'buyer',
                'value' => 'Buyer'
            ),
            array(
                'keyword' => 'seller',
                'value' => 'Seller'
            ),
            array(
                'keyword' => 'rating',
                'value' => 'Rating'
            ),
            array(
                'keyword' => 'review',
                'value' => 'Review'
            ),
            array(
                'keyword' => 'packagename',
                'value' => 'Package Name'
            ),
            array(
                'keyword' => 'startdate',
                'value' => 'Start Date'
            ),
            array(
                'keyword' => 'enddate',
                'value' => 'End Date'
            ),
            array(
                'keyword' => 'totallimit',
                'value' => 'Total Limit'
            ),
            array(
                'keyword' => 'usedlimit',
                'value' => 'Used Limit'
            ),
            array(
                'keyword' => 'paymenttransactions',
                'value' => 'Payment Transactions'
            ),
            array(
                'keyword' => 'username',
                'value' => 'User Name'
            ),
            array(
                'keyword' => 'amount',
                'value' => 'Amount'
            ),
            array(
                'keyword' => 'paymentgateway',
                'value' => 'Payment Gateway'
            ),
            array(
                'keyword' => 'paymentstatus',
                'value' => 'Payment Status'
            ),

            array(
                'keyword' => 'view_all_notifications',
                'value' => 'View All Notifications'
            ),
            array(
                'keyword' => 'my_profile',
                'value' => 'My Profile'
            ),
            array(
                'keyword' => 'logout',
                'value' => 'Logout'
            ),
            array(
                'keyword' => 'light',
                'value' => 'Light'
            ),
            array(
                'keyword' => 'dark',
                'value' => 'Dark'
            ),
            array(
                'keyword' => 'system',
                'value' => 'System'
            ),
            array(
                'keyword' => 'notification',
                'value' => 'Notification'
            ),
            array(
                'keyword' => 'new',
                'value' => 'New'
            ),
            array(
                'keyword' => 'mark_as_read',
                'value' => 'Mark As Read'
            ),
            array(
                'keyword' => 'footer_content',
                'value' => 'Footer Content'
            ),
            array(
                'keyword' => 'footer_company_name',
                'value' => 'Footer Company Name'
            ),
            array(
                'keyword' => 'item_list',
                'value' => 'Item List'
            ),
            array(
                'keyword' => 'subcategory_list',
                'value' => 'Subcategory List'
            ),
            array(
                'keyword' => 'custom_fields',
                'value' => 'Custom Fields'
            ),
            array(
                'keyword' => 'add_fields',
                'value' => 'Add Fields'
            ),
            array(
                'keyword' => 'image_required',
                'value' => 'Image Required'
            ),
            array(
                'keyword' => 'image_required_msg',
                'value' => 'Image Required Msg'
            ),
            array(
                'keyword' => 'field_name',
                'value' => 'Field Name'
            ),
            array(
                'keyword' => 'field_type',
                'value' => 'Field Type'
            ),
            array(
                'keyword' => 'text_input',
                'value' => 'Text Input'
            ),
            array(
                'keyword' => 'number_input',
                'value' => 'Number Input'
            ),
            array(
                'keyword' => 'dropdown',
                'value' => 'Dropdown'
            ),
            array(
                'keyword' => 'checkbox',
                'value' => 'Checkbox'
            ),
            array(
                'keyword' => 'min',
                'value' => 'Min'
            ),
            array(
                'keyword' => 'max',
                'value' => 'Max'
            ),
            array(
                'keyword' => 'remove',
                'value' => 'Remove'
            ),
            array(
                'keyword' => 'field_values',
                'value' => 'Field Values'
            ),
            array(
                'keyword' => 'type_value_press_enter',
                'value' => 'Type Value Press Enter'
            ),
            array(
                'keyword' => 'required',
                'value' => 'Required'
            ),
            array(
                'keyword' => 'active',
                'value' => 'Active'
            ),
            array(
                'keyword' => 'verification_details',
                'value' => 'Verification Details'
            ),
            array(
                'keyword' => 'export',
                'value' => 'Export'
            ),
            array(
                'keyword' => 'export_to_excel',
                'value' => 'Export To Excel'
            ),
            array(
                'keyword' => 'export_to_pdf',
                'value' => 'Export To Pdf'
            ),
            array(
                'keyword' => 'front',
                'value' => 'Front'
            ),
            array(
                'keyword' => 'back',
                'value' => 'Back'
            ),
            array(
                'keyword' => 'ads_packages_list',
                'value' => 'Ads Packages List'
            ),
            array(
                'keyword' => 'ads_packages',
                'value' => 'Ads Packages'
            ),
            array(
                'keyword' => 'name',
                'value' => 'Name'
            ),
            array(
                'keyword' => 'price',
                'value' => 'Price'
            ),
            array(
                'keyword' => 'discount',
                'value' => 'Discount'
            ),
            array(
                'keyword' => 'final_price',
                'value' => 'Final Price'
            ),
            array(
                'keyword' => 'days_type',
                'value' => 'Days Type'
            ),
            array(
                'keyword' => 'no_of_days',
                'value' => 'No Of Days'
            ),
            array(
                'keyword' => 'item_type',
                'value' => 'Item Type'
            ),
            array(
                'keyword' => 'no_of_item',
                'value' => 'No Of Item'
            ),
            array(
                'keyword' => 'status',
                'value' => 'Status'
            ),
            array(
                'keyword' => 'created_at',
                'value' => 'Created At'
            ),
            array(
                'keyword' => 'active',
                'value' => 'Active'
            ),
            array(
                'keyword' => 'deactive',
                'value' => 'Deactive'
            ),
            array(
                'keyword' => 'item_packages_list',
                'value' => 'Item Packages List'
            ),
            array(
                'keyword' => 'item_packages',
                'value' => 'Item Packages'
            ),
            array(
                'keyword' => 'all',
                'value' => 'All'
            ),
            array(
                'keyword' => 'item',
                'value' => 'Item'
            ),
            array(
                'keyword' => 'ads',
                'value' => 'Ads'
            ),
            array(
                'keyword' => 'user_packages',
                'value' => 'User Packages'
            ),
            array(
                'keyword' => 'user_name',
                'value' => 'User Name'
            ),
            array(
                'keyword' => 'user_email',
                'value' => 'User Email'
            ),
            array(
                'keyword' => 'package',
                'value' => 'Package'
            ),
            array(
                'keyword' => 'start_date',
                'value' => 'Start Date'
            ),
            array(
                'keyword' => 'end_date',
                'value' => 'End Date'
            ),
            array(
                'keyword' => 'total_limit',
                'value' => 'Total Limit'
            ),
            array(
                'keyword' => 'used_limit',
                'value' => 'Used Limit'
            ),
            array(
                'keyword' => 'status',
                'value' => 'Status'
            ),
            array(
                'keyword' => 'created_at',
                'value' => 'Created At'
            ),
            array(
                'keyword' => 'active',
                'value' => 'Active'
            ),
            array(
                'keyword' => 'expired',
                'value' => 'Expired'
            ),
            array(
                'keyword' => 'deactive',
                'value' => 'Deactive'
            ),
            array(
                'keyword' => 'unlimited',
                'value' => 'Unlimited'
            ),
            array(
                'keyword' => 'all_gateways',
                'value' => 'All Gateways'
            ),
            array(
                'keyword' => 'paid',
                'value' => 'Paid'
            ),
            array(
                'keyword' => 'failed',
                'value' => 'Failed'
            ),
            array(
                'keyword' => 'pending',
                'value' => 'Pending'
            ),
            array(
                'keyword' => 'reason',
                'value' => 'Reason'
            ),
            array(
                'keyword' => 'reported_at',
                'value' => 'Reported At'
            ),
            array(
                'keyword' => 'select_all',
                'value' => 'Select All'
            ),
            array(
                'keyword' => 'deselect_all',
                'value' => 'Deselect All'
            ),
            array(
                'keyword' => 'resolution',
                'value' => 'Resolution'
            ),
            array(
                'keyword' => 'upload',
                'value' => 'Upload'
            ),
            array(
                'keyword' => 'payment_method',
                'value' => 'Payment Method'
            ),
            array(
                'keyword' => 'razorpay_key',
                'value' => 'Razorpay Key'
            ),
            array(
                'keyword' => 'razorpay_secret',
                'value' => 'Razorpay Secret'
            ),
            array(
                'keyword' => 'enter_razorpay_key',
                'value' => 'Enter Razorpay Key'
            ),
            array(
                'keyword' => 'enter_razorpay_secret',
                'value' => 'Enter Razorpay Secret'
            ),
            array(
                'keyword' => 'stripe_key',
                'value' => 'Stripe Key'
            ),
            array(
                'keyword' => 'stripe_secret_key',
                'value' => 'Stripe Secret Key'
            ),
            array(
                'keyword' => 'enter_stripe_key',
                'value' => 'Enter Stripe Key'
            ),
            array(
                'keyword' => 'enter_stripe_secret_key',
                'value' => 'Enter Stripe Secret Key'
            ),
            array(
                'keyword' => 'paypal_client_id',
                'value' => 'Paypal Client Id'
            ),
            array(
                'keyword' => 'paypal_secret_key',
                'value' => 'Paypal Secret Key'
            ),
            array(
                'keyword' => 'enter_paypal_client_id',
                'value' => 'Enter Paypal Client Id'
            ),
            array(
                'keyword' => 'enter_paypal_secret_key',
                'value' => 'Enter Paypal Secret Key'
            ),
            array(
                'keyword' => 'translation_updated',
                'value' => 'Translation Updated Successfully.'
            ),
            array(
                'keyword' => 'logged_out',
                'value' => 'You Have Been Logged Out.'
            ),
            array(
                'keyword' => 'invalid_data_provided',
                'value' => 'Invalid Data Provided.'
            ),
            array(
                'keyword' => 'package_not_found',
                'value' => 'Package Not Found.'
            ),
            array(
                'keyword' => 'package_assigned_successfully',
                'value' => 'Package Assigned Successfully.'
            ),
            array(
                'keyword' => 'item_package_not_found',
                'value' => 'Item Package Not Found.'
            ),
            array(
                'keyword' => 'item_package_assigned_successfully',
                'value' => 'Item Package Assigned Successfully.'
            ),
            array(
                'keyword' => 'featured_status_updated',
                'value' => 'Featured Status Updated'
            ),
            array(
                'keyword' => 'category_order_updated',
                'value' => 'Category Order Updated Successfully'
            ),
            array(
                'keyword' => 'error_prefix',
                'value' => 'Error: '
            ),
            array(
                'keyword' => 'admin',
                'value' => 'Admin'
            ),
            array(
                'keyword' => 'banner',
                'value' => 'Banner'
            ),
            array(
                'keyword' => 'website_management',
                'value' => 'Website Management'
            ),
            array(
                'keyword' => 'contact_us',
                'value' => 'Contact Us'
            ),
            array(
                'keyword' => 'role_permission',
                'value' => 'Roles & Permissions'
            ),
            array(
                'keyword' => 'admin_menu_dashboard',
                'value' => 'Dashboard'
            ),

            array(
                'keyword' => 'are_you_sure',
                'value' => 'Are you sure?'
            ),
            array(
                'keyword' => 'you_wont_be_able_to_revert_this',
                'value' => 'You will not be able to revert this!'
            ),
            array(
                'keyword' => 'yes_delete_it',
                'value' => 'Yes, delete it!'
            ),


            array(
                'keyword' => 'bulk_delete',
                'value' => 'Bulk Delete'
            ),
            array(
                'keyword' => 'admin_maintainance_mode',
                'value' => 'Maintenance Mode'
            ),
            array(
                'keyword' => 'admin_google_login',
                'value' => 'Google Login'
            ),
            array(
                'keyword' => 'admin_footer_logo',
                'value' => 'Footer Logo'
            ),
            array(
                'keyword' => 'admin_enable_maintainance_mode_placeholder',
                'value' => 'Enable maintenance mode'
            ),
            array(
                'keyword' => 'admin_maintainance_title',
                'value' => 'Maintenance Title'
            ),
            array(
                'keyword' => 'admin_maintainance_title_placeholder',
                'value' => 'Enter maintenance title'
            ),
            array(
                'keyword' => 'admin_maintainance_short_text',
                'value' => 'Maintenance Short Text'
            ),
            array(
                'keyword' => 'admin_maintainance_short_text_placeholder',
                'value' => 'Enter maintenance short text'
            ),
            array(
                'keyword' => 'admin_enable_google_login_placeholder',
                'value' => 'Enable Google login'
            ),
            array(
                'keyword' => 'admin_google_client_id',
                'value' => 'Google Client ID'
            ),
            array(
                'keyword' => 'admin_google_client_id_placeholder',
                'value' => 'Enter Google client ID'
            ),
            array(
                'keyword' => 'admin_google_client_secret',
                'value' => 'Google Client Secret'
            ),
            array(
                'keyword' => 'admin_google_client_secret_placeholder',
                'value' => 'Enter Google client secret'
            ),
            array(
                'keyword' => 'admin_google_redirect_url',
                'value' => 'Google Redirect URL'
            ),
            array(
                'keyword' => 'admin_google_redirect_url_placeholder',
                'value' => 'Enter Google redirect URL'
            ),
            array(
                'keyword' => 'admin_button_save_changes',
                'value' => 'Save Changes'
            ),
            array(
                'keyword' => 'admin_button_back',
                'value' => 'Back'
            ),

            array(
                'keyword' => 'admin_mailer',
                'value' => 'Mailer'
            ),
            array(
                'keyword' => 'admin_mailer_placeholder',
                'value' => 'Enter mailer'
            ),
            array(
                'keyword' => 'admin_host',
                'value' => 'Host'
            ),
            array(
                'keyword' => 'admin_host_placeholder',
                'value' => 'Enter host'
            ),
            array(
                'keyword' => 'admin_port',
                'value' => 'Port'
            ),
            array(
                'keyword' => 'admin_port_placeholder',
                'value' => 'Enter port'
            ),
            array(
                'keyword' => 'admin_username',
                'value' => 'Username'
            ),
            array(
                'keyword' => 'admin_username_placeholder',
                'value' => 'Enter username'
            ),
            array(
                'keyword' => 'admin_password',
                'value' => 'Password'
            ),
            array(
                'keyword' => 'admin_password_placeholder',
                'value' => 'Enter password'
            ),
            array(
                'keyword' => 'admin_encryption',
                'value' => 'Encryption'
            ),
            array(
                'keyword' => 'admin_encryption_placeholder',
                'value' => 'Enter encryption type'
            ),
            array(
                'keyword' => 'admin_from_name',
                'value' => 'From Name'
            ),
            array(
                'keyword' => 'admin_from_name_placeholder',
                'value' => 'Enter from name'
            ),
            array(
                'keyword' => 'admin_from_email_address',
                'value' => 'From Email Address'
            ),
            array(
                'keyword' => 'admin_from_email_address_placeholder',
                'value' => 'Enter from email address'
            ),
            array(
                'keyword' => 'select_package_msg',
                'value' => 'Please select a package'
            ),

            array(
                'keyword' => 'link',
                'value' => 'Link'
            ),
            array(
                'keyword' => 'admin_id',
                'value' => 'ID'
            ),
            array(
                'keyword' => 'admin_role_name',
                'value' => 'Role Name'
            ),
            array(
                'keyword' => 'admin_create_role',
                'value' => 'Create Role'
            ),
            array(
                'keyword' => 'admin_add_role',
                'value' => 'Add Role'
            ),
            array(
                'keyword' => 'admin_set_role_permission',
                'value' => 'Set Role Permission'
            ),
            array(
                'keyword' => 'admin_role_name',
                'value' => 'Role Name'
            ),
            array(
                'keyword' => 'admin_role_name_placeholder',
                'value' => 'Enter role name'
            ),
            array(
                'keyword' => 'admin_role_permissions',
                'value' => 'Role Permissions'
            ),
            array(
                'keyword' => 'admin_all_list',
                'value' => 'All List'
            ),
            array(
                'keyword' => 'admin_all_add',
                'value' => 'All Add'
            ),
            array(
                'keyword' => 'admin_all_update',
                'value' => 'All Update'
            ),
            array(
                'keyword' => 'admin_all_status_change',
                'value' => 'All Status Change'
            ),
            array(
                'keyword' => 'admin_all_delete',
                'value' => 'All Delete'
            ),
            array(
                'keyword' => 'admin_all_module',
                'value' => 'All Module'
            ),
            array(
                'keyword' => 'admin_all_permissions',
                'value' => 'All Permissions'
            ),
            array(
                'keyword' => 'ad_id',
                'value' => 'Ad ID'
            ),
            array(
                'keyword' => 'created_date',
                'value' => 'Created Date'
            ),
            array(
                'keyword' => 'reported_no',
                'value' => 'Reported No.'
            ),
            array(
                'keyword' => 'view_detail',
                'value' => 'View Detail'
            ),
            array(
                'keyword' => 'admin_dashboard',
                'value' => 'Dashboard'
            ),
            array(
                'keyword' => 'admin_list',
                'value' => 'List'
            ),
            array(
                'keyword' => 'admin_back',
                'value' => 'Back'
            ),
            array(
                'keyword' => 'purchase_date',
                'value' => 'Purchase Date'
            ),
            array(
                'keyword' => 'approved',
                'value' => 'Approved'
            ),
            array(
                'keyword' => 'admin_data_change_msg',
                'value' => 'Data has been changed successfully'
            ),
            array(
                'keyword' => 'id_proff',
                'value' => 'ID Proof'
            ),
            array(
                'keyword' => 'admin_name',
                'value' => 'Name'
            ),
            array(
                'keyword' => 'admin_email',
                'value' => 'Email'
            ),
            array(
                'keyword' => 'admin_subject',
                'value' => 'Subject'
            ),
            array(
                'keyword' => 'admin_message',
                'value' => 'Message'
            ),
            array(
                'keyword' => 'admin_action',
                'value' => 'Action'
            ),
            array(
                'keyword' => 'admin_reply',
                'value' => 'Reply'
            ),
            array(
                'keyword' => 'contact_us_list',
                'value' => 'Contact Us List'
            ),
            array(
                'keyword' => 'admin_reply_placeholder',
                'value' => 'Enter reply'
            ),
            array(
                'keyword' => 'admin_button_send',
                'value' => 'Send'
            ),
            array(
                'keyword' => 'admin_button_cancel',
                'value' => 'Cancel'
            ),

            array(
                'keyword' => 'admin_translation_updated',
                'value' => 'Data updated successfully'
            ),
            array(
                'keyword' => 'admin_category_order_updated',
                'value' => 'Category order updated successfully'
            ),
            array(
                'keyword' => 'admin_featured_status_updated',
                'value' => 'Featured status updated successfully'
            ),
            array(
                'keyword' => 'admin_invalid_data_provided',
                'value' => 'Invalid data provided'
            ),
            array(
                'keyword' => 'admin_package_not_found',
                'value' => 'Package not found'
            ),
            array(
                'keyword' => 'admin_package_assigned_successfully',
                'value' => 'Package assigned successfully'
            ),
            array(
                'keyword' => 'admin_item_package_not_found',
                'value' => 'Item package not found'
            ),
            array(
                'keyword' => 'admin_item_package_assigned_successfully',
                'value' => 'Item package assigned successfully'
            ),
            array(
                'keyword' => 'admin_logged_out',
                'value' => 'Logged out successfully'
            ),
            array(
                'keyword' => 'record_deleted_successfully',
                'value' => 'Record deleted successfully'
            ),
            array(
                'keyword' => 'something_went_wrong',
                'value' => 'Something went wrong'
            ),
            array(
                'keyword' => 'admin_error_prefix',
                'value' => 'Error:'
            ),
            array(
                'keyword' => 'admin_access_denied',
                'value' => 'Access denied. Only admins can log in.'
            ),
            array(
                'keyword' => 'admin_invalid_crendetails',
                'value' => 'The provided credentials do not match our records.'
            ),
            array(
                'keyword' => 'admin_password_reset_success',
                'value' => 'Password reset successfully'
            ),
            array(
                'keyword' => 'admin_data_add_msg',
                'value' => 'Data added successfully'
            ),
            array(
                'keyword' => 'admin_data_update_msg',
                'value' => 'Data updated successfully'
            ),
            array(
                'keyword' => 'admin_data_delete_msg',
                'value' => 'Data deleted successfully'
            ),
            array(
                'keyword' => 'admin_data_change_msg',
                'value' => 'Data changed successfully'
            ),
            array(
                'keyword' => 'admin_data_error_msg',
                'value' => 'An error occurred while processing data'
            ),
            array(
                'keyword' => 'featured',
                'value' => 'Featured'
            ),
            array(
                'keyword' => 'idproofback',
                'value' => 'Idproofback'
            ),
            array(
                'keyword' => 'admin_edit',
                'value' => 'Edit'
            ),
            array(
                'keyword' => 'admin_delete',
                'value' => 'Delete'
            ),
            array(
                'keyword' => 'admin_action',
                'value' => 'Action'
            ),
            array(
                'keyword' => 'admin_role',
                'value' => 'Role'
            ),
            array(
                'keyword' => 'admin_select_role',
                'value' => 'Select Role'
            ),
            array(
                'keyword' => 'admin_account_inactive_msg',
                'value' => 'Your account is deactivated by admin!'
            ),
            array(
                'keyword' => 'under_review',
                'value' => 'Under Review'
            ),
            array(
                'keyword' => 'rejected',
                'value' => 'Rejected'
            ),
            array(
                'keyword' => 'approve',
                'value' => 'Approve'
            ),
            array(
                'keyword' => 'reject',
                'value' => 'Reject'
            ),
            array(
                'keyword' => 'sold',
                'value' => 'Sold'
            ),
            array(
                'keyword' => 'available',
                'value' => 'Available'
            ),
            array(
                'keyword' => 'admin_all_assign_package',
                'value' => 'All Assign Package'
            ),
            array(
                'keyword' => 'admin_all_user_package',
                'value' => 'All User Package'
            ),
            array(
                'keyword' => 'admin_all_reply',
                'value' => 'All Reply'
            ),
            array(
                'keyword' => 'admin_all_translation',
                'value' => 'All Translation'
            ),
            array(
                'keyword' => 'select_sold_status',
                'value' => 'Select Sold Status'
            ),
            array(
                'keyword' => 'admin_google_map',
                'value' => 'Google Map'
            ),
            array(
                'keyword' => 'admin_google_map_key',
                'value' => 'Google Map Key'
            ),
            array(
                'keyword' => 'admin_google_map_key_placeholder',
                'value' => 'Google Map Key Placeholder'
            ),
            array(
                'keyword' => 'view_details',
                'value' => 'View Details'
            ),
            array(
                'keyword' => 'identity_proff',
                'value' => 'Identity'
            ),
            array(
                'keyword' => 'admin_view_seller_form',
                'value' => 'View Seller Form'
            ),
            array(
                'keyword' => 'admin_items',
                'value' => 'Items'
            ),
            array(
                'keyword' => 'admin_packages',
                'value' => 'Packages'
            ),
            array(
                'keyword' => 'admin_transactions',
                'value' => 'Transactions'
            ),

            array (
                'keyword' => 'admin_adsense_ads',
                'value' => 'Adsense Ads',
            ),
            array (
                'keyword' => 'admin_adsense_horizontal_ad_client',
                'value' => 'Adsense Horizontal Ad Client',
            ),
            array (
                'keyword' => 'admin_adsense_horizontal_ad_client_placeholder',
                'value' => 'Enter Adsense Horizontal Ad Client',
            ),
            array (
                'keyword' => 'admin_adsense_horizontal_ad_slot',
                'value' => 'Adsense Horizontal Ad Slot',
            ),
            array (
                'keyword' => 'admin_adsense_horizontal_ad_slot_placeholder',
                'value' => 'Enter Adsense Horizontal Ad Slot',
            ),
            array (
                'keyword' => 'admin_enable_adsense_horizontal_ad_placeholder',
                'value' => 'Enable Adsense Horizontal Ad',
            ),
            array (
                'keyword' => 'footer_logo',
                'value' => 'Footer Logo',
            ),
               
        );

        $languages = Language::where('code','en')->get();

        Translation::where('group','admin')->where('language_id',$languages[0]->id)->delete();
        foreach ($languages as $language) {
            foreach ($dp_translations as $key => $value) {
                $check = Translation::where('language_id',$language->id)->where('group','admin')->where('keyword',$value['keyword'])->first();
                if(!$check){
                    Translation::insert([
                        'language_id' => $language->id,
                        'group' => 'admin',
                        'keyword' => $value['keyword'],
                        'key' => $value['keyword'],
                        'value' => $value['value'],
                        'created_at' => date("Y-m-d H:i:s")
                    ]);               
                }
            }        
        }
    }
}