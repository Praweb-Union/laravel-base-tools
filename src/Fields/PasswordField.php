<?php

namespace Praweb\BaseTools\Fields;

class PasswordField extends Field
{
    public function getFieldType(): string
    {
        return 'password';
    }
}
