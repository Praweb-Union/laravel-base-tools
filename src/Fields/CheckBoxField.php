<?php

namespace Praweb\BaseTools\Fields;

use Illuminate\View\ComponentAttributeBag;

class CheckBoxField extends Field
{
    public function render()
    {
        return view(
            'praweb::components.input.checkbox',
            [
                'attributes' => new ComponentAttributeBag(
                    [
                        'label' => $this->getColumnName(),
                        'wire:model.defer' => $this->getField()
                    ]
                )
            ]
        );
    }
}
