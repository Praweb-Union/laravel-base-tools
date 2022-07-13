<?php

namespace Praweb\BaseTools\Fields;

class FileField extends InputWithTypeField
{
    public function getFieldType(): string
    {
        return 'file';
    }
}
