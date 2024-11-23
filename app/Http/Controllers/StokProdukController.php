<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stok;
use App\Http\Requests\StoreStokProdukRequest;
use App\Http\Requests\UpdateStokRequest;
use Illuminate\View\View;
use App\Models\BahanBaku;
use App\Models\Kemasan;
use App\Models\ProdukJadi;
use App\Models\Barang;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class StokProdukController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-stok|edit-stok|show-stok|delete-stok', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-stok', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-stok', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-stok', ['only' => ['destroy']]);
        $this->middleware('permission:show-stok', ['only' => ['index','show']]);
    }

    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $row = (int)request('row', 10);

        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }


        $stokproduk = Barang::with(['stok', 'produkJadi'])
            ->where('kategori_barang', 'Produk Jadi') // Filter berdasarkan kategori
            ->filter(request(['search']))
            ->sortable()
            ->paginate($row)
            ->appends(request()->query());

        return view('stok.produkjadi.index', ['stokproduk' => $stokproduk,]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('stok.produkjadi.create');
    }


    public function store(StoreStokProdukRequest $request): RedirectResponse
{
    // Simpan atau ambil barang berdasarkan nama_barang
    $barang = Barang::firstOrCreate(
        ['nama_barang' => $request->nama],  // Cari atau buat berdasarkan nama_barang
        ['kategori_barang' => 'Produk Jadi'] // Default kategori untuk Bahan Baku
    );

    // Simpan data Bahan Baku
    $produkJadi = ProdukJadi::create([
        'barang_id'   => $barang->id,
        'batch'       => $request->batch,
        'tgl_exp'     => $request->tgl_exp,
        'warna'       => $request->warna,
        'bentuk'      => $request->bentuk,
        'bau'      => $request->bau,
        'ph'      => $request->ph,
        'jlh_sampel'      => $request->jlh_sampel,
        'diproduksi'      => $request->diproduksi,
        'keterangan'  => $request->keterangan,
    ]);

    // Simpan data Stok
    Stok::create([
        'barang_id' => $barang->id,
        'jumlah'    => $request->jumlah,
    ]);

    // Redirect ke halaman index dengan pesan sukses
    return redirect()->route('stokproduk.index')
        ->with('success', 'Data stok bahan berhasil ditambahkan.');
}


    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        // Ambil barang beserta relasi bahan baku dan stok
        $stokProduk = Barang::with(['produkJadi', 'stok'])
            ->where('id', $id)
            ->where('kategori_barang', 'Produk Jadi')
            ->firstOrFail(); // Jika tidak ditemukan, tampilkan 404

        // Kirim data ke view
        return view('stok.produkjadi.show', ['stokProduk' => $stokProduk]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stok $stok): View
    {
        return view('stok.edit', [
            'stok' => $stok
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStokRequest $request, Stok $stok): RedirectResponse
    {
        $stok->update($request->validated());
        return redirect()->back()
            ->withSuccess('Stock data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stok $stok): RedirectResponse
    {
        $stok->delete();
        return redirect()->route('stok.index')
            ->withSuccess('Stock entry deleted successfully.');
    }

}


