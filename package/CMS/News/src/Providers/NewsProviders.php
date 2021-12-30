<?php

namespace CMS\News\Providers;

use App\Helpers\Helpers;
use CMS\News\Repository\NewRepository;
use CMS\News\Repository\NewRepositoryInterface;
use CMS\News\Repository\NewsDetailRepository;
use Illuminate\Support\ServiceProvider;

class NewsProviders extends ServiceProvider
{
    use Helpers;


    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . "/../../routes/web.php");
        $this->loadRoutesFrom(__DIR__ . "/../../routes/api.php");
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'news');
    }

    public function register()
    {
        $configs = $this->split_files_with_basename($this->app['files']->glob(__DIR__ . '/../../config/*.php'));
        foreach ($configs as $key => $row) {
            $this->mergeConfigFrom($row, $key);
        }
        $repository = [
            [
                'ỉnterface' => NewRepositoryInterface::class,
                'binding'   => NewRepository::class,
            ],
            [
                'ỉnterface' => NewRepositoryInterface::class,
                'binding'   => NewsDetailRepository::class,
            ]
        ];
        foreach ($repository as $bind) {
            $this->app->bind($bind['ỉnterface'], $bind['binding']);
        }
    }
}