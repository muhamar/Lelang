-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Apr 2021 pada 21.28
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
-- Struktur dari tabel `gambar`
--

CREATE TABLE `gambar` (
  `id_gambar` int(11) NOT NULL,
  `id_lelang` int(11) NOT NULL,
  `nama_gambar` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `gambar`
--

INSERT INTO `gambar` (`id_gambar`, `id_lelang`, `nama_gambar`) VALUES
(7, 2, 'Plakat multi color 2.png'),
(8, 2, 'Plakat multi color 3.png'),
(9, 2, 'Plakat multi color.png'),
(10, 3, 'Plakat nemo klasik 2.png'),
(11, 3, 'Plakat nemo klasik 3.png'),
(12, 3, 'Plakat nemo klasik.png'),
(13, 4, 'Plakat Kuper.png'),
(14, 5, 'Soft gold 2.png'),
(15, 5, 'Soft gold.png'),
(16, 6, 'dumbo r.png'),
(17, 6, 'dumbo rr.png'),
(18, 6, 'dumbo rrr.png'),
(19, 1, 'Plakat nemo ko 2.png'),
(20, 1, 'Plakat nemo koi 3.png'),
(21, 1, 'Plakat nemo koi.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lelang`
--

CREATE TABLE `lelang` (
  `id_lelang` int(11) NOT NULL,
  `nama_ikan_hias` varchar(128) NOT NULL,
  `harga_buka` int(11) NOT NULL,
  `kelipatan` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `waktu_mulai` timestamp NOT NULL DEFAULT current_timestamp(),
  `waktu_selesai` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `lelang`
--

INSERT INTO `lelang` (`id_lelang`, `nama_ikan_hias`, `harga_buka`, `kelipatan`, `deskripsi`, `waktu_mulai`, `waktu_selesai`) VALUES
(1, 'Plakat Nemo Koi', 100000, 10000, 'Ikan cupang plakat nemo koi berumur 7 - 8 bulan.\r\nWarna ikan hias sesuai gambar lelang.\r\nPengiriman / Ekspedisi melalui :\r\n- TIKI\r\n- JNE\r\nCatatan : \r\nPengiriman dikirim dengan fasilitas karantina.', '2021-04-12 12:45:00', '2021-04-11 12:45:00'),
(2, 'Plakat Multi Color', 200000, 20000, 'Ikan cupang plakat multi color berumur 7 - 8 bulan.\r\nWarna ikan hias sesuai gambar lelang.\r\nPengiriman / Ekspedisi melalui :\r\n- TIKI\r\n- JNE\r\nCatatan : \r\nPengiriman dikirim dengan fasilitas karantina.', '2021-04-12 12:51:00', '2021-04-17 12:51:00'),
(3, 'Plakat Nemo Klasik', 100000, 15000, 'Ikan cupang plakat nemo klasik berumur 7 - 8 bulan.\r\nWarna ikan hias sesuai gambar lelang.\r\nPengiriman / Ekspedisi melalui :\r\n- TIKI\r\n- JNE\r\nCatatan : \r\nPengiriman dikirim dengan fasilitas karantina.', '2021-04-12 12:52:00', '2021-04-18 12:52:00'),
(4, 'Plakat Kuper', 100000, 10000, 'Ikan cupang plakat kuper berumur 7 - 8 bulan.\r\nWarna ikan hias sesuai gambar lelang.\r\nPengiriman / Ekspedisi melalui :\r\n- TIKI\r\n- JNE\r\nCatatan : \r\nPengiriman dikirim dengan fasilitas karantina.', '2021-04-18 12:53:00', '2021-04-24 12:53:00'),
(5, 'Soft Gold', 50000, 10000, 'Ikan cupang soft gold berumur 7 - 8 bulan.\r\nWarna ikan hias sesuai gambar lelang.\r\nPengiriman / Ekspedisi melalui :\r\n- TIKI\r\n- JNE\r\nCatatan : \r\nPengiriman dikirim dengan fasilitas karantina.', '2021-04-19 12:56:00', '2021-04-24 12:56:00'),
(6, 'Dumbo R', 800000, 50000, 'Ikan cupang dumbo r berumur 7 - 8 bulan.\r\nWarna ikan hias sesuai gambar lelang.\r\nPengiriman / Ekspedisi melalui :\r\n- TIKI\r\n- JNE\r\nCatatan : \r\nPengiriman dikirim dengan fasilitas karantina.', '2021-04-25 12:57:00', '2021-04-30 12:57:00');

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
(1, 2, 'dikirim/selesai', '0221300761000012');

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
(2, 4, 1, 3, 150000, '1618233565BbXhEmoH7N7k0R1.png', 'lunas', 'dikirim/selesai', '2021-04-12 13:19:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peserta`
--

CREATE TABLE `peserta` (
  `id_peserta` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `nohp` varchar(115) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `peserta`
--

INSERT INTO `peserta` (`id_peserta`, `nama`, `username`, `nohp`, `alamat`, `password`) VALUES
(1, 'Dian', 'Dian', '081244888666', 'Jl. Perintis', 'Dian'),
(2, 'Arianto', 'Arianto', '081244999111', 'Jl. Antang', 'Arianto'),
(4, 'Muhamar', 'Amar', '081244828616', 'Jl. Dg hayo lr.1 no.7', 'Amar');

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
(1, 1, 1, 115000, '2021-04-12 13:04:50'),
(2, 1, 2, 130000, '2021-04-12 13:06:58'),
(3, 1, 4, 150000, '2021-04-12 13:14:43'),
(4, 2, 4, 220000, '2021-04-12 13:15:03'),
(5, 3, 4, 120000, '2021-04-12 13:15:15');

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
('121030262_101111165109024_4721727974211074648_n.jpg', '       \r\nAabetta.id merupakan salah satu toko penjualan ikan hias dengan konsep pelelangan online di kota Makassar, untuk tokonya sendiri berlokasi di Jl. Borong Indah Ruko No. 78, Kecamatan Rappocini, Kelurahan Kassi-Kassi. Aabetta.id berdiri pada tahun 2020, dimana toko tersebut telah menjual lebih dari 100 ikan hias. Salah satu penghargaan yang telah di peroleh dari toko Aabetta.id yaitu telah meraih penghargaan sebagai juara umum di salah satu kontes betta yang di adakan di kota Makassar. \r\n\r\nCatatan : \r\n1. Bagi peserta yang ingin mengikuti lelang atau melakukan penawaran lelang, peserta di wajibkan untuk melengkapi data diri terlebih dahulu.\r\n2. Bagi peserta yang dinyatakan menang, diharapkan untuk segera melakukan transaksi di halaman \'Menang\'.\r\n3. Bagi peserta yang dinyatakan menang dan tidak melakukan transaksi maksimal 1 x 24 jam, maka akan dinyatakan gugur sebagai pemenang lelang dan akan di jadwalkan pelelangan ulang.');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `gambar`
--
ALTER TABLE `gambar`
  ADD PRIMARY KEY (`id_gambar`);

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
-- AUTO_INCREMENT untuk tabel `gambar`
--
ALTER TABLE `gambar`
  MODIFY `id_gambar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `lelang`
--
ALTER TABLE `lelang`
  MODIFY `id_lelang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pengiriman`
--
ALTER TABLE `pengiriman`
  MODIFY `id_pengiriman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id_peserta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tawaran`
--
ALTER TABLE `tawaran`
  MODIFY `id_tawaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
