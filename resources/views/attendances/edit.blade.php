@extends('master')
@section('title', 'Edit Absensi')
@section('page-title', 'Edit Data Absensi')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-md border border-gray-200">
    <form action="{{ route('attendances.update', $attendance->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="md:col-span-2">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nama Pegawai</label>
                <select name="karyawan_id" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 bg-gray-50">
                    @foreach($employees as $emp)
                        <option value="{{ $emp->id }}" {{ $attendance->karyawan_id == $emp->id ? 'selected' : '' }}>
                            {{ $emp->nama_lengkap }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Tanggal Absensi</label>
                <input type="date" name="tanggal" required 
                       value="{{ old('tanggal', $attendance->tanggal) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500">
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Status Kehadiran</label>
                <select name="status_absensi" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 bg-white">
                    <option value="hadir" {{ $attendance->status_absensi == 'hadir' ? 'selected' : '' }}>Hadir</option>
                    <option value="izin" {{ $attendance->status_absensi == 'izin' ? 'selected' : '' }}>Izin</option>
                    <option value="sakit" {{ $attendance->status_absensi == 'sakit' ? 'selected' : '' }}>Sakit</option>
                    <option value="alpha" {{ $attendance->status_absensi == 'alpha' ? 'selected' : '' }}>Alpha</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Jam Masuk</label>
                <input type="time" name="waktu_masuk" 
                       value="{{ old('waktu_masuk', $attendance->waktu_masuk) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500">
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Jam Keluar</label>
                <input type="time" name="waktu_keluar" 
                       value="{{ old('waktu_keluar', $attendance->waktu_keluar) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500">
            </div>
        </div>

        <div class="flex justify-end space-x-3 mt-8">
            <a href="{{ route('attendances.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition">Batal</a>
            <button type="submit" class="px-4 py-2 bg-yellow-500 text-white font-bold rounded-md hover:bg-yellow-600 transition">Update Absensi</button>
        </div>
    </form>
</div>
@endsection