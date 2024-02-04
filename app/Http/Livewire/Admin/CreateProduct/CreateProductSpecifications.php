<?php

namespace App\Http\Livewire\Admin\CreateProduct;

use App\Models\Product;
use Livewire\Component;

class CreateProductSpecifications extends Component
{
    public $product_id;
    public $product;
    public function mount($product)
    {
        $this->product_id = $product;
        $this->product = Product::where('id', $product)->select(['id', 'title_persian'])->first();
    }

    protected $rules = [
        'name' => ['required'],
        'type' => ['required'],
    ];

    public function save(){

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
