<?php

namespace Praweb\BaseTools\Fields;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\View\View;
use Praweb\BaseTools\Interfaces\FieldInterface;

abstract class Field implements FieldInterface, Arrayable
{
    private string $field;
    private string $columnName;
    private string $validation;
    private string $className;
    private string $showInTableClassName;


    /**
     * @param string $field
     * @param string $columnName
     * @param string $validation
     * @param string $showInTableClassName
     */
    public function __construct(string $field, string $columnName, string $validation, string $showInTableClassName)
    {
        $this->field = $field;
        $this->columnName = $columnName;
        $this->validation = $validation;
        $this->className = get_class($this);
        $this->showInTableClassName = $showInTableClassName;
    }

    /**
     * @return string
     */
    public function getField(): string
    {
        if($this instanceof FileField) {
            return $this->field;
        } elseif(!str_contains($this->field, 'object.')) {
            return 'object.' . $this->field;
        } else {
            return $this->field;
        }
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

    /**
     * @return string
     */
    public function getClassName(): string
    {
        return $this->className;
    }

    /**
     * @return string
     */
    public function getShowInTableClassName(): string
    {
        return $this->showInTableClassName;
    }

    /**
     * @param string $showInTableClassName
     */
    public function setShowInTableClassName(string $showInTableClassName): void
    {
        $this->showInTableClassName = $showInTableClassName;
    }


    public function toArray(): array
    {
        return [
            'field' => $this->getField(),
            'columnName' => $this->getColumnName(),
            'validation' => $this->getValidation(),
            'className' => $this->getClassName(),
            'showInTableClassName' => $this->getShowInTableClassName(),
        ];
    }

    abstract public function render();

    abstract public function getFieldType(): string;
}
