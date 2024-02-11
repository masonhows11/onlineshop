<?php

namespace App\Http\Livewire\Admin\CreateProduct;

use App\Models\Product;
use Livewire\Component;

class EditProductSpecifications extends Component
{
    public $product_id;
    public $product;
    public $attribute;

    public function mount($product,$attribute)
    {
        $this->product_id = $product;
        $this->product = Product::where('id', $product)
            ->select('id', 'category_attribute_id', 'title_persian')
            ->first();
    }

    public function render()
    {
        return view('livewire.admin.create-product.edit-product-specifications')
            ->extends('admin_end.include.master_dash')
            ->section('dash_main_content');
    }
}
