-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2018 at 01:44 PM
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
('e2telu46taf4qt93rd7eno24g1', 0x436f6e6669677c613a313a7b733a343a2274696d65223b693a313533333239363638333b7d417574687c613a313a7b733a343a2255736572223b4f3a32313a224170705c4d6f64656c5c456e746974795c55736572223a31313a7b733a31343a22002a005f61636365737369626c65223b613a343a7b733a343a226e616d65223b623a313b733a383a22757365726e616d65223b623a313b733a383a2270617373776f7264223b623a313b733a343a22726f6c65223b623a313b7d733a31303a22002a005f68696464656e223b613a313a7b693a303b733a383a2270617373776f7264223b7d733a31343a22002a005f70726f70657274696573223b613a353a7b733a323a226964223b693a313b733a343a226e616d65223b733a31343a22416268696c617368204c6f686172223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a383a2270617373776f7264223b733a36303a22243279243130246b6e5077474d72526430776a31332f4a486c574f722e4351646441426b3038694e6a586a66413750355753666936425a3667694d4b223b733a343a22726f6c65223b733a353a2261646d696e223b7d733a31323a22002a005f6f726967696e616c223b613a303a7b7d733a31313a22002a005f7669727475616c223b613a303a7b7d733a31333a22002a005f636c6173734e616d65223b4e3b733a393a22002a005f6469727479223b613a303a7b7d733a373a22002a005f6e6577223b623a303b733a31303a22002a005f6572726f7273223b613a303a7b7d733a31313a22002a005f696e76616c6964223b613a303a7b7d733a31373a22002a005f7265676973747279416c696173223b733a353a225573657273223b7d7d, 1533296683);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;