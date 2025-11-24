@extends('master')
@section('title', 'Data Gaji')
@section('page-title', 'Riwayat Penggajian')

@section('content')
    <div class="mb-3">
        <a href="{{ route('salaries.create') }}" class="btn btn-primary">Input Gaji Baru</a>
    </div>

    <table class="table table-hover table-bordered">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Pegawai</th>
                <th>Bulan/Tahun</th>
                <th>Total Gaji</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($salaries as $salary)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $salary->employee?->nama_lengkap ?? 'Pegawai Terhapus' }}</td>
                <td>{{ $salary->bulan }}</td>
                <td class="fw-bold">Rp {{ number_format($salary->total_gaji, 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('salaries.edit', $salary->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    
                    <form action="{{ route('salaries.destroy', $salary->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" 
                                onclick="return confirm('Hapus data gaji ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Belum ada data penggajian.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-3">
        {{ $salaries->links() }}
    </div>
@endsection