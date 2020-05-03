-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 17, 2020 at 05:17 AM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `ipd19`
--

-- --------------------------------------------------------

--
-- Table structure for table `book_authors`
--

CREATE TABLE `book_authors` (
  `id` int(11) NOT NULL,
  `author` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `book_authors`
--

INSERT INTO `book_authors` (`id`, `author`) VALUES
(1, 'Bjarne Stroustrup'),
(2, 'James A. Gosling'),
(3, 'Rasmus Lerdorf'),
(4, 'Brendan Eich'),
(5, 'Tim Berners-Lee'),
(6, 'Håkon Wium Lie');

-- --------------------------------------------------------

--
-- Table structure for table `book_books`
--

CREATE TABLE `book_books` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `author` int(11) NOT NULL,
  `pub_year` year(4) NOT NULL,
  `description` text NOT NULL,
  `archived` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book_authors`
--
ALTER TABLE `book_authors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_books`
--
ALTER TABLE `book_books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author` (`author`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book_authors`
--
ALTER TABLE `book_authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `book_books`
--
ALTER TABLE `book_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book_books`
--
ALTER TABLE `book_books`
  ADD CONSTRAINT `book_books_ibfk_1` FOREIGN KEY (`author`) REFERENCES `book_authors` (`id`);