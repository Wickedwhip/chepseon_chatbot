-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2025 at 01:09 PM
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
-- Database: `chepseon_chatbot`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat_logs`
--

CREATE TABLE `chat_logs` (
  `id` int(11) NOT NULL,
  `user_message` text DEFAULT NULL,
  `bot_reply` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat_logs`
--

INSERT INTO `chat_logs` (`id`, `user_message`, `bot_reply`, `created_at`) VALUES
(1, 'hi', 'Hello! I’m the Chepseon TVC assistant.', '2025-11-05 10:15:36'),
(2, 'how much is school fees', 'Fee structures vary by course. You can check at the finance office or on the noticeboard.', '2025-11-05 10:15:51'),
(3, 'and admissions', 'Admission is ongoing! Visit the registrar’s office or check our official website for requirements.', '2025-11-05 10:16:04'),
(4, 'hi', 'Hello! I’m the Chepseon TVC assistant.', '2025-11-05 10:43:53'),
(5, 'is admissions ongoing', 'Admission is ongoing! Visit the registrar’s office or check our official website for requirements.', '2025-11-05 10:44:07');

-- --------------------------------------------------------

--
-- Table structure for table `responses`
--

CREATE TABLE `responses` (
  `id` int(11) NOT NULL,
  `keyword` varchar(100) NOT NULL,
  `response` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `responses`
--

INSERT INTO `responses` (`id`, `keyword`, `response`) VALUES
(1, 'hello', 'Hi there! How can I help you today?'),
(2, 'hi', 'Hello! I’m the Chepseon TVC assistant.'),
(3, 'courses', 'We offer ICT, Electrical, Building, and Business courses.'),
(4, 'fees', 'Fee structures vary by course. You can check at the finance office or on the noticeboard.'),
(5, 'admission', 'Admission is ongoing! Visit the registrar’s office or check our official website for requirements.'),
(6, 'location', 'Chepseon TVC is located in Kericho County, along the Kericho–Nakuru highway.'),
(7, 'contacts', 'You can reach us via +2547xxxxxxx or email info@chepseontvc.ac.ke.'),
(8, 'apply', 'You can apply by visiting the Chepseon TVC admissions office or during our intake period. Bring your KCSE results and ID copy.'),
(9, 'admission requirements', 'You need your KCSE certificate or result slip, ID card, and passport photo.'),
(10, 'intake', 'Our main intakes are usually in January, May, and September. Visit the college for specific dates.'),
(11, 'apply online', 'Currently, applications are done in person. You can pick an application form from the admissions office.'),
(12, 'documents', 'Bring your KCSE results, ID, and two passport photos when registering.'),
(13, 'fees', 'Tuition fees vary by course. Visit the accounts office or call for a detailed breakdown.'),
(14, 'payment', 'You can pay fees via M-Pesa or directly at the bank. Always use your admission number as reference.'),
(15, 'installments', 'Yes, fee payments can be made in installments with approval from the accounts office.'),
(16, 'mpesa', 'You can pay via M-Pesa Paybill number 400200, Account: your admission number.'),
(17, 'paybill', 'Our M-Pesa Paybill number is 400200. Use your admission number as the account.'),
(18, 'courses', 'We offer programs in Electrical Engineering, ICT, Business Studies, Building Technology, and more.'),
(19, 'electrical', 'Yes, Chepseon TVC offers Electrical and Electronics Engineering courses at craft and diploma levels.'),
(20, 'computer', 'Yes, we offer ICT and Computer Studies at different levels.'),
(21, 'course duration', 'Courses range from 6 months for short courses to 2 years for diploma programs.'),
(22, 'tveta', 'Yes, all our programs are approved and accredited by TVETA.'),
(23, 'class time', 'Classes usually start at 8:00 AM and end around 4:00 PM.'),
(24, 'term', 'Each term runs about 3 months followed by short breaks.'),
(25, 'holidays', 'Holidays are after every term. Exact dates are announced on campus.'),
(26, 'semester', 'Most diploma courses follow a 3-semester per year structure.'),
(27, 'location', 'Chepseon TVC is located in Chepseon, Kericho County, along the Kericho–Nakuru highway.'),
(28, 'contact', 'You can reach us at 07XX XXX XXX or visit the admin office during working hours.'),
(29, 'phone', 'Call the Chepseon TVC office at 07XX XXX XXX for quick assistance.'),
(30, 'email', 'You can email us via info@chepseontvc.ac.ke.'),
(31, 'kericho', 'Yes, we’re located in Kericho County, near Chepseon Township.'),
(32, 'hostel', 'Yes, we provide accommodation for both male and female students within walking distance.'),
(33, 'accommodation', 'On-campus and off-campus hostels are available. Inquire early to secure space.'),
(34, 'cafeteria', 'We have a cafeteria serving breakfast, lunch, and snacks at affordable prices.'),
(35, 'wifi', 'Yes, Wi-Fi is available for students in designated areas.'),
(36, 'internship', 'We assist students in finding attachment placements after completing coursework.'),
(37, 'attachment', 'Students are guided to get attachments through the department heads.'),
(38, 'certificate', 'Graduates receive certificates recognized by TVETA and the Ministry of Education.'),
(39, 'help', 'You can ask about admissions, fees, contacts, courses, or anything about Chepseon TVC.'),
(40, 'portal', 'For portal help, visit the ICT office or contact the admin for reset assistance.'),
(41, 'more info', 'You can get more info from the front office or by calling our contact line.');

-- --------------------------------------------------------

--
-- Table structure for table `unanswered_queries`
--

CREATE TABLE `unanswered_queries` (
  `id` int(11) NOT NULL,
  `message` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unanswered_queries`
--

INSERT INTO `unanswered_queries` (`id`, `message`, `created_at`) VALUES
(1, 'hi', '2025-11-05 09:48:38'),
(2, 'how much are the tuition fees?', '2025-11-05 09:49:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat_logs`
--
ALTER TABLE `chat_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `responses`
--
ALTER TABLE `responses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unanswered_queries`
--
ALTER TABLE `unanswered_queries`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat_logs`
--
ALTER TABLE `chat_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `responses`
--
ALTER TABLE `responses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `unanswered_queries`
--
ALTER TABLE `unanswered_queries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
