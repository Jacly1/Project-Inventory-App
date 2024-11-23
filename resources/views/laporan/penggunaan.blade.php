@extends('layouts.backend')

@section('content')
<div class="card">
    <div class="card-header text-center">
        <h3>LAPORAN PENGGUNAAN BAHAN</h3>
    </div>
    <div class="card-body">
        <!-- Form untuk memilih periode tanggal -->
        <form action="{{ route('laporan.penggunaan') }}" method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <label for="start_date">Tanggal Mulai:</label>
                    <input type="date" id="start_date" name="start_date" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label for="end_date">Tanggal Selesai:</label>
                    <input type="date" id="end_date" name="end_date" class="form-control" required>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Lihat Laporan</button>
                </div>
            </div>
        </form>

        <!-- Tampilkan hasil laporan jika periode telah ditentukan -->
        @if(isset($penggunaanBahan))
            <p>Tanggal Cetak: {{ now()->format('Y-m-d') }}</p>
            <p>Periode: {{ $startDate }} - {{ $endDate }}</p>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Jumlah Terpakai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($penggunaanBahan as $item)
                        <tr>
                            <td>{{ $item->barang->nama_barang }}</td>
                            <td>{{ $item->total_terpakai }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Tombol download PDF dan Excel -->
            <a href="{{ route('laporan.penggunaan.pdf', ['start_date' => $startDate, 'end_date' => $endDate]) }}" class="btn btn-danger">
                Download PDF
            </a>
            <a href="{{ route('laporan.penggunaan.excel', ['start_date' => $startDate, 'end_date' => $endDate]) }}" class="btn btn-success">
                Download Excel
            </a>
        @endif
    </div>
</div>
@endsection
