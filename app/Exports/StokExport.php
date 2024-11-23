<?php

namespace App\Exports;

use App\Models\Barang;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class StokExport implements FromView
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function view(): View
    {
        $stok = Barang::with('stok')
            ->when($this->startDate && $this->endDate, function($query) {
                return $query->whereHas('stok', function ($q) {
                    $q->whereBetween('updated_at', [$this->startDate, $this->endDate]);
                });
            })
            ->get();

        return view('laporan.stok_excel', [
            'stok' => $stok,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate
        ]);
    }
}
