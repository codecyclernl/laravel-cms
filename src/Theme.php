<?php

namespace Codecycler\Cms;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class Theme
{
    protected array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function getBlockOptions(): array
    {
        $schema = [];

        $blocks = $this->config['blocks'];

        foreach ($blocks as $key => $block) {
            $schema[] = Block::make($key)->schema(
                $this->getBlockForm($block['fields'])
            );
        }

        return $schema;
    }

    protected function getBlockForm(array $fields): array
    {
        $formFields = [];

        foreach ($fields as $name => $fieldConfig) {
            $formFields[] = match ($fieldConfig['type']) {
                'text' => TextInput::make($name),
                'textarea' => Textarea::make($name),
                'markdown' => MarkdownEditor::make($name),
            };
        }

        return $formFields;
    }
}