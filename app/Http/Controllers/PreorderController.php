<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Purchase;
use App\PurchaseTransaction;
use App\Product;
use App\ProductCategory;
use App\Supplier;
use App\Inventory;

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
        $product = Product::with('inventory')->get();
        $supplier = Supplier::all();
        $purchaseTransaction = purchaseTransaction::where('status_id', '4')->first();
        if (!$purchaseTransaction) {
            $purchaseTransaction = new \stdClass();
            $purchaseTransaction->transaction_number = 0;
        }
        return view('adminlte/preorder/po_master', compact('product', 'supplier', 'purchaseTransaction'));
    }

    public function add_new_po(Request $request)
    {
        $index = PurchaseTransaction::count() + 1;
        PurchaseTransaction::create([
            "transaction_number" => ('PO-' . time() . '000' . $index),
            "status_id" => 4, //successfully
            "user_id" => $request['user_id'], //admin
            "supplier_id" => 1, //
        ]);
    }

    public function get_modal_data_po(Request $request)
    {
        $purchase = purchase::where('purchase_transaction_id', $request['purchase_transaction_id'])
            ->where('product_id', $request['product_id']); //cek if product already in cart
        $cek = $purchase->count(); //cek if product already in cart

        $stock = product::with('inventory')->find($request['product_id']);
        if ($cek) { // if product already in cart
            $get = $purchase->get(); // get row in purchase
            $data[0] = purchase::with('product')->find($get[0]->id);
            $data[0]->already_in_cart = true;
            $data[1] = $stock;
            return $data;
        } else {
            $data[0] = Product::find($request['product_id']);
            $data[0]->already_in_cart = false;
            $data[1] = $stock;
            return $data;
        }
    }

    public function add_to_cart_po(Request $request)
    {
        $purchase = purchase::where('purchase_transaction_id', $request['purchase_transaction_id'])
            ->where('product_id', $request['product_id']);

        $product = Product::find($request['product_id']);

        $cek = $purchase->count();

        if ($cek) { //if product already in cart
            $data = $purchase->first(); //get purchase row

            //update cart in purchase 
            $data->amount = $request['product_amount'];
            $data->price = ($product->purchase_price * $request['product_amount']);
            $data->date = date('Y-m-d');
            $data->save();
        } else {
            purchase::create([
                'purchase_transaction_id' => $request['purchase_transaction_id'],
                'product_id' => $request['product_id'],
                'amount' => $request['product_amount'],
                'price' => ($product->purchase_price * $request['product_amount']),
                'date' => '1999-12-12',
            ]);
        }
    }

    // selesai
    public function load_cart_po(Request $request)
    {
        $purchase = purchase::with('product')
            ->where('purchase_transaction_id', $request['purchase_transaction_id'])
            ->get();
        return $purchase;
    }

    function delete_item_po(Request $request)
    {
        purchase::find($request['purchase_id'])->delete();
    }

    public static function search_box_po_2(Request $request) //nda dipakai
    {
        if (isset($request['name'])) {

            // get product by barcode
            $product = ProductCategory::with('product')
                ->whereHas(
                    'product',
                    function ($query) use ($request) {
                        return $query->where('product_code', $request['name']);
                    }
                )->get();
            if ($product->count() > 0) {
                $barcode = true;
                return compact('product', 'barcode');
            }

            // get product by name
            $product = ProductCategory::with('product')
                ->whereHas(
                    'product',
                    function ($query) use ($request) {
                        return $query->where('name', 'like', '%' . $request['name'] . '%');
                    }
                )->get();
            $barcode = false;
            return compact('product', 'barcode');
        }
    }
    public static function search_box_po(Request $request)
    {
        if (isset($request['name'])) {

            $product = product::with('inventory')->where('product_code', $request['name'])->get();
            // get product by barcode
            if ($product->count() > 0) {
                $barcode = true;
                return compact('product', 'barcode');
            }

            // get product by name
            $product = product::with('inventory')->where('name', 'like', '%' . $request['name'] . '%')->get();
            $barcode = false;
            return compact('product', 'barcode');
        }
    }
}