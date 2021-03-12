<?php

namespace App\Http\Controllers\cashier;

use App\product;
use App\category;
use App\sellingTransaction;
use App\selling;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CashierController extends Controller
{
    public function index(){

        $category = Category::all();
        $product = Product::all();

        return view('cashier/master', ['category' => $category, 'product' => $product]);
    }


	public function new_transaction(Request $request){
		
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
	
	public function add_to_cart(Request $request){
		
        $this->validate($request, [
            'selling_transaction_id' => 'required',
            'product_id' => 'required',
            'amount' => 'required',
            'price' => 'required',
        ]);
			
        selling::create([
            'selling_transaction_id' => 1111,
            'product_id' => $request->product_id,
            'amount' => $request->amount,
            'price' => $request->price,
        ]);

        // return $this->index();
	}
}
