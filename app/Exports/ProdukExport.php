<?php

namespace App\Exports;

use App\Models\Produk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;

class ProdukExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $rowNumber = 0;

    public function collection()
    {
        return Produk::with('kategori')->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Produk',
            'Kategori',
            'Harga Satuan',
            'Stok Akhir',
            'Nilai Aset'
        ];
    }

    public function map($produk): array
    {
        $this->rowNumber++;
        $nilaiAset = $produk->harga * $produk->stok_akhir;

        return [
            $this->rowNumber,
            $produk->nama_produk,
            $produk->kategori ? $produk->kategori->nama_kategori : '-',
            $produk->harga,
            $produk->stok_akhir,
            $nilaiAset
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $highestRow = $sheet->getHighestRow();
        $totalRow = $highestRow + 1;

        $sheet->setCellValue('B'.$totalRow, 'TOTAL');
        $sheet->setCellValue('E'.$totalRow, "=SUM(E2:E{$highestRow})");
        $sheet->setCellValue('F'.$totalRow, "=SUM(F2:F{$highestRow})");

        for ($row = 2; $row <= $totalRow; $row++) {
            $sheet->getStyle('D'.$row)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->getStyle('F'.$row)->getNumberFormat()->setFormatCode('#,##0');
        }

        $sheet->getStyle('A1:F1')->getFont()->setBold(true);
        $sheet->getStyle('A'.$totalRow.':F'.$totalRow)->getFont()->setBold(true);

        $borderStyle = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'B0B0B0'],
                ],
            ],
        ];

        $sheet->getStyle('A1:F'.$totalRow)->applyFromArray($borderStyle);
    }
}