@extends('master')

{{-- Judul Tab Browser --}}
@section('title', 'Daftar Pegawai')

{{-- Judul Halaman (akan muncul di header master) --}}
@section('page-title', 'Manajemen Data Pegawai')

@section('content')
    {{-- 1. Tombol Tambah Data (Menggunakan Style Bootstrap) --}}
    <div class="mb-3">
        <a href="{{ route('employees.create') }}" class="btn btn-primary">
            + Tambah Pegawai Baru
        </a>
    </div>

    {{-- 2. Tabel Responsif dengan Class Bootstrap --}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Lengkap & Email</th>
                    <th>Departemen</th> <th>Jabatan</th>    <th>Tanggal Masuk</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($employees as $employee)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <strong>{{ $employee->nama_lengkap }}</strong><br>
                            <span class="text-muted small">{{ $employee->email }}</span>
                        </td>
                        
                        {{-- 3. Menampilkan Data Relasi (Menggunakan Safe Navigation) --}}
                        <td>{{ $employee->department?->nama_departemen ?? '-' }}</td>
                        <td>{{ $employee->position?->nama_jabatan ?? '-' }}</td>
                        
                        <td>{{ $employee->tanggal_masuk }}</td>
                        
                        {{-- 4. Status dengan Badge Warna --}}
                        <td class="text-center">
                            <span class="badge bg-{{ $employee->status == 'aktif' ? 'success' : 'secondary' }}">
                                {{ ucfirst($employee->status) }}
                            </span>
                        </td>

                        {{-- 5. Tombol Aksi yang Lebih Rapi --}}
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-sm btn-info text-white">Detail</a>
                                <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                
                                <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data {{ $employee->nama_lengkap }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    {{-- Tampilan jika data kosong --}}
                    <tr>
                        <td colspan="7" class="text-center p-4">
                            <em>Belum ada data pegawai. Silakan tambah data baru.</em>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- 6. Navigasi Halaman (Pagination) --}}
    <div class="mt-3">
        {{ $employees->links() }}
    </div>
@endsection