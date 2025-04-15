@extends('layouts.app')

@section('title', 'Tambah Kriteria')

@section('content')
<h1>Tambah Kriteria</h1>

<form action="{{ route('criteria.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Nama Kriteria</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
    </div>
    <div class="mb-3">
        <label for="type" class="form-label">Tipe Kriteria</label>
        <select class="form-select" id="type" name="type" required>
            <option value="">Pilih tipe</option>
            <option value="benefit" {{ old('type') == 'benefit' ? 'selected' : '' }}>Benefit</option>
            <option value="cost" {{ old('type') == 'cost' ? 'selected' : '' }}>Cost</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="weight" class="form-label">Bobot</label>
        <input type="number" step="0.0001" class="form-control" id="weight" name="weight" value="{{ old('weight') }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('criteria.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
