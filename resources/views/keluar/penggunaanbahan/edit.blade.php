@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Edit Produk Jadi Masuk
                </div>
                <div class="float-end">
                    <a href="{{ route('masukproduk.index') }}" class="btn btn-primary btn-sm">&larr; Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('masukproduk.update', $masukProduk->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3 row">
                        <label for="barang_id" class="col-md-4 col-form-label text-md-end text-start">Nama Produk Jadi</label>
                        <div class="col-md-6">
                            <select class="form-select @error('barang_id') is-invalid @enderror" id="barang_id" name="barang_id">
                                <option value="">Pilih Produk Jadi</option>
                                @foreach ($produkJadi as $item)
                                <option value="{{ $item->barang_id }}" {{ $masukProduk->barang_id == $item->barang_id ? 'selected' : '' }}>
                                    {{ $item->barang->nama_barang }}
                                </option>
                                @endforeach
                            </select>
                            @if ($errors->has('barang_id'))
                            <span class="text-danger">{{ $errors->first('barang_id') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jumlah" class="col-md-4 col-form-label text-md-end text-start">Jumlah</label>
                        <div class="col-md-6">
                            <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" value="{{ old('jumlah', $masukProduk->jumlah) }}">
                            @if ($errors->has('jumlah'))
                            <span class="text-danger">{{ $errors->first('jumlah') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="tgl_masuk" class="col-md-4 col-form-label text-md-end text-start">Tanggal Masuk</label>
                        <div class="col-md-6">
                            <input type="date" class="form-control @error('tgl_masuk') is-invalid @enderror" id="tgl_masuk" name="tgl_masuk" value="{{ old('tgl_masuk', $masukProduk->tgl_masuk) }}">
                            @if ($errors->has('tgl_masuk'))
                            <span class="text-danger">{{ $errors->first('tgl_masuk') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Simpan Perubahan">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
