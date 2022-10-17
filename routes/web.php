<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// FrontEnd

Route::get('/', [App\Http\Controllers\HomePageController::class, 'index'])->name('index');
// Faqs
Route::get('/faqs', [App\Http\Controllers\HomePageController::class, 'faqs'])->name('faqs');
// Contact Us
Route::get('/contact', [App\Http\Controllers\HomePageController::class, 'contact'])->name('contact');
// Login
Route::get('/login', [App\Http\Controllers\HomePageController::class, 'login'])->name('login');
// Sign In
Route::get('/signup', [App\Http\Controllers\HomePageController::class, 'signup'])->name('signup');
// Forgor
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


// User Dashboard
Route::prefix('dashboard')->group(function () {
    Route::get('/', [App\Http\Controllers\DashboardController::class, 'dashboard'])->name('user.dashboard');
    Route::prefix('/email-marketing')->group(function () {
        Route::get('/email-checker', [App\Http\Controllers\DashboardController::class, 'email_checker'])->name('user.email.checker');
        Route::get('/email-campaign', [App\Http\Controllers\DashboardController::class, 'email_campaign'])->name('user.email.campaign');
        Route::get('/email-campaign/email-design', [App\Http\Controllers\DashboardController::class, 'email_design'])->name('user.email.design');
        Route::get('/email-campaign/email-layout', [App\Http\Controllers\DashboardController::class, 'email_layout'])->name('user.email.layout');
        Route::get('/email-campaign/email-code', [App\Http\Controllers\DashboardController::class, 'email_code'])->name('user.email.code');
        Route::get('/email-automation', [App\Http\Controllers\DashboardController::class, 'email_automation'])->name('user.email.automation');
        Route::get('/automation-campaign', [App\Http\Controllers\DashboardController::class, 'automation_campaign'])->name('user.automation.campaign');
    });
    Route::prefix('/subscribers')->group(function () {
        Route::get('/mailing-list', [App\Http\Controllers\DashboardController::class, 'mailing_list'])->name('user.mailing.list');
    });
    Route::prefix('/messages')->group(function () {
        Route::get('/create-message', [App\Http\Controllers\DashboardController::class, 'create_message'])->name('user.create.message');
        Route::get('/view-message', [App\Http\Controllers\DashboardController::class, 'view_message'])->name('user.view.message');
    });
    Route::get('/page-builder', [App\Http\Controllers\DashboardController::class, 'page_builder'])->name('user.page.builder');
    Route::prefix('/chat-automation')->group(function () {
        Route::get('/sms-automation', [App\Http\Controllers\DashboardController::class, 'sms_automation'])->name('user.sms.automation');
        Route::get('/whatsapp-automation', [App\Http\Controllers\DashboardController::class, 'whatsapp_automation'])->name('user.whatsapp.automation');
    });
    Route::prefix('/ecommerce')->group(function () {
        Route::get('/my-store', [App\Http\Controllers\DashboardController::class, 'my_store'])->name('user.my.store');
        Route::get('/create-course', [App\Http\Controllers\DashboardController::class, 'create_course'])->name('user.create.course');
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