<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Finance;
use App\Exports\VisitorExport;
use App\Exports\FinanceExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index()
    {   
        $jumlahMember = Member::get()->count();
        // dd($jumlahMember);
        return view('adminlte/report/report',compact('jumlahMember'));
    }

    public function indexVisitor()
    {
        return Excel::download(new VisitorExport, 'visitors.xlsx');    
    }

    public function indexFinance()
    {
        return Excel::download(new FinanceExport, 'finances.xlsx');
    }

}
