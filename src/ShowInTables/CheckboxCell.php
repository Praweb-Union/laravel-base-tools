<?php

namespace Praweb\BaseTools\ShowInTables;

use Illuminate\View\View;
use Praweb\BaseTools\Interfaces\ShowInTable;

class CheckboxCell implements ShowInTable
{
    public static function render(mixed $value, array $data = []): string|View|null
    {
        return view('components.check-icon', ['value' => $value]);
    }
}
