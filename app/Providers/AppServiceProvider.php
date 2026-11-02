<?php

namespace App\Providers;

use App\Models\Contact;
use App\Models\HomeSetting;
use App\Models\PpdbSetting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        require_once app_path('helpers.php');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Enforce HTTPS in production or when APP_URL is configured with https
        if ($this->app->environment('production') || str_starts_with((string) config('app.url', ''), 'https://')) {
            URL::forceScheme('https');
        }
        // Share primary contact, site setting, and PPDB setting globally (memoized per-request)
        View::composer('*', function ($view) {
            static $primaryContact = null;
            static $allContacts = null;
            static $siteSetting = null;
            static $ppdbSetting = null;
            static $resolved = false;

            if (! $resolved) {
                try {
                    if (Schema::hasTable('contacts')) {
                        $primaryContact = Contact::where('is_active', true)
                            ->orderBy('is_primary', 'desc')
                            ->first();
                        $allContacts = Contact::where('is_active', true)
                            ->orderBy('is_primary', 'desc')
                            ->get();
                    }

                    if (Schema::hasTable('home_settings')) {
                        $siteSetting = HomeSetting::first();
                    }

                    if (Schema::hasTable('ppdb_settings')) {
                        $ppdbSetting = PpdbSetting::first();
                    }
                } catch (\Throwable $e) {
                    $primaryContact = null;
                    $allContacts = collect();
                    $siteSetting = null;
                    $ppdbSetting = null;
                }
                $resolved = true;
            }

            $view->with([
                'contact' => $primaryContact,
                'allContacts' => $allContacts ?? collect(),
                'siteSetting' => $siteSetting,
                'homeSetting' => $siteSetting,
                'ppdbSetting' => $ppdbSetting,
            ]);
        });
    }
}
