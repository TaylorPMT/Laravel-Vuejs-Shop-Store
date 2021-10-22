<?php

namespace CMS\Category\Providers;

use App\Helpers\Helpers;
use Illuminate\Support\ServiceProvider;
use CMS\Category\Repository\CategoryInterface;
use CMS\Category\Repository\CategoryRepository;

class  CategoryProviders  extends ServiceProvider
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
                'ỉnterface' => CategoryInterface::class,
                'binding'   => CategoryRepository::class,
            ]
        ];
        foreach ($repository as $bind) {
            $this->app->bind($bind['ỉnterface'], $bind['binding']);
        }
    }
}
