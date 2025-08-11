<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ApplicationFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Очищаем таблицу перед заполнением
        DB::table('application_forms')->truncate();

        $faker = Faker::create('ru_RU');

        // Получаем существующие ID для связей
        $countryIds = DB::table('countries')->pluck('id')->toArray();
        $cityIds = DB::table('cities')->pluck('id')->toArray();
        $courseIds = DB::table('courses')->pluck('id')->toArray();
        $specialtyIds = DB::table('specializations')->pluck('id')->toArray();
        $languageIds = DB::table('education_languages')->pluck('id')->toArray();

        // Категории учреждений
        $institutionCategories = ['vuz', 'school', 'college', 'other'];
        
        // Академические степени
        $academicDegrees = [
            'Бакалавр', 'Магистр', 'Доктор наук', 'Кандидат наук', 
            'Специалист', 'Аспирант', 'Доцент', 'Профессор'
        ];

        // Позиции
        $positions = [
            'Преподаватель', 'Старший преподаватель', 'Доцент', 'Профессор',
            'Заведующий кафедрой', 'Декан', 'Ректор', 'Учитель',
            'Директор школы', 'Заместитель директора'
        ];

        // Предметы для преподавания
        $teachingSubjects = [
            'Математика', 'Физика', 'Химия', 'Биология', 'История',
            'Литература', 'Русский язык', 'Английский язык', 'Информатика',
            'География', 'Обществознание', 'Экономика', 'Право', 'Психология'
        ];

        // Создаем 50 тестовых заявок
        for ($i = 0; $i < 50; $i++) {
            $isForeign = $faker->boolean(20); // 20% иностранных граждан
            
            // Генерируем имена на кириллице и латинице
            $lastNameCyr = $faker->lastName;
            $firstNameCyr = $faker->firstName;
            $middleNameCyr = $faker->middleName;
            
            $lastNameLat = $this->transliterate($lastNameCyr);
            $firstNameLat = $this->transliterate($firstNameCyr);
            $middleNameLat = $this->transliterate($middleNameCyr);

            // Выбираем случайные предметы для преподавания (от 1 до 3)
            $selectedSubjects = $faker->randomElements($teachingSubjects, $faker->numberBetween(1, 3));

            DB::table('application_forms')->insert([
                // Личные данные (кириллица)
                'last_name_cyrillic' => $lastNameCyr,
                'first_name_cyrillic' => $firstNameCyr,
                'middle_name_cyrillic' => $middleNameCyr,
                
                // Личные данные (латиница)
                'last_name_latin' => $lastNameLat,
                'first_name_latin' => $firstNameLat,
                'middle_name_latin' => $middleNameLat,
                
                // Гражданство
                'is_foreign_citizen' => $isForeign,
                
                // Контактная информация
                'email' => $faker->unique()->safeEmail,
                'phone' => $faker->phoneNumber,
                
                // Образование и работа
                'course_direction' => $faker->randomElement(['IT', 'Педагогика', 'Медицина', 'Экономика', 'Юриспруденция']),
                'workplace' => $faker->company,
                'country_id' => $faker->randomElement($countryIds),
                'city_id' => $faker->randomElement($cityIds),
                'institution_category' => $faker->randomElement($institutionCategories),
                'other_institution_type' => $faker->randomElement($institutionCategories) === 'other' ? $faker->company : null,
                'academic_degree' => $faker->randomElement($academicDegrees),
                'position' => $faker->randomElement($positions),
                'teaching_subjects' => json_encode($selectedSubjects),
                
                // Курс и даты
                'course_id' => $faker->randomElement($courseIds),
                'specialty_id' => $faker->randomElement($specialtyIds),
                'course_language' => $faker->randomElement($languageIds),
                'seminar_start_date' => $faker->dateTimeBetween('+1 month', '+6 months')->format('Y-m-d'),
                'seminar_end_date' => $faker->dateTimeBetween('+6 months', '+12 months')->format('Y-m-d'),
                
                // Статус заявки
                'status' => $faker->randomElement(['pending', 'approved', 'rejected']),
                'notes' => $faker->optional(0.3)->text(200),
                
                'created_at' => $faker->dateTimeBetween('-6 months', 'now'),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('Тестовые заявки успешно созданы!');
    }

    /**
     * Простая транслитерация кириллицы в латиницу
     */
    private function transliterate($string)
    {
        $converter = [
            'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd',
            'е' => 'e', 'ё' => 'e', 'ж' => 'zh', 'з' => 'z', 'и' => 'i',
            'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n',
            'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't',
            'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch',
            'ш' => 'sh', 'щ' => 'sch', 'ь' => '', 'ы' => 'y', 'ъ' => '',
            'э' => 'e', 'ю' => 'yu', 'я' => 'ya',
            
            'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D',
            'Е' => 'E', 'Ё' => 'E', 'Ж' => 'Zh', 'З' => 'Z', 'И' => 'I',
            'Й' => 'Y', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N',
            'О' => 'O', 'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T',
            'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C', 'Ч' => 'Ch',
            'Ш' => 'Sh', 'Щ' => 'Sch', 'Ь' => '', 'Ы' => 'Y', 'Ъ' => '',
            'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya'
        ];
        
        return strtr($string, $converter);
    }
}
