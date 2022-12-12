<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::get('/day-1', Controllers\DayOneController::class)->name('day-1');
Route::get('/day-2', Controllers\DayTwoController::class)->name('day-2');
Route::get('/day-3', Controllers\DayThreeController::class)->name('day-3');

Route::get('/', Controllers\HomeController::class);
