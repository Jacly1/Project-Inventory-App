@extends('layouts.backend')

@section('content')
<div class="card">
    <div class="card-header">Daftar Bahan Masuk</div>
    
    <div class="card-body">
        <div class="btn-group mb-3" role="group" aria-label="Jenis Barang">
            <a href="{{ route('masukbahan.index') }}" class="btn btn-outline-primary {{ request()->is('masuk/bahanbaku') ? 'active' : '' }}">
                Bahan Baku
            </a>
            <a href="{{ route('masukkemasan.index') }}" class="btn btn-outline-secondary {{ request()->is('masuk/kemasan') ? 'active' : '' }}">
                Kemasan
            </a>
            <a href="{{ route('masukproduk.index') }}" class="btn btn-outline-secondary {{ request()->is('masuk/barangjadi') ? 'active' : '' }}">
                Produk Jadi
            </a>
        </div>

        <a href="{{ route('masukbahan.create') }}" class="btn btn-success btn-sm my-2">
            <i class="bi bi-plus-circle"></i> Tambah Bahan Masuk
        </a>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Tanggal Masuk</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($masukBahan as $item)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $item->barang->nama_barang }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>{{ $item->tgl_masuk }}</td>
                    <td>
                        <form action="{{ route('masukbahan.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('masukbahan.show', $item->id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-eye"></i> Show
                            </a>
                            @can('edit-masuk')
                            <a href="{{ route('masukbahan.edit', $item->id) }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            @endcan
                            @can('delete-masuk')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                            @endcan
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">
                        <span class="text-danger"><strong>No Records Found!</strong></span>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{ $masukBahan->links() }}
    </div>
</div>
@endsection
