<?php

namespace Codecycler\Cms\Resources\PageResource\Pages;

use Codecycler\Cms\Resources\PageResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePage extends CreateRecord
{
    protected static string $resource = PageResource::class;

    protected static ?string $title = null;
}
