<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\UpsellPageSubmission;
use App\Models\BumpsellSubmission;
use App\Models\ListManagement;
use App\Models\ListManagementContact;
use Illuminate\Support\Str;
use App\Models\User;


class CallbackController extends Controller
{
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

    private function validate_payment($id)
    {
        $paystackSecretKey = env('PAYSTACK_SECRET_KEY');
        $url = "https://api.paystack.co/transaction/verify/$id";

        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        // curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer $paystackSecretKey",
            "Cache-Control: no-cache",
        ));

        //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

        //execute post
        $result = curl_exec($ch);
        $result = json_decode($result, true);

        return $result['status'];
    }


    public function process_upsell_payments($id, Request $request)
    {

        try{
            $decrypted = Crypt::decrypt($id);
            $submission = UpsellPageSubmission::where('id', $decrypted)
                ->with('page')
                ->first();

            $status = $this->validate_payment($submission->ref);

            if($status) {
                // Update Table
                UpsellPageSubmission::where('id', $decrypted)
                    ->update(['status' => 'Paid']);
            }

            return redirect($submission->page->file_location);
        } catch(\Exception $e) {
            abort(404);
        }

    }

    public function process_bump_payments($id, Request $request)
    {

        try{
            $decrypted = Crypt::decrypt($id);
            $submission = BumpsellSubmission::where('id', $decrypted)
                ->with('page')
                ->first();

            $status = $this->validate_payment($submission->ref);

            if($status) {
                // Update Table
                BumpsellSubmission::where('id', $decrypted)
                    ->update(['status' => 'Paid']);
            }

            return redirect($submission->page->file_location);
        } catch(\Exception $e) {
            abort(404);
        }

    }

    function handle_form_page_submission($id, Request $request)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
            return abort(404);
        }

        $page = \App\Models\Page::findorFail($id);

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
            $bundle = [
                'candidate' => $request->name,
                'page' => $page->title . " (Opt-In Page)"
            ];
            $vendor = User::find($page->user_id);
            $vendor->notify(new \App\Notifications\LeadNotification($bundle));


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

            // Notify Page Owner about entry made.
            $bundle = [
                'candidate' => $request->name,
                'page' => $page->title . " (Upsell Page)"
            ];
            $vendor = User::find($page->user_id);
            $vendor->notify(new \App\Notifications\LeadNotification($bundle));

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

            // Notify Page Owner about entry made.
            $bundle = [
                'candidate' => $request->name,
                'page' => $page->title . " (Upsell Page with Bump Page)"
            ];
            $vendor = User::find($page->user_id);
            $vendor->notify(new \App\Notifications\LeadNotification($bundle));

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

        if($page->type == "questionaire_page")
        {
            $form_id = $request->form_id;

            $form = \App\Models\QuizAutomationForm::where('id', $form_id)
                ->with('formfields')
                ->first();

            $responses = [];
            foreach($form->formfields as $field) {
                $response = $request->input($field->id);
                if(!empty($response))
                {
                    array_push($responses, (object) [
                        $field->field_question => $response
                    ]);
                }
            }
            $responses = json_encode($responses);

            $submission = new \App\Models\QuizAutomationSubmission;
            $submission->quiz_automation_id = $form_id;
            $submission->response = $responses;
            $submission->save();

            // Notify Page Owner about entry made.
            $bundle = [
                'candidate' => "A Candidate",
                'page' => $page->title . " (Questionaire)"
            ];
            $vendor = User::find($page->user_id);
            $vendor->notify(new \App\Notifications\LeadNotification($bundle));

            return view('pages.default.thank_you_page')->with(['route' => \URL::previous()]);
        }
    }

}
