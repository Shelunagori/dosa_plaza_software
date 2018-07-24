-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2018 at 07:38 AM
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
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id` int(10) NOT NULL,
  `voucher_no` varchar(50) NOT NULL,
  `table_id` int(10) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `tax_id` int(10) NOT NULL,
  `round_off` decimal(5,2) NOT NULL,
  `grand_total` decimal(10,2) NOT NULL,
  `customer_id` int(10) DEFAULT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`id`, `voucher_no`, `table_id`, `total`, `tax_id`, `round_off`, `grand_total`, `customer_id`, `created_on`) VALUES
(1, '1', 1, '700.20', 1, '-0.19', '665.00', NULL, '2018-07-09 12:00:29'),
(2, '2', 2, '319.75', 1, '0.24', '304.00', NULL, '2018-07-09 12:00:29'),
(3, '3', 1, '198.00', 1, '-0.10', '188.00', NULL, '2018-07-09 12:00:29'),
(4, '4', 1, '1218.00', 1, '-0.10', '1157.00', NULL, '2018-07-09 12:00:29'),
(5, '5', 1, '594.00', 1, '-0.30', '564.00', 20, '2018-07-09 12:00:29'),
(6, '6', 1, '287.10', 1, '0.26', '273.00', 20, '2018-07-09 12:00:29'),
(7, '7', 1, '267.30', 1, '0.07', '254.00', 24, '2018-07-09 12:00:29'),
(8, '8', 1, '675.18', 1, '-0.42', '641.00', 20, '2018-07-09 12:00:29'),
(9, '9', 3, '921.24', 1, '-0.18', '875.00', 0, '2018-07-09 12:00:29'),
(10, '10', 14, '350.46', 1, '0.06', '333.00', 27, '2018-07-09 12:00:29'),
(11, '11', 1, '225.72', 1, '-0.43', '214.00', 28, '2018-07-09 12:00:29');

-- --------------------------------------------------------

--
-- Table structure for table `bill_rows`
--

CREATE TABLE `bill_rows` (
  `id` int(10) NOT NULL,
  `bill_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `rate` decimal(10,2) NOT NULL DEFAULT '0.00',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `discount_per` decimal(10,2) DEFAULT '0.00',
  `net_amount` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bill_rows`
--

INSERT INTO `bill_rows` (`id`, `bill_id`, `item_id`, `quantity`, `rate`, `amount`, `discount_per`, `net_amount`) VALUES
(1, 1, 1, '1.00', '99.00', '99.00', NULL, '99.00'),
(2, 1, 2, '1.00', '99.00', '99.00', NULL, '99.00'),
(3, 1, 3, '1.00', '99.00', '99.00', NULL, '99.00'),
(4, 1, 7, '3.60', '112.00', '403.20', NULL, '403.20'),
(5, 2, 2, '1.00', '99.00', '99.00', '10.36', '88.74'),
(6, 2, 3, '1.00', '99.00', '99.00', NULL, '99.00'),
(7, 2, 4, '1.00', '99.00', '99.00', '66.66', '33.01'),
(8, 2, 1, '1.00', '99.00', '99.00', NULL, '99.00'),
(9, 3, 1, '1.00', '99.00', '99.00', NULL, '99.00'),
(10, 3, 2, '1.00', '99.00', '99.00', NULL, '99.00'),
(11, 4, 1, '1.00', '99.00', '99.00', NULL, '99.00'),
(12, 4, 2, '1.00', '99.00', '99.00', NULL, '99.00'),
(13, 4, 3, '1.00', '99.00', '99.00', NULL, '99.00'),
(14, 4, 4, '1.00', '99.00', '99.00', NULL, '99.00'),
(15, 4, 7, '2.00', '112.00', '224.00', NULL, '224.00'),
(16, 4, 8, '2.00', '299.00', '598.00', NULL, '598.00'),
(17, 5, 1, '1.00', '99.00', '99.00', NULL, '99.00'),
(18, 5, 2, '2.00', '99.00', '198.00', NULL, '198.00'),
(19, 5, 3, '2.00', '99.00', '198.00', NULL, '198.00'),
(20, 5, 4, '1.00', '99.00', '99.00', NULL, '99.00'),
(21, 6, 1, '1.00', '99.00', '99.00', '10.00', '89.10'),
(22, 6, 2, '1.00', '99.00', '99.00', NULL, '99.00'),
(23, 6, 3, '1.00', '99.00', '99.00', NULL, '99.00'),
(24, 7, 1, '1.00', '99.00', '99.00', '10.00', '89.10'),
(25, 7, 3, '1.00', '99.00', '99.00', '10.00', '89.10'),
(26, 7, 4, '1.00', '99.00', '99.00', '10.00', '89.10'),
(27, 8, 7, '1.10', '112.00', '123.20', '10.00', '110.88'),
(28, 8, 5, '1.00', '99.00', '99.00', '10.00', '89.10'),
(29, 8, 6, '1.00', '99.00', '99.00', '10.00', '89.10'),
(30, 8, 1, '1.00', '99.00', '99.00', NULL, '99.00'),
(31, 8, 2, '1.00', '99.00', '99.00', NULL, '99.00'),
(32, 8, 3, '1.00', '99.00', '99.00', '10.00', '89.10'),
(33, 8, 4, '1.00', '99.00', '99.00', NULL, '99.00'),
(34, 9, 7, '3.60', '112.00', '403.20', '10.00', '362.88'),
(35, 9, 1, '1.00', '99.00', '99.00', NULL, '99.00'),
(36, 9, 4, '1.00', '99.00', '99.00', '36.00', '63.36'),
(37, 9, 5, '2.00', '99.00', '198.00', NULL, '198.00'),
(38, 9, 6, '2.00', '99.00', '198.00', NULL, '198.00'),
(39, 10, 1, '1.00', '99.00', '99.00', '10.00', '89.10'),
(40, 10, 2, '1.00', '99.00', '99.00', NULL, '99.00'),
(41, 10, 3, '1.00', '99.00', '99.00', '36.00', '63.36'),
(42, 10, 4, '1.00', '99.00', '99.00', NULL, '99.00'),
(43, 11, 1, '1.00', '99.00', '99.00', '36.00', '63.36'),
(44, 11, 2, '1.00', '99.00', '99.00', NULL, '99.00'),
(45, 11, 4, '1.00', '99.00', '99.00', '36.00', '63.36');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` text,
  `mobile_no` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `address`, `mobile_no`) VALUES
