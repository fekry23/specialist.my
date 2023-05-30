<?php

namespace Database\Factories;

use App\Models\Employer;
use App\Models\Trainer;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // FK in Factory: https://stackoverflow.com/questions/65819528/laravel-8-factories-foreign-keys
            // FK in Factory: https://laravel.com/docs/10.x/queries#random-ordering
            'employer_id' => Employer::inRandomOrder()->first()->id,
            'trainer_id' => Trainer::inRandomOrder()->first()->id,
            'title' => $this->faker->sentence(),
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
                'Putrajaya',
                'Sabah',
                'Sarawak',
                'Selangor',
                'Terengganu'
            ]),
            'description' => $this->faker->paragraph(5),
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
            'type' => $this->faker->randomElement([
                'Hourly',
                'Fixed-Price'
            ]),
            'rate' => $this->faker->randomDigitNotNull(),
            'exp_level' => $this->faker->randomElement([
                'Entry',
                'Intermediate',
                'Expert'
            ]),
            'project_length' => $this->faker->randomElement([
                'Less than one month',
                '1 to 3 months',
                '3 to 6 months',
                'More than 6 months'
            ]),
            'skills' => 'laravel, api, backend',
            'status' => 'On going'
        ];
    }
}
