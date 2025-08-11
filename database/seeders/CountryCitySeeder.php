<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CountryCitySeeder extends Seeder
{
    public function run(): void
    {
        // Отключаем FK (MySQL)
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Чистим таблицы так, чтобы сбросить автоинкременты
        DB::table('cities')->truncate();
        DB::table('states')->truncate();
        DB::table('countries')->truncate();

        // Включаем FK назад
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Узнаем, какие колонки реально есть
        $hasCode   = Schema::hasColumn('countries', 'code');
        $hasStatus = Schema::hasColumn('countries', 'status');

        // Справочник стран (можешь дополнить кодами ISO2 при наличии колонки code)
        $countries = [
            ['name' => 'Казахстан',       'code' => 'KZ'],
            ['name' => 'Россия',          'code' => 'RU'],
            ['name' => 'Узбекистан',      'code' => 'UZ'],
            ['name' => 'Кыргызстан',      'code' => 'KG'],
            ['name' => 'Таджикистан',     'code' => 'TJ'],
            ['name' => 'Туркменистан',    'code' => 'TM'],
            ['name' => 'Азербайджан',     'code' => 'AZ'],
            ['name' => 'Армения',         'code' => 'AM'],
            ['name' => 'Грузия',          'code' => 'GE'],
            ['name' => 'Молдова',         'code' => 'MD'],
            ['name' => 'Украина',         'code' => 'UA'],
            ['name' => 'Беларусь',        'code' => 'BY'],
            ['name' => 'США',             'code' => 'US'],
            ['name' => 'Великобритания',  'code' => 'GB'],
            ['name' => 'Германия',        'code' => 'DE'],
            ['name' => 'Франция',         'code' => 'FR'],
            ['name' => 'Италия',          'code' => 'IT'],
            ['name' => 'Испания',         'code' => 'ES'],
            ['name' => 'Китай',           'code' => 'CN'],
            ['name' => 'Япония',          'code' => 'JP'],
            ['name' => 'Южная Корея',     'code' => 'KR'],
            ['name' => 'Индия',           'code' => 'IN'],
            ['name' => 'Турция',          'code' => 'TR'],
            ['name' => 'Иран',            'code' => 'IR'],
            ['name' => 'Египет',          'code' => 'EG'],
            ['name' => 'Марокко',         'code' => 'MA'],
            ['name' => 'Тунис',           'code' => 'TN'],
            ['name' => 'Алжир',           'code' => 'DZ'],
            ['name' => 'Ливия',           'code' => 'LY'],
            ['name' => 'Судан',           'code' => 'SD'],
            ['name' => 'Эфиопия',         'code' => 'ET'],
            ['name' => 'Кения',           'code' => 'KE'],
            ['name' => 'Нигерия',         'code' => 'NG'],
            ['name' => 'ЮАР',             'code' => 'ZA'],
            ['name' => 'Бразилия',        'code' => 'BR'],
            ['name' => 'Аргентина',       'code' => 'AR'],
            ['name' => 'Чили',            'code' => 'CL'],
            ['name' => 'Перу',            'code' => 'PE'],
            ['name' => 'Колумбия',        'code' => 'CO'],
            ['name' => 'Венесуэла',       'code' => 'VE'],
            ['name' => 'Мексика',         'code' => 'MX'],
            ['name' => 'Канада',          'code' => 'CA'],
            ['name' => 'Австралия',       'code' => 'AU'],
            ['name' => 'Новая Зеландия',  'code' => 'NZ'],
        ];

        // Вставляем страны, учитывая реальные колонки
        foreach ($countries as $c) {
            $row = [
                'name'       => $c['name'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
            if ($hasCode)   $row['code']   = $c['code']; // вставляем только если колонка есть
            if ($hasStatus) $row['status'] = 1;

            DB::table('countries')->insert($row);
        }

        // Получаем карту имя страны -> id
        $countryIdByName = DB::table('countries')->pluck('id', 'name'); // Collection: name => id

        // Создаем состояния для каждой страны
        $stateRows = [];
        foreach ($countries as $country) {
            $countryId = $countryIdByName[$country['name']] ?? null;
            if ($countryId) {
                $stateRows[] = [
                    'name' => $country['name'] . ' State',
                    'country_id' => $countryId,
                    'status' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Вставляем состояния
        if (!empty($stateRows)) {
            DB::table('states')->insert($stateRows);
        }

        // Получаем карту имя страны -> state_id
        $stateIdByCountryName = [];
        foreach ($countries as $country) {
            $countryId = $countryIdByName[$country['name']] ?? null;
            if ($countryId) {
                $state = DB::table('states')->where('country_id', $countryId)->first();
                if ($state) {
                    $stateIdByCountryName[$country['name']] = $state->id;
                }
            }
        }

        // Города (связываем по названию страны, а не по фикс. id)
        $cities = [
            // Казахстан
            ['name' => 'Астана', 'country' => 'Казахстан'],
            ['name' => 'Алматы', 'country' => 'Казахстан'],
            ['name' => 'Шымкент', 'country' => 'Казахстан'],
            // Россия
            ['name' => 'Москва', 'country' => 'Россия'],
            ['name' => 'Санкт-Петербург', 'country' => 'Россия'],
            // США
            ['name' => 'Нью-Йорк', 'country' => 'США'],
            ['name' => 'Лос-Анджелес', 'country' => 'США'],
            ['name' => 'Чикаго', 'country' => 'США'],
            // Великобритания
            ['name' => 'Лондон', 'country' => 'Великобритания'],
            ['name' => 'Манчестер', 'country' => 'Великобритания'],
            // Германия
            ['name' => 'Берлин', 'country' => 'Германия'],
            ['name' => 'Мюнхен', 'country' => 'Германия'],
            // Франция
            ['name' => 'Париж', 'country' => 'Франция'],
            ['name' => 'Марсель', 'country' => 'Франция'],
            // Италия
            ['name' => 'Рим', 'country' => 'Италия'],
            ['name' => 'Милан', 'country' => 'Италия'],
            // Испания
            ['name' => 'Мадрид', 'country' => 'Испания'],
            ['name' => 'Барселона', 'country' => 'Испания'],
        ];

        // Готовим партии для вставки
        $cityRows = [];
        foreach ($cities as $city) {
            $countryId = $countryIdByName[$city['country']] ?? null;
            $stateId = $stateIdByCountryName[$city['country']] ?? null;
            
            if (!$countryId || !$stateId) {
                continue;
            }
            
            $cityRows[] = [
                'name'       => $city['name'],
                'country_id' => $countryId,
                'state_id'   => $stateId,
                'status'     => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Вставляем города
        if (!empty($cityRows)) {
            DB::table('cities')->insert($cityRows);
        }

        $this->command->info('Страны, состояния и города успешно заполнены!');
    }
}
