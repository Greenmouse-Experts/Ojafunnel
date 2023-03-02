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
            Route::post('/change-password', [App\Http\Controllers\Admin\AdminController::class, 'profile_update'])->name('admin.profile.update');
            Route::post('/profile-update', [App\Http\Controllers\Admin\AdminController::class, 'changePassword'])->name('admin.change-password');
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
            Route::get('/viewCart', [App\Http\Controllers\Admin\AdminController::class, 'viewCart'])->name('viewCart');
            Route::get('/view-course', [App\Http\Controllers\Admin\AdminController::class, 'view_course'])->name('viewCourse');
            Route::get('/view-course/course-detail', [App\Http\Controllers\Admin\AdminController::class, 'course_detail'])->name('courseDetail');
            Route::get('/view-course/course-detail', [App\Http\Controllers\AdminController::class, 'course_detail'])->name('courseDetail');
            Route::get('/ecommerce/store-list', [App\Http\Controllers\Admin\AdminController::class, 'store_list'])->name('storeList');
            Route::get('/ecommerce/product-list', [App\Http\Controllers\Admin\AdminController::class, 'product_list'])->name('productList');
            Route::get('/ecommerce/product-detail/{id}', [App\Http\Controllers\Admin\AdminController::class, 'product_detail'])->name('productDetail');
            Route::get('/ecommerce/sales-list', [App\Http\Controllers\Admin\AdminController::class, 'sales_list'])->name('salesList');
            Route::get('/user/disable/{uids}', [App\Http\Controllers\Admin\CustomerController::class, 'disable'])->name('disable.user');
            Route::get('/user/enable/{uids}', [App\Http\Controllers\Admin\CustomerController::class, 'enable'])->name('enabled.user');

            Route::get('/email-support', [App\Http\Controllers\Admin\AdminController::class, 'email_support'])->name('emailSupport');
            Route::post('/reply/email-support/{id}', [App\Http\Controllers\Admin\AdminController::class, 'reply_email_support'])->name('replyEmailSupport');
            Route::post('/send/email/user', [App\Http\Controllers\Admin\AdminController::class, 'send_email_to_user'])->name('admin.send.message.user');
            Route::get('/chat-support', [App\Http\Controllers\Admin\AdminController::class, 'chat_support'])->name('chatSupport');
            Route::get('/sms-automation', [App\Http\Controllers\Admin\AdminController::class, 'sms_automation'])->name('smsAutomation');
            Route::get('/whatsapp-automation', [App\Http\Controllers\Admin\AdminController::class, 'whatsapp_automation'])->name('whatsappAutomation');
            Route::get('/integration', [App\Http\Controllers\Admin\AdminController::class, 'integration'])->name('integration');
            Route::get('/birthday-module', [App\Http\Controllers\Admin\AdminController::class, 'birthday_module'])->name('birthdayModule');

            // Support
            Route::post('/support/start/chat/{id}', [App\Http\Controllers\Admin\AdminController::class, 'startChat']);
            Route::get('/support/get/users', [App\Http\Controllers\Admin\AdminController::class, 'fetchAllusers']);
            Route::get('/support/chats', [App\Http\Controllers\Admin\AdminController::class, 'fetchAllRecentChats']);
            Route::post('/support/send', [App\Http\Controllers\Admin\AdminController::class, 'sendMessage']);
            Route::post('/support/clear', [App\Http\Controllers\Admin\AdminController::class, 'clearChat']);
            Route::post('/support/clear/single/chat', [App\Http\Controllers\Admin\AdminController::class, 'deleteSingleChat']);
            Route::delete('/support/deletechatroom', [App\Http\Controllers\Admin\AdminController::class, 'deleteChatroom']);

            // Email Marketing
            Route::get('sending/index', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('sending.server');
            Route::get('sending/index/new-server', [App\Http\Controllers\Admin\AdminController::class, 'new_server'])->name('new.server');
            Route::get('sending/index/new-server/choose', [App\Http\Controllers\Admin\AdminController::class, 'choose_server'])->name('choose.server');
            Route::get('main-bounce', [App\Http\Controllers\Admin\AdminController::class, 'main_bounce'])->name('main.bounce');
            Route::get('main-bounce/new-bounce', [App\Http\Controllers\Admin\AdminController::class, 'new_bounce'])->name('new.bounce');
            Route::get('main-email-verification', [App\Http\Controllers\Admin\AdminController::class, 'main_email'])->name('main.email');
            Route::get('main-email/create-new', [App\Http\Controllers\Admin\AdminController::class, 'create_new'])->name('create.new');
            Route::get('main-backlist', [App\Http\Controllers\Admin\AdminController::class, 'backlist'])->name('backlist.log');
            Route::get('main-backlist/new-import', [App\Http\Controllers\Admin\AdminController::class, 'import_backlist'])->name('import.backlist');
            Route::get('main-delivery-log', [App\Http\Controllers\Admin\AdminController::class, 'delivery_log'])->name('delivery.log');
            Route::get('main-bounce-log', [App\Http\Controllers\Admin\AdminController::class, 'bounce_log'])->name('bounce.log');
            Route::get('main-open-log', [App\Http\Controllers\Admin\AdminController::class, 'open_log'])->name('open.log');
            Route::get('main-click-log', [App\Http\Controllers\Admin\AdminController::class, 'click_log'])->name('click.log');
            Route::get('main-unsubcribe-log', [App\Http\Controllers\Admin\AdminController::class, 'unsubscribe_log'])->name('unsubscribe.log');
            Route::get('setting/general', [App\Http\Controllers\Admin\AdminController::class, 'generall'])->name('setting.general');
            Route::get('main-payment-gateway', [App\Http\Controllers\Admin\AdminController::class, 'payment_gateway'])->name('payment.gateway');
            Route::get('main-plugin', [App\Http\Controllers\Admin\AdminController::class, 'plugin'])->name('plugin');
            Route::get('main-plugin/install-plugin', [App\Http\Controllers\Admin\AdminController::class, 'install_plugin'])->name('install.plugin');

            Route::get('ecommerce/sales-details/{id}', [App\Http\Controllers\Admin\AdminController::class, 'sales_details'])->name('salesDetail');
            // Email Canpaign
            Route::get('email-marketing/manage', [App\Http\Controllers\Admin\AdminController::class, 'manage_campaign'])->name('admin.manage_campaign');

            // sales analytics
            Route::get('sales-analytics', [App\Http\Controllers\Admin\AdminController::class, 'sales_analytics'])->name('salesAnalytics');

            // nofitication admin
            Route::get('notification', [App\Http\Controllers\Admin\AdminController::class, 'notification'])->name('notification');

            // Admin page builder
            Route::get('page-builder', [App\Http\Controllers\Admin\AdminController::class, 'page_builder'])->name('pageBuilder');
        }
    );
});
