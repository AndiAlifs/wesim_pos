<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Price;
use App\Product;
use Carbon\Carbon;

class PriceController extends Controller
{
    public function index_price()
    {
        $prices = Price::orderByDesc('id')->get();
        return view('adminlte.product.price', compact('prices'));
    }

    public function update(Request $request)
    {
        $now = Price::where('product_id',$request->product_id)->get()->last();
        if (($now->harga_beli != $request->harga_beli) ||( $now->harga_jual != $request->harga_jual) ||( $now->profit != $request->profit)) {
            $newPrice = new Price;
            $newPrice->product_id = $request->product_id;
            $newPrice->last_update = Carbon::now();
            if ($now->harga_jual != $request->harga_jual) {
                $newPrice->harga_beli = $request->harga_beli;
                $newPrice->harga_jual = $request->harga_jual;
                $newPrice->profit = ($request->harga_jual - $request->harga_beli) / $request->harga_beli;
            } else if ($now->profit != $request->profit) {
                $newPrice->harga_beli = $request->harga_beli;
                $newPrice->harga_jual = $request->harga_beli + ($request->profit * $request->harga_beli);
                $newPrice->profit = $request->profit;
            }
            $newPrice->save();
        } ;

        return redirect()->route('price');
    }
}
