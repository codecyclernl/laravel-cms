<?php

namespace Codecycler\Cms\Commands;

use Illuminate\Console\Command;

class CmsCommand extends Command
{
    public $signature = 'theme:create';

    public $description = 'Creates initial theme files';

    public function handle(): int
    {
        if (file_exists(resource_path('theme/theme.yml'))) {
            $this->error('Theme already active');
        }

        //
        $this->makeThemeYaml();


        $this->comment('All done!');

        return self::SUCCESS;
    }

    public function makeThemeYaml()
    {
        $contents = file_get_contents(__DIR__.'../theme.yml.stub');

        $contents = str_replace('$NAME', $this->name, $contents);
    }
}
