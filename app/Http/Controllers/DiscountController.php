<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\product;

class DiscountController extends Controller
{
    function index() 
    {
        $products = Product::all();
        return view("adminlte/discount/discount", ["products" => $products]);
    }

    function update(Request $request)
    {
        $this->validate($request, [
            'product_code' => 'required',
            'discount_amount' => 'required',
            'discount_reason' => 'required',
        ]);
        $product = Product::where('product_code', $request->product_code)->first();
        $product->discount_amount = $request->discount_amount;
        $product->discount_reason = $request->discount_reason;
        $product->save();
        return redirect()->route('discount');
    }

    function destroy($id)
    {
        $product = Product::find($id);
        $product->discount_amount = 0;
        $product->discount_reason = '';
        $product->save();
        return redirect()->route('discount');
    }

}
