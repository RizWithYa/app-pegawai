@extends('master')
@section('title', 'Dashboard Karyawan')
@section('page-title', 'Selamat Datang, ' . Auth::user()->name)

@section('content')

<div class="bg-white p-6 rounded-lg shadow-lg border border-blue-100 mb-8 flex flex-col md:flex-row justify-between items-center">
    <div>
        <h2 class="text-xl font-bold text-gray-800">Halo, {{ Auth::user()->name }}!</h2>
        <p class="text-gray-500 text-sm mt-1">Jangan lupa catat kehadiran Anda hari ini.</p>
        <p class="text-2xl font-mono font-bold text-blue-600 mt-2" id="jam-digital">
            {{ now()->format('H:i:s') }}
        </p>
    </div>

    <div class="mt-4 md:mt-0">
        @if(!$todayAttendance)
            <form action="{{ route('attendance.clockIn') }}" method="POST">
                @csrf
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-full shadow-lg transition transform hover:scale-105 flex items-center gap-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                    ABSEN MASUK
                </button>
            </form>

        @elseif($todayAttendance && $todayAttendance->waktu_keluar == null)
            <div class="text-center">
                <p class="text-sm text-green-600 font-bold mb-2">
                    ✅ Masuk pukul {{ $todayAttendance->waktu_masuk }}
                </p>
                <form action="{{ route('attendance.clockOut') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-8 rounded-full shadow-lg transition transform hover:scale-105 flex items-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        ABSEN PULANG
                    </button>
                </form>
            </div>

        @else
            <div class="bg-green-50 border border-green-200 px-6 py-3 rounded-lg text-center">
                <p class="text-green-800 font-bold text-lg">Kehadiran Tuntas! 🎉</p>
                <div class="text-sm text-green-600 mt-1">
                    <span>Masuk: {{ $todayAttendance->waktu_masuk }}</span>
                    <span class="mx-2">|</span>
                    <span>Keluar: {{ $todayAttendance->waktu_keluar }}</span>
                </div>
            </div>
        @endif
    </div>
</div>

<script>
    setInterval(() => {
        const now = new Date();
        const timeString = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
        document.getElementById('jam-digital').innerText = timeString;
    }, 1000);
</script>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    
    <div class="bg-white p-6 rounded-lg shadow border-l-4 border-blue-500">
        <h3 class="text-gray-500 uppercase text-xs font-bold mb-2">Status Kepegawaian</h3>
        
        {{-- TAMBAHKAN PENGECEKAN @if DISINI --}}
        @if($employee)
            <p class="text-xl font-bold">{{ $employee->position->nama_jabatan ?? '-' }}</p>
            <p class="text-gray-600">{{ $employee->department->nama_departemen ?? '-' }}</p>
            <span class="inline-block mt-2 px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">
                {{ ucfirst($employee->status) }}
            </span>
        @else
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                <p class="text-yellow-700">
                    <strong>Akun Anda belum terhubung dengan data pegawai.</strong><br>
                    Silakan hubungi Administrator untuk menghubungkan akun ini dengan data kepegawaian.
                </p>
            </div>
        @endif
        {{-- AKHIR PENGECEKAN --}}
    </div>

    <div class="bg-white p-6 rounded-lg shadow border-l-4 border-green-500">
        <h3 class="text-gray-500 uppercase text-xs font-bold mb-2">Gaji Bulan Terakhir</h3>
        @if(isset($mySalary) && $mySalary)
            <p class="text-2xl font-bold text-green-700">Rp {{ number_format($mySalary->total_gaji, 0, ',', '.') }}</p>
            <p class="text-sm text-gray-500">Periode: {{ $mySalary->bulan }}</p>
        @else
            <p class="text-gray-400 italic">Belum ada data gaji.</p>
        @endif
    </div>

</div>

<div class="mt-8 bg-white rounded-lg shadow p-6">
    <h3 class="text-lg font-bold mb-4">5 Riwayat Absensi Terakhir Anda</h3>
    <table class="w-full text-sm text-left">
        <thead class="bg-gray-100 uppercase">
            <tr>
                <th class="px-4 py-3">Tanggal</th>
                <th class="px-4 py-3">Jam Masuk</th>
                <th class="px-4 py-3">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($myAttendance as $absen)
            <tr class="border-b">
                <td class="px-4 py-3">{{ \Carbon\Carbon::parse($absen->tanggal)->format('d M Y') }}</td>
                <td class="px-4 py-3">{{ $absen->waktu_masuk ?? '-' }}</td>
                <td class="px-4 py-3">{{ ucfirst($absen->status_absensi) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="px-4 py-3 text-gray-500 italic">Belum ada riwayat absensi.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection