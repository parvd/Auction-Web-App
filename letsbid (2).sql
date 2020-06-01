-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2020 at 01:24 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `letsbid`
--

-- --------------------------------------------------------

--
-- Table structure for table `bid_registration`
--

CREATE TABLE `bid_registration` (
  `bid_id` varchar(50) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `product_i_price` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `flag` int(11) NOT NULL DEFAULT 0,
  `bid_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bid_registration`
--

INSERT INTO `bid_registration` (`bid_id`, `product_id`, `date`, `product_i_price`, `username`, `flag`, `bid_date`) VALUES
('bid5ed1030eb6d02', 'pro5ed1030eb6d05', '2020-05-29 12:41:50', 18999, 'goku', 0, '2020-06-03'),
('bid5ed3d076ec217', 'pro5ed3d076ec21b', '2020-05-31 15:42:46', 890, 'goku', 0, '2020-06-04');

-- --------------------------------------------------------

--
-- Table structure for table `participation`
--

CREATE TABLE `participation` (
  `id` int(11) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `bid_id` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `part_pwd` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `participation`
--

INSERT INTO `participation` (`id`, `product_id`, `bid_id`, `username`, `part_pwd`) VALUES
(43, 'pro5ed1030eb6d05 ', 'bid5ed1030eb6d02', 'goku', 'pwd5ed103af82629');

-- --------------------------------------------------------

--
-- Table structure for table `process`
--

CREATE TABLE `process` (
  `id` int(11) NOT NULL,
  `bid_id` varchar(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `bid_price` int(11) NOT NULL DEFAULT 0,
  `flag` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `process`
--

INSERT INTO `process` (`id`, `bid_id`, `username`, `bid_price`, `flag`) VALUES
(35, 'bid5ed1030eb6d02', 'goku', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` varchar(50) NOT NULL,
  `product_name` varchar(80) NOT NULL,
  `product_category` varchar(20) NOT NULL,
  `product_description` varchar(5000) NOT NULL,
  `product_cost` int(11) NOT NULL,
  `product_image` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_category`, `product_description`, `product_cost`, `product_image`) VALUES
('pro5ed1030eb6d05', 'Realme X', 'accessories', 'A sasta case', 18999, ''),
('pro5ed3d076ec21b', 'Adidas', 'book', 'dwndkmmwk', 890, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_t`
--

CREATE TABLE `user_t` (
  `id` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `emailid` varchar(90) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_t`
--

INSERT INTO `user_t` (`id`, `username`, `emailid`, `pwd`, `time`) VALUES
('8', 'goku', 'gokusaiyandbs99@gmail.com', '$2y$10$SHaGF3zEfBESwjaSOXi.6u9LotVIdK4vx8eBg.Wah6tynMmmIVtYq', '2020-05-16 17:42:28'),
('use5ebd9d1b0bc25', 'bittu123', 'bittu123@gmail.com', '$2y$10$SW1ioFszt8vGdpcpBpG9D.ubAWPlTg7VYiMLyRFGwGP16XN1dPMQe', '2020-05-14 19:33:47'),
('use5ec2d772de41d', 'vegeta', 'parvd5@gmail.com', '$2y$10$D1w/NF/UtbCNaE6UpMwmN.LrnrGXPjLOrSJN3bz0c.frJJOT5HIfq', '2020-05-18 18:44:03'),
('use5ec3bc25a7c23', 'krilin', 'kriliin45@gmail.com', '$2y$10$eSf48fbAqXHaB/95k/SO.utONPjuNXoCGetLEDsTAPgugJYK2v1gO', '2020-05-19 10:59:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bid_registration`
--
ALTER TABLE `bid_registration`
  ADD PRIMARY KEY (`bid_id`),
  ADD UNIQUE KEY `product_id` (`product_id`);

--
-- Indexes for table `participation`
--
ALTER TABLE `participation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `process`
--
ALTER TABLE `process`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `user_t`
--
ALTER TABLE `user_t`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_name` (`username`),
  ADD UNIQUE KEY `email_id` (`emailid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `participation`
--
ALTER TABLE `participation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `process`
--
ALTER TABLE `process`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
