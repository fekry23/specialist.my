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
        Schema::create('trainers', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('name');
            $table->string('state');
            $table->string('image')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('hourly_rate')->nullable();
            $table->string('category')->nullable();
            $table->string('specialization_title')->nullable();
            $table->longText('specialization_description')->nullable();
            $table->string('skills_expertise')->nullable();
            $table->string('english_level')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainers');
    }
};
