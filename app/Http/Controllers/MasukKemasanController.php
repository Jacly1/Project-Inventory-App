<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kemasan;
use App\Models\Masuk;
use App\Models\Barang;

class MasukKemasanController extends Controller
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
        $masukKemasan = Masuk::whereHas('barang', function ($query) {
            $query->where('kategori_barang', 'Kemasan');
        })->paginate(10);

        return view('masuk.kemasan.index', compact('masukKemasan'));
    }

    public function show($id)
    {
        $masukKemasan = Masuk::where('id', $id)
            ->whereHas('barang', function ($query) {
                $query->where('kategori_barang', 'Kemasan');
            })->with(['barang', 'barang.kemasan'])->firstOrFail();

        return view('masuk.kemasan.show', compact('masukKemasan'));
    }

    public function create()
    {
        $kemasan = Kemasan::whereHas('barang', function ($query) {
            $query->where('kategori_barang', 'Kemasan');
        })->get();

        return view('masuk.kemasan.create', compact('kemasan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:kemasan,barang_id',
            'jumlah' => 'required|integer|min:1',
            'tgl_masuk' => 'required|date'
        ]);

        // Menyimpan data kemasan masuk
        $masukKemasan = Masuk::create($request->only(['barang_id', 'jumlah', 'tgl_masuk']));

        // Tambahkan jumlah ke stok barang terkait
        $barang = Barang::find($request->barang_id);
        if ($barang && $barang->stok) {
            $barang->stok->jumlah += $request->jumlah;
            $barang->stok->save();
        }

        return redirect()->route('masukkemasan.index')->with('success', 'Data kemasan masuk berhasil ditambahkan dan stok telah diperbarui');
    }

    public function edit($id)
    {
        $masukKemasan = Masuk::where('id', $id)
            ->whereHas('barang', function ($query) {
                $query->where('kategori_barang', 'Kemasan');
            })->with(['barang', 'barang.kemasan'])->firstOrFail();

        $kemasan = Kemasan::whereHas('barang', function ($query) {
            $query->where('kategori_barang', 'Kemasan');
        })->get();

        return view('masuk.kemasan.edit', compact('masukKemasan', 'kemasan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'barang_id' => 'required|exists:kemasan,barang_id',
            'jumlah' => 'required|integer|min:1',
            'tgl_masuk' => 'required|date'
        ]);

        $masukKemasan = Masuk::findOrFail($id);
        $masukKemasan->update($request->only(['barang_id', 'jumlah', 'tgl_masuk']));

        return redirect()->route('masukkemasan.index')->with('success', 'Data kemasan masuk berhasil diperbarui');
    }

    public function destroy($id)
    {
        $masukKemasan = Masuk::findOrFail($id);

        // Ambil barang terkait dan stoknya
        $barang = Barang::find($masukKemasan->barang_id);

        if ($barang && $barang->stok) {
            // Kurangi jumlah stok dengan jumlah barang yang masuk
            $barang->stok->jumlah -= $masukKemasan->jumlah;
            $barang->stok->save();
        }

        $masukKemasan->delete();

        return redirect()->route('masukkemasan.index')->with('success', 'Data kemasan masuk berhasil dihapus dan stok telah dikembalikan.');
    }
}
