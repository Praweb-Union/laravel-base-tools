<?php

namespace Praweb\BaseTools;

use Illuminate\Support\Collection;

abstract class BaseObjectsListComponent extends \Livewire\Component
{
    abstract public function mount();

    public Collection $objects;
}
