@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Detail Keluaran Bahan Baku dan Kemasan</div>
            <div class="card-body">
                <div class="mb-3 row">
                    <label class="col-md-4 col-form-label text-md-end">Nama Barang</label>
                    <div class="col-md-6">
                        <span class="form-control-plaintext">{{ $keluarBahan->barang->nama_barang }}</span>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-md-4 col-form-label text-md-end">Jumlah</label>
                    <div class="col-md-6">
                        <span class="form-control-plaintext">{{ $keluarBahan->jumlah }}</span>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-md-4 col-form-label text-md-end">Tanggal Keluar</label>
                    <div class="col-md-6">
                        <span class="form-control-plaintext">{{ $keluarBahan->tgl_keluar }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
