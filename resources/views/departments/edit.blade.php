@extends('master')
@section('title', 'Edit Departemen')
@section('page-title', 'Edit Departemen')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('departments.update', $department->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="nama_departemen" class="form-label">Nama Departemen</label>
                        <input type="text" name="nama_departemen" class="form-control" 
                               value="{{ old('nama_departemen', $department->nama_departemen) }}" required>
                    </div>
                    
                    <button type="submit" class="btn btn-warning">Update</button>
                    <a href="{{ route('departments.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection