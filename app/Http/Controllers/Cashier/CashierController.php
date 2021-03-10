<?php

namespace App\Http\Controllers\cashier;

use App\product;
use App\category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function index(){

        $category = Category::all();
        $product = Product::all();

        return view('cashier/master', ['category' => $category, 'product' => $product]);
    }
}
