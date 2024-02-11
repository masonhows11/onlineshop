<?php

namespace App\Http\Livewire\Admin\CreateProduct;

use Livewire\Component;

class EditProductSpecifications extends Component
{
    public function render()
    {
        return view('livewire.admin.create-product.edit-product-specifications')
            ->extends('admin_end.include.master_dash')
            ->section('dash_main_content');
    }
}
