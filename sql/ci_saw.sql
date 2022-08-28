-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Aug 28, 2022 at 04:10 AM
-- Server version: 8.0.30
-- PHP Version: 8.0.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_saw`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternatives`
--

CREATE TABLE `alternatives` (
  `id` int NOT NULL,
  `code` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `alternatives`
--

INSERT INTO `alternatives` (`id`, `code`, `name`, `created_at`) VALUES
(8, '311001', 'Bekasi 1 – Ahmad Yani', '2022-08-28 03:28:18'),
(9, '312002', 'Bekasi 2 – Kranji', '2022-08-28 03:28:40'),
(10, '313003', 'Bekasi 3 – Tambun', '2022-08-28 03:29:10'),
(11, '314004', 'Bekasi 4 – Cikarang', '2022-08-28 03:29:37'),
(12, '315005', 'Bekasi 5 – Cibitung', '2022-08-28 03:30:01');

-- --------------------------------------------------------

--
-- Table structure for table `alt_criteria`
--

CREATE TABLE `alt_criteria` (
  `id` int NOT NULL,
  `alt_id` int NOT NULL,
  `criteria_code` varchar(10) NOT NULL,
  `subcriteria_id` int NOT NULL,
  `value` double NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `alt_criteria`
--

INSERT INTO `alt_criteria` (`id`, `alt_id`, `criteria_code`, `subcriteria_id`, `value`, `created_at`) VALUES
(5, 4, '4', 0, 0, '2022-08-28 03:20:07'),
(6, 4, '4', 0, 0, '2022-08-28 03:20:07'),
(7, 4, '4', 0, 0, '2022-08-28 03:20:07'),
(8, 4, '4', 0, 0, '2022-08-28 03:20:07'),
(9, 5, '4', 0, 0, '2022-08-28 03:20:57'),
(10, 5, '4', 0, 0, '2022-08-28 03:20:57'),
(11, 5, '4', 0, 0, '2022-08-28 03:20:57'),
(12, 5, '4', 0, 0, '2022-08-28 03:20:57'),
(13, 6, 'C1', 33, 7, '2022-08-28 03:22:15'),
(14, 6, 'C2', 41, 50, '2022-08-28 03:22:15'),
(15, 6, 'C3', 39, 6, '2022-08-28 03:22:15'),
(16, 6, 'C4', 42, 6, '2022-08-28 03:22:15'),
(17, 7, 'C1', 33, 7, '2022-08-28 03:23:25'),
(18, 7, 'C2', 41, 50, '2022-08-28 03:23:25'),
(19, 7, 'C3', 39, 6, '2022-08-28 03:23:25'),
(20, 7, 'C4', 42, 6, '2022-08-28 03:23:25'),
(21, 8, 'C1', 32, 70, '2022-08-28 03:28:18'),
(22, 8, 'C2', 41, 50, '2022-08-28 03:28:18'),
(23, 8, 'C3', 13, 60, '2022-08-28 03:28:18'),
(24, 8, 'C4', 29, 60, '2022-08-28 03:28:18'),
(25, 9, 'C1', 33, 60, '2022-08-28 03:28:40'),
(26, 9, 'C2', 41, 55, '2022-08-28 03:28:40'),
(27, 9, 'C3', 39, 50, '2022-08-28 03:28:40'),
(28, 9, 'C4', 42, 55, '2022-08-28 03:28:40'),
(29, 10, 'C1', 32, 75, '2022-08-28 03:29:10'),
(30, 10, 'C2', 16, 70, '2022-08-28 03:29:10'),
(31, 10, 'C3', 12, 70, '2022-08-28 03:29:10'),
(32, 10, 'C4', 29, 60, '2022-08-28 03:29:10'),
(33, 11, 'C1', 31, 85, '2022-08-28 03:29:37'),
(34, 11, 'C2', 16, 75, '2022-08-28 03:29:37'),
(35, 11, 'C3', 12, 70, '2022-08-28 03:29:37'),
(36, 11, 'C4', 29, 60, '2022-08-28 03:29:37'),
(37, 12, 'C1', 33, 65, '2022-08-28 03:30:01'),
(38, 12, 'C2', 17, 65, '2022-08-28 03:30:01'),
(39, 12, 'C3', 12, 70, '2022-08-28 03:30:01'),
(40, 12, 'C4', 42, 55, '2022-08-28 03:30:01');

-- --------------------------------------------------------

--
-- Table structure for table `criterias`
--

CREATE TABLE `criterias` (
  `id` int NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `weight` int NOT NULL,
  `percent` double NOT NULL,
  `type` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `criterias`
--

INSERT INTO `criterias` (`id`, `code`, `name`, `weight`, `percent`, `type`, `created_at`) VALUES
(1, 'C1', 'Produktifitas', 35, 0.35, 'Benefit', '2021-12-23 14:27:32'),
(2, 'C2', 'Kualitas Layanan', 25, 0.25, 'Benefit', '2021-12-23 14:28:01'),
(3, 'C3', 'Kualitas Individu', 25, 0.25, 'Benefit', '2021-12-23 14:28:16'),
(4, 'C4', 'Akuntabilitas', 14, 0.14, 'Benefit', '2021-12-23 14:30:19');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int NOT NULL,
  `ip` varchar(15) DEFAULT NULL,
  `os` varchar(20) DEFAULT NULL,
  `browser` varchar(20) DEFAULT NULL,
  `browser_version` varchar(30) DEFAULT NULL,
  `login_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `ip`, `os`, `browser`, `browser_version`, `login_date`, `email`) VALUES
(1, '::1', 'Windows 10', 'Chrome', '104.0.0.0', '2022-08-28 08:56:11', 'septian.arman009@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL,
  `name` varchar(15) DEFAULT NULL,
  `display_name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`) VALUES
(1, 'admin', 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `subcriterias`
--

CREATE TABLE `subcriterias` (
  `id` int NOT NULL,
  `criteria_id` int NOT NULL,
  `range_value` varchar(10) NOT NULL,
  `name` varchar(25) NOT NULL,
  `value` int NOT NULL,
  `weight` double NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `subcriterias`
--

INSERT INTO `subcriterias` (`id`, `criteria_id`, `range_value`, `name`, `value`, `weight`, `created_at`) VALUES
(10, 3, '90-99', 'Istimewa', 100, 1, '2021-12-23 23:56:20'),
(11, 3, '80-89', 'Baik Sekali', 90, 0.8, '2021-12-24 00:28:27'),
(12, 3, '70-79', 'Baik', 80, 0.6, '2021-12-24 00:28:34'),
(13, 3, '60-69', 'Cukup', 70, 0.4, '2021-12-24 00:28:40'),
(14, 2, '90-99', 'Istimewa', 100, 1, '2021-12-24 00:39:15'),
(15, 2, '80-89', 'Baik Sekali', 90, 0.8, '2021-12-24 00:39:20'),
(16, 2, '70-79', 'Baik', 80, 0.6, '2021-12-24 00:39:27'),
(17, 2, '60-69', 'Cukup', 70, 0.4, '2021-12-24 00:39:33'),
(26, 4, '90-99', 'Istimewa', 100, 1, '2021-12-24 00:40:58'),
(27, 4, '80-89', 'Baik Sekali', 90, 0.8, '2021-12-24 00:41:03'),
(28, 4, '70-79', 'Baik', 80, 0.6, '2021-12-24 00:41:08'),
(29, 4, '60-69', 'Cukup', 70, 0.4, '2021-12-24 00:41:13'),
(30, 1, '90-99', 'Istimewa', 100, 1, '2021-12-24 00:41:33'),
(31, 1, '80-89', 'Baik Sekali', 90, 0.8, '2021-12-24 00:41:42'),
(32, 1, '70-79', 'Baik', 80, 0.6, '2021-12-24 00:41:48'),
(33, 1, '60-69', 'Cukup', 70, 0.4, '2021-12-24 00:41:53'),
(39, 3, '50-59', 'Kurang', 60, 0.2, '2022-08-27 16:15:57'),
(40, 1, '50-59', 'Kurang', 60, 0.2, '2022-08-27 19:59:57'),
(41, 2, '50-59', 'Kurang', 60, 0.2, '2022-08-27 20:01:09'),
(42, 4, '50-59', 'Kurang', 60, 0.2, '2022-08-27 20:02:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(65) DEFAULT NULL,
  `role` int NOT NULL,
  `token` varchar(62) DEFAULT NULL,
  `token_password` varchar(62) DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `token`, `token_password`, `is_verified`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'septian.arman009@gmail.com', '$2y$10$1Cn1g/0v66NJgdLUuCYlcuCsicOSYw2T4u68U5QRIDg5tdmZPPLXC', 1, NULL, NULL, 1, '2021-04-29 14:36:32', '2021-04-29 14:36:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternatives`
--
ALTER TABLE `alternatives`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alt_criteria`
--
ALTER TABLE `alt_criteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `criterias`
--
ALTER TABLE `criterias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcriterias`
--
ALTER TABLE `subcriterias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alternatives`
--
ALTER TABLE `alternatives`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `alt_criteria`
--
ALTER TABLE `alt_criteria`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `criterias`
--
ALTER TABLE `criterias`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subcriterias`
--
ALTER TABLE `subcriterias`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
