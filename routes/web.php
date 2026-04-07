<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CmsController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\TipController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\HomepageController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\TranslationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\QueriesController;
use App\Http\Controllers\Admin\SellerController;
use App\Http\Controllers\Admin\ReportreasonController;
use App\Http\Controllers\Admin\CustomersController;
use App\Http\Controllers\Admin\UserReportController;
use App\Http\Controllers\Admin\ReviewsController;
use App\Http\Controllers\Admin\UserpackagesController;
use App\Http\Controllers\Admin\ContactUsController;
use Illuminate\Support\Facades\Artisan;

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

Route::prefix('admin')->group(function () {

  // admin login   routing start
  Route::prefix('login')->controller(LoginController::class)->group(function () {
    Route::get('/', 'getLoginView')->name('login.index');
    Route::post('/do-login', 'authenticate')->name('login.dologin');;
    // admin login routing end
  });
});

// admin login   routing start
Route::get('/admin-login', [LoginController::class, 'getLoginView'])->name('admin.login');

// forgot password  routing start
Route::prefix('forgotpassword')->controller(LoginController::class)->group(function () {
  Route::get('/', 'getForgotpasswordView')->name('forgotpassword.index');
  Route::post('/do-forgot-password', 'doForgetPassword')->name('password.forgot');
  Route::get('/reset-password', 'getResetpasswordView')->name('password.resetShow');
  Route::post('/do-reset-password', 'resetPasswordpost')->name('password.doreset');

  // forgot password end
});

