<?php

namespace Praweb\BaseTools\ShowInTables;

use Illuminate\View\View;
use Praweb\BaseTools\Interfaces\ShowInTable;

class EmptyCell implements ShowInTable
{

    public static function render(mixed $value, array $data = []): string|View|null
    {
        return null;
    }
}
