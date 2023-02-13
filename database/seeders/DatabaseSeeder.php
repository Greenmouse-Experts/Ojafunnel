<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        if (config('app.env') === 'local') {
            $this->call(TestPageSeeder::class);
            $this->call(ContactListSeeder::class);
            $this->call(ContactNumberSeeder::class);
            $this->call(CategorySeeder::class);
            $this->call(PlanSeeder::class);
        }
    }
}
