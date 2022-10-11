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

// Dahboard Part
Route::get('/dashboard', [App\Http\Controllers\HomePageController::class, 'dashboard'])->name('dashboard');