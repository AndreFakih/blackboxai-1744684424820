@extends('layouts.app')

@section('title', 'Daftar Penilaian')

@section('content')
<h1>Daftar Penilaian</h1>

<a href="{{ route('scores.create') }}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah Penilaian</a>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Alternatif</th>
            @foreach($criteria as $criterion)
                <th>{{ $criterion->name }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($alternatives as $alternative)
        <tr>
            <td>{{ $alternative->name }}</td>
            @foreach($criteria as $criterion)
                <td>
                    @if(isset($scores[$alternative->id]))
                        @php
                            $score = $scores[$alternative->id]->firstWhere('criteria_id', $criterion->id);
                        @endphp
                        {{ $score ? $score->value : '-' }}
                    @else
                        -
                    @endif
                </td>
            @endforeach
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
