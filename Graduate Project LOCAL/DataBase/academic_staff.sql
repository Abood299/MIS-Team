-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2025 at 05:28 PM
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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_staff`
--
ALTER TABLE `academic_staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `academic_staff`
--
ALTER TABLE `academic_staff`
  ADD CONSTRAINT `academic_staff_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
