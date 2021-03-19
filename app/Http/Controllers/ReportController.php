<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Exports\VisitorExport;
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
}
