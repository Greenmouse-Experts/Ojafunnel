<?php

namespace App\Http\Controllers;

use App\Models\ListManagement;
use App\Models\ListManagementContact;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Support\Str;
use App\Mail\UserApprovedNotification;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\HomePageController;



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
                'status' => 0,
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
                'status' => 0,
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
        $contact = ListManagementContact::where('list_management_id', $list->id)->get()->count();

        if ($contact > 0) {
            $contact->delete();
        }

        $list->delete();

        return back()->with([
            'type' => 'success',
            'message' => 'List deleted!'
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
        $this->validate($request, [
            'name'  => 'required|max:250',
            'email'         => 'required|email|max:250',
            'phone' => 'required|numeric',
        ]);

        $finder = Crypt::decrypt($id);

        $list = ListManagement::find($finder);

        $emailVerification = $this->email_veriication($request->email);

        if ($emailVerification !== 'true') {
            return back()->with([
                'type' => 'danger',
                'message' => 'The email address is not valid.'
            ]);
        }

        ListManagementContact::create([
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

        return redirect()->route('user.view.list', Crypt::encrypt($list->id))->with([
            'type' => 'success',
            'message' => 'Contact created!'
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
            'phone' => 'required|numeric',
        ]);

        $finder = Crypt::decrypt($id);

        $contact = ListManagementContact::find($finder);

        $emailVerification = $this->email_veriication($request->email);

        if ($emailVerification !== 'true') {
            return back()->with([
                'type' => 'danger',
                'message' => 'The email address is not valid.'
            ]);
        }

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

        return back()->with([
            'type' => 'success',
            'message' => 'Contact deleted!'
        ]);
    }

    public function unsub_contact($id)
    {
        // $finder = Crypt::decrypt($id);
        // ListManagementContact::find($finder)->delete();

        return back()->with([
            'type' => 'success',
            'message' => 'Unsubscribed successfully!'
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
        $validator = FacadesValidator::make(
            [
                'file'      => $request->contact_upload,
                'extension' => strtolower($request->contact_upload->getClientOriginalExtension()),
                'size' => strtolower($request->contact_upload->getSize())
            ],
            [
                'file'          => 'required',
                'extension'      => 'required|in:csv,xsls,xsl',
                'size' => 'required|max:4096'
            ]
        );

        if($validator->fails()){
            return back()->with([
                'type' => 'danger',
                'message' => 'The selected file format is invalid'
            ]); 
        }
        
        $idFinder = Crypt::decrypt($id);

        $list = ListManagement::findorfail($idFinder);

        try {
            $path = $request->file('contact_upload')->getRealPath();
            $data = array_map('str_getcsv', file($path));

            $csv_data = array_slice($data, 1);

            foreach ($csv_data as $key => $escapedItem) {

                $validatedData = FacadesValidator::make([
                    'name' => $escapedItem[0],
                    'email' => preg_replace('/\s+/', '', $escapedItem[1]),
                    'phone' => preg_replace('/\s+/', '', $escapedItem[2])
                    ],[
                    'name' => 'required|string|max:255',
                    'email' => 'required|email',
                    'phone' => 'required|numeric'
                ],);

        
                if($validatedData->fails()){
                    return back()->with([
                        'type' => 'danger',
                        'message' => 'Oops something went wrong. field contain wrong information!'
                    ]); 
                }

                $contact[] = [
                    'uid' => Str::uuid(),
                    'list_management_id' => $list->id,
                    'name' => ucfirst($escapedItem[0]),
                    'email' => preg_replace('/\s+/', '', $escapedItem[1]),
                    'phone' => preg_replace('/\s+/', '', $escapedItem[2]),
                    'subscribe' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            ListManagementContact::insert($contact);

            return redirect()->route('user.view.list', Crypt::encrypt($list->id))->with([
                'type' => 'success',
                'message' => 'Contact added successfully!'
            ]);
        } catch (Exception $e)
        {
            return back()->with([
                'type' => 'danger',
                'message' => 'Contact arrangement invalid!'
            ]); 
        } 
    }
}
