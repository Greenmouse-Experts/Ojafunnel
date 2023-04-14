<?php

namespace App\Http\Controllers;

use Throwable;
use App\Mail\TestMail;
use App\Models\EmailKit;
use Illuminate\Bus\Batch;
use Illuminate\Http\Request;
use App\Jobs\ProcessEmailCampaign;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Auth;

class EmailMarketingController extends Controller
{
    public function email_kits(Request $request)
    {
        $user_email_integrations = EmailKit::latest()->where(['account_id' => Auth::user()->id, 'is_admin' => false])->get();
        $admin_email_integrations = EmailKit::latest()->where(['is_admin' => true])->get();

        return view('dashboard.email-marketing.email-kits.index', [
            'user_email_integrations' => $user_email_integrations,
            'admin_email_integrations' => $admin_email_integrations,
        ]);
    }

    public function email_templates(Request $request)
    {
        return view('dashboard.email-marketing.email-templates.index', []);
    }

    public function email_lists(Request $request)
    {
        return view('dashboard.email-marketing.email-lists.index', []);
    }

    public function email_campaigns(Request $request)
    {
        return view('dashboard.email-marketing.email-campaigns.index', []);
    }

    public function create_campign(Request $request)
    {
        $email_kit = EmailKit::where(['id' => '2', 'user_id', Auth::user()->id]);

        if ($email_kit->exists()) {
            $email_kit = $email_kit->get();

            $batch = Bus::batch([
                new ProcessEmailCampaign([
                    'smtp_host'    => $email_kit->host,
                    'smtp_port'    => $email_kit->port,
                    'smtp_username'  => $email_kit->username,
                    'smtp_password'  => $email_kit->password,
                    'from_email'    => $email_kit->from_email,
                    'from_name'    => $email_kit->from_name,
                ], 'obafunsoridwanadebayo17@gmail.com', new TestMail()),
            ])->then(function (Batch $batch) {
            })->catch(function (Batch $batch, Throwable $e) {
            })->finally(function (Batch $batch) {
                // done here
            })->name('ProcessEmailCampaign')
                ->allowFailures(false)
                ->onQueue('emailcampaign')
                ->dispatch();

            // process email campaign
            // ProcessEmailCampaign::dispatch([
            //     'smtp_host'    => $email_kit->host,
            //     'smtp_port'    => $email_kit->port,
            //     'smtp_username'  => $email_kit->username,
            //     'smtp_password'  => $email_kit->password,
            //     'from_email'    => $email_kit->from_email,
            //     'from_name'    => $email_kit->from_name,
            // ], 'obafunsoridwanadebayo17@gmail.com', new TestMail());
        }
    }
}
