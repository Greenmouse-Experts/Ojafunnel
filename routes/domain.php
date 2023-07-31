<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomSubDomain;
use App\Http\Controllers\PageController;

// Form Submission for page builder
Route::post('/form-submission/{id}', [PageController::class, 'handle_form_page_submission'])
    ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class])
    ->name('page.submission');

// sub domain for page and funnel builder
Route::group(['domain' => '{subdomain}.ojafunnel.com'], function () {
    Route::get('/', [CustomSubDomain::class, 'subdomainIndex']);
    Route::get('/{page}', [CustomSubDomain::class, 'subdomainPages']);
});

// custom domain for page and funnel builder
Route::group(['domain' => '{domain}'], function () {
    Route::get('/', [CustomSubDomain::class, 'domainIndex']);
    Route::get('/{page}', [CustomSubDomain::class, 'domainPages']);
});

