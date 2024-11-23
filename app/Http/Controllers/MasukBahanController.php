<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BahanBaku;
use App\Models\Masuk;
use App\Models\Barang;

class MasukBahanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-masuk|edit-masuk|show-masuk|delete-masuk', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-masuk', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-masuk', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-masuk', ['only' => ['destroy']]);
    }


    public function index()
{
    // Ambil hanya data masuk bahan yang terkait dengan barang ber-kategori 'Bahan Baku'
    $masukBahan = Masuk::whereHas('barang', function ($query) {
        $query->where('kategori_barang', 'Bahan Baku');
    })->paginate(10);

    return view('masuk.bahanbaku.index', compact('masukBahan'));
}

public function show($id)
{
    // Ambil data Masuk berdasarkan ID dengan relasi ke barang dan bahan baku
    $masukBahan = Masuk::where('id', $id)
        ->whereHas('barang', function ($query) {
            $query->where('kategori_barang', 'Bahan Baku');
        })->with(['barang', 'barang.bahanBaku'])->firstOrFail();

    return view('masuk.bahanbaku.show', compact('masukBahan'));
}


public function create()
{
    // Ambil hanya data barang dengan kategori 'Bahan Baku'
    $bahanBaku = BahanBaku::whereHas('barang', function ($query) {
        $query->where('kategori_barang', 'Bahan Baku');
    })->get();

    return view('masuk.bahanbaku.create', compact('bahanBaku'));
}





public function store(Request $request)
{
    $request->validate([
        'barang_id' => 'required|exists:bahan_baku,barang_id',
        'jumlah' => 'required|integer|min:1',
        'tgl_masuk' => 'required|date'
    ]);

    // Ambil barang terkait
    $barang = Barang::findOrFail($request->barang_id);

    // Simpan data barang masuk
    $masukBahan = Masuk::create([
        'barang_id' => $request->barang_id,
        'jumlah' => $request->jumlah,
        'tgl_masuk' => $request->tgl_masuk,
    ]);

    // Tambahkan jumlah barang masuk ke stok
    if ($barang->stok) {
        $barang->stok->jumlah += $request->jumlah;
        $barang->stok->save();
    }

    return redirect()->route('masukbahan.index')->with('success', 'Data bahan baku masuk berhasil ditambahkan dan stok telah diperbarui');
}













    public function edit($id)
{
    // Ambil data Masuk berdasarkan ID dan pastikan barangnya ber-kategori 'Bahan Baku'
    $masukBahan = Masuk::where('id', $id)
        ->whereHas('barang', function ($query) {
            $query->where('kategori_barang', 'Bahan Baku');
        })->with(['barang', 'barang.bahanBaku'])->firstOrFail();

    // Ambil daftar barang dengan kategori 'Bahan Baku' untuk dropdown
    $bahanBaku = BahanBaku::whereHas('barang', function ($query) {
        $query->where('kategori_barang', 'Bahan Baku');
    })->get();

    return view('masuk.bahanbaku.edit', compact('masukBahan', 'bahanBaku'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'barang_id' => 'required|exists:bahan_baku,barang_id',
        'jumlah' => 'required|integer|min:1',
        'tgl_masuk' => 'required|date'
    ]);

    // Cari data Masuk yang ingin di-update
    $masukBahan = Masuk::findOrFail($id);
    $masukBahan->update($request->only(['barang_id', 'jumlah', 'tgl_masuk']));

    return redirect()->route('masukbahan.index')->with('success', 'Data bahan masuk berhasil diperbarui');
}


public function destroy($id)
{
    $masukBahan = Masuk::findOrFail($id); // Cari data barang masuk berdasarkan ID

    // Ambil barang terkait dan stoknya
    $barang = Barang::find($masukBahan->barang_id);

    if ($barang && $barang->stok) {
        // Kurangi jumlah stok dengan jumlah barang yang masuk
        $barang->stok->jumlah -= $masukBahan->jumlah;
        $barang->stok->save();
    }

    $masukBahan->delete(); // Hapus data barang masuk dari database

    return redirect()->route('masukbahan.index')
        ->with('success', 'Data bahan masuk berhasil dihapus dan stok telah dikembalikan.');
}












}
