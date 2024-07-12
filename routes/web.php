<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeatherController;

Route::get('/', [WeatherController::class, 'index'])->name('weather.index');
Route::post('/getweather', [WeatherController::class], 'getweather')->name('weather.getweather');
