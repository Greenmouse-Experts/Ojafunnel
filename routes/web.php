<?php

use App\Events\SendMessage;
use App\Http\Controllers\ChatController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/broadcast', function (Request $request) {
    // Fire the SendMessage event
    $message = "Welcome to Ojafunnel";

    event(new SendMessage($message));

    return 'Successfully';
})->name('broadcast');

// FrontEnd
Route::get('/page-builder/create', [App\Http\Controllers\PageController::class, 'page_builder_create'])->name('user.page.builder.create');
Route::get('pages/{page}/editor', [App\Http\Controllers\PageController::class, 'viewEditor'])->name('user.page.builder.view.editor');
Route::get('pages/{page}', [App\Http\Controllers\PageController::class, 'viewPage'])->name('user.page.builder.view.page');
Route::get('/shop/{storename}', [App\Http\Controllers\StoreFrontController::class, 'storeFront'])->name('user.stores.link');
Route::get('/course/shop/{shopname}', [App\Http\Controllers\StoreFrontController::class, 'shopFront'])->name('user.shops.link');
Route::get('cart/{storename}', [App\Http\Controllers\StoreFrontController::class, 'cart'])->name('cart');
Route::get('checkout/{storename}', [App\Http\Controllers\StoreFrontController::class, 'checkout'])->name('checkout');
Route::post('checkout/payment/{storename}', [App\Http\Controllers\StoreFrontController::class, 'checkoutPayment'])->name('payment.checkout');
Route::get('add-to-cart/{id}', [App\Http\Controllers\StoreFrontController::class, 'addToCart'])->name('add.to.cart');
Route::patch('update-cart', [App\Http\Controllers\StoreFrontController::class, 'update'])->name('update.cart');
Route::delete('remove-from-cart', [App\Http\Controllers\StoreFrontController::class, 'remove'])->name('remove.from.cart');
Route::get('generatePdf', [App\Http\Controllers\StoreFrontController::class, 'Pdf'])->name('generate.pdf');

// Shop
Route::get('/course/shop/{shopname}', [App\Http\Controllers\ShopFrontController::class, 'shopFront'])->name('user.shops.link');
Route::get('/add/course/cart/{id}', [App\Http\Controllers\ShopFrontController::class, 'addCourseToCart'])->name('add.course.to.cart');
Route::get('/course/cart/{shopname}', [App\Http\Controllers\ShopFrontController::class, 'course_cart'])->name('course.cart');
Route::get('/course/checkout/{shopname}', [App\Http\Controllers\ShopFrontController::class, 'course_checkout'])->name('course.checkout');
Route::patch('/course/update-cart', [App\Http\Controllers\ShopFrontController::class, 'course_update'])->name('course.update.cart');
Route::post('/course/checkout/payment/{storename}', [App\Http\Controllers\ShopFrontController::class, 'courseCheckoutPayment'])->name('course.payment.checkout');
// assets path for email
Route::get('assets/{dirname}/{basename}', [
    function ($dirname, $basename) {
        $dirname = \App\Library\StringHelper::base64UrlDecode($dirname);
        $absPath = storage_path(join_paths($dirname, $basename));

        if (\File::exists($absPath)) {
            $mimetype = \App\Library\File::getFileType($absPath);
            return response()->file($absPath, array('Content-Type' => $mimetype));
        } else {
            abort(404);
        }
    }
])->name('public_assets');



// Route::domain(config('app.domain_url'))->group(function() {
Route::get('/', [App\Http\Controllers\HomePageController::class, 'index'])->name('index');
// Faqs
Route::get('/faqs', [App\Http\Controllers\HomePageController::class, 'faqs'])->name('faqs');
// pricing
Route::get('/pricing', [App\Http\Controllers\HomePageController::class, 'pricing'])->name('pricing');
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
Route::get('/features/emailmarketing', [App\Http\Controllers\HomePageController::class, 'emailmarketing'])->name('emailmarketing');
// Chat Automation
Route::get('/chatautomation', [App\Http\Controllers\HomePageController::class, 'chatautomation'])->name('chatautomation');
Route::get('/datatable_locale', [App\Http\Controllers\Controller::class, 'datatable_locale'])->name('datatable_locale');
Route::get('/jquery_validate_locale', [App\Http\Controllers\Controller::class, 'jquery_validate_locale'])->name('jquery_validate_locale');
// });

// See Demo
Route::get('/see-demo', [App\Http\Controllers\HomePageController::class, 'demo'])->name('demo');
// });

