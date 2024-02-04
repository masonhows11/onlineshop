<?php

namespace App\Http\Controllers\Dash\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductCreateSpecificationsController extends Controller
{
    //
    public function index(Request $request)
    {
        return view('admin_end.product.create.create_specifications')
            ->with('product',$request->product);
    }
}
