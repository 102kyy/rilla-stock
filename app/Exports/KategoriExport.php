<?php

namespace App\Exports;

use App\Models\Kategori;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;

class KategoriExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $rowNumber = 0;

    public function collection()
    {
        return Kategori::withCount(['produks as total_stok' => function($query) {
            $query->select(\DB::raw('sum(stok_akhir)'));
        }])->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Kategori',
            'Total Stok Produk',
            'Status'
        ];
    }

    public function map($kategori): array
    {
        $this->rowNumber++;
        return [
            $this->rowNumber,
            $kategori->nama_kategori,
            ($kategori->total_stok ?? 0) . ' Pcs',
            ucfirst($kategori->status)
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