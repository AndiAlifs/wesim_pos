<?php

namespace App\Http\Controllers;

use App\selling;
use App\sellingTransaction;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SellingController extends Controller
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

        $dateFrom = $waktu["tahun_start"]."-".$waktu["bulan_start"]."-01 00:00:00";     
        $dateTo = $waktu["tahun_end"]."-".$waktu["bulan_end"]."-31 00:00:00"; 

        $sellingTransaction =
            sellingTransaction::with("transactionStatus", "user", "member")
                                    ->whereBetween('transaction_date',[$dateFrom, $dateTo])
                                    ->where("status_id", 1)
                                    ->orderByDesc('transaction_date')
                                    ->get();

        foreach ($sellingTransaction as $index => $row) {
            $sellingTransaction[$index]->product_count = Selling::where('selling_transaction_id', $row->id)->count();
        }

        return view('adminlte/selling/selling', compact('sellingTransaction','waktu'));
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