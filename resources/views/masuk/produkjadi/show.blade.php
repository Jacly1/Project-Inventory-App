@extends('layouts.backend')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Detail Produk Jadi Masuk
                </div>
                <div class="float-end">
                    <a href="{{ route('masukproduk.index') }}" class="btn btn-primary btn-sm">&larr; Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-3 row">
                    <label class="col-md-4 col-form-label text-md-end">Nama Barang</label>
                    <div class="col-md-6">
                        <span class="form-control-plaintext">{{ $masukProduk->barang->nama_barang ?? 'Tidak tersedia' }}</span>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-md-4 col-form-label text-md-end">Jumlah</label>
                    <div class="col-md-6">
                        <span class="form-control-plaintext">{{ $masukProduk->jumlah }}</span>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-md-4 col-form-label text-md-end">Tanggal Masuk</label>
                    <div class="col-md-6">
                        <span class="form-control-plaintext">{{ $masukProduk->tgl_masuk }}</span>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-md-4 col-form-label text-md-end">Batch</label>
                    <div class="col-md-6">
                        <span class="form-control-plaintext">{{ $masukProduk->barang->produkJadi->batch ?? '-' }}</span>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-md-4 col-form-label text-md-end">Tanggal Exp</label>
                    <div class="col-md-6">
                        <span class="form-control-plaintext">{{ $masukProduk->barang->produkJadi->tgl_exp ?? '-' }}</span>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-md-4 col-form-label text-md-end">Keterangan</label>
                    <div class="col-md-6">
                        <span class="form-control-plaintext">{{ $masukProduk->barang->produkJadi->keterangan ?? '-' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
