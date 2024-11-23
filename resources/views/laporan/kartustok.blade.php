@extends('layouts.backend')

@section('content')
<div class="container">
    <div class="card mb-4">
        <div class="card-header text-center">
            <h4 class="mb-0">Laporan Kartu Stok</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('laporan.kartustok') }}" method="GET">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="start_date" class="form-label">Tanggal Mulai:</label>
                        <input type="date" name="start_date" class="form-control" id="start_date" value="{{ request('start_date') }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="end_date" class="form-label">Tanggal Akhir:</label>
                        <input type="date" name="end_date" class="form-control" id="end_date" value="{{ request('end_date') }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="barang_id" class="form-label">Nama Barang:</label>
                        <select name="barang_id" class="form-control" id="barang_id">
                            @foreach($barangList as $barang)
                                <option value="{{ $barang->id }}" {{ request('barang_id') == $barang->id ? 'selected' : '' }}>{{ $barang->nama_barang }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Lihat Laporan</button>
                <a href="{{ route('laporan.kartustok.pdf', ['barang_id' => request('barang_id'), 'start_date' => request('start_date'), 'end_date' => request('end_date')]) }}" class="btn btn-danger">Download PDF</a>
                <a href="{{ route('laporan.kartustok.excel', ['barang_id' => request('barang_id'), 'start_date' => request('start_date'), 'end_date' => request('end_date')]) }}" class="btn btn-success">Download Excel</a>
            </form>

            @if(isset($barang))
            <hr>
            <h5>Periode: {{ $startDate }} - {{ $endDate }}</h5>
            <h5>Nama Barang: {{ $barang->nama_barang }}</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tanggal Masuk</th>
                        <th>Tanggal Keluar</th>
                        <th>Sisa Stok</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @php $sisaStok = $barang->stok->jumlah ?? 0; @endphp

                    @foreach($masuk as $masukItem)
                        <tr>
                            <td>{{ $masukItem->tgl_masuk }}</td>
                            <td>-</td>
                            <td>{{ $sisaStok }}</td>
                            <td>-</td>
                        </tr>
                    @endforeach

                    @foreach($keluar as $keluarItem)
                        <tr>
                            <td>-</td>
                            <td>{{ $keluarItem->tgl_keluar }}</td>
                            <td>{{ $sisaStok -= $keluarItem->jumlah }}</td>
                            <td>{{ $keluarItem->nama_barang_jadi ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
</div>
@endsection
