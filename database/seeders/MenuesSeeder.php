<?php

namespace Database\Seeders;

use App\Models\ExplainerContent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $createExplainer = [
            [
                'menu' => 'Dashboard',
                'text' => '',
                'video' => '',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'name' => 'Email-Marketing',
                'text' => '',
                'video' => '',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'name' => 'List-Management',
                'text' => '',
                'video' => '',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'name' => 'Funnel-Builder',
                'text' => '',
                'video' => '',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'name' => 'Page-Builder',
                'text' => '',
                'video' => '',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'name' => 'Transaction',
                'text' => '',
                'video' => '',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'name' => 'Withdrawal',
                'text' => '',
                'video' => '',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'name' => 'Subscription',
                'text' => '',
                'video' => '',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'name' => 'Automation',
                'text' => '',
                'video' => '',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'name' => 'Ecommerce',
                'text' => '',
                'video' => '',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'name' => 'Market-Place',
                'text' => '',
                'video' => '',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'name' => 'Affiliate-Marketing',
                'text' => '',
                'video' => '',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'name' => 'Integration',
                'text' => '',
                'video' => '',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'name' => "Learning-Management",
                'text' => '',
                'video' => '',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'name' => 'Birthday',
                'text' => '',
                'video' => '',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'name' => 'Sales-Analytics',
                'text' => '',
                'video' => '',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'name' => 'Report-Analysis',
                'text' => '',
                'video' => '',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'name' => 'Notification',
                'text' => '',
                'video' => '',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'name' => 'Upgrade',
                'text' => '',
                'video' => '',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'name' => 'Support',
                'text' => '',
                'video' => '',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'name' => 'Setting',
                'text' => '',
                'video' => '',
                'created_at' => now(),
                'updated_at' =>now()
            ],
        ];

        ExplainerContent::insert($createExplainer);
    }
}
