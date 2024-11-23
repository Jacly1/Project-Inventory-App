@extends('layouts.backend')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <span>Informasi Data Kemasan</span>
                <a href="{{ route('stokkemasan.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <label class="col-md-4 col-form-label text-md-end text-start"><strong>Name Bahan:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $stokKemasan->nama_barang }}
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-4 col-form-label text-md-end text-start"><strong>Kategori:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $stokKemasan->kategori_barang }}
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-4 col-form-label text-md-end text-start"><strong>Supplier:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $stokKemasan->kemasan->supplier ?? '-' }}
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-4 col-form-label text-md-end text-start"><strong>Jenis Bahan:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $stokKemasan->kemasan->jenis_bahan ?? '-' }}
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-4 col-form-label text-md-end text-start"><strong>Jenis Kemasan:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $stokKemasan->kemasan->jenis_kemasan ?? '-' }}
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-4 col-form-label text-md-end text-start"><strong>Warna Badan:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $stokKemasan->kemasan->warna_badan ?? '-' }}
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-4 col-form-label text-md-end text-start"><strong>Warna Tutup:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $stokKemasan->kemasan->warna_tutup ?? '-' }}
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-4 col-form-label text-md-end text-start"><strong>Volume:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $stokKemasan->kemasan->volume ?? '-' }}
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-4 col-form-label text-md-end text-start"><strong>Harga:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        Rp{{ number_format($stokKemasan->kemasan->harga ?? 0, 2) }}
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-4 col-form-label text-md-end text-start"><strong>Pemeriksa:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $stokKemasan->kemasan->pemeriksa ?? '-' }}
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-4 col-form-label text-md-end text-start"><strong>Keterangan:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $stokKemasan->kemasan->keterangan ?? '-' }}
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-4 col-form-label text-md-end text-start"><strong>Jumlah:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $stokKemasan->stok->jumlah ?? '0' }} {{ $stokKemasan->stok->satuan ?? '' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection