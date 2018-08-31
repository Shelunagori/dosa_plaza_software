-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2018 at 01:40 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `attendance_status` int(5) NOT NULL COMMENT '1 Present, 2 Half Day, 3 Absent, 4 Off, 5 full',
  `attendance_date` date NOT NULL,
  `remarks` text NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `employee_id`, `attendance_status`, `attendance_date`, `remarks`, `created_on`) VALUES
(1, 1, 4, '2018-08-16', '', '2018-08-16 09:46:39'),
(2, 2, 5, '2018-08-16', '', '2018-08-16 09:46:39'),
(3, 3, 3, '2018-08-16', '', '2018-08-16 09:46:39'),
(4, 4, 2, '2018-08-16', '', '2018-08-16 09:46:39');

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id` int(10) NOT NULL,
  `transaction_date` date NOT NULL,
  `voucher_no` varchar(50) NOT NULL,
  `table_id` int(10) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `tax_id` int(10) NOT NULL,
  `round_off` decimal(5,2) NOT NULL,
  `grand_total` decimal(10,2) NOT NULL,
  `customer_id` int(10) DEFAULT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_type` varchar(10) NOT NULL,
  `occupied_time` timestamp NULL DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `no_of_pax` int(11) DEFAULT NULL,
  `payment_status` int(10) NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `employee_id` int(10) DEFAULT NULL,
  `offer_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `discount_amount` decimal(10,2) NOT NULL,
  `net_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `tax_per` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) NOT NULL,
  `comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`) VALUES
(1, 'Spicy'),
(2, 'Midum socy'),
(3, 'less oil'),
(4, 'No masrum');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` text,
  `mobile_no` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `anniversary` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `customer_code` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `address`, `mobile_no`, `dob`, `anniversary`, `email`, `customer_code`) VALUES
(1, 'Abhilash Lohar', 'V/P Chawand, Teh- Sarara, Dis- Udaipur, Pin-313904', '9636653883', '1992-05-31', '2018-02-07', 'abhilashlohar01@gmail.com', 2001),
(2, 'Dsu', '', '5555555555', '2000-12-12', '1970-01-01', '', 2002),
(3, 'qwer', 'sadsad', '2222222222', '2018-08-09', '2018-08-02', 'manoj@gmail.com', 2003);

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `name`, `is_deleted`) VALUES
(1, 'Steward', 0);

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
  `is_deleted` tinyint(1) NOT NULL,
  `designation_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `mobile_no`, `email`, `address`, `created_on`, `is_deleted`, `designation_id`) VALUES
(1, 'Ramesh', '', '', '', '2018-08-14 04:08:06', 0, 1),
(2, 'Prakash', '', '', '', '2018-08-14 10:24:01', 0, 1),
(3, 'Manoj', '', '', '', '2018-08-14 10:24:19', 0, 1),
(4, 'Suresh', '', '', '', '2018-08-14 10:24:31', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `item_sub_category_id` int(11) NOT NULL,
  `tax_id` int(5) NOT NULL,
  `name` varchar(100) NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  `discount_applicable` tinyint(1) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `edited_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` tinyint(1) NOT NULL COMMENT '0 = active, 1 = deleted',
  `is_favorite` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `item_sub_category_id`, `tax_id`, `name`, `rate`, `discount_applicable`, `created_on`, `created_by`, `edited_on`, `is_deleted`, `is_favorite`) VALUES
(1, 1, 2, 'garlic roast dosa', '133.00', 1, '2018-08-23 13:06:30', 1, '2018-08-24 06:52:21', 0, 1),
(2, 1, 2, 'salsa lite DOSA', '152.00', 1, '2018-08-23 13:06:51', 1, '2018-08-24 06:53:24', 0, 1),
(3, 1, 2, 'mexican roast DOSA', '152.00', 1, '2018-08-23 13:10:17', 1, '2018-08-24 06:53:27', 0, 1),
(4, 1, 2, 'rocket mysore DOSA', '105.00', 1, '2018-08-23 13:10:35', 1, '2018-08-24 06:53:58', 0, 1),
(5, 1, 2, 'sada dosa', '86.00', 1, '2018-08-23 13:10:52', 1, '2018-08-24 06:52:24', 0, 1),
(6, 1, 2, 'onion sada', '105.00', 1, '2018-08-23 13:11:10', 1, '2018-08-24 06:54:01', 0, 1),
(7, 2, 2, 'prem masala DOSA', '152.00', 1, '2018-08-24 04:25:38', 1, '2018-08-24 06:53:30', 0, 1),
(8, 2, 2, 'mysore masala DOSA', '133.00', 1, '2018-08-24 04:26:28', 1, '2018-08-24 06:53:33', 0, 1),
(9, 2, 2, 'harabhara masala DOSA', '152.00', 1, '2018-08-24 04:26:58', 1, '2018-08-24 06:54:05', 0, 1),
(10, 2, 2, 'maharaja masala DOSA', '152.00', 1, '2018-08-24 04:27:22', 1, '2018-08-24 06:53:36', 0, 1),
(11, 2, 2, 'masala DOSA', '105.00', 1, '2018-08-24 04:27:41', 1, '2018-08-24 06:54:08', 0, 1),
(12, 2, 2, 'navratna masala DOSA', '152.00', 1, '2018-08-24 04:27:57', 1, '2018-08-24 06:53:40', 0, 1),
(13, 2, 2, 'onion masala DOSA', '124.00', 1, '2018-08-24 04:28:12', 1, '2018-08-24 06:54:13', 0, 1),
(14, 3, 2, 'paneer schezwan DOSA', '229.00', 1, '2018-08-24 04:29:09', 1, '2018-08-24 06:54:18', 0, 1),
(15, 3, 2, 'paneer crispy DOSA', '267.00', 1, '2018-08-24 04:29:29', 1, '0000-00-00 00:00:00', 0, 0),
(16, 3, 2, 'paneer chilly DOSA', '209.00', 1, '2018-08-24 04:29:44', 1, '2018-08-24 06:52:27', 0, 1),
(17, 3, 2, 'paneer american delight DOSA', '267.00', 1, '2018-08-24 04:29:58', 1, '0000-00-00 00:00:00', 0, 0),
(18, 3, 2, 'paneer spring roll DOSA', '209.00', 1, '2018-08-24 04:30:54', 1, '0000-00-00 00:00:00', 0, 0),
(19, 3, 2, 'paneer chinese delight DOSA', '219.00', 1, '2018-08-24 04:31:10', 1, '0000-00-00 00:00:00', 0, 0),
(20, 3, 2, 'paneer american chopsuey DOSA', '200.00', 1, '2018-08-24 04:31:47', 1, '2018-08-24 06:54:27', 0, 1),
(21, 3, 2, 'paneer salad roast DOSA', '257.00', 1, '2018-08-24 04:32:01', 1, '0000-00-00 00:00:00', 0, 0),
(22, 24, 2, 'SPICY VEGGIE', '190.00', 1, '2018-08-24 04:32:38', 1, '0000-00-00 00:00:00', 0, 0),
(23, 24, 2, 'TABASCO PIZZA', '190.00', 1, '2018-08-24 04:33:06', 1, '0000-00-00 00:00:00', 0, 0),
(24, 24, 2, 'FIERY PERI PERI', '257.00', 1, '2018-08-24 04:33:21', 1, '0000-00-00 00:00:00', 0, 0),
(25, 24, 2, 'ANGRY PANEER', '257.00', 1, '2018-08-24 04:33:35', 1, '0000-00-00 00:00:00', 0, 0),
(26, 24, 2, 'MARGHERITA WITH BASIL', '171.00', 1, '2018-08-24 04:33:49', 1, '2018-08-24 07:01:24', 0, 1),
(27, 24, 2, 'TANDOORI PANEER', '219.00', 1, '2018-08-24 04:34:08', 1, '0000-00-00 00:00:00', 0, 0),
(28, 24, 2, 'MUSHROOMS AND OLIVES', '219.00', 1, '2018-08-24 04:34:24', 1, '2018-08-24 06:54:22', 0, 1),
(29, 24, 2, 'GRILLED ZUCCHINI', '229.00', 1, '2018-08-24 04:34:38', 1, '0000-00-00 00:00:00', 0, 0),
(30, 24, 2, 'SICILIAN', '285.00', 1, '2018-08-24 04:34:52', 1, '0000-00-00 00:00:00', 0, 0),
(31, 24, 2, 'SUN KISSED', '248.00', 1, '2018-08-24 04:35:04', 1, '0000-00-00 00:00:00', 0, 0),
(32, 24, 2, 'VEG GARDEN', '257.00', 1, '2018-08-24 04:35:14', 1, '0000-00-00 00:00:00', 0, 0),
(33, 24, 2, 'CHEESE BLAST', '295.00', 1, '2018-08-24 04:35:27', 1, '0000-00-00 00:00:00', 0, 0),
(34, 24, 2, 'LATINO GARDEN', '295.00', 1, '2018-08-24 04:35:38', 1, '0000-00-00 00:00:00', 0, 0),
(35, 24, 2, 'BABYCORNS AND JALAPENO', '219.00', 1, '2018-08-24 04:35:49', 1, '0000-00-00 00:00:00', 0, 0),
(36, 24, 2, 'VEGGIE CLASSIC', '133.00', 1, '2018-08-24 04:36:01', 1, '0000-00-00 00:00:00', 0, 0),
(37, 24, 2, 'VEGGIE MAMBA', '181.00', 1, '2018-08-24 04:36:14', 1, '2018-08-24 06:54:32', 0, 1),
(38, 4, 2, 'tom chi DOSA', '209.00', 1, '2018-08-24 04:44:20', 1, '0000-00-00 00:00:00', 0, 0),
(39, 4, 2, 'american delight DOSA', '238.00', 1, '2018-08-24 04:44:37', 1, '0000-00-00 00:00:00', 0, 0),
(40, 4, 2, 'mexi roll DOSA', '248.00', 1, '2018-08-24 04:44:57', 1, '2018-08-24 06:54:36', 0, 1),
(41, 4, 2, 'spring roll DOSA', '171.00', 1, '2018-08-24 04:45:13', 1, '0000-00-00 00:00:00', 0, 0),
(42, 4, 2, 'salad roast DOSA', '229.00', 1, '2018-08-24 04:45:34', 1, '2018-08-24 06:54:50', 0, 1),
(43, 5, 2, 'schezwan DOSA', '200.00', 1, '2018-08-24 04:46:01', 1, '2018-08-24 06:52:42', 0, 1),
(44, 5, 2, 'mushroom schezwan DOSA', '229.00', 1, '2018-08-24 04:46:22', 1, '0000-00-00 00:00:00', 0, 0),
(45, 5, 2, 'american chopsuey DOSA', '171.00', 1, '2018-08-24 04:46:36', 1, '2018-08-24 06:54:46', 0, 1),
(46, 5, 2, 'salsa noodles DOSA', '190.00', 1, '2018-08-24 04:46:56', 1, '0000-00-00 00:00:00', 0, 0),
(47, 5, 2, 'sizz lee noodles DOSA', '190.00', 1, '2018-08-24 04:47:17', 1, '2018-08-24 06:53:06', 0, 1),
(48, 5, 2, 'mushroom chopsuey DOSA', '209.00', 1, '2018-08-24 04:47:30', 1, '2018-08-24 07:01:28', 0, 1),
(49, 5, 2, 'chinese delight DOSA', '181.00', 1, '2018-08-24 04:47:45', 1, '0000-00-00 00:00:00', 0, 0),
(50, 6, 2, 'tom chi uttapam', '162.00', 1, '2018-08-24 04:48:11', 1, '0000-00-00 00:00:00', 0, 0),
(51, 6, 2, 'onion delight UTTAPAM', '162.00', 1, '2018-08-24 04:48:27', 1, '2018-08-24 06:55:09', 0, 1),
(52, 6, 2, 'hot garlic mexican  UTTAPAM', '162.00', 1, '2018-08-24 04:48:42', 1, '0000-00-00 00:00:00', 0, 0),
(53, 6, 2, 'chilly delight UTTAPAM', '162.00', 1, '2018-08-24 04:48:56', 1, '2018-08-24 06:54:54', 0, 1),
(54, 6, 2, 'spl prem UTTAPAM', '171.00', 1, '2018-08-24 04:49:10', 1, '2018-08-24 06:54:42', 0, 1),
(55, 6, 2, 'spl spicy UTTAPAM', '181.00', 1, '2018-08-24 04:49:22', 1, '0000-00-00 00:00:00', 0, 0),
(56, 6, 2, 'spl paneer spicy UTTAPAM', '219.00', 1, '2018-08-24 04:49:35', 1, '0000-00-00 00:00:00', 0, 0),
(57, 6, 2, 'sandwich UTTAPAM', '200.00', 1, '2018-08-24 04:49:53', 1, '0000-00-00 00:00:00', 0, 0),
(58, 7, 2, 'mysore UTTAPAM', '152.00', 1, '2018-08-24 04:52:20', 1, '2018-08-24 06:55:04', 0, 1),
(59, 7, 2, 'mix veg UTTAPAM', '171.00', 1, '2018-08-24 04:52:38', 1, '0000-00-00 00:00:00', 0, 0),
(60, 7, 2, 'plain uttapam', '85.00', 1, '2018-08-24 04:52:53', 1, '0000-00-00 00:00:00', 0, 0),
(61, 7, 2, 'mini uttapam', '105.00', 1, '2018-08-24 04:53:41', 1, '2018-08-24 06:54:59', 0, 1),
(62, 7, 2, 'onion uttapam', '133.00', 1, '2018-08-24 04:53:57', 1, '2018-08-24 06:52:47', 0, 1),
(63, 7, 2, 'tomato uttapam', '133.00', 1, '2018-08-24 04:54:23', 1, '0000-00-00 00:00:00', 0, 0),
(64, 7, 2, 'onion tomato uttapam', '162.00', 1, '2018-08-24 04:54:35', 1, '2018-08-24 07:01:33', 0, 1),
(65, 8, 2, 'chetinaad Biryani', '238.00', 1, '2018-08-24 04:55:05', 1, '0000-00-00 00:00:00', 0, 0),
(66, 8, 2, 'samber rice', '162.00', 1, '2018-08-24 04:55:20', 1, '0000-00-00 00:00:00', 0, 0),
(67, 8, 2, 'tamrind rice ( imli rice )', '171.00', 1, '2018-08-24 04:55:32', 1, '0000-00-00 00:00:00', 0, 0),
(68, 8, 2, 'tomato rice', '171.00', 1, '2018-08-24 04:55:45', 1, '0000-00-00 00:00:00', 0, 0),
(69, 8, 2, 'lemon rice', '171.00', 1, '2018-08-24 04:55:58', 1, '0000-00-00 00:00:00', 0, 0),
(70, 8, 2, 'dahi ( curd ) rice', '171.00', 1, '2018-08-24 04:56:14', 1, '2018-08-24 06:55:15', 0, 1),
(71, 9, 2, 'chennai idli 8 pcs', '95.00', 1, '2018-08-24 04:56:37', 1, '0000-00-00 00:00:00', 0, 0),
(72, 9, 2, 'spl mini idli  12 pce', '114.00', 1, '2018-08-24 04:56:52', 1, '0000-00-00 00:00:00', 0, 0),
(73, 9, 2, '14 ghee idli   14 pcs', '133.00', 1, '2018-08-24 04:57:12', 1, '0000-00-00 00:00:00', 0, 0),
(74, 9, 2, 'rasam idli     8 pcs', '104.00', 1, '2018-08-24 04:57:27', 1, '0000-00-00 00:00:00', 0, 0),
(75, 9, 2, 'butter idli     12 pcs', '124.00', 1, '2018-08-24 04:57:47', 1, '0000-00-00 00:00:00', 0, 0),
(76, 10, 2, 'idli manchurian', '171.00', 1, '2018-08-24 04:58:36', 1, '2018-08-24 06:52:54', 0, 1),
(77, 10, 2, 'idli cheese manchurian', '190.00', 1, '2018-08-24 04:58:49', 1, '0000-00-00 00:00:00', 0, 0),
(78, 10, 2, 'idli cheese schezwan', '190.00', 1, '2018-08-24 04:59:01', 1, '0000-00-00 00:00:00', 0, 0),
(79, 11, 2, 'medu wada 2 pcs', '114.00', 1, '2018-08-24 04:59:25', 1, '0000-00-00 00:00:00', 0, 0),
(80, 11, 2, 'mini medu wada 6 pcs', '124.00', 1, '2018-08-24 04:59:38', 1, '0000-00-00 00:00:00', 0, 0),
(81, 11, 2, 'rasam wada 4 pcs', '114.00', 1, '2018-08-24 04:59:53', 1, '0000-00-00 00:00:00', 0, 0),
(82, 11, 2, 'mysore wada 4 pcs', '133.00', 1, '2018-08-24 05:00:05', 1, '0000-00-00 00:00:00', 0, 0),
(83, 11, 2, 'samber wada 4 pcs', '114.00', 1, '2018-08-24 05:00:17', 1, '0000-00-00 00:00:00', 0, 0),
(84, 12, 2, 'butter pav bhaji', '114.00', 1, '2018-08-24 05:00:50', 1, '0000-00-00 00:00:00', 0, 0),
(85, 12, 2, 'cheese pav bhaji', '143.00', 1, '2018-08-24 05:01:04', 1, '0000-00-00 00:00:00', 0, 0),
(86, 12, 2, 'extra pav', '29.00', 1, '2018-08-24 05:01:17', 1, '0000-00-00 00:00:00', 0, 0),
(87, 12, 2, 'cheese masala pav', '57.00', 1, '2018-08-24 05:01:34', 1, '0000-00-00 00:00:00', 0, 0),
(88, 13, 2, 'tomato soup', '105.00', 1, '2018-08-24 05:02:06', 1, '0000-00-00 00:00:00', 0, 0),
(89, 13, 2, 'veg clear soup', '105.00', 1, '2018-08-24 05:02:22', 1, '0000-00-00 00:00:00', 0, 0),
(90, 13, 2, 'sweet corn soup', '105.00', 1, '2018-08-24 05:02:35', 1, '2018-08-24 07:01:39', 0, 1),
(91, 13, 2, 'manchow soup', '105.00', 1, '2018-08-24 05:02:46', 1, '0000-00-00 00:00:00', 0, 0),
(92, 13, 2, 'hot n sour soup', '105.00', 1, '2018-08-24 05:02:57', 1, '0000-00-00 00:00:00', 0, 0),
(93, 14, 2, 'french fries', '95.00', 1, '2018-08-24 05:03:17', 1, '0000-00-00 00:00:00', 0, 0),
(94, 14, 2, 'chinese bhel', '143.00', 1, '2018-08-24 05:03:33', 1, '0000-00-00 00:00:00', 0, 0),
(95, 14, 2, 'aloo 65', '152.00', 1, '2018-08-24 05:03:46', 1, '0000-00-00 00:00:00', 0, 0),
(96, 14, 2, 'crispy fried baby corn', '162.00', 1, '2018-08-24 05:04:00', 1, '0000-00-00 00:00:00', 0, 0),
(97, 14, 2, 'veg spring roll', '162.00', 1, '2018-08-24 05:04:12', 1, '0000-00-00 00:00:00', 0, 0),
(98, 14, 2, 'veg manchurian dry', '162.00', 1, '2018-08-24 05:04:22', 1, '0000-00-00 00:00:00', 0, 0),
(99, 14, 2, 'veg crispy', '162.00', 1, '2018-08-24 05:04:34', 1, '0000-00-00 00:00:00', 0, 0),
(100, 14, 2, 'honey chilli patato', '190.00', 1, '2018-08-24 05:04:44', 1, '0000-00-00 00:00:00', 0, 0),
(101, 14, 2, 'veg manchurian gravy', '181.00', 1, '2018-08-24 05:04:56', 1, '0000-00-00 00:00:00', 0, 0),
(102, 14, 2, 'veg manchurian gravy', '181.00', 1, '2018-08-24 05:04:56', 1, '0000-00-00 00:00:00', 0, 0),
(103, 15, 2, 'paneer 65', '190.00', 1, '2018-08-24 05:05:21', 1, '0000-00-00 00:00:00', 0, 0),
(104, 15, 2, 'panee chilly dry', '181.00', 1, '2018-08-24 05:05:32', 1, '0000-00-00 00:00:00', 0, 0),
(105, 15, 2, 'thread paneer', '210.00', 1, '2018-08-24 05:05:45', 1, '0000-00-00 00:00:00', 0, 0),
(106, 15, 2, 'paneer chilli gravy', '200.00', 1, '2018-08-24 05:05:56', 1, '2018-08-24 06:53:01', 0, 1),
(107, 15, 2, 'paneer hot garlic gravy', '200.00', 1, '2018-08-24 05:06:08', 1, '0000-00-00 00:00:00', 0, 0),
(108, 16, 2, 'veg hakka noodles', '152.00', 1, '2018-08-24 05:06:48', 1, '0000-00-00 00:00:00', 0, 0),
(109, 16, 2, 'tom chi noodles', '162.00', 1, '2018-08-24 05:07:00', 1, '0000-00-00 00:00:00', 0, 0),
(110, 16, 2, 'chilly garlic noodles', '171.00', 1, '2018-08-24 05:07:12', 1, '0000-00-00 00:00:00', 0, 0),
(111, 16, 2, 'veg schezwan noodles', '181.00', 1, '2018-08-24 05:07:24', 1, '0000-00-00 00:00:00', 0, 0),
(112, 16, 2, 'veg chinese chopsuey', '190.00', 1, '2018-08-24 05:07:40', 1, '0000-00-00 00:00:00', 0, 0),
(113, 17, 2, 'veg triple schezwan fried rice', '219.00', 1, '2018-08-24 05:08:48', 1, '0000-00-00 00:00:00', 0, 0),
(114, 17, 2, 'schezwan fried rice', '181.00', 1, '2018-08-24 05:09:01', 1, '0000-00-00 00:00:00', 0, 0),
(115, 17, 2, 'veg fried rice', '162.00', 1, '2018-08-24 05:09:14', 1, '0000-00-00 00:00:00', 0, 0),
(116, 17, 2, 'mushroom fried rice', '200.00', 1, '2018-08-24 05:09:28', 1, '0000-00-00 00:00:00', 0, 0),
(117, 18, 2, 'schezwan sizzler', '333.00', 1, '2018-08-24 05:09:48', 1, '0000-00-00 00:00:00', 0, 0),
(118, 18, 2, 'veg sizzler', '295.00', 1, '2018-08-24 05:10:02', 1, '0000-00-00 00:00:00', 0, 0),
(119, 19, 2, 'mojito', '181.00', 1, '2018-08-24 05:12:17', 1, '0000-00-00 00:00:00', 0, 0),
(120, 19, 2, 'lemoni', '143.00', 1, '2018-08-24 05:12:29', 1, '0000-00-00 00:00:00', 0, 0),
(121, 19, 2, 'cool sky', '143.00', 1, '2018-08-24 05:12:40', 1, '0000-00-00 00:00:00', 0, 0),
(122, 19, 2, 'irish bery', '143.00', 1, '2018-08-24 05:12:52', 1, '0000-00-00 00:00:00', 0, 0),
(123, 19, 2, 'fresh lime soda', '67.00', 1, '2018-08-24 05:13:04', 1, '0000-00-00 00:00:00', 0, 0),
(124, 20, 2, 'vanilla shake', '105.00', 1, '2018-08-24 05:13:21', 1, '0000-00-00 00:00:00', 0, 0),
(125, 20, 2, 'strawberry shake', '114.00', 1, '2018-08-24 05:13:32', 1, '0000-00-00 00:00:00', 0, 0),
(126, 20, 2, 'chocolate shake', '114.00', 1, '2018-08-24 05:13:45', 1, '0000-00-00 00:00:00', 0, 0),
(127, 20, 2, 'orio milkshake', '124.00', 1, '2018-08-24 05:14:26', 1, '0000-00-00 00:00:00', 0, 0),
(128, 20, 2, 'coldcoffee', '105.00', 1, '2018-08-24 05:14:46', 1, '0000-00-00 00:00:00', 0, 0),
(129, 20, 2, 'coldcoffee with icecream', '124.00', 1, '2018-08-24 05:14:59', 1, '0000-00-00 00:00:00', 0, 0),
(130, 20, 2, 'mocha cold coffee ', '143.00', 1, '2018-08-24 05:15:10', 1, '0000-00-00 00:00:00', 0, 0),
(131, 20, 2, 'popcorn cold coffee', '143.00', 1, '2018-08-24 05:15:25', 1, '0000-00-00 00:00:00', 0, 0),
(132, 20, 2, 'hazelnut cold coffee', '143.00', 1, '2018-08-24 05:15:38', 1, '0000-00-00 00:00:00', 0, 0),
(133, 20, 2, 'mango cheesecake shake', '143.00', 1, '2018-08-24 05:15:55', 1, '2018-08-24 06:53:15', 0, 1),
(134, 20, 2, 'bubblegum shake', '143.00', 1, '2018-08-24 05:16:07', 1, '0000-00-00 00:00:00', 0, 0),
(135, 20, 2, 'tea ', '38.00', 1, '2018-08-24 05:16:20', 1, '0000-00-00 00:00:00', 0, 0),
(136, 20, 2, 'filter coffee', '57.00', 1, '2018-08-24 05:16:34', 1, '0000-00-00 00:00:00', 0, 0),
(137, 21, 2, 'thumsup', '29.00', 1, '2018-08-24 05:16:54', 1, '2018-08-24 06:53:21', 0, 1),
(138, 21, 2, 'coke', '29.00', 1, '2018-08-24 05:17:04', 1, '0000-00-00 00:00:00', 0, 0),
(139, 21, 2, 'limca', '29.00', 1, '2018-08-24 05:17:18', 1, '0000-00-00 00:00:00', 0, 0),
(140, 21, 2, 'fanta', '29.00', 1, '2018-08-24 05:17:30', 1, '0000-00-00 00:00:00', 0, 0),
(141, 21, 2, 'sprite', '29.00', 1, '2018-08-24 05:17:40', 1, '0000-00-00 00:00:00', 0, 0),
(142, 21, 2, 'mazza', '29.00', 1, '2018-08-24 05:17:52', 1, '0000-00-00 00:00:00', 0, 0),
(143, 22, 2, 'mineral water', '19.00', 0, '2018-08-24 05:18:26', 1, '2018-08-24 06:53:11', 0, 1),
(144, 22, 2, 'fresh lime water', '47.00', 1, '2018-08-24 05:18:44', 1, '0000-00-00 00:00:00', 0, 0),
(145, 23, 2, 'dahi wada', '133.00', 1, '2018-08-24 05:19:06', 1, '0000-00-00 00:00:00', 0, 0),
(146, 23, 2, 'butter milk', '47.00', 1, '2018-08-24 05:19:21', 1, '0000-00-00 00:00:00', 0, 0),
(147, 23, 2, 'lassi', '57.00', 1, '2018-08-24 05:19:35', 1, '0000-00-00 00:00:00', 0, 0);

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
(1, 'DOSA', 0),
(2, 'UTTAPAM', 0),
(3, 'RICE', 0),
(4, 'IDLI', 0),
(5, 'WADA', 0),
(6, 'MUMBAI PAV BHAJI', 0),
(7, 'CHINESE', 0),
(8, 'BEVERAGE', 0),
(9, 'PIZZA', 0);

-- --------------------------------------------------------

--
-- Table structure for table `item_rows`
--

CREATE TABLE `item_rows` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `raw_material_id` int(11) NOT NULL,
  `quantity` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_rows`
--

INSERT INTO `item_rows` (`id`, `item_id`, `raw_material_id`, `quantity`) VALUES
(1, 1, 1, '0.00'),
(2, 2, 1, '0.00'),
(3, 3, 1, '0.00'),
(4, 4, 1, '0.00'),
(5, 5, 1, '0.00'),
(6, 6, 1, '0.00'),
(7, 7, 1, '0.00'),
(8, 8, 1, '0.00'),
(9, 9, 1, '0.00'),
(10, 10, 1, '0.00'),
(11, 11, 1, '0.00'),
(12, 12, 1, '0.00'),
(13, 13, 1, '0.00'),
(14, 14, 1, '0.00'),
(15, 15, 1, '0.00'),
(16, 16, 1, '0.00'),
(17, 17, 1, '0.00'),
(18, 18, 1, '0.00'),
(19, 19, 1, '0.00'),
(20, 20, 1, '0.00'),
(21, 21, 1, '0.00'),
(22, 22, 1, '0.00'),
(23, 23, 1, '0.00'),
(24, 24, 1, '0.00'),
(25, 25, 1, '0.00'),
(26, 26, 1, '0.00'),
(27, 27, 1, '0.00'),
(28, 28, 1, '0.00'),
(29, 29, 1, '0.00'),
(30, 30, 1, '0.00'),
(31, 31, 1, '0.00'),
(32, 32, 1, '0.00'),
(33, 33, 1, '0.00'),
(34, 34, 1, '0.00'),
(35, 35, 1, '0.00'),
(36, 36, 1, '0.00'),
(37, 37, 1, '0.00'),
(38, 38, 1, '0.00'),
(39, 39, 1, '0.00'),
(40, 40, 1, '0.00'),
(41, 41, 1, '0.00'),
(42, 42, 1, '0.00'),
(43, 43, 1, '0.00'),
(44, 44, 1, '0.00'),
(45, 45, 1, '0.00'),
(46, 46, 1, '0.00'),
(47, 47, 1, '0.00'),
(48, 48, 1, '0.00'),
(49, 49, 1, '0.00'),
(50, 50, 1, '0.00'),
(51, 51, 1, '0.00'),
(52, 52, 1, '0.00'),
(53, 53, 1, '0.00'),
(54, 54, 1, '0.00'),
(55, 55, 1, '0.00'),
(56, 56, 1, '0.00'),
(57, 57, 1, '0.00'),
(58, 58, 1, '0.00'),
(59, 59, 1, '0.00'),
(61, 60, 1, '0.00'),
(62, 61, 1, '0.00'),
(63, 62, 1, '0.00'),
(64, 63, 1, '0.00'),
(65, 64, 1, '0.00'),
(66, 65, 1, '0.00'),
(67, 66, 1, '0.00'),
(68, 67, 1, '0.00'),
(69, 68, 1, '0.00'),
(70, 69, 1, '0.00'),
(71, 70, 1, '0.00'),
(72, 71, 1, '0.00'),
(73, 72, 1, '0.00'),
(74, 73, 1, '0.00'),
(75, 74, 1, '0.00'),
(76, 75, 1, '0.00'),
(77, 76, 1, '0.00'),
(78, 77, 1, '0.00'),
(79, 78, 1, '0.00'),
(80, 79, 1, '0.00'),
(81, 80, 1, '0.00'),
(82, 81, 1, '0.00'),
(83, 82, 1, '0.00'),
(84, 83, 1, '0.00'),
(85, 84, 1, '0.00'),
(86, 85, 1, '0.00'),
(87, 86, 1, '0.00'),
(88, 87, 1, '0.00'),
(89, 88, 1, '0.00'),
(90, 89, 1, '0.00'),
(91, 90, 1, '0.00'),
(92, 91, 1, '0.00'),
(93, 92, 1, '0.00'),
(94, 93, 1, '0.00'),
(95, 94, 1, '0.00'),
(96, 95, 1, '0.00'),
(97, 96, 1, '0.00'),
(98, 97, 1, '0.00'),
(99, 98, 1, '0.00'),
(100, 99, 1, '0.00'),
(101, 100, 1, '0.00'),
(102, 101, 1, '0.00'),
(103, 102, 1, '0.00'),
(104, 103, 1, '0.00'),
(105, 104, 1, '0.00'),
(106, 105, 1, '0.00'),
(107, 106, 1, '0.00'),
(108, 107, 1, '0.00'),
(109, 108, 1, '0.00'),
(110, 109, 1, '0.00'),
(111, 110, 1, '0.00'),
(112, 111, 1, '0.00'),
(113, 112, 1, '0.00'),
(114, 113, 1, '0.00'),
(115, 114, 1, '0.00'),
(116, 115, 1, '0.00'),
(117, 116, 1, '0.00'),
(118, 117, 1, '0.00'),
(119, 118, 1, '0.00'),
(120, 119, 1, '0.00'),
(121, 120, 1, '0.00'),
(122, 121, 1, '0.00'),
(123, 122, 1, '0.00'),
(124, 123, 1, '0.00'),
(125, 124, 1, '0.00'),
(126, 125, 1, '0.00'),
(127, 126, 1, '0.00'),
(128, 127, 1, '0.00'),
(129, 128, 1, '0.00'),
(130, 129, 1, '0.00'),
(131, 130, 1, '0.00'),
(132, 131, 1, '0.00'),
(133, 132, 1, '0.00'),
(134, 133, 1, '0.00'),
(135, 134, 1, '0.00'),
(136, 135, 1, '0.00'),
(137, 136, 1, '0.00'),
(138, 137, 1, '0.00'),
(139, 138, 1, '0.00'),
(140, 139, 1, '0.00'),
(141, 140, 1, '0.00'),
(142, 141, 1, '0.00'),
(143, 142, 1, '0.00'),
(144, 143, 1, '0.00'),
(145, 144, 1, '0.00'),
(146, 145, 1, '0.00'),
(147, 146, 1, '0.00'),
(148, 147, 1, '0.00');

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
(1, 1, 'sada /thin n crispy', 0),
(2, 1, 'masala', 0),
(3, 1, 'paneer', 0),
(4, 1, 'vegitable', 0),
(5, 1, 'noodles', 0),
(6, 2, 'Special Uttapam', 0),
(7, 2, 'Healthy Uttapam', 0),
(8, 3, 'southindian rice', 0),
(9, 4, 'south indian idli', 0),
(10, 4, 'chinese idli', 0),
(11, 5, 'south india wada', 0),
(12, 6, 'pav bhaji', 0),
(13, 7, 'soup', 0),
(14, 7, 'starters', 0),
(15, 7, 'paneer ', 0),
(16, 7, 'noodles', 0),
(17, 7, 'chinese rice', 0),
(18, 7, 'sizzlers', 0),
(19, 8, 'soda', 0),
(20, 8, 'milk', 0),
(21, 8, 'soft drink', 0),
(22, 8, 'water', 0),
(23, 8, 'dahi', 0),
(24, 9, 'WOOD FIRED PIZZA', 0);

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
  `bill_id` int(10) DEFAULT NULL,
  `one_comment` text NOT NULL,
  `order_type` varchar(20) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `delete_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kots`
--

INSERT INTO `kots` (`id`, `voucher_no`, `table_id`, `bill_pending`, `created_on`, `bill_id`, `one_comment`, `order_type`, `is_deleted`, `delete_time`) VALUES
(1, '1', 1, 'yes', '2018-08-24 12:04:14', NULL, 'Spicy, Midum socy, less oil, No masrum', 'dinner', 0, NULL),
(2, '2', 1, 'yes', '2018-08-24 12:12:43', NULL, 'Spicy, Midum socy, less oil, No masrum', 'dinner', 0, NULL),
(3, '3', 1, 'yes', '2018-08-24 12:15:14', NULL, 'Spicy, Midum socy, less oil, No masrum', 'dinner', 0, NULL),
(4, '4', 0, 'yes', '2018-08-24 12:33:02', NULL, '', 'delivery', 0, NULL);

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
  `amount` decimal(10,2) NOT NULL,
  `item_comment` text NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `delete_time` timestamp NULL DEFAULT NULL,
  `delete_comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kot_rows`
--

INSERT INTO `kot_rows` (`id`, `kot_id`, `item_id`, `quantity`, `rate`, `amount`, `item_comment`, `is_deleted`, `delete_time`, `delete_comment`) VALUES
(1, 1, 1, '1.00', '133.00', '133.00', 'less oil, No masrum', 0, NULL, ''),
(2, 1, 2, '1.00', '152.00', '152.00', 'Midum socy, less oil', 0, NULL, ''),
(3, 1, 45, '1.00', '171.00', '171.00', 'No masrum,dfgdfg\ndfgfdg\ndfgdfg', 0, NULL, ''),
(4, 2, 1, '1.00', '133.00', '133.00', 'Spicy', 0, NULL, ''),
(5, 2, 2, '1.00', '152.00', '152.00', 'less oil', 0, NULL, ''),
(6, 2, 4, '1.00', '105.00', '105.00', 'No masrum', 0, NULL, ''),
(7, 3, 2, '1.00', '152.00', '152.00', 'No masrum, less oil', 0, NULL, ''),
(8, 3, 3, '1.00', '152.00', '152.00', 'No masrum', 0, NULL, ''),
(9, 4, 2, '1.00', '152.00', '152.00', '', 0, NULL, ''),
(10, 4, 3, '1.00', '152.00', '152.00', '', 0, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `offer_codes`
--

CREATE TABLE `offer_codes` (
  `id` int(10) NOT NULL,
  `offer_name` varchar(100) NOT NULL,
  `offer_code` varchar(100) NOT NULL,
  `is_enabled` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=enabled, 0=disabled',
  `discount_per` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `offer_codes`
--

INSERT INTO `offer_codes` (`id`, `offer_name`, `offer_code`, `is_enabled`, `discount_per`) VALUES
(1, 'Bumper Offer', 'BUMP1234', 0, '44.00'),
(2, 'asd', 'sadsa234', 1, '99.99'),
(3, 'Rakhi offer', 'RAKHI25', 1, '99.99'),
(4, 'dsf', 'asd sadsadsadsad as ad3432 234', 0, '3.00');

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
(1, 1, '2018-08-21', 1, '2500');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_voucher_rows`
--

