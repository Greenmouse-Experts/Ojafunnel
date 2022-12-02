<?php

use Illuminate\Support\Facades\Route;


//User Authentications
Route::prefix('user')->group(function () {
    // Profile
    Route::post('/profile/update', [App\Http\Controllers\ProfileController::class, 'profile_update'])->name('user.profile.update');
    Route::post('/password/update', [App\Http\Controllers\ProfileController::class, 'password_update'])->name('user.password.update');
    
    // Email Campaign
    Route::post('/email/campaign/checker', [App\Http\Controllers\EmailCampaignController::class, 'email_campaign_checker'])->name('user.email.campaign.checker');

    // SMS Automation
    Route::post('/sms/sendmessage/campaign', [App\Http\Controllers\SmsAutomationController::class, 'sms_sendmessage_campaign'])->name('user.sms.sendmessage.campaign');

    // Intgration
    Route::post('/integration/create', [App\Http\Controllers\IntegrationController::class, 'integration_create'])->name('user.integration.create');
    Route::post('/integration/update/{id}', [App\Http\Controllers\IntegrationController::class, 'integration_update'])->name('user.integration.update');
    Route::get('/integration/enable/{id}', [App\Http\Controllers\IntegrationController::class, 'integration_enable'])->name('user.integration.enable');
    Route::get('/integration/disable/{id}', [App\Http\Controllers\IntegrationController::class, 'integration_disable'])->name('user.integration.disable');
    Route::post('/integration/delete/{id}', [App\Http\Controllers\IntegrationController::class, 'integration_delete'])->name('user.integration.delete');

    // Subscribers
    Route::post('/subscriber/mailing/create', [App\Http\Controllers\SubscriberController::class, 'subscriber_mailing_create'])->name('user.subscriber.mailing.create');
    Route::get('/subscriber/mailing/enable/{id}', [App\Http\Controllers\SubscriberController::class, 'subscriber_mailing_enable'])->name('user.subscriber.mailing.enable');
    Route::get('/subscriber/mailing/disable/{id}', [App\Http\Controllers\SubscriberController::class, 'subscriber_mailing_disable'])->name('user.subscriber.mailing.disable');
    Route::post('/subscriber/mailing/delete/{id}', [App\Http\Controllers\SubscriberController::class, 'subscriber_mailing_delete'])->name('user.subscriber.mailing.delete');
    Route::post('/subscriber/mailing/contact/create/{id}', [App\Http\Controllers\SubscriberController::class, 'subscriber_mailing_contact_create'])->name('user.subscriber.mailing.contact.create');
    Route::post('/subscriber/mailing/contact/upload/{id}', [App\Http\Controllers\SubscriberController::class, 'subscriber_mailing_contact_upload'])->name('user.subscriber.mailing.contact.upload');
    Route::post('/subscriber/mailing/contact/copy/paste/{id}', [App\Http\Controllers\SubscriberController::class, 'subscriber_mailing_contact_copy_paste'])->name('user.subscriber.mailing.contact.copy.paste');
    Route::post('/subscriber/mailing/contact/update/{id}', [App\Http\Controllers\SubscriberController::class, 'subscriber_mailing_contact_update'])->name('user.subscriber.mailing.contact.update');
    Route::post('/subscriber/mailing/contact/delete/{id}', [App\Http\Controllers\SubscriberController::class, 'subscriber_mailing_contact_delete'])->name('user.subscriber.mailing.contact.delete');
    Route::get('/subscriber/mailing/format/download', [App\Http\Controllers\SubscriberController::class, 'subscriber_download_format'])->name('user.subscriber.download.format');

    // Page Builder
    Route::get('/page/builder/create', [App\Http\Controllers\PageController::class, 'page_builder_create'])->name('user.page.builder.create');
    Route::post('/page/builder/update/{id}', [App\Http\Controllers\PageController::class, 'page_builder_update'])->name('user.page.builder.update');
    Route::post('/page/builder/delete/{id}', [App\Http\Controllers\PageController::class, 'page_builder_delete'])->name('user.page.builder.delete');
});