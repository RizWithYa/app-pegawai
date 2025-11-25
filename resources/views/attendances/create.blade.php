@extends('master')
@section('title', 'Input Absensi')
@section('page-title', 'Form Input Absensi Harian')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-md border border-gray-200">
    <form action="{{ route('attendances.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="md:col-span-2">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nama Pegawai</label>
                <select name="karyawan_id" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 bg-white">
                    <option value="">-- Cari Nama Pegawai --</option>
                    @foreach($employees as $emp)
                        <option value="{{ $emp->id }}">{{ $emp->nama_lengkap }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Tanggal Absensi</label>
                <input type="date" name="tanggal" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Status Kehadiran</label>
                <select name="status_absensi" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 bg-white">
                    <option value="hadir">Hadir</option>
                    <option value="izin">Izin</option>
                    <option value="sakit">Sakit</option>
                    <option value="alpha">Alpha (Tanpa Keterangan)</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Jam Masuk</label>
                <input type="time" name="waktu_masuk" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Jam Keluar</label>
                <input type="time" name="waktu_keluar" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
            </div>
        </div>

        <div class="flex justify-end space-x-3 mt-8">
            <a href="{{ route('attendances.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition">Kembali</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-bold rounded-md hover:bg-blue-700 transition">Catat Absensi</button>
        </div>
    </form>
</div>
@endsection