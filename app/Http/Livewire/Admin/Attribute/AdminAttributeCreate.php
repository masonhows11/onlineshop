<?php

namespace App\Http\Livewire\Admin\Attribute;

use Livewire\Component;

class AdminAttributeCreate extends Component
{
    public $category;

    public function mount($category){

    }
    public function render()
    {
        return view('livewire.admin.attribute.admin-attribute-create')
            ->extends('admin_end.include.master_dash')
            ->section('dash_main_content')
            ->with(['' => ]);
    }
}
