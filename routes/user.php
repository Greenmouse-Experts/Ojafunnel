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
    Route::post('/page/builder/create', [App\Http\Controllers\PageController::class, 'page_builder_create'])->name('user.page.builder.create');
    Route::post('/page/builder/save/page', [App\Http\Controllers\PageController::class, 'page_builder_save_page'])->name('user.page.builder.save.page');
    Route::post('/page/builder/update/{id}', [App\Http\Controllers\PageController::class, 'page_builder_update'])->name('user.page.builder.update');
    Route::post('/page/builder/delete/{id}', [App\Http\Controllers\PageController::class, 'page_builder_delete'])->name('user.page.builder.delete');

    // Funnel Builder
    Route::post('/funnel/builder/create/folder', [App\Http\Controllers\PageController::class, 'funnel_builder_create_folder'])->name('user.funnel.builder.create.folder');
    Route::post('/funnel/builder/update/{id}', [App\Http\Controllers\PageController::class, 'funnel_builder_update'])->name('user.funnel.builder.update');
    Route::post('/funnel/builder/delete/{id}', [App\Http\Controllers\PageController::class, 'funnel_builder_delete'])->name('user.funnel.builder.delete');
    Route::post('/funnel/builder/create/page', [App\Http\Controllers\PageController::class, 'funnel_builder_create_page'])->name('user.funnel.builder.create.page');
    Route::post('/funnel/builder/update/page/{id}', [App\Http\Controllers\PageController::class, 'funnel_builder_update_page'])->name('user.funnel.builder.update.page');
    Route::post('/funnel/builder/delete/page/{id}', [App\Http\Controllers\PageController::class, 'funnel_builder_delete_page'])->name('user.funnel.builder.delete.page');
    Route::post('/funnel/builder/save/page', [App\Http\Controllers\PageController::class, 'funnel_builder_save_page'])->name('user.funnel.builder.save.page');

    // Account Upgrade
    Route::get('/upgrade/account/confirm/{plan_id}/{response}/{amount}', [App\Http\Controllers\AccountUpgradeController::class, 'upgrade_account_confirm'])->name('user.upgrade.account.confirm');

    // Funding Account
    Route::get('/transaction/confirm/{response}/{amount}', [App\Http\Controllers\TransactionController::class, 'transaction_confirm'])->name('user.transaction.confirm');

    // CRM
    Route::post('/crm/start/course/creation', [App\Http\Controllers\CMSController::class, 'start_course_creation'])->name('user.start.course.creation');

    Route::post('/crm/save/course/{id}', [App\Http\Controllers\CMSController::class, 'save_course'])->name('user.save.course');

    Route::post('/crm/save/curriculum/{id}', [App\Http\Controllers\CMSController::class, 'save_curriculum'])->name('user.save.curriculum');
    Route::post('/crm/action/curriculum/{id}', [App\Http\Controllers\CMSController::class, 'action_curriculum'])->name('user.action.curriculum');

    Route::post('/crm/save/lesson', [App\Http\Controllers\CMSController::class, 'save_lesson'])->name('user.save.lesson');
    Route::post('/crm/update/lesson/{id}', [App\Http\Controllers\CMSController::class, 'update_lesson'])->name('user.update.lesson');
    Route::post('/crm/delete/lesson/{id}', [App\Http\Controllers\CMSController::class, 'delete_lesson'])->name('user.delete.lesson');

    Route::post('/crm/save/coupon/{id}', [App\Http\Controllers\CMSController::class, 'save_coupon'])->name('user.save.coupon');
    Route::post('/crm/update/coupon/{id}', [App\Http\Controllers\CMSController::class, 'update_coupon'])->name('user.update.coupon');
    Route::post('/crm/delete/coupon/{id}', [App\Http\Controllers\CMSController::class, 'delete_coupon'])->name('user.delete.coupon');
});