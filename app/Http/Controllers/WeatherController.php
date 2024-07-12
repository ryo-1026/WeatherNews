<?php

namespace App\Http\Controllers;

use App\Models\Prefecture;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function index(){
        $prefectures = Prefecture::all();
        return view('weather.index' ,compact('prefectures'));
    }
}
