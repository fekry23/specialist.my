<?php

namespace Database\Factories;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TrainerFactory extends Factory
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
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make($this->faker->password()),
            'name' => $this->faker->name(),
            'state' => $this->faker->randomElement([
                'Johor',
                'Kedah',
                'Kelantan',
                'Kuala Lumpur',
                'Labuan',
                'Melaka',
                'Negeri Sembilan',
                'Pahang',
                'Penang',
                'Perak',
                'Perlis',
                'Perlis',
                'Putrajaya',
                'Sabah',
                'Sarawak',
                'Selangor',
                'Terengganu'
            ]),
            'contact_no' => $this->faker->mobileNumber($countryCodePrefix = false, $formatting = true),
            'hourly_rate' => $this->faker->numberBetween(1, 100),
            'category' => $this->faker->randomElement([
                'Accounting & Consulting',
                'Admin Support',
                'Customer Service',
                'Data Science & Analytics',
                'Design & Creative',
                'Engineering & Architecture',
                'IT & Networking', 'Legal',
                'Sales & Marketing',
                'Translation',
                'Web/Mobile & Software Dev',
                'Writing'
            ]),
            'specialization_title' => $this->faker->sentence(),
            'specialization_description' => $this->faker->paragraph(5),
            'skills_expertise' => 'laravel, api, backend',
            'english_level' => $this->faker->randomElement([
                'Basic',
                'Conversational',
                'Fleunt',
                'Native or bilingual'
            ]),
        ];
    }
}
