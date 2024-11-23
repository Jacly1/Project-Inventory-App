@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                Tambah Keluaran Bahan Baku dan Kemasan
            </div>
            <div class="card-body">
                <form action="{{ route('keluarbahan.store') }}" method="post">
                    @csrf
                    <div class="mb-3 row">
                        <label class="col-md-4 col-form-label text-md-end">Tanggal Keluar</label>
                        <div class="col-md-6">
                            <input type="date" name="tgl_keluar" class="form-control" required>
                        </div>
                    </div>
                    <hr>
                    <h5>Pilih Bahan Baku</h5>
                    <div class="bahan-baku-container">
                        @foreach($bahanBaku as $bahan)
                        <div class="mb-3 row">
                            <label class="col-md-4 col-form-label text-md-end">{{ $bahan->barang->nama_barang }} (Stok: {{ $bahan->barang->stok->jumlah ?? 0 }})</label>
                            <div class="col-md-6">
                                <input type="number" name="bahan_baku[{{ $bahan->barang_id }}][jumlah]" class="form-control" placeholder="Jumlah keluar">
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <hr>
                    <h5>Pilih Kemasan</h5>
                    <div class="kemasan-container">
                        @foreach($kemasan as $item)
                        <div class="mb-3 row">
                            <label class="col-md-4 col-form-label text-md-end">{{ $item->barang->nama_barang }} (Stok: {{ $item->barang->stok->jumlah ?? 0 }})</label>
                            <div class="col-md-6">
                                <input type="number" name="kemasan[{{ $item->barang_id }}][jumlah]" class="form-control" placeholder="Jumlah keluar">
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
