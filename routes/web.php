<?php

use App\Events\SendMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CustomSubDomain;
use App\Http\Controllers\PayPalController;
// Paypal Testing
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmailMarketingController;

Route::get('/spam-score/{id}', [EmailMarketingController::class, 'calculateSpamScore']);

// sub domain for page and funnel builder - production  
Route::group(['domain' => '{subdomain}.ojafunnel.com'], function () {
    Route::get('/', [CustomSubDomain::class, 'wwwOrPageOrFunnelIndex']);

    Route::get('/{page}', [CustomSubDomain::class, 'custom']);
});

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
Route::get('cart/{storename}', [App\Http\Controllers\StoreFrontController::class, 'cart'])->name('cart');
Route::get('checkout/{storename}', [App\Http\Controllers\StoreFrontController::class, 'checkout'])->name('checkout');
Route::post('checkout/payment/{storename}', [App\Http\Controllers\StoreFrontController::class, 'checkoutPayment'])->name('payment.checkout');
Route::get('add-to-cart/{id}', [App\Http\Controllers\StoreFrontController::class, 'addToCart'])->name('add.to.cart');
Route::patch('update-cart', [App\Http\Controllers\StoreFrontController::class, 'update'])->name('update.cart');
Route::delete('remove-from-cart', [App\Http\Controllers\StoreFrontController::class, 'remove'])->name('remove.from.cart');
Route::get('generatePdf', [App\Http\Controllers\ShopFrontController::class, 'Pdf'])->name('generate.pdf');

// Shop
Route::get('/course/shop/{shopname}', [App\Http\Controllers\ShopFrontController::class, 'shopFront'])->name('user.shops.link');
Route::get('/add/course/cart/{id}', [App\Http\Controllers\ShopFrontController::class, 'addCourseToCart'])->name('add.course.to.cart');
Route::get('/course/cart/{shopname}', [App\Http\Controllers\ShopFrontController::class, 'course_cart'])->name('course.cart');
Route::get('/course/checkout/{shopname}', [App\Http\Controllers\ShopFrontController::class, 'course_checkout'])->name('course.checkout');
Route::patch('/course/update-cart', [App\Http\Controllers\ShopFrontController::class, 'course_update'])->name('course.update.cart');
Route::post('/course/checkout/payment/{shopname}', [App\Http\Controllers\ShopFrontController::class, 'courseCheckoutPayment'])->name('course.payment.checkout');
Route::get('/view-course-details/{shopname}/{id}', [App\Http\Controllers\ShopFrontController::class, 'view_course_details'])->name('view.course.details');

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

Route::get('p/{message_id}/open', [\App\Controller\Mail\CampaignController::class, 'open'])->name('openTrackingUrl');
Route::get('p/{url}/click/{message_id?}', [\App\Controller\Mail\CampaignController::class, 'click'])->name('clickTrackingUrl');
Route::get('c/{subscriber}/unsubscribe/{message_id?}', [\App\Controller\Mail\CampaignController::class, 'unsubscribe'])->name('unsubscribeUrl');
Route::get('campaigns/{message_id}/web-view', [\App\Controller\Mail\CampaignController::class, 'webView'])->name('webViewerUrl');
// Route::domain(config('app.domain_url'))->group(function() {
Route::get('/', [App\Http\Controllers\HomePageController::class, 'index'])->name('index');
// Faqs
Route::get('/faqs', [App\Http\Controllers\HomePageController::class, 'faqs'])->name('faqs');
// pricing
Route::get('/pricing', [App\Http\Controllers\HomePageController::class, 'pricing'])->name('pricing');
// Contact Us
Route::get('/contact', [App\Http\Controllers\HomePageController::class, 'contact'])->name('contact');
Route::post('/contact-us', [App\Http\Controllers\HomePageController::class, 'contactConfirm']);
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

// See Demo
Route::get('/see-demo', [App\Http\Controllers\HomePageController::class, 'demo'])->name('demo');

// Ecommerce Frontend
Route::get('/features/ecommerce', [App\Http\Controllers\HomePageController::class, 'ecommerce'])->name('ecommerce');

// Funnel Bulder Frontend
Route::get('/features/funnelbuilder', [App\Http\Controllers\HomePageController::class, 'funnelbuilder'])->name('funnelbuilder');

// Template Designs Frontend
Route::get('/features/template', [App\Http\Controllers\HomePageController::class, 'template'])->name('template');
Route::get('/features/template/{id}', [App\Http\Controllers\HomePageController::class, 'template_details'])->name('templateDetails');

// Affiliate Marketing
Route::get('/features/affiliate', [App\Http\Controllers\HomePageController::class, 'affiliate'])->name('affiliate');

