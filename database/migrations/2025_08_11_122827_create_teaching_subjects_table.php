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
        Schema::create('teaching_subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name_ru')->comment('Название на русском');
            $table->string('name_en')->nullable()->comment('Название на английском');
            $table->string('name_kz')->nullable()->comment('Название на казахском');
            $table->string('category')->default('general')->comment('Категория предмета');
            $table->boolean('is_active')->default(true)->comment('Активен ли предмет');
            $table->integer('sort_order')->default(0)->comment('Порядок сортировки');
            $table->timestamps();
            
            $table->index(['category', 'is_active']);
            $table->index('sort_order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teaching_subjects');
    }
};
