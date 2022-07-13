<?php

namespace Praweb\BaseTools\Traits;

trait WithSearch
{
    public string $search;

    public function search(): static
    {
        if ($this->search === '') {
            return $this;
        }

        $this->query = $this->query->where($this::getSearchColumn(), 'like', '%' . $this->search . '%');

        return $this;
    }

    // Реализуем и возвращаем имя поля модели, по которой будет идти поиск
    public static function getSearchColumn(): ?string
    {
        return null;
    }
}
