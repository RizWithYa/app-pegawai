@extends('master')
@section('title', 'Daftar Departemen')
@section('page-title', 'Manajemen Departemen')

@section('content')
    <div class="mb-6">
        <a href="{{ route('departments.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow transition duration-200 inline-flex items-center">
            <span class="mr-2 text-xl font-bold">+</span> Tambah Departemen
        </a>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-sm font-bold uppercase tracking-wider w-16">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-sm font-bold uppercase tracking-wider">
                        Nama Departemen
                    </th>
                    <th scope="col" class="px-6 py-3 text-center text-sm font-bold uppercase tracking-wider w-40">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($departments as $department)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-medium">
                            {{ $loop->iteration }}
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                            {{ $department->nama_departemen }}
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium space-x-2">
                            <a href="{{ route('departments.edit', $department->id) }}" 
                               class="inline-block bg-yellow-400 hover:bg-yellow-500 text-white text-xs px-3 py-1.5 rounded transition shadow-sm">
                                Edit
                            </a>
                            
                            <form action="{{ route('departments.destroy', $department->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus departemen {{ $department->nama_departemen }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="inline-block bg-red-500 hover:bg-red-600 text-white text-xs px-3 py-1.5 rounded transition shadow-sm">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-10 text-center text-gray-500 italic bg-gray-50">
                            <p class="mb-2">Data departemen belum tersedia.</p>
                            <a href="{{ route('departments.create') }}" class="text-blue-600 hover:underline text-sm">Tambah data sekarang</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4 px-2">
        {{ $departments->links() }}
    </div>
@endsection