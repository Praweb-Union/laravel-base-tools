<?php

namespace Praweb\BaseTools\Fields;

class TextField extends InputWithTypeField
{
    public function getFieldType(): string
    {
        return 'text';
    }
}
