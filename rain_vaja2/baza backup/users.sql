-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2021 at 02:11 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vaja1`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` text COLLATE utf8_slovenian_ci NOT NULL,
  `password` text COLLATE utf8_slovenian_ci NOT NULL,
  `name` text COLLATE utf8_slovenian_ci NOT NULL,
  `surname` text COLLATE utf8_slovenian_ci NOT NULL,
  `email` text COLLATE utf8_slovenian_ci NOT NULL,
  `address` text COLLATE utf8_slovenian_ci DEFAULT NULL,
  `zip` int(11) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `gender` text COLLATE utf8_slovenian_ci DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `admin` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `surname`, `email`, `address`, `zip`, `phone`, `gender`, `age`, `admin`) VALUES
(1, 'vihi', '8cb2237d0679ca88db6464eac60da96345513964', 'Gašper', 'Viher', 'gasper@genericmail.com', 'Žerovinci 68c', 2259, 5556969, 'moski', 20, 1),
(2, 'klepcic', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Peter', 'Klepec', 'klepcic@mail.com', '', 0, 0, '', 0, 0),
(3, 'user', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Kekec', 'lol', 'mail@mail.mail', '', 0, 0, '', 0, 0),
(4, 'user', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Kekec', 'lol', 'mail@mail.mail', '', 0, 0, 'moski', 0, 0),
(5, 'vihi', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'Lojzek77', 'Viher', 'gasper@genericmail.com', 'Žerovinci 68c', 2259, 5556969, 'moski', 20, 0),
(6, 'gen', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Generic', 'Generic', 'mail@mail.mail', '', 0, 0, 'moski', 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
