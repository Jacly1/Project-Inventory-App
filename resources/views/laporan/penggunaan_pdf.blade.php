<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penggunaan Bahan</title>
    <style>
        /* CSS styling untuk tampilan PDF */
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 5px; text-align: left; }
    </style>
</head>
<body>
    <h3 style="text-align: center;">LAPORAN PENGGUNAAN BAHAN</h3>
    <p>Tanggal Cetak: {{ now()->format('Y-m-d') }}</p>
    <p>Periode: {{ $startDate }} - {{ $endDate }}</p>
    <table>
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
</body>
</html>
