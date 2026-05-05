<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department; // Import Model Departemen
use App\Models\Position;   // Import Model Jabatan
use App\Models\User;       // Import Model User
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // Menampilkan daftar pegawai dengan Fitur Pencarian
    public function index(Request $request)
    {
        // 1. Mulai Query Builder
        $query = Employee::with(['department', 'position']);

        // 2. Cek apakah ada input pencarian dari user
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            
            // Filter berdasarkan Nama ATAU Email
            $query->where(function($q) use ($search) {
                $q->where('nama_lengkap', 'LIKE', '%' . $search . '%')
                  ->orWhere('email', 'LIKE', '%' . $search . '%');
            });
        }

        // 3. Ambil data (Paginate) dan urutkan dari yang terbaru
        // withQueryString() penting agar search tidak hilang saat pindah halaman
        $employees = $query->latest()->paginate(10)->withQueryString();
        
        // 4. Kirim ke View
        return view('employees.index', compact('employees'));
    }

    // Menampilkan form tambah pegawai
    public function create()
    {
        // Kita butuh data departemen & jabatan untuk dropdown
        $departments = Department::all();
        $positions = Position::all();
        
        return view('employees.create', compact('departments', 'positions'));
    }

    // Menyimpan data pegawai baru & Membuat Akun Login
    public function store(Request $request)
    {
        // 1. VALIDASI LENGKAP (Wajib diisi semua)
        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email', // Cek unik di tabel USERS
            'nomor_telepon' => 'required',
            'departemen_id' => 'required|exists:departments,id',
            'jabatan_id' => 'required|exists:positions,id',
            'tanggal_lahir' => 'required|date',
            'tanggal_masuk' => 'required|date',
            'status' => 'required|in:aktif,nonaktif',
            'alamat' => 'required|string',
        ]);

        // 2. Buat Akun User untuk Login
        $user = User::create([
            'name' => $request->nama_lengkap,
            'email' => $request->email,
            'password' => bcrypt('12345678'), // Default password
            'role' => 'karyawan'
        ]);

        // 3. Simpan Data Pegawai dengan user_id yang baru dibuat
        $request->merge(['user_id' => $user->id]);
        
        Employee::create($request->all());

        return redirect()->route('employees.index')->with('success', 'Pegawai & Akun Login berhasil dibuat. Password default: 12345678');
    }
    
    // Menampilkan detail
    public function show($id)
    {
        $employee = Employee::with(['department', 'position', 'attendances', 'salaries'])->findOrFail($id);
        return view('employees.show', compact('employee'));
    }

    // Menampilkan form edit
    public function edit(Employee $employee)
    {
        $departments = Department::all();
        $positions = Position::all();
        
        return view('employees.edit', compact('employee', 'departments', 'positions'));
    }

    // Update data pegawai
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            // Validasi unik email di tabel employees, kecuali punya dia sendiri
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'nomor_telepon' => 'required',
            'departemen_id' => 'required|exists:departments,id',
            'jabatan_id' => 'required|exists:positions,id',
            'tanggal_lahir' => 'required|date',
            'tanggal_masuk' => 'required|date',
            'status' => 'required|in:aktif,nonaktif',
            'alamat' => 'required|string',
        ]);

        $employee->update($request->all());

        return redirect()->route('employees.index')->with('success', 'Data pegawai diperbarui.');
    }

    // Hapus data
    public function destroy(Employee $employee)
    {
        // Opsional: Hapus user login-nya juga jika perlu
        if($employee->user_id) { User::find($employee->user_id)->delete(); }

        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Pegawai berhasil dihapus.');
    }
}