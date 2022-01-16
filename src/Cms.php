<?php

namespace Codecycler\Cms;

use Codecycler\Cms\Exceptions\ThemeException;
use Symfony\Component\Yaml\Yaml;

class Cms
{
    protected string $configFilePath;

    public Theme $theme;

    public function __construct()
    {
        $this->configFilePath = resource_path('theme/theme.yml');

        // Bootstrap CMS
        $this->getThemeConfig();
    }

    public function getThemeConfig(): void
    {
        if (file_exists($this->configFilePath)) {
            $config = Yaml::parseFile($this->configFilePath);

            $this->theme = new Theme($config);
        } else {
            throw new ThemeException('No theme.yml config file found');
        }
    }
}
