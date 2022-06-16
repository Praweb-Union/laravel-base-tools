<?php

namespace Praweb\BaseTools\Fields;

use Illuminate\View\ComponentAttributeBag;

class CheckBoxField extends Field
{
    public function render()
    {
        return view(
            'components.input.checkbox',
            [
                'attributes' => new ComponentAttributeBag(
                    [
                        'type' => $this->getFieldType(),
                        'label' => $this->getColumnName(),
                        'wire:model.defer' => $this->getField()
                    ]
                )
            ]
        );
    }
}
