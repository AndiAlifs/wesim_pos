<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Finance;
use App\Product;
use App\Exports\VisitorExport;
use App\Exports\FinanceExport;
use App\Selling;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        // jumlah member
        $jumlahMember = Member::get()->count();

        // produk sales
        $topProduk = [];
        $produk = DB::table('sellings')
            ->select(DB::raw('product_id,count(*) as total_penjualan'))
            ->groupBy("product_id")
            ->orderByDesc('total_penjualan')
            ->limit(5)
            ->get();
        foreach ($produk as $pro) {
            $theProduct = Product::find($pro->product_id);
            $topProduk[] = [
                "nama" => $theProduct->name,
                "image" => $theProduct->image,
                "harga" => $theProduct->price,
                "jumlah_penjualan" => $pro->total_penjualan
            ];
        }

        // transcation sales
        $sellingToday =  Selling::where('date', Carbon::now()->toDateString())->count();

        return view('adminlte/report/report', compact('jumlahMember', 'topProduk', 'sellingToday'));
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