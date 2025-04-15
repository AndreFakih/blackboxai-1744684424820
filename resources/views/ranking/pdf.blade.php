<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Ranking SAW PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h1 { text-align: center; }
    </style>
</head>
<body>
    <h1>Ranking SAW</h1>
    @if(count($ranking) > 0)
    <table>
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
    @else
    <p>Belum ada data ranking yang tersedia.</p>
    @endif
</body>
</html>
