@extends('master')
@section('title', 'Edit Departemen')
@section('page-title', 'Edit Data Departemen')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md border border-gray-200">
    <form action="{{ route('departments.update', $department->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">Nama Departemen</label>
            <input type="text" name="nama_departemen" required 
                   value="{{ old('nama_departemen', $department->nama_departemen) }}"
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition">
        </div>

        <div class="flex items-center justify-end space-x-3">
            <a href="{{ route('departments.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition">Batal</a>
            <button type="submit" class="px-4 py-2 bg-yellow-500 text-white font-bold rounded-md hover:bg-yellow-600 transition">Update</button>
        </div>
    </form>
</div>
@endsection