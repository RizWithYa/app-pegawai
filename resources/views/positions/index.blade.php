@extends('master')
@section('title', 'Daftar Jabatan')
@section('page-title', 'Manajemen Jabatan')

@section('content')
    <div class="mb-6">
        <a href="{{ route('positions.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow transition duration-200 inline-flex items-center">
            <span class="mr-2">+</span> Tambah Jabatan
        </a>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">
        <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="py-3 px-4 text-left text-sm font-bold uppercase tracking-wider w-16">No</th>
                    <th class="py-3 px-4 text-left text-sm font-bold uppercase tracking-wider">Nama Jabatan</th>
                    <th class="py-3 px-4 text-left text-sm font-bold uppercase tracking-wider">Gaji Pokok</th>
                    <th class="py-3 px-4 text-center text-sm font-bold uppercase tracking-wider w-40">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($positions as $position)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-3 px-4 text-gray-700 font-medium">{{ $loop->iteration }}</td>
                        <td class="py-3 px-4 text-gray-800 font-semibold">{{ $position->nama_jabatan }}</td>
                        <td class="py-3 px-4 text-gray-600 font-mono">
                            Rp {{ number_format($position->gaji_pokok, 0, ',', '.') }}
                        </td>
                        <td class="py-3 px-4 text-center space-x-2">
                            <a href="{{ route('positions.edit', $position->id) }}" 
                               class="bg-yellow-400 hover:bg-yellow-500 text-white text-xs px-3 py-1.5 rounded transition">
                                Edit
                            </a>
                            <form action="{{ route('positions.destroy', $position->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus jabatan ini?')">
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
                        <td colspan="4" class="py-6 text-center text-gray-500 italic">
                            Belum ada data jabatan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $positions->links() }}
    </div>
@endsection