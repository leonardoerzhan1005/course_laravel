<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Очищаем таблицу перед заполнением (кроме админа)
        DB::table('users')->where('email', '!=', 'admin@gmail.com')->delete();

        $faker = Faker::create('ru_RU');

        // Создаем 100 тестовых пользователей
        for ($i = 0; $i < 100; $i++) {
            $firstName = $faker->firstName;
            $lastName = $faker->lastName;
            $fullName = $lastName . ' ' . $firstName;
            
            DB::table('users')->insert([
                'name' => $fullName,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => $faker->optional(0.8)->dateTimeBetween('-1 year', 'now'),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'phone' => $faker->phoneNumber,
                'image' => $faker->optional(0.3)->imageUrl(200, 200, 'people'),
                'wallet_balance' => $faker->optional(0.4)->randomFloat(2, 0, 10000),
                'created_at' => $faker->dateTimeBetween('-2 years', 'now'),
                'updated_at' => now(),
            ]);
        }

        // Создаем несколько специальных пользователей для тестирования
        $specialUsers = [
            [
                'name' => 'Иван Петров',
                'email' => 'ivan.petrov@example.com',
                'phone' => '+7 (999) 123-45-67',
                'wallet_balance' => 5000.00,
            ],
            [
                'name' => 'Мария Сидорова',
                'email' => 'maria.sidorova@example.com',
                'phone' => '+7 (999) 234-56-78',
                'wallet_balance' => 7500.00,
            ],
            [
                'name' => 'Алексей Козлов',
                'email' => 'alexey.kozlov@example.com',
                'phone' => '+7 (999) 345-67-89',
                'wallet_balance' => 3000.00,
            ],
            [
                'name' => 'Елена Волкова',
                'email' => 'elena.volkova@example.com',
                'phone' => '+7 (999) 456-78-90',
                'wallet_balance' => 12000.00,
            ],
            [
                'name' => 'Дмитрий Соколов',
                'email' => 'dmitry.sokolov@example.com',
                'phone' => '+7 (999) 567-89-01',
                'wallet_balance' => 8000.00,
            ],
        ];

        foreach ($specialUsers as $user) {
            if (!DB::table('users')->where('email', $user['email'])->exists()) {
                DB::table('users')->insert([
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'email_verified_at' => now(),
                    'password' => Hash::make('password'),
                    'remember_token' => Str::random(10),
                    'phone' => $user['phone'],
                    'image' => $faker->optional(0.5)->imageUrl(200, 200, 'people'),
                    'wallet_balance' => $user['wallet_balance'],
                    'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                    'updated_at' => now(),
                ]);
            }
        }

        $this->command->info('Тестовые пользователи успешно созданы!');
    }
}
