<?php

namespace Praweb\BaseTools\Fields;

class PasswordField extends InputWithTypeField
{
    public function getFieldType(): string
    {
        return 'password';
    }
}
