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
    <section class="text-center w-full px-2">
        <h1 class="w-full text-center text-3xl mt-8">{{ $prefecture->name }}の今日・明日の天気</h1>
        <div class="overflow-x-scroll ">
            <table id="large" class="border border-black border-2 mt-6 mx-2 px-2 w-[1200px] mx-auto">
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
        </div>

        <div class="text-center mt-10">
            <a class="bg-neutral-200 border rounded-md border-black px-8 py-2 hover:bg-neutral-400 " href="{{ url('/') }}">戻る</a>
        </div>
    </section>

</body>

</html>