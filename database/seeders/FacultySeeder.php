<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faculty;
use Illuminate\Support\Str;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faculties = [
            [
                'id' => Str::uuid(),
                'name_ru' => 'Биология',
                'name_kz' => 'Биология',
                'name_en' => 'Biology',
                'sort_order' => 1,
            ],
            [
                'id' => Str::uuid(),
                'name_ru' => 'География',
                'name_kz' => 'География',
                'name_en' => 'Geography',
                'sort_order' => 2,
            ],
            [
                'id' => Str::uuid(),
                'name_ru' => 'Механика-Математика',
                'name_kz' => 'Механика-Математика',
                'name_en' => 'Mechanics-Mathematics',
                'sort_order' => 3,
            ],
            [
                'id' => Str::uuid(),
                'name_ru' => 'Физика',
                'name_kz' => 'Физика',
                'name_en' => 'Physics',
                'sort_order' => 4,
            ],
        ];

        foreach ($faculties as $faculty) {
            Faculty::create($faculty);
        }
    }
}
