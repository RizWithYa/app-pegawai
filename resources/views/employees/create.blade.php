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
                <input type="text" name="nama_lengkap" required placeholder="Nama Lengkap"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" required placeholder="email@kantor.com"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Departemen</label>
                <select name="departemen_id" required class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none bg-white">
                    <option value="">-- Pilih Departemen --</option>
                    @foreach($departments as $dept)
                        <option value="{{ $dept->id }}">{{ $dept->nama_departemen }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Jabatan</label>
                <select name="jabatan_id" required class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none bg-white">
                    <option value="">-- Pilih Jabatan --</option>
                    @foreach($positions as $pos)
                        <option value="{{ $pos->id }}">{{ $pos->nama_jabatan }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" required class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Masuk</label>
                <input type="date" name="tanggal_masuk" required class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                <input type="text" name="nomor_telepon" required class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
            <textarea name="alamat" rows="3" required class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select name="status" required class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none bg-white">
                <option value="aktif">Aktif</option>
                <option value="nonaktif">Non-Aktif</option>
            </select>
        </div>

        <div class="flex justify-end pt-4 border-t border-gray-200">
            <a href="{{ route('employees.index') }}" class="mr-3 px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition">Batal</a>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 transition shadow-md">Simpan Data</button>
        </div>
    </form>
</div>
@endsection