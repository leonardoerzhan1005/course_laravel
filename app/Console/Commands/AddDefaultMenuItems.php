<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AddDefaultMenuItems extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'menu:add-default-items';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add default menu items to navigation menu';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Adding default menu items...');
        
        // Получаем ID навигационного меню
        $navMenu = DB::table('menus')->where('slug', 'nav-menu')->first();
        
        if (!$navMenu) {
            $this->error('Navigation menu not found!');
            return;
        }
        
        // Стандартные пункты меню
        $defaultItems = [
            [
                'label' => 'Home',
                'link' => '/',
                'translations' => [
                    'en' => 'Home',
                    'ru' => 'Главная',
                    'kk' => 'Басты бет',
                    'ar' => 'الرئيسية',
                    'hi' => 'होम',
                ]
            ],
            [
                'label' => 'Courses',
                'link' => '/courses',
                'translations' => [
                    'en' => 'Courses',
                    'ru' => 'Курсы',
                    'kk' => 'Курстар',
                    'ar' => 'الدورات',
                    'hi' => 'पाठ्यक्रम',
                ]
            ],
            [
                'label' => 'Blog',
                'link' => '/blog',
                'translations' => [
                    'en' => 'Blog',
                    'ru' => 'Блог',
                    'kk' => 'Блог',
                    'ar' => 'المدونة',
                    'hi' => 'ब्लॉग',
                ]
            ],
            [
                'label' => 'About Us',
                'link' => '/about-us',
                'translations' => [
                    'en' => 'About Us',
                    'ru' => 'О нас',
                    'kk' => 'Біз туралы',
                    'ar' => 'من نحن',
                    'hi' => 'हमारे बारे में',
                ]
            ],
            [
                'label' => 'Contact',
                'link' => '/contact',
                'translations' => [
                    'en' => 'Contact',
                    'ru' => 'Контакты',
                    'kk' => 'Байланыс',
                    'ar' => 'اتصل بنا',
                    'hi' => 'संपर्क',
                ]
            ],
            [
                'label' => 'All Instructors',
                'link' => '/all-instructors',
                'translations' => [
                    'en' => 'All Instructors',
                    'ru' => 'Все преподаватели',
                    'kk' => 'Барлық оқытушылар',
                    'ar' => 'جميع المدربين',
                    'hi' => 'सभी प्रशिक्षक',
                ]
            ],
        ];
        
        $sortOrder = 1;
        
        foreach ($defaultItems as $item) {
            // Проверяем, есть ли уже такой пункт меню
            $existingMenuItem = DB::table('menu_items')
                ->where('link', $item['link'])
                ->first();
                
            if ($existingMenuItem) {
                $this->warn("Menu item '{$item['label']}' already exists, skipping...");
                continue;
            }
            
            // Получаем следующий доступный ID для пункта меню
            $nextMenuItemId = DB::table('menu_items')->max('id') + 1;
            
            // Добавляем пункт меню
            DB::table('menu_items')->insert([
                'id' => $nextMenuItemId,
                'label' => $item['label'],
                'link' => $item['link'],
                'parent_id' => 0,
                'sort' => $sortOrder,
                'class' => '',
                'menu_id' => $navMenu->id,
                'depth' => 0,
                'role_id' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            // Добавляем переводы для пункта меню
            foreach ($item['translations'] as $langCode => $translation) {
                DB::table('menu_item_translations')->insert([
                    'menu_item_id' => $nextMenuItemId,
                    'lang_code' => $langCode,
                    'label' => $translation,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            
            $this->info("Added menu item: {$item['label']} (ID: {$nextMenuItemId})");
            $sortOrder++;
        }
        
        $this->info('Default menu items added successfully!');
    }
}
