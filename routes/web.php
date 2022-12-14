<?php

use Illuminate\Support\Facades\Route;

// FrontEnd
Route::get('/page-builder/create', [App\Http\Controllers\PageController::class, 'page_builder_create'])->name('user.page.builder.create');
Route::get('pages/{page}/editor', [App\Http\Controllers\PageController::class, 'viewEditor'])->name('user.page.builder.view.editor');
Route::get('pages/{page}', [App\Http\Controllers\PageController::class, 'viewPage'])->name('user.page.builder.view.page');

// Route::domain(config('app.domain_url'))->group(function() {
Route::get('/', [App\Http\Controllers\HomePageController::class, 'index'])->name('index');
// Faqs
Route::get('/faqs', [App\Http\Controllers\HomePageController::class, 'faqs'])->name('faqs');
// pricing
Route::get('/pricing', [App\Http\Controllers\HomePageController::class, 'pricing'])->name('pricing');
// Contact Us
Route::get('/contact', [App\Http\Controllers\HomePageController::class, 'contact'])->name('contact');
// Login
Route::get('/login', [App\Http\Controllers\HomePageController::class, 'login'])->name('login');
// Sign In
Route::get('/signup', [App\Http\Controllers\HomePageController::class, 'signup'])->name('signup');
// Email Verification
Route::get('/emailverification', [App\Http\Controllers\HomePageController::class, 'emailverification'])->name('emailverification');
// Forgot Password
Route::get('/forgot', [App\Http\Controllers\HomePageController::class, 'forgot'])->name('forgot');
// Market Automation
Route::get('/features/marketauto', [App\Http\Controllers\HomePageController::class, 'marketauto'])->name('marketauto');
// Page Builder
Route::get('/features/pagebuilder', [App\Http\Controllers\HomePageController::class, 'pagebuilder'])->name('pagebuilder');
// Privacy
Route::get('/privacy', [App\Http\Controllers\HomePageController::class, 'privacy'])->name('privacy');
// Terms
Route::get('/terms', [App\Http\Controllers\HomePageController::class, 'terms'])->name('terms');
// EmailMarkeying
Route::get('/emailmarketing', [App\Http\Controllers\HomePageController::class, 'emailmarketing'])->name('emailmarketing');
// Chat Automation
Route::get('/chatautomation', [App\Http\Controllers\HomePageController::class, 'chatautomation'])->name('chatautomation');
// });

//User Authentications
Route::prefix('auth')->group(function () {
    Route::post('/register', [App\Http\Controllers\AuthController::class, 'register'])->name('register');
    Route::get('/verify/account/{email}', [App\Http\Controllers\AuthController::class, 'verify_account'])->name('verify.account');
    Route::post('/email/verify/resend/{email}', [App\Http\Controllers\AuthController::class, 'email_verify_resend'])->name('email.verify.resend');
    Route::post('/email/confirm/{token}', [App\Http\Controllers\AuthController::class, 'registerConfirm'])->name('email.confirmation');
    Route::post('/user/login', [App\Http\Controllers\AuthController::class, 'user_login'])->name('user.login');
    Route::post('/password/forget', [App\Http\Controllers\AuthController::class, 'forget_password'])->name('user.forget.password');
    Route::get('/reset/password/email/{email}', [App\Http\Controllers\AuthController::class, 'password_reset_email'])->name('user.reset.password');
    Route::post('update/password/reset/', [App\Http\Controllers\AuthController::class, 'reset_password'])->name('user.update.password');
});

Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

