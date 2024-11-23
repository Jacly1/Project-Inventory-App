<!DOCTYPE html>
<html>
<head>
    <title>Laporan Stok</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 5px; text-align: left; }
    </style>
</head>
<body>
    <h3 style="text-align: center;">LAPORAN STOK</h3>
    <p>Tanggal Cetak: {{ $tanggalCetak }}</p>
    @if($startDate && $endDate)
        <p>Periode: {{ $startDate }} - {{ $endDate }}</p>
    @endif
    <table>
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
</body>
</html>
