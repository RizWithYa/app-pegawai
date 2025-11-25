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
                <a href="/" class="text-white text-xl font-bold hover:text-blue-100 transition">
                    App Kepegawaian
                </a>

                <ul class="flex space-x-6 text-white text-sm font-medium">
                    <li>
                        <a href="{{ route('employees.index') }}" 
                           class="hover:text-blue-200 transition {{ request()->routeIs('employees.*') ? 'underline underline-offset-4 decoration-2' : '' }}">
                            Pegawai
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('departments.index') }}" 
                           class="hover:text-blue-200 transition {{ request()->routeIs('departments.*') ? 'underline underline-offset-4 decoration-2' : '' }}">
                            Departemen
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('positions.index') }}" 
                           class="hover:text-blue-200 transition {{ request()->routeIs('positions.*') ? 'underline underline-offset-4 decoration-2' : '' }}">
                            Jabatan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('attendances.index') }}" 
                           class="hover:text-blue-200 transition {{ request()->routeIs('attendances.*') ? 'underline underline-offset-4 decoration-2' : '' }}">
                            Absensi
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('salaries.index') }}" 
                           class="hover:text-blue-200 transition {{ request()->routeIs('salaries.*') ? 'underline underline-offset-4 decoration-2' : '' }}">
                            Gaji
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4 pb-12">
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 shadow-sm rounded-r" role="alert">
                <p class="font-bold">Berhasil!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-2 border-gray-300">
            @yield('page-title')
        </h2>

        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            @yield('content')
        </div>
    </main>

    <footer class="text-center py-6 text-gray-500 text-sm">
        <p>&copy; {{ date('Y') }} Aplikasi Kepegawaian - Tugas Laravel with Tailwind</p>
    </footer>

</body>
</html>