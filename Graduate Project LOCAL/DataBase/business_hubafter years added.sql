-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2025 at 06:10 PM
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
(1, ' Salameh', 'ayman@ju.edu.jo', 'https://linkedin.com/in/ayman', 'images/ayman.jpg', 'Building A - Room 101', 1),
(2, 'Dr. Rania Haddad', 'rania@ju.edu.jo', 'https://linkedin.com/in/rania', 'images/rania.jpg', 'Building B - Room 202', 2),
(60, 'جمانة زياد الزعبي', 'j.zoubi@ju.edu.jo', 'https://business.ju.edu.jo/ar/Arabic/Lists/FacultyAcademicStaff/StaffDisp.aspx?id=123', 'JumanaZoubi.jpg', 'مبنى 3 الطابق الأرضي', 6),
(61, 'محمود محمد مقابلة', 'maqableh@ju.edu.jo', 'https://business.ju.edu.jo/ar/Arabic/Lists/FacultyAcademicStaff/StaffDisp.aspx?id=78', 'mahmoudmaqableh.jpg', 'مبنى 4 الطابق الثاني', 1),
(62, 'هزار ياسر الحمود', 'h.hmoud@ju.edu.jo', 'https://business.ju.edu.jo/ar/Arabic/Lists/FacultyAcademicStaff/StaffDisp.aspx?id=104', 'hazarhmoud.jpg', 'مبنى 4 الطابق الأرضي', 1),
(63, 'محمود علي الدلاهمة', 'm.aldalahmeh@ju.edu.jo', 'https://business.ju.edu.jo/ar/Arabic/Lists/FacultyAcademicStaff/StaffDisp.aspx?id=43', 'الدلاهمة.jpg', 'مبنى 4 الطابق الأرضي', 1),
(64, 'ليلى علي ذهيبة', 'laila.dahabiyeh@ju.edu.jo', 'https://business.ju.edu.jo/ar/Arabic/Lists/FacultyAcademicStaff/StaffDisp.aspx?id=105', 'Laila.jpg', 'مبنى 1 الطابق الأرضي', 1),
(65, 'هاني حامد الضمور', 'dmourh@ju.edu.jo', 'https://business.ju.edu.jo/ar/Arabic/Lists/FacultyAcademicStaff/StaffDisp.aspx?id=33', 'هاني-الضمور.jpg', 'مبنى 4 الطابق الثاني', 2),
(66, 'زيد محمد عبيدات', 'z.obeidat@ju.edu.jo', 'https://business.ju.edu.jo/ar/Arabic/Lists/FacultyAcademicStaff/StaffDisp.aspx?id=116', 'زيد-عبيدات.jpg', 'مبنى 4 الطابق الثاني', 2),
(67, 'رامي محمد الدويري', 'r.dweeri@ju.edu.jo', 'https://business.ju.edu.jo/ar/Arabic/Lists/FacultyAcademicStaff/StaffDisp.aspx?id=114', 'رامي-دويري.jpg', 'مبنى 4 الطابق الثاني', 2),
(68, 'آيات مازن المحمود', 'a.alhawary@ju.edu.jo', 'https://business.ju.edu.jo/ar/Arabic/Lists/FacultyAcademicStaff/StaffDisp.aspx?id=119', 'Ayat.jpg', 'مبنى 3 الطابق الأرضي', 2),
(69, 'فرح ملك شيشان', 'f.shishan@ju.edu.jo', 'https://business.ju.edu.jo/ar/Arabic/Lists/FacultyAcademicStaff/StaffDisp.aspx?id=106https://business.ju.edu.jo/ar/Arabic/Lists/FacultyAcademicStaff/StaffDisp.aspx?id=106', 'Farahb.jpg', 'مبنى 3 الطابق الأرضي', 2),
(70, 'دانا فوزي قاقيش', 'Dana.Kakeesh@ju.edu.jo', 'https://business.ju.edu.jo/ar/Arabic/Lists/FacultyAcademicStaff/StaffDisp.aspx?id=107', 'DanaKakeesh.jpg', 'مبنى 3 الطابق الأرضي', 2),
(71, 'معتز محمد الدبعي', 'm.aldebei@ju.edu.jo', 'https://business.ju.edu.jo/ar/Arabic/Lists/FacultyAcademicStaff/StaffDisp.aspx?id=77', 'معتز-الدبعي.jpg', 'مبنى 4 الطابق الأول', 1),
(72, 'اشرف عادل بني محمد', 'a.bany@ju.edu.jo', 'https://business.ju.edu.jo/ar/Arabic/Lists/FacultyAcademicStaff/StaffDisp.aspx?id=95', 'ashraf.jpg', 'مبنى 4 الطابق الثاني', 1),
(73, 'رند هاني الضمور', 'Rand.aldmour@ju.edu.jo', 'https://business.ju.edu.jo/ar/Arabic/Lists/FacultyAcademicStaff/StaffDisp.aspx?id=98', 'rand-aldmour.jpg', 'مبنى 4 الطابق الأول', 1),
(74, 'محمد خالد النوايسة', 'm.nawaiseh@ju.edu.jo', 'https://business.ju.edu.jo/ar/Arabic/Lists/FacultyAcademicStaff/StaffDisp.aspx?id=134', 'محمد-النوايسة.jpg', 'مبنى 4 الطابق الأول', 1),
(75, 'أسماء محمد جديتاوي (رئيس قسم)', 'a.jdaitawi@ju.edu.jo', 'https://business.ju.edu.jo/ar/Arabic/Lists/FacultyAcademicStaff/StaffDisp.aspx?id=100', 'AsmaJdaitawe.jpg', 'مبنى 4 الطابق الأرضي', 1),
(76, 'رفعت عودة الله الشناق', 'rshannak@ju.edu.jo', 'https://business.ju.edu.jo/ar/Arabic/Lists/FacultyAcademicStaff/StaffDisp.aspx?id=42', 'RifatShannak.jpg', 'مبنى 4 الطابق الأول', 1),
(77, 'رائد مساعده بني ياسين', 'r.masadeh@ju.edu.jo', 'https://business.ju.edu.jo/ar/Arabic/Lists/FacultyAcademicStaff/StaffDisp.aspx?id=44', 'رائد-مساعده.jpg', 'مبنى 1 الطابق الأرضي', 1),
(78, 'بشير أحمد خميس', 'basheer@ju.edu.jo', 'https://business.ju.edu.jo/ar/Arabic/Lists/FacultyAcademicStaff/StaffDisp.aspx?id=17', 'بشير-خميس.jpg', 'مبنى 3 الطابق الأرضي', 4),
(79, 'احمد لطفي احمد', 'a.jitawi@ju.edu.jo', 'https://business.ju.edu.jo/ar/Arabic/Lists/FacultyAcademicStaff/StaffDisp.aspx?id=132', 'ahmad12.jpg', 'مبنى 3 الطابق الأرضي', 4),
(80, 'بتول بسام عبد الدايم', 'b.Abdeldayem@ju.edu.jo', 'https://business.ju.edu.jo/ar/Arabic/Lists/FacultyAcademicStaff/StaffDisp.aspx?id=157', 'بتول-بسام.jpg', 'مبنى 2 الطابق الأرضي', 4),
(81, 'عمر تيسير موافي (رئيس القسم)', 'o.mowafi@ju.edu.jo', 'https://business.ju.edu.jo/ar/Arabic/Lists/FacultyAcademicStaff/StaffDisp.aspx?id=158', 'عمر-الموافي.jpg', 'مبنى 2 الطابق الأرضي', 4),
(82, 'ياسر محمد اللوزي', 'y.allozi@ju.edu.jo', 'https://business.ju.edu.jo/ar/Arabic/Lists/FacultyAcademicStaff/StaffDisp.aspx?id=164', 'ياسر-اللوزي.jpg', 'مبنى 3 الطابق الأرضي', 4),
(83, 'آمنة خميس حمد', 'a.hamad@ju.edu.jo', 'https://business.ju.edu.jo/ar/Arabic/Lists/FacultyAcademicStaff/StaffDisp.aspx?id=19', 'امنه-خميس.jpg', 'مبنى 3 الطابق الأرضي', 4),
(84, 'ياسين ممدوح الطراونة', 'y.tarawneh@ju.edu.jo', 'https://business.ju.edu.jo/ar/Arabic/Lists/FacultyAcademicStaff/StaffDisp.aspx?id=142', 'YaseenAltarawneh.jpg', 'مبنى 2 الطابق الأرضي', 5),
(85, 'هديل صلاح ياسين', 'h.yaseen@ju.edu.jo', 'https://business.ju.edu.jo/ar/Arabic/Lists/FacultyAcademicStaff/StaffDisp.aspx?id=133', 'هديل-الياسين.jpg', 'مبنى 3 الطابق الاول', 3),
(86, 'محمد عبدالله الخطايبه', 'khataybeh@ju.edu.jo', 'https://business.ju.edu.jo/ar/Arabic/Lists/FacultyAcademicStaff/StaffDisp.aspx?id=145', 'خطايبه.jpg', 'مبنى 3 الطابق الاول', 3),
(87, 'دعاء فوزي شبيطة', 'd.shubita@ju.edu.jo', 'https://business.ju.edu.jo/ar/Arabic/Lists/FacultyAcademicStaff/StaffDisp.aspx?id=31', 'دعاء-شبيطة.jpg', 'مبنى 3 الطابق الاول', 3),
(88, 'سالم عادل الزيادات', 's.ziadat@ju.edu.jo', 'https://business.ju.edu.jo/ar/Arabic/Lists/FacultyAcademicStaff/StaffDisp.aspx?id=211', 'سالم-الزيادات.jpg', 'مبنى 3 الطابق الاول', 3),
(89, 'مجد منير اسكندراني', 'm.iskandrani@ju.edu.jo', 'https://business.ju.edu.jo/ar/Arabic/Lists/FacultyAcademicStaff/StaffDisp.aspx?id=109', 'Majd.jpg', 'مبنى 2 الطابق الاول', 3),
(90, 'مهند حسين عبيدات', 'Obeidatmohanned@yahoo.com', 'https://business.ju.edu.jo/ar/Arabic/Lists/FacultyAcademicStaff/StaffDisp.aspx?id=155', 'مهند-عبيدات.jpg', 'مبنى 2 الطابق الاول', 3),
(91, 'نورا حامد ابو عصب', 'n.abuasab@ju.edu.jo', 'https://business.ju.edu.jo/ar/Arabic/Lists/FacultyAcademicStaff/StaffDisp.aspx?id=102', 'nora-abu-asab.jpg', 'مبنى 2 الطابق الاول', 5),
(92, 'خوله علي سبيتان', 'Khawlah.Spetan@ju.edu.jo', 'https://business.ju.edu.jo/ar/Arabic/Lists/FacultyAcademicStaff/StaffDisp.aspx?id=66', 'خوله-علي.jpg', 'مبنى 2 الطابق الاول', 5),
(93, 'زياد سامي الكلحة', 'z.kalha@ju.edu.jo', 'https://business.ju.edu.jo/ar/Arabic/Lists/FacultyAcademicStaff/StaffDisp.aspx?id=124', 'زياد-كلحه.jpg', 'مبنى 3 الطابق الأول', 7),
(94, 'تغريد صالح سعيفان', 't.suifan@ju.edu.jo', 'https://business.ju.edu.jo/ar/Arabic/Lists/FacultyAcademicStaff/StaffDisp.aspx?id=76', 'تغريد-سعيفان .jpg', 'مبنى 4 الطابق الثاني', 7),
(95, 'أيمن بهجت عبدالله', 'a.abdallah@ju.edu.jo', 'https://business.ju.edu.jo/ar/Arabic/Lists/FacultyAcademicStaff/StaffDisp.aspx?id=91', 'AymanAbdullah.jpg', 'مبنى 4 الطابق الاول', 7),
(96, 'معتصم محمد الذنيبات (رئيس القسم)', 'Motasem.thneibat@ju.edu.jo', 'https://business.ju.edu.jo/ar/Arabic/Lists/FacultyAcademicStaff/StaffDisp.aspx?id=147', 'motasemThunaibat.jpg', 'مبنى 4 الطابق الاول', 7),
(97, 'ريما وحيد الحسن', 'r.hasan@ju.edu.jo', 'https://business.ju.edu.jo/ar/Arabic/Lists/FacultyAcademicStaff/StaffDisp.aspx?id=111', 'ريما.jpg', 'مبنى 3 الطابق الأرضي', 7),
(98, 'سامر عيد الدحيات', 's.dahiyat@ju.edu.jo', 'https://business.ju.edu.jo/ar/Arabic/Lists/FacultyAcademicStaff/StaffDisp.aspx?id=8', 'Dr.Samer.jpg', 'مبنى 4 الطابق الأول', 7),
(99, 'نيفين مازن السيد', 'n.alsayed@ju.edu.jo', 'https://business.ju.edu.jo/ar/Arabic/Lists/FacultyAcademicStaff/StaffDisp.aspx?id=86', 'نيفين.jpg', 'مبنى 3 الطابق الأرضي', 7),
(100, 'زعبي محمد الزعبي', 'z.alzubi@ju.edu.jo', 'https://business.ju.edu.jo/ar/Arabic/Lists/FacultyAcademicStaff/StaffDisp.aspx?id=10', 'زعبي-الزعبي.jpg', 'مبنى 3 الطابق الأرضي', 7),
(101, 'راتب جليل صويص', 'r.sweis@ju.edu.jo', 'https://business.ju.edu.jo/ar/Arabic/Lists/FacultyAcademicStaff/StaffDisp.aspx?id=7', 'راتب-صويص.jpg', 'مبنى 4 الطابق الثاني', 7),
(102, 'علاء الدين عوض الطراونة', 'a.altarawneh@ju.edu.jo', 'https://business.ju.edu.jo/ar/Arabic/Lists/FacultyAcademicStaff/StaffDisp.aspx?id=83', 'علاء-طراونة.jpg', 'مبنى 2 الطابق الاول', 5),
(103, 'نهيل اسماعيل سقف الحيط', 'nahil.saqfalhait@ju.edu.jo', 'https://business.ju.edu.jo/ar/Arabic/Lists/FacultyAcademicStaff/StaffDisp.aspx?id=65', 'profnaheel.jpg', 'مبنى 2 الطابق الاول', 5),
(104, 'محمد عاطف المومني', 'mo.almomani@ju.edu.jo', 'https://business.ju.edu.jo/ar/Arabic/Lists/FacultyAcademicStaff/StaffDisp.aspx?id=163', 'محمد-المومني.jpg', 'مبنى 2 الطابق الاول', 2),
(105, 'احمد محمد عبيدات', 'a.obeidat@ju.edu.jo', 'https://business.ju.edu.jo/ar/Arabic/Lists/FacultyAcademicStaff/StaffDisp.aspx?id=112', 'ahmadobeidat.jpg', 'مبنى 4 الطابق الثاني', 7),
(106, 'محمود عوده أبو فارس', 'm.abufares@ju.edu.jo', 'https://business.ju.edu.jo/ar/Arabic/Lists/FacultyAcademicStaff/StaffDisp.aspx?id=52', 'AboFares.jpg', 'مبنى 3 الطابق الأرضي', 6),
(107, 'عبد الحكيم عقلة اخو ارشيدة', 'a.hakim@ju.edu.jo', 'https://business.ju.edu.jo/ar/Arabic/Lists/FacultyAcademicStaff/StaffDisp.aspx?id=87', 'اخورشيده.jpg', 'مبنى 3 الطابق الأرضي', 6),
(108, 'غالب محمد أبو رمان', 'g.aburumman@ju.edu.jo', 'https://business.ju.edu.jo/ar/Arabic/Lists/FacultyAcademicStaff/StaffDisp.aspx?id=18', 'unkown.jpg', 'مبنى 3 الطابق الأرضي', 4);

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `year` enum('1','2','3','4') NOT NULL DEFAULT '1',
  `book_name` varchar(255) DEFAULT NULL,
  `book_material` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `department_id`, `year`, `book_name`, `book_material`) VALUES
