<?php

namespace App\Http\Livewire\Admin\Attribute;

use Livewire\Component;

class AdminAttribute extends Component
{
    public function render()
    {
        return view('livewire.admin.attribute.admin-attribute')
            ->extends('admin_end.include.master_dash')
            ->section('dash_main_content')
            ->with([]);
    }
}
