<?php

use Illuminate\Support\Facades\Route;


//User Authentications
Route::prefix('user')->group(function () {
    Route::post('/profile/update', [App\Http\Controllers\ProfileController::class, 'profile_update'])->name('user.profile.update');
    Route::post('/password/update', [App\Http\Controllers\ProfileController::class, 'password_update'])->name('user.password.update');
});