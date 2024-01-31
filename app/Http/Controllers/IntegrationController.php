<?php

namespace App\Http\Controllers;

use App\Models\c;
use App\Models\EmailKit;
use App\Models\Integration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Ramsey\Uuid\Type\Integer;
use App\Http\Controllers\HomePageController;


class IntegrationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $home;
    public function __construct(){
        $this->home = new HomePageController;
        $this->middleware(['auth', 'verified']);
    }

    public function integration_email_create(Request $request)
    {
        $request->validate([
            'host' => 'required',
            'port' => 'required|numeric',
            'username' => 'required|string',
            'password' => 'required',
            'encryption' => 'required|string',
            'from_email' => 'required|email',
            'from_name' => 'required|string',
            'replyto_email' => 'required|string',
            'replyto_name' => 'required|string',
            'type' => 'required',
        ]);

        $kit = new EmailKit();
        $kit->account_id = Auth::user()->id;
        $kit->is_admin = false;
        $kit->host = $request->host;
        $kit->port = $request->port;
        $kit->username = $request->username;
        $kit->password = $request->password;
        $kit->encryption = $request->encryption;
        $kit->from_email = $request->from_email;
        $kit->from_name = $request->from_name;
        $kit->replyto_email = $request->replyto_email;
        $kit->replyto_name = $request->replyto_name;
        $kit->type = $request->type;
        $kit->sent = 0;
        $kit->bounced = 0;
        $kit->save();

        return back()->with([
            'type' => 'success',
            'message' => $kit->type . ' Integration Created Successfully!'
        ]);
    }

    public function integration_email_update(Request $request)
    {
    }

    public function integration_email_delete(Request $request)
    {
    }

    public function integration_create(Request $request)
    {
        if($this->home->site_features_settings('Integration Page') || $this->home->user_site_features_settings('Integration Page') > 0) return $this->home->redirects();

        $integrations = Integration::where('user_id', Auth::user()->id)->get();

        if ($integrations->isEmpty()) {
            if ($request->type == 'Twillio') {
                //Validate Request
                $this->validate($request, [
                    'sid' => ['required', 'string', 'max:255'],
                    'token' => ['required', 'string', 'max:255'],
                    'from' => ['required', 'string', 'max:255'],
                ]);

                Integration::create([
                    'user_id' => Auth::user()->id,
                    'sid' => $request->sid,
                    'token' => $request->token,
                    'from' => $request->from,
                    'type' => $request->type
                ]);

                return redirect()->route('user.manage_integration', ['username' => Auth::user()->username])->with([
                    'type' => 'success',
                    'message' => 'Twilio Integration Created Successfully!'
                ]);
            }
            if ($request->type == 'SMSLive247') {
                //Validate Request
                $this->validate($request, [
                    'sid' => ['required', 'string', 'max:255'],
                    // 'token' => ['required', 'string', 'max:255'],
                    'from' => ['required', 'string', 'max:255'],
                ]);

                Integration::create([
                    'user_id' => Auth::user()->id,
                    'sid' => $request->sid,
                    // 'token' => $request->token,
                    'from' => $request->from,
                    'type' => $request->type
                ]);

                return redirect()->route('user.manage_integration', ['username' => Auth::user()->username])->with([
                    'type' => 'success',
                    'message' => 'Twilio Integration Created Successfully!'
                ]);
            }
            if ($request->type == 'InfoBip') {
                //Validate Request
                $this->validate($request, [
                    'api_key' => ['required', 'string', 'max:255'],
                    'api_base_url' => ['required', 'string', 'max:255']
                ]);

                Integration::create([
                    'user_id' => Auth::user()->id,
                    'api_key' => $request->api_key,
                    'api_base_url' => $request->api_base_url,
                    'type' => $request->type
                ]);

                return  redirect()->route('user.manage_integration', ['username' => Auth::user()->username])->with([
                    'type' => 'success',
                    'message' => 'InfoBip Integration Created Successfully!'
                ]);
            }
            if ($request->type == 'NigeriaBulkSms') {
                //Validate Request
                $this->validate($request, [
                    'username' => ['required', 'string', 'max:255'],
                    'password' => ['required', 'string', 'max:255'],
                ]);

                Integration::create([
                    'user_id' => Auth::user()->id,
                    'username' => $request->username,
                    'password' => $request->password,
                    'type' => $request->type
                ]);

                return redirect()->route('user.manage_integration', ['username' => Auth::user()->username])->with([
                    'type' => 'success',
                    'message' => 'NigeriaBulkSms Integration Created Successfully!'
                ]);
            }
            if ($request->type == 'Multitexter') {
                //Validate Request
                $this->validate($request, [
                    'email' => ['required', 'string', 'max:255'],
                    'password' => ['required', 'string', 'max:255'],
                    'api_key' => ['required', 'string', 'max:255']
                ]);

                Integration::create([
                    'user_id' => Auth::user()->id,
                    'email' => $request->email,
                    'password' => $request->password,
                    'api_key' => $request->api_key,
                    'type' => $request->type
                ]);

                return redirect()->route('user.manage_integration', ['username' => Auth::user()->username])->with([
                    'type' => 'success',
                    'message' => 'Multitexter Integration Created Successfully!'
                ]);
            }
            if ($request->type == 'AWS') {
                //Validate Request
                $this->validate($request, [
                    'key' => ['required', 'string', 'max:255'],
                    'secret' => ['required', 'string', 'max:255']
                ]);

                Integration::create([
                    'user_id' => Auth::user()->id,
                    'key' => $request->key,
                    'secret' => $request->secret,
                    'type' => $request->type
                ]);

                return redirect()->route('user.manage_integration', ['username' => Auth::user()->username])->with([
                    'type' => 'success',
                    'message' => 'AWS Integration Created Successfully!'
                ]);
            }
            return back()->with([
                'type' => 'danger',
                'message' => 'Integration Not Found.'
            ]);
        } else {
            foreach ($integrations as $integration) {
                $type[] = $integration->type;
            }

            // return $type;

            if (in_array($request->type, $type) || in_array($request->type, $type) || in_array($request->type, $type) || in_array($request->type, $type) || in_array($request->type, $type)) {
                return back()->with([
                    'type' => 'danger',
                    'message' => 'Integration added before.',
                ]);
            } else {
                if ($request->type == 'Twillio') {
                    //Validate Request
                    $this->validate($request, [
                        'sid' => ['required', 'string', 'max:255'],
                        'token' => ['required', 'string', 'max:255'],
                        'from' => ['required', 'string', 'max:255'],
                    ]);

                    Integration::create([
                        'user_id' => Auth::user()->id,
                        'sid' => $request->sid,
                        'token' => $request->token,
                        'from' => $request->from,
                        'type' => $request->type
                    ]);

                    return redirect()->route('user.manage_integration', ['username' => Auth::user()->username])->with([
                        'type' => 'success',
                        'message' => 'Twilio Integration Created Successfully!'
                    ]);
                }
                if ($request->type == 'SMSLive247') {
                    //Validate Request
                    $this->validate($request, [
                        'sid' => ['required', 'string', 'max:255'],
                        'from' => ['required', 'string', 'max:255'],
                    ]);

                    Integration::create([
                        'user_id' => Auth::user()->id,
                        'sid' => $request->sid,
                        // 'token' => $request->token,
                        'from' => $request->from,
                        'type' => $request->type
                    ]);

                    return redirect()->route('user.manage_integration', ['username' => Auth::user()->username])->with([
                        'type' => 'success',
                        'message' => 'Twilio Integration Created Successfully!'
                    ]);
                }
                if ($request->type == 'InfoBip') {
                    //Validate Request
                    $this->validate($request, [
                        'api_key' => ['required', 'string', 'max:255'],
                        'api_base_url' => ['required', 'string', 'max:255']
                    ]);

                    Integration::create([
                        'user_id' => Auth::user()->id,
                        'api_key' => $request->api_key,
                        'api_base_url' => $request->api_base_url,
                        'type' => $request->type
                    ]);

                    return redirect()->route('user.manage_integration', ['username' => Auth::user()->username])->with([
                        'type' => 'success',
                        'message' => 'InfoBip Integration Created Successfully!'
                    ]);
                }
                if ($request->type == 'NigeriaBulkSms') {
                    //Validate Request
                    $this->validate($request, [
                        'username' => ['required', 'string', 'max:255'],
                        'password' => ['required', 'string', 'max:255'],
                    ]);

                    Integration::create([
                        'user_id' => Auth::user()->id,
                        'username' => $request->username,
                        'password' => $request->password,
                        'type' => $request->type
                    ]);

                    return redirect()->route('user.manage_integration', ['username' => Auth::user()->username])->with([
                        'type' => 'success',
                        'message' => 'NigeriaBulkSms Integration Created Successfully!'
                    ]);
                }
                if ($request->type == 'Multitexter') {
                    //Validate Request
                    $this->validate($request, [
                        'email' => ['required', 'string', 'max:255'],
                        'password' => ['required', 'string', 'max:255'],
                        'api_key' => ['required', 'string', 'max:255']
                    ]);

                    Integration::create([
                        'user_id' => Auth::user()->id,
                        'email' => $request->email,
                        'password' => $request->password,
                        'api_key' => $request->api_key,
                        'type' => $request->type
                    ]);

                    return redirect()->route('user.manage_integration', ['username' => Auth::user()->username])->with([
                        'type' => 'success',
                        'message' => 'Multitexter Integration Created Successfully!'
                    ]);
                }
                if ($request->type == 'AWS') {
                    //Validate Request
                    $this->validate($request, [
                        'key' => ['required', 'string', 'max:255'],
                        'secret' => ['required', 'string', 'max:255']
                    ]);

                    Integration::create([
                        'user_id' => Auth::user()->id,
                        'key' => $request->key,
                        'secret' => $request->secret,
                        'type' => $request->type
                    ]);

                    return redirect()->route('user.manage_integration', ['username' => Auth::user()->username])->with([
                        'type' => 'success',
                        'message' => 'AWS Integration Created Successfully!'
                    ]);
                }
                return back()->with([
                    'type' => 'danger',
                    'message' => 'Integration Not Found.'
                ]);
            }
        }
    }

    public function integration_update($id, Request $request)
    {
        $idFinder = Crypt::decrypt($id);

        $integration = Integration::findorfail($idFinder);

        if ($integration->type == 'Twillio') {
            //Validate Request
            $this->validate($request, [
                'sid' => ['required', 'string', 'max:255'],
                'token' => ['required', 'string', 'max:255'],
                'from' => ['required', 'string', 'max:255'],
            ]);

            $integration->update([
                'sid' => $request->sid,
                'token' => $request->token,
                'from' => $request->from,
            ]);

            return back()->with([
                'type' => 'success',
                'message' => 'Twilio Integration Updated Successfully!'
            ]);
        }
        if ($integration->type == 'InfoBip') {
            //Validate Request
            $this->validate($request, [
                'api_key' => ['required', 'string', 'max:255'],
                'api_base_url' => ['required', 'string', 'max:255']
            ]);

            $integration->update([
                'api_key' => $request->api_key,
                'api_base_url' => $request->api_base_url,
            ]);

            return back()->with([
                'type' => 'success',
                'message' => 'InfoBip Integration Updated Successfully!'
            ]);
        }
        if ($integration->type == 'NigeriaBulkSms') {
            //Validate Request
            $this->validate($request, [
                'username' => ['required', 'string', 'max:255'],
                'password' => ['required', 'string', 'max:255']
            ]);

            $integration->update([
                'username' => $request->username,
                'password' => $request->password
            ]);

            return back()->with([
                'type' => 'success',
                'message' => 'NigeriaBulkSms Integration Updated Successfully!'
            ]);
        }
        if ($integration->type == 'Multitexter') {
            //Validate Request
            $this->validate($request, [
                'email' => ['required', 'email', 'max:255'],
                'password' => ['required', 'string', 'max:255'],
                'api_key' => ['required', 'string', 'max:255']
            ]);

            $integration->update([
                'email' => $request->email,
                'password' => $request->password,
                'api_key' => $request->api_key,
            ]);

            return back()->with([
                'type' => 'success',
                'message' => 'Multitexter Integration Updated Successfully!'
            ]);
        }
        if ($integration->type == 'AWS') {
            //Validate Request
            $this->validate($request, [
                'key' => ['required', 'string', 'max:255'],
                'secret' => ['required', 'string', 'max:255']
            ]);

            $integration->update([
                'key' => $request->key,
                'secret' => $request->secret
            ]);

            return back()->with([
                'type' => 'success',
                'message' => 'AWS Integration Updated Successfully!'
            ]);
        }
        return back()->with([
            'type' => 'danger',
            'message' => "Integration doesn't exit."
        ]);
    }

    public function integration_enable($id)
    {
        $idFinder = Crypt::decrypt($id);

        $integration = Integration::findorfail($idFinder);

        $allIntegration = Integration::where('user_id', Auth::user()->id)->where('status', 'Active')->get();

        if($allIntegration->count() > 0)
        {
            return back()->with([
                'type' => 'danger',
                'message' => 'You have an active SMS Integration, deactivate and try again!'
            ]);
        }

        $integration->update([
            'status' => 'Active'
        ]);

        return back()->with([
            'type' => 'success',
            'message' => $integration->type . ' Integration Enabled Successfully!'
        ]);
    }

    public function integration_disable($id)
    {
        $idFinder = Crypt::decrypt($id);

        $integration = Integration::findorfail($idFinder);

        $integration->update([
            'status' => 'Inactive'
        ]);

        return back()->with([
            'type' => 'success',
            'message' => $integration->type . ' Integration Disabled Successfully!'
        ]);
    }

    public function integration_delete($id, Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'delete_field' => ['required', 'string', 'max:255']
        ]);

        if ($request->delete_field == "DELETE") {
            $idFinder = Crypt::decrypt($id);

            Integration::findorfail($idFinder)->delete();

            return back()->with([
                'type' => 'success',
                'message' => 'Integration Deleted Successfully!'
            ]);
        }

        return back()->with([
            'type' => 'danger',
            'message' => "Field doesn't match, Try Again!"
        ]);
    }
}
