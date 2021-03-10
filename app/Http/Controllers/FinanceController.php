<?php

namespace App\Http\Controllers;

use App\finance;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $finances = finance::orderByDesc('transaction_date')->get();
        // dd($finances);

        $kas["debit"] = 0;
        $kas["kredit"] = 0;

        foreach ($finances as $finance) {
            if($finance->jenis == "debit"){
                $kas["debit"] += $finance->amount;
            } else {
                $kas["kredit"] += $finance->amount;
            }
        }

        // dd($kas);
        return view('adminlte/finance/finance', compact('finances','kas'));
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
     * @param  \App\finance  $finance
     * @return \Illuminate\Http\Response
     */
    public function show(finance $finance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\finance  $finance
     * @return \Illuminate\Http\Response
     */
    public function edit(finance $finance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\finance  $finance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, finance $finance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\finance  $finance
     * @return \Illuminate\Http\Response
     */
    public function destroy(finance $finance)
    {
        //
    }
}
