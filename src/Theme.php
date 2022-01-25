<?php

namespace Codecycler\Cms;

use Filament\Forms\Components\Builder\Block;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class Theme
{
    protected array $config;

    protected array $blocks = [];

    public function __construct(array $config)
    {
        $this->config = $config;

        // Register the options
        $filesystem = app(Filesystem::class);

        $this->blocks = collect($filesystem->allFiles(app_path('Theme/Blocks')))->map(function ($file): string {
            return Str::of('Theme/Blocks')->append('\\', $file->getRelativePathname())
                ->replace(['/', '.php'], ['\\', '']);
        })->toArray();
    }

    public function getBlockOptions(): array
    {
        $schema = [];

        foreach ($this->blocks as $blockOption) {
            $className = 'App\\' . $blockOption;
            $block = new $className();

            $schema[] = Block::make($block->name)->schema(
                $block->getSchema()
            );
        }

        return $schema;
    }
}