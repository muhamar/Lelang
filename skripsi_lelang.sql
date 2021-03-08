-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Mar 2021 pada 08.01
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.3.27

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
  `waktu_mulai` timestamp NOT NULL DEFAULT current_timestamp(),
  `waktu_selesai` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `lelang`
--

INSERT INTO `lelang` (`id_lelang`, `nama_ikan_hias`, `harga_buka`, `gambar`, `deskripsi`, `waktu_mulai`, `waktu_selesai`) VALUES
(18, 'Ikan Emas', 200000, 'IMG-20181011-WA0102.jpg', 'abcd', '2021-03-05 11:34:00', '2021-03-06 11:31:00'),
(19, 'asdf', 100000, 'IMG-20180812-WA0005.jpg', 'abcd', '2021-03-12 11:34:00', '2021-03-23 11:34:00');

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
(29, 21, 'dikirim/selesai', 'B123123123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `id_peserta` int(11) NOT NULL,
  `id_lelang` int(11) NOT NULL,
  `id_tawaran` int(11) NOT NULL,
  `jumlah_bayar` int(11) NOT NULL,
  `bukti_gambar` varchar(128) DEFAULT NULL,
  `status_pembayaran` varchar(255) NOT NULL,
  `status_pengiriman` enum('proses','dikirim/selesai') DEFAULT NULL,
  `waktu_pembayaran` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_peserta`, `id_lelang`, `id_tawaran`, `jumlah_bayar`, `bukti_gambar`, `status_pembayaran`, `status_pengiriman`, `waktu_pembayaran`) VALUES
(21, 1, 18, 66, 55555555, '1615121008bjz6PajZKnDF0LQ.png', 'lunas', 'dikirim/selesai', '2021-03-06 17:03:28'),
(22, 1, 19, 67, 100000, '1615121906SDIIZ8Hob8kfGGn.png', 'pending', 'proses', '2021-03-06 17:03:26');

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
(1, 'amar', 'amar', '081', 'Gggvv', 'amar'),
(23, 'Maru', 'Maru', '081', 'Jl.an', 'Maru'),
(24, 'Yura', 'Yura', NULL, '', 'Yura'),
(25, 'Abcd', 'Abcd', NULL, '', 'Abcd'),
(26, 'Amar', 'Aass', NULL, '', 'Ssasd'),
(27, 'Amar', 'Aas', NULL, '', 'Scscsc');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tawaran`
--

CREATE TABLE `tawaran` (
  `id_tawaran` int(11) NOT NULL,
  `id_lelang` int(11) NOT NULL,
  `id_peserta` int(11) NOT NULL,
  `harga_tawar` int(11) NOT NULL,
  `waktu_penawaran` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tawaran`
--

INSERT INTO `tawaran` (`id_tawaran`, `id_lelang`, `id_peserta`, `harga_tawar`, `waktu_penawaran`) VALUES
(64, 18, 1, 200000, '2021-03-05 17:03:21'),
(65, 18, 1, 2000001, '2021-03-05 17:03:30'),
(66, 18, 1, 55555555, '2021-03-05 17:03:57'),
(67, 19, 1, 100000, '2021-03-07 00:03:20');

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
('logo1.png', 'Toko ini adalah toko yang berjalan di bisnis penjualan ikan hias yang berada di pusat kota makassar, Toko ini adalah toko yang berjalan di bisnis penjualan ikan hias yang berada di pusat kota makassar, Toko ini adalah toko yang berjalan di bisnis penjualan ikan hias yang berada di pusat kota makassar, Toko ini adalah toko yang berjalan di bisnis penjualan ikan hias yang berada di pusat kota makassar, Toko ini adalah toko yang berjalan di bisnis penjualan ikan hias yang berada di pusat kota makassar, Toko ini adalah toko yang berjalan di bisnis penjualan ikan hias yang berada di pusat kota makassar, \r\n\r\n\r\nToko ini adalah toko yang berjalan di bisnis penjualan ikan hias yang berada di pusat kota makassar, Toko ini adalah toko yang berjalan di bisnis penjualan ikan hias yang berada di pusat kota makassar, Toko ini adalah toko yang berjalan di bisnis penjualan ikan hias yang berada di pusat kota makassar, Toko ini adalah toko yang berjalan di bisnis penjualan ikan hias yang berada di pusat kota makassar, Toko ini adalah toko yang berjalan di bisnis penjualan ikan hias yang berada di pusat kota makassar, ');

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
  MODIFY `id_lelang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `pengiriman`
--
ALTER TABLE `pengiriman`
  MODIFY `id_pengiriman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id_peserta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `tawaran`
--
ALTER TABLE `tawaran`
  MODIFY `id_tawaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
