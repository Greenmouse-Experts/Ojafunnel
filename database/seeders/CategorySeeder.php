<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $createCategory = [
            [
                'name' => 'Development',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'name' => 'Business',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'name' => 'Finance and Accounting',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'name' => 'IT & Software',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'name' => 'Office Productivity',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'name' => 'Personal Development',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'name' => 'Design',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'name' => 'Marketing',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'name' => 'Lifestyle',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'name' => 'Photography & Video',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'name' => 'Health & Fitness',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'name' => 'Music',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'name' => 'Teaching & Academics',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'name' => "I don't know yet",
                'created_at' => now(),
                'updated_at' =>now()
            ]
        ];

        Category::insert($createCategory);
    }
}
