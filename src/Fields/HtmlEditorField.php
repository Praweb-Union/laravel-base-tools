<?php

namespace Praweb\BaseTools\Fields;

use Illuminate\View\ComponentAttributeBag;

class HtmlEditorField extends Field
{

    public function render()
    {
        return view(
            'praweb::components.input.html-editor',
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
