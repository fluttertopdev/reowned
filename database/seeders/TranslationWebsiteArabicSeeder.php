<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Translation;
use App\Models\Language;

class TranslationWebsiteArabicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
       $dp_translations = [
            ['keyword' => 'select_location', 'value' => 'اختر الموقع'],
            ['keyword' => 'all_categories', 'value' => 'جميع الفئات'],
            ['keyword' => 'more', 'value' => 'المزيد'],
            ['keyword' => 'register', 'value' => 'تسجيل'],
            ['keyword' => 'login', 'value' => 'تسجيل الدخول'],
            ['keyword' => 'sell', 'value' => 'بيع'],
            ['keyword' => 'other', 'value' => 'أخرى'],
            ['keyword' => 'select_location', 'value' => 'اختر الموقع'],
            ['keyword' => 'copyright', 'value' => 'حقوق النشر ©'],
            ['keyword' => 'all_rights_reserved', 'value' => 'جميع الحقوق محفوظة'],
            ['keyword' => 'explore_popular_categories', 'value' => 'استكشف الفئات الشائعة'],
            ['keyword' => 'recommendations', 'value' => 'التوصيات'],
            ['keyword' => 'view_all', 'value' => 'عرض الكل'],
            ['keyword' => 'popular_items', 'value' => 'العناصر الشائعة'],
            ['keyword' => 'all_item', 'value' => 'جميع العناصر'],
            ['keyword' => 'category', 'value' => 'الفئة'],
            ['keyword' => 'load_more', 'value' => 'تحميل المزيد'],
            ['keyword' => 'price_low_to_high', 'value' => 'السعر: من الأقل إلى الأعلى'],
            ['keyword' => 'low_to_high', 'value' => 'من الأقل إلى الأعلى'],
            ['keyword' => 'high_to_low', 'value' => 'من الأعلى إلى الأقل'],
            ['keyword' => 'oldest_to_newest', 'value' => 'من الأقدم إلى الأحدث'],
            ['keyword' => 'newest_to_oldest', 'value' => 'من الأحدث إلى الأقدم'],
            ['keyword' => 'home', 'value' => 'الرئيسية'],
            ['keyword' => 'search_result', 'value' => 'نتائج البحث'],
            ['keyword' => 'filters', 'value' => 'عوامل التصفية'],
            ['keyword' => 'recommended_for_you', 'value' => 'موصى به لك'],
            ['keyword' => 'popular_in_your_area', 'value' => 'الشائع في منطقتك'],
            ['keyword' => 'all_items', 'value' => 'جميع العناصر'],
            ['keyword' => 'item_lists', 'value' => 'قوائم العناصر'],
            ['keyword' => 'description', 'value' => 'الوصف'],
            ['keyword' => 'highlights', 'value' => 'النقاط البارزة'],
            ['keyword' => 'facebook', 'value' => 'فيسبوك'],
            ['keyword' => 'x', 'value' => 'إكس'],
            ['keyword' => 'whatsApp', 'value' => 'واتساب'],
            ['keyword' => 'copy_link', 'value' => 'نسخ الرابط'],
            ['keyword' => 'report', 'value' => 'تبليغ'],
            ['keyword' => 'copied', 'value' => 'تم النسخ'],
            ['keyword' => 'link_copied_to_clipboard', 'value' => 'تم نسخ الرابط إلى الحافظة'],
            ['keyword' => 'pricing_plans', 'value' => 'خطط الأسعار'],
            ['keyword' => 'ad_listing_plan', 'value' => 'خطة إعلان القائمة'],
            ['keyword' => 'featured_ad_plan', 'value' => 'خطة الإعلان المميز'],
            ['keyword' => 'free', 'value' => 'مجاني'],
            ['keyword' => 'choose_plan', 'value' => 'اختر الخطة'],
            ['keyword' => 'no_packages_found', 'value' => 'لم يتم العثور على باقات'],
            ['keyword' => 'payment_with', 'value' => 'الدفع عبر'],
            ['keyword' => 'razorpay', 'value' => 'رازورباي'],
            ['keyword' => 'stripe', 'value' => 'سترايب'],
            ['keyword' => 'stripe_available_only_for_USD_payments', 'value' => 'سترايب متاحة فقط للمدفوعات بالدولار الأمريكي'],
            ['keyword' => 'paypal', 'value' => 'باي بال'],
            ['keyword' => 'please_select_a_package', 'value' => 'الرجاء اختيار باقة'],
            ['keyword' => 'total_ads', 'value' => 'إجمالي الإعلانات'],
            ['keyword' => 'not_ads_found', 'value' => 'لم يتم العثور على إعلانات'],
            ['keyword' => 'not_ads_found_description', 'value' => 'لا توجد إعلانات حالياً. ابدأ بإنشاء إعلانك الأول الآن!'],
            ['keyword' => 'newest', 'value' => 'الأحدث'],
            ['keyword' => 'price_high_to_low', 'value' => 'السعر: أعلى ← أقل'],
            ['keyword' => 'all', 'value' => 'الكل'],
            ['keyword' => 'under_review', 'value' => 'قيد المراجعة'],
            ['keyword' => 'live', 'value' => 'منشور'],
            ['keyword' => 'rejected', 'value' => 'مرفوض'],
            ['keyword' => 'sold', 'value' => 'تم البيع'],
            ['keyword' => 'no_transactions_found', 'value' => 'لم يتم العثور على معاملات'],
            ['keyword' => 'showing', 'value' => 'عرض'],
            ['keyword' => 'of', 'value' => 'من'],
            ['keyword' => 'to', 'value' => 'إلى'],
            ['keyword' => 'entries', 'value' => 'مدخلات'],
            ['keyword' => 'success', 'value' => 'ناجح'],
            ['keyword' => 'failed', 'value' => 'فشل'],
            ['keyword' => 'pending', 'value' => 'قيد الانتظار'],
            ['keyword' => 'select_category', 'value' => 'اختر الفئة'],
            ['keyword' => 'all_category', 'value' => 'جميع الفئات'],
            ['keyword' => 'all_subcategory', 'value' => 'جميع الفئات الفرعية'],
            ['keyword' => 'ad_listing', 'value' => 'قائمة الإعلان'],
            ['keyword' => 'selected_category', 'value' => 'الفئة المختارة'],
            ['keyword' => 'include_some_details', 'value' => 'أضف بعض التفاصيل'],
            ['keyword' => 'ad_title', 'value' => 'عنوان الإعلان'],
            ['keyword' => 'ad_title_placeholder', 'value' => 'اذكر الميزات الرئيسية لعنصرك (مثال: العلامة التجارية، الموديل، العمر، النوع)'],
            ['keyword' => 'description_placeholder', 'value' => 'اذكر الميزات الرئيسية لعنصرك (مثال: العلامة التجارية، الموديل، العمر، النوع)'],
            ['keyword' => 'set_a_price', 'value' => 'حدد سعراً'],
            ['keyword' => 'price', 'value' => 'السعر'],
            ['keyword' => 'upload_photos', 'value' => 'حمّل حتى 20 صورة'],
            ['keyword' => 'main_picture', 'value' => 'الصورة الرئيسية'],
            ['keyword' => 'drag_drop', 'value' => 'اسحب وأفلت ملفاتك أو'],
            ['keyword' => 'upload', 'value' => 'رفع'],
            ['keyword' => 'confirm_location', 'value' => 'تأكيد موقعك'],
            ['keyword' => 'area', 'value' => 'المنطقة'],
            ['keyword' => 'enter_area', 'value' => 'أدخل منطقتك'],
            ['keyword' => 'post_now', 'value' => 'نشر الآن'],
            ['keyword' => 'select', 'value' => 'اختر'],
            ['keyword' => 'home_appliances', 'value' => 'الأجهزة المنزلية'],
            ['keyword' => 'contact_us', 'value' => 'اتصل بنا'],
            ['keyword' => 'faqs', 'value' => 'الأسئلة الشائعة'],
            ['keyword' => 'chat', 'value' => 'الدردشة'],
            ['keyword' => 'blocked_users', 'value' => 'المستخدمون المحظورون'],
            ['keyword' => 'selling', 'value' => 'بيع'],
            ['keyword' => 'buying', 'value' => 'شراء'],
            ['keyword' => 'no_user_found', 'value' => 'لم يتم العثور على مستخدم...'],
            ['keyword' => 'no_selling_users_found', 'value' => 'لم يتم العثور على مستخدمين يبيعون...'],
            ['keyword' => 'no_buying_users_found', 'value' => 'لم يتم العثور على مستخدمين يشترون...'],
            ['keyword' => 'no_chat_data_found', 'value' => 'لم يتم العثور على بيانات دردشة'],
            ['keyword' => 'item_name', 'value' => 'اسم العنصر :- '],
            ['keyword' => 'no_message_yet', 'value' => 'لا توجد رسائل بعد'],
            ['keyword' => 'sign_out', 'value' => 'تسجيل الخروج'],
            ['keyword' => 'delete_account', 'value' => 'حذف الحساب'],
            ['keyword' => 'setting', 'value' => 'الإعدادات'],
            ['keyword' => 'edit_profile', 'value' => 'تعديل الملف الشخصي'],
            ['keyword' => 'get_verification_badge', 'value' => 'احصل على شارة التوثيق'],
            ['keyword' => 'notifications', 'value' => 'الإشعارات'],
            ['keyword' => 'subscription', 'value' => 'الاشتراك'],
            ['keyword' => 'ads', 'value' => 'الإعلانات'],
            ['keyword' => 'favorites', 'value' => 'المفضلة'],
            ['keyword' => 'transaction', 'value' => 'المعاملات'],
            ['keyword' => 'quick_links', 'value' => 'روابط سريعة'],
            ['keyword' => 'legal', 'value' => 'قانوني'],
            ['keyword' => 'get_in_touch', 'value' => 'تواصل معنا'],
            ['keyword' => 'edit_location', 'value' => 'تعديل الموقع'],
            ['keyword' => 'current_location', 'value' => 'الموقع الحالي'],
            ['keyword' => 'search_city_area', 'value' => 'ابحث عن مدينة / منطقة'],
            ['keyword' => 'km_range', 'value' => 'النطاق (كم)'],
            ['keyword' => 'search_placeholder', 'value' => 'بحث...'],
            ['keyword' => 'contact_description', 'value' => 'تواصل معنا! سواء كان لديك أسئلة أو ملاحظات أو ترغب فقط في إلقاء التحية، صفحة الاتصال الخاصة بنا هي بوابتك للوصول إلى فريقنا.'],
            ['keyword' => 'enter_name', 'value' => 'أدخل الاسم'],
            ['keyword' => 'enter_email', 'value' => 'أدخل البريد الإلكتروني'],
            ['keyword' => 'enter_subject', 'value' => 'أدخل الموضوع'],
            ['keyword' => 'enter_message', 'value' => 'أدخل الرسالة'],
            ['keyword' => 'submit', 'value' => 'إرسال'],
            ['keyword' => 'name_required', 'value' => 'الاسم مطلوب'],
            ['keyword' => 'email_required', 'value' => 'البريد الإلكتروني مطلوب'],
            ['keyword' => 'enter_valid_email', 'value' => 'أدخل بريداً إلكترونياً صالحاً'],
            ['keyword' => 'subject_required', 'value' => 'الموضوع مطلوب'],
            ['keyword' => 'message_required', 'value' => 'الرسالة مطلوبة'],
            ['keyword' => 'verify', 'value' => 'تحقق'],
            ['keyword' => 'user_verification', 'value' => 'توثيق المستخدم'],
            ['keyword' => 'id_proof_front', 'value' => 'إثبات الهوية (الوجه الأمامي)'],
            ['keyword' => 'id_proof_back', 'value' => 'إثبات الهوية (الوجه الخلفي)'],
            ['keyword' => 'allowed_file_types', 'value' => 'أنواع الملفات المسموحة: PNG، JPG، JPEG، SVG، PDF'],
            ['keyword' => 'save_changes', 'value' => 'حفظ التغييرات'],
            ['keyword' => 'personal_info', 'value' => 'المعلومات الشخصية'],
            ['keyword' => 'edit_your_personal_information', 'value' => 'تعديل معلوماتك الشخصية'],
            ['keyword' => 'name_placeholder', 'value' => 'إستر هوارد'],
            ['keyword' => 'email_placeholder', 'value' => 'estherhaward@gmail.com'],
            ['keyword' => 'phone', 'value' => 'الهاتف'],
            ['keyword' => 'phone_placeholder', 'value' => '98765 43210'],
            ['keyword' => 'notification', 'value' => 'الإشعارات'],
            ['keyword' => 'address', 'value' => 'العنوان'],
            ['keyword' => 'edit_your_address', 'value' => 'تعديل عنوانك'],
            ['keyword' => 'address_placeholder', 'value' => 'جوروناناك سوسايتي، ثان'],
            ['keyword' => 'start_chat', 'value' => 'بدء الدردشة'],
            ['keyword' => 'call', 'value' => 'اتصال'],
            ['keyword' => 'posted_in', 'value' => 'تم النشر في'],
            ['keyword' => 'view_on_google_map', 'value' => 'عرض على خرائط جوجل'],
            ['keyword' => 'did_you_find_problem', 'value' => 'هل وجدت أي مشكلة في هذا العنصر؟'],
            ['keyword' => 'ad_name', 'value' => 'اسم الإعلان'],
            ['keyword' => 'report_this_ad', 'value' => 'الإبلاغ عن هذا الإعلان'],
            ['keyword' => 'related_ads', 'value' => 'إعلانات ذات صلة'],
            ['keyword' => 'unblock', 'value' => 'إلغاء الحظر'],
            ['keyword' => 'block', 'value' => 'حظر'],
            ['keyword' => 'start_conversation', 'value' => 'بدء المحادثة'],
            ['keyword' => 'typing', 'value' => 'يكتب...'],
            ['keyword' => 'type_a_message', 'value' => 'اكتب رسالة...'],
            ['keyword' => 'no_favorites_items_found', 'value' => 'لم يتم العثور على عناصر مفضلة'],
            ['keyword' => 'sell', 'value' => 'بيع'],
            ['keyword' => 'add_listing', 'value' => 'إضافة قائمة'],
            ['keyword' => 'add', 'value' => 'إضافة'],
            ['keyword' => 'date', 'value' => 'التاريخ'],
            ['keyword' => 'id', 'value' => 'المعرف'],
            ['keyword' => 'package_detail', 'value' => 'تفاصيل الباقة'],
            ['keyword' => 'payment_method', 'value' => 'طريقة الدفع'],
            ['keyword' => 'transaction_id', 'value' => 'رقم المعاملة'],
            ['keyword' => 'price', 'value' => 'السعر'],
            ['keyword' => 'status', 'value' => 'الحالة'],
            ['keyword' => 'posted_on', 'value' => 'تم النشر في:'],
            ['keyword' => 'you_blocked_this_user', 'value' => 'لقد قمت بحظر هذا المستخدم'],
            ['keyword' => 'user_unblocked', 'value' => 'تم إلغاء حظر المستخدم!'],
            ['keyword' => 'user_blocked', 'value' => 'تم حظر المستخدم!'],
            ['keyword' => 'are_you_sure', 'value' => 'هل أنت متأكد؟'],
            ['keyword' => 'your_ads_transactions_history_deleted', 'value' => 'سيتم حذف إعلاناتك وسجل معاملاتك'],
            ['keyword' => 'accounts_details_cant_be_recovered', 'value' => 'لا يمكن استعادة تفاصيل الحساب'],
            ['keyword' => 'subscriptions_will_be_cancelled', 'value' => 'سيتم إلغاء الاشتراكات'],
            ['keyword' => 'saved_preferences_and_messages_lost', 'value' => 'سيتم فقدان التفضيلات والرسائل المحفوظة'],
            ['keyword' => 'cancel', 'value' => 'إلغاء'],
            ['keyword' => 'yes', 'value' => 'نعم'],
            ['keyword' => 'are_you_sure_to_sign_out', 'value' => 'هل أنت متأكد من رغبتك في تسجيل الخروج؟'],
            ['keyword' => 'payment_successful', 'value' => 'الدفع ناجح ✅'],
            ['keyword' => 'payment_failed', 'value' => 'الدفع فشل ❌'],
            ['keyword' => 'account_not_exists', 'value' => 'الحساب غير موجود'],
            ['keyword' => 'registration_successful_check_email', 'value' => 'تم التسجيل بنجاح! يرجى التحقق من بريدك الإلكتروني.'],
            ['keyword' => 'registration_failed_email_sending_failed', 'value' => 'فشل التسجيل! فشل إرسال البريد الإلكتروني. يرجى المحاولة مرة أخرى لاحقاً.'],
            ['keyword' => 'invalid_verification_link', 'value' => 'رابط التحقق غير صالح.'],
            ['keyword' => 'verification_link_expired', 'value' => 'انتهت صلاحية رابط التحقق.'],
            ['keyword' => 'account_already_verified', 'value' => 'الحساب مؤكد بالفعل.'],
            ['keyword' => 'account_verified_successfully', 'value' => 'تم تأكيد حسابك بنجاح!'],
            ['keyword' => 'email_not_registered', 'value' => 'البريد الإلكتروني غير مسجل.'],
            ['keyword' => 'account_has_been_deleted', 'value' => 'تم حذف هذا الحساب.'],
            ['keyword' => 'unauthorized_access', 'value' => 'دخول غير مصرح به.'],
            ['keyword' => 'please_verify_your_email_first', 'value' => 'يرجى تأكيد بريدك الإلكتروني أولاً.'],
            ['keyword' => 'incorrect_password', 'value' => 'كلمة المرور غير صحيحة.'],
            ['keyword' => 'login_successful', 'value' => 'تم تسجيل الدخول بنجاح!'],
            ['keyword' => 'logged_out_successfully', 'value' => 'تم تسجيل الخروج بنجاح.'],
            ['keyword' => 'user_not_found', 'value' => 'المستخدم غير موجود.'],
            ['keyword' => 'account_deleted_successfully', 'value' => 'تم حذف الحساب بنجاح.'],
            ['keyword' => 'google_login_disabled', 'value' => 'تسجيل الدخول عبر جوجل معطل'],
            ['keyword' => 'google_login_failed', 'value' => 'فشل تسجيل الدخول عبر جوجل'],
            ['keyword' => 'phone_number_must_be_exactly_10_digits', 'value' => 'يجب أن يكون رقم الهاتف 10 أرقام بالضبط.'],
            ['keyword' => 'phone_number_must_contain_only_numbers', 'value' => 'يجب أن يحتوي رقم الهاتف على أرقام فقط.'],
            ['keyword' => 'phone_must_be_exactly_10_digits', 'value' => 'يجب أن يكون رقم الهاتف 10 أرقام بالضبط'],
            ['keyword' => 'phone_must_contain_only_numbers', 'value' => 'يجب أن يحتوي رقم الهاتف على أرقام فقط'],
            ['keyword' => 'image_must_be_jpg_jpeg_or_png_only', 'value' => 'يجب أن تكون الصورة من نوع jpg أو jpeg أو png فقط'],
            ['keyword' => 'image_size_must_not_exceed_2mb', 'value' => 'يجب ألا يتجاوز حجم الصورة 2 ميغابايت'],
            ['keyword' => 'profile_updated_successfully', 'value' => 'تم تحديث الملف الشخصي بنجاح.'],
            ['keyword' => 'documents_uploaded_successfully', 'value' => 'تم رفع المستندات بنجاح.'],
            ['keyword' => 'file_size_must_not_exceed_4mb', 'value' => 'يجب ألا يتجاوز حجم الملف 4 ميغابايت'],
            ['keyword' => 'message_sent_successfully', 'value' => 'تم إرسال الرسالة بنجاح'],
            ['keyword' => 'cannot_chat_on_own_item', 'value' => 'لا يمكنك الدردشة على عنصرك الخاص'],
            ['keyword' => 'invalid_package', 'value' => 'باقة غير صالحة'],
            ['keyword' => 'unable_to_create_order', 'value' => 'غير قادر على إنشاء الطلب'],
            ['keyword' => 'stripe_not_available_for_this_currency', 'value' => 'سترايب غير متاحة لهذه العملة'],
            ['keyword' => 'payment_initialization_failed', 'value' => 'فشل تهيئة الدفع'],
            ['keyword' => 'payment_not_completed', 'value' => 'الدفع غير مكتمل'],
            ['keyword' => 'payment_verification_failed', 'value' => 'فشل التحقق من الدفع'],
            ['keyword' => 'webhook_failed', 'value' => 'فشل Webhook'],
            ['keyword' => 'listing_posted_successfully', 'value' => 'تم نشر القائمة بنجاح'],
            ['keyword' => 'item_not_found', 'value' => 'العنصر غير موجود'],
            ['keyword' => 'item_not_available_in_your_area', 'value' => 'العنصر غير متوفر في منطقتك'],
            ['keyword' => 'you_already_reported_this_item', 'value' => 'لقد قمت بالفعل بالإبلاغ عن هذا العنصر.'],
            ['keyword' => 'item_reported_successfully', 'value' => 'تم الإبلاغ عن العنصر بنجاح.'],
            ['keyword' => 'something_went_wrong', 'value' => 'حدث خطأ ما.'],
            ['keyword' => 'something_went_wrong_try_again', 'value' => 'حدث خطأ ما. يرجى المحاولة مرة أخرى.'],
            ['keyword' => 'welcome_to_reowned', 'value' => 'مرحباً بك في Reowned'],
            ['keyword' => 'lets_create_your_account', 'value' => 'دعنا ننشئ حسابك'],
            ['keyword' => 'type_name', 'value' => 'أدخل الاسم'],
            ['keyword' => 'phone_number', 'value' => 'رقم الهاتف'],
            ['keyword' => 'enter_phone_number', 'value' => 'رقم الهاتف'],
            ['keyword' => 'enter_your_password', 'value' => 'أدخل كلمة المرور الخاصة بك'],
            ['keyword' => 'signup', 'value' => 'اشتراك'],
            ['keyword' => 'sign_in_with_google', 'value' => 'تسجيل الدخول عبر جوجل'],
            ['keyword' => 'login_to_reowned', 'value' => 'تسجيل الدخول إلى Reowned'],
            ['keyword' => 'welcome_back_enter_details', 'value' => 'مرحباً بعودتك، يرجى إدخال تفاصيلك'],
            ['keyword' => 'login', 'value' => 'تسجيل الدخول'],
            ['keyword' => 'youve_got_mail', 'value' => 'لديك بريد!'],
            ['keyword' => 'click_the_link_in_your_email', 'value' => 'انقر على الرابط في بريدك الإلكتروني لتأكيد حسابك.'],
            ['keyword' => 'name', 'value' => 'الاسم'],
            ['keyword' => 'email', 'value' => 'البريد الإلكتروني'],
            ['keyword' => 'password', 'value' => 'كلمة المرور'],
            ['keyword' => 'enter_your_email', 'value' => 'أدخل بريدك الإلكتروني'],
            ['keyword' => 'enter_valid_email_address', 'value' => 'أدخل عنوان بريد إلكتروني صالح'],
            ['keyword' => 'name_minimum_characters', 'value' => 'يجب أن يتكون الاسم من 3 أحرف على الأقل'],
            ['keyword' => 'phone_number_exact_digits', 'value' => 'يجب أن يكون رقم الهاتف 10 أرقام بالضبط'],
            ['keyword' => 'password_minimum_length', 'value' => 'يجب أن تتكون كلمة المرور من 8 أحرف على الأقل'],
            ['keyword' => 'submitting', 'value' => 'جاري الإرسال...'],
            ['keyword' => 'logging_in', 'value' => 'جاري تسجيل الدخول...'],
            ['keyword' => 'email_already_registered', 'value' => 'البريد الإلكتروني مسجل بالفعل'],
            ['keyword' => 'login_required', 'value' => 'تسجيل الدخول مطلوب'],
            ['keyword' => 'login_to_add_items_wishlist', 'value' => 'يرجى تسجيل الدخول لإضافة عناصر إلى قائمة رغباتك'],
            ['keyword' => 'all_subcategory', 'value' => 'جميع الفئات الفرعية'],
            ['keyword' => 'no_subcategories_found', 'value' => 'لم يتم العثور على فئات فرعية.'],
            ['keyword' => 'saving_changes', 'value' => 'جاري الحفظ...'],
            ['keyword' => 'uploading', 'value' => 'جاري الرفع...'],
            ['keyword' => 'location', 'value' => 'الموقع'],
            ['keyword' => 'budget', 'value' => 'الميزانية'],
            ['keyword' => 'choose_range', 'value' => 'اختر نطاقاً أدناه'],
            ['keyword' => 'apply', 'value' => 'تطبيق'],
            ['keyword' => 'date_posted', 'value' => 'تاريخ النشر'],
            ['keyword' => 'all_time', 'value' => 'كل الأوقات'],
            ['keyword' => 'today', 'value' => 'اليوم'],
            ['keyword' => 'last_7_days', 'value' => 'آخر 7 أيام'],
            ['keyword' => 'last_30_days', 'value' => 'آخر 30 يوماً'],
            ['keyword' => 'nearby_km_range', 'value' => 'القريبة (نطاق الكيلومترات)'],
            ['keyword' => 'items', 'value' => 'العناصر'],
            ['keyword' => 'newest_to_oldest', 'value' => 'من الأحدث إلى الأقدم'],
            ['keyword' => 'low_to_high', 'value' => 'من الأقل إلى الأعلى'],
            ['keyword' => 'high_to_low', 'value' => 'من الأعلى إلى الأقل'],
            ['keyword' => 'oldest_to_newest', 'value' => 'من الأقدم إلى الأحدث'],
            ['keyword' => 'list_view', 'value' => 'عرض القائمة'],
            ['keyword' => 'grid_view', 'value' => 'عرض الشبكة'],
            ['keyword' => 'save', 'value' => 'حفظ'],
            array(
                'keyword' => 'edit_listing',
                'value' => 'تعديل القائمة'
            ),
            array(
                'keyword' => 'update_listing',
                'value' => 'تحديث القائمة'
            ),
            array(
                'keyword' => 'category',
                'value' => 'الفئة'
            ),
            array(
                'keyword' => 'item_sold_msg',
                'value' => 'هذا العنصر قد تم بيعه بالفعل'
            ),
            array(
                'keyword' => 'item_already_sold_msg',
                'value' => 'تم تحديد العنصر كـ "تم بيعه" بالفعل'
            ),
            array(
                'keyword' => 'item_marked_sold_success_msg',
                'value' => 'تم تحديد العنصر كـ "تم بيعه" بنجاح'
            ),
            array(
                'keyword' => 'listing_update_success_msg',
                'value' => 'تم تحديث القائمة بنجاح'
            ),
            array(
                'keyword' => 'mark_as_sold_swal_msg',
                'value' => 'هل تريد تحديد هذا العنصر كـ "تم بيعه"؟'
            ),
            array(
                'keyword' => 'mark_as_sold_swal_btn_text',
                'value' => 'نعم، حدد كـ "تم بيعه"!'
            ),
            array(
                'keyword' => 'approved_items_can_be_marked_as_sold',
                'value' => 'فقط العناصر الموافق عليها يمكن تحديدها كـ "تم بيعه"'
            ),
            array(
                'keyword' => 'make_an_offer',
                'value' => 'تقديم عرض'
            ),
            array(
                'keyword' => 'tips',
                'value' => 'نصائح'
            ),
            array(
                'keyword' => 'no_tips_found',
                'value' => 'لا توجد نصائح'
            ),
            ['keyword' => 'signin_footer_msg', 'value' => 'بتسجيل الدخول إلى حسابك، فإنك توافق على شروط Reowned'],

            array(
                'keyword' => 'published',
                'value' => 'منشور'
            ),
            array(
                'keyword' => 'mark_as_sold',
                'value' => 'تحديد كـ "تم البيع"'
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
                'keyword' => 'delete_item_swal_msg',
                'value' => 'تم حذف العنصر بنجاح!'
            ),
            array(
                'keyword' => 'yes_delete_it',
                'value' => 'نعم، احذفه!'
            ),
            array(
                'keyword' => 'deleted',
                'value' => 'تم الحذف!'
            ),
            array(
                'keyword' => 'error',
                'value' => 'خطأ'
            ),
            array(
                'keyword' => 'unauthorized_action',
                'value' => 'إجراء غير مصرح به'
            ),
            array(
                'keyword' => 'item_delete_success_msg',
                'value' => 'تم حذف العنصر بنجاح'
            ),
            array(
                'keyword' => 'active',
                'value' => 'نشط'
            ),

            array(
                'keyword' => 'expire_on',
                'value' => 'تنتهي في'
            ),
            array(
                'keyword' => 'please_purchase_item_plan_first',
                'value' => 'يرجى شراء خطة العناصر أولاً'
            ),
            array(
                'keyword' => 'item_limit_exhausted',
                'value' => 'تم استنفاد حد العناصر'
            ),
            array(
                'keyword' => 'no_active_plan',
                'value' => 'لا توجد خطة نشطة'
            ),
            array(
                'keyword' => 'please_purchase_a_plan_to_add_listing',
                'value' => 'يرجى شراء خطة لإضافة قائمة'
            ),
            array(
                'keyword' => 'view_package',
                'value' => 'عرض الباقة'
            ),
            array(
                'keyword' => 'limit_reached',
                'value' => 'تم الوصول إلى الحد الأقصى'
            ),
            array(
                'keyword' => 'your_plan_limit_is_over_please_upgrade_your_plan',
                'value' => 'لقد انتهى حد خطتك. يرجى ترقية خطتك'
            ),
            array(
                'keyword' => 'upgrade_plan',
                'value' => 'ترقية الخطة'
            ),
            array(
                'keyword' => 'limit_already_reached',
                'value' => 'تم الوصول إلى الحد الأقصى بالفعل'
            ),

            array(
                'keyword' => 'account_detail',
                'value' => 'تفاصيل الحساب'
            ),
            array(
                'keyword' => 'account_information',
                'value' => 'معلومات الحساب'
            ),
            array(
                'keyword' => 'live_ads',
                'value' => 'إعلانات مباشرة'
            ),
            array(
                'keyword' => 'no_item_found',
                'value' => 'لم يتم العثور على عناصر'
            ),

            array(
                'keyword' => 'valid_till',
                'value' => 'صالح حتى'
            ),

        ];

        $languages = Language::where('code','ar')->get();

        foreach ($languages as $language) {

            Translation::where('group','website')
                ->where('language_id',$language->id)
                ->delete();

            foreach ($dp_translations as $value) {

                Translation::create([
                    'language_id' => $language->id,
                    'group' => 'website',
                    'keyword' => $value['keyword'],
                    'value' => $value['value'],
                ]);
            }
        }
    }
}
