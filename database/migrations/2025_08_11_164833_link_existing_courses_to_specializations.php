<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Связываем существующие курсы со специализациями
        // Курс "Основы генетики для учителей" уже связан с "Генетика"
        
        // Курс "Курс повышения квалификации по педагогике" связываем с педагогической специализацией
        $pedagogySpec = DB::table('specializations')
            ->where('name_ru', 'like', '%педагог%')
            ->orWhere('name_ru', 'like', '%обучен%')
            ->first();
            
        if ($pedagogySpec) {
            DB::table('courses')
                ->where('id', 3)
                ->update(['specialization_id' => $pedagogySpec->id]);
        }
        
        // Курс "Курс повышения квалификации по информационным технологиям" связываем с IT специализацией
        $itSpec = DB::table('specializations')
            ->where('name_ru', 'like', '%информац%')
            ->orWhere('name_ru', 'like', '%компьютер%')
            ->orWhere('name_ru', 'like', '%программ%')
            ->first();
            
        if ($itSpec) {
            DB::table('courses')
                ->where('id', 2)
                ->update(['specialization_id' => $itSpec->id]);
        }
        
        // Курс "Основы квантовой механики для учителей" связываем с физикой
        $physicsSpec = DB::table('specializations')
            ->where('name_ru', 'like', '%физик%')
            ->orWhere('name_ru', 'like', '%механик%')
            ->first();
            
        if ($physicsSpec) {
            DB::table('courses')
                ->where('id', 6)
                ->update(['specialization_id' => $physicsSpec->id]);
        }
        
        // Курс "Курс повышения квалификации по медицине" связываем с медицинской специализацией
        $medicalSpec = DB::table('specializations')
            ->where('name_ru', 'like', '%медиц%')
            ->orWhere('name_ru', 'like', '%биолог%')
            ->first();
            
        if ($medicalSpec) {
            DB::table('courses')
                ->where('id', 4)
                ->update(['specialization_id' => $medicalSpec->id]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Отвязываем курсы от специализаций
        DB::table('courses')
            ->whereIn('id', [2, 3, 4, 6])
            ->update(['specialization_id' => null]);
    }
};
