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
        Schema::create('trainer_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trainer_id')
                ->constrained('trainers')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('job_id')
                ->constrained('jobs')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('employer_id')
                ->constrained('employers')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->longText('description')->nullable();
            $table->string('application_status');
            $table->timestamps();
        });

        // This is an SQL update statement that sets the application_status column to 'rejected' for all rows 
        // in the trainer_applications table where the job_id is the same as the updated row's job_id, and the 
        // trainer_id is different from the updated row's trainer_id. 
        DB::unprepared('
        CREATE TRIGGER trg_update_job_trainer_id
        AFTER UPDATE ON trainer_applications
        FOR EACH ROW
        BEGIN
            IF NEW.application_status = "Accepted" THEN
                UPDATE jobs
                SET trainer_id = NEW.trainer_id,
                    updated_at = NOW()
                WHERE id = NEW.job_id;
            END IF;
        END;
    ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the trigger before dropping the table
        DB::unprepared('DROP TRIGGER IF EXISTS trg_insert_job_trainer_id;');
        Schema::dropIfExists('trainer_applications');
    }
};
