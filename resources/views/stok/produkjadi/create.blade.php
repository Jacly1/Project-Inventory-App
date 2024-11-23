@extends('layouts.backend')

@section('content')
<div class="container">
    <h2>Tambah Produk Jadi</h2>
    <form action="{{ route('stokproduk.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Barang</label>
            <input type="text" name="nama" class="form-control" id="nama" required>
        </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" name="jumlah" class="form-control" id="jumlah" required>
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
            <input type="text" name="bentuk" class="form-control" id="bentuk">
        </div>
        <div class="mb-3">
            <label for="bau" class="form-label">Bau</label>
            <input type="text" name="bau" class="form-control" id="bau">
        </div>
        <div class="mb-3">
            <label for="ph" class="form-label">PH</label>
            <input type="number" name="ph" class="form-control" id="ph" step="0.1" min="0" max="14" required>
        </div>
        <div class="mb-3">
            <label for="jlh_sampel" class="form-label">Jumlah Sampel</label>
            <input type="number" name="jlh_sampel" class="form-control" id="jlh_sampel">
        </div>
        <div class="mb-3">
            <label for="diproduksi" class="form-label">Diproduksi Oleh</label>
            <input type="text" name="diproduksi" class="form-control" id="diproduksi">
        </div>
        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <input type="text" name="keterangan" class="form-control" id="keterangan">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection