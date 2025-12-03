<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'App Pegawai')</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">

    <nav class="bg-blue-600 shadow-md mb-8">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                
                <a href="{{ route('dashboard') }}" class="text-white text-xl font-bold hover:text-blue-100 transition flex items-center gap-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    Lantara
                </a>

                <ul class="flex space-x-6 text-white text-sm font-medium items-center">
                    
                    <li>
                        <a href="{{ route('dashboard') }}" 
                           class="hover:text-blue-200 transition {{ request()->routeIs('dashboard') ? 'underline underline-offset-4 decoration-2 font-bold text-white' : 'text-blue-100' }}">
                            Dashboard
                        </a>
                    </li>

                    @if(Auth::check() && Auth::user()->role == 'admin')
                        <li>
                            <a href="{{ route('employees.index') }}" 
                               class="hover:text-blue-200 transition {{ request()->routeIs('employees.*') ? 'underline underline-offset-4 decoration-2 font-bold text-white' : 'text-blue-100' }}">
                                Pegawai
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('departments.index') }}" 
                               class="hover:text-blue-200 transition {{ request()->routeIs('departments.*') ? 'underline underline-offset-4 decoration-2 font-bold text-white' : 'text-blue-100' }}">
                                Departemen
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('positions.index') }}" 
                               class="hover:text-blue-200 transition {{ request()->routeIs('positions.*') ? 'underline underline-offset-4 decoration-2 font-bold text-white' : 'text-blue-100' }}">
                                Jabatan
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('attendances.index') }}" 
                               class="hover:text-blue-200 transition {{ request()->routeIs('attendances.*') ? 'underline underline-offset-4 decoration-2 font-bold text-white' : 'text-blue-100' }}">
                                Absensi
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('salaries.index') }}" 
                               class="hover:text-blue-200 transition {{ request()->routeIs('salaries.*') ? 'underline underline-offset-4 decoration-2 font-bold text-white' : 'text-blue-100' }}">
                                Gaji
                            </a>
                        </li>
                    @endif

                    <li class="border-l border-blue-400 h-6 mx-2"></li>

                    <li class="flex items-center gap-4">
                        <span class="text-blue-100 hidden md:inline-block">
                            Halo, {{ Auth::user()->name }} 
                            <span class="text-xs bg-blue-700 px-2 py-0.5 rounded ml-1 uppercase border border-blue-500">
                                {{ Auth::user()->role }}
                            </span>
                        </span>
                        
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" 
                                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded shadow transition text-xs font-bold flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                Keluar
                            </button>
                        </form>
                    </li>

                </ul>            
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4 pb-12">
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 shadow-sm rounded-r flex justify-between items-center" role="alert">
                <div>
                    <span class="font-bold">Berhasil!</span> {{ session('success') }}
                </div>
                <button onclick="this.parentElement.style.display='none'" class="text-green-700 font-bold px-2">
                    &times;
                </button>
            </div>
        @endif

        <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-2 border-gray-300">
            @yield('page-title')
        </h2>

        <div>
            @yield('content')
        </div>
    </main>

    <footer class="text-center py-6 text-gray-500 text-sm">
        <p>&copy; {{ date('Y') }} Aplikasi Pegawai Lantara</p>
    </footer>

</body>
</html>