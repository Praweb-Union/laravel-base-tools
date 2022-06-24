<?php

namespace Praweb\BaseTools\Fields;

use Illuminate\View\ComponentAttributeBag;
use Illuminate\View\View;

abstract class InputWithTypeField extends Field
{
    protected string $inputType;

    abstract public function getFieldType(): string;

    public function render(): View
    {
        return \view('praweb::components.input.text', [
            'attributes' => new ComponentAttributeBag(
                [
                    'type' => $this->getFieldType(),
                    'label' => $this->getColumnName(),
                    'wire:model.defer' => $this->getField()
                ]
            )
        ]);
    }
}
