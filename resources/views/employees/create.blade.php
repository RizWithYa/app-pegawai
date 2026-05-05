@extends('master')
@section('title', 'Tambah Pegawai')
@section('page-title', 'Form Tambah Pegawai')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <form action="{{ route('employees.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required placeholder="Nama Lengkap"
                       class="w-full border {{ $errors->has('nama_lengkap') ? 'border-red-500' : 'border-gray-300' }} rounded px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                @error('nama_lengkap') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required placeholder="email@kantor.com"
                       class="w-full border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }} rounded px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                @error('email') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Departemen</label>
                <select name="departemen_id" required class="w-full border {{ $errors->has('departemen_id') ? 'border-red-500' : 'border-gray-300' }} rounded px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none bg-white">
                    <option value="">-- Pilih Departemen --</option>
                    @foreach($departments as $dept)
                        <option value="{{ $dept->id }}" {{ old('departemen_id') == $dept->id ? 'selected' : '' }}>{{ $dept->nama_departemen }}</option>
                    @endforeach
                </select>
                @error('departemen_id') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Jabatan</label>
                <select name="jabatan_id" required class="w-full border {{ $errors->has('jabatan_id') ? 'border-red-500' : 'border-gray-300' }} rounded px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none bg-white">
                    <option value="">-- Pilih Jabatan --</option>
                    @foreach($positions as $pos)
                        <option value="{{ $pos->id }}" {{ old('jabatan_id') == $pos->id ? 'selected' : '' }}>{{ $pos->nama_jabatan }}</option>
                    @endforeach
                </select>
                @error('jabatan_id') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required
                       class="w-full border {{ $errors->has('tanggal_lahir') ? 'border-red-500' : 'border-gray-300' }} rounded px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                @error('tanggal_lahir') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Masuk</label>
                <input type="date" name="tanggal_masuk" value="{{ old('tanggal_masuk') }}" required
                       class="w-full border {{ $errors->has('tanggal_masuk') ? 'border-red-500' : 'border-gray-300' }} rounded px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                @error('tanggal_masuk') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                <input type="text" name="nomor_telepon" value="{{ old('nomor_telepon') }}" required
                       class="w-full border {{ $errors->has('nomor_telepon') ? 'border-red-500' : 'border-gray-300' }} rounded px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                @error('nomor_telepon') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
            <textarea name="alamat" rows="3" required
                      class="w-full border {{ $errors->has('alamat') ? 'border-red-500' : 'border-gray-300' }} rounded px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">{{ old('alamat') }}</textarea>
            @error('alamat') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select name="status" required class="w-full border {{ $errors->has('status') ? 'border-red-500' : 'border-gray-300' }} rounded px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none bg-white">
                <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Non-Aktif</option>
            </select>
            @error('status') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-3 mb-6 text-sm text-yellow-700">
            <strong>Info:</strong> Akun login akan dibuat otomatis dengan password default: <code class="bg-yellow-100 px-1 rounded">12345678</code>
        </div>

        <div class="flex justify-end pt-4 border-t border-gray-200">
            <a href="{{ route('employees.index') }}" class="mr-3 px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition">Batal</a>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 transition shadow-md">Simpan Data</button>
        </div>
    </form>
</div>
@endsection
