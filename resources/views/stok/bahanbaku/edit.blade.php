@extends('layouts.backend')

@section('content')
<div class="container">
    <h2>Edit Stok Bahan Baku</h2>
    <form action="{{ route('stokbahan.update', $bahanBaku->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Barang</label>
            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" 
                   value="{{ old('nama', $bahanBaku->barang->nama_barang ?? '') }}" required>
            @error('nama')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>


        <div class="mb-3">
            <label for="supplier" class="form-label">Supplier</label>
            <input type="text" name="supplier" class="form-control @error('supplier') is-invalid @enderror" id="supplier" 
                   value="{{ old('supplier', $bahanBaku->supplier ?? '') }}">
            @error('supplier')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="batch" class="form-label">Batch</label>
            <input type="text" name="batch" class="form-control @error('batch') is-invalid @enderror" id="batch" 
                   value="{{ old('batch', $bahanBaku->batch ?? '') }}">
            @error('batch')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="tgl_exp" class="form-label">Tanggal Expired</label>
            <input type="date" name="tgl_exp" class="form-control @error('tgl_exp') is-invalid @enderror" id="tgl_exp" 
                   value="{{ old('tgl_exp', $bahanBaku->tgl_exp ?? '') }}">
            @error('tgl_exp')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="warna" class="form-label">Warna</label>
            <input type="text" name="warna" class="form-control @error('warna') is-invalid @enderror" id="warna" 
                   value="{{ old('warna', $bahanBaku->warna ?? '') }}">
            @error('warna')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="bentuk" class="form-label">Bentuk</label>
            <select name="bentuk" id="bentuk" class="form-control @error('bentuk') is-invalid @enderror">
                <option value="">-- Pilih Bentuk --</option>
                <option value="Cair" {{ old('bentuk', $bahanBaku->bentuk ?? '') == 'Cair' ? 'selected' : '' }}>Cair</option>
                <option value="Cairan Kental" {{ old('bentuk', $bahanBaku->bentuk ?? '') == 'Cairan Kental' ? 'selected' : '' }}>Cairan Kental</option>
                <option value="Butter" {{ old('bentuk', $bahanBaku->bentuk ?? '') == 'Butter' ? 'selected' : '' }}>Butter</option>
                <option value="Serbuk" {{ old('bentuk', $bahanBaku->bentuk ?? '') == 'Serbuk' ? 'selected' : '' }}>Serbuk</option>
                <option value="Pellet" {{ old('bentuk', $bahanBaku->bentuk ?? '') == 'Pellet' ? 'selected' : '' }}>Pellet</option>
            </select>
            @error('bentuk')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror" id="harga" 
                   value="{{ old('harga', $bahanBaku->harga ?? 0) }}">
            @error('harga')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="satuan" class="form-label">Satuan</label>
            <select name="satuan" id="satuan" class="form-control @error('satuan') is-invalid @enderror" required>
                <option value="">-- Pilih Satuan --</option>
                <option value="Buah" {{ old('satuan', $bahanBaku->barang->stok->satuan ?? '') == 'Buah' ? 'selected' : '' }}>Buah</option>
                <option value="ml" {{ old('satuan', $bahanBaku->barang->stok->satuan ?? '') == 'ml' ? 'selected' : '' }}>ml</option>
                <option value="gr" {{ old('satuan', $bahanBaku->barang->stok->satuan ?? '') == 'gr' ? 'selected' : '' }}>gr</option>
            </select>
            @error('satuan')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" 
                   value="{{ old('jumlah', $bahanBaku->barang->stok->jumlah ?? 0) }}">
            @error('jumlah')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="penyimpanan" class="form-label">Penyimpanan</label>
            <select name="penyimpanan" id="penyimpanan" class="form-control @error('penyimpanan') is-invalid @enderror" required>
                <option value="">-- Pilih Penyimpanan --</option>
                <option value="Suhu Ruang" {{ old('penyimpanan', $bahanBaku->penyimpanan ?? '') == 'Suhu Ruang' ? 'selected' : '' }}>Suhu Ruang</option>
                <option value="Kulkas" {{ old('penyimpanan', $bahanBaku->penyimpanan ?? '') == 'Kulkas' ? 'selected' : '' }}>Kulkas</option>
            </select>
            @error('penyimpanan')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="pemeriksa" class="form-label">Pemeriksa</label>
            <input type="text" name="pemeriksa" class="form-control @error('pemeriksa') is-invalid @enderror" id="pemeriksa" 
                   value="{{ old('pemeriksa', $bahanBaku->pemeriksa ?? '') }}">
            @error('pemeriksa')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <input type="text" name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" 
                   value="{{ old('keterangan', $bahanBaku->keterangan ?? '') }}">
            @error('keterangan')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
