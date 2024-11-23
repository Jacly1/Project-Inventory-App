@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header text-center">
            <h3>LAPORAN KARTU STOK</h3>
            <p>Periode: {{ $startDate }} - {{ $endDate }}</p>
            <p>Nama Barang: {{ $barang->nama_barang }}</p>
        </div>
        <div class="card-body">
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
        </div>
    </div>
</div>
@endsection
