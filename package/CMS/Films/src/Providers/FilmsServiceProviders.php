<?php

namespace CMS\Films\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\Helpers;
class FilmsServiceProviders extends ServiceProvider
{
    use Helpers;
    public function boot(){
        $this->loadRoutesFrom(__DIR__."/../../routes/web.php");
        $this->loadRoutesFrom(__DIR__."/../../routes/api.php");
    }
    public function register(){


        $configs = $this->split_files_with_basename($this->app['files']->glob(__DIR__ . '/../../config/*.php'));
        foreach ($configs as $key => $row) {
            $this->mergeConfigFrom($row, $key);
        }
    }
}
