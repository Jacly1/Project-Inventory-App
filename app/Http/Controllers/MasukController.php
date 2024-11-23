<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Masuk;
use App\Models\BahanBaku;
use App\Models\Kemasan;
use App\Models\ProdukJadi;
use App\Models\Barang;
use Illuminate\View\View;

class MasukController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-masuk|edit-masuk|show-masuk|delete-masuk', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-masuk', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-masuk', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-masuk', ['only' => ['destroy']]);
    }

    public function indexBahanBaku()
    {
        // Ambil data masuk dengan barang dan bahan baku
        $bahanBakuMasuk = Masuk::with('barang.bahanBaku')->get();
    
        return view('barangmasuk.bahanbaku.index', compact('bahanBakuMasuk'));
    }
    
    


 

    
    // Tampilkan daftar barang masuk (Bahan Baku, Kemasan, Produk Jadi)
    public function index(): View
    {
        $bahanBaku = BahanBaku::all();

        return view('barangmasuk.bahanbaku.index', [
            'masuks' => Masuk::latest()->paginate(100)
        ]);
    }

    // Tampilkan form untuk menambah barang masuk
    public function create()
    {
        $barangs = \App\Models\Barang::all(); // Ambil semua data barang dari tabel Barang
        return view('masuk.create', compact('barangs')); // Kirim data ke view
    }


    // Simpan data barang masuk ke database
    public function store(Request $request)
    {
        $this->validate($request, [
            'kategori' => 'required',
        ]);

        if ($request->kategori == 'bahan_baku') {
            BahanBaku::create($request->all());
        } elseif ($request->kategori == 'kemasan') {
            Kemasan::create($request->all());
        } elseif ($request->kategori == 'produk_jadi') {
            ProdukJadi::create($request->all());
        }

        return redirect()->route('barangmasuk.index')->with('success', 'Barang berhasil ditambahkan');
    }

    // Tampilkan detail barang
    public function show($id, $kategori)
    {
        if ($kategori == 'bahan_baku') {
            $barang = BahanBaku::findOrFail($id);
        } elseif ($kategori == 'kemasan') {
            $barang = Kemasan::findOrFail($id);
        } elseif ($kategori == 'produk_jadi') {
            $barang = ProdukJadi::findOrFail($id);
        }

        return view('barangmasuk.show', compact('barang', 'kategori'));
    }

    // Tampilkan form edit
    public function edit($id, $kategori)
    {
        if ($kategori == 'bahan_baku') {
            $barang = BahanBaku::findOrFail($id);
        } elseif ($kategori == 'kemasan') {
            $barang = Kemasan::findOrFail($id);
        } elseif ($kategori == 'produk_jadi') {
            $barang = ProdukJadi::findOrFail($id);
        }

        return view('barangmasuk.edit', compact('barang', 'kategori'));
    }

    // Update data barang
    public function update(Request $request, $id, $kategori)
    {
        if ($kategori == 'bahan_baku') {
            $barang = BahanBaku::findOrFail($id);
        } elseif ($kategori == 'kemasan') {
            $barang = Kemasan::findOrFail($id);
        } elseif ($kategori == 'produk_jadi') {
            $barang = ProdukJadi::findOrFail($id);
        }

        $barang->update($request->all());

        return redirect()->route('barangmasuk.index')->with('success', 'Data berhasil diperbarui');
    }

    // Hapus data barang
    public function destroy($id, $kategori)
    {
        if ($kategori == 'bahan_baku') {
            BahanBaku::findOrFail($id)->delete();
        } elseif ($kategori == 'kemasan') {
            Kemasan::findOrFail($id)->delete();
        } elseif ($kategori == 'produk_jadi') {
            ProdukJadi::findOrFail($id)->delete();
        }

        return redirect()->route('barangmasuk.index')->with('success', 'Data berhasil dihapus');
    }

    public function bahanBaku()
    {
        $bahanBaku = BahanBaku::all();
        return view('barangmasuk.bahanbaku.index', compact('bahanBaku'));
    }

    public function kemasan()
    {
        $kemasan = Kemasan::all();
        return view('barangmasuk.kemasan.index', compact('kemasan'));
    }

    public function produkJadi()
    {
        $produkJadi = ProdukJadi::all();
        return view('barangmasuk.produkjadi.index', compact('produkJadi'));
    }

    public function destroyBahanBaku($id)
{
    $bahanBaku = BahanBaku::findOrFail($id); // Cari data berdasarkan ID
    $bahanBaku->delete(); // Hapus data

    return redirect()->route('bahanbaku.index')->with('success', 'Bahan Baku berhasil dihapus.');
}


    
}
