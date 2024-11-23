<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stok;
use App\Http\Requests\StoreStokBahanRequest;
use App\Http\Requests\UpdateStokBahanRequest;
use Illuminate\View\View;
use App\Models\BahanBaku;
use App\Models\Barang;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class StokBahanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-stok|edit-stok|show-stok|delete-stok', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-stok', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-stok', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-stok', ['only' => ['destroy']]);
        $this->middleware('permission:show-stok', ['only' => ['index', 'show']]);
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

        $stokbahan = Barang::with(['stok', 'bahanBaku'])
            ->where('kategori_barang', 'Bahan Baku')
            ->filter(request(['search']))
            ->sortable()
            ->paginate($row)
            ->appends(request()->query());

        return view('stok.bahanbaku.index', ['stokbahan' => $stokbahan]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('stok.bahanbaku.create');
    }

    public function store(StoreStokBahanRequest $request): RedirectResponse
    {
        $barang = Barang::firstOrCreate(
            ['nama_barang' => $request->nama],
            ['kategori_barang' => 'Bahan Baku']
        );

        BahanBaku::create([
            'barang_id'   => $barang->id,
            'supplier'    => $request->supplier,
            'batch'       => $request->batch,
            'tgl_exp'     => $request->tgl_exp,
            'warna'       => $request->warna,
            'bentuk'      => $request->bentuk,
            'harga'       => $request->harga,
            'penyimpanan' => $request->penyimpanan,
            'pemeriksa'   => $request->pemeriksa,
            'keterangan'  => $request->keterangan,
        ]);

        Stok::create([
            'barang_id' => $barang->id,
            'satuan'    => $request->satuan,
            'jumlah'    => $request->jumlah ?? 0,
        ]);

        return redirect()->route('stokbahan.index')
            ->with('success', 'Data stok bahan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $stokBahan = Barang::with(['bahanBaku', 'stok'])
            ->where('id', $id)
            ->where('kategori_barang', 'Bahan Baku')
            ->firstOrFail();

        return view('stok.bahanbaku.show', ['stokBahan' => $stokBahan]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $bahanBaku = BahanBaku::with('barang')
            ->whereHas('barang', function($query) {
                $query->where('kategori_barang', 'Bahan Baku');
            })
            ->findOrFail($id);

        return view('stok.bahanbaku.edit', ['bahanBaku' => $bahanBaku]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStokBahanRequest $request, BahanBaku $bahanBaku): RedirectResponse
    {
        if (!$bahanBaku || !$bahanBaku->barang) {
            return redirect()->route('stokbahan.index')->with('error', 'Bahan baku atau barang tidak ditemukan.');
        }

        if ($bahanBaku->barang->kategori_barang !== 'Bahan Baku') {
            return redirect()->route('stokbahan.index')->with('error', 'Kategori barang tidak valid untuk diupdate.');
        }

        $bahanBaku->barang->update([
            'nama_barang' => $request->nama
        ]);

        $bahanBaku->update($request->only([
            'supplier',
            'batch',
            'tgl_exp',
            'warna',
            'bentuk',
            'harga',
            'penyimpanan',
            'pemeriksa',
            'keterangan'
        ]));

        $stok = Stok::where('barang_id', $bahanBaku->barang_id)->firstOrFail();
        $stok->update([
            'jumlah' => $request->jumlah,
            'satuan' => $request->satuan,
        ]);

        return redirect()->route('stokbahan.index')
            ->with('success', 'Data stok bahan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BahanBaku $bahanBaku): RedirectResponse
    {
        DB::beginTransaction();
        try {
            DB::table('masuk')->where('barang_id', $bahanBaku->barang_id)->delete();
            DB::table('keluar')->where('barang_id', $bahanBaku->barang_id)->delete();

            $stok = Stok::where('barang_id', $bahanBaku->barang_id)->first();
            if ($stok) {
                $stok->delete();
            }

            $barang = Barang::findOrFail($bahanBaku->barang_id);
            $barang->delete();

            $bahanBaku->delete();

            DB::commit();

            return redirect()->route('stokbahan.index')
                ->with('success', 'Data stok bahan berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('stokbahan.index')
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
