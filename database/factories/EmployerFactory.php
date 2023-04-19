<?php

namespace Database\Factories;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EmployerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'username' => $this->faker->unique()->userName(),
            'password' => Hash::make($this->faker->password()),
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'contact_no' => $this->faker->mobileNumber($countryCodePrefix = false, $formatting = true),
            'gender' => $this->faker->randomElement(['M', 'F']),
            'company_name' => $this->faker->company()
        ];
    }
}
