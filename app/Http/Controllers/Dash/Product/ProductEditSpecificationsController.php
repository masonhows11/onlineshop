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
        // dd($value);
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
}
