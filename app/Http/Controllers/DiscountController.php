<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\product;

class DiscountController extends Controller
{
    function index() 
    {
        $discounts = Product::all();
        return view("adminlte/discount/discount", ["discounts" => $discounts]);
    }
}
