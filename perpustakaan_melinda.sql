-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2026 at 02:53 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan_melinda`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota_melinda`
--

CREATE TABLE `anggota_melinda` (
  `id_anggota_melinda` int(11) NOT NULL,
  `id_user_melinda` int(11) NOT NULL,
  `nis_melinda` varchar(20) DEFAULT NULL,
  `nama_anggota_melinda` varchar(100) DEFAULT NULL,
  `kelas_melinda` varchar(20) DEFAULT NULL,
  `jurusan_melinda` varchar(50) NOT NULL,
  `status_verifikasi` enum('pending','aktif','expired','noaktif') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `anggota_melinda`
--

INSERT INTO `anggota_melinda` (`id_anggota_melinda`, `id_user_melinda`, `nis_melinda`, `nama_anggota_melinda`, `kelas_melinda`, `jurusan_melinda`, `status_verifikasi`) VALUES
(1, 1, '102306419', 'melinda puspita', '10', 'rpl', 'aktif'),
(4, 5, '102306422', 'siswi cewe', '12', 'mekatronika', 'aktif'),
(6, 7, '1', 'a', '1', 'mesin', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `buku_melinda`
--

CREATE TABLE `buku_melinda` (
  `id_buku_melinda` int(11) NOT NULL,
  `judul_buku_melinda` varchar(150) DEFAULT NULL,
  `pengarang_melinda` varchar(100) DEFAULT NULL,
  `penerbit_melinda` varchar(100) DEFAULT NULL,
  `tahun_terbit_melinda` year(4) DEFAULT NULL,
  `kategori_buku_melinda` enum('Novel','Komik','Dongeng','Buku Paket','Biografi','Majalah','Karya Ilmiah','Buku Digital','Fotografi','Cergam') NOT NULL,
  `stok_melinda` int(11) DEFAULT NULL,
  `status_buku_melinda` enum('Baru','Rusak') NOT NULL DEFAULT 'Baru'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku_melinda`
--

INSERT INTO `buku_melinda` (`id_buku_melinda`, `judul_buku_melinda`, `pengarang_melinda`, `penerbit_melinda`, `tahun_terbit_melinda`, `kategori_buku_melinda`, `stok_melinda`, `status_buku_melinda`) VALUES
(2, 'tutorial php', 'gtw', 'gtw', '2005', 'Novel', 124, 'Baru'),
(4, 'one piece', 'gtw', 'gtw', '2006', 'Komik', 244, 'Baru'),
(7, 'ancika', 'gatau', 'gatau', '2000', 'Novel', 245, 'Baru');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman_melinda`
--

CREATE TABLE `peminjaman_melinda` (
  `id_peminjaman_melinda` int(11) NOT NULL,
  `id_buku_melinda` int(11) DEFAULT NULL,
  `tanggal_pinjam_melinda` date DEFAULT NULL,
  `tanggal_kembali_melinda` date DEFAULT NULL,
  `status_melinda` enum('dipinjam','dikembalikan','dibatalkan','') DEFAULT NULL,
  `id_anggota_melinda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjaman_melinda`
--

INSERT INTO `peminjaman_melinda` (`id_peminjaman_melinda`, `id_buku_melinda`, `tanggal_pinjam_melinda`, `tanggal_kembali_melinda`, `status_melinda`, `id_anggota_melinda`) VALUES
(5, 2, '2026-01-21', '2026-01-21', 'dikembalikan', 1),
(6, 2, '2026-01-21', '2026-01-21', 'dikembalikan', 1),
(7, 2, '2026-01-21', '2026-01-21', 'dikembalikan', 1),
(8, 4, '2026-01-21', NULL, 'dipinjam', 1),
(9, 4, '2026-01-21', '2026-01-21', 'dikembalikan', 1),
(10, 2, '2026-01-21', NULL, 'dipinjam', 1),
(11, 4, '2026-01-21', NULL, 'dipinjam', 4),
(12, 2, '2026-01-22', '0000-00-00', '', 4);

-- --------------------------------------------------------

--
-- Table structure for table `user_melinda`
--

CREATE TABLE `user_melinda` (
  `id_user_melinda` int(11) NOT NULL,
  `username_melinda` varchar(50) DEFAULT NULL,
  `password_melinda` varchar(255) DEFAULT NULL,
  `role_melinda` enum('admin','user') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_melinda`
--

INSERT INTO `user_melinda` (`id_user_melinda`, `username_melinda`, `password_melinda`, `role_melinda`) VALUES
(1, 'mel', '202cb962ac59075b964b07152d234b70', 'user'),
(2, 'min', '202cb962ac59075b964b07152d234b70', 'admin'),
(5, 'siswi', 'b44f4e457859949b3c4b9c5b0405b6a8', 'user'),
(6, 'coba', 'c3ec0f7b054e729c5a716c8125839829', 'user'),
(7, 'a', '0cc175b9c0f1b6a831c399e269772661', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota_melinda`
--
ALTER TABLE `anggota_melinda`
  ADD PRIMARY KEY (`id_anggota_melinda`),
  ADD KEY `id_user_melinda` (`id_user_melinda`);

--
-- Indexes for table `buku_melinda`
--
ALTER TABLE `buku_melinda`
  ADD PRIMARY KEY (`id_buku_melinda`);

--
-- Indexes for table `peminjaman_melinda`
--
ALTER TABLE `peminjaman_melinda`
  ADD PRIMARY KEY (`id_peminjaman_melinda`),
  ADD KEY `id_buku_melinda` (`id_buku_melinda`),
  ADD KEY `id_anggota_melinda` (`id_anggota_melinda`);

--
-- Indexes for table `user_melinda`
--
ALTER TABLE `user_melinda`
  ADD PRIMARY KEY (`id_user_melinda`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota_melinda`
--
ALTER TABLE `anggota_melinda`
  MODIFY `id_anggota_melinda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `buku_melinda`
--
ALTER TABLE `buku_melinda`
  MODIFY `id_buku_melinda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `peminjaman_melinda`
--
ALTER TABLE `peminjaman_melinda`
  MODIFY `id_peminjaman_melinda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_melinda`
--
ALTER TABLE `user_melinda`
  MODIFY `id_user_melinda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anggota_melinda`
--
ALTER TABLE `anggota_melinda`
  ADD CONSTRAINT `anggota_melinda_ibfk_1` FOREIGN KEY (`id_user_melinda`) REFERENCES `user_melinda` (`id_user_melinda`);

--
-- Constraints for table `peminjaman_melinda`
--
ALTER TABLE `peminjaman_melinda`
  ADD CONSTRAINT `peminjaman_melinda_ibfk_2` FOREIGN KEY (`id_buku_melinda`) REFERENCES `buku_melinda` (`id_buku_melinda`),
  ADD CONSTRAINT `peminjaman_melinda_ibfk_3` FOREIGN KEY (`id_anggota_melinda`) REFERENCES `anggota_melinda` (`id_anggota_melinda`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
