@extends('master')
@section('title', 'Tambah Jabatan')
@section('page-title', 'Tambah Jabatan Baru')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md border border-gray-200">
    <form action="{{ route('positions.store') }}" method="POST">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Nama Jabatan</label>
                <input type="text" name="nama_jabatan" required placeholder="Contoh: Senior Developer"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Gaji Pokok (Rp)</label>
                <input type="number" name="gaji_pokok" required placeholder="Contoh: 5000000"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
            </div>
        </div>

        <div class="flex items-center justify-end space-x-3 border-t border-gray-100 pt-4">
            <a href="{{ route('positions.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-bold rounded-md hover:bg-blue-700 transition">Simpan Data</button>
        </div>
    </form>
</div>
@endsection