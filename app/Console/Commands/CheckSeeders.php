<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CheckSeeders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seeders:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Проверка работы сидеров - подсчет записей в основных таблицах';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('=== Проверка работы сидеров ===');
        $this->newLine();

        // Проверяем подключение к базе данных
        try {
            DB::connection()->getPdo();
            $this->info('✅ Подключение к базе данных успешно');
        } catch (\Exception $e) {
            $this->error('❌ Ошибка подключения к базе данных: ' . $e->getMessage());
            return 1;
        }

        $this->newLine();
        $this->info('=== Проверка таблиц ===');

        // Проверяем основные таблицы
        $tables = [
            'admins' => 1,
            'countries' => 50,
            'cities' => 200,
            'faculties' => 8,
            'specializations' => 40,
            'education_languages' => 8,
            'users' => 100,
            'courses' => 60,
            'applications' => 100,
            'application_forms' => 50,
        ];

        $allTablesOk = true;
        foreach ($tables as $table => $expectedMin) {
            if (!$this->checkTable($table, $expectedMin)) {
                $allTablesOk = false;
            }
        }

        $this->newLine();
        $this->info('=== Результат проверки ===');

        if ($allTablesOk) {
            $this->info('🎉 Все сидеры работают корректно!');
            $this->info('База данных заполнена тестовыми данными.');
        } else {
            $this->warn('⚠️  Некоторые сидеры могут работать некорректно.');
            $this->info('Попробуйте запустить: php artisan db:seed');
        }

        $this->newLine();
        $this->info('=== Полезные команды ===');
        $this->line('Запуск всех сидеров: php artisan db:seed');
        $this->line('Сброс и перезапуск: php artisan migrate:fresh --seed');
        $this->line('Очистка кэша: php artisan cache:clear');
        $this->line('Очистка конфига: php artisan config:clear');

        $this->newLine();
        $this->info('=== Тестовые пользователи ===');
        $this->line('Админ: admin@gmail.com / 1234');
        $this->line('Тестовый пользователь: ivan.petrov@example.com / password');

        return 0;
    }

    /**
     * Проверяет количество записей в таблице
     */
    private function checkTable(string $tableName, int $expectedMin = 1): bool
    {
        try {
            $count = DB::table($tableName)->count();
            
            if ($count >= $expectedMin) {
                $this->info("✅ Таблица '$tableName': $count записей");
                return true;
            } else {
                $this->warn("⚠️  Таблица '$tableName': $count записей (ожидалось минимум $expectedMin)");
                return false;
            }
        } catch (\Exception $e) {
            $this->error("❌ Ошибка проверки таблицы '$tableName': " . $e->getMessage());
            return false;
        }
    }
}
