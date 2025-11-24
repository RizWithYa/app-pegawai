@extends('master')
@section('title', 'Catat Absensi')
@section('page-title', 'Catat Absensi Harian')

@section('content')
<div class="card col-md-6">
    <div class="card-body">
        <form action="{{ route('attendances.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="form-label">Nama Pegawai</label>
                <select name="karyawan_id" class="form-select" required>
                    <option value="">-- Pilih Pegawai --</option>
                    @foreach($employees as $emp)
                        <option value="{{ $emp->id }}">{{ $emp->nama_lengkap }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Jam Masuk</label>
                    <input type="time" name="waktu_masuk" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Jam Keluar</label>
                    <input type="time" name="waktu_keluar" class="form-control">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status_absensi" class="form-select" required>
                    <option value="hadir">Hadir</option>
                    <option value="izin">Izin</option>
                    <option value="sakit">Sakit</option>
                    <option value="alpha">Alpha</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection