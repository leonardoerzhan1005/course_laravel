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
        Schema::create('application_forms', function (Blueprint $table) {
            $table->id();
            
            // Личные данные (кириллица)
            $table->string('last_name_cyrillic');
            $table->string('first_name_cyrillic');
            $table->string('middle_name_cyrillic');
            
            // Личные данные (латиница)
            $table->string('last_name_latin');
            $table->string('first_name_latin');
            $table->string('middle_name_latin');
            
            // Гражданство
            $table->boolean('is_foreign_citizen');
            
            // Контактная информация
            $table->string('email');
            $table->string('phone');
            
            // Образование и работа
            $table->string('course_direction');
            $table->string('workplace');
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('city_id');
            $table->string('institution_category');
            $table->string('other_institution_type')->nullable();
            $table->string('academic_degree');
            $table->string('position');
            $table->json('teaching_subjects');
            
            // Курс и даты
            $table->unsignedBigInteger('course_id');
            $table->uuid('specialty_id')->nullable(); // ID специализации
            $table->string('course_language', 8); // Код языка курса
            $table->date('seminar_start_date');
            $table->date('seminar_end_date');
            
            // Статус заявки
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('notes')->nullable();
            
            $table->timestamps();
            
            // Внешние ключи
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('specialty_id')->references('id')->on('specializations')->onDelete('set null');
            $table->foreign('course_language')->references('code')->on('education_languages')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_forms');
    }
};
