@extends('master')
@section('title', 'Edit Gaji')
@section('page-title', 'Edit Data Gaji')

@section('content')
<div class="card col-md-8">
    <div class="card-body">
        <form action="{{ route('salaries.update', $salary->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label class="form-label">Pegawai</label>
                <select name="karyawan_id" class="form-select" required>
                    @foreach($employees as $emp)
                        <option value="{{ $emp->id }}" {{ $salary->karyawan_id == $emp->id ? 'selected' : '' }}>
                            {{ $emp->nama_lengkap }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Bulan & Tahun</label>
                <input type="text" name="bulan" class="form-control" value="{{ $salary->bulan }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Gaji Pokok</label>
                <input type="number" name="gaji_pokok" class="form-control" value="{{ $salary->gaji_pokok }}" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tunjangan</label>
                    <input type="number" name="tunjangan" class="form-control" value="{{ $salary->tunjangan }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Potongan</label>
                    <input type="number" name="potongan" class="form-control" value="{{ $salary->potongan }}">
                </div>
            </div>

            <button type="submit" class="btn btn-warning">Update Data</button>
            <a href="{{ route('salaries.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection