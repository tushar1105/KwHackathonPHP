-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 14, 2024 at 09:26 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kwhackathon`
--

-- --------------------------------------------------------

--
-- Table structure for table `kw_student_information`
--

CREATE TABLE `kw_student_information` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `team_id` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kw_student_information`
--

INSERT INTO `kw_student_information` (`id`, `first_name`, `last_name`, `email`, `team_id`, `created_on`) VALUES
(3, 'Tushar', 'Sharma', 'tushar@gmail.com', 3, '2024-08-14 19:01:18'),
(4, 'Test', 'User', 'test@gmail.com', 3, '2024-08-14 19:01:18'),
(5, 'vsdsd', 'vdsv', 'abc@123.com', 4, '2024-08-14 19:24:11'),
(6, 'nckjs', 'cdsvsdfv', 'abcdd@123.com', 4, '2024-08-14 19:24:11');

-- --------------------------------------------------------

--
-- Table structure for table `kw_team_information`
--

CREATE TABLE `kw_team_information` (
  `id` int(11) NOT NULL,
  `team_name` varchar(255) NOT NULL,
  `college_name` varchar(255) NOT NULL,
  `college_address` varchar(255) NOT NULL,
  `college_city` varchar(255) NOT NULL,
  `college_province` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kw_team_information`
--

INSERT INTO `kw_team_information` (`id`, `team_name`, `college_name`, `college_address`, `college_city`, `college_province`, `created_at`) VALUES
(3, 'TeamA', 'Conestoga', 'Univ Ave', 'Waterloo', 'ON', '2024-08-14 19:01:18'),
(4, 'csdcsd', 'cdscds', 'vddvd', 'vddv', 'NS', '2024-08-14 19:24:11');

-- --------------------------------------------------------

--
-- Table structure for table `kw_userlogin`
--

CREATE TABLE `kw_userlogin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kw_userlogin`
--

INSERT INTO `kw_userlogin` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kw_student_information`
--
ALTER TABLE `kw_student_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kw_team_information`
--
ALTER TABLE `kw_team_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kw_userlogin`
--
ALTER TABLE `kw_userlogin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kw_student_information`
--
ALTER TABLE `kw_student_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kw_team_information`
--
ALTER TABLE `kw_team_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kw_userlogin`
--
ALTER TABLE `kw_userlogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
