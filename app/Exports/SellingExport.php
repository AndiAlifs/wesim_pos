<?php

namespace App\Exports;

use App\SellingTransaction;
use App\Selling;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SellingExport implements FromView, ShouldAutoSize, WithStyles
{
    public $jumlah = 3;

    public function view(): View
    {
        $sellingTransaction = sellingTransaction::with("transactionStatus", "user", "member")
            ->where("status_id", 1)->get();

        foreach ($sellingTransaction as $index => $row) {
            $sellingTransaction[$index]->product_count = Selling::where('selling_transaction_id', $row->id)->count();
        }

        $this->jumlah += $sellingTransaction->count();

        return view('report/finance/selling',compact('sellingTransaction'));
    }

    public function styles(Worksheet $sheet)
    {
        return [
            '1' => [
                'font' => [
                    'bold' => true,
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ],

            'A3:F'.$this->jumlah => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ]
            ],

            '3'=> [
                'font' => [
                    'bold' => true,
                    'color' => ['argb' => \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE],
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
                    'color' => ['argb' => \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_DARKBLUE],
                ]
            ],
        ];
    }
}
