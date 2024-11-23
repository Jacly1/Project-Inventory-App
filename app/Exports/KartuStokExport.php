<?php

namespace App\Exports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\DB;

class KartuStokExport implements FromCollection, WithHeadings, WithMapping
{
    protected $barangId;
    protected $startDate;
    protected $endDate;

    public function __construct($barangId, $startDate, $endDate)
    {
        $this->barangId = $barangId;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        $barang = Barang::with(['stok', 'masuk', 'keluar'])
            ->findOrFail($this->barangId);

        $masuk = $barang->masuk()->whereBetween('tgl_masuk', [$this->startDate, $this->endDate])->get();
        $keluar = $barang->keluar()->whereBetween('tgl_keluar', [$this->startDate, $this->endDate])->get();

        return $masuk->concat($keluar);
    }

    public function headings(): array
    {
        return [
            'Tanggal Masuk',
            'Jumlah Masuk',
            'Tanggal Keluar',
            'Jumlah Keluar',
            'Sisa Stok',
            'Keterangan',
        ];
    }

    public function map($row): array
    {
        return [
            $row->tgl_masuk ?? '',
            $row->jumlah_masuk ?? '',
            $row->tgl_keluar ?? '',
            $row->jumlah_keluar ?? '',
            $row->sisa_stok ?? '',
            $row->nama_barang_jadi ?? '',
        ];
    }
}
