@extends('master')
@section('title', 'Tambah Departemen')
@section('page-title', 'Tambah Departemen Baru')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md border border-gray-200">
    <form action="{{ route('departments.store') }}" method="POST">
        @csrf
        
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">Nama Departemen</label>
            <input type="text" name="nama_departemen" required placeholder="Contoh: Information Technology"
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
        </div>

        <div class="flex items-center justify-end space-x-3">
            <a href="{{ route('departments.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-bold rounded-md hover:bg-blue-700 transition">Simpan</button>
        </div>
    </form>
</div>
@endsection