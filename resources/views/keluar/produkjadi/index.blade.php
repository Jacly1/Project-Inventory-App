@extends('layouts.backend')

@section('content')
<div class="card">
    <div class="card-header">Daftar Produk Jadi Keluar</div>
    <div class="btn-group mb-3" role="group" aria-label="Jenis Barang">
            <a href="{{ route('keluarproduk.index') }}" class="btn btn-outline-primary {{ request()->is('/keluarproduk') ? 'active' : '' }}">
                Produk Jadi
            </a>
            <a href="{{ route('keluarbahan.index') }}" class="btn btn-outline-secondary {{ request()->is('/keluarbahan') ? 'active' : '' }}">
                Pengurangan Bahan
            </a>
        </div>
    
    <div class="card-body">
        <a href="{{ route('keluarproduk.create') }}" class="btn btn-success btn-sm my-2">
            <i class="bi bi-plus-circle"></i> Tambah Produk Jadi Keluar
        </a>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Tanggal Keluar</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($keluarProduk as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->barang->nama_barang }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>{{ $item->tgl_keluar }}</td>
                    <td>
                        <form action="{{ route('keluarproduk.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('keluarproduk.show', $item->id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-eye"></i> Show
                            </a>
                            <a href="{{ route('keluarproduk.edit', $item->id) }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">No Records Found!</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{ $keluarProduk->links() }}
    </div>
</div>
@endsection
