-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2021 at 02:18 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `invitations_generator`
--

-- --------------------------------------------------------

--
-- Table structure for table `invitations`
--

CREATE TABLE `invitations` (
  `id` int(10) NOT NULL,
  `title` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `subject` varchar(50) NOT NULL,
  `place` varchar(15) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invitations`
--

INSERT INTO `invitations` (`id`, `title`, `date`, `time`, `subject`, `place`, `user_id`) VALUES
(1, 'Css - layout, flexbox', '2022-01-04', '10:00:00', 'Web technologies', 'BBB', 4),
(2, 'Genetic algorithm', '2022-01-11', '11:00:00', 'Artificial intelligence ', 'FMI', 4);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
(7, 'student'),
(8, 'tutor');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `fn` int(5) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role_id` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fn`, `username`, `password`, `role_id`, `email`) VALUES
(4, 81933, 'kristinabp', '$2y$10$8Gc8Ux50ndNL8wi5ZyHDreIxhezZCEhJucgGVcKxYf3HIR0INZyWa', '7', 'krissypopowa@abv.bg'),
(5, 80000, 'desi', '$2y$10$tzLKXskp1ALA3/VzInUf3e0fglHQMaGMnYvuNE72hmS4OoUidFLnm', '7', 'desi15@abv.bg'),
(7, 0, 'milenp', '$2y$10$WUd92/gFqjqRK.QL1KIrbOd/wpQQzHBSOQU7OibEaZk1cl0FaPtJu', '8', 'milenp@abv.bg'),
(8, 81934, 'krissypopo', '$2y$10$SNf9VWpjTsDDYWKtmdViRu/XHkD5HtB2JQCTrN15elZ7EXMN.Vv62', '7', 'krissypopowa2@abv.bg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `invitations`
--
ALTER TABLE `invitations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role` (`role`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fn` (`fn`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `invitations`
--
ALTER TABLE `invitations`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
