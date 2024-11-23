@extends('layouts.backend')

@section('content')
<div class="container">
    <h2>Tambah Stok Kemasan</h2>
    <form action="{{ route('stokkemasan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Barang</label>
            <input type="text" name="nama" class="form-control" id="nama" required>
        </div>
        <div class="mb-3">
            <label for="supplier" class="form-label">Supplier</label>
            <input type="text" name="supplier" class="form-control" id="supplier">
        </div>
        <div class="mb-3">
            <label for="jenis_bahan" class="form-label">Jenis Bahan</label>
            <select name="jenis_bahan" id="jenis_bahan" class="form-control" >
                <option value="">-- Pilih Jenis Bahan --</option>
                <option value="Kaca">Kaca</option>
                <option value="Plastik">Plastik</option>
                <option value="Aluminium">Aluminium</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="jenis_kemasan" class="form-label">Jenis Kemasan</label>
            <select name="jenis_kemasan" id="jenis_kemasan" class="form-control" >
                <option value="">-- Pilih Jenis Kemasan --</option>
                <option value="Spray">Spray</option>
                <option value="Pipet">Pipet</option>
                <option value="Tube">Tube</option>
                <option value="Jar">Jar</option>
                <option value="Biasa">Biasa</option>
                <option value="Pump">Pump</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="warna_badan" class="form-label">Warna Badan</label>
            <input type="text" name="warna_badan" class="form-control" id="warna_badan">
        </div>
        <div class="mb-3">
            <label for="warna_tutup" class="form-label">Warna Tutup</label>
            <input type="text" name="warna_tutup" class="form-control" id="warna_tutup">
        </div>
        <div class="mb-3">
            <label for="volume" class="form-label">Volume</label>
            <input type="number" name="volume" class="form-control" id="volume">
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" name="harga" class="form-control" id="harga">
        </div>
        <div class="mb-3">
            <label for="satuan" class="form-label">Satuan</label>
            <select name="satuan" id="satuan" class="form-control" required>
                <option value="">-- Pilih Satuan --</option>
                <option value="Buah">Buah</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" name="jumlah" class="form-control" id="jumlah">
        </div>
        <div class="mb-3">
            <label for="pemeriksa" class="form-label">Pemeriksa</label>
            <input type="text" name="pemeriksa" class="form-control" id="pemeriksa">
        </div>
        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <input type="text" name="keterangan" class="form-control" id="keterangan">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection