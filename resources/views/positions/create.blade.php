@extends('master')
@section('title', 'Tambah Jabatan')
@section('page-title', 'Tambah Jabatan')

@section('content')
<div class="card col-md-6">
    <div class="card-body">
        <form action="{{ route('positions.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama Jabatan</label>
                <input type="text" name="nama_jabatan" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Gaji Pokok (Rp)</label>
                <input type="number" name="gaji_pokok" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('positions.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection