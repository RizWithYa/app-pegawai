@extends('master')

@section('title', 'Detail Pegawai')
@section('page-title', 'Detail Data Pegawai')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Informasi Lengkap: {{ $employee->nama_lengkap }}</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th style="width: 30%">Nama Lengkap</th>
                        <td>{{ $employee->nama_lengkap }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $employee->email }}</td>
                    </tr>
                    
                    {{-- DATA BARU: Relasi Departemen & Jabatan --}}
                    <tr>
                        <th>Departemen</th>
                        <td>{{ $employee->department?->nama_departemen ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Jabatan</th>
                        <td>{{ $employee->position?->nama_jabatan ?? '-' }}</td>
                    </tr>
                    
                    <tr>
                        <th>Nomor Telepon</th>
                        <td>{{ $employee->nomor_telepon }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Lahir</th>
                        <td>{{ \Carbon\Carbon::parse($employee->tanggal_lahir)->format('d F Y') }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $employee->alamat }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Masuk</th>
                        <td>{{ \Carbon\Carbon::parse($employee->tanggal_masuk)->format('d F Y') }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <span class="badge bg-{{ $employee->status == 'aktif' ? 'success' : 'secondary' }}">
                                {{ ucfirst($employee->status) }}
                            </span>
                        </td>
                    </tr>
                </table>

                <div class="mt-4">
                    <a href="{{ route('employees.index') }}" class="btn btn-secondary">Kembali</a>
                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning">Edit Data</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection