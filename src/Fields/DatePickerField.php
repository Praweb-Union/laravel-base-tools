<?php

namespace Praweb\BaseTools\Fields;

use Illuminate\View\ComponentAttributeBag;

class DatePickerField extends Field
{
    public function render()
    {
        return view(
            'praweb::components.input.datepicker',
            [
                'attributes' => new ComponentAttributeBag(
                    [
                        'label' => $this->getColumnName(),
                        'wire:model.defer' => 'object.' . $this->getField(),
                    ]
                )
            ]
        );
    }
}