-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2024 at 04:00 PM
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
-- Database: `amc`
--

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `workspace` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(30) NOT NULL,
  `job` varchar(2000) NOT NULL,
  `address` varchar(2000) NOT NULL,
  `phone` int(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `about` varchar(5000) NOT NULL,
  `role` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`workspace`, `username`, `password`, `job`, `address`, `phone`, `email`, `about`, `role`) VALUES
('Arav Patel', 'Arav K Patel', 'arav@123', 'Buisness', 'Rajkot Sun city', 2147483647, 'arav@gmail.com', '                        Hello', 'customer'),
('Hir_12', 'Hir Rupapara', 'jay@6125', 'Buisness', 'Jetpur', 2147483647, 'hir@gmail.com', 'hii', ' customer'),
('Khus Patel', 'Patel Khus Girishbhai', 'khus@123', 'Buisness', 'SG-Highway, S2 Street Ahmedabad', 1234567890, 'khus@gmail.com', '                        I.m Khus patel', 'employee'),
('Ramani_Jay214', 'Ramani Jay', 'jay@6125', 'Web Developer', 'BAVAVALAPARA NEAR CHORA', 2147483647, 'jayr43178@gmail.com', '                        HIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIII', 'employee');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`workspace`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
