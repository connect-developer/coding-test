<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'about' => $this->faker->catchPhrase(),
            'address' => $this->faker->address(),
            'phone_number' => $this->faker->phoneNumber(),
            'user_id' => $this->faker->unique()->numberBetween(1, User::count())
        ];
    }
}
