<?php

namespace App\Http\Livewire\Admin\CreateProduct;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Product;
use Livewire\Component;

class CreateProductSpecifications extends Component
{
    public $product_id;
    public $product;
    public $attributes;
    public $selectedAttributeType;
    public $selectedAttribute;
    public $attributeDefaultValues = null;

    public $name;
    public $type;
    public $value;

    public function mount($product)
    {
        $this->product_id = $product;
        $this->product = Product::where('id', $product)
            ->select('id', 'category_attribute_id', 'title_persian')
            ->first();
        $this->attributes = Attribute::where('category_id', $this->product->category_attribute_id)
            ->get();

    }

    protected $rules = [
        'name' => ['required'],
        'type' => ['required'],
        'value' => ['required']
    ];

    public function changeAttribute()
    {
        if($this->name == 0)
            return null;
        else
        $this->selectedAttribute = Attribute::where('id',$this->name)->first();
        $this->type = $this->selectedAttribute->type;
        switch ($this->selectedAttribute->type) {
            case 'select':
                $this->selectedAttributeType = 'select';
                $this->attributeDefaultValues = AttributeValue::where('attribute_id',$this->selectedAttribute->id)->get();
                break;
            case 'multi_select':
                $this->selectedAttributeType = 'multi_select';
                $this->attributeDefaultValues = AttributeValue::where('attribute_id',$this->selectedAttribute->id)->get();
                break;
            case 'text_area':
                $this->selectedAttributeType = 'text_area';
                break;
            case 'text_box':
                $this->selectedAttributeType = 'text_box';
                break;
            default:

        }

    }

    public function save()
    {
        dd($this->value);
    }



    public function deleteConfirmation($id)
    {
        //        $this->meta_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    protected $listeners = [
        'deleteConfirmed' => 'deleteModel',
    ];


    public function deleteModel()
    {
        try {
            /*
             $model = ProductMeta::findOrFail($this->meta_id);
             $model->delete();
            */
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
            ->with(['product' => $this->product]);
    }
}
