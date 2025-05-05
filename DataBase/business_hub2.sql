-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2025 at 05:21 PM
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
-- Database: `business_hub2`
--
CREATE DATABASE IF NOT EXISTS `business_hub2` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `business_hub2`;

-- --------------------------------------------------------

--
-- Table structure for table `academic_staff`
--

DROP TABLE IF EXISTS `academic_staff`;
CREATE TABLE IF NOT EXISTS `academic_staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `office_location` varchar(255) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `department_id` (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `academic_staff`
--

INSERT INTO `academic_staff` (`id`, `name`, `email`, `linkedin`, `image`, `office_location`, `department_id`) VALUES
(1, 'Dr. Ayman Salameh', 'ayman@ju.edu.jo', 'https://linkedin.com/in/ayman', 'images/ayman.jpg', 'Building A - Room 101', 1),
(2, 'Dr. Rania Haddad', 'rania@ju.edu.jo', 'https://linkedin.com/in/rania', 'images/rania.jpg', 'Building B - Room 202', 2);

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_id` int(11) DEFAULT NULL,
  `book_name` varchar(255) DEFAULT NULL,
  `book_material` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `department_id` (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `department_id`, `book_name`, `book_material`) VALUES
(1, 1, 'MIS Book A', 'materials/mis_book_a.pdf'),
(2, 2, 'Marketing Book B', 'materials/marketing_book_b.pdf'),
(3, 6, 'Intro to MIS 222', 'https://noorplay.com/ar'),
(4, 1, 'one', 'dgfshsedgfh'),
(5, 1, 'two', 'sdklajf;lqa'),
(6, 1, 'three', 'asdgasfd'),
(7, 1, 'four', 'asdgf'),
(8, 1, 'five', 'asdfg'),
(9, 1, 'six', 'sadgsa'),
(10, 1, 'seven', 'asgasfg');

-- --------------------------------------------------------

--
-- Table structure for table `book_exchange`
--

