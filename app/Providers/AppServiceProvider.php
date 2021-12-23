<?php

namespace App\Providers;

use App\Libraries\Shortcode\Providers\ShortcodesServiceProvider;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use App\Libraries\Shortcode\Facades\Shortcode;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->register(ShortcodesServiceProvider::class);

        $loader = AliasLoader::getInstance();
        $loader->alias('Shortcode', Shortcode::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //



    }
}
