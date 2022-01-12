-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2022 at 06:16 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `se_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(20) NOT NULL,
  `restaurant_name` varchar(255) NOT NULL,
  `cat_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `restaurant_name`, `cat_name`) VALUES
(1, 'Raju', 'burgers'),
(3, 'Raju', 'pizza'),
(4, 'Raju', 'steak'),
(20, 'Ayan', 'Paratha Rolls'),
(21, 'Ayan', 'Chinese');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `i_id` int(20) NOT NULL,
  `restaurant_name` varchar(255) NOT NULL,
  `i_category` varchar(255) NOT NULL,
  `i_name` varchar(255) NOT NULL,
  `i_price` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`i_id`, `restaurant_name`, `i_category`, `i_name`, `i_price`) VALUES
(2, 'Raju', 'steak', 'bbq steak', 600),
(3, 'Raju', 'pizza', 'special pizza (M)', 800),
(4, 'Raju', 'burgers', 'fish burger', 300),
(5, 'Raju', 'steak', 'white sauce steak', 600),
(7, 'Raju', 'pizza', 'new pizza', 1200),
(8, 'Raju', 'steak', 'updated steak 2', 600),
(9, 'Ayan', 'Paratha Rolls', 'zinger paratha roll', 180),
(11, 'Ayan', 'Chinese', 'new item', 500),
(14, 'Raju', 'burgers', 'Zinger', 350),
(15, 'Raju', 'burgers', 'Campus Special', 400),
(16, 'Raju', 'burgers', 'Patty Burger', 250);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `o_id` int(11) NOT NULL,
  `restaurant_name` varchar(255) NOT NULL,
  `o_items` varchar(255) NOT NULL,
  `o_price` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_fullname` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `hostel` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`o_id`, `restaurant_name`, `o_items`, `o_price`, `username`, `user_fullname`, `contact_number`, `hostel`) VALUES
(9, 'Raju', '3', '1200', 'arqam', 'Arqam Javed', '03347733102', 'h7'),
(27, 'Raju', '1', '800', 'saim', 'saim', '03347733102', 'h3'),
(28, 'Raju', '3', '900', 'arqam', 'Arqam Javed', '065146163', 'h4'),
(30, 'Raju', '1', '300', 'arqam', 'Arqam Javed', '03347733102', 'h6'),
(31, 'Raju', '1', '1200', 'saim', 'saim', '03347733102', 'h7'),
(32, 'Raju', '2', '2400', 'saim', 'saim', '03347733102', 'h8'),
(33, 'Raju', '4', '3000', 'saim', 'saim', '03347733102', 'h9'),
(34, 'Raju', '4', '3000', 'saim', 'saim', '03347733102', 'h10'),
(35, 'Raju', '5', '4200', 'saim', 'saim', '03347733102', 'h11'),
(39, 'Raju', '3', '1500', 'ali', 'Ali', '12345678910', 'h10'),
(40, 'Raju', '3', '1500', 'saad', 'Saad Ahmed', '12345678910', 'h1'),
(42, 'Raju', '3', '1500', 'ahmed', 'Ahmed Saim', '12345678910', 'h8'),
(44, 'Raju', '3', '1500', 'arsi', 'Arslan Ashraf', '12345678910', 'h8'),
(45, 'Raju', '5', '3000', 'arqam', 'Arqam Javed', '03326525325', 'h8'),
(46, 'Raju', '2', '600', 'ibbi', 'ibraheem', '0336488844', '5'),
(47, 'Raju', '1', '300', 'arsi', 'arsi', '032215485', '11'),
(48, 'Raju', '4', '1200', 'eeshanwaqar', 'eeshan waqar ', '03324519059', '4'),
(49, 'Raju', '1', '300', 'arsi', 'arsi', 'ijj', 'k'),
(50, 'Raju', '1', '300', 'arsi', 'arsi', 'j', 'j'),
(51, 'Raju', '4', '2000', 'arsi', 'arsi', '6262030', '3');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `order_id` int(100) NOT NULL,
  `restaurant_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `transaction_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_price` float(10,2) NOT NULL,
  `quantity` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(25) COLLATE utf8_unicode_ci NOT NULL COMMENT '0=Failed, 1=Success',
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `payment_method` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `order_id`, `restaurant_name`, `username`, `transaction_id`, `total_price`, `quantity`, `status`, `date`, `payment_method`) VALUES
(2, 9, 'Raju', 'arqam', 'T20210102015102', 1200.00, '1', '1', '2021-01-01 20:51:51', 'Online'),
(3, 27, 'Raju', 'saim', 'T20210102184816', 800.00, '1', '1', '2021-01-02 13:51:13', 'Online'),
(4, 28, 'Raju', 'arqam', 'T20210102185230', 900.00, '3', '1', '2021-01-02 13:55:19', 'Online'),
(5, 30, 'Raju', 'arqam', 'T20210102190244', 300.00, '1', '1', '2021-01-02 14:03:41', 'Online'),
(6, 31, 'Raju', 'saim', 'NULL', 120000.00, '1', '1', '2021-01-02 19:15:26', 'COD'),
(7, 32, 'Raju', 'saim', 'NULL', 2400.00, '2', '1', '2021-01-02 19:16:44', 'COD'),
(29, 33, 'Raju', 'saim', 'NULL', 3000.00, '4', '1', '2021-01-02 19:27:26', 'COD'),
(41, 34, 'Ayan', 'saim', 'NULL', 3000.00, '4', '1', '2021-01-02 19:29:30', 'COD'),
(43, 35, 'Raju', 'saim', 'T20210103012519', 4200.00, '5', '1', '2021-01-02 20:26:14', 'Online'),
(49, 39, 'Raju', 'ali', 'T20210108123738', 1500.00, '3', '1', '2021-01-08 07:39:25', 'Online'),
(50, 42, 'Raju', 'ahmed', 'T20210108190000', 1500.00, '3', '1', '2021-01-08 14:01:32', 'Online'),
(51, 44, 'Raju', 'arsi', 'T20210108202942', 1500.00, '3', '1', '2021-01-08 15:31:11', 'Online'),
(52, 45, 'Raju', 'arqam', 'T20210108204644', 3000.00, '5', '1', '2021-01-08 15:48:04', 'Online'),
(53, 46, 'Raju', 'ibbi', 'NULL', 600.00, '2', '1', '2021-02-25 20:34:47', 'COD'),
(54, 48, 'Raju', 'eeshanwaqar', 'NULL', 1200.00, '4', '1', '2022-01-11 16:56:29', 'COD'),
(56, 49, 'Raju', 'arsi', 'NULL', 300.00, '1', '1', '2022-01-11 19:06:27', 'COD'),
(58, 50, 'Raju', 'arsi', 'NULL', 300.00, '1', '1', '2022-01-11 19:15:26', 'COD'),
(59, 52, 'Raju', 'raju', 'NULL', 1350.00, '4', '1', '2022-01-12 17:00:55', 'COD');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `r_name` varchar(255) NOT NULL,
  `r_pic` text NOT NULL,
  `r_id` int(11) NOT NULL,
  `r_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`r_name`, `r_pic`, `r_id`, `r_number`) VALUES
('Raju', 'Food1.jpg', 1, '03326525321'),
('Ayan', 'food3.jpg', 2, '03336164802'),
('Hot & Spicy', 'Food2.jpg', 3, '03321122105'),
('Asrarbucks', 'coffee.jpg', 5, '03336164802');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `u_role` varchar(255) NOT NULL,
  `u_restaurant` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `name`, `username`, `password`, `u_role`, `u_restaurant`) VALUES
(2, 'Arqam Javed', 'arqam', '123', 'customer', NULL),
(5, 'Raju', 'raju', '123', 'owner', 'Raju'),
(6, 'Ayan Garden', 'ayan', '123', 'owner', 'Ayan'),
(11, 'saim', 'saim', '123', 'admin', NULL),
(12, 'ameer hamza', 'hot&spicy', '123', 'owner', 'Hot & Spicy'),
(13, 'Ali', 'ali', '123', 'customer', NULL),
(14, 'Saad Ahmed', 'saad', '123', 'customer', NULL),
(15, 'Ahmed Saim', 'ahmed', '123', 'customer', NULL),
(16, 'Arslan Ashraf', 'arsii', '123', 'customer', NULL),
(17, 'ibraheem', 'ibbi', '123', 'customer', NULL),
(18, 'arsi', 'arsi', '123', 'customer', NULL),
(19, 'eeshan waqar ', 'eeshanwaqar', '1234', 'customer', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`),
  ADD UNIQUE KEY `m_category` (`cat_name`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`i_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`o_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_id` (`order_id`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`r_id`),
  ADD UNIQUE KEY `r_name` (`r_name`),
  ADD KEY `r_id` (`r_name`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `i_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
