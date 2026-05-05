<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    // Menampilkan Tabel
    public function index()
    {
        $departments = Department::latest()->paginate(10);
        return view('departments.index', compact('departments'));
    }

    // Menampilkan Form Tambah
    public function create()
    {
        return view('departments.create');
    }

    // Menyimpan Data Baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_departemen' => 'required|string|max:100',
        ]);

        // Simpan ke database
        Department::create($request->all());

        return redirect()->route('departments.index')
                         ->with('success', 'Departemen berhasil ditambahkan.');
    }

    // Menampilkan Form Edit
    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    // Update Data
    public function update(Request $request, Department $department)
    {
        $request->validate([
            'nama_departemen' => 'required|string|max:100',
        ]);

        $department->update($request->all());

        return redirect()->route('departments.index')
                         ->with('success', 'Departemen berhasil diperbarui.');
    }

    // Hapus Data
    public function destroy(Department $department)
    {
        $department->delete();

        return redirect()->route('departments.index')
                         ->with('success', 'Departemen berhasil dihapus.');
    }
}