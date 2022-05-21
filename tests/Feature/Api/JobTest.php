<?php

namespace Tests\Feature\Api;

use App\Models\Admin;
use App\Models\Job;
use Tests\TestCase;

class JobTest extends TestCase
{
    private $admin;

    public function setUp(): void
    {
        parent::setUp();

        $this->admin = Admin::factory()->create();
        Job::factory()->count(25)->open()->create();
        Job::factory()->count(30)->closed()->create();
    }

    public function test_view()
    {
        $perPage = 12;
        $page = 1;

        $response = $this->json('GET', route('job.view'), [
            'per_page' => $perPage,
            'page' => $page,
        ]);

        $response
            ->assertOk()
            ->assertJson([
                'meta' => [
                    'per_page' => $perPage,
                    'current_page' => $page,
                    'total' => 25,
                ],
            ]);
    }

    public function test_show()
    {
        $job = Job::factory()->open()->create();
        $response = $this->json('GET', route('job.show', ['id' => $job->id]));

        $response
            ->assertOk()
            ->assertJson([
                'data' => [
                    'id' => $job->id,
                ],
            ]);
    }

    public function test_show_not_found()
    {
        $job = Job::factory()->closed()->create();
        $response = $this->json('GET', route('job.show', ['id' => $job->id]));

        $response->assertNotFound();
    }

    public function test_create()
    {
        $job = Job::factory()->make();
        $response = $this->actingAs($this->admin, 'web')->json('POST', route('job.create'), [
            'company_id' => $job->company_id,
            'job_title_id' => $job->job_title_id,
            'description' => $job->description,
            'status' => $job->status->key,
        ]);

        $response
            ->assertCreated()
            ->assertJson([
                'data' => [
                    'company' => [
                        'id' => $job->company_id,
                    ],
                    'job_title' => [
                        'id' => $job->job_title_id,
                    ],
                    'description' => $job->description,
                    'status' => $job->status->key,
                ],
            ]);
    }

    public function test_create_unauthenticated()
    {
        $this->assertGuest();

        $job = Job::factory()->make();
        $response = $this->json('POST', route('job.create'), [
            'company_id' => $job->company_id,
            'job_title_id' => $job->job_title_id,
            'description' => $job->description,
            'status' => $job->status->key,
        ]);

        $response->assertUnauthorized();
    }

    public function test_create_company_id_failure()
    {
        $this
            ->actingAs($this->admin, 'web')
            ->json('POST', route('job.create'), [
                'company_id' => null,
            ])
            ->assertInvalid(['company_id']);

        $this
            ->actingAs($this->admin, 'web')
            ->json('POST', route('job.create'), [
                'company_id' => 99999999,
            ])
            ->assertInvalid(['company_id']);
    }

    public function test_create_job_title_id_failure()
    {
        $this
            ->actingAs($this->admin, 'web')
            ->json('POST', route('job.create'), [
                'job_title_id' => null,
            ])
            ->assertInvalid(['job_title_id']);

        $this
            ->actingAs($this->admin, 'web')
            ->json('POST', route('job.create'), [
                'job_title_id' => 99999999,
            ])
            ->assertInvalid(['job_title_id']);
    }

    public function test_create_description_failure()
    {
        $this
            ->actingAs($this->admin, 'web')
            ->json('POST', route('job.create'), [
                'description' => null,
            ])
            ->assertInvalid(['description']);

        $this
            ->actingAs($this->admin, 'web')
            ->json('POST', route('job.create'), [
                'description' => $this->faker->realTextBetween(20001, 20100),
            ])
            ->assertInvalid(['description']);
    }

    public function test_create_status_failure()
    {
        $this
            ->actingAs($this->admin, 'web')
            ->json('POST', route('job.create'), [
                'status' => null,
            ])
            ->assertInvalid(['status']);

        $this
            ->actingAs($this->admin, 'web')
            ->json('POST', route('job.create'), [
                'status' => 'Scheduled',
            ])
            ->assertInvalid(['status']);
    }

    public function test_update()
    {
        $job = Job::factory()->create();
        $fake = Job::factory()->make();
        $response = $this->actingAs($this->admin, 'web')->json('PUT', route('job.update', ['id' => $job->id]), [
            'company_id' => $fake->company_id,
            'job_title_id' => $fake->job_title_id,
            'description' => $fake->description,
            'status' => $fake->status->key,
        ]);

        $response
            ->assertOk()
            ->assertJson([
                'data' => [
                    'company' => [
                        'id' => $fake->company_id,
                    ],
                    'job_title' => [
                        'id' => $fake->job_title_id,
                    ],
                    'description' => $fake->description,
                    'status' => $fake->status->key,
                ],
            ]);
    }

    public function test_update_company_id_failure()
    {
        $job = Job::factory()->create();
        $this
            ->actingAs($this->admin, 'web')
            ->json('PUT', route('job.update', ['id' => $job->id]), [
                'company_id' => null,
            ])
            ->assertInvalid(['company_id']);

        $this
            ->actingAs($this->admin, 'web')
            ->json('PUT', route('job.update', ['id' => $job->id]), [
                'company_id' => 99999999,
            ])
            ->assertInvalid(['company_id']);
    }

    public function test_update_job_title_id_failure()
    {
        $job = Job::factory()->create();
        $this
            ->actingAs($this->admin, 'web')
            ->json('PUT', route('job.update', ['id' => $job->id]), [
                'job_title_id' => null,
            ])
            ->assertInvalid(['job_title_id']);

        $this
            ->actingAs($this->admin, 'web')
            ->json('PUT', route('job.update', ['id' => $job->id]), [
                'job_title_id' => 99999999,
            ])
            ->assertInvalid(['job_title_id']);
    }

    public function test_update_description_failure()
    {
        $job = Job::factory()->create();
        $this
            ->actingAs($this->admin, 'web')
            ->json('PUT', route('job.update', ['id' => $job->id]), [
                'description' => null,
            ])
            ->assertInvalid(['description']);

        $this
            ->actingAs($this->admin, 'web')
            ->json('PUT', route('job.update', ['id' => $job->id]), [
                'description' => $this->faker->realTextBetween(20001, 20100),
            ])
            ->assertInvalid(['description']);
    }

    public function test_update_status_failure()
    {
        $job = Job::factory()->create();
        $this
            ->actingAs($this->admin, 'web')
            ->json('PUT', route('job.update', ['id' => $job->id]), [
                'status' => null,
            ])
            ->assertInvalid(['status']);

        $this
            ->actingAs($this->admin, 'web')
            ->json('PUT', route('job.update', ['id' => $job->id]), [
                'status' => 'Scheduled',
            ])
            ->assertInvalid(['status']);
    }

    public function test_delete()
    {
        $job = Job::factory()->create();
        $this
            ->actingAs($this->admin, 'web')
            ->json('DELETE', route('job.delete', ['id' => $job->id]))
            ->assertNoContent();
    }

    public function test_delete_not_found()
    {
        $this
            ->actingAs($this->admin, 'web')
            ->json('DELETE', route('job.delete', ['id' => 99999999]))
            ->assertNotFound();
    }
}
