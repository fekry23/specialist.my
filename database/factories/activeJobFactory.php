<?php

namespace Database\Factories;

use App\Models\Employer;
use App\Models\Job;
use App\Models\Trainer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class activeJobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $job = Job::inRandomOrder()->first();
        return [
            'employer_id' => $job->employer_id,
            'trainer_id' => Trainer::inRandomOrder()->first()->id,
            'job_id' => $job->id,
        ];
    }
}
