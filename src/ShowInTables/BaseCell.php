<?php

namespace Praweb\BaseTools\ShowInTables;

use Illuminate\View\View;
use Praweb\BaseTools\Interfaces\ShowInTable;

class BaseCell implements ShowInTable
{
    public static function render(mixed $value, array $data = []): string|View|null
    {
        return $value;
    }
}
