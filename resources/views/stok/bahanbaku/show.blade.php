@extends('layouts.backend')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <span>Informasi Data Barang</span>
                <a href="{{ route('stokbahan.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <label class="col-md-4 col-form-label text-md-end text-start"><strong>Name Bahan:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $stokBahan->nama_barang }}
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-4 col-form-label text-md-end text-start"><strong>Kategori:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $stokBahan->kategori_barang }}
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-4 col-form-label text-md-end text-start"><strong>Supplier:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $stokBahan->bahanBaku->supplier ?? '-' }}
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-4 col-form-label text-md-end text-start"><strong>Batch:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $stokBahan->bahanBaku->batch ?? '-' }}
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-4 col-form-label text-md-end text-start"><strong>Tgl Exp:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $stokBahan->bahanBaku->tgl_exp ?? '-' }}
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-4 col-form-label text-md-end text-start"><strong>Warna:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $stokBahan->bahanBaku->warna ?? '-' }}
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-4 col-form-label text-md-end text-start"><strong>Bentuk:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $stokBahan->bahanBaku->bentuk ?? '-' }}
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-4 col-form-label text-md-end text-start"><strong>Harga:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        Rp{{ number_format($stokBahan->bahanBaku->harga ?? 0, 2) }}
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-4 col-form-label text-md-end text-start"><strong>Penyimpanan:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $stokBahan->bahanBaku->penyimpanan ?? '-' }}
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-4 col-form-label text-md-end text-start"><strong>Pemeriksa:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $stokBahan->bahanBaku->pemeriksa ?? '-' }}
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-4 col-form-label text-md-end text-start"><strong>Keterangan:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $stokBahan->bahanBaku->keterangan ?? '-' }}
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-4 col-form-label text-md-end text-start"><strong>Jumlah:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $stokBahan->stok->jumlah ?? '0' }} {{ $stokBahan->stok->satuan ?? '' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection