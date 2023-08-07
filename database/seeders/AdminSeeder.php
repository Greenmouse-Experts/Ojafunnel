<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // insert into admin_groups
        DB::insert("INSERT INTO `admin_groups` (`name`, `options`, `permissions`, `creator_id`, `created_at`, `updated_at`) VALUES
        ('Administrator', '', '{\"admin_group_read\":\"all\",\"admin_group_create\":\"yes\",\"admin_group_update\":\"all\",\"admin_group_delete\":\"all\",\"admin_read\":\"all\",\"admin_create\":\"yes\",\"admin_update\":\"all\",\"admin_delete\":\"all\",\"admin_login_as\":\"all\",\"customer_read\":\"all\",\"customer_create\":\"yes\",\"customer_update\":\"all\",\"customer_delete\":\"all\",\"customer_login_as\":\"all\",\"subscription_read\":\"all\",\"subscription_create\":\"yes\",\"subscription_update\":\"all\",\"subscription_disable\":\"all\",\"subscription_enable\":\"all\",\"subscription_delete\":\"all\",\"subscription_paid\":\"all\",\"subscription_unpaid\":\"all\",\"plan_read\":\"all\",\"plan_create\":\"yes\",\"plan_update\":\"all\",\"plan_delete\":\"all\",\"payment_method_read\":\"all\",\"payment_method_create\":\"yes\",\"payment_method_update\":\"all\",\"payment_method_delete\":\"all\",\"sending_server_read\":\"all\",\"sending_server_create\":\"yes\",\"sending_server_update\":\"all\",\"sending_server_delete\":\"all\",\"bounce_handler_read\":\"all\",\"bounce_handler_create\":\"yes\",\"bounce_handler_update\":\"all\",\"bounce_handler_delete\":\"all\",\"fbl_handler_read\":\"all\",\"fbl_handler_create\":\"yes\",\"fbl_handler_update\":\"all\",\"fbl_handler_delete\":\"all\",\"sending_domain_read\":\"all\",\"sending_domain_create\":\"yes\",\"sending_domain_update\":\"all\",\"sending_domain_delete\":\"all\",\"template_read\":\"all\",\"template_create\":\"yes\",\"template_update\":\"all\",\"template_delete\":\"all\",\"layout_read\":\"yes\",\"layout_update\":\"yes\",\"setting_general\":\"yes\",\"setting_sending\":\"yes\",\"setting_system_urls\":\"yes\",\"setting_access_when_offline\":\"yes\",\"setting_background_job\":\"yes\",\"setting_upgrade_manager\":\"yes\",\"language_read\":\"yes\",\"language_create\":\"yes\",\"language_update\":\"yes\",\"language_delete\":\"yes\",\"currency_read\":\"all\",\"currency_create\":\"yes\",\"currency_update\":\"all\",\"currency_delete\":\"all\",\"report_blacklist\":\"yes\",\"report_tracking_log\":\"yes\",\"report_bounce_log\":\"yes\",\"report_feedback_log\":\"yes\",\"report_open_log\":\"yes\",\"report_click_log\":\"yes\",\"report_unsubscribe_log\":\"yes\"}', NULL, '2017-03-06 18:33:12', '2017-04-09 06:31:41'),
        ('Reseller', '', '{\"admin_group_read\":\"no\",\"admin_group_create\":\"no\",\"admin_group_update\":\"no\",\"admin_group_delete\":\"no\",\"admin_read\":\"no\",\"admin_create\":\"no\",\"admin_update\":\"no\",\"admin_delete\":\"no\",\"admin_login_as\":\"no\",\"customer_read\":\"own\",\"customer_create\":\"yes\",\"customer_update\":\"own\",\"customer_delete\":\"own\",\"customer_login_as\":\"own\",\"subscription_read\":\"own\",\"subscription_create\":\"yes\",\"subscription_update\":\"no\",\"subscription_disable\":\"own\",\"subscription_enable\":\"own\",\"subscription_delete\":\"own\",\"subscription_paid\":\"no\",\"subscription_unpaid\":\"no\",\"plan_read\":\"all\",\"plan_create\":\"no\",\"plan_update\":\"no\",\"plan_delete\":\"no\",\"payment_method_read\":\"no\",\"payment_method_create\":\"no\",\"payment_method_update\":\"no\",\"payment_method_delete\":\"no\",\"sending_server_read\":\"no\",\"sending_server_create\":\"no\",\"sending_server_update\":\"no\",\"sending_server_delete\":\"no\",\"bounce_handler_read\":\"no\",\"bounce_handler_create\":\"no\",\"bounce_handler_update\":\"no\",\"bounce_handler_delete\":\"no\",\"fbl_handler_read\":\"no\",\"fbl_handler_create\":\"no\",\"fbl_handler_update\":\"no\",\"fbl_handler_delete\":\"no\",\"sending_domain_read\":\"no\",\"sending_domain_create\":\"no\",\"sending_domain_update\":\"no\",\"sending_domain_delete\":\"no\",\"template_read\":\"own\",\"template_create\":\"yes\",\"template_update\":\"own\",\"template_delete\":\"own\",\"layout_read\":\"no\",\"layout_update\":\"no\",\"setting_general\":\"no\",\"setting_sending\":\"no\",\"setting_system_urls\":\"no\",\"setting_access_when_offline\":\"no\",\"setting_background_job\":\"no\",\"setting_upgrade_manager\":\"no\",\"language_read\":\"no\",\"language_create\":\"no\",\"language_update\":\"no\",\"language_delete\":\"no\",\"currency_read\":\"no\",\"currency_create\":\"no\",\"currency_update\":\"no\",\"currency_delete\":\"no\",\"report_blacklist\":\"no\",\"report_tracking_log\":\"no\",\"report_bounce_log\":\"no\",\"report_feedback_log\":\"no\",\"report_open_log\":\"no\",\"report_click_log\":\"no\",\"report_unsubscribe_log\":\"no\"}', NULL, '2017-04-09 06:31:41', '2017-04-09 06:34:44');");

        
        DB::insert("INSERT INTO `site_features` (`features`) VALUES
        ('Page Builder'), ('Funnel Builder'), ('Subscription Page'), ('Email Marketing'), ('Integration Page'), ('List Management')");


        // insert into users
        DB::insert("INSERT INTO `users` (`user_type`, `affiliate_link`, `code`, `photo`, `first_name`, `last_name`, `username`, `email`, `phone_number`, `referral_link`, `ref_bonus`, `email_verified_at`, `plan`, `customer_id`, `status`, `password`, `remember_token`, `created_at`, `updated_at`, `wallet`, `fcm_token`, `promotion_link`, `promotion_bonus`) VALUES
        ('Administrator', 'ojaFunnel', NULL, NULL, 'Oja', 'Funnel', 'ojafunnel', 'admin@ojafunnel.com', '090909090909', NULL, '0.00', '2023-01-06 07:05:19', '1', 1, 'active', '$2y$10\$YQ8n8kVsBAyghWIzfPyxA.lOfX9Ub7NUdMhFUfLo4RX06EPUR3TS6', NULL, '2023-01-06 07:03:32', '2023-01-10 12:10:22', '0.00', NULL, '9aef1d9ac', '0.00');");

        // insert into customers
        DB::insert("INSERT INTO `customers` (`uid`, `admin_id`, `contact_id`, `language_id`, `timezone`, `status`, `color_scheme`, `quota`, `created_at`, `updated_at`, `cache`, `text_direction`, `payment_method`, `auto_billing_data`, `menu_layout`, `theme_mode`) VALUES
        ('63b7c87dc4b17', NULL, NULL, 1, 'Africa/Lagos', 'active', 'default', NULL, '2023-01-06 07:06:37', '2023-01-16 14:00:00', '{\"SubscriberCount\":13,\"SubscriberUsage\":1.3,\"SubscribedCount\":8,\"UnsubscribedCount\":0,\"UnconfirmedCount\":0,\"BlacklistedCount\":0,\"SpamReportedCount\":0,\"MailListSelectOptions\":[{\"id\":2,\"value\":\"63beca3f4f626\",\"text\":\"Green Mouse (0 subscribers)\"},{\"id\":8,\"value\":\"63bfd15cd0f37\",\"text\":\"Launch (4 subscribers)\"},{\"id\":10,\"value\":\"63c185db9a71f\",\"text\":\"New Oja (0 subscribers)\"},{\"id\":9,\"value\":\"63c1843562290\",\"text\":\"Oja Funnel (0 subscribers)\"},{\"id\":1,\"value\":\"63b7ce9d76acd\",\"text\":\"Test Contact (7 subscribers)\"}],\"Bounce\\/FeedbackRate\":0}', 'ltr', '{\"method\":\"offline\"}', NULL, 'left', 'auto');");

        // insert into mail user
        DB::insert("INSERT INTO `mailusers` (`uid`, `api_token`, `creator_id`, `email`, `password`, `remember_token`, `status`, `created_at`, `updated_at`, `quota`, `activated`, `one_time_api_token`, `customer_id`, `first_name`, `last_name`) VALUES
         ('63b7c87daf83f', 'SwpLpt1sp6Sztrv46mJ55EkOKHDxUgTBwpTWfMcNytsnYYAy92mTBDtfyNyv', NULL, 'lotushub@gmail.com', '$2y$10\$nXMvKLchL2H4hsuee06mJ.rZ2zsK7qmPbwSat/ROVxnyJJ0Yp3nBi', 'Bp4fDKs6LAy3Qf97mXkP4HJ8OVvQIbcAaheKqhCtwu8MhVHeIfK1u3AhKB6F', 'active', '2016-12-31 23:00:00', '2023-01-06 07:06:37', NULL, 1, NULL, 1, 'Lotus', 'Hub');");

        // insert into admins
        DB::insert("INSERT INTO `admins` (`uid`, `user_id`, `creator_id`, `contact_id`, `admin_group_id`, `language_id`, `timezone`, `status`, `color_scheme`, `created_at`, `updated_at`, `text_direction`, `menu_layout`, `theme_mode`, `email`, `name`, `password`, `fcm_token`) VALUES 
        ('63b7c87dbfdad', 1, NULL, NULL, 1, 1, 'Africa/Lagos', 'active', NULL, '2016-12-31 22:00:00', '2023-03-10 11:02:53', 'ltr', 'left', 'light', 'admins@ojafunnel.com', 'Administrator', '$2y$10\$BOXNf2KHfv60NAKqSt/xrex.KfUBOTwWUby0gh5.0Wd.UvDbpzWMO', 'fksZDJWcpMyLCKRfwVHSL0:APA91bHlVU-Gp7zDID4gApFQfY15UH22-XmwEHS3F_bXhXpK76ARiC3Ja_bDEgDCAQlcZ4I_XjaEKC3H6NAnq-QtxZYF-s6L4yt-RK-cayuO0LPUzi2JuyBU-Erg02I3N44F2x9sTmCl');");
    }
}
