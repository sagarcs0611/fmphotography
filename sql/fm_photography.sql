-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2025 at 07:11 AM
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
-- Database: `fm_photography`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `client_id` int(11) NOT NULL,
  `client_unique_id` varchar(255) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `ph_no` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_id`, `client_unique_id`, `name`, `email`, `ph_no`, `address`, `created_at`, `updated_at`) VALUES
(1, 'cRwZ2ovH', 'Rohan Sen', 'rohan@gmail.com', '9876543456', 'Barasat', '2025-04-26 02:37:03', '2025-04-26 02:37:03');

-- --------------------------------------------------------

--
-- Table structure for table `product_master`
--

CREATE TABLE `product_master` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `side` varchar(20) DEFAULT NULL,
  `price` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_master`
--

INSERT INTO `product_master` (`product_id`, `product_name`, `short_description`, `side`, `price`, `created_at`, `updated_at`) VALUES
(3, 'STANDER PACK', 'Single side package 3 days', 'Single Side', '49000', '2025-04-25 23:23:22', '2025-04-25 23:23:22'),
(8, 'Super Saver Pack', 'Both Side Package 3 Days', 'Both Side', '65000', '2025-04-25 23:23:22', '2025-04-25 23:23:22');

-- --------------------------------------------------------

--
-- Table structure for table `product_service`
--

CREATE TABLE `product_service` (
  `service_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `service_name` varchar(100) DEFAULT NULL,
  `service_price` varchar(20) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_service`
--

INSERT INTO `product_service` (`service_id`, `product_id`, `service_name`, `service_price`, `created_at`, `updated_at`) VALUES
(6, 3, 'Event Covered By Professional Mirrorless Fx & Dx camera.', '0', '2025-04-25 23:23:22', '2025-04-25 23:23:22'),
(7, 3, '2photographer and 1 Cinematographer, (1 Fx and 1 dx camera)', '0', '2025-04-25 23:23:22', '2025-04-25 23:23:22'),
(8, 3, '1 Cinematic Teaser', '0', '2025-04-25 23:23:22', '2025-04-25 23:23:22'),
(20, 8, 'Event Covered By professional DSLR Camera ', '0', '2025-04-24 10:15:05', '2025-04-24 10:15:05'),
(21, 8, 'Unlimited Soft Copy Photographs', '0', '2025-04-27 14:45:19', '2025-04-27 14:45:19');

-- --------------------------------------------------------

--
-- Table structure for table `proposal`
--

CREATE TABLE `proposal` (
  `proposal_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `package_name` varchar(50) DEFAULT NULL,
  `side` varchar(20) DEFAULT NULL,
  `client1_name` varchar(50) DEFAULT NULL,
  `client1_phone` varchar(20) DEFAULT NULL,
  `client1_email` varchar(50) DEFAULT NULL,
  `client1_address` text DEFAULT NULL,
  `client1_date` varchar(255) DEFAULT NULL,
  `client2_name` varchar(50) DEFAULT NULL,
  `client2_phone` varchar(20) DEFAULT NULL,
  `client2_email` varchar(50) DEFAULT NULL,
  `client2_address` text DEFAULT NULL,
  `client2_date` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `proposal`
--

INSERT INTO `proposal` (`proposal_id`, `client_id`, `user_id`, `package_name`, `side`, `client1_name`, `client1_phone`, `client1_email`, `client1_address`, `client1_date`, `client2_name`, `client2_phone`, `client2_email`, `client2_address`, `client2_date`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '8', 'Both Side', 'Rohan Das', '9874564578', 'rohan@gmail.com', 'Madhyamgram', '2025-05-30,2025-05-01', 'Reshmi Sen', '7845986512', 'reshmi@gmail.com', 'Barasat', '2025-05-07', '2025-04-27 05:44:34', '2025-04-27 05:44:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'sagar karmakar', 'sagar@gmail.com', '$2y$12$Ue1PFAtI95Rl0ziqSOEPCuEb.sj7ViMhblRNNbMJNW6znic6dslFm', 'admin', '2025-04-24 10:15:05', '2025-04-24 10:15:05'),
(2, 'Rohan Sen', 'rohan@gmail.com', '$2y$12$Ue1PFAtI95Rl0ziqSOEPCuEb.sj7ViMhblRNNbMJNW6znic6dslFm', 'user', '2025-04-24 10:15:05', '2025-04-24 10:15:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `product_master`
--
ALTER TABLE `product_master`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_service`
--
ALTER TABLE `product_service`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `proposal`
--
ALTER TABLE `proposal`
  ADD PRIMARY KEY (`proposal_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_master`
--
ALTER TABLE `product_master`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_service`
--
ALTER TABLE `product_service`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `proposal`
--
ALTER TABLE `proposal`
  MODIFY `proposal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
