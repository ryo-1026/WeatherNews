@php

use Carbon\Carbon;

@endphp

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>天気情報 - {{ $prefecture->name }}</title>
    @vite('resources/css/app.css')
</head>

<body>
    <h1 class="w-full text-center text-3xl mt-8">{{ $prefecture->name }}の今日・明日の天気</h1>
    <div id="large" class="hidden text-center w-full px-2">
        <table class="border border-black border-2 mt-6 mx-2 px-2 w-[1200px] mx-auto">
            <tbody class="w-full">
                <tr class="py-4 border border-b border-black">
                    <td class="text-base px-4 py-2 border-b border-r border-black bg-slate-200">
                        日付
                    </td>
                    @foreach ($weatherRecords as $weatherRecord)
                    <td class="px-2 py-2 border-r border-b border-black bg-slate-200">
                        {{ Carbon::parse($weatherRecord->datetime)->format('n/j') }}
                        <br>
                        {{ Carbon::parse($weatherRecord->datetime)->format('G時') }}
                    </td>
                    @endforeach
                </tr>

                <tr class="py-4">
                    <td class="text-base py-2 border-b border-r border-black bg-slate-200">
                        天気
                    </td>
                    @foreach ($weatherRecords as $weatherRecord)
                    <td class="px-2 py-2 border-r border-b border-black">
                        {{ $weatherRecord->description }}
                    </td>
                    @endforeach
                </tr>

                <tr class="py-4">
                    <td class="text-base py-2 border-b border-r border-black bg-slate-200">
                        気温
                    </td>
                    @foreach ($weatherRecords as $weatherRecord)
                    <td class="px-2 py-2 border-r border-b border-black">
                        {{ $weatherRecord->temperature }} ℃
                    </td>
                    @endforeach
                </tr>

                <tr class="py-4">
                    <td class="text-base py-2 border-b border-r border-black bg-slate-200">
                        降水<br>確率
                    </td>
                    @foreach ($weatherRecords as $weatherRecord)
                    <td class="px-2 py-2 border-r border-b border-black">
                        {{ $weatherRecord->precipitation_probability }} %
                    </td>
                    @endforeach
                </tr>
            </tbody>
        </table>
        <div class="text-center my-10">
            <a class="bg-neutral-200 border rounded-md border-black px-8 py-2 hover:bg-neutral-400 " href="{{ url('/') }}">戻る</a>
        </div>
    </div>
    <!-- レスポンンシブデザインstart -->
    <div id="middle" class="hidden px-2">
        <table class="border border-black border-2 mt-6 mx-2 px-2 w-full mx-auto">
            <thead>
                <tr class="bg-slate-200">
                    <th class="text-base py-2 border-b border-r border-black">日時</th>
                    <th class="text-base py-2 border-b border-r border-black">天気</th>
                    <th class="text-base py-2 border-b border-r border-black">気温</th>
                    <th class="text-base py-2 border-b border-r border-black">降水確率</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($weatherRecords as $weatherRecord)
                <tr>
                    <td class="px-2 py-2 border-r border-b border-black bg-slate-200">{{ Carbon::parse($weatherRecord->datetime)->format('n/j') }}
                        <br>
                        {{ Carbon::parse($weatherRecord->datetime)->format('G時') }}
                    </td>
                    <td class="px-2 py-2 border-r border-b border-black"> {{ $weatherRecord->description }}</td>
                    <td class="px-2 py-2 border-r border-b border-black">{{ $weatherRecord->temperature }}°C</td>
                    <td class="px-2 py-2 border-r border-b border-black">{{ $weatherRecord->precipitation_probability }} %</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-center my-10">
            <a class="bg-neutral-200 border rounded-md border-black px-8 py-2 hover:bg-neutral-400 " href="{{ url('/') }}">戻る</a>
        </div>
    </div>

    <!-- レスポンシブデザインend -->

    <script>
        function responsiveTable() {
            const width = window.innerWidth;
            // const small = document.querySelector('.small');
            const middle = document.getElementById('middle');
            const large = document.getElementById('large');
            if (width < 1024) {
                large.classList.add('hidden');
                middle.classList.remove('hidden');
            } else {
                large.classList.remove('hidden');
                middle.classList.add('hidden');
            }
        }

        window.addEventListener('resize', responsiveTable);
        window.addEventListener('load', responsiveTable);
    </script>
</body>

</html>