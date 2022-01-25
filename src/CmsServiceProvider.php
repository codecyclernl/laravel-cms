<?php

namespace Codecycler\Cms;

use Codecycler\Cms\Commands\CreateThemeBlock;
use Route;
use Schema;
use Codecycler\Cms\Models\Page;
use Filament\PluginServiceProvider;
use Codecycler\Cms\Resources\PageResource;

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

        $pages = Page::all();

        foreach($pages as $page) {
            Route::get($page->url, function () use ($page) {
                return view('theme/page', [
                    'page' => $page,
                ]);
            });
        }
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
