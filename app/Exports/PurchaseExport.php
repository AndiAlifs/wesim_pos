<?php

namespace App\Exports;

use App\Purchase;
use App\PurchaseTransaction;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PurchaseExport implements FromView, ShouldAutoSize, WithStyles
{
    public $jumlah = 3;

    public function view(): View
    {
        $purchaseTransaction =
            PurchaseTransaction::with("transactionStatus", "user", "supplier")
            ->where("status_id", 1)->get();

        foreach ($purchaseTransaction as $index => $row) {
            $purchaseTransaction[$index]->product_count = Purchase::where('purchase_transaction_id', $row->id)->count();
        }

        $this->jumlah += $purchaseTransaction->count();

        return view('report/finance/purchase', compact('purchaseTransaction'));
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
