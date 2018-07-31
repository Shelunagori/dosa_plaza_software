-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2018 at 08:16 AM
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
-- Table structure for table `stock_ledgers`
--

CREATE TABLE `stock_ledgers` (
  `id` int(10) NOT NULL,
  `raw_material_id` int(50) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  `status` varchar(10) NOT NULL,
  `effected_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `voucher_name` varchar(50) NOT NULL,
  `adjustment_commant` varchar(50) NOT NULL,
  `wastage_commant` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_ledgers`
--

INSERT INTO `stock_ledgers` (`id`, `raw_material_id`, `quantity`, `rate`, `status`, `effected_on`, `voucher_name`, `adjustment_commant`, `wastage_commant`) VALUES
(1, 5, '20.00', '0.00', 'in', '2018-07-31 05:41:05', 'stock adjustment', 'commant 1', ''),
(2, 8, '39.00', '0.00', 'out', '2018-07-31 05:41:06', 'stock adjustment', 'commant 2', 'commant 2'),
(3, 8, '23.00', '0.00', 'out', '2018-07-31 05:41:06', 'stock adjustment', 'commant 2', 'commant 2'),
(4, 9, '25.00', '0.00', 'in', '2018-07-31 05:41:06', 'stock adjustment', 'commant 3', ''),
(5, 10, '72.00', '0.00', 'out', '2018-07-31 05:41:06', 'stock adjustment', 'commant 4', 'commant5');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `stock_ledgers`
--
ALTER TABLE `stock_ledgers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `stock_ledgers`
--
ALTER TABLE `stock_ledgers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
