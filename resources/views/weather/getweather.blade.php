<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>天気情報 - {{ $prefecture->name }}</title>
    @vite('resources/css/app.css')
</head>

<body>
    <h1>{{ $prefecture->name }}の今日・明日の天気</h1>
    <table>
        <thead>
            <tr>
                <th>日時</th>
                <th>天気</th>
                <th>気温</th>
                <th>降水確率</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($weatherRecords as $weatherRecord)
            <tr>
                <td>{{ $weatherRecord->datetime }}</td>
                <td>{{ $weatherRecord->description }}</td>
                <td>{{ $weatherRecord->temperature }}°C</td>
                <td>{{ $weatherRecord->precipitation_probability }}%</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ url('/') }}">戻る</a>
</body>

</html>