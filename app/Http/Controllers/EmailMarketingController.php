<?php

namespace App\Http\Controllers;

use Throwable;
use App\Mail\TestMail;
use App\Models\EmailKit;
use Illuminate\Bus\Batch;
use Illuminate\Http\Request;
use App\Jobs\ProcessEmailCampaign;
use App\Models\EmailTemplate;
use App\Models\MailContact;
use App\Models\MailList;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

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

        if (!file_put_contents($disk, $request->content)) {
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

    public function create_email__contact_list()
    {
        return view('dashboard.email-marketing.email-lists.contacts.create');
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
            'message' => 'List activate successfully.',
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
            'message' => 'List disactive successfully.',
        ]);
    }


    public function email_create_contact(Request $request)
    {
        $this->validate($request, [
            'first_name'  => 'required|max:250',
            'last_name'         => 'required|max:250',
            'email'         => 'required|email|max:250',
            'address_1' => 'required|max:250',
            'country' => 'required|max:250',
            'state' => 'required|max:250',
            'zip' => 'required|max:250',
            'phone' => 'required|numeric',
            'subscribe' => 'required|boolean'
        ]);

        MailContact::create([
           'uid' => Str::uuid(),
           'user_id' => Auth::user()->id,
           'first_name' => $request->first_name,
           'last_name' => $request->last_name,
           'email' => $request->email,
           'address_1' => $request->address_1,
           'address_2' => $request->address_2,
           'country' => $request->country,
           'state' => $request->state,
           'zip' => $request->zip,
           'phone' => $request->phone,
           'subscribe' => $request->subscribe
        ]);

        return redirect()->route('user.email-marketing.email.contacts', Auth::user()->username)->with([
            'type' => 'success',
            'message' => 'Contact created!'
        ]);
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

    // sanitize, remove double dot .. and remove get parameters if any
    function sanitizeName($name)
    {
        return preg_replace('@\?.*$@', '', preg_replace('@\.{2,}@', '', preg_replace('@[^\/\\a-zA-Z0-9\-\._]@', '', $name)));
    }
}