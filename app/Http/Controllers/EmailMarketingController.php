<?php

namespace App\Http\Controllers;

use App\Models\EmailKit;
use Illuminate\Http\Request;
use App\Models\EmailCampaign;
use App\Models\EmailTemplate;
use Illuminate\Support\Carbon;
use App\Jobs\ProcessEmailCampaign;
use App\Models\EmailCampaignQueue;
use App\Models\ListManagement;
use App\Models\ListManagementContact;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\HomePageController;

class EmailMarketingController extends Controller
{

    private $home;
    public function __construct(){
        $this->home = new HomePageController;
    }

    public function email_kits(Request $request)
    {
        if($this->home->site_features_settings('Email Marketing') || $this->home->user_site_features_settings('Email Marketing') > 0) return $this->home->redirects();

        $user_email_integrations = EmailKit::latest()->where(['account_id' => Auth::user()->id, 'is_admin' => false])->get();
        $admin_email_integrations = EmailKit::latest()->where(['is_admin' => true])->get();

        return view('dashboard.email-marketing.email-kits.index', [
            'user_email_integrations' => $user_email_integrations,
            'admin_email_integrations' => $admin_email_integrations,
        ]);
    }

    public function email_kits_update(Request $request)
    {
        $request->validate([
            'host' => 'required',
            'port' => 'required|numeric',
            'username' => 'required|string',
            'password' => 'required',
            'encryption' => 'required|string',
            'from_email' => 'required|email',
            'from_name' => 'required|string',
            'replyto_name' => 'required|string',
            'replyto_email' => 'required|string',
        ]);

        $email_kit = EmailKit::where(['id' => $request->id, 'account_id' => Auth::user()->id, 'is_admin' => false]);

        if (!$email_kit->exists()) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Error occured'
            ]);
        }

        $email_kit->update([
            'host' =>  $request->host,
            'port' => $request->port,
            'username' => $request->username,
            'password' => $request->password,
            'encryption' => $request->encryption,
            'from_email' => $request->from_email,
            'from_name' => $request->from_name,
            'replyto_name' => $request->replyto_name,
            'replyto_email' => $request->replyto_email,
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Email kit updated successfully'
        ]);
    }

    public function email_kits_master(Request $request)
    {
        $email_kit = EmailKit::where(['account_id' => Auth::user()->id, 'is_admin' => false]);
        $_email_kit = EmailKit::where(['id' => $request->id, 'account_id' => Auth::user()->id, 'is_admin' => false]);

        if (!$email_kit->exists() || !$_email_kit->exists()) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Error occured'
            ]);
        }

        $email_kit->update(['master' => false]);
        $_email_kit->update(['master' => true]);

        return back()->with([
            'type' => 'success',
            'message' => 'Email kit has been assigned master successfully'
        ]);
    }

    public function email_kits_delete(Request $request)
    {
        $email_kit = EmailKit::where(['id' => $request->id, 'account_id' => Auth::user()->id, 'is_admin' => false]);

        if ($request->delete != 'DELETE') {
            return back()->with([
                'type' => 'danger',
                'message' => 'Please type DELETE to confirm.'
            ]);
        }

        if (!$email_kit->exists()) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Error occured'
            ]);
        }

        // delete model
        $email_kit->delete();

        return back()->with([
            'type' => 'success',
            'message' => 'Email kit deleted successfully'
        ]);
    }

    public function email_templates(Request $request)
    {
        if($this->home->site_features_settings('Email Marketing') || $this->home->user_site_features_settings('Email Marketing') > 0) return $this->home->redirects();

        $email_templates = EmailTemplate::where(['user_id' => Auth::user()->id])->get();

        return view('dashboard.email-marketing.email-templates.index', [
            'email_templates' => $email_templates
        ]);
    }

    public function email_templates_choose_temp()
    {
        if($this->home->site_features_settings('Email Marketing') || $this->home->user_site_features_settings('Email Marketing') > 0) return $this->home->redirects();

        return view('dashboard.email-marketing.email-templates.choose-temp', []);
    }

    public function email_templates_view_temp(Request $request)
    {
        if($this->home->site_features_settings('Email Marketing') || $this->home->user_site_features_settings('Email Marketing') > 0) return $this->home->redirects();

        if ($request->id > 4) return redirect(route('user.dashboard', ['username', Auth::user()->username]));

        $calltoaction1 = file_get_contents(resource_path('views/emails/email-marketing-templates/default/template-1.blade.php'));
        $calltoaction2 = file_get_contents(resource_path('views/emails/email-marketing-templates/default/template-2.blade.php'));
        $weeklydigest = file_get_contents(resource_path('views/emails/email-marketing-templates/default/template-3.blade.php'));
        $warning = file_get_contents(resource_path('views/emails/email-marketing-templates/default/template-4.blade.php'));
        $billing = file_get_contents(resource_path('views/emails/email-marketing-templates/default/template-5.blade.php'));

        $from = ["{{ \$name }}", "{{ \$email }}"];
        $to = ["\$name", "\$email"];

        $calltoaction1 = str_replace($from, $to, $calltoaction1);
        $calltoaction2 = str_replace($from, $to, $calltoaction2);
        $weeklydigest = str_replace($from, $to, $weeklydigest);
        $warning = str_replace($from, $to, $warning);
        $billing = str_replace($from, $to, $billing);

        return view('dashboard.email-marketing.email-templates.view-temp', [
            'templates' => [$calltoaction1, $calltoaction2, $weeklydigest, $warning, $billing],
            'id' => $request->id
        ]);
    }

    public function email_templates_create(Request $request)
    {
        $name = $this->sanitizeName($request->name);
        $slug = strtolower(implode('-', explode(' ', $name)));
        $username = Auth::user()->username;

        $email_template = EmailTemplate::where(['slug' => $slug, 'user_id' => Auth::user()->id]);

        if ($email_template->exists()) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Email template already exists'
            ]);
        }

        if ($request->id < 1 || $request->id > 5) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Email template not found.'
            ]);
        }

        // check if contains dots
        if (str_contains($name, '.') || str_contains($name, '-')) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Email template is invalid. Can\'t contain dot(s) or hyphen(s)'
            ]);
        }

        // prevent username with 'default' to add template to root folder
        if ($username == 'default') {
            return back()->with([
                'type' => 'danger',
                'message' => 'This user is not allowed to create email template due to security reasons'
            ]);
        }

        // check if folder exist, if not create new
        File::ensureDirectoryExists(resource_path("views/emails/email-marketing-templates/$username"));

        // put template into disk
        $disk = resource_path("views/emails/email-marketing-templates/$username/$slug.blade.php");
        $template = file_get_contents(resource_path("views/emails/email-marketing-templates/default/template-$request->id.blade.php"));

        if (!file_put_contents($disk, $template)) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Error occured while creating template. Try again'
            ]);
        }

        $email_template = new EmailTemplate();
        $email_template->user_id = Auth::user()->id;
        $email_template->name = $request->name;
        $email_template->location = "views/emails/email-marketing-templates/$username/$slug.blade.php";
        $email_template->slug = $slug;
        $email_template->save();

        return redirect(route('user.email-marketing.email.templates', ['username' => $username]))->with([
            'type' => 'success',
            'message' => 'Email template created successfully. Please do edit to your taste.'
        ]);
    }

    public function email_templates_delete(Request $request)
    {
        $template = EmailTemplate::where(['id' => $request->id, 'user_id' => Auth::user()->id]);

        if ($request->delete != 'DELETE') {
            return back()->with([
                'type' => 'danger',
                'message' => 'Please type DELETE to confirm.'
            ]);
        }

        if (!$template->exists()) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Error occured'
            ]);
        }

        $username = Auth::user()->username;
        $slug = $template->first()->slug;

        $disk = resource_path("views/emails/email-marketing-templates/$username/$slug.blade.php");

        if (!File::delete($disk)) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Error occured while deleting the template. Try again'
            ]);
        }

        // delete model
        $template->delete();

        return back()->with([
            'type' => 'success',
            'message' => 'Email template deleted successfully'
        ]);
    }

    public function email_templates_editor(Request $request)
    {
        $template = EmailTemplate::where('id', $request->id);

        if (!$template->exists()) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Error occured while loading email editor. Try again'
            ]);
        }

        if ($template->first()->user_id != Auth::user()->id) {
            return back()->with([
                'type' => 'danger',
                'message' => 'You re not authorized to view this email template'
            ]);
        }

        $template = file_get_contents(resource_path($template->first()->location));

        $from = ["{{ \$name }}", "{{ \$email }}"];
        $to = ["\$name", "\$email"];
        $template = str_replace($from, $to, $template);

        return view('dashboard.email-marketing.email-templates.editor', [
            'template' => $template,
            'id' => $request->id
        ]);
    }

    public function email_templates_editor_save(Request $request)
    {
        $template = EmailTemplate::where('id', $request->id);

        if (!$template->exists()) {
            return response()->json([
                'status' => false,
                'message' => 'Error occured while loading email editor. Try again'
            ]);
        }

        $username = Auth::user()->username;
        $slug = $template->first()->slug;

        $disk = resource_path("views/emails/email-marketing-templates/$username/$slug.blade.php");

        $from = ["{{", "}}", "\$name", "\$email"];
        $to = ["", "", "{{ \$name }}", "{{ \$email }}"];
        $template = str_replace($from, $to, $request->content);

        if (!file_put_contents($disk, $template)) {
            return response()->json([
                'status' => false,
                'message' => 'Error occured while saving template. Try again'
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Email template saved successully.'
        ]);
    }

    public function email_campaigns(Request $request)
    {
        if($this->home->site_features_settings('Email Marketing') || $this->home->user_site_features_settings('Email Marketing') > 0) return $this->home->redirects();

        $email_campaigns = EmailCampaign::latest()->where('user_id', Auth::user()->id)->get();

        return view('dashboard.email-marketing.email-campaigns.index', [
            'email_campaigns' => $email_campaigns
        ]);
    }

    
    public function broadcast_message(Request $request)
    {
        $lists = ListManagementContact::latest()->get();

        $list_tags = "";
        foreach($lists as $list){
            if($list->tags !== null){
                $list_tags .= $list->tags.",";
            }
        }
        $list_tags = str_replace(", ", ",", $list_tags);
        $list_tags = array_unique(explode(',', $list_tags));

        $arrs=[];
        foreach($list_tags as $list_tag){
            if($list_tag !== ""){
                $arrs[] = $list_tag;
            }
        }
        $data['tags'] = $arrs;
        return view('dashboard.broadcast', $data);
    }


    public function email_campaigns_delete(Request $request)
    {
        $email_campaign = EmailCampaign::find($request->id);

        if (count($email_campaign->email_campaign_queues->where('status', 'Waiting')) > 0) {
            return back()->with([
                'type' => 'danger',
                'message' => 'The email campaign can\'t be deleted during execution.'
            ]);
        }

        // delete all related wa_queues
        $email_campaign->email_campaign_queues()->delete();

        // delete campaign
        $email_campaign->delete();

        return back()->with([
            'type' => 'success',
            'message' => 'The email campaign has been deleted successfully.'
        ]);
    }

    public function email_campaigns_overview(Request $request)
    {
        if($this->home->site_features_settings('Email Marketing') || $this->home->user_site_features_settings('Email Marketing') > 0) return $this->home->redirects();

        $email_campaign = EmailCampaign::latest()->where(['user_id' => Auth::user()->id, 'id' => $request->id])->first();
        $email_campaign_queues = EmailCampaignQueue::where('email_campaign_id', $email_campaign->id)->get();

        return view('dashboard.email-marketing.email-campaigns.overview', [
            'email_campaign' => $email_campaign,
            'email_campaign_queues' => $email_campaign_queues
        ]);
    }

    public function email_campaigns_create()
    {
        if($this->home->site_features_settings('Email Marketing') || $this->home->user_site_features_settings('Email Marketing') > 0) return $this->home->redirects();

        $email_templates = EmailTemplate::where(['user_id' => Auth::user()->id])->get();
        $mail_lists = ListManagement::where('user_id', Auth::user()->id)->where('status', true)->get();

        return view('dashboard.email-marketing.email-campaigns.create', [
            'email_templates' => $email_templates,
            'mail_lists' => $mail_lists
        ]);
    }

    public function email_campaigns_template_content(Request $request)
    {
        $email_template = EmailTemplate::where(['id' => $request->id, 'user_id' => Auth::user()->id]);

        if (!$email_template->exists()) {
            return response()->json([
                'success' => false,
                'data' => 'email template not exist',
            ]);
        }

        $template = file_get_contents(resource_path($email_template->first()->location));
        $from = ["{{ \$name }}", "{{ \$email }}"];
        $to = ["\$name", "\$email"];
        $template = str_replace($from, $to, $template);

        return response()->json([
            'success' => true,
            'data' => $template,
        ]);
    }

    public function email_campaigns_save(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'subject' => 'required',
            'email_template_id' => 'required',
            'email_template' => 'required',
            'email_list' => 'required',
            'message_timing' => 'required'
        ]);

        $email_kit = EmailKit::where(['account_id' => Auth::user()->id, 'is_admin' => false, 'master' => true]);
        $email_template = EmailTemplate::where('id', $request->email_template_id)->first();
        $mail_list = ListManagement::where('id', $request->email_list)->first();

        if (!$email_kit->exists()) {
            $email_kit = EmailKit::where(['is_admin' => true, 'master' => true]);

            if (!$email_kit->exists()) {
                return back()->with([
                    'type' => 'danger',
                    'message' => 'You currently have no master email kit. Likewise Ojafunnel team have no master email kit. Please set up email kit and it make master. Thanks.'
                ])->withInput();
            }

            $email_kit = $email_kit->first();
        } else $email_kit = $email_kit->first();

        if ($request->message_timing == 'Immediately') {
            DB::transaction(function () use ($request, $email_kit, $email_template, $mail_list) {
                $slug = $email_template->slug . '-' . substr(sha1(mt_rand()), 10, 15);
                $username = Auth::user()->username;
                $template = $request->email_template;

                // replace all variables with correct laravel syntax
                $from = ["{{", "}}", "\$name", "\$email"];
                $to = ["", "", "{{ \$name }}", "{{ \$email }}"];
                $template = str_replace($from, $to, $template);

                // add Powered by Ojafunnel
                $template = str_replace("</body>", $this->getPoweredBy(), $template);

                // check if folder exist, if not create new
                File::ensureDirectoryExists(resource_path("views/emails/email-marketing-templates/$username"));

                // put template into disk
                $disk = resource_path("views/emails/email-marketing-templates/$username/$slug.blade.php");

                if (!file_put_contents($disk, $template)) {
                    return back()->with([
                        'type' => 'danger',
                        'message' => 'Error occured while creating template. Try again'
                    ]);
                }

                $email_campaign = new EmailCampaign();
                $email_campaign->user_id = Auth::user()->id;
                $email_campaign->name = $request->name;
                $email_campaign->subject = $request->subject;
                $email_campaign->replyto_email = $email_kit->replyto_email;
                $email_campaign->replyto_name = $email_kit->replyto_name;
                $email_campaign->email_kit_id = $email_kit->id;
                $email_campaign->list_id = $mail_list->id;
                $email_campaign->email_template_id = $email_template->id;
                $email_campaign->sent = 0;
                $email_campaign->bounced = 0;
                $email_campaign->spam_score = 0;
                $email_campaign->message_timing = $request->message_timing;
                $email_campaign->attachment_paths = json_encode([]);
                $email_campaign->slug = $slug;
                $email_campaign->save();

                if ($request->hasFile('attachments')) {
                    $attachment_paths = [];

                    foreach ($request->file('attachments') as $key => $attachment) {
                        $filename = $attachment->getClientOriginalName();
                        $path = 'email-marketing/' . Auth::user()->username . '/attachment/campaign-' . $email_campaign->id;
                        $fullpath = $path . '/' . $filename;

                        // store here
                        $attachment->storeAs($path, $filename, 'public');

                        array_push($attachment_paths, $fullpath);
                    }

                    $email_campaign->attachment_paths = json_encode($attachment_paths);
                    $email_campaign->save();
                }

                $contacts = ListManagementContact::latest()->where('list_management_id', $mail_list->id)->get();

                // build each wa queue data based on contacts
                $email_campaign_queue = $contacts->map(function ($_contact) use ($email_campaign) {
                    $timestamp = Carbon::now();

                    return [
                        'email_campaign_id' => $email_campaign->id,
                        'recepient' => $_contact->email,
                        'status' => 'Waiting',
                        'created_at' => $timestamp,
                        'updated_at' => $timestamp,
                    ];
                })->toArray();

                // bulk insert
                EmailCampaignQueue::insert($email_campaign_queue);

                // divide into 500 chunks and
                // delay each job between 10  - 20 sec in the queue
                $chunks = $contacts->chunk(500);
                $delay = mt_rand(10, 20);

                // dispatch job and delay
                foreach ($chunks as $key => $_chunk) {
                    // dispatch job
                    ProcessEmailCampaign::dispatch([
                        'smtp_host'    => $email_kit->host,
                        'smtp_port'    => $email_kit->port,
                        'smtp_username'  => $email_kit->username,
                        'smtp_password'  => $email_kit->password,
                        'from_email'    => $email_kit->from_email,
                        'from_name'    => $email_kit->from_name,
                    ],  $_chunk, [
                        'email_campaign' => $email_campaign,
                        'email_kit' => $email_kit,
                        'user' => Auth::user()
                    ])->afterCommit()->onQueue('emailCampaign')->delay($delay);

                    $delay += mt_rand(10, 20);
                }
            });

            return back()->with([
                'type' => 'success',
                'message' => 'The Email campaign has been created and execution will begin soon.'
            ]);
        }

        if ($request->message_timing == 'Schedule') {
            $request->validate([
                'start_date' => 'required',
                'start_time' => 'required',
            ]);

            if ($request->start_date < Carbon::now()->format('Y-m-d')) return back()->with([
                'type' => 'danger',
                'message' => 'The email campaign schedule start date is invalid'
            ])->withInput();

            if ($request->start_date == Carbon::now()->format('Y-m-d')) {
                if ($request->start_time <= Carbon::now()->format('H:i'))  return back()->with([
                    'type' => 'danger',
                    'message' => 'The email campaign schedule start time is invalid'
                ])->withInput();
            }

            DB::transaction(function () use ($request, $email_kit, $email_template, $mail_list) {
                $slug = $email_template->slug . '-' . substr(sha1(mt_rand()), 10, 15);
                $username = Auth::user()->username;
                $template = $request->email_template;

                // replace all variables with correct laravel syntax
                $from = ["{{", "}}", "\$name", "\$email"];
                $to = ["", "", "{{ \$name }}", "{{ \$email }}"];
                $template = str_replace($from, $to, $template);

                // add Powered by Ojafunnel
                $template = str_replace("</body>", $this->getPoweredBy(), $template);

                // check if folder exist, if not create new
                File::ensureDirectoryExists(resource_path("views/emails/email-marketing-templates/$username"));

                // put template into disk
                $disk = resource_path("views/emails/email-marketing-templates/$username/$slug.blade.php");

                if (!file_put_contents($disk, $template)) {
                    return back()->with([
                        'type' => 'danger',
                        'message' => 'Error occured while creating template. Try again'
                    ]);
                }

                $email_campaign = new EmailCampaign();
                $email_campaign->user_id = Auth::user()->id;
                $email_campaign->name = $request->name;
                $email_campaign->subject = $request->subject;
                $email_campaign->replyto_email = $email_kit->replyto_email;
                $email_campaign->replyto_name = $email_kit->replyto_name;
                $email_campaign->email_kit_id = $email_kit->id;
                $email_campaign->list_id = $mail_list->id;
                $email_campaign->email_template_id = $email_template->id;
                $email_campaign->sent = 0;
                $email_campaign->bounced = 0;
                $email_campaign->spam_score = 0;
                $email_campaign->message_timing = $request->message_timing;
                $email_campaign->start_date = $request->start_date;
                $email_campaign->start_time = $request->start_time;
                $email_campaign->slug = $slug;
                $email_campaign->attachment_paths = json_encode([]);
                $email_campaign->save();

                if ($request->hasFile('attachments')) {
                    $attachment_paths = [];

                    foreach ($request->file('attachments') as $key => $attachment) {
                        $filename = $attachment->getClientOriginalName();
                        $path = 'email-marketing/' . Auth::user()->username . '/attachment/campaign-' . $email_campaign->id;
                        $fullpath = $path . '/' . $filename;

                        // store here
                        $attachment->storeAs($path, $filename, 'public');

                        array_push($attachment_paths, $fullpath);
                    }

                    $email_campaign->attachment_paths = json_encode($attachment_paths);
                    $email_campaign->save();
                }

                $contacts = ListManagementContact::latest()->where('list_management_id', $mail_list->id)->get();

                // build each wa queue data based on contacts
                $email_campaign_queue = $contacts->map(function ($_contact) use ($email_campaign) {
                    $timestamp = Carbon::now();

                    return [
                        'email_campaign_id' => $email_campaign->id,
                        'recepient' => $_contact->email,
                        'status' => 'Waiting',
                        'created_at' => $timestamp,
                        'updated_at' => $timestamp,
                    ];
                })->toArray();

                // bulk insert
                EmailCampaignQueue::insert($email_campaign_queue);
            });

            return back()->with([
                'type' => 'success',
                'message' => 'The email campaign has been scheduled successfully'
            ]);
        }
    }

    function calculateSpamScore(Request $request)
    {
        $template = file_get_contents(resource_path("views/emails/email-marketing-templates/default/template-$request->id.blade.php"));

        $response = Http::post('https://spamcheck.postmarkapp.com/filter', [
            "email" => $template,
            "options" => 'long'
        ]);

        print_r($response['score']);
        print_r($response['rules']);
    }

    // sanitize, remove double dot .. and remove get parameters if any
    function sanitizeName($name)
    {
        return preg_replace('@\?.*$@', '', preg_replace('@\.{2,}@', '', preg_replace('@[^\/\\a-zA-Z0-9\-\._]@', '', $name)));
    }

    function getPoweredBy()
    {
        return '
                <div class="footer" style="clear: both; margin-top: 10px; text-align: center; width: 100%; font-weight: bold; font-size: 16px;">
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" width="100%">
                    <tr>
                        <td class="content-block powered-by" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #999999; font-size: 12px; text-align: center;" valign="top" align="center">
                        Powered by <a href="https://ojafunnel.com" style="color: #999999; font-size: 12px; text-align: center; text-decoration: none;">Ojafunnel</a>.
                        </td>
                    </tr>
                    </table>
                </div>
                </body>
            ';
    }
}
