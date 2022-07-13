<?php

namespace Praweb\BaseTools\ShowInTables;

use Illuminate\View\View;

class ShowByIdCell implements \Praweb\BaseTools\Interfaces\ShowInTable
{

    public static function render(mixed $value, array $data = []): string|View|null
    {
        return \Arr::get($data, 'modelName')::findOrFail($value)->{\Arr::get($data, 'showField')};
    }
}