// Ecommerce Frontend
Route::get('/features/ecommerce', [App\Http\Controllers\HomePageController::class, 'ecommerce'])->name('ecommerce');
// });

// Funnel Bulder Frontend
Route::get('/features/funnelbuilder', [App\Http\Controllers\HomePageController::class, 'funnelbuilder'])->name('funnelbuilder');
// });

// Template Designs Frontend
Route::get('/features/template', [App\Http\Controllers\HomePageController::class, 'template'])->name('template');
// });

// Affiliate Marketing
Route::get('/features/affiliate', [App\Http\Controllers\HomePageController::class, 'affiliate'])->name('affiliate');
// });


// Integration Frontend
Route::get('/features/integrations', [App\Http\Controllers\HomePageController::class, 'integrations'])->name('integrations');
// });


//User Authentications
Route::prefix('auth')->group(function () {
    Route::post('/register', [App\Http\Controllers\AuthController::class, 'register'])->name('register');
    Route::get('/verify/account/{email}', [App\Http\Controllers\AuthController::class, 'verify_account'])->name('verify.account');
    Route::post('/email/verify/resend/{email}', [App\Http\Controllers\AuthController::class, 'email_verify_resend'])->name('email.verify.resend');
    Route::post('/email/confirm/{token}', [App\Http\Controllers\AuthController::class, 'registerConfirm'])->name('email.confirmation');
    Route::post('/user/login', [App\Http\Controllers\AuthController::class, 'user_login'])->name('user.login');
    Route::post('/password/forget', [App\Http\Controllers\AuthController::class, 'forget_password'])->name('user.forget.password');
    Route::get('/reset/password/email/{email}', [App\Http\Controllers\AuthController::class, 'password_reset_email'])->name('user.reset.password');
    Route::post('update/password/reset/', [App\Http\Controllers\AuthController::class, 'reset_password'])->name('user.update.password');
});

Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

