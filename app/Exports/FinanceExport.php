<?php

namespace App\Exports;

use App\finance;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class FinanceExport implements FromView
{
    public function view(): View
    {
        $finances = finance::orderByDesc('transaction_date')->get();

        $kas["debit"] = finance::where('jenis','debit')->sum('amount');
        $kas["kredit"] = finance::where('jenis','kredit')->sum('amount');

        return view('report/finance/finance', compact('finances','kas'));
    }
}
