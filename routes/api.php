<?php

use Acelle\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => ['cors']], function () {
    Route::get('/csrf-token', function() {
        return response()->json(['csrf_token' => csrf_token()]);
    });
    Route::post('/list/management/validate/email', [AuthController::class, 'validateEmail']);
});


