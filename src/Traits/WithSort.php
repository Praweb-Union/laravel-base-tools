<?php

namespace Praweb\BaseTools\Traits;

use Illuminate\Contracts\Pagination\LengthAwarePaginator as IPaginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

use function array_key_exists;

trait WithSort
{
    /** @var \Illuminate\Support\Collection{column: string, direction: string, custom: bool} */
    public Collection $sort;

    public function updateSort(string $column): void
    {
        if ($this->sort->isEmpty() || $column !== $this->sort->get('column')) {
            $this->sort = Collection::make(
                [
                    'column' => $column,
                    'direction' => 'asc',
                    'custom' => !array_key_exists(
                        $column,
                        array_merge(
                            $this->object->getAttributes(),
                            $this->attributesThatDontContainsInModelButDontCustom()
                        )
                    )
                ]
            );

            return;
        }

        if ($this->sort->get('direction') === 'asc') {
            $this->sort->put('direction', 'desc');
            return;
        }

        $this->sort = Collection::empty();
    }

    public function sort(): static
    {
        if ($this->sort->isNotEmpty() && !$this->sort->get('custom')) {
            $this->query = $this->query->orderBy($this->sort->get('column'), $this->sort->get('direction'));
        }
        session(['direction' => $this->sort->get('direction')]);
        return $this;
    }

    public function sortByCustomAttributes(IPaginator $iPaginator): LengthAwarePaginator
    {
        $paginator = new LengthAwarePaginator($iPaginator->items(), $iPaginator->total(), $iPaginator->perPage());

        $collection = collect($paginator->all());
        if ($this->sort->get('custom') === true) {
            $collection = $collection
                ->{$this->sort->get('direction') === 'asc' ? 'sortBy' : 'sortByDesc'}(
                    $this->sort->get('column')
                );
        }

        return new LengthAwarePaginator($collection, $paginator->total(), $paginator->perPage());
    }

    /** @return array<string, int> */
    private function attributesThatDontContainsInModelButDontCustom(): array
    {
        return array_flip(['id', 'created_at', 'updated_at']);
    }
}
