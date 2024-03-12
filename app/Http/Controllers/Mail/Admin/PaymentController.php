<?php

namespace Acelle\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Acelle\Http\Controllers\Controller;
use Illuminate\Support\MessageBag;
use Acelle\Library\Facades\Billing;
use App\Models\PaymentGateway;
use Illuminate\Support\Facades\Http;


class PaymentController extends Controller
{
    protected $baseUrl = [
        'sandbox' => 'https://api-m.sandbox.paypal.com',
    ];

    public function generateAccessToken()
    {
        $paypal = PaymentGateway::where('name', 'Paypal')->first();

        try {
            $auth = base64_encode($paypal->PAYPAL_CLIENT_ID . ':' . $paypal->PAYPAL_CLIENT_SECRET);

            $response = Http::post("{$this->baseUrl['sandbox']}/v1/oauth2/token", [
                'grant_type' => 'client_credentials',
            ], [
                'headers' => [
                    'Authorization' => "Basic {$auth}",
                ],
            ]);

            $data = $response->json();
            return $data['access_token'] ?? null;
        } catch (\Exception $e) {
            report($e);
            return null;
        }
    }

    public function createOrder($paymentSource, Request $request)
    {
        $purchaseAmount = $request->value; // TODO: pull amount from a database or session
        $accessToken = $this->generateAccessToken();

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => "Bearer {$accessToken}",
        ])->post("{$this->baseUrl['sandbox']}/v2/checkout/orders", [
            'intent' => 'CAPTURE',
            'purchase_units' => [
                [
                    'amount' => [
                        'currency_code' => 'USD',
                        'value' => $purchaseAmount,
                    ],
                ],
            ],
            'payment_source' => [
                $paymentSource => (object)[],
            ],
        ]);

        return $response->json();
    }


    public function capture(Request $request, $orderID)
    {
        // Simulate capturing the order
        // For the sake of this demo, we'll randomly decide if the capture is successful or not
        $isSuccess = rand(0, 1);

        // Simulate a successful capture response
        $successResponse = [
            'status' => 'success',
            'message' => 'Transaction successfully captured.',
            'orderID' => $orderID, // Return the order ID received from the request
            // Add any additional data you want to return
        ];

        // Simulate a failed capture response
        $failureResponse = [
            'status' => 'error',
            'message' => 'Failed to capture transaction.',
            'details' => [
                'issue' => 'INSTRUMENT_DECLINED',
                'description' => 'The payment instrument was declined.',
            ]
        ];

        // Return the appropriate response based on the success/failure simulation
        if ($isSuccess) {
            return response()->json($successResponse);
        } else {
            return response()->json($failureResponse, 400);
        }
    }

    /**
     * Display all paymentt.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, MessageBag $message_bag)
    {
        return view('admin.payments.index', [
            'gateways' => Billing::getGateways(),
            'enabledGateways' => Billing::getEnabledPaymentGateways(),
        ]);
    }

    /**
     * Enable payment.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $name
     *
     * @return \Illuminate\Http\Response
     */
    public function enable(Request $request, $name)
    {
        // enable gateway
        Billing::enablePaymentGateway($name);

        $request->session()->flash('alert-success', trans('messages.payment_gateway.updated'));
        return redirect()->action('Admin\PaymentController@index');
    }

    /**
     * Disable payment.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $name
     *
     * @return \Illuminate\Http\Response
     */
    public function disable(Request $request, $name)
    {
        // disable gateway
        Billing::disablePaymentGateway($name);

        $request->session()->flash('alert-success', trans('messages.payment_gateway.updated'));
        return redirect()->action('Admin\PaymentController@index');
    }
}
