<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class VisitorExport implements FromView
{
    public function view(): View
    {
        return view('report/visitor/visitor');
    }
}
