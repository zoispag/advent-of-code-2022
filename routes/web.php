<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::get('/day-1', Controllers\DayOneController::class)->name('day-1');
Route::get('/day-2', Controllers\DayTwoController::class)->name('day-2');
Route::get('/day-3', Controllers\DayThreeController::class)->name('day-3');
Route::get('/day-4', Controllers\DayFourController::class)->name('day-4');
Route::get('/day-5', Controllers\DayFiveController::class)->name('day-5');
Route::get('/day-6', Controllers\DaySixController::class)->name('day-6');
Route::get('/day-7', Controllers\DaySevenController::class)->name('day-7');
Route::get('/day-8', Controllers\DayEightController::class)->name('day-8');
Route::get('/day-9', Controllers\DayNineController::class)->name('day-9');
Route::get('/day-10', Controllers\DayTenController::class)->name('day-10');
Route::view('/day-10-show-letters', 'day-10-show-letters')->name('day-10-show-letters');
Route::get('/day-11', Controllers\DayElevenController::class)->name('day-11');

Route::get('/', Controllers\HomeController::class);
