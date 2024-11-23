@extends('layouts.backend')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <span>Informasi Data Kemasan</span>
                <a href="{{ route('stokproduk.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <label class="col-md-4 col-form-label text-md-end text-start"><strong>Name Bahan:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $stokProduk->nama_barang }}
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-4 col-form-label text-md-end text-start"><strong>Kategori:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $stokProduk->kategori_barang }}
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-4 col-form-label text-md-end text-start"><strong>Batch:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $stokProduk->produkJadi->batch ?? '-' }}
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-4 col-form-label text-md-end text-start"><strong>Tgl Exp:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $stokProduk->produkJadi->tgl_exp ?? '-' }}
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-4 col-form-label text-md-end text-start"><strong>Warna:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $stokProduk->produkJadi->warna ?? '-' }}
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-4 col-form-label text-md-end text-start"><strong>Bentuk:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $stokProduk->produkJadi->bentuk ?? '-' }}
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-4 col-form-label text-md-end text-start"><strong>Bau:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $stokProduk->produkJadi->bau ?? '-' }}
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-4 col-form-label text-md-end text-start"><strong>PH:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $stokProduk->produkJadi->ph ?? '-' }}
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-4 col-form-label text-md-end text-start"><strong>Jumlah Sampel:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $stokProduk->produkJadi->jlh_sampel ?? '-' }}
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-4 col-form-label text-md-end text-start"><strong>Diproduksi Oleh:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $stokProduk->produkJadi->diproduksi ?? '-' }}
                    </div>
                </div>
                
                <div class="row">
                    <label class="col-md-4 col-form-label text-md-end text-start"><strong>Keterangan:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $stokProduk->produkJadi->keterangan ?? '-' }}
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-4 col-form-label text-md-end text-start"><strong>Jumlah:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $stokProduk->stok->jumlah ?? '0' }} {{ $stokProduk->stok->satuan ?? '' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection