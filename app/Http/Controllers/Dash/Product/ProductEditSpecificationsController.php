<?php

namespace App\Http\Controllers\Dash\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductEditSpecificationsController extends Controller
{
    //
    public function index(Request $request)
    {
        return view('admin_end.product.edit.edit_specifications')
            ->with(['product_id' => $request->product_id ,'attribute_product_id'=>$request->attribute_product_id]);
    }
}
