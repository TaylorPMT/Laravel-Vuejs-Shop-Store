<?php

namespace CMS\Menu\Providers;

use App\Helpers\Helpers;
use CMS\Menu\Repository\MenuInterface;
use CMS\Menu\Repository\MenuRepository;
use Illuminate\Support\ServiceProvider;


class  MenuProviders  extends ServiceProvider
{
    use Helpers;
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . "/../../routes/web.php");
        $this->loadRoutesFrom(__DIR__ . "/../../routes/api.php");
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'category');
    }
    public function register()
    {


        $configs = $this->split_files_with_basename($this->app['files']->glob(__DIR__ . '/../../config/*.php'));
        foreach ($configs as $key => $row) {
            $this->mergeConfigFrom($row, $key);
        }
        $repository = [
            [
                'ỉnterface' => MenuInterface::class,
                'binding'   => MenuRepository::class,
            ]
        ];
        foreach ($repository as $bind) {
            $this->app->bind($bind['ỉnterface'], $bind['binding']);
        }
    }
}