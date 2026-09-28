-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Sep 2026 pada 11.35
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jhic`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alumni_track`
--

CREATE TABLE `alumni_track` (
  `id_alumni` bigint(20) UNSIGNED NOT NULL,
  `id_siswa` bigint(20) UNSIGNED DEFAULT NULL,
  `tahun_lulus` year(4) NOT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `status` enum('bekerja','kuliah','wirausaha','mencari_kerja') NOT NULL DEFAULT 'mencari_kerja',
  `keterangan` text DEFAULT NULL,
  `mentor` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_jurusan` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `alumni_track`
--

INSERT INTO `alumni_track` (`id_alumni`, `id_siswa`, `tahun_lulus`, `no_telp`, `email`, `status`, `keterangan`, `mentor`, `created_at`, `updated_at`, `id_jurusan`) VALUES
(34, 15, '2026', '123123123132', 'yoyonjr7@gmail.com', 'mencari_kerja', NULL, 0, '2026-09-24 08:01:40', '2026-09-24 08:01:40', 3),
(36, 14, '2020', '1111111111', 'yoyonjr7@gmail.com', 'bekerja', 'Perusahaan: PT Bambang Jaya\nJabatan: Aiti suprot\nPengalaman: Teknisi', 1, '2026-09-24 08:28:08', '2026-09-24 08:28:08', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `booking_tefa`
--

CREATE TABLE `booking_tefa` (
  `id_book` bigint(20) UNSIGNED NOT NULL,
  `id_transaksi` bigint(20) UNSIGNED NOT NULL,
  `status_book` enum('pending','diproses','selesai','batal') NOT NULL DEFAULT 'pending',
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `booking_tefa`
--

INSERT INTO `booking_tefa` (`id_book`, `id_transaksi`, `status_book`, `keterangan`, `created_at`, `updated_at`) VALUES
(100676, 36, 'pending', 'Booking online melalui TEFA Online', '2026-09-22 00:17:05', '2026-09-22 00:17:05'),
(117611, 40, 'pending', 'Booking online melalui TEFA Online', '2026-09-23 01:08:00', '2026-09-23 01:08:00'),
(247798, 33, 'pending', 'Booking online melalui TEFA Online', '2026-09-21 22:54:19', '2026-09-21 22:54:19'),
(413339, 34, 'pending', 'Booking online melalui TEFA Online', '2026-09-21 23:37:41', '2026-09-21 23:37:41'),
(452223, 35, 'pending', 'Booking online melalui TEFA Online', '2026-09-22 00:03:13', '2026-09-22 00:03:13'),
(500654, 39, 'pending', 'Booking online melalui TEFA Online', '2026-09-22 05:58:57', '2026-09-22 05:58:57'),
(517656, 38, 'pending', 'Booking online melalui TEFA Online', '2026-09-22 05:21:06', '2026-09-22 05:21:06'),
(549502, 41, 'pending', 'Booking online melalui TEFA Online', '2026-09-23 22:36:39', '2026-09-23 22:36:39'),
(618474, 37, 'pending', 'Booking online melalui TEFA Online', '2026-09-22 00:18:07', '2026-09-22 00:18:07'),
(870006, 42, 'pending', 'Booking online melalui TEFA Online', '2026-09-24 22:01:23', '2026-09-24 22:01:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `book_jasah`
--

CREATE TABLE `book_jasah` (
  `id_bookjasah` bigint(20) UNSIGNED NOT NULL,
  `id_alumni` bigint(20) UNSIGNED NOT NULL,
  `status_book` enum('pending','diproses','selesai','batal') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `book_jasah`
--

INSERT INTO `book_jasah` (`id_bookjasah`, `id_alumni`, `status_book`, `created_at`, `updated_at`) VALUES
(371722056184, 36, 'pending', '2026-09-24 08:28:08', '2026-09-24 08:28:08'),
(747231795969, 34, 'pending', '2026-09-24 08:01:40', '2026-09-24 08:01:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE `guru` (
  `id_guru` bigint(20) UNSIGNED NOT NULL,
  `nama_guru` varchar(150) NOT NULL,
  `id_jurusan` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `guru`
--

INSERT INTO `guru` (`id_guru`, `nama_guru`, `id_jurusan`, `created_at`, `updated_at`) VALUES
(1, 'Irwanto, S.T', 1, '2026-09-20 21:59:38', '2026-09-20 21:59:38'),
(2, 'M Maghribi, S.T', 2, '2026-09-20 21:59:38', '2026-09-20 21:59:38'),
(3, 'M Hamzah Romadhon, S.Kom', 3, '2026-09-20 21:59:38', '2026-09-20 21:59:38'),
(4, 'Rusman Haji, S.T', 4, '2026-09-20 21:59:38', '2026-09-20 21:59:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` bigint(20) UNSIGNED NOT NULL,
  `nama_jurusan` varchar(150) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `nama_jurusan`, `created_at`, `updated_at`) VALUES
