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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employer_id')
                ->constrained('employers')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('title');
            $table->string('state');
            $table->longText('description');
            $table->string('category');
            $table->string('type');
            $table->string('rate');
            $table->string('exp_level');
            $table->string('project_length');
            $table->string('skills');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
