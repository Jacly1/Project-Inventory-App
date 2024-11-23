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
        <a href="{{ route('stokproduk.create') }}" class="btn btn-success btn-sm my-2">
            <i class="bi bi-plus-circle"></i> Add New Stock
        </a>
        @endcan




        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Batch</th>
                    <th scope="col">Tgl Exp</th>
                    <th scope="col">Warna</th>
                    <th scope="col">Bentuk</th>
                    <th scope="col">PH</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Diproduksi Oleh</th>
                    <th scope="col">Jumlah Sampel</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($stokproduk as $sp)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $sp->nama_barang ?? '-' }}</td>
                    <td>{{ $sp->produkJadi->batch ?? '-' }}</td>
                    <td>{{ $sp->produkJadi->tgl_exp ?? '-' }}</td>
                    <td>{{ $sp->produkJadi->warna ?? '-' }}</td>
                    <td>{{ $sp->produkJadi->bentuk ?? '-' }}</td>
                    <td>{{ $sp->produkJadi->ph ?? '-' }}</td>
                    <td>{{ $sp->stok->jumlah ?? '-' }}</td>
                    <td>{{ $sp->produkJadi->diproduksi ?? '-' }}</td>
                    <td>{{ $sp->produkJadi->jlh_sampel ?? '-' }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Actions">
                            <a href="{{ route('stokproduk.show', $sp->id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-eye"></i> Show
                            </a>
                            @can('edit-stok')
                            <a href="{{ route('stokbahan.edit', $sp->id) }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            @endcan
                            @can('delete-stok')
                            <form action="{{ route('stokbahan.destroy', $sp->id) }}" method="post" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this stock?');">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                            @endcan
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center">
                        <span class="text-danger"><strong>No Stocks Found!</strong></span>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{ $stokproduk->links() }}
    </div>
</div>
@endsection