@extends('master')
@section('title', 'Tambah Pegawai')
@section('page-title', 'Form Tambah Pegawai')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('employees.store') }}" method="POST">
            @csrf

            {{-- Baris 1: Nama & Email --}}
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control" required placeholder="Nama Lengkap">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required placeholder="email@kantor.com">
                </div>
            </div>

            {{-- Baris 2: Departemen & Jabatan (DROPDOWN RELASI) --}}
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Departemen</label>
                    <select name="departemen_id" class="form-select" required>
                        <option value="">-- Pilih Departemen --</option>
                        @foreach($departments as $dept)
                            <option value="{{ $dept->id }}">{{ $dept->nama_departemen }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Jabatan</label>
                    <select name="jabatan_id" class="form-select" required>
                        <option value="">-- Pilih Jabatan --</option>
                        @foreach($positions as $pos)
                            <option value="{{ $pos->id }}">
                                {{ $pos->nama_jabatan }} (Gaji: Rp {{ number_format($pos->gaji_pokok, 0, ',', '.') }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Baris 3: Tgl Lahir, Tgl Masuk, No Telp --}}
            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Tanggal Masuk</label>
                    <input type="date" name="tanggal_masuk" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Nomor Telepon</label>
                    <input type="text" name="nomor_telepon" class="form-control" required>
                </div>
            </div>

            {{-- Baris 4: Alamat & Status --}}
            <div class="mb-3">
                <label class="form-label">Alamat Lengkap</label>
                <textarea name="alamat" class="form-control" rows="2" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Status Kepegawaian</label>
                <select name="status" class="form-select" required>
                    <option value="aktif">Aktif</option>
                    <option value="nonaktif">Non-Aktif (Resign/Cuti)</option>
                </select>
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('employees.index') }}" class="btn btn-secondary me-2">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Data</button>
            </div>
        </form>
    </div>
</div>
@endsection