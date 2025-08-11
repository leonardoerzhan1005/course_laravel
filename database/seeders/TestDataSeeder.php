<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Faculty;
use App\Models\Specialization;
use Modules\Course\app\Models\CourseLanguage;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Создаем тестовые курсы
        Course::create([
            'instructor_id' => 1, // Предполагаем, что есть пользователь с ID 1
            'category_id' => 1,   // Предполагаем, что есть категория с ID 1
            'type' => 'course',
            'title' => 'Курс повышения квалификации по информационным технологиям',
            'slug' => 'course-information-technology',
            'description' => 'Описание курса повышения квалификации по информационным технологиям',
            'price' => 15000,
            'status' => 'active',
            'is_approved' => 'approved',
        ]);
        
        Course::create([
            'instructor_id' => 1,
            'category_id' => 1,
            'type' => 'course',
            'title' => 'Курс повышения квалификации по педагогике',
            'slug' => 'course-pedagogy',
            'description' => 'Описание курса повышения квалификации по педагогике',
            'price' => 12000,
            'status' => 'active',
            'is_approved' => 'approved',
        ]);
        
        Course::create([
            'instructor_id' => 1,
            'category_id' => 1,
            'type' => 'course',
            'title' => 'Курс повышения квалификации по медицине',
            'slug' => 'course-medicine',
            'description' => 'Описание курса повышения квалификации по медицине',
            'price' => 18000,
            'status' => 'active',
            'is_approved' => 'approved',
        ]);
        
        // Создаем языки курсов, если их нет
        if (CourseLanguage::count() == 0) {
            CourseLanguage::create(['name' => 'Русский', 'status' => 1]);
            CourseLanguage::create(['name' => 'Английский', 'status' => 1]);
            CourseLanguage::create(['name' => 'Казахский', 'status' => 1]);
        }
        
        $this->command->info('Test data seeded successfully!');
    }
}
