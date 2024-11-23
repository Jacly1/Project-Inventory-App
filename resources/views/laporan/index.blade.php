<!-- resources/views/laporan/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-4">
        <div class="card-header">
            <h4 class="mb-0">Laporan</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Laporan Stok -->
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <i class="bi bi-box" style="font-size: 2rem;"></i>
                            <h5 class="card-title">Laporan Stok</h5>
                            <p class="card-text">Laporan daftar sisa barang</p>
                            <a href="{{ route('laporan.stok') }}" class="btn btn-primary">Lihat Laporan</a>
                        </div>
                    </div>
                </div>

                <!-- Laporan Kartu Stok -->
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <i class="bi bi-graph-up" style="font-size: 2rem;"></i>
                            <h5 class="card-title">Laporan Kartu Stok</h5>
                            <p class="card-text">Laporan data barang masuk dan keluar</p>
                            <a href="{{ route('laporan.kartustok') }}" class="btn btn-primary">Lihat Laporan</a>
                        </div>
                    </div>
                </div>

                <!-- Laporan Penggunaan Bahan -->
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <i class="bi bi-bar-chart-line" style="font-size: 2rem;"></i>
                            <h5 class="card-title">Laporan Penggunaan Bahan</h5>
                            <p class="card-text">Laporan pemakaian bahan mentah</p>
                            <a href="{{ route('laporan.penggunaan') }}" class="btn btn-primary">Lihat Laporan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
