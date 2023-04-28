<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ListManagementController;
use App\Http\Controllers\OjafunnelNotificationController;
use Illuminate\Support\Facades\Route;


//User Authentications
Route::prefix('user')->group(function () {
    // Profile
    Route::post('/profile/update', [App\Http\Controllers\ProfileController::class, 'profile_update'])->name('user.profile.update');
    Route::post('/password/update', [App\Http\Controllers\ProfileController::class, 'password_update'])->name('user.password.update');

    // SMS Automation
    Route::post('/sms/sendmessage/campaign', [App\Http\Controllers\SmsAutomationController::class, 'sms_sendmessage_campaign'])->name('user.sms.sendmessage.campaign');

    // Intgration - sms
    Route::post('/integration/create', [App\Http\Controllers\IntegrationController::class, 'integration_create'])->name('user.integration.create');
    Route::post('/integration/update/{id}', [App\Http\Controllers\IntegrationController::class, 'integration_update'])->name('user.integration.update');
    Route::get('/integration/enable/{id}', [App\Http\Controllers\IntegrationController::class, 'integration_enable'])->name('user.integration.enable');
    Route::get('/integration/disable/{id}', [App\Http\Controllers\IntegrationController::class, 'integration_disable'])->name('user.integration.disable');
    Route::post('/integration/delete/{id}', [App\Http\Controllers\IntegrationController::class, 'integration_delete'])->name('user.integration.delete');

    // Intgration - email
    Route::post('/integration/email/create', [App\Http\Controllers\IntegrationController::class, 'integration_email_create'])->name('user.integration.email.create');
    Route::post('/integration/email/update/{id}', [App\Http\Controllers\IntegrationController::class, 'integration_email_update'])->name('user.integration.email.update');
    Route::post('/integration/email/delete/{id}', [App\Http\Controllers\IntegrationController::class, 'integration_email_delete'])->name('user.integration.email.delete');

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
    Route::any('/page/builder/save/page', [App\Http\Controllers\PageController::class, 'page_builder_save_page'])->name('user.page.builder.save.page');
    Route::post('/page/builder/update/{id}', [App\Http\Controllers\PageController::class, 'page_builder_update'])->name('user.page.builder.update');
    Route::post('/page/builder/delete/{id}', [App\Http\Controllers\PageController::class, 'page_builder_delete'])->name('user.page.builder.delete');

    // Funnel Builder
    Route::post('/funnel/builder/create/folder', [App\Http\Controllers\PageController::class, 'funnel_builder_create_folder'])->name('user.funnel.builder.create.folder');
    Route::post('/funnel/builder/update/{id}', [App\Http\Controllers\PageController::class, 'funnel_builder_update'])->name('user.funnel.builder.update');
    Route::post('/funnel/builder/delete/{id}', [App\Http\Controllers\PageController::class, 'funnel_builder_delete'])->name('user.funnel.builder.delete');
    Route::post('/funnel/builder/create/page', [App\Http\Controllers\PageController::class, 'funnel_builder_create_page'])->name('user.funnel.builder.create.page');
    Route::post('/funnel/builder/update/page/{id}', [App\Http\Controllers\PageController::class, 'funnel_builder_update_page'])->name('user.funnel.builder.update.page');
    Route::post('/funnel/builder/delete/page/{id}', [App\Http\Controllers\PageController::class, 'funnel_builder_delete_page'])->name('user.funnel.builder.delete.page');
    Route::any('/funnel/builder/save/page', [App\Http\Controllers\PageController::class, 'funnel_builder_save_page'])->name('user.funnel.builder.save.page');

    // Account Upgrade
    Route::get('/upgrade/account/confirm/{plan_id}/{response}/{price}/{currency}', [App\Http\Controllers\AccountUpgradeController::class, 'upgrade_account_confirm'])->name('user.upgrade.account.confirm');

    // Funding Account
    Route::get('/transaction/confirm/{response}/{amount}', [App\Http\Controllers\TransactionController::class, 'transaction_confirm'])->name('user.transaction.confirm');

    // LMS
    Route::post('/crm/start/course/creation', [App\Http\Controllers\CMSController::class, 'start_course_creation'])->name('user.start.course.creation');

    Route::post('/crm/save/course/{id}', [App\Http\Controllers\CMSController::class, 'save_course'])->name('user.save.course');

    Route::post('/crm/save/curriculum/{id}', [App\Http\Controllers\CMSController::class, 'save_curriculum'])->name('user.save.curriculum');
    Route::post('/crm/action/curriculum/{id}', [App\Http\Controllers\CMSController::class, 'action_curriculum'])->name('user.action.curriculum');

    Route::post('/crm/save/lesson', [App\Http\Controllers\CMSController::class, 'save_lesson'])->name('user.save.lesson');
    Route::post('/crm/update/lesson/{id}', [App\Http\Controllers\CMSController::class, 'update_lesson'])->name('user.update.lesson');
    Route::post('/crm/delete/lesson/{id}', [App\Http\Controllers\CMSController::class, 'delete_lesson'])->name('user.delete.lesson');

    Route::post('/crm/save/requirement/{id}', [App\Http\Controllers\CMSController::class, 'save_requirement'])->name('user.save.requirement');
    Route::get('/crm/delete/requirement/{id}', [App\Http\Controllers\CMSController::class, 'delete_requirement'])->name('user.delete.requirement');

    Route::post('/crm/save/what_to_learn/{id}', [App\Http\Controllers\CMSController::class, 'save_what_to_learn'])->name('user.save.what.to.learn');
    Route::get('/crm/delete/what_to_learn/{id}', [App\Http\Controllers\CMSController::class, 'delete_what_to_learn'])->name('user.delete.what.to.learn');

    Route::post('/crm/save/coupon/{id}', [App\Http\Controllers\CMSController::class, 'save_coupon'])->name('user.save.coupon');
    Route::post('/crm/update/coupon/{id}', [App\Http\Controllers\CMSController::class, 'update_coupon'])->name('user.update.coupon');
    Route::post('/crm/delete/coupon/{id}', [App\Http\Controllers\CMSController::class, 'delete_coupon'])->name('user.delete.coupon');

    Route::post('/crm/create/shop', [App\Http\Controllers\CMSController::class, 'create_shop'])->name('user.shop.create');
    Route::post('/crm/update/shop/{id}', [App\Http\Controllers\CMSController::class, 'update_shop'])->name('user.shop.update');
    Route::post('/crm/delete/shop/{id}', [App\Http\Controllers\CMSController::class, 'delete_shop'])->name('user.shop.delete');

    // Email
    Route::post('/user/send/message/admin', [OjafunnelNotificationController::class, 'user_send_message'])->name('user.send.message');
    Route::get('/user/get/all/notifications', [OjafunnelNotificationController::class, 'get_all_notifications']);
    Route::get('/user/get/all/unread/notifications', [OjafunnelNotificationController::class, 'get_all_unread_notifications']);
    Route::get('/user/count/unread/notifications', [OjafunnelNotificationController::class, 'count_unread_notifications']);

    // Sms Automation
    Route::post('/sms-automation/delete/{id}', [App\Http\Controllers\DashboardController::class, 'delete_sms_campaign'])->name('user.delete.sms.campaign');
    Route::post('/sms-automation/update/{id}', [App\Http\Controllers\DashboardController::class, 'update_sms_campaign'])->name('user.update.sms.campaign');

    // Notification
    Route::get('/user/read/notification/{id}', [OjafunnelNotificationController::class, 'read_notification'])->name('user.read.notification');

    // Withdrawal
    Route::post('/withdrawal/add/bank', [App\Http\Controllers\TransactionController::class, 'add_bank_information'])->name('user.add.bank.details');
    Route::post('/withdrawal/update/bank/{id}', [App\Http\Controllers\TransactionController::class, 'update_bank_information'])->name('user.update.bank.details');
    Route::post('/withdrawal/delete/bank/{id}', [App\Http\Controllers\TransactionController::class, 'delete_bank_information'])->name('user.delete.bank.details');
    Route::post('/withdrawal/add/us/bank', [App\Http\Controllers\TransactionController::class, 'add_us_bank_information'])->name('user.add.us.bank.details');
    Route::post('/withdrawal/add/paystack', [App\Http\Controllers\TransactionController::class, 'add_paystack'])->name('user.add.paystack');
    Route::post('/withdrawal/update/paystack/{id}', [App\Http\Controllers\TransactionController::class, 'update_paystack'])->name('user.update.paystack');
    Route::post('/withdrawal/add/paypal', [App\Http\Controllers\TransactionController::class, 'add_paypal'])->name('user.add.paypal');
    Route::post('/withdrawal/withdraw', [App\Http\Controllers\TransactionController::class, 'withdraw'])->name('user.withdraw');
    Route::post('/withdrawal/delete/withdraw/{id}', [App\Http\Controllers\TransactionController::class, 'delete_withdraw'])->name('user.delete.withdraw');

    // Birthday Automation
    Route::post('/update-birthday/{id}', [App\Http\Controllers\BirthdayController::class, 'update_birthday'])->name('user.update.birthday');


    // Email Marketing
    Route::post('/list/management/create/list', [ListManagementController::class, 'store_list'])->name('user.store.list');
    Route::get('/list/management/list/view/{id}', [ListManagementController::class, 'view_list'])->name('user.view.list');
    Route::get('/list/management/list/edit/{id}', [ListManagementController::class, 'edit_list'])->name('user.edit.list');
    Route::post('/list/management/list/update/{id}', [ListManagementController::class, 'update_list'])->name('user.update.list');
    Route::get('/list/management/list/enable/{id}', [ListManagementController::class, 'enable_list'])->name('user.enable.list');
    Route::get('/list/management/list/disabled/{id}', [ListManagementController::class, 'disable_list'])->name('user.disable.list');
    Route::post('/list/management/list/delete/{id}', [ListManagementController::class, 'delete_list'])->name('user.delete.list');
    Route::get('/list/management/create/contact/list/{id}', [ListManagementController::class, 'create_contact_list'])->name('user.create.contact.list');
    Route::post('/list/management/create/contact/{id}', [ListManagementController::class, 'create_contact'])->name('user.create.contact');
    Route::get('/list/management/contact/edit/{id}', [ListManagementController::class, 'edit_contact'])->name('user.edit.contact');
    Route::post('/list/management/contact/update/{id}', [ListManagementController::class, 'update_contact'])->name('user.update.contact');
    Route::post('/list/management/contact/delete/{id}', [ListManagementController::class, 'delete_contact'])->name('user.delete.contact');
    Route::get('/list/management/upload/contact/list/{id}', [ListManagementController::class, 'upload_contact_list'])->name('user.upload.contact.list');
    Route::post('/list/management/upload/contact/{id}', [ListManagementController::class, 'upload_contact'])->name('user.upload.contact');
}); 
