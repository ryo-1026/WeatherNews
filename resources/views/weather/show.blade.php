<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>天気情報</title>
    @vite('resources/css/app.css')
</head>

<body>
    <h1>{{ $weather->prefecture->name }}の天気情報</h1>
    <p>日付: {{ $weather->date }}</p>
    <p>天気: {{ $weather->weather }}</p>
    <p>降水確率: {{ $weather->precipitation }}%</p>
    <p>最高気温: {{ $weather->max_temp }}°C</p>
    <p>最低気温: {{ $weather->min_temp }}°C</p>
    <a href="{{ route('weather.index') }}">戻る</a>
</body>

</html>