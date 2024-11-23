@extends('layouts.backend')

@section('content')
<div class="card">
    <div class="card-header text-center">
        <h3>LAPORAN STOK</h3>
    </div>
    <div class="card-body">
        <!-- Form untuk memilih periode tanggal -->
        <form action="{{ route('laporan.stok') }}" method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <label for="start_date">Tanggal Mulai:</label>
                    <input type="date" id="start_date" name="start_date" class="form-control" value="{{ request('start_date') }}" required>
                </div>
                <div class="col-md-4">
                    <label for="end_date">Tanggal Selesai:</label>
                    <input type="date" id="end_date" name="end_date" class="form-control" value="{{ request('end_date') }}" required>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Lihat Laporan</button>
                </div>
            </div>
        </form>

        <p>Tanggal Cetak: {{ $tanggalCetak }}</p>
        @if($startDate && $endDate)
            <p>Periode: {{ $startDate }} - {{ $endDate }}</p>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Jumlah Stok</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stok as $item)
                    <tr>
                        <td>{{ $item->nama_barang }}</td>
                        <td>{{ $item->stok->jumlah ?? 0 }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('laporan.stok.pdf', ['start_date' => $startDate, 'end_date' => $endDate]) }}" class="btn btn-danger">
            Download PDF
        </a>
        <a href="{{ route('laporan.stok.excel', ['start_date' => $startDate, 'end_date' => $endDate]) }}" class="btn btn-success">
            Download Excel
        </a>
    </div>
</div>
@endsection
