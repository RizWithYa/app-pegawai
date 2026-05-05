@extends('master')
@section('title', 'Edit Pegawai')
@section('page-title', 'Edit Data Pegawai')

@section('content')
<div class="bg-white p-8 rounded-lg shadow-md border border-gray-200">
    <form action="{{ route('employees.update', $employee->id) }}" method="POST">
        @csrf
        @method('PUT')

        <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">Identitas Diri</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" required 
                       value="{{ old('nama_lengkap', $employee->nama_lengkap) }}"
                       class="w-full px-3 py-2 border {{ $errors->has('nama_lengkap') ? 'border-red-500' : 'border-gray-300' }} rounded-md focus:ring-2 focus:ring-yellow-500 focus:outline-none">
                @error('nama_lengkap') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <input type="email" name="email" required 
                       value="{{ old('email', $employee->email) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 focus:outline-none">
            </div>
        </div>

        <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4 mt-6">Posisi Kerja</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Departemen</label>
                <select name="departemen_id" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 bg-white">
                    <option value="">-- Pilih Departemen --</option>
                    @foreach($departments as $dept)
                        <option value="{{ $dept->id }}" {{ $employee->departemen_id == $dept->id ? 'selected' : '' }}>
                            {{ $dept->nama_departemen }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Jabatan</label>
                <select name="jabatan_id" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 bg-white">
                    <option value="">-- Pilih Jabatan --</option>
                    @foreach($positions as $pos)
                        <option value="{{ $pos->id }}" {{ $employee->jabatan_id == $pos->id ? 'selected' : '' }}>
                            {{ $pos->nama_jabatan }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" required 
                       value="{{ old('tanggal_lahir', $employee->tanggal_lahir) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500">
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Tanggal Masuk</label>
                <input type="date" name="tanggal_masuk" required 
                       value="{{ old('tanggal_masuk', $employee->tanggal_masuk) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500">
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">No. Telepon</label>
                <input type="text" name="nomor_telepon" required 
                       value="{{ old('nomor_telepon', $employee->nomor_telepon) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500">
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">Alamat</label>
            <textarea name="alamat" rows="3" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500">{{ old('alamat', $employee->alamat) }}</textarea>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">Status</label>
            <select name="status" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 bg-white">
                <option value="aktif" {{ $employee->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="nonaktif" {{ $employee->status == 'nonaktif' ? 'selected' : '' }}>Non-Aktif</option>
            </select>
        </div>

        <div class="flex justify-end space-x-4 border-t pt-6">
            <a href="{{ route('employees.index') }}" class="px-5 py-2.5 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Batal</a>
            <button type="submit" class="px-5 py-2.5 bg-yellow-500 text-white font-bold rounded-lg hover:bg-yellow-600 shadow-md transition">Update Pegawai</button>
        </div>
    </form>
</div>
@endsection