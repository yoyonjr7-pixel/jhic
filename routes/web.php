<?php

use App\Http\Controllers\KarirController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\AlumniTrackController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\MentoringController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\SpmbPendaftarController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TefaController;
use App\Http\Controllers\TefaBookingController;
use App\Http\Controllers\UnduhInformasiController;
use App\Models\Berita;
use App\Models\Jurusan;
use App\Models\Prestasi;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $daftarPrestasi = Prestasi::latest('id_prestasi')->get();

    // Semua berita dikirim ke view; tampil per 6 artikel dikontrol oleh
    // paginasi klien (panah + dots) di home.blade.php.
    $daftarBerita = Berita::orderByDesc('Tanggal')
        ->orderByDesc('id_berita')
        ->get();

    return view('home', compact('daftarPrestasi', 'daftarBerita'));
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
    $hasil = [
        'TSM' => [
            'nama' => 'Teknik Sepeda Motor',
            'deskripsi' => 'Mempelajari perawatan, perbaikan, dan teknologi sepeda motor.',
            'poin' => ['Servis dan perawatan sepeda motor', 'Sistem mesin dan kelistrikan', 'Praktik kerja bengkel'],
        ],
        'TKR' => [
            'nama' => 'Teknik Kendaraan Ringan',
            'deskripsi' => 'Mempelajari perawatan dan perbaikan kendaraan ringan seperti mobil.',
            'poin' => ['Perawatan mesin kendaraan', 'Sistem pemindah tenaga', 'Diagnosis kerusakan mobil'],
        ],
        'TJKT' => [
            'nama' => 'Teknik Jaringan Komputer dan Telekomunikasi',
            'deskripsi' => 'Mempelajari jaringan komputer, perangkat digital, dan teknologi komunikasi.',
            'poin' => ['Instalasi jaringan', 'Administrasi sistem', 'Perangkat dan layanan digital'],
        ],
        'TP' => [
            'nama' => 'Teknik Pemesinan',
            'deskripsi' => 'Mempelajari proses pemesinan, pengelasan, dan pembuatan benda kerja.',
            'poin' => ['Pengoperasian mesin perkakas', 'Pengukuran teknik', 'Pembuatan dan penyambungan logam'],
        ],
    ];

    $points = session('jurumatch.points', array_fill_keys(array_keys($hasil), 0));
    $kodeJawaban = strtoupper((string) request('jawaban'));

    if (array_key_exists($kodeJawaban, $points)) {
        $points[$kodeJawaban]++;
        session(['jurumatch.points' => $points]);
    }

    $maxPoints = 10;
    $maxScore = max($points);
    $kode = array_key_first($points);
    $kodeTeratas = $maxScore > 0
        ? array_keys(array_filter($points, static fn ($itemPoints) => $itemPoints === $maxScore))
        : [$kode];
    $kode = $kodeTeratas[0];

    return view('jurumatch.hasil', compact('kode', 'kodeTeratas', 'hasil', 'points', 'maxPoints'));
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

Route::get('/jurumatch/quiz', function () {
    session()->forget('jurumatch.points');
    return view('jurumatch.pertanyaan1');
})->name('jurumatch.quiz');

Route::get('/jurumatch/quiz/pertanyaan{number}', function (int $number) {
    $kodeJawaban = strtoupper((string) request('jawaban'));
    $kodeTersedia = ['TSM', 'TKR', 'TJKT', 'TP'];
    $points = session('jurumatch.points', array_fill_keys($kodeTersedia, 0));

    if (in_array($kodeJawaban, $kodeTersedia, true)) {
        $points[$kodeJawaban]++;
        session(['jurumatch.points' => $points]);
    }

    return view('jurumatch.pertanyaan' . $number);
})->where('number', '[2-9]|10')->name('jurumatch.quiz.pertanyaan');

Route::get('/profil-guru', function () {
    return view('profil-guru.profil-guru');
})->name('profil-guru');

Route::get('/spmb/informasi', function () {
    return view('spmb.informasi');
})->name('spmb.informasi');

Route::get('/spmb/unduh-informasi', [UnduhInformasiController::class, 'publicIndex'])
    ->name('spmb.unduh-informasi');

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

Route::get('/prestasi', [PrestasiController::class, 'publicIndex'])->name('prestasi');

Route::get('/berita-sekolah', [BeritaController::class, 'publicIndex'])
    ->name('berita.public');

Route::get('/download-information', [UnduhInformasiController::class, 'publicIndex'])
    ->name('download-information');
Route::get('/download-information/{id}', [UnduhInformasiController::class, 'publicDownload'])
    ->name('download-information.file');

Route::get('/karir', [KarirController::class, 'tjkt'])->name('karir.tjkt');
Route::get('/tkr', [KarirController::class, 'tkr'])->name('karir.tkr');
Route::get('/tbsm', [KarirController::class, 'tbsm'])->name('karir.tbsm');
Route::get('/tp', [KarirController::class, 'tp'])->name('karir.tp');
Route::post('/mentoring', [KarirController::class, 'mentoringStore'])
    ->name('mentoring.store');

