<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    
    // Nama tabel harus dispesifikasikan jika tidak jamak standar (opsional tapi aman)
    protected $table = 'attendances'; 

    protected $fillable = [
        'karyawan_id', 
        'tanggal', 
        'waktu_masuk', 
        'waktu_keluar', 
        'status_absensi'
    ];

    // Relasi Kebalikan: Absensi ini milik satu pegawai
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'karyawan_id');
    }
}