<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Member;
use App\Finance;
use App\Product;
use App\Selling;
use App\SellingTransaction;
use App\Purchase;
use App\PurchaseTransaction;
use App\Inventory;

use App\Exports\VisitorExport;
use App\Exports\FinanceExport;
use App\Exports\SellingExport;
use App\Exports\PurchaseExport;
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
                "harga" => $theProduct->prices->last()->harga_jual,
                "jumlah_penjualan" => $pro->total_penjualan
            ];
        }

        // transcation sales
        $sellingToday =  SellingTransaction::where('transaction_date','like' ,Carbon::now()->toDateString().'%')->count();
        $sellingMonth =  SellingTransaction::whereBetween('transaction_date',[Carbon::now()->firstOfMonth()->toDateTimeString(),Carbon::now()->lastOfMonth()->toDateTimeString()])->get()->sum('total_price');

        // produk shipping
        $onShipping = PurchaseTransaction::where('status_id',3)->get()->count();

        //selling
        $akhirPekan = Carbon::now()->endOfWeek()->subDays(14);
        $sellingThisWeek = SellingTransaction::whereBetween('transaction_date',[Carbon::now()->startOfWeek()->toDateString(),Carbon::now()->endOfWeek()->toDateString()])->get()->count();
        for ($i=0; $i <= 6; $i++) { 
            $hariCari = $akhirPekan->addDays(1);
            $jumlahSellingLastWeek[$i] = SellingTransaction::where('transaction_date','like',$hariCari->toDateString().'%')->get()->count();
        }
        for ($i=6; $i <= 13; $i++) { 
            $hariCari = $akhirPekan->addDays(1);
            $jumlahSellingThisWeek[6-$i] = SellingTransaction::where('transaction_date','like',$hariCari->toDateString().'%')->get()->count();
        }

        return view('adminlte/report/report', compact('jumlahMember', 'topProduk', 'sellingToday','onShipping','jumlahSellingLastWeek','jumlahSellingThisWeek','sellingThisWeek','sellingMonth'));
    }

    public function indexVisitor()
    {
        return Excel::download(new VisitorExport, 'visitors.xlsx');
    }

    public function indexFinance()
    {   

        $bulan_name = [".","Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        
        if($_GET){
            $fileName = 'LaporanKeuangan_'.$bulan_name[$_GET["bulan_start"]].$_GET["tahun_start"]."_".$bulan_name[$_GET["bulan_end"]].$_GET["tahun_end"];
        } else {
            $fileName = 'LaporanKeuangan_'.$bulan_name[Carbon::now()->month].Carbon::now()->year;
        }

        return Excel::download(new FinanceExport, $fileName.'.xlsx');
    }
    
    public function indexSelling()
    {   
        return Excel::download(new SellingExport, 'laporanPenjualan.xlsx');
    }

    public function indexpurchase()
    {   
        return Excel::download(new PurchaseExport, 'laporanPembelian.xlsx');
    }
}