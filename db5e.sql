-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2026 at 03:52 PM
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
-- Database: `db5e`
--

-- --------------------------------------------------------

--
-- Table structure for table `myguests`
--

CREATE TABLE `myguests` (
  `id` int(6) UNSIGNED NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `myguests`
--

INSERT INTO `myguests` (`id`, `firstname`, `lastname`, `email`, `reg_date`) VALUES
(1, 'Caesha', 'Nabila', 'keisha@example.com', '2026-10-08 07:26:32'),
(2, 'Caesha', 'Nabila', 'kesha@polnep.com', '2026-10-08 07:32:24'),
(3, 'caesha', 'nabila', 'keysha@example.com', '2026-10-08 07:51:47'),
(4, 'caesha', 'nabila', 'keysha@example.com', '2026-10-08 07:56:24'),
(5, '', '', '', '2026-10-08 07:56:28'),
(6, 'keisha', 'nabila', 'keisha@example.com', '2026-10-08 07:58:07');

-- --------------------------------------------------------

--
-- Table structure for table `nilaimhsw`
--

CREATE TABLE `nilaimhsw` (
  `nim` char(10) NOT NULL,
  `namalengkap` varchar(50) NOT NULL,
  `nilaiakhir` decimal(5,2) NOT NULL,
  `nilaihuruf` char(1) DEFAULT NULL,
  `predikat` varchar(20) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nilaimhsw`
--

INSERT INTO `nilaimhsw` (`nim`, `namalengkap`, `nilaiakhir`, `nilaihuruf`, `predikat`, `created_date`, `modified_date`, `foto`) VALUES
('3202416080', 'Repan', 79.00, 'B', 'Memuaskan', '2026-10-08 09:23:08', '2026-10-26 03:18:29', '3202416080_1792937145.jpg'),
('3202416089', 'Nabila', 89.00, 'A', 'Sangat Memuaskan', '2026-10-13 04:45:08', '2026-10-25 14:17:57', '3202416089_1792937233.jpg'),
('3202416090', 'Adel', 90.00, 'A', 'Sangat Memuaskan', '2026-10-26 14:25:34', '2026-10-26 14:25:34', '3202416090_1793024734.jpg'),
('3202416097', 'Caesha', 95.00, 'A', 'Sangat Memuaskan', '2026-10-25 09:10:59', '2026-10-25 09:10:59', '3202416097_1792919459.jpeg'),
('3202416100', 'Ridwansyah', 80.00, 'B', 'Memuaskan', '2026-10-25 14:12:40', '2026-10-26 03:18:24', '3202416100.jpg'),
('3202416102', 'Misha', 35.00, 'D', 'Kurang Memuaskan', '2026-10-19 10:39:08', '2026-10-26 03:18:50', '3202416102_1792937719.jpg'),
('3202416104', 'Kania', 78.50, 'B', 'Memuaskan', '2026-10-08 09:24:37', '2026-10-26 03:18:35', '3202416104_1792937733.jpg'),
('3202416113', 'Ariel', 30.00, 'E', 'Tidak Lulus', '2026-10-19 09:46:04', '2026-10-26 03:18:57', '3202416113_1792937495.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

CREATE TABLE `photo` (
  `id_photo` int(6) UNSIGNED NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `uploaded_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `photo`
--

INSERT INTO `photo` (`id_photo`, `file_name`, `uploaded_date`) VALUES
(1, 'img/contoh1.jpg', '2026-10-20 06:56:36'),
(2, 'img/buah1.jpg', '2026-10-20 06:59:24'),
(3, 'img/UseCase_ProposalLaundry_FIXBANGET.drawio.png', '2026-10-20 07:01:17'),
(5, 'img/ngoding.gif', '2026-10-20 07:12:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `myguests`
--
ALTER TABLE `myguests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilaimhsw`
--
ALTER TABLE `nilaimhsw`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`id_photo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `myguests`
--
ALTER TABLE `myguests`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `photo`
--
ALTER TABLE `photo`
  MODIFY `id_photo` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
