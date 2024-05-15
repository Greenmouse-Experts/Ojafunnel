<?php

namespace App\Http\Controllers;

use App\Models\ListManagement;
use App\Models\ListManagementContact;
use App\Models\WaCampaigns;
use App\Models\SeriesWaCampaign;
use App\Models\CandidateWASeries;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Support\Str;
use App\Mail\UserApprovedNotification;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\HomePageController;
use App\Models\OjaPlanParameter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ListManagementController extends Controller
{

    private $home;
    public function __construct(){
        $this->home = new HomePageController;
        $this->middleware(['auth', 'verified']);
    }

    public function list_management($username)
    {

        if($this->home->site_features_settings('List Management') || $this->home->user_site_features_settings('List Management') > 0) return $this->home->redirects();

        return view('dashboard.list-management.index', [
            'username' => $username
        ]);
    }

    public function create_list(Request $request)
    {
        return view('dashboard.list-management.create', []);
    }

    public function store_list(Request $request)
    {
        $this->validate($request, [
            'name'         => 'required|max:250',
            'display_name' => 'required|max:250',
            'description' => 'required|max:250',
        ]);

        if (empty($request->slug))
        {
            $list = ListManagement::create([
                'uid' => Str::uuid($request->display_name),
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'display_name' => $request->display_name,
                'slug' => Str::slug($request->display_name).mt_rand(1000, 9999),
                'description' => $request->description,
                'status' => 1, // before 0
                // 'tags' => $request->tags,
            ]);
        } else {
            $this->validate($request, [
                'slug' => 'max:250|alpha_dash|unique:list_management',
            ]);

            $list = ListManagement::create([
                'uid' => Str::uuid($request->display_name),
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'display_name' => $request->display_name,
                'slug' => $request->slug,
                'description' => $request->description,
                'status' => 1, // before 0
                // 'tags' => $request->tags,
            ]);
        }

        $data = array(
            'user' => 'OjaFunnel',
            'message' => "A user $request->name has created a list, kindly login to your admin and react to it."
        );

        Mail::to('admin@ojafunnel.com')->send(new UserApprovedNotification($data['user'], $data['message'], ''));
        // Mail::to('donchibobo@gmail.com')->send(new UserApprovedNotification($data['user'], $data['message'], ''));

        return redirect()->route('user.list.management', Auth::user()->username)->with([
            'type' => 'success',
            'message' => 'List created!'
        ]);
    }

    public function view_list($id)
    {
        if($this->home->site_features_settings('List Management') || $this->home->user_site_features_settings('List Management') > 0) return $this->home->redirects();

        $finder = Crypt::decrypt($id);

        $user_id = Auth::user()->id;
        $list = ListManagement::find($finder);
        //$lists = ListManagementContact::whereRaw("list_management_id IN (SELECT id FROM list_management WHERE user_id='$user_id')")->get();
        $lists = ListManagementContact::where('list_management_id', $list->id)->get();

        return view('dashboard.list-management.view')->with([
            'list' => $list,
            'tags1' => [],// $data,
            'lists' => $lists,
            // 'tags1' => $lists,
        ]);
    }

    public function edit_list($id)
    {
        if($this->home->site_features_settings('List Management') || $this->home->user_site_features_settings('List Management') > 0) return $this->home->redirects();

        $finder = Crypt::decrypt($id);

        $list = ListManagement::find($finder);

        return view('dashboard.list-management.edit')->with([
            'list' => $list
        ]);
    }

    public function update_list($id, Request $request)
    {
        $this->validate($request, [
            'name'         => 'required|max:250',
            'display_name' => 'required|max:250',
            'description' => 'required|max:250',
        ]);

        $finder = Crypt::decrypt($id);

        $list = ListManagement::find($finder);

        if (empty($request->slug))
        {
            $list->update([
                'uid' => Str::slug($request->display_name),
                'name' => $request->name,
                'display_name' => $request->display_name,
                'slug' => $request->slug,
                'description' => $request->description,
                // 'tags' => $request->tags,
            ]);
        } else {
            if($list->slug == $request->slug)
            {
                $list->update([
                    'uid' => Str::slug($request->display_name),
                    'name' => $request->name,
                    'display_name' => $request->display_name,
                    'slug' => Str::slug($request->display_name).mt_rand(1000, 9999),
                    'description' => $request->description,
                    // 'tags' => $request->tags,
                ]);
            } else {
                $this->validate($request, [
                    'slug' => 'max:250|alpha_dash|unique:list_management',
                ]);

                $list->update([
                    'uid' => Str::slug($request->display_name),
                    'name' => $request->name,
                    'display_name' => $request->display_name,
                    'slug' => Str::slug($request->display_name).mt_rand(1000, 9999),
                    'description' => $request->description
                ]);
            }
        }

        return redirect()->route('user.list.management', Auth::user()->username)->with([
            'type' => 'success',
            'message' => 'List updated!'
        ]);
    }

    public function delete_list($id)
    {
        $finder = Crypt::decrypt($id);

        $list = ListManagement::find($finder);

        $contacts = ListManagementContact::where('list_management_id', $list->id)->get();

        if ($contacts->count() > 0) {
            // Delete contacts associated with the list in batches
            ListManagementContact::where('list_management_id', $list->id)->chunk(100, function ($contacts) {
                foreach ($contacts as $contact) {
                    $contact->delete();
                }
            });
        }

        // Delete the list
        $list->delete();

        return response()->json([
            'code' => 200,
            'message' => 'List deleted successfully.',
        ]);
    }

    public function create_contact_list($id)
    {
        if($this->home->site_features_settings('List Management') || $this->home->user_site_features_settings('List Management') > 0) return $this->home->redirects();

        $finder = Crypt::decrypt($id);
        $list = ListManagement::find($finder);

        return view('dashboard.list-management.contacts.create', [
            'list' => $list
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
            if (in_array('format_valid', $json)) {
                if ($json['format_valid'] == true) {
                    return 'true';
                }
            }
            if (in_array('success', $json)) {
                if ($json['success'] == false) {
                    return 'invalid';
                }
            }
        }

        return 'invalid';
    }

    public function create_contact($id, Request $request)
    {
        if (OjaPlanParameter::where('plan_id', Auth::user()->plan)->first()->add_contact_list == 'no') {
            return back()->with([
                'type' => 'danger',
                'message' => "Your subscription plan doesn't support contact creation"
            ]);
        }

        $this->validate($request, [
            'name'  => 'required|max:250',
            'email' => 'required|email|max:250',
            'phone' => ['required', 'min:9', 'max:14']
        ]);

        $finder = Crypt::decrypt($id);

        $list = ListManagement::find($finder);

        $listEmail = ListManagementContact::where(['list_management_id' => $list->id, 'email' => $request->email])->first();

        if($listEmail)
        {
            return back()->with([
                'type' => 'danger',
                'message' => 'The email address already exist.'
            ]);
        }

        $listManagementContact = ListManagementContact::create([
            'uid' => Str::uuid(),
            'list_management_id' => $list->id,
            'name' => $request->name,
            'email' => $request->email,
            'address_1' => $request->address_1,
            'address_2' => $request->address_2,
            'country' => $request->country,
            'state' => $request->state,
            'zip' => $request->zip,
            'phone' => $request->phone,
            'date_of_birth' => $request->date_of_birth,
            'anniv_date' => $request->anniv_date,
            'subscribe' => true,
            'tags' => $request->tags,
        ]);

        // check if list_mgt_id is tied to any wa campaign;
        $campaign = WaCampaigns::where('contact_list_id', $listManagementContact->list_management_id)
            ->orderBy('id', 'DESC') // Filter the last campaign ran
            ->first();

        if(!is_null($campaign)) {

            // with the following detail @ hand; you can proceed to restart a fresh series campaign
            // for the newly added candidate.
            $wa_series = SeriesWaCampaign::where(['wa_campaign_id' => $campaign->id])->get();

            $old_dates = SeriesWaCampaign::where(['wa_campaign_id' => $campaign->id])->pluck('date')->toArray();
            $old_times = SeriesWaCampaign::where(['wa_campaign_id' => $campaign->id])->pluck('time')->toArray();
            $last_created_series = null;

            $index = 0;

            foreach ($wa_series as $item)
            {
                $now = Carbon::now();

                if($index == 0)
                {
                    // add 1hr to kick time
                    $date = Carbon::parse($now)->addHour();
                    $last_created_series = CandidateWASeries::create([
                        'user_id' => $item->user_id,
                        'wa_campaign_id' => $campaign->id,
                        'date' => $date->format('Y-m-d'),
                        'time' => $date->format('h:i:s'),
                        'message' => $item->message,
                        'contact_count' => 1,
                        'delivered_count' => 0,
                        'status' => 'Waiting'
                    ]);
                } else {
                    $last_date = $last_created_series->date;
                    $last_old_date = new Carbon($old_dates[$index - 1]);
                    $curr_old_date = new Carbon($old_dates[$index]);

                    $getintvl = $last_old_date->diffInDays($curr_old_date);
                    $new_date = Carbon::parse($last_date)->addDays($getintvl)->format('Y-m-d');

                    $last_created_series = CandidateWASeries::create([
                        'user_id' => $item->user_id,
                        'wa_campaign_id' => $campaign->id,
                        'date' => $new_date,
                        'time' => $last_created_series->time,
                        'message' => $item->message,
                        'contact_count' => 1,
                        'delivered_count' => 0,
                        'status' => 'Waiting'
                    ]);
                }


                $index++;
            }
        }

        return redirect()->route('user.view.list', Crypt::encrypt($list->id))->with([
            'type' => 'success',
            'message' => 'Contact created successfully!'
        ]);
    }

    public function edit_contact($id)
    {
        $finder = Crypt::decrypt($id);

        $contact = ListManagementContact::find($finder);

        return view('dashboard.list-management.contacts.edit')->with([
            'contact' => $contact
        ]);
    }

    public function update_contact($id, Request $request)
    {
        $this->validate($request, [
            'name'  => 'required|max:250',
            'email' => 'required|email|max:250',
            'phone' => ['required', 'min:9', 'max:14']
        ]);

        $finder = Crypt::decrypt($id);

        $contact = ListManagementContact::find($finder);

        // $emailVerification = $this->email_veriication($request->email);

        // if ($emailVerification !== 'true') {
        //     return back()->with([
        //         'type' => 'danger',
        //         'message' => 'The email address is not valid.'
        //     ]);
        // }

        $contact->update([
            'name' => $request->name,
            'email' => $request->email,
            'address_1' => $request->address_1,
            'address_2' => $request->address_2,
            'country' => $request->country,
            'state' => $request->state,
            'zip' => $request->zip,
            'phone' => $request->phone,
            'date_of_birth' => $request->date_of_birth,
            'anniv_date' => $request->anniv_date,
            'tags' => $request->tags,
        ]);

        return redirect()->route('user.view.list', Crypt::encrypt($contact->list_management_id))->with([
            'type' => 'success',
            'message' => 'Contact updated!'
        ]);
    }

    public function delete_contact($id)
    {
        $finder = Crypt::decrypt($id);

        ListManagementContact::find($finder)->delete();

        return response()->json([
            'code' => 200,
            'message' => 'Contact deleted successfully.',
        ]);
    }

    public function unsub_contact($id)
    {
        $finder = Crypt::decrypt($id);
        $list = ListManagementContact::find($finder);

        $list->update([
            'subscribe' => false
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Unsubscribed successfully!'
        ]);
    }

    public function sub_contact($id)
    {
        $finder = Crypt::decrypt($id);
        $list = ListManagementContact::find($finder);

        $list->update([
            'subscribe' => true
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'subscribed successfully!'
        ]);
    }

    public function upload_contact_list($id)
    {
        $finder = Crypt::decrypt($id);
        $list = ListManagement::find($finder);

        return view('dashboard.list-management.upload.create', [
            'list' => $list
        ]);
    }

    public function upload_contact($id, Request $request)
    {
        if (OjaPlanParameter::where('plan_id', Auth::user()->plan)->first()->list_upload == 'no') {
            return response()->json([
                'code' => 401,
                'message' => "Your subscription plan doesn't support upload of contact"
            ]);
        }

        $failed = 0;
        $passed = 0;
        $existingEmail = 0;

        $validator = FacadesValidator::make($request->all(), [
            'contact_upload' => 'required|file', // Ensure 'contact_upload' exists and is a file
            'contact_upload' => 'mimes:csv,xlsx,xls', // Check file extension
            'contact_upload' => 'max:4096', // Check file size (in kilobytes)
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => 'Validation failed. Please see errors parameter for details.',
                'errors' => $validator->errors()
            ]);
        }

        $idFinder = Crypt::decrypt($id);
        $list = ListManagement::findorfail($idFinder);

        try {
            $path = $request->file('contact_upload')->getRealPath();
            $data = array_map('str_getcsv', file($path));
            $csv_data = array_slice($data, 1);

            $batchSize = 100; // Set your preferred batch size

            DB::beginTransaction();

            foreach (array_chunk($csv_data, $batchSize) as $batch) {
                foreach ($batch as $key => $escapedItem) {
                    try {
                        // Your validation and processing code here

                        // Example:
                        $validatedData = FacadesValidator::make($request->all(), [
                            'name' => $escapedItem[0],
                            'email' => preg_replace('/\s+/', '', $escapedItem[1]),
                            'phone' => preg_replace('/\s+/', '', $escapedItem[2])
                        ],[
                            'name' => 'required|string|max:255',
                            'email' => 'required|email',
                            'phone' => 'required|numeric'
                        ]);

                        if ($validatedData->fails()) {
                            throw new \Exception('Validation error');
                        }

                        $listEmail = ListManagementContact::where(['list_management_id' => $list->id, 'email' => preg_replace('/\s+/', '', $escapedItem[1])])->first();

                        if($listEmail)
                        {
                            $existingEmail++;

                            // Handle the error
                            $result = ['error' => 'The email address already exist.'];
                            continue;
                        } else {
                            // Make a request to the debounce API for each email address
                            $response = Http::get('https://api.debounce.io/v1/', [
                                'api' => config('app.debounce_key'),
                                'email' => preg_replace('/\s+/', '', $escapedItem[1]), // Trim any leading/trailing whitespace
                                // Add any other parameters required by the API
                            ]);

                            // Check if the request was successful
                            if ($response->successful()) {
                                // Process the response data
                                $data = $response->json();

                                // Add the debounce data to the result array
                                $result = $data;

                                // Check if the result is invalid or risky
                                if ($result['debounce']['result'] === 'Invalid' || $result['debounce']['result'] === 'Risky') {
                                    // Skip saving the contact and move to the next iteration
                                    $failed++;
                                    continue;
                                }

                            } else {
                                // Handle the error
                                $result = ['error' => 'Failed to validate email address'];
                                continue;
                            }

                            $passed++;

                            ListManagementContact::create([
                                'uid' => Str::uuid(),
                                'list_management_id' => $list->id,
                                'name' => ucfirst($escapedItem[0]),
                                'email' => preg_replace('/\s+/', '', $escapedItem[1]),
                                'phone' => preg_replace('/\s+/', '', $escapedItem[2]),
                                'subscribe' => true,
                            ]);
                        }
                    } catch (Exception $e) {
                        $failed += count($batch); // Increment failed count by the batch size
                    }
                }
            }

            DB::commit();

            // return redirect()->route('user.view.list', Crypt::encrypt($list->id))->with([
            //     'type' => 'success',
            //     'message' => 'Contact upload completed. Failed: ' . $failed . ', Passed: ' . $passed . ' Existing Contacts:' . $existingEmail
            // ]);
            return response()->json([
                'code' => 200,
                'message' => 'Contact upload completed. Failed: ' . $failed . ', Passed: ' . $passed . ' Existing Contacts:' . $existingEmail
            ]);
        } catch (Exception $e) {

            DB::rollback(); // Rollback the batch transaction in case of error

            return response()->json([
                'code' => 401,
                'message' => 'Contact upload failed: ' . $e->getMessage()
            ]);
        }
    }
}
