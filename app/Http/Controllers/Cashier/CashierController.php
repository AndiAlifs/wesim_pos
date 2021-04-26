<?php

namespace App\Http\Controllers\cashier;

use App\product;
use App\category;
use App\productCategory;
use App\sellingTransaction;
use App\selling;
use App\member;
use App\inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

class CashierController extends Controller
{

    public static function index(Request $request)
    {
        $category = Category::all();
        $product = ProductCategory::with('product.prices')->get();
        $member = Member::all();
        $selling = Selling::all();
        $sellingTransaction = SellingTransaction::where('status_id', '2')->get();

        return view(
            'cashier/cashier/cashier',
            compact(
                'category',
                'product',
                'member',
                'selling',
                'sellingTransaction'
            )
        );
    }

    public static function search_box(Request $request)
    {
        if (isset($request['name'])) {

            // get product by barcode
            $product = ProductCategory::with('product.prices')
                ->whereHas(
                    'product.prices',
                    function ($query) use ($request) {
                        return $query->where('product_code', $request['name']);
                    }
                )->get();
            if ($product->count() > 0) {
                $barcode = true;
                return compact('product', 'barcode');
            }

            // get product by name
            $product = ProductCategory::with('product.prices')
                ->whereHas(
                    'product.prices',
                    function ($query) use ($request) {
                        return $query->where('name', 'like', '%' . $request['name'] . '%');
                    }
                )->get();
            $barcode = false;
            return compact('product', 'barcode');
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

        $selling_transaction = sellingTransaction::find($selling_transaction_id);
        $selling_transaction->transaction_number = $transaction_number;
        $selling_transaction->status_id = 1;
        $selling_transaction->member_id = $member_id[0]->id;
        $selling_transaction->pay_cost = $pay_cost;
        $selling_transaction->total_price = $total_price;
        $selling_transaction->transaction_date = $transaction_date;
        echo ($total_price);
        $selling_transaction->save();
    }

    function delete_cart(Request $request)
    {
        $selling = Selling::where('selling_transaction_id', $request['selling_transaction_id'])->get();

        foreach ($selling as $row) {
            $inventory = Inventory::where('product_id', $row['product_id'])->first();
            $inventory->in_stock += $row['amount'];
            $inventory->save();
            $row->delete();
        }
        // selling::where('selling_transaction_id', $request['selling_transaction_id'])->delete();
        sellingTransaction::find($request['selling_transaction_id'])->delete();
    }




    // selesai
    public function load_cart(Request $request)
    {
        $selling = Selling::with('product.prices')
            ->where('selling_transaction_id', $request['selling_transaction_id'])
            ->get();
        return $selling;
    }

    public function get_modal_data(Request $request)
    {
        $selling = Selling::where('selling_transaction_id', $request['selling_transaction_id'])
            ->where('product_id', $request['product_id']); //cek if product already in cart
        $cek = $selling->count(); //cek if product already in cart

        if ($cek) { // if product already in cart
            $get = $selling->get(); // get row in selling
            $data = Selling::with('product.prices')->with('product.inventory')->find($get[0]->id);
            $data->already_in_cart = true;
            return $data;
        } else {
            $data = Product::with('prices')->with('inventory')->find($request['product_id']);
            $data->already_in_cart = false;
            return $data;
        }
    }

    public function add_to_cart(Request $request)
    {
        $selling = Selling::where('selling_transaction_id', $request['selling_transaction_id'])
            ->where('product_id', $request['product_id']);

        $product = Product::with('prices')->find($request['product_id']);
        $product_price = $product->prices[count($product->prices) - 1]['harga_jual'];

        $inventory = inventory::where('product_id', $request['product_id'])->first();
        $cek = $selling->count();

        if ($cek) {
            $data = $selling->first(); //get selling row

            // update stock in inventory
            $inventory->in_stock = ($inventory->in_stock + ($data->amount - $request['product_amount']));
            $inventory->save();

            //update cart in selling 
            $data->amount = $request['product_amount'];
            $data->price = ($product_price * $request['product_amount']);
            $data->date = date('Y-m-d');
            $data->save();
        } else {
            Selling::create([
                'selling_transaction_id' => $request['selling_transaction_id'],
                'product_id' => $request['product_id'],
                'amount' => $request['product_amount'],
                'price' => ($product_price * $request['product_amount']),
                'date' => '1999-12-12',
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

        return view(
            'cashier/cashier/cashier',
            compact(
                'category',
                'product',
                'member',
                'selling',
                'sellingTransaction'
            )
        );
    }
}