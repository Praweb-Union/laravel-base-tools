<?php

namespace Praweb\BaseTools;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Praweb\BaseTools\Exceptions\MultipleFieldsException;
use Praweb\BaseTools\Fields\Field;
use Praweb\BaseTools\Fields\FileField;
use Praweb\BaseTools\Traits\WithSearch;
use Praweb\BaseTools\Traits\WithSort;

abstract class BaseComponent extends Component
{
    use WithPagination;
    use WithSearch;
    use WithSort;

    use WithFileUploads;
    use AuthorizesRequests;

    // Базовый запрос в бд для всех объектов. Как правило, Model::all() но можно добавить условия
    public Model $object;

    // Модель для круда
    public bool $isModalOpened = false;

    // Флаг для модального окна. Один как для создания, так и для редактирования
    public Collection $fields;
    protected Builder $query;
    protected bool $withPaginate = true;
    protected bool $withSort = true;
    protected bool $withSearch = true;

    protected $listeners = [
        'openModal'
    ];

    public static function sortDirection(Collection $sort, string $column): string|null
    {
        return $sort->get('column') === $column ? $sort->get('direction') : null;
    }

    public function mount(): void
    {
        $this->object = new ($this->getModel())();

        if (property_exists($this, 'search')) {
            $this->search = '';
        }

        if (property_exists($this, 'sort')) {
            $this->sort = Collection::empty();
        }

        $this->fields = collect();
        $this->setUpFields();
    }

    public function render()
    {
        $this->query = $this->getModel()::query();

        if ($this->withSearch) {
            $this->search();
        }

        if ($this->withSort) {
            $this->sort();
        }

        if ($this->withPaginate) {
            $objects = $this->query->paginate($this->perPage());
        } else {
            $objects = $this->query->get();
        }

        $this->checkForErrors();

        return view('praweb::livewire.crud', [
            'objects'      => $objects,
            'withPaginate' => $this->withPaginate,
        ]);
    }

    public function openModal(int $id = null, string $source = null): void
    {
        if (!$source || $source === str_replace('\\', '', get_class($this))) {
            $this->object = $id ? $this->getModel()::findOrFail($id) : new ($this->getModel())();
            $this->isModalOpened = true;
            $this->resetErrorBag();
        }
    }

    public function create(): void
    {
        $this->validate();
        $this->fields->filter(fn(Field $field) => $field instanceof FileField)
            ->each(function (FileField $field) {
                $this->{$field->getField()}->store($this->{$field->getField()}->getClientOriginalName());
                $this->object->{$field->getField()} = $this->{$field->getField()}->getClientOriginalName();
            });

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

    public function rules(): array
    {
        $fields = collect();

        foreach ($this->fields as $field) {
            $fields->put($field->getField(), $field->getValidation());
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
                    $field['showInTableClassName'],
                    $field['data'],
                )
            );
        }
    }

    protected function perPage(): int
    {
        return 10;
    }

    abstract protected function getModel(): string;

    // Возвращаем класс модели

    protected function setUpFields(): void
    {
    }

    private function checkForErrors()
    {
        $fields = collect(collect($this->fields)->transform(fn($item) => $item->toArray()))->pluck('field');

        if ($fields->count() !== $fields->unique()->count()) {
            throw new MultipleFieldsException('Обнаружено дублирование полей в компоненте');
        }
    }
}
