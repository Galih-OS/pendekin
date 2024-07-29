-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2024 at 07:51 AM
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
-- Database: `url_shortener`
--

-- --------------------------------------------------------

--
-- Table structure for table `urls`
--

CREATE TABLE `urls` (
  `id` int(11) NOT NULL,
  `original_url` varchar(2048) NOT NULL,
  `short_code` varchar(10) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `urls`
--

INSERT INTO `urls` (`id`, `original_url`, `short_code`, `title`, `updated_at`) VALUES
(17, 'https://wargaklampid-dispendukcapil.surabaya.go.id/app', '65b42a', 'a1', '2024-07-29 04:46:45'),
(18, 'https://www.youtube.com/watch?v=c11OUBnvzhU', 'danger', 'a2', '2024-07-29 04:46:48'),
(19, 'https://www.youtube.com/watch?v=3-Xcc1GSLjY', 'galihos', 'a3', '2024-07-29 04:47:02'),
(26, 'https://portal.lelang.go.id/lot-lelang/detail/923834/Honda-Type-MCB-Tahun-1997-Noplat-L-2401-TP-di-Kota-Surabaya.html', '9f7cfb', 'a4', '2024-07-29 04:47:05'),
(27, 'https://portal.lelang.go.id/lot-lelang/detail/923837/1-Honda-Type-MCB-Tahun-2000-Noplat-L-6528-BP-di-Kota-Surabaya.html', '85b80c', 'a5', '2024-07-29 04:47:08'),
(28, 'https://portal.lelang.go.id/lot-lelang/detail/923893/1-Honda-Type-MCB-Tahun-1994-Noplat-L-6335-AP-di-Kota-Surabaya.html', 'c0c036', 'a6', '2024-07-29 04:47:10'),
(29, 'https://www.youtube.com/watch?v=c11OUBnvzhU', 'c70803', 'a7', '2024-07-29 04:47:14'),
(30, 'https://peraturan.bpk.go.id/Details/280634/permendagri-no-15-tahun-2023', '4b25b7', 'a8', '2024-07-29 04:47:17'),
(31, 'https://wargaklampid-dispendukcapil.surabaya.go.id/app', '7ebcab', 'a9', '2024-07-29 04:47:20'),
(32, 'https://eperformance.surabaya.go.id/2024/aktivitas-capaian-route', '9cf63c', 'ePerformance | Sistem Informasi Manajemen Kinerja Pegawai Pemerintah Kota Surabaya', '2024-07-29 05:11:05'),
(35, 'https://galih-os.github.io/', '00a25e', 'Galihos', '2024-07-29 05:38:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `urls`
--
ALTER TABLE `urls`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `short_code` (`short_code`),
  ADD KEY `idx_short_code` (`short_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `urls`
--
ALTER TABLE `urls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
