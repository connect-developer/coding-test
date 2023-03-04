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
        $user = User::all()->random()->first();

        return [
            'name' => $this->faker->company(),
            'about' => $this->faker->catchPhrase(),
            'address' => $this->faker->address(),
            'phone_number' => $this->faker->phoneNumber(),
            'user_id' => $user->id
        ];
    }

    public function user()
    {
        return $this->faker->randomElement([
            User::class
        ]);
    }
}
