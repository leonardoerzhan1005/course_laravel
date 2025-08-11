<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Очищаем существующие связи
        DB::table('course_specialization')->truncate();

        // Курс по IT (ID: 2) -> специализации по IT
        $itFacultyId = '3c9f4171-66b7-4b54-aacc-e77e9b2bea5c';
        $itSpecs = DB::table('specializations')
            ->where('faculty_id', $itFacultyId)
            ->pluck('id')
            ->toArray();

        foreach ($itSpecs as $specId) {
            DB::table('course_specialization')->insert([
                'course_id' => 2,
                'specialization_id' => $specId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Курс по педагогике (ID: 3) -> специализации по педагогике
        $pedFacultyId = '231a483d-2250-4be2-97b3-601d8bf49243';
        $pedSpecs = DB::table('specializations')
            ->where('faculty_id', $pedFacultyId)
            ->pluck('id')
            ->toArray();

        foreach ($pedSpecs as $specId) {
            DB::table('course_specialization')->insert([
                'course_id' => 3,
                'specialization_id' => $specId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Курс по медицине (ID: 4) -> специализации по медицине
        $medFacultyId = '6927e7d5-86ff-47f3-bbac-3b2355ac91cc';
        $medSpecs = DB::table('specializations')
            ->where('faculty_id', $medFacultyId)
            ->pluck('id')
            ->toArray();

        foreach ($medSpecs as $specId) {
            DB::table('course_specialization')->insert([
                'course_id' => 4,
                'specialization_id' => $specId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('Course-Specialization relationships created successfully!');
    }
}
