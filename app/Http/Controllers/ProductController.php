<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::get();
        // dd($product);
        return view('adminlte.product.product', compact('product'));
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->Category()->detach();
        $product->delete();
        return redirect()->route('product');
    }

    public function create($request)
    {
        $product = Product::find($id);
        $product->Category()->detach();
        $product->delete();
        return redirect()->route('product');
    }
}