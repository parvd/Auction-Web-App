-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2020 at 07:16 PM
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
  `flag` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bid_registration`
--

INSERT INTO `bid_registration` (`bid_id`, `product_id`, `date`, `product_i_price`, `username`, `flag`) VALUES
('bid5ec2579448d45', 'pro5ec2579448d47', '2020-05-19 06:37:09', 17999, 'goku', 0),
('bid5ec2d86f3d054', 'pro5ec2d86f3d058', '2020-05-19 06:37:16', 199999, 'vegeta', 0),
('bid5ec2d8e567046', 'pro5ec2d8e56704b', '2020-05-19 06:37:20', 62000, 'goku', 0),
('bid5ec2dc0fa9615', 'pro5ec2dc0fa9616', '2020-05-19 06:37:26', 11999, 'vegeta', 0),
('bid5ec2e2a80ab14', 'pro5ec2e2a80ab15', '2020-05-19 06:37:30', 999, 'goku', 0),
('bid5ec381c29c20f', 'pro5ec381c29c210', '2020-05-19 06:50:42', 18999, 'goku', 0),
('bid5ec4212156ddd', 'pro5ec4212156de4', '2020-05-19 18:10:41', 123455, 'goku', 0),
('bid5ec4218591ebc', 'pro5ec4218591ebd', '2020-05-19 18:12:21', 55000, 'goku', 0);

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
(8, 'pro5ec2579448d47', 'bid5ec2579448d45', 'goku', 'pwd5ec259965335d'),
(9, 'pro5ec2d86f3d058', 'bid5ec2d86f3d054', 'goku', 'pwd5ec2d89731df5'),
(10, 'pro5ec2d8e56704b', 'bid5ec2d8e567046', 'vegeta', 'pwd5ec2d8f44aa11'),
(11, 'pro5ec2dc0fa9616', 'bid5ec2dc0fa9615', 'vegeta', 'pwd5ec2dc44ebe40'),
(12, 'pro5ec2e2a80ab15', 'bid5ec2e2a80ab14', 'goku', 'pwd5ec2e2bb0983c'),
(13, 'pro5ec381c29c210', 'bid5ec381c29c20f', 'vegeta', 'pwd5ec3820404429'),
(28, 'pro5ec2579448d47 ', 'bid5ec2579448d45', 'krilin', 'pwd5ec4196777a15'),
(38, 'pro5ec2579448d47 ', 'bid5ec2579448d45', 'vegeta', 'pwd5ec43816c030e'),
(39, 'pro5ec2e2a80ab15 ', 'bid5ec2e2a80ab14', 'krilin', 'pwd5ec5134be50b7'),
(40, 'pro5ec2e2a80ab15 ', 'bid5ec2e2a80ab14', 'vegeta', 'pwd5ec514f702719'),
(41, 'pro5ec4218591ebd ', 'bid5ec4218591ebc', 'goku', 'pwd5ec56440d9b74');

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
(31, 'bid5ec2e2a80ab14', 'krilin', 2000, 0),
(32, 'bid5ec2e2a80ab14', 'vegeta', 1600, 0),
(33, 'bid5ec4218591ebc', 'goku', 0, 0);

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
('pro5ec2579448d47', 'Mi note 10', 'mobile', 'Power Pack heater', 17999, 0x433a78616d7070096d70706870463843352e746d70),
('pro5ec2d86f3d058', 'Rolex', 'watch', 'Expensive watch', 199999, 0x433a78616d7070096d70706870344646452e746d70),
('pro5ec2d8e56704b', 'Iphone X', 'mobile', 'cheap phone', 62000, 0x433a78616d7070096d70706870314441422e746d70),
('pro5ec2dc0fa9616', 'Vivo V9 pro', 'mobile', 'China', 11999, 0x433a78616d7070096d70706870374145342e746d70),
('pro5ec2e2a80ab15', 'Boat 255', 'accessories', 'Basshead', 999, 0x433a78616d7070096d70706870334445452e746d70),
('pro5ec381c29c210', 'Realme X', 'mobile', 'Best in class', 18999, 0x433a78616d7070096d70706870424444432e746d70),
('pro5ec4218591ebd', 'PC dell', 'accessories', 'A dell pc', 55000, '');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `process`
--
ALTER TABLE `process`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
