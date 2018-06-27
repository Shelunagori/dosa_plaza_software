-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2018 at 02:15 PM
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
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `item_sub_category_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL COMMENT '0 = active, 1 = deleted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `item_categories`
--
ALTER TABLE `item_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `item_sub_categories`
--
ALTER TABLE `item_sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
