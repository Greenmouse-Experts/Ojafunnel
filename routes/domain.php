<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomSubDomain;

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
