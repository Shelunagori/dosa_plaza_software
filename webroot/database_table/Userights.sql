-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2018 at 11:57 AM
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
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `controller_name` varchar(100) NOT NULL,
  `action` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `controller_name`, `action`, `name`) VALUES
(1, 'Users', 'Dashboard', 'Dashboard'),
(2, 'PurchaseVouchers', 'add', 'Purchase Vouchers Add'),
(3, 'PurchaseVouchers', 'index', 'Purchase Vouchers View'),
(4, 'RawMaterials', 'stock_adjustment', 'Raw Materials Stock Adjustment'),
(5, 'Attendances', 'add', 'Attendances '),
(6, 'ItemCategories', 'add', 'Item Category'),
(7, 'ItemSubCategories', 'add', 'Item Sub Category'),
(8, 'Items', 'add', 'Items Add'),
(9, 'Items', 'index', 'Items View'),
(10, 'RawMaterialCategories', 'add', 'Raw Material Category'),
(11, 'RawMaterialSubCategories', 'add', 'Raw Material Sub Category'),
(12, 'RawMaterials', 'add', 'Raw Material Add'),
(13, 'RawMaterials', 'index', 'RawMaterial View'),
(14, 'OfferCodes', 'index', 'Offer Code'),
(15, 'Employees', 'add', 'Employee Add'),
(16, 'Employees', 'index', 'Employee View'),
(17, 'Vendors', 'add', 'Vendor Add'),
(18, 'Vendors', 'index', 'Vendors View'),
(19, 'Customers', 'index', 'Customers'),
(20, 'Bills', 'index', 'Bills'),
(21, 'Comments', 'add', 'Comments'),
(22, 'Tables', 'add', 'Tables'),
(23, 'Designations', 'add', 'Designations'),
(24, 'Taxes', 'add', 'Taxes'),
(25, 'Units', 'add', 'Units'),
(26, 'Users', 'Reports', 'Reports'),
(27, 'Tables', 'index', 'Table'),
(28, 'UserRights', 'add', 'User Rights');

-- --------------------------------------------------------

--
-- Table structure for table `user_rights`
--

CREATE TABLE `user_rights` (
  `id` int(11) NOT NULL,
  `user_id` int(12) NOT NULL,
  `page_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_rights`
--

INSERT INTO `user_rights` (`id`, `user_id`, `page_id`) VALUES
(6, 4, 1),
(7, 4, 2),
(9, 1, 1),
(10, 1, 2),
(11, 1, 3),
(12, 1, 4),
(13, 1, 5),
(14, 1, 6),
(15, 1, 7),
(16, 1, 8),
(17, 1, 9),
(18, 1, 10),
(19, 1, 11),
(20, 1, 12),
(21, 1, 13),
(22, 1, 14),
(23, 1, 15),
(24, 1, 16),
(25, 1, 17),
(26, 1, 18),
(27, 1, 19),
(28, 1, 20),
(29, 1, 21),
(30, 1, 22),
(31, 1, 23),
(32, 1, 24),
(33, 1, 25),
(34, 1, 26),
(35, 1, 27),
(36, 1, 28);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_rights`
--
ALTER TABLE `user_rights`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `user_rights`
--
ALTER TABLE `user_rights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
