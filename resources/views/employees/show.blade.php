@extends('master')
@section('title', 'Detail Pegawai')
@section('page-title', 'Detail Data Pegawai')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
        
        <div class="bg-blue-600 px-6 py-4 border-b border-blue-500 flex justify-between items-center">
            <h3 class="text-white text-lg font-bold">Informasi Personal</h3>
            <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $employee->status == 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                Status: {{ ucfirst($employee->status) }}
            </span>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-12">
                
                <div>
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Nama Lengkap</label>
                    <p class="text-gray-900 font-semibold text-lg">{{ $employee->nama_lengkap }}</p>
                </div>

                <div>
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Email</label>
                    <p class="text-gray-900 text-lg">{{ $employee->email }}</p>
                </div>

                <div>
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Departemen</label>
                    <p class="text-gray-900 text-lg">{{ $employee->department?->nama_departemen ?? '-' }}</p>
                </div>

                <div>
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Jabatan</label>
                    <p class="text-gray-900 text-lg">{{ $employee->position?->nama_jabatan ?? '-' }}</p>
                </div>

                <div>
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Tanggal Lahir</label>
                    <p class="text-gray-900">
                        {{ \Carbon\Carbon::parse($employee->tanggal_lahir)->format('d F Y') }}
                    </p>
                </div>

                <div>
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Tanggal Bergabung</label>
                    <p class="text-gray-900">
                        {{ \Carbon\Carbon::parse($employee->tanggal_masuk)->format('d F Y') }}
                    </p>
                </div>

                <div>
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Nomor Telepon</label>
                    <p class="text-gray-900">{{ $employee->nomor_telepon }}</p>
                </div>
            </div>

            <div class="mt-6 pt-6 border-t border-gray-100">
                <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Alamat Lengkap</label>
                <p class="text-gray-900 mt-1 leading-relaxed">{{ $employee->alamat }}</p>
            </div>
        </div>

        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
            <a href="{{ route('employees.index') }}" 
               class="px-4 py-2 bg-gray-200 text-gray-700 font-medium rounded-md hover:bg-gray-300 transition">
                Kembali
            </a>
            <a href="{{ route('employees.edit', $employee->id) }}" 
               class="px-4 py-2 bg-yellow-400 text-white font-medium rounded-md hover:bg-yellow-500 transition shadow-sm">
                Edit Data
            </a>
        </div>

    </div>
</div>
@endsection