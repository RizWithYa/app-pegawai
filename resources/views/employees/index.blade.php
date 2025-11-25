@extends('master')
@section('title', 'Daftar Pegawai')
@section('page-title', 'Manajemen Data Pegawai')

@section('content')
    <div class="mb-6">
        <a href="{{ route('employees.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow transition duration-200">
            + Tambah Pegawai Baru
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg overflow-hidden">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="py-3 px-4 text-left text-sm font-semibold uppercase tracking-wider">No</th>
                    <th class="py-3 px-4 text-left text-sm font-semibold uppercase tracking-wider">Nama & Email</th>
                    <th class="py-3 px-4 text-left text-sm font-semibold uppercase tracking-wider">Departemen</th>
                    <th class="py-3 px-4 text-left text-sm font-semibold uppercase tracking-wider">Jabatan</th>
                    <th class="py-3 px-4 text-center text-sm font-semibold uppercase tracking-wider">Status</th>
                    <th class="py-3 px-4 text-center text-sm font-semibold uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($employees as $employee)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-3 px-4 text-gray-700">{{ $loop->iteration }}</td>
                        <td class="py-3 px-4">
                            <div class="font-medium text-gray-900">{{ $employee->nama_lengkap }}</div>
                            <div class="text-sm text-gray-500">{{ $employee->email }}</div>
                        </td>
                        <td class="py-3 px-4 text-gray-700">{{ $employee->department?->nama_departemen ?? '-' }}</td>
                        <td class="py-3 px-4 text-gray-700">{{ $employee->position?->nama_jabatan ?? '-' }}</td>
                        <td class="py-3 px-4 text-center">
                            <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full 
                                {{ $employee->status == 'aktif' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ ucfirst($employee->status) }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-center space-x-1">
                            <a href="{{ route('employees.show', $employee->id) }}" 
                               class="bg-cyan-500 hover:bg-cyan-600 text-white text-xs px-3 py-1.5 rounded transition">
                               Detail
                            </a>
                            <a href="{{ route('employees.edit', $employee->id) }}" 
                               class="bg-yellow-400 hover:bg-yellow-500 text-white text-xs px-3 py-1.5 rounded transition">
                               Edit
                            </a>
                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="bg-red-500 hover:bg-red-600 text-white text-xs px-3 py-1.5 rounded transition">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-6 text-center text-gray-500 italic">
                            Belum ada data pegawai.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $employees->links() }}
    </div>
@endsection