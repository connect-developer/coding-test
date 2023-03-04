<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;
use App\Models\Job;
use App\Models\JobTitle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        ini_set('memory_limit','512M');

        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('users')->truncate();
        DB::table('companies')->truncate();
        DB::table('job_titles')->truncate();
        DB::table('jobs')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        User::create(['email' => 'admin@example.net', 'username' => 'admin', 'role' => 'ADMIN', 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'created_by' => 'system']);

        User::factory()->count(10)->create();
        Company::factory()->count(100)->create();
        JobTitle::factory()->count(50)->create();
        Job::factory()->count(1000)->create();
    }
}
