<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Purchase;
use App\PurchaseTransaction;
use App\Product;
use App\Supplier;

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
        $supplier = Supplier::all();
        $purchaseTransaction = purchaseTransaction::where('status_id', '4')->first();
        if (!$purchaseTransaction) {
            $purchaseTransaction = new \stdClass();
            $purchaseTransaction->transaction_number = 0;
        }
        return view('adminlte/preorder/po_master', compact('product', 'supplier', 'purchaseTransaction'));
    }

    public function add_new_po_cart(Request $request)
    {
        $index = PurchaseTransaction::count();
        PurchaseTransaction::create([
            "transaction_number" => ('PO' . time() . '000' . $index),
            "status_id" => 4, //successfully
            "user_id" => $request['user_id'], //admin
            "supplier_id" => 1, //
        ]);
    }
}