-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2017 at 02:04 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin_nucleus_vision`
--

-- --------------------------------------------------------

--
-- Table structure for table `nucleus_vision_tracker`
--

CREATE TABLE `nucleus_vision_tracker` (
  `id` int(11) NOT NULL,
  `imei_caputured` varchar(250) NOT NULL,
  `sensors_count` varchar(250) NOT NULL,
  `authorizations` varchar(250) NOT NULL,
  `recommendations` varchar(250) NOT NULL,
  `benefits_availed` varchar(250) NOT NULL,
  `temp1` varchar(200) DEFAULT NULL,
  `temp2` varchar(200) DEFAULT NULL,
  `temp3` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nucleus_vision_tracker`
--

INSERT INTO `nucleus_vision_tracker` (`id`, `imei_caputured`, `sensors_count`, `authorizations`, `recommendations`, `benefits_availed`, `temp1`, `temp2`, `temp3`) VALUES
(1, '35446', '19', '2031', '2119', '1576', '70', '200', '');

-- --------------------------------------------------------

--
-- Table structure for table `nucleus_vision_tracker_qa`
--

CREATE TABLE `nucleus_vision_tracker_qa` (
  `id` int(11) NOT NULL,
  `imei_caputured` varchar(250) NOT NULL,
  `sensors_count` varchar(250) NOT NULL,
  `authorizations` varchar(250) NOT NULL,
  `recommendations` varchar(250) NOT NULL,
  `benefits_availed` varchar(250) NOT NULL,
  `temp1` varchar(200) DEFAULT NULL,
  `temp2` varchar(200) DEFAULT NULL,
  `temp3` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nucleus_vision_tracker_qa`
--

INSERT INTO `nucleus_vision_tracker_qa` (`id`, `imei_caputured`, `sensors_count`, `authorizations`, `recommendations`, `benefits_availed`, `temp1`, `temp2`, `temp3`) VALUES
(1, '35476', '19', '2031', '2119', '1576', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nucleus_vision_tracker`
--
ALTER TABLE `nucleus_vision_tracker`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nucleus_vision_tracker_qa`
--
ALTER TABLE `nucleus_vision_tracker_qa`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nucleus_vision_tracker`
--
ALTER TABLE `nucleus_vision_tracker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `nucleus_vision_tracker_qa`
--
ALTER TABLE `nucleus_vision_tracker_qa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
