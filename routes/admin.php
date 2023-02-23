<?php
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/login', [App\Http\Controllers\Admin\Auth\AdminAuthController::class, 'getLogin'])->name('adminLogin');
    Route::post('/login', [App\Http\Controllers\Admin\Auth\AdminAuthController::class, 'postLogin'])->name('adminLoginPost');
    Route::get('/logoutAdmin', [App\Http\Controllers\Admin\Auth\AdminAuthController::class, 'adminLogout'])->name('adminLogout');

    Route::group(
        ['prefix' => 'page', 'middleware' => 'adminauth'],
        function () {
            // Admin Dashboard
            Route::get('dashboard', [App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('adminDashboard');
            Route::get('/view_users', [App\Http\Controllers\Admin\AdminController::class, 'view_users'])->name('view_users');
            Route::get('/view_users/users-details/{id}', [App\Http\Controllers\Admin\CustomerController::class, 'view'])->name('users.details');
            Route::get('/add_plans', [App\Http\Controllers\Admin\AdminController::class, 'add_plans'])->name('add_plans');
            Route::get('/manage_plans', [App\Http\Controllers\Admin\AdminController::class, 'manage_plans'])->name('manage_plans');
            Route::get('/viewmessage', [App\Http\Controllers\Admin\AdminController::class, 'viewmessage'])->name('viewmessage');
            Route::get('/transactions', [App\Http\Controllers\Admin\AdminController::class, 'transactions'])->name('transactions');
            Route::get('/subscriptions', [App\Http\Controllers\Admin\AdminController::class, 'subscriptions'])->name('subscriptions');
            Route::get('/security', [App\Http\Controllers\Admin\AdminController::class, 'security'])->name('security');
            Route::get('/general', [App\Http\Controllers\Admin\AdminController::class, 'general'])->name('general');
            Route::get('/subscribtions', [App\Http\Controllers\Admin\AdminController::class, 'subscribtions'])->name('admin.subcribers');
            Route::get('/unscribers', [App\Http\Controllers\Admin\AdminController::class, 'unscribers'])->name('admin.unscribers');
            Route::get('/vendorlist', [App\Http\Controllers\Admin\AdminController::class, 'vendorlist'])->name('vendorlist');
            Route::get('/trans_details', [App\Http\Controllers\Admin\AdminController::class, 'trans_details'])->name('trans.details');
            Route::get('/affiliateList', [App\Http\Controllers\Admin\AdminController::class, 'affiliateList'])->name('affiliateList');
            Route::get('/product', [App\Http\Controllers\Admin\AdminController::class, 'product'])->name('product');
            Route::get('/addProduct', [App\Http\Controllers\Admin\AdminController::class, 'addProduct'])->name('addProduct');
            Route::get('/productDetails', [App\Http\Controllers\Admin\AdminController::class, 'productDetails'])->name('productDetails');
            Route::get('/viewCart', [App\Http\Controllers\Admin\AdminController::class, 'viewCart'])->name('viewCart');
            Route::get('/view-course', [App\Http\Controllers\Admin\AdminController::class, 'view_course'])->name('viewCourse');
            Route::get('/view-course/course-detail', [App\Http\Controllers\Admin\AdminController::class, 'course_detail'])->name('courseDetail');
            Route::get('/admin/view-course/course-detail', [App\Http\Controllers\AdminController::class, 'course_detail'])->name('courseDetail');
            Route::get('/admin/ecommerce/store-list', [App\Http\Controllers\AdminController::class, 'store_list'])->name('storeList');
            Route::get('/admin/ecommerce/product-list', [App\Http\Controllers\AdminController::class, 'product_list'])->name('productList');
            Route::get('/admin/ecommerce/product-detail', [App\Http\Controllers\AdminController::class, 'product_detail'])->name('productDetail');
            Route::get('/admin/ecommerce/sales-list', [App\Http\Controllers\AdminController::class, 'sales_list'])->name('salesList');
            Route::get('/user/disable/{uids}', [App\Http\Controllers\Admin\CustomerController::class, 'disable'])->name('disable.user');
            Route::get('/user/enable/{uids}', [App\Http\Controllers\Admin\CustomerController::class, 'enable'])->name('enabled.user');

            Route::get('/email-support', [App\Http\Controllers\Admin\AdminController::class, 'email_support'])->name('emailSupport');
            Route::get('/chat-support', [App\Http\Controllers\Admin\AdminController::class, 'chat_support'])->name('chatSupport');
            Route::get('/sms-automation', [App\Http\Controllers\Admin\AdminController::class, 'sms_automation'])->name('smsAutomation');
            Route::get('/whatsapp-automation', [App\Http\Controllers\Admin\AdminController::class, 'whatsapp_automation'])->name('whatsappAutomation');


            // Email Marketing
            Route::get('sending/index', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('sending.server');
            Route::get('sending/index/new-server', [App\Http\Controllers\Admin\AdminController::class, 'new_server'])->name('new.server');
            Route::get('sending/index/new-server/choose', [App\Http\Controllers\Admin\AdminController::class, 'choose_server'])->name('choose.server');
            Route::get('main-bounce', [App\Http\Controllers\Admin\AdminController::class, 'main_bounce'])->name('main.bounce');
            Route::get('main-bounce/new-bounce', [App\Http\Controllers\Admin\AdminController::class, 'new_bounce'])->name('new.bounce');
            Route::get('main-email-verification', [App\Http\Controllers\Admin\AdminController::class, 'main_email'])->name('main.email');
            Route::get('main-email/create-new', [App\Http\Controllers\Admin\AdminController::class, 'create_new'])->name('create.new');
            Route::get('ecommerce/sales-details', [App\Http\Controllers\AdminController::class, 'sales_list'])->name('salesDetail');
            // Email Canpaign
            Route::get('email-marketing/manage', [App\Http\Controllers\AdminController::class, 'manage_campaign'])->name('admin.manage_campaign');

        }
    );
});
