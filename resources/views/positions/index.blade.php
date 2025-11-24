@extends('master')
@section('title', 'Daftar Jabatan')
@section('page-title', 'Data Jabatan')

@section('content')
    <div class="mb-3">
        <a href="{{ route('positions.create') }}" class="btn btn-primary">Tambah Jabatan</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th width="5%">No</th>
                <th>Nama Jabatan</th>
                <th>Gaji Pokok</th>
                <th width="15%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($positions as $position)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $position->nama_jabatan }}</td>
                <td>Rp {{ number_format($position->gaji_pokok, 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('positions.edit', $position->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    
                    <form action="{{ route('positions.destroy', $position->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" 
                                onclick="return confirm('Hapus jabatan ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Belum ada data jabatan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="mt-3">
        {{ $positions->links() }}
    </div>
@endsection