<?php

namespace App\Http\Controllers\Dash\Product;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductEditSpecificationsController extends Controller
{
    //
    public function index(Request $request)
    {
        $product = Product::where('id', $request->product_id)
            ->select('id', 'category_attribute_id', 'title_persian')
            ->first();
        $product_attribute = AttributeProduct::where('id', $request->attribute_product_id)
            ->first();
        $attribute_name = Attribute::where('id', $product_attribute->attribute_id)
            ->select('name')
            ->first();

        return view('admin_end.product.edit.edit_specifications')
            ->with(['product' => $product,
                    'attribute_name' => $attribute_name,
                    'product_id' => $request->product_id,
                    'attribute_product_id' => $request->attribute_product_id]);
    }
}
