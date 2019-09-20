-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2019 at 03:25 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `teamplaceholder`
--

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(10) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `firstname`, `lastname`, `username`, `email`, `password`) VALUES
(8, 'lini', 'lini', '', 'lini@gmail.com', '$2y$10$BKzFR9Ct2yogEaH.UpK8xOniBtENywKmN0.HOvVZ913HQU0gwefH.'),
(11, 'jasmine', 'ortega', 'jasmine10', 'jasjas@gmail.com', '$2y$10$JKvK8a9Vvhzu6GSdf/3bauGt4pSmwLx4dwuq0AF89SA9vH07e35Nm'),
(12, 'bobby', 'yemi', 'bobby123', 'bob@gmail.com', '$2y$10$U5cLvdJ/ciTjBOF89hBAAe2FnhSs5Rq2sTdFXCr2MH5bUG6OJh4Sa'),
(13, 'cassidy', 'smowke', 'cassie123', 'cassy@gmail.com', '$2y$10$NTMmbce1cKt60vFEzurEIOJcag5Gh90HtRmn8JAvIvykNx6zB3BHy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
