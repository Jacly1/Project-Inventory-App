<?php

namespace App\Exports;

use App\Models\Keluar;
use Illuminate\Support\Facades\DB; // Tambahkan ini
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PenggunaanBahanExport implements FromCollection, WithHeadings
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        return Keluar::whereBetween('tgl_keluar', [$this->startDate, $this->endDate])
            ->join('barang', 'keluar.barang_id', '=', 'barang.id')
            ->select('barang.nama_barang', DB::raw('SUM(keluar.jumlah) as total_terpakai'))
            ->groupBy('keluar.barang_id')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Nama Barang',
            'Jumlah Terpakai',
        ];
    }
}
