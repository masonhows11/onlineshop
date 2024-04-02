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
        $values = '';
        $name = '';
        $priority = '';
        $type = '';
        $value = [];
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


        ////
        $attribute_id = $product_attribute->attribute_id;
        $priority = $product_attribute->priority;
        // fill the value input wire model base on attribute type
        $type = $product_attribute->type;
        switch ($type) {
            case 'select':
                $selectedAttributeType = 'select';
                $attributeDefaultValues =
                    AttributeValue::where('attribute_id', $attribute_id)->select('id', 'value')->get();
                $value = json_decode($product_attribute->values)->id;
                break;
            case 'multi_select':
                $selectedAttributeType = 'multi_select';
                $attributeDefaultValues =
                    AttributeValue::where('attribute_id', $attribute_id)->select('id', 'value')->get();
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
                'attribute_id' => $attribute_id,
                'value' => $value,
                'priority' => $priority,
                'attribute_name' => $attribute_name,
                'selectedAttributeType' => $selectedAttributeType,
                'attributeDefaultValues' => $attributeDefaultValues,
                'product_id' => $request->product_id,
                'attribute_product_id' => $request->attribute_product_id,]);
    }

    private function validateInput($type): array
    {
        if ($type == 'text_box' || $type == 'text_area') {
            return ['required', 'string', 'min:5', 'max:250'];
        } else if ($type == 'select' || $type == 'multi_select')
            return ['required'];
    }

    public function update(Request $request)
    {


        $request->validate([
            'priority' => ['required', 'gt:0'],
            'value' => $this->validateInput($request->type)
        ]);

        switch ($request->type) {
            case 'select':
                $values = AttributeValue::where('attribute_id', $request->attribute_id)
                    ->where('id', $request->value)->select('id', 'value')
                    ->first();
                $values = json_encode(['id' => $values->id, 'value' => $values->value]);

                AttributeProduct::where('id', $request->attribute_product_id)->update([
                    'product_id' => $request->product_id,
                    'attribute_id' => $request->attribute_id,
                    'values' => $values,
                    'priority' => $request->priority,
                    'type' => $request->type,
                ]);
                break;
            case 'multi_select':
                $values = AttributeValue::where('attribute_id', $request->attribute_id)
                    ->whereIn('id', $request->value)->select('id', 'value')
                    ->get();
                $values = $values->map(function ($item) {
                    return ['id' => $item['id'], 'value' => $item['value']];
                });

                AttributeProduct::where('id', $request->attribute_product_id)->update([
                    'product_id' => $request->product_id,
                    'values' => $values,
                    'attribute_id' => $request->attribute_id,
                    'priority' => $request->priority,
                    'type' => $request->type,
                ]);
                break;
            case 'text_box':
            case 'text_area':
                $values = json_encode(['value' => $request->value]);
                AttributeProduct::where('id', $request->attribute_product_id)->update([
                    'product_id' => $request->product_id,
                    'values' => $values,
                    'attribute_id' => $request->attribute_id,
                    'priority' => $request->priority,
                    'type' => $request->type,
                ]);
                break;
        }

        session()->flash('success', __('messages.The_update_was_completed_successfully'));
        return redirect()->route('admin.product.create.specifications', ['product' => $request->product_id]);

    }
}
