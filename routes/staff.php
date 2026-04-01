<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Staff\StaffdashboardController;
use App\Http\Controllers\Staff\Auth\StaffloginController;
use App\Http\Controllers\Staff\StaffcategoryController;
use App\Http\Controllers\Staff\StaffpackageController;
use App\Http\Controllers\Staff\StaffnotificationController;
use App\Http\Controllers\Staff\StaffsettingController;
use App\Http\Controllers\Staff\StaffQueriesController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/clear', function () {
  Artisan::call('cache:clear');
  Artisan::call('config:clear');
  Artisan::call('view:clear');
  Artisan::call('route:clear');
  return "Cache is cleared";
});
Route::get('/', function () {
  return view('welcome');
});;


Route::prefix('staff')->group(function () {
  // forgot password  routing start
  Route::prefix('forgotpassword')->controller(StaffloginController::class)->group(function () {
    Route::get('/', 'staffGetforgotpasswordView')->name('staffforgotpassword.index');
    Route::post('/do-forgot-password', 'staffdoForgetPassword')->name('staffpassword.forgot');
    Route::get('/reset-password', 'staffgetResetpasswordView')->name('staffpassword.resetShow');
    Route::post('/do-reset-password', 'staffresetPasswordpost')->name('staffpassword.doreset');

    // forgot password end
  });
});

Route::middleware('staff-language')->group(function () {
  Route::prefix('staff')->group(function () {
    // admin login   routing start
    Route::prefix('login')->controller(StaffloginController::class)->group(function () {
      Route::get('/', 'getLoginView')->name('staffloginlogin.index');
      Route::post('/staff-do-login', 'staffAuthenticate')->name('stafflogin.dologin');;

      // admin login routing end
    });
  });


  Route::prefix('staff')->middleware(['auth.staff'])->group(function () {
    Route::controller(StaffdashboardController::class)->group(function () {
      Route::get('/dashboard', 'dashboardOverview')->name('staffdashboard.index');
      Route::get('/profile', 'staffProfile')->name('staffprofile.profile');
      Route::post('/staffupdateprofile', 'updateStaffprofile')->name('staffupdateprofile.profile');
      Route::post('/staffLogout', 'staffLogout')->name('staff.logout');
    });

    Route::prefix('category')->controller(StaffcategoryController::class)->group(function () {
      Route::get('/', 'categoryOverview')->name('staffCategory.index');
      Route::get('/form/{id?}', 'staffCategoryform')->name('staffCategory.form');
      Route::post('/store', 'staffCategorystore')->name('staffCategory.store');
      Route::post('/update', 'staffCategoryupdate')->name('staffCategory.update');
      Route::get('/status/{id}', 'staffCategoryupdateStatus')->name('staffCategory.updateStatus');
      Route::get('/delete/{id}', 'staffCategorydestroy')->name('staffCategory.destroy');
      Route::get('/translation/{id}', 'staffCategorytranslation')->name('staffCategory.translation');
      Route::post('/updatetranslate/{id}', 'staffCategoryupdateTranslate')->name('staffCategory.updatetranslate');
      // category routing end
    });

    // advertisement package start
    Route::prefix('advertisement-package')->controller(StaffpackageController::class)->group(function () {
      Route::get('/', 'advertisementpackageOverview')->name('staffAdvertisementpackage.index');
      Route::get('/form/{id?}', 'advertisementpackageForm')->name('staffAdvertisementpackage.form');
      Route::post('/store', 'advertisementpackageStore')->name('staffAdvertisementpackage.store');
      Route::post('/update', 'advertisementpackageUpdate')->name('staffAdvertisementpackage.update');
      Route::get('/delete/{id}', 'advertisementpackageDestroy')->name('staffAdvertisementpackage.destroy');
      Route::get('/status/{id}', 'advertisementpackageUpdateStatus')->name('staffAdvertisementpackage.updateStatus');
    });

    // advertisement package end 

    // item listing -package routing start here

    Route::prefix('item-listing-package')->controller(StaffpackageController::class)->group(function () {
      Route::get('/', 'itemPackagesOverview')->name('staffitemPackages.index');
      Route::get('/form/{id?}', 'staffitemPackagesform')->name('staffitemPackages.form');
      Route::post('/store', 'staffitemPackagesstore')->name('staffitemPackages.store');
      Route::post('/update', 'staffitemPackagesUpdate')->name('staffitemPackages.update');
      Route::get('/delete/{id}', 'staffitemPackagesDestroy')->name('staffitemPackages.destroy');
      Route::get('/status/{id}', 'staffitemPackagesStatus')->name('staffitemPackages.updateStatus');
    });
    // item listing -package routing end here


    //  notification routing start here
    Route::prefix('notification')->controller(StaffnotificationController::class)->group(function () {
      Route::get('/', 'notificationOverview')->name('staffNotification.index');
      Route::get('/form/{id?}', 'staffNotificationform')->name('staffNotification.form');
      Route::post('/store', 'staffNotificationstore')->name('staffNotification.store');
      Route::post('/update', 'staffNotificationupdate')->name('staffNotification.update');
      Route::get('/delete/{id}', 'staffNotificationdestroy')->name('staffNotification.destroy');
      Route::get('/status/{id}', 'staffNotificationupdateStatus')->name('staffNotification.updateStatus');


      //  notification routing end here
    });

    // setting management routing start here 
    Route::prefix('setting')->controller(StaffsettingController::class)->group(function () {
      Route::get('/setlang', 'staffetLanguage')->name('staffsetting.setLanguage');
    });

    // setting management routing start here 

    // userquries routing start here

    Route::prefix('userqueries')->controller(StaffQueriesController::class)->group(function () {
      Route::get('/', 'queriesOverview')->name('staffuserqueries.index');
      Route::get('/form/{id?}', 'form')->name('staffuserqueries.form');
      Route::get('/delete/{id}', 'staffdelete')->name('staffuserqueries.destroy');
    });

    // userquries routing end here

  });
});
