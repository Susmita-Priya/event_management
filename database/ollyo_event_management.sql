-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2025 at 03:25 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `bookingId`, `name`, `phone`, `email`, `gender`, `eventId`, `guestNo`, `payment`, `info`, `status`, `created_at`, `updated_at`) VALUES
(4, '347612565', 'test', '01234562314', 'susmita@gmail.com', 'Female', 1, 10, '1000000.00', '', 'Active', '2025-01-28 05:09:42', '2025-01-28 05:09:42'),
(7, '339983051', 'Priya', '01234562314', 'priya@gmail.com', 'Female', 19, 4, '40000.00', '', 'Active', '2025-01-28 07:07:04', '2025-01-28 07:07:04'),
(9, '985725958', 'Susmita Saha', '01766829719', 'susmi@gmail.com', 'Female', 1, 3, '300000.00', '', 'Active', '2025-01-29 06:32:32', '2025-01-29 06:32:32'),
(10, '510880758', 'Test', '01766829717', 'test@gmail.com', 'Female', 22, 20, '0.00', '', 'Active', '2025-01-29 06:34:06', '2025-01-29 06:34:06'),
(11, '185378938', 'Susmita Rani Saha ', '01766829719', 'saha06571@gmail.com', 'Female', 23, 8, '4000.00', 'Test', 'Active', '2025-01-31 13:23:40', '2025-01-31 13:23:40'),
(12, '340779556', 'Test', '+880171441172', 'test@gmail.com', 'Male', 19, 20, '200000.00', '', 'Active', '2025-01-31 13:27:12', '2025-01-31 13:27:12');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `event_name`, `category_name`, `venue`, `pincode`, `capacity`, `availability`, `payment`, `start_date`, `start_time`, `end_date`, `end_time`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Birthday Party', 'Private Event', 'Rain Forest Resort And Spa', '422302', '500', 7, '100000.00', '2025-01-27', '11:11:00', '2025-01-29', '11:11:00', '', 'Active', '2025-01-27 05:11:49', '2025-01-29 06:32:32'),
(2, 'Anniversary', 'Private Event', 'Pearl Community Center', '422301', '500', 150, '20000.00', '2025-01-28', '11:22:00', '2025-01-29', '11:22:00', '', 'Inactive', '2025-01-28 05:23:01', '2025-01-31 13:29:46'),
(19, 'Concert', 'Public Event', 'Fancy Club', '422300', '50000', 49154, '10000.00', '2025-01-29', '13:04:00', '2025-01-30', '13:04:00', '', 'Active', '2025-01-28 07:04:13', '2025-01-31 13:27:12'),
(22, 'Engagement', 'Private Event', 'Dhaka Convention Center', '402301', '250', 230, '0.00', '2025-01-30', '12:30:00', '2025-01-30', '00:30:00', '', 'Active', '2025-01-29 06:30:13', '2025-01-29 06:34:06'),
(23, 'Wedding', 'Private Event', 'Pan Pacific Sonargaon ', '433310', '300', 292, '500.00', '2025-02-28', '19:10:00', '2025-03-03', '19:10:00', 'Wedding with x and y.', 'Active', '2025-01-31 13:12:53', '2025-01-31 13:29:33');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `permission_id` int(11) NOT NULL,
  `permission_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`permission_id`, `permission_name`) VALUES
(26, 'attendee_reg'),
(21, 'change_password'),
(25, 'download_csv'),
(24, 'download_pdf'),
(4, 'event_add'),
(7, 'event_delete'),
(5, 'event_edit'),
(27, 'event_management'),
(6, 'event_view'),
(29, 'management user'),
(16, 'permission_add'),
(19, 'permission_delete'),
(17, 'permission_edit'),
(32, 'permission_management'),
(18, 'permission_view'),
(20, 'profile_edit'),
(28, 'reports'),
(12, 'role_add'),
(15, 'role_delete'),
(13, 'role_edit'),
(31, 'role_management'),
(14, 'role_view'),
(22, 'search_event'),
(8, 'user_add'),
(11, 'user_delete'),
(9, 'user_edit'),
(30, 'user_management'),
(10, 'user_view'),
(23, 'view_booking');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`role_id`, `permission_id`) VALUES
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23),
(1, 24),
(1, 25),
(1, 26),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(1, 32),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 20),
(2, 21),
(2, 22),
(2, 23),
(2, 26),
(2, 27),
(2, 28),
(18, 21),
(18, 26);

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
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstName`, `lastName`, `email`, `phone`, `password`, `role_id`, `created_at`) VALUES
(2, 'Susmita', 'Saha', 'susmita@gmail.com', '01766829718', '$2y$10$aN01zQhPHvNFH3CvwaNJz.wanNjBTQZuMty/9aiQAI4QFoHmmEdSa', 1, '2025-01-30 06:49:45'),
(6, 'Priya', 'Saha', 'priya@gmail.com', '01766829718', '$2y$10$jLrJjzIZpgP7rAOsOLwy6e2GGdHZz87lW3GtayrbgxBsB2A.5hLA.', 2, '2025-01-31 10:12:26');

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
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`permission_id`),
  ADD UNIQUE KEY `permission_name` (`permission_name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`role_id`,`permission_id`),
  ADD KEY `permission_id` (`permission_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
