<?php

namespace Database\Seeders;

use App\Models\PaymentGateway;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentGatewaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $createGateway = [
            [
                'name' => 'Paystack',
                'logo' => 'paystack.png',
                'PAYSTACK_PUBLIC_KEY' => null,
                'PAYSTACK_SECRET_KEY' => null,
                'FLW_PUBLIC_KEY' => null,
                'FLW_SECRET_KEY' => null,
                'PAYPAL_MODE' => null,
                'PAYPAL_CURRENCY' => null,
                'PAYPAL_SANDBOX_API_CERTIFICATE' => null,
                'PAYPAL_CLIENT_ID' => null,
                'PAYPAL_CLIENT_SECRET' => null,
                'STRIPE_KEY' => null,
                'STRIPE_SECRET' => null,
                'status' => 'Inactive',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'name' => 'Paypal',
                'logo' => 'paypal.png',
                'PAYSTACK_PUBLIC_KEY' => null,
                'PAYSTACK_SECRET_KEY' => null,
                'FLW_PUBLIC_KEY' => null,
                'FLW_SECRET_KEY' => null,
                'PAYPAL_MODE' => null,
                'PAYPAL_CURRENCY' => null,
                'PAYPAL_SANDBOX_API_CERTIFICATE' => null,
                'PAYPAL_CLIENT_ID' => null,
                'PAYPAL_CLIENT_SECRET' => null,
                'STRIPE_KEY' => null,
                'STRIPE_SECRET' => null,
                'status' => 'Inactive',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'name' => 'Stripe',
                'logo' => 'stripe.png',
                'PAYSTACK_PUBLIC_KEY' => null,
                'PAYSTACK_SECRET_KEY' => null,
                'FLW_PUBLIC_KEY' => null,
                'FLW_SECRET_KEY' => null,
                'PAYPAL_MODE' => null,
                'PAYPAL_CURRENCY' => null,
                'PAYPAL_SANDBOX_API_CERTIFICATE' => null,
                'PAYPAL_CLIENT_ID' => null,
                'PAYPAL_CLIENT_SECRET' => null,
                'STRIPE_KEY' => null,
                'STRIPE_SECRET' => null,
                'status' => 'Inactive',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'name' => 'Flutterwave',
                'logo' => 'flutterwave.png',
                'PAYSTACK_PUBLIC_KEY' => null,
                'PAYSTACK_SECRET_KEY' => null,
                'FLW_PUBLIC_KEY' => null,
                'FLW_SECRET_KEY' => null,
                'PAYPAL_MODE' => null,
                'PAYPAL_CURRENCY' => null,
                'PAYPAL_SANDBOX_API_CERTIFICATE' => null,
                'PAYPAL_CLIENT_ID' => null,
                'PAYPAL_CLIENT_SECRET' => null,
                'STRIPE_KEY' => null,
                'STRIPE_SECRET' => null,
                'status' => 'Inactive',
                'created_at' => now(),
                'updated_at' =>now()
            ],
        ];

        PaymentGateway::insert($createGateway);
    }
}
