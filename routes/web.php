
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumniTrackController;
use App\Http\Controllers\TefaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\UnduhInformasiController;

/*
|--------------------------------------------------------------------------
| HALAMAN UMUM
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| AUTHENTICATION
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');


/*
|--------------------------------------------------------------------------
| AREA ADMIN
|--------------------------------------------------------------------------
|
| Semua halaman di dalam group ini membutuhkan login.
|
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | MENTORING
    |--------------------------------------------------------------------------
    */

    Route::get('/mentoring', function () {
        return view('mentoring');
    });

    Route::get('/mentoring/detail', function () {
        return view('mentoring-detail');
    });


    /*
    |--------------------------------------------------------------------------
    | ALUMNI TRACK
    |--------------------------------------------------------------------------
    */

    Route::get('/alumni-track', [AlumniTrackController::class, 'index']);

    Route::post('/alumni-track', [AlumniTrackController::class, 'store'])
        ->name('alumni-track.store');

    Route::put('/alumni-track/{id}', [AlumniTrackController::class, 'update'])
        ->name('alumni-track.update');

    Route::delete('/alumni-track/{id}', [AlumniTrackController::class, 'destroy'])
        ->name('alumni-track.destroy');


    /*
    |--------------------------------------------------------------------------
    | TEFA ONLINE
    |--------------------------------------------------------------------------
    */

    Route::get('/tefa-online', [TefaController::class, 'index'])
        ->name('tefa.index');

    Route::post('/tefa-online', [TefaController::class, 'store'])
        ->name('tefa.store');

    Route::get('/tefa-online/{id}', [TefaController::class, 'show'])
        ->name('tefa.show');

    Route::put('/tefa-online/{id}', [TefaController::class, 'update'])
        ->name('tefa.update');

    Route::put('/tefa-online/{id}/status', [TefaController::class, 'updateStatus'])
        ->name('tefa.update-status');

    Route::delete('/tefa-online/{id}', [TefaController::class, 'destroy'])
        ->name('tefa.destroy');


    /*
    |--------------------------------------------------------------------------
    | PRESTASI
    |--------------------------------------------------------------------------
    */

    Route::get('/prestasi', [PrestasiController::class, 'index'])
        ->name('prestasi.index');

    Route::post('/prestasi', [PrestasiController::class, 'store'])
        ->name('prestasi.store');

    Route::get('/prestasi/{id}', [PrestasiController::class, 'show'])
        ->name('prestasi.show');

    Route::put('/prestasi/{id}', [PrestasiController::class, 'update'])
        ->name('prestasi.update');

    Route::delete('/prestasi/{id}', [PrestasiController::class, 'destroy'])
        ->name('prestasi.destroy');


    /*
    |--------------------------------------------------------------------------
    | BERITA TERBARU
    |--------------------------------------------------------------------------
    */

    Route::get('/berita', [BeritaController::class, 'index'])
        ->name('berita.index');

    Route::post('/berita', [BeritaController::class, 'store'])
        ->name('berita.store');

    Route::get('/berita/{id}', [BeritaController::class, 'show'])
        ->name('berita.show');

    Route::put('/berita/{id}', [BeritaController::class, 'update'])
        ->name('berita.update');

    Route::delete('/berita/{id}', [BeritaController::class, 'destroy'])
        ->name('berita.destroy');


    /*
    |--------------------------------------------------------------------------
    | UNDUH INFORMASI
    |--------------------------------------------------------------------------
    */

    Route::get('/unduh-informasi', [UnduhInformasiController::class, 'index'])
        ->name('unduh-informasi.index');

    Route::post('/unduh-informasi', [UnduhInformasiController::class, 'store'])
        ->name('unduh-informasi.store');

    Route::get('/unduh-informasi/{id}', [UnduhInformasiController::class, 'show'])
        ->name('unduh-informasi.show');

    Route::put('/unduh-informasi/{id}', [UnduhInformasiController::class, 'update'])
        ->name('unduh-informasi.update');

    Route::delete('/unduh-informasi/{id}', [UnduhInformasiController::class, 'destroy'])
        ->name('unduh-informasi.destroy');

    Route::get('/unduh-informasi/{id}/download', [UnduhInformasiController::class, 'download'])
        ->name('unduh-informasi.download');


    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

});