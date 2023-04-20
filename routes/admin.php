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

            // Email Marketing
            Route::get('/email-marketing/email-kits', [App\Http\Controllers\Admin\AdminController::class, 'view_email_kits'])->name('admin.email-marketing.email-kits');
            Route::get('/email-marketing/email-campaigns', [App\Http\Controllers\Admin\AdminController::class, 'view_email_campaigns'])->name('admin.email-marketing.email-campaigns');
            Route::get('/email-marketing/email-lists', [App\Http\Controllers\Admin\AdminController::class, 'email_lists'])->name('admin.email-marketing.email-lists');
            Route::get('/email-marketing/view/email-lists/{id}', [App\Http\Controllers\Admin\AdminController::class, 'view_email_lists'])->name('admin.email-marketing.email-lists.view');
            Route::get('/email-marketing/disactivate/email-lists/{id}', [App\Http\Controllers\Admin\AdminController::class, 'disactivate_email_lists'])->name('admin.email-marketing.email-lists.disactivate');
            Route::get('/email-marketing/activate/email-lists/{id}', [App\Http\Controllers\Admin\AdminController::class, 'activate_email_lists'])->name('admin.email-marketing.email-lists.activate');
            Route::post('/email-marketing/delete/email-lists/{id}', [App\Http\Controllers\Admin\AdminController::class, 'delete_email_lists'])->name('admin.email-marketing.email-lists.delete');

            // LMS
            Route::get('/viewCart', [App\Http\Controllers\Admin\AdminController::class, 'viewCart'])->name('viewCart');
            Route::get('/view-course', [App\Http\Controllers\Admin\AdminController::class, 'view_course'])->name('viewCourse');
            Route::get('/view-shop', [App\Http\Controllers\Admin\AdminController::class, 'view_shop'])->name('viewShop');
            Route::get('/course-category', [App\Http\Controllers\Admin\AdminController::class, 'view_category'])->name('viewCategory');
            Route::post('/add-course-category', [App\Http\Controllers\Admin\AdminController::class, 'add_category'])->name('addCategory');
            Route::post('/update-course-category/{id}', [App\Http\Controllers\Admin\AdminController::class, 'update_category'])->name('updateCategory');
            Route::post('/delete-course-category/{id}', [App\Http\Controllers\Admin\AdminController::class, 'delete_category'])->name('deleteCategory');
            Route::get('/view-course/course-detail/{id}', [App\Http\Controllers\Admin\AdminController::class, 'course_detail'])->name('courseDetail');
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

            Route::get('ecommerce/sales-details/{id}', [App\Http\Controllers\Admin\AdminController::class, 'sales_details'])->name('salesDetail');
            // Email Canpaign
            Route::get('email-marketing/manage', [App\Http\Controllers\Admin\AdminController::class, 'manage_campaign'])->name('admin.manage_campaign');

            // sales analytics
            Route::get('sales-analytics', [App\Http\Controllers\Admin\AdminController::class, 'sales_analytics'])->name('salesAnalytics');

            // nofitication admin
            Route::get('notification', [App\Http\Controllers\Admin\AdminController::class, 'notification'])->name('notification');

            // Admin page builder
            Route::get('page-builder', [App\Http\Controllers\Admin\AdminController::class, 'page_builder'])->name('pageBuilder');
            Route::get('funnel-builder', [App\Http\Controllers\Admin\AdminController::class, 'funnel_builder'])->name('funnelBuilder');
            Route::get('/funnel-builder/pages/{id}', [App\Http\Controllers\Admin\AdminController::class, 'view_funnel_pages'])->name('funnelBuilderView');

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
            Route::get('/add-plan/parameters/{id}', [App\Http\Controllers\Admin\AdminController::class, 'plan_parameters'])->name('admin.planParameters');
            Route::any('/add-parameters/{id}', [App\Http\Controllers\Admin\AdminController::class, 'add_plan_parameter'])->name('admin.addPlan.parameter');
            Route::post('/add-interval/{id}', [App\Http\Controllers\Admin\AdminController::class, 'add_plan_interval'])->name('admin.addPlan.interval');
            Route::post('/update-interval/{id}', [App\Http\Controllers\Admin\AdminController::class, 'update_plan_interval'])->name('admin.updatePlan.interval');
            Route::post('/delete-interval/{id}', [App\Http\Controllers\Admin\AdminController::class, 'delete_plan_interval'])->name('admin.deletePlan.interval');
        }
    );
});
