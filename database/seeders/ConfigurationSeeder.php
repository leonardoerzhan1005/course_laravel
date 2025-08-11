<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Проверяем, существует ли таблица configurations
        if (!DB::getSchemaBuilder()->hasTable('configurations')) {
            $this->command->info('Таблица configurations не существует. Создайте её сначала.');
            return;
        }

        // Добавляем необходимые записи для завершения установки
        $configurations = [
            [
                'config' => 'setup_complete',
                'value' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'config' => 'setup_stage',
                'value' => '5', // 5 означает завершение установки
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        foreach ($configurations as $config) {
            // Проверяем, существует ли уже запись
            $exists = DB::table('configurations')
                ->where('config', $config['config'])
                ->exists();

            if (!$exists) {
                DB::table('configurations')->insert($config);
                $this->command->info("Добавлена конфигурация: {$config['config']} = {$config['value']}");
            } else {
                // Обновляем существующую запись
                DB::table('configurations')
                    ->where('config', $config['config'])
                    ->update(['value' => $config['value'], 'updated_at' => now()]);
                $this->command->info("Обновлена конфигурация: {$config['config']} = {$config['value']}");
            }
        }

        $this->command->info('Конфигурации установки успешно обновлены!');
    }
}
