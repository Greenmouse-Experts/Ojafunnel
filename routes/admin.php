<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\OjafunnelNotificationController;
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

            // Marketing
            Route::get('/email-marketing/email-kits', [App\Http\Controllers\Admin\AdminController::class, 'view_email_kits'])->name('admin.email-marketing.email-kits');
            Route::get('/email-marketing/email-campaigns', [App\Http\Controllers\Admin\AdminController::class, 'view_email_campaigns'])->name('admin.email-marketing.email-campaigns');

            // LMS
            Route::get('/viewCart', [App\Http\Controllers\Admin\AdminController::class, 'viewCart'])->name('viewCart');
            Route::get('/view-course', [App\Http\Controllers\Admin\AdminController::class, 'view_course'])->name('viewCourse');
            Route::get('/view-shop', [App\Http\Controllers\Admin\AdminController::class, 'view_shop'])->name('viewShop');
            Route::get('/course-category', [App\Http\Controllers\Admin\AdminController::class, 'view_category'])->name('viewCategory');
            Route::post('/add-course-category', [App\Http\Controllers\Admin\AdminController::class, 'add_category'])->name('addCategory');
            Route::post('/update-course-category/{id}', [App\Http\Controllers\Admin\AdminController::class, 'update_category'])->name('updateCategory');
            Route::post('/delete-course-category/{id}', [App\Http\Controllers\Admin\AdminController::class, 'delete_category'])->name('deleteCategory');
            Route::get('/view-course/course-detail', [App\Http\Controllers\Admin\AdminController::class, 'course_detail'])->name('courseDetail');
            Route::get('/view-course/course-activate/{id}', [App\Http\Controllers\Admin\AdminController::class, 'course_activate'])->name('course.activate');
            Route::get('/view-course/course-deactivate/{id}', [App\Http\Controllers\Admin\AdminController::class, 'course_deactivate'])->name('course.deactivate');
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

            // Whatsapp Support
            Route::get('/support/whatsapp', [App\Http\Controllers\Admin\AdminController::class, 'support_whatsapp'])->name('whatsappSupport');
            Route::post('/add/support/whatsapp', [App\Http\Controllers\Admin\AdminController::class, 'add_support_whatsapp'])->name('whatsappSupportAdd');
            Route::post('/delete-support-whatsapp/{id}', [App\Http\Controllers\Admin\AdminController::class, 'delete_support_whatsapp'])->name('deleteWhatsappSupport');

            // Support
            Route::get('/support/checkConvo/{recieverId}', [App\Http\Controllers\Admin\AdminController::class, 'check']);
            Route::post('/support/sendMessage', [App\Http\Controllers\Admin\AdminController::class, 'store'])->name('sendMessage');
            Route::get('/support/loadMessage/{reciever}/{sender}', [App\Http\Controllers\Admin\AdminController::class, 'load']);
            Route::get('/support/retrieveMessages/{reciever}/{sender}/{lastMsgId}', [App\Http\Controllers\Admin\AdminController::class, 'retrieveNew']);

            // Email Marketing

            Route::prefix('/sending-server')->group(
                function () {
                    Route::get('/sort', [App\Http\Controllers\Mail\Admin\SendingServerController::class, 'sort'])->name('sending.server.sort');
                    Route::get('/listing', [App\Http\Controllers\Mail\Admin\SendingServerController::class, 'listing'])->name('sending.server.listing');
                    Route::get('/enable', [App\Http\Controllers\Mail\Admin\SendingServerController::class, 'enable'])->name('sending.server.enable');
                    Route::get('/disable', [App\Http\Controllers\Mail\Admin\SendingServerController::class, 'disable'])->name('sending.server.disable');
                    Route::get('/delete', [App\Http\Controllers\Mail\Admin\SendingServerController::class, 'delete'])->name('sending.server.delete');
                    Route::get('/select', [App\Http\Controllers\Mail\Admin\SendingServerController::class, 'select'])->name('sending.server.select');
                    Route::get('/create', [App\Http\Controllers\Mail\Admin\SendingServerController::class, 'create'])->name('sending.server.create');
                    Route::get('/edit/{id}', [App\Http\Controllers\Mail\Admin\SendingServerController::class, 'edit'])->name('sending.server.edit');
                    Route::match(['get', 'post'], '/sendingLimit', [App\Http\Controllers\Mail\Admin\SendingServerController::class, 'sendingLimit'])->name('sending.server.sendingLimit');
                    Route::post('/store', [App\Http\Controllers\Mail\Admin\SendingServerController::class, 'store'])->name('sending.server.store');
                    Route::patch('/update', [App\Http\Controllers\Mail\Admin\SendingServerController::class, 'update'])->name('sending.server.update');
                    Route::match(['get', 'post'], '/testConnection/{uid}', [App\Http\Controllers\Mail\Admin\SendingServerController::class, 'testConnection'])->name('sending.server.testConnection');
                    Route::match(['get', 'post'], '/test/{uid}', [App\Http\Controllers\Mail\Admin\SendingServerController::class, 'test'])->name('sending.server.test');
                    Route::match(['get', 'post'], '/awsRegionHost', [App\Http\Controllers\Mail\Admin\SendingServerController::class, 'awsRegionHost'])->name('sending.server.awsRegionHost');
                    Route::match(['get', 'post'], '/addDomain', [App\Http\Controllers\Mail\Admin\SendingServerController::class, 'addDomain'])->name('sending.server.addDomain');
                    Route::match(['get', 'post'], '/removeDomain', [App\Http\Controllers\Mail\Admin\SendingServerController::class, 'removeDomain'])->name('sending.server.removeDomain');
                    Route::match(['get', 'post'], '/fromDropbox/{uid}', [App\Http\Controllers\Mail\Admin\SendingServerController::class, 'fromDropbox'])->name('sending.server.fromDropbox');
                    Route::post('/config/{uid}', [App\Http\Controllers\Mail\Admin\SendingServerController::class, 'config'])->name('sending.server.config');
                }
            );
            Route::get('sending/index', [App\Http\Controllers\Mail\Admin\SendingServerController::class, 'index'])->name('sending.server');
            Route::get('sending-server/index', [App\Http\Controllers\Mail\Admin\SendingServerController::class, 'index'])->name('sending.server.index');
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

            // Admin Page Builder
            Route::post('/page/builder/create', [App\Http\Controllers\Admin\AdminController::class, 'page_builder_create'])->name('admin.page.builder.create');
            Route::any('/page/builder/save/page', [App\Http\Controllers\Admin\AdminController::class, 'page_builder_save_page'])->name('admin.page.builder.save.page');
            Route::post('/page/builder/update/{id}', [App\Http\Controllers\Admin\AdminController::class, 'page_builder_update'])->name('admin.page.builder.update');
            Route::get('/page/publish/{action}/{id}', [App\Http\Controllers\Admin\AdminController::class, 'page_publish'])->name('admin.page.publish');
            Route::post('/page/builder/delete/{id}', [App\Http\Controllers\Admin\AdminController::class, 'page_builder_delete'])->name('admin.page.builder.delete');
            Route::get('/pages/{page}/editor', [App\Http\Controllers\Admin\AdminController::class, 'viewEditor'])->name('admin.page.builder.view.editor');

            // Notification
            Route::get('/admin/read/notification/{id}', [App\Http\Controllers\Admin\AdminController::class, 'read_notification'])->name('admin.read.notification');

            // Frontend
            Route::get('/faq', [App\Http\Controllers\Admin\AdminController::class, 'view_faq'])->name('viewFaq');
            Route::post('/add-faq', [App\Http\Controllers\Admin\AdminController::class, 'add_faq'])->name('addFaq');
            Route::post('/update-faq/{id}', [App\Http\Controllers\Admin\AdminController::class, 'update_faq'])->name('updateFaq');
            Route::post('/delete-faq/{id}', [App\Http\Controllers\Admin\AdminController::class, 'delete_faq'])->name('deleteFaq');

            Route::get('/contact-us', [App\Http\Controllers\Admin\AdminController::class, 'view_contact_us'])->name('viewContactUs');
            Route::post('/delete-contact-us/{id}', [App\Http\Controllers\Admin\AdminController::class, 'delete_contact_us'])->name('deleteContactUs');

            // Save FCM Token
            Route::post('/save-token', [AdminController::class, 'saveToken'])->name('admin.save.token');

            // Payouts
            Route::get('/pending/payouts', [App\Http\Controllers\Admin\AdminController::class, 'pending_payouts'])->name('pending.payouts');
            Route::post('/process/payouts/{id}', [App\Http\Controllers\Admin\AdminController::class, 'process_payouts'])->name('process.payouts');
            Route::get('/transaction/confirm/{id}/{response}/{status}/{description}', [App\Http\Controllers\Admin\AdminController::class, 'transaction_confirm'])->name('transaction.confirm');
            Route::get('/finalized/payouts', [App\Http\Controllers\Admin\AdminController::class, 'finalized_payouts'])->name('finalized.payouts');

            // 
            Route::post('/add-plan', [App\Http\Controllers\Admin\AdminController::class, 'add_plan'])->name('admin.addPlan');
            Route::post('/update-plan/{id}', [App\Http\Controllers\Admin\AdminController::class, 'update_plan'])->name('admin.updatePlan');
            Route::post('/delete-plan/{id}', [App\Http\Controllers\Admin\AdminController::class, 'delete_plan'])->name('admin.deletePlan');
            Route::get('/enable-plan/{id}', [App\Http\Controllers\Admin\AdminController::class, 'enable_plan'])->name('admin.enablePlan');
            Route::get('/disable-plan/{id}', [App\Http\Controllers\Admin\AdminController::class, 'disable_plan'])->name('admin.disablePlan');
            Route::get('/add-plan/intervals/{id}', [App\Http\Controllers\Admin\AdminController::class, 'plan_interval'])->name('admin.planinterval');
            Route::post('/add-interval/{id}', [App\Http\Controllers\Admin\AdminController::class, 'add_plan_interval'])->name('admin.addPlan.interval');
            Route::post('/update-interval/{id}', [App\Http\Controllers\Admin\AdminController::class, 'update_plan_interval'])->name('admin.updatePlan.interval');
            Route::post('/delete-interval/{id}', [App\Http\Controllers\Admin\AdminController::class, 'delete_plan_interval'])->name('admin.deletePlan.interval');
        }
    );
});
