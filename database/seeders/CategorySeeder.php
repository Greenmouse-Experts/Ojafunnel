<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contact_numbers')->insert([
            [
                'phone_number' => '+2348134211037',
                'contact_list_id' => 1
            ],
            [
                'phone_number' => '+2348137457095',
                'contact_list_id' => 1
            ],
            [
                'phone_number' => '+2347044792651',
                'contact_list_id' => 1
            ],
        ]);
    }
}
