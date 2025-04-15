@extends('layouts.app')

@section('title', 'Edit Kriteria')

@section('content')
<h1>Edit Kriteria</h1>

<form action="{{ route('criteria.update', $criteria) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="name" class="form-label">Nama Kriteria</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $criteria->name) }}" required>
    </div>
    <div class="mb-3">
        <label for="type" class="form-label">Tipe Kriteria</label>
        <select class="form-select" id="type" name="type" required>
            <option value="benefit" {{ old('type', $criteria->type) == 'benefit' ? 'selected' : '' }}>Benefit</option>
            <option value="cost" {{ old('type', $criteria->type) == 'cost' ? 'selected' : '' }}>Cost</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="weight" class="form-label">Bobot</label>
        <input type="number" step="0.0001" class="form-control" id="weight" name="weight" value="{{ old('weight', $criteria->weight) }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('criteria.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
