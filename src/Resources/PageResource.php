<?php

namespace Codecycler\Cms\Resources;

use Codecycler\Cms\Models\Page;
use Codecycler\Cms\Resources\PageResource\Pages\CreatePage;
use Codecycler\Cms\Resources\PageResource\Pages\EditPage;
use Codecycler\Cms\Resources\PageResource\Pages\ListPages;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Columns\TextColumn;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'CMS';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()->schema([
                    Tabs::make('tabs')->tabs([
                        Tabs\Tab::make('Algemeen')->schema([
                            TextInput::make('title')->label('Titel')->required(),
                            TextInput::make('url')->label('Url')->required(),
                            Select::make('layout')->options([
                                'default' => 'default.blade.php',
                            ])->required(),

                            Builder::make('blocks')->blocks(
                                app('cms')->theme->getBlockOptions()
                            )->columnSpan(2),
                        ])->columns(2),
                        Tabs\Tab::make('SEO')->schema([
                            TextInput::make('meta_title'),
                            Textarea::make('meta_description'),
                        ]),
                    ])->columnSpan(4),
                ])->columns(4),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title'),
                TextColumn::make('url'),
            ])
            ->filters([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPages::route('/'),
            'create' => CreatePage::route('/create'),
            'edit' => EditPage::route('/{record}/edit'),
        ];
    }
}