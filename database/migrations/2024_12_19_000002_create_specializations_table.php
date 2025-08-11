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
        Schema::create('specializations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('faculty_id'); // Связь с направлением (факультетом)
            $table->string('name_ru', 255);
            $table->string('name_kz', 255)->nullable();
            $table->string('name_en', 255)->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            // Индексы
            $table->index('faculty_id');
            $table->index('is_active');
            $table->index('sort_order');

            // Внешние ключи
            $table->foreign('faculty_id')->references('id')->on('faculties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specializations');
    }
};
