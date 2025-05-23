-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2025 at 01:04 PM
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
(20, 1, '1', 'مبادئ محاسبة 1', 'https://m.media-amazon.com/images/I/81H7oynuXHL._SL1500_.jpg'),
(21, 1, '1', 'نظم إدارة قواعد البيانات', 'https://www.dreambookpublishing.com/wp-content/uploads/2021/11/duxcfg-744x1024.png'),
(22, 1, '1', 'إدارة موارد المعلومات', 'https://m.media-amazon.com/images/I/818lYq4iUGL._SL1500_.jpg'),
(23, 1, '1', 'نظم إدارة المعرفة: أساليب وممارسات', 'https://thaka.bing.com/th/id/OIP.N4YBJF2gxo0tbmB8BeLRRwAAAA?rs=1&pid=ImgDetMain'),
(24, 1, '1', 'تحليل وتصميم أنظمة المعلومات', 'https://m.media-amazon.com/images/I/61aOGVXMQ1L._SL1324_.jpg'),
(25, 1, '1', 'الابتكار والريادة الرقمية', 'https://m.media-amazon.com/images/I/61C7uSPWIuL._SL1500_.jpg'),
(26, 1, '1', 'حلقة بحث في نظم المعلومات الإدارية', 'https://media.springernature.com/w153/springer-static/cover/book/978-3-031-25470-3.jpg'),
(27, 1, '2', 'مبادئ إدارة الأعمال', 'https://th.bing.com/th/id/R.c0d3f18f70b5e1b8ad0ba6067da5e62a?rik=Sgnco9rs8JKBkw&pid=ImgRaw&r=0'),
(28, 1, '2', 'أساسيات البرمجة للأعمال', 'https://thaka.bing.com/th/id/OIP.9oLn7WU8Qh75VKQPH61yqgHaLG?rs=1&pid=ImgDetMain'),
(29, 1, '2', 'مبادئ الاقتصاد الجزئي', 'https://th.bing.com/th/id/OIP.cuY6NHnYLFXuQU5NhM3b_AHaIt?cb=iwc1&rs=1&pid=ImgDetMain'),
(30, 1, '2', 'مبادئ تسويق', 'https://i.pinimg.com/736x/04/09/cc/0409cc2d2f11d037acb4a88dcaa0c0a3.jpg'),
(31, 1, '2', 'ذكاء الأعمال وأدوات تحليل البيانات', 'https://m.media-amazon.com/images/I/71PERh4QmgL._SL1500_.jpg'),
(32, 1, '2', 'قضايا معاصرة في نظم المعلومات الإدارية', 'https://thaka.bing.com/th/id/OIP.-oJFHEEnvwOYJrq9BL1GOQHaLI?rs=1&pid=ImgDetMain'),
(33, 1, '2', 'تطبيقات الذكاء الاصطناعي للأعمال', 'https://cdn.kobo.com/book-images/a3627c8f-5ab8-488e-9b18-10a86092a9d0/1200/1200/False/artificial-intelligence-business-applications.jpg'),
(34, 1, '3', 'مبادئ إحصاء', 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1388183119i/340019.jpg'),
(35, 1, '3', 'برمجة تطبيقات الأعمال', 'https://m.media-amazon.com/images/I/41NF7KEPJVL.jpg'),
(36, 1, '3', 'برمجة تطبيقات الإنترنت', 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1348734135i/3729666.jpg'),
(37, 1, '3', 'نظم إدارة موارد المنظمة', 'https://thaka.bing.com/th/id/OIP.MgxDlgKKzPErGOGyS_9fgwHaLL?rs=1&pid=ImgDetMain'),
(38, 1, '3', 'نمذجة الأعمال والمحاكاة', 'https://th.bing.com/th/id/R.0b0fa81fa2c21f8d17d5a0d54df8152c?rik=C6H6m0fiDac9Sw&pid=ImgRaw&r=0'),
(39, 1, '3', 'مهارات الاستعداد لسوق العمل', 'nan'),
(40, 1, '3', 'مشروع في نظم المعلومات الإدارية', 'nan'),
(41, 1, '4', 'الإدارة العامة الحديثة', 'https://th.bing.com/th/id/OIP.d7qgPv_PJb8SCCoqsKH2PwAAAA?cb=iwc1&rs=1&pid=ImgDetMain'),
(42, 1, '4', 'الأعمال الإلكترونية', 'https://m.media-amazon.com/images/I/61rvdr5W-TL._SL1072_.jpg'),
(43, 1, '4', 'نظم الوسائط المتعددة', 'https://images.secondsale.com/images/ff259a19eb448be2719e91d8503766c5.jpg'),
(44, 1, '4', 'برمجة تطبيقات الأجهزة الذكية', 'https://thaka.bing.com/th/id/OIP.eigHM4vOmyXA-9MH55p77QHaLO?rs=1&pid=ImgDetMain'),
(45, 1, '4', 'أمن المعلومات', 'https://m.media-amazon.com/images/I/71RYLQjODAL._SL1500_.jpg'),
(46, 1, '4', 'التدريب العملي لطلبة نظم المعلومات الإدارية', 'nan'),
(47, 2, '1', 'مبادئ التسويق', 'https://i.pinimg.com/736x/04/09/cc/0409cc2d2f11d037acb4a88dcaa0c0a3.jpg'),
(48, 2, '1', 'مبادئ الاقتصاد الجزئي', 'https://th.bing.com/th/id/OIP.cuY6NHnYLFXuQU5NhM3b_AHaIt?cb=iwc1&rs=1&pid=ImgDetMain'),
(49, 2, '1', 'الاتصالات التسويقية المتكاملة', 'https://m.media-amazon.com/images/I/61aQeB0F1RL._SL1250_.jpg'),
(50, 2, '1', 'إدارة قنوات التسويق', 'https://res.cloudinary.com/bloomsbury-atlas/image/upload/w_568,c_scale/jackets/9780275954390.jpg'),
(51, 2, '1', 'إدارة التسويق', 'https://thaka.bing.com/th/id/OIP.9zUj88prQPrbm4ii7IbwpgHaKx?rs=1&pid=ImgDetMain'),
(52, 2, '1', 'بحوث السوق', 'https://rukminim1.flixcart.com/image/1408/1408/book/2/2/3/marketing-research-4ed-beri-original-imadcuktehzpzf6x.jpeg?q=90'),
(53, 2, '1', 'التسويق عبر محركات البحث', 'https://www.digitalvidya.com/blog/wp-content/uploads/2017/01/Global-Search-Engine-Marketing.webp'),
(54, 2, '1', 'العمل لطلبة التسويق', 'nan'),
(55, 2, '2', 'مبادئ إدارة أعمال', 'https://th.bing.com/th/id/R.c0d3f18f70b5e1b8ad0ba6067da5e62a?rik=Sgnco9rs8JKBkw&pid=ImgRaw&r=0'),
(56, 2, '2', 'مبادئ نظم معلومات إدارية', 'https://www.neerajbooks.com/image/data/mcs-52-em-principal_of_management_and_information_system.jpg'),
(57, 2, '2', 'تخطيط وتطوير المنتجات', 'https://www.oreilly.com/api/v2/epubs/9780127999456/files/images/9780128001905_FC.jpg'),
(58, 2, '2', 'المهارات الرقمية الحديثة', 'https://th.bing.com/th/id/R.82b76ffe7a29d2a510fb015b1159322b?rik=YvPqjasI6Rd40Q&pid=ImgRaw&r=0'),
(59, 2, '2', 'التسويق الرقمي', 'https://thaka.bing.com/th/id/OIP.C7VBtSaEpHTUSro8UMNr6wHaHa?rs=1&pid=ImgDetMain'),
(60, 2, '2', 'استراتيجية التسويق', 'https://thaka.bing.com/th/id/OIP.Rw_VvSEXa1xzEJyHIwB3vAHaKz?rs=1&pid=ImgDetMain'),
(61, 2, '2', 'مشروع التخرج', 'nan'),
(62, 2, '3', 'الإدارة العامة الحديثة', 'https://th.bing.com/th/id/OIP.d7qgPv_PJb8SCCoqsKH2PwAAAA?cb=iwc1&rs=1&pid=ImgDetMain'),
(63, 2, '3', 'سلوك مستهلك', 'https://thaka.bing.com/th/id/OIP.DpFpfzlSOFY_r1JLMniqlwAAAA?rs=1&pid=ImgDetMain'),
(64, 2, '3', 'مبادئ إحصاء', 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1388183119i/340019.jpg'),
(65, 2, '3', 'مبادئ الإدارة المالية', 'https://th.bing.com/th/id/OIP.GPX1wfBvXgu7G1q-5hrSKgHaJQ?cb=iwc1&rs=1&pid=ImgDetMain'),
(66, 2, '3', 'العلاقات العامة', 'https://th.bing.com/th/id/R.1b174acc9bc4b9c68028e77443f4a932?rik=sWQw7%2bG0aDERow&pid=ImgRaw&r=0'),
(67, 2, '3', 'قضايا معاصرة في التسويق', 'https://res.cloudinary.com/bloomsbury-atlas/image/upload/w_360,c_scale/jackets/9780333677742.jpg'),
(68, 2, '3', 'التدريب الميداني', 'nan'),
(69, 2, '4', 'مبادئ محاسبة (1)', 'https://m.media-amazon.com/images/I/81H7oynuXHL._SL1500_.jpg'),
(70, 2, '4', 'مدخل إلى الاقتصاد الرياضي', 'https://img.perlego.com/book-covers/1239853/9788132325567_300_450.webp'),
(71, 2, '4', 'التسويق الدولي', 'https://th.bing.com/th/id/R.dd69a5b023b020113f29fe26d186838d?rik=u%2bP2xd3bmQhXqA&pid=ImgRaw&r=0'),
(72, 2, '4', 'إدارة مبيعات', 'https://mashummollah.com/wp-content/uploads/2021/02/Sales-Management.-Simplified.jpg'),
(73, 2, '4', 'سياسات التسعير', 'https://images-na.ssl-images-amazon.com/images/I/51eM5oYtNSL.jpg'),
(74, 2, '4', 'تسويق وإدارة المحتوى', 'https://thaka.bing.com/th/id/OIP.Fh50P_eJQSgPBEq7Lr03qQAAAA?rs=1&pid=ImgDetMain'),
(75, 2, '4', 'مهارات الجاهزية لسوق العمل', 'nan'),
(76, 3, '1', 'مبادئ إدارة الأعمال', 'https://th.bing.com/th/id/R.c0d3f18f70b5e1b8ad0ba6067da5e62a?rik=Sgnco9rs8JKBkw&pid=ImgRaw&r=0'),
(77, 3, '1', 'الرياضيات لطلبة التمويل', 'https://images-na.ssl-images-amazon.com/images/I/51vMyX8q6LL.jpg'),
(78, 3, '1', 'مبادئ الاستثمار', 'https://m.media-amazon.com/images/I/51+6+H+0v6kL.jpg'),
(79, 3, '1', 'مؤسسات مالية', 'https://th.bing.com/th/id/OIP.Sw0Lpqntcy82WrXqOSaD2QHaLH?rs=1&pid=ImgDetMain'),
(80, 3, '1', 'التحليل المالي', 'https://m.media-amazon.com/images/I/71-6az4ms2L._SL1500_.jpg'),
(81, 3, '1', 'تمويل الشركات', 'https://th.bing.com/th/id/OIP.x-M2ZhE3NS3kYQJ6ZNEyQgAAAA?rs=1&pid=ImgDetMain'),
(82, 3, '1', 'تحليل الأوراق المالية', 'https://th.bing.com/th/id/OIP.KXLEZBYX6MQu-Skbw2yq1QHaLH?rs=1&pid=ImgDetMain'),
(83, 3, '1', 'مشروع التخرج', 'nan'),
(84, 3, '2', 'مبادئ المحاسبة (1)', 'https://m.media-amazon.com/images/I/81H7oynuXHL._SL1500_.jpg'),
(85, 3, '2', 'الإحصاء لطلبة التمويل', 'https://m.media-amazon.com/images/I/71ER6kUMbHL._SL1200_.jpg'),
(86, 3, '2', 'محاسبة التكاليف', 'https://th.bing.com/th/id/OIP.MUKv9iMFL5K-nZljg9GoGwHaLZ?rs=1&pid=ImgDetMain'),
(87, 3, '2', 'أسواق مالية', 'https://th.bing.com/th/id/OIP.ehMm5w_Yo3vD_3Q4F8EsaAHaLQ?rs=1&pid=ImgDetMain'),
(88, 3, '2', 'إدارة مالية (2)', 'https://th.bing.com/th/id/OIP.6mJ4Q7FvjwRuV-bHZbcV-wHaKf?rs=1&pid=ImgDetMain'),
(89, 3, '2', 'التحليل الكمي في التمويل', 'https://th.bing.com/th/id/OIP.pGukwBEPRC3H7xuKsnJ8pAHaJ4?rs=1&pid=ImgDetMain'),
(90, 3, '2', 'تمويل دولي', 'https://m.media-amazon.com/images/I/61tRUJYln-L._SL1000_.jpg'),
(91, 3, '2', 'التدريب العملي', 'nan'),
(92, 3, '3', 'مبادئ التمويل', 'https://thaka.bing.com/th/id/OIP.E6vNBvCC_4kWzvmm9MjZ9gAAAA?rs=1&pid=ImgDetMain'),
(93, 3, '3', 'مبادئ نظم معلومات إدارية', 'https://www.neerajbooks.com/image/data/mcs-52-em-principal_of_management_and_information_system.jpg'),
(94, 3, '3', 'الاقتصاد الكلي', 'https://th.bing.com/th/id/OIP.dIUS5zCnBP8VMT-hyb6fjAHaLH?rs=1&pid=ImgDetMain'),
(95, 3, '3', 'محاسبة شركات', 'https://m.media-amazon.com/images/I/61rIXds4X6L._SL1024_.jpg'),
(96, 3, '3', 'تمويل المشاريع', 'https://m.media-amazon.com/images/I/51l4WrkQCXL.jpg'),
(97, 3, '3', 'إدارة المحافظ الاستثمارية', 'https://m.media-amazon.com/images/I/71Q7FwE4rlL._SL1500_.jpg'),
(98, 3, '3', 'قضايا معاصرة في التمويل', 'https://m.media-amazon.com/images/I/91PiVRUX6DL._SL1500_.jpg'),
(99, 3, '4', 'مبادئ الاقتصاد الجزئي', 'https://th.bing.com/th/id/OIP.cuY6NHnYLFXuQU5NhM3b_AHaIt?cb=iwc1&rs=1&pid=ImgDetMain'),
(100, 3, '4', 'التمويل المتوسط والطويل الأجل', 'https://m.media-amazon.com/images/I/41YkAqVYVxL.jpg'),
(101, 3, '4', 'إدارة مالية (1)', 'https://th.bing.com/th/id/OIP.z5fYMXkCR2u8xEJ1GJXqWgHaL2?rs=1&pid=ImgDetMain'),
(102, 3, '4', 'تحليل القوائم المالية', 'https://th.bing.com/th/id/OIP.EA7WLdnPpUz9uMr9k92oDgHaJ4?rs=1&pid=ImgDetMain'),
(103, 3, '4', 'التمويل الإسلامي', 'https://m.media-amazon.com/images/I/81aey-YAs0L._SL1500_.jpg'),
(104, 3, '4', 'إدارة الخطر والتأمين', 'https://m.media-amazon.com/images/I/91V8AqJtYcL._SL1500_.jpg'),
(105, 3, '4', 'مهارات الجاهزية لسوق العمل', 'nan'),
(106, 4, '1', 'مبادئ المحاسبة (1)', 'https://m.media-amazon.com/images/I/81H7oynuXHL._SL1500_.jpg'),
(107, 4, '1', 'الرياضيات لطلبة المحاسبة', 'https://images-na.ssl-images-amazon.com/images/I/51vMyX8q6LL.jpg'),
(108, 4, '1', 'محاسبة التكاليف', 'https://th.bing.com/th/id/OIP.MUKv9iMFL5K-nZljg9GoGwHaLZ?rs=1&pid=ImgDetMain'),
(109, 4, '1', 'التحليل المالي', 'https://m.media-amazon.com/images/I/71-6az4ms2L._SL1500_.jpg'),
(110, 4, '1', 'محاسبة إدارية', 'https://th.bing.com/th/id/OIP.2_2rsv46Bkg02MlJcuUpzwHaKp?rs=1&pid=ImgDetMain'),
(111, 4, '1', 'محاسبة شركات الأشخاص', 'https://th.bing.com/th/id/OIP.4J1znZxw_d3lzH3DCYyBkwHaLS?rs=1&pid=ImgDetMain'),
(112, 4, '1', 'التدقيق المالي (2)', 'https://m.media-amazon.com/images/I/61lYWPDGWnL._SL1000_.jpg'),
(113, 4, '1', 'التدريب العملي', 'nan'),
(114, 4, '2', 'مبادئ إدارة الأعمال', 'https://th.bing.com/th/id/R.c0d3f18f70b5e1b8ad0ba6067da5e62a?rik=Sgnco9rs8JKBkw&pid=ImgRaw&r=0'),
(115, 4, '2', 'اللغة الإنجليزية للمحاسبة', 'https://th.bing.com/th/id/OIP.pzyD2GQUoyVbB9JQnJIGhwHaKN?rs=1&pid=ImgDetMain'),
(116, 4, '2', 'المحاسبة الحكومية', 'https://th.bing.com/th/id/R.165f19a121a92fa71b7f5bdb4e6f8ec1?rik=y2rNeVbmQ7aeJg&pid=ImgRaw&r=0'),
(117, 4, '2', 'مقدمة في التدقيق', 'https://m.media-amazon.com/images/I/61RMVKjjxaL._SL1181_.jpg'),
(118, 4, '2', 'محاسبة متوسطة (1)', 'https://m.media-amazon.com/images/I/51vljKxoRTL.jpg'),
(119, 4, '2', 'محاسبة الشركات الأجنبية', 'https://th.bing.com/th/id/OIP.7ucRCY7XEfKHqGOXIMhL1QHaLH?rs=1&pid=ImgDetMain'),
(120, 4, '2', 'التدقيق المحوسب', 'https://th.bing.com/th/id/OIP.WITy1z1_5V5UzJ2zPP-3FAHaLH?rs=1&pid=ImgDetMain'),
(121, 4, '2', 'مهارات الجاهزية لسوق العمل', 'nan'),
(122, 4, '3', 'مبادئ الاقتصاد الجزئي', 'https://th.bing.com/th/id/OIP.cuY6NHnYLFXuQU5NhM3b_AHaIt?cb=iwc1&rs=1&pid=ImgDetMain'),
(123, 4, '3', 'مقدمة في نظم المعلومات المحاسبية', 'https://th.bing.com/th/id/R.e3ef1ac7f396025e9bb76d498bd8437e?rik=LEAjshwoDR3pKA&pid=ImgRaw&r=0'),
(124, 4, '3', 'الاقتصاد الكلي', 'https://th.bing.com/th/id/OIP.dIUS5zCnBP8VMT-hyb6fjAHaLH?rs=1&pid=ImgDetMain'),
(125, 4, '3', 'مبادئ القانون التجاري', 'https://th.bing.com/th/id/OIP.yZOS3kmNGyR_FqMJnKEDaAHaLH?rs=1&pid=ImgDetMain'),
(126, 4, '3', 'محاسبة متوسطة (2)', 'https://th.bing.com/th/id/R.17eaf8d6c790ae173af6624bcb79d0d2?rik=GfMTydMxBQ9Xzw&pid=ImgRaw&r=0'),
(127, 4, '3', 'قضايا معاصرة في المحاسبة', 'https://m.media-amazon.com/images/I/61ZnOIBGQdL._SL1000_.jpg'),
(128, 4, '3', 'محاسبة دولية', 'https://th.bing.com/th/id/OIP.HHy8uUhcf7s9NoENcSY_3gHaJ4?rs=1&pid=ImgDetMain'),
(129, 4, '4', 'الإحصاء', 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1388183119i/340019.jpg'),
(130, 4, '4', 'محاسبة الشركات', 'https://m.media-amazon.com/images/I/61rIXds4X6L._SL1024_.jpg'),
(131, 4, '4', 'محاسبة المؤسسات المالية', 'https://m.media-amazon.com/images/I/61DE2Y4eNXL.jpg'),
(132, 4, '4', 'محاسبة ضريبية', 'https://m.media-amazon.com/images/I/71kAWH3e6OL._SL1001_.jpg'),
(133, 4, '4', 'التدقيق المالي (1)', 'https://th.bing.com/th/id/OIP.FAxyvhzHb15Ulf8ZzC1W7wAAAA?rs=1&pid=ImgDetMain'),
(134, 4, '4', 'محاسبة متقدمة', 'https://m.media-amazon.com/images/I/81E8XqRCQZL._SL1500_.jpg'),
(135, 4, '4', 'مشروع التخرج', 'nan'),
(136, 5, '1', 'مبادئ الاقتصاد الجزئي', 'https://th.bing.com/th/id/OIP.cuY6NHnYLFXuQU5NhM3b_AHaIt?cb=iwc1&rs=1&pid=ImgDetMain'),
(137, 5, '1', 'مبادئ الاقتصاد الكلي', 'https://th.bing.com/th/id/OIP.dIUS5zCnBP8VMT-hyb6fjAHaLH?rs=1&pid=ImgDetMain'),
(138, 5, '1', 'الاقتصاد الرياضي (1)', 'https://img.perlego.com/book-covers/1239853/9788132325567_300_450.webp'),
(139, 5, '1', 'تاريخ الفكر الاقتصادي', 'https://www.neelwafurat.com/images/lb/abookstore/covers/carton/268/268501.jpg'),
(140, 5, '1', 'الاقتصاد الرياضي (2)', 'https://img.perlego.com/book-covers/1239853/9788132325567_300_450.webp'),
(141, 5, '1', 'نظرية الاقتصاد الكلي', 'https://m.media-amazon.com/images/I/61c4HKfvWVL._SL1500_.jpg'),
(142, 5, '1', 'الاقتصاد المؤسسي', 'https://th.bing.com/th/id/OIP.oMtyt8uIFB-Wge8UBjS65QAAAA?rs=1&pid=ImgDetMain'),
(143, 5, '1', 'مهارات الجاهزية لسوق العمل', 'nan'),
(144, 5, '2', 'مبادئ المحاسبة', 'https://m.media-amazon.com/images/I/81H7oynuXHL._SL1500_.jpg'),
(145, 5, '2', 'الرياضيات لطلبة الاقتصاد', 'https://images-na.ssl-images-amazon.com/images/I/51vMyX8q6LL.jpg'),
(146, 5, '2', 'المالية العامة', 'https://www.neelwafurat.com/images/lb/abookstore/covers/carton/237/237636.jpg'),
(147, 5, '2', 'الاقتصاد الإسلامي', 'https://m.media-amazon.com/images/I/71vRvJv7N0L._SL1500_.jpg'),
(148, 5, '2', 'تنمية اقتصادية', 'https://th.bing.com/th/id/OIP.qJUGMryZvxzxYBFlp7cU6QAAAA?rs=1&pid=ImgDetMain'),
(149, 5, '2', 'اقتصاد البيئة', 'https://m.media-amazon.com/images/I/71vRVoo8i-L._SL1000_.jpg'),
(150, 5, '2', 'تحليل اقتصادي كلي', 'https://th.bing.com/th/id/R.7b508a4bc1f689da9841ee9f1542422f?rik=MLWh5GOVeHuhww&pid=ImgRaw&r=0'),
(151, 5, '3', 'مبادئ إحصاء', 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1388183119i/340019.jpg'),
(152, 5, '3', 'اللغة الإنجليزية للاقتصاد', 'https://th.bing.com/th/id/OIP.pzyD2GQUoyVbB9JQnJIGhwHaKN?rs=1&pid=ImgDetMain'),
(153, 5, '3', 'نقود وبنوك', 'https://th.bing.com/th/id/R.5b194d1fa3d2d1fbd39eb42f7f54f775?rik=6ZEBXslPKQ5qpw&pid=ImgRaw&r=0'),
(154, 5, '3', 'القانون التجاري', 'https://th.bing.com/th/id/OIP.yZOS3kmNGyR_FqMJnKEDaAHaLH?rs=1&pid=ImgDetMain'),
(155, 5, '3', 'نظرية التجارة الدولية', 'https://th.bing.com/th/id/R.c9ec4513f8cb73034ef382d6f2a4e9e1?rik=FXSUL9dQ70WXpA&pid=ImgRaw&r=0'),
(156, 5, '3', 'اقتصاد دولي', 'https://m.media-amazon.com/images/I/61L7ceRphjL._SL1000_.jpg'),
(157, 5, '3', 'مشروع التخرج', 'nan'),
(158, 5, '4', 'مبادئ إدارة الأعمال', 'https://th.bing.com/th/id/R.c0d3f18f70b5e1b8ad0ba6067da5e62a?rik=Sgnco9rs8JKBkw&pid=ImgRaw&r=0'),
(159, 5, '4', 'الاقتصاد القياسي (1)', 'https://m.media-amazon.com/images/I/71gcjW1mcpL._SL1500_.jpg'),
(160, 5, '4', 'نظم معلومات اقتصادية', 'https://thaka.bing.com/th/id/OIP.DrRZStGZbpRChxOr6x8N9gHaJ4?rs=1&pid=ImgDetMain'),
(161, 5, '4', 'الاقتصاد القياسي (2)', 'https://m.media-amazon.com/images/I/71gcjW1mcpL._SL1500_.jpg'),
(162, 5, '4', 'اقتصاد إداري', 'https://www.neelwafurat.com/images/lb/abookstore/covers/carton/158/158939.jpg'),
(163, 5, '4', 'اقتصاد الطاقة', 'https://m.media-amazon.com/images/I/61wlQBDZsZL._SL1000_.jpg'),
(164, 5, '4', 'التدريب العملي', 'nan'),
(165, 6, '1', 'الإدارة العامة الحديثة', 'https://th.bing.com/th/id/OIP.d7qgPv_PJb8SCCoqsKH2PwAAAA?cb=iwc1&rs=1&pid=ImgDetMain'),
(166, 6, '1', 'نظريات التنظيم', 'https://th.bing.com/th/id/R.67f5371999691fe5c72f62fd82bb47eb?rik=tlKb9TYaGTiwbg&pid=ImgRaw&r=0'),
(167, 6, '1', 'مبادئ الاقتصاد الجزئي', 'https://th.bing.com/th/id/OIP.cuY6NHnYLFXuQU5NhM3b_AHaIt?cb=iwc1&rs=1&pid=ImgDetMain'),
(168, 6, '1', 'المهارات الرقمية', 'https://th.bing.com/th/id/R.82b76ffe7a29d2a510fb015b1159322b?rik=YvPqjasI6Rd40Q&pid=ImgRaw&r=0'),
(169, 6, '1', 'مبادئ نظم معلومات إدارية', 'https://www.neerajbooks.com/image/data/mcs-52-em-principal_of_management_and_information_system.jpg'),
(170, 6, '1', 'السياسات العامة', 'https://www.neelwafurat.com/images/eg/abookstore/covers/carton/156/156743.jpg'),
(171, 6, '1', 'التخطيط الاستراتيجي في القطاع العام', 'https://th.bing.com/th/id/OIP.nqKcbpT1bFltRsc3TyBh4AAAAA?cb=iwc1&rs=1&pid=ImgDetMain'),
(172, 6, '1', 'التدريب العملي', 'nan'),
(173, 6, '2', 'مبادئ إحصاء', 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1388183119i/340019.jpg'),
(174, 6, '2', 'مناهج البحث في العلوم الإدارية', 'https://media.zid.store/cdn-cgi/image/f=auto/https://media.zid.store/c3c80b9f-f176-496c-9f27-04187e1270f9/d267aabe-5fc0-444d-ba24-a6b29515817b.jpg'),
(175, 6, '2', 'السلوك الإداري', 'https://www.neelwafurat.com/images/lb/abookstore/covers/carton/314/314759.jpg'),
(176, 6, '2', 'التنظيم وإجراءات العمل', 'https://th.bing.com/th/id/OIP.pIgJ-1Mi66HEYdTK2vlR4gHaKf?cb=iwc1&rs=1&pid=ImgDetMain'),
(177, 6, '2', 'الإدارة العامة في الأردن', 'https://www.neelwafurat.com/images/lb/abookstore/covers/normal/103/103843.gif'),
(178, 6, '2', 'إدارة الجودة في القطاع العام', 'https://www.neelwafurat.com/images/eg/abookstore/covers/carton/222/222658.jpg'),
(179, 6, '2', 'إدارة الحسابات الحكومية', 'https://th.bing.com/th/id/R.f1f678ef4a9fde7ae7c2c467a061d118?rik=GGyc%2brCpb0uujg&pid=ImgRaw&r=0'),
(180, 6, '3', 'مبادئ محاسبة (1)', 'https://m.media-amazon.com/images/I/81H7oynuXHL._SL1500_.jpg'),
(181, 6, '3', 'مبادئ إدارة الأعمال', 'https://th.bing.com/th/id/R.c0d3f18f70b5e1b8ad0ba6067da5e62a?rik=Sgnco9rs8JKBkw&pid=ImgRaw&r=0'),
(182, 6, '3', 'مالية عامة', 'https://www.neelwafurat.com/images/lb/abookstore/covers/carton/237/237636.jpg'),
(183, 6, '3', 'إدارة المشروعات العامة', 'https://www.neelwafurat.com/images/lb/abookstore/covers/carton/377/377941.jpg'),
(184, 6, '3', 'إدارة المشتريات والتوزيد', 'https://www.neelwafurat.com/images/eg/abookstore/covers/normal/243/243000.jpg'),
(185, 6, '3', 'أساليب التحليل الكمي', 'https://www.neelwafurat.com/images/lb/abookstore/covers/carton/171/171933.jpg'),
(186, 6, '3', 'إدارة الأزمات', 'https://m.media-amazon.com/images/I/81dksK7DXOL._SL1500_.jpg'),
(187, 6, '4', 'مبادئ التسويق', 'https://i.pinimg.com/736x/04/09/cc/0409cc2d2f11d037acb4a88dcaa0c0a3.jpg'),
(188, 6, '4', 'مبادئ الإدارة المالية', 'https://th.bing.com/th/id/OIP.GPX1wfBvXgu7G1q-5hrSKgHaJQ?cb=iwc1&rs=1&pid=ImgDetMain'),
(189, 6, '4', 'إدارة العلاقات العامة', 'https://www.neelwafurat.com/images/lb/abookstore/covers/normal/342/342772.jpg'),
(190, 6, '4', 'الحوكمة', 'https://i0.wp.com/eduschool40.blog/wp-content/uploads/2021/12/FHZw-0DWYAE03eS.jpg?ssl=1'),
(191, 6, '4', 'إدارة الموارد البشرية في القطاع العام', 'https://www.neelwafurat.com/images/lb/abookstore/covers/carton/189/189789.gif'),
(192, 6, '4', 'مهارات الاستعداد لسوق العمل', 'nan'),
(193, 6, '4', 'الموازنة العامة', 'https://www.neelwafurat.com/images/lb/abookstore/covers/normal/404/404235.jpg'),
(194, 7, '1', 'مبادئ إدارة الأعمال', 'https://th.bing.com/th/id/R.c0d3f18f70b5e1b8ad0ba6067da5e62a?rik=Sgnco9rs8JKBkw&pid=ImgRaw&r=0'),
(195, 7, '1', 'مبادئ الإحصاء', 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1388183119i/340019.jpg'),
(196, 7, '1', 'مبادئ التمويل', 'https://thaka.bing.com/th/id/OIP.E6vNBvCC_4kWzvmm9MjZ9gAAAA?rs=1&pid=ImgDetMain'),
(197, 7, '1', 'إدارة العمليات', 'https://m.media-amazon.com/images/I/61Zfxzgq6WL.jpg'),
(198, 7, '1', 'إدارة الأعمال الدولية', 'https://m.media-amazon.com/images/I/71RI+bVj+pL._SL1500_.jpg'),
(199, 7, '1', 'محاسبة إدارية', 'https://th.bing.com/th/id/OIP.2_2rsv46Bkg02MlJcuUpzwHaKp?rs=1&pid=ImgDetMain'),
(200, 7, '1', 'إدارة المعرفة', 'https://m.media-amazon.com/images/I/61Vo0qjHdqL._SL1000_.jpg'),
(201, 7, '1', 'مشروع التخرج', 'nan'),
(202, 7, '2', 'مبادئ محاسبة', 'https://m.media-amazon.com/images/I/81H7oynuXHL._SL1500_.jpg'),
(203, 7, '2', 'الرياضيات لطلبة الإدارة', 'https://images-na.ssl-images-amazon.com/images/I/51vMyX8q6LL.jpg'),
(204, 7, '2', 'مبادئ القانون التجاري', 'https://th.bing.com/th/id/OIP.yZOS3kmNGyR_FqMJnKEDaAHaLH?rs=1&pid=ImgDetMain'),
(205, 7, '2', 'مقدمة في نظم معلومات إدارية', 'https://www.neerajbooks.com/image/data/mcs-52-em-principal_of_management_and_information_system.jpg'),
(206, 7, '2', 'إدارة التغيير والتطوير التنظيمي', 'https://th.bing.com/th/id/OIP.49A3r3mLjM6um3oWg7NcUwAAAA?rs=1&pid=ImgDetMain'),
(207, 7, '2', 'إدارة الإنتاج', 'https://m.media-amazon.com/images/I/71ItkHHYZuL._SL1000_.jpg'),
(208, 7, '2', 'إدارة الابتكار', 'https://m.media-amazon.com/images/I/91d5L7pKqfL._SL1500_.jpg'),
(209, 7, '2', 'التدريب العملي', 'nan'),
(210, 7, '3', 'مبادئ الاقتصاد الجزئي', 'https://th.bing.com/th/id/OIP.cuY6NHnYLFXuQU5NhM3b_AHaIt?cb=iwc1&rs=1&pid=ImgDetMain'),
(211, 7, '3', 'اللغة الإنجليزية للإدارة', 'https://th.bing.com/th/id/OIP.pzyD2GQUoyVbB9JQnJIGhwHaKN?rs=1&pid=ImgDetMain'),
(212, 7, '3', 'إدارة موارد بشرية', 'https://m.media-amazon.com/images/I/41DT7M2gVgL.jpg'),
(213, 7, '3', 'مهارات اتصال إداري', 'https://th.bing.com/th/id/OIP.npPWYbKuGpHPhUuGOkUWIgHaKn?rs=1&pid=ImgDetMain'),
(214, 7, '3', 'تحليل قرارات الأعمال', 'https://th.bing.com/th/id/OIP.fOWVmcM-KY-ymlPJ7SgbYwAAAA?rs=1&pid=ImgDetMain'),
(215, 7, '3', 'قضايا معاصرة في الإدارة', 'https://th.bing.com/th/id/OIP.iNS3uVjRtE1iQ6xT7xFKYAHaLH?rs=1&pid=ImgDetMain'),
(216, 7, '3', 'إدارة المشاريع', 'https://th.bing.com/th/id/OIP.pIgJ-1Mi66HEYdTK2vlR4gHaKf?cb=iwc1&rs=1&pid=ImgDetMain'),
(217, 7, '4', 'مبادئ تسويق', 'https://i.pinimg.com/736x/04/09/cc/0409cc2d2f11d037acb4a88dcaa0c0a3.jpg'),
(218, 7, '4', 'سلوك تنظيمي', 'https://th.bing.com/th/id/OIP.A1UbOUvKjzN-BW_LNJ2KDgHaLH?rs=1&pid=ImgDetMain'),
(219, 7, '4', 'الاقتصاد الكلي', 'https://th.bing.com/th/id/OIP.dIUS5zCnBP8VMT-hyb6fjAHaLH?rs=1&pid=ImgDetMain'),
(220, 7, '4', 'إدارة استراتيجية', 'https://th.bing.com/th/id/OIP.AwVgUhhLHgPl7vBW7Mw91gAAAA?rs=1&pid=ImgDetMain'),
(221, 7, '4', 'إدارة مالية', 'https://th.bing.com/th/id/OIP.z5fYMXkCR2u8xEJ1GJXqWgHaL2?rs=1&pid=ImgDetMain'),
(222, 7, '4', 'أخلاقيات العمل', 'https://th.bing.com/th/id/OIP.9k7GM9zZsUBG9fA_m9lq6wHaLH?rs=1&pid=ImgDetMain'),
(223, 7, '4', 'مهارات الجاهزية لسوق العمل', 'nana');

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
(1, 'تحليل وتصميم انظمة', 'https://m.media-amazon.com/images/I/91z81kUHUjL._AC_UF1000,1000_QL80_.jpg', 1),
(2, 'مبادئ تسويق', 'https://res.cloudinary.com/bloomsbury-atlas/image/upload/w_568,c_scale,dpr_1.5/jackets/9780230392700.jpg', 2),
(3, 'مبادئ ادارة مالية', 'https://www.massira.jo/sites/default/files/200850999_0.jpg', 3),
(4, 'مبادئ محاسبة 1', 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1500300702i/35693562.jpg', 4),
(5, 'مبادئ الاقتصاد الجزئي', 'https://www.neelwafurat.com/images/lb/abookstore/covers/carton/164/164765.jpg', 5),
(6, 'ادارة عامة حديثة', 'https://www.neelwafurat.com/images/lb/abookstore/covers/normal/221/221059.jpg', 6),
(7, 'مبادئ ادارة اعمال', 'https://www.store.bookrivers.com/wp-content/uploads/2023/04/front-4.jpg', 7);

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
(41, 1, 4, NULL, '12343546', '2025-04-04 22:37:58', 'dropped'),
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
(116, 2, 7, NULL, 'book ', '2025-05-12 22:55:20', 'exchanged'),
(117, 1, 3, NULL, 'شششششششششششش', '2025-05-12 22:58:15', 'exchanged'),
(118, 2, 1, NULL, 'aaaaaaaa', '2025-05-13 10:36:23', 'dropped'),
(119, 2, 4, NULL, 'aaaaaa', '2025-05-13 11:00:05', 'dropped'),
(120, 1, 1, 2, 'cvsdsfg', '2025-05-13 11:31:01', 'dropped'),
(121, 2, 1, NULL, 'safgsaf', '2025-05-13 11:36:31', 'exchanged'),
(122, 2, 1, NULL, 'a', '2025-05-13 11:40:36', 'dropped'),
(123, 2, 1, 1, 'sdgfhfsdg', '2025-05-13 11:52:48', 'dropped'),
(124, 2, 1, 1, 'book ', '2025-05-13 11:57:59', 'dropped'),
(125, 1, 1, 2, 'يا رب', '2025-05-13 12:01:56', 'exchanged'),
(126, 1, 1, 2, 'اميزنق', '2025-05-13 12:19:38', 'dropped'),
(127, 2, 3, NULL, 'شششششششش', '2025-05-13 12:22:02', 'dropped'),
(128, 2, 3, NULL, 'aaaaaaaaa', '2025-05-13 17:11:21', 'dropped'),
(129, 2, 5, 1, 'بدي اجرب يخوان', '2025-05-13 18:02:23', 'dropped'),
(130, 1, 5, 2, 'book ', '2025-05-13 18:02:50', 'dropped'),
(131, 2, 5, NULL, 'شششششششش', '2025-05-13 18:19:26', 'exchanged'),
(132, 2, 5, NULL, 'ششششششش', '2025-05-13 22:32:39', 'exchanged'),
(133, 1, 7, NULL, 'كتاب مناصير', '2025-05-13 22:50:31', 'exchanged'),
(134, 1, 3, 2, 'انا عماد وبدي مين يبدل', '2025-05-13 23:00:55', 'exchanged'),
(135, 1, 7, 2, 'الو', '2025-05-13 23:04:56', 'exchanged'),
(136, 2, 8, NULL, 'هي كتابي علي', '2025-05-13 23:32:06', 'exchanged'),
(137, 2, 1, NULL, 'كتاب عبدالله الشمال', '2025-05-13 23:33:17', 'exchanged'),
(138, 1, 1, NULL, 'كتاب عبدالله اليمين', '2025-05-13 23:33:25', 'exchanged'),
(139, 2, 1, 1, 'jdskajf;', '2025-05-14 19:20:18', 'exchanged'),
(140, 2, 1, NULL, 'عندي هاظ الكتاب ما بدي اياه', '2025-05-15 23:41:17', 'exchanged'),
(141, 2, 1, NULL, 'ش', '2025-05-15 23:42:14', 'exchanged'),
(142, 2, 7, 1, 'سلايدات ميد', '2025-05-15 23:44:45', 'dropped'),
(143, 2, 1, NULL, 'gfghrijrflkkjk', '2025-05-16 18:11:36', 'dropped'),
(144, 1, 4, NULL, 'عندي مادة الميد للتحليل بدي اعطيها ما بدي اياها', '2025-05-17 13:30:36', 'dropped'),
(145, 1, 7, NULL, 'عندي تيست بانك فاينل تحليل انظمه ما بدي اياه مطبوع', '2025-05-17 13:31:07', 'exchanged'),
(146, 2, 5, NULL, 'عندي ملخص مبادئ تسويق', '2025-05-17 14:24:55', 'dropped'),
(147, 7, 1, 1, 'عندي كتاب ادارة اعمال الاصلي', '2025-05-17 14:26:59', 'dropped'),
(148, 7, 1, 1, 'عندي كتاب ادارة اعمال الاصلي', '2025-05-17 14:27:53', 'dropped'),
(149, 3, 1, 4, 'ش', '2025-05-17 15:51:28', 'exchanged'),
(150, 2, 3, NULL, 'ض', '2025-05-17 15:54:26', 'dropped'),
(151, 3, 3, 1, '1', '2025-05-17 15:56:42', 'dropped'),
(152, 5, 3, 6, 'book ', '2025-05-17 16:04:44', 'dropped'),
(153, 3, 1, 5, 'hhhh', '2025-05-18 10:10:17', 'exchanged'),
(154, 1, 1, NULL, '1', '2025-05-18 10:18:31', 'exchanged'),
(155, 1, 7, NULL, '2', '2025-05-18 10:18:41', 'exchanged'),
(156, 5, 1, 1, 'احتاج للتحليل عندي سلايدات اقتصاد جزئي ميد', '2025-05-18 19:08:48', 'dropped'),
(157, 2, 5, NULL, 'عندي ملخص مبادئ تسويق لكل المادة ما بدي اياه', '2025-05-18 20:18:57', 'exchanged'),
(158, 3, 5, NULL, 'aaaaaaaaaa', '2025-05-20 22:37:11', 'exchanged');

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
(26, 41, 1, 'accepted', '2025-05-04 22:38:08'),
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
(126, 126, 5, 'accepted', '2025-05-13 17:15:33'),
(127, 126, 5, 'accepted', '2025-05-13 17:20:33'),
(128, 126, 5, 'accepted', '2025-05-13 17:20:58'),
(129, 126, 5, 'rejected', '2025-05-13 17:24:01'),
(130, 126, 7, 'rejected', '2025-05-13 17:27:43'),
(131, 126, 7, 'rejected', '2025-05-13 17:52:34'),
(132, 130, 3, 'rejected', '2025-05-13 18:03:00'),
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
(148, 137, 2, 'accepted', '2025-05-13 23:33:59'),
(149, 139, 4, 'canceled', '2025-05-14 19:20:44'),
(150, 139, 4, 'accepted', '2025-05-14 19:22:28'),
(151, 140, 7, 'accepted', '2025-05-15 23:41:35'),
(152, 141, 7, 'rejected', '2025-05-15 23:43:23'),
(153, 141, 5, 'accepted', '2025-05-15 23:43:30'),
(154, 145, 5, 'accepted', '2025-05-17 14:25:52'),
(155, 149, 3, 'rejected', '2025-05-17 15:51:35'),
(156, 149, 5, 'accepted', '2025-05-17 15:51:52'),
(157, 152, 1, 'rejected', '2025-05-17 16:04:51'),
(158, 152, 5, 'rejected', '2025-05-17 16:05:04'),
(159, 152, 1, 'rejected', '2025-05-17 16:06:07'),
(160, 153, 4, 'accepted', '2025-05-18 10:11:37'),
(161, 155, 4, 'rejected', '2025-05-18 10:18:53'),
(162, 154, 4, 'accepted', '2025-05-18 10:18:55'),
(163, 157, 1, 'rejected', '2025-05-20 22:06:27'),
(164, 155, 5, 'accepted', '2025-05-20 22:15:08'),
(165, 157, 7, 'accepted', '2025-05-20 22:33:05'),
(166, 158, 4, 'accepted', '2025-05-20 22:37:21');

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `id` int(11) NOT NULL,
  `user1_id` int(11) NOT NULL,
  `user2_id` int(11) NOT NULL,
  `related_request_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `last_message_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `conversations`
--

INSERT INTO `conversations` (`id`, `user1_id`, `user2_id`, `related_request_id`, `created_at`, `last_message_at`) VALUES
(1, 5, 7, 165, '2025-05-20 22:32:49', NULL),
(2, 4, 5, 166, '2025-05-20 22:37:33', '2025-05-20 22:50:02');

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
(1, 2, 'Fundamentals of Digital Marketing', 'https://skillshop.exceedlms.com/student/path/29372-fundamentals-of-digital-marketing', 'Discover the new Digital Marketing Fundamentals course – a self-paced program by Google covering 17 expert-designed modules. Learn key topics like AI tools, video marketing, and more through real-world examples and practical exercises to grow your business or career.'),
(2, 7, 'Quality Improvement and Management', 'https://www.coursera.org/learn/quality-improvement-management', 'Learn the importance of quality improvement, explore ISO 9001 benefits and requirements, and translate customer needs into practical actions using Bloom’s Taxonomy.'),
(3, 1, 'C# FOR BEGINNERS', 'https://www.youtube.com/watch?v=GhQdlIFylQ8', 'This course will give you a full introduction into all of the core concepts in C#.'),
(4, 1, 'HTML Front End', 'https://www.mygreatlearning.com/academy/learn-for-free/courses/html-tutorial-for-beginners', 'HTML is the core of web development. Start by learning its basics—features, editors, and comments—then progress to key concepts like the HTML skeleton, elements, and more, building a strong front-end foundation.'),
(5, 4, 'Managerial Accounting', 'https://alison.com/course/management-accounting', 'Learn management accounting to create and manage value, forecast for budgets, explore budgeting theory, control performance, apply linear programming, and handle risk in decisions.'),
(6, 4, 'Cost Accounting', 'https://alison.com/course/diploma-in-cost-accounting', 'Explore financial management and cost accounting basics—cost types, marginal cost functions, budgetary control, and variance formulas—all in a free course to boost your accounting skills.'),
(7, 1, 'JavaScript Crash Course For Beginners', 'https://www.youtube.com/watch?v=hdI2bqOjy3c', 'In this Traversy Media YouTube course, you will learn about JavaScript basics including conditions, loops, functions, objects, arrays, and ES6.'),
(8, 5, 'Managerial Economics', 'https://alison.com/course/diploma-in-managerial-economics', 'Master managerial economics from basics to optimization. Learn consumer behavior, indifference curves, and demand—all in this free online course.'),
(9, 5, 'Principles of Economics: Macroeconomics - The Big Picture', 'https://www.coursera.org/learn/principles-of-economics-macroeconomics', 'Through course lectures, quizzes, discussions, and problem sets, my hope is that you\'ll be able to digest economic news with a more discerning viewpoint, and have a more informed view about the cost and benefits of economic policy.'),
(10, 6, 'Investment Risk Management', 'https://www.coursera.org/learn/investment-risk-management', 'Learn to measure risk vs. reward using the Treynor Ratio and calculate portfolio value at risk. Basic financial risk knowledge is required. Best for North America learners; not investment advice.'),
(11, 7, 'ادارة مشاريع', 'https://www.studyshoot.com/top/free-management-courses/', 'أفضل الشركات العالمية مثل Google وIBM تقدم دورات إدارة مجانية عبر الإنترنت للجميع دون شروط مسبقة، لتعلم مهارات التخطيط والتنظيم والإشراف على المشاريع. في نهاية كل دورة، يحصل المتدربون على شهادات احترافية معتمدة تساعدهم في التوظيف أو بدء مشاريعهم الخاصة.'),
(13, 7, 'Marketing Channels Management', 'https://www.coursera.org/learn/channel-management-retailing', 'Learn how to design and manage distribution channels, understand key players and conflict resolution. Explore retail strategies, competitive advantages, growth opportunities, entry methods, and the role of online presence in future retail trends.'),
(14, 2, 'Pricing Policies', 'https://www.coursera.org/learn/pricing-strategy', 'Understand pricing strategies and how psychology affects perceived value. Apply price discrimination through customer traits, quantity, bundling, and versions. Measure willingness to pay using surveys and data. Calculate price elasticity and determine the optimal price.'),
(15, 3, 'Financial Markets', 'https://www.coursera.org/learn/financial-markets-global', 'Introduction to risk management and behavioral finance principles to understand the real-world functioning of securities, insurance, and banking industries.  The ultimate goal of this course is using such industries effectively and towards a better society.'),
(16, 3, 'Python and Statistics for Financial Analysis', 'https://www.coursera.org/learn/python-statistics-financial-analysis', ' Due to python’s simplicity and high readability, it is gaining its importance in the financial industry.  The course combines both python coding and statistical concepts and applies into analyzing financial data, such as stock data.'),
(17, 3, 'Private Equity and Venture Capital', 'https://www.coursera.org/learn/private-equity', 'Over the course, students will be provided with a deep understanding of the mechanism underpinning the creation and/or development of a firm and the financial support it can get from the financial system through venture capital investment.'),
(18, 5, 'Narrative Economics', 'https://www.coursera.org/learn/narrative-economics', 'This course, Narrative Economics, is relatively short and proposes a simple concept: we need to incorporate the contagion of narratives into our economic theory. '),
(19, 2, 'Brand Management: Aligning Business, Brand and Behaviour', 'https://www.coursera.org/learn/brand', 'The aim of the course is to change the conception of brands as being an organisation\'s visual identity (e.g., logo) and image (customers\' brand associations) to an experience along \"moments-that-matter\" along the customer journey and, therefore, delivered by people across the entire organisation.'),
(20, 4, 'Financial Accounting: Foundations', 'https://www.coursera.org/learn/financial-accounting-basics', 'In this course, you will learn the foundations of financial accounting information. You will start your journey with a general overview of what financial accounting information is and the main financial statements'),
(21, 6, 'Advanced Public Sector Strategy and Leadership Essentials', 'https://www.educations.com/institutions/london-business-training-and-consulting/advanced-public-sector-strategy-and-leadership-essentials?fl=1', 'The Advanced Public Sector Strategy and Leadership Essentials program equips students with essential skills for strategic thinking and dynamic leadership in the public sector.'),
(22, 6, 'Online Microcredentials in Public Administration', 'https://www.educations.com/institutions/university-of-birmingham-online/online-microcredentials-in-public-administration?fl=2', 'The Online Microcredentials in Public Administration offer a flexible way to enhance your skills in public service. You can tailor your learning to your personal and professional goals while studying at your own pace. ');

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
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `conversation_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `edited_at` datetime DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `conversation_id`, `sender_id`, `content`, `created_at`, `edited_at`, `is_deleted`, `deleted_at`, `deleted_by`) VALUES
(1, 2, 5, 'مرحبا يغالي', '2025-05-20 22:37:41', NULL, 0, NULL, NULL),
(2, 2, 4, 'هلا', '2025-05-20 22:43:16', NULL, 0, NULL, NULL),
(3, 2, 4, 'ترا زبط اذا ملاحظ', '2025-05-20 22:45:56', NULL, 0, NULL, NULL),
(4, 2, 4, 'وزبط الانتر', '2025-05-20 22:47:16', NULL, 0, NULL, NULL),
(5, 2, 4, 'هاي الرسالة من  احمد قضاه ل لين', '2025-05-20 22:47:37', NULL, 0, NULL, NULL),
(6, 2, 4, 'ششششششششششش', '2025-05-20 22:49:23', NULL, 0, NULL, NULL),
(7, 2, 4, 'ششش', '2025-05-20 22:49:41', NULL, 0, NULL, NULL),
(8, 2, 4, 'ششش', '2025-05-20 22:50:02', NULL, 0, NULL, NULL);

--
-- Triggers `messages`
--
DELIMITER $$
CREATE TRIGGER `trg_update_last_message` AFTER INSERT ON `messages` FOR EACH ROW BEGIN
  UPDATE conversations
     SET last_message_at = NEW.created_at
   WHERE id = NEW.conversation_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `message_edits`
--

CREATE TABLE `message_edits` (
  `id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  `editor_id` int(11) NOT NULL,
  `old_content` text NOT NULL,
  `edited_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(345, 5, 4, 138, 'new_message', 'Leen sent you a message.', 1, 1, '2025-05-13 19:34:10'),
(346, 4, 5, 138, 'new_message', 'Ahmad sent you a message.', 1, 1, '2025-05-13 19:34:37'),
(347, 5, 4, 138, 'new_message', 'Leen sent you a message.', 1, 1, '2025-05-13 19:39:26'),
(348, 5, 4, 138, 'new_message', 'Leen sent you a message.', 1, 1, '2025-05-13 19:39:29'),
(349, 5, 4, 138, 'new_message', 'Leen sent you a message.', 1, 1, '2025-05-13 19:39:32'),
(350, 5, 4, 138, 'new_message', 'Leen sent you a message.', 1, 1, '2025-05-13 19:39:37'),
(351, 4, 5, 138, 'new_message', 'Ahmad sent you a message.', 1, 1, '2025-05-13 19:40:26'),
(352, 5, 4, 138, 'new_message', 'Leen sent you a message.', 1, 1, '2025-05-13 19:47:22'),
(353, 4, 5, 138, 'new_message', 'Ahmad sent you a message.', 1, 1, '2025-05-13 19:47:38'),
(354, 3, 5, 139, 'book_request', 'Emad Qudah has requested your book', 1, 1, '2025-05-13 19:48:39'),
(355, 5, 3, 139, 'request_accepted', 'Leen accepted your request.', 1, 1, '2025-05-13 19:48:56'),
(356, 5, 3, 138, 'new_message', 'Leen sent you a message.', 1, 1, '2025-05-13 19:49:20'),
(357, 1, 7, 140, 'book_request', 'Abood Qudah has requested your book', 1, 1, '2025-05-13 19:50:39'),
(358, 3, 7, 141, 'book_request', 'Emad Qudah has requested your book', 1, 1, '2025-05-13 19:50:46'),
(359, 7, 1, 133, 'book_taken', 'Ahmad gave this book to someone else.', 1, 1, '2025-05-13 19:50:56'),
(360, 7, 3, 141, 'request_accepted', 'Ahmad accepted your request.', 1, 0, '2025-05-13 19:50:56'),
(361, 7, 3, 141, 'new_message', 'Ahmad sent you a message.', 1, 0, '2025-05-13 19:51:08'),
(362, 3, 7, 141, 'new_message', 'Emad sent you a message.', 1, 1, '2025-05-13 19:51:41'),
(363, NULL, 3, 142, 'swap_request', 'Abood Qudah wants to swap “Business Research Me” for “مبادئ تسويق”', 1, 0, '2025-05-13 20:01:07'),
(364, NULL, 3, 143, 'swap_request', 'Leen Ghanem wants to swap “Business Research Me” for “مبادئ تسويق”', 1, 0, '2025-05-13 20:01:14'),
(365, 3, 5, 134, 'book_taken', 'Emad gave this book to someone else.', 1, 1, '2025-05-13 20:01:31'),
(366, 3, 1, 142, 'request_accepted', 'Emad accepted your request.', 1, 1, '2025-05-13 20:01:31'),
(367, 3, 1, 141, 'new_message', 'Emad sent you a message.', 1, 1, '2025-05-13 20:01:39'),
(368, 1, 3, 142, 'new_message', 'Abood sent you a message.', 1, 0, '2025-05-13 20:02:00'),
(369, 1, 3, 142, 'new_message', 'Abood sent you a message.', 1, 0, '2025-05-13 20:02:12'),
(370, 3, 1, 141, 'new_message', 'Emad sent you a message.', 1, 1, '2025-05-13 20:03:35'),
(371, 3, 7, 141, 'new_message', 'Emad sent you a message.', 1, 1, '2025-05-13 20:03:50'),
(372, 3, 7, 141, 'new_message', 'Emad sent you a message.', 1, 1, '2025-05-13 20:03:55'),
(373, 3, 7, 141, 'new_message', 'Emad sent you a message.', 1, 1, '2025-05-13 20:03:56'),
(374, NULL, 7, 144, 'swap_request', 'Abood Qudah wants to swap “Business Research Me” for “مبادئ تسويق”', 1, 1, '2025-05-13 20:05:03'),
(375, NULL, 7, 145, 'swap_request', 'Leen Ghanem wants to swap “Business Research Me” for “مبادئ تسويق”', 1, 1, '2025-05-13 20:05:13'),
(376, 7, 5, 135, 'book_taken', 'Ahmad gave this book to someone else.', 1, 1, '2025-05-13 20:05:21'),
(377, 7, 1, 144, 'request_accepted', 'Ahmad accepted your request.', 1, 0, '2025-05-13 20:05:21'),
(378, 3, 5, 141, 'new_message', 'Emad sent you a message.', 1, 1, '2025-05-13 20:12:28'),
(379, 5, 4, 138, 'new_message', 'Leen sent you a message.', 1, 1, '2025-05-13 20:17:16'),
(380, 2, 8, 146, 'book_request', 'Jane Doe has requested your book', 1, 0, '2025-05-13 20:32:25'),
(381, 8, 2, 146, 'request_accepted', 'ali accepted your request.', 1, 0, '2025-05-13 20:32:35'),
(382, 8, 2, 146, 'new_message', 'ali sent you a message.', 1, 0, '2025-05-13 20:32:42'),
(383, 8, 1, 147, 'book_request', 'ali sami has requested your book', 1, 0, '2025-05-13 20:33:46'),
(384, 2, 1, 148, 'book_request', 'Jane Doe has requested your book', 1, 0, '2025-05-13 20:33:59'),
(385, 1, 2, 148, 'request_accepted', 'Abood accepted your request.', 1, 0, '2025-05-13 20:34:11'),
(386, 1, 2, 144, 'new_message', 'Abood sent you a message.', 1, 0, '2025-05-13 20:34:25'),
(387, 1, 8, 147, 'request_accepted', 'Abood accepted your request.', 0, 0, '2025-05-13 20:34:34'),
(388, 5, 1, 138, 'new_message', 'Leen sent you a message.', 1, 0, '2025-05-13 20:39:41'),
(389, 4, 5, 138, 'new_message', 'Ahmad sent you a message.', 1, 1, '2025-05-13 20:40:45'),
(390, NULL, 1, 149, 'swap_request', 'Ahmad Qudah wants to swap “مبادئ تسويق” for “Business Research Me”', 1, 0, '2025-05-14 16:20:44'),
(391, NULL, 1, 150, 'swap_request', 'Ahmad Qudah wants to swap “مبادئ تسويق” for “Business Research Me”', 1, 0, '2025-05-14 16:22:28'),
(392, 1, 4, 150, 'request_accepted', 'Abood accepted your request.', 1, 1, '2025-05-14 16:22:40'),
(393, 7, 1, 151, 'book_request', 'Ahmad Manaseer has requested your book', 1, 0, '2025-05-15 20:41:35'),
(394, 1, 7, 151, 'request_accepted', 'Abood accepted your request.', 1, 1, '2025-05-15 20:41:46'),
(395, 7, 1, 152, 'book_request', 'Ahmad Manaseer has requested your book', 1, 1, '2025-05-15 20:43:23'),
(396, 5, 1, 153, 'book_request', 'Leen Ghanem has requested your book', 1, 0, '2025-05-15 20:43:30'),
(397, 1, 7, 141, 'book_taken', 'Abood gave this book to someone else.', 1, 1, '2025-05-15 20:43:40'),
(398, 1, 5, 153, 'request_accepted', 'Abood accepted your request.', 1, 1, '2025-05-15 20:43:40'),
(399, 4, 5, 138, 'new_message', 'Ahmad sent you a message.', 1, 1, '2025-05-17 10:26:12'),
(400, 5, 7, 154, 'book_request', 'Leen Ghanem has requested your book', 1, 0, '2025-05-17 11:25:52'),
(401, 7, 5, 154, 'request_accepted', 'Ahmad accepted your request.', 1, 1, '2025-05-17 11:30:12'),
(402, 7, 5, 154, 'new_message', 'Ahmad sent you a message.', 1, 1, '2025-05-17 11:30:33'),
(403, NULL, 1, 155, 'swap_request', 'Emad Qudah wants to swap “مبادئ ادارة مالية” for “مبادئ محاسبة 1”', 1, 0, '2025-05-17 12:51:35'),
(404, NULL, 1, 156, 'swap_request', 'Leen Ghanem wants to swap “مبادئ ادارة مالية” for “مبادئ محاسبة 1”', 1, 0, '2025-05-17 12:51:52'),
(405, 1, 3, 149, 'book_taken', 'Abood gave this book to someone else.', 1, 0, '2025-05-17 12:52:09'),
(406, 1, 5, 156, 'request_accepted', 'Abood accepted your request.', 1, 1, '2025-05-17 12:52:09'),
(407, NULL, 3, 157, 'swap_request', 'Abood Qudah wants to swap “مبادئ الاقتصاد الجزئي” for “ادارة عامة حديثة”', 1, 0, '2025-05-17 13:04:51'),
(408, NULL, 3, 158, 'swap_request', 'Leen Ghanem wants to swap “مبادئ الاقتصاد الجزئي” for “ادارة عامة حديثة”', 1, 0, '2025-05-17 13:05:04'),
(409, 3, 5, NULL, 'request_rejected', 'Emad rejected your book request.', 1, 1, '2025-05-17 13:05:15'),
(410, 3, 5, NULL, 'request_rejected', 'Emad rejected your book request.', 1, 1, '2025-05-17 13:05:15'),
(411, 3, 1, NULL, 'request_rejected', 'Emad rejected your book request.', 1, 1, '2025-05-17 13:05:20'),
(412, 3, 1, NULL, 'request_rejected', 'Emad rejected your book request.', 1, 1, '2025-05-17 13:05:20'),
(413, NULL, 3, 159, 'swap_request', 'Abood Qudah wants to swap “مبادئ الاقتصاد الجزئي” for “ادارة عامة حديثة”', 1, 0, '2025-05-17 13:06:07'),
(414, 3, 1, NULL, 'request_rejected', 'Emad rejected your book request.', 1, 1, '2025-05-17 13:07:02'),
(415, 3, 1, NULL, 'request_rejected', 'Emad rejected your book request.', 1, 0, '2025-05-17 13:07:02'),
(416, NULL, 1, 160, 'swap_request', 'Ahmad Qudah wants to swap “مبادئ ادارة مالية” for “مبادئ الاقتصاد الجزئي”', 1, 0, '2025-05-18 07:11:37'),
(417, 1, 4, 160, 'request_accepted', 'Abood accepted your request.', 1, 1, '2025-05-18 07:11:52'),
(418, 4, 7, 161, 'book_request', 'Ahmad Qudah has requested your book', 1, 1, '2025-05-18 07:18:53'),
(419, 4, 1, 162, 'book_request', 'Ahmad Qudah has requested your book', 1, 0, '2025-05-18 07:18:55'),
(421, 5, 1, NULL, 'request_rejected', 'Leen rejected your book request.', 0, 0, '2025-05-20 19:15:03'),
(422, 5, 7, 164, 'book_request', 'Leen Ghanem has requested your book', 1, 0, '2025-05-20 19:15:08'),
(423, 7, 4, 155, 'book_taken', 'Ahmad gave this book to someone else.', 1, 1, '2025-05-20 19:32:49'),
(424, 7, 5, 164, 'request_accepted', 'Ahmad accepted your request.', 1, 1, '2025-05-20 19:32:49'),
(425, 7, 5, 165, 'book_request', 'Ahmad Manaseer has requested your book', 1, 1, '2025-05-20 19:33:05'),
(426, 5, 7, 165, 'request_accepted', 'Leen accepted your request.', 0, 0, '2025-05-20 19:33:13'),
(427, 4, 5, 166, 'book_request', 'Ahmad Qudah has requested your book', 1, 1, '2025-05-20 19:37:21'),
(428, 5, 4, 166, 'request_accepted', 'Leen accepted your request.', 1, 0, '2025-05-20 19:37:33');

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
(8, 'ali', 'sami', NULL, 'ali.qudah@gmail.com', '0787745136', '1', 'user', '2025-05-06 19:42:36', 0),
(10, 'Hazar', 'Hmoud', NULL, 'HazarHmoud@gmail.com', '0789543124', '11', 'user', '2025-05-14 20:01:37', 0);

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
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_pair` (`user1_id`,`user2_id`),
  ADD KEY `fk_conv_user2` (`user2_id`),
  ADD KEY `fk_conv_request` (`related_request_id`);

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
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_conv` (`conversation_id`),
  ADD KEY `fk_msg_sender` (`sender_id`),
  ADD KEY `fk_msg_deleted_by` (`deleted_by`);

--
-- Indexes for table `message_edits`
--
ALTER TABLE `message_edits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_msgid` (`message_id`),
  ADD KEY `fk_me_editor` (`editor_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=224;

--
-- AUTO_INCREMENT for table `book_exchange`
--
ALTER TABLE `book_exchange`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `book_offers`
--
ALTER TABLE `book_offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `book_requests`
--
ALTER TABLE `book_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `message_edits`
--
ALTER TABLE `message_edits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=431;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
-- Constraints for table `conversations`
--
ALTER TABLE `conversations`
  ADD CONSTRAINT `fk_conv_request` FOREIGN KEY (`related_request_id`) REFERENCES `book_requests` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_conv_user1` FOREIGN KEY (`user1_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_conv_user2` FOREIGN KEY (`user2_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fk_msg_conv` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_msg_deleted_by` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_msg_sender` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `message_edits`
--
ALTER TABLE `message_edits`
  ADD CONSTRAINT `fk_me_editor` FOREIGN KEY (`editor_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_me_msg` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
