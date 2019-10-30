-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 30, 2019 at 08:10 AM
-- Server version: 8.0.17
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mortgage`
--

-- --------------------------------------------------------

--
-- Table structure for table `saved_data`
--

CREATE TABLE `saved_data` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `payment` varchar(100) NOT NULL,
  `interest_b` varchar(2000) NOT NULL,
  `interest_p` varchar(2000) NOT NULL,
  `years` int(11) NOT NULL,
  `year_spent` varchar(2000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `saved_data`
--

INSERT INTO `saved_data` (`id`, `username`, `payment`, `interest_b`, `interest_p`, `years`, `year_spent`) VALUES
(10, 'Lucky Mhlanga', '1169.33', '98.98,97.79,96.53,95.18,93.74,92.2,90.56,88.81,86.94,84.95,82.82,80.55,78.13,75.55,72.8,69.86,66.72,63.37,59.8,55.99,51.93,47.59,42.96,38.03,32.76,27.14,21.14,14.74,7.91,0.63', '1.02,2.21,3.47,4.82,6.26,7.8,9.44,11.19,13.06,15.05,17.18,19.45,21.87,24.45,27.2,30.14,33.28,36.63,40.2,44.01,48.07,52.41,57.04,61.97,67.24,72.86,78.86,85.26,92.09,99.37', 30, '14031.91,28063.82,42095.73,56127.64,70159.55,84191.46,98223.37,112255.28,126287.19,140319.1,154351.01,168382.92,182414.83,196446.74,210478.65,224510.56,238542.47,252574.38,266606.29,280638.2,294670.11,308702.02,322733.93,336765.84,350797.75,364829.66,378861.57,392893.48,406925.39,420957.3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `saved_data`
--
ALTER TABLE `saved_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `saved_data`
--
ALTER TABLE `saved_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
