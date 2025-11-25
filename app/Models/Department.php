<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    // Izinkan kolom ini diisi
    protected $fillable = ['nama_departemen'];

    // Relasi: Satu departemen punya banyak pegawai
    public function employees()
    {
        return $this->hasMany(Employee::class, 'departemen_id');
    }
}