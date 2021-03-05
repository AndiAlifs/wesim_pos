<?php

namespace App\Http\Controllers;

use App\user;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $user = User::with('role')->get();
        return view('adminlte.product.product', compact('user'));
    }
}
