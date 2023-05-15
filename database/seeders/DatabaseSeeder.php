<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Company;
use App\Models\Job;
use App\Models\JobTitle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        Admin::factory()->create([
            'email' => 'admin@example.net',
        ]);

        Company::factory()->count(100)->create();
        JobTitle::factory()->count(50)->create();
        Job::factory()->count(1000)->create();
    }
}
