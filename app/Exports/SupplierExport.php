<?php

namespace App\Exports;

use App\Models\Supplier;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;

class SupplierExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $rowNumber = 0;

    public function collection()
    {
        return Supplier::all();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Supplier',
            'No. Telepon / WA',
            'Alamat Lengkap'
        ];
    }

    public function map($supplier): array
    {
        $this->rowNumber++;
        return [
            $this->rowNumber,
            $supplier->nama_supplier,
            $supplier->kontak ?? '-', 
            $supplier->alamat ?? '-'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $highestRow = $sheet->getHighestRow();
        $sheet->getStyle('A1:D1')->getFont()->setBold(true);
        $borderStyle = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'B0B0B0'],
                ],
            ],
        ];
        $sheet->getStyle('A1:D'.$highestRow)->applyFromArray($borderStyle);
    }
}