(1, 1, '1', 'MIS Book A', 'materials/mis_book_a.pdf'),
(2, 2, '1', 'Marketing Book B', 'materials/marketing_book_b.pdf'),
(3, 6, '1', 'Intro to MIS 222', 'https://noorplay.com/ar'),
(4, 1, '1', 'one', 'dgfshsedgfh'),
(5, 1, '1', 'two', 'sdklajf;lqa'),
(6, 1, '1', 'three', 'asdgasfd'),
(7, 1, '1', 'four', 'asdgf'),
(8, 1, '1', 'five', 'asdfg'),
(9, 1, '1', 'six', 'sadgsa'),
(10, 1, '1', 'hhhhhhhhhh', 'asgasfg');

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
(1, 'Business Research Me', 'https://m.media-amazon.com/images/I/81-w3wQfp5L._AC_UF1000,1000_QL80_.jpg', 1),
(2, 'مبادئ تسويق', 'https://www.neelwafurat.com/images/lb/abookstore/covers/normal/221/221059.jpg', 2);

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
  `status` enum('active','dropped','exchanged') NOT NULL DEFAULT 'active'
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
(62, 2, 4, NULL, 'aaaa', '2025-05-07 13:48:40', 'dropped'),
(63, 1, 4, NULL, 'aaaaaaaaaaaaaaaaaaaaaa', '2025-05-09 16:03:00', 'dropped'),
(64, 1, 4, NULL, 'a', '2025-05-09 16:05:50', 'dropped'),
(65, 2, 4, NULL, 'bbbbbb', '2025-05-09 16:52:39', 'dropped'),
(66, 1, 1, NULL, '111111111', '2025-05-09 16:53:47', 'dropped'),
(67, 2, 1, NULL, 'AAAAAAA', '2025-05-09 17:10:03', 'dropped'),
(68, 1, 1, NULL, 'afg', '2025-05-09 17:50:56', 'dropped'),
(69, 2, 1, NULL, 'sadfg', '2025-05-09 17:57:22', 'dropped'),
(70, 2, 4, NULL, 'sde', '2025-05-09 18:00:08', 'dropped'),
(71, 1, 1, NULL, 'aaaaa', '2025-05-09 18:04:32', 'dropped'),
(72, 2, 1, NULL, 'ggggggggg', '2025-05-09 20:21:05', 'dropped'),
(73, 2, 1, NULL, 'agfdsg', '2025-05-09 20:39:57', 'dropped'),
(74, 2, 1, NULL, 'saaaaaaa', '2025-05-09 20:43:26', 'exchanged'),
(75, 1, 3, NULL, 'aaaaaaaagffsdah', '2025-05-09 20:55:13', 'exchanged'),
(76, 1, 1, NULL, 'aaaaaaaaaaaa', '2025-05-10 15:24:16', 'dropped'),
(77, 1, 1, NULL, 'ghhgggggggg', '2025-05-10 15:26:19', 'dropped'),
(78, 2, 1, NULL, 'aaaaaaaaa', '2025-05-10 15:31:21', 'dropped'),
(79, 2, 1, NULL, 'gf', '2025-05-10 17:23:42', 'dropped'),
(80, 2, 4, NULL, 'ش', '2025-05-10 17:58:01', 'dropped'),
(81, 2, 1, NULL, 'ش', '2025-05-10 18:03:21', 'dropped'),
(93, 1, 1, NULL, 'gggg', '2025-05-11 10:10:46', 'dropped'),
(94, 2, 1, NULL, 'this', '2025-05-11 10:16:32', 'dropped'),
(95, 1, 1, NULL, '1', '2025-05-11 10:19:43', 'exchanged'),
(96, 2, 1, NULL, 'شششششششش', '2025-05-11 17:54:51', 'dropped'),
(97, 1, 1, NULL, 'a', '2025-05-11 22:23:54', 'dropped'),
(98, 2, 1, NULL, 'a', '2025-05-11 22:24:29', 'dropped'),
(101, 1, 1, NULL, '131', '2025-05-12 17:00:14', 'dropped'),
(102, 2, 1, NULL, 'asdf', '2025-05-12 17:00:33', 'dropped'),
(103, 1, 1, NULL, 'a', '2025-05-12 17:02:54', 'dropped'),
(104, 2, 1, NULL, 'a', '2025-05-12 17:03:06', 'dropped'),
(105, 2, 1, NULL, 'dfd', '2025-05-12 17:04:07', 'dropped'),
(106, 2, 1, NULL, 'nnnnnnnnnnnn', '2025-05-12 17:05:46', 'dropped'),
(107, 2, 1, NULL, 'شسباسشيبا', '2025-05-12 17:44:58', 'dropped'),
(110, 2, 1, 1, 'بجرب قاعد', '2025-05-12 18:59:04', 'dropped'),
(111, 2, 1, NULL, 'شششششششششششششششش', '2025-05-12 20:46:44', 'dropped'),
(112, 2, 1, 1, 'بجرررررررررب', '2025-05-12 20:52:48', 'dropped'),
(113, 2, 1, NULL, 'شسلبيلتا', '2025-05-12 21:08:01', 'dropped'),
(114, 2, 1, NULL, 'سشبلسيشبل', '2025-05-12 21:57:09', 'dropped'),
(115, 2, 1, 1, 'انا عبدالله بدي اعطي مبادئ تسويق وبدي تخصص mis', '2025-05-12 22:28:47', 'dropped'),
(116, 2, 7, NULL, 'هاي الاداره العامه للزلام الي بده', '2025-05-12 22:55:20', 'exchanged'),
(117, 1, 3, NULL, 'شششششششششششش', '2025-05-12 22:58:15', 'exchanged'),
(118, 2, 1, NULL, 'aaaaaaaa', '2025-05-13 10:36:23', 'dropped'),
(119, 2, 4, NULL, 'aaaaaa', '2025-05-13 11:00:05', 'dropped'),
(120, 1, 1, 2, 'cvsdsfg', '2025-05-13 11:31:01', 'dropped'),
(121, 2, 1, NULL, 'safgsaf', '2025-05-13 11:36:31', 'exchanged'),
(122, 2, 1, NULL, 'a', '2025-05-13 11:40:36', 'dropped'),
(123, 2, 1, 1, 'sdgfhfsdg', '2025-05-13 11:52:48', 'dropped'),
(124, 2, 1, 1, 'هذه تجربه رائعة', '2025-05-13 11:57:59', 'dropped'),
(125, 1, 1, 2, 'يا رب', '2025-05-13 12:01:56', 'exchanged'),
(126, 1, 1, 2, 'اميزنق', '2025-05-13 12:19:38', 'dropped'),
(127, 2, 3, NULL, 'شششششششش', '2025-05-13 12:22:02', 'dropped'),
(128, 2, 3, NULL, 'aaaaaaaaa', '2025-05-13 17:11:21', 'dropped'),
(129, 2, 5, 1, 'بدي اجرب يخوان', '2025-05-13 18:02:23', 'dropped'),
(130, 1, 5, 2, 'الحمدلله زبط اول اشي', '2025-05-13 18:02:50', 'dropped'),
(131, 2, 5, NULL, 'شششششششش', '2025-05-13 18:19:26', 'exchanged'),
(132, 2, 5, NULL, 'ششششششش', '2025-05-13 22:32:39', 'exchanged'),
(133, 1, 7, NULL, 'كتاب مناصير', '2025-05-13 22:50:31', 'exchanged'),
(134, 1, 3, 2, 'انا عماد وبدي مين يبدل', '2025-05-13 23:00:55', 'exchanged'),
(135, 1, 7, 2, 'الو', '2025-05-13 23:04:56', 'exchanged'),
(136, 2, 8, NULL, 'هي كتابي علي', '2025-05-13 23:32:06', 'exchanged'),
(137, 2, 1, NULL, 'كتاب عبدالله الشمال', '2025-05-13 23:33:17', 'exchanged'),
(138, 1, 1, NULL, 'كتاب عبدالله اليمين', '2025-05-13 23:33:25', 'exchanged');

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
(56, 62, 1, 'accepted', '2025-05-07 14:31:06'),
(57, 62, 1, 'accepted', '2025-05-07 16:21:24'),
(58, 62, 1, 'accepted', '2025-05-08 11:14:55'),
(59, 62, 1, 'rejected', '2025-05-08 11:17:25'),
(60, 62, 7, 'accepted', '2025-05-08 11:17:41'),
(61, 62, 1, 'accepted', '2025-05-08 11:25:21'),
(62, 62, 7, 'rejected', '2025-05-08 11:26:14'),
(63, 62, 7, 'accepted', '2025-05-08 11:31:16'),
(64, 62, 1, 'rejected', '2025-05-09 15:57:11'),
(65, 62, 7, 'accepted', '2025-05-09 15:57:26'),
(66, 63, 1, 'accepted', '2025-05-09 16:03:09'),
(67, 63, 7, 'accepted', '2025-05-09 16:03:14'),
(68, 63, 5, 'accepted', '2025-05-09 16:03:23'),
(69, 63, 3, 'accepted', '2025-05-09 16:03:36'),
(70, 64, 7, 'accepted', '2025-05-09 16:05:57'),
(71, 64, 7, 'accepted', '2025-05-09 16:09:03'),
(72, 65, 1, 'accepted', '2025-05-09 16:52:51'),
(73, 66, 7, 'accepted', '2025-05-09 16:53:55'),
(74, 66, 7, 'accepted', '2025-05-09 16:54:39'),
(75, 66, 4, 'accepted', '2025-05-09 16:59:17'),
(76, 66, 4, 'rejected', '2025-05-09 17:00:58'),
(77, 67, 5, 'rejected', '2025-05-09 17:10:10'),
(78, 67, 4, 'accepted', '2025-05-09 17:29:24'),
(79, 67, 4, 'accepted', '2025-05-09 17:38:23'),
(80, 67, 4, 'accepted', '2025-05-09 17:40:23'),
(81, 68, 4, 'accepted', '2025-05-09 17:51:10'),
(82, 70, 7, 'accepted', '2025-05-09 18:01:23'),
(83, 71, 4, 'rejected', '2025-05-09 20:11:59'),
(84, 71, 7, 'rejected', '2025-05-09 20:12:06'),
(85, 71, 5, 'accepted', '2025-05-09 20:12:17'),
(86, 72, 4, 'rejected', '2025-05-09 20:21:38'),
(87, 72, 7, 'rejected', '2025-05-09 20:21:50'),
(88, 72, 5, 'accepted', '2025-05-09 20:21:59'),
(89, 73, 7, 'accepted', '2025-05-09 20:40:09'),
(90, 74, 7, 'accepted', '2025-05-09 20:43:31'),
(91, 75, 5, 'accepted', '2025-05-09 20:55:19'),
(92, 76, 7, 'accepted', '2025-05-10 15:24:31'),
(93, 77, 3, 'accepted', '2025-05-10 15:26:33'),
(94, 78, 4, 'accepted', '2025-05-10 15:31:30'),
(95, 78, 4, 'accepted', '2025-05-10 17:03:35'),
(96, 78, 7, 'accepted', '2025-05-10 17:10:08'),
(97, 78, 7, 'accepted', '2025-05-10 17:15:51'),
(98, 78, 7, 'accepted', '2025-05-10 17:20:38'),
(99, 78, 7, 'accepted', '2025-05-10 17:23:04'),
(100, 79, 7, 'accepted', '2025-05-10 17:26:37'),
(101, 79, 4, 'accepted', '2025-05-10 17:29:38'),
(102, 81, 3, 'canceled', '2025-05-10 22:37:37'),
(103, 81, 3, 'accepted', '2025-05-10 22:39:08'),
(104, 94, 4, 'accepted', '2025-05-11 10:17:36'),
(105, 95, 4, 'accepted', '2025-05-11 10:20:29'),
(106, 95, 5, 'rejected', '2025-05-11 10:20:40'),
(107, 95, 3, 'accepted', '2025-05-11 17:51:12'),
(109, 116, 3, 'accepted', '2025-05-12 22:55:36'),
(110, 117, 5, 'accepted', '2025-05-12 22:58:22'),
(115, 121, 4, 'accepted', '2025-05-13 11:36:39'),
(120, 125, 4, 'accepted', '2025-05-13 12:18:23'),
(121, 126, 3, 'rejected', '2025-05-13 12:21:25'),
(122, 127, 1, 'rejected', '2025-05-13 12:22:08'),
(123, 126, 3, 'canceled', '2025-05-13 17:07:34'),
(124, 126, 3, 'canceled', '2025-05-13 17:08:28'),
(125, 128, 7, 'canceled', '2025-05-13 17:11:27'),
(126, 126, 5, '', '2025-05-13 17:15:33'),
(127, 126, 5, '', '2025-05-13 17:20:33'),
(128, 126, 5, '', '2025-05-13 17:20:58'),
(129, 126, 5, 'rejected', '2025-05-13 17:24:01'),
(130, 126, 7, '', '2025-05-13 17:27:43'),
(131, 126, 7, '', '2025-05-13 17:52:34'),
(132, 130, 3, '', '2025-05-13 18:03:00'),
(133, 130, 3, 'canceled', '2025-05-13 18:06:31'),
(134, 131, 7, 'rejected', '2025-05-13 18:19:33'),
(135, 131, 7, 'rejected', '2025-05-13 18:23:01'),
(136, 131, 7, 'rejected', '2025-05-13 18:23:54'),
(137, 131, 7, 'rejected', '2025-05-13 18:27:18'),
(138, 131, 4, 'accepted', '2025-05-13 18:52:34'),
(139, 132, 3, 'accepted', '2025-05-13 22:48:39'),
(140, 133, 1, 'rejected', '2025-05-13 22:50:39'),
(141, 133, 3, 'accepted', '2025-05-13 22:50:46'),
(142, 134, 1, 'accepted', '2025-05-13 23:01:07'),
(143, 134, 5, 'rejected', '2025-05-13 23:01:14'),
(144, 135, 1, 'accepted', '2025-05-13 23:05:03'),
(145, 135, 5, 'rejected', '2025-05-13 23:05:13'),
(146, 136, 2, 'accepted', '2025-05-13 23:32:25'),
(147, 138, 8, 'accepted', '2025-05-13 23:33:46'),
(148, 137, 2, 'accepted', '2025-05-13 23:33:59');

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
(10, 56, 4, 1, '2025-05-07 11:31:40'),
(11, 57, 4, 1, '2025-05-07 13:21:39'),
(12, 58, 4, 1, '2025-05-08 08:15:10'),
(13, 60, 4, 7, '2025-05-08 08:17:56'),
(14, 61, 4, 1, '2025-05-08 08:26:28'),
(15, 63, 4, 7, '2025-05-08 08:31:28'),
(16, 65, 4, 7, '2025-05-09 12:57:41'),
(17, 72, 4, 1, '2025-05-09 13:52:59'),
(18, 73, 1, 7, '2025-05-09 13:54:05'),
(19, 74, 1, 7, '2025-05-09 13:54:50'),
(20, 75, 1, 4, '2025-05-09 13:59:27'),
(21, 78, 1, 4, '2025-05-09 14:33:37'),
(22, 79, 1, 4, '2025-05-09 14:38:35'),
(23, 80, 1, 4, '2025-05-09 14:40:30'),
(24, 81, 1, 4, '2025-05-09 14:51:24'),
(25, 82, 4, 7, '2025-05-09 15:01:55'),
(26, 85, 1, 5, '2025-05-09 17:12:47'),
(27, 88, 1, 5, '2025-05-09 17:22:10'),
(28, 89, 1, 7, '2025-05-09 17:40:37'),
(29, 90, 1, 7, '2025-05-09 17:43:37'),
(30, 91, 3, 5, '2025-05-09 17:55:27'),
(31, 92, 1, 7, '2025-05-10 12:24:40'),
(32, 93, 1, 3, '2025-05-10 12:26:55'),
(33, 94, 1, 4, '2025-05-10 12:31:37'),
(34, 95, 1, 4, '2025-05-10 14:04:01'),
(35, 96, 1, 7, '2025-05-10 14:10:18'),
(36, 97, 1, 7, '2025-05-10 14:15:58'),
(37, 98, 1, 7, '2025-05-10 14:20:46'),
(38, 99, 1, 7, '2025-05-10 14:24:10'),
(39, 100, 1, 7, '2025-05-10 14:26:47'),
(40, 101, 1, 4, '2025-05-10 14:29:47'),
(41, 103, 1, 3, '2025-05-10 19:39:58'),
(42, 104, 1, 4, '2025-05-11 07:17:56'),
(43, 105, 1, 4, '2025-05-11 07:20:53'),
(44, 107, 1, 3, '2025-05-11 14:51:22'),
(45, 109, 7, 3, '2025-05-12 19:55:57'),
(46, 110, 3, 5, '2025-05-12 19:58:31'),
(47, 115, 1, 4, '2025-05-13 08:36:48'),
(48, 120, 1, 4, '2025-05-13 09:18:47'),
(49, 138, 5, 4, '2025-05-13 15:52:42'),
(50, 139, 5, 3, '2025-05-13 19:48:56'),
(51, 141, 7, 3, '2025-05-13 19:50:56'),
(52, 142, 3, 1, '2025-05-13 20:01:31'),
(53, 144, 7, 1, '2025-05-13 20:05:21'),
(54, 146, 8, 2, '2025-05-13 20:32:35'),
(55, 148, 1, 2, '2025-05-13 20:34:11'),
(56, 147, 1, 8, '2025-05-13 20:34:34');

