@extends('master')
@section('title', 'Data Gaji')
@section('page-title', 'Riwayat Penggajian')

@section('content')
    <div class="mb-6">
        <a href="{{ route('salaries.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow transition duration-200">
            + Input Gaji Baru
        </a>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">No</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">Nama Pegawai</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">Periode</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">Detail Komponen</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">Total Terima</th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-bold uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($salaries as $salary)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-bold text-gray-900">{{ $salary->employee?->nama_lengkap ?? 'Pegawai Terhapus' }}</div>
                        <div class="text-xs text-gray-500">{{ $salary->employee?->department?->nama_departemen ?? '-' }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                        <span class="bg-blue-50 text-blue-700 px-2 py-1 rounded text-xs font-bold">
                            {{ $salary->bulan }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        <div class="text-xs">Gaji Pokok: Rp {{ number_format($salary->gaji_pokok, 0, ',', '.') }}</div>
                        <div class="text-xs text-green-600">+ Tunjangan: Rp {{ number_format($salary->tunjangan, 0, ',', '.') }}</div>
                        <div class="text-xs text-red-500">- Potongan: Rp {{ number_format($salary->potongan, 0, ',', '.') }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-bold text-gray-900 bg-green-50 px-3 py-1 rounded border border-green-200 inline-block">
                            Rp {{ number_format($salary->total_gaji, 0, ',', '.') }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium space-x-2">
                        
                        <a href="{{ route('salaries.print', $salary->id) }}" target="_blank" 
                           class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white text-xs px-3 py-1.5 rounded transition shadow-sm">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                            Cetak
                        </a>

                        <a href="{{ route('salaries.edit', $salary->id) }}" class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 px-3 py-1 rounded hover:bg-indigo-100 transition">Edit</a>
                        
                        <form action="{{ route('salaries.destroy', $salary->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus data gaji ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900 bg-red-50 px-3 py-1 rounded hover:bg-red-100 transition">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-gray-500 italic">Belum ada data penggajian.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $salaries->links() }}
    </div>
@endsection