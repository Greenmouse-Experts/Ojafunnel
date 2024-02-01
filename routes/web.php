<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmailMarketingController;
use App\Http\Controllers\ListManagementController;

\DB::raw("SET GLOBAL super_read_only = 0");
\DB::raw("SET GLOBAL read_only = 0");

Route::get('/spam-score/{id}', [EmailMarketingController::class, 'calculateSpamScore']);
Route::get('/text', [AuthController::class, 'text']);

Route::post('/list/management/contact/delete/{id}', [ListManagementController::class, 'delete_contact'])->name('delete_contact');
Route::post('/list/management/contact/delete/{id}', [ListManagementController::class, 'unsub_contact'])->name('unsub_contact');

Route::post('store-cart-details-tmp', [App\Http\Controllers\HomePageController::class, 'store_cart_details_tmp']);
Route::get('access-course', [App\Http\Controllers\HomePageController::class, 'access_course'])->name('access_course');
Route::get('access-course-quiz/{quizId}/{sessionId}', [App\Http\Controllers\HomePageController::class, 'access_course_quiz'])->name('access_course_quiz');
Route::post('access-course-quiz/{quizId}/{sessionId}', [App\Http\Controllers\HomePageController::class, 'submit_course_quiz'])->name('submit.course.quiz');
Route::post('get-access-course', [App\Http\Controllers\HomePageController::class, 'access_auth_course']);
Route::get('course-quiz-result/{quizId}/{sessionId}', [App\Http\Controllers\HomePageController::class, 'course_quiz_result'])->name('course_quiz_result');
Route::get('magic-login-link/{id}', [App\Http\Controllers\HomePageController::class, 'magic_login_link']);
Route::get('check-course-eligibility', [App\Http\Controllers\HomePageController::class, 'checkForCourseEligibility'])->name('check.eligibility');
Route::get('generate-certificate', [App\Http\Controllers\HomePageController::class, 'generateCertificate'])->name('generate.certificate');
Route::get('issue-certificate', [App\Http\Controllers\HomePageController::class, 'issueCertificate'])->name('issue.certificate');

// Route::post('checkout/payment/{storename}', [App\Http\Controllers\HomePageController::class, 'checkoutPayment'])->name('payment.checkout');

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

Route::get('/retrieve/payment/{name}', [App\Http\Controllers\StoreFrontController::class, 'retrievePayment'])->name('retrievePayment');

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

Route::get('/', [App\Http\Controllers\HomePageController::class, 'index'])->name('index');
Route::post('/newsletter/subscribe', [App\Http\Controllers\HomePageController::class, 'subscribe_newsletter'])->name('subscribe.newsletter');
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

// Verify Upsell Payments
Route::get('/accept/{id}', [App\Http\Controllers\CallbackController::class, 'process_upsell_payments']);
Route::get('/accept/bump/{id}', [App\Http\Controllers\CallbackController::class, 'process_bump_payments']);

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
Route::post('send-broadcast', [App\Http\Controllers\DashboardController::class, 'send_broadcast']); //
Route::post('add-quiz-session', [App\Http\Controllers\DashboardController::class, 'add_quiz_session'])->name('add-quiz-session');
Route::post('submit-answers', [App\Http\Controllers\DashboardController::class, 'submit_answers'])->name('submit-answers');
Route::post('submit-quizzes', [App\Http\Controllers\DashboardController::class, 'submit_quizzes'])->name('submit-quizzes');

Route::post('delete-session', [App\Http\Controllers\DashboardController::class, 'delete_session'])->name('delete-session');
Route::post('delete-course', [App\Http\Controllers\DashboardController::class, 'delete_course'])->name('delete-course');
Route::post('delete-requirement', [App\Http\Controllers\DashboardController::class, 'delete_requirement'])->name('delete-requirement');
Route::post('stripe', [App\Http\Controllers\ShopFrontController::class, 'stripePost'])->name('stripe.post');



Route::prefix('dashboard')->group(function(){
    Route::post('validate_buy_backup', [DashboardController::class, 'validate_buy_backup']);
    Route::post('buy_backup', [DashboardController::class, 'buy_backup']);
});




