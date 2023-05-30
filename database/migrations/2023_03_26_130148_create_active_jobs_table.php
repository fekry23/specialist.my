<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('active_jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employer_id')
                ->constrained('employers')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('trainer_id')
                ->nullable()
                ->constrained('trainers')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('job_id')
                ->constrained('jobs')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->timestamps();
        });

        //  Automatically inserts a new row into the active_jobs table
        DB::unprepared('
        CREATE TRIGGER trg_active_jobs_insert
        AFTER INSERT ON jobs
        FOR EACH ROW
        BEGIN
            INSERT INTO active_jobs (employer_id, trainer_id, job_id, created_at, updated_at)
            VALUES (NEW.employer_id, NEW.trainer_id, NEW.id, NOW(), NOW());
        END;
        ');

        // Automatically update trainer_id column when a new trainer is accepted
        DB::statement('
        CREATE TRIGGER trg_active_jobs_update
        AFTER UPDATE ON jobs
        FOR EACH ROW
        BEGIN
            UPDATE active_jobs
            SET trainer_id = NEW.trainer_id,
                updated_at = NOW()
            WHERE job_id = NEW.id;
        END;
    ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the trigger before dropping the table
        DB::unprepared('DROP TRIGGER IF EXISTS trg_active_jobs_insert;');
        DB::unprepared('DROP TRIGGER IF EXISTS trg_active_jobs_update;');

        Schema::dropIfExists('active_jobs');
    }
};