// User Dashboard
Route::prefix('{username}')->group(function () {
    // Route::domain('{username}.' . config('app.domain_url'))->group(function () {
    Route::get('/test', [App\Http\Controllers\HomePageController::class, 'test']);
    Route::prefix('dashboard')->group(
        function () {
            Route::get('/', [App\Http\Controllers\DashboardController::class, 'dashboard'])->name('user.dashboard');
            Route::get('/upgrade', [App\Http\Controllers\DashboardController::class, 'upgrade'])->name('user.upgrade');
            Route::get('/upgrade/account/{id}/{amount}', [App\Http\Controllers\DashboardController::class, 'upgrade_account'])->name('user.upgrade.account');
            Route::get('/transaction', [App\Http\Controllers\DashboardController::class, 'transaction'])->name('user.transaction');
            Route::get('/subscription', [App\Http\Controllers\DashboardController::class, 'subscription'])->name('user.subscription');
            Route::prefix('/email-marketing')->group(
                function () {
                        Route::get('/email-checker', [App\Http\Controllers\DashboardController::class, 'email_checker'])->name('user.email.checker');
                        Route::get('/email-campaign', [App\Http\Controllers\DashboardController::class, 'email_campaign'])->name('user.email.campaign');
                        Route::get('/email-campaign/email-campaign', [App\Http\Controllers\DashboardController::class, 'email_Ecampaign'])->name('user.email.Ecampaign');
                        Route::get('/email-campaign/email-layout', [App\Http\Controllers\DashboardController::class, 'email_layout'])->name('user.email.layout');
                        Route::get('/email-campaign/email-campaign/email-code', [App\Http\Controllers\DashboardController::class, 'email_code'])->name('user.email.code');
                        Route::get('/email-campaign/email-preview', [App\Http\Controllers\DashboardController::class, 'email_preview'])->name('user.email.preview');
                        Route::get('/email-campaign/email-design', [App\Http\Controllers\DashboardController::class, 'email_design'])->name('user.email.design');
                        // Route::get('/email-campaign/email-layout', [App\Http\Controllers\DashboardController::class, 'email_layout'])->name('user.email.layout');
                        // Route::get('/email-campaign/email-code', [App\Http\Controllers\DashboardController::class, 'email_code'])->name('user.email.code');
                        Route::get('/email-automation', [App\Http\Controllers\DashboardController::class, 'email_automation'])->name('user.email.automation');
                        Route::get('/automation-campaign', [App\Http\Controllers\DashboardController::class, 'automation_campaign'])->name('user.automation.campaign');
                        Route::get('/edittemplate', [App\Http\Controllers\DashboardController::class, 'edit_template'])->name('user.edit.template');
                    }
            );
            Route::prefix('/list')->group(
                function () {
                        Route::get('/create-view', [App\Http\Controllers\Mail\MailListController::class, 'create'])->name('user.create.list');
                        Route::post('/create-view/store', [App\Http\Controllers\Mail\MailListController::class, 'store'])->name('user.create_list');
                        Route::patch('/update-list/{uid}', [App\Http\Controllers\Mail\MailListController::class, 'update'])->name('user.update_list');
                        Route::get('/view-list', [App\Http\Controllers\Mail\MailListController::class, 'index'])->name('user.view.list');
                        Route::get('/list-overview/{uid}', [App\Http\Controllers\Mail\MailListController::class, 'overview'])->name('user.view.overview');
                        Route::get('/list-performance', [App\Http\Controllers\DashboardController::class, 'list_performance'])->name('user.list.performance');
                        Route::get('/list-setting/{uid}', [App\Http\Controllers\Mail\MailListController::class, 'edit'])->name('user.list.setting');
                        Route::get('/list-subscribers/{uid}', [App\Http\Controllers\Mail\SubscriberController::class, 'index'])->name('user.list.subscribers');
                        Route::get('/new-subscribers/{uid}', [App\Http\Controllers\Mail\SubscriberController::class, 'create'])->name('user.new.subscribers');
                        Route::post('/new-subscribers/store/{uid}', [App\Http\Controllers\Mail\SubscriberController::class, 'store'])->name('user.new.subscribers.post');
                        Route::get('/delete-subscriber/{list_uid}/{uids}', [App\Http\Controllers\Mail\SubscriberController::class, 'delete'])->name('user.subscriber.delete');

                        Route::get('/import-subscribers/{uid}', [App\Http\Controllers\Mail\SubscriberController::class, 'import'])->name('user.import.subscribers');
                        Route::get('/import-progress/{job_uid}/{list_uid}', [App\Http\Controllers\Mail\SubscriberController::class, 'importProgress'])->name('user.importProgress');
                        Route::post('/cancelImport/{job_uid}', [App\Http\Controllers\Mail\SubscriberController::class, 'cancelImport'])->name('user.cancelImport');
                        Route::get('/downloadImportLog/{job_uid}', [App\Http\Controllers\Mail\SubscriberController::class, 'downloadImportLog'])->name('user.downloadImportLog');
                        Route::post('/dispatchImportJob/{list_uid}', [App\Http\Controllers\Mail\SubscriberController::class, 'dispatchImportJob'])->name('user.dispatchImportJob');
                        Route::get('/export-subscribers/{uid}', [App\Http\Controllers\Mail\SubscriberController::class, 'export'])->name('user.export.subscribers');
                        Route::get('/exportProgress/{job_uid}', [App\Http\Controllers\Mail\SubscriberController::class, 'exportProgress'])->name('user.exportProgress');
                        Route::post('/cancelExport/{job_uid}', [App\Http\Controllers\Mail\SubscriberController::class, 'cancelExport'])->name('user.cancelExport');
                        Route::get('/downloadExportedFile/{job_uid}', [App\Http\Controllers\Mail\SubscriberController::class, 'downloadExportedFile'])->name('user.downloadExportedFile');
                        Route::post('/dispatchExportJob/{list_uid}', [App\Http\Controllers\Mail\SubscriberController::class, 'dispatchExportJob'])->name('user.dispatchExportJob');
                        Route::get('/segments', [App\Http\Controllers\DashboardController::class, 'segments'])->name('user.new.segments');
                        Route::get('/create-segments', [App\Http\Controllers\DashboardController::class, 'create_segments'])->name('user.create.segments');
                    }
            );
            Route::prefix('/campaign')->group(
                function () {
                        Route::get('/overview', [App\Http\Controllers\Mail\CampaignController::class, 'index'])->name('user.campaign.overview');
                        Route::get('/overviews', [App\Http\Controllers\Mail\CampaignController::class, 'overview'])->name('user.campaign.overviews');
                        Route::get('/copy/uid/copy_campaign_uid', [App\Http\Controllers\Mail\CampaignController::class, 'copy'])->name('user.campaign.copy');
                        Route::post('/delete/uids', [App\Http\Controllers\Mail\CampaignController::class, 'delete'])->name('user.campaign.delete');
                        Route::post('/restart/uids', [App\Http\Controllers\Mail\CampaignController::class, 'restart'])->name('user.campaign.restart');
                        Route::post('/pause/uids', [App\Http\Controllers\Mail\CampaignController::class, 'pause'])->name('user.campaign.pause');
                        Route::get('/resend/uid', [App\Http\Controllers\Mail\CampaignController::class, 'resend'])->name('user.campaign.resend');
                        Route::post('/resend/uid', [App\Http\Controllers\Mail\CampaignController::class, 'resend'])->name('user.campaign.resend');
                        Route::get('/ediit/uid', [App\Http\Controllers\Mail\CampaignController::class, 'edit'])->name('user.campaign.edit');
                        Route::get('/show/{uid}', [App\Http\Controllers\Mail\CampaignController::class, 'show'])->name('user.campaign.show');
                        Route::get('/edit/{uid}', [App\Http\Controllers\Mail\CampaignController::class, 'edit'])->name('user.campaign.edit');
                        Route::get('/list', [App\Http\Controllers\Mail\CampaignController::class, 'listing'])->name('user.campaign.list');
                        Route::get('/select-type', [App\Http\Controllers\Mail\CampaignController::class, 'selectType'])->name('user.campaign.selectType');
                        Route::get('/create/{type}', [App\Http\Controllers\Mail\CampaignController::class, 'create'])->name('user.campaign.create');
                        Route::get('/recipents/{uid}', [App\Http\Controllers\Mail\CampaignController::class, 'recipients'])->name('user.campaign.recipient');
                        Route::get('/listSegmentForm/{uid}', [App\Http\Controllers\Mail\CampaignController::class, 'listSegmentForm'])->name('user.campaign.listSegmentForm');
                        Route::post('/recipents/{uid}', [App\Http\Controllers\Mail\CampaignController::class, 'recipients'])->name('user.campaign.recipient.post');
                        Route::get('/setup/{uid}', [App\Http\Controllers\Mail\CampaignController::class, 'setup'])->name('user.campaign.setup');
                        Route::post('/setup/{uid}', [App\Http\Controllers\Mail\CampaignController::class, 'setup'])->name('user.campaign.setup.post');
                        Route::get('/template/{uid}', [App\Http\Controllers\Mail\CampaignController::class, 'template'])->name('user.campaign.template');
                        Route::get('/schedule/{uid}', [App\Http\Controllers\Mail\CampaignController::class, 'schedule'])->name('user.campaign.schedule');
                        Route::post('/schedule/{uid}', [App\Http\Controllers\Mail\CampaignController::class, 'schedule'])->name('user.campaign.schedule');
                        Route::get('/confirm/{uid}', [App\Http\Controllers\Mail\CampaignController::class, 'confirm'])->name('user.campaign.confirm');
                        Route::post('/confirm/{uid}', [App\Http\Controllers\Mail\CampaignController::class, 'confirm'])->name('user.campaign.confirm');
                        Route::get('/templateLayout/{uid}/', [App\Http\Controllers\Mail\CampaignController::class, 'templateLayout'])->name('user.campaign.templateLayout');
                        Route::post('/templateLayouts/{uid}/{template}', [App\Http\Controllers\Mail\CampaignController::class, 'templateLayout'])->name('user.campaign.templateLayouts');
                        Route::get('/templateLayout2/{uid}/{category_uid}', [App\Http\Controllers\Mail\CampaignController::class, 'templateLayout'])->name('user.campaign.templateLayouts2');
                        Route::get('/templateLayoutsMine/{uid}/{from}', [App\Http\Controllers\Mail\CampaignController::class, 'templateLayout'])->name('user.campaign.templateLayout.from');
                        Route::get('/templateLayoutList/{uid}', [App\Http\Controllers\Mail\CampaignController::class, 'templateLayoutList'])->name('user.campaign.templateLayoutList');
                        Route::get('/templateUpload/{uid}', [App\Http\Controllers\Mail\CampaignController::class, 'templateUpload'])->name('user.campaign.templateUpload');
                        Route::get('/plain/{uid}', [App\Http\Controllers\Mail\CampaignController::class, 'plain'])->name('user.campaign.plain');
                        Route::get('/templateCreate/{uid}', [App\Http\Controllers\Mail\CampaignController::class, 'templateCreate'])->name('user.campaign.templateCreate');
                        Route::get('/templateBuilderSelect/{uid}', [App\Http\Controllers\Mail\CampaignController::class, 'templateBuilderSelect'])->name('user.campaign.templateBuilderSelect');
                        Route::get('/templateEdit/{uid}', [App\Http\Controllers\Mail\CampaignController::class, 'templateEdit'])->name('user.campaign.templateEdit');
                        Route::post('/templateEdit/{uid}', [App\Http\Controllers\Mail\CampaignController::class, 'templateEdit'])->name('user.campaign.templateEdit');
                        Route::get('/builderClassic/{uid}', [App\Http\Controllers\Mail\CampaignController::class, 'builderClassic'])->name('user.campaign.builderClassic');
                        Route::post('/builderClassic/{uid}', [App\Http\Controllers\Mail\CampaignController::class, 'builderClassic'])->name('user.campaign.builderClassic');
                        Route::get('/builderPlainEdit/{uid}', [App\Http\Controllers\Mail\CampaignController::class, 'builderPlainEdit'])->name('user.campaign.builderPlainEdit');
                        Route::post('/builderPlainEdit/{uid}', [App\Http\Controllers\Mail\CampaignController::class, 'builderPlainEdit'])->name('user.campaign.builderPlainEdit');
                        Route::get('/templateContent/{uid}', [App\Http\Controllers\Mail\CampaignController::class, 'templateContent'])->name('user.campaign.templateContent');
                        Route::get('/previewContent/{uid}', [App\Http\Controllers\Mail\CampaignController::class, 'previewContent'])->name('user.campaign.previewContent');
                        Route::get('/preview/{uid}', [App\Http\Controllers\Mail\CampaignController::class, 'preview'])->name('user.campaign.preview');
                        Route::post('/uploadAttachment/{uid}', [App\Http\Controllers\Mail\CampaignController::class, 'uploadAttachment'])->name('user.campaign.uploadAttachment');
                        Route::get('/downloadAttachment/{uid}/{name}', [App\Http\Controllers\Mail\CampaignController::class, 'downloadAttachment'])->name('user.campaign.downloadAttachment');
                        Route::post('/removeAttachment/{uid}/{name}', [App\Http\Controllers\Mail\CampaignController::class, 'removeAttachment'])->name('user.campaign.removeAttachment');
                        Route::get('/spamScore/{uid}', [App\Http\Controllers\Mail\CampaignController::class, 'spamScore'])->name('user.campaign.spamScore');
                        Route::get('/sendTestEmail/{uid}', [App\Http\Controllers\Mail\CampaignController::class, 'sendTestEmail'])->name('user.campaign.sendTestEmail');
                        Route::post('/sendTestEmail/{uid}', [App\Http\Controllers\Mail\CampaignController::class, 'sendTestEmail'])->name('user.campaign.sendTestEmail');
                        Route::get('/campaigns/test/{message}', [App\Http\Controllers\Mail\CampaignController::class, 'notification'])->name('campaign_message');

                    }
            );
            Route::prefix('/template')->group(
                function () {
                        Route::post('/uploadTemplateAssets/{uid}', [App\Http\Controllers\Mail\TemplateController::class, 'uploadTemplateAssets'])->name('user.template.uploadTemplateAssets');
                    }
            );
            Route::prefix('/product')->group(
                function () {
                        Route::get('/widgetProductList', [App\Http\Controllers\Mail\ProductController::class, 'widgetProductList'])->name('user.product.widgetProductList');
                        Route::get('/widgetProductOptions', [App\Http\Controllers\Mail\ProductController::class, 'widgetProductOptions'])->name('user.product.widgetProductOptions');
                        Route::post('/widgetProduct', [App\Http\Controllers\Mail\ProductController::class, 'widgetProduct'])->name('user.product.widgetProduct');
                    }
            );
            Route::prefix('/segment')->group(
                function () {
                        Route::get('/overview', [App\Http\Controllers\Mail\SegmentController::class, 'selectBox'])->name('user.segment.selectBox');
                    }
            );
            Route::prefix('/sender')->group(
                function () {
                        Route::get('/index', [App\Http\Controllers\Mail\SenderController::class, 'index'])->name('user.segment.index');
                        Route::get('/dropbox', [App\Http\Controllers\Mail\SenderController::class, 'dropbox'])->name('user.segment.dropbox');
                    }
            );
            Route::prefix('/subscribers')->group(
                function () {
                        Route::get('/mailing-list', [App\Http\Controllers\DashboardController::class, 'mailing_list'])->name('user.mailing.list');
                        Route::get('/mailing-list/contacts/{id}', [App\Http\Controllers\DashboardController::class, 'contact'])->name('user.contact');
                        Route::get('/mailing-list/add-contact/{id}', [App\Http\Controllers\DashboardController::class, 'add_contact'])->name('user.add.contact');
                        Route::get('/mailing-list/copypaste/{id}', [App\Http\Controllers\DashboardController::class, 'copy_paste'])->name('user.copy.paste');
                        Route::get('/mailing-list/upload/{id}', [App\Http\Controllers\DashboardController::class, 'upload'])->name('user.up.load');
                    }
            );
            Route::prefix('/messages')->group(
                function () {
                        Route::get('/create-message', [App\Http\Controllers\DashboardController::class, 'create_message'])->name('user.create.message');
                        Route::get('/view-message', [App\Http\Controllers\DashboardController::class, 'view_message'])->name('user.view.message');
                    }
            );
            Route::prefix('/funnel-builder')->group(
                function () {
                        Route::get('/choose-temp', [App\Http\Controllers\DashboardController::class, 'choose_temp'])->name('user.choose.temp');
                        Route::get('/choose-temp/funnel/pages/{id}', [App\Http\Controllers\DashboardController::class, 'view_funnel_pages'])->name('user.view.funnel.pages');
                        Route::get('page-builder/{page}/editor', [App\Http\Controllers\PageController::class, 'viewFunnelEditor'])->name('user.funnel.builder.view.editor');
                        Route::get('/choose-temp/take-quiz', [App\Http\Controllers\DashboardController::class, 'take_quiz'])->name('user.take.quiz');
                        Route::get('/choose-temp/face-shape', [App\Http\Controllers\DashboardController::class, 'face_shape'])->name('user.face.shape');
                        Route::get('/choose-temp/choose-diamond', [App\Http\Controllers\DashboardController::class, 'choose_diamond'])->name('user.choose.diamond');
                        Route::get('/choose-temp/final-step', [App\Http\Controllers\DashboardController::class, 'final_step'])->name('user.final.step');
                        Route::get('/choose-temp/pay', [App\Http\Controllers\DashboardController::class, 'pay'])->name('user.pay');
                        Route::get('/choose-temp/congratulation', [App\Http\Controllers\DashboardController::class, 'congratulation'])->name('user.congratulation');
                    }
            );
            Route::get('/page-builder', [App\Http\Controllers\DashboardController::class, 'page_builder'])->name('user.page.builder');
            Route::get('page-builder/{page}/editor', [App\Http\Controllers\PageController::class, 'viewEditor'])->name('user.page.builder.view.editor');
            Route::get('page-builder/{page}', [App\Http\Controllers\PageController::class, 'viewPage'])->name('user.page.builder.view.page');
            Route::prefix('/chat-automation')->group(
                function () {
                        Route::get('/sms-automation', [App\Http\Controllers\DashboardController::class, 'sms_automation'])->name('user.sms.automation');
                        Route::get('/sms-automation/newsms', [App\Http\Controllers\DashboardController::class, 'newsms'])->name('user.new.sms');
                        Route::get('/automation/contact_list', [App\Http\Controllers\DashboardController::class, 'contact_list'])->name('user.automation.contact_list');
                        Route::post('/automation/contact_list', [App\Http\Controllers\DashboardController::class, 'contact_list'])->name('user.automation.contact_list');
                        Route::post('/automation/contact_list_update/{list_id}', [App\Http\Controllers\DashboardController::class, 'contact_list_update'])->name('user.automation.contact_list_update');
                        Route::post('/automation/contact_list_delete/{list_id}', [App\Http\Controllers\DashboardController::class, 'contact_list_delete'])->name('user.automation.contact_list_delete');
                        Route::get('/automation/add_contact/{list_id}', [App\Http\Controllers\DashboardController::class, 'add_contact_to_list'])->name('user.automation.contact_add');
                        Route::post('/automation/add_contact/{list_id}', [App\Http\Controllers\DashboardController::class, 'add_contact_to_list'])->name('user.automation.contact_add');
                        Route::post('/automation/update_contact/{contact_id}', [App\Http\Controllers\DashboardController::class, 'update_contact_num'])->name('user.automation.contact_num_update');
                        Route::post('/automation/delete_contact/{contact_id}', [App\Http\Controllers\DashboardController::class, 'delete_contact_num'])->name('user.automation.contact_num_delete');
                        Route::get('/whatsapp-automation', [App\Http\Controllers\DashboardController::class, 'whatsapp_automation'])->name('user.whatsapp.automation');
                        Route::get('/whatsapp-automation/sendbroadcast', [App\Http\Controllers\DashboardController::class, 'sendbroadcast'])->name('user.send.broadcast');
                    }
            );
            Route::prefix('/ecommerce')->group(
                function () {
                        Route::get('/my-store', [App\Http\Controllers\DashboardController::class, 'my_store'])->name('user.my.store');
                        Route::get('/my-store/viewstore', [App\Http\Controllers\StoreController::class, 'viewstore'])->name('user.check.store');
                        Route::post('/my-store/create', [App\Http\Controllers\StoreController::class, 'store'])->name('user.store.create');
                        Route::post('/my-store/update/{id}', [App\Http\Controllers\StoreController::class, 'updateStore'])->name('user.store.update');
                        Route::post('/my-store/delete/{id}', [App\Http\Controllers\StoreController::class, 'deleteStore'])->name('user.store.delete');
                        Route::get('/my-store/available-product', [App\Http\Controllers\StoreController::class, 'available_product'])->name('user.available.product');
                        Route::post('/my-store/product/add/{store_id}', [App\Http\Controllers\StoreController::class, 'addProduct'])->name('user.store.product.add');
                        Route::post('/my-store/product/update/{store_id}/{id}', [App\Http\Controllers\StoreController::class, 'updateProduct'])->name('user.store.product.update');
                        Route::post('/my-store/product/delete/{id}', [App\Http\Controllers\StoreController::class, 'deleteProduct'])->name('user.store.product.delete');
                        Route::get('/shop/sales', [App\Http\Controllers\StoreController::class, 'sales'])->name('user.sales');
                        Route::get('/shop/order-details/{id}', [App\Http\Controllers\StoreController::class, 'order_details'])->name('user.order.details');
                        // Route::get('/my-store/storee', [App\Http\Controllers\DashboardController::class, 'store'])->name('user.store');
                        Route::get('/shops', [App\Http\Controllers\StoreController::class, 'shops'])->name('user.shops');
                        Route::get('/stores', [App\Http\Controllers\DashboardController::class, 'stores'])->name('user.stores');
                        Route::get('/checkout', [App\Http\Controllers\DashboardController::class, 'checkout'])->name('user.checkout');
                        Route::get('/cart', [App\Http\Controllers\DashboardController::class, 'cart'])->name('user.cart');
                    }
            );
            Route::prefix('/Learning')->group(
                function () {
                        Route::get('/create-course', [App\Http\Controllers\DashboardController::class, 'create_course'])->name('user.create.course');
                        Route::get('/shop-course', [App\Http\Controllers\DashboardController::class, 'shop'])->name('user.shop.course');
                        Route::get('/create-course/start', [App\Http\Controllers\DashboardController::class, 'create_course_start'])->name('user.create.course.start');
                        Route::get('/my-cart', [App\Http\Controllers\DashboardController::class, 'my_cart'])->name('user.my.cart');
                        Route::get('/create-course/course-content/{id}', [App\Http\Controllers\DashboardController::class, 'course_content'])->name('user.course.content');
                        Route::get('/create-shop', [App\Http\Controllers\DashboardController::class, 'create_shop'])->name('user.create.shop.course');
                        Route::get('/view-shop', [App\Http\Controllers\DashboardController::class, 'view_shops'])->name('user.view.course.shops');
                        Route::get('/my-shop', [App\Http\Controllers\DashboardController::class, 'my_shops'])->name('user.my.shops.course');
                        Route::get('/course/checkout', [App\Http\Controllers\DashboardController::class, 'course_checkout'])->name('user.course.checkout');
                        Route::get('/course/cart', [App\Http\Controllers\DashboardController::class, 'course_cart'])->name('user.course.cart');
                        Route::get('/course-details', [App\Http\Controllers\DashboardController::class, 'course_details'])->name('user.course.details');
                        // Route::get('/create-course/get-quiz', [App\Http\Controllers\DashboardController::class, 'get_quiz'])->name('user.get.quiz');
                        // Route::get('/create-course/course-summary', [App\Http\Controllers\DashboardController::class, 'course_summary'])->name('user.course.summary');
                        // Route::get('/create-course/enroll-now', [App\Http\Controllers\DashboardController::class, 'enroll_now'])->name('user.enroll.now');
                        // Route::get('/create-course/enroll-cur', [App\Http\Controllers\DashboardController::class, 'enroll_cur'])->name('user.enroll.cur');
                    }
            );
            Route::get('/affiliate-marketing', [App\Http\Controllers\DashboardController::class, 'affiliate_marketing'])->name('user.affiliate.marketing');
            Route::get('/integration', [App\Http\Controllers\DashboardController::class, 'integration'])->name('user.integration');
            Route::get('/manage-integration', [App\Http\Controllers\DashboardController::class, 'manage_integration'])->name('user.manage_integration');
            Route::get('/reports-analysis', [App\Http\Controllers\DashboardController::class, 'reports_analysis'])->name('user.reports.analysis');
            Route::get('/help', [App\Http\Controllers\DashboardController::class, 'help'])->name('user.help');
            Route::prefix('/settings')->group(
                function () {
                        Route::get('/general', [App\Http\Controllers\DashboardController::class, 'general'])->name('user.general');
                        Route::get('/security', [App\Http\Controllers\DashboardController::class, 'security'])->name('user.security');
                    }
            );
            Route::prefix('/birthday')->group(
                function () {
                        Route::get('/module', [App\Http\Controllers\BirthdayController::class, 'main_module'])->name('user.main.list');
                        Route::post('/create-list', [App\Http\Controllers\BirthdayController::class, 'create_list'])->name('user.main.create.list');
                        Route::post('/create-birthday-contact-list/{birthday_id}', [App\Http\Controllers\BirthdayController::class, 'birthday_create_contact_list'])->name('user.main.birthday.create.list');
                        Route::post('/update-birthday-contact-list/{birthday_id}/{id}', [App\Http\Controllers\BirthdayController::class, 'birthday_update_contact_list'])->name('user.main.birthday.update.list');
                        Route::post('/delete-birthday-contact-list/{birthday_id}/{id}', [App\Http\Controllers\BirthdayController::class, 'birthday_delete_contact_list'])->name('user.main.birthday.delete.list');
                        Route::post('/update-list/{id}', [App\Http\Controllers\BirthdayController::class, 'update_list'])->name('user.main.update.list');
                        Route::post('/delete-list/{id}', [App\Http\Controllers\BirthdayController::class, 'delete_list'])->name('user.main.delete.list');
                        Route::get('/manage-list', [App\Http\Controllers\BirthdayController::class, 'manage_list'])->name('user.manage.list');
                        Route::get('/individual-list/{id}', [App\Http\Controllers\BirthdayController::class, 'individual_list'])->name('user.individual.list');
                        Route::get('/manage-birthday', [App\Http\Controllers\BirthdayController::class, 'manage_birthday'])->name('user.manage.birthday');
                        Route::get('/create-birthday', [App\Http\Controllers\BirthdayController::class, 'create_birthday'])->name('user.create.birthday');
                        Route::get('/edit-birthday/{id}', [App\Http\Controllers\BirthdayController::class, 'edit_birthday'])->name('user.edit.birthday');
                        Route::get('/delete-birthday/{id}', [App\Http\Controllers\BirthdayController::class, 'delete_birthday'])->name('user.delete.birthday');
                        Route::post('/create-birthday-automation', [App\Http\Controllers\BirthdayController::class, 'create_birthday_automation'])->name('user.create.birthday.automation');
                    }
            );
            Route::prefix('/notification')->group(
                function () {
                        Route::get('/notification', [App\Http\Controllers\DashboardController::class, 'main_notify'])->name('user.main.notification');
                    }
            );
            Route::prefix('/promotion')->group(
                function () {
                        Route::get('/promotion', [App\Http\Controllers\DashboardController::class, 'main_promo'])->name('user.main.promotion');
                    }
            );
            Route::prefix('/sales')->group(
                function () {
                        Route::get('/sales-analytics', [App\Http\Controllers\DashboardController::class, 'main_sales'])->name('user.main.sales');
                    }
            );
            Route::prefix('/support')->group(
                function () {
                        Route::get('/index', [App\Http\Controllers\DashboardController::class, 'main_support'])->name('user.main.support');
                        Route::get('/chat', [App\Http\Controllers\DashboardController::class, 'support_chat'])->name('user.main.support.chat');
                        Route::get('/email', [App\Http\Controllers\DashboardController::class, 'support_email'])->name('user.main.email');
                    }
            );
        }
    );
});

// Upload
Route::get('/general/builder/scan/file', [App\Http\Controllers\PageController::class, 'general_builder_scan'])->name('user.general.builder.scan');
Route::post('/general/builder/upload/file', [App\Http\Controllers\PageController::class, 'general_builder_upload'])->name('user.general.builder.upload');

// User Support
Route::post('/support/start/chat/{id}', [ChatController::class, 'startChat']);
Route::get('/support/get/admins', [ChatController::class, 'fetchAllAdmins']);
Route::get('/support/chats', [ChatController::class, 'fetchAllRecentChats']);
Route::post('/support/send', [ChatController::class, 'sendMessage']);

Route::post('/support/clear/single/chat', [ChatController::class, 'deleteSingleChat']);



// Builder
Route::post('/page/builder/save/page', [App\Http\Controllers\PageController::class, 'page_builder_save_page'])->name('user.page.builder.save.page');
Route::post('/funnel/builder/save/page', [App\Http\Controllers\PageController::class, 'funnel_builder_save_page'])->name('user.funnel.builder.save.page');
