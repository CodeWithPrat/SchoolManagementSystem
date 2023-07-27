-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2019 at 02:23 PM
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
-- Table structure for table `sms_attendance`
--

CREATE TABLE `sms_attendance` (
  `attendance_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `attendance_status` int(11) NOT NULL,
  `attendance_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms_attendance`
--

INSERT INTO `sms_attendance` (`attendance_id`, `student_id`, `class_id`, `section_id`, `attendance_status`, `attendance_date`) VALUES
(1, 6, 2, 1, 1, '2019/06/22'),
(2, 5, 2, 1, 4, '2019/06/22'),
(3, 3, 2, 1, 3, '2019/06/22'),
(4, 7, 4, 4, 3, '2019/06/22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sms_attendance`
--
ALTER TABLE `sms_attendance`
  ADD PRIMARY KEY (`attendance_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sms_attendance`
--
ALTER TABLE `sms_attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
