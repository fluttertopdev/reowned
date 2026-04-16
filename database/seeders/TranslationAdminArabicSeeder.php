<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Translation;
use App\Models\Language;

class TranslationAdminArabicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        $dp_translations = array(

            array(
                'keyword' => 'menu_dashboard',
                'value' => 'لوحة التحكم'
            ),
            array(
                'keyword' => 'ads_listing',
                'value' => 'قائمة الإعلانات'
            ),
            array(
                'keyword' => 'categories',
                'value' => 'الفئات'
            ),
            array(
                'keyword' => 'item_management',
                'value' => 'إدارة العناصر'
            ),
            array(
                'keyword' => 'tips',
                'value' => 'نصائح'
            ),
            array(
                'keyword' => 'package_management',
                'value' => 'إدارة الباقات'
            ),
            array(
                'keyword' => 'advertisement_package',
                'value' => 'باقة الإعلانات'
            ),
            array(
                'keyword' => 'item_listing_package',
                'value' => 'باقة قائمة العناصر'
            ),
            array(
                'keyword' => 'blogs_management',
                'value' => 'إدارة المدونات'
            ),
            array(
                'keyword' => 'blogs',
                'value' => 'المدونات'
            ),
            array(
                'keyword' => 'tags',
                'value' => 'الوسوم'
            ),
            array(
                'keyword' => 'staff_management',
                'value' => 'إدارة الموظفين'
            ),
            array(
                'keyword' => 'staff',
                'value' => 'الموظفون'
            ),
            array(
                'keyword' => 'site_management',
                'value' => 'إدارة الموقع'
            ),
            array(
                'keyword' => 'cms',
                'value' => 'نظام إدارة المحتوى'
            ),
            array(
                'keyword' => 'faq',
                'value' => 'الأسئلة الشائعة'
            ),
            array(
                'keyword' => 'slider',
                'value' => 'السلايدر'
            ),
            array(
                'keyword' => 'place_location_management',
                'value' => 'إدارة المكان/الموقع'
            ),
            array(
                'keyword' => 'place_location',
                'value' => 'المكان/الموقع'
            ),
            array(
                'keyword' => 'country',
                'value' => 'الدولة'
            ),
            array(
                'keyword' => 'state',
                'value' => 'الولاية / المحافظة'
            ),
            array(
                'keyword' => 'city',
                'value' => 'المدينة'
            ),
            array(
                'keyword' => 'area',
                'value' => 'المنطقة'
            ),
            array(
                'keyword' => 'language_management',
                'value' => 'إدارة اللغة'
            ),
            array(
                'keyword' => 'language',
                'value' => 'اللغة'
            ),
            array(
                'keyword' => 'setting_management',
                'value' => 'إدارة الإعدادات'
            ),
            array(
                'keyword' => 'setting',
                'value' => 'الإعدادات'
            ),
            array(
                'keyword' => 'all_setting',
                'value' => 'جميع الإعدادات'
            ),
            array(
                'keyword' => 'customers',
                'value' => 'العملاء'
            ),
            array(
                'keyword' => 'item',
                'value' => 'العنصر'
            ),
            array(
                'keyword' => 'statistics',
                'value' => 'الإحصائيات'
            ),
            array(
                'keyword' => 'my_profile',
                'value' => 'ملفي الشخصي'
            ),
            array(
                'keyword' => 'logout',
                'value' => 'تسجيل الخروج'
            ),
            array(
                'keyword' => 'upload_new_photo',
                'value' => 'رفع صورة جديدة'
            ),
            array(
                'keyword' => 'name',
                'value' => 'الاسم'
            ),
            array(
                'keyword' => 'email',
                'value' => 'البريد الإلكتروني'
            ),
            array(
                'keyword' => 'phone_number',
                'value' => 'رقم الهاتف'
            ),
            array(
                'keyword' => 'password',
                'value' => 'كلمة المرور'
            ),
            array(
                'keyword' => 'save',
                'value' => 'حفظ'
            ),
            array(
                'keyword' => 'category_list',
                'value' => 'قائمة الفئات'
            ),
            array(
                'keyword' => 'page',
                'value' => 'الصفحة'
            ),
            array(
                'keyword' => 'select_status',
                'value' => 'اختر الحالة'
            ),
            array(
                'keyword' => 'reset',
                'value' => 'إعادة تعيين'
            ),
            array(
                'keyword' => 'search',
                'value' => 'بحث'
            ),
            array(
                'keyword' => 'add_category',
                'value' => 'إضافة فئة'
            ),
            array(
                'keyword' => 'category',
                'value' => 'الفئة'
            ),
            array(
                'keyword' => 'subcategory',
                'value' => 'الفئة الفرعية'
            ),
            array(
                'keyword' => 'created_at',
                'value' => 'تاريخ الإنشاء'
            ),
            array(
                'keyword' => 'status',
                'value' => 'الحالة'
            ),
            array(
                'keyword' => 'actions',
                'value' => 'الإجراءات'
            ),
            array(
                'keyword' => 'view',
                'value' => 'عرض'
            ),
            array(
                'keyword' => 'edit',
                'value' => 'تعديل'
            ),
            array(
                'keyword' => 'delete',
                'value' => 'حذف'
            ),
            array(
                'keyword' => 'add_subcategory',
                'value' => 'إضافة فئة فرعية'
            ),
            array(
                'keyword' => 'translation',
                'value' => 'الترجمة'
            ),
            array(
                'keyword' => 'active',
                'value' => 'نشط'
            ),
            array(
                'keyword' => 'deactive',
                'value' => 'غير نشط'
            ),
            array(
                'keyword' => 'subcategory_list',
                'value' => 'قائمة الفئات الفرعية'
            ),
            array(
                'keyword' => 'add',
                'value' => 'إضافة'
            ),
            array(
                'keyword' => 'category_name',
                'value' => 'اسم الفئة'
            ),
            array(
                'keyword' => 'slug',
                'value' => 'الرابط المختصر'
            ),
            array(
                'keyword' => 'description',
                'value' => 'الوصف'
            ),
            array(
                'keyword' => 'image',
                'value' => 'الصورة'
            ),
            array(
                'keyword' => 'image_preview',
                'value' => 'معاينة الصورة'
            ),
            array(
                'keyword' => 'submit',
                'value' => 'إرسال'
            ),
            array(
                'keyword' => 'back',
                'value' => 'رجوع'
            ),
            array(
                'keyword' => 'showing',
                'value' => 'عرض'
            ),
            array(
                'keyword' => 'tips_list',
                'value' => 'قائمة النصائح'
            ),
            array(
                'keyword' => 'add_tip',
                'value' => 'إضافة نصيحة'
            ),
            array(
                'keyword' => 'no_record_found',
                'value' => 'لا يوجد سجلات'
            ),
            array(
                'keyword' => 'add_package',
                'value' => 'إضافة باقة'
            ),
            array(
                'keyword' => 'price',
                'value' => 'السعر'
            ),
            array(
                'keyword' => 'discount',
                'value' => 'الخصم'
            ),
            array(
                'keyword' => 'final_price',
                'value' => 'السعر النهائي'
            ),
            array(
                'keyword' => 'days',
                'value' => 'الأيام'
            ),
            array(
                'keyword' => 'limited',
                'value' => 'محدود'
            ),
            array(
                'keyword' => 'unlimited',
                'value' => 'غير محدود'
            ),
            array(
                'keyword' => 'no_days',
                'value' => 'عدد الأيام'
            ),
            array(
                'keyword' => 'no_item',
                'value' => 'عدد العناصر'
            ),
            array(
                'keyword' => 'add_blog',
                'value' => 'إضافة مدونة'
            ),
            array(
                'keyword' => 'title',
                'value' => 'العنوان'
            ),
            array(
                'keyword' => 'tag',
                'value' => 'الوسم'
            ),
            array(
                'keyword' => 'tag_list',
                'value' => 'قائمة الوسوم'
            ),
            array(
                'keyword' => 'add_tag',
                'value' => 'إضافة وسم'
            ),
            array(
                'keyword' => 'staff_list',
                'value' => 'قائمة الموظفين'
            ),
            array(
                'keyword' => 'add_staff',
                'value' => 'إضافة موظف'
            ),
            array(
                'keyword' => 'phone',
                'value' => 'الهاتف'
            ),
            array(
                'keyword' => 'update',
                'value' => 'تحديث'
            ),
            array(
                'keyword' => 'confirm_password',
                'value' => 'تأكيد كلمة المرور'
            ),
            array(
                'keyword' => 'cms_list',
                'value' => 'قائمة نظام إدارة المحتوى'
            ),
            array(
                'keyword' => 'add_cms',
                'value' => 'إضافة صفحة CMS'
            ),
            array(
                'keyword' => 'page_name',
                'value' => 'اسم الصفحة'
            ),
            array(
                'keyword' => 'faq_list',
                'value' => 'قائمة الأسئلة الشائعة'
            ),
            array(
                'keyword' => 'question',
                'value' => 'السؤال'
            ),
            array(
                'keyword' => 'add_faq',
                'value' => 'إضافة سؤال شائع'
            ),
            array(
                'keyword' => 'answer',
                'value' => 'الإجابة'
            ),
            array(
                'keyword' => 'country_list',
                'value' => 'قائمة الدول'
            ),
            array(
                'keyword' => 'add_country',
                'value' => 'إضافة دولة'
            ),
            array(
                'keyword' => 'upload',
                'value' => 'رفع'
            ),
            array(
                'keyword' => 'cancel',
                'value' => 'إلغاء'
            ),
            array(
                'keyword' => 'bulk_upload_country',
                'value' => 'رفع دول متعددة'
            ),
            array(
                'keyword' => 'state_list',
                'value' => 'قائمة الولايات/المحافظات'
            ),
            array(
                'keyword' => 'add_state',
                'value' => 'إضافة ولاية / محافظة'
            ),
            array(
                'keyword' => 'bulk_upload_states',
                'value' => 'رفع ولايات متعددة'
            ),
            array(
                'keyword' => 'select_country',
                'value' => 'اختر الدولة'
            ),
            array(
                'keyword' => 'city_list',
                'value' => 'قائمة المدن'
            ),
            array(
                'keyword' => 'add_city',
                'value' => 'إضافة مدينة'
            ),
            array(
                'keyword' => 'bulk_upload_city',
                'value' => 'رفع مدن متعددة'
            ),
            array(
                'keyword' => 'area_list',
                'value' => 'قائمة المناطق'
            ),
            array(
                'keyword' => 'add_area',
                'value' => 'إضافة منطقة'
            ),
            array(
                'keyword' => 'select_state',
                'value' => 'اختر الولاية / المحافظة'
            ),
            array(
                'keyword' => 'bulk_upload_area',
                'value' => 'رفع مناطق متعددة'
            ),
            array(
                'keyword' => 'select_city',
                'value' => 'اختر المدينة'
            ),
            array(
                'keyword' => 'languages_list',
                'value' => 'قائمة اللغات'
            ),
            array(
                'keyword' => 'add_languages',
                'value' => 'إضافة لغات'
            ),
            array(
                'keyword' => 'language_code',
                'value' => 'رمز اللغة'
            ),
            array(
                'keyword' => 'position',
                'value' => 'الترتيب'
            ),
            array(
                'keyword' => 'default',
                'value' => 'افتراضي'
            ),
            array(
                'keyword' => 'code',
                'value' => 'الكود'
            ),
            array(
                'keyword' => 'yes',
                'value' => 'نعم'
            ),
            array(
                'keyword' => 'no',
                'value' => 'لا'
            ),
            array(
                'keyword' => 'please_select',
                'value' => 'الرجاء الاختيار'
            ),
            array(
                'keyword' => 'translation_list',
                'value' => 'قائمة الترجمات'
            ),
            array(
                'keyword' => 'value',
                'value' => 'القيمة'
            ),
            array(
                'keyword' => 'select_group',
                'value' => 'اختر المجموعة'
            ),
            array(
                'keyword' => 'add_translation',
                'value' => 'إضافة ترجمة'
            ),
            array(
                'keyword' => 'group_name',
                'value' => 'اسم المجموعة'
            ),
            array(
                'keyword' => 'group',
                'value' => 'المجموعة'
            ),
            array(
                'keyword' => 'keyword',
                'value' => 'الكلمة المفتاحية'
            ),
            array(
                'keyword' => 'general_settings',
                'value' => 'الإعدادات العامة'
            ),
            array(
                'keyword' => 'company_setting',
                'value' => 'إعدادات الشركة'
            ),
            array(
                'keyword' => 'logo',
                'value' => 'الشعار'
            ),
            array(
                'keyword' => 'favicon',
                'value' => 'أيقونة الموقع'
            ),
            array(
                'keyword' => 'currency',
                'value' => 'العملة'
            ),
            array(
                'keyword' => 'admin_login',
                'value' => 'تسجيل دخول المشرف'
            ),
            array(
                'keyword' => 'login',
                'value' => 'تسجيل الدخول'
            ),
            array(
                'keyword' => 'forgot_password',
                'value' => 'نسيت كلمة المرور؟'
            ),
            array(
                'keyword' => 'forgot_password_text',
                'value' => 'أدخل بريدك الإلكتروني وسنرسل لك تعليمات لإعادة تعيين كلمة المرور'
            ),
            array(
                'keyword' => 'back_to_login',
                'value' => 'رجوع إلى تسجيل الدخول'
            ),
            array(
                'keyword' => 'reset_password',
                'value' => 'إعادة تعيين كلمة المرور'
            ),
            array(
                'keyword' => 'reset_password_text',
                'value' => 'يجب أن تكون كلمة المرور الجديدة مختلفة عن كلمات المرور المستخدمة سابقاً'
            ),
            array(
                'keyword' => 'otp',
                'value' => 'رمز التحقق'
            ),
            array(
                'keyword' => 'new_password',
                'value' => 'كلمة المرور الجديدة'
            ),
            array(
                'keyword' => 'enter_otp',
                'value' => 'أدخل رمز التحقق'
            ),
            array(
                'keyword' => 'set_new_password',
                'value' => 'تعيين كلمة مرور جديدة'
            ),
            array(
                'keyword' => 'data_change_msg',
                'value' => 'تم تغيير الحالة بنجاح'
            ),
            array(
                'keyword' => 'data_update_msg',
                'value' => 'تم تحديث البيانات بنجاح'
            ),
            array(
                'keyword' => 'data_add_msg',
                'value' => 'تمت إضافة البيانات بنجاح'
            ),
            array(
                'keyword' => 'data_delete_msg',
                'value' => 'تم حذف البيانات بنجاح'
            ),
            array(
                'keyword' => 'promotional_management',
                'value' => 'إدارة العروض الترويجية'
            ),
            array(
                'keyword' => 'send_notification',
                'value' => 'إرسال إشعار'
            ),
            array(
                'keyword' => 'notification_list',
                'value' => 'قائمة الإشعارات'
            ),
            array(
                'keyword' => 'add_notification',
                'value' => 'إضافة إشعار'
            ),
            array(
                'keyword' => 'select_user',
                'value' => 'اختر المستخدم'
            ),
            array(
                'keyword' => 'select_item',
                'value' => 'اختر العنصر'
            ),
            array(
                'keyword' => 'message',
                'value' => 'الرسالة'
            ),
            array(
                'keyword' => 'mailer',
                'value' => 'المرسل'
            ),
            array(
                'keyword' => 'mailer_placeholder',
                'value' => 'أدخل المرسل'
            ),
            array(
                'keyword' => 'host',
                'value' => 'المضيف'
            ),
            array(
                'keyword' => 'host_placeholder',
                'value' => 'أدخل المضيف'
            ),
            array(
                'keyword' => 'port',
                'value' => 'المنفذ'
            ),
            array(
                'keyword' => 'port_placeholder',
                'value' => 'أدخل المنفذ'
            ),
            array(
                'keyword' => 'username',
                'value' => 'اسم المستخدم'
            ),
            array(
                'keyword' => 'username_placeholder',
                'value' => 'أدخل اسم المستخدم'
            ),
            array(
                'keyword' => 'encryption',
                'value' => 'التشفير'
            ),
            array(
                'keyword' => 'encryption_placeholder',
                'value' => 'أدخل التشفير'
            ),
            array(
                'keyword' => 'from_name',
                'value' => 'اسم المرسل'
            ),
            array(
                'keyword' => 'from_name_placeholder',
                'value' => 'أدخل اسم المرسل'
            ),
            array(
                'keyword' => 'from_email_address',
                'value' => 'البريد الإلكتروني للمرسل'
            ),
            array(
                'keyword' => 'from_email_address_placeholder',
                'value' => 'أدخل البريد الإلكتروني للمرسل'
            ),
            array(
                'keyword' => 'maintainance_mode',
                'value' => 'وضع الصيانة'
            ),
            array(
                'keyword' => 'enable_maintainance_mode_placeholder',
                'value' => 'تفعيل وضع الصيانة'
            ),
            array(
                'keyword' => 'maintainance_title',
                'value' => 'عنوان الصيانة'
            ),
            array(
                'keyword' => 'maintainance_title_placeholder',
                'value' => 'أدخل عنوان الصيانة'
            ),
            array(
                'keyword' => 'maintainance_short_text',
                'value' => 'نص قصير للصيانة'
            ),
            array(
                'keyword' => 'maintainance_short_text_placeholder',
                'value' => 'أدخل نصاً قصيراً للصيانة'
            ),
            array(
                'keyword' => 'slider_list',
                'value' => 'قائمة السلايدر'
            ),
            array(
                'keyword' => 'add_slider',
                'value' => 'إضافة سلايدر'
            ),
            array(
                'keyword' => 'type',
                'value' => 'النوع'
            ),
            array(
                'keyword' => 'external_link',
                'value' => 'رابط خارجي'
            ),
            array(
                'keyword' => 'seo_setting',
                'value' => 'إعدادات تحسين محركات البحث'
            ),
            array(
                'keyword' => 'seo_list',
                'value' => 'قائمة تحسين محركات البحث'
            ),
            array(
                'keyword' => 'add_seo',
                'value' => 'إضافة تحسين محركات البحث'
            ),
            array(
                'keyword' => 'social_media',
                'value' => 'وسائل التواصل الاجتماعي'
            ),
            array(
                'keyword' => 'instagram',
                'value' => 'إنستغرام'
            ),
            array(
                'keyword' => 'facebook',
                'value' => 'فيسبوك'
            ),
            array(
                'keyword' => 'linkedin',
                'value' => 'لينكد إن'
            ),
            array(
                'keyword' => 'x_social_media',
                'value' => 'إكس (تويتر سابقاً)'
            ),
            array(
                'keyword' => 'contact_number1',
                'value' => 'رقم الاتصال 1'
            ),
            array(
                'keyword' => 'contact_number2',
                'value' => 'رقم الاتصال 2'
            ),
            array(
                'keyword' => 'address',
                'value' => 'العنوان'
            ),
            array(
                'keyword' => 'staff_login',
                'value' => 'تسجيل دخول الموظفين'
            ),
            array(
                'keyword' => 'subcategory_name',
                'value' => 'اسم الفئة الفرعية'
            ),
            array(
                'keyword' => 'item_limit',
                'value' => 'حد العناصر'
            ),
            array(
                'keyword' => 'download_dummy_excel',
                'value' => 'تحميل ملف إكسيل تجريبي'
            ),
            array(
                'keyword' => 'rolelist',
                'value' => 'قائمة الأدوار'
            ),
            array(
                'keyword' => 'roles',
                'value' => 'الدور'
            ),
            array(
                'keyword' => 'id',
                'value' => 'المعرف'
            ),
            array(
                'keyword' => 'role_name',
                'value' => 'اسم الدور'
            ),
            array(
                'keyword' => 'create_role',
                'value' => 'إضافة دور'
            ),
            array(
                'keyword' => 'set_role_permission',
                'value' => 'تعيين صلاحيات الدور'
            ),
            array(
                'keyword' => 'all_list',
                'value' => 'قائمة الكل'
            ),
            array(
                'keyword' => 'all_delete',
                'value' => 'حذف الكل'
            ),
            array(
                'keyword' => 'all_add',
                'value' => 'إضافة الكل'
            ),
            array(
                'keyword' => 'all_update',
                'value' => 'تحديث الكل'
            ),
            array(
                'keyword' => 'role_name_placeholder',
                'value' => 'أدخل اسم الدور'
            ),
            array(
                'keyword' => 'role_permissions',
                'value' => 'صلاحيات الدور'
            ),
            array(
                'keyword' => 'add_role',
                'value' => 'إضافة دور'
            ),
            array(
                'keyword' => 'all_status_change',
                'value' => 'تغيير الحالة للكل'
            ),
            array(
                'keyword' => 'all_module',
                'value' => 'الوحدة'
            ),
            array(
                'keyword' => 'all_permissions',
                'value' => 'الصلاحيات'
            ),
            array(
                'keyword' => 'queries',
                'value' => 'استفسارات المستخدمين'
            ),
            array(
                'keyword' => 'userqueries',
                'value' => 'استفسارات المستخدمين'
            ),
            array(
                'keyword' => 'subject',
                'value' => 'الموضوع'
            ),
            array(
                'keyword' => 'sellermanagement',
                'value' => 'إدارة البائعين'
            ),
            array(
                'keyword' => 'sellerverification',
                'value' => 'توثيق البائع'
            ),
            array(
                'keyword' => 'idprooffront',
                'value' => 'إثبات الهوية (الوجه الأمامي)'
            ),
            array(
                'keyword' => 'reports_management',
                'value' => 'إدارة التقارير'
            ),
            array(
                'keyword' => 'reportreasons',
                'value' => 'أسباب الإبلاغ'
            ),
            array(
                'keyword' => 'addreportreasons',
                'value' => 'إضافة أسباب الإبلاغ'
            ),
            array(
                'keyword' => 'reason',
                'value' => 'السبب'
            ),
            array(
                'keyword' => 'customersmanagement',
                'value' => 'إدارة العملاء'
            ),
            array(
                'keyword' => 'assignpackage',
                'value' => 'تعيين باقة'
            ),
            array(
                'keyword' => 'viewpackages',
                'value' => 'عرض الباقات'
            ),
            array(
                'keyword' => 'userpackages',
                'value' => 'باقات المستخدم'
            ),
            array(
                'keyword' => 'recentitem',
                'value' => 'العناصر الأخيرة'
            ),
            array(
                'keyword' => 'userreport',
                'value' => 'تقرير المستخدم'
            ),
            array(
                'keyword' => 'reviews',
                'value' => 'تقييمات البائع'
            ),
            array(
                'keyword' => 'buyer',
                'value' => 'المشتري'
            ),
            array(
                'keyword' => 'seller',
                'value' => 'البائع'
            ),
            array(
                'keyword' => 'rating',
                'value' => 'التقييم'
            ),
            array(
                'keyword' => 'review',
                'value' => 'المراجعة'
            ),
            array(
                'keyword' => 'packagename',
                'value' => 'اسم الباقة'
            ),
            array(
                'keyword' => 'startdate',
                'value' => 'تاريخ البدء'
            ),
            array(
                'keyword' => 'enddate',
                'value' => 'تاريخ الانتهاء'
            ),
            array(
                'keyword' => 'totallimit',
                'value' => 'الحد الإجمالي'
            ),
            array(
                'keyword' => 'usedlimit',
                'value' => 'الحد المستخدم'
            ),
            array(
                'keyword' => 'paymenttransactions',
                'value' => 'معاملات الدفع'
            ),
            array(
                'keyword' => 'username',
                'value' => 'اسم المستخدم'
            ),
            array(
                'keyword' => 'amount',
                'value' => 'المبلغ'
            ),
            array(
                'keyword' => 'paymentgateway',
                'value' => 'بوابة الدفع'
            ),
            array(
                'keyword' => 'paymentstatus',
                'value' => 'حالة الدفع'
            ),
            array(
                'keyword' => 'view_all_notifications',
                'value' => 'عرض جميع الإشعارات'
            ),
            array(
                'keyword' => 'my_profile',
                'value' => 'ملفي الشخصي'
            ),
            array(
                'keyword' => 'logout',
                'value' => 'تسجيل الخروج'
            ),
            array(
                'keyword' => 'light',
                'value' => 'فاتح'
            ),
            array(
                'keyword' => 'dark',
                'value' => 'داكن'
            ),
            array(
                'keyword' => 'system',
                'value' => 'النظام'
            ),
            array(
                'keyword' => 'notification',
                'value' => 'الإشعار'
            ),
            array(
                'keyword' => 'new',
                'value' => 'جديد'
            ),
            array(
                'keyword' => 'mark_as_read',
                'value' => 'تحديد كمقروء'
            ),
            array(
                'keyword' => 'footer_content',
                'value' => 'محتوى التذييل'
            ),
            array(
                'keyword' => 'footer_company_name',
                'value' => 'اسم الشركة في التذييل'
            ),
            array(
                'keyword' => 'item_list',
                'value' => 'قائمة العناصر'
            ),
            array(
                'keyword' => 'subcategory_list',
                'value' => 'قائمة الفئات الفرعية'
            ),
            array(
                'keyword' => 'custom_fields',
                'value' => 'الحقول المخصصة'
            ),
            array(
                'keyword' => 'add_fields',
                'value' => 'إضافة حقول'
            ),
            array(
                'keyword' => 'image_required',
                'value' => 'الصورة مطلوبة'
            ),
            array(
                'keyword' => 'image_required_msg',
                'value' => 'رسالة أن الصورة مطلوبة'
            ),
            array(
                'keyword' => 'field_name',
                'value' => 'اسم الحقل'
            ),
            array(
                'keyword' => 'field_type',
                'value' => 'نوع الحقل'
            ),
            array(
                'keyword' => 'text_input',
                'value' => 'إدخال نصي'
            ),
            array(
                'keyword' => 'number_input',
                'value' => 'إدخال رقمي'
            ),
            array(
                'keyword' => 'dropdown',
                'value' => 'قائمة منسدلة'
            ),
            array(
                'keyword' => 'checkbox',
                'value' => 'مربع اختيار'
            ),
            array(
                'keyword' => 'min',
                'value' => 'الحد الأدنى'
            ),
            array(
                'keyword' => 'max',
                'value' => 'الحد الأقصى'
            ),
            array(
                'keyword' => 'remove',
                'value' => 'إزالة'
            ),
            array(
                'keyword' => 'field_values',
                'value' => 'قيم الحقل'
            ),
            array(
                'keyword' => 'type_value_press_enter',
                'value' => 'اكتب القيمة ثم اضغط Enter'
            ),
            array(
                'keyword' => 'required',
                'value' => 'إلزامي'
            ),
            array(
                'keyword' => 'active',
                'value' => 'نشط'
            ),
            array(
                'keyword' => 'verification_details',
                'value' => 'تفاصيل التوثيق'
            ),
            array(
                'keyword' => 'export',
                'value' => 'تصدير'
            ),
            array(
                'keyword' => 'export_to_excel',
                'value' => 'تصدير إلى إكسيل'
            ),
            array(
                'keyword' => 'export_to_pdf',
                'value' => 'تصدير إلى PDF'
            ),
            array(
                'keyword' => 'front',
                'value' => 'أمامي'
            ),
            array(
                'keyword' => 'back',
                'value' => 'خلفي'
            ),
            array(
                'keyword' => 'ads_packages_list',
                'value' => 'قائمة باقات الإعلانات'
            ),
            array(
                'keyword' => 'ads_packages',
                'value' => 'باقات الإعلانات'
            ),
            array(
                'keyword' => 'name',
                'value' => 'الاسم'
            ),
            array(
                'keyword' => 'price',
                'value' => 'السعر'
            ),
            array(
                'keyword' => 'discount',
                'value' => 'الخصم'
            ),
            array(
                'keyword' => 'final_price',
                'value' => 'السعر النهائي'
            ),
            array(
                'keyword' => 'days_type',
                'value' => 'نوع الأيام'
            ),
            array(
                'keyword' => 'no_of_days',
                'value' => 'عدد الأيام'
            ),
            array(
                'keyword' => 'item_type',
                'value' => 'نوع العنصر'
            ),
            array(
                'keyword' => 'no_of_item',
                'value' => 'عدد العناصر'
            ),
            array(
                'keyword' => 'status',
                'value' => 'الحالة'
            ),
            array(
                'keyword' => 'created_at',
                'value' => 'تاريخ الإنشاء'
            ),
            array(
                'keyword' => 'deactive',
                'value' => 'غير نشط'
            ),
            array(
                'keyword' => 'item_packages_list',
                'value' => 'قائمة باقات العناصر'
            ),
            array(
                'keyword' => 'item_packages',
                'value' => 'باقات العناصر'
            ),
            array(
                'keyword' => 'all',
                'value' => 'الكل'
            ),
            array(
                'keyword' => 'item',
                'value' => 'العنصر'
            ),
            array(
                'keyword' => 'ads',
                'value' => 'الإعلانات'
            ),
            array(
                'keyword' => 'user_packages',
                'value' => 'باقات المستخدم'
            ),
            array(
                'keyword' => 'user_name',
                'value' => 'اسم المستخدم'
            ),
            array(
                'keyword' => 'user_email',
                'value' => 'البريد الإلكتروني للمستخدم'
            ),
            array(
                'keyword' => 'package',
                'value' => 'الباقة'
            ),
            array(
                'keyword' => 'start_date',
                'value' => 'تاريخ البدء'
            ),
            array(
                'keyword' => 'end_date',
                'value' => 'تاريخ الانتهاء'
            ),
            array(
                'keyword' => 'total_limit',
                'value' => 'الحد الإجمالي'
            ),
            array(
                'keyword' => 'used_limit',
                'value' => 'الحد المستخدم'
            ),
            array(
                'keyword' => 'expired',
                'value' => 'منتهي الصلاحية'
            ),
            array(
                'keyword' => 'unlimited',
                'value' => 'غير محدود'
            ),
            array(
                'keyword' => 'all_gateways',
                'value' => 'جميع البوابات'
            ),
            array(
                'keyword' => 'paid',
                'value' => 'مدفوع'
            ),
            array(
                'keyword' => 'failed',
                'value' => 'فشل'
            ),
            array(
                'keyword' => 'pending',
                'value' => 'قيد الانتظار'
            ),
            array(
                'keyword' => 'reason',
                'value' => 'السبب'
            ),
            array(
                'keyword' => 'reported_at',
                'value' => 'تاريخ الإبلاغ'
            ),
            array(
                'keyword' => 'select_all',
                'value' => 'تحديد الكل'
            ),
            array(
                'keyword' => 'deselect_all',
                'value' => 'إلغاء تحديد الكل'
            ),
            array(
                'keyword' => 'resolution',
                'value' => 'القرار / الحل'
            ),
            array(
                'keyword' => 'upload',
                'value' => 'رفع'
            ),
            array(
                'keyword' => 'payment_method',
                'value' => 'طريقة الدفع'
            ),
            array(
                'keyword' => 'razorpay_key',
                'value' => 'مفتاح Razorpay'
            ),
            array(
                'keyword' => 'razorpay_secret',
                'value' => 'المفتاح السري لـ Razorpay'
            ),
            array(
                'keyword' => 'enter_razorpay_key',
                'value' => 'أدخل مفتاح Razorpay'
            ),
            array(
                'keyword' => 'enter_razorpay_secret',
                'value' => 'أدخل المفتاح السري لـ Razorpay'
            ),
            array(
                'keyword' => 'stripe_key',
                'value' => 'مفتاح Stripe'
            ),
            array(
                'keyword' => 'stripe_secret_key',
                'value' => 'المفتاح السري لـ Stripe'
            ),
            array(
                'keyword' => 'enter_stripe_key',
                'value' => 'أدخل مفتاح Stripe'
            ),
            array(
                'keyword' => 'enter_stripe_secret_key',
                'value' => 'أدخل المفتاح السري لـ Stripe'
            ),
            array(
                'keyword' => 'paypal_client_id',
                'value' => 'معرف عميل PayPal'
            ),
            array(
                'keyword' => 'paypal_secret_key',
                'value' => 'المفتاح السري لـ PayPal'
            ),
            array(
                'keyword' => 'enter_paypal_client_id',
                'value' => 'أدخل معرف عميل PayPal'
            ),
            array(
                'keyword' => 'enter_paypal_secret_key',
                'value' => 'أدخل المفتاح السري لـ PayPal'
            ),
            array(
                'keyword' => 'translation_updated',
                'value' => 'تم تحديث الترجمة بنجاح.'
            ),
            array(
                'keyword' => 'logged_out',
                'value' => 'لقد تم تسجيل خروجك.'
            ),
            array(
                'keyword' => 'invalid_data_provided',
                'value' => 'تم تقديم بيانات غير صالحة.'
            ),
            array(
                'keyword' => 'package_not_found',
                'value' => 'الباقة غير موجودة.'
            ),
            array(
                'keyword' => 'package_assigned_successfully',
                'value' => 'تم تعيين الباقة بنجاح.'
            ),
            array(
                'keyword' => 'item_package_not_found',
                'value' => 'باقة العنصر غير موجودة.'
            ),
            array(
                'keyword' => 'item_package_assigned_successfully',
                'value' => 'تم تعيين باقة العنصر بنجاح.'
            ),
            array(
                'keyword' => 'featured_status_updated',
                'value' => 'تم تحديث حالة المميز'
            ),
            array(
                'keyword' => 'category_order_updated',
                'value' => 'تم تحديث ترتيب الفئات بنجاح'
            ),
            array(
                'keyword' => 'error_prefix',
                'value' => 'خطأ: '
            ),
            array(
                'keyword' => 'admin',
                'value' => 'مدير'
            ),
            array(
                'keyword' => 'banner',
                'value' => 'بانر'
            ),
            array(
                'keyword' => 'website_management',
                'value' => 'إدارة الموقع'
            ),
            array(
                'keyword' => 'contact_us',
                'value' => 'اتصل بنا'
            ),
            array(
                'keyword' => 'role_permission',
                'value' => 'الأدوار والصلاحيات'
            ),
            array(
                'keyword' => 'admin_menu_dashboard',
                'value' => 'لوحة التحكم'
            ),

            array(
                'keyword' => 'are_you_sure',
                'value' => 'هل أنت متأكد؟'
            ),
            array(
                'keyword' => 'you_wont_be_able_to_revert_this',
                'value' => 'لن تكون قادراً على التراجع عن هذا!'
            ),
            array(
                'keyword' => 'yes_delete_it',
                'value' => 'نعم، احذفه!'
            ),


            array(
                'keyword' => 'bulk_delete',
                'value' => 'حذف جماعي'
            ),
            array(
                'keyword' => 'admin_maintainance_mode',
                'value' => 'وضع الصيانة'
            ),
            array(
                'keyword' => 'admin_google_login',
                'value' => 'تسجيل الدخول عبر جوجل'
            ),
            array(
                'keyword' => 'admin_footer_logo',
                'value' => 'شعار التذييل'
            ),
            array(
                'keyword' => 'admin_enable_maintainance_mode_placeholder',
                'value' => 'تفعيل وضع الصيانة'
            ),
            array(
                'keyword' => 'admin_maintainance_title',
                'value' => 'عنوان الصيانة'
            ),
            array(
                'keyword' => 'admin_maintainance_title_placeholder',
                'value' => 'أدخل عنوان الصيانة'
            ),
            array(
                'keyword' => 'admin_maintainance_short_text',
                'value' => 'نص قصير للصيانة'
            ),
            array(
                'keyword' => 'admin_maintainance_short_text_placeholder',
                'value' => 'أدخل النص القصير للصيانة'
            ),
            array(
                'keyword' => 'admin_enable_google_login_placeholder',
                'value' => 'تفعيل تسجيل الدخول عبر جوجل'
            ),
            array(
                'keyword' => 'admin_google_client_id',
                'value' => 'معرف عميل جوجل'
            ),
            array(
                'keyword' => 'admin_google_client_id_placeholder',
                'value' => 'أدخل معرف عميل جوجل'
            ),
            array(
                'keyword' => 'admin_google_client_secret',
                'value' => 'المفتاح السري لعميل جوجل'
            ),
            array(
                'keyword' => 'admin_google_client_secret_placeholder',
                'value' => 'أدخل المفتاح السري لعميل جوجل'
            ),
            array(
                'keyword' => 'admin_google_redirect_url',
                'value' => 'رابط إعادة التوجيه لجوجل'
            ),
            array(
                'keyword' => 'admin_google_redirect_url_placeholder',
                'value' => 'أدخل رابط إعادة التوجيه لجوجل'
            ),
            array(
                'keyword' => 'admin_button_save_changes',
                'value' => 'حفظ التغييرات'
            ),
            array(
                'keyword' => 'admin_button_back',
                'value' => 'رجوع'
            ),

            array(
                'keyword' => 'admin_mailer',
                'value' => 'نظام البريد'
            ),
            array(
                'keyword' => 'admin_mailer_placeholder',
                'value' => 'أدخل نظام البريد'
            ),
            array(
                'keyword' => 'admin_host',
                'value' => 'المضيف'
            ),
            array(
                'keyword' => 'admin_host_placeholder',
                'value' => 'أدخل اسم المضيف'
            ),
            array(
                'keyword' => 'admin_port',
                'value' => 'المنفذ'
            ),
            array(
                'keyword' => 'admin_port_placeholder',
                'value' => 'أدخل رقم المنفذ'
            ),
            array(
                'keyword' => 'admin_username',
                'value' => 'اسم المستخدم'
            ),
            array(
                'keyword' => 'admin_username_placeholder',
                'value' => 'أدخل اسم المستخدم'
            ),
            array(
                'keyword' => 'admin_password',
                'value' => 'كلمة المرور'
            ),
            array(
                'keyword' => 'admin_password_placeholder',
                'value' => 'أدخل كلمة المرور'
            ),
            array(
                'keyword' => 'admin_encryption',
                'value' => 'التشفير'
            ),
            array(
                'keyword' => 'admin_encryption_placeholder',
                'value' => 'أدخل نوع التشفير'
            ),
            array(
                'keyword' => 'admin_from_name',
                'value' => 'اسم المرسل'
            ),
            array(
                'keyword' => 'admin_from_name_placeholder',
                'value' => 'أدخل اسم المرسل'
            ),
            array(
                'keyword' => 'admin_from_email_address',
                'value' => 'البريد الإلكتروني للمرسل'
            ),
            array(
                'keyword' => 'admin_from_email_address_placeholder',
                'value' => 'أدخل البريد الإلكتروني للمرسل'
            ),
            array(
                'keyword' => 'select_package_msg',
                'value' => 'الرجاء اختيار باقة'
            ),

            array(
                'keyword' => 'link',
                'value' => 'الرابط'
            ),
            array(
                'keyword' => 'admin_id',
                'value' => 'المعرف'
            ),
            array(
                'keyword' => 'admin_role_name',
                'value' => 'اسم الدور'
            ),
            array(
                'keyword' => 'admin_create_role',
                'value' => 'إنشاء دور'
            ),
            array(
                'keyword' => 'admin_add_role',
                'value' => 'إضافة دور'
            ),
            array(
                'keyword' => 'admin_set_role_permission',
                'value' => 'تعيين صلاحيات الدور'
            ),
            array(
                'keyword' => 'admin_role_name_placeholder',
                'value' => 'أدخل اسم الدور'
            ),
            array(
                'keyword' => 'admin_role_permissions',
                'value' => 'صلاحيات الدور'
            ),
            array(
                'keyword' => 'admin_all_list',
                'value' => 'عرض الكل'
            ),
            array(
                'keyword' => 'admin_all_add',
                'value' => 'إضافة الكل'
            ),
            array(
                'keyword' => 'admin_all_update',
                'value' => 'تحديث الكل'
            ),
            array(
                'keyword' => 'admin_all_status_change',
                'value' => 'تغيير حالة الكل'
            ),
            array(
                'keyword' => 'admin_all_delete',
                'value' => 'حذف الكل'
            ),
            array(
                'keyword' => 'admin_all_module',
                'value' => 'جميع الوحدات'
            ),
            array(
                'keyword' => 'admin_all_permissions',
                'value' => 'جميع الصلاحيات'
            ),
            array(
                'keyword' => 'ad_id',
                'value' => 'معرف الإعلان'
            ),
            array(
                'keyword' => 'created_date',
                'value' => 'تاريخ الإنشاء'
            ),
            array(
                'keyword' => 'reported_no',
                'value' => 'عدد البلاغات'
            ),
            array(
                'keyword' => 'view_detail',
                'value' => 'عرض التفاصيل'
            ),
            array(
                'keyword' => 'admin_dashboard',
                'value' => 'لوحة التحكم'
            ),
            array(
                'keyword' => 'admin_list',
                'value' => 'القائمة'
            ),
            array(
                'keyword' => 'admin_back',
                'value' => 'رجوع'
            ),
            array(
                'keyword' => 'purchase_date',
                'value' => 'تاريخ الشراء'
            ),
            array(
                'keyword' => 'approved',
                'value' => 'موافق عليه'
            ),
            array(
                'keyword' => 'admin_data_change_msg',
                'value' => 'تم تغيير البيانات بنجاح'
            ),
            array(
                'keyword' => 'id_proff',
                'value' => 'إثبات الهوية'
            ),
            array(
                'keyword' => 'admin_name',
                'value' => 'الاسم'
            ),
            array(
                'keyword' => 'admin_email',
                'value' => 'البريد الإلكتروني'
            ),
            array(
                'keyword' => 'admin_subject',
                'value' => 'الموضوع'
            ),
            array(
                'keyword' => 'admin_message',
                'value' => 'الرسالة'
            ),
            array(
                'keyword' => 'admin_action',
                'value' => 'إجراء'
            ),
            array(
                'keyword' => 'admin_reply',
                'value' => 'رد'
            ),
            array(
                'keyword' => 'contact_us_list',
                'value' => 'قائمة اتصل بنا'
            ),
            array(
                'keyword' => 'admin_reply_placeholder',
                'value' => 'أدخل الرد'
            ),
            array(
                'keyword' => 'admin_button_send',
                'value' => 'إرسال'
            ),
            array(
                'keyword' => 'admin_button_cancel',
                'value' => 'إلغاء'
            ),

            array(
                'keyword' => 'admin_translation_updated',
                'value' => 'تم تحديث البيانات بنجاح'
            ),
            array(
                'keyword' => 'admin_category_order_updated',
                'value' => 'تم تحديث ترتيب الفئات بنجاح'
            ),
            array(
                'keyword' => 'admin_featured_status_updated',
                'value' => 'تم تحديث حالة المميز بنجاح'
            ),
            array(
                'keyword' => 'admin_invalid_data_provided',
                'value' => 'تم تقديم بيانات غير صالحة'
            ),
            array(
                'keyword' => 'admin_package_not_found',
                'value' => 'الباقة غير موجودة'
            ),
            array(
                'keyword' => 'admin_package_assigned_successfully',
                'value' => 'تم تعيين الباقة بنجاح'
            ),
            array(
                'keyword' => 'admin_item_package_not_found',
                'value' => 'باقة العنصر غير موجودة'
            ),
            array(
                'keyword' => 'admin_item_package_assigned_successfully',
                'value' => 'تم تعيين باقة العنصر بنجاح'
            ),
            array(
                'keyword' => 'admin_logged_out',
                'value' => 'تم تسجيل الخروج بنجاح'
            ),
            array(
                'keyword' => 'record_deleted_successfully',
                'value' => 'تم حذف السجل بنجاح'
            ),
            array(
                'keyword' => 'something_went_wrong',
                'value' => 'حدث خطأ ما'
            ),
            array(
                'keyword' => 'admin_error_prefix',
                'value' => 'خطأ:'
            ),
            array(
                'keyword' => 'admin_access_denied',
                'value' => 'تم رفض الوصول. فقط المديرون يمكنهم تسجيل الدخول.'
            ),
            array(
                'keyword' => 'admin_invalid_crendetails',
                'value' => 'البيانات المدخلة غير متطابقة مع سجلاتنا.'
            ),
            array(
                'keyword' => 'admin_password_reset_success',
                'value' => 'تم إعادة تعيين كلمة المرور بنجاح'
            ),
            array(
                'keyword' => 'admin_data_add_msg',
                'value' => 'تمت إضافة البيانات بنجاح'
            ),
            array(
                'keyword' => 'admin_data_update_msg',
                'value' => 'تم تحديث البيانات بنجاح'
            ),
            array(
                'keyword' => 'admin_data_delete_msg',
                'value' => 'تم حذف البيانات بنجاح'
            ),
            array(
                'keyword' => 'admin_data_change_msg',
                'value' => 'تم تغيير البيانات بنجاح'
            ),
            array(
                'keyword' => 'admin_data_error_msg',
                'value' => 'حدث خطأ أثناء معالجة البيانات'
            ),
            array(
                'keyword' => 'featured',
                'value' => 'مميز'
            ),
            
            array(
                'keyword' => 'idproofback',
                'value' => 'إثبات الهوية (الوجه الخلفي)'
            ),
            array(
                'keyword' => 'admin_edit',
                'value' => 'تعديل'
            ),
            array(
                'keyword' => 'admin_delete',
                'value' => 'حذف'
            ),
            array(
                'keyword' => 'admin_action',
                'value' => 'إجراء'
            ),
            array(
                'keyword' => 'admin_role',
                'value' => 'الدور'
            ),
            array(
                'keyword' => 'admin_select_role',
                'value' => 'اختر الدور'
            ),
            array(
                'keyword' => 'admin_account_inactive_msg',
                'value' => 'تم إلغاء تنشيط حسابك بواسطة المشرف!'
            ),
        );

        $languages = Language::where('code','ar')->get();

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