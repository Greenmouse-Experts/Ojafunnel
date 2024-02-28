<?php

namespace Database\Seeders;

use App\Models\AffiliateLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $createLevel = [
            [
                'level' => '1',
                'bonus_percent' => '10',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'level' => '2',
                'bonus_percent' => '5',
                'created_at' => now(),
                'updated_at' =>now()
            ],
        ];

        AffiliateLevel::insert($createLevel);
    }
}
