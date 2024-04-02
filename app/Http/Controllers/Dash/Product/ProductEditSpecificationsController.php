<?php

namespace App\Http\Controllers\Dash\Product;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeProduct;
use App\Models\AttributeValue;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductEditSpecificationsController extends Controller
{
    //
    public function index(Request $request)
    {
        $value = [];
        $values = '';
        $name = '';
        $priority = '';
        $type = '';
        $selectedAttributeType = '';
        $attributeDefaultValues = '';

        $product = Product::where('id', $request->product_id)
            ->select('id', 'category_attribute_id', 'title_persian')
            ->first();
        $product_attribute = AttributeProduct::where('id', $request->attribute_product_id)
            ->first();
        $attribute_name = Attribute::where('id', $product_attribute->attribute_id)
            ->select('name')
            ->first();

        $product_attribute = AttributeProduct::where('id', $request->attribute_product_id)->first();

        ////
        $name = $product_attribute->attribute_id;
        $priority = $product_attribute->priority;
        // fill the value input wire model base on attribute type
        $type = $product_attribute->type;
        switch ($type) {
            case 'select':
                $selectedAttributeType = 'select';
                $attributeDefaultValues =
                    AttributeValue::where('attribute_id', $name)->select('id', 'value')->get();
                $value = json_decode($product_attribute->values)->id;
                break;
            case 'multi_select':
                $selectedAttributeType = 'multi_select';
                $attributeDefaultValues =
                    AttributeValue::where('attribute_id', $name)->select('id', 'value')->get();
                foreach (json_decode($product_attribute->values, true) as $item) {
                    array_push($value, $item['id']);
                }
                break;
            case 'text_area':
                $selectedAttributeType = 'text_area';
                $value = json_decode($product_attribute->values)->value;
                break;
            case 'text_box':
                $selectedAttributeType = 'text_box';
                $value = json_decode($product_attribute->values)->value;
                break;
        }

        return view('admin_end.product.edit.edit_specifications')
            ->with(['product' => $product,
                'value' => $value,
                'priority' => $priority,
                'attribute_name' => $attribute_name,
                'selectedAttributeType' => $selectedAttributeType,
                'attributeDefaultValues' => $attributeDefaultValues,
                'product_id' => $request->product_id,
                'attribute_product_id' => $request->attribute_product_id,]);
    }

    private  function validateInput(): array
    {
        if ($this->type == 'text_box' || $this->type == 'text_area') {
            return ['required', 'string', 'min:5', 'max:250'];
        } else if ($this->type == 'select' || $this->type == 'multi_select')
            return ['required'];
    }

    public function update(Request $request)
    {

        $request->validate([
            'priority' => ['required', 'gt:0'],
            'value' => $this->validateInput()
        ]);

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
}
