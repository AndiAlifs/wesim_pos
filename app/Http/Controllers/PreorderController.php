<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Purchase;
use App\PurchaseTransaction;
use App\Product;
use App\ProductCategory;
use App\Supplier;
use App\Inventory;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

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
        $product = Product::with('inventory')->with('prices')->get();
        $supplier = Supplier::all();
        $purchaseTransaction = purchaseTransaction::where('status_id', '4')->first();
        if (!$purchaseTransaction) {
            $purchaseTransaction = new \stdClass();
            $purchaseTransaction->transaction_number = 0;
            $purchaseTransaction->id = 0;
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

        if ($cek) { // if product already in cart
            $get = $purchase->first(); // get row in purchase
            $data = purchase::with('product.prices')->with('product.inventory')
                ->find($get->id);
            $data->already_in_cart = true;
            return $data;
        } else {
            $data = product::with('inventory')->with('prices')->find($request['product_id']);
            $data->already_in_cart = false;
            return $data;
        }
    }
    public function add_to_cart_po(Request $request)
    {
        $purchase = purchase::where('purchase_transaction_id', $request['purchase_transaction_id'])
            ->where('product_id', $request['product_id']);

        $product = Product::with('prices')->find($request['product_id']);

        $cek = $purchase->count();

        if ($cek) { //if product already in cart
            $data = $purchase->first(); //get purchase row

            //update cart in purchase 
            $data->amount = $request['product_amount'];
            $data->price = ($product->prices[count($product->prices) - 1]->harga_beli * $request['product_amount']);
            $data->date = date('Y-m-d');
            $data->save();
        } else {
            purchase::create([
                'purchase_transaction_id' => $request['purchase_transaction_id'],
                'product_id' => $request['product_id'],
                'amount' => $request['product_amount'],
                'price' => ($product->prices[count($product->prices) - 1]->harga_beli * $request['product_amount']),
                'date' => '1999-12-12',
            ]);
        }
    }

    // selesai
    public function load_cart_po(Request $request)
    {
        $purchase = purchase::with('product.prices')
            ->where('purchase_transaction_id', $request['purchase_transaction_id'])
            ->get();
        return $purchase;
    }

    function delete_item_po(Request $request)
    {
        purchase::find($request['purchase_id'])->delete();
    }


    public static function search_box_po(Request $request)
    {
        if (isset($request['name'])) {

            $product = product::with('inventory')->with('prices')->where('product_code', $request['name'])->get();
            // get product by barcode
            if ($product->count() > 0) {
                $barcode = true;
                return compact('product', 'barcode');
            }

            // get product by name
            $product = product::with('inventory')->with('prices')->where('name', 'like', '%' . $request['name'] . '%')->get();
            $barcode = false;
            return compact('product', 'barcode');
        }
    }
    public static function order(Request $request)
    {
        $PurchaseTransaction = PurchaseTransaction::find($request['purchase_transaction_id']);
        $PurchaseTransaction->status_id = 3;
        $PurchaseTransaction->supplier_id = $request['supplier_id'];
        $PurchaseTransaction->total_price = $request['total_price'];
        $PurchaseTransaction->save();
    }

    public function destroy($id)
    {
        $purchase = purchase::where('purchase_transaction_id', $id)->get();
        foreach ($purchase as $item) {
            $item->delete();
        }
        PurchaseTransaction::find($id)->delete();
        return redirect('/preorder');
    }
}