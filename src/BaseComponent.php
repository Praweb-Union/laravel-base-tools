<?php

namespace Praweb\BaseTools;

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

    // Количество объектов на страницу
    protected const PER_PAGE = 10;

    // Базовый запрос в бд для всех объектов. Как правило, Model::all() но можно добавить условия
    protected Builder $query;

    // Модель для круда
    public Model $object;

    // Флаг для модального окна. Один как для создания, так и для редактирования
    public bool $isModalOpened = false;

    public Collection $fields;

    public function mount(): void
    {
        $this->object = new ($this->getModel());

        if (property_exists($this, 'search')) {
            $this->search = '';
        }

        if (property_exists($this, 'sort')) {
            $this->sort = Collection::empty();
        }

        $this->setUpFields();
    }

    public function render()
    {
        $this->query = $this->getModel()::query();

        return view('livewire.category', [
            'objects' => $this
                ->search()
                ->sort()
                ->query->paginate(self::PER_PAGE)
        ]);
    }

    public function openModal(int $id = null): void
    {
        $this->object = $id ? $this->getModel()::findOrFail($id) : new ($this->getModel())();
        $this->isModalOpened = true;
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
        $this->isModalOpened = false;
        $this->object = new ($this->getModel());
    }

    public static function sortDirection(Collection $sort, string $column): string|null
    {
        return $sort->get('column') === $column ? $sort->get('direction') : null;
    }

    public function rules()
    {
        $fields = collect();

        foreach ($this->fields as $field) {
            $fields->put('object.' . $field->getField(), $field->getValidation());
        }

        return $fields->toArray();
    }

    public function hydrate()
    {
        foreach ($this->fields as $key => $field) {
            $this->fields->put(
                $key,
                new Field($field['field'], $field['columnName'], InputType::from($field['type']), $field['validation'])
            );
        }
    }

    // Возвращаем класс модели
    abstract protected function getModel(): string;

    abstract protected function setUpFields(): void;
}