Route::middleware('admin-language')->group(function () {

  Route::prefix('admin')->middleware(['auth.admin'])->group(function () {
    // admin dashboard/profile routing start here
    Route::controller(DashboardController::class)->group(function () {
      Route::get('/dashboard', 'index')->name('dashboard.index');
      Route::get('/profile', 'adminProfile')->name('admin.profile');
      Route::post('/update-profile', 'updateAdminProfile')->name('updateAdmin.profile');
      Route::post('/adminLogout', 'adminLogout')->name('admin.logout');
    });
    // admin dashboard/profile routing end  here


    // category routing start
    Route::prefix('category')->controller(CategoryController::class)->group(function () {
      Route::get('/', 'index')->name('category.index');
      Route::get('/form/{id?}', 'form')->name('category.form');
      Route::post('/store', 'store')->name('category.store');
      Route::post('/update', 'update')->name('category.update');
      Route::get('/status/{id}', 'updateStatus')->name('category.updateStatus');
      Route::get('/delete/{id}', 'destroy')->name('category.destroy');
      Route::get('/translation/{id}', 'translation')->name('category.translation');
      Route::post('/updatetranslate/{id}', 'updateTranslate')->name('category.updatetranslate');
      Route::get('/update-featured/{id}', [CategoryController::class, 'updateFeatured'])->name('category.updateFeatured');
    });
    Route::post('/category-sortable', [CategoryController::class, 'sorting'])
      ->name('category-sorting');
    // category routing end

    
    // advertisement-package routing end here
    Route::prefix('advertisement-package')->controller(PackageController::class)->group(function () {
      Route::get('/', 'index')->name('advertisement-package.index');
      Route::get('/form/{id?}', 'form')->name('advertisement-package.form');
      Route::post('/store', 'store')->name('advertisement-package.store');
      Route::post('/update', 'update')->name('advertisement-package.update');
      Route::get('/delete/{id}', 'destroy')->name('advertisement-package.destroy');
      Route::get('/status/{id}', 'updateStatus')->name('advertisement-package.updateStatus');
      Route::get('/translation/{id}', 'translation')->name('advertisement-package.translation');
      Route::post('/updatetranslate/{id}', 'updateTranslate')->name('advertisement-package.updatetranslate');
    });
    // advertisement-package routing end here


    // item listing -package routing start here
    Route::prefix('item-listing-package')->controller(PackageController::class)->group(function () {
      Route::get('/', 'itemPackages')->name('item-listing-package.index');
      Route::get('/form/{id?}', 'itemPackagesform')->name('item-listing-package.form');
      Route::post('/store', 'storeListingPackage')->name('item-listing-package.store');
      Route::post('/update', 'itemlistingPackageUpdate')->name('item-listing-package.update');
      Route::get('/delete/{id}', 'destroyListingPackage')->name('item-listing-package.destroy');
      Route::get('/status/{id}', 'updateListingPackageStatus')->name('item-listing-package.updateStatus');
      Route::get('/translation/{id}', 'itemPackagetranslation')->name('item-listing-package.translation');
      Route::post('/updatetranslate/{id}', 'itemPackageupdateTranslate')->name('item-listing-package.updatetranslate');
    });
    // item listing -package routing end here

    // user packages strart here 
    Route::prefix('userpackage')->controller(UserpackagesController::class)->group(function () {
      Route::get('/', 'index')->name('userpackage.index');
      Route::get('/form/{id?}', 'form')->name('userpackage.form');
      Route::get('/delete/{id}', 'destroy')->name('userpackage.destroy');
    });
    // user packages end  here 

    // user packages end  here 
    Route::prefix('transactions')->controller(UserpackagesController::class)->group(function () {
      Route::get('/', 'transactionOverview')->name('transactions.index');
    });


    // Cms routing start here
    Route::prefix('cms')->controller(CmsController::class)->group(function () {
      Route::get('/', 'index')->name('cms.index');
      Route::get('/create', 'create')->name('cms.create');
      Route::post('/store', 'store')->name('cms.store');
      Route::get('/edit/{id}', 'edit')->name('cms.edit');
      Route::post('/update', 'update')->name('cms.update');
      Route::get('/status/{id}', 'updateStatus')->name('cms.updateStatus');
      Route::get('/delete/{id}', 'destroy')->name('cms.destroy');
      Route::get('/translation/{id}', 'translation')->name('cms.translation');
      Route::post('/updatetranslate/{id}', 'updateTranslate')->name('cms.updatetranslate');
    });
    // Cms routing end here


    // Banner routing start here
    Route::prefix('banner')->controller(BannerController::class)->group(function () {
      Route::get('/edit', 'edit')->name('banner.edit');
      Route::post('/update', 'update')->name('banner.update');
    });
    // Banner routing end here


    // faq routing start here
    Route::prefix('faq')->controller(FaqController::class)->group(function () {
      Route::get('/', 'index')->name('faq.index');
      Route::get('/create', 'create')->name('faq.create');
      Route::post('/store', 'store')->name('faq.store');
      Route::get('/edit/{id}', 'edit')->name('faq.edit');
      Route::post('/update', 'update')->name('faq.update');
      Route::get('/status/{id}', 'updateStatus')->name('faq.updateStatus');
      Route::get('/delete/{id}', 'destroy')->name('faq.destroy');
      Route::get('/translation/{id}', 'translation')->name('faq.translation');
      Route::post('/updatetranslate/{id}', 'updateTranslate')->name('faq.updatetranslate');
    });
    // faq routing end here

    // tips routing start here
    Route::prefix('tips')->controller(TipController::class)->group(function () {
      Route::get('/', 'index')->name('tips.index');
      Route::get('/create', 'create')->name('tips.create');
      Route::post('/store', 'store')->name('tips.store');
      Route::get('/edit/{id}', 'edit')->name('tips.edit');
      Route::post('/update', 'update')->name('tips.update');
      Route::get('/status/{id}', 'updateStatus')->name('tips.updateStatus');
      Route::get('/delete/{id}', 'destroy')->name('tips.destroy');
      Route::get('/translation/{id}', 'translation')->name('tips.translation');
      Route::post('/updatetranslate/{id}', 'updateTranslate')->name('tips.updatetranslate');
    });
    // tips routing end here


    // slider routing start here
    Route::prefix('slider')->controller(HomepageController::class)->group(function () {
      Route::get('/', 'index')->name('slider.index');
      Route::get('/form/{id?}', 'form')->name('slider.form');
      Route::post('/save', 'store')->name('slider.store');
      Route::get('/edit/{id}', 'edit')->name('slider.edit');
      Route::post('/update', 'update')->name('slider.update');
      Route::get('/status/{id}', 'updateStatus')->name('slider.updateStatus');
      Route::get('/delete/{id}', 'destroy')->name('slider.destroy');
    });

    // country management routing start here 
    Route::prefix('country')->controller(CountryController::class)->group(function () {
      Route::get('/', 'index')->name('country.index');
      Route::get('/form/{id?}', 'form')->name('country.form');
      Route::post('/store', 'store')->name('country.store');
      Route::post('/bulkUpload', 'bulkUpload')->name('country.bulkUpload');
      Route::post('/update', 'update')->name('country.update');
      Route::get('/status/{id}', 'updateStatus')->name('country.updateStatus');
      Route::get('/delete/{id}', 'destroy')->name('country.destroy');
    });
    // country management routing end  here 

    // State management routing start here 
    Route::prefix('state')->controller(StateController::class)->group(function () {
      Route::get('/', 'index')->name('state.index');
      Route::get('/form/{id?}', 'form')->name('state.form');
      Route::post('/store', 'store')->name('state.store');
      Route::post('/update', 'update')->name('state.update');
      Route::post('/bulkUpload', 'bulkUpload')->name('state.bulkUpload');
      Route::get('/status/{id}', 'updateStatus')->name('state.updateStatus');
      Route::get('/delete/{id}', 'destroy')->name('state.destroy');
    });
    // State management routing end  here 

    // City management routing start here 
    Route::prefix('city')->controller(CityController::class)->group(function () {
      Route::get('/', 'index')->name('city.index');
      Route::get('/form/{id?}', 'form')->name('city.form');
      Route::get('get-states', 'getStates')->name('get.states');
      Route::post('/update', 'update')->name('city.update');
      Route::post('/store', 'store')->name('city.store');
      Route::post('/bulkUpload', 'bulkUpload')->name('city.bulkUpload');
      Route::get('/status/{id}', 'updateStatus')->name('city.updateStatus');
      Route::get('/delete/{id}', 'destroy')->name('city.destroy');
    });
    // City management routing end  here

    // Area management routing start here 
    Route::prefix('area')->controller(AreaController::class)->group(function () {
      Route::get('/', 'index')->name('area.index');
      Route::get('/form/{id?}', 'form')->name('area.form');
      Route::get('get-cities', 'getCities')->name('get.cities');
      Route::get('get-states', 'getStates')->name('get.states');
      Route::post('/update', 'update')->name('area.update');
      Route::post('/store', 'store')->name('area.store');
      Route::post('/bulkUpload', 'bulkUpload')->name('area.bulkUpload');
      Route::get('/status/{id}', 'updateStatus')->name('area.updateStatus');
      Route::get('/delete/{id}', 'destroy')->name('area.destroy');
    });
    // Area management routing end  here


    // setting management routing start here 
    Route::prefix('setting')->controller(SettingController::class)->group(function () {
      Route::get('/', 'index')->name('setting.index');
      Route::post('/update', 'update')->name('setting.update');
      Route::get('/setlang', 'setLanguage')->name('setting.setLanguage');
    });
    // setting management routing end  here


    // language management routing start here
    Route::prefix('language')->controller(LanguageController::class)->group(function () {
      Route::get('/', 'index')->name('language.index');
      Route::get('/form/{id?}', 'form')->name('language.form');
      Route::post('/store', 'store')->name('language.store');
      Route::post('/update', 'update')->name('language.update');
      Route::get('/delete/{id}', 'destroy')->name('language.destroy');
      Route::get('/status/{id}', 'updateStatus')->name('language.updateStatus');
    });
    // language management routing end here

    // translation management routing start here
    Route::prefix('translation')->controller(TranslationController::class)->group(function () {

      Route::get('/list/{language_id}', 'index')->name('translation.index');
      Route::get('/create/{id}', 'create')->name('translation.create');
      Route::post('/store', 'store')->name('translation.store');
      Route::post('/updatetranslation', 'update')->name('translation.updatetranslation');
    });
    // translation management routing end here


    // Staff  management routing start here
    Route::prefix('staff')->controller(StaffController::class)->group(function () {
      Route::get('/', 'index')->name('staff.index');
      Route::get('/form/{id?}', 'form')->name('staff.form');
      Route::post('/store', 'store')->name('staff.store');
      Route::post('/update', 'update')->name('staff.update');
      Route::get('/delete/{id}', 'destroy')->name('staff.destroy');
      Route::get('/status/{id}', 'updateStatus')->name('staff.updateStatus');
    });
    // Staff  management routing end  here


    // item management routing start here
    Route::prefix('item')->controller(ItemController::class)->group(function () {
      Route::get('/', 'index')->name('item.index');
      Route::get('/form/{id?}', 'form')->name('item.form');
      Route::get('get-cities', 'getCities')->name('get.cities');
      Route::get('get-states', 'getStates')->name('get.states');
      Route::get('/status/{id}', 'updateStatus')->name('item.updateStatus');
    });
    // item management routing end here


    //  notification routing start here
    Route::prefix('notification')->controller(NotificationController::class)->group(function () {
      Route::get('/', 'index')->name('notification.index');
      Route::get('/form/{id?}', 'form')->name('notification.form');
      Route::post('/store', 'store')->name('notification.store');
      Route::post('/update', 'update')->name('notification.update');
      Route::get('/delete/{id}', 'destroy')->name('notification.destroy');
      Route::get('/status/{id}', 'updateStatus')->name('notification.updateStatus');
      Route::post('/bulk-delete', 'bulkDelete')->name('notification.bulkDelete');
    });
    //  notification routing end here

    // role  routing start here
    Route::prefix('role')->controller(RoleController::class)->group(function () {
      Route::get('/', 'index')->name('role.index');
      Route::post('/store', 'store')->name('role.store');
      Route::post('/update', 'update')->name('role.update');
      Route::get('/delete/{id}', 'destroy')->name('role.destroy');
    });
    // role notification routing end here

    // userquries routing start here
    Route::prefix('userqueries')->controller(QueriesController::class)->group(function () {
      Route::get('/', 'index')->name('userqueries.index');
      Route::get('/form/{id?}', 'form')->name('userqueries.form');
      Route::get('/delete/{id}', 'destroy')->name('userqueries.destroy');
    });
    // userquries routing end here

    // userreport routing start here
    Route::prefix('userreport')->controller(UserReportController::class)->group(function () {
      Route::get('/', 'index')->name('userreport.index');
      Route::get('/form/{id?}', 'form')->name('userreport.form');
      Route::get('/delete/{id}', 'destroy')->name('userreport.destroy');
    });
    // userreport routing end here


    // seller managemnt routing start here 
    Route::prefix('seller')->controller(SellerController::class)->group(function () {
      Route::get('/', 'index')->name('seller.index');
      Route::get('/form/{id?}', 'form')->name('seller.form');
      Route::post('/update', 'update')->name('seller.update');
      Route::get('/delete/{id}', 'destroy')->name('seller.destroy');
      Route::get('/status/{id}', 'updateStatus')->name('seller.updateStatus');
    });
    // seller managemnt routing end here

    // reviews management routing start here
    Route::prefix('reviews')->controller(ReviewsController::class)->group(function () {
      Route::get('/', 'index')->name('reviews.index');
      Route::get('/form/{id?}', 'form')->name('reviews.form');
      Route::get('/delete/{id}', 'destroy')->name('reviews.destroy');
    });
    // reviews management routing end  here

    // report-reason managemnt routing start here 
    Route::prefix('report-reason')->controller(ReportreasonController::class)->group(function () {
      Route::get('/', 'index')->name('reportreason.index');
      Route::get('/form/{id?}', 'form')->name('reportreason.form');
      Route::post('/store', 'store')->name('reportreason.store');
      Route::post('/update', 'update')->name('reportreason.update');
      Route::get('/delete/{id}', 'destroy')->name('reportreason.destroy');
      Route::get('/status/{id}', 'updateStatus')->name('reportreason.updateStatus');
    });
    // report-reason managemnt routing end  here  


    // customers  managemnt routing start here 
    Route::prefix('customer')->controller(CustomersController::class)->group(function () {
      Route::get('/', 'index')->name('customer.index');
      Route::get('/form/{id?}', 'form')->name('customer.form');
      Route::post('/update', 'update')->name('customer.update');
      Route::get('/delete/{id}', 'destroy')->name('customer.destroy');
      Route::get('/status/{id}', 'updateStatus')->name('customer.updateStatus');
      Route::get('/ads-package/{id}', 'adsPackage')->name('customer.adspackage');
      Route::post('/assign-package', 'assignPackage')->name('customer.assignpackage');
      Route::get('/item-package/{id}', 'itemPackage')->name('customer.itempackage');
      Route::post('/assign-itempackage', 'assignItempackage')->name('customer.assignitempackage');
      Route::get('/user-package/{id}', 'userPackage')->name('customer.userpackage');
    });
    // customers  managemnt routing end  here


    // reviews management routing start here
    Route::prefix('contact_us')->controller(ContactUsController::class)->group(function () {
      Route::get('/', 'index')->name('contact_us.index');
      Route::post('/reply', 'replyQuery')->name('contact_us.reply');
      
    });
    // reviews management routing end  here

    Route::prefix('admin')->group(function () {

      Route::get(
        'seller/export/excel',
        [SellerController::class, 'exportExcel']
      )->name('seller.export.excel');

      Route::get(
        'seller/export/pdf',
        [SellerController::class, 'exportPdf']
      )->name('seller.export.pdf');

      Route::get(
        'advertisement-package/export/excel',
          [PackageController::class, 'exportExcel']
      )->name('advertisement-package.export.excel');

      Route::get(
          'advertisement-package/export/pdf',
          [PackageController::class, 'exportPdf']
      )->name('advertisement-package.export.pdf');

      Route::get(
          'item-package/export/excel',
          [PackageController::class, 'exportItemExcel']
      )->name('item-package.export.excel');

      Route::get(
          'item-package/export/pdf',
          [PackageController::class, 'exportItemPdf']
      )->name('item-package.export.pdf');

      Route::get(
          'user-query/export/excel',
          [UserpackagesController::class, 'exportQueryExcel']
      )->name('user-query.export.excel');

      Route::get(
          'user-query/export/pdf',
          [UserpackagesController::class, 'exportQueryPdf']
      )->name('user-query.export.pdf');

    });
    
  });

});
