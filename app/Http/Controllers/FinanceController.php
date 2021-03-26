<?php

namespace App\Http\Controllers;

use App\finance;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        if($_GET){
            $waktu["bulan"] = sprintf("%02d", $_GET["bulan"]);
            $waktu["tahun"] = $_GET["tahun"];
        } else {
            $waktu["bulan"] = sprintf("%02d",Carbon::now()->month);
            $waktu["tahun"] = Carbon::now()->year;
        }

        $dateFrom = $waktu["tahun"]."-".$waktu["bulan"]."-01";     
        $dateTo = $waktu["tahun"]."-".$waktu["bulan"]."-31";     

        // Query between
        $finances = finance::whereBetween('transaction_date',[$dateFrom, $dateTo])
                                ->orderByDesc('transaction_date')
                                ->get();
        // dd($finances);

        $kas["debit"] = finance::where('jenis','debit')->sum('amount');
        $kas["kredit"] = finance::where('jenis','kredit')->sum('amount');

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
        // dd($request);
        $new_transaction = new finance;
        $new_transaction->transaction_name = $request->name;
        $new_transaction->transaction_date = $request->date;
        $new_transaction->jenis = $request->type;
        $new_transaction->amount = $request->amount;
        $new_transaction->save();

        return redirect()->route('finance');
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
