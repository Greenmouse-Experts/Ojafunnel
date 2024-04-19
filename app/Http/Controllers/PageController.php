<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Domain;
use App\Models\Funnel;
use App\Models\FunnelPage;
use App\Models\BuilderPage;
use App\Models\ListManagement;
use App\Models\ListManagementContact;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\OjaPlanParameter;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Dotlogics\Grapesjs\App\Traits\EditorTrait;
use App\Http\Controllers\HomePageController;

// checkout

class PageController extends Controller
{
    use EditorTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $home;

    public function __construct()
    {
        $this->home = new HomePageController;
        $this->middleware(['auth', 'verified']);

    }

    public function generatePageSlug($folder)
    {
        $slug = strtolower(implode('-', explode(' ', $folder)));

        $page = Page::where(['slug' => $slug]);

        if ($page->exists()) {
            if ($page->first()->user_id == Auth::user()->id) {
                return [true, $slug];
            } else return [false, $slug];
        }

        return [true, $slug];
    }

    private function generate_payment_link($email, $amount, $callback)
    {

        // Replace 'YOUR_PAYSTACK_SECRET_KEY' with your actual Paystack API secret key
        $paystackSecretKey = env('PAYSTACK_SECRET_KEY');
        $url = "https://api.paystack.co/transaction/initialize";

        $fields = [
            'callback_url' => $callback,
            'email' => $email,
            'amount' => $amount * 100,
        ];

        $fields_string = http_build_query($fields);

        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer $paystackSecretKey",
            "Cache-Control: no-cache",
        ));

        //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

        //execute post
        $result = curl_exec($ch);
        $result = json_decode($result, true);

        $result['url'] = $result['data']['authorization_url'];
        $result['ref'] = $result['data']['reference'];
        return $result;
    }

    public function page_builder_create(Request $request)
    {
        $bump_products = [];

        //Validate Request
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'file_folder' => ['required', 'string', 'max:255'],
            'file_name' => ['required', 'string', 'max:255'],
            'page_type' => ['required', 'string']
        ]);

        // if (Page::where('user_id', Auth::user()->id)->get()->count() >= OjaPlanParameter::find(Auth::user()->plan)->page_builder) {
        //     return back()->with([
        //         'type' => 'danger',
        //         'message' => 'Upgrade to enjoy more access.'
        //     ]);
        // }

        if (BuilderPage::where('user_id', Auth::user()->id)->get()->count() >= OjaPlanParameter::find(Auth::user()->plan)->page_builder) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Upgrade to enjoy more access.'
            ]);
        }

        $page_name = strtolower(implode('-', explode(' ', $request->file_name)));

        $res =  $this->generatePageSlug($request->file_folder);

        // check if sub domain name taken
        if (!$res[0]) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Sub domain already taken.'
            ]);
        }

        // check if subdomain contains .
        if (str_contains($res[1], '.')) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Sub domain is invalid. Can\'t contain dot(s)'
            ]);
        }

        if (str_contains($page_name, '.')) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Page name is invalid. Can\'t contain dot(s)'
            ]);
        }

        $file = $page_name . '.html';

        define('MAX_FILE_LIMIT', 1024 * 1024 * 2); //2 Megabytes max html file size

        $data = null;

        if ($request->page_type == "landing_page" || $request->page_type == "thank_you_page") {
            $data = file_get_contents(resource_path('views/builder/new-page-blank-template.blade.php'));
        }
        elseif($request->page_type == "questionaire_page") {
            $template_page_name = str_replace('_', '-', $request->page_type);
            $data = file_get_contents(resource_path("views/builder/$template_page_name.blade.php"));

            $data = str_replace('$title', $request->title, $data);
        }
        elseif($request->page_type == "dynamic_timer_page") {
            $template_page_name = str_replace('_', '-', $request->page_type);
            $data = file_get_contents(resource_path("views/builder/$template_page_name.blade.php"));

            $data = str_replace('$title', $request->title, $data);
            $data = str_replace('$product_name', $request->product_name, $data);
            $data = str_replace('$product_price', number_format($request->product_price, 2), $data);
            $data = str_replace('$timer', $request->offer_time, $data);
            $data = str_replace('$rate', $request->rate, $data);
        } else {
            $template_page_name = str_replace('_', '-', $request->page_type);
            $data = file_get_contents(resource_path("views/builder/$template_page_name.blade.php"));

            $data = str_replace('$title', $request->title, $data);
            $data = str_replace('$product_name', $request->product_name, $data);
            $data = str_replace('$product_price', number_format($request->product_price, 2), $data);
        }

        if($request->page_type == "upsell_bump_page")
        {
            $product_limit = 20;

            $data = str_replace('$main_product_name', $request->bump_product_name_main, $data);
            $data = str_replace('$main_product_price', $request->bump_product_price_main, $data);

            array_push($bump_products, [
                'name' => $request->input('bump_product_name'),
                'price' => $request->input('bump_product_price')
            ]);

            for($i=1; $i<=20; $i++) {
                $p_name = $request->input('bump_product_name_'.$i);
                $p_price = $request->input('bump_product_price_'.$i);

                if(!empty($p_name)) {
                    array_push($bump_products, [
                        'name' => $p_name,
                        'price' => $p_price
                    ]);
                }
            }

            $html_products = "<ul class='list'>";
            foreach($bump_products as $bp) {
                $html_products .= "<li>";
                    $html_products .= "<b>". $bp['name'] . " </b> - " . number_format($bp['price'], 2);
                $html_products .= "</li>";
                $html_products .= "<hr />";
            }
            $html_products .= "</ul>";

            $data = str_replace('$bump_products', $html_products, $data);
        }

        $html = substr($data, 0, MAX_FILE_LIMIT);
        $file = $this->sanitizeFileName($file);

        // $datum = strval($request->file_folder);
        // $_page = BuilderPage::where(['name' => $file, 'slug' => $res[1], 'user_id' => Auth::user()->id]);
        $_page = Page::where(['name' => $file, 'slug' => $res[1], 'user_id' => Auth::user()->id]);

        if ($_page->exists()) {
            return back()->with([
                'type' => 'danger',
                'message' => 'This page already exist on your subdomain.'
            ]);
        }

        $disk = Storage::build([
            'driver' => 'local',
            'root'   => public_path('pageBuilder') . '/' . $res[1],
            'permissions' => [
                'file' => [
                    'public' => 0777,
                    'private' => 0777,
                    'custom' => 0777
                ],
                'dir' => [
                    'public' => 0777,
                    'private' => 0777,
                    'custom' => 0777
                ],
            ],
        ]);

        if (!$disk->put($file, $html)) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
            return back()->with([
                'type' => 'danger',
                'message' => 'Error saving file  ' . $file . '\nPossible causes are missing write permission or incorrect file path!'
            ]);
        } else {
            $page = Page::create([
                'user_id' => Auth::user()->id,
                'title' => $request->title,
                'name' => $file,
                'type' => $request->page_type,
                'folder' => $request->file_folder,
                'file_location' => config('app.url') . '/pageBuilder/' . $res[1] . '/' . $file,
                'slug' => $res[1],
                'list_id' => $request->list_id
            ]);

            if($request->page_type != "blank") {
                $id = Crypt::encrypt($page->id);
                $route = route('page.submission', ['id' => $id]);
                $html = str_replace('$action', $route, $html);
                $disk->put($file, $html);
            }

            if($request->page_type == "upsell_page")
            {
                $_upsell = new \App\Models\UpsellPageProduct;
                $_upsell->page_id = $page->id;
                $_upsell->product_name = $request->product_name;
                $_upsell->amount = $request->product_price;
                $_upsell->account_id = $request->collection_account;
                $_upsell->save();
            }

            if($request->page_type == "upsell_bump_page")
            {
                // insert into bump page
                $_bumpsell = new \App\Models\BumpsellProduct;
                $_bumpsell->page_id = $page->id;
                $_bumpsell->user_id = auth()->user()->id;
                $_bumpsell->account_id = $request->collection_account;
                $_bumpsell->product_name = $request->bump_product_name_main;
                $_bumpsell->amount = $request->bump_product_price_main;
                $_bumpsell->save();

                // insert into bump page products and with their respective checkout options optional.
                foreach ($bump_products as $bp) {
                    $_bumpsellproduct = new \App\Models\BumpsellProductListing;
                    $_bumpsellproduct->bumpsell_products_id = $_bumpsell->id;
                    $_bumpsellproduct->product_name = $bp['name'];
                    $_bumpsellproduct->product_price = $bp['price'];
                    $_bumpsellproduct->save();
                }
            }

            if($request->page_type == "questionaire_page")
            {
                $_quiz = new \App\Models\QuizAutomationForm;
                $_quiz->page_id = $page->id;
                $_quiz->user_id = auth()->user()->id;
                $_quiz->title = $request->title;
                $_quiz->save();
            }

            if($request->page_type == "dynamic_timer_page")
            {
                // Dynamic Timer
                $_dpp = new \App\Models\DynamicTimerProductPage;
                $_dpp->page_id = $page->id;
                $_dpp->title = $page->title;
                $_dpp->offer_time = $request->offer_time;
                $_dpp->rate = $request->rate;
                $_dpp->product_name = $request->product_name;
                $_dpp->amount = $request->product_price;
                $_dpp->user_id = auth()->user()->id;
                $_dpp->save();
            }

            return back()->with([
                'type' => 'success',
                'message' => $page->name . ' created.'
            ]);
        };
    }

    /*
    function handle_form_page_submission($id, Request $request)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
            return abort(404);
        }

        $page = Page::findorFail($id);

        // Opt - In Pages
        if($page->type == "optin_page")
        {
            $list = ListManagement::where(['uid' => $page->id])->first();
            // Check for existing List
            if($list) {
                ListManagementContact::create([
                    'uid' => Str::uuid(),
                    'list_management_id' => $list->id,
                    'name' => $request->name,
                    'email' => $request->email,
                    'address_1' => $request->address,
                    'address_2' => $request->address_2 ?? "N/A",
                    'country' => $request->country ?? "N/A",
                    'state' => $request->state ?? "N/A",
                    'zip' => $request->zip ?? "N/A",
                    'phone' => $request->phone,
                    'date_of_birth' => $request->date_of_birth ?? null,
                    'anniv_date' => $request->anniv_date ?? null,
                    'subscribe' => true
                ]);
            }
            else {
                // Save Data to List Mgt
                $list = ListManagement::create([
                    'uid' => $page->id,
                    'user_id' => $page->user_id,
                    'name' => $page->title,
                    'display_name' => $page->title . " (Opt-In Page)",
                    'slug' => Str::slug($page->slug).mt_rand(1000, 9999),
                    'description' => "Opt-In Page"
                ]);

                // Add Contact to List
                ListManagementContact::create([
                    'uid' => Str::uuid(),
                    'list_management_id' => $list->id,
                    'name' => $request->name,
                    'email' => $request->email,
                    'address_1' => $request->address,
                    'address_2' => $request->address_2 ?? "N/A",
                    'country' => $request->country ?? "N/A",
                    'state' => $request->state ?? "N/A",
                    'zip' => $request->zip ?? "N/A",
                    'phone' => $request->phone,
                    // 'date_of_birth' => $request->date_of_birth ?? "N/A",
                    // 'anniv_date' => $request->anniv_date ?? "N/A",
                    'subscribe' => true
                ]);
            }

            // Notify Page Owner about entry made.


            return view('pages.default.thank_you_page')->with(['route' => \URL::previous()]);
        }

        // Upsell Pages
        if($page->type == "upsell_page")
        {
            $upsell_page = \App\Models\UpsellPageProduct::where(['page_id' => $page->id])->first();
            $list = ListManagement::where(['uid' => $page->id])->first();
            $list_contact = null;

            // Check for existing List
            if($list) {
                $list_contact = ListManagementContact::create([
                    'uid' => Str::uuid(),
                    'list_management_id' => $list->id,
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'subscribe' => true
                ]);
            }
            else {
                // Save Data to List Mgt
                $list = ListManagement::create([
                    'uid' => $page->id,
                    'user_id' => $page->user_id,
                    'name' => $page->title,
                    'display_name' => $page->title . " (Upsell Page)",
                    'slug' => Str::slug($page->slug).mt_rand(1000, 9999),
                    'description' => "Upsell Page"
                ]);

                // Add Contact to List
                $list_contact = ListManagementContact::create([
                    'uid' => Str::uuid(),
                    'list_management_id' => $list->id,
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'subscribe' => true
                ]);
            }

            $submission = new \App\Models\UpsellPageSubmission;
            $submission->page_id = $upsell_page->page_id;
            $submission->list_id = $list->id;
            $submission->list_contact_id = $list_contact->id;
            $submission->payment_link = 'N/A';
            $submission->save();

            $needle = Crypt::encrypt($submission->id);
            $callback_url = env('APP_URL') . "/accept/" . $needle;
            $paystack = $this->generate_payment_link($request->email, $upsell_page->amount, $callback_url);

            \App\Models\UpsellPageSubmission::where('id', $submission->id)
                ->update(['payment_link' => $paystack['url'], 'ref' => $paystack['ref']]);

            return redirect($paystack['url']);
        }


        // Bump sell Pages
        if($page->type == "upsell_bump_page")
        {
            $bumpsell_page = \App\Models\BumpsellProduct::where(['page_id' => $page->id])->first();
            $list = ListManagement::where(['uid' => $page->id])->first();
            $list_contact = null;

            // Check for existing List
            if($list) {
                $list_contact = ListManagementContact::create([
                    'uid' => Str::uuid(),
                    'list_management_id' => $list->id,
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'subscribe' => true
                ]);
            }
            else {
                // Save Data to List Mgt
                $list = ListManagement::create([
                    'uid' => $page->id,
                    'user_id' => $page->user_id,
                    'name' => $page->title,
                    'display_name' => $page->title . " (Upsell with Bump Page)",
                    'slug' => Str::slug($page->slug).mt_rand(1000, 9999),
                    'description' => "Upsell with Bump Page"
                ]);

                // Add Contact to List
                $list_contact = ListManagementContact::create([
                    'uid' => Str::uuid(),
                    'list_management_id' => $list->id,
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'subscribe' => true
                ]);
            }

            $total = 0;
            $products = \App\Models\BumpsellProductListing::where('bumpsell_products_id', $bumpsell_page->id)->get();
            foreach($products as $p)
            {
                $total += (int) $p->product_price;
            }
            $total = ($total + ((int) $bumpsell_page->amount) ) * 1;

            $submission = new \App\Models\BumpsellSubmission;
            $submission->page_id = $bumpsell_page->page_id;
            $submission->bumpsell_products_id = $bumpsell_page->id;
            $submission->list_id = $list->id;
            $submission->list_contact_id = $list_contact->id;
            $submission->payment_link = 'N/A';
            $submission->amount = $total;
            $submission->checkout_bump_products_ids = "N/A";
            $submission->save();

            $needle = Crypt::encrypt($submission->id);
            $callback_url = env('APP_URL') . "/accept/bump/" . $needle;
            $paystack = $this->generate_payment_link($request->email, $total, $callback_url);

            \App\Models\BumpsellSubmission::where('id', $submission->id)
                ->update(['payment_link' => $paystack['url'], 'ref' => $paystack['ref']]);

            return redirect($paystack['url']);
        }
    }
    */

    function sanitizeFileName($file)
    {
        //sanitize, remove double dot .. and remove get parameters if any
        $file = preg_replace('@\?.*$@', '', preg_replace('@\.{2,}@', '', preg_replace('@[^\/\\a-zA-Z0-9\-\._]@', '', $file)));
        return $file;
    }

    public function viewEditor($username, $id)
    {
        $finder = Crypt::decrypt($id);

        $page = Page::find($finder);

        return view('dashboard.editor', [
            'page' => $page
        ]);
    }

    public function viewPage($username, Request $request, Page $page)
    {
        return view('dashboard.page', compact('page'));
    }

    public function viewQuizPageFields($username, $page, Request $request)
    {
        $page_id = Crypt::decrypt($page);
        $page = Page::find($page_id);

        $form = \App\Models\QuizAutomationForm::where(['page_id' => $page->id])
            ->with(['formfields'])
            ->first();

        return view('dashboard.pageBuilderQuizField', [
            'page' => $page,
            'form' => $form
        ]);
    }

    public function viewQuizResponses($username, $page, Request $request)
    {
        $page_id = Crypt::decrypt($page);
        $page = Page::find($page_id);

        $qz_automation = \App\Models\QuizAutomationForm::where(['page_id' => $page->id])->first();

        $response = \App\Models\QuizAutomationSubmission::where(['quiz_automation_id' => $qz_automation->id])
            ->orderBy('id', 'DESC')
            ->get();

        $result = [];

        foreach($response as $res)
        {
            if($res->response == "" || $res->response == "[]")
            {
                $res->response = [];
            } else {
                $sub = json_decode($res->response);
                $sbs = [];
                foreach($sub as $val) {
                    foreach($val as $k => $v) {
                        array_push($sbs, $k . " : " . $v);
                        continue;
                    }
                }

                $res->response = $sbs;
            }

            array_push($result, $res);
        }

        return view('dashboard.pageBuilderQuizResponse', [
            'page' => $page,
            'qz' => $qz_automation,
            'response' => $response
        ]);
    }

    public function viewQuizPageAddFields($username, $page, Request $request)
    {
        $form_id = $request->form_id;

        $page_id = Crypt::decrypt($page);
        $page = Page::find($page_id);

        $formfield = new \App\Models\QuizAutomationFormField;
        $formfield->quiz_automation_id = $form_id;
        $formfield->field_question = $request->question;
        $formfield->field_type = $request->field_type;
        $formfield->save();

        $form = \App\Models\QuizAutomationForm::where(['page_id' => $page->id, 'id' => $form_id])
            ->with(['formfields'])
            ->first();

        $formfields = $form->formfields;

        $input = "";
        $index = 0;
        foreach ($formfields as $field) {
            $input .= '<div class="form-group" style="margin-bottom: 100px">';
            $input .=   '<label>' . $field->field_question . '</label>';
            $input .=   "<input type='$field->field_type' name='$field->id' class='form-control'  />";
            $input .= '</div>';
            $index++;
        }

        $input .= '<div class="form-group">';
        $input .=   '<input type="submit" class="btn btn-success">';
        $input .= '</div>';

        $html = file_get_contents(resource_path("views/builder/questionaire-page.blade.php"));

        $id = Crypt::encrypt($page->id);
        $formfield_id = Crypt::encrypt($formfield->id);
        $route = route('page.submission', ['id' => $id, 'form_id' => $form_id]);

        $html = str_replace('$title', $form->title, $html);
        $html = str_replace('$action', $route, $html);
        $html = str_replace('$content', $input, $html);

        // save html to existing template file.
        $disk = public_path('pageBuilder/' . $page->slug . '/' . $page->name);

        @file_put_contents($disk, $html);

        return back()->with([
            'type' => 'success',
            'message' => 'Page updated successfully!'
        ]);
    }

    public function deleteQuizPageField($username, $page, $id, Request $request)
    {
        $page_id = Crypt::decrypt($page);
        $page = Page::find($page_id);
        $field_id = Crypt::decrypt($id);

        $form_id = $request->form_id;

        \App\Models\QuizAutomationFormField::where(['id' => $field_id, 'quiz_automation_id' => $form_id])
            ->delete();


        $form = \App\Models\QuizAutomationForm::where(['page_id' => $page->id, 'id' => $form_id])
            ->with(['formfields'])
            ->first();

        $formfields = $form->formfields;

        $input = "";
        $index = 0;
        foreach ($formfields as $field) {
            $input .= '<div class="form-group" style="margin-bottom: 100px">';
            $input .=   '<label>' . $field->field_question . '</label>';
            $input .=   "<input type='$field->field_type' name='$field->id' class='form-control'  />";
            $input .= '</div>';
            $index++;
        }

        $input .= '<div class="form-group">';
        $input .=   '<input type="submit" class="btn btn-success">';
        $input .= '</div>';

        $html = file_get_contents(resource_path("views/builder/questionaire-page.blade.php"));

        $id = Crypt::encrypt($page->id);
        // $formfield_id = Crypt::encrypt($formfield->id);
        $route = route('page.submission', ['id' => $id, 'form_id' => $form_id]);

        $html = str_replace('$title', $form->title, $html);
        $html = str_replace('$action', $route, $html);
        $html = str_replace('$content', $input, $html);

        // save html to existing template file.
        $disk = public_path('pageBuilder/' . $page->slug . '/' . $page->name);

        @file_put_contents($disk, $html);

        return back()->with([
            'type' => 'success',
            'message' => 'Form Field deleted successfully!'
        ]);
    }

    public function page_builder_save_page()
    {
        $page = Page::find($_POST['id']);

        define('MAX_FILE_LIMIT', 1024 * 1024 * 2); //2 Megabytes max html file size

        $html = "";

        if (isset($_POST['html'])) {
            $html = substr($_POST['html'], 0, MAX_FILE_LIMIT);
        }

        $disk = public_path('pageBuilder/' . $page->slug . '/' . $page->name);

        if (file_put_contents($disk, $html)) {
            echo "File saved.";
        } else {
            header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
            echo "Error saving file. \nPossible causes are missing write permission or incorrect file path!";
        }
    }

    public function page_builder_template_view($username, $id, Request $request)
    {
        $templates = ['landing_page', 'optin_page', 'order_form_page', 'order_bump_upsell_page', 'thank_you_page'];
        $template_folder = ['landing', 'opt-in', 'order-form', 'order-bump', 'thank-you'];
        $template_index = (int) $id;

        if ($template_index >= sizeof($templates)) {
            return redirect()->back();
        }

        $template_name = $templates[$template_index];

        // $template = file_get_contents(resource_path("views/pages/default/$template_name.blade.php"));
        // $template_data_bindings = ['page_title'];
        // $currentpage = FunnelPage::find(1);
        // $pages = FunnelPage::where('user_id', Auth::user()->id)->get();
        // $pbuilder = Funnel::where('id', 1)->first();

        $currentpage = new \StdClass();
        $currentpage->file_location = env('APP_URL') . "/pageBuilder/$template_folder[$template_index]/index.html";
        $currentpage->folder_id = $template_index;
        $currentpage->id = $template_index;
        $currentpage->name = "index.html";
        $currentpage->title = "Template " . ($template_index + 1);

        $pbuilder = new \StdClass();
        $pbuilder->user_id = Auth::user()->id;
        $pbuilder->folder = 'template';
        $pbuilder->slug = 'template';
        $pbuilder->id = $template_index;

        return view('dashboard.pageBuilderEditor', [
            'currentpage' => $currentpage,
            'pages' => [],
            'pbuilder' => $pbuilder
        ]);
    }

    public function page_builder_update($id, Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255']
        ]);

        $page_name = strtolower(implode('-', explode(' ', $request->name)));

        if (str_contains($page_name, '.')) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Page name is invalid. Can\'t contain dot(s)'
            ]);
        }

        $idFinder = Crypt::decrypt($id);
        $page = Page::find($idFinder);

        $file = $page_name . '.html';

        $disk = public_path('pageBuilder/' . $page->slug . '/' . $page->name);

        rename($disk, public_path('pageBuilder/' . $page->slug . '/' . $file));

        // validate User
        if (request()->hasFile('thumbnail')) {
            $this->validate($request, [
                'thumbnail' => 'required|mimes:jpeg,png,jpg',
            ]);
            $filename = request()->thumbnail->getClientOriginalName();
            if ($page->thumbnail) {
                Storage::delete(str_replace("storage", "public", $page->thumbnail));
            }
            request()->thumbnail->storeAs('pages', $filename, 'public');

            $page->update([
                'thumbnail' => '/storage/pages/' . $filename,
                'name' => $file,
                'title' => $request->title,
                'file_location' => config('app.url') . '/pageBuilder/' . $page->slug . '/' . $file
            ]);

            return back()->with([
                'type' => 'success',
                'message' => 'Page updated successfully!'
            ]);
        }

        $page->update([
            'name' => $file,
            'title' => $request->title,
            'file_location' => config('app.url') . '/pageBuilder/' . $page->slug . '/' . $file
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Page Updated Successfully!'
        ]);
    }

    public function page_builder_delete($id, Request $request)
    {
        // validate Request
        $this->validate($request, [
            'delete_field' => ['required', 'string', 'max:255']
        ]);

        if ($request->delete_field == "DELETE") {
            $idFinder = Crypt::decrypt($id);

            $page = Page::findorfail($idFinder);

            if($page->type == "questionaire_page") {

                $form = \App\Models\QuizAutomationForm::where(['page_id' => $page->id])
                    ->first();

                \App\Models\QuizAutomationSubmission::where(['quiz_automation_id' => $form->id])
                    ->delete();

                \App\Models\QuizAutomationFormField::where(['quiz_automation_id' => $form->id])
                    ->delete();

                \App\Models\QuizAutomationForm::where(['page_id' => $page->id])
                    ->delete();

                if ($page->thumbnail) {
                    Storage::delete(str_replace("storage", "public", $page->thumbnail));
                }

                if ($page->file_location) {
                    File::deleteDirectory(public_path('pageBuilder/' . $page->slug));
                }

                $page->delete();

                return back()->with([
                    'type' => 'success',
                    'message' => 'Page deleted successfully!'
                ]);
            }

            if($page->type == "dynamic_timer_page") {

                \App\Models\DynamicTimerPageSubmission::where(['page_id' => $page->id])
                    ->delete();

                \App\Models\DynamicTimerProductPage::where(['page_id' => $page->id])
                    ->delete();

            }

            if ($page->thumbnail) {
                Storage::delete(str_replace("storage", "public", $page->thumbnail));
            }

            if ($page->file_location) {
                File::deleteDirectory(public_path('pageBuilder/' . $page->slug));
            }

            $page->delete();

            return back()->with([
                'type' => 'success',
                'message' => 'Page deleted successfully!'
            ]);
        }

        return back()->with([
            'type' => 'danger',
            'message' => "Field doesn't match, Try Again!"
        ]);
    }

    public function generateFunnelSlug($folder)
    {
        $slug = strtolower(implode('-', explode(' ', $folder)));

        $funnel = Funnel::where(['slug' => $slug]);

        if ($funnel->exists()) return [false, $slug];

        return [true, $slug];
    }



    public function funnel_builder_create_folder(Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'category_id' => ['required'],
            'file_folder' => ['required', 'string', 'max:255'],
        ]);

        if (Funnel::where('user_id', Auth::user()->id)->get()->count() >= OjaPlanParameter::find(Auth::user()->plan)->funnel_builder) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Upgrade to enjoy more access.'
            ]);
        }

        $res = $this->generateFunnelSlug($request->file_folder);

        // check if sub domain name taken
        if (!$res[0]) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Sub domain already taken.'
            ]);
        }

        // check if subdomain contains .
        if (str_contains($res[1], '.')) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Sub domain is invalid. Can\'t contain dot(s)'
            ]);
        }

        $disk = Storage::build([
            'driver' => 'local',
            'root'   => public_path('funnelBuilder') . '/' . $res[1],
            'permissions' => [
                'file' => [
                    'public' => 0777,
                    'private' => 0777,
                    'custom' => 0777
                ],
                'dir' => [
                    'public' => 0777,
                    'private' => 0777,
                    'custom' => 0777
                ],
            ],
        ]);

        if ($disk) {
            Funnel::create([
                'user_id' => Auth::user()->id,
                'folder' => $request->file_folder,
                'slug' => $res[1],
                'category_id' => $request->category_id
            ]);

            return back()->with([
                'type' => 'success',
                'message' => 'Funnel subdomain and folder created.'
            ]);
        } else {
            return back()->with([
                'type' => 'danger',
                'message' => 'Failed to create funnel subdomain and folder.'
            ]);
        }
    }

    public function funnel_builder_update($id, Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'file_folder' => ['required', 'string', 'max:255'],
        ]);

        $idFinder = Crypt::decrypt($id);

        $funnel = Funnel::findorfail($idFinder);

        $disk = public_path('funnelBuilder/' . $funnel->slug . '/');

        $res = $this->generateFunnelSlug($request->file_folder);

        // check slug exists on domain...
        $domain = Domain::where(['type' => 'funnel', 'slug' => $funnel->slug, 'user_id' => Auth::user()->id]);

        // check if sub domain name taken
        if (!$res[0]) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Sub domain  already taken.'
            ]);
        }

        // check if subdomain contains .
        if (str_contains($res[1], '.')) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Sub domain is invalid. Can\'t contain dot(s)'
            ]);
        }

        rename($disk, public_path('funnelBuilder/' . $res[1] . '/'));

        $pages = FunnelPage::where('folder_id', $funnel->id)->get();

        if ($pages) {
            foreach ($pages as $page) {
                $page->update([
                    'file_location' => config('app.url') . '/funnelBuilder/' . $res[1] . '/' . $page->name
                ]);
            }
        }

        $funnel->update([
            'folder' => $request->file_folder,
            'slug' => $res[1]
        ]);

        //  then update on domain
        $domain->update([
            'subdomain' => $res[1] . '-funnel',
            'slug' => $res[1]
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Updated successfully.'
        ]);
    }

    public function funnel_builder_delete($id, Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'delete_field' => ['required', 'string', 'max:255']
        ]);

        if ($request->delete_field == "DELETE") {
            $idFinder = Crypt::decrypt($id);

            $funnel = Funnel::findorfail($idFinder);

            // check slug exists on domain...
            $domain = Domain::where(['type' => 'funnel', 'slug' => $funnel->slug, 'user_id' => Auth::user()->id]);

            $disk = public_path('funnelBuilder/' . $funnel->slug . '/');

            File::deleteDirectory($disk);

            $pages = FunnelPage::where('folder_id', $funnel->id)->get();

            if ($pages) {
                foreach ($pages as $page) {
                    $page->delete();
                }
            }

            $funnel->delete();

            //  then delete on domain
            $domain->delete();

            return back()->with([
                'type' => 'success',
                'message' => 'Deleted successfully.'
            ]);
        }

        return back()->with([
            'type' => 'danger',
            'message' => "Field doesn't match, try again."
        ]);
    }

    public function funnel_builder_create_page(Request $request)
    {
        // Validate Request
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'file_folder' => ['required', 'string', 'max:255'],
            'file_name' => ['required', 'string', 'max:255'],
        ]);

        $page_name = strtolower(implode('-', explode(' ', $request->file_name)));

        if (str_contains($page_name, '.')) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Page name is invalid. Can\'t contain dot(s)'
            ]);
        }

        $funnel = Funnel::where(['id' => $request->file_folder])->first();

        $file = $page_name . '.html';

        $funnel_page = FunnelPage::where(['name' => $file, 'folder_id' => $funnel->id]);

        if ($funnel_page->exists()) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Page name exists in the funnel'
            ]);
        }

        define('MAX_FILE_LIMIT', 1024 * 1024 * 2); //2 Megabytes max html file size

        $data = file_get_contents(resource_path('views/builder/new-page-blank-template.blade.php'));

        $html = substr($data, 0, MAX_FILE_LIMIT);

        $file = $this->sanitizeFileName($file);

        $disk = public_path('funnelBuilder/' . $funnel->slug . '/');

        if (!file_put_contents($disk . $file, $html)) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
            return back()->with([
                'type' => 'danger',
                'message' => 'Error saving file  ' . $file . '\nPossible causes are missing write permission or incorrect file path!'
            ]);
        } else {
            $page = FunnelPage::create([
                'user_id' => Auth::user()->id,
                'folder_id' => $funnel->id,
                'name' => $file,
                'title' => ucfirst($request->title),
                'file_location' => config('app.url') . '/funnelBuilder/' . $funnel->slug . '/' . $file
            ]);

            return back()->with([
                'type' => 'success',
                'message' => $page->name . ' created.'
            ]);
        }
    }

    public function viewFunnelEditor($username, $id)
    {

        if($this->home->site_features_settings('Funnel Builder') || $this->home->user_site_features_settings('Funnel Builder') > 0) return $this->home->redirects();

        $finder = Crypt::decrypt($id);

        $currentpage = FunnelPage::find($finder);

        $pages = FunnelPage::where('user_id', Auth::user()->id)->get();
        $funnel = Funnel::where('id', $currentpage->folder_id)->first();

        return view('dashboard.funnelEditor', [
            'currentpage' => $currentpage,
            'pages' => $pages,
            'funnel' => $funnel
        ]);
    }

    public function funnel_builder_update_page($id, Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'file_folder' => ['required', 'string', 'max:255'],
            'file_name' => ['required', 'string', 'max:255'],
        ]);

        $idFinder = Crypt::decrypt($id);

        $page = FunnelPage::find($idFinder);
        $funnel = Funnel::findorfail($page->folder_id);

        if (str_contains($request->file_name, '.')) {
            return back()->with([
                'type' => 'danger',
                'message' => 'file name invalid.'
            ]);
        }

        $page_name = strtolower(implode('-', explode(' ', $request->file_name)));
        $file = $page_name . '.html';

        if ($page->name != $file) {
            $funnel_page = FunnelPage::where(['folder_id' => $funnel->id, 'name' => $file]);

            if ($funnel_page->exists()) {
                return back()->with([
                    'type' => 'danger',
                    'message' => 'Page name already exists in this funnel.'
                ]);
            }
        }

        $disk = public_path('funnelBuilder/' . $funnel->slug . '/' . $page->name);
        rename($disk, public_path('funnelBuilder/' . $funnel->slug . '/' . $file));

        //Validate User
        if (request()->hasFile('thumbnail')) {
            $this->validate($request, [
                'thumbnail' => 'required|mimes:jpeg,png,jpg',
            ]);

            $filename = request()->thumbnail->getClientOriginalName();
            if ($page->thumbnail) {
                Storage::delete(str_replace("storage", "public", $page->thumbnail));
            }
            request()->thumbnail->storeAs('funnel_page_thumbnails', $filename, 'public');

            $page->update([
                'folder_id' => $funnel->id,
                'name' => $file,
                'title' => ucfirst($request->title),
                'thumbnail' => '/storage/funnel_page_thumbnails/' . $filename,
                'file_location' => config('app.url') . '/funnelBuilder/' . $funnel->slug . '/' . $file
            ]);

            return back()->with([
                'type' => 'success',
                'message' => $page->name . ' updated.'
            ]);
        }

        $page->update([
            'folder_id' => $funnel->id,
            'name' => $file,
            'title' => ucfirst($request->title),
            'file_location' => config('app.url') . '/funnelBuilder/' . $funnel->slug . '/' . $file
        ]);

        return back()->with([
            'type' => 'success',
            'message' => $page->name . ' updated.'
        ]);
    }

    public function funnel_builder_delete_page($id, Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'delete_field' => ['required', 'string', 'max:255']
        ]);

        if ($request->delete_field == "DELETE") {
            $idFinder = Crypt::decrypt($id);

            $page = FunnelPage::findorfail($idFinder);
            $funnel = Funnel::findorfail($page->folder_id);

            $disk = public_path('funnelBuilder/' . $funnel->slug . '/' . $page->name);

            File::delete($disk);

            if ($page->thumbnail) {
                Storage::delete(str_replace("storage", "public", $page->thumbnail));
            }

            $page->delete();

            return back()->with([
                'type' => 'success',
                'message' => 'Deleted successfully.'
            ]);
        }

        return back()->with([
            'type' => 'danger',
            'message' => "Field doesn't match, try again."
        ]);
    }

    public function funnel_builder_save_page(Request $request)
    {
        $id = Crypt::decrypt($request->page);
        $page = FunnelPage::find($id);

        $funnel = Funnel::findorfail($page->folder_id);

        define('MAX_FILE_LIMIT', 1024 * 1024 * 2); //2 Megabytes max html file size

        $html = "";

        if (isset($_POST['html'])) {
            $html = substr($_POST['html'], 0, MAX_FILE_LIMIT);
        }

        $disk = public_path('funnelBuilder/' . $funnel->slug . '/' . $page->name);

        if (file_put_contents($disk, $html)) {
            echo "File saved.";
        } else {
            header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
            echo "Error saving file. \nPossible causes are missing write permission or incorrect file path!";
        }
    }

    public function general_builder_scan()
    {
        if (isset($_POST['mediaPath'])) {
            define('UPLOAD_PATH', $_POST['mediaPath']);
        } else {
            define('UPLOAD_PATH', 'media');
        }

        $scandir = __DIR__ . '/' . UPLOAD_PATH;

        // Run the recursive function
        // This function scans the files folder recursively, and builds a large array

        $scan = function ($dir) use ($scandir, &$scan) {
            $files = [];

            // Is there actually such a folder/file?

            if (file_exists($dir)) {
                foreach (scandir($dir) as $f) {
                    if (!$f || $f[0] == '.') {
                        continue; // Ignore hidden files
                    }

                    if (is_dir($dir . '/' . $f)) {
                        // The path is a folder

                        $files[] = [
                            'name'  => $f,
                            'type'  => 'folder',
                            'path'  => str_replace($scandir, '', $dir) . '/' . $f,
                            'items' => $scan($dir . '/' . $f), // Recursively get the contents of the folder
                        ];
                    } else {
                        // It is a file

                        $files[] = [
                            'name' => $f,
                            'type' => 'file',
                            'path' => str_replace($scandir, '', $dir) . '/' . $f,
                            'size' => filesize($dir . '/' . $f), // Gets the size of this file
                        ];
                    }
                }
            }

            return $files;
        };

        $response = $scan($scandir);

        // Output the directory listing as JSON

        header('Content-type: application/json');

        echo json_encode([
            'name'  => '',
            'type'  => 'folder',
            'path'  => '',
            'items' => $response,
        ]);
    }

    public function general_builder_upload()
    {
        define('UPLOAD_FOLDER', __DIR__ . '/');

        if (isset($_POST['mediaPath'])) {
            define('UPLOAD_PATH', $this->sanitizeFileName($_POST['mediaPath']) . '/');
        } else {
            define('UPLOAD_PATH', '/');
        }

        // $destination = UPLOAD_FOLDER . UPLOAD_PATH . '/' . $_FILES['file']['name'];
        $disk = public_path('builder/media/' . $_FILES['file']['name']);
        move_uploaded_file($_FILES['file']['tmp_name'], $disk);

        if (isset($_POST['onlyFilename'])) {
            echo $_FILES['file']['name'];
        } else {
            echo UPLOAD_PATH . $_FILES['file']['name'];
        }
    }
}
