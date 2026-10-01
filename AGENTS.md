# AGENTS.md — Panduan Agen untuk Proyek JHIC

## Perilaku: lanjut otomatis saat error (auto-continue)

Jika sebuah langkah gagal — error perintah, error PHP/JS, validasi gagal, tool gagal,
hasil kosong, atau asumsi yang ternyata salah — **jangan berhenti menunggu pesan "do it"**.
Perlakukan "do it" sebagai "lanjutkan", dan secara default lakukan sendiri:

1. Baca pesan error sampai tuntas, cari akar masalahnya (jangan menebak).
2. Perbaiki lalu ulangi langkah yang gagal.
3. Kalau pendekatan pertama gagal, coba pendekatan lain yang masuk akal (maksimal 2–3 percobaan).
4. Lanjutkan sampai tugas selesai, lalu laporkan hasil akhir beserta sisa risiko/ketidakpastian.

Jangan menyuruh pengguna mengetik "do it" hanya untuk melanjutkan pekerjaan yang sama.

### Batas keamanan (tetap minta konfirmasi)

Auto-continue **tidak** berlaku untuk tindakan berisiko atau ireversibel. Tetap berhenti
dan minta konfirmasi sebelum:

- `git commit`, `git push`, `git reset --hard`, rebase, force push, hapus branch/tag
- menghapus file secara masal, atau mereset/menghapus data database
- mengubah `.env`/kredensial, mengirim data ke layanan eksternal, memasang dependensi baru
- memperluas lingkup pekerjaan di luar permintaan terakhir pengguna

Kalau pemulihan dari error menuntut salah satu hal di atas: berhenti, jelaskan singkat, lalu tanyakan.

## Konteks proyek

- Laravel 12, PHP 8.2, di XAMPP; database MySQL `jhic`.
- Halaman memakai `@extends('layouts.app')` + `@section('title' | 'styles' | 'content')`.
  - `@yield('styles')` ada di `layouts/navbar.blade.php` (bukan di `app.blade.php`).
  - `navbar.blade.php` dan `footer.blade.php` sudah memuat `<html>`, jadi jangan menambah struktur itu di view halaman.
- CSS halaman: `public/css/<nama>.css`. Sebagian file memakai format renggang, sebagian rapat —
  ikuti gaya file yang sedang diedit.
- JS halaman: `public/js/<nama>.js`. Jangan tambah library/dependensi baru kalau CSS/JS biasa cukup.
- Halaman statis cukup pakai route closure di `routes/web.php`; data dinamis pakai controller.
- Bahasa kode, komentar, dan teks UI mengikuti gaya existing: Indonesia.

## Verifikasi sebelum selesai

- PHP: `php -l <file>`
- JS: `node --check <file>`
- Blade: `php artisan view:cache` lalu `php artisan view:clear`
- Halaman: `php artisan serve` pada port bebas, fetch lewat HTTP, pastikan status 200 dan
  tidak ada `ErrorException`/`Internal Server Error`.
- Cek error terbaru di `storage/logs/laravel.log`.

## Git

- Jangan commit/push kecuali diminta eksplisit.
- Worktree Agent Manager di `.kilo/worktrees/` jangan diutak-atik kecuali diminta.

## Catatan data yang mudah menjebak

- `lowongan_kerja` punya kolom `id_jurusan`, `gaji_min`, `gaji_max`, `skills` yang **hanya ada di
  database**, belum ada migration/seeder-nya. Kalau database di-reset, kolom & data itu hilang.
- `lowongan_kerja.skills` disimpan sebagai string JSON; model `Lowongan` sudah meng-cast ke `array`.
  Tetap pakai `(array)` saat me-loop di view agar data lama yang tidak valid tidak membuat 500.
- Relasi lowongan ke jurusan memakai `id_jurusan`, dicocokkan dari `config('tefa.jurusan.<kode>.nama')`
  ke tabel `jurusan` (lihat `KarirController`).
