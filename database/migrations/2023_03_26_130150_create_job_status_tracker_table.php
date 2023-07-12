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
        Schema::create('job_status_tracker', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')
                ->constrained('jobs')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('status');
            $table->longText('description')
                ->nullable();
            $table->timestamps();
        });

        // Trigger to insert into job_status_tracker table
        DB::unprepared('
        CREATE TRIGGER trg_job_status_insert
        AFTER INSERT ON jobs
        FOR EACH ROW
        BEGIN
            INSERT INTO job_status_tracker (job_id, status, created_at, updated_at)
            VALUES (NEW.id, NEW.status, NOW(), NOW());
        END;
        ');

        // Trigger to track job status changes
        DB::unprepared('
        CREATE TRIGGER trg_job_status_update
        AFTER UPDATE ON jobs
        FOR EACH ROW
        BEGIN
            IF NEW.status <> OLD.status THEN
                INSERT INTO job_status_tracker (job_id, status, created_at, updated_at)
                VALUES (NEW.id, NEW.status, NOW(), NOW());
            END IF;
        END;
        ');

        // Trigger to remove trainer 
        DB::unprepared('
        CREATE TRIGGER trg_job_remove_trainer
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
        DB::unprepared('DROP TRIGGER IF EXISTS trg_job_status_insert;');
        DB::unprepared('DROP TRIGGER IF EXISTS trg_job_status_update;');
        Schema::dropIfExists('job_status_tracker');
    }
};
