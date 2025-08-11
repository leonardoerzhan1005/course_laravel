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
        // 1. Добавляем specialization_id в таблицу courses
        Schema::table('courses', function (Blueprint $table) {
            $table->uuid('specialization_id')->nullable()->after('faculty_id');
            $table->foreign('specialization_id')->references('id')->on('specializations')->onDelete('set null');
            $table->index('specialization_id');
        });

        // 2. Удаляем faculty_id из таблицы courses (так как теперь связь идет через specialization)
        Schema::table('courses', function (Blueprint $table) {
            $table->dropForeign(['faculty_id']);
            $table->dropIndex(['faculty_id']);
            $table->dropColumn('faculty_id');
        });

        // 3. Удаляем старую таблицу course_specialization (так как теперь связь прямая)
        Schema::dropIfExists('course_specialization');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 1. Восстанавливаем faculty_id в таблицу courses
        Schema::table('courses', function (Blueprint $table) {
            $table->uuid('faculty_id')->nullable()->after('category_id');
            $table->foreign('faculty_id')->references('id')->on('faculties')->onDelete('set null');
            $table->index('faculty_id');
        });

        // 2. Удаляем specialization_id из таблицы courses
        Schema::table('courses', function (Blueprint $table) {
            $table->dropForeign(['specialization_id']);
            $table->dropIndex(['specialization_id']);
            $table->dropColumn('specialization_id');
        });

        // 3. Восстанавливаем таблицу course_specialization
        Schema::create('course_specialization', function (Blueprint $table) {
            $table->id();
            $table->uuid('course_id');
            $table->uuid('specialization_id');
            $table->timestamps();

            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('specialization_id')->references('id')->on('specializations')->onDelete('cascade');

            $table->unique(['course_id', 'specialization_id']);
        });
    }
};
