@extends('master')
@section('title', 'Edit Gaji')
@section('page-title', 'Edit Data Gaji')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-md border border-gray-200">
    <form action="{{ route('salaries.update', $salary->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">Pilih Pegawai</label>
            <select name="karyawan_id" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 bg-gray-50">
                @foreach($employees as $emp)
                    <option value="{{ $emp->id }}" {{ $salary->karyawan_id == $emp->id ? 'selected' : '' }}>
                        {{ $emp->nama_lengkap }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">Periode (Bulan & Tahun)</label>
            <input type="text" name="bulan" required 
                   value="{{ old('bulan', $salary->bulan) }}"
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500">
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">Gaji Pokok</label>
            <div class="relative">
                <span class="absolute left-3 top-2 text-gray-500">Rp</span>
                <input type="number" name="gaji_pokok" required 
                       value="{{ old('gaji_pokok', $salary->gaji_pokok) }}"
                       class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Tunjangan (+)</label>
                <div class="relative">
                    <span class="absolute left-3 top-2 text-gray-500">Rp</span>
                    <input type="number" name="tunjangan" 
                           value="{{ old('tunjangan', $salary->tunjangan) }}"
                           class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 border-green-200 bg-green-50">
                </div>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Potongan (-)</label>
                <div class="relative">
                    <span class="absolute left-3 top-2 text-gray-500">Rp</span>
                    <input type="number" name="potongan" 
                           value="{{ old('potongan', $salary->potongan) }}"
                           class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-red-500 border-red-200 bg-red-50">
                </div>
            </div>
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('salaries.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition">Batal</a>
            <button type="submit" class="px-4 py-2 bg-yellow-500 text-white font-bold rounded-md hover:bg-yellow-600 shadow transition">Update Gaji</button>
        </div>
    </form>
</div>
@endsection