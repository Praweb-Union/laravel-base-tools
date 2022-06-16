<?php

namespace Praweb\BaseTools\Interfaces;

interface FieldInterface
{
    public function getFieldType(): string;

    public function render();
}
