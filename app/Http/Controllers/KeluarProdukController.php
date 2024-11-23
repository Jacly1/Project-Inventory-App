<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProdukJadi;
use App\Models\Keluar;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;

class KeluarProdukController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-keluar|edit-keluar|show-keluar|delete-keluar', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-keluar', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-keluar', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-keluar', ['only' => ['destroy']]);
    }

    public function index()
    {
        $keluarProduk = Keluar::whereHas('barang', function ($query) {
            $query->where('kategori_barang', 'Produk Jadi');
        })->paginate(10);

        return view('keluar.produkjadi.index', compact('keluarProduk'));
    }

    public function create()
    {
        $produkJadi = ProdukJadi::whereHas('barang', function ($query) {
            $query->where('kategori_barang', 'Produk Jadi');
        })->get();

        return view('keluar.produkjadi.create', compact('produkJadi'));
    }

    public function store(Request $request)
{
    $request->validate([
        'barang_id' => 'required|exists:produk_jadi,barang_id',
        'jumlah' => 'required|integer|min:1',
        'tgl_keluar' => 'required|date'
    ]);

    // Gunakan transaction untuk memastikan semua operasi tersimpan dengan aman
    DB::beginTransaction();

    try {
        // Buat data Keluar
        $keluar = Keluar::create([
            'barang_id' => $request->barang_id,
            'jumlah' => $request->jumlah,
            'tgl_keluar' => $request->tgl_keluar
        ]);

        // Kurangi jumlah stok barang terkait
        $barang = Barang::find($request->barang_id);
        if ($barang && $barang->stok) {
            $barang->stok->jumlah -= $request->jumlah;
            $barang->stok->save();
        }

        DB::commit();
        return redirect()->route('keluarproduk.index')->with('success', 'Data produk jadi keluar berhasil ditambahkan dan stok telah diperbarui');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->withErrors(['msg' => 'Terjadi kesalahan: ' . $e->getMessage()]);
    }
}



    public function show($id)
    {
        $keluarProduk = Keluar::where('id', $id)
            ->whereHas('barang', function ($query) {
                $query->where('kategori_barang', 'Produk Jadi');
            })->with(['barang', 'barang.produkJadi'])->firstOrFail();

        return view('keluar.produkjadi.show', compact('keluarProduk'));
    }

    public function edit($id)
    {
        $keluarProduk = Keluar::where('id', $id)
            ->whereHas('barang', function ($query) {
                $query->where('kategori_barang', 'Produk Jadi');
            })->with(['barang', 'barang.produkJadi'])->firstOrFail();

        $produkJadi = ProdukJadi::whereHas('barang', function ($query) {
            $query->where('kategori_barang', 'Produk Jadi');
        })->get();

        return view('keluar.produkjadi.edit', compact('keluarProduk', 'produkJadi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'barang_id' => 'required|exists:produk_jadi,barang_id',
            'jumlah' => 'required|integer|min:1',
            'tgl_keluar' => 'required|date'
        ]);

        $keluarProduk = Keluar::findOrFail($id);

        // Update jumlah stok (tambahkan kembali jumlah sebelumnya, kurangi dengan jumlah baru)
        $barang = Barang::find($keluarProduk->barang_id);
        if ($barang && $barang->stok) {
            $barang->stok->jumlah += $keluarProduk->jumlah;  // Tambahkan kembali jumlah lama
            $barang->stok->jumlah -= $request->jumlah;       // Kurangi dengan jumlah baru
            $barang->stok->save();
        }

        $keluarProduk->update($request->only(['barang_id', 'jumlah', 'tgl_keluar']));

        return redirect()->route('keluarproduk.index')->with('success', 'Data produk jadi keluar berhasil diperbarui dan stok telah diperbarui');
    }

    public function destroy($id)
    {
        $keluarProduk = Keluar::findOrFail($id);

        // Tambahkan kembali jumlah ke stok saat data keluar dihapus
        $barang = Barang::find($keluarProduk->barang_id);
        if ($barang && $barang->stok) {
            $barang->stok->jumlah += $keluarProduk->jumlah;
            $barang->stok->save();
        }

        $keluarProduk->delete();

        return redirect()->route('keluarproduk.index')->with('success', 'Data produk jadi keluar berhasil dihapus dan stok telah diperbarui');
    }
}
