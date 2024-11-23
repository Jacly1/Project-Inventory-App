<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProdukJadi;
use App\Models\Masuk;
use App\Models\Barang;

class MasukProdukController extends Controller
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
        $masukProduk = Masuk::whereHas('barang', function ($query) {
            $query->where('kategori_barang', 'Produk Jadi');
        })->paginate(10);

        return view('masuk.produkjadi.index', compact('masukProduk'));
    }

    public function create()
    {
        // Mengambil data barang dengan kategori Produk Jadi untuk dropdown
        $produkJadi = ProdukJadi::whereHas('barang', function ($query) {
            $query->where('kategori_barang', 'Produk Jadi');
        })->get();

        return view('masuk.produkjadi.create', compact('produkJadi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:produk_jadi,barang_id',
            'jumlah' => 'required|integer|min:1',
            'tgl_masuk' => 'required|date'
        ]);

        // Menyimpan data produk jadi masuk
        $masukProduk = Masuk::create($request->only(['barang_id', 'jumlah', 'tgl_masuk']));

        // Tambahkan jumlah ke stok barang terkait
        $barang = Barang::find($request->barang_id);
        if ($barang && $barang->stok) {
            $barang->stok->jumlah += $request->jumlah;
            $barang->stok->save();
        }

        return redirect()->route('masukproduk.index')->with('success', 'Data produk jadi masuk berhasil ditambahkan dan stok telah diperbarui');
    }


    public function show($id)
    {
        $masukProduk = Masuk::where('id', $id)
            ->whereHas('barang', function ($query) {
                $query->where('kategori_barang', 'Produk Jadi');
            })->with(['barang', 'barang.produkJadi'])->firstOrFail();

        return view('masuk.produkjadi.show', compact('masukProduk'));
    }

    public function edit($id)
    {
        $masukProduk = Masuk::where('id', $id)
            ->whereHas('barang', function ($query) {
                $query->where('kategori_barang', 'Produk Jadi');
            })->with(['barang', 'barang.produkJadi'])->firstOrFail();

        $produkJadi = ProdukJadi::whereHas('barang', function ($query) {
            $query->where('kategori_barang', 'Produk Jadi');
        })->get();

        return view('masuk.produkjadi.edit', compact('masukProduk', 'produkJadi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'barang_id' => 'required|exists:produk_jadi,barang_id',
            'jumlah' => 'required|integer|min:1',
            'tgl_masuk' => 'required|date'
        ]);

        $masukProduk = Masuk::findOrFail($id);
        $masukProduk->update($request->only(['barang_id', 'jumlah', 'tgl_masuk']));

        return redirect()->route('masukproduk.index')->with('success', 'Data produk jadi masuk berhasil diperbarui');
    }

    public function destroy($id)
    {
        $masukProduk = Masuk::findOrFail($id);

        // Ambil barang terkait dan stoknya
        $barang = Barang::find($masukProduk->barang_id);

        if ($barang && $barang->stok) {
            // Kurangi jumlah stok dengan jumlah barang yang masuk
            $barang->stok->jumlah -= $masukProduk->jumlah;
            $barang->stok->save();
        }

        $masukProduk->delete();

        return redirect()->route('masukproduk.index')->with('success', 'Data produk jadi masuk berhasil dihapus dan stok telah dikembalikan.');
    }
}
