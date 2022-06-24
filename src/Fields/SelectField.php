<?php

namespace Praweb\BaseTools\Fields;

use Illuminate\View\ComponentAttributeBag;

class SelectField extends Field
{
    public function __construct(string $field, string $columnName, string $validation, string $showInTableClassName, array $data = [])
    {
        parent::__construct($field, $columnName, $validation, $showInTableClassName, $data);

        if(!\Arr::get($data, 'options') || !is_array(\Arr::get($data, 'options'))) {
            throw new \LogicException('Нужно добавить параметры в select');
        }
    }

    public function render()
    {
        return view('praweb::components.input.select',
            [
                'attributes' => new ComponentAttributeBag(
                    [
                        'label' => $this->getColumnName(),
                        'wire:model.defer' => $this->getField(),
                    ]
                ),
                'options' => \Arr::get($this->data, 'options')
            ]);
    }
}
