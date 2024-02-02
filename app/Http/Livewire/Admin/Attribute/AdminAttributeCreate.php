<?php

namespace App\Http\Livewire\Admin\Attribute;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AdminAttributeCreate extends Component
{
    public $category;
    public $category_id;

    public function mount($category){

        $this->category_id = $category;
    }
    public function render()
    {
        return view('livewire.admin.attribute.admin-attribute-create')
            ->extends('admin_end.include.master_dash')
            ->section('dash_main_content')
            ->with(['attributes' => DB::table('attributes')
                ->where('category_id',$this->category_id)->get() ]);
    }
}
