<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stok;
use App\Models\Masuk;
use App\Models\Keluar;
use App\Models\ProdukJadi;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
{
    // Dummy data for testing
    $incomingData = [0, 30, 45, 60, 75, 90, 105, 120, 135, 150, 165, 180];
    $outgoingData = [0, 20, 35, 50, 65, 80, 95, 110, 125, 140, 155, 170];

    // Ensure all 12 months are represented
    $incomingData = array_replace(array_fill(1, 12, 0), array_combine(range(1, 12), $incomingData));
    $outgoingData = array_replace(array_fill(1, 12, 0), array_combine(range(1, 12), $outgoingData));

    // Low quantity stock (threshold <= 15)
    $lowQuantityStock = Stok::where('jumlah', '<=', 15)->with('barang')->get();

    // Top selling stock
    $topSellingStock = Keluar::selectRaw('barang_id, SUM(jumlah) as sold_quantity')
        ->with('barang')
        ->groupBy('barang_id')
        ->orderByDesc('sold_quantity')
        ->take(3)
        ->get();

    // Get expiring products (3 months before expiration or already expired)
    $expiringProducts = ProdukJadi::with('barang.stok')
        ->where('tgl_exp', '<=', Carbon::now()->addMonths(3))  // Filter produk yang kadaluarsa dalam 3 bulan ke depan
        ->whereHas('barang.stok', function($query) {
            $query->where('jumlah', '>', 0); // Only include products with stock remaining
        })
        ->get()
        ->map(function($product) {
            $expiringIn3Months = Carbon::parse($product->tgl_exp)->subMonths(3); // 3 months before expiration date
            $daysLeft = Carbon::now()->diffInDays($expiringIn3Months, false); // Calculate days until the alert

            // Set status and color based on the expiration date
            $status = 'Not yet';
            $statusClass = 'text-success';

            if ($daysLeft <= 0) {
                $status = 'Expiring soon';
                $statusClass = 'text-warning';
            }

            // If the product is already expired
            if (Carbon::now()->gt($product->tgl_exp)) {
                $status = 'Expired';
                $statusClass = 'text-danger';
            }

            return [
                'nama_barang' => $product->barang->nama_barang,
                'jumlah' => $product->barang->stok->jumlah,
                'tanggal_kedaluwarsa' => $product->tgl_exp,
                'status' => $status,
                'statusClass' => $statusClass
            ];
        });

    return view('dashboard', compact('incomingData', 'outgoingData', 'lowQuantityStock', 'topSellingStock', 'expiringProducts'));
}




}
