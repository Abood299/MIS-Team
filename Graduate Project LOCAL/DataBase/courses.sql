-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2025 at 04:46 PM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
