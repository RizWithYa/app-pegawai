@extends('master')
@section('title', 'Daftar Pegawai')
@section('page-title', 'Manajemen Data Pegawai')

@section('content')
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        
        <a href="{{ route('employees.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow transition duration-200 inline-flex items-center">
            <span class="mr-2 text-lg">+</span> Tambah Pegawai
        </a>

        <form action="{{ route('employees.index') }}" method="GET" class="w-full md:w-auto">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>

                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}"
                       class="pl-10 pr-20 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent w-full md:w-72 transition"
                       placeholder="Cari nama atau email...">
                       
                <button type="submit" class="absolute inset-y-0 right-0 px-4 text-sm font-medium text-white bg-blue-600 rounded-r-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 transition">
                    Cari
                </button>
            </div>
        </form>
    </div>

    <div class="overflow-x-auto bg-white border border-gray-200 rounded-lg shadow-sm">
        <table class="min-w-full bg-white overflow-hidden">
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
                               class="bg-cyan-500 hover:bg-cyan-600 text-white text-xs px-3 py-1.5 rounded transition inline-block">
                               Detail
                            </a>
                            <a href="{{ route('employees.edit', $employee->id) }}" 
                               class="bg-yellow-400 hover:bg-yellow-500 text-white text-xs px-3 py-1.5 rounded transition inline-block">
                               Edit
                            </a>
                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus data ini?')">
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
                        <td colspan="6" class="py-8 text-center text-gray-500 italic">
                            @if(request('search'))
                                Tidak ditemukan pegawai dengan kata kunci "<strong>{{ request('search') }}</strong>".
                            @else
                                Belum ada data pegawai.
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{-- PENTING: withQueryString() agar pencarian tidak hilang saat pindah halaman --}}
        {{ $employees->withQueryString()->links() }}
    </div>
@endsection