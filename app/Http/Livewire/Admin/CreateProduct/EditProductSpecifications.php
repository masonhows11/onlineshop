<?php

namespace App\Http\Livewire\Admin\CreateProduct;

use App\Models\Attribute;
use App\Models\AttributeProduct;
use App\Models\Product;
use Livewire\Component;

class EditProductSpecifications extends Component
{
    public $product_id;
    public $product;
    public $attribute;
    public $attributes;
    public $product_attribute;

    public function mount($product,$attribute)
    {
        $this->product_id = $product;
        $this->attribute  = $attribute;
        $this->product = Product::where('id', $product)
            ->select('id', 'category_attribute_id', 'title_persian')
            ->first();
        $this->product_attribute = AttributeProduct::where('id',$this->attribute)->first();
        $this->attributes = Attribute::where('id',$this->attribute)->where('category_id', $this->product->category_attribute_id)
            ->first();
        dd($this->product_attribute);
    }

    public function save(){

    }

    public function edit(){

    }
    public function render()
    {
        return view('livewire.admin.create-product.edit-product-specifications')
            ->extends('admin_end.include.master_dash')
            ->section('dash_main_content');
    }
}