(1, 'Teknik Sepeda Motor', '2026-09-20 21:59:38', '2026-09-20 21:59:38'),
(2, 'Teknik Kendaraan Ringan', '2026-09-20 21:59:38', '2026-09-20 21:59:38'),
(3, 'Teknik Jaringan Komputer dan Telekomunikasi', '2026-09-20 21:59:38', '2026-09-20 21:59:38'),
(4, 'Teknik Pemesinan', '2026-09-20 21:59:38', '2026-09-20 21:59:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `layanan`
--

CREATE TABLE `layanan` (
  `id_layanan` bigint(20) UNSIGNED NOT NULL,
  `nama_layanan` varchar(150) NOT NULL,
  `id_jurusan` bigint(20) UNSIGNED NOT NULL,
  `harga` decimal(12,2) NOT NULL DEFAULT 0.00,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `layanan`
--

INSERT INTO `layanan` (`id_layanan`, `nama_layanan`, `id_jurusan`, `harga`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'Servis Ringan Motor', 1, 25000.00, 'Ganti oli, cek rem, cek rantai & kelistrikan dasar', '2026-09-20 21:59:38', '2026-09-20 21:59:38'),
(2, 'Tune Up Mesin Motor', 1, 50000.00, 'Servis menyeluruh: karburator/ busi, filter udara', '2026-09-20 21:59:38', '2026-09-20 21:59:38'),
(3, 'Ganti Kampas Rem', 1, 20000.00, 'Ganti kampas rem depan/ belakang (belum termasuk part)', '2026-09-20 21:59:38', '2026-09-20 21:59:38'),
(4, 'Servis Ringan Mobil', 2, 40000.00, 'Ganti oli, cek rem, cek filter & kelistrikan dasar', '2026-09-20 21:59:38', '2026-09-20 21:59:38'),
(5, 'Tune Up Mesin Mobil', 2, 75000.00, 'Servis menyeluruh: injektor/ karburator, busi, filter udara', '2026-09-20 21:59:38', '2026-09-20 21:59:38'),
(6, 'Servis Rem & Kaki-kaki', 2, 35000.00, 'Ganti kampas rem, cek sistem pengereman & kaki-kaki (belum termasuk part)', '2026-09-20 21:59:38', '2026-09-20 21:59:38'),
(7, 'Instalasi Jaringan LAN', 3, 50000.00, 'Pemasangan kabel, konfigurasi switch & akses poin', '2026-09-20 21:59:38', '2026-09-20 21:59:38'),
(8, 'Servis & Perawatan Komputer', 3, 45000.00, 'Pembersihan, install ulang, perbaikan perangkat', '2026-09-20 21:59:38', '2026-09-20 21:59:38'),
(9, 'Konfigurasi Router & WiFi', 3, 60000.00, 'Setting router, penguatan sinyal & keamanan jaringan', '2026-09-20 21:59:38', '2026-09-20 21:59:38'),
(10, 'Pengelasan Las Listrik', 4, 50000.00, 'Pengelasan rangka, pagar & konstruksi besi ringan', '2026-09-20 21:59:38', '2026-09-20 21:59:38'),
(11, 'Bubut & Pemesinan', 4, 65000.00, 'Pembuatan komponen dengan mesin bubut sesuai ukuran', '2026-09-20 21:59:38', '2026-09-20 21:59:38'),
(12, 'Fabrikasi Rangka Besi', 4, 55000.00, 'Pembuatan rangka meja, kursi, kanopi & sejenisnya (belum termasuk material)', '2026-09-20 21:59:38', '2026-09-20 21:59:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lowongan_kerja`
--

CREATE TABLE `lowongan_kerja` (
  `id_lowongan` bigint(20) UNSIGNED NOT NULL,
  `nama_lowongan` varchar(150) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `id_jurusan` bigint(20) UNSIGNED DEFAULT NULL,
  `jumlah` int(11) NOT NULL DEFAULT 0,
  `gaji_min` decimal(12,2) DEFAULT NULL,
  `gaji_max` decimal(12,2) DEFAULT NULL,
  `skills` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`skills`)),
  `status` varchar(30) NOT NULL DEFAULT 'dibuka',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `lowongan_kerja`
--

INSERT INTO `lowongan_kerja` (`id_lowongan`, `nama_lowongan`, `deskripsi`, `id_jurusan`, `jumlah`, `gaji_min`, `gaji_max`, `skills`, `status`, `created_at`, `updated_at`) VALUES
(1, 'IT SUPPORT', 'Menangani masalah perangkat, software dan sistem IT di perusahaan', 3, 1, 5000000.00, 7000000.00, '[\"Troubleshooting\",\"Microsoft Windows\",\"Hardware & Software\",\"Komunikasi\"]', 'dibuka', '2026-09-21 20:15:58', '2026-09-21 20:33:16'),
(2, 'NETWORK', 'Memasang, mengkonfigurasi, dan memelihara jaringan komputer.', 3, 1, 4000000.00, 5000000.00, '[\"TCP \\/ IP & Networking\",\"Mikrotik & cisco\",\"Lan & Wan\",\"Troubleshooting\"]', 'dibuka', '2026-09-21 20:15:59', '2026-09-21 20:33:16'),
(4, 'MEKANIK MOBIL', 'Melakukan pemeriksaan, perawatan, dan perbaikan kendaraan roda empat.', 2, 1, 3500000.00, 6500000.00, '[\"Troubleshooting kendaraan\",\"Engine & transmission\",\"Sistem rem dan suspensi\",\"Kelistrikan mobil\",\"Penggunaan alat bengkel\"]', 'dibuka', '2026-09-21 20:15:59', '2026-09-21 20:33:16'),
(5, 'NETSERVICE ADVISOR', 'Melayani pelanggan, menerima keluhan kendaraan, menjelaskan kebutuhan servis, dan mengkoordinasikan pekerjaan mekanik.', 2, 1, 3500000.00, 6500000.00, '[\"Pengetahuan dasar otomotif\",\"Komunikasi\",\"Customer service\",\"Administrasi\",\"Identifikasi masalah kendaraan\"]', 'dibuka', '2026-09-21 20:15:59', '2026-09-21 20:33:16'),
(6, 'TEKNISI BODY & PAINT', 'Melakukan perbaikan bodi kendaraan serta proses persiapan dan pengecatan mobil.', 2, 1, 3500000.00, 6500000.00, '[\"Body repair\",\"Teknik pengecatan\",\"Penggunaan alat bengkel\",\"Ketelitian\",\"Finishing\"]', 'dibuka', '2026-09-21 20:15:59', '2026-09-21 20:33:16'),
(7, 'MEKANIK MOTOR', 'Melakukan servis, pemeriksaan, dan perbaikan sepeda motor.', 1, 1, 3000000.00, 5500000.00, '[\"Engine sepeda motor\",\"Troubleshooting\",\"Sistem injeksi\",\"Kelistrikan motor\",\"Penggunaan tools\"]', 'dibuka', '2026-09-21 20:15:59', '2026-09-21 20:33:16'),
(8, 'TEKNISI SERVICE MOTOR', 'Menangani perawatan berkala dan diagnosis kerusakan sepeda motor di bengkel atau dealer.', 1, 1, 3000000.00, 5500000.00, '[\"Servis berkala\",\"EFI\\/injeksi\",\"Sistem rem\",\"Sistem kelistrikan\",\"Diagnosis kerusakan\"]', 'dibuka', '2026-09-21 20:15:59', '2026-09-21 20:33:16'),
(9, 'PARTS COUNTER', 'Melayani kebutuhan suku cadang, mencari nomor part, mengecek stok, dan membantu pelanggan menemukan spare part yang sesuai.', 1, 1, 3000000.00, 5000000.00, '[\"Pengetahuan spare part\",\"Administrasi\",\"Inventory\",\"Komunikasi\",\"Komputer dasar\"]', 'dibuka', '2026-09-21 20:15:59', '2026-09-21 20:33:16'),
(10, 'OPERATOR MESIN CNC', 'Mengoperasikan mesin CNC untuk menghasilkan komponen sesuai gambar dan ukuran yang ditentukan.', 4, 1, 4000000.00, 7000000.00, '[\"CNC\",\"Gambar teknik\",\"Pengukuran\",\"G-Code & M-Code\",\"Penggunaan alat ukur\"]', 'dibuka', '2026-09-21 20:15:59', '2026-09-21 20:33:16'),
(11, 'OPERATOR MESIN BUBUT', 'Mengoperasikan mesin bubut untuk membuat atau memperbaiki komponen dengan ukuran dan bentuk tertentu.', 4, 1, 3500000.00, 6000000.00, '[\"Mesin bubut\",\"Gambar teknik\",\"LanPengukuran presisi\",\"Cutting tools\",\"K3\"]', 'dibuka', '2026-09-21 20:15:59', '2026-09-21 20:33:16'),
(12, 'QUALITY CONTROL (QC)', 'Memeriksa kualitas dan ukuran produk hasil proses produksi agar sesuai dengan standar yang ditentukan.', 4, 1, 3500000.00, 6500000.00, '[\"Alat ukur (jangka sorong, mikrometer)\",\"Membaca gambar teknik\",\"Inspection\",\"Ketelitian\",\"Quality control\"]', 'dibuka', '2026-09-21 20:15:59', '2026-09-21 20:33:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(12, '2026_09_19_000001_create_jurusan_table', 2),
(13, '2026_09_19_000002_create_layanan_table', 2),
(14, '2026_09_19_000003_create_siswa_table', 2),
(15, '2026_09_19_000004_create_transaksi_tefa_table', 2),
(16, '2026_09_19_000005_create_alumni_track_table', 2),
(17, '2026_09_19_000006_create_booking_tefa_table', 2),
(18, '2026_09_19_000007_create_book_jasah_table', 2),
(19, '2026_09_19_000008_create_spmb_table', 2),
(20, '2026_09_19_000009_change_tanggal_to_datetime_on_transaksi_tefa_table', 3),
(21, '2026_09_19_000010_create_guru_table', 4),
(22, '2026_09_19_000011_change_transaksi_tefa_penanggung_jawab_to_id_guru', 4),
(23, '2026_09_19_000012_create_lowongan_kerja_table', 5),
(24, '2026_09_23_000001_make_alumni_track_siswa_optional', 6),
(25, '2026_09_23_000002_change_alumni_track_mentor_to_string', 7),
(26, '2026_09_23_000003_change_alumni_track_mentor_to_boolean', 8),
(27, '2026_09_23_000004_make_book_jasah_id_random', 9),
(28, '2026_09_24_000001_add_id_jurusan_to_alumni_track', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('MQfFy73zbPBtL0PyFMAcBUsjpRm4TSkXaGzL2qcy', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM0FrbnlJUGxXb3RuNDcxTG5EcHk2TktEMWFNRXp2WlJCb0FpSEhDZyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMS92aXJ0dWFsdG91ciI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1790328415);

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` bigint(20) UNSIGNED NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `nama_siswa` varchar(150) NOT NULL,
  `kelas` varchar(20) NOT NULL,
  `id_jurusan` bigint(20) UNSIGNED NOT NULL,
  `status` enum('aktif','lulus','keluar') NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nisn`, `nama_siswa`, `kelas`, `id_jurusan`, `status`, `created_at`, `updated_at`) VALUES
(14, '1234567890', 'Dion Maulidin Pratama', '12 TKJ', 3, 'aktif', NULL, NULL),
(15, '0909090909', 'Caesar Bayu', '12 TKJ', 3, 'aktif', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `spmb`
--

CREATE TABLE `spmb` (
  `id_spmb` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(150) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `spmb`
--

INSERT INTO `spmb` (`id_spmb`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Muhammad Rizky', '2026-09-20 21:59:38', '2026-09-20 21:59:38'),
(2, 'Nadia Safira', '2026-09-20 21:59:38', '2026-09-20 21:59:38'),
(3, 'Oktavian Dwi', '2026-09-20 21:59:38', '2026-09-20 21:59:38'),
(4, 'Putri Amelia', '2026-09-20 21:59:38', '2026-09-20 21:59:38'),
(5, 'Raka Aditya', '2026-09-20 21:59:38', '2026-09-20 21:59:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_tefa`
--

CREATE TABLE `transaksi_tefa` (
  `id_transaksi` bigint(20) UNSIGNED NOT NULL,
  `nama_pelanggan` varchar(150) NOT NULL,
  `tanggal` datetime NOT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `deskripsi` text NOT NULL,
  `id_layanan` bigint(20) UNSIGNED NOT NULL,
  `id_guru` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaksi_tefa`
--

INSERT INTO `transaksi_tefa` (`id_transaksi`, `nama_pelanggan`, `tanggal`, `no_telp`, `deskripsi`, `id_layanan`, `id_guru`, `created_at`, `updated_at`) VALUES
(33, 'Dion Maulidin', '2026-09-22 07:01:00', '088111111111', 'asdasdasdasd', 8, 3, '2026-09-21 22:54:19', '2026-09-21 22:54:19'),
(34, 'Dion Maulidin', '2026-09-22 07:01:00', '088111111111', 'asdasdasdadsasd', 1, 1, '2026-09-21 23:37:41', '2026-09-21 23:37:41'),
(35, 'Dion Maulidin', '2026-09-23 07:01:00', '088111111111', 'poijoij', 1, 1, '2026-09-22 00:03:13', '2026-09-22 00:03:13'),
(36, 'Dion Maulidin', '2026-09-23 07:01:00', '088111111111', 'asdasdasd', 2, 1, '2026-09-22 00:17:05', '2026-09-22 00:17:05'),
(37, 'Dion Maulidin', '2026-09-23 07:01:00', '088111111111', 'asdasdasd', 2, 1, '2026-09-22 00:18:07', '2026-09-22 00:18:07'),
(38, 'Dion Maulidin', '2026-09-23 07:00:00', '088111111111', 'asdasdasdasd', 2, 1, '2026-09-22 05:21:06', '2026-09-22 05:21:06'),
(39, 'Dion Maulidin', '2026-09-23 07:01:00', '088111111111', 'asdasdasdasd', 2, 1, '2026-09-22 05:58:57', '2026-09-22 05:58:57'),
(40, 'Dion Maulidin', '2026-09-24 07:01:00', '088111111111', 'asdasdsad', 1, 1, '2026-09-23 01:08:00', '2026-09-23 01:08:00'),
(41, 'affan', '2026-09-25 07:01:00', '123123123', 'pedaku rusak', 1, 1, '2026-09-23 22:36:39', '2026-09-23 22:36:39'),
(42, 'Dion Maulidin', '2026-09-25 07:01:00', '088111111111', 'ytta', 11, 4, '2026-09-24 22:01:23', '2026-09-24 22:01:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alumni_track`
--
ALTER TABLE `alumni_track`
  ADD PRIMARY KEY (`id_alumni`),
  ADD KEY `alumni_track_id_siswa_foreign` (`id_siswa`),
  ADD KEY `alumni_track_id_jurusan_foreign` (`id_jurusan`);

--
-- Indeks untuk tabel `booking_tefa`
--
ALTER TABLE `booking_tefa`
  ADD PRIMARY KEY (`id_book`),
  ADD KEY `booking_tefa_id_transaksi_foreign` (`id_transaksi`);

--
-- Indeks untuk tabel `book_jasah`
--
ALTER TABLE `book_jasah`
  ADD PRIMARY KEY (`id_bookjasah`),
  ADD KEY `book_jasah_id_alumni_foreign` (`id_alumni`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`),
  ADD KEY `guru_id_jurusan_foreign` (`id_jurusan`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indeks untuk tabel `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id_layanan`),
  ADD KEY `layanan_id_jurusan_foreign` (`id_jurusan`);

--
-- Indeks untuk tabel `lowongan_kerja`
--
ALTER TABLE `lowongan_kerja`
  ADD PRIMARY KEY (`id_lowongan`),
  ADD KEY `lowongan_kerja_id_jurusan_foreign` (`id_jurusan`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD UNIQUE KEY `siswa_nisn_unique` (`nisn`),
  ADD KEY `siswa_id_jurusan_foreign` (`id_jurusan`);

--
-- Indeks untuk tabel `spmb`
--
ALTER TABLE `spmb`
  ADD PRIMARY KEY (`id_spmb`);

--
-- Indeks untuk tabel `transaksi_tefa`
--
ALTER TABLE `transaksi_tefa`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `transaksi_tefa_id_layanan_foreign` (`id_layanan`),
  ADD KEY `transaksi_tefa_id_guru_foreign` (`id_guru`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alumni_track`
--
ALTER TABLE `alumni_track`
  MODIFY `id_alumni` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `booking_tefa`
--
ALTER TABLE `booking_tefa`
  MODIFY `id_book` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=989621;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `guru`
--
ALTER TABLE `guru`
  MODIFY `id_guru` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `layanan`
--
ALTER TABLE `layanan`
  MODIFY `id_layanan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `lowongan_kerja`
--
ALTER TABLE `lowongan_kerja`
  MODIFY `id_lowongan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `spmb`
--
ALTER TABLE `spmb`
  MODIFY `id_spmb` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `transaksi_tefa`
--
ALTER TABLE `transaksi_tefa`
  MODIFY `id_transaksi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `alumni_track`
--
ALTER TABLE `alumni_track`
  ADD CONSTRAINT `alumni_track_id_jurusan_foreign` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id_jurusan`);

--
-- Ketidakleluasaan untuk tabel `booking_tefa`
--
ALTER TABLE `booking_tefa`
  ADD CONSTRAINT `booking_tefa_id_transaksi_foreign` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi_tefa` (`id_transaksi`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `book_jasah`
--
ALTER TABLE `book_jasah`
  ADD CONSTRAINT `book_jasah_id_alumni_foreign` FOREIGN KEY (`id_alumni`) REFERENCES `alumni_track` (`id_alumni`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD CONSTRAINT `guru_id_jurusan_foreign` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id_jurusan`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `layanan`
--
ALTER TABLE `layanan`
  ADD CONSTRAINT `layanan_id_jurusan_foreign` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id_jurusan`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `lowongan_kerja`
--
ALTER TABLE `lowongan_kerja`
  ADD CONSTRAINT `lowongan_kerja_id_jurusan_foreign` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id_jurusan`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_id_jurusan_foreign` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id_jurusan`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi_tefa`
--
ALTER TABLE `transaksi_tefa`
  ADD CONSTRAINT `transaksi_tefa_id_guru_foreign` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id_guru`) ON DELETE SET NULL,
  ADD CONSTRAINT `transaksi_tefa_id_layanan_foreign` FOREIGN KEY (`id_layanan`) REFERENCES `layanan` (`id_layanan`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
