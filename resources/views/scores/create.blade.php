@extends('layouts.app')

@section('title', 'Tambah Penilaian')

@section('content')
<h1>Tambah Penilaian</h1>

<form action="{{ route('scores.store') }}" method="POST">
    @csrf
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Alternatif</th>
                @foreach($criteria as $criterion)
                    <th>{{ $criterion->name }} ({{ ucfirst($criterion->type) }})</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($alternatives as $alternative)
            <tr>
                <td>{{ $alternative->name }}</td>
                @foreach($criteria as $criterion)
                <td>
                    <input type="number" step="0.0001" name="scores[{{ $loop->parent->index }}][value]" class="form-control" required>
                    <input type="hidden" name="scores[{{ $loop->parent->index }}][alternative_id]" value="{{ $alternative->id }}">
                    <input type="hidden" name="scores[{{ $loop->parent->index }}][criteria_id]" value="{{ $criterion->id }}">
                </td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('scores.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
