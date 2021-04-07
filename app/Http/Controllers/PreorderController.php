<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Purchase;
use App\PurchaseTransaction;
use App\Product;

class PreorderController extends Controller
{
    public function index()
    {
        $purchaseTransaction =
            PurchaseTransaction::with("transactionStatus", "user", "supplier")
            ->where("status_id", 3)->get();

        foreach ($purchaseTransaction as $index => $row) {
            $purchaseTransaction[$index]->product_count = Purchase::where('purchase_transaction_id', $row->id)->count();
        }

        return view('adminlte/preorder/preorder', compact('purchaseTransaction'));
    }
    

    public function preorder_cashier()
    {
        $product = Product::all();
        return view('adminlte/preorder/preorder_master', compact('product'));
    }
}