<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Translation;
use App\Models\Language;

class TranslationWebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
       $dp_translations = [
            ['keyword' => 'select_location', 'value' => 'Select Location'],
            ['keyword' => 'all_categories', 'value' => 'All Categories'],
            ['keyword' => 'more', 'value' => 'More'],
            ['keyword' => 'register', 'value' => 'Register'],
            ['keyword' => 'login', 'value' => 'Login'],
            ['keyword' => 'sell', 'value' => 'Sell'],
            ['keyword' => 'other', 'value' => 'Other'],
            ['keyword' => 'select_location', 'value' => 'Select Location'],
            ['keyword' => 'copyright', 'value' => 'Copyright©'],
            ['keyword' => 'all_rights_reserved', 'value' => 'All Rights Reserved'],
            ['keyword' => 'explore_popular_categories', 'value' => 'Explore Popular Categories'],
            ['keyword' => 'recommendations', 'value' => 'Recommendations'],
            ['keyword' => 'view_all', 'value' => 'View All'],
            ['keyword' => 'popular_items', 'value' => 'Popular Items'],
            ['keyword' => 'all_item', 'value' => 'All Items'],
            ['keyword' => 'category', 'value' => 'Category'],
            ['keyword' => 'load_more', 'value' => 'Load More'],
            ['keyword' => 'price_low_to_high', 'value' => 'Price - Low to High'],
            ['keyword' => 'low_to_high', 'value' => 'Low to High'],
            ['keyword' => 'high_to_low', 'value' => 'High to Low'],
            ['keyword' => 'oldest_to_newest', 'value' => 'Oldest to Newest'],
            ['keyword' => 'newest_to_oldest', 'value' => 'Newest to Oldest'],
            ['keyword' => 'home', 'value' => 'Home'],
            ['keyword' => 'search_result', 'value' => 'Search Result'],
            ['keyword' => 'filters', 'value' => 'Filters'],
            ['keyword' => 'recommended_for_you', 'value' => 'Recommended For You'],
            ['keyword' => 'popular_in_your_area', 'value' => 'Popular In Your Area'],
            ['keyword' => 'all_items', 'value' => 'All Items'],
            ['keyword' => 'item_lists', 'value' => 'Item Lists'],
            ['keyword' => 'description', 'value' => 'Description'],
            ['keyword' => 'highlights', 'value' => 'Highlights'],
            ['keyword' => 'facebook', 'value' => 'Facebook'],
            ['keyword' => 'x', 'value' => 'X'],
            ['keyword' => 'whatsApp', 'value' => 'WhatsApp'],
            ['keyword' => 'copy_link', 'value' => 'Copy Link'],
            ['keyword' => 'report', 'value' => 'Report'],
            ['keyword' => 'copied', 'value' => 'Copied'],
            ['keyword' => 'link_copied_to_clipboard', 'value' => 'Link copied to clipboard'],
            ['keyword' => 'pricing_plans', 'value' => 'Pricing Plans'],
            ['keyword' => 'ad_listing_plan', 'value' => 'Ad Listing Plan'],
            ['keyword' => 'featured_ad_plan', 'value' => 'Featured Ad Plan'],
            ['keyword' => 'free', 'value' => 'Free'],
            ['keyword' => 'choose_plan', 'value' => 'Choose Plan'],
            ['keyword' => 'no_packages_found', 'value' => 'No Packages Found'],
            ['keyword' => 'payment_with', 'value' => 'Payment With'],
            ['keyword' => 'razorpay', 'value' => 'Razorpay'],
            ['keyword' => 'stripe', 'value' => 'Stripe'],
            ['keyword' => 'stripe_available_only_for_USD_payments', 'value' => 'Stripe available only for USD payments'],
            ['keyword' => 'paypal', 'value' => 'PayPal'],
            ['keyword' => 'please_select_a_package', 'value' => 'Please select a package'],
            ['keyword' => 'total_ads', 'value' => 'Total Ads'],
            ['keyword' => 'not_ads_found', 'value' => 'No Ads Found'],
            ['keyword' => 'not_ads_found_description', 'value' => 'There are currently no ads available. Start by creating your first ad now!'],
            ['keyword' => 'newest', 'value' => 'Newest'],
            ['keyword' => 'price_high_to_low', 'value' => 'Price High → Low'],
            ['keyword' => 'all', 'value' => 'All'],
            ['keyword' => 'under_review', 'value' => 'Under Review'],
            ['keyword' => 'live', 'value' => 'Live'],
            ['keyword' => 'rejected', 'value' => 'Rejected'],
            ['keyword' => 'sold', 'value' => 'Sold'],
            ['keyword' => 'no_transactions_found', 'value' => 'No Transactions Found'],
            ['keyword' => 'showing', 'value' => 'Showing'],
            ['keyword' => 'of', 'value' => 'Of'],
            ['keyword' => 'to', 'value' => 'To'],
            ['keyword' => 'entries', 'value' => 'Entries'],
            ['keyword' => 'success', 'value' => 'Success'],
            ['keyword' => 'failed', 'value' => 'Failed'],
            ['keyword' => 'pending', 'value' => 'Pending'],
            ['keyword' => 'select_category', 'value' => 'Select Category'],
            ['keyword' => 'all_category', 'value' => 'All Category'],
            ['keyword' => 'all_subcategory', 'value' => 'All Subcategory'],
            ['keyword' => 'ad_listing', 'value' => 'Ad Listing'],
            ['keyword' => 'selected_category', 'value' => 'Selected Category'],
            ['keyword' => 'include_some_details', 'value' => 'Include some details'],
            ['keyword' => 'ad_title', 'value' => 'Ad title'],
            ['keyword' => 'ad_title_placeholder', 'value' => 'Mention the key features of your item (e.g. brand, model, age, type)'],
            ['keyword' => 'description', 'value' => 'Description'],
            ['keyword' => 'description_placeholder', 'value' => 'Mention the key features of your item (e.g. brand, model, age, type)'],
            ['keyword' => 'set_a_price', 'value' => 'Set a price'],
            ['keyword' => 'price', 'value' => 'Price'],
            ['keyword' => 'upload_photos', 'value' => 'Upload up to 20 photos'],
            ['keyword' => 'main_picture', 'value' => 'Main picture'],
            ['keyword' => 'drag_drop', 'value' => 'Drag & Drop your files or'],
            ['keyword' => 'upload', 'value' => 'Upload'],
            ['keyword' => 'confirm_location', 'value' => 'Confirm your location'],
            ['keyword' => 'area', 'value' => 'Area'],
            ['keyword' => 'enter_area', 'value' => 'Enter your area'],
            ['keyword' => 'post_now', 'value' => 'Post Now'],
            ['keyword' => 'select', 'value' => 'Select'],
            ['keyword' => 'home', 'value' => 'Home'],
            ['keyword' => 'home_appliances', 'value' => 'Home Appliances'],
            ['keyword' => 'contact_us', 'value' => 'Contact Us'],
            ['keyword' => 'faqs', 'value' => 'FAQs'],
            ['keyword' => 'chat', 'value' => 'Chat'],
            ['keyword' => 'blocked_users', 'value' => 'Blocked Users'],
            ['keyword' => 'selling', 'value' => 'Selling'],
            ['keyword' => 'buying', 'value' => 'Buying'],
            ['keyword' => 'no_user_found', 'value' => 'No user found...'],
            ['keyword' => 'no_selling_users_found', 'value' => 'No selling users found...'],
            ['keyword' => 'no_buying_users_found', 'value' => 'No buying users found...'],
            ['keyword' => 'no_chat_data_found', 'value' => 'No Chat data found'],
            ['keyword' => 'item_name', 'value' => 'Item Name :- '],
            ['keyword' => 'no_message_yet', 'value' => 'No message yet'],
            ['keyword' => 'sign_out', 'value' => 'Sign out'],
            ['keyword' => 'delete_account', 'value' => 'Delete Account'],
            ['keyword' => 'setting', 'value' => 'Setting'],
            ['keyword' => 'edit_profile', 'value' => 'Edit profile'],
            ['keyword' => 'get_verification_badge', 'value' => 'Get Verification Badge'],
            ['keyword' => 'notifications', 'value' => 'Notifications'],
            ['keyword' => 'subscription', 'value' => 'Subscription'],
            ['keyword' => 'ads', 'value' => 'Ads'],
            ['keyword' => 'favorites', 'value' => 'Favorites'],
            ['keyword' => 'transaction', 'value' => 'Transaction'],
            ['keyword' => 'quick_links', 'value' => 'Quick links'],
            ['keyword' => 'legal', 'value' => 'Legal'],
            ['keyword' => 'get_in_touch', 'value' => 'Get in touch'],
            ['keyword' => 'edit_location', 'value' => 'Edit location'],
            ['keyword' => 'current_location', 'value' => 'Current location'],
            ['keyword' => 'search_city_area', 'value' => 'Search city / area'],
            ['keyword' => 'km_range', 'value' => 'KM Range'],
            ['keyword' => 'search_placeholder', 'value' => 'Search...'],
            ['keyword' => 'contact_description', 'value' => 'Get in touch with us! whether you have questions, feedback, or just want to hello, our contact page is the gateway to reaching our team.'],
            ['keyword' => 'enter_name', 'value' => 'Enter name'],
            ['keyword' => 'enter_email', 'value' => 'Enter email'],
            ['keyword' => 'enter_subject', 'value' => 'Enter subject'],
            ['keyword' => 'enter_message', 'value' => 'Enter message'],
            ['keyword' => 'submit', 'value' => 'Submit'],
            ['keyword' => 'name_required', 'value' => 'Name is required'],
            ['keyword' => 'email_required', 'value' => 'Email is required'],
            ['keyword' => 'enter_valid_email', 'value' => 'Enter valid email'],
            ['keyword' => 'subject_required', 'value' => 'Subject is required'],
            ['keyword' => 'message_required', 'value' => 'Message is required'],
            ['keyword' => 'verify', 'value' => 'Verify'],
            ['keyword' => 'user_verification', 'value' => 'User verification'],
            ['keyword' => 'id_proof_front', 'value' => 'ID Proof (Front)'],
            ['keyword' => 'id_proof_back', 'value' => 'ID Proof (Back)'],
            ['keyword' => 'allowed_file_types', 'value' => 'Allowed file types: PNG,JPG,JPEG,SVG,PDF'],
            ['keyword' => 'save_changes', 'value' => 'Save changes'],
            ['keyword' => 'personal_info', 'value' => 'Personal Info'],
            ['keyword' => 'edit_your_personal_information', 'value' => 'Edit your Personal Information'],
            ['keyword' => 'name_placeholder', 'value' => 'Esther Howard'],
            ['keyword' => 'email_placeholder', 'value' => 'estherhaward@gmail.com'],
            ['keyword' => 'phone', 'value' => 'Phone'],
            ['keyword' => 'phone_placeholder', 'value' => '98765 43210'],
            ['keyword' => 'notification', 'value' => 'Notification'],
            ['keyword' => 'address', 'value' => 'Address'],
            ['keyword' => 'edit_your_address', 'value' => 'Edit your address'],
            ['keyword' => 'address_placeholder', 'value' => 'Enter your address'],
            ['keyword' => 'start_chat', 'value' => 'Start chat'],
            ['keyword' => 'call', 'value' => 'Call'],
            ['keyword' => 'posted_in', 'value' => 'Posted in'],
            ['keyword' => 'view_on_google_map', 'value' => 'View on Google map'],
            ['keyword' => 'did_you_find_problem', 'value' => 'Did you find any problem with this item?'],
            ['keyword' => 'ad_name', 'value' => 'Ad name'],
            ['keyword' => 'report_this_ad', 'value' => 'Report this ad'],
            ['keyword' => 'related_ads', 'value' => 'Related Ads'],
            ['keyword' => 'unblock', 'value' => 'Unblock'],
            ['keyword' => 'block', 'value' => 'Block'],
            ['keyword' => 'start_conversation', 'value' => 'Start conversation'],
            ['keyword' => 'typing', 'value' => 'Typing...'],
            ['keyword' => 'type_a_message', 'value' => 'Type a message...'],
            ['keyword' => 'no_favorites_items_found', 'value' => 'No favourite items found'],
            ['keyword' => 'sell', 'value' => 'Sell'],
            ['keyword' => 'add_listing', 'value' => 'Add listing'],
            ['keyword' => 'add', 'value' => 'Add'],
            ['keyword' => 'date', 'value' => 'Date'],
            ['keyword' => 'id', 'value' => 'ID'],
            ['keyword' => 'package_detail', 'value' => 'Package Detail'],
            ['keyword' => 'payment_method', 'value' => 'Payment Method'],
            ['keyword' => 'transaction_id', 'value' => 'Transaction ID'],
            ['keyword' => 'price', 'value' => 'Price'],
            ['keyword' => 'status', 'value' => 'Status'],
            ['keyword' => 'posted_on', 'value' => 'Posted on :'],
            ['keyword' => 'you_blocked_this_user', 'value' => 'You blocked this user'],
            ['keyword' => 'user_unblocked', 'value' => 'User unblocked!!'],
            ['keyword' => 'user_blocked', 'value' => 'User blocked!!'],
            ['keyword' => 'are_you_sure', 'value' => 'Are you sure?'],
            ['keyword' => 'your_ads_transactions_history_deleted', 'value' => 'Your ads and transactions history will be deleted'],
            ['keyword' => 'accounts_details_cant_be_recovered', 'value' => 'Account details can\'t be recovered'],
            ['keyword' => 'subscriptions_will_be_cancelled', 'value' => 'Subscriptions will be cancelled'],
            ['keyword' => 'saved_preferences_and_messages_lost', 'value' => 'Saved preferences and messages will be lost'],
            ['keyword' => 'cancel', 'value' => 'Cancel'],
            ['keyword' => 'yes', 'value' => 'Yes'],
            ['keyword' => 'are_you_sure_to_sign_out', 'value' => 'Are you sure you want to Sign out?'],
            ['keyword' => 'payment_successful', 'value' => 'Payment Successful ✅'],
            ['keyword' => 'payment_failed', 'value' => 'Payment Failed ❌'],
            ['keyword' => 'account_not_exists', 'value' => 'Account does not exist'],
            ['keyword' => 'registration_successful_check_email', 'value' => 'Registration successful! Please check your email.'],
            ['keyword' => 'registration_failed_email_sending_failed', 'value' => 'Registration failed! Email sending failed. Please try again later.'],
            ['keyword' => 'invalid_verification_link', 'value' => 'Invalid verification link.'],
            ['keyword' => 'verification_link_expired', 'value' => 'Verification link expired.'],
            ['keyword' => 'account_already_verified', 'value' => 'Account already verified.'],
            ['keyword' => 'account_verified_successfully', 'value' => 'Your account has been verified successfully!'],
            ['keyword' => 'email_not_registered', 'value' => 'Email not registered.'],
            ['keyword' => 'account_has_been_deleted', 'value' => 'This account has been deleted.'],
            ['keyword' => 'unauthorized_access', 'value' => 'Unauthorized access.'],
            ['keyword' => 'please_verify_your_email_first', 'value' => 'Please verify your email first.'],
            ['keyword' => 'incorrect_password', 'value' => 'Incorrect password.'],
            ['keyword' => 'login_successful', 'value' => 'Login successful!'],
            ['keyword' => 'logged_out_successfully', 'value' => 'Logged out successfully.'],
            ['keyword' => 'user_not_found', 'value' => 'User not found.'],
            ['keyword' => 'account_deleted_successfully', 'value' => 'Account deleted successfully.'],
            ['keyword' => 'google_login_disabled', 'value' => 'Google login disabled'],
            ['keyword' => 'google_login_failed', 'value' => 'Google login failed'],
            ['keyword' => 'phone_number_must_be_exactly_10_digits', 'value' => 'Phone number must be exactly 10 digits.'],
            ['keyword' => 'phone_number_must_contain_only_numbers', 'value' => 'Phone number must contain only numbers.'],
            ['keyword' => 'phone_must_be_exactly_10_digits', 'value' => 'Phone must be exactly 10 digits'],
            ['keyword' => 'phone_must_contain_only_numbers', 'value' => 'Phone must contain only numbers'],
            ['keyword' => 'image_must_be_jpg_jpeg_or_png_only', 'value' => 'Image must be jpg, jpeg or png only'],
            ['keyword' => 'image_size_must_not_exceed_2mb', 'value' => 'Image size must not exceed 2MB'],
            ['keyword' => 'profile_updated_successfully', 'value' => 'Profile updated successfully.'],
            ['keyword' => 'documents_uploaded_successfully', 'value' => 'Documents uploaded successfully.'],
            ['keyword' => 'file_size_must_not_exceed_4mb', 'value' => 'File size must not exceed 4MB'],
            ['keyword' => 'message_sent_successfully', 'value' => 'Message sent successfully'],
            ['keyword' => 'cannot_chat_on_own_item', 'value' => 'You cannot chat on your own item'],
            ['keyword' => 'invalid_package', 'value' => 'Invalid package'],
            ['keyword' => 'unable_to_create_order', 'value' => 'Unable to create order'],
            ['keyword' => 'stripe_not_available_for_this_currency', 'value' => 'Stripe not available for this currency'],
            ['keyword' => 'payment_initialization_failed', 'value' => 'Payment initialization failed'],
            ['keyword' => 'payment_not_completed', 'value' => 'Payment not completed'],
            ['keyword' => 'payment_verification_failed', 'value' => 'Payment verification failed'],
            ['keyword' => 'webhook_failed', 'value' => 'Webhook failed'],
            ['keyword' => 'listing_posted_successfully', 'value' => 'Listing Posted Successfully'],
            ['keyword' => 'item_not_found', 'value' => 'Item not found'],
            ['keyword' => 'item_not_available_in_your_area', 'value' => 'Item not available in your area'],
            ['keyword' => 'you_already_reported_this_item', 'value' => 'You already reported this item.'],
            ['keyword' => 'item_reported_successfully', 'value' => 'Item reported successfully.'],
            ['keyword' => 'something_went_wrong', 'value' => 'Something went wrong.'],
            ['keyword' => 'something_went_wrong_try_again', 'value' => 'Something went wrong. Please try again.'],
            ['keyword' => 'welcome_to_reowned', 'value' => 'Welcome to Reowned'],
            ['keyword' => 'lets_create_your_account', 'value' => 'Let\'s create your account'],
            ['keyword' => 'type_name', 'value' => 'Type name'],
            ['keyword' => 'phone_number', 'value' => 'Phone Number'],
            ['keyword' => 'enter_phone_number', 'value' => 'Phone Number'],
            ['keyword' => 'enter_your_password', 'value' => 'Enter your password'],
            ['keyword' => 'signup', 'value' => 'Signup'],
            ['keyword' => 'sign_in_with_google', 'value' => 'Sign in with Google'],
            ['keyword' => 'login_to_reowned', 'value' => 'Login to Reowned'],
            ['keyword' => 'welcome_back_enter_details', 'value' => 'Welcome back, please enter your details'],
            ['keyword' => 'login', 'value' => 'Login'],
            ['keyword' => 'youve_got_mail', 'value' => 'You’ve got mail!'],
            ['keyword' => 'click_the_link_in_your_email', 'value' => 'Click the link in your email to verify your account.'],
            ['keyword' => 'name', 'value' => 'Name'],
            ['keyword' => 'email', 'value' => 'Email'],
            ['keyword' => 'password', 'value' => 'Password'],
            ['keyword' => 'enter_your_email', 'value' => 'Enter your email'],
            ['keyword' => 'enter_valid_email_address', 'value' => 'Enter a valid email address'],
            ['keyword' => 'name_minimum_characters', 'value' => 'Name must be at least 3 characters'],
            ['keyword' => 'phone_number_exact_digits', 'value' => 'Phone number must be exactly 10 digits'],
            ['keyword' => 'password_minimum_length', 'value' => 'Password must be minimum 8 characters'],
            ['keyword' => 'submitting', 'value' => 'Submitting...'],
            ['keyword' => 'logging_in', 'value' => 'Logging in...'],
            ['keyword' => 'email_already_registered', 'value' => 'Email already registered'],
            ['keyword' => 'login_required', 'value' => 'Login Required'],
            ['keyword' => 'login_to_add_items_wishlist', 'value' => 'Please login to add items to your wishlist'],
            ['keyword' => 'all_subcategory', 'value' => 'All Subcategory'],
            ['keyword' => 'no_subcategories_found', 'value' => 'No subcategories found.'],
            ['keyword' => 'saving_changes', 'value' => 'Saving...'],
            ['keyword' => 'uploading', 'value' => 'Uploading...'],
            ['keyword' => 'location', 'value' => 'Location'],
            ['keyword' => 'budget', 'value' => 'Budget'],
            ['keyword' => 'choose_range', 'value' => 'Choose a range below'],
            ['keyword' => 'apply', 'value' => 'Apply'],
            ['keyword' => 'date_posted', 'value' => 'Date Posted'],
            ['keyword' => 'all_time', 'value' => 'All Time'],
            ['keyword' => 'today', 'value' => 'Today'],
            ['keyword' => 'last_7_days', 'value' => 'Last 7 Days'],
            ['keyword' => 'last_30_days', 'value' => 'Last 30 Days'],
            ['keyword' => 'nearby_km_range', 'value' => 'Nearby (KM Range)'],
            ['keyword' => 'items', 'value' => 'Items'],
            ['keyword' => 'newest_to_oldest', 'value' => 'Newest to Oldest'],
            ['keyword' => 'low_to_high', 'value' => 'Low to High'],
            ['keyword' => 'high_to_low', 'value' => 'High to Low'],
            ['keyword' => 'oldest_to_newest', 'value' => 'Oldest to Newest'],
            ['keyword' => 'list_view', 'value' => 'List View'],
            ['keyword' => 'grid_view', 'value' => 'Grid View'],
            ['keyword' => 'save', 'value' => 'Save'],

            array(
                'keyword' => 'edit_listing',
                'value' => 'Edit Listing'
            ),
            array(
                'keyword' => 'update_listing',
                'value' => 'Update Listing'
            ),
            array(
                'keyword' => 'category',
                'value' => 'Category'
            ),
            array(
                'keyword' => 'item_sold_msg',
                'value' => 'This Item Is Already Sold'
            ),
            array(
                'keyword' => 'item_already_sold_msg',
                'value' => 'Item Already Marked As Sold'
            ),
            array(
                'keyword' => 'item_marked_sold_success_msg',
                'value' => 'Item Marked As Sold Successfully'
            ),
            array(
                'keyword' => 'listing_update_success_msg',
                'value' => 'Listing Updated Successfully'
            ),
            array(
                'keyword' => 'mark_as_sold_swal_msg',
                'value' => 'You Want To Mark This Item As Sold'
            ),
            array(
                'keyword' => 'mark_as_sold_swal_btn_text',
                'value' => 'Yes, Mark As Sold!'
            ),
            array(
                'keyword' => 'approved_items_can_be_marked_as_sold',
                'value' => 'Only Approved Items Can Be Marked As Sold'
            ),
            array(
                'keyword' => 'make_an_offer',
                'value' => 'Make An Offer'
            ),
            array(
                'keyword' => 'tips',
                'value' => 'Tips'
            ),
            array(
                'keyword' => 'no_tips_found',
                'value' => 'No Tips Found'
            ),

            ['keyword' => 'signin_footer_msg', 'value' => 'By signing in to your account you agree to Reowned'],

            array(
                'keyword' => 'published',
                'value' => 'Published'
            ),
            array(
                'keyword' => 'mark_as_sold',
                'value' => 'Mark As Sold'
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
                'keyword' => 'delete_item_swal_msg',
                'value' => 'You Won\'t Be Able To Recover This Item!'
            ),
            array(
                'keyword' => 'yes_delete_it',
                'value' => 'Yes, Delete It!'
            ),
            array(
                'keyword' => 'deleted',
                'value' => 'Deleted!'
            ),
            array(
                'keyword' => 'error',
                'value' => 'Error'
            ),
            array(
                'keyword' => 'unauthorized_action',
                'value' => 'Unauthorized Action'
            ),
            array(
                'keyword' => 'item_delete_success_msg',
                'value' => 'Item Delete Successfully!'
            ),
            array(
                'keyword' => 'active',
                'value' => 'Active'
            ),

            array(
                'keyword' => 'expire_on',
                'value' => 'Expire On'
            ),
            array(
                'keyword' => 'please_purchase_item_plan_first',
                'value' => 'Please Purchase Item Plan First'
            ),
            array(
                'keyword' => 'item_limit_exhausted',
                'value' => 'Item Limit Exhausted'
            ),
            array(
                'keyword' => 'no_active_plan',
                'value' => 'No Active Plan'
            ),
            array(
                'keyword' => 'please_purchase_a_plan_to_add_listing',
                'value' => 'Please Purchase A Plan To Add Listing'
            ),
            array(
                'keyword' => 'view_package',
                'value' => 'View Package'
            ),
            array(
                'keyword' => 'limit_reached',
                'value' => 'Limit Reached'
            ),
            array(
                'keyword' => 'your_plan_limit_is_over_please_upgrade_your_plan',
                'value' => 'Your Plan Limit Is Over. Please Upgrade Your Plan'
            ),
            array(
                'keyword' => 'upgrade_plan',
                'value' => 'Upgrade Plan'
            ),
            array(
                'keyword' => 'limit_already_reached',
                'value' => 'Limit Already Reached'
            ),
            array(
                'keyword' => 'account_detail',
                'value' => 'Account Detail'
            ),
            array(
                'keyword' => 'account_information',
                'value' => 'Account Information'
            ),
            array(
                'keyword' => 'live_ads',
                'value' => 'Live Ads'
            ),
            array(
                'keyword' => 'no_item_found',
                'value' => 'No Item Found'
            ),

            array(
                'keyword' => 'validity',
                'value' => 'Validity'
            ),
            array(
                'keyword' => 'verified',
                'value' => 'Verified'
            ),
            
            array(
                'keyword' => 'forgot_password',
                'value' => 'Forgot Password'
            ),
            array(
                'keyword' => 'enter_your_email',
                'value' => 'Enter Your Email'
            ),
            array(
                'keyword' => 'email',
                'value' => 'Email'
            ),
            array(
                'keyword' => 'submit',
                'value' => 'Submit'
            ),
            array(
                'keyword' => 'email_required',
                'value' => 'Email Is Required'
            ),
            array(
                'keyword' => 'invalid_email',
                'value' => 'Invalid Email Address'
            ),
            array(
                'keyword' => 'email_not_found',
                'value' => 'Email Not Found'
            ),
            array(
                'keyword' => 'reset_password_subject',
                'value' => 'Reset Your Password - Reowned'
            ),
            array(
                'keyword' => 'reset_password_email_message',
                'value' => 'Click The Button Below To Reset Your Password.'
            ),
            array(
                'keyword' => 'reset_link_sent',
                'value' => 'Password Reset Link Sent To Your Email'
            ),
            array(
                'keyword' => 'click_here_to_reset_password',
                'value' => 'Click Here To Reset Password'
            ),
            array(
                'keyword' => 'link_expire_note',
                'value' => 'This Link Will Expire In 1 Hour'
            ),
            array(
                'keyword' => 'something_went_wrong',
                'value' => 'Something Went Wrong, Please Try Again'
            ),
            array(
                'keyword' => 'otp',
                'value' => 'Otp'
            ),
            array(
                'keyword' => 'enter_otp',
                'value' => 'Enter Otp'
            ),
            array(
                'keyword' => 'otp_sent',
                'value' => 'Otp Sent To Your Email'
            ),
            array(
                'keyword' => 'invalid_otp',
                'value' => 'Invalid Otp'
            ),
            array(
                'keyword' => 'otp_expired',
                'value' => 'Otp Has Expired'
            ),
            array(
                'keyword' => 'reset_password',
                'value' => 'Reset Password'
            ),
            array(
                'keyword' => 'enter_otp_and_password',
                'value' => 'Enter Otp And New Password'
            ),
            array(
                'keyword' => 'new_password',
                'value' => 'New Password'
            ),
            array(
                'keyword' => 'confirm_password',
                'value' => 'Confirm Password'
            ),
            array(
                'keyword' => 'password_reset_success',
                'value' => 'Password Reset Successfully'
            ),
            array(
                'keyword' => 'please_wait',
                'value' => 'Please Wait...'
            ),


        ];

        $languages = Language::where('code','en')->get();

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
