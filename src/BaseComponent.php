<?php

namespace Praweb\BaseTools;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;
use Praweb\BaseTools\Traits\WithSearch;
use Praweb\BaseTools\Traits\WithSort;

abstract class BaseComponent extends Component
{
    use WithPagination;
    use WithSearch;
    use WithSort;

    // Базовый запрос в бд для всех объектов. Как правило, Model::all() но можно добавить условия
    protected Builder $query;

    // Модель для круда
    public Model $object;

    // Флаг для модального окна. Один как для создания, так и для редактирования
    public bool $isModalOpened = false;

    public Collection $fields;

    protected bool $withPaginate = true;
    protected bool $withSort = true;
    protected bool $withSearch = true;

    public function mount(): void
    {
        $this->object = new ($this->getModel())();

        if (property_exists($this, 'search')) {
            $this->search = '';
        }

        if (property_exists($this, 'sort')) {
            $this->sort = Collection::empty();
        }

        $this->setUpFields();
    }

    public function render(): Factory|View|Application
    {
        $this->query = $this->getModel()::query();

        if($this->withSearch) {
            $this->search();
        }

        if($this->withSort) {
            $this->sort();
        }

        if($this->withPaginate) {
            $objects = $this->query->paginate($this->perPage());
        } else {
            $objects = $this->query->get();
        }

        $this->checkForErrors();

        return view('livewire.crud', [
            'objects' => $objects,
            'withPaginate' => $this->withPaginate,
        ]);
    }

    public function openModal(int $id = null): void
    {
        $this->object = $id ? $this->getModel()::findOrFail($id) : new ($this->getModel())();
        $this->isModalOpened = true;
        $this->resetErrorBag();
    }

    public function create(): void
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
        $this->isModalOpened = false;
        $this->object = new ($this->getModel())();
    }

    public static function sortDirection(Collection $sort, string $column): string|null
    {
        return $sort->get('column') === $column ? $sort->get('direction') : null;
    }

    public function rules(): array
    {
        $fields = collect();

        foreach ($this->fields as $field) {
            $fields->put('object.' . $field->getField(), $field->getValidation());
        }

        return $fields->toArray();
    }

    public function hydrate(): void
    {
        foreach ($this->fields as $key => $field) {
            $this->fields->put(
                $key,
                new $field['className'](
                    $field['field'],
                    $field['columnName'],
                    $field['validation'],
                    $field['showInTableClassName']
                )
            );
        }
    }

    protected function perPage(): int
    {
        return 10;
    }

    // Возвращаем класс модели
    abstract protected function getModel(): string;

    abstract protected function setUpFields(): void;
}
