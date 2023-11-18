-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 14, 2023 at 07:20 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospital`
--

-- --------------------------------------------------------

--
-- Table structure for table `balances`
--

CREATE TABLE `balances` (
  `balance_id` int(10) NOT NULL,
  `medication_id` int(10) NOT NULL,
  `service_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `medication`
--

CREATE TABLE `medication` (
  `medication_id` int(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `price` varchar(20) NOT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `record_id` int(10) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `medication_id` int(10) NOT NULL,
  `disease` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `services_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `price` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Students`
--

CREATE TABLE `Students` (
  `student_id` varchar(100) NOT NULL DEFAULT uuid(),
  `reg_number` varchar(100) NOT NULL,
  `user_id` varchar(100) DEFAULT NULL,
  `graduation_year` date NOT NULL,
  `enrollment_year` date NOT NULL,
  `faculty` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Students`
--

INSERT INTO `Students` (`student_id`, `reg_number`, `user_id`, `graduation_year`, `enrollment_year`, `faculty`) VALUES
('492d2baf-8286-11ee-89d2-f816547ffa99', 'jsjkskjsk', '492ce896-8286-11ee-89d2-f816547ffa99', '2023-11-23', '2023-11-30', 'ICT'),
('8e00d733-7e71-11ee-a023-f816547ffa99', 'BsclCT/23/044', '793fcd6e-7e6d-11ee-a023-f816547ffa99', '2025-06-01', '2023-06-01', 'Computer Science'),
('8e3287c9-7e71-11ee-a023-f816547ffa99', 'BsclCT/23/046', '793fd3cd-7e6d-11ee-a023-f816547ffa99', '2025-06-01', '2023-06-01', 'Engineering'),
('8e3c854e-7e71-11ee-a023-f816547ffa99', 'BsclCT/23/047', '793fd45a-7e6d-11ee-a023-f816547ffa99', '2025-06-01', '2023-06-01', 'Computer Science'),
('8e507333-7e71-11ee-a023-f816547ffa99', 'BsclCT/23/049', '793fd555-7e6d-11ee-a023-f816547ffa99', '2025-06-01', '2023-06-01', 'Engineering'),
('8e5af8fb-7e71-11ee-a023-f816547ffa99', 'BsclCT/23/050', '793fd5ce-7e6d-11ee-a023-f816547ffa99', '2025-06-01', '2023-06-01', 'Law');

-- --------------------------------------------------------

--
-- Table structure for table `stuff`
--

CREATE TABLE `stuff` (
  `stuff_id` varchar(100) NOT NULL DEFAULT uuid(),
  `email` varchar(100) NOT NULL,
  `password` varchar(200) DEFAULT NULL,
  `user_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stuff`
--

INSERT INTO `stuff` (`stuff_id`, `email`, `password`, `user_id`) VALUES
('3e192d5e-7e73-11ee-a023-f816547ffa99', 'lihua@example.com', '$2y$10$eZXBSgDRlQMsxcsBG.A18.oj2A93QqmLgzGEglyZThutbu1BZYqb', 'd81ffe84-7e72-11ee-a023-f816547ffa99'),
('cc444733-830d-11ee-8e19-f816547ffa99', 'sakara@example.com', '$2y$10$ye/hq4gd7VC8LkpaSxfC.uvur6MIljgXNrUkp2fDcpFNS.cMRlN.e', '96af4943-830d-11ee-8e19-f816547ffa99');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(100) NOT NULL DEFAULT uuid(),
  `avatar` mediumtext DEFAULT NULL,
  `role` enum('student','dos','receptionist','admin') NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `dob` date NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `avatar`, `role`, `first_name`, `last_name`, `gender`, `dob`, `created_on`) VALUES
('492ce896-8286-11ee-89d2-f816547ffa99', '', 'student', 'pemphero', 'mkuka', 'male', '2023-11-17', '2023-11-14 05:54:38'),
('793fcd6e-7e6d-11ee-a023-f816547ffa99', '', 'student', 'Alice', 'Johnson', 'female', '1999-05-15', '2023-11-14 04:41:48'),
('793fd3cd-7e6d-11ee-a023-f816547ffa99', '', 'student', 'Eva', 'Williams', 'female', '2000-03-10', '2023-11-14 04:41:48'),
('793fd45a-7e6d-11ee-a023-f816547ffa99', '', 'student', 'David', 'Brown', 'male', '1997-07-18', '2023-11-14 04:41:48'),
('793fd555-7e6d-11ee-a023-f816547ffa99', '', 'student', 'Liam', 'Miller', 'male', '1998-12-30', '2023-11-14 04:41:48'),
('793fd5ce-7e6d-11ee-a023-f816547ffa99', '', 'student', 'Sophia', 'Anderson', 'female', '2001-02-20', '2023-11-14 04:41:48'),
('96af4943-830d-11ee-8e19-f816547ffa99', NULL, 'admin', 'sakara', 'minori', 'female', '2001-11-20', '2023-11-14 16:48:08'),
('d81ffe84-7e72-11ee-a023-f816547ffa99', '', 'receptionist', 'li', 'hua', 'female', '2000-06-01', '2023-11-14 04:41:48');

-- --------------------------------------------------------

--
-- Table structure for table `user_contact`
--

CREATE TABLE `user_contact` (
  `contact_id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `phone_number` char(15) NOT NULL,
  `email` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_contact`
--

INSERT INTO `user_contact` (`contact_id`, `user_id`, `phone_number`, `email`) VALUES
(7, '793fcd6e-7e6d-11ee-a023-f816547ffa99', '1234567890', 'aliceJs@example.com'),
(9, '793fd3cd-7e6d-11ee-a023-f816547ffa99', '3456789012', 'evaW@example.com'),
(10, '793fd45a-7e6d-11ee-a023-f816547ffa99', '4567890123', 'davidB@example.com'),
(13, '793fd5ce-7e6d-11ee-a023-f816547ffa99', '7890123456', 'sophiaA@example.com'),
(20, '492ce896-8286-11ee-89d2-f816547ffa99', '0009999399', 'pheromkuka49@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `balances`
--
ALTER TABLE `balances`
  ADD PRIMARY KEY (`balance_id`),
  ADD KEY `medication_id` (`medication_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `medication`
--
ALTER TABLE `medication`
  ADD PRIMARY KEY (`medication_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`record_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `medication_id` (`medication_id`),
  ADD KEY `services_id` (`services_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `Students`
--
ALTER TABLE `Students`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `stuff`
--
ALTER TABLE `stuff`
  ADD PRIMARY KEY (`stuff_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_contact`
--
ALTER TABLE `user_contact`
  ADD PRIMARY KEY (`contact_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `balances`
--
ALTER TABLE `balances`
  MODIFY `balance_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `record_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_contact`
--
ALTER TABLE `user_contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `balances`
--
ALTER TABLE `balances`
  ADD CONSTRAINT `balances_ibfk_1` FOREIGN KEY (`medication_id`) REFERENCES `medication` (`medication_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `balances_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `records`
--
ALTER TABLE `records`
  ADD CONSTRAINT `records_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `records_ibfk_2` FOREIGN KEY (`medication_id`) REFERENCES `medication` (`medication_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `records_ibfk_3` FOREIGN KEY (`services_id`) REFERENCES `services` (`service_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Students`
--
ALTER TABLE `Students`
  ADD CONSTRAINT `Students_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stuff`
--
ALTER TABLE `stuff`
  ADD CONSTRAINT `stuff_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_contact`
--
ALTER TABLE `user_contact`
  ADD CONSTRAINT `user_contact_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
