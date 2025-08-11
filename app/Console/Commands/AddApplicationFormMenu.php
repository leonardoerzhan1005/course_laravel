<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AddApplicationFormMenu extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'menu:add-application-form';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add Application Form menu item to navigation menu';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Adding Application Form menu item...');
        
        // Проверяем, есть ли уже пункт меню для анкеты
        $existingMenuItem = DB::table('menu_items')
            ->where('link', '/application-form')
            ->first();
            
        if ($existingMenuItem) {
            $this->warn('Application Form menu item already exists!');
            return;
        }
        
        // Получаем ID навигационного меню
        $navMenu = DB::table('menus')->where('slug', 'nav-menu')->first();
        
        if (!$navMenu) {
            $this->error('Navigation menu not found!');
            return;
        }
        
        // Получаем следующий доступный ID для пункта меню
        $nextMenuItemId = DB::table('menu_items')->max('id') + 1;
        $nextSortOrder = DB::table('menu_items')->where('menu_id', $navMenu->id)->max('sort') + 1;
        
        // Добавляем пункт меню "Application Form"
        DB::table('menu_items')->insert([
            'id' => $nextMenuItemId,
            'label' => 'Application Form',
            'link' => '/application-form',
            'parent_id' => 0,
            'sort' => $nextSortOrder,
            'class' => '',
            'menu_id' => $navMenu->id,
            'depth' => 0,
            'role_id' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        // Добавляем переводы для пункта меню
        $languages = ['en', 'ru', 'kk', 'ar', 'hi'];
        $translations = [
            'en' => 'Application Form',
            'ru' => 'Анкета регистрации',
            'kk' => 'Бағдарлама тіркеу анкетасы',
            'ar' => 'نموذج التسجيل',
            'hi' => 'आवेदन पत्र',
        ];
        
        foreach ($languages as $langCode) {
            if (isset($translations[$langCode])) {
                DB::table('menu_item_translations')->insert([
                    'menu_item_id' => $nextMenuItemId,
                    'lang_code' => $langCode,
                    'label' => $translations[$langCode],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
        
        $this->info('Application Form menu item added successfully!');
        $this->info('Menu item ID: ' . $nextMenuItemId);
        $this->info('Sort order: ' . $nextSortOrder);
    }
}
