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
        Schema::create('education_languages', function (Blueprint $table) {
            $table->string('code', 8)->primary();
            $table->string('name_ru', 64);
            $table->timestamps();
        });

        // Вставляем базовые языки
        DB::table('education_languages')->insert([
            ['code' => 'kk', 'name_ru' => 'Казахский', 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'ru', 'name_ru' => 'Русский', 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'en', 'name_ru' => 'Английский', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_languages');
    }
};
