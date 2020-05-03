-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 16, 2020 at 08:59 PM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ipd19`
--
CREATE DATABASE IF NOT EXISTS `ipd19` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `ipd19`;

-- --------------------------------------------------------

--
-- Table structure for table `book_users`
--

DROP TABLE IF EXISTS `book_users`;
CREATE TABLE `book_users` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `book_users`
--

INSERT INTO `book_users` (`id`, `name`, `email`, `pword`) VALUES
(1, 'Steph', 'steph@gmail.com', '$2y$10$9mWqPLqg2CDsMsYPzM.YWerpYXH1jCplQ3EsVe0p/PqzIkBw43Mp6'),
(2, 'Bob', 'bobbi@gmail.com', '$2y$10$a4kwbPhUr2Edr01baUNM3uch3.b3V20qscO9obLgbqOCjSrrFv/6e'),
(3, 'Garamond', 'garamond@fonts.com', '$2y$10$ttXkgx/C0u70F7mOcMcTveRCNp3cQTCcZWztRds9wqgREmLc4aCB2'),
(4, 'Tahoma', 'tahoma@fonts.com', '$2y$10$fl6CG0fAwqnMt/ni/g1IU.pHccOPnoXhmuBTqTxah0nFnOewRemDC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book_users`
--
ALTER TABLE `book_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book_users`
--
ALTER TABLE `book_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
