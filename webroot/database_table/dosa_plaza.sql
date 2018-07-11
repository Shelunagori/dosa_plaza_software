-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2018 at 06:40 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dosa_plaza`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `attendance_status` int(5) NOT NULL COMMENT '1 for Present, 2 for Leave, 3 for HalfDay, 4 Official Off',
  `attendance_date` date NOT NULL,
  `remarks` text NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `employee_id`, `attendance_status`, `attendance_date`, `remarks`, `created_on`) VALUES
(1, 1, 1, '2018-07-03', '1', '2018-07-03 12:09:07'),
(2, 2, 3, '2018-07-03', '2', '2018-07-03 12:09:07'),
(3, 3, 2, '2018-07-03', '3', '2018-07-03 12:09:07'),
(4, 1, 3, '2018-07-04', '', '2018-07-04 04:12:15'),
(5, 2, 1, '2018-07-04', '', '2018-07-04 04:12:15'),
(7, 3, 4, '2018-07-04', '', '2018-07-04 04:42:19');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `mobile_no` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `mobile_no`, `email`, `address`, `created_on`, `is_deleted`) VALUES
(1, 'Dashrath Menaria', '9680747166', 'dasumenaria@gmail.com', 'Test', '2018-07-03 06:51:00', 0),
(2, 'Dsu Menaria', '9680747166', 'dasumenaria1@gmail.com', 'v/p menaria teh vallabhnager  udaipur', '2018-07-03 11:14:01', 0),
(3, 'abilash', '9999999999', 'abhilash@123.com', 'dsav/p menaria teh vallabhnager  udaipur', '2018-07-03 11:14:23', 0);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `item_sub_category_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  `discount_applicable` tinyint(1) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL COMMENT '0 = active, 1 = deleted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `item_sub_category_id`, `name`, `rate`, `discount_applicable`, `created_on`, `created_by`, `is_deleted`) VALUES
(1, 1, 'Dosa bread', '1000.00', 0, '2018-06-29 05:48:44', 1, 0),
(2, 1, 'Pav Bhaji Breads', '20.25', 0, '2018-06-29 05:49:19', 1, 0),
(3, 1, 'Mix Breads', '50.90', 0, '2018-06-29 06:05:06', 1, 0),
(4, 2, 'Panjabi Mushroom', '15.50', 1, '2018-06-30 04:11:31', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `item_categories`
--

CREATE TABLE `item_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = active, 1 = deleted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_categories`
--

INSERT INTO `item_categories` (`id`, `name`, `is_deleted`) VALUES
(1, 'American breads', 0),
(2, 'Panjabi Rice', 0);

-- --------------------------------------------------------

--
-- Table structure for table `item_sub_categories`
--

CREATE TABLE `item_sub_categories` (
  `id` int(11) NOT NULL,
  `item_category_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL COMMENT '0 = active, 1 = deleted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_sub_categories`
--

INSERT INTO `item_sub_categories` (`id`, `item_category_id`, `name`, `is_deleted`) VALUES
(1, 1, 'Sweet Breads', 0),
(2, 2, 'Mushrooms', 0);

-- --------------------------------------------------------

--
-- Table structure for table `master_offers`
--

CREATE TABLE `master_offers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `percentage` decimal(10,2) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL COMMENT '0 = active, 1 = deleted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_offers`
--

INSERT INTO `master_offers` (`id`, `name`, `percentage`, `is_deleted`) VALUES
(1, 'Best Offer', '15.20', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `role`) VALUES
(1, 'Abhilash Lohar', 'admin', '$2y$10$knPwGMrRd0wj13/JHlWOr.CQddABk08iNjXjfA7P5WSfi6BZ6giMK', ''),
(2, 'sdf', 'admin', '$2y$10$WxmIxmYOrWAjzObZTvI9EuzbsKcliecxS/HMCoiUa.lKq8l9pqHxO', ''),
(3, 'adsd', 'admin', '$2y$10$fV9.nrJ01tvWVmbEvZ5p/ugsG60V4CRV3V00BKJPA328B8OoOG.qq', '');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact_person` varchar(50) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `is_deleted` tinyint(1) NOT NULL COMMENT '0 = active, 1 = deleted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `contact_person`, `contact_number`, `address`, `is_deleted`) VALUES
(1, 'Dsu Menaria', 'Dsu Menaria', '9680747166', 'v/p menaria teh vallabhnager  udaipur', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vendor_items`
--

CREATE TABLE `vendor_items` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor_items`
--

INSERT INTO `vendor_items` (`id`, `vendor_id`, `item_id`) VALUES
(6, 1, 1),
(7, 1, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_categories`
--
ALTER TABLE `item_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_sub_categories`
--
ALTER TABLE `item_sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_offers`
--
ALTER TABLE `master_offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor_items`
--
ALTER TABLE `vendor_items`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `item_categories`
--
ALTER TABLE `item_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `item_sub_categories`
--
ALTER TABLE `item_sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `master_offers`
--
ALTER TABLE `master_offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `vendor_items`
--
ALTER TABLE `vendor_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
