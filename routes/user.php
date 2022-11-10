<?php

use Illuminate\Support\Facades\Route;


//User Authentications
Route::prefix('user')->group(function () {
    Route::post('/profile/update', [App\Http\Controllers\ProfileController::class, 'profile_update'])->name('user.profile.update');
    Route::post('/password/update', [App\Http\Controllers\ProfileController::class, 'password_update'])->name('user.password.update');
    Route::post('/integration/twilio/create', [App\Http\Controllers\SmsAutomationController::class, 'integration_twilio_create'])->name('user.integration.twilio.create');
    Route::post('/subscriber/mailing/create', [App\Http\Controllers\SubscriberController::class, 'subscriber_mailing_create'])->name('user.subscriber.mailing.create');
    Route::get('/subscriber/mailing/enable/{id}', [App\Http\Controllers\SubscriberController::class, 'subscriber_mailing_enable'])->name('user.subscriber.mailing.enable');
    Route::get('/subscriber/mailing/disable/{id}', [App\Http\Controllers\SubscriberController::class, 'subscriber_mailing_disable'])->name('user.subscriber.mailing.disable');
    Route::post('/subscriber/mailing/delete/{id}', [App\Http\Controllers\SubscriberController::class, 'subscriber_mailing_delete'])->name('user.subscriber.mailing.delete');
    Route::post('/subscriber/mailing/contact/create/{id}', [App\Http\Controllers\SubscriberController::class, 'subscriber_mailing_contact_create'])->name('user.subscriber.mailing.contact.create');
    Route::post('/subscriber/mailing/contact/upload/{id}', [App\Http\Controllers\SubscriberController::class, 'subscriber_mailing_contact_upload'])->name('user.subscriber.mailing.contact.upload');
    Route::post('/subscriber/mailing/contact/copy/paste/{id}', [App\Http\Controllers\SubscriberController::class, 'subscriber_mailing_contact_copy_paste'])->name('user.subscriber.mailing.contact.copy.paste');
    Route::post('/subscriber/mailing/contact/update/{id}', [App\Http\Controllers\SubscriberController::class, 'subscriber_mailing_contact_update'])->name('user.subscriber.mailing.contact.update');
    Route::post('/subscriber/mailing/contact/delete/{id}', [App\Http\Controllers\SubscriberController::class, 'subscriber_mailing_contact_delete'])->name('user.subscriber.mailing.contact.delete');
});