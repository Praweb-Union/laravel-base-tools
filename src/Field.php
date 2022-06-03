<?php

namespace Praweb\BaseTools;

use Illuminate\Contracts\Support\Arrayable;
use Praweb\BaseTools\Interfaces\FieldInterface;

enum InputType: string
{
    case text = 'text';
    case number = 'number';
    case checkbox = 'checkbox';
    case password = 'password';
}

class Field implements FieldInterface, Arrayable
{
    private string $field;
    private string $columnName;
    private InputType $type;
    private string $validation;

    /**
     * @param string $columnName
     * @param InputType $type
     * @param string $validation
     */
    public function __construct(string $field, string $columnName, InputType $type, string $validation)
    {
        $this->field = $field;
        $this->columnName = $columnName;
        $this->type = $type;
        $this->validation = $validation;
    }

    /**
     * @return string
     */
    public function getField(): string
    {
        return $this->field;
    }

    /**
     * @param string $field
     */
    public function setField(string $field): void
    {
        $this->field = $field;
    }

    /**
     * @return string
     */
    public function getColumnName(): string
    {
        return $this->columnName;
    }

    /**
     * @param string $columnName
     */
    public function setColumnName(string $columnName): void
    {
        $this->columnName = $columnName;
    }

    /**
     * @return InputType
     */
    public function getType(): InputType
    {
        return $this->type;
    }

    /**
     * @param InputType $type
     */
    public function setType(InputType $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getValidation(): string
    {
        return $this->validation;
    }

    /**
     * @param string $validation
     */
    public function setValidation(string $validation): void
    {
        $this->validation = $validation;
    }

    public function toArray()
    {
        return [
            'field' => $this->getField(),
            'columnName' => $this->getColumnName(),
            'type' => $this->getType(),
            'validation' => $this->getValidation()
        ];
    }

}
