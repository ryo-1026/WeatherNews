<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>天気予報</title>
    @vite('resources/css/app.css')
</head>

<body>
    <section class="p-10">
        <h1 class="w-full text-center text-3xl mt-8">都道府県別天気情報</h1>
        <div class="mx-auto border rounded-md border-black border-2 p-8 mt-10 lg:w-1/2 md:w-3/4">
            @if (session('error'))
            <p class="text-red-600">{{ session('error') }}</p>
            @endif
            <form class="text-center" action="{{ route('weather.getweather') }}" method="POST">
                @csrf
                <div class="mb-4 text-center">
                    <label for="prefecture w-full block">都道府県を選択してください</label>
                    <div class="w-full mt-4">
                        <select id="prefecture" class="border border-black" name="prefecture_id" required>
                            @foreach ($prefectures as $prefecture)
                            <option value="{{ $prefecture->id }}">{{ $prefecture->name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <button class="lg:w-1/2 md:3/4 mt-10 bg-neutral-200 border rounded-md border-black px-8 py-2 hover:bg-neutral-400  block mx-auto" type="submit">天気情報を取得</button>
            </form>
        </div>

    </section>


</body>

</html>