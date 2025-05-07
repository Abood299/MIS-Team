-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2025 at 02:43 PM
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

CREATE TABLE `academic_staff` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `office_location` varchar(255) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `book_name` varchar(255) DEFAULT NULL,
  `book_material` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

CREATE TABLE `book_exchange` (
  `id` int(11) NOT NULL,
  `book_name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

CREATE TABLE `book_offers` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `desired_book_id` int(11) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `timestamp` datetime DEFAULT current_timestamp(),
  `status` enum('active','dropped') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_offers`
--

INSERT INTO `book_offers` (`id`, `book_id`, `user_id`, `desired_book_id`, `details`, `timestamp`, `status`) VALUES
(41, 1, 4, NULL, '12343546', '2025-05-04 22:37:58', 'dropped'),
(46, 2, 1, NULL, 'aaaaaaaaaa', '2025-05-05 17:14:14', 'dropped'),
(47, 2, 1, NULL, 'abood book now', '2025-05-05 17:19:00', 'dropped'),
(48, 1, 1, NULL, 'abood book', '2025-05-05 17:58:22', 'dropped'),
(49, 2, 1, NULL, 'abood is testing', '2025-05-05 17:59:40', 'dropped'),
(50, 2, 1, NULL, 'this is abood book', '2025-05-06 09:53:44', 'dropped'),
(51, 1, 4, NULL, 'ad', '2025-05-06 09:56:00', 'dropped'),
(52, 2, 4, NULL, 'aaa', '2025-05-06 09:56:11', 'dropped'),
(53, 2, 1, NULL, 'abood book', '2025-05-06 20:31:39', 'dropped'),
(54, 2, 1, NULL, 'aaaaaaaaaa', '2025-05-06 22:20:20', 'dropped'),
(55, 1, 1, NULL, 'gggggggg', '2025-05-06 22:28:46', 'dropped'),
(56, 1, 4, NULL, 'aaaaaaaaa', '2025-05-06 22:31:02', 'dropped'),
(57, 2, 4, NULL, 'sddfdsa', '2025-05-06 22:41:22', 'dropped'),
(58, 2, 4, NULL, 'لا لا لا', '2025-05-06 22:53:17', 'dropped'),
(59, 2, 4, NULL, 'شششششششششش', '2025-05-06 23:02:27', 'dropped'),
(60, 2, 4, NULL, 'سيبئ', '2025-05-06 23:08:09', 'dropped'),
(61, 1, 4, NULL, 'sfdag', '2025-05-06 23:31:43', 'dropped'),
(62, 2, 4, NULL, 'aaaa', '2025-05-07 13:48:40', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `book_requests`
--

CREATE TABLE `book_requests` (
  `id` int(11) NOT NULL,
  `offer_id` int(11) DEFAULT NULL,
  `requester_id` int(11) DEFAULT NULL,
  `status` enum('pending','accepted','rejected','canceled') NOT NULL DEFAULT 'pending',
  `timestamp` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(40, 49, 4, 'rejected', '2025-05-05 18:05:14'),
(41, 50, 4, 'rejected', '2025-05-06 09:56:27'),
(42, 53, 4, 'canceled', '2025-05-06 20:32:19'),
(43, 53, 4, 'rejected', '2025-05-06 20:32:24'),
(44, 54, 4, 'accepted', '2025-05-06 22:20:30'),
(45, 55, 4, 'accepted', '2025-05-06 22:28:55'),
(46, 56, 1, 'accepted', '2025-05-06 22:31:46'),
(47, 57, 1, 'accepted', '2025-05-06 22:41:35'),
(48, 58, 1, 'accepted', '2025-05-06 22:53:24'),
(49, 59, 1, 'accepted', '2025-05-06 23:02:40'),
(50, 60, 1, 'accepted', '2025-05-06 23:08:16'),
(51, 60, 1, 'accepted', '2025-05-06 23:16:24'),
(52, 61, 1, 'accepted', '2025-05-06 23:32:02'),
(53, 61, 1, 'accepted', '2025-05-07 13:46:36'),
(54, 62, 1, 'accepted', '2025-05-07 13:49:06'),
(55, 62, 1, 'accepted', '2025-05-07 14:10:42'),
(56, 62, 1, 'accepted', '2025-05-07 14:31:06');

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` int(11) NOT NULL,
  `request_id` int(11) DEFAULT NULL,
  `user1_id` int(11) NOT NULL,
  `user2_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `request_id`, `user1_id`, `user2_id`, `created_at`) VALUES
(1, 47, 4, 1, '2025-05-06 19:44:15'),
(2, 48, 4, 1, '2025-05-06 19:53:32'),
(3, 49, 4, 1, '2025-05-06 20:02:52'),
(4, 50, 4, 1, '2025-05-06 20:08:28'),
(5, 51, 4, 1, '2025-05-06 20:16:45'),
(6, 52, 4, 1, '2025-05-06 20:32:10'),
(7, 53, 4, 1, '2025-05-07 10:48:13'),
(8, 54, 4, 1, '2025-05-07 10:49:14'),
(9, 55, 4, 1, '2025-05-07 11:14:37'),
(10, 56, 4, 1, '2025-05-07 11:31:40');

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `id` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat_messages`
--

INSERT INTO `chat_messages` (`id`, `chat_id`, `sender_id`, `receiver_id`, `message`, `timestamp`) VALUES
(1, 2, 4, 4, 'سشسش', '2025-05-06 19:57:28'),
(2, 2, 4, 4, 'شششششششش', '2025-05-06 19:57:33'),
(3, 3, 4, 4, 'شش', '2025-05-06 20:03:17'),
(4, 3, 4, 4, 'سس', '2025-05-06 20:07:29'),
(5, 4, 4, 4, 'ش', '2025-05-06 20:08:32'),
(6, 4, 4, 4, 'a', '2025-05-06 20:15:06'),
(7, 5, 4, 1, 'a', '2025-05-06 20:23:11'),
(8, 5, 4, 1, 'dsfkj', '2025-05-06 20:25:54'),
(9, 6, 4, 1, 'مرحبا كيف الاقيك', '2025-05-06 20:32:18'),
(10, 6, 4, 1, 'مرحبا كيف الاقيك', '2025-05-06 20:35:43'),
(11, 6, 4, 1, 'مرحبا', '2025-05-06 20:35:46'),
(12, 6, 4, 1, 'كيف الاقيك', '2025-05-06 20:35:52'),
(13, 6, 1, 4, 'هلا اخوي', '2025-05-06 20:36:16'),
(14, 6, 1, 4, 'اموري طيبة', '2025-05-06 20:36:25'),
(15, 6, 1, 4, 'انت كيفك', '2025-05-06 20:36:30'),
(16, 8, 4, 1, 'a', '2025-05-07 10:49:24'),
(17, 6, 4, 1, 'aa', '2025-05-07 11:14:28'),
(18, 9, 4, 1, 'aaaa', '2025-05-07 11:14:40'),
(19, 10, 4, 1, 'aqa', '2025-05-07 11:31:42'),
(20, 10, 1, 4, 'aaa', '2025-05-07 11:51:31'),
(21, 9, 1, 4, 'cxdxf', '2025-05-07 12:20:47'),
(22, 9, 1, 4, 'sdfgsfaa', '2025-05-07 12:21:14'),
(23, 9, 4, 1, 'asrfhsdfgjdgfj', '2025-05-07 12:21:44'),
(24, 9, 4, 1, 'asfhstedhsdfjt', '2025-05-07 12:21:46'),
(25, 9, 4, 1, 'sadgjhsedtgjstedrju', '2025-05-07 12:21:48'),
(26, 9, 1, 4, 'chgvjcfhdjk', '2025-05-07 12:22:24'),
(27, 9, 1, 4, '1', '2025-05-07 12:23:21');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `course_name` varchar(255) DEFAULT NULL,
  `course_link` text DEFAULT NULL,
  `course_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `department_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `action_id` int(11) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `receiver_id`, `action_id`, `type`, `message`, `is_read`, `is_deleted`, `created_at`) VALUES
(28, 4, 1, NULL, 'request_rejected', 'Ahmad rejected your book request.', 1, 1, '2025-05-04 19:27:48'),
(30, 4, 1, NULL, 'request_rejected', 'Ahmad rejected your book request.', 1, 1, '2025-05-04 19:38:26'),
(32, 4, 1, NULL, 'request_rejected', 'Ahmad rejected your book request.', 1, 1, '2025-05-04 19:59:01'),
(35, 1, 4, NULL, 'request_rejected', 'Abood rejected your book request.', 1, 1, '2025-05-05 14:14:57'),
(37, 4, 1, 31, 'book_request', 'Ahmad Qudah has requested your book', 1, 1, '2025-05-05 14:45:24'),
(38, 4, 1, 32, 'book_request', 'Ahmad Qudah has requested your book', 1, 1, '2025-05-05 14:45:42'),
(40, 1, 4, NULL, 'request_rejected', 'Abood rejected your book request.', 1, 1, '2025-05-05 14:50:24'),
(42, 1, 4, NULL, 'request_rejected', 'Abood rejected your book request.', 1, 1, '2025-05-05 14:54:36'),
(43, 1, 4, NULL, 'request_rejected', 'Abood rejected your book request.', 1, 1, '2025-05-05 14:54:36'),
(44, 4, 1, 35, 'book_request', 'Ahmad Qudah has requested your book', 1, 1, '2025-05-05 15:00:13'),
(45, 4, 1, 36, 'book_request', 'Ahmad Qudah has requested your book', 1, 1, '2025-05-05 15:01:41'),
(46, 4, 1, 37, 'book_request', 'Ahmad Qudah has requested your book', 1, 1, '2025-05-05 15:02:05'),
(47, 4, 1, 38, 'book_request', 'Ahmad Qudah has requested your book', 1, 1, '2025-05-05 15:02:10'),
(48, 4, 1, 39, 'book_request', 'Ahmad Qudah has requested your book', 1, 1, '2025-05-05 15:02:47'),
(50, 1, 4, NULL, 'request_rejected', 'Abood rejected your book request.', 1, 1, '2025-05-05 15:05:35'),
(51, 1, 4, NULL, 'request_rejected', 'Abood rejected your book request.', 1, 1, '2025-05-05 15:05:35'),
(53, 1, 4, NULL, 'request_rejected', 'Abood rejected your book request.', 1, 1, '2025-05-06 06:56:58'),
(54, 1, 4, NULL, 'request_rejected', 'Abood rejected your book request.', 1, 1, '2025-05-06 06:56:58'),
(55, 4, 1, 42, 'book_request', 'Ahmad Qudah has requested your book', 1, 1, '2025-05-06 17:32:19'),
(57, 1, 4, NULL, 'request_rejected', 'Abood rejected your book request.', 1, 1, '2025-05-06 17:32:45'),
(58, 4, 1, 44, 'book_request', 'Ahmad Qudah has requested your book', 1, 1, '2025-05-06 19:20:30'),
(59, 1, 4, 44, 'request_accepted', 'Abood accepted your request.', 1, 1, '2025-05-06 19:20:40'),
(60, 4, 1, 45, 'book_request', 'Ahmad Qudah has requested your book', 1, 1, '2025-05-06 19:28:55'),
(61, 1, 4, 45, 'request_accepted', 'Abood accepted your request.', 1, 1, '2025-05-06 19:29:07'),
(62, 1, 4, 46, 'book_request', 'Abood Qudah has requested your book', 1, 1, '2025-05-06 19:31:46'),
(63, 4, 1, 46, 'request_accepted', 'Ahmad accepted your request.', 1, 1, '2025-05-06 19:31:54'),
(64, 1, 4, 47, 'book_request', 'Abood Qudah has requested your book', 1, 1, '2025-05-06 19:41:35'),
(65, 4, 1, 47, 'request_accepted', 'Ahmad accepted your request.', 1, 1, '2025-05-06 19:44:15'),
(66, 1, 4, 48, 'book_request', 'Abood Qudah has requested your book', 1, 1, '2025-05-06 19:53:24'),
(67, 4, 1, 48, 'request_accepted', 'Ahmad accepted your request.', 1, 1, '2025-05-06 19:53:32'),
(68, 1, 4, 49, 'book_request', 'Abood Qudah has requested your book', 1, 1, '2025-05-06 20:02:40'),
(69, 4, 1, 49, 'request_accepted', 'Ahmad accepted your request.', 1, 1, '2025-05-06 20:02:52'),
(70, 1, 4, 50, 'book_request', 'Abood Qudah has requested your book', 1, 1, '2025-05-06 20:08:16'),
(71, 4, 1, 50, 'request_accepted', 'Ahmad accepted your request.', 1, 1, '2025-05-06 20:08:28'),
(72, 1, 4, 51, 'book_request', 'Abood Qudah has requested your book', 1, 1, '2025-05-06 20:16:24'),
(73, 4, 1, 51, 'request_accepted', 'Ahmad accepted your request.', 1, 1, '2025-05-06 20:16:45'),
(74, 1, 4, 52, 'book_request', 'Abood Qudah has requested your book', 1, 1, '2025-05-06 20:32:02'),
(75, 4, 1, 52, 'request_accepted', 'Ahmad accepted your request.', 1, 1, '2025-05-06 20:32:10'),
(77, 4, 1, 52, 'new_message', 'Ahmad sent you a message.', 1, 1, '2025-05-06 20:35:43'),
(78, 4, 1, 52, 'new_message', 'Ahmad sent you a message.', 1, 1, '2025-05-06 20:35:46'),
(79, 4, 1, 52, 'new_message', 'Ahmad sent you a message.', 1, 1, '2025-05-06 20:35:52'),
(80, 1, 4, 52, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-06 20:36:16'),
(81, 1, 4, 52, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-06 20:36:25'),
(82, 1, 4, 52, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-06 20:36:30'),
(83, 1, 4, 53, 'book_request', 'Abood Qudah has requested your book', 1, 1, '2025-05-07 10:46:36'),
(84, 4, 1, 53, 'request_accepted', 'Ahmad accepted your request.', 1, 1, '2025-05-07 10:48:13'),
(85, 1, 4, 54, 'book_request', 'Abood Qudah has requested your book', 1, 1, '2025-05-07 10:49:06'),
(86, 4, 1, 54, 'request_accepted', 'Ahmad accepted your request.', 1, 1, '2025-05-07 10:49:14'),
(87, 4, 1, 54, 'new_message', 'Ahmad sent you a message.', 1, 1, '2025-05-07 10:49:24'),
(88, 1, 4, 55, 'book_request', 'Abood Qudah has requested your book', 1, 1, '2025-05-07 11:10:42'),
(89, 4, 1, 52, 'new_message', 'Ahmad sent you a message.', 1, 1, '2025-05-07 11:14:28'),
(90, 4, 1, 55, 'request_accepted', 'Ahmad accepted your request.', 1, 1, '2025-05-07 11:14:37'),
(91, 4, 1, 55, 'new_message', 'Ahmad sent you a message.', 1, 1, '2025-05-07 11:14:40'),
(92, 1, 4, 56, 'book_request', 'Abood Qudah has requested your book', 1, 0, '2025-05-07 11:31:06'),
(93, 4, 1, 56, 'request_accepted', 'Ahmad accepted your request.', 1, 1, '2025-05-07 11:31:40'),
(94, 4, 1, 56, 'new_message', 'Ahmad sent you a message.', 1, 1, '2025-05-07 11:31:42'),
(95, 1, 4, 56, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-07 11:51:31'),
(96, 1, 4, 55, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-07 12:20:47'),
(97, 1, 4, 55, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-07 12:21:14'),
(98, 4, 1, 55, 'new_message', 'Ahmad sent you a message.', 1, 0, '2025-05-07 12:21:44'),
(99, 4, 1, 55, 'new_message', 'Ahmad sent you a message.', 1, 0, '2025-05-07 12:21:46'),
(100, 4, 1, 55, 'new_message', 'Ahmad sent you a message.', 1, 0, '2025-05-07 12:21:48'),
(101, 1, 4, 55, 'new_message', 'Abood sent you a message.', 1, 0, '2025-05-07 12:22:24'),
(102, 1, 4, 55, 'new_message', 'Abood sent you a message.', 0, 0, '2025-05-07 12:23:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `avatar_url` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('user','super_admin') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_blocked` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `avatar_url`, `email`, `phone`, `password`, `role`, `created_at`, `is_blocked`) VALUES
(1, 'Abood', 'Qudah', NULL, 'abood.qudah@gmail.com', '0790000000', '1', 'super_admin', '2025-04-18 12:34:27', 0),
(2, 'Jane', 'Doe', NULL, 'jane.doe@example.com', '0781234567', 'jane123', 'user', '2025-04-18 12:34:27', 0),
(3, 'Emad', 'Qudah', NULL, 'Emad.qudah@gmail.com', '0781245789', '$2y$10$fLoWrob7R.8LBlvG3sXUpOYesjSSDoiwtOq0u2o1900rXq/8mUgS.', 'user', '2025-04-18 18:44:48', 0),
(4, 'Ahmad', 'Qudah', NULL, 'ahmad.qudah@gmail.com', '0791197936', '1', 'super_admin', '2025-04-18 20:05:12', 0),
(5, 'Leen', 'Ghanem', NULL, 'leen.ghanem@gmail.com', '0781543219', 'leen123', 'super_admin', '2025-04-19 12:00:23', 0),
(7, 'Ahmad', 'Manaseer', NULL, 'manaser.ahmad@gmail.com', '0787701415', 'ahmad123', 'user', '2025-04-19 18:49:40', 0),
(8, 'ali', 'sami', NULL, 'ali.qudah@gmail.com', '0787745136', 'a', 'user', '2025-05-06 19:42:36', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_staff`
--
ALTER TABLE `academic_staff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `book_exchange`
--
ALTER TABLE `book_exchange`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `book_offers`
--
ALTER TABLE `book_offers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `desired_book_id` (`desired_book_id`);

--
-- Indexes for table `book_requests`
--
ALTER TABLE `book_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offer_id` (`offer_id`),
  ADD KEY `requester_id` (`requester_id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `request_id` (`request_id`),
  ADD KEY `user1_id` (`user1_id`),
  ADD KEY `user2_id` (`user2_id`);

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_id` (`chat_id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `receiver_id` (`receiver_id`),
  ADD KEY `action_id` (`action_id`);

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
-- AUTO_INCREMENT for table `academic_staff`
--
ALTER TABLE `academic_staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `book_exchange`
--
ALTER TABLE `book_exchange`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `book_offers`
--
ALTER TABLE `book_offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `book_requests`
--
ALTER TABLE `book_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
-- Constraints for table `chats`
--
ALTER TABLE `chats`
  ADD CONSTRAINT `chats_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `book_requests` (`id`),
  ADD CONSTRAINT `chats_ibfk_2` FOREIGN KEY (`user1_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `chats_ibfk_3` FOREIGN KEY (`user2_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD CONSTRAINT `chat_messages_ibfk_1` FOREIGN KEY (`chat_id`) REFERENCES `chats` (`id`),
  ADD CONSTRAINT `chat_messages_ibfk_2` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `chat_messages_ibfk_3` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`);

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
