@extends('layouts.backend')

@section('content')
<div class="container">
    <h2>Tambah Stok Bahan Baku</h2>
    <form action="{{ route('stokbahan.store') }}" method="POST">
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
            <label for="batch" class="form-label">Batch</label>
            <input type="text" name="batch" class="form-control" id="batch">
        </div>
        <div class="mb-3">
            <label for="tgl_exp" class="form-label">Tanggal Expired</label>
            <input type="date" name="tgl_exp" class="form-control" id="tgl_exp">
        </div>
        <div class="mb-3">
            <label for="warna" class="form-label">Warna</label>
            <input type="text" name="warna" class="form-control" id="warna">
        </div>
        <div class="mb-3">
            <label for="bentuk" class="form-label">Bentuk</label>
            <select name="bentuk" id="bentuk" class="form-control" >
                <option value="">-- Pilih Bentuk --</option>
                <option value="Cair">Cair</option>
                <option value="Cairan Kental">Cairan Kental</option>
                <option value="Butter">Butter</option>
                <option value="Serbuk">Serbuk</option>
                <option value="Pellet">Pellet</option>
            </select>
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
                <option value="ml">ml</option>
                <option value="gr">gr</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" name="jumlah" class="form-control" id="jumlah">
        </div>
        <div class="mb-3">
            <label for="penyimpanan" class="form-label">Penyimpanan</label>
            <select name="penyimpanan" id="penyimpanan" class="form-control" required>
                <option value="">-- Pilih Penyimpanan --</option>
                <option value="Suhu Ruang">Suhu Ruang</option>
                <option value="Kulkas">Kulkas</option>
            </select>
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