<?php

namespace Modules\SiteAppearance\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if section_settings table exists and is empty
        if (DB::getSchemaBuilder()->hasTable('section_settings')) {
            $count = DB::table('section_settings')->count();
            
            if ($count === 0) {
                DB::table('section_settings')->insert([
                    'hero_section' => 1,
                    'top_category_section' => 1,
                    'brands_section' => 1,
                    'about_section' => 1,
                    'featured_course_section' => 1,
                    'news_letter_section' => 1,
                    'featured_instructor_section' => 1,
                    'counter_section' => 1,
                    'faq_section' => 1,
                    'our_features_section' => 1,
                    'testimonial_section' => 1,
                    'banner_section' => 1,
                    'latest_blog_section' => 1,
                    'blog_page' => 1,
                    'about_page' => 1,
                    'contact_page' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
