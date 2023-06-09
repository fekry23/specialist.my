<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
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
            $table->longText('title');
            $table->longText('description');
            $table->longText('rating_value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('review');
    }
};
