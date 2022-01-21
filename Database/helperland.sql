-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2022 at 10:58 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `helperland`
--

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `city_id` int(11) NOT NULL,
  `city_postal` int(11) NOT NULL,
  `city_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `contactmessage`
--

CREATE TABLE `contactmessage` (
  `msg_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message_type` varchar(50) NOT NULL,
  `message` varchar(255) NOT NULL,
  `generated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `extraservice`
--

CREATE TABLE `extraservice` (
  `extra_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `extra_service_name` varchar(100) NOT NULL,
  `extra_service_amount` int(11) NOT NULL,
  `extra_service_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notification_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `notification` varchar(255) NOT NULL,
  `arrived_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `service_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `sp_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  `cleaning_time` varchar(50) NOT NULL,
  `cleaning_date` varchar(50) NOT NULL,
  `working_hour` varchar(50) NOT NULL,
  `total_payment` int(11) NOT NULL,
  `comments` varchar(255) NOT NULL,
  `pat_at_home` tinyint(1) NOT NULL DEFAULT 0,
  `payment_status` varchar(50) NOT NULL,
  `service_status` varchar(50) NOT NULL,
  `service_distance` int(11) NOT NULL,
  `created_time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `servicehistory`
--

CREATE TABLE `servicehistory` (
  `service_history_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `completed_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `servicer`
--

CREATE TABLE `servicer` (
  `servicer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `working_with_pet` tinyint(1) NOT NULL DEFAULT 1,
  `set_radius` int(11) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `avtar` varchar(50) NOT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `servicerating`
--

CREATE TABLE `servicerating` (
  `service_rating_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `on_time_arrival` int(11) NOT NULL,
  `friendly` int(11) NOT NULL,
  `quality_of_service` int(11) NOT NULL,
  `feedback` varchar(255) NOT NULL,
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `useraddress`
--

CREATE TABLE `useraddress` (
  `address_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `street_name` varchar(255) NOT NULL,
  `houce_number` varchar(50) NOT NULL,
  `city_id` int(11) NOT NULL,
  `contact_number` varchar(10) NOT NULL,
  `is_selected` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_type_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `password` varchar(100) NOT NULL,
  `dob` varchar(50) NOT NULL,
  `preferred_langauge` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `date_of_registration` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `usersfavorites`
--

CREATE TABLE `usersfavorites` (
  `favorite_id` int(11) NOT NULL,
  `favorite_for` int(11) NOT NULL,
  `favorite_user` int(11) NOT NULL,
  `is_favorite` tinyint(1) NOT NULL DEFAULT 0,
  `is_blocked` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

CREATE TABLE `usertype` (
  `user_type_id` int(11) NOT NULL,
  `user_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `contactmessage`
--
ALTER TABLE `contactmessage`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `extraservice`
--
ALTER TABLE `extraservice`
  ADD PRIMARY KEY (`extra_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `serviceprovider` (`service_id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`service_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `address_id` (`address_id`),
  ADD KEY `sp__id` (`sp_id`);

--
-- Indexes for table `servicehistory`
--
ALTER TABLE `servicehistory`
  ADD PRIMARY KEY (`service_history_id`),
  ADD KEY `serviceId` (`service_id`);

--
-- Indexes for table `servicer`
--
ALTER TABLE `servicer`
  ADD PRIMARY KEY (`servicer_id`),
  ADD KEY `userid` (`user_id`);

--
-- Indexes for table `servicerating`
--
ALTER TABLE `servicerating`
  ADD PRIMARY KEY (`service_rating_id`),
  ADD KEY `service__id` (`service_id`);

--
-- Indexes for table `useraddress`
--
ALTER TABLE `useraddress`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_type_id` (`user_type_id`);

--
-- Indexes for table `usersfavorites`
--
ALTER TABLE `usersfavorites`
  ADD PRIMARY KEY (`favorite_id`),
  ADD KEY `favorite_for` (`favorite_for`),
  ADD KEY `favorite_user` (`favorite_user`);

--
-- Indexes for table `usertype`
--
ALTER TABLE `usertype`
  ADD PRIMARY KEY (`user_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contactmessage`
--
ALTER TABLE `contactmessage`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `extraservice`
--
ALTER TABLE `extraservice`
  MODIFY `extra_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `servicehistory`
--
ALTER TABLE `servicehistory`
  MODIFY `service_history_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `servicer`
--
ALTER TABLE `servicer`
  MODIFY `servicer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `servicerating`
--
ALTER TABLE `servicerating`
  MODIFY `service_rating_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `useraddress`
--
ALTER TABLE `useraddress`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usersfavorites`
--
ALTER TABLE `usersfavorites`
  MODIFY `favorite_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usertype`
--
ALTER TABLE `usertype`
  MODIFY `user_type_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `extraservice`
--
ALTER TABLE `extraservice`
  ADD CONSTRAINT `service_id` FOREIGN KEY (`service_id`) REFERENCES `service` (`service_id`);

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `serviceprovider` FOREIGN KEY (`service_id`) REFERENCES `service` (`service_id`);

--
-- Constraints for table `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `address_id` FOREIGN KEY (`address_id`) REFERENCES `useraddress` (`address_id`),
  ADD CONSTRAINT `customer_id` FOREIGN KEY (`customer_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `sp__id` FOREIGN KEY (`sp_id`) REFERENCES `servicer` (`servicer_id`);

--
-- Constraints for table `servicehistory`
--
ALTER TABLE `servicehistory`
  ADD CONSTRAINT `serviceId` FOREIGN KEY (`service_id`) REFERENCES `servicer` (`servicer_id`);

--
-- Constraints for table `servicer`
--
ALTER TABLE `servicer`
  ADD CONSTRAINT `userid` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `servicerating`
--
ALTER TABLE `servicerating`
  ADD CONSTRAINT `service__id` FOREIGN KEY (`service_id`) REFERENCES `service` (`service_id`);

--
-- Constraints for table `useraddress`
--
ALTER TABLE `useraddress`
  ADD CONSTRAINT `city_id` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`),
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `user_type_id` FOREIGN KEY (`user_type_id`) REFERENCES `usertype` (`user_type_id`);

--
-- Constraints for table `usersfavorites`
--
ALTER TABLE `usersfavorites`
  ADD CONSTRAINT `favorite_for` FOREIGN KEY (`favorite_for`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `favorite_user` FOREIGN KEY (`favorite_user`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
