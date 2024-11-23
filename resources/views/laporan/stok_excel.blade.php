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
