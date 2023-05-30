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
    public $timestamps = false; // No timestamps (updated_at,created_at)

    public function up(): void
    {
        Schema::create('completed_jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employer_id')
                ->constrained('employers')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('trainer_id')
                ->constrained('trainers')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('job_id')
                ->constrained('jobs')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->longText('description')->nullable();
            $table->timestamp('finish_time', $precision = 0);
            $table->string('attachment_path')->nullable();
            $table->timestamps(); // Ensure this line is removed or commented out
        });

        // Create a trigger to update the job status in the 'jobs' table after inserting a new row in the 'completed_jobs' table
        DB::unprepared('
        CREATE TRIGGER update_job_status AFTER INSERT ON completed_jobs
        FOR EACH ROW
        BEGIN
            UPDATE jobs SET status = "Pending payment" WHERE id = NEW.job_id AND trainer_id = NEW.trainer_id;
        END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the trigger
        DB::unprepared('DROP TRIGGER IF EXISTS update_job_status');

        Schema::dropIfExists('completed_jobs');
    }
};
