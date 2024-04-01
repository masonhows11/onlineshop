<?php

namespace App\Http\Livewire\Admin\CreateProduct;

use App\Models\Attribute;
use App\Models\AttributeProduct;
use App\Models\AttributeValue;
use App\Models\Product;
use Livewire\Component;

class EditProductSpecifications extends Component
{
    // public $attr_ids = [];
    // public $attributes;
    // public $product_id;
    // public $attribute_product_id;


    ////
    public $product;
    public $attribute_name;
    ////
    public $product_attribute;
    public $selectedAttributeType;
    public $attributeDefaultValues = null;
    ////
    public $name;
    public $priority;
    public $values;
    public $value = [];
    public $type;

    public function mount($product_id, $attribute_product_id)
    {

        // $this->attributes = Attribute::where('category_id', $this->product->category_attribute_id)->get();
        //  $this->product_id = $product_id;
        // $this->attribute_product_id = $attribute_product_id;

        ////
        $this->product = Product::where('id', $product_id)
            ->select('id', 'category_attribute_id', 'title_persian')
            ->first();
        ////
        $this->product_attribute = AttributeProduct::where('id', $attribute_product_id)
            ->first();
        // fill input with current value
        $this->attribute_name = Attribute::where('id', $this->product_attribute->attribute_id)
            ->select('name')
            ->first();
        ////
        $this->name = $this->product_attribute->attribute_id;
        $this->priority = $this->product_attribute->priority;
        // fill the value input wire model base on attribute type
        $this->type = $this->product_attribute->type;
        switch ($this->type) {
            case 'select':
                $this->selectedAttributeType = 'select';
                $this->attributeDefaultValues =
                    AttributeValue::where('attribute_id', $this->name)->select('id', 'value')->get();
                $this->value = json_decode($this->product_attribute->values)->id;
                break;
            case 'multi_select':
                $this->selectedAttributeType = 'multi_select';
                $this->attributeDefaultValues =
                    AttributeValue::where('attribute_id', $this->name)->select('id', 'value')->get();
                foreach (json_decode($this->product_attribute->values, true) as $item) {
                    array_push($this->value, $item['id']);
                }
                break;
            case 'text_area':
                $this->selectedAttributeType = 'text_area';
                $this->value = json_decode($this->product_attribute->values)->value;
                break;
            case 'text_box':
                $this->selectedAttributeType = 'text_box';
                $this->value = json_decode($this->product_attribute->values)->value;
                break;
        }
    }


    public function rules()
    {
        return [
            'name' => ['required'],
            'type' => ['required'],
            'priority' => ['required'],
            'value' => $this->type == 'text_box' || 'text_area' ? 'required|string|min:1|max:255' : 'required',
        ];
    }

    public function save()
    {
        $this->validate();

        switch ($this->type) {
            case 'select':
                $this->values = AttributeValue::where('attribute_id', $this->name)
                    ->where('id', $this->value)->select('id', 'value')
                    ->first();
                $this->values = json_encode(['id' => $this->values->id, 'value' => $this->values->value]);

                AttributeProduct::where('id', $this->attribute_product_id)->update([
                    'product_id' => $this->product_id,
                    'attribute_id' => $this->name,
                    'values' => $this->values,
                    'priority' => $this->priority,
                    'type' => $this->type,
                ]);
                $this->name = null;
                $this->value = null;
                $this->priority = null;
                break;
            case 'multi_select':
                $this->values = AttributeValue::where('attribute_id', $this->name)
                    ->whereIn('id', $this->value)->select('id', 'value')
                    ->get();
                $this->values = $this->values->map(function ($item) {
                    return ['id' => $item['id'], 'value' => $item['value']];
                });

                AttributeProduct::where('id', $this->attribute_product_id)->update([
                    'product_id' => $this->product_id,
                    'values' => $this->values,
                    'attribute_id' => $this->name,
                    'priority' => $this->priority,
                    'type' => $this->type,
                ]);
                $this->name = null;
                $this->value = null;
                $this->priority = null;
                break;
            case 'text_box':
            case 'text_area':
                $this->values = json_encode(['value' => $this->value]);
                AttributeProduct::where('id', $this->attribute_product_id)->update([
                    'product_id' => $this->product_id,
                    'values' => $this->values,
                    'attribute_id' => $this->name,
                    'priority' => $this->priority,
                    'type' => $this->type,
                ]);
                $this->name = null;
                $this->value = null;
                $this->priority = null;
                break;
        }
        session()->flash('success', __('messages.The_update_was_completed_successfully'));
        return redirect()->route('admin.product.create.specifications', ['product' => $this->product_id]);

    }

    //// for set again style after component refresh
    // $this->emit('valueSelect');
    protected $listeners = ['valueSelect' => 'setStyle'];

    public function setStyle()
    {

        // dd($this->attr_ids);
        $this->emit('resetSelect');
    }

    public function render()
    {

        return view('livewire.admin.create-product.edit-product-specifications')
            ->extends('admin_end.include.master_dash')
            ->section('dash_main_content')->with(['attr_name' => $this->attribute_name]);
    }
}
