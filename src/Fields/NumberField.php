<?php

namespace Praweb\BaseTools\Fields;

class NumberField extends InputWithTypeField
{
    public function getFieldType(): string
    {
        return 'number';
    }
}
