<?php

use Illuminate\Support\Facades\Route;

// FrontEnd
// Route::domain(config('app.domain_url'))->group(function() {
    Route::get('/', [App\Http\Controllers\HomePageController::class, 'index'])->name('index');
    // Faqs
    Route::get('/faqs', [App\Http\Controllers\HomePageController::class, 'faqs'])->name('faqs');
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
    Route::post('/password/forget',  [App\Http\Controllers\AuthController::class, 'forget_password'])->name('user.forget.password');
    Route::get('/reset/password/email/{email}', [App\Http\Controllers\AuthController::class, 'password_reset_email'])->name('user.reset.password');
    Route::post('update/password/reset/', [App\Http\Controllers\AuthController::class, 'reset_password'])->name('user.update.password');
});

Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

// User Dashboard
Route::domain('{username}.'. config('app.domain_url'))->group(function() {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [App\Http\Controllers\DashboardController::class, 'dashboard'])->name('user.dashboard');
        Route::prefix('/email-marketing')->group(function () {
            Route::get('/email-checker', [App\Http\Controllers\DashboardController::class, 'email_checker'])->name('user.email.checker');
            Route::get('/email-campaign', [App\Http\Controllers\DashboardController::class, 'email_campaign'])->name('user.email.campaign');
            Route::get('/email-campaign/email-campaign', [App\Http\Controllers\DashboardController::class, 'email_Ecampaign'])->name('user.email.Ecampaign');
            Route::get('/email-campaign/email-campaign/email-layout', [App\Http\Controllers\DashboardController::class, 'email_layout'])->name('user.email.layout');
            Route::get('/email-campaign/email-campaign/email-code', [App\Http\Controllers\DashboardController::class, 'email_code'])->name('user.email.code');
            Route::get('/email-campaign/email-preview', [App\Http\Controllers\DashboardController::class, 'email_preview'])->name('user.email.preview');
            Route::get('/email-campaign/email-design', [App\Http\Controllers\DashboardController::class, 'email_design'])->name('user.email.design');
            // Route::get('/email-campaign/email-layout', [App\Http\Controllers\DashboardController::class, 'email_layout'])->name('user.email.layout');
            // Route::get('/email-campaign/email-code', [App\Http\Controllers\DashboardController::class, 'email_code'])->name('user.email.code');
            Route::get('/email-automation', [App\Http\Controllers\DashboardController::class, 'email_automation'])->name('user.email.automation');
            Route::get('/automation-campaign', [App\Http\Controllers\DashboardController::class, 'automation_campaign'])->name('user.automation.campaign');
            Route::get('/edittemplate', [App\Http\Controllers\DashboardController::class, 'edit_template'])->name('user.edit.template');
        });
        Route::prefix('/subscribers')->group(function () {
            Route::get('/mailing-list', [App\Http\Controllers\DashboardController::class, 'mailing_list'])->name('user.mailing.list');
            Route::get('/mailing-list/add-contact', [App\Http\Controllers\DashboardController::class, 'add_contact'])->name('user.add.contact');
            Route::get('/mailing-list/copypaste', [App\Http\Controllers\DashboardController::class, 'copy_paste'])->name('user.copy.paste');
            Route::get('/mailing-list/upload', [App\Http\Controllers\DashboardController::class, 'upload'])->name('user.up.load');
        });
        Route::prefix('/messages')->group(function () {
            Route::get('/create-message', [App\Http\Controllers\DashboardController::class, 'create_message'])->name('user.create.message');
            Route::get('/view-message', [App\Http\Controllers\DashboardController::class, 'view_message'])->name('user.view.message');
        });
        Route::prefix('/funnel-builder')->group(function () {
            Route::get('/choose-temp', [App\Http\Controllers\DashboardController::class, 'choose_temp'])->name('user.choose.temp');
            Route::get('/choose-temp/use-template', [App\Http\Controllers\DashboardController::class, 'use_template'])->name('user.use.template');
            Route::get('/choose-temp/product-recommendation', [App\Http\Controllers\DashboardController::class, 'product_recall'])->name('user.product.recall');
            Route::get('/choose-temp/take-quiz', [App\Http\Controllers\DashboardController::class, 'take_quiz'])->name('user.take.quiz');
            Route::get('/choose-temp/face-shape', [App\Http\Controllers\DashboardController::class, 'face_shape'])->name('user.face.shape');
            Route::get('/choose-temp/choose-diamond', [App\Http\Controllers\DashboardController::class, 'choose_diamond'])->name('user.choose.diamond');
            Route::get('/choose-temp/final-step', [App\Http\Controllers\DashboardController::class, 'final_step'])->name('user.final.step');
        });
        Route::get('/page-builder', [App\Http\Controllers\DashboardController::class, 'page_builder'])->name('user.page.builder');
        Route::prefix('/chat-automation')->group(function () {
            Route::get('/sms-automation', [App\Http\Controllers\DashboardController::class, 'sms_automation'])->name('user.sms.automation');
            Route::get('/sms-automation/newsms', [App\Http\Controllers\DashboardController::class, 'newsms'])->name('user.new.sms');
            Route::get('/whatsapp-automation', [App\Http\Controllers\DashboardController::class, 'whatsapp_automation'])->name('user.whatsapp.automation');
            Route::get('/whatsapp-automation/sendbroadcast', [App\Http\Controllers\DashboardController::class, 'sendbroadcast'])->name('user.send.broadcast');
        });
        Route::prefix('/ecommerce')->group(function () {
            Route::get('/my-store', [App\Http\Controllers\DashboardController::class, 'my_store'])->name('user.my.store');
            Route::get('/my-store/viewstore', [App\Http\Controllers\DashboardController::class, 'viewstore'])->name('user.check.store');
            Route::get('/my-store/storee', [App\Http\Controllers\DashboardController::class, 'store'])->name('user.store');
            Route::get('/create-course', [App\Http\Controllers\DashboardController::class, 'create_course'])->name('user.create.course');
            Route::get('/create-course/course-content', [App\Http\Controllers\DashboardController::class, 'course_content'])->name('user.course.content');
            Route::get('/create-course/get-quiz', [App\Http\Controllers\DashboardController::class, 'get_quiz'])->name('user.get.quiz');
            Route::get('/create-course/course-summary', [App\Http\Controllers\DashboardController::class, 'course_summary'])->name('user.course.summary');
            Route::get('/create-course/enroll-now', [App\Http\Controllers\DashboardController::class, 'enroll_now'])->name('user.enroll.now');
            Route::get('/create-course/enroll-cur', [App\Http\Controllers\DashboardController::class, 'enroll_cur'])->name('user.enroll.cur');
        });
        Route::get('/affiliate-marketing', [App\Http\Controllers\DashboardController::class, 'affiliate_marketing'])->name('user.affiliate.marketing');
        Route::get('/integration', [App\Http\Controllers\DashboardController::class, 'integration'])->name('user.integration');
        Route::get('/reports-analysis', [App\Http\Controllers\DashboardController::class, 'reports_analysis'])->name('user.reports.analysis');
        Route::get('/help', [App\Http\Controllers\DashboardController::class, 'help'])->name('user.help');
        Route::prefix('/settings')->group(function () {
            Route::get('/general', [App\Http\Controllers\DashboardController::class, 'general'])->name('user.general');
            Route::get('/security', [App\Http\Controllers\DashboardController::class, 'security'])->name('user.security');
        });
    });
});
    