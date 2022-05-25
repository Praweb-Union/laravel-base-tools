<?php

namespace Praweb\BaseTools;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Livewire\Component;

abstract class BaseComponent extends Component
{
    public Model $object;
    public Collection $objects;

    public bool $isCreateModalOpened = false;

    public function openCreateModal(): void
    {
        $this->object = new ($this->getModel())();
        $this->isCreateModalOpened = true;
        $this->resetErrorBag();
    }

    public function create()
    {
        $this->validate();
        $this->object->save();
        $this->closeAllModals();
    }

    public function update(int $id): void
    {
        $this->validate();
        $this->object->save();
    }

    public function delete(int $id): void
    {
        $this->getModel()::findOrFail($id)->delete();
    }

    public function closeAllModals(): void
    {
        $this->isCreateModalOpened = false;
    }

    abstract protected function getModelAttributes(): array;

    abstract protected function getModel(): string;
}
