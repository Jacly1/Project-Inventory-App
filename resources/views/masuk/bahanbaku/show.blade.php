@extends('layouts.backend')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Detail Bahan Masuk
                </div>
                <div class="float-end">
                    <a href="{{ route('masukbahan.index') }}" class="btn btn-primary btn-sm">&larr; Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-3 row">
                    <label class="col-md-4 col-form-label text-md-end">Nama Barang</label>
                    <div class="col-md-6">
                        <span class="form-control-plaintext">{{ $masukBahan->barang->nama_barang ?? 'Tidak tersedia' }}</span>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-md-4 col-form-label text-md-end">Jumlah</label>
                    <div class="col-md-6">
                        <span class="form-control-plaintext">{{ $masukBahan->jumlah }}</span>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-md-4 col-form-label text-md-end">Tanggal Masuk</label>
                    <div class="col-md-6">
                        <span class="form-control-plaintext">{{ $masukBahan->tgl_masuk }}</span>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-md-4 col-form-label text-md-end">Supplier</label>
                    <div class="col-md-6">
                        <span class="form-control-plaintext">{{ $masukBahan->barang->bahanBaku->supplier ?? '-' }}</span>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-md-4 col-form-label text-md-end">Harga</label>
                    <div class="col-md-6">
                        <span class="form-control-plaintext">{{ $masukBahan->barang->bahanBaku->harga ?? '-' }}</span>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-md-4 col-form-label text-md-end">Tanggal Exp</label>
                    <div class="col-md-6">
                        <span class="form-control-plaintext">{{ $masukBahan->barang->bahanBaku->tgl_exp ?? '-' }}</span>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-md-4 col-form-label text-md-end">Keterangan</label>
                    <div class="col-md-6">
                        <span class="form-control-plaintext">{{ $masukBahan->barang->bahanBaku->keterangan ?? '-' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
