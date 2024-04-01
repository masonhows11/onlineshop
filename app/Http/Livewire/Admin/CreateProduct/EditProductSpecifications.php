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
    public $attribute_product_id;
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

        $this->product_id = $product_id;
        $this->attribute_product_id = $attribute_product_id;
        ////
        $this->product_attribute = AttributeProduct::where('id', $this->attribute_product_id)
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

    private function validateInput(): array
    {
        if ($this->type == 'text_box' || $this->type == 'text_area') {
            return ['required', 'string', 'min:5', 'max:250'];
        } else if ($this->type == 'select' || $this->type == 'multi_select')
            return ['required'];
    }

    protected function rules()
    {
        return [
            'priority' => ['required', 'gt:0'],
            'value' => $this->validateInput()
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
    protected $listeners = ['valueSelect' => 'setStyle'];
    public function setStyle()
    {
         $this->emit('resetSelect');
    }

    public function render()
    {
        return view('livewire.admin.create-product.edit-product-specifications');

    }
}
