<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // <--- WAJIB DITAMBAHKAN AGAR BISA DISIMPAN
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

    // Relasi ke User (Akun Login)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Departemen
    public function department()
    {
        return $this->belongsTo(Department::class, 'departemen_id');
    }

    // Relasi ke Jabatan
    public function position()
    {
        return $this->belongsTo(Position::class, 'jabatan_id');
    }

    // Relasi ke Absensi
    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'karyawan_id');
    }

    // Relasi ke Gaji
    public function salaries()
    {
        return $this->hasMany(Salary::class, 'karyawan_id');
    }
}