<?php

namespace App\Http\Livewire\Admin\CreateProduct;

use App\Models\Attribute;
use App\Models\AttributeProduct;
use App\Models\AttributeValue;
use App\Models\Product;
use Livewire\Component;

class EditProductSpecifications extends Component
{
    ////
    public $product_id;
    public $attribute_product_id;
    ////
    public $product;
    public $attributes;
    ////
    public $product_attribute;
    public $selectedAttributeType;
    public $attributeDefaultValues = null;
    ////
    public $name;
    public $priority;
    public $values;
    public $value=[];
    public $type;

    public function mount($product_id,$attribute_product_id)
    {
        ////
        $this->product_id = $product_id;
        $this->attribute_product_id  = $attribute_product_id;
        ////
        $this->product = Product::where('id', $this->product_id)
            ->select('id', 'category_attribute_id', 'title_persian')
            ->first();
        ////
        $this->attributes = Attribute::where('category_id',$this->product->category_attribute_id)
            ->get();
        ////
        $this->product_attribute = AttributeProduct::where('id',$this->attribute_product_id)
            ->first();




        // fill input with current value
        $this->name = $this->product_attribute->attribute_id;
        $this->priority = $this->product_attribute->priority;


        // fill the value input wire model base on attribute type
        $this->type = $this->product_attribute->type;
        switch ($this->type) {
            case 'select':
                $this->selectedAttributeType = 'select';
                $this->attributeDefaultValues =
                    AttributeValue::where('attribute_id', $this->name)->select('id','value')->get();
                $this->value = json_decode($this->product_attribute->values)->id;
                break;
            case 'multi_select':
                $this->selectedAttributeType = 'multi_select';
                $this->attributeDefaultValues =
                AttributeValue::where('attribute_id', $this->name)->select('id','value')->get();
                foreach ($this->product_attribute->values as $item){
                    array_push($this->value,$item['id']);
                }
                break;
            case 'text_area':
                $this->selectedAttributeType = 'text_area';
                $this->value = $this->product_attribute->values;
                break;
            case 'text_box':
                $this->selectedAttributeType = 'text_box';
                $this->value =$this->product_attribute->values;
                break;
        }


    }

    public function save()
    {

    }

    public function render()
    {
        return view('livewire.admin.create-product.edit-product-specifications')
            ->extends('admin_end.include.master_dash')
            ->section('dash_main_content');
    }
}
