<?php

namespace App\Http\Controllers\cashier;

use App\product;
use App\category;
use App\productCategory;
use App\sellingTransaction;
use App\selling;
use App\member;
use App\inventory;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public static function index(Request $request)
    {
        $product = product::all();
        $member = Member::all();
        $selling = Selling::all();
        $sellingTransaction = SellingTransaction::where('status_id', '1')->whereDate('updated_at', Carbon::today())->get();

        return view(
            'cashier/transaction/transaction',
            compact(
                'product',
                'member',
                'selling',
                'sellingTransaction'
            )
        );
    }

    public static function detail_transaction(Request $request)
    {
        $selling = selling::with('product.prices')->where('selling_transaction_id', $request['id'])->get();
        $sellingTransaction = sellingTransaction::with('member')->find($request['id']);

        return compact('selling', 'sellingTransaction');
    }
}