CREATE TABLE `purchase_voucher_rows` (
  `id` int(11) NOT NULL,
  `raw_material_id` int(50) NOT NULL,
  `quantity` decimal(8,2) DEFAULT NULL,
  `rate` decimal(15,2) DEFAULT NULL,
  `discount_per` decimal(8,2) DEFAULT NULL,
  `discount_amt` decimal(15,2) DEFAULT NULL,
  `tax_per` decimal(8,2) DEFAULT NULL,
  `tax_amt` decimal(15,2) DEFAULT NULL,
  `round_off` decimal(15,2) DEFAULT NULL,
  `net_amt_total` decimal(15,2) DEFAULT NULL,
  `purchase_voucher_id` int(50) NOT NULL,
  `taxable_value` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_voucher_rows`
--

INSERT INTO `purchase_voucher_rows` (`id`, `raw_material_id`, `quantity`, `rate`, `discount_per`, `discount_amt`, `tax_per`, `tax_amt`, `round_off`, `net_amt_total`, `purchase_voucher_id`, `taxable_value`) VALUES
(1, 1, '10.00', '95.24', NULL, NULL, '5.00', '47.62', '-0.02', '1000.00', 1, '952.40'),
(2, 2, '10.00', '150.00', NULL, NULL, '0.00', '0.00', NULL, '1500.00', 1, '1500.00');

-- --------------------------------------------------------

--
-- Table structure for table `raw_materials`
--

CREATE TABLE `raw_materials` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `tax_id` int(22) NOT NULL,
  `primary_unit_id` int(11) NOT NULL COMMENT 'Unit Conversion Id',
  `has_secondary_unit` tinyint(1) NOT NULL COMMENT '1 for yes, 0 for not',
  `secondary_unit_id` int(11) NOT NULL COMMENT 'Unit Conversion Id',
  `formula` decimal(10,2) NOT NULL,
  `purchase_voucher_unit_type` varchar(20) NOT NULL,
  `recipe_unit_type` varchar(20) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `raw_materials`
--

INSERT INTO `raw_materials` (`id`, `name`, `tax_id`, `primary_unit_id`, `has_secondary_unit`, `secondary_unit_id`, `formula`, `purchase_voucher_unit_type`, `recipe_unit_type`, `is_deleted`) VALUES
(1, 'Dummy', 1, 3, 0, 0, '0.00', 'primary', 'primary', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `data` blob NOT NULL,
  `expires` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `data`, `expires`) VALUES
('ptc1h69i3v6vq8qp9ju3uq98h3', 0x436f6e6669677c613a313a7b733a343a2274696d65223b693a313533353131303633393b7d466c6173687c613a303a7b7d417574687c613a313a7b733a343a2255736572223b4f3a32313a224170705c4d6f64656c5c456e746974795c55736572223a31313a7b733a31343a22002a005f61636365737369626c65223b613a343a7b733a343a226e616d65223b623a313b733a383a22757365726e616d65223b623a313b733a383a2270617373776f7264223b623a313b733a343a22726f6c65223b623a313b7d733a31303a22002a005f68696464656e223b613a313a7b693a303b733a383a2270617373776f7264223b7d733a31343a22002a005f70726f70657274696573223b613a353a7b733a323a226964223b693a313b733a343a226e616d65223b733a31343a22416268696c617368204c6f686172223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a383a2270617373776f7264223b733a36303a22243279243130246b6e5077474d72526430776a31332f4a486c574f722e4351646441426b3038694e6a586a66413750355753666936425a3667694d4b223b733a343a22726f6c65223b733a353a2261646d696e223b7d733a31323a22002a005f6f726967696e616c223b613a303a7b7d733a31313a22002a005f7669727475616c223b613a303a7b7d733a31333a22002a005f636c6173734e616d65223b4e3b733a393a22002a005f6469727479223b613a303a7b7d733a373a22002a005f6e6577223b623a303b733a31303a22002a005f6572726f7273223b613a303a7b7d733a31313a22002a005f696e76616c6964223b613a303a7b7d733a31373a22002a005f7265676973747279416c696173223b733a353a225573657273223b7d7d, 1535110639);

-- --------------------------------------------------------

--
-- Table structure for table `stock_ledgers`
--

CREATE TABLE `stock_ledgers` (
  `id` int(10) NOT NULL,
  `transaction_date` date NOT NULL,
  `raw_material_id` int(50) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  `status` varchar(10) NOT NULL,
  `effected_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `voucher_name` varchar(50) NOT NULL,
  `is_wastage` tinyint(1) NOT NULL DEFAULT '0',
  `adjustment_commant` varchar(50) NOT NULL,
  `wastage_commant` varchar(50) NOT NULL,
  `purchase_voucher_row_id` int(10) NOT NULL,
  `purchase_voucher_id` int(10) NOT NULL,
  `bill_id` int(10) NOT NULL,
  `bill_row_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_ledgers`
--

INSERT INTO `stock_ledgers` (`id`, `transaction_date`, `raw_material_id`, `quantity`, `rate`, `status`, `effected_on`, `voucher_name`, `is_wastage`, `adjustment_commant`, `wastage_commant`, `purchase_voucher_row_id`, `purchase_voucher_id`, `bill_id`, `bill_row_id`) VALUES
(1, '2018-08-23', 1, '0.10', '0.00', 'out', '2018-08-23 12:15:55', 'Bill', 0, '', '', 0, 0, 1, 1),
(2, '2018-08-23', 2, '1.00', '0.00', 'out', '2018-08-23 12:15:55', 'Bill', 0, '', '', 0, 0, 1, 1),
(3, '2018-08-23', 1, '0.20', '0.00', 'out', '2018-08-23 12:15:55', 'Bill', 0, '', '', 0, 0, 1, 2),
(4, '2018-08-23', 1, '0.10', '0.00', 'out', '2018-08-23 12:26:08', 'Bill', 0, '', '', 0, 0, 1, 1),
(5, '2018-08-23', 2, '1.00', '0.00', 'out', '2018-08-23 12:26:09', 'Bill', 0, '', '', 0, 0, 1, 1),
(6, '2018-08-23', 1, '0.10', '0.00', 'out', '2018-08-23 12:31:09', 'Bill', 0, '', '', 0, 0, 2, 2),
(7, '2018-08-23', 2, '1.00', '0.00', 'out', '2018-08-23 12:31:09', 'Bill', 0, '', '', 0, 0, 2, 2),
(8, '2018-08-23', 1, '0.20', '0.00', 'out', '2018-08-23 12:31:09', 'Bill', 0, '', '', 0, 0, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` varchar(30) NOT NULL,
  `c_name` varchar(255) DEFAULT NULL,
  `c_mobile` varchar(10) DEFAULT NULL,
  `no_of_pax` int(10) DEFAULT NULL,
  `occupied_time` timestamp NULL DEFAULT NULL,
  `dob` date NOT NULL,
  `doa` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `c_address` text NOT NULL,
  `employee_id` int(10) NOT NULL,
  `payment_status` varchar(10) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `customer_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`id`, `name`, `status`, `c_name`, `c_mobile`, `no_of_pax`, `occupied_time`, `dob`, `doa`, `email`, `c_address`, `employee_id`, `payment_status`, `bill_id`, `customer_id`) VALUES
(1, '101', 'occupied', '', '', 1, '2018-08-23 13:07:30', '0000-00-00', '0000-00-00', '', '', 2, '', 0, 1),
(2, '102', 'occupied', '', '', 8, '2018-08-24 10:02:40', '0000-00-00', '0000-00-00', '', '', 0, '', 0, NULL),
(3, '103', 'occupied', '', '', 1, '2018-08-24 10:33:56', '0000-00-00', '0000-00-00', '', '', 0, '', 0, NULL),
(4, '104', 'vacant', '', '', 0, '0000-00-00 00:00:00', '0000-00-00', '0000-00-00', '', '', 0, '', 0, NULL),
(5, '105', 'vacant', '', '', 0, '0000-00-00 00:00:00', '0000-00-00', '0000-00-00', '', '', 0, '', 0, NULL),
(6, '106', 'vacant', '', '', NULL, '0000-00-00 00:00:00', '0000-00-00', '0000-00-00', '', '', 0, '', 0, NULL),
(7, '107', 'occupied', '', '', 4, '2018-08-24 10:17:04', '0000-00-00', '0000-00-00', '', '', 0, '', 0, 1),
(8, '108', 'occupied', '', '', 1, '2018-08-24 10:34:10', '0000-00-00', '0000-00-00', '', '', 0, '', 0, NULL),
(9, '109', 'vacant', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '', '', 0, '', 0, NULL),
(10, '110', 'vacant', '', '', 0, '0000-00-00 00:00:00', '0000-00-00', '0000-00-00', '', '', 0, '', 0, NULL),
(11, '111', 'occupied', '', '', 1, '2018-08-24 10:37:11', '0000-00-00', '0000-00-00', '', '', 0, '', 0, NULL),
(12, '112', 'vacant', '', '', 0, '0000-00-00 00:00:00', '0000-00-00', '0000-00-00', '', '', 0, '', 0, NULL),
(13, '113', 'vacant', '', '', 0, '0000-00-00 00:00:00', '0000-00-00', '0000-00-00', '', '', 0, '', 0, NULL),
(14, '114', 'occupied', '', '', 10, '2018-08-24 10:18:43', '0000-00-00', '0000-00-00', '', '', 0, '', 0, NULL),
(15, '115', 'vacant', '', '', NULL, '0000-00-00 00:00:00', '0000-00-00', '0000-00-00', '', '', 0, '', 0, NULL),
(16, '116', 'occupied', '', '', 4, '2018-08-24 10:37:23', '0000-00-00', '0000-00-00', '', '', 0, '', 0, NULL),
(17, '117', 'vacant', NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00', '0000-00-00', '', '', 0, '', 0, NULL),
(18, '118', 'occupied', '', '', 9, '2018-08-24 10:37:42', '0000-00-00', '0000-00-00', '', '', 0, '', 0, NULL),
(19, '119', 'vacant', NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00', '0000-00-00', '', '', 0, '', 0, NULL),
(20, '120', 'occupied', '', '', 1, '2018-08-24 10:37:00', '0000-00-00', '0000-00-00', '', '', 0, '', 0, NULL);

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
(1, '0%', '0.00', ''),
(2, '5%', '5.00', '');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `is_deleted`) VALUES
(1, 'Kg', 0),
(2, 'Gm', 0),
(3, 'Pcs', 0);

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
(1, 'Abhilash Lohar', 'admin', '$2y$10$knPwGMrRd0wj13/JHlWOr.CQddABk08iNjXjfA7P5WSfi6BZ6giMK', 'admin'),
(4, 'Counter', 'counter', '$2y$10$qECmG7n5/SWMFFhiwYXeCufmHrZpkgymPzotrPQcSKQULWeDr.r5S', 'counter');

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
(1, 'Vendor 1', '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vendor_items`
--

CREATE TABLE `vendor_items` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `raw_material_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customer_code` (`customer_code`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
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
-- Indexes for table `item_rows`
--
ALTER TABLE `item_rows`
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
-- Indexes for table `offer_codes`
--
ALTER TABLE `offer_codes`
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
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_ledgers`
--
ALTER TABLE `stock_ledgers`
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
-- Indexes for table `units`
--
ALTER TABLE `units`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bill_rows`
--
ALTER TABLE `bill_rows`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;
--
-- AUTO_INCREMENT for table `item_categories`
--
ALTER TABLE `item_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `item_rows`
--
ALTER TABLE `item_rows`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;
--
-- AUTO_INCREMENT for table `item_sub_categories`
--
ALTER TABLE `item_sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `kots`
--
ALTER TABLE `kots`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `kot_rows`
--
ALTER TABLE `kot_rows`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `offer_codes`
--
ALTER TABLE `offer_codes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `purchase_vouchers`
--
ALTER TABLE `purchase_vouchers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `purchase_voucher_rows`
--
ALTER TABLE `purchase_voucher_rows`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `raw_materials`
--
ALTER TABLE `raw_materials`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `stock_ledgers`
--
ALTER TABLE `stock_ledgers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `vendor_items`
--
ALTER TABLE `vendor_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
