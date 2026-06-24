<?php

namespace App\Exports;

use App\Models\StokMasuk;
use App\Models\StokKeluar;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class LaporanArusStokExport implements WithMultipleSheets
{
    protected $tanggal_mulai;
    protected $tanggal_selesai;

    public function __with($tanggal_mulai, $tanggal_selesai)
    {
        $this->tanggal_mulai = $tanggal_mulai;
        $this->tanggal_selesai = $tanggal_selesai;
    }

    public function sheets(): array
    {
        return [
            new \App\Exports\Sheets\StokMasukSheet($this->tanggal_mulai, $this->tanggal_selesai),
            new \App\Exports\Sheets\StokKeluarSheet($this->tanggal_mulai, $this->tanggal_selesai),
        ];
    }
}