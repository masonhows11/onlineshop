<?php

namespace App\Http\Livewire\Admin\CreateProduct;

use App\Models\Attribute;
use App\Models\AttributeProduct;
use App\Models\AttributeValue;
use App\Models\Product;
use Illuminate\Validation\Rule;
use Livewire\Component;


class CreateProductSpecifications extends Component
{
    public $product_id;
    public $product;
    public $attributes;
    public $attribute_value_id;
    public $selectedAttributeType;
    public $selectedAttribute;
    public $attributeDefaultValues = null;

    public $name;
    public $type;
    public $priority;
    public $value;
    public $values;
    public $result = [];

    public function mount($product)
    {
        $this->product_id = $product;
        $this->product = Product::where('id', $product)
            ->select('id', 'category_attribute_id', 'title_persian')
            ->first();
        $this->attributes = Attribute::where('category_id', $this->product->category_attribute_id)
            ->get();

    }

    public function rules(){
        return [
            'name' => ['required'],
            'type' => ['required'],
            'priority' => ['required'],
            'value' => $this->type == 'text_box' || 'text_area' ? 'required|string|min:1|max:255' : 'required',
        ];
    }


    public function changeAttribute()
    {
        if ($this->name == 0) {
            $this->name = null;
        } else
            $this->selectedAttribute = Attribute::where('id', $this->name)->first();
        $this->type = $this->selectedAttribute->type;
        switch ($this->type) {
            case 'select':
                $this->selectedAttributeType = 'select';
                $this->attributeDefaultValues =
                    AttributeValue::where('attribute_id', $this->selectedAttribute->id)
                        ->get();
                break;
            case 'multi_select':
                $this->selectedAttributeType = 'multi_select';
                $this->attributeDefaultValues =
                    AttributeValue::where('attribute_id', $this->selectedAttribute->id)
                        ->get();
                break;
            case 'text_area':
                $this->selectedAttributeType = 'text_area';
                break;
            case 'text_box':
                $this->selectedAttributeType = 'text_box';
                break;
            default:
                $this->selectedAttributeType = 'text_box';
        }

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
                AttributeProduct::create([
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

                AttributeProduct::create([
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
                AttributeProduct::create([
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


    }


    public function deleteConfirmation($id)
    {
        $this->attribute_value_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    protected $listeners = [
        'deleteConfirmed' => 'deleteModel',
    ];


    public function deleteModel()
    {
        try {

             $model = AttributeProduct::findOrFail($this->attribute_value_id);
             $model->delete();

            $this->dispatchBrowserEvent('show-result',
                ['type' => 'success',
                    'message' => __('messages.The_deletion_was_successful')]);
        } catch (\Exception $ex) {
            return view('errors_custom.model_not_found');
        }
        return null;
    }

    public function render()
    {
        return view('livewire.admin.create-product.create-product-specifications')
            ->extends('admin_end.include.master_dash')
            ->section('dash_main_content')
            ->with(['product' => $this->product ,
                'attribute_product' => AttributeProduct::where('product_id',$this->product_id)->orderBy('priority','asc')->get()]);
    }
}
