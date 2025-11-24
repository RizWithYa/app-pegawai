@extends('master')
@section('title', 'Input Gaji')
@section('page-title', 'Input Gaji Pegawai')

@section('content')
<div class="card col-md-8">
    <div class="card-body">
        <form action="{{ route('salaries.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="form-label">Pegawai</label>
                <select name="karyawan_id" class="form-select" required>
                    @foreach($employees as $emp)
                        <option value="{{ $emp->id }}">{{ $emp->nama_lengkap }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Bulan & Tahun (Contoh: September 2025)</label>
                <input type="text" name="bulan" class="form-control" placeholder="September 2025" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Gaji Pokok</label>
                <input type="number" name="gaji_pokok" class="form-control" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tunjangan</label>
                    <input type="number" name="tunjangan" class="form-control" value="0">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Potongan</label>
                    <input type="number" name="potongan" class="form-control" value="0">
                </div>
            </div>

            <div class="alert alert-info">
                Total Gaji akan dihitung otomatis oleh sistem.
            </div>

            <button type="submit" class="btn btn-primary">Simpan Data</button>
        </form>
    </div>
</div>
@endsection