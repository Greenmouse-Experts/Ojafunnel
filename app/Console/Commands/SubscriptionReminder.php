<?php

namespace App\Console\Commands;

use App\Mail\SubscriptionExpiryReminderMail;
use App\Mail\SubscriptionExpiryNotifyAdmin;
use App\Models\OjaPlan;
use Illuminate\Console\Command;
use App\Models\OjaSubscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

class SubscriptionReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriptionReminder:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remind User of the subscription, when it is about to expire.';

    /**
     * Execute the console command.
     *
     * @return int
     */


    public function sendMessageMultitexter($data, $allDataPhones)
    {
        $contacts = User::whereNotNull('phone_number')->pluck('phone_number')->toArray();
        $integration = \App\Models\Integration::where('type', 'Multitexter')->first();
        $api_key = env('MULTITEXTER_API');

        try {
            foreach($allDataPhones as $phone)
            {
                $phoneNumber = trim("0" . ltrim(ltrim(ltrim(ltrim($phone, "0"), "2340"), "234"), "+234"));
                // $get_formatted_phone = "+234".(int)$phoneNumber."<br>";
                $phoneNumber = str_replace("+", "", $phoneNumber);

                $client = new Client();
                $url = "https://app.multitexter.com/v2/app/sendsms";

                $params = [
                    "sender_name" => 'OjaFunnel',
                    "message" => $data['body'],
                    "recipients" => $phoneNumber
                    // "recipients" => "08161215848"
                ];
                $headers = [
                    'Authorization' => 'Bearer ' . $api_key
                ];
                $client->request('POST', $url, [
                    'json' => $params,
                    'headers' => $headers,
                ]);
            }
            $responseBody = true;
        } catch (Exception $e) {
            $responseBody = $e;
        }
        return $responseBody;
    }


    public function handle()
    {
        $subscribers = \App\Models\OjaSubscription::where('status', 'Active')->where('subscription_reminder', '<', 5)->get();
        $user_phones="";
        foreach($subscribers as $subscribe1){
            $user_phones .= User::whereNotNull('phone_number')->where('id', $subscribe1->user_id)->value('phone_number');
        }
        $allDataPhones = substr($user_phones, 0, -1);

        foreach($subscribers as $subscribe)
        {
            if(date('Y-m-d', strtotime($subscribe->expiry_notify_at)) > Carbon::today()->toDateString())
            {
                //send emails
                    $user = User::find($subscribe->user_id);
                    $plan = OjaPlan::find($subscribe->plan_id);
                    Mail::to($user->email)->send(new SubscriptionExpiryReminderMail($user, $subscribe, $plan));
                //send emails

                //send sms
                    $data = array(
                        'body' => "Dear ".ucfirst($user->first_name).",\r\nThis is a notice that your subscription plan will soon expire, kindly check your email.",
                    );
                    $allDataPhones = explode(",", $allDataPhones);
                    $this->sendMessageMultitexter($data, $allDataPhones);
                //send sms
                $subscribe->increment('subscription_reminder');
            }
        }

        // send admin email
            $user_names="";
            foreach($subscribers as $subscribe2){
                $user_details = User::where('id', $subscribe2->user_id)->first();
                $user_details1 = ucwords($user_details->first_name." ".$user_details->last_name);
                if(strlen($user_details1) <= 4){ // it means user didnt enter their names, get their emails
                    $user_names .= $user_details->email.", ";
                }else{
                    $user_names .= $user_details1."|| ";
                }
            }
            $allDataNames = substr($user_names, 0, -3);

            if(strlen($allDataNames) >= 4){
                $allDataNames = str_replace("||", "\r\n", $allDataNames);
                $admin_user = "Admin";
                $admin_message = "Kindly be notified that the following members' plans have or about to expire in due time<br><b>Names</b><br>$allDataNames";
                Mail::to(env('ADMIN_EMAIL'))->send(new SubscriptionExpiryNotifyAdmin($admin_user, $admin_message));
            }
        // send admin email


        //// delete non-active users above admin setting months
        $months_nonactive_user = (int)Admin::find(1)->months_nonactive_user;

        $delete_users = \App\Models\OjaSubscription::where('status', 'Active')->whereDate('expiry_notify_at', '<=', now()->subMonth($months_nonactive_user))->where('subscription_reminder', '<', 5)->whereRaw("user_id IN (SELECT id FROM users WHERE paid_for_backup=1)")->get();
        if(count($delete_users) > 0){
            foreach($delete_users as $delete_user){
                DB::table('bank_details')->where('user_id', $delete_user->user_id)->delete();
                DB::table('birthday_automations')->where('user_id', $delete_user->user_id)->delete();
                DB::table('campaigns')->where('customer_id', $delete_user->user_id)->delete();
                DB::table('contact_lists')->where('user_id', $delete_user->user_id)->delete();
                DB::table('courses')->where('user_id', $delete_user->user_id)->delete();
                DB::table('domains')->where('user_id', $delete_user->user_id)->delete();
                DB::table('email_campaigns')->where('user_id', $delete_user->user_id)->delete();
                DB::table('email_templates')->where('user_id', $delete_user->user_id)->delete();
                DB::table('funnels')->where('user_id', $delete_user->user_id)->delete();
                DB::table('funnel_pages')->where('user_id', $delete_user->user_id)->delete();
                DB::table('integrations')->where('user_id', $delete_user->user_id)->delete();
                DB::table('list_management')->where('user_id', $delete_user->user_id)->delete();
                DB::table('logs')->where('customer_id', $delete_user->user_id)->delete();
                DB::table('mailusers')->where('customer_id', $delete_user->user_id)->delete();
                DB::table('messages')->where('message_users_id', $delete_user->user_id)->delete();
                DB::table('message_users')->where('sender_id', $delete_user->user_id)->orWhere('reciever_id', $delete_user->user_id)->delete();
                DB::table('ojafunnel_mail_supports')->where('user_id', $delete_user->user_id)->delete();
                DB::table('ojafunnel_notifications')->where('to', $delete_user->user_id)->delete();
                DB::table('pages')->where('user_id', $delete_user->user_id)->delete();
                DB::table('products')->where('customer_id', $delete_user->user_id)->delete();
                DB::table('referrals')->where('user', $delete_user->user_id)->orWhere('referred', $delete_user->user_id)->delete();
                DB::table('reply_mail_supports')->where('user_id', $delete_user->user_id)->delete();
                DB::table('sessions')->where('user_id', $delete_user->user_id)->delete();
                DB::table('shops')->where('user_id', $delete_user->user_id)->delete();
                DB::table('sms_automations')->where('user_id', $delete_user->user_id)->delete();
                DB::table('sms_campaigns')->where('user_id', $delete_user->user_id)->delete();
                DB::table('stores')->where('user_id', $delete_user->user_id)->delete();
                DB::table('store_coupons')->where('user_id', $delete_user->user_id)->delete();
                DB::table('store_products')->where('user_id', $delete_user->user_id)->delete();
                DB::table('transactions')->where('user_id', $delete_user->user_id)->delete();
                DB::table('wa_campaigns')->where('user_id', $delete_user->user_id)->delete();
                DB::table('whatsapp_numbers')->where('user_id', $delete_user->user_id)->delete();
                DB::table('withdrawals')->where('user_id', $delete_user->user_id)->delete();
                DB::table('users')->where('id', $delete_user->user_id)->delete();
                $delete_user->delete();
            }
        }

        return Command::SUCCESS;
    }
}
