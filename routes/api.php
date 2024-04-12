<?php

use Acelle\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['cors', 'json.response']], function () {
    Route::get('/csrf-token', function() {
        return response()->json(['csrf_token' => csrf_token()]);
    });

    Route::get('/list/management/validate/email/{email}', function($email) {
        // Make a request to the debounce API for each email address
        $response = Http::get('https://api.debounce.io/v1/', [
            'api' => config('app.debounce_key'),
            'email' => trim($email), // Use input() instead of get()
            // Add any other parameters required by the API
        ]);

        // Check if the request was successful
        if ($response->successful()) {
            // Process the response data
            $data = $response->json();

            // Add the debounce data to the result array
            $result = $data;
        } else {
            // Handle the error
            $result = ['error' => 'Failed to validate email address'];
        }

        return response()->json([
            'success' => true,
            'message' => 'Email address validated successfully.',
            'data' => $result
        ]);
    });
});
