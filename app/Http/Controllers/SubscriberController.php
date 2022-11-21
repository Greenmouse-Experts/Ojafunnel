<?php

namespace App\Http\Controllers;

use App\Models\Mailinglist;
use App\Models\Subscriber;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class SubscriberController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function subscriber_download_format()
    {
        // $url = __DIR__.'/format.csv';
        $filepath = public_path('files/format.csv');

        return response()->download($filepath); 
    }

    public function subscriber_mailing_create(Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
        ]);

        Mailinglist::create([
            'user_id' => Auth::user()->id,
            'mailinglist_name' => ucfirst($request->name)
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Maillist Added Successfully!'
        ]); 
    }

    public function subscriber_mailing_enable($id)
    {
        $idFinder = Crypt::decrypt($id);

        $mailinglist = Mailinglist::findorfail($idFinder);

        $mailinglist->update([
            'status' => 'Active'
        ]);

        return back()->with([
            'type' => 'success',
            'message' => $mailinglist->mailinglist_name.' Mailinglist Enabled Successfully!'
        ]); 
    }

    public function subscriber_mailing_disable($id)
    {
        $idFinder = Crypt::decrypt($id);

        $mailinglist = Mailinglist::findorfail($idFinder);

        $mailinglist->update([
            'status' => 'Inactive'
        ]);

        return back()->with([
            'type' => 'success',
            'message' => $mailinglist->mailinglist_name.' Mailinglist Disabled Successfully!'
        ]); 
    }

    public function subscriber_mailing_delete($id, Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'delete_field' => ['required', 'string', 'max:255']
        ]);

        if($request->delete_field == "DELETE")
        {
            $idFinder = Crypt::decrypt($id);

            $mailinglist = Mailinglist::findorfail($idFinder);


            $contacts = Subscriber::where('mailinglist_id', $mailinglist->id)->get();

            if($contacts->isEmpty())
            {
                $mailinglist->delete();
            } else {
                foreach($contacts as $contact)
                {
                    $contact->delete();
                }

                $mailinglist->delete();
            }

            return back()->with([
                'type' => 'success',
                'message' => 'Mailinglist Deleted Successfully!'
            ]); 
        } 

        return back()->with([
            'type' => 'danger',
            'message' => "Field doesn't match, Try Again!"
        ]); 
    }

    public function subscriber_mailing_contact_create(Request $request, $id)
    {
        $idFinder = Crypt::decrypt($id);

        $mailinglist = Mailinglist::findorfail($idFinder);

        //Validate Request
        $this->validate($request, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone_number' => ['required', 'numeric'],
        ]);

        Subscriber::create([
            'user_id' => Auth::user()->id,
            'mailinglist_id' => $mailinglist->id,
            'first_name' => ucfirst($request->first_name),
            'last_name' => ucfirst($request->last_name),
            'email' => $request->email,
            'phone_number' => $request->phone_number
        ]);

        $mailinglist->no_of_contacts += 1;
        $mailinglist->email += 1;
        $mailinglist->phone_number += 1;
        $mailinglist->save();

        return redirect()->route('user.contact', [Auth::user()->username, Crypt::encrypt($mailinglist->id)])->with([
            'type' => 'success',
            'message' => 'Contacts Added Successfully!'
        ]); 
    }

    public function subscriber_mailing_contact_upload(Request $request, $id)
    {
        //Validate Request
        $this->validate($request, [
            'contact_upload' => 'required',
        ]);
        
        $validator = Validator::make(
            [
                'file'      => $request->contact_upload,
                'extension' => strtolower($request->contact_upload->getClientOriginalExtension()),
            ],
            [
                'file'          => 'required',
                'extension'      => 'required|in:csv,xsls,xsl',
            ]
        );

        if($validator->fails()){
            return back()->with([
                'type' => 'danger',
                'message' => 'The selected file format is invalid'
            ]); 
        }
        
        $idFinder = Crypt::decrypt($id);

        $mailinglist = Mailinglist::findorfail($idFinder);

        try {
            $path = $request->file('contact_upload')->getRealPath();
            $data = array_map('str_getcsv', file($path));

            $csv_data = array_slice($data, 1);

            foreach ($csv_data as $key => $escapedItem) {
                $data = preg_replace('/\s+/', '', $escapedItem);

                $validatedData = Validator::make([
                    'first_name' => $data[0],
                    'last_name' => $data[1],
                    'email' => $data[2],
                    'phone_number' => $data[3]
                    ],[
                    'first_name' => 'required|string|max:255',
                    'last_name' => 'required|string|max:255',
                    'email' => 'required|email',
                    'phone_number' => 'required|numeric'
                ],);
        
                if($validatedData->fails()){
                    return back()->with([
                        'type' => 'danger',
                        'message' => 'Oops something went wrong. field contain wrong information!'
                    ]); 
                }

                $contact[] = [
                    'user_id' => Auth::user()->id,
                    'mailinglist_id' => $mailinglist->id,
                    'first_name' => ucfirst($data[0]),
                    'last_name' => ucfirst($data[1]),
                    'email' => $data[2],
                    'phone_number' => $data[3],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            
            Subscriber::insert($contact);
            
            $mailinglist->no_of_contacts += count($csv_data);
            $mailinglist->email += count($csv_data);
            $mailinglist->phone_number += count($csv_data);
            $mailinglist->save();

            return redirect()->route('user.contact', [Auth::user()->username, Crypt::encrypt($mailinglist->id)])->with([
                'type' => 'success',
                'message' => 'Contacts Added Successfully!'
            ]);
        } catch (Exception $e)
        {
            return back()->with([
                'type' => 'danger',
                'message' => 'Contact arrangement invalid!'
            ]); 
        } 
    }

    public function subscriber_mailing_contact_copy_paste(Request $request, $id)
    {
        //Validate Request
        $this->validate($request, [
            'contact' => ['required', 'string'],
        ]);

        $idFinder = Crypt::decrypt($id);

        $mailinglist = Mailinglist::findorfail($idFinder);

        try {
            $file = array_map("str_getcsv", preg_split('/\r*\n+|\r+/', $request->contact));
            
            foreach ($file as $key => $escapedItem) {
                $data = preg_replace('/\s+/', '', $escapedItem);

                $validatedData = Validator::make([
                    'first_name' => $data[0],
                    'last_name' => $data[1],
                    'email' => $data[2],
                    'phone_number' => $data[3]
                    ],[
                    'first_name' => 'required|string|max:255',
                    'last_name' => 'required|string|max:255',
                    'email' => 'required|email',
                    'phone_number' => 'required|numeric'
                ],);
        
                if($validatedData->fails()){
                    return back()->with([
                        'type' => 'danger',
                        'message' => 'Oops something went wrong. field contain wrong information!'
                    ]); 
                }

                $contact[] = [
                    'user_id' => Auth::user()->id,
                    'mailinglist_id' => $mailinglist->id,
                    'first_name' => ucfirst($data[0]),
                    'last_name' => ucfirst($data[1]),
                    'email' => $data[2],
                    'phone_number' => $data[3],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        
            Subscriber::insert($contact);
            
            $mailinglist->no_of_contacts += count($file);
            $mailinglist->email += count($file);
            $mailinglist->phone_number += count($file);
            $mailinglist->save();

            return redirect()->route('user.contact', [Auth::user()->username, Crypt::encrypt($mailinglist->id)])->with([
                'type' => 'success',
                'message' => 'Contacts Added Successfully!'
            ]); 

        } catch (Exception $e)
        {
            return back()->with([
                'type' => 'danger',
                'message' => 'Contact arrangement invalid!'
            ]); 
        } 
    }

    public function subscriber_mailing_contact_update($id, Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone_number' => ['required', 'numeric'],
        ]);
        
        $idFinder = Crypt::decrypt($id);

        $subscriber = Subscriber::findorfail($idFinder);

        $subscriber->first_name = ucfirst($request->first_name);
        $subscriber->last_name = ucfirst($request->last_name);
        $subscriber->email = $request->email;
        $subscriber->phone_number = $request->phone_number;
        $subscriber->save();
        
        return back()->with([
            'type' => 'success',
            'message' => 'Contact Updated Successfully!'
        ]); 
    }

    public function subscriber_mailing_contact_delete($id, Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'delete_field' => ['required', 'string', 'max:255']
        ]);

        if($request->delete_field == "DELETE")
        {
            $idFinder = Crypt::decrypt($id);

            $subscriber = Subscriber::findorfail($idFinder);

            $mailinglist = Mailinglist::findorfail($subscriber->mailinglist_id);

            $mailinglist->no_of_contacts -= 1;
            $mailinglist->email -= 1;
            $mailinglist->phone_number -= 1;
            $mailinglist->save();

            $subscriber->delete();

            return back()->with([
                'type' => 'success',
                'message' => 'Contact Deleted Successfully!'
            ]); 
        }
        
        return back()->with([
            'type' => 'danger',
            'message' => "Field doesn't match, Try Again!"
        ]); 
    }
}
