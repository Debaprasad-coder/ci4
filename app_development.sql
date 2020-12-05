-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2020 at 12:12 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app_development`
--

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE `password_reset` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL COMMENT 'requeste email',
  `token` text NOT NULL COMMENT 'access token',
  `send_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'link sned at',
  `reset_at` datetime DEFAULT NULL COMMENT 'reset at',
  `status` int(1) DEFAULT 0 COMMENT '0=>not reset,1=>reset'
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `profile_id` int(11) NOT NULL COMMENT 'user id',
  `profile_img` char(10) DEFAULT NULL COMMENT 'user img',
  `profile_contact` char(15) DEFAULT NULL COMMENT 'contact number',
  `created_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'created at',
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp() COMMENT 'updated at',
  `deleted_at` datetime DEFAULT NULL COMMENT 'deleted at'
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`profile_id`, `profile_img`, `profile_contact`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, NULL, '2020-09-04 17:11:21', NULL, NULL),
(2, '2.jpg', '9474758548', '2020-09-04 17:22:30', '2020-09-04 23:43:31', NULL),
(3, '3.jpg', '9474758548', '2020-09-04 17:23:25', '2020-09-06 22:09:12', NULL),
(4, '4.jpg', '9474758548', '2020-09-04 17:24:35', '2020-09-04 23:36:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL COMMENT 'ai,pk',
  `username` char(100) NOT NULL COMMENT 'username',
  `email` char(100) NOT NULL COMMENT 'email',
  `password` varchar(100) NOT NULL COMMENT 'password',
  `is_active` int(2) NOT NULL DEFAULT 0 COMMENT '0=>in-active,1=>active',
  `role_id` int(2) NOT NULL DEFAULT 2 COMMENT 'user role 1=>admin,',
  `created_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'created at',
  `updated_at` datetime DEFAULT NULL COMMENT 'upddated at',
  `deleted_at` datetime DEFAULT NULL COMMENT 'deleted at'
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `is_active`, `role_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'DEBAPRASAD MAITY', 'debaprasad.maity@yahoo.com', '$2y$10$rxpz.nfKqXARUaa1TY4sAe0jyHxpZhyDboney.jEe653NeAPIho9W', 1, 1, '2020-09-04 17:11:21', NULL, NULL),
(2, 'Asit Das', 'asit@gmail.com', '$2y$10$I3f5gYFvH8H4tyddVEccPO3mFLj6vjYwfOp8d/yeLHCFcpI09kKbC', 1, 2, '2020-09-04 17:22:30', NULL, NULL),
(3, 'Kamal Barman', 'dmparision@gmail.com', '$2y$10$hsyW6iW1w0gSCiSv8uKwVOWbi8XKJfaBdcDn7kspIC.aqC3PtvC2O', 1, 2, '2020-09-04 17:23:25', NULL, NULL),
(4, 'ANIMESH PRAMANIK', 'animesh.prmnk@gmail.com', '$2y$10$dOeDpARX91MBKRHdjp6ZYu4P88VX7phJlei1In3kHWtpNurRahEDi', 1, 2, '2020-09-04 17:24:35', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`profile_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ai,pk', AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
