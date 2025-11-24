<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Models\Employee;
use Illuminate\Http\Request;

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
        $request->validate([
            'karyawan_id' => 'required',
            'bulan' => 'required',
            'gaji_pokok' => 'required|numeric',
        ]);

        // Hitung Total Gaji Otomatis
        $total = $request->gaji_pokok + $request->tunjangan - $request->potongan;

        // Merge total gaji ke dalam request sebelum disimpan
        $request->merge(['total_gaji' => $total]);

        Salary::create($request->all());

        return redirect()->route('salaries.index')->with('success', 'Data gaji berhasil disimpan.');
    }

    public function edit(Salary $salary)
    {
        $employees = Employee::all();
        return view('salaries.edit', compact('salary', 'employees'));
    }

    public function update(Request $request, Salary $salary)
    {
        $request->validate([
            'karyawan_id' => 'required',
            'gaji_pokok' => 'required|numeric',
        ]);

        // Hitung Ulang Total
        $total = $request->gaji_pokok + $request->tunjangan - $request->potongan;
        $request->merge(['total_gaji' => $total]);

        $salary->update($request->all());

        return redirect()->route('salaries.index')->with('success', 'Data gaji diperbarui.');
    }

    public function destroy(Salary $salary)
    {
        $salary->delete();
        return redirect()->route('salaries.index')->with('success', 'Data gaji dihapus.');
    }
}