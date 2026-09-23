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
Route::get('/fasilitas', function () {
    return view('fasilitas.fasilitas');
})->name('fasilitas');

Route::get('/jurumatch', function () {
    return view('jurumatch.JuruMatch');
})->name('jurumatch');

Route::get('/jurumatch/hasil', function () {
    return view('jurumatch.hasil');
})->name('jurumatch.hasil');

Route::get('/jurumatch/pertanyaan1', function () {
    return view('jurumatch.pertanyaan1');
})->name('jurumatch.pertanyaan1');

Route::get('/jurumatch/pertanyaan2', function () {
    return view('jurumatch.pertanyaan2');
})->name('jurumatch.pertanyaan2');

Route::get('/jurumatch/pertanyaan3', function () {
    return view('jurumatch.pertanyaan3');
})->name('jurumatch.pertanyaan3');

Route::get('/jurumatch/pertanyaan4', function () {
    return view('jurumatch.pertanyaan4');
})->name('jurumatch.pertanyaan4');

Route::get('/jurumatch/pertanyaan5', function () {
    return view('jurumatch.pertanyaan5');
})->name('jurumatch.pertanyaan5');

Route::get('/jurumatch/pertanyaan6', function () {
    return view('jurumatch.pertanyaan6');
})->name('jurumatch.pertanyaan6');

Route::get('/jurumatch/pertanyaan7', function () {
    return view('jurumatch.pertanyaan7');
})->name('jurumatch.pertanyaan7');

Route::get('/jurumatch/pertanyaan8', function () {
    return view('jurumatch.pertanyaan8');
})->name('jurumatch.pertanyaan8');

Route::get('/jurumatch/pertanyaan9', function () {
    return view('jurumatch.pertanyaan9');
})->name('jurumatch.pertanyaan9');

Route::get('/jurumatch/pertanyaan10', function () {
    return view('jurumatch.pertanyaan10');
})->name('jurumatch.pertanyaan10');

Route::get('/profil-guru', function () {
    return view('profil-guru.profil-guru');
})->name('profil-guru');

Route::get('/spmb/informasi', function () {
    return view('spmb.informasi');
})->name('spmb.informasi');

Route::get('/spmb/unduh-informasi', function () {
    return view('spmb.unduh-informasi');
})->name('spmb.unduh-informasi');

Route::get('/visi-misi', function () {
    return view('visi-misi.visi-misi');
})->name('visi-misi');

// Alias lama (URL /visimisi tetap dipertahankan).
Route::get('/visimisi', function () {
    return view('visi-misi.visi-misi');
})->name('visimisi.visi-misi');

Route::get('/about-school', function () {
    return view('visi-misi.visi-misi');
})->name('about-school');

Route::get('/spmb', function () {
    return view('spmb.informasi');
})->name('spmb');

Route::get('/download-information', function () {
    return view('spmb.unduh-informasi');
})->name('download-information');

Route::get('/prestasi', function () {
    return view('prestasi.index', [
        'prestasi' => [
            ['tingkat' => 'Kabupaten', 'jumlah' => 50],
            ['tingkat' => 'Provinsi', 'jumlah' => 60],
            ['tingkat' => 'Nasional', 'jumlah' => 120],
            ['tingkat' => 'Internasional', 'jumlah' => 0],
        ],
    ]);
})->name('prestasi');

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
