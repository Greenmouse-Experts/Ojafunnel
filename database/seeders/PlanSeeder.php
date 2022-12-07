<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $createPlan = [
            [
                'name' => 'Free',
                'monthly_amount' => 0,
                'yearly_amount' => 0,
                'currency' => '₦',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'name' => 'Starter',
                'monthly_amount' => 100,
                'yearly_amount' => 200,
                'currency' => '₦',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'name' => 'Standard',
                'monthly_amount' => 500,
                'yearly_amount' => 1000,
                'currency' => '₦',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'name' => 'Essencial',
                'monthly_amount' => 1500,
                'yearly_amount' => 2000,
                'currency' => '₦',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'name' => 'Premium',
                'monthly_amount' => 2500,
                'yearly_amount' => 3000,
                'currency' => '₦',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'name' => 'Enterprise',
                'monthly_amount' => 4000,
                'yearly_amount' => 4500,
                'currency' => '₦',
                'created_at' => now(),
                'updated_at' =>now()
            ]
        ];

        Plan::insert($createPlan);
    }
}
