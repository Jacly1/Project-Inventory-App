@extends('layouts.backend')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Edit Bahan Masuk
                </div>
                <div class="float-end">
                    <a href="{{ route('masukbahan.index') }}" class="btn btn-primary btn-sm">&larr; Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('masukbahan.update', $masukBahan->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3 row">
                        <label for="barang_id" class="col-md-4 col-form-label text-md-end text-start">Nama Bahan Baku</label>
                        <div class="col-md-6">
                            <select class="form-select @error('barang_id') is-invalid @enderror" id="barang_id" name="barang_id">
                                <option value="">Pilih Bahan Baku</option>
                                @foreach ($bahanBaku as $bahan)
                                <option value="{{ $bahan->barang_id }}" {{ $masukBahan->barang_id == $bahan->barang_id ? 'selected' : '' }}>
                                    {{ $bahan->barang->nama_barang }}
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
                            <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" value="{{ old('jumlah', $masukBahan->jumlah) }}">
                            @if ($errors->has('jumlah'))
                            <span class="text-danger">{{ $errors->first('jumlah') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="tgl_masuk" class="col-md-4 col-form-label text-md-end text-start">Tanggal Masuk</label>
                        <div class="col-md-6">
                            <input type="date" class="form-control @error('tgl_masuk') is-invalid @enderror" id="tgl_masuk" name="tgl_masuk" value="{{ old('tgl_masuk', $masukBahan->tgl_masuk) }}">
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
