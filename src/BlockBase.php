<?php

namespace Codecycler\Cms;

use Livewire\Component;

class BlockBase extends Component
{
    public string $name;

    public string $label;

    public function getSchema(): array
    {
        return [];
    }

    public function render()
    {
        return view('theme.blocks.' . $this->name);
    }
}