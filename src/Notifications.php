<?php

namespace Praweb\BaseTools;

use Livewire\Component;
use Spatie\Activitylog\Models\Activity;

class Notifications extends Component
{
    public function render()
    {
        return view('praweb::livewire.notifications', ['notifications' => Activity::orderBy('id', 'DESC')->get()]);
    }
}
