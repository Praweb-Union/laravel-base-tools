<?php

namespace Praweb\BaseTools;

use Illuminate\Database\Eloquent\Model;

abstract class BaseComponent extends \Livewire\Component
{
    public Model $object;

    public function mount($id = null): void
    {
        $this->object = $id ? $this->getModel()::findOrFail($id) : new $this->getModel();
    }

    public function create(): void
    {
        $this->validate();
        $this->getModel()::create($this->getModelAttributes());
    }

    public function update(int $id): void
    {
        $this->validate();
        $this->object->save();
    }

    public function delete(): void
    {
        $this->object->delete();
        $this->emit('render');
    }

    abstract protected function getModelAttributes(): array;

    abstract protected function getModel(): string;
}
