<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    // Mass Assignment: Kolom mana saja yang boleh diisi user
    protected $fillable = [
        'nama_lengkap',
        'email',
        'nomor_telepon',
        'tanggal_lahir',
        'alamat',
        'tanggal_masuk',
        'status',
        'departemen_id',
        'jabatan_id',
    ];

    // Relasi 1: Pegawai milik satu Departemen
    public function department()
    {
        return $this->belongsTo(Department::class, 'departemen_id');
    }

    // Relasi 2: Pegawai punya satu Jabatan
    public function position()
    {
        return $this->belongsTo(Position::class, 'jabatan_id');
    }

    // Relasi 3: Pegawai punya banyak data Absensi
    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'karyawan_id');
    }

    // Relasi 4: Pegawai punya banyak data Gaji
    public function salaries()
    {
        return $this->hasMany(Salary::class, 'karyawan_id');
    }
}