<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department; // Import Model Departemen
use App\Models\Position;   // Import Model Jabatan
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // Menampilkan daftar pegawai
    public function index()
    {
        // Menggunakan with() untuk Eager Loading (biar query lebih cepat)
        $employees = Employee::with(['department', 'position'])
                             ->latest()
                             ->paginate(10);
                             
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

    // Menyimpan data pegawai baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'email' => 'required|email|unique:employees,email',
            'nomor_telepon' => 'required',
            'departemen_id' => 'required|exists:departments,id', // Validasi Relasi
            'jabatan_id' => 'required|exists:positions,id',      // Validasi Relasi
            'tanggal_lahir' => 'required|date',
            'tanggal_masuk' => 'required|date',
            'status' => 'required|in:aktif,nonaktif',
            'alamat' => 'required|string',
        ]);

        Employee::create($request->all());

        return redirect()->route('employees.index')->with('success', 'Pegawai berhasil ditambahkan.');
    }

    // Menampilkan detail (Opsional, jika tombol detail diklik)
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
            // Validasi unik email kecuali milik user ini sendiri
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
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Pegawai berhasil dihapus.');
    }
}