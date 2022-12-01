-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2022 at 06:15 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20221127024027', '2022-11-27 03:41:38', 64),
('DoctrineMigrations\\Version20221127024112', '2022-11-27 03:48:49', 59),
('DoctrineMigrations\\Version20221128192521', '2022-11-28 20:25:50', 150),
('DoctrineMigrations\\Version20221130005516', '2022-11-30 01:55:33', 369),
('DoctrineMigrations\\Version20221130005558', '2022-11-30 01:56:01', 28),
('DoctrineMigrations\\Version20221201041319', '2022-12-01 05:13:27', 35);

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `expense_date` datetime NOT NULL,
  `repeating` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`id`, `name`, `amount`, `expense_date`, `repeating`) VALUES
(1, 'Laptop', 2999, '2022-11-27 05:04:00', 0),
(2, 'Keyboard', 99, '2022-11-27 05:04:00', 0),
(3, 'Keyboard', 150, '2022-11-27 05:04:00', 0),
(4, 'Keyboard', 99.9, '2022-11-27 06:00:00', 0),
(5, 'Keyboard', 150, '2022-11-27 05:04:00', 0),
(6, 'Keyboard', 199.95, '2022-11-26 14:10:00', 0),
(7, 'Keyboard', 200, '2022-11-27 20:29:00', 0),
(8, 'Mice', 20, '2022-11-27 20:29:00', 0),
(9, 'Mice', 20, '2022-11-15 18:17:09', 0),
(10, 'Храна', 20, '2022-11-29 08:30:00', 0),
(11, 'Храна', 10, '2022-11-29 10:30:00', 0),
(12, 'Храна', 10, '2022-11-29 10:30:00', 0),
(13, 'Вода', 1, '2022-11-29 11:00:00', 0),
(14, 'Headphones', 30, '2022-09-01 00:00:00', 0),
(15, 'Храна', 22.25, '2022-11-08 12:00:00', 0),
(16, 'Keyboard', 75, '2018-12-01 00:00:00', 0),
(21, 'test', 100, '2022-11-30 05:15:00', 1),
(22, 'Test expense non repeating', 1000, '2022-11-30 00:09:00', 0),
(23, 'Test repeating expense', 1000, '2022-11-30 11:01:00', 12),
(24, 'Храна', 4.99, '2022-11-30 09:09:00', 0),
(25, 'Вода', 0.99, '2022-11-30 09:09:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `income_date` datetime NOT NULL,
  `repeating` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`id`, `amount`, `income_date`, `repeating`) VALUES
(1, 2000, '2022-10-31 10:00:00', 0),
(2, 1000, '2017-01-01 00:00:00', 0),
(3, 200, '2017-01-01 00:00:00', 0),
(4, 3000, '2022-11-16 00:00:00', 0),
(5, 2000, '2021-10-01 00:00:00', 0),
(7, 1, '2022-11-22 11:01:00', 0),
(8, 10, '2022-11-30 01:01:00', 0),
(9, 10, '2022-11-30 01:01:00', 2),
(10, 1, '2022-11-30 11:11:00', 1),
(11, 100, '2022-12-01 05:09:00', 0),
(12, 1000, '2022-12-01 11:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
