@extends('layouts.app')

@section('title', 'Ranking SAW')

@section('content')
<h1>Ranking SAW</h1>

@if(count($ranking) > 0)
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Peringkat</th>
            <th>Alternatif</th>
            <th>Skor</th>
        </tr>
    </thead>
    <tbody>
        @foreach($ranking as $index => $item)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $item['alternative'] }}</td>
            <td>{{ $item['score'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<a href="{{ route('ranking.exportPdf') }}" class="btn btn-danger"><i class="fas fa-file-pdf"></i> Export PDF</a>
@else
<p>Belum ada data ranking yang tersedia.</p>
@endif

@endsection
