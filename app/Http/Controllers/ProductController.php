<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::get();
        $warnaBg = ["primary", "secondary", "success", "danger", "warning", "info", "dark"];
        return view('adminlte.product.product', compact('product','warnaBg'));
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->Category()->detach();
        $product->delete();
        return redirect()->route('product');
    }

    public function create($id)
    {
        $product = Product::find($id);
        $product->Category()->detach();
        $product->delete();
        return redirect()->route('product');
    }
}