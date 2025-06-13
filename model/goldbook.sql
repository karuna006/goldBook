-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2025 at 07:16 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `goldbook`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `customer_id` varchar(50) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `dob` date DEFAULT NULL,
  `mobile_number` varchar(15) NOT NULL,
  `aadhar_number` varchar(12) NOT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `landmark` varchar(150) DEFAULT NULL,
  `pincode` varchar(10) DEFAULT NULL,
  `aadhar_photo_url` text DEFAULT NULL,
  `customer_photo_url` text DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_by` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gold_quality`
--

CREATE TABLE `gold_quality` (
  `quality_id` int(11) NOT NULL,
  `quality_name` varchar(50) NOT NULL,
  `rate_per_gram` decimal(10,2) NOT NULL,
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `loan_id` varchar(30) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `contact_no` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `gold_quality_id` int(11) DEFAULT NULL,
  `no_of_items` int(11) DEFAULT NULL,
  `total_weight` decimal(10,2) DEFAULT NULL,
  `loan_amount` decimal(12,2) DEFAULT NULL,
  `interest_rate` decimal(5,2) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Active',
  `created_by` int(20) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loan_closures`
--

CREATE TABLE `loan_closures` (
  `closure_id` int(11) NOT NULL,
  `loan_id` varchar(30) DEFAULT NULL,
  `closing_amount` decimal(12,2) DEFAULT NULL,
  `interest_paid` decimal(12,2) DEFAULT NULL,
  `closed_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `log_id` int(11) NOT NULL,
  `user_id` int(20) DEFAULT NULL,
  `action` text DEFAULT NULL,
  `log_time` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'Admin'),
(2, 'Employee'),
(3, 'Shareholder');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(20) NOT NULL,
  `custom_user_id` varchar(20) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `contact_no` varchar(15) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `custom_user_id`, `username`, `name`, `role_id`, `contact_no`, `password`, `created_at`) VALUES
(1, 'GB052024001', 'admin', 'Sathish Kumar', 1, '9876543210', 'VU4yKzlJT1plNnhPMmNuZHd6WHFoUT09', '2024-05-01 10:00:00'),
(2, 'GB052024002', 'loanexecutive1', 'Priya Ramesh', 2, '9845612300', 'VU4yKzlJT1plNnhPMmNuZHd6WHFoUT09', '2024-05-05 11:30:00'),
(3, 'GB052024003', 'loanexecutive2', 'Arun Raj', 2, '9564781234', 'VU4yKzlJT1plNnhPMmNuZHd6WHFoUT09', '2024-05-08 09:45:00'),
(4, 'GB052024004', 'shareholder1', 'Karthik Mohan', 3, '9654782310', 'VU4yKzlJT1plNnhPMmNuZHd6WHFoUT09', '2024-05-10 12:15:00');

-- --------------------------------------------------------

--
-- Stand-in structure for view `users_with_roles`
-- (See below for the actual view)
--
CREATE TABLE `users_with_roles` (
`user_id` int(20)
,`custom_user_id` varchar(20)
,`username` varchar(50)
,`name` varchar(100)
,`role_id` int(11)
,`contact_no` varchar(15)
,`password` varchar(255)
,`created_at` datetime
,`role_name` varchar(50)
);

-- --------------------------------------------------------

--
-- Structure for view `users_with_roles`
--
DROP TABLE IF EXISTS `users_with_roles`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `users_with_roles`  AS SELECT `u`.`user_id` AS `user_id`, `u`.`custom_user_id` AS `custom_user_id`, `u`.`username` AS `username`, `u`.`name` AS `name`, `u`.`role_id` AS `role_id`, `u`.`contact_no` AS `contact_no`, `u`.`password` AS `password`, `u`.`created_at` AS `created_at`, `r`.`role_name` AS `role_name` FROM (`users` `u` join `roles` `r` on(`u`.`role_id` = `r`.`role_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customer_id` (`customer_id`);

--
-- Indexes for table `gold_quality`
--
ALTER TABLE `gold_quality`
  ADD PRIMARY KEY (`quality_id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`loan_id`),
  ADD KEY `gold_quality_id` (`gold_quality_id`),
  ADD KEY `loans_ibfk_2` (`created_by`);

--
-- Indexes for table `loan_closures`
--
ALTER TABLE `loan_closures`
  ADD PRIMARY KEY (`closure_id`),
  ADD KEY `loan_id` (`loan_id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `fk_logs_user` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `custom_user_id` (`custom_user_id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gold_quality`
--
ALTER TABLE `gold_quality`
  MODIFY `quality_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loan_closures`
--
ALTER TABLE `loan_closures`
  MODIFY `closure_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `loans_ibfk_1` FOREIGN KEY (`gold_quality_id`) REFERENCES `gold_quality` (`quality_id`),
  ADD CONSTRAINT `loans_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `loan_closures`
--
ALTER TABLE `loan_closures`
  ADD CONSTRAINT `loan_closures_ibfk_1` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`loan_id`);

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `fk_logs_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
