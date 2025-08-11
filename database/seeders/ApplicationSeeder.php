<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Очищаем таблицу перед заполнением
        DB::table('applications')->truncate();

        $faker = Faker::create('ru_RU');

        // Получаем существующие ID для связей
        $userIds = DB::table('users')->pluck('id')->toArray();
        $courseIds = DB::table('courses')->pluck('id')->toArray();
        $specializationIds = DB::table('specializations')->pluck('id')->toArray();
        $languageCodes = DB::table('education_languages')->pluck('code')->toArray();

        // Категории работодателей
        $employerCategories = ['vuz', 'school', 'college', 'other'];
        
        // Статусы заявок
        $statuses = ['draft', 'submitted', 'in_review', 'approved', 'rejected'];

        // Создаем 100 тестовых заявок
        for ($i = 0; $i < 100; $i++) {
            $isForeign = $faker->boolean(25); // 25% иностранных граждан
            
            // Генерируем имена на кириллице и латинице
            $fullNameCyr = $faker->name;
            $fullNameLat = $this->transliterate($fullNameCyr);

            // Выбираем случайные предметы для преподавания
            $taughtSubjects = $faker->randomElements([
                'Математика', 'Физика', 'Химия', 'Биология', 'История',
                'Литература', 'Русский язык', 'Английский язык', 'Информатика',
                'География', 'Обществознание', 'Экономика', 'Право', 'Психология'
            ], $faker->numberBetween(1, 4));

            // Выбираем случайную страну и город
            $country = $faker->randomElement(['Казахстан', 'Россия', 'Узбекистан', 'Кыргызстан', 'США', 'Германия', 'Франция']);
            $city = $faker->randomElement(['Астана', 'Москва', 'Ташкент', 'Бишкек', 'Нью-Йорк', 'Берлин', 'Париж']);

            DB::table('applications')->insert([
                'id' => Str::uuid(),
                'user_id' => $faker->randomElement($userIds),
                'full_name_cyr' => $fullNameCyr,
                'full_name_lat' => $fullNameLat,
                'is_foreign_citizen' => $isForeign,
                'desired_track_id' => $faker->optional(0.8)->randomElement($courseIds),
                'employer_country' => $country,
                'employer_city' => $city,
                'employer_category' => $faker->randomElement($employerCategories),
                'degree' => $faker->randomElement([
                    'Бакалавр', 'Магистр', 'Доктор наук', 'Кандидат наук', 
                    'Специалист', 'Аспирант', 'Доцент', 'Профессор'
                ]),
                'position' => $faker->randomElement([
                    'Преподаватель', 'Старший преподаватель', 'Доцент', 'Профессор',
                    'Заведующий кафедрой', 'Декан', 'Ректор', 'Учитель',
                    'Директор школы', 'Заместитель директора'
                ]),
                'specialty' => $faker->randomElement([
                    'Информационные технологии', 'Педагогика', 'Медицина', 
                    'Экономика', 'Юриспруденция', 'Инженерия', 'Гуманитарные науки'
                ]),
                'taught_subjects' => implode(', ', $taughtSubjects),
                'contact_email' => $faker->unique()->safeEmail,
                'contact_phone' => $faker->phoneNumber,
                'desired_course_text' => $faker->optional(0.7)->sentence(10),
                'specialization_id' => $faker->optional(0.6)->randomElement($specializationIds),
                'seminar_date_from' => $faker->dateTimeBetween('+1 month', '+6 months')->format('Y-m-d'),
                'seminar_date_to' => $faker->dateTimeBetween('+6 months', '+12 months')->format('Y-m-d'),
                'study_language' => $faker->randomElement($languageCodes),
                'login' => $faker->optional(0.5)->userName,
                'status' => $faker->randomElement($statuses),
                'created_at' => $faker->dateTimeBetween('-6 months', 'now'),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('Тестовые заявки (applications) успешно созданы!');
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
