-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2023 at 12:47 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `beroeps2agender`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(255) NOT NULL,
  `userId` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `beginDate` date NOT NULL,
  `endDate` date NOT NULL,
  `beginTime` time NOT NULL,
  `endTime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `userId`, `title`, `description`, `beginDate`, `endDate`, `beginTime`, `endTime`) VALUES
(1, 1, 'a', '', '2023-03-17', '0000-00-00', '00:00:00', '00:00:00'),
(5, 1, 'b', '', '2023-03-08', '0000-00-00', '00:00:00', '00:00:00'),
(6, 2, 'a', '', '2023-03-10', '0000-00-00', '00:00:00', '00:00:00'),
(7, 2, 'a', '', '2023-03-10', '0000-00-00', '00:00:00', '00:00:00'),
(8, 2, 'a', '', '2023-03-10', '0000-00-00', '00:00:00', '00:00:00'),
(9, 2, 'a', '', '2023-03-10', '0000-00-00', '00:00:00', '00:00:00'),
(10, 2, 'a', '', '2023-03-10', '0000-00-00', '00:00:00', '00:00:00'),
(11, 2, 'a', '', '2023-03-10', '0000-00-00', '00:00:00', '00:00:00'),
(12, 1, 'test', '', '0000-00-00', '0000-00-00', '00:00:00', '00:00:00'),
(13, 1, 'test', '', '2023-02-15', '0000-00-00', '00:00:00', '00:00:00'),
(14, 1, 'test', 'testdesc', '2023-02-14', '2023-03-16', '00:00:00', '00:00:00'),
(15, 1, 'test', 'testdesc', '2023-02-14', '0000-00-00', '00:00:00', '00:00:00'),
(16, 1, 'test', 'testdesc', '2023-02-14', '2023-03-15', '16:20:00', '06:09:00'),
(17, 1, 'asd', 'asdasd', '2023-02-15', '2023-03-24', '18:34:00', '16:28:00'),
(18, 1, 'test', 'test', '2023-03-19', '2023-04-18', '00:00:00', '00:00:00'),
(19, 1, 'test2', 'test22', '2023-03-19', '2023-04-20', '00:00:00', '00:00:00'),
(20, 1, 'test4', 'testblablacar', '2023-03-19', '2023-04-20', '00:00:00', '00:00:00'),
(21, 1, 'test', 'test2', '2023-03-20', '2023-04-21', '00:00:00', '00:00:00'),
(22, 1, 'test2', 'test3', '2023-03-20', '2023-04-21', '00:00:00', '00:00:00'),
(23, 1, 'test', 'test2', '2023-03-20', '2023-04-20', '00:00:00', '00:00:00'),
(24, 1, 'test', 'test2', '2023-03-20', '2023-04-20', '00:00:00', '00:00:00'),
(25, 1, 'test', 'test2', '2023-03-20', '2023-04-21', '00:00:00', '00:00:00'),
(26, 1, 'test', 'test2', '2023-03-20', '2023-04-20', '00:00:00', '00:00:00'),
(27, 1, 'test', 'test2', '2023-03-20', '2023-04-20', '00:00:00', '00:00:00'),
(28, 1, 'test', 'test2', '2023-03-01', '2023-04-20', '00:00:00', '00:00:00'),
(29, 1, 'test', 'test2', '2023-03-20', '2023-04-20', '00:00:00', '00:00:00'),
(30, 1, 'test', 'test2', '2023-03-20', '2023-04-20', '00:00:00', '00:00:00'),
(31, 1, 'test', 'test2', '2023-03-20', '2023-04-20', '00:00:00', '00:00:00'),
(32, 1, 'test', 'test2', '2023-04-20', '2023-04-20', '00:00:00', '00:00:00'),
(33, 1, 'test', 'test2', '2023-04-20', '2023-04-20', '00:00:00', '00:00:00'),
(34, 1, 'test2', 'test3', '2023-04-20', '2023-04-21', '00:00:00', '00:00:00'),
(35, 1, 'test3', 'test4', '2023-04-20', '2023-04-21', '00:00:00', '00:00:00'),
(36, 1, 'test4', 'test5', '2023-04-20', '2023-04-21', '00:00:00', '00:00:00'),
(37, 1, 'test4', 'test5', '2023-04-20', '2023-04-21', '00:00:00', '00:00:00'),
(38, 4, 'vakantie vieren', 'mooi weer', '2023-05-22', '2023-04-23', '00:00:00', '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `isAdmin`) VALUES
(1, 'test', '$2y$10$qtfXVZId8rfecOeg6NlLA.7eJPgmUzdgDgJlmXS1Rzba4Y3uxdOMS', 0),
(2, 'a', '$2y$10$P4c3jfuUny2YJF1oAjrfBuarsQ6Xono61juM/Osnq.WLvA20vCw86', 0),
(3, 'b', '$2y$10$JY2r6Y7GLvOE9cP76n33re59MF6XW1Zau64OTSyjyDhHuH5YYKCn.', 0),
(4, 'c', '$2y$10$RrZLN0JUbZQVwVWgtA08QurH/7q35EPOcKO8Y1j/xeRhm7LOFZ5au', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
