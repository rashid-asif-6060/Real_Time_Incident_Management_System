-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Jan 21, 2026 at 08:21 PM
-- Server version: 8.0.44
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Real_Time_Incident_Management_System`
--

-- --------------------------------------------------------

--
-- Table structure for table `incidents`
--

CREATE TABLE `incidents` (
  `id` int NOT NULL,
  `category` enum('Electrical','Device','Network','Plumbing','Others') NOT NULL,
  `room` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `reporter_type` enum('student','faculty') NOT NULL,
  `status` enum('Reported','Assigned','In Progress','Resolved') NOT NULL DEFAULT 'Reported',
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `incidents`
--

INSERT INTO `incidents` (`id`, `category`, `room`, `description`, `reporter_type`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(6, 'Electrical', '100', 'light', 'student', 'Reported', 3, '2026-01-21 19:21:29', '2026-01-21 19:21:29'),
(7, 'Electrical', '100', 'Light is not good', 'student', 'Reported', 3, '2026-01-21 19:26:13', '2026-01-21 19:26:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('reporter','responder','admin') NOT NULL,
  `reporter_type` enum('student','faculty') DEFAULT NULL,
  `responder_skill` enum('electrician','technician','network_engineer','plumber') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `reporter_type`, `responder_skill`, `created_at`) VALUES
(3, 'Al Amin Hossain Nahid', 'alamin@gmail.com', '$2y$10$6DmJXszzjGrCSycvjgbT/uVzluJuwwaZov8LqiFupCYHOAvRF2yMa', 'reporter', 'student', NULL, '2026-01-21 15:35:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `incidents`
--
ALTER TABLE `incidents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_incidents_status` (`status`),
  ADD KEY `idx_incidents_category` (`category`),
  ADD KEY `idx_incidents_created_by` (`created_by`),
  ADD KEY `idx_incidents_room_category` (`room`,`category`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `incidents`
--
ALTER TABLE `incidents`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `incidents`
--
ALTER TABLE `incidents`
  ADD CONSTRAINT `fk_incidents_created_by` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
