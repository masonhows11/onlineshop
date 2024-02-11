<?php

namespace App\Http\Livewire\Admin\CreateProduct;

use App\Models\Attribute;
use App\Models\AttributeProduct;
use App\Models\AttributeValue;
use App\Models\Product;
use Livewire\Component;

class EditProductSpecifications extends Component
{
    public $product_id;
    public $product;
    public $attribute;
    public $attributes;
    public $attribute_values;
    public $product_attribute;


    public $name;
    public $priority;
    public $values;

    public function mount($product,$attribute)
    {
        $this->product_id = $product;
        $this->attribute  = $attribute;
        $this->product = Product::where('id', $product)
            ->select('id', 'category_attribute_id', 'title_persian')
            ->first();
        $this->attributes = Attribute::where('category_id',$this->product->category_attribute_id)
            ->get();
        $this->product_attribute = AttributeProduct::where('id',$this->attribute)
            ->first();
        $this->attribute_values = AttributeValue::where('attribute_id',$this->product_attribute->attribute_id)
            ->get();


        // fill input with old value
        $this->name = $this->product_attribute->attribute_id;
        $this->priority = $this->product_attribute->priority;

    }

    public function save(){

    }

    public function render()
    {
        return view('livewire.admin.create-product.edit-product-specifications')
            ->extends('admin_end.include.master_dash')
            ->section('dash_main_content');
    }
}
