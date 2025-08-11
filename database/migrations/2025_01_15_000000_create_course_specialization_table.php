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
        Schema::create('course_specialization', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('course_id')->unsigned();
            $table->uuid('specialization_id');
            $table->timestamps();

            // Индексы
            $table->index('course_id');
            $table->index('specialization_id');

            // Внешние ключи
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('specialization_id')->references('id')->on('specializations')->onDelete('cascade');

            // Уникальный индекс для предотвращения дублирования
            $table->unique(['course_id', 'specialization_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_specialization');
    }
};
