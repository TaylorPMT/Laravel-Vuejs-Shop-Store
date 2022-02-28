<?php

namespace CMS\Page\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\Helpers;
use CMS\Page\Repository\BlockRepository;
use CMS\Page\Repository\BlockRepositoryInterface;
use Shortcode;
use CMS\Page\Repository\Shortcode\BlockSingleShortCode;

class PageProviders extends ServiceProvider
{
    use Helpers;


    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . "/../../routes/web.php");
        $this->loadRoutesFrom(__DIR__ . "/../../routes/api.php");
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'page');
    }

    public function register()
    {
        $configs = $this->split_files_with_basename($this->app['files']->glob(__DIR__ . '/../../config/*.php'));
        foreach ($configs as $key => $row) {
            $this->mergeConfigFrom($row, $key);
        }
        $repository = [
            [
                'interface' => BlockRepositoryInterface::class,
                'binding'   => BlockRepository::class,
            ],
        ];
        Shortcode::register(BlockSingleShortCode::short_code_name, BlockSingleShortCode::class);

        foreach ($repository as $bind) {
            $this->app->bind($bind['interface'], $bind['binding']);
        }
    }
}
