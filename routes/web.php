<?php

use App\Http\Controllers\KarirController;
use App\Http\Controllers\TefaBookingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});
Route::get('/virtualtour', function () {
    return view('virtualtour.index');
});

Route::get('/karir', [KarirController::class, 'tjkt'])->name('karir.tjkt');
Route::get('/tkr', [KarirController::class, 'tkr'])->name('karir.tkr');
Route::get('/tbsm', [KarirController::class, 'tbsm'])->name('karir.tbsm');
Route::get('/tp', [KarirController::class, 'tp'])->name('karir.tp');
Route::post('/mentoring', [KarirController::class, 'mentoringStore'])
    ->name('mentoring.store');

Route::get('/alumni', function () {
    return view('alumnitrack.alumnitrack');
})->name('alumni');

Route::get('/tefa', function () {
    return view('tefa.katalog');
})->name('tefa.katalog');
Route::get('/tefa/booking', function () {
    return view('tefa.booking');
})->name('tefa.booking');
Route::post('/tefa/booking', [TefaBookingController::class, 'store'])
    ->name('tefa.booking.store');
