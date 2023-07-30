<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\UpsellPageSubmission;

class CallbackController extends Controller
{
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
}