// User Dashboard
Route::prefix('{username}')->group(function () {
    // Route::domain('{username}.' . config('app.domain_url'))->group(function () {
    Route::get('/test', [App\Http\Controllers\HomePageController::class, 'test']);
    Route::prefix('dashboard')->group(
        function () {
            Route::get('/', [App\Http\Controllers\DashboardController::class, 'dashboard'])->name('user.dashboard');
            Route::get('/upgrade', [App\Http\Controllers\DashboardController::class, 'upgrade'])->name('user.upgrade');
            Route::get('/upgrade/account/{id}/{amount}', [App\Http\Controllers\DashboardController::class, 'upgrade_account'])->name('user.upgrade.account');
            Route::get('/transaction', [App\Http\Controllers\DashboardController::class, 'transaction'])->name('user.transaction');
            Route::get('/subscription', [App\Http\Controllers\DashboardController::class, 'subscription'])->name('user.subscription');
            Route::prefix('/email-marketing')->group(
                function () {
                        Route::get('/email-checker', [App\Http\Controllers\DashboardController::class, 'email_checker'])->name('user.email.checker');
                        Route::get('/email-campaign', [App\Http\Controllers\DashboardController::class, 'email_campaign'])->name('user.email.campaign');
                        Route::get('/email-campaign/email-campaign', [App\Http\Controllers\DashboardController::class, 'email_Ecampaign'])->name('user.email.Ecampaign');
                        Route::get('/email-campaign/email-layout', [App\Http\Controllers\DashboardController::class, 'email_layout'])->name('user.email.layout');
                        Route::get('/email-campaign/email-campaign/email-code', [App\Http\Controllers\DashboardController::class, 'email_code'])->name('user.email.code');
                        Route::get('/email-campaign/email-preview', [App\Http\Controllers\DashboardController::class, 'email_preview'])->name('user.email.preview');
                        Route::get('/email-campaign/email-design', [App\Http\Controllers\DashboardController::class, 'email_design'])->name('user.email.design');
                        // Route::get('/email-campaign/email-layout', [App\Http\Controllers\DashboardController::class, 'email_layout'])->name('user.email.layout');
                        // Route::get('/email-campaign/email-code', [App\Http\Controllers\DashboardController::class, 'email_code'])->name('user.email.code');
                        Route::get('/email-automation', [App\Http\Controllers\DashboardController::class, 'email_automation'])->name('user.email.automation');
                        Route::get('/automation-campaign', [App\Http\Controllers\DashboardController::class, 'automation_campaign'])->name('user.automation.campaign');
                        Route::get('/edittemplate', [App\Http\Controllers\DashboardController::class, 'edit_template'])->name('user.edit.template');
                    }
            );
            Route::prefix('/list')->group(
                function () {
                        Route::get('/create-view', [App\Http\Controllers\Mail\MailListController::class, 'create'])->name('user.create.list');
                        Route::post('/create-view/store', [App\Http\Controllers\Mail\MailListController::class, 'store'])->name('user.create_list');
                        Route::get('/view-list', [App\Http\Controllers\Mail\MailListController::class, 'index'])->name('user.view.list');
                        Route::get('/list-overview/{uid}', [App\Http\Controllers\Mail\MailListController::class, 'overview'])->name('user.view.overview');
                        Route::get('/list-performance', [App\Http\Controllers\DashboardController::class, 'list_performance'])->name('user.list.performance');
                        Route::get('/list-setting', [App\Http\Controllers\DashboardController::class, 'list_setting'])->name('user.list.setting');
                        Route::get('/list-subscribers', [App\Http\Controllers\DashboardController::class, 'list_subscribers'])->name('user.list.subscribers');
                        Route::get('/new-subscribers', [App\Http\Controllers\DashboardController::class, 'new_subscribers'])->name('user.new.subscribers');
                        Route::get('/import-subscribers', [App\Http\Controllers\DashboardController::class, 'import_subscribers'])->name('user.import.subscribers');
                        Route::get('/export-subscribers', [App\Http\Controllers\DashboardController::class, 'export_subscribers'])->name('user.export.subscribers');
                        Route::get('/segments', [App\Http\Controllers\DashboardController::class, 'segments'])->name('user.new.segments');
                        Route::get('/create-segments', [App\Http\Controllers\DashboardController::class, 'create_segments'])->name('user.create.segments');
                    }
            );
            Route::prefix('/subscribers')->group(
                function () {
                        Route::get('/mailing-list', [App\Http\Controllers\DashboardController::class, 'mailing_list'])->name('user.mailing.list');
                        Route::get('/mailing-list/contacts/{id}', [App\Http\Controllers\DashboardController::class, 'contact'])->name('user.contact');
                        Route::get('/mailing-list/add-contact/{id}', [App\Http\Controllers\DashboardController::class, 'add_contact'])->name('user.add.contact');
                        Route::get('/mailing-list/copypaste/{id}', [App\Http\Controllers\DashboardController::class, 'copy_paste'])->name('user.copy.paste');
                        Route::get('/mailing-list/upload/{id}', [App\Http\Controllers\DashboardController::class, 'upload'])->name('user.up.load');
                    }
            );
            Route::prefix('/messages')->group(
                function () {
                        Route::get('/create-message', [App\Http\Controllers\DashboardController::class, 'create_message'])->name('user.create.message');
                        Route::get('/view-message', [App\Http\Controllers\DashboardController::class, 'view_message'])->name('user.view.message');
                    }
            );
            Route::prefix('/funnel-builder')->group(
                function () {
                        Route::get('/choose-temp', [App\Http\Controllers\DashboardController::class, 'choose_temp'])->name('user.choose.temp');
                        Route::get('/choose-temp/use-template', [App\Http\Controllers\DashboardController::class, 'use_template'])->name('user.use.template');
                        Route::get('/choose-temp/product-recommendation', [App\Http\Controllers\DashboardController::class, 'product_recall'])->name('user.product.recall');
                        Route::get('/choose-temp/take-quiz', [App\Http\Controllers\DashboardController::class, 'take_quiz'])->name('user.take.quiz');
                        Route::get('/choose-temp/face-shape', [App\Http\Controllers\DashboardController::class, 'face_shape'])->name('user.face.shape');
                        Route::get('/choose-temp/choose-diamond', [App\Http\Controllers\DashboardController::class, 'choose_diamond'])->name('user.choose.diamond');
                        Route::get('/choose-temp/final-step', [App\Http\Controllers\DashboardController::class, 'final_step'])->name('user.final.step');
                        Route::get('/choose-temp/pay', [App\Http\Controllers\DashboardController::class, 'pay'])->name('user.pay');
                        Route::get('/choose-temp/congratulation', [App\Http\Controllers\DashboardController::class, 'congratulation'])->name('user.congratulation');
                    }
            );
            Route::get('/page-builder', [App\Http\Controllers\DashboardController::class, 'page_builder'])->name('user.page.builder');
            Route::get('page-builder/{page}/editor', [App\Http\Controllers\PageController::class, 'viewEditor'])->name('user.page.builder.view.editor');
            Route::get('page-builder/{page}', [App\Http\Controllers\PageController::class, 'viewPage'])->name('user.page.builder.view.page');
            Route::prefix('/chat-automation')->group(
                function () {
                        Route::get('/sms-automation', [App\Http\Controllers\DashboardController::class, 'sms_automation'])->name('user.sms.automation');
                        Route::get('/sms-automation/newsms', [App\Http\Controllers\DashboardController::class, 'newsms'])->name('user.new.sms');
                        Route::get('/whatsapp-automation', [App\Http\Controllers\DashboardController::class, 'whatsapp_automation'])->name('user.whatsapp.automation');
                        Route::get('/whatsapp-automation/sendbroadcast', [App\Http\Controllers\DashboardController::class, 'sendbroadcast'])->name('user.send.broadcast');
                    }
            );
            Route::prefix('/ecommerce')->group(
                function () {
                        Route::get('/my-store', [App\Http\Controllers\DashboardController::class, 'my_store'])->name('user.my.store');
                        Route::get('/my-store/viewstore', [App\Http\Controllers\DashboardController::class, 'viewstore'])->name('user.check.store');
                        Route::get('/my-store/storee', [App\Http\Controllers\DashboardController::class, 'store'])->name('user.store');
                        Route::get('/create-course', [App\Http\Controllers\DashboardController::class, 'create_course'])->name('user.create.course');
                        Route::get('/create-course/course-content', [App\Http\Controllers\DashboardController::class, 'course_content'])->name('user.course.content');
                        Route::get('/create-course/get-quiz', [App\Http\Controllers\DashboardController::class, 'get_quiz'])->name('user.get.quiz');
                        Route::get('/create-course/course-summary', [App\Http\Controllers\DashboardController::class, 'course_summary'])->name('user.course.summary');
                        Route::get('/create-course/enroll-now', [App\Http\Controllers\DashboardController::class, 'enroll_now'])->name('user.enroll.now');
                        Route::get('/create-course/enroll-cur', [App\Http\Controllers\DashboardController::class, 'enroll_cur'])->name('user.enroll.cur');
                    }
            );
            Route::get('/affiliate-marketing', [App\Http\Controllers\DashboardController::class, 'affiliate_marketing'])->name('user.affiliate.marketing');
            Route::get('/integration', [App\Http\Controllers\DashboardController::class, 'integration'])->name('user.integration');
            Route::get('/manage-integration', [App\Http\Controllers\DashboardController::class, 'manage_integration'])->name('user.manage_integration');
            Route::get('/reports-analysis', [App\Http\Controllers\DashboardController::class, 'reports_analysis'])->name('user.reports.analysis');
            Route::get('/help', [App\Http\Controllers\DashboardController::class, 'help'])->name('user.help');
            Route::prefix('/settings')->group(
                function () {
                        Route::get('/general', [App\Http\Controllers\DashboardController::class, 'general'])->name('user.general');
                        Route::get('/security', [App\Http\Controllers\DashboardController::class, 'security'])->name('user.security');
                    }
            );
        }
    );
});

