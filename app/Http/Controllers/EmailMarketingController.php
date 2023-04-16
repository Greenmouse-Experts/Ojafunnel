<?php

namespace App\Http\Controllers;

use Throwable;
use App\Mail\TestMail;
use App\Models\EmailKit;
use Illuminate\Bus\Batch;
use Illuminate\Http\Request;
use App\Jobs\ProcessEmailCampaign;
use App\Models\EmailTemplate;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
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
