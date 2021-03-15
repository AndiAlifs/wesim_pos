<?php

namespace App\Http\Controllers\cashier;

use App\product;
use App\category;
use App\sellingTransaction;
use App\selling;
use App\cart;

use App\Http\Controllers\Controller;
use App\SellingTransaction as AppSellingTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Environment\Console;

class CashierController extends Controller
{
    public function index()
    {
        $category = Category::all();
        $product = Product::all();
        $selling = Selling::all();
        $sellingTransaction = SellingTransaction::where('status_id', '2')->get();

        return view('cashier/master', ['category' => $category, 'product' => $product, 'selling' => $selling, 'sellingTransaction' => $sellingTransaction]);
    }


    public function new_transaction(Request $request)
    {
        $this->validate($request, [
            'status' => 'required',
            'transaction_number' => 'required',
        ]);

        sellingTransaction::create([
            'status' => $request->status,
            'transaction_number' => $request->transaction_number,
            'user_id' => $request->user_id,
            'member_id' => $request->member_id,
        ]);
    }

    public function add_to_cart($id, Request $request)
    {

        $this->validate($request, [
            // 'selling_transaction_id' => 'required',
            'product_id' => 'required',
            'amount' => 'required',
            'price' => 'required',
        ]);

        selling::create([
            'selling_transaction_id' => 1,
            'product_id' => $request->product_id,
            'amount' => $request->amount,
            'price' => $request->price,
        ]);

        return $this->index();
    }

    // tryy ajax--------------------------------------------
    public function add_to_hold(Request $request)
    {
        // get request
        $product = $request->product;

        // delete old product from table selling
        $selling = Selling::where('selling_transaction_id', $product['transaction_id'])
            ->where('product_id', $product['product_id'])
            ->delete();

        // store new product to table selling
        Selling::create([
            'selling_transaction_id' => $product['transaction_id'],
            'product_id' => $product['product_id'],
            'amount' => $product['amount'],
            'price' => ($product['price'] * $product['amount']),
        ]);
    }
    public function delete_item(Request $request)
    {
        Selling::where('selling_transaction_id', $request->selling_transaction_id)
            ->where('product_id', $request->product_id)
            ->delete();
    }

    public function load_cart(Request $request)
    {
        $status_id = 2;
        $sellingTransaction = SellingTransaction::where('id', $request->selling_transaction_id)->get();
        $selling = Selling::with('product')->where('selling_transaction_id', $sellingTransaction[0]->id)->get();

        return $selling;
    }

    public function get_modal_data(Request $request)
    {
        // cek if product already in cart 

        $sellingTransaction = SellingTransaction::where('transaction_number', $request->transaction_number)->get();
        $product = Selling::with('product')
            ->where('selling_transaction_id', $sellingTransaction[0]->id)
            ->where('product_id', $request->product_id)
            ->get();

        return $product;
    }
    // end try ajax---------------------------------
}