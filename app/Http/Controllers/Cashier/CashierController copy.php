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
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
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

    public function add_to_cart(Request $request)
    {
        // get request
        $product = $request;

        // delete old product from table selling
        // $selling = Selling::where('selling_transaction_id', $product['transaction_id'])
        //     ->where('product_id', $product['product_id']);
        $selling = Selling::find($product['selling_id']);
        if ($selling->exists()) {
            $selling->amount = $product['product_amount'];
            $selling->price = $product['product_amount'];
            $selling->save();
            echo 'berhasil';
        } else
            echo 'yeaho';
    }

    // tryy ajax--------------------------------------------
    public function add_to_hold(Request $request)
    {
        // get request
        $product = $request->product;

        // delete old product from table selling
        Selling::where('selling_transaction_id', $product['transaction_id'])
            ->where('product_id', $product['product_id'])
            ->delete();

        // store new product to table selling
        Selling::create([
            'selling_transaction_id' => $product['transaction_id'],
            'product_id' => $product['product_id'],
            'amount' => $product['product_amount'],
            'price' => ($product['price'] * $product['amount']),
        ]);
    }


    // selesai
    public function delete_item(Request $request)
    {
        Selling::where('selling_transaction_id', $request->selling_transaction_id)
            ->where('product_id', $request->product_id)
            ->delete();
    }

    // selesai
    public function load_cart(Request $request)
    {
        $selling = Selling::with('product')->where('selling_transaction_id', $request['selling_transaction_id'])->get();

        return $selling;
    }
    // selesai
    public function get_modal_data(Request $request)
    {
        // cek if product already in cart 
        echo $request['selling_id'];
        $product = Selling::find($request['selling_id']);

        return $product;
    }
    // end try ajax---------------------------------
}