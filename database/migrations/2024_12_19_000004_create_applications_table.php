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
        Schema::create('applications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('user_id');
            $table->string('full_name_cyr', 255);
            $table->string('full_name_lat', 255);
            $table->boolean('is_foreign_citizen');
            $table->unsignedBigInteger('desired_track_id')->nullable();
            $table->string('employer_country', 100);
            $table->string('employer_city', 100);
            $table->enum('employer_category', ['vuz', 'school', 'college', 'other']);
            $table->string('degree', 150)->nullable();
            $table->string('position', 150)->nullable();
            $table->string('specialty', 200)->nullable();
            $table->string('taught_subjects', 300)->nullable();
            $table->string('contact_email');
            $table->string('contact_phone', 32);
            $table->string('desired_course_text', 300)->nullable();
            $table->unsignedBigInteger('specialization_id')->nullable();
            $table->date('seminar_date_from');
            $table->date('seminar_date_to');
            $table->string('study_language', 8);
            $table->string('login', 150)->nullable();
            $table->enum('status', ['draft', 'submitted', 'in_review', 'approved', 'rejected'])->default('draft');
            $table->timestamps();

            // Индексы
            $table->index('user_id');
            $table->index('desired_track_id');
            $table->index('specialization_id');
            $table->index('study_language');
            $table->index('status');
            $table->index('created_at');

            // Внешние ключи
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('desired_track_id')->references('id')->on('courses')->onDelete('set null');
            $table->foreign('specialization_id')->references('id')->on('specializations')->onDelete('set null');
            $table->foreign('study_language')->references('code')->on('education_languages')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
