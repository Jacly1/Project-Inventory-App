@extends('layouts.backend')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="float-start">Detail Produk Jadi Keluar</div>
                <div class="float-end">
                    <a href="{{ route('keluarproduk.index') }}" class="btn btn-primary btn-sm">&larr; Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-3 row">
                    <label class="col-md-4 col-form-label text-md-end">Nama Barang</label>
                    <div class="col-md-6">
                        <span class="form-control-plaintext">{{ $keluarProduk->barang->nama_barang ?? 'Tidak tersedia' }}</span>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-md-4 col-form-label text-md-end">Jumlah</label>
                    <div class="col-md-6">
                        <span class="form-control-plaintext">{{ $keluarProduk->jumlah }}</span>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-md-4 col-form-label text-md-end">Tanggal Keluar</label>
                    <div class="col-md-6">
                        <span class="form-control-plaintext">{{ $keluarProduk->tgl_keluar }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
