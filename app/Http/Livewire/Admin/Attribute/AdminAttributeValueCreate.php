<?php

namespace App\Http\Livewire\Admin\Attribute;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Category;
use Livewire\Component;

class AdminAttributeValueCreate extends Component
{
    public $category;
    public $category_name;
    public $category_id;
    public $attribute_id;
    public $attribute_value_id;
    public $edit_mode = false;

    public $name;
    public $value;
    public $priority;

    public function mount($id)
    {
        $this->category_id = $id;
        $this->category = Category::where('id', $id)->select('title_persian')->first();
        $this->category_name = $this->category->title_persian;

    }

    protected $rules = [
        'name' => ['required'],
        'value' => ['required', 'min:2', 'max:30'],
        'priority' => ['required', 'numeric', 'gt:0'],

    ];


    public function save()
    {
        $this->validate();

        try {
            if ($this->edit_mode == false) {

                AttributeValue::create([
                    'value' => $this->value,
                    'attribute_id' => $this->name,
                    'priority' => $this->priority,
                ]);
                $this->name = '';
                $this->value = '';
                $this->priority = '';

                $this->dispatchBrowserEvent('show-result',
                    ['type' => 'success',
                        'message' => __('messages.New_record_saved_successfully')]);


            } elseif ($this->edit_mode == true) {
                AttributeValue::where('id', $this->attribute_value_id)
                         ->update(['value' => $this->value,
                                   'attribute_id' => $this->name,
                                   'priority' => $this->priority,]);

                $this->name = '';
                $this->value = '';
                $this->priority = '';
                $this->edit_mode = false;

                $this->dispatchBrowserEvent('show-result',
                    ['type' => 'success',
                        'message' => __('messages.The_update_was_completed_successfully')]);
            }

        } catch (\Exception $ex) {
            return view('errors_custom.model_store_error');
        }
        return null;
    }

    public function edit($id)
    {

        $this->attribute_value_id = $id;
        try {
            $attribute = AttributeValue::findOrFail($id);
            $this->name = $attribute->attribute_id;
            $this->value = $attribute->value;
            $this->priority = $attribute->priority;
            $this->edit_mode = true;


        } catch (\Exception $ex) {
            return view('errors_custom.model_not_found');
        }
        return null;

    }

    public function resetInput()
    {
        $this->name = '';
        $this->value = '';
        $this->priority = '';
        $this->edit_mode = false;
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

            $model = AttributeValue::findOrFail($this->attribute_value_id);
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
        return view('livewire.admin.attribute.admin-attribute-value-create')
            ->extends('admin_end.include.master_dash')
            ->section('dash_main_content')
            ->with(['attributes' =>
                Attribute::where('category_id', $this->category_id)->where('has_default_value',1)->orderBy('priority','asc')->get()]);
    }
}
