<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // Job::factory(6)->create();
        // $this->call(JobSeeder::class);
        // $this->call(TrainerSeeder::class);
        // https://laravel.com/docs/10.x/seeding#calling-additional-seeders
        $this->call([
            TrainerSeeder::class,
            EmployerSeeder::class,
            JobSeeder::class,
        ]);

        // //https://stackoverflow.com/questions/64220203/how-to-get-unique-values-from-faker
        // $max = 11;
        // for ($c = 1; $c <= $max; $c++) {
        //     Trainer::factory()->create();
        // }

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
