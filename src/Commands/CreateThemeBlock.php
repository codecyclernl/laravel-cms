<?php

namespace Codecycler\Cms\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

class CreateThemeBlock extends GeneratorCommand
{
    protected $name = 'make:theme-block';

    protected $description = 'Creates a theme block.';

    protected $type = 'ThemeBlock';

    protected function replaceClass($stub, $name): string
    {
        $stub = parent::replaceClass($stub, $name);

        //
        $text = str_replace('BlockType', $this->argument('name'), $stub);

        return str_replace('TYPE', strtolower($this->argument('name')), $text);
    }

    protected function getStub(): string
    {
        return $this->resolveStubPath('/stubs/theme-block.stub');
    }

    protected function resolveStubPath($stub): string
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
            ? $customPath
            : __DIR__.$stub;
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Theme\Blocks';
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the class'],
        ];
    }
}