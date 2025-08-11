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
        Schema::table('specializations', function (Blueprint $table) {
            // Добавляем новое поле faculty_id
            $table->uuid('faculty_id')->nullable()->after('id');
            
            // Добавляем индекс для нового поля
            $table->index('faculty_id');
        });

        // Копируем данные из course_id в faculty_id (временно)
        // Здесь можно добавить логику миграции данных, если нужно
        
        Schema::table('specializations', function (Blueprint $table) {
            // Удаляем старый внешний ключ
            $table->dropForeign(['course_id']);
            
            // Удаляем старый индекс
            $table->dropIndex(['course_id']);
            
            // Удаляем старое поле
            $table->dropColumn('course_id');
        });

        // Добавляем внешний ключ для faculty_id
        Schema::table('specializations', function (Blueprint $table) {
            $table->foreign('faculty_id')->references('id')->on('faculties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('specializations', function (Blueprint $table) {
            // Удаляем новый внешний ключ
            $table->dropForeign(['faculty_id']);
            
            // Удаляем новый индекс
            $table->dropIndex(['faculty_id']);
            
            // Удаляем новое поле
            $table->dropColumn('faculty_id');
        });

        // Восстанавливаем старое поле course_id
        Schema::table('specializations', function (Blueprint $table) {
            $table->unsignedBigInteger('course_id')->after('id');
            $table->index('course_id');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });
    }
};
