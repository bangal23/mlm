-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 29, 2023 at 09:23 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mlm`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_members`
--

CREATE TABLE `tb_members` (
  `id` varchar(5) COLLATE utf8mb3_bin NOT NULL,
  `nama` varchar(30) COLLATE utf8mb3_bin NOT NULL,
  `alamat` varchar(100) COLLATE utf8mb3_bin NOT NULL,
  `notelp` varchar(15) COLLATE utf8mb3_bin NOT NULL,
  `upline_id` varchar(5) COLLATE utf8mb3_bin NOT NULL,
  `downline1` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `downline2` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Dumping data for table `tb_members`
--

INSERT INTO `tb_members` (`id`, `nama`, `alamat`, `notelp`, `upline_id`, `downline1`, `downline2`) VALUES
('12311', 'Braun Schimizer', 'Jalan Tuntungan Blok T Nomor 201', '0811998877', '12345', '99616', '53164'),
('12312', 'Connie Jeiger', 'Jalan Mahakam Timur Nomor 5X', '0899765432', '12345', '81116', NULL),
('12345', 'Alfa Edison', 'Jalan Mabar Nomor 1A', '0813456789', '0', '12311', '12312'),
('53164', 'Horas Parjuangan', 'Jalan Merdeka Nomor 10A', '08112233454', '12311', NULL, NULL),
('81116', 'Tiago El Yada', 'Jalan Singosari Nomor 11', '0987625252', '12312', NULL, NULL),
('99616', 'Adi Maulana', 'Jalan Pegangsaan Timur 15A', '081362123303', '12311', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_members`
--
ALTER TABLE `tb_members`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
