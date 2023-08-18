<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SiteFeature;

class SiteFeaturesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $createSiteFeatures = [
            [
                'features' => 'Page Builder',
            ],
            [
                'features' => 'Funnel Builder',
            ],
            [
                'features' => 'Subscription Page',
            ],
            [
                'features' => 'Email Marketing',
            ],
            [
                'features' => 'Integration Page',
            ],
            [
                'features' => 'List Management',
            ],
        ];

        SiteFeature::insert($createSiteFeatures);

    }
}
