@extends('layouts.app')

@section('title', 'Edit Alternatif')

@section('content')
<h1>Edit Alternatif</h1>

<form action="{{ route('alternatives.update', $alternative) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="name" class="form-label">Nama Alternatif</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $alternative->name) }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('alternatives.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