Route::get('/alumni', function () {
    $jurusan = Jurusan::orderBy('id_jurusan')->get();

    return view('alumnitrack.alumnitrack', compact('jurusan'));
})->name('alumni');
Route::get('/alumni/check-nisn', [AlumniController::class, 'checkNisn'])->name('alumni.check-nisn');
Route::post('/alumni', [AlumniController::class, 'store'])->name('alumni.store');

Route::get('/tefa', function () {
    return view('tefa.katalog');
})->name('tefa.katalog');
Route::get('/tefa/booking', function () {
    return view('tefa.booking');
})->name('tefa.booking');
Route::post('/tefa/booking', [TefaBookingController::class, 'store'])
    ->name('tefa.booking.store');

    Route::get('/spmb', [SpmbPendaftarController::class, 'show'])->name('spmb');
Route::get('/spmb/daftar', [SpmbPendaftarController::class, 'showForm'])->name('spmb.form');
Route::post('/spmb/daftar/konfirmasi', [SpmbPendaftarController::class, 'confirm'])->name('spmb.confirm');
Route::get('/spmb/daftar/konfirmasi', [SpmbPendaftarController::class, 'showConfirmation'])->name('spmb.confirmation');
Route::post('/spmb/daftar/kirim', [SpmbPendaftarController::class, 'store'])->name('spmb.store');
Route::get('/spmb/daftar/selesai', [SpmbPendaftarController::class, 'success'])->name('spmb.success');



/*
|--------------------------------------------------------------------------
| HALAMAN UMUM
|--------------------------------------------------------------------------
*/

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

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | DATA SISWA
    |--------------------------------------------------------------------------
    */

    Route::get('/siswa', [SiswaController::class, 'index'])
        ->name('siswa.index');
    Route::post('/siswa', [SiswaController::class, 'store'])
        ->name('siswa.store');
    Route::put('/siswa/{id}', [SiswaController::class, 'update'])
        ->name('siswa.update');
    Route::delete('/siswa/{id}', [SiswaController::class, 'destroy'])
        ->name('siswa.destroy');


    /*
    |--------------------------------------------------------------------------
    | MENTORING
    |--------------------------------------------------------------------------
    */

    Route::get('/mentoring', [MentoringController::class, 'index'])
        ->name('mentoring.index');
    Route::put('/mentoring/{id}/status', [MentoringController::class, 'updateStatus'])
        ->name('mentoring.update-status');
    Route::delete('/mentoring/{id}', [MentoringController::class, 'destroy'])
        ->name('mentoring.destroy');
    Route::get('/mentoring/{id}', [MentoringController::class, 'show'])
        ->whereNumber('id')
        ->name('mentoring.show');
    Route::get('/mentoring/detail', fn () => redirect()->route('mentoring.index'));


    /*
    |--------------------------------------------------------------------------
    | ALUMNI TRACK
    |--------------------------------------------------------------------------
    */

    Route::get('/alumni-track', [AlumniTrackController::class, 'index']);

    Route::post('/alumni-track/{id}/ijazah', [AlumniTrackController::class, 'generateIjazahId'])
        ->whereNumber('id')
        ->name('alumni-track.ijazah.generate');
    Route::put('/alumni-track/ijazah/{id}', [AlumniTrackController::class, 'updateIjazah'])
        ->whereNumber('id')
        ->name('alumni-track.ijazah.update');

    Route::post('/alumni-track', [AlumniTrackController::class, 'store'])
        ->name('alumni-track.store');

    Route::put('/alumni-track/{id}', [AlumniTrackController::class, 'update'])
        ->name('alumni-track.update');

    Route::delete('/alumni-track/{id}', [AlumniTrackController::class, 'destroy'])
        ->name('alumni-track.destroy');

    Route::get('/lowongan-pekerjaan', [LowonganController::class, 'index'])
        ->name('lowongan.index');
    Route::post('/lowongan-pekerjaan', [LowonganController::class, 'store'])
        ->name('lowongan.store');
    Route::put('/lowongan-pekerjaan/{id}', [LowonganController::class, 'update'])
        ->name('lowongan.update');
    Route::delete('/lowongan-pekerjaan/{id}', [LowonganController::class, 'destroy'])
        ->name('lowongan.destroy');

    Route::get('/spmb-pendaftar', [SpmbPendaftarController::class, 'adminIndex'])
        ->name('spmb-pendaftar.index');
    Route::put('/spmb-pendaftar/{id}/status', [SpmbPendaftarController::class, 'updateStatus'])
        ->name('spmb-pendaftar.update-status');


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

    Route::get('/admin/prestasi', [PrestasiController::class, 'index'])
        ->name('prestasi.index');

    Route::post('/admin/prestasi', [PrestasiController::class, 'store'])
        ->name('prestasi.store');

    Route::get('/admin/prestasi/{id}', [PrestasiController::class, 'show'])
        ->name('prestasi.show');

    Route::put('/admin/prestasi/{id}', [PrestasiController::class, 'update'])
        ->name('prestasi.update');

    Route::delete('/admin/prestasi/{id}', [PrestasiController::class, 'destroy'])
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