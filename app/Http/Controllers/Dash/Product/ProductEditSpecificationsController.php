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
        $this->product = Product::where('id', $request->product_id)
            ->select('id', 'category_attribute_id', 'title_persian')
            ->first();
        ////
        $this->product_attribute = AttributeProduct::where('id', $request->attribute_product_id)
            ->first();
        // fill input with current value
        $this->attribute_name = Attribute::where('id', $this->product_attribute->attribute_id)
            ->select('name')
            ->first();

        return view('admin_end.product.edit.edit_specifications')
            ->with(['product_id' => $request->product_id ,'attribute_product_id'=> $request->attribute_product_id]);
    }
}
