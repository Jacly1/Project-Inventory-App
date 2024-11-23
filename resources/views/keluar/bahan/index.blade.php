@extends('layouts.backend')

@section('content')
<div class="card">
    <div class="card-header">Daftar Keluaran Bahan Baku dan Kemasan</div>
    
    <div class="card-body">
        <a href="{{ route('keluarbahan.create') }}" class="btn btn-success btn-sm my-2">
            <i class="bi bi-plus-circle"></i> Tambah Keluaran
        </a>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang Jadi</th>
                    <th>Tanggal Keluar</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($keluarBahan as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_barang_jadi }}</td>
                    <td>{{ $item->tgl_keluar }}</td>
                    <td>
                        <a href="{{ route('keluarbahan.show', $item->id) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-eye"></i> Show
                        </a>
                        <a href="{{ route('keluarbahan.edit', $item->id) }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">No Records Found!</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{ $keluarBahan->links() }}
    </div>
</div>
@endsection
