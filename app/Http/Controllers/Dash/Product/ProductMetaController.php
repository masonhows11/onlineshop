<?php

namespace App\Http\Controllers\Dash\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductMetaController extends Controller
{
    public function index(Request $request)
    {

            return view('admin_end.product.create.create_meta')
                ->with('product',$request->product);


    }
}
