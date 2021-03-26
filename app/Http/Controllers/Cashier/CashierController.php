<?php

namespace App\Http\Controllers\cashier;

use App\product;
use App\category;
use App\productCategory;
use App\sellingTransaction;
use App\selling;
use App\member;

use App\Http\Controllers\Controller;
use App\inventory;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function index(Request $request)
    {

        $category = Category::all();
        $product = ProductCategory::with('product')->get();
        $member = Member::all();
        $selling = Selling::all();
        $sellingTransaction = SellingTransaction::where('status_id', '2')->get();

        return view('cashier/master', [
            'category' => $category,
            'product' => $product,
            'member' => $member,
            'selling' => $selling,
            'sellingTransaction' => $sellingTransaction
        ]);
    }

    public function search_box(Request $request)
    {
        if (isset($request['name'])) {
            $product = ProductCategory::with('product')
                ->whereHas(
                    'product',
                    function ($query) use ($request) {
                        return $query->where('name', 'like', '%' . $request['name'] . '%');
                    }
                )->get();
            return $product;
        }
    }

    public function add_new_transaction(Request $request)
    {
        $transaction_number = 'Cart ' . time() . rand(1000, 9999);
        sellingTransaction::create([
            'transaction_number' => $transaction_number,
            'status_id' => 2,
            'user_id' => $request->user_id,
            'member_id' => 1,
        ]);

        $selling_tansaction_id = SellingTransaction::where('transaction_number', $transaction_number)->get();
        return $selling_tansaction_id[0]->id;
    }

    public function pay_transaction(Request $request)
    {
        $selling_transaction_id = $request['selling_transaction_id'];
        $transaction_number = $request['transaction_number'];
        $member_id = $request['member_id'];
        $pay_cost = $request['pay_cost'];
        $total_price = $request['total_price'];
        $transaction_date = $request['transaction_date'];

        $member_id = Member::where('member_id', $member_id)->get();
        echo $member_id[0]->id;

        $selling_transaction = sellingTransaction::find($selling_transaction_id);
        $selling_transaction->transaction_number = $transaction_number;
        $selling_transaction->status_id = 1;
        $selling_transaction->member_id = $member_id[0]->id;
        $selling_transaction->pay_cost = $pay_cost;
        $selling_transaction->total_price = $total_price;
        $selling_transaction->transaction_date = $transaction_date;
        $selling_transaction->save();
    }

    function delete_cart(Request $request)
    {
        selling::where('selling_transaction_id', $request['selling_transaction_id'])->delete();
        sellingTransaction::find($request['selling_transaction_id'])->delete();
    }


    // selesai utk sementara
    public function filter_category($id, Request $request)
    {
        $category = Category::all();
        $product = ProductCategory::with('product')->with('category')
            ->where('category_id', $id)
            ->get();
        $member = Member::all();
        $selling = selling::all();
        $sellingTransaction = SellingTransaction::where('status_id', '2')->get();

        return view('cashier/master', [
            'category' => $category,
            'product' => $product,
            'member' => $member,
            'selling' => $selling,
            'sellingTransaction' => $sellingTransaction
        ]);
    }


    // selesai
    public function load_cart(Request $request)
    {
        $selling = Selling::with('product')
            ->where('selling_transaction_id', $request['selling_transaction_id'])
            ->get();
        return $selling;
    }

    public function get_modal_data(Request $request)
    {
        $selling = Selling::where('selling_transaction_id', $request['selling_transaction_id'])
            ->where('product_id', $request['product_id']); //cek if product already in cart
        $cek = $selling->count(); //cek if product already in cart

        $stock = product::with('inventory')->find($request['product_id']);
        if ($cek) { // if product already in cart
            $get = $selling->get(); // get row in selling
            $data[0] = Selling::with('product')->find($get[0]->id);
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

    public function add_to_cart(Request $request)
    {
        $selling = Selling::where('selling_transaction_id', $request['selling_transaction_id'])
            ->where('product_id', $request['product_id']);

        $product = Product::find($request['product_id']);
        $inventory = inventory::where('product_id', $request['product_id'])->first();

        $cek = $selling->count();

        if ($cek) {
            $data = $selling->first(); //get selling row

            // update stock in inventory
            $inventory->in_stock = ($inventory->in_stock + ($data->amount - $request['product_amount']));
            $inventory->save();

            //update cart in selling 
            $data->amount = $request['product_amount'];
            $data->price = ($product->price * $request['product_amount']);
            $data->save();
        } else {
            Selling::create([
                'selling_transaction_id' => $request['selling_transaction_id'],
                'product_id' => $request['product_id'],
                'amount' => $request['product_amount'],
                'price' => ($product->price * $request['product_amount']),
            ]);
            $inventory->in_stock = ($inventory->in_stock - $request['product_amount']);
            $inventory->save();
        }
    }

    function delete_item(Request $request)
    {
        $selling =  Selling::find($request['selling_id']);

        //update inventory
        $inventory = inventory::where('product_id', $selling['product_id'])->first();
        $inventory->in_stock = ($inventory->in_stock + $request['selling_amount']);
        $inventory->save();

        Selling::find($request['selling_id'])->delete();
    }
}