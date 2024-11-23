<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keluar;
use App\Models\Barang;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PenggunaanBahanExport;
use App\Exports\StokExport;
use App\Exports\KartuStokExport;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:show-laporan', ['only' => [
            'index',
            'laporanPenggunaan',
            'laporanPenggunaanPdf',
            'laporanPenggunaanExcel',
            'laporanStok',
            'laporanStokPdf',
            'laporanStokExcel',
            'laporanKartuStok'
        ]]);
    }

    public function index()
    {
        return view('laporan.index');
    }

    // Menampilkan halaman laporan penggunaan dengan input periode tanggal
    public function laporanPenggunaan(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if ($startDate && $endDate) {
            // Ambil data penggunaan bahan berdasarkan periode tanggal
            $penggunaanBahan = Keluar::whereBetween('tgl_keluar', [$startDate, $endDate])
                ->with('barang')
                ->selectRaw('barang_id, sum(jumlah) as total_terpakai')
                ->groupBy('barang_id')
                ->get();
        } else {
            $penggunaanBahan = null;
        }

        return view('laporan.penggunaan', compact('penggunaanBahan', 'startDate', 'endDate'));
    }

    // Menghasilkan laporan penggunaan dalam bentuk PDF
    public function laporanPenggunaanPdf(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $penggunaanBahan = Keluar::whereBetween('tgl_keluar', [$startDate, $endDate])
            ->with('barang')
            ->selectRaw('barang_id, sum(jumlah) as total_terpakai')
            ->groupBy('barang_id')
            ->get();

        $pdf = Pdf::loadView('laporan.penggunaan_pdf', compact('penggunaanBahan', 'startDate', 'endDate'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('laporan_penggunaan_bahan.pdf');
    }

    // Menghasilkan laporan penggunaan dalam bentuk Excel
    public function laporanPenggunaanExcel(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        return Excel::download(new PenggunaanBahanExport($startDate, $endDate), 'laporan_penggunaan_bahan.xlsx');
    }

    public function columnWidths(): array
    {
        return [
            'A' => 30,
            'B' => 20,
        ];
    }

    // Menampilkan laporan stok
    public function laporanStok(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $stok = Barang::with('stok')
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                return $query->whereHas('stok', function ($q) use ($startDate, $endDate) {
                    $q->whereBetween('updated_at', [$startDate, $endDate]);
                });
            })
            ->get();

        $tanggalCetak = now()->format('Y-m-d');

        return view('laporan.stok', compact('stok', 'tanggalCetak', 'startDate', 'endDate'));
    }

    public function laporanStokPdf(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $stok = Barang::with('stok')
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                return $query->whereHas('stok', function ($q) use ($startDate, $endDate) {
                    $q->whereBetween('updated_at', [$startDate, $endDate]);
                });
            })
            ->get();

        $tanggalCetak = now()->format('Y-m-d');

        $pdf = Pdf::loadView('laporan.stok_pdf', compact('stok', 'tanggalCetak', 'startDate', 'endDate'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('laporan_stok.pdf');
    }

    public function laporanStokExcel(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        return Excel::download(new StokExport($startDate, $endDate), 'laporan_stok.xlsx');
    }

    
    public function laporanKartuStok(Request $request)
    { 
        echo "test";
        $barangId = $request->input('barang_id');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // $barang = Barang::with(['stok', 'masuk', 'keluar'])->findOrFail($barangId);
        // $masuk = $barang->masuk()->whereBetween('tgl_masuk', [$startDate, $endDate])->get();
        // $keluar = $barang->keluar()->whereBetween('tgl_keluar', [$startDate, $endDate])->get();

        // $barangList = Barang::all(); // List of all Barang for dropdown

        // return view('laporan.kartustok', compact('barang', 'masuk', 'keluar', 'startDate', 'endDate', 'barangList'));
    }

    public function laporanKartuStokPdf(Request $request)
    {
        $barangId = $request->input('barang_id');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $barang = Barang::with(['stok', 'masuk', 'keluar'])->findOrFail($barangId);
        $masuk = $barang->masuk()->whereBetween('tgl_masuk', [$startDate, $endDate])->get();
        $keluar = $barang->keluar()->whereBetween('tgl_keluar', [$startDate, $endDate])->get();

        $pdf = Pdf::loadView('laporan.kartustok_pdf', compact('barang', 'masuk', 'keluar', 'startDate', 'endDate'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('laporan_kartu_stok.pdf');
    }

    public function laporanKartuStokExcel(Request $request)
    {
        $barangId = $request->input('barang_id');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        return Excel::download(new KartuStokExport($barangId, $startDate, $endDate), 'laporan_kartu_stok.xlsx');
    }  
}


