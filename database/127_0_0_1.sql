-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2025 at 06:00 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pet_cafe`
--
CREATE DATABASE IF NOT EXISTS `pet_cafe` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `pet_cafe`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_counter`
--

CREATE TABLE `tbl_counter` (
  `c_id` int(10) NOT NULL,
  `c_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id` int(11) NOT NULL,
  `customer_fname` varchar(100) NOT NULL,
  `customer_lname` varchar(100) NOT NULL,
  `customer_password` varchar(100) NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `customer_tel` varchar(100) NOT NULL,
  `customer_status` enum('Member','Vip') NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `customer_fname`, `customer_lname`, `customer_password`, `customer_email`, `customer_tel`, `customer_status`, `dateCreate`) VALUES
(1, 'Customer', 'Test01', '$2y$12$8IzSdbMG45UUFiGBMFXzSu7f3Ov3qcFJJGS/TE1UkTHCfAZoyxSZK', 'Customer01@gmail.com', '1234567890', 'Member', '2025-09-07 16:04:35'),
(4, 'Aibi', 'Seravine', '$2y$12$ZbW6y2bWW.2Ax0RAn5IFs.8JPhgUHLddseePjFTKgg96GWnUmKuBa', 'lillie@gmail.com', '0981951566', 'Vip', '2025-09-26 03:14:39'),
(5, 'Numshok', 'Narngong', '$2y$12$CASYCvwZStQ6decflltCTezkQvYMh180ddzFrFC9jdO71tbIqPBOK', 'numshok@gmail.com', '0971451366', 'Vip', '2025-09-26 03:16:00'),
(6, 'Ashiraya', 'Eiei', '$2y$12$StNPba35WcIPgx81Waxx4OwUUWQmvvNSccgw0fktG.80Am4HFFTgi', 'Ashiraya101239@gmail.com', '0634566939', 'Member', '2025-09-26 03:17:06');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_foods`
--

CREATE TABLE `tbl_foods` (
  `id` int(11) NOT NULL,
  `food_name` varchar(100) NOT NULL,
  `food_detail` text NOT NULL,
  `food_type` enum('SavoryDishes','Desserts','Appetizers','Beverages') NOT NULL,
  `food_price` float(10,2) NOT NULL,
  `food_img` varchar(200) NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_foods`
--

INSERT INTO `tbl_foods` (`id`, `food_name`, `food_detail`, `food_type`, `food_price`, `food_img`, `dateCreate`) VALUES
(1, 'Cheesecake', 'Cheesecake is sweet', 'Desserts', 159.00, 'uploads/food/sLoEleOCnxopKHj2LvJHOrqNp81CSa1Opokz4aDH.png', '2025-09-22 11:25:04');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pets`
--

CREATE TABLE `tbl_pets` (
  `id` int(11) NOT NULL,
  `pet_name` varchar(100) NOT NULL,
  `pet_detail` text NOT NULL,
  `pet_type` enum('Dog','Cat','Raccoon') NOT NULL,
  `pet_img` varchar(200) NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_pets`
--

INSERT INTO `tbl_pets` (`id`, `pet_name`, `pet_detail`, `pet_type`, `pet_img`, `dateCreate`) VALUES
(1, 'Chamoi', 'Chamoi is Dog', 'Dog', 'uploads/pet/mk1GWuchgJ2sokKZTmlVBgLFfhbT5FTdDadQTxCb.jpg', '2025-09-22 11:30:15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_staff`
--

CREATE TABLE `tbl_staff` (
  `id` int(11) NOT NULL,
  `staff_fname` varchar(100) NOT NULL,
  `staff_lname` varchar(100) NOT NULL,
  `staff_tel` varchar(10) NOT NULL,
  `staff_email` varchar(100) NOT NULL,
  `staff_password` varchar(100) NOT NULL,
  `staff_gender` varchar(10) NOT NULL,
  `staff_address` varchar(200) NOT NULL,
  `staff_position` varchar(100) NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_staff`
--

INSERT INTO `tbl_staff` (`id`, `staff_fname`, `staff_lname`, `staff_tel`, `staff_email`, `staff_password`, `staff_gender`, `staff_address`, `staff_position`, `dateCreate`) VALUES
(1, 'Admin', 'Staff01', '0123456789', 'Admin01@gmail.com', '$2y$12$ax8DFI2jU8ym7S5tyiqmrOlVB8oAWzZCr.A6N0R9P5OAWwYTEfl9C', 'Male', 'AdminStaff01', 'Manager', '2025-09-07 14:26:34');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_test`
--

CREATE TABLE `tbl_test` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_test`
--

INSERT INTO `tbl_test` (`id`, `name`, `lastname`, `email`) VALUES
(1, 'Test', '01', 'Test01@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_counter`
--
ALTER TABLE `tbl_counter`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customer_email` (`customer_email`);

--
-- Indexes for table `tbl_foods`
--
ALTER TABLE `tbl_foods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pets`
--
ALTER TABLE `tbl_pets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_staff`
--
ALTER TABLE `tbl_staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `staff_email` (`staff_email`);

--
-- Indexes for table `tbl_test`
--
ALTER TABLE `tbl_test`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_counter`
--
ALTER TABLE `tbl_counter`
  MODIFY `c_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16521;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_foods`
--
ALTER TABLE `tbl_foods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_pets`
--
ALTER TABLE `tbl_pets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_staff`
--
ALTER TABLE `tbl_staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_test`
--
ALTER TABLE `tbl_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
