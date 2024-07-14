<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>地域別天気予報</title>
    @vite('resources/css/app.css')
</head>

<body>
    <section class="p-10">
        <h1 class="w-full text-center text-3xl mt-8">都道府県別天気情報</h1>
        <div class="mx-auto border border-black border-2 p-8 mt-10 w-1/2">
            @if (session('error'))
            <p class="text-red-600">{{ session('error') }}</p>
            @endif
            <form class="text-center" action="{{ route('weather.getweather') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="prefecture">都道府県を選択してください　:　</label>
                    <select id="prefecture" class="border border-black" name="prefecture_id" required>
                        @foreach ($prefectures as $prefecture)
                        <option value="{{ $prefecture->id }}">{{ $prefecture->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button class="w-1/2 mt-10 bg-neutral-200 border rounded-md border-black px-8 py-2 hover:bg-neutral-400  block mx-auto" type="submit">天気情報を取得</button>
            </form>
        </div>

    </section>


</body>

</html>