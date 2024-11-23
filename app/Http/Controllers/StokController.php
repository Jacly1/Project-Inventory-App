<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use Illuminate\Http\Request;
use App\Http\Requests\StoreStokRequest;
use App\Http\Requests\UpdateStokRequest;
use Illuminate\View\View;
use App\Models\BahanBaku;
use App\Models\Kemasan;
use App\Models\ProdukJadi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class StokController extends Controller
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

    public function index(): View

    
    {

        $row = (int) request('row', 10);

        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }
        $stocks = Stok::paginate($row)->appends(request()->query());
        return view('stock.bahanbaku.index', [
            'stocks' => $stocks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('stok.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStokRequest $request): RedirectResponse
    {
        Stok::create($request->validated());
        return redirect()->route('stok.index')
            ->withSuccess('New stock entry added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Stok $stok): View
    {
        return view('stok.show', [
            'stok' => $stok
        ]);
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

    // Method untuk stok bahan baku
    public function bahanBaku()
    {
        // Query data bahan baku beserta stok dan barang terkait
        $stoks = DB::table('stok')
            ->join('barang', 'stok.barang_id', '=', 'barang.barang_id')
            ->join('bahan_baku', 'bahan_baku.barang_id', '=', 'barang.barang_id')
            ->select(
                'stok.id_stok',
                'barang.nama_barang',
                'stok.jumlah',
                'stok.satuan',
                'bahan_baku.batch',
                'bahan_baku.tgl_exp',
                'bahan_baku.pemeriksa'
            )
            ->get();

        return view('stok.index', compact('stoks'));
    }

    public function kemasan()
    {
        // Query data kemasan dan stok
        $stoks = DB::table('stok')
            ->join('barang', 'stok.barang_id', '=', 'barang.barang_id')
            ->join('kemasan', 'kemasan.barang_id', '=', 'barang.barang_id')
            ->select(
                'stok.id_stok',
                'barang.nama_barang',
                'stok.jumlah',
                'stok.satuan',
                'kemasan.jenis_bahan',
                'kemasan.jenis_kemasan'
            )
            ->get();

        return view('stok.index', compact('stoks'));
    }

    public function produkJadi()
    {
        // Query data produk jadi dan stok
        $stoks = DB::table('stok')
            ->join('barang', 'stok.barang_id', '=', 'barang.barang_id')
            ->join('produk_jadi', 'produk_jadi.barang_id', '=', 'barang.barang_id')
            ->select(
                'stok.id_stok',
                'barang.nama_barang',
                'stok.jumlah',
                'stok.satuan',
                'produk_jadi.batch',
                'produk_jadi.tgl_exp',
                'produk_jadi.diproduksi'
            )
            ->get();

        return view('stok.index', compact('stoks'));
    }
}

