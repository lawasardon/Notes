-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2024 at 08:00 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `noteapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `archives`
--

CREATE TABLE `archives` (
  `n_id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `content` varchar(500) DEFAULT NULL,
  `is_favorite` tinyint(1) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `u_id` int(11) DEFAULT NULL,
  `archived_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `archives`
--

INSERT INTO `archives` (`n_id`, `title`, `content`, `is_favorite`, `time`, `u_id`, `archived_at`) VALUES
(98, 'Note 2', 'sddsfsdf\r\nfsdfdsfsd\r\nfsdfsdf\r\nfsdfsdfs\r\nfdsfds', 1, '2024-04-03 10:30:10', 59, '2024-04-06 13:03:48'),
(101, 'Note 5', 'fdfdfggd gfdgdfg gdfgdfgd dgfdgd dgfdgd vdsfgds\r\ngfdgdf \r\nfdsgdfgdf fdsggdfgfdg gdfgdg dfgfd gdfgfd\r\ngfdgdfgfdg gdfgdf gdfgdfgd gdfg\r\ndfgfdgdf dfgdfg gdfggdfgdfg\r\n', 1, '2024-04-06 17:46:10', 59, '2024-04-06 17:48:57'),
(102, 'Note 8', 'gfdsgdfggfdg\r\ndfgdf\r\ngdfg\r\ndfg\r\ndfg\r\ndfg\r\nd', 0, '2024-04-06 17:50:04', 59, '2024-04-06 17:51:25'),
(103, 'Note 7', 'Ardon\r\nLawas\r\nMark\r\nArdon\r\nLawas\r\ndsdds\r\ndsds\r\nddas', 0, '2024-04-06 17:51:14', 59, '2024-04-06 17:51:18');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `n_id` int(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` varchar(500) NOT NULL,
  `is_favorite` tinyint(1) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `u_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`n_id`, `title`, `content`, `is_favorite`, `time`, `u_id`) VALUES
(95, 'Note 1', 'aaddsd\r\ndsadsad\r\ndsadsadd\r\nsadsad\r\ndasdas', 1, '2024-04-04 03:01:35', 59),
(113, 'Note 1', 'My notes', 0, '2024-04-04 03:13:12', 63),
(114, 'Note 2', 'Your Notes', 1, '2024-04-04 03:13:52', 63);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `photo` varchar(255) NOT NULL DEFAULT 'DEFUALT'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `name`, `email`, `password`, `photo`) VALUES
(59, 'Ardon ', 'k@gmail.com', '$2y$10$qwrUlZq30X/2/DxcjN.lYOgRN1Q0biMndCbJKD6DQ/m8IP2Jpjheq', 'img/a.png'),
(60, 'Ardon', 'ard@gmail.com', '$2y$10$bXKNtcyjd71jcAUILCvaXe6ps2W/X.WMAcKyfVWF2Dr7EmKHyo4j.', 'img/icon.png'),
(61, 'Ardon', 'l@gmail.com', '$2y$10$1bWJ6bUfdHLhKSAFBDW2DO/PTWrkaNzHDlCh1DhCmVbr0rJX9ukyS', 'DEFUALT'),
(63, 'Mark Ardon', 'mark@gmail.com', '$2y$10$nkXjplX/t2HSvUhTfajkVeh4/LavZ8702seWW0V9haAMetvtetoqW', 'DEFUALT');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `archives`
--
ALTER TABLE `archives`
  ADD PRIMARY KEY (`n_id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`n_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `n_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `users` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
