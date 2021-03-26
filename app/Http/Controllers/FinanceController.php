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
        $bulan_name = [".","Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        
        if($_GET){
            $waktu["bulan_start"] = sprintf("%02d", $_GET["bulan_start"]);
            $waktu["bulan_name_start"] = $bulan_name[$_GET["bulan_start"]];
            $waktu["tahun_start"] = $_GET["tahun_start"];
            $waktu["bulan_end"] = sprintf("%02d", $_GET["bulan_end"]);
            $waktu["bulan_name_end"] = $bulan_name[$_GET["bulan_end"]];
            $waktu["tahun_end"] = $_GET["tahun_end"];
        } else {
            $waktu["bulan_start"] = sprintf("%02d",Carbon::now()->month);
            $waktu["bulan_name_start"] = $bulan_name[Carbon::now()->month];
            $waktu["tahun_start"] = Carbon::now()->year;
            $waktu["bulan_end"] = sprintf("%02d",Carbon::now()->month);
            $waktu["bulan_name_end"] = $bulan_name[Carbon::now()->month];
            $waktu["tahun_end"] = Carbon::now()->year;
        }

        $dateFrom = $waktu["tahun_start"]."-".$waktu["bulan_start"]."-01";     
        $dateTo = $waktu["tahun_end"]."-".$waktu["bulan_end"]."-31";     

        // Query between
        $finances = finance::whereBetween('transaction_date',[$dateFrom, $dateTo])
                                ->orderBy('transaction_date')
                                ->get();

        $kas["debit"] = 0;
        $kas["kredit"] = 0;
        foreach ($finances as $finance ) {
            if ($finance->jenis == "debit"){
                $kas["debit"] += $finance["amount"];
            } else {
                $kas["kredit"] += $finance["amount"];
            }
        }


        return view('adminlte/finance/finance', compact('finances','kas','waktu'));
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
