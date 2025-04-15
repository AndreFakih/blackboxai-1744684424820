@extends('layouts.app')

@section('title', 'Daftar Alternatif')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Daftar Alternatif</h1>
    <a href="{{ route('alternatives.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Alternatif</a>
</div>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($alternatives as $alternative)
        <tr>
            <td>{{ $alternative->name }}</td>
            <td>
                <a href="{{ route('alternatives.edit', $alternative) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
                <form action="{{ route('alternatives.destroy', $alternative) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus alternatif ini?');">
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
