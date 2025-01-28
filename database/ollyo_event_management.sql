-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2025 at 10:50 AM
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
-- Database: `ollyo_event_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `bookingId` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `eventId` int(11) NOT NULL,
  `guestNo` int(11) NOT NULL,
  `payment` decimal(10,2) NOT NULL,
  `info` text DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `bookingId`, `name`, `phone`, `email`, `gender`, `eventId`, `guestNo`, `payment`, `info`, `status`, `created_at`, `updated_at`) VALUES
(4, '347612565', 'test', '01234562314', 'susmita@gmail.com', 'Female', 1, 10, 1000000.00, '', 'Active', '2025-01-28 05:09:42', '2025-01-28 05:09:42'),
(5, '326799347', 'test', '01234562314', 'priya@gmail.com', 'Female', 2, 350, 99999999.99, '', 'Active', '2025-01-28 05:24:39', '2025-01-28 05:24:39'),
(7, '339983051', 'Priya', '01234562314', 'priya@gmail.com', 'Female', 19, 4, 40000.00, '', 'Active', '2025-01-28 07:07:04', '2025-01-28 07:07:04');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `event_name` varchar(100) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `venue` varchar(255) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `capacity` varchar(100) NOT NULL,
  `availability` int(11) NOT NULL DEFAULT 0,
  `payment` decimal(10,2) NOT NULL DEFAULT 0.00,
  `start_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_date` date NOT NULL,
  `end_time` time NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `event_name`, `category_name`, `venue`, `pincode`, `capacity`, `availability`, `payment`, `start_date`, `start_time`, `end_date`, `end_time`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Birthday Party', 'Private Event', 'Rain Forest Resort And Spa', '422302', '500', 10, 100000.00, '2025-01-27', '11:11:00', '2025-01-29', '11:11:00', '', 'Active', '2025-01-27 05:11:49', '2025-01-28 06:20:06'),
(2, 'Anniversary', 'Private Event', 'Pearl Community Center', '422301', '500', 150, 20000.00, '2025-01-28', '11:22:00', '2025-01-29', '11:22:00', '', 'Active', '2025-01-28 05:23:01', '2025-01-28 07:05:34'),
(19, 'Concert', 'Public Event', 'Fancy Club', '422300', '50000', 49996, 10000.00, '2025-01-29', '13:04:00', '2025-01-30', '13:04:00', '', 'Active', '2025-01-28 07:04:13', '2025-01-28 07:07:04');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstName`, `lastName`, `email`, `phone`, `password`, `created_at`) VALUES
(1, 'Susmita', 'Saha', 'susmita@gmail.com', '01766829712', '$2y$10$iZCqkUl8rbeEO4oJUYnnruvnO86OHcD4oGcfhkMqQa9AK6/tBvf/u', '2025-01-25 09:40:22'),
(2, 'Test', 'Test', 'test@gmail.com', '01234562314', '$2y$10$MhOLL4ydQzujTnjET/iPEeBNRDN2CMZFviBYR6P5H0RQXLuwln0iy', '2025-01-28 07:02:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bookingId` (`bookingId`),
  ADD KEY `eventId` (`eventId`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`eventId`) REFERENCES `event` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
