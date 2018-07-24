-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2018 at 07:28 AM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dosa`
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
(3, 'abilash', '9999999999', 'abhilash@123.com', 'dsav/p menaria teh vallabhnager  udaipur', '2018-07-03 11:14:23', 1),
(4, 'vikas', '8107555872', 'v95gaur@gmail.com', '77, NORTH AYAD\r\nSUTHARO KA MOHALLA\r\nMEERA COLONY', '2018-07-14 07:03:28', 0);

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
-- Table structure for table `purchase_vouchers`
--

CREATE TABLE `purchase_vouchers` (
  `id` int(11) NOT NULL,
  `voucher_no` int(255) NOT NULL,
  `transaction_date` date NOT NULL,
  `vendor_id` int(50) NOT NULL,
  `grand_total` decimal(15,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_vouchers`
--

INSERT INTO `purchase_vouchers` (`id`, `voucher_no`, `transaction_date`, `vendor_id`, `grand_total`) VALUES
(7, 7, '2018-07-11', 1, '33');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_voucher_rows`
--

CREATE TABLE `purchase_voucher_rows` (
  `id` int(11) NOT NULL,
  `raw_material_id` int(50) NOT NULL,
  `quantity` decimal(8,2) NOT NULL,
  `rate` decimal(15,2) NOT NULL,
  `discount_per` decimal(8,2) NOT NULL,
  `discount_amt` decimal(15,2) NOT NULL,
  `tax_per` decimal(8,2) NOT NULL,
  `tax_amt` decimal(15,2) NOT NULL,
  `round_off` decimal(15,2) NOT NULL,
  `net_amt_total` decimal(15,2) NOT NULL,
  `purchase_voucher_id` int(50) NOT NULL,
  `taxable_value` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `raw_materials`
--

CREATE TABLE `raw_materials` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `tax_id` int(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `raw_materials`
--

INSERT INTO `raw_materials` (`id`, `name`, `tax_id`) VALUES
(1, 'jffojeo', 1),
(2, 'jfjoerijrewl', 1),
(5, 'punjabi Rice ', 1);

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
(1, 'Dsu Menaria', 'Dsu Menaria', '9680747166', 'v/p menaria teh vallabhnager  udaipur', 0),
(2, 'vikas gaur', 'vikas gaur', '8107555872', '77,north Ayed sutharo ka mohaall mera colony', 0);

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
-- Indexes for table `master_offers`
--
ALTER TABLE `master_offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_vouchers`
--
ALTER TABLE `purchase_vouchers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_voucher_rows`
--
ALTER TABLE `purchase_voucher_rows`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `raw_materials`
--
ALTER TABLE `raw_materials`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `master_offers`
--
ALTER TABLE `master_offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchase_vouchers`
--
ALTER TABLE `purchase_vouchers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `purchase_voucher_rows`
--
ALTER TABLE `purchase_voucher_rows`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `raw_materials`
--
ALTER TABLE `raw_materials`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vendor_items`
--
ALTER TABLE `vendor_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
