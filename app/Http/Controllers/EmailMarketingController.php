<?php

namespace App\Http\Controllers;

use App\Models\EmailKit;
use App\Models\MailList;
use Illuminate\Bus\Batch;
use App\Models\MailContact;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\EmailCampaign;
use App\Models\EmailTemplate;
use Illuminate\Support\Carbon;
use App\Mail\EmailCampaignMail;
use App\Models\ContactMailList;
use App\Jobs\ProcessEmailCampaign;
use App\Models\EmailCampaignQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

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
        $email_templates = EmailTemplate::where(['user_id' => Auth::user()->id])->get();

        return view('dashboard.email-marketing.email-templates.index', [
            'email_templates' => $email_templates
        ]);
    }

    public function email_templates_choose_temp()
    {
        return view('dashboard.email-marketing.email-templates.choose-temp', []);
    }

    public function email_templates_view_temp(Request $request)
    {
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
        $template = EmailTemplate::find($request->id);

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
        $template = EmailTemplate::find($request->id);

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

    public function create_email_list(Request $request)
    {
        return view('dashboard.email-marketing.email-lists.create', []);
    }

    public function email_lists(Request $request)
    {
        return view('dashboard.email-marketing.email-lists.index', []);
    }

    public function email_contacts()
    {
        return view('dashboard.email-marketing.email-lists.contacts.index');
    }

    public function create_email_contact_list($id)
    {
        $finder = Crypt::decrypt($id);
        $mailList = MailList::find($finder);

        return view('dashboard.email-marketing.email-lists.contacts.create', [
            'mailList' => $mailList
        ]);
    }

    public function email_create_list(Request $request)
    {
        $this->validate($request, [
            'name'         => 'required|max:250',
            'display_name' => 'required|max:250',
            'description' => 'required|max:250',
            'slug'         => 'max:250|alpha_dash|unique:mail_lists,slug',
        ]);

        $list = MailList::create([
            'uid' => Str::slug($request->display_name),
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'display_name' => $request->display_name,
            'slug' => $request->slug,
            'description' => $request->description
        ]);

        if (empty($list->slug)) {
            $list->slug = Str::slug($list->display_name);
        }

        $list->save();

        return redirect()->route('user.email-marketing.email.lists', Auth::user()->username)->with([
            'type' => 'success',
            'message' => 'List created!'
        ]);
    }

    public function view_list($id)
    {
        $finder = Crypt::decrypt($id);

        $mail_list = MailList::find($finder);

        return view('dashboard.email-marketing.email-lists.view')->with([
            'mail_list' => $mail_list
        ]);
    }

    public function edit_list($id)
    {
        $finder = Crypt::decrypt($id);

        $mail_list = MailList::find($finder);

        return view('dashboard.email-marketing.email-lists.edit')->with([
            'mail_list' => $mail_list
        ]);
    }

    public function update_list($id, Request $request)
    {
        $this->validate($request, [
            'name'         => 'required|max:250',
            'display_name' => 'required|max:250',
            'description' => 'required|max:250',
            'slug'         => 'max:250|alpha_dash|unique:mail_lists,slug',
        ]);

        $finder = Crypt::decrypt($id);

        $list = MailList::find($finder);

        $list->update([
            'uid' => Str::slug($request->display_name),
            'name' => $request->name,
            'display_name' => $request->display_name,
            'slug' => $request->slug,
            'description' => $request->description
        ]);

        if (empty($list->slug)) {
            $list->slug = Str::slug($list->display_name);
        }

        $list->save();

        return redirect()->route('user.email-marketing.email.lists', Auth::user()->username)->with([
            'type' => 'success',
            'message' => 'List updated!'
        ]);
    }

    public function email_enable_list($id)
    {
        $finder = Crypt::decrypt($id);

        $mail_list = MailList::find($finder);

        $mail_list->update([
            'status' => true
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'List activated successfully.',
        ]);
    }

    public function email_disable_list($id)
    {
        $finder = Crypt::decrypt($id);

        $mail_list = MailList::find($finder);

        $mail_list->update([
            'status' => false
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'List disactivated successfully.',
        ]);
    }

    public function email_delete_list($id)
    {
        $finder = Crypt::decrypt($id);

        $list = MailList::find($finder);
        $contact = MailContact::where('mail_list_id', $list->id)->get()->count();

        if ($contact > 0) {
            $contact->delete();
        }

        $list->delete();

        return back()->with([
            'type' => 'success',
            'message' => 'List deleted!'
        ]);
    }

    function email_veriication($email)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.apilayer.com/email_verification/check?email=$email",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: text/plain",
                "apikey: hh1kBNxCPLAwYaePOR55kuyy3mT7zxow"
            ),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET"
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $json = json_decode($response, true);

        // dd($json);

        if ($json !== null) {
            if ($json['format_valid'] == true) {
                return 'true';
            }
            if ($json['success'] == false) {
                return 'invalid';
            }
        }

        return 'invalid';
    }

    public function email_create_contact($id, Request $request)
    {
        $this->validate($request, [
            'name'  => 'required|max:250',
            'email'         => 'required|email|unique:mail_contacts|max:250',
            'address_1' => 'required|max:250',
            'country' => 'required|max:250',
            'state' => 'required|max:250',
            'zip' => 'required|max:250',
            'phone' => 'required|numeric',
            'subscribe' => 'required|boolean'
        ]);

        $finder = Crypt::decrypt($id);

        $mailList = MailList::find($finder);

        $emailVerification = $this->email_veriication($request->email);

        if ($emailVerification !== 'true') {
            return back()->with([
                'type' => 'danger',
                'message' => 'The email address is not valid.'
            ]);
        }

        MailContact::create([
            'uid' => Str::uuid(),
            'mail_list_id' => $mailList->id,
            'name' => $request->name,
            'email' => $request->email,
            'address_1' => $request->address_1,
            'address_2' => $request->address_2,
            'country' => $request->country,
            'state' => $request->state,
            'zip' => $request->zip,
            'phone' => $request->phone,
            'subscribe' => $request->subscribe
        ]);

        return redirect()->route('user.email.view.list', Crypt::encrypt($mailList->id))->with([
            'type' => 'success',
            'message' => 'Contact created!'
        ]);
    }

    public function edit_contact($id)
    {
        $finder = Crypt::decrypt($id);

        $contact = MailContact::find($finder);

        return view('dashboard.email-marketing.email-lists.contacts.edit')->with([
            'contact' => $contact
        ]);
    }

    public function update_contact($id, Request $request)
    {
        $this->validate($request, [
            'name'  => 'required|max:250',
            'address_1' => 'required|max:250',
            'country' => 'required|max:250',
            'state' => 'required|max:250',
            'zip' => 'required|max:250',
            'phone' => 'required|numeric',
            'subscribe' => 'required|boolean'
        ]);

        $finder = Crypt::decrypt($id);

        $contact = MailContact::find($finder);

        if ($contact->email == $request->email) {
            $contact->update([
                'name' => $request->name,
                'address_1' => $request->address_1,
                'address_2' => $request->address_2,
                'country' => $request->country,
                'state' => $request->state,
                'zip' => $request->zip,
                'phone' => $request->phone,
                'subscribe' => $request->subscribe
            ]);

            return redirect()->route('user.email.view.list', Crypt::encrypt($contact->mail_list_id))->with([
                'type' => 'success',
                'message' => 'Contact updated!'
            ]);
        }

        $this->validate($request, [
            'email' => 'required|email|unique:mail_contacts|max:250',
        ]);

        $contact->update([
            'name' => $request->name,
            'email' => $request->email,
            'address_1' => $request->address_1,
            'address_2' => $request->address_2,
            'country' => $request->country,
            'state' => $request->state,
            'zip' => $request->zip,
            'phone' => $request->phone,
            'subscribe' => $request->subscribe
        ]);

        return redirect()->route('user.email.view.list', Crypt::encrypt($contact->mail_list_id))->with([
            'type' => 'success',
            'message' => 'Contact updated!'
        ]);
    }

    public function delete_contact($id)
    {
        $finder = Crypt::decrypt($id);

        $contact = MailContact::find($finder)->delete();

        return back()->with([
            'type' => 'success',
            'message' => 'Contact deleted!'
        ]);
    }

    public function email_campaigns(Request $request)
    {
        $email_campaigns = EmailCampaign::latest()->where('user_id', Auth::user()->id)->get();

        return view('dashboard.email-marketing.email-campaigns.index', [
            'email_campaigns' => $email_campaigns
        ]);
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
        $email_campaign = EmailCampaign::latest()->where(['user_id' => Auth::user()->id, 'id' => $request->id])->first();
        $email_campaign_queues = EmailCampaignQueue::where('email_campaign_id', $email_campaign->id)->get();

        return view('dashboard.email-marketing.email-campaigns.overview', [
            'email_campaign' => $email_campaign,
            'email_campaign_queues' => $email_campaign_queues
        ]);
    }

    public function email_campaigns_create()
    {
        $user_email_integrations = EmailKit::latest()->where(['account_id' => Auth::user()->id, 'is_admin' => false])->get();
        $admin_email_integrations = EmailKit::latest()->where(['is_admin' => true])->get();
        $email_integrations = $user_email_integrations->merge($admin_email_integrations);

        $email_templates = EmailTemplate::where(['user_id' => Auth::user()->id])->get();
        $mail_lists = MailList::where('user_id', Auth::user()->id)->get();

        return view('dashboard.email-marketing.email-campaigns.create', [
            'email_integrations' => $email_integrations,
            'email_templates' => $email_templates,
            'mail_lists' => $mail_lists
        ]);
    }

    public function email_campaigns_save(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'subject' => 'required',
            'replyto_email' => 'required',
            'replyto_name' => 'required',
            'email_kit' => 'required',
            'email_template' => 'required',
            'email_list' => 'required',
            'message_timing' => 'required'
        ]);

        $email_kit = EmailKit::find($request->email_kit)->first();
        $email_template = EmailTemplate::find($request->email_template)->first();
        $mail_list = MailList::find($request->email_list)->first();

        if ($request->message_timing == 'Immediately') {
            DB::transaction(function () use ($request, $email_kit, $email_template, $mail_list) {
                $email_campaign = new EmailCampaign();
                $email_campaign->user_id = Auth::user()->id;
                $email_campaign->name = $request->name;
                $email_campaign->subject = $request->subject;
                $email_campaign->replyto_email = $request->replyto_email;
                $email_campaign->replyto_name = $request->replyto_name;
                $email_campaign->email_kit_id = $email_kit->id;
                $email_campaign->list_id = $mail_list->id;
                $email_campaign->email_template_id = $email_template->id;
                $email_campaign->sent = 0;
                $email_campaign->bounced = 0;
                $email_campaign->spam_score = 0;
                $email_campaign->message_timing = $request->message_timing;
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

                $contacts = MailContact::latest()->where('mail_list_id', $mail_list->id)->get();

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
                        'email_template' => $email_template,
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

        // if ($request->message_timing == 'Schedule') {
        // }
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
}
