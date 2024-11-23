@extends('layouts.backend')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                Tambah Keluaran Bahan Baku dan Kemasan
            </div>
            <div class="card-body">
                <form action="{{ route('keluarbahan.store') }}" method="post">
                    @csrf
                    <div class="mb-3 row">
                        <label for="kategori" class="col-md-4 col-form-label text-md-end">Kategori</label>
                        <div class="col-md-6">
                            <select name="kategori" id="kategori" class="form-control" required onchange="toggleKategori()">
                                <option value="produk_jadi">Produk Jadi</option>
                                <option value="pengurangan_bahan">Pengurangan Bahan</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="tgl_keluar" class="col-md-4 col-form-label text-md-end">Tanggal Keluar</label>
                        <div class="col-md-6">
                            <input type="date" name="tgl_keluar" class="form-control" required>
                        </div>
                    </div>
                    <div id="pengurangan-bahan-fields" style="display:none;">
                        <div class="mb-3 row">
                            <label for="nama_barang_jadi" class="col-md-4 col-form-label text-md-end">Nama Barang Jadi</label>
                            <div class="col-md-6">
                                <input type="text" name="nama_barang_jadi" class="form-control">
                            </div>
                        </div>
                        <hr>
                        <h5>Pilih Bahan Baku</h5>
                        <div id="bahan-baku-wrapper"></div>
                        <button type="button" class="btn btn-secondary mb-3" onclick="addBahanBaku()">Tambah Bahan Baku</button>
                        <hr>
                        <h5>Pilih Kemasan</h5>
                        <div id="kemasan-wrapper"></div>
                        <button type="button" class="btn btn-secondary mb-3" onclick="addKemasan()">Tambah Kemasan</button>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function toggleKategori() {
    const kategori = document.getElementById('kategori').value;
    const penguranganBahanFields = document.getElementById('pengurangan-bahan-fields');
    if (kategori === 'pengurangan_bahan') {
        penguranganBahanFields.style.display = 'block';
    } else {
        penguranganBahanFields.style.display = 'none';
    }
}

function addBahanBaku() {
    const wrapper = document.getElementById('bahan-baku-wrapper');
    const index = wrapper.children.length / 2;

    const bahanBakuDiv = document.createElement('div');
    bahanBakuDiv.className = 'mb-3 row';
    bahanBakuDiv.innerHTML = `
        <label for="bahan_baku[${index}][barang_id]" class="col-md-4 col-form-label text-md-end">Nama Bahan</label>
        <div class="col-md-6">
            <select name="bahan_baku[${index}][barang_id]" class="form-control" required>
                @foreach($bahanBaku as $bahan)
                <option value="{{ $bahan->barang_id }}">{{ $bahan->barang->nama_barang }} (Stok: {{ $bahan->barang->stok->jumlah ?? 0 }})</option>
                @endforeach
            </select>
        </div>
    `;
    wrapper.appendChild(bahanBakuDiv);

    const jumlahDiv = document.createElement('div');
    jumlahDiv.className = 'mb-3 row';
    jumlahDiv.innerHTML = `
        <label for="bahan_baku[${index}][jumlah]" class="col-md-4 col-form-label text-md-end">Jumlah</label>
        <div class="col-md-6">
            <input type="number" class="form-control" name="bahan_baku[${index}][jumlah]" required>
        </div>
    `;
    wrapper.appendChild(jumlahDiv);
}

function addKemasan() {
    const wrapper = document.getElementById('kemasan-wrapper');
    const index = wrapper.children.length / 2;

    const kemasanDiv = document.createElement('div');
    kemasanDiv.className = 'mb-3 row';
    kemasanDiv.innerHTML = `
        <label for="kemasan[${index}][barang_id]" class="col-md-4 col-form-label text-md-end">Nama Kemasan</label>
        <div class="col-md-6">
            <select name="kemasan[${index}][barang_id]" class="form-control" required>
                @foreach($kemasan as $item)
                <option value="{{ $item->barang_id }}">{{ $item->barang->nama_barang }} (Stok: {{ $item->barang->stok->jumlah ?? 0 }})</option>
                @endforeach
            </select>
        </div>
    `;
    wrapper.appendChild(kemasanDiv);

    const jumlahDiv = document.createElement('div');
    jumlahDiv.className = 'mb-3 row';
    jumlahDiv.innerHTML = `
        <label for="kemasan[${index}][jumlah]" class="col-md-4 col-form-label text-md-end">Jumlah</label>
        <div class="col-md-6">
            <input type="number" class="form-control" name="kemasan[${index}][jumlah]" required>
        </div>
    `;
    wrapper.appendChild(jumlahDiv);
}
</script>
@endsection
