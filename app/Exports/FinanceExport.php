<?php

namespace App\Exports;

use App\finance;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\Style;

class FinanceExport implements FromView, WithStyles, ShouldAutoSize
{   
    public $jumlah = 5;

    public function view(): View
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

        
        $this->jumlah += $finances->count();

        return view('report/finance/finance', compact('finances','kas','waktu'));
    }

    public function styles(Worksheet $sheet)
    {   
        $range = "A4:E".$this->jumlah;
        return [
            '1:2' => [
                'font' => [
                    'bold' => true,
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ],

            'D5:E'.$this->jumlah => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                ],
            ],

            '4'=> [
                'font' => [
                    'bold' => true,
                    'color' => ['argb' => \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE],
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
                    'color' => ['argb' => \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_DARKBLUE],
                ]
            ],

            'D'.$this->jumlah => [
                'font' => [
                    'color' => ['argb' => \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED],
                ],
            ],

            $this->jumlah => [
                'font' => [
                    'bold' => true,
                ],
            ],

            'E'.$this->jumlah => [
                'font' => [
                    'color' => ['argb' => \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_DARKGREEN],
                ],
            ],
            

            $range => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ]
            ]
        ];
    }
}
