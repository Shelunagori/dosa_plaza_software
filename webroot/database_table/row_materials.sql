-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2018 at 12:49 PM
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
-- Table structure for table `raw_materials`
--

CREATE TABLE `raw_materials` (
  `id` int(10) NOT NULL,
  `raw_material_sub_category_id` int(11) NOT NULL,
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

INSERT INTO `raw_materials` (`id`, `raw_material_sub_category_id`, `name`, `tax_id`, `primary_unit_id`, `has_secondary_unit`, `secondary_unit_id`, `formula`, `purchase_voucher_unit_type`, `recipe_unit_type`, `is_deleted`) VALUES
(1, 0, 'Dummy', 1, 3, 0, 0, '0.00', 'primary', 'primary', 0),
(2, 0, 'Raw Material 1', 2, 1, 1, 2, '1000.00', 'primary', 'secondary', 0),
(3, 0, 'Raw Material 2', 2, 1, 0, 2, '0.00', 'primary', 'secondary', 0),
(4, 0, 'Raw Material 3', 2, 3, 0, 2, '0.00', 'primary', 'secondary', 0),
(5, 0, 'Raw Material 4', 2, 3, 0, 2, '0.00', 'primary', 'secondary', 0),
(6, 1, 'test1', 2, 1, 0, 0, '0.00', 'primary', 'primary', 0);

-- --------------------------------------------------------

--
-- Table structure for table `raw_material_categories`
--

CREATE TABLE `raw_material_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `raw_material_categories`
--

INSERT INTO `raw_material_categories` (`id`, `name`, `is_deleted`) VALUES
(1, 'AATA !', 0);

-- --------------------------------------------------------

--
-- Table structure for table `raw_material_sub_categories`
--

CREATE TABLE `raw_material_sub_categories` (
  `id` int(11) NOT NULL,
  `raw_material_category_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `raw_material_sub_categories`
--

INSERT INTO `raw_material_sub_categories` (`id`, `raw_material_category_id`, `name`, `is_deleted`) VALUES
(1, 1, 'Sukha aata', 0),
(2, 1, 'NEw Ata', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `raw_materials`
--
ALTER TABLE `raw_materials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `raw_material_categories`
--
ALTER TABLE `raw_material_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `raw_material_sub_categories`
--
ALTER TABLE `raw_material_sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `raw_materials`
--
ALTER TABLE `raw_materials`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `raw_material_categories`
--
ALTER TABLE `raw_material_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `raw_material_sub_categories`
--
ALTER TABLE `raw_material_sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
