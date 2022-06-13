<?php

namespace Praweb\BaseTools\Fields;

use Illuminate\View\ComponentAttributeBag;

class DatePickerField extends Field
{

    public function render()
    {
        return view('components.input.datepicker',
            [
                'attributes' => new ComponentAttributeBag(
                    [
                        'label' => $this->getColumnName(),
                        'wire:model.defer' => 'object.' . $this->getField(),
                    ]
                )
            ]);
    }

    public function getFieldType(): string
    {
        return 'text';
    }
}