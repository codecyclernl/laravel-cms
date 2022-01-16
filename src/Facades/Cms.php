<?php

namespace Codecycler\Cms\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Codecycler\Cms\Cms
 */
class Cms extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-cms';
    }
}
