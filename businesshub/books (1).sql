-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2025 at 01:19 PM
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
(75, 1, '1', 'مبادئ نظم معلومات إدارية', 'https://www.neerajbooks.com/image/data/mcs-52-em-principal_of_management_and_information_system.jpg'),
(76, 1, '1', 'مبادئ محاسبة (1)', 'https://m.media-amazon.com/images/I/81H7oynuXHL._SL1500_.jpg'),
(77, 1, '1', 'مبادئ إدارة الأعمال', 'https://th.bing.com/th/id/R.c0d3f18f70b5e1b8ad0ba6067da5e62a?rik=Sgnco9rs8JKBkw&pid=ImgRaw&r=0'),
(78, 1, '1', 'مبادئ إحصاء', 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1388183119i/340019.jpg'),
(79, 1, '1', 'الإدارة العامة الحديثة', 'https://th.bing.com/th/id/OIP.d7qgPv_PJb8SCCoqsKH2PwAAAA?cb=iwc1&rs=1&pid=ImgDetMain'),
(80, 1, '1', 'نظم إدارة قواعد البيانات', 'https://www.dreambookpublishing.com/wp-content/uploads/2021/11/duxcfg-744x1024.png'),
(81, 1, '1', 'أساسيات البرمجة للأعمال', 'https://thaka.bing.com/th/id/OIP.9oLn7WU8Qh75VKQPH61yqgHaLG?rs=1&pid=ImgDetMain'),
(82, 1, '2', 'برمجة تطبيقات الأعمال', 'https://m.media-amazon.com/images/I/41NF7KEPJVL.jpg'),
(83, 1, '2', 'الأعمال الإلكترونية', 'https://m.media-amazon.com/images/I/61rvdr5W-TL._SL1072_.jpg'),
(84, 1, '2', 'إدارة موارد المعلومات', 'https://m.media-amazon.com/images/I/818lYq4iUGL._SL1500_.jpg'),
(85, 1, '2', 'مبادئ الاقتصاد الجزئي', 'https://th.bing.com/th/id/OIP.cuY6NHnYLFXuQU5NhM3b_AHaIt?cb=iwc1&rs=1&pid=ImgDetMain'),
(86, 1, '2', 'برمجة تطبيقات الإنترنت', 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1348734135i/3729666.jpg'),
(87, 1, '2', 'نظم الوسائط المتعددة', 'https://images.secondsale.com/images/ff259a19eb448be2719e91d8503766c5.jpg'),
(88, 1, '2', 'نظم إدارة المعرفة: أساليب وممارسات', 'https://thaka.bing.com/th/id/OIP.N4YBJF2gxo0tbmB8BeLRRwAAAA?rs=1&pid=ImgDetMain'),
(89, 1, '2', 'مبادئ تسويق', 'https://i.pinimg.com/736x/04/09/cc/0409cc2d2f11d037acb4a88dcaa0c0a3.jpg'),
(90, 1, '3', 'نظم إدارة موارد المنظمة', 'https://thaka.bing.com/th/id/OIP.MgxDlgKKzPErGOGyS_9fgwHaLL?rs=1&pid=ImgDetMain'),
(91, 1, '3', 'برمجة تطبيقات الأجهزة الذكية', 'https://thaka.bing.com/th/id/OIP.eigHM4vOmyXA-9MH55p77QHaLO?rs=1&pid=ImgDetMain'),
(92, 1, '3', 'تحليل وتصميم أنظمة المعلومات', 'https://m.media-amazon.com/images/I/61aOGVXMQ1L._SL1324_.jpg'),
(93, 1, '3', 'ذكاء الأعمال وأدوات تحليل البيانات', 'https://m.media-amazon.com/images/I/71PERh4QmgL._SL1500_.jpg'),
(94, 1, '3', 'نمذجة الأعمال والمحاكاة', 'https://th.bing.com/th/id/R.0b0fa81fa2c21f8d17d5a0d54df8152c?rik=C6H6m0fiDac9Sw&pid=ImgRaw&r=0'),
(95, 1, '3', 'أمن المعلومات', 'https://m.media-amazon.com/images/I/71RYLQjODAL._SL1500_.jpg'),
(96, 1, '3', 'الابتكار والريادة الرقمية', 'https://m.media-amazon.com/images/I/61C7uSPWIuL._SL1500_.jpg'),
(97, 1, '4', 'قضايا معاصرة في نظم المعلومات الإدارية', 'https://thaka.bing.com/th/id/OIP.-oJFHEEnvwOYJrq9BL1GOQHaLI?rs=1&pid=ImgDetMain'),
(98, 1, '4', 'مهارات الاستعداد لسوق العمل', NULL),
(99, 1, '4', 'التدريب العملي لطلبة نظم المعلومات الإدارية', NULL),
(100, 1, '4', 'حلقة بحث في نظم المعلومات الإدارية', 'https://media.springernature.com/w153/springer-static/cover/book/978-3-031-25470-3.jpg'),
(101, 1, '4', 'تطبيقات الذكاء الاصطناعي للأعمال', 'https://cdn.kobo.com/book-images/a3627c8f-5ab8-488e-9b18-10a86092a9d0/1200/1200/False/artificial-intelligence-business-applications.jpg'),
(102, 1, '4', 'مشروع في نظم المعلومات الإدارية', NULL),
(103, 2, '1', 'مبادئ التسويق', 'https://i.pinimg.com/736x/04/09/cc/0409cc2d2f11d037acb4a88dcaa0c0a3.jpg'),
(104, 2, '1', 'مبادئ إدارة أعمال', 'https://th.bing.com/th/id/R.c0d3f18f70b5e1b8ad0ba6067da5e62a?rik=Sgnco9rs8JKBkw&pid=ImgRaw&r=0'),
(105, 2, '1', 'الإدارة العامة الحديثة', 'https://th.bing.com/th/id/OIP.d7qgPv_PJb8SCCoqsKH2PwAAAA?cb=iwc1&rs=1&pid=ImgDetMain'),
(106, 2, '1', 'مبادئ محاسبة (1)', 'https://m.media-amazon.com/images/I/81H7oynuXHL._SL1500_.jpg'),
(107, 2, '1', 'مبادئ الاقتصاد الجزئي', 'https://th.bing.com/th/id/OIP.cuY6NHnYLFXuQU5NhM3b_AHaIt?cb=iwc1&rs=1&pid=ImgDetMain'),
(108, 2, '1', 'مبادئ نظم معلومات إدارية', 'https://www.neerajbooks.com/image/data/mcs-52-em-principal_of_management_and_information_system.jpg'),
(109, 2, '1', 'سلوك مستهلك', 'https://thaka.bing.com/th/id/OIP.DpFpfzlSOFY_r1JLMniqlwAAAA?rs=1&pid=ImgDetMain'),
(110, 2, '2', 'مدخل إلى الاقتصاد الرياضي', 'https://img.perlego.com/book-covers/1239853/9788132325567_300_450.webp'),
(111, 2, '2', 'الاتصالات التسويقية المتكاملة', 'https://m.media-amazon.com/images/I/61aQeB0F1RL._SL1250_.jpg'),
(112, 2, '2', 'تخطيط وتطوير المنتجات', 'https://www.oreilly.com/api/v2/epubs/9780127999456/files/images/9780128001905_FC.jpg'),
(113, 2, '2', 'مبادئ إحصاء', 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1388183119i/340019.jpg'),
(114, 2, '2', 'التسويق الدولي', 'https://th.bing.com/th/id/R.dd69a5b023b020113f29fe26d186838d?rik=u%2bP2xd3bmQhXqA&pid=ImgRaw&r=0'),
(115, 2, '2', 'إدارة قنوات التسويق', 'https://res.cloudinary.com/bloomsbury-atlas/image/upload/w_568,c_scale/jackets/9780275954390.jpg'),
(116, 2, '2', 'المهارات الرقمية الحديثة', 'https://th.bing.com/th/id/R.82b76ffe7a29d2a510fb015b1159322b?rik=YvPqjasI6Rd40Q&pid=ImgRaw&r=0'),
(117, 2, '2', 'مبادئ الإدارة المالية', 'https://th.bing.com/th/id/OIP.GPX1wfBvXgu7G1q-5hrSKgHaJQ?cb=iwc1&rs=1&pid=ImgDetMain'),
(118, 2, '3', 'إدارة مبيعات', 'https://mashummollah.com/wp-content/uploads/2021/02/Sales-Management.-Simplified.jpg'),
(119, 2, '3', 'إدارة التسويق', 'https://thaka.bing.com/th/id/OIP.9zUj88prQPrbm4ii7IbwpgHaKx?rs=1&pid=ImgDetMain'),
(120, 2, '3', 'التسويق الرقمي', 'https://thaka.bing.com/th/id/OIP.C7VBtSaEpHTUSro8UMNr6wHaHa?rs=1&pid=ImgDetMain'),
(121, 2, '3', 'العلاقات العامة', 'https://th.bing.com/th/id/R.1b174acc9bc4b9c68028e77443f4a932?rik=sWQw7%2bG0aDERow&pid=ImgRaw&r=0'),
(122, 2, '3', 'سياسات التسعير', 'https://images-na.ssl-images-amazon.com/images/I/51eM5oYtNSL.jpg'),
(123, 2, '3', 'بحوث السوق', 'https://rukminim1.flixcart.com/image/1408/1408/book/2/2/3/marketing-research-4ed-beri-original-imadcuktehzpzf6x.jpeg?q=90'),
(124, 2, '4', 'استراتيجية التسويق', 'https://thaka.bing.com/th/id/OIP.Rw_VvSEXa1xzEJyHIwB3vAHaKz?rs=1&pid=ImgDetMain'),
(125, 2, '4', 'قضايا معاصرة في التسويق', 'https://res.cloudinary.com/bloomsbury-atlas/image/upload/w_360,c_scale/jackets/9780333677742.jpg'),
(126, 2, '4', 'تسويق وإدارة المحتوى', 'https://thaka.bing.com/th/id/OIP.Fh50P_eJQSgPBEq7Lr03qQAAAA?rs=1&pid=ImgDetMain'),
(127, 2, '4', 'التسويق عبر محركات البحث', 'https://www.digitalvidya.com/blog/wp-content/uploads/2017/01/Global-Search-Engine-Marketing.webp'),
(128, 2, '4', 'مشروع التخرج', NULL),
(129, 2, '4', 'التدريب الميداني', NULL),
(130, 2, '4', 'مهارات الجاهزية لسوق العمل', NULL),
(131, 2, '4', 'العمل لطلبة التسويق', NULL),
(134, 3, '1', 'Consumer Behavior ', 'Books links/Consumer behavior.pdf'),
(135, 4, '2', 'Consumer Behavior ', 'sawfgseth');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