Route::prefix('{username}')->group(function () {
    // Route::domain('{username}.' . config('app.domain_url'))->group(function () {
    Route::prefix('dashboard')->group(
        function () {
            Route::get('/', [App\Http\Controllers\DashboardController::class, 'dashboard'])->name('user.dashboard');
            Route::get('/upgrade', [App\Http\Controllers\DashboardController::class, 'upgrade'])->name('user.upgrade');
            Route::get('/upgrade/account/{plan_id}/{currency}/{price}', [App\Http\Controllers\DashboardController::class, 'upgrade_account'])->name('user.upgrade.account');
            Route::get('/transaction', [App\Http\Controllers\DashboardController::class, 'transaction'])->name('user.transaction');
            Route::get('/subscription', [App\Http\Controllers\DashboardController::class, 'subscription'])->name('user.subscription');

            Route::get('/broadcast-message', [App\Http\Controllers\EmailMarketingController::class, 'broadcast_message'])->name('broadcast-message');

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
                    Route::get('/add-custom-domain/{id}', [App\Http\Controllers\DashboardController::class, 'add_funnel_custom_domain'])->name('user.add.custom.domain');
                    Route::post('/save-custom-domain', [App\Http\Controllers\DashboardController::class, 'save_funnel_custom_domain'])->name('user.save.custom.domain');
                    Route::post('/remove-custom-domain', [App\Http\Controllers\DashboardController::class, 'remove_funnel_custom_domain'])->name('user.remove.custom.domain');
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
            Route::get('/page-builder/use-template/{id}', [App\Http\Controllers\DashboardController::class, 'view_use_page_builder_template'])->name('user.page.use_template');
            Route::post('/page-builder/use-template-create', [App\Http\Controllers\DashboardController::class, 'create_use_page_builder_template'])->name('user.page.create_use_template');
            Route::get('/page-builder/add-custom-domain/{id}', [App\Http\Controllers\DashboardController::class, 'add_page_custom_domain'])->name('user.page.add.custom.domain');
            Route::post('/page-builder/save-custom-domain', [App\Http\Controllers\DashboardController::class, 'save_page_custom_domain'])->name('user.page.save.custom.domain');
            Route::post('/page-builder/remove-custom-domain', [App\Http\Controllers\DashboardController::class, 'remove_page_custom_domain'])->name('user.page.remove.custom.domain');
            Route::get('page-builder/{page}/editor', [App\Http\Controllers\PageController::class, 'viewEditor'])->name('user.page.builder.view.editor');
            Route::get('/page-builder/{page}/quiz', [App\Http\Controllers\PageController::class, 'viewQuizPageFields'])->name('user.page.builder.view.edit.quiz');
            Route::post('/page-builder/{page}/quiz/fields', [App\Http\Controllers\PageController::class, 'viewQuizPageAddFields'])->name('user.page.builder.view.edit.quiz.addfields');
            Route::get('/page-builder/{page}/quiz/fields/delete/{id}', [App\Http\Controllers\PageController::class, 'deleteQuizPageField'])->name('user.page.builder.view.quiz.field.delete');
            Route::get('/page-builder/{page}/quiz/responses', [App\Http\Controllers\PageController::class, 'viewQuizResponses'])->name('user.page.builder.view.quiz.response');
            Route::get('page-builder/{page}', [App\Http\Controllers\PageController::class, 'viewPage'])->name('user.page.builder.view.page');

            // Page Builder template
            Route::get('/page/builder/template/{id}', [App\Http\Controllers\PageController::class, 'page_builder_template_view'])->name('user.page.builder.template');

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

                    // Automation Scheduled Messages

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
                    Route::post('/my-store/digital/product/add/{store_id}', [App\Http\Controllers\StoreController::class, 'addDigitalProduct'])->name('user.store.digital.product.add');
                    Route::post('/my-store/digital/product/update/{store_id}/{id}', [App\Http\Controllers\StoreController::class, 'updateDigitalProduct'])->name('user.store.digital.product.update');
                    Route::post('/my-store/product/delete/{id}', [App\Http\Controllers\StoreController::class, 'deleteProduct'])->name('user.store.product.delete');
                    Route::get('/shop/sales', [App\Http\Controllers\StoreController::class, 'sales'])->name('user.sales');
                    Route::get('/shop/order-details/{id}', [App\Http\Controllers\StoreController::class, 'order_details'])->name('user.order.details');
                    // Route::get('/my-store/storee', [App\Http\Controllers\DashboardController::class, 'store'])->name('user.store');
                    Route::get('/shops', [App\Http\Controllers\StoreController::class, 'shops'])->name('user.shops');
                    Route::get('/stores', [App\Http\Controllers\DashboardController::class, 'stores'])->name('user.stores');
                    Route::get('/checkout', [App\Http\Controllers\DashboardController::class, 'checkout'])->name('user.checkout');
                    Route::get('/cart', [App\Http\Controllers\DashboardController::class, 'cart'])->name('user.cart');

                    Route::get('/my-store/coupon', [App\Http\Controllers\StoreController::class, 'storeCoupon'])->name('user.store.coupon');
                }
            );



            Route::prefix('/Learning')->group(
                function () {
                    Route::get('/create-course', [App\Http\Controllers\DashboardController::class, 'create_course'])->name('user.create.course');
                    Route::get('/shop-course', [App\Http\Controllers\DashboardController::class, 'shop'])->name('user.shop.course');
                    Route::get('/create-course/start', [App\Http\Controllers\DashboardController::class, 'create_course_start'])->name('user.create.course.start');
                    Route::get('/my-cart', [App\Http\Controllers\DashboardController::class, 'my_cart'])->name('user.my.cart');
                    Route::get('/create-course/course-content/{id}', [App\Http\Controllers\DashboardController::class, 'course_content'])->name('user.course.content');
                    Route::post('/create-course/course-content/update_commission/{id}', [App\Http\Controllers\DashboardController::class, 'update_course_commission'])->name('user.course.content.update_course_commission');
                    Route::get('/create-shop', [App\Http\Controllers\DashboardController::class, 'create_shop'])->name('user.create.shop.course');
                    Route::get('/view-shop', [App\Http\Controllers\DashboardController::class, 'view_shops'])->name('user.view.course.shops');
                    Route::get('/view-enrollments/{id}', [App\Http\Controllers\DashboardController::class, 'view_enrollments'])->name('user.view.course.enrollments');
                    Route::get('/my-shop', [App\Http\Controllers\DashboardController::class, 'my_shops'])->name('user.my.shops.course');
                    Route::get('/course/checkout', [App\Http\Controllers\DashboardController::class, 'course_checkout'])->name('user.course.checkout');
                    Route::get('/course/cart', [App\Http\Controllers\DashboardController::class, 'course_cart'])->name('user.course.cart');
                    Route::get('/view-course-details/{id}', [App\Http\Controllers\DashboardController::class, 'view_course_details'])->name('user.view.course.details');
                    // Route::get('/view-course-details1/{id}', [App\Http\Controllers\DashboardController::class, 'view_course_details1']);
                    Route::get('/view-course-details/{id}/{name}/{session}', [App\Http\Controllers\DashboardController::class, 'view_course_details1']);
                    Route::get('/view-quiz/{id}', [App\Http\Controllers\DashboardController::class, 'view_quiz'])->name('view-quiz');
                    Route::get('/view-quiz/{id}/view-scores/{session}', [App\Http\Controllers\DashboardController::class, 'view_scores']);
                    Route::get('/view-scores/{id}', [App\Http\Controllers\DashboardController::class, 'view_scores'])->name('view-scores');
                    Route::get('/create-quiz/{id}', [App\Http\Controllers\DashboardController::class, 'create_quiz'])->name('create-quiz');
                    // Route::get('/create-quiz/{id}/{session}', [App\Http\Controllers\DashboardController::class, 'create_quiz'])->name('create-quiz');
                    Route::get('/create-quiz/{id}/{session}', [App\Http\Controllers\DashboardController::class, 'create_quiz'])->name('create-quiz1');



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
                    Route::post('/email-kits/update', [App\Http\Controllers\EmailMarketingController::class, 'email_kits_update'])->name('user.email-marketing.email.kits.update');
                    Route::post('/email-kits/delete', [App\Http\Controllers\EmailMarketingController::class, 'email_kits_delete'])->name('user.email-marketing.email.kits.delete');
                    Route::post('/email-kits/master', [App\Http\Controllers\EmailMarketingController::class, 'email_kits_master'])->name('user.email-marketing.email.kits.master');
                    Route::get('/email-templates', [App\Http\Controllers\EmailMarketingController::class, 'email_templates'])->name('user.email-marketing.email.templates');
                    Route::get('/email-templates/choose-temp', [App\Http\Controllers\EmailMarketingController::class, 'email_templates_choose_temp'])->name('user.email-marketing.email.templates.choose-temp');
                    Route::get('/email-templates/view-temp', [App\Http\Controllers\EmailMarketingController::class, 'email_templates_view_temp'])->name('user.email-marketing.email.templates.view-temp');
                    Route::post('/email-templates/create', [App\Http\Controllers\EmailMarketingController::class, 'email_templates_create'])->name('user.email-marketing.email.templates.create');
                    Route::post('/email-templates/delete', [App\Http\Controllers\EmailMarketingController::class, 'email_templates_delete'])->name('user.email-marketing.email.templates.delete');
                    Route::get('/email-templates/editor/{id}', [App\Http\Controllers\EmailMarketingController::class, 'email_templates_editor'])->name('user.email-marketing.email.templates.editor');
                    Route::post('/email-templates/editor/save', [App\Http\Controllers\EmailMarketingController::class, 'email_templates_editor_save'])->name('user.email-marketing.email.templates.editor.save');
                    Route::get('/email-campaigns', [App\Http\Controllers\EmailMarketingController::class, 'email_campaigns'])->name('user.email-marketing.email.campaigns');
                    // Route::get('/broadcast-message', [App\Http\Controllers\EmailMarketingController::class, 'broadcast_message'])->name('broadcast-message');


                    Route::get('/email-campaigns/template_content/{id}', [App\Http\Controllers\EmailMarketingController::class, 'email_campaigns_template_content'])->name('user.email-marketing.email.campaigns.template_content');
                    Route::get('/email-campaigns/create', [App\Http\Controllers\EmailMarketingController::class, 'email_campaigns_create'])->name('user.email-marketing.email.campaigns.create');
                    Route::post('/email-campaigns/delete', [App\Http\Controllers\EmailMarketingController::class, 'email_campaigns_delete'])->name('user.email-marketing.email.campaigns.delete');
                    Route::get('/email-campaigns/overview/{id}', [App\Http\Controllers\EmailMarketingController::class, 'email_campaigns_overview'])->name('user.email-marketing.email.campaigns.overview');
                    Route::post('/email-campaigns/save', [App\Http\Controllers\EmailMarketingController::class, 'email_campaigns_save'])->name('user.email-marketing.email.campaigns.save');
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


            // List Management
            Route::prefix('/list/management')->group(
                function () {
                    Route::get('/index', [App\Http\Controllers\ListManagementController::class, 'list_management'])->name('user.list.management');
                    Route::get('/create', [App\Http\Controllers\ListManagementController::class, 'create_list'])->name('user.create.list');
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
Route::post('/support/markMessageAsRead/{messageId}', [ChatController::class, 'markMessageAsRead']);

// Page Builder
Route::post('/page/builder/save/page', [App\Http\Controllers\PageController::class, 'page_builder_save_page'])->name('user.page.builder.save.page');

// Funnel Builder
Route::post('/funnel/builder/save/page/{page}', [App\Http\Controllers\PageController::class, 'funnel_builder_save_page'])->name('user.funnel.builder.save.page');

Route::get('/paypal/payment/success', [App\Http\Controllers\StoreFrontController::class, 'paymentSuccess'])->name('success.payment');
Route::get('/paypal/payment/cancel', [App\Http\Controllers\StoreFrontController::class, 'paymentCancel'])->name('cancel.payment');
