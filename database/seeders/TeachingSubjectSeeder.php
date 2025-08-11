<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TeachingSubject;

class TeachingSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            // Основные предметы
            ['name_ru' => 'Математика', 'category' => 'exact', 'sort_order' => 1],
            ['name_ru' => 'Физика', 'category' => 'exact', 'sort_order' => 2],
            ['name_ru' => 'Химия', 'category' => 'exact', 'sort_order' => 3],
            ['name_ru' => 'Биология', 'category' => 'natural', 'sort_order' => 4],
            ['name_ru' => 'География', 'category' => 'natural', 'sort_order' => 5],
            
            // Гуманитарные предметы
            ['name_ru' => 'История', 'category' => 'humanitarian', 'sort_order' => 6],
            ['name_ru' => 'Литература', 'category' => 'humanitarian', 'sort_order' => 7],
            ['name_ru' => 'Русский язык', 'category' => 'language', 'sort_order' => 8],
            ['name_ru' => 'Английский язык', 'category' => 'language', 'sort_order' => 9],
            ['name_ru' => 'Казахский язык', 'category' => 'language', 'sort_order' => 10],
            
            // Технические предметы
            ['name_ru' => 'Информатика', 'category' => 'technical', 'sort_order' => 11],
            ['name_ru' => 'Программирование', 'category' => 'technical', 'sort_order' => 12],
            ['name_ru' => 'Робототехника', 'category' => 'technical', 'sort_order' => 13],
            
            // Творческие предметы
            ['name_ru' => 'ИЗО', 'category' => 'creative', 'sort_order' => 14],
            ['name_ru' => 'Музыка', 'category' => 'creative', 'sort_order' => 15],
            ['name_ru' => 'Физкультура', 'category' => 'physical', 'sort_order' => 16],
            
            // Экономические предметы
            ['name_ru' => 'Экономика', 'category' => 'economic', 'sort_order' => 17],
            ['name_ru' => 'Бухгалтерия', 'category' => 'economic', 'sort_order' => 18],
            ['name_ru' => 'Менеджмент', 'category' => 'economic', 'sort_order' => 19],
            
            // Медицинские предметы
            ['name_ru' => 'Анатомия', 'category' => 'medical', 'sort_order' => 20],
            ['name_ru' => 'Физиология', 'category' => 'medical', 'sort_order' => 21],
            ['name_ru' => 'Фармакология', 'category' => 'medical', 'sort_order' => 22],
        ];

        foreach ($subjects as $subject) {
            TeachingSubject::updateOrCreate(
                ['name_ru' => $subject['name_ru']],
                $subject
            );
        }
    }
}
