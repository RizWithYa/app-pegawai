<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRIS Pro - Sistem Kepegawaian</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <div class="bg-blue-600 text-white p-2 rounded-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
                <span class="text-xl font-bold text-gray-800 tracking-tight">HRIS<span class="text-blue-600">Pro</span></span>
            </div>
            
            <div>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-blue-600 font-medium transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg font-medium transition shadow-md hover:shadow-lg">
                            Login Area
                        </a>
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <section class="container mx-auto px-6 py-20 text-center">
        <div class="max-w-3xl mx-auto">
            <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 mb-6 leading-tight">
                Kelola Tim Anda dengan <br> <span class="text-blue-600">Lebih Cerdas</span>
            </h1>
            <p class="text-lg text-gray-600 mb-10 leading-relaxed">
                Sistem Informasi Kepegawaian terintegrasi untuk manajemen data karyawan, absensi real-time, dan penggajian otomatis dalam satu platform yang mudah digunakan.
            </p>
            
            <div class="flex justify-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="bg-blue-600 text-white px-8 py-3.5 rounded-xl font-bold text-lg hover:bg-blue-700 transition shadow-lg hover:shadow-blue-500/30">
                        Buka Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="bg-blue-600 text-white px-8 py-3.5 rounded-xl font-bold text-lg hover:bg-blue-700 transition shadow-lg hover:shadow-blue-500/30">
                        Masuk Sekarang
                    </a>
                @endauth
            </div>
        </div>
    </section>

    <section class="bg-white py-20">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-3 gap-10">
                <div class="p-8 rounded-2xl bg-blue-50 border border-blue-100 hover:shadow-lg transition duration-300">
                    <div class="w-14 h-14 bg-blue-600 rounded-xl flex items-center justify-center text-white mb-6">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-900">Database Pegawai</h3>
                    <p class="text-gray-600">Pusat data karyawan yang lengkap dengan riwayat jabatan dan departemen yang terstruktur.</p>
                </div>

                <div class="p-8 rounded-2xl bg-green-50 border border-green-100 hover:shadow-lg transition duration-300">
                    <div class="w-14 h-14 bg-green-600 rounded-xl flex items-center justify-center text-white mb-6">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-900">Absensi Mandiri</h3>
                    <p class="text-gray-600">Fitur Check-in dan Check-out harian yang mudah diakses karyawan melalui dashboard pribadi.</p>
                </div>

                <div class="p-8 rounded-2xl bg-yellow-50 border border-yellow-100 hover:shadow-lg transition duration-300">
                    <div class="w-14 h-14 bg-yellow-500 rounded-xl flex items-center justify-center text-white mb-6">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-900">Penggajian Otomatis</h3>
                    <p class="text-gray-600">Perhitungan gaji pokok, tunjangan, dan potongan yang akurat dan transparan.</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-gray-50 border-t border-gray-200 py-8 text-center text-gray-500 text-sm">
        <p>&copy; {{ date('Y') }} HRIS Pro Application. All rights reserved.</p>
    </footer>

</body>
</html>