<?php

use App\Http\Controllers\TefaBookingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});
Route::get('/virtualtour', function () {
    return view('virtualtour.index');
});
Route::get('/tefa', function () {
    return view('tefa.katalog');
})->name('tefa.katalog');
Route::get('/tefa/booking', function () {
    return view('tefa.booking');
})->name('tefa.booking');
Route::post('/tefa/booking', [TefaBookingController::class, 'store'])
    ->name('tefa.booking.store');
