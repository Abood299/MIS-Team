-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2025 at 03:29 PM
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
(20, 1, '1', 'مبادئ محاسبة 1', 'https://web.ung.edu/media/university-press/Principles-of-Financial-Accounting.pdf?t=1542408454385'),
(21, 1, '1', 'نظم إدارة قواعد البيانات', 'https://mrcet.com/downloads/digital_notes/ECE/III%20Year/DATABASE%20MANAGEMENT%20SYSTEMS.pdf'),
(22, 1, '1', 'مبادئ الاحصاء', 'https://www.bau.edu.jo/UserPortal/UserProfile/PostsAttach/24828_3774_1.pdf'),
(23, 1, '1', 'مبادئ إدارة الأعمال', 'https://www.apo-tokyo.org/wp-content/uploads/2014/07/ind-43-km_tt-2010.pdf'),
(24, 1, '1', 'الادارة العامة الحديثة', 'https://digilib.stiestekom.ac.id/assets/dokumen/ebook/feb_fa71ed3e33262f6f85e4b3122596d2a086ea62c4_1648782931.pdf'),
(25, 1, '1', 'أساسيات البرمجة للأعمال', 'https://www.researchgate.net/publication/379955327_Digital_Leadership_Business_Model_Innovation_and_Organizational_Change_Role_of_Leader_in_Steering_Digital_Transformation'),
(26, 1, '1', 'مبادئ نظم معلومات إدراية', 'https://business.ju.edu.jo/Lists/Courses/Attachments/134/Research%20seminar%20Syllabus.pdf'),
(27, 1, '2', 'نظم ادارة المعرفة', 'https://th.bing.com/th/id/R.c0d3f18f70b5e1b8ad0ba6067da5e62a?rik=Sgnco9rs8JKBkw&pid=ImgRaw&r=0'),
(28, 1, '2', 'نظم الوسائط المتعددة', 'https://thaka.bing.com/th/id/OIP.9oLn7WU8Qh75VKQPH61yqgHaLG?rs=1&pid=ImgDetMain'),
(29, 1, '2', 'مبادئ الاقتصاد الجزئي', 'https://th.bing.com/th/id/OIP.cuY6NHnYLFXuQU5NhM3b_AHaIt?cb=iwc1&rs=1&pid=ImgDetMain'),
(30, 1, '2', 'مبادئ تسويق', 'https://i.pinimg.com/736x/04/09/cc/0409cc2d2f11d037acb4a88dcaa0c0a3.jpg'),
(31, 1, '2', 'الأعمال الالكترونية', 'https://m.media-amazon.com/images/I/71PERh4QmgL._SL1500_.jpg'),
(32, 1, '2', 'برمجة تطبيقات الاعمال', 'https://thaka.bing.com/th/id/OIP.-oJFHEEnvwOYJrq9BL1GOQHaLI?rs=1&pid=ImgDetMain'),
(33, 1, '2', 'برمجة تطبيقات الأنترنت', 'https://cdn.kobo.com/book-images/a3627c8f-5ab8-488e-9b18-10a86092a9d0/1200/1200/False/artificial-intelligence-business-applications.jpg'),
(34, 1, '3', 'ذكاء الأعمال وأدوات تحليل البيانات', 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1388183119i/340019.jpg'),
(35, 1, '3', 'رياضيات الأعمال', 'https://m.media-amazon.com/images/I/41NF7KEPJVL.jpg'),
(36, 1, '3', 'برمجة تطبيقات الاجهزة الذكية', 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1348734135i/3729666.jpg'),
(37, 1, '3', 'نظم إدارة موارد المنظمة', 'https://thaka.bing.com/th/id/OIP.MgxDlgKKzPErGOGyS_9fgwHaLL?rs=1&pid=ImgDetMain'),
(38, 1, '3', 'أمن المعلومات ', 'https://th.bing.com/th/id/R.0b0fa81fa2c21f8d17d5a0d54df8152c?rik=C6H6m0fiDac9Sw&pid=ImgRaw&r=0'),
(39, 1, '3', 'نمذجة الأعمال والمحاكاة ', 'https://m.media-amazon.com/images/I/41NF7KEPJVL.jpg'),
(40, 1, '3', 'تحليل وتصميم انظمة المعلومات ', 'https://th.bing.com/th/id/R.0b0fa81fa2c21f8d17d5a0d54df8152c?rik=C6H6m0fiDac9Sw&pid=ImgRaw&r=0'),
(41, 1, '4', 'حلقة بحث في نظم المعلومات', 'https://th.bing.com/th/id/OIP.d7qgPv_PJb8SCCoqsKH2PwAAAA?cb=iwc1&rs=1&pid=ImgDetMain'),
(42, 1, '4', 'مشروع في نظم المعلومات الإدارية', 'https://m.media-amazon.com/images/I/61rvdr5W-TL._SL1072_.jpg'),
(43, 1, '4', 'نظم الوسائط المتعددة', 'https://images.secondsale.com/images/ff259a19eb448be2719e91d8503766c5.jpg'),
(44, 1, '4', 'مهارات الاستعداد لسوق العمل', 'https://thaka.bing.com/th/id/OIP.eigHM4vOmyXA-9MH55p77QHaLO?rs=1&pid=ImgDetMain'),
(45, 1, '4', 'قضايا معاصرة في نظم المعلومات', 'https://m.media-amazon.com/images/I/71RYLQjODAL._SL1500_.jpg'),
(46, 1, '4', 'التدريب العملي لطلبة نظم المعلومات الإدارية', 'https://images.secondsale.com/images/ff259a19eb448be2719e91d8503766c5.jpg'),
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
(196, 7, '1', 'مبادئ الأدارة المالية', 'https://thaka.bing.com/th/id/OIP.E6vNBvCC_4kWzvmm9MjZ9gAAAA?rs=1&pid=ImgDetMain'),
(197, 7, '1', 'مبادئ محاسبة 1', 'https://m.media-amazon.com/images/I/61Zfxzgq6WL.jpg'),
(198, 7, '1', 'مبادئ الاقتصاد الجزئي', 'https://m.media-amazon.com/images/I/71RI+bVj+pL._SL1500_.jpg'),
(199, 7, '1', 'الادارة العامة الحديثة', 'https://th.bing.com/th/id/OIP.2_2rsv46Bkg02MlJcuUpzwHaKp?rs=1&pid=ImgDetMain'),
(200, 7, '1', 'مدخل الى الأقتصاد الرياضي', 'https://m.media-amazon.com/images/I/61Vo0qjHdqL._SL1000_.jpg'),
(201, 7, '1', 'تشريعات تجارية', 'https://m.media-amazon.com/images/I/71RI+bVj+pL._SL1500_.jpg'),
(202, 7, '2', 'مبادئ التسويق', 'https://m.media-amazon.com/images/I/81H7oynuXHL._SL1500_.jpg'),
(203, 7, '2', 'رياضيات الأعمال', 'https://images-na.ssl-images-amazon.com/images/I/51vMyX8q6LL.jpg'),
(204, 7, '2', 'التسويق الالكتروني ', 'https://th.bing.com/th/id/OIP.yZOS3kmNGyR_FqMJnKEDaAHaLH?rs=1&pid=ImgDetMain'),
(205, 7, '2', 'مبادئ نظم معلومات إدراية', 'https://www.neerajbooks.com/image/data/mcs-52-em-principal_of_management_and_information_system.jpg'),
(206, 7, '2', 'نظرية وتصميم المنظمة ', 'https://th.bing.com/th/id/OIP.49A3r3mLjM6um3oWg7NcUwAAAA?rs=1&pid=ImgDetMain'),
(207, 7, '2', 'بحوث عمليات ', 'https://m.media-amazon.com/images/I/71ItkHHYZuL._SL1000_.jpg'),
(208, 7, '2', 'منهجية البحث العلمي ', 'https://m.media-amazon.com/images/I/91d5L7pKqfL._SL1500_.jpg'),
(209, 7, '2', 'السلوك التنظيمي', 'https://m.media-amazon.com/images/I/91d5L7pKqfL._SL1500_.jpg'),
(210, 7, '3', 'إدارة سلسلة التزويد', 'https://th.bing.com/th/id/OIP.cuY6NHnYLFXuQU5NhM3b_AHaIt?cb=iwc1&rs=1&pid=ImgDetMain'),
(211, 7, '3', 'الحاكمية المؤسسية', 'https://th.bing.com/th/id/OIP.pzyD2GQUoyVbB9JQnJIGhwHaKN?rs=1&pid=ImgDetMain'),
(212, 7, '3', 'إدارة موارد بشرية', 'https://m.media-amazon.com/images/I/41DT7M2gVgL.jpg'),
(213, 7, '3', 'إدارة الإبتكار', 'https://th.bing.com/th/id/OIP.npPWYbKuGpHPhUuGOkUWIgHaKn?rs=1&pid=ImgDetMain'),
(214, 7, '3', 'إدارة عمليات الخدمات', 'https://th.bing.com/th/id/OIP.fOWVmcM-KY-ymlPJ7SgbYwAAAA?rs=1&pid=ImgDetMain'),
(215, 7, '3', 'قضايا معاصرة في الإدارة', 'https://th.bing.com/th/id/OIP.iNS3uVjRtE1iQ6xT7xFKYAHaLH?rs=1&pid=ImgDetMain'),
(216, 7, '3', 'إدارة المشاريع', 'https://th.bing.com/th/id/OIP.pIgJ-1Mi66HEYdTK2vlR4gHaKf?cb=iwc1&rs=1&pid=ImgDetMain'),
(217, 7, '4', 'التدريب العملي ', 'https://i.pinimg.com/736x/04/09/cc/0409cc2d2f11d037acb4a88dcaa0c0a3.jpg'),
(218, 7, '4', 'إدارة المعرفة', 'https://th.bing.com/th/id/OIP.A1UbOUvKjzN-BW_LNJ2KDgHaLH?rs=1&pid=ImgDetMain'),
(219, 7, '4', 'إدارة المشاريع ', 'https://th.bing.com/th/id/OIP.dIUS5zCnBP8VMT-hyb6fjAHaLH?rs=1&pid=ImgDetMain'),
(220, 7, '4', 'إدارة استراتيجية', 'https://th.bing.com/th/id/OIP.AwVgUhhLHgPl7vBW7Mw91gAAAA?rs=1&pid=ImgDetMain'),
(221, 7, '4', 'مهارات الاستعداد لسوق العمل', 'https://th.bing.com/th/id/OIP.z5fYMXkCR2u8xEJ1GJXqWgHaL2?rs=1&pid=ImgDetMain'),
(222, 7, '4', 'إدارة عمليات الإنتاج ', 'https://th.bing.com/th/id/OIP.9k7GM9zZsUBG9fA_m9lq6wHaLH?rs=1&pid=ImgDetMain'),
(223, 7, '4', 'الريادية في الاعمال', 'https://th.bing.com/th/id/OIP.9k7GM9zZsUBG9fA_m9lq6wHaLH?rs=1&pid=ImgDetMain');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=224;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