(1, 'Abhilash', 'jdbfjksdbgdfgsdfsgsg', '987654321'),
(2, 'Abhilash', 'jdbfjksdbgdfgsdfsgsg', '987654321'),
(3, 'Abhilash', 'jdbfjksdbgdfgsdfsgsg', '987654321'),
(4, 'Abhilash', 'jdbfjksdbgdfgsdfsgsg', '987654321'),
(5, 'sfddf', ' sdfsdf\ndsfdsf', '98765432'),
(6, 'sda', ' dasd', '9876543211'),
(7, 'saasd', ' sadsadas', '9876543'),
(8, 'sdas', ' dsadasd', '987654323'),
(9, 's', ' asdasd', '23434'),
(10, 'asdsa', ' dsad', '5654'),
(11, 'sd', ' asdasd', '345'),
(12, 'sd', ' asdasd', '345'),
(13, 'sad', ' asdasd', '98765432e'),
(14, 'dsfsdf', ' sdfdsf', '54654'),
(15, 'gdfg', 'dfg', '3454'),
(16, 'sfsd', ' fdsf', '657567'),
(17, 'erwe', ' rewre', '43'),
(18, 'weewr', ' werwr', '33'),
(19, 'sdsf', ' sdfsdf', '32423'),
(20, 'Abhilash Lohar', 'Hiran  Mangri\nSec 4 ', '9636653883'),
(21, 'Vivek', 'sosdfsdf adas fs ', '9636653883'),
(22, 'qwe', ' qwe', '9636653883'),
(23, 'Manoj tanwar', '', '1234567890'),
(24, 'Priyanka jingar', 'Hiran mangri \nsec 5', '9694561206'),
(25, 'Gourav parmar', 'qwert sdfsdf dsfsdf\nsadfsdf ds ', '1123456765'),
(26, 'Rahul Jain', 'bla bla bla...', '9785055571'),
(27, 'Test USer', 'wefweg\nwefsdf', '9999999999'),
(28, 'Dashrath Menaria', 'asfsefasda\nfsdfadsfdf\nsfdsf', '9636653888');

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
(4, 2, 'Panjabi Mushroom', '15.50', 1, '2018-06-30 04:11:31', 1, 1);

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
(1, 'American breads', 1),
(2, 'Panjabi Rice', 1),
(3, 'Punjabi Rise', 0),
(4, 'test', 1),
(5, 'American Dasa ', 1),
(6, 'jdfjds', 1);

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
(2, 2, 'Mushrooms', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kots`
--

CREATE TABLE `kots` (
  `id` int(10) NOT NULL,
  `voucher_no` varchar(100) NOT NULL,
  `table_id` int(10) NOT NULL,
  `bill_pending` varchar(10) NOT NULL DEFAULT 'yes',
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bill_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kots`
--

INSERT INTO `kots` (`id`, `voucher_no`, `table_id`, `bill_pending`, `created_on`, `bill_id`) VALUES
(1, '1', 1, 'no', '2018-07-06 10:50:18', 1),
(2, '2', 1, 'no', '2018-07-06 10:50:27', 1),
(3, '3', 2, 'no', '2018-07-06 10:51:04', 2),
(4, '4', 2, 'no', '2018-07-06 10:51:07', 2),
(5, '5', 3, 'no', '2018-07-06 10:52:10', 9),
(6, '6', 1, 'no', '2018-07-06 11:20:54', 3),
(7, '7', 1, 'no', '2018-07-07 05:10:16', 4),
(8, '8', 1, 'no', '2018-07-07 05:17:57', 4),
(9, '9', 1, 'no', '2018-07-07 05:43:51', 5),
(10, '10', 1, 'no', '2018-07-07 05:43:55', 5),
(11, '11', 1, 'no', '2018-07-07 05:57:24', 6),
(12, '12', 1, 'no', '2018-07-07 06:32:34', 7),
(13, '13', 1, 'no', '2018-07-07 07:22:33', 8),
(14, '14', 1, 'no', '2018-07-07 07:38:28', 8),
(15, '15', 1, 'no', '2018-07-07 07:38:34', 8),
(16, '16', 1, 'no', '2018-07-07 12:36:59', 11),
(17, '17', 3, 'no', '2018-07-07 12:40:54', 9),
(18, '18', 3, 'no', '2018-07-07 12:40:59', 9),
(19, '19', 14, 'no', '2018-07-07 12:46:51', 10),
(20, '20', 14, 'no', '2018-07-07 12:46:53', 10);

-- --------------------------------------------------------

--
-- Table structure for table `kot_rows`
--

CREATE TABLE `kot_rows` (
  `id` int(10) NOT NULL,
  `kot_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  `amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kot_rows`
--

INSERT INTO `kot_rows` (`id`, `kot_id`, `item_id`, `quantity`, `rate`, `amount`) VALUES
(1, 1, 1, '1.00', '99.00', '99.00'),
(2, 1, 2, '1.00', '99.00', '99.00'),
(3, 1, 3, '1.00', '99.00', '99.00'),
(4, 2, 7, '3.60', '112.00', '112.00'),
(5, 3, 2, '1.00', '99.00', '99.00'),
(6, 3, 3, '1.00', '99.00', '99.00'),
(7, 4, 4, '1.00', '99.00', '99.00'),
(8, 4, 1, '1.00', '99.00', '99.00'),
(9, 5, 7, '3.60', '112.00', '112.00'),
(10, 6, 1, '1.00', '99.00', '99.00'),
(11, 6, 2, '1.00', '99.00', '99.00'),
(12, 7, 1, '1.00', '99.00', '99.00'),
(13, 7, 2, '1.00', '99.00', '99.00'),
(14, 7, 3, '1.00', '99.00', '99.00'),
(15, 7, 4, '1.00', '99.00', '99.00'),
(16, 7, 7, '1.00', '112.00', '112.00'),
(17, 7, 8, '1.00', '299.00', '299.00'),
(18, 8, 7, '1.00', '112.00', '112.00'),
(19, 8, 8, '1.00', '299.00', '299.00'),
(20, 9, 1, '1.00', '99.00', '99.00'),
(21, 9, 2, '1.00', '99.00', '99.00'),
(22, 9, 3, '1.00', '99.00', '99.00'),
(23, 10, 3, '1.00', '99.00', '99.00'),
(24, 10, 4, '1.00', '99.00', '99.00'),
(25, 10, 2, '1.00', '99.00', '99.00'),
(26, 11, 1, '1.00', '99.00', '99.00'),
(27, 11, 2, '1.00', '99.00', '99.00'),
(28, 11, 3, '1.00', '99.00', '99.00'),
(29, 12, 1, '1.00', '99.00', '99.00'),
(30, 12, 3, '1.00', '99.00', '99.00'),
(31, 12, 4, '1.00', '99.00', '99.00'),
(32, 13, 7, '1.10', '112.00', '112.00'),
(33, 14, 5, '1.00', '99.00', '99.00'),
(34, 14, 6, '1.00', '99.00', '99.00'),
(35, 15, 1, '1.00', '99.00', '99.00'),
(36, 15, 2, '1.00', '99.00', '99.00'),
(37, 15, 3, '1.00', '99.00', '99.00'),
(38, 15, 4, '1.00', '99.00', '99.00'),
(39, 16, 1, '1.00', '99.00', '99.00'),
(40, 16, 2, '1.00', '99.00', '99.00'),
(41, 16, 4, '1.00', '99.00', '99.00'),
(42, 17, 1, '1.00', '99.00', '99.00'),
(43, 17, 4, '1.00', '99.00', '99.00'),
(44, 17, 5, '1.00', '99.00', '99.00'),
(45, 17, 6, '1.00', '99.00', '99.00'),
(46, 18, 5, '1.00', '99.00', '99.00'),
(47, 18, 6, '1.00', '99.00', '99.00'),
(48, 19, 1, '1.00', '99.00', '99.00'),
(49, 19, 2, '1.00', '99.00', '99.00'),
(50, 20, 3, '1.00', '99.00', '99.00'),
(51, 20, 4, '1.00', '99.00', '99.00');

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
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`id`, `name`) VALUES
(1, '101'),
(2, '102'),
(3, '103'),
(4, '104'),
(5, '105'),
(6, '106'),
(7, '107'),
(8, '108'),
(9, '109'),
(10, '110'),
(11, '111'),
(12, '112'),
(13, '113'),
(14, '114');

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `id` int(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `tax_per` decimal(5,2) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `taxes`
--

INSERT INTO `taxes` (`id`, `name`, `tax_per`, `status`) VALUES
(1, '5%', '5.00', 'active');

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
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bill_rows`
--
ALTER TABLE `bill_rows`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
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
-- Indexes for table `kots`
--
ALTER TABLE `kots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kot_rows`
--
ALTER TABLE `kot_rows`
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
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
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
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `bill_rows`
--
ALTER TABLE `bill_rows`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `item_categories`
--
ALTER TABLE `item_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `item_sub_categories`
--
ALTER TABLE `item_sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kots`
--
ALTER TABLE `kots`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `kot_rows`
--
ALTER TABLE `kot_rows`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

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
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