DROP TABLE IF EXISTS `book_exchange`;
CREATE TABLE IF NOT EXISTS `book_exchange` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `department_id` (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_exchange`
--

INSERT INTO `book_exchange` (`id`, `book_name`, `image`, `department_id`) VALUES
(1, 'Business Research Methods', 'https://m.media-amazon.com/images/I/81-w3wQfp5L._AC_UF1000,1000_QL80_.jpg', 1),
(2, 'Principles of Marketing', 'https://www.neelwafurat.com/images/lb/abookstore/covers/normal/221/221059.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `book_offers`
--

DROP TABLE IF EXISTS `book_offers`;
CREATE TABLE IF NOT EXISTS `book_offers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `desired_book_id` int(11) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `timestamp` datetime DEFAULT current_timestamp(),
  `status` enum('active','dropped') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`),
  KEY `book_id` (`book_id`),
  KEY `user_id` (`user_id`),
  KEY `desired_book_id` (`desired_book_id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_offers`
--

INSERT INTO `book_offers` (`id`, `book_id`, `user_id`, `desired_book_id`, `details`, `timestamp`, `status`) VALUES
(41, 1, 4, NULL, '12343546', '2025-05-04 22:37:58', 'dropped'),
(46, 2, 1, NULL, 'aaaaaaaaaa', '2025-05-05 17:14:14', 'dropped'),
(47, 2, 1, NULL, 'abood book now', '2025-05-05 17:19:00', 'dropped'),
(48, 1, 1, NULL, 'abood book', '2025-05-05 17:58:22', 'dropped'),
(49, 2, 1, NULL, 'abood is testing', '2025-05-05 17:59:40', 'dropped');

-- --------------------------------------------------------

--
-- Table structure for table `book_requests`
--

DROP TABLE IF EXISTS `book_requests`;
CREATE TABLE IF NOT EXISTS `book_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `offer_id` int(11) DEFAULT NULL,
  `requester_id` int(11) DEFAULT NULL,
  `status` enum('pending','accepted','rejected','canceled') NOT NULL DEFAULT 'pending',
  `timestamp` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `offer_id` (`offer_id`),
  KEY `requester_id` (`requester_id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_requests`
--

INSERT INTO `book_requests` (`id`, `offer_id`, `requester_id`, `status`, `timestamp`) VALUES
(26, 41, 1, 'rejected', '2025-05-04 22:38:08'),
(27, 41, 1, 'rejected', '2025-05-04 22:58:23'),
(29, 46, 4, 'rejected', '2025-05-05 17:14:28'),
(31, 47, 4, 'canceled', '2025-05-05 17:45:24'),
(32, 47, 4, 'canceled', '2025-05-05 17:45:42'),
(33, 47, 4, 'rejected', '2025-05-05 17:45:51'),
(34, 47, 4, 'rejected', '2025-05-05 17:53:06'),
(35, 49, 4, 'canceled', '2025-05-05 18:00:13'),
(36, 49, 4, 'canceled', '2025-05-05 18:01:41'),
(37, 49, 4, 'canceled', '2025-05-05 18:02:05'),
(38, 49, 4, 'canceled', '2025-05-05 18:02:10'),
(39, 49, 4, 'canceled', '2025-05-05 18:02:47'),
(40, 49, 4, 'rejected', '2025-05-05 18:05:14');

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

DROP TABLE IF EXISTS `chat_messages`;
CREATE TABLE IF NOT EXISTS `chat_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `timestamp` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `sender_id` (`sender_id`),
  KEY `receiver_id` (`receiver_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat_messages`
--

INSERT INTO `chat_messages` (`id`, `sender_id`, `receiver_id`, `message`, `timestamp`) VALUES
(1, 1, 2, 'Hello, when can we meet for the book exchange?', '2025-04-18 15:34:27'),
(2, 2, 1, 'I am available tomorrow afternoon.', '2025-04-18 15:34:27');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_id` int(11) DEFAULT NULL,
  `course_name` varchar(255) DEFAULT NULL,
  `course_link` text DEFAULT NULL,
  `course_description` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `department_id` (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `department_id`, `course_name`, `course_link`, `course_description`) VALUES
(1, 1, 'Database Systems', 'http://example.com/db-course', 'Intro to databasesjnnjjnIntro to databasesjnnjjnIntro to databasesjnnjjnIntro to databasesjnnjjnIntro to databasesjnnjjnIntro to databasesjnnjjnIntro to databasesjnnjjnIntro to databasesjnnjjnIntro to databasesjnnjjnIntro to databasesjnnjjnIntro to databasesjnnjjn'),
(2, 2, 'Marketing Strategies', 'http://example.com/marketing-course', 'Advanced marketing concepts');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_name`, `description`) VALUES
(1, 'MIS', NULL),
(2, 'Marketing', NULL),
(3, 'Finance', NULL),
(4, 'Accounting', NULL),
(5, 'Business Economics', NULL),
(6, 'Public Administration', NULL),
(7, 'Business Adminstration', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `action_id` int(11) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `receiver_id` (`receiver_id`),
  KEY `action_id` (`action_id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `receiver_id`, `action_id`, `type`, `message`, `is_read`, `created_at`) VALUES
(28, 4, 1, NULL, 'request_rejected', 'Ahmad rejected your book request.', 1, '2025-05-04 19:27:48'),
(30, 4, 1, NULL, 'request_rejected', 'Ahmad rejected your book request.', 1, '2025-05-04 19:38:26'),
(32, 4, 1, NULL, 'request_rejected', 'Ahmad rejected your book request.', 1, '2025-05-04 19:59:01'),
(35, 1, 4, NULL, 'request_rejected', 'Abood rejected your book request.', 1, '2025-05-05 14:14:57'),
(37, 4, 1, 31, 'book_request', 'Ahmad Qudah has requested your book', 1, '2025-05-05 14:45:24'),
(38, 4, 1, 32, 'book_request', 'Ahmad Qudah has requested your book', 1, '2025-05-05 14:45:42'),
(40, 1, 4, NULL, 'request_rejected', 'Abood rejected your book request.', 1, '2025-05-05 14:50:24'),
(42, 1, 4, NULL, 'request_rejected', 'Abood rejected your book request.', 1, '2025-05-05 14:54:36'),
(43, 1, 4, NULL, 'request_rejected', 'Abood rejected your book request.', 1, '2025-05-05 14:54:36'),
(44, 4, 1, 35, 'book_request', 'Ahmad Qudah has requested your book', 1, '2025-05-05 15:00:13'),
(45, 4, 1, 36, 'book_request', 'Ahmad Qudah has requested your book', 1, '2025-05-05 15:01:41'),
(46, 4, 1, 37, 'book_request', 'Ahmad Qudah has requested your book', 1, '2025-05-05 15:02:05'),
(47, 4, 1, 38, 'book_request', 'Ahmad Qudah has requested your book', 1, '2025-05-05 15:02:10'),
(48, 4, 1, 39, 'book_request', 'Ahmad Qudah has requested your book', 1, '2025-05-05 15:02:47'),
(50, 1, 4, NULL, 'request_rejected', 'Abood rejected your book request.', 0, '2025-05-05 15:05:35'),
(51, 1, 4, NULL, 'request_rejected', 'Abood rejected your book request.', 0, '2025-05-05 15:05:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('user','super_admin') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_blocked` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `phone`, `password`, `role`, `created_at`, `is_blocked`) VALUES
(1, 'Abood', 'Qudah', 'abood.qudah@gmail.com', '0790000000', 'abood123', 'super_admin', '2025-04-18 12:34:27', 0),
(2, 'Jane', 'Doe', 'jane.doe@example.com', '0781234567', 'jane123', 'user', '2025-04-18 12:34:27', 0),
(3, 'Emad', 'Qudah', 'Emad.qudah@gmail.com', '0781245789', '$2y$10$fLoWrob7R.8LBlvG3sXUpOYesjSSDoiwtOq0u2o1900rXq/8mUgS.', 'user', '2025-04-18 18:44:48', 0),
(4, 'Ahmad', 'Qudah', 'ahmad.qudah@gmail.com', '0791197936', 'ahmad123', 'super_admin', '2025-04-18 20:05:12', 0),
(5, 'Leen', 'Ghanem', 'leen.ghanem@gmail.com', '0781543219', 'leen123', 'super_admin', '2025-04-19 12:00:23', 0),
(7, 'Ahmad', 'Manaseer', 'manaser.ahmad@gmail.com', '0787701415', 'ahmad123', 'user', '2025-04-19 18:49:40', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `academic_staff`
--
ALTER TABLE `academic_staff`
  ADD CONSTRAINT `academic_staff_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);

--
-- Constraints for table `book_exchange`
--
ALTER TABLE `book_exchange`
  ADD CONSTRAINT `book_exchange_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);

--
-- Constraints for table `book_offers`
--
ALTER TABLE `book_offers`
  ADD CONSTRAINT `book_offers_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book_exchange` (`id`),
  ADD CONSTRAINT `book_offers_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `book_offers_ibfk_3` FOREIGN KEY (`desired_book_id`) REFERENCES `book_exchange` (`id`);

--
-- Constraints for table `book_requests`
--
ALTER TABLE `book_requests`
  ADD CONSTRAINT `book_requests_ibfk_1` FOREIGN KEY (`offer_id`) REFERENCES `book_offers` (`id`),
  ADD CONSTRAINT `book_requests_ibfk_2` FOREIGN KEY (`requester_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD CONSTRAINT `chat_messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `chat_messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `notifications_ibfk_3` FOREIGN KEY (`action_id`) REFERENCES `book_requests` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
