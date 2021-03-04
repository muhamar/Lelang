-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2021 at 12:16 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.27

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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username_admin` varchar(128) NOT NULL,
  `nama_admin` varchar(128) NOT NULL,
  `password_admin` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username_admin`, `nama_admin`, `password_admin`) VALUES
(1, 'admin', 'Administrator', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `lelang`
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
-- Dumping data for table `lelang`
--

INSERT INTO `lelang` (`id_lelang`, `nama_ikan_hias`, `harga_buka`, `gambar`, `deskripsi`, `waktu_mulai`, `waktu_selesai`) VALUES
(2, 'Light Moon', 200000, '121030262_101111165109024_4721727974211074648_n-removebg-preview.png', 'Ikan hiu makan tai tolo nah', '2021-02-18 18:29:00', '2021-03-02 19:53:11'),
(3, 'Light Sun', 100000, 'logo.png', 'Ikan ini bersaudara dengan ikan hiuwersdfsdfsdf', '2021-02-18 18:30:00', '2021-03-02 18:30:00'),
(7, 'menu s', 300000, 'Koala1.jpg', 'no comment', '2021-03-11 17:24:00', '2021-03-15 17:24:00'),
(8, 'piranha', 300000, 'Jellyfish.jpg', 'no comment', '2021-03-03 07:58:00', '2021-03-03 07:59:00'),
(9, 'hiu', 2121, 'Desert.jpg', 'no commet', '2021-03-03 08:00:00', '2021-03-26 08:01:00');

-- --------------------------------------------------------

--
-- Table structure for table `pengiriman`
--

CREATE TABLE `pengiriman` (
  `id_pengiriman` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `status_pengiriman` enum('dikirim/selesai') NOT NULL,
  `nomor_resi` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengiriman`
--

INSERT INTO `pengiriman` (`id_pengiriman`, `id_pesanan`, `status_pengiriman`, `nomor_resi`) VALUES
(25, 2, 'dikirim/selesai', 'dqwe123'),
(27, 1, 'dikirim/selesai', '123123123'),
(28, 19, 'dikirim/selesai', 'erituoperjiogdgf d fsdf sd');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
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
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_peserta`, `id_lelang`, `id_tawaran`, `jumlah_bayar`, `bukti_gambar`, `status_pembayaran`, `status_pengiriman`, `waktu_pembayaran`) VALUES
(17, 19, 3, 33, 700005, '1614827198fGwj6iZfmTNOZ7F.png', 'pending', 'proses', '2021-03-03 21:03:38'),
(18, 19, 2, 23, 2147483647, '1614827214g4nABsC6Dm292I7.png', 'pending', 'proses', '2021-03-03 21:03:54'),
(19, 20, 8, 38, 300000, '1614846306YTmwzJbINrypouW.png', 'lunas', 'dikirim/selesai', '2021-03-04 01:03:06');

-- --------------------------------------------------------

--
-- Table structure for table `peserta`
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
-- Dumping data for table `peserta`
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
(15, 'User1', 'User1', '081244244244', 'Jl.abcs', 'User1'),
(16, 'gowadede', 'dedede', NULL, '', 'deded'),
(17, 'Dede', 'User', NULL, '', 'pass'),
(18, 'Test', 'Test', NULL, '', 'Test'),
(19, 'dede', 'dede', 'dede', 'dededede', 'dede'),
(20, 'Testting', 'Test1', '0800', 'Makassar', 'test1'),
(21, 'Amar', 'Amar', NULL, '', 'Amar');

-- --------------------------------------------------------

--
-- Table structure for table `tawaran`
--

CREATE TABLE `tawaran` (
  `id_tawaran` int(11) NOT NULL,
  `id_lelang` int(11) NOT NULL,
  `id_peserta` int(11) NOT NULL,
  `harga_tawar` int(11) NOT NULL,
  `waktu_penawaran` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tawaran`
--

INSERT INTO `tawaran` (`id_tawaran`, `id_lelang`, `id_peserta`, `harga_tawar`, `waktu_penawaran`) VALUES
(1, 3, 1, 250000, '2021-02-19 05:19:56'),
(2, 2, 1, 150000, '2021-02-19 08:39:56'),
(3, 2, 3, 250000, '2021-02-19 04:39:56'),
(4, 3, 4, 600000, '0000-00-00 00:00:00'),
(8, 2, 3, 900000, '0000-00-00 00:00:00'),
(12, 2, 3, 900000, '0000-00-00 00:00:00'),
(13, 2, 3, 900000, '0000-00-00 00:00:00'),
(14, 2, 3, 900000, '0000-00-00 00:00:00'),
(15, 2, 3, 910000, '0000-00-00 00:00:00'),
(16, 2, 3, 920000, '0000-00-00 00:00:00'),
(17, 2, 16, 9200003, '0000-00-00 00:00:00'),
(18, 2, 16, 92000033, '2021-03-01 00:03:06'),
(19, 2, 16, 92000033, '2021-03-01 00:03:40'),
(20, 2, 16, 92000033, '2021-03-01 00:03:31'),
(21, 2, 16, 92000033, '2021-03-01 00:03:35'),
(22, 2, 16, 920000334, '2021-03-01 00:03:28'),
(23, 2, 19, 2147483647, '2021-03-03 02:03:48'),
(29, 3, 19, 700000, '2021-03-03 02:03:39'),
(30, 3, 19, 700001, '2021-03-03 02:03:00'),
(31, 3, 19, 700003, '2021-03-03 02:03:23'),
(32, 3, 19, 700004, '2021-03-03 02:03:46'),
(33, 3, 19, 700005, '2021-03-03 02:03:23'),
(35, 9, 20, 1000, '2021-03-04 01:03:46'),
(36, 9, 20, 1001, '2021-03-04 01:03:15'),
(37, 9, 20, 2122, '2021-03-04 01:03:38'),
(38, 8, 20, 300000, '2021-03-04 01:03:16'),
(39, 9, 20, 10000, '2021-03-04 01:03:12'),
(40, 9, 20, 12000, '2021-03-04 01:03:43'),
(41, 9, 20, 50000, '2021-03-04 02:03:21'),
(42, 9, 21, 600000, '2021-03-04 03:03:01'),
(43, 9, 19, 705009, '2021-03-04 03:03:20');

-- --------------------------------------------------------

--
-- Table structure for table `tentang_toko`
--

CREATE TABLE `tentang_toko` (
  `gambar` varchar(125) NOT NULL,
  `tentang_aabetta` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tentang_toko`
--

INSERT INTO `tentang_toko` (`gambar`, `tentang_aabetta`) VALUES
('121030262_101111165109024_4721727974211074648_n-removebg-preview2.png', 'Toko ini adalah toko yang berjalan di bisnis penjualan ikan hias yang berada di pusat kota makassar, Toko ini adalah toko yang berjalan di bisnis penjualan ikan hias yang berada di pusat kota makassar, Toko ini adalah toko yang berjalan di bisnis penjualan ikan hias yang berada di pusat kota makassar, Toko ini adalah toko yang berjalan di bisnis penjualan ikan hias yang berada di pusat kota makassar, Toko ini adalah toko yang berjalan di bisnis penjualan ikan hias yang berada di pusat kota makassar, Toko ini adalah toko yang berjalan di bisnis penjualan ikan hias yang berada di pusat kota makassar, \r\n\r\n\r\nToko ini adalah toko yang berjalan di bisnis penjualan ikan hias yang berada di pusat kota makassar, Toko ini adalah toko yang berjalan di bisnis penjualan ikan hias yang berada di pusat kota makassar, Toko ini adalah toko yang berjalan di bisnis penjualan ikan hias yang berada di pusat kota makassar, Toko ini adalah toko yang berjalan di bisnis penjualan ikan hias yang berada di pusat kota makassar, Toko ini adalah toko yang berjalan di bisnis penjualan ikan hias yang berada di pusat kota makassar, ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `lelang`
--
ALTER TABLE `lelang`
  ADD PRIMARY KEY (`id_lelang`);

--
-- Indexes for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`id_pengiriman`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`);

--
-- Indexes for table `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`id_peserta`);

--
-- Indexes for table `tawaran`
--
ALTER TABLE `tawaran`
  ADD PRIMARY KEY (`id_tawaran`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lelang`
--
ALTER TABLE `lelang`
  MODIFY `id_lelang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pengiriman`
--
ALTER TABLE `pengiriman`
  MODIFY `id_pengiriman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id_peserta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tawaran`
--
ALTER TABLE `tawaran`
  MODIFY `id_tawaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
