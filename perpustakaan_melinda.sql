-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2026 at 02:15 AM
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
  `nis_melinda` varchar(20) DEFAULT NULL,
  `nama_anggota_melinda` varchar(100) DEFAULT NULL,
  `kelas_melinda` varchar(20) DEFAULT NULL,
  `jurusan_melinda` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `stok_melinda` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman_melinda`
--

CREATE TABLE `peminjaman_melinda` (
  `id_peminjaman_melinda` int(11) NOT NULL,
  `id_anggota_melinda` int(11) DEFAULT NULL,
  `id_buku_melinda` int(11) DEFAULT NULL,
  `tanggal_pinjam_melinda` date DEFAULT NULL,
  `tanggal_kembali_melinda` date DEFAULT NULL,
  `status_melinda` enum('dipinjam','dikembalikan') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota_melinda`
--
ALTER TABLE `anggota_melinda`
  ADD PRIMARY KEY (`id_anggota_melinda`);

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
  ADD KEY `id_anggota_melinda` (`id_anggota_melinda`),
  ADD KEY `id_buku_melinda` (`id_buku_melinda`);

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
  MODIFY `id_anggota_melinda` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `buku_melinda`
--
ALTER TABLE `buku_melinda`
  MODIFY `id_buku_melinda` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `peminjaman_melinda`
--
ALTER TABLE `peminjaman_melinda`
  MODIFY `id_peminjaman_melinda` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_melinda`
--
ALTER TABLE `user_melinda`
  MODIFY `id_user_melinda` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `peminjaman_melinda`
--
ALTER TABLE `peminjaman_melinda`
  ADD CONSTRAINT `peminjaman_melinda_ibfk_1` FOREIGN KEY (`id_anggota_melinda`) REFERENCES `anggota_melinda` (`id_anggota_melinda`),
  ADD CONSTRAINT `peminjaman_melinda_ibfk_2` FOREIGN KEY (`id_buku_melinda`) REFERENCES `buku_melinda` (`id_buku_melinda`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
