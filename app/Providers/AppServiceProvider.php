<?php

namespace App\Providers;

use App\Enums\ThemeList;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Modules\GlobalSetting\app\Models\MarketingSetting;
use Modules\GlobalSetting\app\Models\SeoSetting;
use Modules\GlobalSetting\app\Models\Setting;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     */
    public function register(): void {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {
        try {
            /** Cache settings */
            $setting = Cache::rememberForever('setting', fn() => (object) Setting::pluck('value', 'key')->all());
            $marketing_setting = Cache::rememberForever('marketing_setting', fn() => (object) MarketingSetting::pluck('value', 'key')->all());
            $seo_setting = Cache::rememberForever('seo_setting', fn() => SeoSetting::all()->groupBy('page_name')->mapWithKeys(function ($group, $pageName) {
                $firstItem = $group->first();
                return [$pageName => [
                    'seo_title' => $firstItem->seo_title ?? '',
                    'seo_description' => $firstItem->seo_description ?? '',
                    'seo_keywords' => $firstItem->seo_keywords ?? '',
                ]];
            })->toArray());

            if ($setting) {
                set_wasabi_config();
                set_aws_config();
            }
        } catch (\Throwable $th) {
            info($th);
            $setting = (object) ['timezone' => config('app.timezone'), 'site_theme' => ThemeList::MAIN->value];
            $marketing_setting = (object) [];
            $seo_setting = [];
        }

        // Ensure seo_setting is always an array and provide default values if empty
        if (empty($seo_setting) || !is_array($seo_setting)) {
            $seo_setting = [
                'home_page' => ['seo_title' => '', 'seo_description' => '', 'seo_keywords' => ''],
                'about_page' => ['seo_title' => '', 'seo_description' => '', 'seo_keywords' => ''],
                'course_page' => ['seo_title' => '', 'seo_description' => '', 'seo_keywords' => ''],
                'blog_page' => ['seo_title' => '', 'seo_description' => '', 'seo_keywords' => ''],
                'contact_page' => ['seo_title' => '', 'seo_description' => '', 'seo_keywords' => ''],
            ];
        }

        // Ensure all required keys exist with proper array structure
        $requiredKeys = ['home_page', 'about_page', 'course_page', 'blog_page', 'contact_page'];
        foreach ($requiredKeys as $key) {
            if (!isset($seo_setting[$key]) || !is_array($seo_setting[$key])) {
                $seo_setting[$key] = ['seo_title' => '', 'seo_description' => '', 'seo_keywords' => ''];
            } else {
                // Ensure each key has the required sub-keys and they are strings, not objects
                $seo_setting[$key] = array_merge([
                    'seo_title' => '',
                    'seo_description' => '',
                    'seo_keywords' => ''
                ], array_map(function($value) {
                    // Convert any objects to strings to prevent type errors
                    return is_object($value) ? (string) $value : $value;
                }, $seo_setting[$key]));
            }
        }

        /** Share settings to all views */
        View::composer('*', function ($view) use ($setting, $marketing_setting, $seo_setting) {
            // Get footer menu data with fallbacks
            $footer_menu_one = null;
            $footer_menu_two = null;
            $footer_menu_three = null;
            
            try {
                if (function_exists('menu_get_by_slug')) {
                    $footer_menu_one = menu_get_by_slug('footer-col-one');
                    $footer_menu_two = menu_get_by_slug('footer-col-two-1PiTN');
                    $footer_menu_three = menu_get_by_slug('footer-col-three');
                }
            } catch (\Throwable $th) {
                info('Error getting footer menus: ' . $th->getMessage());
            }
            
            $view->with([
                'setting' => $setting, 
                'marketing_setting' => $marketing_setting, 
                'seo_setting' => $seo_setting,
                'footer_menu_one' => $footer_menu_one,
                'footer_menu_two' => $footer_menu_two,
                'footer_menu_three' => $footer_menu_three
            ]);
        });

        // set timezone
        date_default_timezone_set($setting->timezone ?? config('app.timezone'));

        /** Register custom blade directives */
        $this->registerBladeDirectives();

        // Use Bootstrap 4 pagination
        Paginator::useBootstrapFour();

        // Define default homepage based on site_theme from setting, with fallback
         if (!defined('DEFAULT_HOMEPAGE')) {
    define('DEFAULT_HOMEPAGE', $setting?->site_theme ?? ThemeList::MAIN->value);
}

        // Add safety check for views to prevent UrlGenerator objects from being passed
        Blade::directive('safeContent', function ($expression) {
            return "<?php echo is_string($expression) ? $expression : (string)($expression ?? ''); ?>";
        });
        
        // Add error handling for common view data issues
        View::composer('*', function ($view) {
            $data = $view->getData();
            foreach ($data as $key => $value) {
                if (is_object($value) && get_class($value) === 'Illuminate\Routing\UrlGenerator') {
                    \Log::error('UrlGenerator object found in view data', [
                        'key' => $key,
                        'view' => $view->getName(),
                        'trace' => debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 5)
                    ]);
                    // Replace with empty string to prevent errors
                    $view->with($key, '');
                }
            }
        });
    }

    protected function registerBladeDirectives() {
        Blade::directive('adminCan', function ($permission) {
            return "<?php if(auth()->guard('admin')->user()->can({$permission})): ?>";
        });

        Blade::directive('endadminCan', function () {
            return '<?php endif; ?>';
        });

        // Blade directive for checking the current theme
        Blade::directive('theme', function ($themes) {
            return "<?php if(in_array(DEFAULT_HOMEPAGE, {$themes})): ?>";
        });

        Blade::directive('endtheme', function () {
            return '<?php endif; ?>';
        });
    }
}
