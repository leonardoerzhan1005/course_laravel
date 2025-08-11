<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // Сначала создаем роли и разрешения
            RolePermissionSeeder::class,
            
            // Затем создаем базовые данные
            AdminInfoSeeder::class,
            CountryCitySeeder::class,
            FacultySeeder::class, // Сначала направления
            SpecializationSeeder::class, // Затем специализации
            
            // Затем создаем пользователей
            UserSeeder::class,
            
            // Создаем курсы и связанные данные
            CourseSeeder::class,
            
            // В конце создаем заявки (они зависят от пользователей и курсов)
            ApplicationSeeder::class,
            ApplicationFormSeeder::class,
            
            // Добавляем пункт меню для анкеты
            \Modules\Menubuilder\database\seeders\ApplicationFormMenuSeeder::class,
        ]);
    }
}
