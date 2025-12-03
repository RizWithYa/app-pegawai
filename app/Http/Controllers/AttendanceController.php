<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon; // PENTING: Untuk menangani Tanggal & Waktu

class AttendanceController extends Controller
{
    // --- BAGIAN 1: CRUD ADMIN (Kelola Absensi via Menu Admin) ---

    public function index()
    {
        // Menampilkan daftar absensi urut dari yang terbaru
        $attendances = Attendance::with('employee')->latest()->paginate(10);
        return view('attendances.index', compact('attendances'));
    }

    public function create()
    {
        // Ambil data pegawai untuk dropdown form
        $employees = Employee::all(); 
        return view('attendances.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'tanggal' => 'required|date',
            'status_absensi' => 'required|in:hadir,izin,sakit,alpha',
        ]);

        Attendance::create($request->all());

        return redirect()->route('attendances.index')->with('success', 'Absensi berhasil dicatat.');
    }

    public function edit(Attendance $attendance)
    {
        $employees = Employee::all();
        return view('attendances.edit', compact('attendance', 'employees'));
    }

    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'tanggal' => 'required|date',
            'status_absensi' => 'required|in:hadir,izin,sakit,alpha',
        ]);

        $attendance->update($request->all());

        return redirect()->route('attendances.index')->with('success', 'Absensi berhasil diupdate.');
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return redirect()->route('attendances.index')->with('success', 'Data absensi dihapus.');
    }


    // --- BAGIAN 2: FITUR KARYAWAN (Absensi Mandiri via Dashboard) ---

    public function clockIn(Request $request)
    {
        $user = auth()->user();
        
        // 1. Cari data pegawai berdasarkan User yang login
        $employee = Employee::where('user_id', $user->id)->first();

        // Pencegahan jika akun admin (yang tidak punya data pegawai) mencoba absen
        if (!$employee) {
            return back()->with('error', 'Data pegawai tidak ditemukan. Pastikan akun ini terhubung dengan data pegawai.');
        }

        // 2. Cek apakah hari ini sudah absen masuk?
        $cek = Attendance::where('karyawan_id', $employee->id)
                         ->whereDate('tanggal', Carbon::today())
                         ->first();

        if ($cek) {
            return back()->with('error', 'Anda sudah melakukan absen masuk hari ini.');
        }

        // 3. Simpan Data Absen Masuk
        Attendance::create([
            'karyawan_id' => $employee->id,
            'tanggal' => Carbon::today(),           // Format: YYYY-MM-DD
            'waktu_masuk' => Carbon::now()->format('H:i'), // Format: HH:MM
            'status_absensi' => 'hadir',
        ]);

        return back()->with('success', 'Berhasil Absen Masuk pada ' . Carbon::now()->format('H:i'));
    }

    public function clockOut(Request $request)
    {
        $user = auth()->user();
        $employee = Employee::where('user_id', $user->id)->first();

        if (!$employee) {
            return back()->with('error', 'Data pegawai tidak ditemukan.');
        }

        // 1. Cari data absensi HARI INI
        $attendance = Attendance::where('karyawan_id', $employee->id)
                                ->whereDate('tanggal', Carbon::today())
                                ->first();

        // Jika belum absen masuk, tidak bisa absen pulang
        if (!$attendance) {
            return back()->with('error', 'Anda belum melakukan absen masuk hari ini.');
        }

        // 2. Update waktu keluar
        $attendance->update([
            'waktu_keluar' => Carbon::now()->format('H:i')
        ]);

        return back()->with('success', 'Berhasil Absen Pulang. Hati-hati di jalan!');
    }
}