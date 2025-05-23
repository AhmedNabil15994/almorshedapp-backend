<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use languages;
use Setting;

class LocalesServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        config([
          'translatable.locales' => Setting::get('locales'),

          'laravellocalization.supportedLocales' => languages::supported(Setting::get('locales')),

          'laravellocalization.useAcceptLanguageHeader' => false,

          'laravellocalization.hideDefaultLocaleInURL' => false,

          'app.locale'      => Setting::get('default_locales'),

        ]);
    }
}