-- --------------------------------------------------------

--
-- Table structure for table `chat_deletions`
--

CREATE TABLE `chat_deletions` (
  `user_id` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL,
  `deleted_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat_deletions`
--

INSERT INTO `chat_deletions` (`user_id`, `chat_id`, `deleted_at`) VALUES
(1, 26, '2025-05-13 22:32:10'),
(1, 27, '2025-05-13 22:29:18'),
(4, 49, '2025-05-13 22:47:11'),
(5, 49, '2025-05-13 22:34:23'),
(7, 51, '2025-05-13 23:04:40');

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
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_at` datetime DEFAULT NULL,
  `is_edited` tinyint(1) NOT NULL DEFAULT 0,
  `edited_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat_messages`
--

INSERT INTO `chat_messages` (`id`, `chat_id`, `sender_id`, `receiver_id`, `message`, `timestamp`, `is_deleted`, `deleted_at`, `is_edited`, `edited_at`) VALUES
(1, 2, 4, 4, 'سشسش', '2025-05-06 19:57:28', 0, NULL, 0, NULL),
(2, 2, 4, 4, 'شششششششش', '2025-05-06 19:57:33', 0, NULL, 0, NULL),
(3, 3, 4, 4, 'شش', '2025-05-06 20:03:17', 0, NULL, 0, NULL),
(4, 3, 4, 4, 'سس', '2025-05-06 20:07:29', 0, NULL, 0, NULL),
(5, 4, 4, 4, 'ش', '2025-05-06 20:08:32', 0, NULL, 0, NULL),
(6, 4, 4, 4, 'a', '2025-05-06 20:15:06', 0, NULL, 0, NULL),
(7, 5, 4, 1, 'a', '2025-05-06 20:23:11', 0, NULL, 0, NULL),
(8, 5, 4, 1, 'dsfkj', '2025-05-06 20:25:54', 0, NULL, 0, NULL),
(9, 6, 4, 1, 'مرحبا كيف الاقيك', '2025-05-06 20:32:18', 0, NULL, 0, NULL),
(10, 6, 4, 1, 'مرحبا كيف الاقيك', '2025-05-06 20:35:43', 0, NULL, 0, NULL),
(11, 6, 4, 1, 'مرحبا', '2025-05-06 20:35:46', 0, NULL, 0, NULL),
(12, 6, 4, 1, 'كيف الاقيك', '2025-05-06 20:35:52', 0, NULL, 0, NULL),
(13, 6, 1, 4, 'هلا اخوي', '2025-05-06 20:36:16', 0, NULL, 0, NULL),
(14, 6, 1, 4, 'اموري طيبة', '2025-05-06 20:36:25', 0, NULL, 0, NULL),
(15, 6, 1, 4, 'انت كيفك', '2025-05-06 20:36:30', 0, NULL, 0, NULL),
(16, 8, 4, 1, 'a', '2025-05-07 10:49:24', 0, NULL, 0, NULL),
(17, 6, 4, 1, 'aa', '2025-05-07 11:14:28', 0, NULL, 0, NULL),
(18, 9, 4, 1, 'aaaa', '2025-05-07 11:14:40', 0, NULL, 0, NULL),
(19, 10, 4, 1, 'aqa', '2025-05-07 11:31:42', 0, NULL, 0, NULL),
(20, 10, 1, 4, 'aaa', '2025-05-07 11:51:31', 0, NULL, 0, NULL),
(21, 9, 1, 4, 'cxdxf', '2025-05-07 12:20:47', 0, NULL, 0, NULL),
(22, 9, 1, 4, 'sdfgsfaa', '2025-05-07 12:21:14', 0, NULL, 0, NULL),
(23, 9, 4, 1, 'asrfhsdfgjdgfj', '2025-05-07 12:21:44', 0, NULL, 0, NULL),
(24, 9, 4, 1, 'asfhstedhsdfjt', '2025-05-07 12:21:46', 0, NULL, 0, NULL),
(25, 9, 4, 1, 'sadgjhsedtgjstedrju', '2025-05-07 12:21:48', 0, NULL, 0, NULL),
(26, 9, 1, 4, 'chgvjcfhdjk', '2025-05-07 12:22:24', 0, NULL, 0, NULL),
(27, 9, 1, 4, '1', '2025-05-07 12:23:21', 0, NULL, 0, NULL),
(28, 11, 4, 1, 'كيف اعطيك الكتاب', '2025-05-07 13:21:51', 0, NULL, 0, NULL),
(29, 11, 1, 4, 'هيه مع مريدات', '2025-05-07 13:22:24', 0, NULL, 0, NULL),
(30, 12, 4, 1, 'q', '2025-05-08 08:15:13', 0, NULL, 0, NULL),
(31, 14, 4, 1, 'اسمع انا رح اعطيك الكتاب الك', '2025-05-08 08:26:38', 0, NULL, 0, NULL),
(32, 14, 4, 1, 'مش لمناصير', '2025-05-08 08:26:45', 0, NULL, 0, NULL),
(33, 15, 4, 7, 'AAA', '2025-05-08 08:31:30', 0, NULL, 0, NULL),
(34, 16, 4, 7, 'aaaaaaaaaaa', '2025-05-09 12:57:44', 0, NULL, 0, NULL),
(35, 22, 1, 4, 'adf', '2025-05-09 14:38:39', 0, NULL, 0, NULL),
(36, 23, 1, 4, 'okey ?', '2025-05-09 14:45:00', 0, NULL, 0, NULL),
(37, 23, 4, 1, 'deal', '2025-05-09 14:45:18', 0, NULL, 0, NULL),
(38, 23, 1, 4, 'deal', '2025-05-09 14:45:40', 0, NULL, 0, NULL),
(39, 24, 1, 4, 'aaaaaaaa', '2025-05-09 14:51:26', 0, NULL, 0, NULL),
(40, 25, 4, 7, 'aaaaaaa', '2025-05-09 15:01:58', 0, NULL, 0, NULL),
(41, 26, 1, 5, 'I\'m gonna give you the book where shall we meet ?', '2025-05-09 17:13:05', 0, NULL, 0, NULL),
(42, 26, 5, 1, 'in business 4 building', '2025-05-09 17:13:41', 0, NULL, 0, NULL),
(43, 26, 1, 5, 'Deal', '2025-05-09 17:14:01', 0, NULL, 0, NULL),
(44, 27, 1, 5, 'I wanna give you my boo', '2025-05-09 17:22:19', 0, NULL, 0, NULL),
(45, 27, 5, 1, 'okey deal', '2025-05-09 17:22:38', 0, NULL, 0, NULL),
(46, 27, 1, 5, 'deal', '2025-05-09 17:22:52', 0, NULL, 0, NULL),
(47, 28, 1, 7, 'asfgasfhasfh', '2025-05-09 17:40:47', 0, NULL, 0, NULL),
(48, 29, 1, 7, 'afgasf', '2025-05-09 17:43:39', 0, NULL, 0, NULL),
(49, 30, 3, 5, 'ahagjhsdgj', '2025-05-09 17:55:29', 0, NULL, 0, NULL),
(50, 30, 3, 5, 'sdfgsdf', '2025-05-09 18:03:01', 0, NULL, 0, NULL),
(51, 30, 3, 5, 'sdfh', '2025-05-09 18:03:02', 0, NULL, 0, NULL),
(52, 30, 3, 5, 'sdgfh', '2025-05-09 18:03:10', 0, NULL, 0, NULL),
(53, 30, 3, 5, 'hdgfsa', '2025-05-09 18:03:13', 0, NULL, 0, NULL),
(54, 30, 5, 3, 'asdg', '2025-05-09 18:03:33', 0, NULL, 0, NULL),
(55, 30, 5, 3, 'asfghsaf', '2025-05-09 18:03:35', 0, NULL, 0, NULL),
(56, 30, 5, 3, 'gasf', '2025-05-09 18:03:37', 0, NULL, 0, NULL),
(57, 30, 5, 3, 's', '2025-05-09 18:29:43', 0, NULL, 0, NULL),
(58, 30, 5, 3, 's', '2025-05-09 18:29:45', 0, NULL, 0, NULL),
(59, 27, 5, 1, 'asdf', '2025-05-09 18:33:48', 0, NULL, 0, NULL),
(60, 27, 5, 1, 'adgfh', '2025-05-09 18:33:51', 0, NULL, 0, NULL),
(61, 27, 5, 1, 'sdafg', '2025-05-09 18:33:52', 0, NULL, 0, NULL),
(62, 27, 5, 1, 'asfg', '2025-05-09 18:33:54', 0, NULL, 0, NULL),
(63, 27, 5, 1, 'afd', '2025-05-09 18:33:55', 0, NULL, 0, NULL),
(64, 27, 1, 5, 'xfh', '2025-05-09 18:42:38', 0, NULL, 0, NULL),
(65, 27, 1, 5, 'sa', '2025-05-09 18:47:35', 0, NULL, 0, NULL),
(66, 27, 1, 5, 's', '2025-05-09 18:47:38', 0, NULL, 0, NULL),
(67, 27, 1, 5, 's', '2025-05-09 18:47:39', 0, NULL, 0, NULL),
(68, 27, 1, 5, 'sad', '2025-05-09 18:50:24', 0, NULL, 0, NULL),
(69, 27, 1, 5, 'dsf', '2025-05-09 18:50:28', 0, NULL, 0, NULL),
(70, 27, 1, 5, 'adfhgsdfhg', '2025-05-09 18:50:33', 0, NULL, 0, NULL),
(71, 27, 1, 5, 'adgfhsd', '2025-05-09 18:50:36', 0, NULL, 0, NULL),
(72, 27, 1, 5, 'sdfgasdf', '2025-05-09 18:51:06', 0, NULL, 0, NULL),
(73, 27, 1, 5, 'asdgfasdf', '2025-05-09 19:05:57', 0, NULL, 0, NULL),
(74, 27, 1, 5, 'adhsdfh', '2025-05-09 19:05:58', 0, NULL, 0, NULL),
(75, 27, 1, 5, 'adhgfsdgfh', '2025-05-09 19:06:01', 0, NULL, 0, NULL),
(76, 27, 1, 5, 'asdfgasgf', '2025-05-09 19:10:26', 0, NULL, 0, NULL),
(77, 27, 1, 5, 'safgsdafg', '2025-05-09 19:17:30', 0, NULL, 0, NULL),
(78, 27, 1, 5, 'dsgfsa', '2025-05-09 19:23:36', 0, NULL, 0, NULL),
(79, 27, 1, 5, 'dsgfsa', '2025-05-09 19:23:43', 0, NULL, 0, NULL),
(80, 27, 1, 5, 'dsgfsaaaaaaaaa', '2025-05-09 19:24:46', 0, NULL, 0, NULL),
(81, 27, 1, 5, 'dsgfsaaaaaaaaa', '2025-05-09 19:24:50', 0, NULL, 0, NULL),
(82, 27, 1, 5, 'dsgfsaaaaaaaaa', '2025-05-09 19:27:08', 0, NULL, 0, NULL),
(83, 27, 1, 5, 'sdf', '2025-05-09 19:27:13', 0, NULL, 0, NULL),
(84, 27, 1, 5, 'sdf', '2025-05-09 21:19:14', 0, NULL, 0, NULL),
(85, 27, 1, 5, 'sdf', '2025-05-09 21:35:14', 0, NULL, 0, NULL),
(86, 27, 1, 5, 'aa', '2025-05-09 21:35:18', 0, NULL, 0, NULL),
(87, 27, 1, 5, 'aa', '2025-05-09 21:35:20', 0, NULL, 0, NULL),
(88, 27, 1, 5, 'aaasdf', '2025-05-09 21:35:47', 0, NULL, 0, NULL),
(89, 27, 1, 5, 'aaasdf', '2025-05-09 21:37:56', 0, NULL, 0, NULL),
(90, 27, 1, 5, 'sadf', '2025-05-09 21:39:37', 0, NULL, 0, NULL),
(91, 27, 1, 5, 'adsfsa', '2025-05-09 21:40:51', 0, NULL, 0, NULL),
(92, 27, 1, 5, 'adsfsa', '2025-05-09 21:40:54', 0, NULL, 0, NULL),
(93, 27, 1, 5, 'a', '2025-05-10 11:56:02', 0, NULL, 0, NULL),
(94, 27, 1, 5, 'a', '2025-05-10 11:58:02', 0, NULL, 0, NULL),
(95, 27, 1, 5, 'a', '2025-05-10 12:01:06', 0, NULL, 0, NULL),
(96, 27, 1, 5, 'a', '2025-05-10 12:01:10', 0, NULL, 0, NULL),
(97, 27, 1, 5, 'aasd', '2025-05-10 12:02:46', 0, NULL, 0, NULL),
(98, 27, 1, 5, 'aasd', '2025-05-10 12:07:17', 0, NULL, 0, NULL),
(99, 27, 1, 5, 'aa', '2025-05-10 12:09:31', 0, NULL, 0, NULL),
(100, 27, 1, 5, 's', '2025-05-10 12:13:48', 0, NULL, 0, NULL),
(101, 27, 1, 5, 'sdfasdf', '2025-05-10 12:16:13', 0, NULL, 0, NULL),
(102, 40, 1, 4, 'a', '2025-05-10 14:29:52', 0, NULL, 0, NULL),
(103, 40, 1, 4, 'a', '2025-05-10 14:29:56', 0, NULL, 0, NULL),
(104, 40, 1, 4, 'a', '2025-05-10 14:29:58', 0, NULL, 0, NULL),
(105, 40, 1, 4, 'aaaa', '2025-05-10 14:34:40', 0, NULL, 0, NULL),
(106, 40, 1, 4, 'a', '2025-05-10 14:34:41', 0, NULL, 0, NULL),
(107, 40, 1, 4, 'a', '2025-05-10 14:34:44', 0, NULL, 0, NULL),
(108, 40, 1, 4, 's', '2025-05-10 14:35:15', 0, NULL, 0, NULL),
(109, 40, 1, 4, 'a', '2025-05-10 14:35:23', 0, NULL, 0, NULL),
(110, 40, 1, 4, 'adf', '2025-05-10 14:35:38', 0, NULL, 0, NULL),
(111, 40, 1, 4, 'asdf', '2025-05-10 14:35:40', 0, NULL, 0, NULL),
(112, 40, 4, 1, 'هلا هلا', '2025-05-10 14:36:16', 0, NULL, 0, NULL),
(113, 32, 1, 3, 'll', '2025-05-10 16:20:11', 0, NULL, 0, NULL),
(114, 32, 3, 1, ';ll', '2025-05-10 16:20:22', 0, NULL, 0, NULL),
(115, 32, 1, 3, 'مرحبا', '2025-05-10 19:40:12', 0, NULL, 0, NULL),
(116, 32, 1, 3, 'كيفك', '2025-05-10 19:40:27', 0, NULL, 0, NULL),
(117, 32, 3, 1, 'هلا', '2025-05-10 19:41:55', 0, NULL, 0, NULL),
(118, 32, 3, 1, 'a', '2025-05-10 19:43:17', 0, NULL, 0, NULL),
(119, 32, 1, 3, 'a', '2025-05-10 19:43:32', 0, NULL, 0, NULL),
(120, 42, 1, 4, 'للل', '2025-05-11 07:18:04', 0, NULL, 0, NULL),
(121, 44, 1, 3, 'ؤ', '2025-05-11 14:51:50', 1, '2025-05-11 18:17:15', 1, '2025-05-11 18:16:30'),
(122, 44, 1, 3, 'يسبل', '2025-05-11 15:05:15', 0, NULL, 1, '2025-05-11 18:16:36'),
(123, 44, 1, 3, 'هذه اختبار', '2025-05-11 15:16:47', 0, NULL, 1, '2025-05-11 18:16:58'),
(124, 44, 3, 1, 'مرحبا يغالي', '2025-05-11 15:23:06', 0, NULL, 1, '2025-05-11 18:23:17'),
(125, 44, 3, 1, 'يا سلام عالوقت تزبط', '2025-05-11 15:28:05', 1, '2025-05-11 18:28:38', 0, NULL),
(126, 44, 1, 3, 'يا هلا', '2025-05-11 19:48:46', 0, NULL, 0, NULL),
(127, 36, 7, 3, 'اه مدير بدك الكتاب؟', '2025-05-12 19:56:11', 0, NULL, 1, '2025-05-12 22:56:17'),
(128, 36, 7, 1, 'شسيب', '2025-05-12 19:56:20', 1, '2025-05-12 22:56:21', 0, NULL),
(129, 46, 3, 5, 'اهلا وسهلا', '2025-05-12 19:58:35', 0, NULL, 0, NULL),
(130, 46, 5, 3, 'اهلين بالزلام', '2025-05-12 19:58:53', 0, NULL, 0, NULL),
(131, 47, 1, 4, 'aaaaaaaaaaaaa', '2025-05-13 08:36:50', 0, NULL, 0, NULL),
(132, 47, 4, 1, 'aaaaaaaaaa', '2025-05-13 08:36:59', 0, NULL, 0, NULL),
(133, 48, 1, 4, 'لحظه زبببببببببببببببببببط ؟', '2025-05-13 09:18:56', 0, NULL, 0, NULL),
(134, 49, 4, 5, 'شش', '2025-05-13 19:33:02', 0, NULL, 0, NULL),
(135, 49, 4, 5, 'ششش', '2025-05-13 19:33:51', 0, NULL, 0, NULL),
(136, 49, 5, 4, 'ش', '2025-05-13 19:34:10', 0, NULL, 0, NULL),
(137, 49, 4, 5, 'ششلاقبس', '2025-05-13 19:34:37', 0, NULL, 0, NULL),
(138, 49, 5, 4, 'س', '2025-05-13 19:39:26', 0, NULL, 0, NULL),
(139, 49, 5, 4, 'س', '2025-05-13 19:39:29', 0, NULL, 0, NULL),
(140, 49, 5, 4, 'س', '2025-05-13 19:39:32', 0, NULL, 0, NULL),
(141, 49, 5, 4, 'س', '2025-05-13 19:39:37', 0, NULL, 0, NULL),
(142, 49, 4, 5, 'ش', '2025-05-13 19:40:26', 0, NULL, 0, NULL),
(143, 49, 5, 4, 'ييييييييييييييي', '2025-05-13 19:47:22', 0, NULL, 0, NULL),
(144, 49, 4, 5, 'مرحبا', '2025-05-13 19:47:38', 0, NULL, 0, NULL),
(145, 49, 5, 3, 'هاي المسج مرسله من لين لعماد', '2025-05-13 19:49:20', 0, NULL, 0, NULL),
(146, 51, 7, 3, 'انا مناصير بدي اعطيك يا عماد', '2025-05-13 19:51:07', 1, '2025-05-13 23:11:25', 0, NULL),
(147, 51, 3, 7, 'هلا بالشيخ', '2025-05-13 19:51:41', 1, '2025-05-13 23:11:50', 0, NULL),
(148, 51, 3, 1, 'هلا الك الكتاب ان شاء الله', '2025-05-13 20:01:39', 1, '2025-05-13 23:11:52', 0, NULL),
(149, 52, 1, 3, 'شش', '2025-05-13 20:02:00', 0, NULL, 0, NULL),
(150, 52, 1, 3, 'بسيطه هي مره وحده صارت', '2025-05-13 20:02:12', 0, NULL, 0, NULL),
(151, 51, 3, 1, 'يا حبيبي', '2025-05-13 20:03:35', 1, '2025-05-13 23:11:54', 0, NULL),
(152, 51, 3, 7, 'شو قاعد بصير', '2025-05-13 20:03:50', 1, '2025-05-13 23:11:56', 0, NULL),
(153, 51, 3, 7, 'شش', '2025-05-13 20:03:55', 1, '2025-05-13 23:11:58', 0, NULL),
(154, 51, 3, 7, 'شش', '2025-05-13 20:03:56', 1, '2025-05-13 23:12:00', 0, NULL),
(155, 51, 3, 5, 'هاي من عماد ل لين', '2025-05-13 20:12:28', 0, NULL, 0, NULL),
(156, 49, 5, 4, 'هاي الرساله هسا مرسله من لين لاحمد قضاه', '2025-05-13 20:17:16', 0, NULL, 0, NULL),
(157, 54, 8, 2, 'مرحبا جاني انا علي', '2025-05-13 20:32:42', 0, NULL, 0, NULL),
(158, 53, 1, 2, 'مرحبا جاني انا عبدالله لكتابي الشمال', '2025-05-13 20:34:25', 0, NULL, 0, NULL),
(159, 49, 5, 1, 'هاي من لين لعبدالله', '2025-05-13 20:39:41', 0, NULL, 0, NULL),
(160, 49, 4, 5, 'هاي من احمد ل لين', '2025-05-13 20:40:45', 0, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chat_message_edits`
--

CREATE TABLE `chat_message_edits` (
  `id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  `old_content` text NOT NULL,
  `edited_at` datetime NOT NULL,
  `edited_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat_message_edits`
--

INSERT INTO `chat_message_edits` (`id`, `message_id`, `old_content`, `edited_at`, `edited_by`) VALUES
(1, 121, 'زبط يا كبييييييييير', '2025-05-11 18:13:01', 1),
(2, 122, 'سءس', '2025-05-11 18:13:11', 1),
(3, 121, 'تتال          18:51', '2025-05-11 18:16:30', 1),
(4, 122, 'سءس          05', '2025-05-11 18:16:36', 1),
(5, 123, 'يييييييي', '2025-05-11 18:16:58', 1),
(6, 124, 'مرحبا', '2025-05-11 18:23:17', 3),
(7, 127, 'اه معلم بدك الكتاب؟', '2025-05-12 22:56:17', 7);

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
(92, 1, 4, 56, 'book_request', 'Abood Qudah has requested your book', 1, 1, '2025-05-07 11:31:06'),
(93, 4, 1, 56, 'request_accepted', 'Ahmad accepted your request.', 1, 1, '2025-05-07 11:31:40'),
(94, 4, 1, 56, 'new_message', 'Ahmad sent you a message.', 1, 1, '2025-05-07 11:31:42'),
(95, 1, 4, 56, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-07 11:51:31'),
(96, 1, 4, 55, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-07 12:20:47'),
(97, 1, 4, 55, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-07 12:21:14'),
(98, 4, 1, 55, 'new_message', 'Ahmad sent you a message.', 1, 1, '2025-05-07 12:21:44'),
(99, 4, 1, 55, 'new_message', 'Ahmad sent you a message.', 1, 1, '2025-05-07 12:21:46'),
(100, 4, 1, 55, 'new_message', 'Ahmad sent you a message.', 1, 1, '2025-05-07 12:21:48'),
(101, 1, 4, 55, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-07 12:22:24'),
(102, 1, 4, 55, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-07 12:23:21'),
(103, 1, 4, 57, 'book_request', 'Abood Qudah has requested your book', 1, 1, '2025-05-07 13:21:24'),
(104, 4, 1, 57, 'request_accepted', 'Ahmad accepted your request.', 1, 1, '2025-05-07 13:21:39'),
(105, 4, 1, 57, 'new_message', 'Ahmad sent you a message.', 1, 1, '2025-05-07 13:21:51'),
(106, 1, 4, 57, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-07 13:22:24'),
(107, 1, 4, 58, 'book_request', 'Abood Qudah has requested your book', 1, 1, '2025-05-08 08:14:55'),
(108, 4, 1, 58, 'request_accepted', 'Ahmad accepted your request.', 1, 1, '2025-05-08 08:15:10'),
(109, 4, 1, 58, 'new_message', 'Ahmad sent you a message.', 1, 1, '2025-05-08 08:15:13'),
(111, 7, 4, 60, 'book_request', 'Ahmad Manaseer has requested your book', 1, 1, '2025-05-08 08:17:41'),
(112, 4, 7, 60, 'request_accepted', 'Ahmad accepted your request.', 1, 1, '2025-05-08 08:17:56'),
(113, 4, 1, NULL, 'request_rejected', 'Ahmad rejected your book request.', 1, 1, '2025-05-08 08:25:03'),
(114, 4, 1, NULL, 'request_rejected', 'Ahmad rejected your book request.', 1, 1, '2025-05-08 08:25:03'),
(115, 1, 4, 61, 'book_request', 'Abood Qudah has requested your book', 1, 1, '2025-05-08 08:25:21'),
(116, 7, 4, 62, 'book_request', 'Ahmad Manaseer has requested your book', 1, 1, '2025-05-08 08:26:14'),
(117, 4, 7, 62, 'book_taken', 'Ahmad gave this book to someone else.', 1, 1, '2025-05-08 08:26:28'),
(118, 4, 1, 61, 'request_accepted', 'Ahmad accepted your request.', 1, 1, '2025-05-08 08:26:28'),
(119, 4, 1, 61, 'new_message', 'Ahmad sent you a message.', 1, 1, '2025-05-08 08:26:38'),
(120, 4, 1, 61, 'new_message', 'Ahmad sent you a message.', 1, 1, '2025-05-08 08:26:45'),
(121, 7, 4, 63, 'book_request', 'Ahmad Manaseer has requested your book', 1, 1, '2025-05-08 08:31:16'),
(122, 4, 7, 63, 'request_accepted', 'Ahmad accepted your request.', 1, 1, '2025-05-08 08:31:28'),
(123, 4, 7, 63, 'new_message', 'Ahmad sent you a message.', 1, 1, '2025-05-08 08:31:30'),
(124, 1, 4, 64, 'book_request', 'Abood Qudah has requested your book', 1, 1, '2025-05-09 12:57:11'),
(125, 7, 4, 65, 'book_request', 'Ahmad Manaseer has requested your book', 1, 1, '2025-05-09 12:57:26'),
(126, 4, 1, 62, 'book_taken', 'Ahmad gave this book to someone else.', 1, 1, '2025-05-09 12:57:41'),
(127, 4, 7, 65, 'request_accepted', 'Ahmad accepted your request.', 1, 1, '2025-05-09 12:57:41'),
(128, 4, 7, 65, 'new_message', 'Ahmad sent you a message.', 1, 1, '2025-05-09 12:57:44'),
(129, 1, 4, 66, 'book_request', 'Abood Qudah has requested your book', 1, 1, '2025-05-09 13:03:09'),
(130, 7, 4, 67, 'book_request', 'Ahmad Manaseer has requested your book', 1, 1, '2025-05-09 13:03:14'),
(131, 5, 4, 68, 'book_request', 'Leen Ghanem has requested your book', 1, 1, '2025-05-09 13:03:23'),
(132, 3, 4, 69, 'book_request', 'Emad Qudah has requested your book', 1, 1, '2025-05-09 13:03:36'),
(133, 7, 4, 70, 'book_request', 'Ahmad Manaseer has requested your book', 1, 1, '2025-05-09 13:05:57'),
(134, 7, 4, 71, 'book_request', 'Ahmad Manaseer has requested your book', 1, 1, '2025-05-09 13:09:03'),
(135, 1, 4, 72, 'book_request', 'Abood Qudah has requested your book', 1, 1, '2025-05-09 13:52:51'),
(136, 7, 1, 73, 'book_request', 'Ahmad Manaseer has requested your book', 1, 1, '2025-05-09 13:53:55'),
(137, 7, 1, 74, 'book_request', 'Ahmad Manaseer has requested your book', 1, 1, '2025-05-09 13:54:39'),
(138, 4, 1, 75, 'book_request', 'Ahmad Qudah has requested your book', 1, 1, '2025-05-09 13:59:17'),
(140, 1, 4, NULL, 'request_rejected', 'Abood rejected your book request.', 1, 1, '2025-05-09 14:09:41'),
(142, 1, 5, NULL, 'request_rejected', 'Abood rejected your book request.', 1, 1, '2025-05-09 14:29:03'),
(143, 4, 1, 78, 'book_request', 'Ahmad Qudah has requested your book', 1, 1, '2025-05-09 14:29:24'),
(144, 1, 4, 78, 'request_accepted', 'Abood accepted your request.', 1, 1, '2025-05-09 14:33:37'),
(145, 4, 1, 79, 'book_request', 'Ahmad Qudah has requested your book', 1, 1, '2025-05-09 14:38:23'),
(146, 1, 4, 79, 'request_accepted', 'Abood accepted your request.', 1, 1, '2025-05-09 14:38:35'),
(147, 1, 4, 79, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-09 14:38:39'),
(148, 4, 1, 80, 'book_request', 'Ahmad Qudah has requested your book', 1, 1, '2025-05-09 14:40:23'),
(149, 1, 4, 80, 'request_accepted', 'Abood accepted your request.', 1, 1, '2025-05-09 14:40:30'),
(150, 1, 4, 80, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-09 14:45:00'),
(151, 4, 1, 80, 'new_message', 'Ahmad sent you a message.', 1, 1, '2025-05-09 14:45:18'),
(152, 1, 4, 80, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-09 14:45:40'),
(153, 4, 1, 81, 'book_request', 'Ahmad Qudah has requested your book', 1, 1, '2025-05-09 14:51:10'),
(154, 1, 4, 81, 'request_accepted', 'Abood accepted your request.', 1, 1, '2025-05-09 14:51:24'),
(155, 1, 4, 81, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-09 14:51:26'),
(156, 7, 4, 82, 'book_request', 'Ahmad Manaseer has requested your book', 1, 1, '2025-05-09 15:01:23'),
(157, 4, 7, 82, 'request_accepted', 'Ahmad accepted your request.', 1, 1, '2025-05-09 15:01:55'),
(158, 4, 7, 82, 'new_message', 'Ahmad sent you a message.', 1, 1, '2025-05-09 15:01:58'),
(159, 4, 1, 83, 'book_request', 'Ahmad Qudah has requested your book', 1, 1, '2025-05-09 17:11:59'),
(160, 7, 1, 84, 'book_request', 'Ahmad Manaseer has requested your book', 1, 1, '2025-05-09 17:12:06'),
(161, 5, 1, 85, 'book_request', 'Leen Ghanem has requested your book', 1, 1, '2025-05-09 17:12:17'),
(162, 1, 4, 71, 'book_taken', 'Abood gave this book to someone else.', 1, 1, '2025-05-09 17:12:47'),
(163, 1, 7, 71, 'book_taken', 'Abood gave this book to someone else.', 1, 1, '2025-05-09 17:12:47'),
(164, 1, 5, 85, 'request_accepted', 'Abood accepted your request.', 1, 1, '2025-05-09 17:12:47'),
(165, 1, 5, 85, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-09 17:13:05'),
(166, 5, 1, 85, 'new_message', 'Leen sent you a message.', 1, 1, '2025-05-09 17:13:41'),
(167, 1, 5, 85, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-09 17:14:01'),
(168, 4, 1, 86, 'book_request', 'Ahmad Qudah has requested your book', 1, 1, '2025-05-09 17:21:38'),
(169, 7, 1, 87, 'book_request', 'Ahmad Manaseer has requested your book', 1, 1, '2025-05-09 17:21:50'),
(170, 5, 1, 88, 'book_request', 'Leen Ghanem has requested your book', 1, 1, '2025-05-09 17:21:59'),
(171, 1, 4, 72, 'book_taken', 'Abood gave this book to someone else.', 1, 1, '2025-05-09 17:22:10'),
(172, 1, 7, 72, 'book_taken', 'Abood gave this book to someone else.', 1, 1, '2025-05-09 17:22:10'),
(173, 1, 5, 88, 'request_accepted', 'Abood accepted your request.', 1, 1, '2025-05-09 17:22:10'),
(174, 1, 5, 88, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-09 17:22:19'),
(175, 5, 1, 88, 'new_message', 'Leen sent you a message.', 1, 1, '2025-05-09 17:22:38'),
(176, 1, 5, 88, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-09 17:22:52'),
(177, 7, 1, 89, 'book_request', 'Ahmad Manaseer has requested your book', 1, 1, '2025-05-09 17:40:09'),
(178, 1, 7, 89, 'request_accepted', 'Abood accepted your request.', 1, 1, '2025-05-09 17:40:37'),
(179, 1, 7, 89, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-09 17:40:47'),
(180, 7, 1, 90, 'book_request', 'Ahmad Manaseer has requested your book', 1, 1, '2025-05-09 17:43:31'),
(181, 1, 7, 90, 'request_accepted', 'Abood accepted your request.', 1, 1, '2025-05-09 17:43:37'),
(182, 1, 7, 90, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-09 17:43:39'),
(183, 5, 3, 91, 'book_request', 'Leen Ghanem has requested your book', 1, 1, '2025-05-09 17:55:19'),
(184, 3, 5, 91, 'request_accepted', 'Emad accepted your request.', 1, 1, '2025-05-09 17:55:27'),
(185, 3, 5, 91, 'new_message', 'Emad sent you a message.', 1, 1, '2025-05-09 17:55:29'),
(186, 3, 5, 91, 'new_message', 'Emad sent you a message.', 1, 1, '2025-05-09 18:03:01'),
(187, 3, 5, 91, 'new_message', 'Emad sent you a message.', 1, 1, '2025-05-09 18:03:02'),
(188, 3, 5, 91, 'new_message', 'Emad sent you a message.', 1, 1, '2025-05-09 18:03:10'),
(189, 3, 5, 91, 'new_message', 'Emad sent you a message.', 1, 1, '2025-05-09 18:03:13'),
(190, 5, 3, 91, 'new_message', 'Leen sent you a message.', 1, 1, '2025-05-09 18:03:33'),
(191, 5, 3, 91, 'new_message', 'Leen sent you a message.', 1, 1, '2025-05-09 18:03:35'),
(192, 5, 3, 91, 'new_message', 'Leen sent you a message.', 1, 1, '2025-05-09 18:03:37'),
(193, 5, 3, 91, 'new_message', 'Leen sent you a message.', 1, 1, '2025-05-09 18:29:43'),
(194, 5, 3, 91, 'new_message', 'Leen sent you a message.', 1, 1, '2025-05-09 18:29:45'),
(195, 5, 1, 88, 'new_message', 'Leen sent you a message.', 1, 1, '2025-05-09 18:33:48'),
(196, 5, 1, 88, 'new_message', 'Leen sent you a message.', 1, 1, '2025-05-09 18:33:51'),
(197, 5, 1, 88, 'new_message', 'Leen sent you a message.', 1, 1, '2025-05-09 18:33:52'),
(198, 5, 1, 88, 'new_message', 'Leen sent you a message.', 1, 1, '2025-05-09 18:33:54'),
(199, 5, 1, 88, 'new_message', 'Leen sent you a message.', 1, 1, '2025-05-09 18:33:55'),
(200, 1, 5, 88, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-09 18:42:38'),
(201, 1, 5, 88, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-09 18:47:35'),
(202, 1, 5, 88, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-09 18:47:38'),
(203, 1, 5, 88, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-09 18:47:39'),
(204, 1, 5, 88, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-09 18:50:24'),
(205, 1, 5, 88, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-09 18:50:28'),
(206, 1, 5, 88, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-09 18:50:33'),
(207, 1, 5, 88, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-09 18:50:36'),
(208, 1, 5, 88, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-09 18:51:06'),
(209, 1, 5, 88, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-09 19:05:57'),
(210, 1, 5, 88, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-09 19:05:58'),
(211, 1, 5, 88, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-09 19:06:01'),
(212, 1, 5, 88, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-09 19:10:26'),
(213, 1, 5, 88, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-09 19:17:30'),
(214, 1, 5, 88, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-09 19:23:36'),
(215, 1, 5, 88, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-09 19:23:43'),
(216, 1, 5, 88, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-09 19:24:46'),
(217, 1, 5, 88, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-09 19:24:50'),
(218, 1, 5, 88, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-09 19:27:08'),
(219, 1, 5, 88, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-09 19:27:13'),
(220, 1, 5, 88, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-09 21:19:14'),
(221, 1, 5, 88, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-09 21:35:14'),
(222, 1, 5, 88, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-09 21:35:18'),
(223, 1, 5, 88, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-09 21:35:20'),
(224, 1, 5, 88, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-09 21:35:47'),
(225, 1, 5, 88, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-09 21:37:56'),
(226, 1, 5, 88, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-09 21:39:37'),
(227, 1, 5, 88, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-09 21:40:51'),
(228, 1, 5, 88, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-09 21:40:54'),
(229, 1, 5, 88, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-10 11:56:02'),
(230, 1, 5, 88, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-10 11:58:02'),
(231, 1, 5, 88, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-10 12:01:06'),
(232, 1, 5, 88, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-10 12:01:10'),
(233, 1, 5, 88, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-10 12:02:46'),
(234, 1, 5, 88, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-10 12:07:17'),
(235, 1, 5, 88, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-10 12:09:31'),
(236, 1, 5, 88, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-10 12:13:48'),
(237, 1, 5, 88, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-10 12:16:13'),
(238, 7, 1, 92, 'book_request', 'Ahmad Manaseer has requested your book', 1, 1, '2025-05-10 12:24:31'),
(239, 1, 7, 92, 'request_accepted', 'Abood accepted your request.', 1, 1, '2025-05-10 12:24:40'),
(240, 3, 1, 93, 'book_request', 'Emad Qudah has requested your book', 1, 1, '2025-05-10 12:26:33'),
(241, 1, 3, 93, 'request_accepted', 'Abood accepted your request.', 1, 1, '2025-05-10 12:26:55'),
(242, 4, 1, 94, 'book_request', 'Ahmad Qudah has requested your book', 1, 1, '2025-05-10 12:31:30'),
(243, 1, 4, 94, 'request_accepted', 'Abood accepted your request.', 1, 1, '2025-05-10 12:31:37'),
(244, 4, 1, 95, 'book_request', 'Ahmad Qudah has requested your book', 1, 1, '2025-05-10 14:03:35'),
(245, 1, 4, 95, 'request_accepted', 'Abood accepted your request.', 1, 1, '2025-05-10 14:04:01'),
(246, 7, 1, 96, 'book_request', 'Ahmad Manaseer has requested your book', 1, 1, '2025-05-10 14:10:08'),
(247, 1, 7, 96, 'request_accepted', 'Abood accepted your request.', 1, 1, '2025-05-10 14:10:18'),
(248, 7, 1, 97, 'book_request', 'Ahmad Manaseer has requested your book', 1, 1, '2025-05-10 14:15:51'),
(249, 1, 7, 97, 'request_accepted', 'Abood accepted your request.', 1, 1, '2025-05-10 14:15:58'),
(250, 7, 1, 98, 'book_request', 'Ahmad Manaseer has requested your book', 1, 1, '2025-05-10 14:20:38'),
(251, 1, 7, 98, 'request_accepted', 'Abood accepted your request.', 1, 1, '2025-05-10 14:20:46'),
(252, 7, 1, 99, 'book_request', 'Ahmad Manaseer has requested your book', 1, 1, '2025-05-10 14:23:04'),
(253, 1, 7, 99, 'request_accepted', 'Abood accepted your request.', 1, 1, '2025-05-10 14:24:10'),
(254, 7, 1, 100, 'book_request', 'Ahmad Manaseer has requested your book', 1, 1, '2025-05-10 14:26:37'),
(255, 1, 7, 100, 'request_accepted', 'Abood accepted your request.', 1, 1, '2025-05-10 14:26:47'),
(256, 4, 1, 101, 'book_request', 'Ahmad Qudah has requested your book', 1, 1, '2025-05-10 14:29:38'),
(257, 1, 4, 101, 'request_accepted', 'Abood accepted your request.', 1, 1, '2025-05-10 14:29:47'),
(258, 1, 4, 101, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-10 14:29:52'),
(259, 1, 4, 101, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-10 14:29:56'),
(260, 1, 4, 101, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-10 14:29:59'),
(261, 1, 4, 101, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-10 14:34:40'),
(262, 1, 4, 101, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-10 14:34:41'),
(263, 1, 4, 101, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-10 14:34:44'),
(264, 1, 4, 101, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-10 14:35:15'),
(265, 1, 4, 101, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-10 14:35:23'),
(266, 1, 4, 101, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-10 14:35:38'),
(267, 1, 4, 101, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-10 14:35:40'),
(268, 4, 1, 101, 'new_message', 'Ahmad sent you a message.', 1, 1, '2025-05-10 14:36:16'),
(269, 1, 3, 93, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-10 16:20:11'),
(270, 3, 1, 93, 'new_message', 'Emad sent you a message.', 1, 1, '2025-05-10 16:20:22'),
(271, 3, 1, 102, 'book_request', 'Emad Qudah has requested your book', 1, 1, '2025-05-10 19:37:37'),
(272, 3, 1, 103, 'book_request', 'Emad Qudah has requested your book', 1, 1, '2025-05-10 19:39:08'),
(273, 1, 3, 103, 'request_accepted', 'Abood accepted your request.', 1, 1, '2025-05-10 19:39:58'),
(274, 1, 3, 93, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-10 19:40:12'),
(275, 1, 3, 93, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-10 19:40:27'),
(276, 3, 1, 93, 'new_message', 'Emad sent you a message.', 1, 1, '2025-05-10 19:41:55'),
(277, 3, 1, 93, 'new_message', 'Emad sent you a message.', 1, 1, '2025-05-10 19:43:17'),
(278, 1, 3, 93, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-10 19:43:32'),
(279, 4, 1, 104, 'book_request', 'Ahmad Qudah has requested your book', 1, 1, '2025-05-11 07:17:36'),
(280, 1, 4, 104, 'request_accepted', 'Abood accepted your request.', 1, 1, '2025-05-11 07:17:56'),
(281, 1, 4, 104, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-11 07:18:04'),
(282, 4, 1, 105, 'book_request', 'Ahmad Qudah has requested your book', 1, 1, '2025-05-11 07:20:29'),
(283, 5, 1, 106, 'book_request', 'Leen Ghanem has requested your book', 1, 1, '2025-05-11 07:20:40'),
(284, 1, 5, 95, 'book_taken', 'Abood gave this book to someone else.', 1, 1, '2025-05-11 07:20:53'),
(285, 1, 4, 105, 'request_accepted', 'Abood accepted your request.', 1, 1, '2025-05-11 07:20:53'),
(286, 3, 1, 107, 'book_request', 'Emad Qudah has requested your book', 1, 1, '2025-05-11 14:51:12'),
(287, 1, 3, 107, 'request_accepted', 'Abood accepted your request.', 1, 1, '2025-05-11 14:51:22'),
(288, 1, 3, 107, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-11 14:51:50'),
(289, 1, 3, 107, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-11 15:05:15'),
(290, 1, 3, 107, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-11 15:16:47'),
(291, 3, 1, 107, 'new_message', 'Emad sent you a message.', 1, 1, '2025-05-11 15:23:06'),
(292, 3, 1, 107, 'new_message', 'Emad sent you a message.', 1, 1, '2025-05-11 15:28:05'),
(293, 1, 3, 107, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-11 19:48:46'),
(294, 3, 7, 109, 'book_request', 'Emad Qudah has requested your book', 1, 1, '2025-05-12 19:55:36'),
(295, 7, 3, 109, 'request_accepted', 'Ahmad accepted your request.', 1, 1, '2025-05-12 19:55:57'),
(296, 7, 3, 97, 'new_message', 'Ahmad sent you a message.', 1, 1, '2025-05-12 19:56:11'),
(297, 7, 1, 97, 'new_message', 'Ahmad sent you a message.', 1, 1, '2025-05-12 19:56:20'),
(298, 5, 3, 110, 'book_request', 'Leen Ghanem has requested your book', 1, 1, '2025-05-12 19:58:22'),
(299, 3, 5, 110, 'request_accepted', 'Emad accepted your request.', 1, 1, '2025-05-12 19:58:31'),
(300, 3, 5, 110, 'new_message', 'Emad sent you a message.', 1, 1, '2025-05-12 19:58:35'),
(301, 5, 3, 110, 'new_message', 'Leen sent you a message.', 1, 1, '2025-05-12 19:58:53'),
(302, 4, 1, 115, 'book_request', 'Ahmad Qudah has requested your book', 1, 1, '2025-05-13 08:36:39'),
(303, 1, 4, 115, 'request_accepted', 'Abood accepted your request.', 1, 1, '2025-05-13 08:36:48'),
(304, 1, 4, 115, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-13 08:36:50'),
(305, 4, 1, 115, 'new_message', 'Ahmad sent you a message.', 1, 1, '2025-05-13 08:36:59'),
(307, NULL, 1, 120, 'swap_request', 'Ahmad Qudah wants to swap “Business Research Me” for “Principles of Marketing”', 1, 1, '2025-05-13 09:18:23'),
(308, 1, 4, 120, 'request_accepted', 'Abood accepted your request.', 1, 1, '2025-05-13 09:18:47'),
(309, 1, 4, 120, 'new_message', 'Abood sent you a message.', 1, 1, '2025-05-13 09:18:56'),
(310, NULL, 1, 121, 'swap_request', 'Emad Qudah wants to swap “Business Research Me” for “Principles of Marketing”', 1, 1, '2025-05-13 09:21:25'),
(311, 1, 3, NULL, 'request_rejected', 'Abood rejected your book request.', 1, 1, '2025-05-13 09:21:33'),
(312, 1, 3, NULL, 'request_rejected', 'Abood rejected your book request.', 1, 1, '2025-05-13 09:21:33'),
(314, 3, 1, NULL, 'request_rejected', 'Emad rejected your book request.', 1, 1, '2025-05-13 09:22:17'),
(315, 3, 1, NULL, 'request_rejected', 'Emad rejected your book request.', 1, 1, '2025-05-13 09:22:17'),
(316, NULL, 1, 123, 'swap_request', 'Emad Qudah wants to swap “Business Research Me” for “Principles of Marketing”', 1, 1, '2025-05-13 14:07:34'),
(317, NULL, 1, 124, 'swap_request', 'Emad Qudah wants to swap “Business Research Me” for “Principles of Marketing”', 1, 1, '2025-05-13 14:08:28'),
(318, 7, 3, 125, 'book_request', 'Ahmad Manaseer has requested your book', 1, 1, '2025-05-13 14:11:27'),
(319, NULL, 1, 126, 'swap_request', 'Leen Ghanem wants to swap “Business Research Me” for “Principles of Marketing”', 1, 1, '2025-05-13 14:15:33'),
(320, NULL, 1, 127, 'swap_request', 'Leen Ghanem wants to swap “Business Research Me” for “Principles of Marketing”', 1, 1, '2025-05-13 14:20:33'),
(321, NULL, 1, 128, 'swap_request', 'Leen Ghanem wants to swap “Business Research Me” for “Principles of Marketing”', 1, 1, '2025-05-13 14:20:58'),
(322, NULL, 1, 129, 'swap_request', 'Leen Ghanem wants to swap “Business Research Me” for “Principles of Marketing”', 1, 1, '2025-05-13 14:24:01'),
(323, NULL, 1, 130, 'swap_request', 'Ahmad Manaseer wants to swap “Business Research Me” for “Principles of Marketing”', 1, 1, '2025-05-13 14:27:43'),
(324, NULL, 1, 131, 'swap_request', 'Ahmad Manaseer wants to swap “Business Research Me” for “مبادئ تسويق”', 1, 1, '2025-05-13 14:52:34'),
(325, 1, 5, NULL, 'request_rejected', 'Abood rejected your book request.', 1, 1, '2025-05-13 14:53:25'),
(326, 1, 5, NULL, 'request_rejected', 'Abood rejected your book request.', 1, 1, '2025-05-13 14:53:25'),
(327, NULL, 5, 132, 'swap_request', 'Emad Qudah wants to swap “Business Research Me” for “مبادئ تسويق”', 1, 1, '2025-05-13 15:03:00'),
(328, NULL, 5, 133, 'swap_request', 'Emad Qudah wants to swap “Business Research Me” for “مبادئ تسويق”', 1, 1, '2025-05-13 15:06:31'),
(330, 5, 7, NULL, 'request_rejected', 'Leen rejected your book request.', 1, 1, '2025-05-13 15:19:49'),
(331, 5, 7, NULL, 'request_rejected', 'Leen rejected your book request.', 1, 1, '2025-05-13 15:19:49'),
(333, 5, 7, 135, 'request_rejected', 'Leen rejected your book request.', 1, 1, '2025-05-13 15:23:09'),
(334, 5, 7, 135, 'request_rejected', 'Leen rejected your book request.', 1, 1, '2025-05-13 15:23:09'),
(336, NULL, 7, NULL, 'request_rejected', 'Leen rejected your book request.', 1, 1, '2025-05-13 15:24:02'),
(337, NULL, 7, NULL, 'request_rejected', 'Leen rejected your book request.', 1, 1, '2025-05-13 15:24:02'),
(339, 5, 7, NULL, 'request_rejected', 'Leen rejected your book request.', 1, 1, '2025-05-13 15:27:29'),
(340, 5, 7, NULL, 'request_rejected', 'Leen rejected your book request.', 1, 1, '2025-05-13 15:27:30'),
(341, 4, 5, 138, 'book_request', 'Ahmad Qudah has requested your book', 1, 1, '2025-05-13 15:52:34'),
(342, 5, 4, 138, 'request_accepted', 'Leen accepted your request.', 1, 1, '2025-05-13 15:52:42'),
(343, 4, 5, 138, 'new_message', 'Ahmad sent you a message.', 1, 1, '2025-05-13 19:33:02'),
(344, 4, 5, 138, 'new_message', 'Ahmad sent you a message.', 1, 1, '2025-05-13 19:33:51'),
(345, 5, 4, 138, 'new_message', 'Leen sent you a message.', 1, 0, '2025-05-13 19:34:10'),
(346, 4, 5, 138, 'new_message', 'Ahmad sent you a message.', 1, 1, '2025-05-13 19:34:37'),
(347, 5, 4, 138, 'new_message', 'Leen sent you a message.', 1, 0, '2025-05-13 19:39:26'),
(348, 5, 4, 138, 'new_message', 'Leen sent you a message.', 1, 0, '2025-05-13 19:39:29'),
(349, 5, 4, 138, 'new_message', 'Leen sent you a message.', 1, 0, '2025-05-13 19:39:32'),
(350, 5, 4, 138, 'new_message', 'Leen sent you a message.', 1, 0, '2025-05-13 19:39:37'),
(351, 4, 5, 138, 'new_message', 'Ahmad sent you a message.', 1, 0, '2025-05-13 19:40:26'),
(352, 5, 4, 138, 'new_message', 'Leen sent you a message.', 1, 0, '2025-05-13 19:47:22'),
(353, 4, 5, 138, 'new_message', 'Ahmad sent you a message.', 1, 0, '2025-05-13 19:47:38'),
(354, 3, 5, 139, 'book_request', 'Emad Qudah has requested your book', 1, 0, '2025-05-13 19:48:39'),
(355, 5, 3, 139, 'request_accepted', 'Leen accepted your request.', 1, 1, '2025-05-13 19:48:56'),
(356, 5, 3, 138, 'new_message', 'Leen sent you a message.', 1, 1, '2025-05-13 19:49:20'),
(357, 1, 7, 140, 'book_request', 'Abood Qudah has requested your book', 1, 1, '2025-05-13 19:50:39'),
(358, 3, 7, 141, 'book_request', 'Emad Qudah has requested your book', 1, 0, '2025-05-13 19:50:46'),
(359, 7, 1, 133, 'book_taken', 'Ahmad gave this book to someone else.', 1, 1, '2025-05-13 19:50:56'),
(360, 7, 3, 141, 'request_accepted', 'Ahmad accepted your request.', 1, 0, '2025-05-13 19:50:56'),
(361, 7, 3, 141, 'new_message', 'Ahmad sent you a message.', 1, 0, '2025-05-13 19:51:08'),
(362, 3, 7, 141, 'new_message', 'Emad sent you a message.', 1, 0, '2025-05-13 19:51:41'),
(363, NULL, 3, 142, 'swap_request', 'Abood Qudah wants to swap “Business Research Me” for “مبادئ تسويق”', 1, 0, '2025-05-13 20:01:07'),
(364, NULL, 3, 143, 'swap_request', 'Leen Ghanem wants to swap “Business Research Me” for “مبادئ تسويق”', 1, 0, '2025-05-13 20:01:14'),
(365, 3, 5, 134, 'book_taken', 'Emad gave this book to someone else.', 1, 0, '2025-05-13 20:01:31'),
(366, 3, 1, 142, 'request_accepted', 'Emad accepted your request.', 1, 1, '2025-05-13 20:01:31'),
(367, 3, 1, 141, 'new_message', 'Emad sent you a message.', 1, 1, '2025-05-13 20:01:39'),
(368, 1, 3, 142, 'new_message', 'Abood sent you a message.', 1, 0, '2025-05-13 20:02:00'),
(369, 1, 3, 142, 'new_message', 'Abood sent you a message.', 1, 0, '2025-05-13 20:02:12'),
(370, 3, 1, 141, 'new_message', 'Emad sent you a message.', 1, 1, '2025-05-13 20:03:35'),
(371, 3, 7, 141, 'new_message', 'Emad sent you a message.', 1, 0, '2025-05-13 20:03:50'),
(372, 3, 7, 141, 'new_message', 'Emad sent you a message.', 1, 0, '2025-05-13 20:03:55'),
(373, 3, 7, 141, 'new_message', 'Emad sent you a message.', 1, 0, '2025-05-13 20:03:56'),
(374, NULL, 7, 144, 'swap_request', 'Abood Qudah wants to swap “Business Research Me” for “مبادئ تسويق”', 1, 0, '2025-05-13 20:05:03'),
(375, NULL, 7, 145, 'swap_request', 'Leen Ghanem wants to swap “Business Research Me” for “مبادئ تسويق”', 1, 0, '2025-05-13 20:05:13'),
(376, 7, 5, 135, 'book_taken', 'Ahmad gave this book to someone else.', 1, 0, '2025-05-13 20:05:21'),
(377, 7, 1, 144, 'request_accepted', 'Ahmad accepted your request.', 1, 0, '2025-05-13 20:05:21'),
(378, 3, 5, 141, 'new_message', 'Emad sent you a message.', 1, 0, '2025-05-13 20:12:28'),
(379, 5, 4, 138, 'new_message', 'Leen sent you a message.', 1, 0, '2025-05-13 20:17:16'),
(380, 2, 8, 146, 'book_request', 'Jane Doe has requested your book', 1, 0, '2025-05-13 20:32:25'),
(381, 8, 2, 146, 'request_accepted', 'ali accepted your request.', 1, 0, '2025-05-13 20:32:35'),
(382, 8, 2, 146, 'new_message', 'ali sent you a message.', 1, 0, '2025-05-13 20:32:42'),
(383, 8, 1, 147, 'book_request', 'ali sami has requested your book', 1, 0, '2025-05-13 20:33:46'),
(384, 2, 1, 148, 'book_request', 'Jane Doe has requested your book', 1, 0, '2025-05-13 20:33:59'),
(385, 1, 2, 148, 'request_accepted', 'Abood accepted your request.', 1, 0, '2025-05-13 20:34:11'),
(386, 1, 2, 144, 'new_message', 'Abood sent you a message.', 1, 0, '2025-05-13 20:34:25'),
(387, 1, 8, 147, 'request_accepted', 'Abood accepted your request.', 0, 0, '2025-05-13 20:34:34'),
(388, 5, 1, 138, 'new_message', 'Leen sent you a message.', 1, 0, '2025-05-13 20:39:41'),
(389, 4, 5, 138, 'new_message', 'Ahmad sent you a message.', 0, 0, '2025-05-13 20:40:45');

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
(2, 'Jane', 'Doe', NULL, 'jane.doe@example.com', '0781234567', '1', 'user', '2025-04-18 12:34:27', 0),
(3, 'Emad', 'Qudah', NULL, 'Emad.qudah@gmail.com', '0781245789', '1', 'user', '2025-04-18 18:44:48', 0),
(4, 'Ahmad', 'Qudah', NULL, 'ahmad.qudah@gmail.com', '0791197936', '1', 'super_admin', '2025-04-18 20:05:12', 0),
(5, 'Leen', 'Ghanem', NULL, 'leen.ghanem@gmail.com', '0781543219', '1', 'super_admin', '2025-04-19 12:00:23', 0),
(7, 'Ahmad', 'Manaseer', NULL, 'manaser.ahmad@gmail.com', '0787701415', '1', 'user', '2025-04-19 18:49:40', 0),
(8, 'ali', 'sami', NULL, 'ali.qudah@gmail.com', '0787745136', '1', 'user', '2025-05-06 19:42:36', 0);

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
-- Indexes for table `chat_deletions`
--
ALTER TABLE `chat_deletions`
  ADD PRIMARY KEY (`user_id`,`chat_id`),
  ADD KEY `chat_id` (`chat_id`);

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_id` (`chat_id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `chat_message_edits`
--
ALTER TABLE `chat_message_edits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `message_id` (`message_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `book_requests`
--
ALTER TABLE `book_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT for table `chat_message_edits`
--
ALTER TABLE `chat_message_edits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=390;

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
-- Constraints for table `chat_deletions`
--
ALTER TABLE `chat_deletions`
  ADD CONSTRAINT `chat_deletions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `chat_deletions_ibfk_2` FOREIGN KEY (`chat_id`) REFERENCES `chats` (`id`);

--
-- Constraints for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD CONSTRAINT `chat_messages_ibfk_1` FOREIGN KEY (`chat_id`) REFERENCES `chats` (`id`),
  ADD CONSTRAINT `chat_messages_ibfk_2` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `chat_messages_ibfk_3` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `chat_message_edits`
--
ALTER TABLE `chat_message_edits`
  ADD CONSTRAINT `chat_message_edits_ibfk_1` FOREIGN KEY (`message_id`) REFERENCES `chat_messages` (`id`);

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