// Integration Frontend
Route::get('/features/integrations', [App\Http\Controllers\HomePageController::class, 'integrations'])->name('integrations');

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
            Route::get('/upgrade/account/{plan_id}/{currency}/{price}', [App\Http\Controllers\DashboardController::class, 'upgrade_account'])->name('user.upgrade.account');
            Route::get('/transaction', [App\Http\Controllers\DashboardController::class, 'transaction'])->name('user.transaction');
            Route::get('/subscription', [App\Http\Controllers\DashboardController::class, 'subscription'])->name('user.subscription');
            Route::prefix('/accounts')->group(
                function () {
                    Route::get('/contact', [App\Http\Controllers\Mail\AccountController::class, 'contact'])->name('user.account.contact');
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


                    Route::get('/wa-number', [App\Http\Controllers\DashboardController::class, 'wa_number'])->name('user.whatsapp.wa-number');
                    Route::post('/wa-number/generate-qr', [App\Http\Controllers\DashboardController::class, 'generate_wa_qr'])->name('user.whatsapp.wa-number-generate-qr');
                    Route::post('/wa-number/logout-session', [App\Http\Controllers\DashboardController::class, 'logout_wa_session'])->name('user.whatsapp.wa-number-logout-session');
                    Route::post('/wa-number/check-session-connection', [App\Http\Controllers\DashboardController::class, 'check_wa_session_connection'])->name('user.whatsapp.wa-number-check-session-connection');
                    Route::post('/wa-number/create', [App\Http\Controllers\DashboardController::class, 'create_wa_number'])->name('user.whatsapp.create-wa-number');
                    Route::post('/wa-number/update', [App\Http\Controllers\DashboardController::class, 'update_wa_number'])->name('user.whatsapp.update-wa-number');
                    Route::post('/wa-number/delete', [App\Http\Controllers\DashboardController::class, 'delete_wa_number'])->name('user.whatsapp.delete-wa-number');

                    Route::get('/whatsapp-automation', [App\Http\Controllers\DashboardController::class, 'whatsapp_automation'])->name('user.whatsapp.automation');
                    Route::get('/whatsapp-automation/campaign/{campaign_id}/overview', [App\Http\Controllers\DashboardController::class, 'whatsapp_automation_campaign'])->name('user.whatsapp.automation.campaign');
                    Route::get('/whatsapp-automation/sendbroadcast', [App\Http\Controllers\DashboardController::class, 'sendbroadcast'])->name('user.send.broadcast');

                    Route::post('/whatsapp-automation/sendbroadcast/create', [App\Http\Controllers\DashboardController::class, 'sendbroadcastcreate'])->name('user.send.broadcast.create');

                    Route::post('/whatsapp-automation/campaign/edit', [App\Http\Controllers\DashboardController::class, 'editWAbroadcast'])->name('user.wa.campaign.edit');
                    Route::post('/whatsapp-automation/campaign/delete', [App\Http\Controllers\DashboardController::class, 'deleteWAbroadcast'])->name('user.wa.campaign.delete');
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
                    Route::get('/view-enrollments/{id}', [App\Http\Controllers\DashboardController::class, 'view_enrollments'])->name('user.view.course.enrollments');
                    Route::get('/my-shop', [App\Http\Controllers\DashboardController::class, 'my_shops'])->name('user.my.shops.course');
                    Route::get('/course/checkout', [App\Http\Controllers\DashboardController::class, 'course_checkout'])->name('user.course.checkout');
                    Route::get('/course/cart', [App\Http\Controllers\DashboardController::class, 'course_cart'])->name('user.course.cart');
                    Route::get('/view-course-details/{id}', [App\Http\Controllers\DashboardController::class, 'view_course_details'])->name('user.view.course.details');
                    Route::get('/course-details', [App\Http\Controllers\DashboardController::class, 'course_details'])->name('user.course.details');
                    Route::get('/course-details', [App\Http\Controllers\DashboardController::class, 'courses_details'])->name('user.details');
                    // Route::get('/create-course/get-quiz', [App\Http\Controllers\DashboardController::class, 'get_quiz'])->name('user.get.quiz');
                    // Route::get('/create-course/course-summary', [App\Http\Controllers\DashboardController::class, 'course_summary'])->name('user.course.summary');
                    // Route::get('/create-course/enroll-now', [App\Http\Controllers\DashboardController::class, 'enroll_now'])->name('user.enroll.now');
                    // Route::get('/create-course/enroll-cur', [App\Http\Controllers\DashboardController::class, 'enroll_cur'])->name('user.enroll.cur');
                }
            );

            // email marketing
            Route::prefix('/email-marketing')->group(
                function () {
                    Route::get('/email-kits', [App\Http\Controllers\EmailMarketingController::class, 'email_kits'])->name('user.email-marketing.email.kits');
                    Route::get('/email-templates', [App\Http\Controllers\EmailMarketingController::class, 'email_templates'])->name('user.email-marketing.email.templates');
                    Route::get('/email-templates/choose-temp', [App\Http\Controllers\EmailMarketingController::class, 'email_templates_choose_temp'])->name('user.email-marketing.email.templates.choose-temp');
                    Route::get('/email-templates/view-temp', [App\Http\Controllers\EmailMarketingController::class, 'email_templates_view_temp'])->name('user.email-marketing.email.templates.view-temp');
                    Route::post('/email-templates/create', [App\Http\Controllers\EmailMarketingController::class, 'email_templates_create'])->name('user.email-marketing.email.templates.create');
                    Route::post('/email-templates/delete', [App\Http\Controllers\EmailMarketingController::class, 'email_templates_delete'])->name('user.email-marketing.email.templates.delete');
                    Route::get('/email-templates/editor/{id}', [App\Http\Controllers\EmailMarketingController::class, 'email_templates_editor'])->name('user.email-marketing.email.templates.editor');
                    Route::post('/email-templates/editor/save', [App\Http\Controllers\EmailMarketingController::class, 'email_templates_editor_save'])->name('user.email-marketing.email.templates.editor.save');
                    Route::get('/email-lists', [App\Http\Controllers\EmailMarketingController::class, 'email_lists'])->name('user.email-marketing.email.lists');
                    Route::get('/email-contacts', [App\Http\Controllers\EmailMarketingController::class, 'email_contacts'])->name('user.email-marketing.email.contacts');
                    Route::get('/create-list', [App\Http\Controllers\EmailMarketingController::class, 'create_email_list'])->name('user.email.marketing.create.list');
                    Route::get('/create-contact-list', [App\Http\Controllers\EmailMarketingController::class, 'create_email__contact_list'])->name('user.email.marketing.create.contact.list');
                    Route::get('/email-campaigns', [App\Http\Controllers\EmailMarketingController::class, 'email_campaigns'])->name('user.email-marketing.email.campaigns');
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
                    Route::post('/delete-birthday/{id}', [App\Http\Controllers\BirthdayController::class, 'delete_birthday'])->name('user.delete.birthday');
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

            Route::prefix('/withdrawal')->group(
                function () {
                    Route::get('/', [App\Http\Controllers\DashboardController::class, 'withdrawal'])->name('user.withdrawal');
                    Route::get('/bank', [App\Http\Controllers\DashboardController::class, 'bank'])->name('user.bank.details');
                    Route::get('/other_payment_method', [App\Http\Controllers\DashboardController::class, 'other_payment_method'])->name('user.other.payment.method');
                    Route::get('/direct_us_bank', [App\Http\Controllers\DashboardController::class, 'direct_us_bank'])->name('user.direct.us.bank');
                    Route::get('/paystack', [App\Http\Controllers\DashboardController::class, 'paystack'])->name('user.paystack');
                    Route::get('/paypal', [App\Http\Controllers\DashboardController::class, 'paypal'])->name('user.paypal');
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

// Save FCM Token
Route::post('/save-token', [DashboardController::class, 'saveToken'])->name('save.token');

// Upload
Route::get('/general/builder/scan/file', [App\Http\Controllers\PageController::class, 'general_builder_scan'])->name('user.general.builder.scan');
Route::post('/general/builder/upload/file', [App\Http\Controllers\PageController::class, 'general_builder_upload'])->name('user.general.builder.upload');

// Support
Route::get('/support/checkConvo/{recieverId}', [ChatController::class, 'check']);
Route::post('/support/sendMessage', [ChatController::class, 'store'])->name('sendMessage');
Route::get('/support/loadMessage/{reciever}/{sender}', [ChatController::class, 'load']);
Route::get('/support/retrieveMessages/{reciever}/{sender}/{lastMsgId}', [ChatController::class, 'retrieveNew']);

// Builder
Route::post('/page/builder/save/page', [App\Http\Controllers\PageController::class, 'page_builder_save_page'])->name('user.page.builder.save.page');
Route::post('/funnel/builder/save/page/{page}', [App\Http\Controllers\PageController::class, 'funnel_builder_save_page'])->name('user.funnel.builder.save.page');

Route::get('payment', [PayPalController::class, 'okpay'])->name('ok.pay');
// Paypal Payment
Route::prefix('paypal')->group(function () {
    Route::post('payment', [PayPalController::class, 'payment'])->name('payment');
    Route::any('paymentSuccess', [PayPalController::class, 'paymentSuccess'])->name('paymentSuccess');
    Route::any('paymentFail', [PayPalController::class, 'paymentFail'])->name('paymentFail');
});
