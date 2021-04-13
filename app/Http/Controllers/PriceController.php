<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Price;
use App\Product;

class PriceController extends Controller
{
    public function index_price()
    {
        $prices = Price::get();
        return view('adminlte.product.price', compact('prices'));
    }
}
