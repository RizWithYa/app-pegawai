@extends('master')
@section('title', 'Edit Absensi')
@section('page-title', 'Edit Data Absensi')

@section('content')
<div class="card col-md-6">
    <div class="card-body">
        <form action="{{ route('attendances.update', $attendance->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label class="form-label">Nama Pegawai</label>
                <select name="karyawan_id" class="form-select" required>
                    @foreach($employees as $emp)
                        <option value="{{ $emp->id }}" {{ $attendance->karyawan_id == $emp->id ? 'selected' : '' }}>
                            {{ $emp->nama_lengkap }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" value="{{ $attendance->tanggal }}" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Jam Masuk</label>
                    <input type="time" name="waktu_masuk" class="form-control" value="{{ $attendance->waktu_masuk }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Jam Keluar</label>
                    <input type="time" name="waktu_keluar" class="form-control" value="{{ $attendance->waktu_keluar }}">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status_absensi" class="form-select" required>
                    <option value="hadir" {{ $attendance->status_absensi == 'hadir' ? 'selected' : '' }}>Hadir</option>
                    <option value="izin" {{ $attendance->status_absensi == 'izin' ? 'selected' : '' }}>Izin</option>
                    <option value="sakit" {{ $attendance->status_absensi == 'sakit' ? 'selected' : '' }}>Sakit</option>
                    <option value="alpha" {{ $attendance->status_absensi == 'alpha' ? 'selected' : '' }}>Alpha</option>
                </select>
            </div>

            <button type="submit" class="btn btn-warning">Update</button>
            <a href="{{ route('attendances.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection