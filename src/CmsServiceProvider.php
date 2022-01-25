<?php

namespace Codecycler\Cms;

use Filament\PluginServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Codecycler\Cms\Resources\PageResource;
use Codecycler\Cms\Commands\CreateThemeBlock;
use Codecycler\Cms\Http\Controllers\CmsController;

class CmsServiceProvider extends PluginServiceProvider
{
    public static string $name = 'filament-cms';

    protected function getResources(): array
    {
        return [
            PageResource::class,
        ];
    }

    public function bootingPackage()
    {
        if (!Schema::hasTable('cms_pages')) {
            return;
        }

        Route::fallback([CmsController::class, 'run']);
    }

    public function packageConfigured($package): void
    {
        $package
            ->hasMigration('create_cms_pages_table')
            ->hasCommand(CreateThemeBlock::class);
    }

    public function registeringPackage()
    {
        $this->app->singleton('cms', function () {
            return new Cms();
        });
    }
}
