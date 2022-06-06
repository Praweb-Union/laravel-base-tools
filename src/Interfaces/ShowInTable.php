<?php

namespace Praweb\BaseTools\Interfaces;

use Illuminate\View\View;

interface ShowInTable
{
    public static function render(mixed $value): string|View|null;
}
