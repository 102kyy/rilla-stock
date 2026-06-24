<?php

namespace App\Exports;

use App\Models\BahanBaku;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;

class BahanBakuExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $rowNumber = 0;

    public function collection()
    {
        return BahanBaku::with('supplier')->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Bahan Baku',
            'Supplier Asal',
            'Stok Gudang',
            'Satuan',
            'Harga Beli Satuan'
        ];
    }

    public function map($bb): array
    {
        $this->rowNumber++;
        return [
            $this->rowNumber,
            $bb->nama_bahan,
            $bb->supplier ? $bb->supplier->nama_supplier : '-',
            $bb->stok_bahan,
            $bb->satuan,
            $bb->harga_beli
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $highestRow = $sheet->getHighestRow();

        $sheet->getStyle('A1:F1')->getFont()->setBold(true);

        for ($row = 2; $row <= $highestRow; $row++) {
            $sheet->getStyle('F'.$row)->getNumberFormat()->setFormatCode('#,##0');
        }

        $borderStyle = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'B0B0B0'],
                ],
            ],
        ];
        $sheet->getStyle('A1:F'.$highestRow)->applyFromArray($borderStyle);
    }
}