<?php

namespace Praweb\BaseTools\Fields;

use Illuminate\View\ComponentAttributeBag;

class TextareaField extends Field
{
    public function render()
    {
        return view(
            'praweb::components.input.textarea',
            [
                'attributes' => new ComponentAttributeBag(
                    [
                        'label' => $this->getColumnName(),
                        'wire:model.defer' => $this->getField(),
                    ]
                )
            ]
        );
    }
}
