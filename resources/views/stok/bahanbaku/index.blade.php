@extends('layouts.backend')

@section('content')
<div class="card">
    <div class="card-header">Stock Bahan Baku List</div>
    
    <div class="card-body">
        <div class="btn-group mb-3" role="group" aria-label="Jenis Barang">
            <a href="{{ route('stokbahan.index') }}" class="btn btn-outline-primary {{ request()->is('stok/bahanbaku') ? 'active' : '' }}">
                Bahan Baku
            </a>
            <a href="{{ route('stokkemasan.index') }}" class="btn btn-outline-secondary {{ request()->is('stok/kemasan') ? 'active' : '' }}">
                Kemasan
            </a>
            <a href="{{ route('stokproduk.index') }}" class="btn btn-outline-secondary {{ request()->is('stok/barangjadi') ? 'active' : '' }}">
                Produk Jadi
            </a>
        </div>

        @can('create-stok')
        <a href="{{ route('stokbahan.create') }}" class="btn btn-success btn-sm my-2">
            <i class="bi bi-plus-circle"></i> Add New Stock
        </a>
        @endcan

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Supplier</th>
                    <th scope="col">Exp Date</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($stokbahan as $sb)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $sb->nama_barang }}</td>
                    <td>{{ $sb->bahanBaku->supplier ?? '-' }}</td> <!-- Tambahkan null coalescing -->
                    <td>{{ $sb->bahanBaku->tgl_exp ?? '-' }}</td> <!-- Pastikan relasi benar -->
                    <td>{{ $sb->bahanBaku->harga ?? '-' }}</td>
                    <td>{{ $sb->stok->jumlah ?? '0' }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Actions">
                            <a href="{{ route('stokbahan.show', $sb->id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-eye"></i> Show
                            </a>
                            @can('edit-stok')
                            <a href="{{ route('stokbahan.edit', $sb->id) }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            @endcan
                            @can('delete-stok')
                            <form action="{{ route('stokbahan.destroy', $sb->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>


                            @endcan
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">
                        <span class="text-danger"><strong>No Stocks Found!</strong></span>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{ $stokbahan->links() }}
    </div>
</div>
@endsection