<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use App\Models\Attendance;
use App\Models\Salary;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data user yang sedang login
        $user = Auth::user();

        // ---------------------------------------------------------
        // SKENARIO 1: JIKA YANG LOGIN ADALAH KARYAWAN
        // ---------------------------------------------------------
        if ($user->role == 'karyawan') {
            // 1. Cari data Employee yang terhubung dengan User ini
            $employee = Employee::with(['position', 'department'])
                                ->where('user_id', $user->id)
                                ->first();

            // Cek jika data employee ditemukan (untuk menghindari error jika user manual belum di-link)
            if (!$employee) {
                return view('dashboard_karyawan', [
                    'employee' => null, 
                    'myAttendance' => [], 
                    'mySalary' => null,
                    'todayAttendance' => null // Tambahkan null agar view tidak error
                ]);
            }
            
            // 2. Ambil 5 Riwayat Absensi Terakhir milik pegawai ini
            $myAttendance = Attendance::where('karyawan_id', $employee->id)
                                      ->latest()
                                      ->take(5)
                                      ->get();

            // 3. Ambil Data Gaji Terakhir milik pegawai ini
            $mySalary = Salary::where('karyawan_id', $employee->id)
                              ->latest()
                              ->first();

            // 4. [BARU] Ambil Data Absensi HARI INI (Untuk Logika Tombol Masuk/Pulang)
            $todayAttendance = Attendance::where('karyawan_id', $employee->id)
                                         ->whereDate('tanggal', \Carbon\Carbon::today())
                                         ->first();

            // Tampilkan View Khusus Karyawan dengan variabel tambahan
            return view('dashboard_karyawan', compact('employee', 'myAttendance', 'mySalary', 'todayAttendance'));
        }

        // ---------------------------------------------------------
        // SKENARIO 2: JIKA YANG LOGIN ADALAH ADMIN (DEFAULT)
        // ---------------------------------------------------------
        
        // 1. Hitung Total Pegawai Aktif
        $totalPegawai = Employee::where('status', 'aktif')->count();

        // 2. Hitung Total Departemen
        $totalDepartemen = Department::count();

        // 3. Hitung Jumlah Pegawai yang HADIR HARI INI
        $hadirHariIni = Attendance::whereDate('tanggal', now())
                                  ->where('status_absensi', 'hadir')
                                  ->count();

        // 4. Hitung Pegawai yang Tidak Masuk Hari Ini
        $tidakHadirHariIni = Attendance::whereDate('tanggal', now())
                                       ->whereIn('status_absensi', ['sakit', 'izin', 'alpha'])
                                       ->count();

        // Tampilkan View Dashboard Admin
        return view('dashboard', compact('totalPegawai', 'totalDepartemen', 'hadirHariIni', 'tidakHadirHariIni'));
    }
}