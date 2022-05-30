<?php

namespace Praweb\BaseTools;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Livewire\Component;

abstract class BaseComponent extends Component
{
    // Количество объектов на страницу
    protected const PER_PAGE = 10;
    
    // Базовый запрос в бд для всех объектов. Как правило, Model::all() но можно добавить условия
    protected Builder $query;
    
    // Модель для круда
    public Model $object;

    // Флаг для модального окна. Один как для создания, так и для редактирования
    public bool $isModalOpened = false;

    public function mount(): void
    {
        // Инициализируем поля
        $this->object = new ($this->getModel());
        
        if (property_exists($this, 'search')) {
            $this->search = '';
        }

        if (property_exists($this, 'sort')) {
            $this->sort = Collection::empty();
        }
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
    
    // Возвращаем класс модели
    abstract protected function getModel(): string;

    // Наименования столбцов в таблице. Ключ - имя поля модели
    abstract public static function getColumnHeaders(): array;
}
