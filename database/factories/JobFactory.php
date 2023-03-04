<?php

namespace Database\Factories;

use App\Enums\JobStatus;
use App\Models\Company;
use App\Models\JobTitle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $companyId = Company::all()->random(1)[0]->id;
        $jobTitleId = JobTitle::all()->random(1)[0]->id;

        return [
            'company_id' => $companyId,
            'job_title_id' => $jobTitleId,
            'description' => $this->faker->paragraphs(2, true),
            'status' => JobStatus::getRandomInstance(),
            'created_by' => 'system'
        ];
    }

    public function open()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => JobStatus::Open(),
            ];
        });
    }

    public function closed()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => JobStatus::Closed(),
            ];
        });
    }
}
