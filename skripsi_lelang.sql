-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Mar 2021 pada 08.09
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
(33, 'Plakat Nemo Koi', 100000, 'plakat_nemo_koi-022.png', 'Ikan cupang plakat nemo koi\r\nWarna sesuai dengan gambar lelang\r\nPengiriman / Ekspedisi melalui :\r\n- TIKI\r\n- JNE\r\nCatatan :\r\nPengiriman dikirim dengan tambahan fasilitas karantina.', '2021-03-18 01:00:00', '2021-03-18 15:30:00'),
(34, 'Dumbo R', 800000, 'dumbo_r-02.png', 'Ikan cupang dumbo r\r\nWarna sesuai dengan gambar lelang\r\nPengiriman / Ekspedisi melalui :\r\n- TIKI\r\n- JNE\r\nCatatan :\r\nPengiriman dikirim dengan tambahan fasilitas karantina.', '2021-03-21 23:00:00', '2021-03-23 23:00:00'),
(35, 'Soft Gold', 50000, 'softgold-02.png', 'Ikan cupang soft gold\r\nWarna sesuai dengan gambar lelang\r\nPengiriman / Ekspedisi melalui :\r\n- TIKI\r\n- JNE\r\nCatatan :\r\nPengiriman dikirim dengan tambahan fasilitas karantina.', '2021-03-18 22:00:00', '2021-03-19 16:00:00'),
(36, 'Plakat kuper', 100000, 'plakat_kuper.png', 'Ikan cupang plakat kuper\r\nWarna sesuai dengan gambar lelang\r\nPengiriman / Ekspedisi melalui :\r\n- TIKI\r\n- JNE\r\nCatatan :\r\nPengiriman dikirim dengan tambahan fasilitas karantina.', '2021-03-18 14:00:00', '2021-03-19 14:00:00'),
(37, 'Plakat Multi Color', 200000, 'plakat_multi_color-02.png', 'Ikan cupang plakat multi color\r\nWarna sesuai dengan gambar lelang\r\nPengiriman / Ekspedisi melalui :\r\n- TIKI\r\n- JNE\r\nCatatan :\r\nPengiriman dikirim dengan tambahan fasilitas karantina.', '2021-03-18 12:10:00', '2021-03-20 14:15:00'),
(38, 'Plakat Nemo Klasik', 100000, 'plakat_nemo_klasik_-02.png', 'Ikan cupang plakat nemo klasik\r\nWarna sesuai dengan gambar lelang\r\nPengiriman / Ekspedisi melalui :\r\n- TIKI\r\n- JNE\r\nCatatan :\r\nPengiriman dikirim dengan tambahan fasilitas karantina.', '2021-03-25 07:15:00', '2021-03-26 21:20:00');

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
(33, 48, 'dikirim/selesai', '0134412698500921');

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
(48, 39, 33, 92, 175000, '1616082555a8qHzEt7sADrVrg.png', 'lunas', 'dikirim/selesai', '2021-03-18 15:49:15');

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
(36, 'Dian', 'Dian', '081244800858', 'Jl. Sejati No.5', 'Dian'),
(37, 'Fany', 'Fany', '081244900909', 'Jl.Antang Raya No.1', 'Fany'),
(38, 'Arianto', 'Arianto', '081244765900', 'Jl. Antang Raya No.2', 'Arianto'),
(39, 'Muhamar', 'Amar', '081244828616', 'Jl. Dg. Hayo Lr.1 No.7', 'Amar');

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
(85, 33, 36, 125000, '2021-03-18 15:23:48'),
(86, 33, 37, 145000, '2021-03-18 15:24:58'),
(87, 33, 38, 150000, '2021-03-18 15:25:52'),
(88, 36, 39, 135000, '2021-03-18 15:29:16'),
(92, 33, 39, 175000, '2021-03-18 15:47:42');

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
('121030262_101111165109024_4721727974211074648_n1.jpg', '       \r\nAabetta.id merupakan salah satu toko penjualan ikan hias dengan konsep pelelangan online di kota Makassar, untuk tokonya sendiri berlokasi di Jl. Borong Indah Ruko No. 78, Kecamatan Rappocini, Kelurahan Kassi-Kassi. Aabetta.id berdiri pada tahun 2020, dimana toko tersebut telah menjual lebih dari 100 ikan hias. Salah satu penghargaan yang telah di peroleh dari toko Aabetta.id yaitu telah meraih penghargaan sebagai juara umum di salah satu kontes betta yang di adakan di kota Makassar. \r\n\r\nCatatan : \r\n1. Bagi peserta yang ingin mengikuti lelang atau melakukan penawaran lelang, peserta di wajibkan untuk melengkapi data diri terlebih dahulu.\r\n2. Bagi peserta yang dinyatakan menang, diharapkan untuk segera melakukan transaksi di halaman \'Menang\'.\r\n3. Bagi peserta yang dinyatakan menang dan tidak melakukan transaksi maksimal 1 x 24 jam, maka akan dinyatakan gugur sebagai pemenang lelang dan akan di jadwalkan pelelangan ulang.\r\n');

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
  MODIFY `id_lelang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `pengiriman`
--
ALTER TABLE `pengiriman`
  MODIFY `id_pengiriman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT untuk tabel `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id_peserta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `tawaran`
--
ALTER TABLE `tawaran`
  MODIFY `id_tawaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
