<?php

namespace App\Http\Livewire\Admin\Attribute;


use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AdminAttribute extends Component
{
    public function mount(){

    }

    public function render()
    {
        return view('livewire.admin.attribute.admin-attribute')
            ->extends('admin_end.include.master_dash')
            ->section('dash_main_content')
            ->with(['categories' => DB::table('categories')
                ->where('has_specifications','=',1)
                ->paginate(10)]);
    }
}