// Admin Login
Route::get('/admin/login', [App\Http\Controllers\AuthController::class, 'adminlogin'])->name('adminlogin');

// Admin Login
Route::get('/admin/welcome', [App\Http\Controllers\AdminController::class, 'adminwelcome'])->name('adminwelcome');
Route::get('/admin/view_users', [App\Http\Controllers\AdminController::class, 'view_users'])->name('view_users');
Route::get('/admin/add_plans', [App\Http\Controllers\AdminController::class, 'add_plans'])->name('add_plans');
Route::get('/admin/manage_plans', [App\Http\Controllers\AdminController::class, 'manage_plans'])->name('manage_plans');
Route::get('/admin/viewmessage', [App\Http\Controllers\AdminController::class, 'viewmessage'])->name('viewmessage');
Route::get('/admin/transactions', [App\Http\Controllers\AdminController::class, 'transactions'])->name('transactions');
Route::get('/admin/subscriptions', [App\Http\Controllers\AdminController::class, 'subscriptions'])->name('subscriptions');
Route::get('/admin/security', [App\Http\Controllers\AdminController::class, 'security'])->name('security');
Route::get('/admin/general', [App\Http\Controllers\AdminController::class, 'general'])->name('general');
Route::get('/admin/subscribtions', [App\Http\Controllers\AdminController::class, 'subscribtions'])->name('subscribtions');
Route::get('/admin/vendorlist', [App\Http\Controllers\AdminController::class, 'vendorlist'])->name('vendorlist');
Route::get('/admin/vendordetails', [App\Http\Controllers\AdminController::class, 'vendordetails'])->name('vendordetails');
Route::get('/admin/affiliateList', [App\Http\Controllers\AdminController::class, 'affiliateList'])->name('affiliateList');
Route::get('/admin/product', [App\Http\Controllers\AdminController::class, 'product'])->name('product');
Route::get('/admin/addProduct', [App\Http\Controllers\AdminController::class, 'addProduct'])->name('addProduct');
Route::get('/admin/productDetails', [App\Http\Controllers\AdminController::class, 'productDetails'])->name('productDetails');
Route::get('/admin/viewCart', [App\Http\Controllers\AdminController::class, 'viewCart'])->name('viewCart');
