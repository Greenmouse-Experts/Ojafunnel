<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
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

    public function profile_update(Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'numeric'],
        ]);

        //Profile
        $profile = User::find(Auth::user()->id);

        //Validate User
        if (request()->hasFile('photo')) {
            $this->validate($request, [
                'photo' => 'required|mimes:jpeg,png,jpg',
            ]);
            $filename = request()->photo->getClientOriginalName();
            if($profile->photo) {
                Storage::delete(str_replace("storage", "public", $profile->photo));
            }
            request()->photo->storeAs('users_photo', $filename, 'public');
            
            if($profile->email == $request->email)
            {
                $profile->update([
                    'photo' => '/storage/users_photo/'.$filename,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'phone_number' => $request->phone_number,
                ]);
    
                return back()->with([
                    'type' => 'success',
                    'message' => 'Profile Updated Successfully!'
                ]);
            }

            $this->validate($request, [
                'email' => ['string', 'email', 'max:255', 'unique:users'],
            ]);

            $profile->update([
                'photo' => '/storage/users_photo/'.$filename,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone_number' => $request->phone_number,
                'email' => $request->email
            ]);

            return back()->with([
                'type' => 'success',
                'message' => 'Profile Updated Successfully!'
            ]);
        } else {
            if($profile->email == $request->email)
            {
                $profile->update([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'phone_number' => $request->phone_number
                ]);

                return back()->with([
                    'type' => 'success',
                    'message' => 'Profile Updated Successfully!'
                ]);
            }

            $this->validate($request, [
                'email' => ['string', 'email', 'max:255', 'unique:users'],
            ]);

            $profile->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone_number' => $request->phone_number,
                'email' => $request->email
            ]);

            return back()->with([
                'type' => 'success',
                'message' => 'Profile Updated Successfully!'
            ]);

        }
    }

    public function password_update(Request $request)
    {
        $this->validate($request, [
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::findorfail(Auth::user()->id);
        
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with([
            'type' => 'success',
            'message' => 'Password Updated Successfully!'
        ]); 
    }
}
