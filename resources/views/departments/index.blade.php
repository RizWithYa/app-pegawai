@extends('master')
@section('title', 'Daftar Departemen')

@section('content')
    <a href="{{ route('departments.create') }}" class="btn btn-primary mb-3">Tambah Departemen</a>
    
    <table class="table table-bordered table-striped"> <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Departemen</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            </tbody>
    </table>
@endsection