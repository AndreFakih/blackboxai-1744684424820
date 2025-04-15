@extends('layouts.app')

@section('title', 'Daftar Kriteria')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Daftar Kriteria</h1>
    <a href="{{ route('criteria.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Kriteria</a>
</div>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Tipe</th>
            <th>Bobot</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($criteria as $criterion)
        <tr>
            <td>{{ $criterion->name }}</td>
            <td>{{ ucfirst($criterion->type) }}</td>
            <td>{{ $criterion->weight }}</td>
            <td>
                <a href="{{ route('criteria.edit', $criterion) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
                <form action="{{ route('criteria.destroy', $criterion) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kriteria ini?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
