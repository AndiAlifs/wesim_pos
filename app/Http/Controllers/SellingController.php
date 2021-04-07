<?php

namespace App\Http\Controllers;

use App\selling;
use App\sellingTransaction;
use Illuminate\Http\Request;

class SellingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sellingTransaction =
            sellingTransaction::with("transactionStatus", "user", "member")
            ->where("status_id", 1)->get();

        foreach ($sellingTransaction as $index => $row) {
            $sellingTransaction[$index]->product_count = Selling::where('selling_transaction_id', $row->id)->count();
        }

        return view('adminlte/selling/selling', compact('sellingTransaction'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\selling  $selling
     * @return \Illuminate\Http\Response
     */
    public function show(selling $selling)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\selling  $selling
     * @return \Illuminate\Http\Response
     */
    public function edit(selling $selling)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\selling  $selling
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, selling $selling)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\selling  $selling
     * @return \Illuminate\Http\Response
     */
    public function destroy(selling $selling)
    {
        //
    }
}