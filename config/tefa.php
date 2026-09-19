<?php

/*
|--------------------------------------------------------------------------
| KATALOG LAYANAN TEFA ONLINE
|--------------------------------------------------------------------------
|
| Ubah nama, deskripsi, dan harga layanan pada array dibawah ini.
| Field yang tersedia untuk setiap layanan:
|   - nama      : Judul layanan yang tampil pada kartu
|   - deskripsi : Penjelasan singkat layanan
|   - harga     : Teks harga yang tampil pada kartu
|   - kategori  : Kode jurusan (tsm, tkr, tjkt, tp) untuk filter
|   - slug      : Identitas unik layanan (tanpa spasi, gunakan tanda -)
|   - ikon      : Nama ikon, lihat resources/views/tefa/partials/icon.blade.php
|
*/

return [

    /*
    |--------------------------------------------------------------------------
    | DAFTAR JURUSAN
    |--------------------------------------------------------------------------
    | Kode jurusan dipakai untuk filter katalog, sedangkan nama jurusan dipakai
    | untuk mencocokkan data ke tabel `jurusan` pada database.
    |
    */

    'jurusan' => [
        'tsm'  => ['label' => 'TSM',  'nama' => 'Teknik Sepeda Motor'],
        'tkr'  => ['label' => 'TKR',  'nama' => 'Teknik Kendaraan Ringan'],
        'tjkt' => ['label' => 'TJKT', 'nama' => 'Teknik Jaringan Komputer dan Telekomunikasi'],
        'tp'   => ['label' => 'TP',   'nama' => 'Teknik Pemesinan'],
    ],

    'layanan' => [

        // =====================================================
        // TSM - Teknik Sepeda Motor
        // =====================================================
        [
            'nama'      => 'Servis Ringan Motor',
            'deskripsi' => 'Ganti oli, cek rem, cek rantai & kelistrikan dasar',
            'harga'     => 'Rp. 25.000',
            'kategori'  => 'tsm',
            'slug'      => 'servis-ringan-motor',
            'ikon'      => 'motor',
        ],
        [
            'nama'      => 'Tune Up Mesin Motor',
            'deskripsi' => 'Servis menyeluruh: karburator/ busi, filter udara',
            'harga'     => 'Rp. 50.000',
            'kategori'  => 'tsm',
            'slug'      => 'tune-up-mesin-motor',
            'ikon'      => 'mesin',
        ],
        [
            'nama'      => 'Ganti Kampas Rem',
            'deskripsi' => 'Ganti kampas rem depan/ belakang',
            'harga'     => 'Rp. 20.000 + Part',
            'kategori'  => 'tsm',
            'slug'      => 'ganti-kampas-rem',
            'ikon'      => 'rem',
        ],

        // =====================================================
        // TKR - Teknik Kendaraan Ringan (Otomotif Mobil)
        // =====================================================
        [
            'nama'      => 'Servis Ringan Mobil',
            'deskripsi' => 'Ganti oli, cek rem, cek filter & kelistrikan dasar',
            'harga'     => 'Rp. 40.000',
            'kategori'  => 'tkr',
            'slug'      => 'servis-ringan-mobil',
            'ikon'      => 'mobil',
        ],
        [
            'nama'      => 'Tune Up Mesin Mobil',
            'deskripsi' => 'Servis menyeluruh: injektor/ karburator, busi, filter udara',
            'harga'     => 'Rp. 75.000',
            'kategori'  => 'tkr',
            'slug'      => 'tune-up-mesin-mobil',
            'ikon'      => 'mesin',
        ],
        [
            'nama'      => 'Servis Rem & Kaki-kaki',
            'deskripsi' => 'Ganti kampas rem, cek sistem pengereman & kaki-kaki',
            'harga'     => 'Rp. 35.000 + Part',
            'kategori'  => 'tkr',
            'slug'      => 'servis-rem-kaki-kaki',
            'ikon'      => 'rem',
        ],

        // =====================================================
        // TJKT - Teknik Jaringan Komputer & Telekomunikasi
        // =====================================================
        [
            'nama'      => 'Instalasi Jaringan LAN',
            'deskripsi' => 'Pemasangan kabel, konfigurasi switch & akses poin',
            'harga'     => 'Rp. 50.000',
            'kategori'  => 'tjkt',
            'slug'      => 'instalasi-jaringan-lan',
            'ikon'      => 'jaringan',
        ],
        [
            'nama'      => 'Servis & Perawatan Komputer',
            'deskripsi' => 'Pembersihan, install ulang, perbaikan perangkat',
            'harga'     => 'Rp. 45.000',
            'kategori'  => 'tjkt',
            'slug'      => 'servis-perawatan-komputer',
            'ikon'      => 'komputer',
        ],
        [
            'nama'      => 'Konfigurasi Router & WiFi',
            'deskripsi' => 'Setting router, penguatan sinyal & keamanan jaringan',
            'harga'     => 'Rp. 60.000',
            'kategori'  => 'tjkt',
            'slug'      => 'konfigurasi-router-wifi',
            'ikon'      => 'wifi',
        ],

        // =====================================================
        // TP - Teknik Pemesinan / Pengelasan
        // =====================================================
        [
            'nama'      => 'Pengelasan Las Listrik',
            'deskripsi' => 'Pengelasan rangka, pagar & konstruksi besi ringan',
            'harga'     => 'Rp. 50.000',
            'kategori'  => 'tp',
            'slug'      => 'pengelasan-las-listrik',
            'ikon'      => 'las',
        ],
        [
            'nama'      => 'Bubut & Pemesinan',
            'deskripsi' => 'Pembuatan komponen dengan mesin bubut sesuai ukuran',
            'harga'     => 'Rp. 65.000',
            'kategori'  => 'tp',
            'slug'      => 'bubut-pemesinan',
            'ikon'      => 'bubut',
        ],
        [
            'nama'      => 'Fabrikasi Rangka Besi',
            'deskripsi' => 'Pembuatan rangka meja, kursi, kanopi & sejenisnya',
            'harga'     => 'Rp. 55.000 + Material',
            'kategori'  => 'tp',
            'slug'      => 'fabrikasi-rangka-besi',
            'ikon'      => 'rangka',
        ],

    ],

];
