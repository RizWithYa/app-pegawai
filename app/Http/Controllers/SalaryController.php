<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Models\Employee;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; 

class SalaryController extends Controller
{
    public function index()
    {
        $salaries = Salary::with('employee')->latest()->paginate(10);
        return view('salaries.index', compact('salaries'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('salaries.create', compact('employees'));
    }

    public function store(Request $request)
    {
        // 1. Validasi Input (Hapus 'total_gaji' dari sini jika ada)
        $request->validate([
            'karyawan_id' => 'required',
            'bulan' => 'required',
            'gaji_pokok' => 'required|numeric',
            // 'tunjangan' dan 'potongan' opsional, jadi tidak perlu required
        ]);

        // 2. Hitung Total Gaji Otomatis
        // Gunakan (int) atau floatval() untuk memastikan angka
        $gaji = (int) $request->gaji_pokok;
        $tunjangan = (int) $request->tunjangan;
        $potongan = (int) $request->potongan;
        
        $total = $gaji + $tunjangan - $potongan;

        // 3. Simpan Menggunakan Array Manual (Lebih Aman daripada merge)
        \App\Models\Salary::create([
            'karyawan_id' => $request->karyawan_id,
            'bulan'       => $request->bulan,
            'gaji_pokok'  => $gaji,
            'tunjangan'   => $tunjangan,
            'potongan'    => $potongan,
            'total_gaji'  => $total // <--- Ini yang penting
        ]);

        return redirect()->route('salaries.index')->with('success', 'Data gaji berhasil disimpan.');
    }

    public function edit(Salary $salary)
    {
        $employees = Employee::all();
        return view('salaries.edit', compact('salary', 'employees'));
    }

    public function update(Request $request, \App\Models\Salary $salary)
    {
        $request->validate([
            'bulan' => 'required',
            'gaji_pokok' => 'required|numeric',
        ]);

        // Hitung Ulang Total
        $total = $request->gaji_pokok + $request->tunjangan - $request->potongan;

        // Update data
        $salary->update([
            'karyawan_id' => $request->karyawan_id,
            'bulan'       => $request->bulan,
            'gaji_pokok'  => $request->gaji_pokok,
            'tunjangan'   => $request->tunjangan,
            'potongan'    => $request->potongan,
            'total_gaji'  => $total
        ]);

        return redirect()->route('salaries.index')->with('success', 'Data gaji diperbarui.');
    }

    public function destroy(Salary $salary)
    {
        $salary->delete();
        return redirect()->route('salaries.index')->with('success', 'Data gaji dihapus.');
    }

    public function printPDF($id)
    {
        $salary = Salary::with(['employee.position', 'employee.department'])->findOrFail($id);

        $pdf = Pdf::loadView('salaries.pdf_slip', compact('salary'));

        return $pdf->download('Slip-Gaji-' . $salary->employee->nama_lengkap . '-' . $salary->bulan . '.pdf');
    }
}