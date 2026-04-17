<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\ProfileController;
use App\Http\Controllers\Website\SellController;
use App\Http\Controllers\Website\ItemController;
use App\Http\Controllers\Website\VerificationBadgeController;
use App\Http\Controllers\Website\NotificationController;
use App\Http\Controllers\Website\ChatController;
use App\Http\Controllers\Website\SubscriptionController;
use App\Http\Controllers\Website\FavoriteController;
use App\Http\Controllers\Website\TransactionController;
use App\Http\Controllers\Website\ContactusController;
use App\Http\Controllers\Website\AboutusController;
use App\Http\Controllers\Website\FaqController;
use App\Http\Controllers\Website\CategoryController;
use App\Http\Controllers\Website\UserController;
use App\Http\Controllers\Website\CmsController;


/*
|--------------------------------------------------------------------------
| Website Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['website-language:web'])->group(function () {

    // Homepage
    Route::get('/', [HomeController::class, 'index'])
        ->name('website.index');
    Route::get('/load-items', [HomeController::class, 'loadItems'])->name('load.items');
    Route::post('/save-location', [HomeController::class, 'saveLocation'])->name('save.location');
    Route::get('/check-session-location', [HomeController::class, 'checkSessionLocation'])->name('check.session.location');
    Route::get('/setlang', [HomeController::class, 'setLanguage'])->name('setlang');



    /*
    |--------------------------------------------------------------------------
    | Profile Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware('auth.webuser')->group(function () {
        Route::prefix('profile')->name('profile.')->group(function () {

            Route::get('/', [ProfileController::class, 'index'])
                ->name('index');

            Route::post('/update', [ProfileController::class, 'update'])
                ->name('update');
        });
    });


    /*
    |--------------------------------------------------------------------------
    | Sell Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware('auth.webuser')->group(function () {
        Route::prefix('sell')->name('sell.')->group(function () {
             
            Route::get('/', [SellController::class, 'index'])
                ->name('index');

            // AJAX: get subcategories
            Route::get('/get-subcategories/{category}', [SellController::class, 'getSubcategories'])
                ->name('get.subcategories');

            // Final listing page
            Route::get('/add-listing/{category}/{subcategory}', [SellController::class, 'addSellListing'])
                ->name('add.listing');

            Route::post('/store', [SellController::class, 'store'])
            ->name('store');

            Route::get('/listing', [SellController::class, 'sellListing'])
                ->name('listing');

            Route::get('/edit-listing/{id}', [SellController::class, 'sellEditListing'])
                ->name('edit-listing');

            Route::post('/update', [SellController::class, 'update'])
                ->name('update');

            Route::get('/load-more-items', [SellController::class, 'loadMoreItems'])
            ->name('load.more.items');

            Route::post('/mark-sold/{id}', [SellController::class, 'markAsSold'])->name('item.markSold');

        });
    });


    /*
    |--------------------------------------------------------------------------
    | Item Routes
    |--------------------------------------------------------------------------
    */

    Route::prefix('item')->name('item.')->group(function () {

        Route::get('/list', [ItemController::class, 'list'])
            ->name('list');

        Route::get('/detail/{slug}', [ItemController::class, 'detail'])
            ->name('detail');

        Route::post('/favorite/toggle',[ItemController::class,'toggleFavorite'])->name('favorite.toggle')->middleware('auth');

        Route::post('/report',[ItemController::class,'reportItem'])->name('report')->middleware('auth');
    });


    /*
    |--------------------------------------------------------------------------
    | Verification Badge Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware('auth.webuser')->group(function () {
        Route::get('/get-verification-badge', [VerificationBadgeController::class, 'index'])
                ->name('get-verification-badge');

        Route::post('/verification-badge/upload', [VerificationBadgeController::class, 'upload'])
                ->name('verification.upload');
    });


    /*
    |--------------------------------------------------------------------------
    |  Notification Routes
    |--------------------------------------------------------------------------
    */

    Route::get('/notifications', [NotificationController::class, 'index'])
            ->name('notifications');


    /*
    |--------------------------------------------------------------------------
    |  Chat Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware('auth.webuser')->group(function () {
         
         Route::get('/chats', [ChatController::class, 'index'])
        ->name('index');

        Route::prefix('chat')->name('chat.')->group(function () {

            Route::get('/chats', [ChatController::class, 'index'])
                ->name('index');

            Route::get('/list', [ChatController::class,'chatList']);

            Route::get('/messages/{id}', [ChatController::class,'messages']);

            Route::post('/send', [ChatController::class,'send']);

            Route::post('/block', [ChatController::class,'block']);

            Route::post('/unblock', [ChatController::class,'unblock']);

            Route::get('/start/{item}', [ChatController::class,'startChat'])
                ->name('start');

            Route::post('/typing', [ChatController::class,'typing']);

            Route::post('/seen', [ChatController::class, 'markSeen']);

        });
    });

    /*
    |--------------------------------------------------------------------------
    |  Subscription Routes
    |--------------------------------------------------------------------------
    */

    Route::get('/subscriptions', [SubscriptionController::class, 'index'])
            ->name('subscriptions');

    // razorpay        
    Route::post('/razorpay/order', [SubscriptionController::class, 'createOrder'])->name('razorpay.order');
    Route::post('/razorpay/verify', [SubscriptionController::class, 'verifyPayment'])->name('razorpay.verify');

    // stripe
    Route::post('/stripe/order', [SubscriptionController::class, 'createStripeOrder'])->name('stripe.order');
    Route::post('/stripe/verify', [SubscriptionController::class, 'verifyStripePayment'])->name('stripe.verify');
    Route::post('/stripe/webhook', [SubscriptionController::class, 'handleWebhook']);
    Route::get('/stripe-success', [SubscriptionController::class, 'verifyStripePayment']);

    // Paypal
    Route::post('/paypal/order', [SubscriptionController::class, 'createPaypalOrder'])->name('paypal.order');
    Route::post('/paypal/capture', [SubscriptionController::class, 'capturePaypalPayment'])->name('paypal.capture');
    Route::post('/paypal/webhook', [SubscriptionController::class, 'paypalWebhook'])->name('paypal.webhook');


    /*
    |--------------------------------------------------------------------------
    |  Favorite Routes
    |--------------------------------------------------------------------------
    */

    Route::get('/favorites', [FavoriteController::class, 'index'])
            ->name('favorites');


    /*
    |--------------------------------------------------------------------------
    |  Transaction Routes
    |--------------------------------------------------------------------------
    */

    Route::get('/transactions', [TransactionController::class, 'index'])
            ->name('transactions');


    /*
    |--------------------------------------------------------------------------
    |  About Routes
    |--------------------------------------------------------------------------
    */

    Route::get('/about-us', [AboutusController::class, 'index'])
            ->name('about-us');


    /*
    |--------------------------------------------------------------------------
    |  Contact Us Routes
    |--------------------------------------------------------------------------
    */

    Route::get('/contact-us', [ContactusController::class, 'index'])->name('contact-us');
    Route::post('/store-contact-us', [ContactusController::class, 'store'])->name('store-contact-us');


    /*
    |--------------------------------------------------------------------------
    |  Faqs Routes
    |--------------------------------------------------------------------------
    */

    Route::get('/faqs', [FaqController::class, 'index'])
            ->name('faqs');


    /*
    |--------------------------------------------------------------------------
    |  Category Routes
    |--------------------------------------------------------------------------
    */

    Route::get('/category-detail/{slug}', [CategoryController::class, 'detail'])
            ->name('category-detail');


    /*
    |--------------------------------------------------------------------------
    |  User Routes
    |--------------------------------------------------------------------------
    */

    Route::middleware('auth.webuser')->group(function () {
        Route::get('/ajax/load-items', [UserController::class,'loadItems'])->name('ajax.load.items');
    });
        Route::get('/account-detail/{id}', [UserController::class, 'accountDetail'])
                ->name('account-detail');

    Route::prefix('user')->name('user.')->group(function () {

        Route::post('do-signup', [UserController::class, 'doSignup'])
            ->name('do-signup');

        Route::get('verify-email/{token}', [UserController::class, 'verifyEmail'])
            ->name('verify-email');

        Route::post('check-email', [UserController::class, 'checkEmail'])
        ->name('check-email');

        Route::post('do-login', [UserController::class, 'doLogin'])
        ->name('do-login');

        Route::post('logout', [UserController::class, 'logout'])
        ->name('logout');

        Route::post('delete', [UserController::class, 'deleteAccount'])
        ->name('delete');
    });

    Route::get('/auth/google', [UserController::class, 'redirectToGoogle'])->name('google.login');
    Route::get('/auth/google/callback', [UserController::class, 'handleGoogleCallback']);


    /*
    |--------------------------------------------------------------------------
    |  CMS Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/{page_name}', [CmsController::class, 'index']);

});