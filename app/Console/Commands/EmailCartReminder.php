<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TempCart;
use Carbon\Carbon;
use Exception;



class EmailCartReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sms_cart_reminder:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user_emails = TempCart::where('sent_email', 0)->where('created_at', '<=', now()->subHours(24))->pluck('email')->toArray();
        $all_emails = "";
        $send_emails = false;
        if(count($user_emails) > 0){
            $data = array(
                'name' => "Hello Chief",
                'subject' => "Unfinished Shopping",
                'body' => "We noticed you didn't complete your shopping process, we are ready to assist you if you are facing any challenges or problems. Kindly contact us lets put you through in completing your shopping.",
                'emails' => $user_emails
            );
            Mail::to(env('MAIL_FROM_ADDRESS'))->bcc($data['emails'])->send(new \App\Mail\BroadcastEmail($data['subject'], $data['body']));
            $send_emails = true;
        }

        if($send_emails){
            return response()->json([
                'status' => 'success',
                'message' => "emails sent",
                'data' => ''
            ],200);         
        }
        return response()->json([
            'status' => 'error',
            'message' => "Error in sending email reminders",
            'data' => ''
        ],200);

        return Command::SUCCESS;
    }



}
