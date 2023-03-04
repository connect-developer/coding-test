<?php

namespace Tests\Feature\Api;

use App\Enums\JobStatus;
use App\Models\Company;
use App\Models\JobTitle;
use App\Models\User;
use App\Models\Job;
use Tests\TestCase;

class JobTest extends TestCase
{
    // All
    public function test_get_all_jobs_as_admin_success()
    {
        $this->artisan("migrate:refresh");
        $this->artisan("db:seed");

        $user = User::all()->first();

        $response = $this->actingAs($user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ])->get(route('action.job.all', ['path' => 'admin']));

        $response->assertOk()
            ->assertJsonStructure(['datas']);
    }

    public function test_get_all_jobs_as_admin_invalid()
    {
        $this->artisan("migrate:refresh");
        $this->artisan("db:seed");

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ])->get(route('action.job.all', ['path' => 'admin']));

        $response->assertStatus(401)
            ->assertJson(['message' => 'Unauthenticated.']);
    }

    public function test_get_all_jobs_as_company_success()
    {
        $this->artisan("migrate:refresh");
        $this->artisan("db:seed");

        $user = User::all()->first();

        $response = $this->actingAs($user, 'sanctum')
            ->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ])->get(route('action.job.all', ['path' => 'company']));

        $response->assertOk()
            ->assertJsonStructure(['datas']);
    }

    public function test_get_all_jobs_as_company_invalid()
    {
        $this->artisan("migrate:refresh");
        $this->artisan("db:seed");

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ])->get(route('action.job.all', ['path' => 'company']));

        $response->assertStatus(401)
            ->assertJson(['message' => 'Unauthenticated.']);
    }

    public function test_get_all_jobs_as_guest_success()
    {
        $this->artisan("migrate:refresh");
        $this->artisan("db:seed");

        $user = User::all()->first();

        $response = $this->actingAs($user, 'sanctum')
            ->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ])->get(route('action.guest.job.all'));

        $response->assertOk()
            ->assertJsonStructure(['datas']);
    }


    // All Search
    public function test_get_all_jobs_search_as_admin_success()
    {
        $this->artisan("migrate:refresh");
        $this->artisan("db:seed");

        $user = User::all()->first();

        $response = $this->actingAs($user, 'sanctum')
            ->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ])->post(route('action.job.all.search', ['path' => 'admin']), [
                "search" => null,
                "order_by" => "id",
                "sort" => "DESC",
                "filter" => null
            ]);

        $response->assertOk()
            ->assertJsonStructure(['datas']);
    }

    public function test_get_all_jobs_search_as_admin_invalid()
    {
        $this->artisan("migrate:refresh");
        $this->artisan("db:seed");

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ])->post(route('action.job.all.search', ['path' => 'admin']), [
            "search" => null,
            "orderBy" => "id",
            "sort" => "asc",
            "filter"=> null
        ]);

        $response->assertStatus(401)
            ->assertJson(['message' => 'Unauthenticated.']);
    }

    public function test_get_all_jobs_search_as_company_success()
    {
        $this->artisan("migrate:refresh");
        $this->artisan("db:seed");

        $user = User::all()->first();

        $response = $this->actingAs($user, 'sanctum')
            ->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ])->post(route('action.job.all.search', ['path' => 'company']), [
                "search" => null,
                "order_by" => "id",
                "sort" => "DESC",
                "filter" => null
            ]);

        $response->assertOk()
            ->assertJsonStructure(['datas']);
    }

    public function test_get_all_jobs_search_as_company_invalid()
    {
        $this->artisan("migrate:refresh");
        $this->artisan("db:seed");

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ])->post(route('action.job.all.search', ['path' => 'company']), [
            "search" => null,
            "orderBy" => "id",
            "sort" => "asc",
            "filter"=> null
        ]);

        $response->assertStatus(401)
            ->assertJson(['message' => 'Unauthenticated.']);
    }

    public function test_get_all_jobs_search_as_guest_success()
    {
        $this->artisan("migrate:refresh");
        $this->artisan("db:seed");

        $user = User::all()->first();

        $response = $this->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ])->post(route('action.guest.job.all.search'), [
                "search" => null,
                "order_by" => "id",
                "sort" => "DESC",
                "filter" => null
            ]);

        $response->assertOk()
            ->assertJsonStructure(['datas']);
    }

    // All Search Page
    public function test_get_all_jobs_search_page_as_admin_success()
    {
        $this->artisan("migrate:refresh");
        $this->artisan("db:seed");

        $user = User::all()->first();

        $response = $this->actingAs($user, 'sanctum')
            ->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ])->post(route('action.job.all.search.page', ['path' => 'admin']), [
                "search" => null,
                "order_by" => "id",
                "sort" => "DESC",
                "filter" => null
            ]);

        $response->assertOk()
            ->assertJsonStructure(['datas']);
    }

    public function test_get_all_jobs_search_page_as_admin_invalid()
    {
        $this->artisan("migrate:refresh");
        $this->artisan("db:seed");

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ])->post(route('action.job.all.search.page', ['path' => 'admin']), [
            "search" => null,
            "orderBy" => "id",
            "sort" => "asc",
            "filter"=> null
        ]);

        $response->assertStatus(401)
            ->assertJson(['message' => 'Unauthenticated.']);
    }

    public function test_get_all_jobs_search_page_as_company_success()
    {
        $this->artisan("migrate:refresh");
        $this->artisan("db:seed");

        $user = User::all()->first();

        $response = $this->actingAs($user, 'sanctum')
            ->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ])->post(route('action.job.all.search.page', ['path' => 'company']), [
                "search" => null,
                "order_by" => "id",
                "sort" => "DESC",
                "filter" => null
            ]);

        $response->assertOk()
            ->assertJsonStructure(['datas']);
    }

    public function test_get_all_jobs_search_page_as_company_invalid()
    {
        $this->artisan("migrate:refresh");
        $this->artisan("db:seed");

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ])->post(route('action.job.all.search.page', ['path' => 'company']), [
            "search" => null,
            "orderBy" => "id",
            "sort" => "asc",
            "filter"=> null
        ]);

        $response->assertStatus(401)
            ->assertJson(['message' => 'Unauthenticated.']);
    }

    public function test_get_all_jobs_search_page_as_guest_success()
    {
        $this->artisan("migrate:refresh");
        $this->artisan("db:seed");

        $user = User::all()->first();

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ])->post(route('action.guest.job.all.search.page'), [
            "search" => null,
            "order_by" => "id",
            "sort" => "DESC",
            "filter" => null
        ]);

        $response->assertOk()
            ->assertJsonStructure(['datas']);
    }

    public function test_get_job_as_admin_success()
    {
        $this->artisan("migrate:refresh");
        $this->artisan("db:seed");

        $users = User::all();
        $userLogged = $users->first();

        $jobs = Job::all();
        $jobTarget = $jobs->toArray()[rand(0, $jobs->count() - 1)];

        $response = $this->actingAs($userLogged, 'sanctum')
            ->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ])
            ->get(route('action.job.show', ["path" => "admin", "id" => $jobTarget["id"]]));

        $response->assertOk()
            ->assertJsonStructure(['data']);
    }

    public function test_get_job_as_company_success()
    {
        $this->artisan("migrate:refresh");
        $this->artisan("db:seed");

        $users = User::all();
        $userLogged = $users->first();

        $jobs = Job::all();
        $jobTarget = $jobs->toArray()[rand(0, $jobs->count() - 1)];

        $response = $this->actingAs($userLogged, 'sanctum')
            ->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ])
            ->get(route('action.job.show', ["path" => "company", "id" => $jobTarget["id"]]));

        $response->assertOk()
            ->assertJsonStructure(['data']);
    }


    public function test_get_job_as_admin_not_found()
    {
        $this->artisan("migrate:refresh");
        $this->artisan("db:seed");

        $users = User::all();
        $userLogged = $users->first();

        $jobs = Job::all();
        $jobTarget = $jobs->last();

        $response = $this->actingAs($userLogged, 'sanctum')
            ->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ])
            ->get(route('action.job.show', ["path" => "admin", "id" => $jobTarget["id"] + 1]));

        $response->assertStatus(404)
            ->assertJson(['meta' => ['type' => 'ERROR']]);
    }

    public function test_get_job_as_company_not_found()
    {
        $this->artisan("migrate:refresh");
        $this->artisan("db:seed");

        $users = User::all();
        $userLogged = $users->first();

        $jobs = Job::all();
        $jobTarget = $jobs->last();

        $response = $this->actingAs($userLogged, 'sanctum')
            ->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ])
            ->get(route('action.job.show', ["path" => "company", "id" => $jobTarget["id"] + 1]));

        $response->assertStatus(404)
            ->assertJson(['meta' => ['type' => 'ERROR']]);
    }


    // Create
    public function test_store_job_as_admin_success()
    {
        $this->artisan("migrate:refresh");
        $this->artisan("db:seed");

        $users = User::all();
        $userLogged = $users->first();

        $company = Company::find(rand(1,10));
        $job_title = JobTitle::find(rand(1,10));
        $status = "Open";

        $response = $this->actingAs($userLogged, 'sanctum')
            ->post(route('action.job.create', ['path' => 'admin']), [
                "company_id" => $company->id,
                "job_title_id" => $job_title->id,
                "description" => fake()->text,
                "status" => $status
            ]);

        $response->assertOk()
            ->assertJsonStructure(['data']);
    }

    public function test_store_job_as_admin_invalid()
    {
        $this->artisan("migrate:refresh");
        $this->artisan("db:seed");

        $users = User::where('role', "ADMIN")->get();
        $userLogged = $users->first();

        $job_title = JobTitle::find(rand(1,10));
        $status = "Open";

        $response = $this->actingAs($userLogged, 'sanctum')
            ->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ])
            ->postJson(route('action.job.create', ['path' => 'admin']), [
                "job_title_id" => $job_title->id,
                "description" => fake()->text,
                "status" => $status
            ]);

        $response->assertStatus(422);
    }

    public function test_store_job_as_company_success()
    {
        $this->artisan("migrate:refresh");
        $this->artisan("db:seed");

        $users = User::all();
        $userLogged = $users->first();

        $company = Company::find(rand(1,10));
        $job_title = JobTitle::find(rand(1,10));
        $status = "Open";

        $response = $this->actingAs($userLogged, 'sanctum')
            ->post(route('action.job.create', ['path' => 'company']), [
                "company_id" => $company->id,
                "job_title_id" => $job_title->id,
                "description" => fake()->text,
                "status" => $status
            ]);

        $response->assertOk()
            ->assertJsonStructure(['data']);
    }

    public function test_store_job_as_company_invalid()
    {
        $this->artisan("migrate:refresh");
        $this->artisan("db:seed");

        $users = User::where('role', "COMPANY")->get();
        $userLogged = $users->first();

        $job_title = JobTitle::find(rand(1,10));
        $status = "Open";

        $response = $this->actingAs($userLogged, 'sanctum')
            ->postJson(route('action.job.create', ['path' => 'company']), [
                "description" => fake()->text,
                "status" => $status
            ]);

        $response->assertStatus(422);
    }

    // Update
    public function test_update_job_as_admin_success()
    {
        $this->artisan("migrate:refresh");
        $this->artisan("db:seed");

        $users = User::all();
        $userLogged = $users->first();

        $jobs = Job::all();
        $jobTarget = $jobs->toArray()[rand(0, $jobs->count() - 1)];

        $response = $this->actingAs($userLogged, 'sanctum')
            ->put(route('action.job.update', ["path" => "admin", "id" => $jobTarget["id"]]), [
                "company_id" => $jobTarget["company_id"],
                "job_title_id" => $jobTarget["job_title_id"],
                "description" => $jobTarget["description"],
                "status" => "Closed"
            ]);

        $response->assertOk()
            ->assertJsonStructure(['data']);
    }

    public function test_update_job_as_admin_invalid()
    {
        $this->artisan("migrate:refresh");
        $this->artisan("db:seed");

        $users = User::all();
        $userLogged = $users->first();

        $jobs = Job::all();
        $jobTarget = $jobs->toArray()[rand(0, $jobs->count() - 1)];

        $response = $this->actingAs($userLogged, 'sanctum')
            ->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ])
            ->put(route('action.job.update', ["path" => "admin", "id" => $jobTarget["id"]]), [
                "status" => "Closed"
            ]);

        $response->assertStatus(422);
    }

    public function test_update_job_as_company_success()
    {
        $this->artisan("migrate:refresh");
        $this->artisan("db:seed");

        $users = User::all();
        $userLogged = $users->first();

        $jobs = Job::all();
        $jobTarget = $jobs->toArray()[rand(0, $jobs->count() - 1)];

        $response = $this->actingAs($userLogged, 'sanctum')
            ->put(route('action.job.update', ["path" => "company", "id" => $jobTarget["id"]]), [
                "company_id" => $jobTarget["company_id"],
                "job_title_id" => $jobTarget["job_title_id"],
                "description" => $jobTarget["description"],
                "status" => "Closed"
            ]);

        $response->assertOk()
            ->assertJsonStructure(['data']);
    }

    public function test_update_job_as_company_invalid()
    {
        $this->artisan("migrate:refresh");
        $this->artisan("db:seed");

        $users = User::all();
        $userLogged = $users->first();

        $jobs = Job::all();
        $jobTarget = $jobs->toArray()[rand(0, $jobs->count() - 1)];

        $response = $this->actingAs($userLogged, 'sanctum')
            ->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ])
            ->put(route('action.job.update', ["path" => "company", "id" => $jobTarget["id"]]), [
                "status" => "Closed"
            ]);

        $response->assertStatus(422);
    }

    // Delete
    public function test_destroy_job_as_admin_success()
    {
        $this->artisan("migrate:refresh");
        $this->artisan("db:seed");

        $users = User::all();
        $userLogged = $users->first();

        $jobs = Job::all();
        $jobTarget = $jobs->toArray()[rand(0, $jobs->count() - 1)];

        $response = $this->actingAs($userLogged, 'sanctum')
            ->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ])
            ->delete(route('action.job.delete', ["path" => "admin", "id" => $jobTarget["id"]]));

        $response->assertOk();
    }

    public function test_destroy_job_as_admin_invalid()
    {
        $this->artisan("migrate:refresh");
        $this->artisan("db:seed");

        $users = User::all();
        $userLogged = $users->first();

        $jobs = Job::all();
        $jobTarget = $jobs->last();

        $response = $this->actingAs($userLogged, 'sanctum')
            ->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ])
            ->delete(route('action.job.delete', ["path" => "admin", "id" => $jobTarget["id"] + 1]));

        $response->assertStatus(404);
    }

    public function test_destroy_job_as_company_success()
    {
        $this->artisan("migrate:refresh");
        $this->artisan("db:seed");

        $users = User::all();
        $userLogged = $users->first();

        $jobs = Job::all();
        $jobTarget = $jobs->toArray()[rand(0, $jobs->count() - 1)];

        $response = $this->actingAs($userLogged, 'sanctum')
            ->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ])
            ->delete(route('action.job.delete', ["path" => "company", "id" => $jobTarget["id"]]));

        $response->assertOk();
    }

    public function test_destroy_job_as_company_invalid()
    {
        $this->artisan("migrate:refresh");
        $this->artisan("db:seed");

        $users = User::all();
        $userLogged = $users->first();

        $jobs = Job::all();
        $jobTarget = $jobs->last();

        $response = $this->actingAs($userLogged, 'sanctum')
            ->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ])
            ->delete(route('action.job.delete', ["path" => "company", "id" => $jobTarget["id"] + 1]));

        $response->assertStatus(404);
    }
}
