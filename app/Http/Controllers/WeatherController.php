<?php

namespace App\Http\Controllers;

use App\Models\Prefecture;
use App\Models\Weather;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function index()
    {
        $prefectures = Prefecture::all();
        return view('weather.index', compact('prefectures'));
    }

    public function getweather(Request $request)
    {

        $request->validate([
            'prefecture_id' => ['required', 'exists:prefectures,id']
        ]);

        //取得したIDから、都道府県の情報をDB取得
        $prefecture = Prefecture::findOrFail($request->prefecture_id);
        //今日の日付を取得して文字列変換
        $today = Carbon::today()->toDateString();

        //weathersテーブルに選ばれた都道府県名に対応する天気予報情報があるか
        $weatherRecords = Weather::where('prefecture_id', $prefecture->id)
            ->whereDate('created_at', $today)
            ->orderBy('datetime', 'asc')
            ->get();

        //weatherテーブルに取得したデータが今日以外の場合、テーブルデータを削除する
        $deleteRecords = Weather::where('prefecture_id', $prefecture->id)
            ->whereDate('created_at', '<>', $today)
            ->delete();

        //データベースにない場合APIを利用して天気データを取得する
        if ($weatherRecords->isEmpty()) {
            $apiKey = env('OPENWEATHERMAP_API_KEY');
            $response = Http::retry(3, 100)->get(
                "https://api.openweathermap.org/data/2.5/forecast",
                [
                    'q' => $prefecture->name,
                    'appid' => $apiKey,
                    'units' => 'metric',
                    'lang' => 'ja'
                ]
            );

            if ($response->successful()) {
                $getWeatherDataLists = $response->json();

                foreach ($getWeatherDataLists['list'] as $getWeatherDataList) {

                    //今日と明日の日付を定義
                    $startDateTime = Carbon::today();
                    $endDateTime = Carbon::tomorrow()->endOfDay();

                    //APIから取得した天気データの時間帯を日本時間に変換
                    $datetime = Carbon::createFromTimestamp($getWeatherDataList['dt'])->timezone('Asia/Tokyo');

                    //取得した天気データの時間帯が今日と明日の範囲内にあるか判定
                    if ($datetime->between($startDateTime, $endDateTime)) {
                        //条件に合致した天気情報のみデータベースに保存
                        Weather::create([
                            'prefecture_id' => $prefecture->id,
                            'description' => $getWeatherDataList['weather'][0]['description'],
                            'precipitation_probability' => $getWeatherDataList['pop'] * 100,
                            'temperature' => number_format($getWeatherDataList['main']['temp'], 1),
                            'datetime' => $datetime->toDateTimeString(),
                        ]);
                    }
                }

                //データベースかデータ抽出
                $weatherRecords = Weather::where('prefecture_id', $prefecture->id)
                    ->whereBetween('datetime', [$startDateTime, $endDateTime])
                    ->orderBy('datetime', 'asc')
                    ->get();
            } else {
                //APIからの取得を失敗した場合
                return redirect()->back()->with('error', '天気情報を取得できませんでした');
            }
        }

        // 天気データをviewで表示
        return view('weather.getweather', compact('prefecture', 'weatherRecords'));
    }
}
