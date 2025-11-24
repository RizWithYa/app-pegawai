<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

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

    // Relasi: Setiap karyawan milik satu departemen (Many to One)
    public function department() {
        // 'departemen_id' adalah foreign key di tabel employees
        return $this->belongsTo(Department::class, 'departemen_id'); 
    }

    // Relasi: Setiap karyawan punya satu jabatan (Many to One)
    public function position() {
        // 'jabatan_id' adalah foreign key di tabel employees
        return $this->belongsTo(Position::class, 'jabatan_id');
    }

    // Relasi: Satu karyawan punya banyak data absensi (One to Many)
    public function attendances() {
        // 'karyawan_id' adalah foreign key di tabel attendances
        return $this->hasMany(Attendance::class, 'karyawan_id');
    }

    // Relasi: Satu karyawan punya banyak riwayat gaji (One to Many)
    public function salaries() {
        // 'karyawan_id' adalah foreign key di tabel salaries
        return $this->hasMany(Salary::class, 'karyawan_id');
    }
}