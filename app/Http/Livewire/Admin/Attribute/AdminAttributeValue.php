<?php

namespace App\Http\Livewire\Admin\Attribute;

use Livewire\Component;

class AdminAttributeValue extends Component
{
    public function render()
    {
        return view('livewire.admin.attribute.admin-attribute-value')
            ->extends('admin_end.include.master_dash')
            ->section('dash_main_content')
            ->with([]);
    }
}
