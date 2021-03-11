<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiscountController extends Controller
{
    function index() 
    {
        $discounts = Discount::all();
        return view("adminlte/discount/discount", ["discounts", $discounts]);
    }
}
