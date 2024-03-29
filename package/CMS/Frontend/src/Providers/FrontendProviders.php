<?php

namespace CMS\Frontend\Providers;

use App\Helpers\Helpers;
use CMS\Frontend\Repository\FrontendInterface;
use CMS\Frontend\Repository\FrontendRepository;
use Illuminate\Support\ServiceProvider;


class  FrontendProviders  extends ServiceProvider
{
    use Helpers;
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . "/../../routes/web.php");
        $this->loadRoutesFrom(__DIR__ . "/../../routes/api.php");
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'product');
    }
    public function register()
    {
        $configs = $this->split_files_with_basename($this->app['files']->glob(__DIR__ . '/../../config/*.php'));
        foreach ($configs as $key => $row) {
            $this->mergeConfigFrom($row, $key);
        }
        $repository = [
            [
                'ỉnterface' => FrontendInterface::class,
                'binding'   => FrontendRepository::class,
            ]
        ];
        foreach ($repository as $bind) {
            $this->app->bind($bind['ỉnterface'], $bind['binding']);
        }
    }
}