@extends('master')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard Ringkasan')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    
    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-600 flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-gray-500 uppercase">Total Pegawai</p>
            <p class="text-3xl font-bold text-gray-800">{{ $totalPegawai }}</p>
        </div>
        <div class="p-3 bg-blue-100 rounded-full text-blue-600">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500 flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-gray-500 uppercase">Hadir Hari Ini</p>
            <p class="text-3xl font-bold text-gray-800">{{ $hadirHariIni }}</p>
            <p class="text-xs text-gray-400 mt-1">{{ \Carbon\Carbon::now()->format('d M Y') }}</p>
        </div>
        <div class="p-3 bg-green-100 rounded-full text-green-600">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-red-500 flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-gray-500 uppercase">Tidak Masuk</p>
            <p class="text-3xl font-bold text-gray-800">{{ $tidakHadirHariIni }}</p>
            <p class="text-xs text-gray-400 mt-1">Sakit / Izin / Alpha</p>
        </div>
        <div class="p-3 bg-red-100 rounded-full text-red-600">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-yellow-500 flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-gray-500 uppercase">Departemen</p>
            <p class="text-3xl font-bold text-gray-800">{{ $totalDepartemen }}</p>
        </div>
        <div class="p-3 bg-yellow-100 rounded-full text-yellow-600">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
        </div>
    </div>
</div>

<div class="bg-blue-600 rounded-lg shadow-lg p-6 text-white">
    <h3 class="text-2xl font-bold mb-2">Selamat Datang di Sistem Lantara!</h3>
    <p class="opacity-90">
        Anda sedang login sebagai Administrator. Gunakan menu navigasi di atas untuk mengelola data pegawai, departemen, jabatan, absensi, dan penggajian.
    </p>
</div>
@endsection