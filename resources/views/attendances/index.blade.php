@extends('master')
@section('title', 'Data Absensi')
@section('page-title', 'Rekap Absensi Pegawai')

@section('content')
    <div class="mb-6">
        <a href="{{ route('attendances.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow transition duration-200">
            + Catat Absensi Baru
        </a>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full leading-normal">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">No</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Nama Pegawai</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Tanggal</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Jam Kerja</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 text-center text-xs font-semibold uppercase tracking-wider">Status</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 text-center text-xs font-semibold uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($attendances as $attendance)
                <tr class="hover:bg-gray-50">
                    <td class="px-5 py-5 text-sm">{{ $loop->iteration }}</td>
                    <td class="px-5 py-5 text-sm">
                        <div class="font-bold text-gray-900">{{ $attendance->employee?->nama_lengkap ?? 'Pegawai Terhapus' }}</div>
                    </td>
                    <td class="px-5 py-5 text-sm text-gray-600">
                        {{ \Carbon\Carbon::parse($attendance->tanggal)->format('d M Y') }}
                    </td>
                    <td class="px-5 py-5 text-sm text-gray-600">
                        @if($attendance->waktu_masuk)
                            <span class="bg-gray-100 px-2 py-1 rounded">{{ $attendance->waktu_masuk }}</span> - 
                            <span class="bg-gray-100 px-2 py-1 rounded">{{ $attendance->waktu_keluar ?? '...' }}</span>
                        @else
                            -
                        @endif
                    </td>
                    <td class="px-5 py-5 text-center text-sm">
                        @php
                            $statusColor = match($attendance->status_absensi) {
                                'hadir' => 'bg-green-100 text-green-800',
                                'sakit' => 'bg-yellow-100 text-yellow-800',
                                'izin'  => 'bg-blue-100 text-blue-800',
                                'alpha' => 'bg-red-100 text-red-800',
                                default => 'bg-gray-100 text-gray-800'
                            };
                        @endphp
                        <span class="px-3 py-1 font-semibold leading-tight rounded-full {{ $statusColor }}">
                            {{ ucfirst($attendance->status_absensi) }}
                        </span>
                    </td>
                    <td class="px-5 py-5 text-center text-sm space-x-2">
                        <a href="{{ route('attendances.edit', $attendance->id) }}" class="text-blue-600 hover:text-blue-900 font-medium">Edit</a>
                        <form action="{{ route('attendances.destroy', $attendance->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus data absensi ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900 font-medium ml-2">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-6 text-center text-gray-500">Belum ada data absensi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $attendances->links() }}
    </div>
@endsection