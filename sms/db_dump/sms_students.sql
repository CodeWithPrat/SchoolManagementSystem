-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2019 at 02:24 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webdamn_demos`
--

-- --------------------------------------------------------

--
-- Table structure for table `sms_students`
--

CREATE TABLE `sms_students` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(40) NOT NULL,
  `gender` varchar(40) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `photo` varchar(40) DEFAULT NULL,
  `mobile` int(10) UNSIGNED NOT NULL,
  `email` varchar(40) DEFAULT NULL,
  `current_address` varchar(40) DEFAULT NULL,
  `permanent_address` varchar(40) DEFAULT NULL,
  `father_name` varchar(255) NOT NULL,
  `father_mobile` int(10) UNSIGNED NOT NULL,
  `father_occupation` varchar(255) NOT NULL,
  `mother_name` varchar(255) NOT NULL,
  `mother_mobile` int(10) UNSIGNED NOT NULL,
  `admission_no` int(11) NOT NULL,
  `roll_no` int(11) NOT NULL,
  `class` int(10) UNSIGNED NOT NULL,
  `section` int(11) NOT NULL,
  `stream` int(10) UNSIGNED DEFAULT NULL,
  `hostel` int(10) UNSIGNED DEFAULT NULL,
  `admission_date` varchar(255) NOT NULL,
  `category` int(10) UNSIGNED DEFAULT NULL,
  `academic_year` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sms_students`
--

INSERT INTO `sms_students` (`id`, `name`, `gender`, `dob`, `photo`, `mobile`, `email`, `current_address`, `permanent_address`, `father_name`, `father_mobile`, `father_occupation`, `mother_name`, `mother_mobile`, `admission_no`, `roll_no`, `class`, `section`, `stream`, `hostel`, `admission_date`, `category`, `academic_year`) VALUES
(3, 'Smith', 'male', '0000-00-00', '1559480265cat-2083492_960_720.jpg', 123456789, 'smith@test.com', 'xyxz', NULL, 'jhone smith', 0, '', 'Diana smith', 0, 1234567, 654378, 2, 1, NULL, NULL, '0000-00-00', NULL, 2019),
(4, 'jaeeme khan', 'male', '22/06/1992', '1559480508phpzag.gif', 123456789, 'jaeeme@test.com', 'New delhi india', NULL, '', 0, '', '', 0, 12345678, 67891, 3, 2, NULL, NULL, '02/06/2019', NULL, 2019),
(5, 'Root', 'male', '22/06/1992', '1560685652password reset with php.png', 0, 'root@gmail.com', '', NULL, '', 0, '', '', 0, 123456789, 3532552, 2, 1, NULL, NULL, '02/06/2019', NULL, 2019),
(6, 'William', 'male', '22/06/1994', '1560686427cat-2083492_960_720.jpg', 0, 'william@test.com', '', NULL, '', 0, '', '', 0, 2147483647, 2147483647, 2, 1, NULL, NULL, '16/06/2019', NULL, 2019),
(7, 'Stokes', 'male', '22/06/1996', '1560687168cat-2083492_960_720.jpg', 0, 'stokes@test.com', '', NULL, '', 0, '', '', 0, 553252525, 1234554363, 4, 4, NULL, NULL, '16/06/2019', NULL, 2019);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sms_students`
--
ALTER TABLE `sms_students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sms_students`
--
ALTER TABLE `sms_students`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
