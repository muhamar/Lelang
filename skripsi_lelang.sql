-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Mar 2021 pada 04.37
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skripsi_lelang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username_admin` varchar(128) NOT NULL,
  `nama_admin` varchar(128) NOT NULL,
  `password_admin` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username_admin`, `nama_admin`, `password_admin`) VALUES
(1, 'admin', 'Administrator', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lelang`
--

CREATE TABLE `lelang` (
  `id_lelang` int(11) NOT NULL,
  `nama_ikan_hias` varchar(128) NOT NULL,
  `harga_buka` int(11) NOT NULL,
  `gambar` varchar(128) NOT NULL,
  `deskripsi` text NOT NULL,
  `status` enum('dibuka','ditutup') NOT NULL,
  `waktu_mulai` timestamp NOT NULL DEFAULT current_timestamp(),
  `waktu_selesai` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `lelang`
--

INSERT INTO `lelang` (`id_lelang`, `nama_ikan_hias`, `harga_buka`, `gambar`, `deskripsi`, `status`, `waktu_mulai`, `waktu_selesai`) VALUES
(2, 'Light Moon', 200000, '121030262_101111165109024_4721727974211074648_n-removebg-preview.png', 'Ikan hiu makan tai tolo nah', 'dibuka', '2021-02-18 18:29:00', '2021-02-24 18:29:00'),
(3, 'Light Sun', 100000, 'logo.png', 'Ikan ini bersaudara dengan ikan hiuwersdfsdfsdf', 'dibuka', '2021-02-18 18:30:00', '2021-02-22 18:30:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengiriman`
--

CREATE TABLE `pengiriman` (
  `id_pengiriman` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `status_pengiriman` enum('dikirim/selesai') NOT NULL,
  `nomor_resi` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengiriman`
--

INSERT INTO `pengiriman` (`id_pengiriman`, `id_pesanan`, `status_pengiriman`, `nomor_resi`) VALUES
(25, 2, 'dikirim/selesai', 'dqwe123'),
(27, 1, 'dikirim/selesai', '123123123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `id_peserta` int(11) NOT NULL,
  `id_lelang` int(11) NOT NULL,
  `jumlah_bayar` int(11) NOT NULL,
  `bukti_gambar` varchar(128) DEFAULT NULL,
  `status_pembayaran` enum('belum lunas','lunas') NOT NULL,
  `status_pengiriman` enum('proses','dikirim/selesai') DEFAULT NULL,
  `waktu_pembayaran` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_peserta`, `id_lelang`, `jumlah_bayar`, `bukti_gambar`, `status_pembayaran`, `status_pengiriman`, `waktu_pembayaran`) VALUES
(1, 1, 2, 250000, 'logo.png', 'lunas', 'dikirim/selesai', '2021-02-17 13:48:01'),
(3, 3, 3, 500000, 'logo.png', 'lunas', 'proses', '2021-02-24 10:37:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peserta`
--

CREATE TABLE `peserta` (
  `id_peserta` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `nohp` varchar(115) DEFAULT NULL,
  `alamat` text NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `peserta`
--

INSERT INTO `peserta` (`id_peserta`, `nama`, `username`, `nohp`, `alamat`, `password`) VALUES
(1, 'dede', 'muhamar', '0800080089', 'gowa makassar', 'amar'),
(3, 'hardiyanti', 'hardiyanti@gmail', '81123123', 'jl.buntu raya', 'dian'),
(5, 'Amar999', 'Muhamarrrrr', '81123123', 'jl.123123', '123123'),
(6, 'Amar9991233123213', 'Muhamarrrrr123', '81123123', 'jl.123123', '123123'),
(7, 'Amar9991233123213', 'qwerty', '81123123', 'jl.123123', '123123'),
(8, 'Amar999', 'muhamar123', '123123123', 'Jl.123', 'amar123'),
(9, 'amar12333', 'muhamar123333', '0', '', 'amar12333'),
(10, 'deded', 'dededede', '0', '', 'password'),
(11, 'Mia', 'Mia123', '0', '', 'Password'),
(12, 'Dd', 'Ded', '0', '', 'De'),
(13, 'Dede ard', 'Dedeardh', '0', '', 'Dede'),
(14, 'Hzhhzha', 'GHahhhaha', '0812', 'Btp', 'Hshsjjjs'),
(15, 'User1', 'User1', '081244244244', 'Jl.abcs', 'User1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tawaran`
--

CREATE TABLE `tawaran` (
  `id_tawaran` int(11) NOT NULL,
  `id_lelang` int(11) NOT NULL,
  `id_peserta` int(11) NOT NULL,
  `harga_tawar` int(11) NOT NULL,
  `status` enum('proses','menang','kalah') NOT NULL,
  `waktu_penawaran` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tawaran`
--

INSERT INTO `tawaran` (`id_tawaran`, `id_lelang`, `id_peserta`, `harga_tawar`, `status`, `waktu_penawaran`) VALUES
(1, 3, 1, 250000, 'proses', '2021-02-19 05:19:56'),
(2, 2, 1, 150000, 'proses', '2021-02-19 08:39:56'),
(3, 2, 3, 250000, 'proses', '2021-02-19 04:39:56'),
(4, 3, 4, 600000, 'proses', '0000-00-00 00:00:00'),
(8, 2, 3, 900000, 'proses', '0000-00-00 00:00:00'),
(12, 2, 3, 900000, 'proses', '0000-00-00 00:00:00'),
(13, 2, 3, 900000, 'proses', '0000-00-00 00:00:00'),
(14, 2, 3, 900000, 'proses', '0000-00-00 00:00:00'),
(15, 2, 3, 910000, 'proses', '0000-00-00 00:00:00'),
(16, 2, 3, 920000, 'proses', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tentang_toko`
--

CREATE TABLE `tentang_toko` (
  `gambar` varchar(125) NOT NULL,
  `tentang_aabetta` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tentang_toko`
--

INSERT INTO `tentang_toko` (`gambar`, `tentang_aabetta`) VALUES
('121030262_101111165109024_4721727974211074648_n-removebg-preview2.png', 'Toko ini adalah toko yang berjalan di bisnis penjualan ikan hias yang berada di pusat kota makassar, Toko ini adalah toko yang berjalan di bisnis penjualan ikan hias yang berada di pusat kota makassar, Toko ini adalah toko yang berjalan di bisnis penjualan ikan hias yang berada di pusat kota makassar, Toko ini adalah toko yang berjalan di bisnis penjualan ikan hias yang berada di pusat kota makassar, Toko ini adalah toko yang berjalan di bisnis penjualan ikan hias yang berada di pusat kota makassar, Toko ini adalah toko yang berjalan di bisnis penjualan ikan hias yang berada di pusat kota makassar, \r\n\r\n\r\nToko ini adalah toko yang berjalan di bisnis penjualan ikan hias yang berada di pusat kota makassar, Toko ini adalah toko yang berjalan di bisnis penjualan ikan hias yang berada di pusat kota makassar, Toko ini adalah toko yang berjalan di bisnis penjualan ikan hias yang berada di pusat kota makassar, Toko ini adalah toko yang berjalan di bisnis penjualan ikan hias yang berada di pusat kota makassar, Toko ini adalah toko yang berjalan di bisnis penjualan ikan hias yang berada di pusat kota makassar, ');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `lelang`
--
ALTER TABLE `lelang`
  ADD PRIMARY KEY (`id_lelang`);

--
-- Indeks untuk tabel `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`id_pengiriman`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`);

--
-- Indeks untuk tabel `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`id_peserta`);

--
-- Indeks untuk tabel `tawaran`
--
ALTER TABLE `tawaran`
  ADD PRIMARY KEY (`id_tawaran`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `lelang`
--
ALTER TABLE `lelang`
  MODIFY `id_lelang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pengiriman`
--
ALTER TABLE `pengiriman`
  MODIFY `id_pengiriman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id_peserta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `tawaran`
--
ALTER TABLE `tawaran`
  MODIFY `id_tawaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
