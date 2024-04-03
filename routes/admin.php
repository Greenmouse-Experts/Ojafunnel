<?php

use App\Http\Controllers\Admin\AdminController;
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
            Route::get('/user/login/{id}', [App\Http\Controllers\Admin\AdminController::class, 'user_login'])->name('admin.user.login');
            Route::get('/view_users/users-details/{id}', [App\Http\Controllers\Admin\CustomerController::class, 'view'])->name('users.details');
            Route::get('/add_plans', [App\Http\Controllers\Admin\AdminController::class, 'add_plans'])->name('add_plans');
            Route::get('/manage_plans', [App\Http\Controllers\Admin\AdminController::class, 'manage_plans'])->name('manage_plans');
            Route::get('/viewmessage', [App\Http\Controllers\Admin\AdminController::class, 'viewmessage'])->name('viewmessage');
            Route::get('/all/transactions', [App\Http\Controllers\Admin\AdminController::class, 'all_transactions'])->name('all_transactions');
            Route::get('/recent/transactions', [App\Http\Controllers\Admin\AdminController::class, 'recent_transactions'])->name('recent_transactions');
            Route::get('/subscriptions', [App\Http\Controllers\Admin\AdminController::class, 'subscriptions'])->name('subscriptions');
            Route::get('/security', [App\Http\Controllers\Admin\AdminController::class, 'security'])->name('security');
            Route::get('/general', [App\Http\Controllers\Admin\AdminController::class, 'general'])->name('general');
            Route::get('/subscribtions', [App\Http\Controllers\Admin\AdminController::class, 'subscribtions'])->name('admin.subcribers');
            Route::get('/unscribers', [App\Http\Controllers\Admin\AdminController::class, 'unscribers'])->name('admin.unscribers');
            Route::get('/vendorlist', [App\Http\Controllers\Admin\AdminController::class, 'vendorlist'])->name('vendorlist');
            Route::get('/trans_details', [App\Http\Controllers\Admin\AdminController::class, 'trans_details'])->name('trans.details');
            Route::get('/affiliateList', [App\Http\Controllers\Admin\AdminController::class, 'affiliateList'])->name('affiliateList');

            // Affiliate
            Route::get('/affiliateLevel', [App\Http\Controllers\Admin\AdminController::class, 'affiliateLevel'])->name('affiliateLevel');
            Route::post('/affiliate-levels/create', [AdminController::class, 'create_affiliateLevel'])->name('affiliate-levels.create');
            Route::post('/affiliate-levels/{id}', [AdminController::class, 'update_affiliateLevel'])->name('affiliate-levels.update');
            Route::delete('/affiliate-levels/{affiliatelevel}', [AdminController::class, 'delete_affiliateLevel'])->name('affiliate-levels.delete');

            Route::post('/add-users', [App\Http\Controllers\Admin\AdminController::class, 'add_users']); //
            Route::post('/update-prvdg', [App\Http\Controllers\Admin\AdminController::class, 'update_prvdg']); //

            Route::post('/send-broadcast', [App\Http\Controllers\Admin\AdminController::class, 'send_broadcast']); //
            Route::post('/get-statistics', [App\Http\Controllers\Admin\AdminController::class, 'getStatistics']); //

            Route::post('/renew-extend', [App\Http\Controllers\Admin\AdminController::class, 'renew_extend'])->name('renewExtend'); //
            Route::post('/react-feature', [App\Http\Controllers\Admin\AdminController::class, 'react_feature']); //

            Route::post('/send-newsletter', [App\Http\Controllers\Admin\AdminController::class, 'sendNewsletter'])->name('send.newsletter');
            Route::get('/download-attachment/{filename}', [App\Http\Controllers\Admin\AdminController::class, 'download'])->name('download.attachment');

            // Email Marketing
            Route::get('/email-marketing/validate-email', [App\Http\Controllers\Admin\AdminController::class, 'validate_email'])->name('validate-email'); //
            Route::post('/validate-user-emails', [App\Http\Controllers\Admin\AdminController::class, 'validate_user_emails']); //
            Route::post('/fetch-referrals', [App\Http\Controllers\Admin\AdminController::class, 'fetch_referrals']); //
            Route::post('/get-users-prvd', [App\Http\Controllers\Admin\AdminController::class, 'get_users_prvd']); //

            Route::post('/clrs', [App\Http\Controllers\Admin\AdminController::class, 'clrs'])->name('clrs'); //
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
            Route::get('/broadcast', [App\Http\Controllers\Admin\AdminController::class, 'broadcast'])->name('broadcast'); //
            Route::get('/priviledges', [App\Http\Controllers\Admin\AdminController::class, 'priviledges'])->name('priviledges'); //

            Route::post('/reply/email-support/{id}', [App\Http\Controllers\Admin\AdminController::class, 'reply_email_support'])->name('replyEmailSupport');
            Route::post('/send/email/user', [App\Http\Controllers\Admin\AdminController::class, 'send_email_to_user'])->name('admin.send.message.user');
            Route::get('/chat-support', [App\Http\Controllers\Admin\AdminController::class, 'chat_support'])->name('chatSupport');
            Route::get('/sms-automation', [App\Http\Controllers\Admin\AdminController::class, 'sms_automation'])->name('smsAutomation');
            Route::get('/whatsapp-automation', [App\Http\Controllers\Admin\AdminController::class, 'whatsapp_automation'])->name('whatsappAutomation');
            Route::get('/integration', [App\Http\Controllers\Admin\AdminController::class, 'integration'])->name('integration');
            Route::get('/birthday-module', [App\Http\Controllers\Admin\AdminController::class, 'birthday_module'])->name('birthdayModule');

            Route::get('/exchange-rate', [App\Http\Controllers\Admin\AdminController::class, 'lms_xrate'])->name('system.xrate');
            Route::post('/exchange-rate/update', [App\Http\Controllers\Admin\AdminController::class, 'lms_xrate_submit'])->name('xrate.update');
            // Whatsapp Support
            Route::get('/support/whatsapp', [App\Http\Controllers\Admin\AdminController::class, 'support_whatsapp'])->name('whatsappSupport');
            Route::post('/add/support/whatsapp', [App\Http\Controllers\Admin\AdminController::class, 'add_support_whatsapp'])->name('whatsappSupportAdd');
            Route::post('/delete-support-whatsapp/{id}', [App\Http\Controllers\Admin\AdminController::class, 'delete_support_whatsapp'])->name('deleteWhatsappSupport');

            // Support
            Route::get('/support/checkConvo/{recieverId}', [App\Http\Controllers\Admin\AdminController::class, 'check']);
            Route::post('/support/sendMessage', [App\Http\Controllers\Admin\AdminController::class, 'store'])->name('sendMessage');
            Route::get('/support/loadMessage/{reciever}/{sender}', [App\Http\Controllers\Admin\AdminController::class, 'load']);
            Route::get('/support/retrieveMessages/{reciever}/{sender}/{lastMsgId}', [App\Http\Controllers\Admin\AdminController::class, 'retrieveNew']);
            Route::post('/support/markMessageAsRead/{messageId}', [App\Http\Controllers\Admin\AdminController::class, 'markMessageAsRead']);

            Route::get('ecommerce/sales-details/{id}', [App\Http\Controllers\Admin\AdminController::class, 'sales_details'])->name('salesDetail');
            // Email Canpaign
            Route::get('email-marketing/manage', [App\Http\Controllers\Admin\AdminController::class, 'manage_campaign'])->name('admin.manage_campaign');

            // sales analytics
            Route::get('sales-analytics', [App\Http\Controllers\Admin\AdminController::class, 'sales_analytics'])->name('salesAnalytics');
            Route::get('email-analytics', [App\Http\Controllers\Admin\AdminController::class, 'email_analytics'])->name('emailAnalytics'); //

            // nofitication admin
            Route::get('notification', [App\Http\Controllers\Admin\AdminController::class, 'notification'])->name('notification');

            // Admin page builder
            Route::get('page-builder', [App\Http\Controllers\Admin\AdminController::class, 'page_builder'])->name('pageBuilder');
            Route::get('funnel-builder', [App\Http\Controllers\Admin\AdminController::class, 'funnel_builder'])->name('funnelBuilder');
            Route::get('funnel-builder/categories', [App\Http\Controllers\Admin\AdminController::class, 'funnel_builder_categories'])->name('funnelBuilder.categories');
            Route::post('/funnel-builder/categories', [App\Http\Controllers\Admin\AdminController::class, 'funnel_category_create'])->name('funnelBuilder.categories.add');
            Route::get('/funnel-builder/categories/{id}/delete', [App\Http\Controllers\Admin\AdminController::class, 'funnel_category_delete'])->name('funnelBuilder.categories.delete');
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
            Route::get('/newsletter', [App\Http\Controllers\Admin\AdminController::class, 'newsletter'])->name('newsletter');
            Route::post('/delete-newsletter/{id}', [App\Http\Controllers\Admin\AdminController::class, 'delete_newsletter'])->name('deleteNewsletter');

            Route::get('/faq', [App\Http\Controllers\Admin\AdminController::class, 'view_faq'])->name('viewFaq');
            Route::post('/add-faq', [App\Http\Controllers\Admin\AdminController::class, 'add_faq'])->name('addFaq');
            Route::post('/update-faq/{id}', [App\Http\Controllers\Admin\AdminController::class, 'update_faq'])->name('updateFaq');
            Route::post('/delete-faq/{id}', [App\Http\Controllers\Admin\AdminController::class, 'delete_faq'])->name('deleteFaq');

            Route::get('/contact-us', [App\Http\Controllers\Admin\AdminController::class, 'view_contact_us'])->name('viewContactUs');
            Route::post('/delete-contact-us/{id}', [App\Http\Controllers\Admin\AdminController::class, 'delete_contact_us'])->name('deleteContactUs');

            // Save FCM Token
            Route::post('/save-token', [AdminController::class, 'saveToken'])->name('admin.save.token');

            // Demo Video
            Route::get('/demo-video', [AdminController::class, 'demoVideo'])->name('admin.demo.video');
            Route::post('/update/demo-video', [AdminController::class, 'updateDemoVideo'])->name('admin.update.demo.video');

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

            // Birthday Module
            Route::post('/admin/update-birthday/{id}', [App\Http\Controllers\Admin\AdminController::class, 'update_birthday'])->name('admin.update.birthday');
            Route::post('/admin/delete-birthday/{id}', [App\Http\Controllers\Admin\AdminController::class, 'delete_birthday'])->name('admin.delete.birthday');

            // Email kit
            Route::post('/integration/email/admin_create', [App\Http\Controllers\Admin\AdminController::class, 'integration_email_admin_create'])->name('user.integration.email.admin_create');
            Route::post('/integration/email/admin_update', [App\Http\Controllers\Admin\AdminController::class, 'integration_email_admin_update'])->name('user.integration.email.admin_update');
            Route::post('/integration/email/admin_delete', [App\Http\Controllers\Admin\AdminController::class, 'integration_email_admin_delete'])->name('user.integration.email.admin_delete');
            Route::post('/integration/email/admin_master', [App\Http\Controllers\Admin\AdminController::class, 'integration_email_admin_master'])->name('user.integration.email.admin_master');

            // List Management
            Route::get('/user/list/management', [App\Http\Controllers\Admin\AdminController::class, 'user_list'])->name('admin.user.list');
            Route::get('/user/list/management/view/{id}', [App\Http\Controllers\Admin\AdminController::class, 'view_list'])->name('admin.view.user.list');
            Route::get('/user/list/management/list/edit/{id}', [App\Http\Controllers\Admin\AdminController::class, 'edit_list'])->name('admin.edit.user.list');
            Route::post('/user/management/update/{id}', [App\Http\Controllers\Admin\AdminController::class, 'update_list'])->name('admin.user.update.list');
            Route::get('/user/management/enable/{id}', [App\Http\Controllers\Admin\AdminController::class, 'enable_list'])->name('admin.user.enable.list');
            Route::get('/user/management/disabled/{id}', [App\Http\Controllers\Admin\AdminController::class, 'disable_list'])->name('admin.user.disable.list');
            Route::post('/user/management/delete/{id}', [App\Http\Controllers\Admin\AdminController::class, 'delete_list'])->name('admin.user.delete.list');
            Route::get('/user/list/management/contact/edit/{id}', [App\Http\Controllers\Admin\AdminController::class, 'edit_contact'])->name('admin.user.edit.contact');
            Route::post('/user/list/management/contact/update/{id}', [App\Http\Controllers\Admin\AdminController::class, 'update_contact'])->name('admin.user.update.contact');
            Route::post('/user/list/management/contact/delete/{id}', [App\Http\Controllers\Admin\AdminController::class, 'delete_contact'])->name('admin.user.delete.contact');

            // Integration
            Route::get('/integration/enable/{id}', [App\Http\Controllers\Admin\AdminController::class, 'integration_enable'])->name('admin.integration.enable');
            Route::get('/integration/disable/{id}', [App\Http\Controllers\Admin\AdminController::class, 'integration_disable'])->name('admin.integration.disable');
            Route::post('/integration/delete/{id}', [App\Http\Controllers\Admin\AdminController::class, 'integration_delete'])->name('admin.integration.delete');

            Route::get('/payment/gateway', [App\Http\Controllers\Admin\AdminController::class, 'payment_gateway'])->name('admin.payment.gateway');
            Route::get('/view/payment/gateway/{id}', [App\Http\Controllers\Admin\AdminController::class, 'viewPaymentGateway'])->name('viewPaymentGateway');
            Route::post('/update/payment/gateway', [App\Http\Controllers\Admin\AdminController::class, 'updatePaymentGateway'])->name('updatePaymentGateway');

            Route::get('/general/exchange/rate', [App\Http\Controllers\Admin\AdminController::class, 'general_exchange_rate'])->name('admin.general.exchange.rate');
            Route::post('/general/exchange/rate/add', [App\Http\Controllers\Admin\AdminController::class, 'add_general_exchange_rate'])->name('admin.add.general.exchange.rate');
            Route::post('/general/exchange/rate/update/{id}', [App\Http\Controllers\Admin\AdminController::class, 'update_general_exchange_rate'])->name('admin.update.general.exchange.rate');
            Route::get('/general/explainer/contents', [App\Http\Controllers\Admin\AdminController::class, 'explainer_contents'])->name('admin.general.explainer.contents');
            Route::post('/general/update/explainer/content/{id}', [App\Http\Controllers\Admin\AdminController::class, 'update_explainer_content'])->name('admin.update.general.explainer.content');


            Route::post('/wa-number/generate-qr', [App\Http\Controllers\Admin\AdminController::class, 'generate_wa_qr'])->name('admin.whatsapp.wa-number-generate-qr');
            Route::post('/wa-number/logout-session', [App\Http\Controllers\Admin\AdminController::class, 'logout_wa_session'])->name('admin.whatsapp.wa-number-logout-session');
            Route::post('/wa-number/check-session-connection', [App\Http\Controllers\Admin\AdminController::class, 'check_wa_session_connection'])->name('admin.whatsapp.wa-number-check-session-connection');
            Route::post('/wa-number/create', [App\Http\Controllers\Admin\AdminController::class, 'create_wa_number'])->name('admin.whatsapp.create-wa-number');
            Route::post('/wa-number/update', [App\Http\Controllers\Admin\AdminController::class, 'update_wa_number'])->name('admin.whatsapp.update-wa-number');
            Route::post('/wa-number/delete', [App\Http\Controllers\Admin\AdminController::class, 'delete_wa_number'])->name('admin.whatsapp.delete-wa-number');


            // Whatsapp Broadcast
            Route::get('/wa-automation', [App\Http\Controllers\Admin\AdminController::class, 'wa_automation'])->name('admin.wa-automation');
            Route::get('/wa-automation/broadcast', [App\Http\Controllers\Admin\AdminController::class, 'broadcast_wa_message'])->name('admin.wa-automation.broadcast');
            Route::get('/wa-automation/broadcast/create', [App\Http\Controllers\Admin\AdminController::class, 'broadcast_wa_message_create'])->name('admin.wa-automation.broadcast.create');
            Route::post('/wa-automation/broadcast/create', [App\Http\Controllers\Admin\AdminController::class, 'broadcast_wa_message_create'])->name('admin.wa-automation.broadcast.create');
        }
    );
});
