<?php

namespace App\Http\Controllers\cashier;

use App\product;
use App\category;
use App\productCategory;
use App\sellingTransaction;
use App\selling;
use App\member;

use App\Http\Controllers\Controller;
use App\SellingTransaction as AppSellingTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use SebastianBergmann\Environment\Console;
use SellingTransactionSeeder;

class CashierController extends Controller
{
    public function index(Request $request)
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
        } else
            $product = ProductCategory::with('product')->get();

        $category = Category::all();
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

    // blum sama skali
    public function search_box(Request $request)
    {
        $category = Category::all();
        $selling = Selling::all();
        $member = Member::all();
        $sellingTransaction = SellingTransaction::where('status_id', '2')->get();

        $key = $request->key;
        $product = ProductCategory::with('product');
        $product = ProductCategory::where('product.name', 'like', "%" . $key . "%")->get();

        return view('cashier/master', [
            'category' => $category,
            'product' => $product,
            'member' => $member,
            'selling' => $selling,
            'sellingTransaction' => $sellingTransaction,
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
            ->where('product_id', $request['product_id']);
        $cek = $selling->count();
        if ($cek) {
            $get = $selling->get();
            $data = Selling::with('product')->find($get[0]->id);
            $data->already_in_cart = true;
            return $data;
        } else {
            $data = Product::find($request['product_id']);
            $data->already_in_cart = false;
            return $data;
        }
    }

    public function add_to_cart(Request $request)
    {
        $selling = Selling::where('selling_transaction_id', $request['selling_transaction_id'])
            ->where('product_id', $request['product_id']);

        $product = Product::find($request['product_id']);

        $cek = $selling->count();
        if ($cek) {
            $get = $selling->get();
            $data = Selling::find($get[0]->id);
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
        }
    }

    function delete_item(Request $request)
    {
        Selling::find($request['selling_id'])->delete();
    }
}