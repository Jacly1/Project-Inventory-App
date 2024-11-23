@extends('layouts.backend')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="float-start">Tambah Produk Jadi Keluar</div>
                <div class="float-end">
                    <a href="{{ route('keluarproduk.index') }}" class="btn btn-primary btn-sm">&larr; Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('keluarproduk.store') }}" method="post">
                    @csrf
                    <div class="mb-3 row">
                        <label for="barang_id" class="col-md-4 col-form-label text-md-end text-start">Nama Produk Jadi</label>
                        <div class="col-md-6">
                            <select class="form-select @error('barang_id') is-invalid @enderror" id="barang_id" name="barang_id">
                                <option value="">Pilih Produk Jadi</option>
                                @foreach ($produkJadi as $item)
                                    <option value="{{ $item->barang_id }}">{{ $item->barang->nama_barang }}</option>
                                @endforeach
                            </select>
                            @error('barang_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jumlah" class="col-md-4 col-form-label text-md-end text-start">Jumlah</label>
                        <div class="col-md-6">
                            <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" value="{{ old('jumlah') }}">
                            @error('jumlah') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="tgl_keluar" class="col-md-4 col-form-label text-md-end text-start">Tanggal Keluar</label>
                        <div class="col-md-6">
                            <input type="date" class="form-control @error('tgl_keluar') is-invalid @enderror" id="tgl_keluar" name="tgl_keluar" value="{{ old('tgl_keluar') }}">
                            @error('tgl_keluar') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Tambah Produk Jadi Keluar">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
