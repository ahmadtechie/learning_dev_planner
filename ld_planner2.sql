-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Apr 16, 2024 at 05:21 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ld_planner2`
--

-- --------------------------------------------------------

--
-- Table structure for table `competency`
--

CREATE TABLE `competency` (
  `id` int(10) UNSIGNED NOT NULL,
  `competency_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `competency`
--

INSERT INTO `competency` (`id`, `competency_name`, `created_at`, `updated_at`, `deleted_at`, `description`) VALUES
(1, 'Project management', NULL, NULL, NULL, NULL),
(2, 'Communication Skills', '2024-02-22 15:07:06', '2024-02-22 15:07:06', NULL, 'Must be possess good English communication skills'),
(3, 'Problem-solving', '2024-02-24 02:47:23', '2024-02-24 02:47:23', NULL, 'Must be a great problem-solver'),
(4, 'Data Structure & Algo', '2024-04-02 14:33:02', '2024-04-02 14:33:02', NULL, 'Deep knowledge of data structures and algorithms'),
(5, 'AWS', '2024-04-02 14:34:11', '2024-04-02 14:34:11', NULL, 'Technical know-how of deploying and managing products on AWS'),
(6, 'Strategic thinking', '2024-04-12 02:38:38', '2024-04-12 02:38:38', NULL, 'The need to have a clear vision of the organization\'s goals, values, and culture, and how they align with the current and future needs of the workforce'),
(7, 'Communication and collaboration', '2024-04-12 02:39:16', '2024-04-12 02:39:16', NULL, 'You need to be able to communicate and collaborate effectively with various stakeholders, such as senior leaders, managers, employees, and external partners.'),
(8, 'Analytical and critical thinking', '2024-04-12 02:40:02', '2024-04-12 02:40:02', NULL, 'You need to be able to use analytical and critical thinking skills to identify patterns, trends, gaps, and opportunities, and to evaluate the effectiveness and impact of talent management and succession planning initiatives'),
(9, 'Debugging Skills', '2024-04-14 09:31:50', '2024-04-14 09:31:50', NULL, 'Must possess strong debugging skills');

-- --------------------------------------------------------

--
-- Table structure for table `competency_descriptor`
--

CREATE TABLE `competency_descriptor` (
  `id` int(10) UNSIGNED NOT NULL,
  `competency_id` int(10) UNSIGNED NOT NULL,
  `descriptor_text` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(10) UNSIGNED NOT NULL,
  `department_name` varchar(355) NOT NULL,
  `group_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `department_name`, `group_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'Fixam', 4, '2024-02-20 11:48:53', '2024-02-20 16:39:17', NULL),
(4, 'fixams', 4, '2024-02-20 11:49:48', '2024-02-20 11:51:12', '2024-02-20 11:51:12'),
(5, 'fixamings', 4, '2024-02-20 11:50:17', '2024-02-20 11:51:06', '2024-02-20 11:51:06'),
(6, 'Fixams', 4, '2024-02-20 11:52:48', '2024-02-20 11:53:00', '2024-02-20 11:53:00'),
(7, 'FixamS', NULL, '2024-03-20 12:40:00', '2024-04-02 07:53:20', '2024-04-02 07:53:20'),
(8, 'Technical', NULL, '2024-04-02 07:53:14', '2024-04-02 07:53:14', NULL),
(9, 'Finance', NULL, NULL, NULL, NULL),
(10, 'Human Resources', NULL, '2024-04-13 19:48:24', '2024-04-13 19:48:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `development_cycle`
--

CREATE TABLE `development_cycle` (
  `id` int(10) UNSIGNED NOT NULL,
  `max_competencies` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `cycle_year` int(10) UNSIGNED NOT NULL,
  `start_month` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `end_month` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `descriptor_text` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `development_cycle`
--

INSERT INTO `development_cycle` (`id`, `max_competencies`, `cycle_year`, `start_month`, `end_month`, `descriptor_text`, `created_at`, `updated_at`, `deleted_at`, `is_active`) VALUES
(1, 2, 2024, 2, 6, '', NULL, '2024-04-11 20:24:55', NULL, 0),
(6, 4, 2025, 3, 9, '', '2024-04-11 19:19:28', '2024-04-11 20:28:23', NULL, 0),
(8, 5, 2026, 2, 11, '', '2024-04-14 09:35:22', '2024-04-14 09:36:34', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `development_rating`
--

CREATE TABLE `development_rating` (
  `id` int(10) UNSIGNED NOT NULL,
  `employee_id` int(10) UNSIGNED NOT NULL,
  `competency_id` int(10) UNSIGNED NOT NULL,
  `self_rating` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `line_manager_rating` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `cycle_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `development_rating`
--

INSERT INTO `development_rating` (`id`, `employee_id`, `competency_id`, `self_rating`, `line_manager_rating`, `cycle_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 36, 5, 8, 0, 1, '2024-04-03 12:25:15', '2024-04-03 12:25:15', NULL),
(2, 36, 3, 10, 0, 1, '2024-04-03 12:25:15', '2024-04-03 12:25:15', NULL),
(3, 46, 3, 9, 0, 1, '2024-04-11 11:40:25', '2024-04-11 11:40:25', NULL),
(4, 46, 2, 10, 0, 1, '2024-04-11 11:40:25', '2024-04-11 11:40:25', NULL),
(5, 46, 8, 8, 7, 6, '2024-04-12 02:46:01', '2024-04-13 19:23:38', NULL),
(6, 46, 7, 6, 8, 6, '2024-04-12 02:46:01', '2024-04-13 19:23:38', NULL),
(7, 46, 6, 7, 9, 6, '2024-04-12 02:46:01', '2024-04-13 19:23:38', NULL),
(8, 46, 3, 9, 10, 6, '2024-04-12 02:46:01', '2024-04-13 19:23:38', NULL),
(9, 159, 8, 9, 9, 6, '2024-04-13 19:22:01', '2024-04-13 19:23:38', NULL),
(10, 159, 7, 10, 7, 6, '2024-04-13 19:22:01', '2024-04-13 19:23:38', NULL),
(11, 159, 6, 8, 10, 6, '2024-04-13 19:22:01', '2024-04-13 19:23:38', NULL),
(12, 159, 3, 10, 9, 6, '2024-04-13 19:22:01', '2024-04-13 19:23:38', NULL),
(13, 157, 8, 9, 0, 6, '2024-04-13 19:34:19', '2024-04-13 19:34:19', NULL),
(14, 157, 5, 6, 0, 6, '2024-04-13 19:34:19', '2024-04-13 19:34:19', NULL),
(15, 157, 4, 10, 0, 6, '2024-04-13 19:34:19', '2024-04-13 19:34:19', NULL),
(16, 157, 3, 8, 0, 6, '2024-04-13 19:34:19', '2024-04-13 19:34:19', NULL),
(17, 203, 9, 9, 7, 8, '2024-04-14 09:37:51', '2024-04-14 10:20:37', NULL),
(18, 203, 8, 8, 6, 8, '2024-04-14 09:37:51', '2024-04-14 10:20:37', NULL),
(19, 203, 5, 10, 9, 8, '2024-04-14 09:37:51', '2024-04-14 10:20:37', NULL),
(20, 203, 4, 10, 8, 8, '2024-04-14 09:37:51', '2024-04-14 10:20:37', NULL),
(21, 203, 3, 9, 10, 8, '2024-04-14 09:37:51', '2024-04-14 10:20:37', NULL),
(22, 46, 8, 10, 9, 8, '2024-04-14 09:46:41', '2024-04-14 10:20:37', NULL),
(23, 46, 7, 9, 5, 8, '2024-04-14 09:46:41', '2024-04-14 10:20:37', NULL),
(24, 46, 6, 9, 9, 8, '2024-04-14 09:46:41', '2024-04-14 10:20:37', NULL),
(25, 46, 3, 10, 10, 8, '2024-04-14 09:46:41', '2024-04-14 10:20:37', NULL),
(26, 46, 2, 10, 8, 8, '2024-04-14 09:46:41', '2024-04-14 10:20:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `division`
--

CREATE TABLE `division` (
  `id` int(10) UNSIGNED NOT NULL,
  `division_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `division`
--

INSERT INTO `division` (`id`, `division_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Digital Marketing', '2024-02-01 01:58:31', '2024-02-20 11:32:00', '2024-02-20 11:32:00'),
(2, 'Digital Services', '2024-02-01 02:00:07', '2024-02-01 02:10:35', '2024-02-01 02:10:35'),
(3, 'Digital Services', '2024-02-01 02:04:08', '2024-02-20 10:10:00', '2024-02-20 10:10:00'),
(4, 'Technology Solutions and Platforms', '2024-02-01 02:16:49', '2024-02-20 10:45:53', '2024-02-20 10:45:53'),
(5, 'Digital Services', '2024-02-20 10:10:09', '2024-02-20 11:12:44', '2024-02-20 11:12:44'),
(6, 'Technology Solutions and Platform', '2024-02-20 10:47:40', '2024-02-20 11:15:29', NULL),
(7, 'Technical', '2024-02-20 11:01:02', '2024-02-20 11:02:44', '2024-02-20 11:02:44'),
(8, 'Digital Marketings', '2024-02-20 11:03:02', '2024-02-20 11:15:41', '2024-02-20 11:15:41'),
(9, 'EPV', '2024-02-20 11:04:20', '2024-02-20 11:04:27', '2024-02-20 11:04:27'),
(10, 'Digital Services', '2024-02-20 16:03:50', '2024-02-20 16:35:01', '2024-02-20 16:35:01'),
(11, 'Digital Services', '2024-02-20 16:35:11', '2024-02-20 16:45:46', NULL),
(12, 'BDC', '2024-03-20 12:13:30', '2024-03-20 12:13:30', NULL),
(13, 'Finance', '2024-03-20 12:37:20', '2024-03-20 12:37:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `email_logs`
--

CREATE TABLE `email_logs` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` enum('success','failed') NOT NULL DEFAULT 'success',
  `created_at` datetime DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `email_logs`
--

INSERT INTO `email_logs` (`id`, `email`, `status`, `created_at`, `type`, `updated_at`, `deleted_at`) VALUES
(118, 'ahmad.sharafudeen@gmail.com', 'success', '2024-04-14 12:57:24', 'cycle_invite', '2024-04-14 11:57:24', NULL),
(119, 'uambursa.It@buk.edu.ng', 'success', '2024-04-14 12:57:24', 'cycle_invite', '2024-04-14 11:57:24', NULL),
(120, 'muneer@gmail.com', 'success', '2024-04-14 12:57:25', 'cycle_invite', '2024-04-14 11:57:25', NULL),
(121, 'jumai@gmail.com', 'success', '2024-04-14 12:57:25', 'cycle_invite', '2024-04-14 11:57:25', NULL),
(122, 'asharafudeenraji@gmail.com', 'success', '2024-04-14 12:57:25', 'cycle_invite', '2024-04-14 11:57:25', NULL),
(123, 'anike@gmail.com', 'success', '2024-04-14 12:57:26', 'cycle_invite', '2024-04-14 11:57:26', NULL),
(124, 'jamiu@gmail.com', 'success', '2024-04-14 12:57:26', 'cycle_invite', '2024-04-14 11:57:26', NULL),
(125, 'hkakudi.cs@buk.edu.ng', 'success', '2024-04-14 12:57:27', 'cycle_invite', '2024-04-14 11:57:27', NULL),
(126, 'yusuff.taiwo@gmail.com', 'success', '2024-04-14 12:57:27', 'cycle_invite', '2024-04-14 11:57:27', NULL),
(127, 'jane45@example.com', 'success', '2024-04-14 12:57:27', 'cycle_invite', '2024-04-14 11:57:27', NULL),
(128, 'jane46@example.com', 'success', '2024-04-14 12:57:28', 'cycle_invite', '2024-04-14 11:57:28', NULL),
(129, 'john47@example.com', 'success', '2024-04-14 12:57:28', 'cycle_invite', '2024-04-14 11:57:28', NULL),
(130, 'john27@example.com', 'success', '2024-04-14 12:57:28', 'cycle_invite', '2024-04-14 11:57:28', NULL),
(131, 'smith28@example.com', 'success', '2024-04-14 12:57:29', 'cycle_invite', '2024-04-14 11:57:29', NULL),
(132, 'john29@example.com', 'success', '2024-04-14 12:57:29', 'cycle_invite', '2024-04-14 11:57:29', NULL),
(133, 'jane30@example.com', 'success', '2024-04-14 12:57:29', 'cycle_invite', '2024-04-14 11:57:29', NULL),
(134, 'john31@example.com', 'success', '2024-04-14 12:57:30', 'cycle_invite', '2024-04-14 11:57:30', NULL),
(135, 'jane32@example.com', 'success', '2024-04-14 12:57:30', 'cycle_invite', '2024-04-14 11:57:30', NULL),
(136, 'smith33@example.com', 'success', '2024-04-14 12:57:30', 'cycle_invite', '2024-04-14 11:57:30', NULL),
(137, 'jane34@example.com', 'success', '2024-04-14 12:57:30', 'cycle_invite', '2024-04-14 11:57:30', NULL),
(138, 'jane35@example.com', 'success', '2024-04-14 12:57:31', 'cycle_invite', '2024-04-14 11:57:31', NULL),
(139, 'smith48@example.com', 'success', '2024-04-14 12:57:31', 'cycle_invite', '2024-04-14 11:57:31', NULL),
(140, 'smith49@example.com', 'success', '2024-04-14 12:57:32', 'cycle_invite', '2024-04-14 11:57:32', NULL),
(141, 'john1@example.com', 'success', '2024-04-14 12:57:32', 'cycle_invite', '2024-04-14 11:57:32', NULL),
(142, 'john2@example.com', 'success', '2024-04-14 12:57:32', 'cycle_invite', '2024-04-14 11:57:32', NULL),
(143, 'john3@example.com', 'success', '2024-04-14 12:57:33', 'cycle_invite', '2024-04-14 11:57:33', NULL),
(144, 'john4@example.com', 'success', '2024-04-14 12:57:33', 'cycle_invite', '2024-04-14 11:57:33', NULL),
(145, 'jane5@example.com', 'success', '2024-04-14 12:57:33', 'cycle_invite', '2024-04-14 11:57:33', NULL),
(146, 'john6@example.com', 'success', '2024-04-14 12:57:34', 'cycle_invite', '2024-04-14 11:57:34', NULL),
(147, 'smith7@example.com', 'success', '2024-04-14 12:57:34', 'cycle_invite', '2024-04-14 11:57:34', NULL),
(148, 'jane8@example.com', 'success', '2024-04-14 12:57:34', 'cycle_invite', '2024-04-14 11:57:34', NULL),
(149, 'smith9@example.com', 'success', '2024-04-14 12:57:35', 'cycle_invite', '2024-04-14 11:57:35', NULL),
(150, 'john10@example.com', 'success', '2024-04-14 12:57:35', 'cycle_invite', '2024-04-14 11:57:35', NULL),
(151, 'john11@example.com', 'success', '2024-04-14 12:57:35', 'cycle_invite', '2024-04-14 11:57:35', NULL),
(152, 'john12@example.com', 'success', '2024-04-14 12:57:36', 'cycle_invite', '2024-04-14 11:57:36', NULL),
(153, 'jane13@example.com', 'success', '2024-04-14 12:57:36', 'cycle_invite', '2024-04-14 11:57:36', NULL),
(154, 'jane14@example.com', 'success', '2024-04-14 12:57:36', 'cycle_invite', '2024-04-14 11:57:36', NULL),
(155, 'jane15@example.com', 'success', '2024-04-14 12:57:37', 'cycle_invite', '2024-04-14 11:57:37', NULL),
(156, 'smith16@example.com', 'success', '2024-04-14 12:57:37', 'cycle_invite', '2024-04-14 11:57:37', NULL),
(157, 'john17@example.com', 'success', '2024-04-14 12:57:37', 'cycle_invite', '2024-04-14 11:57:37', NULL),
(158, 'smith18@example.com', 'success', '2024-04-14 12:57:37', 'cycle_invite', '2024-04-14 11:57:37', NULL),
(159, 'jane19@example.com', 'success', '2024-04-14 12:57:38', 'cycle_invite', '2024-04-14 11:57:38', NULL),
(160, 'jane20@example.com', 'success', '2024-04-14 12:57:38', 'cycle_invite', '2024-04-14 11:57:38', NULL),
(161, 'john21@example.com', 'success', '2024-04-14 12:57:38', 'cycle_invite', '2024-04-14 11:57:38', NULL),
(162, 'jane22@example.com', 'success', '2024-04-14 12:57:39', 'cycle_invite', '2024-04-14 11:57:39', NULL),
(163, 'jane23@example.com', 'success', '2024-04-14 12:57:39', 'cycle_invite', '2024-04-14 11:57:39', NULL),
(164, 'jane24@example.com', 'success', '2024-04-14 12:57:39', 'cycle_invite', '2024-04-14 11:57:39', NULL),
(165, 'jane25@example.com', 'success', '2024-04-14 12:57:40', 'cycle_invite', '2024-04-14 11:57:40', NULL),
(166, 'jane26@example.com', 'success', '2024-04-14 12:57:40', 'cycle_invite', '2024-04-14 11:57:40', NULL),
(167, 'jane36@example.com', 'success', '2024-04-14 12:57:40', 'cycle_invite', '2024-04-14 11:57:40', NULL),
(168, 'john37@example.com', 'success', '2024-04-14 12:57:41', 'cycle_invite', '2024-04-14 11:57:41', NULL),
(169, 'jane38@example.com', 'success', '2024-04-14 12:57:41', 'cycle_invite', '2024-04-14 11:57:41', NULL),
(170, 'smith39@example.com', 'success', '2024-04-14 12:57:41', 'cycle_invite', '2024-04-14 11:57:41', NULL),
(171, 'jane40@example.com', 'success', '2024-04-14 12:57:42', 'cycle_invite', '2024-04-14 11:57:42', NULL),
(172, 'john41@example.com', 'success', '2024-04-14 12:57:42', 'cycle_invite', '2024-04-14 11:57:42', NULL),
(173, 'smith42@example.com', 'success', '2024-04-14 12:57:42', 'cycle_invite', '2024-04-14 11:57:42', NULL),
(174, 'smith43@example.com', 'success', '2024-04-14 12:57:43', 'cycle_invite', '2024-04-14 11:57:43', NULL),
(175, 'jane44@example.com', 'success', '2024-04-14 12:57:43', 'cycle_invite', '2024-04-14 11:57:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `email_template`
--

CREATE TABLE `email_template` (
  `id` int(10) UNSIGNED NOT NULL,
  `email_type` varchar(100) NOT NULL,
  `email_subject` varchar(150) NOT NULL,
  `email_body` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `email_from` varchar(100) DEFAULT NULL,
  `email_from_name` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `email_template`
--

INSERT INTO `email_template` (`id`, `email_type`, `email_subject`, `email_body`, `created_at`, `updated_at`, `deleted_at`, `email_from`, `email_from_name`) VALUES
(1, 'staff_created', 'Welcome to {siteName} Learning and Development Planner App', '<!DOCTYPE html>\n<html lang=\"en\">\n<head>\n    <meta charset=\\\"UTF-8\\\">\n    <meta name=\\\"viewport\\\" content=\\\"width=device-width, initial-scale=1.0\\\">\n    <title>Welcome to LD Planner</title>\n    <style>\n        body {\n            font-family: Arial, sans-serif;\n            margin: 0;\n            padding: 0;\n            background-color: #f4f4f4;\n        }\n        .container {\n            max-width: 600px;\n            margin: 20px auto;\n            padding: 20px;\n            background-color: #fff;\n            border-radius: 5px;\n            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);\n        }\n        h1 {\n            color: #333;\n        }\n        .login-details {\n            margin-top: 20px;\n        }\n        .button {\n            display: inline-block;\n            padding: 10px 20px;\n            background-color: #007bff;\n            color: #fff;\n            text-decoration: none;\n            border-radius: 5px;\n        }\n    </style>\n</head>\n<body>\n<div class=\\\"container\\\">\n    <h1>Welcome to LD Planner</h1>\n    <p>Greetings {first_name},</p>\n    <p>Welcome!!! {user_roles} account was created for you on LD Planner, find below your login details:</p>\n    <div class=\\\"login-details\\\">\n        <p><strong>Login Username:</strong> {username}</p>\n        <p><strong>Login Email Address:</strong>  {email}</p>\n        <p><strong>Login Password:</strong>  {password}</p>\n        <p><strong>For security purposes, please change your password on first login.</strong></p>\n    </div>\n    <p><a href=\"{login_url}\" class=\\\"button\\\">LOGIN PAGE</a></p>\n</div>\n</body>\n</html>\n', NULL, NULL, NULL, 'aas1800216.com@buk.edu.ng', NULL),
(2, 'validate_rating_notify', 'Notification: Self-Rating Ready for Validation: {first_name} {last_name}', '<!DOCTYPE html>\n<html lang=\\\"en\\\">\n<head>\n    <meta charset=\\\"UTF-8\\\">\n    <meta name=\\\"viewport\\\" content=\\\"width=device-width, initial-scale=1.0\\\">\n    <title>Notification: Self-Rating Ready for Validation</title>\n    <style>\n        body {\n            font-family: Arial, sans-serif;\n            margin: 0;\n            padding: 0;\n            background-color: #f4f4f4;\n        }\n        .container {\n            max-width: 600px;\n            margin: 20px auto;\n            padding: 20px;\n            background-color: #fff;\n            border-radius: 5px;\n            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);\n        }\n        h1 {\n            color: #333;\n        }\n        .notification-content {\n            margin-top: 20px;\n        }\n        .button {\n            display: inline-block;\n            padding: 10px 20px;\n            background-color: #007bff;\n            color: #fff;\n            text-decoration: none;\n            border-radius: 5px;\n        }\n    </style>\n</head>\n<body>\n<div class=\\\"container\\\">\n    <h1>Notification: Self-Rating Ready for Validation</h1>\n    <div class=\\\"notification-content\\\">\n        <p>Hello {line_manager_name},</p>\n        <p>This is to inform you that {employee_name} has completed their self-rating for the cycle year {cycle_year}.</p>\n        <p>Please click the button below to validate their rating:</p>\n        <p><a href=\"{validation_url}\" class=\\\"button\\\">Validate Rating</a></p>\n    </div>\n</div>\n</body>\n</html>\n', NULL, NULL, NULL, 'aas1800216.com@buk.edu.ng', NULL),
(3, 'sef_rating_invite', 'Notification: Self-Rating Invitation {first_name} {last_name}', '<!DOCTYPE html>\n<html lang=\"en\">\n<head>\n    <meta charset=\"UTF-8\">\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n    <title>Notification: Self-Rating Invitation</title>\n    <style>\n        body {\n            font-family: Arial, sans-serif;\n            margin: 0;\n            padding: 0;\n            background-color: #f4f4f4;\n        }\n        .container {\n            max-width: 600px;\n            margin: 20px auto;\n            padding: 20px;\n            background-color: #fff;\n            border-radius: 5px;\n            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);\n        }\n        h1 {\n            color: #333;\n        }\n        .notification-content {\n            margin-top: 20px;\n        }\n        .button {\n            display: inline-block;\n            padding: 10px 20px;\n            background-color: #007bff;\n            color: #fff;\n            text-decoration: none;\n            border-radius: 5px;\n        }\n    </style>\n</head>\n<body>\n<div class=\"container\">\n    <h1>Notification: Self-Rating Invitation</h1>\n    <div class=\"notification-content\">\n        <p>Hello {employee_name},</p>\n        <p>This is to invite you that it\'s time to start your self-rating for the new {cycle_year} development contracting cycle.</p>\n        <p>Please click the button below to begin your self-rating:</p>\n        <p><a href=\"{self_rating_url}\" class=\"button\">Start Self-Rating</a></p>\n    </div>\n</div>\n</body>\n</html>\n', NULL, NULL, NULL, 'aas1800216.com@buk.edu.ng', 'Ogochimelu Ejike');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `job_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `line_manager_id` int(10) UNSIGNED DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `user_id`, `job_id`, `created_at`, `updated_at`, `deleted_at`, `line_manager_id`, `department_id`, `unit_id`) VALUES
(27, 36, 4, '2024-03-25 10:58:43', '2024-04-14 23:27:49', NULL, 36, 8, 4),
(28, 37, 4, '2024-03-25 12:56:05', '2024-04-02 11:56:03', '2024-04-01 10:28:31', 29, 3, 0),
(29, 38, 4, '2024-03-25 13:35:19', '2024-04-14 18:21:59', NULL, 32, 0, 0),
(30, 39, 5, '2024-03-25 13:36:27', '2024-04-14 17:25:54', '2024-04-01 10:31:54', 32, 3, 1),
(31, 40, 5, '2024-03-25 13:37:30', '2024-04-14 18:39:47', NULL, 36, NULL, NULL),
(32, 41, 5, '2024-03-26 11:46:46', '2024-04-14 18:39:47', NULL, 36, NULL, NULL),
(36, 45, 4, '2024-03-31 09:20:26', '2024-04-14 18:39:47', NULL, 36, NULL, NULL),
(37, 46, 4, '2024-03-31 12:44:00', '2024-04-16 02:57:12', NULL, 31, NULL, NULL),
(38, 47, 5, '2024-04-01 09:55:21', '2024-04-16 02:57:27', NULL, 36, 8, 5),
(41, 50, 5, '2024-04-11 06:14:49', '2024-04-14 18:39:47', NULL, 36, NULL, NULL),
(42, 51, 4, '2024-04-11 10:20:20', '2024-04-11 10:20:20', NULL, 36, NULL, NULL),
(43, 52, 4, '2024-04-11 10:39:13', '2024-04-14 18:39:47', NULL, 36, NULL, NULL),
(46, 55, 5, '2024-04-11 10:54:55', '2024-04-14 18:39:47', NULL, 36, NULL, NULL),
(47, 56, 5, '2024-04-12 07:44:38', '2024-04-14 18:45:33', NULL, 203, NULL, NULL),
(151, 163, 9, '2024-04-13 19:13:08', '2024-04-13 19:13:08', NULL, 36, 9, 6),
(152, 164, 10, '2024-04-13 19:13:08', '2024-04-13 19:13:08', NULL, 36, 9, 7),
(153, 165, 9, '2024-04-13 19:13:09', '2024-04-13 19:13:09', NULL, NULL, 9, NULL),
(154, 166, 9, '2024-04-13 19:13:09', '2024-04-13 19:13:09', NULL, NULL, NULL, 7),
(155, 167, 9, '2024-04-13 19:13:10', '2024-04-13 19:13:10', NULL, NULL, NULL, 6),
(156, 168, 10, '2024-04-13 19:13:11', '2024-04-13 19:13:11', NULL, NULL, NULL, 7),
(157, 169, 4, '2024-04-13 19:13:11', '2024-04-13 19:31:51', NULL, 36, 9, 7),
(158, 170, 9, '2024-04-13 19:13:12', '2024-04-13 19:13:12', NULL, NULL, NULL, NULL),
(159, 171, 5, '2024-04-13 19:13:12', '2024-04-13 19:20:41', NULL, 36, NULL, 7),
(160, 172, 9, '2024-04-13 19:13:13', '2024-04-13 19:13:13', NULL, NULL, NULL, 7),
(161, 173, 10, '2024-04-13 19:13:13', '2024-04-13 19:13:13', NULL, NULL, NULL, 6),
(162, 174, 9, '2024-04-13 19:13:14', '2024-04-13 19:13:14', NULL, NULL, NULL, NULL),
(163, 175, 11, '2024-04-13 19:13:15', '2024-04-13 19:13:15', NULL, NULL, NULL, 6),
(164, 176, 11, '2024-04-13 19:13:16', '2024-04-13 19:13:16', NULL, NULL, 9, 7),
(165, 177, 9, '2024-04-13 19:13:17', '2024-04-13 19:13:17', NULL, NULL, 9, NULL),
(166, 178, 9, '2024-04-13 19:13:17', '2024-04-13 19:13:17', NULL, NULL, NULL, 6),
(167, 179, 9, '2024-04-13 19:13:18', '2024-04-13 19:13:18', NULL, NULL, NULL, NULL),
(168, 180, 9, '2024-04-13 19:13:19', '2024-04-13 19:13:19', NULL, NULL, 9, 6),
(169, 181, 10, '2024-04-13 19:13:20', '2024-04-13 19:13:20', NULL, NULL, 9, 7),
(170, 182, 11, '2024-04-13 19:13:21', '2024-04-13 19:13:21', NULL, NULL, NULL, 6),
(171, 183, 9, '2024-04-13 19:13:22', '2024-04-13 19:13:22', NULL, NULL, NULL, 7),
(172, 184, 11, '2024-04-13 19:13:22', '2024-04-13 19:13:22', NULL, NULL, NULL, 7),
(173, 185, 9, '2024-04-13 19:13:23', '2024-04-13 19:13:23', NULL, NULL, 9, NULL),
(174, 186, 10, '2024-04-13 19:13:24', '2024-04-13 19:13:24', NULL, NULL, 9, 6),
(175, 187, 11, '2024-04-13 19:13:25', '2024-04-13 19:13:25', NULL, NULL, NULL, 6),
(176, 188, 11, '2024-04-13 19:13:26', '2024-04-13 19:13:26', NULL, NULL, NULL, 7),
(177, 189, 11, '2024-04-13 19:13:27', '2024-04-13 19:13:27', NULL, NULL, 9, NULL),
(178, 190, 9, '2024-04-13 19:13:27', '2024-04-13 19:13:27', NULL, NULL, 9, NULL),
(179, 191, 11, '2024-04-13 19:13:28', '2024-04-13 19:13:28', NULL, NULL, NULL, 6),
(180, 192, 10, '2024-04-13 19:13:28', '2024-04-13 19:13:28', NULL, NULL, NULL, 7),
(181, 193, 11, '2024-04-13 19:13:29', '2024-04-13 19:13:29', NULL, NULL, NULL, 7),
(182, 194, 9, '2024-04-13 19:13:30', '2024-04-13 19:13:30', NULL, NULL, NULL, 6),
(183, 195, 10, '2024-04-13 19:13:31', '2024-04-13 19:13:31', NULL, NULL, NULL, 6),
(184, 196, 9, '2024-04-13 19:13:31', '2024-04-13 19:13:31', NULL, NULL, 9, NULL),
(185, 197, 9, '2024-04-13 19:13:32', '2024-04-13 19:13:32', NULL, NULL, NULL, NULL),
(186, 198, 11, '2024-04-13 19:13:33', '2024-04-13 19:13:33', NULL, NULL, 9, 7),
(187, 199, 10, '2024-04-13 19:13:33', '2024-04-13 19:13:33', NULL, NULL, 9, 6),
(188, 200, 11, '2024-04-13 19:13:34', '2024-04-13 19:13:34', NULL, NULL, NULL, 7),
(189, 201, 11, '2024-04-13 19:13:35', '2024-04-13 19:13:35', NULL, NULL, NULL, 6),
(190, 202, 11, '2024-04-13 19:13:36', '2024-04-13 19:13:36', NULL, NULL, NULL, NULL),
(191, 203, 10, '2024-04-13 19:13:36', '2024-04-13 19:13:36', NULL, NULL, NULL, 6),
(192, 204, 10, '2024-04-13 19:13:37', '2024-04-13 19:13:37', NULL, NULL, NULL, 7),
(193, 205, 11, '2024-04-13 19:13:38', '2024-04-13 19:13:38', NULL, NULL, NULL, 6),
(194, 206, 11, '2024-04-13 19:13:39', '2024-04-13 19:13:39', NULL, NULL, 9, 6),
(195, 207, 11, '2024-04-13 19:13:39', '2024-04-13 19:13:39', NULL, NULL, NULL, 7),
(196, 208, 11, '2024-04-13 19:13:40', '2024-04-13 19:13:40', NULL, NULL, NULL, 6),
(197, 209, 10, '2024-04-13 19:13:40', '2024-04-14 18:26:39', NULL, NULL, 9, 7),
(198, 210, 9, '2024-04-13 19:13:41', '2024-04-14 18:19:37', NULL, 43, 9, 7),
(199, 211, 11, '2024-04-13 19:13:42', '2024-04-13 19:13:42', NULL, NULL, 9, 7),
(200, 212, 11, '2024-04-14 09:15:00', '2024-04-14 09:15:00', NULL, NULL, NULL, 6),
(201, 213, 10, '2024-04-14 09:15:04', '2024-04-14 09:15:04', NULL, NULL, NULL, 7),
(202, 214, 11, '2024-04-14 09:15:05', '2024-04-14 18:45:33', NULL, 203, NULL, 7),
(203, 215, 4, '2024-04-14 09:15:05', '2024-04-14 18:39:47', NULL, 36, NULL, 6),
(204, 216, 10, '2024-04-14 09:15:06', '2024-04-14 09:15:06', NULL, NULL, NULL, 6),
(205, 217, 9, '2024-04-14 09:15:06', '2024-04-14 18:45:33', NULL, NULL, 9, NULL),
(206, 218, 9, '2024-04-14 09:15:07', '2024-04-14 18:19:37', NULL, NULL, NULL, NULL),
(207, 219, 11, '2024-04-14 09:15:07', '2024-04-14 09:15:07', NULL, NULL, 9, 7),
(208, 220, 10, '2024-04-14 09:15:08', '2024-04-14 09:15:08', NULL, NULL, 9, 6),
(209, 221, 9, '2024-04-14 09:20:48', '2024-04-14 18:39:47', NULL, 36, 9, 6),
(210, 222, 10, '2024-04-14 09:20:49', '2024-04-14 18:39:47', NULL, 36, 9, 7),
(211, 223, 9, '2024-04-14 09:20:49', '2024-04-14 18:45:33', NULL, NULL, 9, NULL),
(212, 224, 9, '2024-04-14 09:20:50', '2024-04-14 09:20:50', NULL, NULL, NULL, 7),
(213, 225, 9, '2024-04-14 09:20:50', '2024-04-14 18:45:33', NULL, 203, NULL, 6),
(214, 226, 10, '2024-04-14 09:20:51', '2024-04-14 18:45:33', NULL, NULL, NULL, 7),
(215, 227, 10, '2024-04-14 09:20:51', '2024-04-14 18:45:33', NULL, NULL, 9, 7),
(216, 228, 9, '2024-04-14 09:20:52', '2024-04-14 18:21:59', NULL, 32, NULL, NULL),
(217, 229, 9, '2024-04-14 09:20:52', '2024-04-14 09:20:52', NULL, NULL, NULL, 7),
(218, 230, 9, '2024-04-14 09:20:53', '2024-04-14 18:45:33', NULL, 203, NULL, 7),
(219, 231, 10, '2024-04-14 09:20:53', '2024-04-14 18:45:33', NULL, 203, NULL, 6),
(220, 232, 9, '2024-04-14 09:20:53', '2024-04-14 18:26:39', NULL, NULL, NULL, NULL),
(221, 233, 11, '2024-04-14 09:20:54', '2024-04-14 09:20:54', NULL, NULL, NULL, 6),
(222, 234, 11, '2024-04-14 09:20:54', '2024-04-14 09:20:54', NULL, NULL, 9, 7),
(223, 235, 9, '2024-04-14 09:20:55', '2024-04-14 09:20:55', NULL, NULL, 9, NULL),
(224, 236, 9, '2024-04-14 09:20:55', '2024-04-14 09:20:55', NULL, NULL, NULL, 6),
(225, 237, 9, '2024-04-14 09:20:56', '2024-04-14 09:20:56', NULL, NULL, NULL, NULL),
(226, 238, 9, '2024-04-14 09:20:56', '2024-04-14 09:20:56', NULL, NULL, 9, 6),
(227, 239, 10, '2024-04-14 09:20:57', '2024-04-14 18:26:19', NULL, NULL, 9, 7),
(228, 240, 11, '2024-04-14 09:20:57', '2024-04-14 09:20:57', NULL, NULL, NULL, 6),
(229, 241, 9, '2024-04-14 09:20:57', '2024-04-14 09:20:57', NULL, NULL, NULL, 7),
(230, 242, 11, '2024-04-14 09:20:58', '2024-04-14 18:26:19', NULL, NULL, NULL, 7),
(231, 243, 9, '2024-04-14 09:20:58', '2024-04-14 18:26:19', NULL, NULL, 9, NULL),
(232, 244, 10, '2024-04-14 09:20:59', '2024-04-14 18:26:19', NULL, NULL, 9, 6),
(233, 245, 11, '2024-04-14 09:20:59', '2024-04-14 09:20:59', NULL, NULL, NULL, 6),
(234, 246, 11, '2024-04-14 09:21:00', '2024-04-14 09:21:00', NULL, NULL, NULL, 7),
(235, 247, 11, '2024-04-14 09:21:00', '2024-04-14 09:21:00', NULL, NULL, 9, NULL),
(236, 248, 9, '2024-04-14 09:21:00', '2024-04-14 09:21:00', NULL, NULL, 9, NULL),
(237, 249, 11, '2024-04-14 09:21:01', '2024-04-14 09:21:01', NULL, NULL, NULL, 7),
(238, 250, 11, '2024-04-14 09:21:01', '2024-04-14 09:21:01', NULL, NULL, NULL, 6),
(239, 251, 11, '2024-04-14 09:21:02', '2024-04-14 18:25:19', NULL, NULL, NULL, NULL),
(240, 252, 10, '2024-04-14 09:21:02', '2024-04-14 09:21:02', NULL, NULL, NULL, 6),
(241, 253, 10, '2024-04-14 09:21:03', '2024-04-14 09:21:03', NULL, NULL, NULL, 7),
(242, 254, 11, '2024-04-14 09:21:03', '2024-04-14 23:28:05', NULL, 0, NULL, 6),
(243, 255, 11, '2024-04-14 09:21:04', '2024-04-14 18:25:19', NULL, NULL, 9, 6),
(244, 256, 11, '2024-04-14 09:21:04', '2024-04-14 18:25:19', NULL, NULL, NULL, 7),
(245, 257, 11, '2024-04-14 09:21:04', '2024-04-14 09:21:04', NULL, NULL, NULL, 6),
(246, 258, 5, '2024-04-14 12:28:06', '2024-04-14 23:27:39', NULL, 36, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee_interventions`
--

CREATE TABLE `employee_interventions` (
  `id` int(11) UNSIGNED NOT NULL,
  `employee_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `intervention_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `employee_interventions`
--

INSERT INTO `employee_interventions` (`id`, `employee_id`, `created_at`, `updated_at`, `deleted_at`, `intervention_id`) VALUES
(23, 27, '2024-04-16 03:54:39', '2024-04-16 03:54:39', NULL, 5),
(24, 28, '2024-04-16 03:54:39', '2024-04-16 03:54:39', NULL, 5),
(25, 29, '2024-04-16 03:54:39', '2024-04-16 03:54:39', NULL, 5),
(26, 30, '2024-04-16 03:54:39', '2024-04-16 03:54:39', NULL, 5),
(27, 31, '2024-04-16 03:54:39', '2024-04-16 03:54:39', NULL, 5),
(28, 32, '2024-04-16 03:54:39', '2024-04-16 03:54:39', NULL, 5),
(29, 36, '2024-04-16 03:54:39', '2024-04-16 03:54:39', NULL, 5),
(30, 37, '2024-04-16 03:54:39', '2024-04-16 03:54:39', NULL, 5),
(31, 29, '2024-04-16 03:57:50', '2024-04-16 03:57:50', NULL, 5),
(32, 30, '2024-04-16 03:57:50', '2024-04-16 03:57:50', NULL, 5),
(33, 31, '2024-04-16 03:57:50', '2024-04-16 03:57:50', NULL, 5),
(34, 27, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(35, 28, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(36, 29, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(37, 30, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(38, 31, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(39, 32, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(40, 36, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(41, 37, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(42, 38, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(43, 41, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(44, 43, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(45, 46, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(46, 47, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(47, 197, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(48, 198, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(49, 199, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(50, 200, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(51, 201, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(52, 202, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(53, 203, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(54, 204, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(55, 205, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(56, 206, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(57, 207, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(58, 208, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(59, 209, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(60, 210, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(61, 211, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(62, 212, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(63, 213, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(64, 214, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(65, 215, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(66, 216, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(67, 217, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(68, 218, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(69, 219, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(70, 220, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(71, 221, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(72, 222, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(73, 223, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(74, 224, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(75, 225, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(76, 226, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(77, 227, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(78, 228, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(79, 229, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(80, 230, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(81, 231, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(82, 232, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(83, 233, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(84, 234, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(85, 235, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(86, 236, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(87, 237, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(88, 238, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(89, 239, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(90, 240, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(91, 241, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(92, 242, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(93, 243, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(94, 244, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(95, 245, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4),
(96, 246, '2024-04-16 04:04:16', '2024-04-16 04:04:16', NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `employee_roles`
--

CREATE TABLE `employee_roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `employee_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `employee_roles`
--

INSERT INTO `employee_roles` (`id`, `employee_id`, `role_id`, `created_at`, `updated_at`, `deleted_at`, `user_id`) VALUES
(52, 29, 8, '2024-03-25 13:35:19', '2024-03-25 13:35:26', '2024-03-25 13:35:26', 38),
(53, 29, 9, '2024-03-25 13:35:19', '2024-03-25 13:35:26', '2024-03-25 13:35:26', 38),
(57, 31, 8, '2024-03-25 13:37:30', '2024-03-25 14:06:01', '2024-03-25 14:06:01', 40),
(58, 31, 11, '2024-03-25 13:37:30', '2024-03-25 14:06:01', '2024-03-25 14:06:01', 40),
(88, 32, 8, '2024-04-01 11:10:26', '2024-04-01 11:10:26', NULL, 41),
(89, 32, 9, '2024-04-01 11:10:26', '2024-04-01 11:10:26', NULL, 41),
(90, 32, 11, '2024-04-01 11:10:26', '2024-04-01 11:10:26', NULL, 41),
(91, 36, 8, '2024-04-01 11:33:07', '2024-04-01 11:33:07', NULL, 45),
(92, 36, 9, '2024-04-01 11:33:07', '2024-04-01 11:33:07', NULL, 45),
(93, 36, 11, '2024-04-01 11:33:07', '2024-04-01 11:33:07', NULL, 45),
(99, 41, 8, '2024-04-11 06:14:49', '2024-04-11 06:14:49', NULL, 50),
(100, 41, 11, '2024-04-11 06:14:49', '2024-04-11 06:14:49', NULL, 50),
(101, 42, 8, '2024-04-11 10:20:20', '2024-04-11 10:20:20', NULL, 51),
(102, 42, 10, '2024-04-11 10:20:20', '2024-04-11 10:20:20', NULL, 51),
(103, 42, 11, '2024-04-11 10:20:20', '2024-04-11 10:20:20', NULL, 51),
(104, 43, 8, '2024-04-11 10:39:13', '2024-04-11 10:39:13', NULL, 52),
(105, 43, 11, '2024-04-11 10:39:13', '2024-04-11 10:39:13', NULL, 52),
(113, 46, 8, '2024-04-12 02:40:57', '2024-04-12 02:40:57', NULL, 55),
(114, 46, 11, '2024-04-12 02:40:57', '2024-04-12 02:40:57', NULL, 55),
(118, 47, 10, '2024-04-12 07:45:40', '2024-04-12 07:45:40', NULL, 56),
(119, 47, 11, '2024-04-12 07:45:40', '2024-04-12 07:45:40', NULL, 56),
(150, 151, 9, '2024-04-13 19:13:08', '2024-04-13 19:13:08', NULL, 163),
(151, 152, 11, '2024-04-13 19:13:08', '2024-04-13 19:13:08', NULL, 164),
(152, 152, 8, '2024-04-13 19:13:08', '2024-04-13 19:13:08', NULL, 164),
(153, 153, 11, '2024-04-13 19:13:09', '2024-04-13 19:13:09', NULL, 165),
(154, 154, 11, '2024-04-13 19:13:09', '2024-04-13 19:13:09', NULL, 166),
(155, 155, 11, '2024-04-13 19:13:10', '2024-04-13 19:13:10', NULL, 167),
(156, 155, 8, '2024-04-13 19:13:10', '2024-04-13 19:13:10', NULL, 167),
(157, 156, 11, '2024-04-13 19:13:11', '2024-04-13 19:13:11', NULL, 168),
(158, 160, 11, '2024-04-13 19:13:13', '2024-04-13 19:13:13', NULL, 172),
(159, 165, 11, '2024-04-13 19:13:17', '2024-04-13 19:13:17', NULL, 177),
(160, 165, 8, '2024-04-13 19:13:17', '2024-04-13 19:13:17', NULL, 177),
(161, 171, 11, '2024-04-13 19:13:22', '2024-04-13 19:13:22', NULL, 183),
(162, 171, 8, '2024-04-13 19:13:22', '2024-04-13 19:13:22', NULL, 183),
(163, 175, 11, '2024-04-13 19:13:25', '2024-04-13 19:13:25', NULL, 187),
(164, 175, 8, '2024-04-13 19:13:25', '2024-04-13 19:13:25', NULL, 187),
(165, 183, 11, '2024-04-13 19:13:31', '2024-04-13 19:13:31', NULL, 195),
(166, 184, 11, '2024-04-13 19:13:31', '2024-04-13 19:13:31', NULL, 196),
(167, 185, 11, '2024-04-13 19:13:32', '2024-04-13 19:13:32', NULL, 197),
(168, 187, 11, '2024-04-13 19:13:33', '2024-04-13 19:13:33', NULL, 199),
(169, 189, 11, '2024-04-13 19:13:35', '2024-04-13 19:13:35', NULL, 201),
(170, 190, 11, '2024-04-13 19:13:36', '2024-04-13 19:13:36', NULL, 202),
(173, 159, 8, '2024-04-13 19:20:41', '2024-04-13 19:20:41', NULL, 171),
(174, 159, 11, '2024-04-13 19:20:41', '2024-04-13 19:20:41', NULL, 171),
(175, 157, 11, '2024-04-13 19:31:51', '2024-04-13 19:31:51', NULL, 169),
(176, 204, 11, '2024-04-14 09:15:06', '2024-04-14 09:15:06', NULL, 216),
(177, 205, 11, '2024-04-14 09:15:06', '2024-04-14 09:15:06', NULL, 217),
(178, 206, 11, '2024-04-14 09:15:07', '2024-04-14 09:15:07', NULL, 218),
(179, 208, 11, '2024-04-14 09:15:08', '2024-04-14 09:15:08', NULL, 220),
(180, 209, 9, '2024-04-14 09:20:48', '2024-04-14 09:20:48', NULL, 221),
(181, 210, 11, '2024-04-14 09:20:49', '2024-04-14 09:20:49', NULL, 222),
(182, 210, 8, '2024-04-14 09:20:49', '2024-04-14 09:20:49', NULL, 222),
(183, 211, 11, '2024-04-14 09:20:49', '2024-04-14 09:20:49', NULL, 223),
(184, 212, 11, '2024-04-14 09:20:50', '2024-04-14 09:20:50', NULL, 224),
(185, 213, 11, '2024-04-14 09:20:50', '2024-04-14 09:20:50', NULL, 225),
(186, 213, 8, '2024-04-14 09:20:50', '2024-04-14 09:20:50', NULL, 225),
(187, 214, 11, '2024-04-14 09:20:51', '2024-04-14 09:20:51', NULL, 226),
(188, 218, 11, '2024-04-14 09:20:53', '2024-04-14 09:20:53', NULL, 230),
(189, 223, 11, '2024-04-14 09:20:55', '2024-04-14 09:20:55', NULL, 235),
(190, 223, 8, '2024-04-14 09:20:55', '2024-04-14 09:20:55', NULL, 235),
(191, 229, 11, '2024-04-14 09:20:57', '2024-04-14 09:20:57', NULL, 241),
(192, 229, 8, '2024-04-14 09:20:57', '2024-04-14 09:20:57', NULL, 241),
(193, 233, 11, '2024-04-14 09:20:59', '2024-04-14 09:20:59', NULL, 245),
(194, 233, 8, '2024-04-14 09:20:59', '2024-04-14 09:20:59', NULL, 245),
(195, 238, 11, '2024-04-14 09:21:01', '2024-04-14 09:21:01', NULL, 250),
(196, 239, 11, '2024-04-14 09:21:02', '2024-04-14 09:21:02', NULL, 251),
(201, 203, 8, '2024-04-14 09:30:28', '2024-04-14 09:30:28', NULL, 215),
(202, 203, 11, '2024-04-14 09:30:28', '2024-04-14 09:30:28', NULL, 215),
(205, 246, 8, '2024-04-14 23:27:39', '2024-04-14 23:27:39', NULL, 258),
(206, 246, 10, '2024-04-14 23:27:39', '2024-04-14 23:27:39', NULL, 258),
(207, 246, 11, '2024-04-14 23:27:39', '2024-04-14 23:27:39', NULL, 258),
(208, 27, 8, '2024-04-14 23:27:49', '2024-04-14 23:27:49', NULL, 36),
(209, 27, 10, '2024-04-14 23:27:49', '2024-04-14 23:27:49', NULL, 36),
(210, 27, 11, '2024-04-14 23:27:49', '2024-04-14 23:27:49', NULL, 36),
(211, 242, 10, '2024-04-14 23:28:05', '2024-04-14 23:28:05', NULL, 254);

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE `group` (
  `id` int(10) UNSIGNED NOT NULL,
  `group_name` varchar(355) NOT NULL,
  `division_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`id`, `group_name`, `division_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'Backend engineering', 6, '2024-02-20 11:37:24', '2024-02-20 16:36:33', NULL),
(4, 'Frontend engineering', 6, '2024-02-20 11:43:47', '2024-02-20 11:44:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `intervention_attendance`
--

CREATE TABLE `intervention_attendance` (
  `id` int(10) UNSIGNED NOT NULL,
  `intervention_id` int(10) UNSIGNED NOT NULL,
  `employee_id` int(10) UNSIGNED DEFAULT NULL,
  `line_manager_id` int(10) UNSIGNED NOT NULL,
  `attendance_date` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `intervention_class`
--

CREATE TABLE `intervention_class` (
  `id` int(5) UNSIGNED NOT NULL,
  `intervention_id` int(5) UNSIGNED DEFAULT NULL,
  `class_name` varchar(150) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `venue` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `intervention_class`
--

INSERT INTO `intervention_class` (`id`, `intervention_id`, `class_name`, `start_date`, `end_date`, `venue`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, 'Intro to Architecture', '2024-04-15', '2024-04-18', 'Gwarinpasss', '2024-04-15 00:46:11', '2024-04-15 13:43:12', NULL),
(3, 4, 'Intro to Architecture', '2024-04-15', '2024-04-17', 'Gwarinpa', '2024-04-15 05:32:49', '2024-04-15 05:32:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `intervention_content`
--

CREATE TABLE `intervention_content` (
  `id` int(5) UNSIGNED NOT NULL,
  `intervention_id` int(10) UNSIGNED NOT NULL,
  `module_title` varchar(100) NOT NULL,
  `sub_topic` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `intervention_content`
--

INSERT INTO `intervention_content` (`id`, `intervention_id`, `module_title`, `sub_topic`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, 'Introduction to Software Engneering', 'Software Development Life Cycle', '2024-04-16 01:12:37', '2024-04-16 01:12:37', NULL),
(2, 4, 'Introduction to Software Engneering', 'Software Development Life Cycle', '2024-04-16 01:13:18', '2024-04-16 02:06:09', '2024-04-16 02:06:09'),
(3, 4, 'Introduction to Software Engneerings', 'Software Development Life Cycle', '2024-04-16 02:03:59', '2024-04-16 02:03:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `intervention_type`
--

CREATE TABLE `intervention_type` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `intervention_type`
--

INSERT INTO `intervention_type` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Virtual', '2024-04-14 19:03:38', '2024-04-14 19:21:00', '2024-04-14 19:21:00'),
(2, 'Virtual', '2024-04-14 19:48:10', '2024-04-14 19:48:10', NULL),
(3, 'In-Person', '2024-04-14 19:48:30', '2024-04-14 19:48:30', NULL),
(4, 'Asynchronous E-Learning', '2024-04-14 19:49:02', '2024-04-14 19:49:02', NULL),
(5, 'Blended Learning', '2024-04-14 19:49:19', '2024-04-14 19:49:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `intervention_vendor`
--

CREATE TABLE `intervention_vendor` (
  `id` int(10) UNSIGNED NOT NULL,
  `vendor_name` varchar(255) NOT NULL,
  `contact_person` varchar(100) NOT NULL,
  `contact_email` varchar(150) DEFAULT NULL,
  `contact_phone` varchar(15) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `intervention_id` int(10) UNSIGNED DEFAULT NULL,
  `service_provided` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `intervention_vendor`
--

INSERT INTO `intervention_vendor` (`id`, `vendor_name`, `contact_person`, `contact_email`, `contact_phone`, `created_at`, `updated_at`, `deleted_at`, `intervention_id`, `service_provided`) VALUES
(1, 'Ahmad Sharafudeen', 'Rofee\'ah AbdurRahman', 'asharafudeenraji@gmail.com', '07066402941', NULL, '2024-04-14 20:06:36', NULL, NULL, NULL),
(2, 'Kamilu', 'Sadeeq', 'kamilu@gmail.com', '08030735791', '2024-04-14 20:11:11', '2024-04-14 20:13:42', '2024-04-14 20:13:42', NULL, NULL),
(3, 'KhemShield', 'Kareem Adamu', 'kareem.adamu@buk.edu.ng', '08030735791', '2024-04-15 00:00:35', '2024-04-15 00:03:26', NULL, 4, 'Cyber Security Services'),
(4, 'KhemShieldss', 'Mansur Babagana', 'mbabagana.cs@buk.edu.ng', '08030735791', '2024-04-15 00:04:01', '2024-04-15 00:04:01', NULL, 4, 'Security Services');

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `id` int(10) UNSIGNED NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `qualifications` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`id`, `job_title`, `qualifications`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 'Software Engineer', '- Bachelor\'s degree in Computer Science or Software Engineering', '2024-02-25 06:53:01', '2024-02-25 06:53:01', NULL),
(5, 'Talent Manager', '- Human Resources Management\r\n- Communocation skills', '2024-02-26 14:50:55', '2024-02-26 14:50:55', NULL),
(9, 'Admin', '', '2024-04-13 18:55:20', '2024-04-13 18:55:20', NULL),
(10, 'Staff', '', '2024-04-13 18:55:26', '2024-04-13 18:55:26', NULL),
(11, 'Manager', '', '2024-04-13 18:55:32', '2024-04-13 18:55:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `job_competencies`
--

CREATE TABLE `job_competencies` (
  `job_id` int(10) UNSIGNED NOT NULL,
  `competency_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `job_competencies`
--

INSERT INTO `job_competencies` (`job_id`, `competency_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 3, '2024-03-14 17:15:11', '2024-04-12 02:44:55', '2024-04-12 02:44:55'),
(5, 2, '2024-03-14 17:15:11', '2024-04-12 02:44:55', '2024-04-12 02:44:55'),
(4, 5, '2024-04-02 14:34:43', '2024-04-13 19:33:01', '2024-04-13 19:33:01'),
(4, 4, '2024-04-02 14:34:43', '2024-04-13 19:33:01', '2024-04-13 19:33:01'),
(4, 3, '2024-04-02 14:34:43', '2024-04-13 19:33:01', '2024-04-13 19:33:01'),
(5, 8, '2024-04-12 02:44:55', '2024-04-14 09:43:48', '2024-04-14 09:43:48'),
(5, 7, '2024-04-12 02:44:55', '2024-04-14 09:43:48', '2024-04-14 09:43:48'),
(5, 6, '2024-04-12 02:44:55', '2024-04-14 09:43:48', '2024-04-14 09:43:48'),
(5, 3, '2024-04-12 02:44:55', '2024-04-14 09:43:48', '2024-04-14 09:43:48'),
(4, 8, '2024-04-13 19:33:01', '2024-04-14 09:32:11', '2024-04-14 09:32:11'),
(4, 5, '2024-04-13 19:33:01', '2024-04-14 09:32:11', '2024-04-14 09:32:11'),
(4, 4, '2024-04-13 19:33:01', '2024-04-14 09:32:11', '2024-04-14 09:32:11'),
(4, 3, '2024-04-13 19:33:01', '2024-04-14 09:32:11', '2024-04-14 09:32:11'),
(11, 7, '2024-04-13 19:52:10', '2024-04-13 19:52:10', NULL),
(11, 2, '2024-04-13 19:52:10', '2024-04-13 19:52:10', NULL),
(9, 8, '2024-04-13 19:52:24', '2024-04-13 19:52:24', NULL),
(10, 1, '2024-04-13 19:52:39', '2024-04-13 19:52:39', NULL),
(4, 9, '2024-04-14 09:32:11', '2024-04-14 09:32:11', NULL),
(4, 8, '2024-04-14 09:32:11', '2024-04-14 09:32:11', NULL),
(4, 5, '2024-04-14 09:32:11', '2024-04-14 09:32:11', NULL),
(4, 4, '2024-04-14 09:32:11', '2024-04-14 09:32:11', NULL),
(4, 3, '2024-04-14 09:32:11', '2024-04-14 09:32:11', NULL),
(5, 8, '2024-04-14 09:43:48', '2024-04-14 09:43:48', NULL),
(5, 7, '2024-04-14 09:43:48', '2024-04-14 09:43:48', NULL),
(5, 6, '2024-04-14 09:43:48', '2024-04-14 09:43:48', NULL),
(5, 3, '2024-04-14 09:43:48', '2024-04-14 09:43:48', NULL),
(5, 2, '2024-04-14 09:43:48', '2024-04-14 09:43:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `learning_intervention`
--

CREATE TABLE `learning_intervention` (
  `id` int(10) UNSIGNED NOT NULL,
  `cycle_id` int(10) UNSIGNED NOT NULL,
  `intervention_type_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `cost` float DEFAULT 0,
  `trainer_id` int(10) UNSIGNED DEFAULT NULL,
  `competency_id` int(10) UNSIGNED DEFAULT NULL,
  `intervention_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `learning_intervention`
--

INSERT INTO `learning_intervention` (`id`, `cycle_id`, `intervention_type_id`, `created_at`, `updated_at`, `deleted_at`, `cost`, `trainer_id`, `competency_id`, `intervention_name`) VALUES
(4, 1, 2, '2024-04-14 23:36:07', '2024-04-16 02:14:05', NULL, 600000, 47, 2, 'Design Basics'),
(5, 6, 3, '2024-04-16 00:41:30', '2024-04-16 02:16:54', NULL, 56000, 27, 3, 'Practical Problem Solving'),
(7, 6, 3, '2024-04-16 00:47:35', '2024-04-16 02:13:10', NULL, 3435, 27, 1, 'AWS Learning');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2023-11-14-084158', 'App\\Database\\Migrations\\AddJob', 'default', 'App', 1706745206, 1),
(2, '2023-11-14-083901', 'App\\Database\\Migrations\\AddEmployee', 'default', 'App', 1706745213, 2),
(3, '2023-11-14-073745', 'App\\Database\\Migrations\\AddUser', 'default', 'App', 1706745238, 3),
(4, '2023-11-15-023348', 'App\\Database\\Migrations\\AddCompetency', 'default', 'App', 1706745329, 4),
(5, '2023-11-15-023646', 'App\\Database\\Migrations\\AddCompetencyDescriptor', 'default', 'App', 1706745349, 5),
(6, '2023-11-17-015400', 'App\\Database\\Migrations\\AddDevelopmentCycle', 'default', 'App', 1706745364, 6),
(7, '2023-11-17-022717', 'App\\Database\\Migrations\\AlterUserTable', 'default', 'App', 1706745377, 7),
(8, '2023-11-17-023137', 'App\\Database\\Migrations\\AlterEmployeeTable', 'default', 'App', 1706745388, 8),
(9, '2023-11-17-023308', 'App\\Database\\Migrations\\AlterCompetencyTable', 'default', 'App', 1706745402, 9),
(10, '2023-11-17-023456', 'App\\Database\\Migrations\\AlterCompetencyDescriptorTable', 'default', 'App', 1706745415, 10),
(11, '2023-11-17-023623', 'App\\Database\\Migrations\\AlterJobTable', 'default', 'App', 1706745430, 11),
(12, '2023-11-17-023814', 'App\\Database\\Migrations\\AddDevelopmentRating', 'default', 'App', 1706745444, 12),
(13, '2023-11-17-025557', 'App\\Database\\Migrations\\AddInterventionVendor', 'default', 'App', 1706745465, 13),
(14, '2023-11-17-030418', 'App\\Database\\Migrations\\AddInterventionType', 'default', 'App', 1706745476, 14),
(15, '2023-11-17-032438', 'App\\Database\\Migrations\\AddLearningIntervention', 'default', 'App', 1706745486, 15),
(16, '2023-11-17-032618', 'App\\Database\\Migrations\\AddInterventionAttendance', 'default', 'App', 1706745501, 16),
(17, '2023-11-17-034201', 'App\\Database\\Migrations\\AlterEmployeeAddField', 'default', 'App', 1706745592, 17),
(18, '2023-11-17-034732', 'App\\Database\\Migrations\\AddUserRole', 'default', 'App', 1706745605, 18),
(19, '2023-11-17-040151', 'App\\Database\\Migrations\\AlterInterventionAttendance', 'default', 'App', 1706745618, 19),
(20, '2023-11-17-040424', 'App\\Database\\Migrations\\AlterUserRole', 'default', 'App', 1706745640, 20),
(21, '2023-11-17-040555', 'App\\Database\\Migrations\\AddParticipantFeedback', 'default', 'App', 1706745662, 21),
(22, '2023-11-17-041447', 'App\\Database\\Migrations\\AddSelectionIntervention', 'default', 'App', 1706745676, 22),
(23, '2024-01-06-014326', 'App\\Database\\Migrations\\DivisionsMigration', 'default', 'App', 1706745703, 23),
(24, '2024-01-06-014356', 'App\\Database\\Migrations\\GroupMigration', 'default', 'App', 1706745716, 24),
(25, '2024-01-06-014411', 'App\\Database\\Migrations\\DepartmentMigration', 'default', 'App', 1706745729, 25),
(27, '2024-01-06-014428', 'App\\Database\\Migrations\\UnitMigration', 'default', 'App', 1708194911, 26),
(28, '2024-02-17-143630', 'App\\Database\\Migrations\\AlterUserTable', 'default', 'App', 1708195120, 27),
(29, '2024-02-18-072348', 'App\\Database\\Migrations\\RemoveEmployeeIDColumnFromUser', 'default', 'App', 1708241128, 28),
(31, '2024-02-19-081454', 'App\\Database\\Migrations\\AlterUserAddusername', 'default', 'App', 1708330669, 30),
(32, '2024-02-18-115208', 'App\\Database\\Migrations\\UnitCompetency', 'default', 'App', 1708415405, 31),
(33, '2024-02-20-140803', 'App\\Database\\Migrations\\CreateJobCompetenciesTable', 'default', 'App', 1708438154, 32),
(34, '2024-02-20-171216', 'App\\Database\\Migrations\\AlterGroupTableAddUniqueTogether', 'default', 'App', 1708449458, 33),
(35, '2024-02-20-171230', 'App\\Database\\Migrations\\AlterDepartmentTableAddUniqueTogether', 'default', 'App', 1708449458, 33),
(36, '2024-02-20-171238', 'App\\Database\\Migrations\\AlterUnitTableAddUniqueTogether', 'default', 'App', 1708449458, 33),
(37, '2024-02-20-181425', 'App\\Database\\Migrations\\AlterJobAddUnitID', 'default', 'App', 1708454106, 34),
(38, '2024-02-20-182327', 'App\\Database\\Migrations\\AlterJobAddDepartmentID', 'default', 'App', 1708454106, 34),
(39, '2024-02-20-183238', 'App\\Database\\Migrations\\AlterCompetencyAddDescription', 'default', 'App', 1708454106, 34),
(40, '2024-02-24-013701', 'App\\Database\\Migrations\\AlterJobControllerAddTimeStamps', 'default', 'App', 1708738719, 35),
(41, '2024-02-25-080911', 'App\\Database\\Migrations\\AlterUserRoleTable', 'default', 'App', 1708849167, 36),
(42, '2024-02-25-082012', 'App\\Database\\Migrations\\CreateEmployeeRolesTable', 'default', 'App', 1708849297, 37),
(43, '2024-02-25-082535', 'App\\Database\\Migrations\\AlterRoleRemoveUserID', 'default', 'App', 1708849755, 38),
(44, '2024-02-25-084139', 'App\\Database\\Migrations\\AlterEmployeeRoleAddTimeStamp', 'default', 'App', 1708850579, 39),
(45, '2024-02-25-091714', 'App\\Database\\Migrations\\AlterEmployeeRoleTableAddUserID', 'default', 'App', 1708852887, 40),
(46, '2024-03-25-135838', 'App\\Database\\Migrations\\ModifyEmployee', 'default', 'App', 1711375453, 41),
(47, '2024-04-01-124619', 'App\\Database\\Migrations\\AlterEmployeeAddDeptId', 'default', 'App', 1711981168, 42),
(48, '2024-04-02-140525', 'App\\Database\\Migrations\\AlterDevCycleTable', 'default', 'App', 1712066980, 43),
(49, '2024-04-03-173245', 'App\\Database\\Migrations\\EmailTemplateMigration', 'default', 'App', 1712652195, 44),
(50, '2024-04-03-173245', 'App\\Database\\Migrations\\EmailTemplateMigrationSetup', 'default', 'App', 1712652684, 45),
(51, '2024-04-09-085750', 'App\\Database\\Migrations\\SiteSettingsMigration', 'default', 'App', 1712653600, 46),
(52, '2024-04-09-090804', 'App\\Database\\Migrations\\AlterEmailTemplate', 'default', 'App', 1712653779, 47),
(53, '2024-04-09-090818', 'App\\Database\\Migrations\\AlterSiteSettings', 'default', 'App', 1712653779, 47),
(54, '2024-04-03-173245', 'App\\Database\\Migrations\\EmailTemplate', 'default', 'App', 1712661927, 48),
(55, '2024-04-09-085750', 'App\\Database\\Migrations\\SiteSettings', 'default', 'App', 1712661927, 48),
(56, '2024-04-09-141155', 'App\\Database\\Migrations\\AlterEmailTemplateAddFrom', 'default', 'App', 1712672053, 49),
(57, '2024-04-12-084041', 'App\\Database\\Migrations\\AlterEmailTemplateAddFromName', 'default', 'App', 1712911303, 50),
(58, '2024-04-14-092431', 'App\\Database\\Migrations\\EmailLogsTable', 'default', 'App', 1713086729, 51),
(59, '2024-04-14-093215', 'App\\Database\\Migrations\\EmailLogsTableAlter', 'default', 'App', 1713087282, 52),
(60, '2024-04-14-115727', 'App\\Database\\Migrations\\AlterEmailLogAddUpdatedAt', 'default', 'App', 1713096334, 53),
(61, '2024-04-14-232250', 'App\\Database\\Migrations\\InterventionClasses', 'default', 'App', 1713137557, 54),
(62, '2024-04-14-232449', 'App\\Database\\Migrations\\AlterInterventionTable', 'default', 'App', 1713137558, 54),
(63, '2024-04-14-233621', 'App\\Database\\Migrations\\AlterInterventionTableAddCost', 'default', 'App', 1713137982, 55),
(64, '2024-04-14-234002', 'App\\Database\\Migrations\\AlterInterventionClasses', 'default', 'App', 1713138054, 56),
(65, '2024-04-14-234623', 'App\\Database\\Migrations\\InterventionContentNew', 'default', 'App', 1713138488, 57),
(66, '2024-04-15-000415', 'App\\Database\\Migrations\\AlterInterventionTableRenameVendor', 'default', 'App', 1713139968, 58),
(67, '2024-04-15-004045', 'App\\Database\\Migrations\\AlterInterventionVendor', 'default', 'App', 1713141742, 59),
(68, '2024-04-15-005414', 'App\\Database\\Migrations\\AlterInterventionVendorAddField', 'default', 'App', 1713142563, 60),
(69, '2024-04-16-012559', 'App\\Database\\Migrations\\AlterLearningInterventionAddField', 'default', 'App', 1713230977, 61),
(70, '2024-04-16-015140', 'App\\Database\\Migrations\\EmployeeInterventionMappingTable', 'default', 'App', 1713232594, 62),
(71, '2024-04-16-030019', 'App\\Database\\Migrations\\AlterLearningInterventionAddName', 'default', 'App', 1713236501, 63),
(72, '2024-04-16-030337', 'App\\Database\\Migrations\\AlterLearningInterventionAddInterventionName', 'default', 'App', 1713236678, 64),
(73, '2024-04-16-034137', 'App\\Database\\Migrations\\AlterEmployeeInterventionModifyIntervention', 'default', 'App', 1713239191, 65);

-- --------------------------------------------------------

--
-- Table structure for table `participant_feedback`
--

CREATE TABLE `participant_feedback` (
  `id` int(10) UNSIGNED NOT NULL,
  `intervention_id` int(10) UNSIGNED NOT NULL,
  `employee_id` int(10) UNSIGNED NOT NULL,
  `feedback_text` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(8, 'LineManager', NULL, NULL, NULL),
(9, 'LDM', NULL, NULL, NULL),
(10, 'Trainer', NULL, NULL, NULL),
(11, 'Employee', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `selected_intervention`
--

CREATE TABLE `selected_intervention` (
  `id` int(10) UNSIGNED NOT NULL,
  `intervention_id` int(10) UNSIGNED NOT NULL,
  `employee_id` int(10) UNSIGNED NOT NULL,
  `competency_id` int(10) UNSIGNED NOT NULL,
  `cycle_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `logo` varchar(350) DEFAULT NULL,
  `company_address` text NOT NULL,
  `primary_color` varchar(10) DEFAULT NULL,
  `secondary_color` varchar(10) DEFAULT NULL,
  `background_color` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `company_name`, `logo`, `company_address`, `primary_color`, `secondary_color`, `background_color`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'AFIL', NULL, 'Central Busines District, Abuja', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `id` int(10) UNSIGNED NOT NULL,
  `unit_name` varchar(355) NOT NULL,
  `department_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`id`, `unit_name`, `department_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Backend', 3, '2024-02-20 11:53:15', '2024-02-20 11:53:15', NULL),
(2, 'Backendss', 3, '2024-02-20 12:43:44', '2024-02-20 12:44:54', '2024-02-20 12:44:54'),
(3, 'Backendss', 3, '2024-02-20 12:45:07', '2024-02-20 12:45:07', NULL),
(4, 'Project Management', 8, '2024-04-02 07:54:36', '2024-04-02 07:55:50', NULL),
(5, 'Interior Decor', 8, '2024-04-02 07:55:06', '2024-04-02 07:55:06', NULL),
(6, 'recruitment', 9, NULL, NULL, NULL),
(7, 'Accounting', 9, NULL, NULL, NULL),
(8, 'Compliance', 10, '2024-04-13 19:48:43', '2024-04-13 19:48:43', NULL),
(9, 'Zoology', 8, '2024-04-13 19:49:12', '2024-04-13 19:49:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `unit_competency`
--

CREATE TABLE `unit_competency` (
  `id` int(10) UNSIGNED NOT NULL,
  `unit_id` int(10) UNSIGNED NOT NULL,
  `competency_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(300) NOT NULL,
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `first_name`, `last_name`, `created_at`, `updated_at`, `deleted_at`, `username`) VALUES
(36, 'ahmad.sharafudeen@gmail.com', '$2y$10$mzXvq7F5RM3h3vA0hy0mzu4wMjW25iUbfwAVwyi7r3fB/kp2bR07i', 'Ahmad', 'Sharafudeen', '2024-03-25 10:58:43', '2024-04-14 23:27:49', NULL, 'LD328136'),
(37, 'mbabagana.cs@buk.edu.ng', '$2y$10$ZEDwHMO75zSQgMnyxYF6.e2KB1ZHPKXnVkDEdTlEt49jVySIP0VdK', 'Mansur', 'Babagana', '2024-03-25 12:56:05', '2024-04-01 10:28:31', '2024-04-01 10:28:31', 'LD694592'),
(38, 'uambursa.It@buk.edu.ng', '$2y$10$aSUSJxub4uVFRTXbIA3WdOduQhltade38xEXhIkHpcJsnfteSZIi6', 'Faruk', 'Ambursa', '2024-03-25 13:35:19', '2024-03-25 14:05:54', NULL, 'LD757956'),
(39, 'rofeeah@gmail.com', '$2y$10$AS/8BGnQkjzDHR1/B/zgXOpUEd8L1ZM0.7NM60EEg.q2ZYcuRdcJy', 'Rofee\'ah', 'Juwon', '2024-03-25 13:36:27', '2024-04-01 10:31:54', '2024-04-01 10:31:54', 'LD414153'),
(40, 'muneer@gmail.com', '$2y$10$ZtSmXGCzq8DvSvV8kUc.WeyH6dlfIfCvJnqc96GripTmI8l6QEKd2', 'Muneeru', 'Kaamil', '2024-03-25 13:37:30', '2024-04-01 10:28:51', NULL, 'LD009074'),
(41, 'jumai@gmail.com', '$2y$10$UPkoL7kAmyRSn1cShaBzruxnWJMvG1dOFIazmoUT5vhWvP0NxlFM2', 'Jumai', 'Usman', '2024-03-26 11:46:46', '2024-04-01 11:10:26', NULL, 'LD095206'),
(45, 'asharafudeenraji@gmail.com', '$2y$10$8VElWwbD8BAAfa1W8iFObOfDHZIHWM64pMrn8.0M1iY44ufffJMne', 'Adeniyi', 'Sharafudeen', '2024-03-31 09:20:26', '2024-04-01 11:33:07', NULL, 'LD229330'),
(46, 'muideen@gmail.com', '$2y$10$VjNFPMZKbM.7NTwN03BeMeptbkAGdt93VHAlXI1WAcz1VzhL8GFvG', 'Muideen', 'Ojo', '2024-03-31 12:44:00', '2024-04-16 02:57:12', NULL, 'LD815879'),
(47, 'ojo@gmail.com', '$2y$10$LTt2uHnb7O5.eW8sJbQ5WOo4mDQALVpQVi2po9TIuqClpbVCX8HGi', 'Ojo', 'Abimbola', '2024-04-01 09:55:21', '2024-04-16 02:57:27', NULL, 'LD660182'),
(50, 'anike@gmail.com', '$2y$10$YYPjQ61lhxlUYeTqJFV8C.mCfM2cve/XTllvePmwynoBPk5fs4ntS', 'Anike', 'Rahman', '2024-04-11 06:14:49', '2024-04-11 06:14:49', NULL, 'LD053369'),
(52, 'jamiu@gmail.com', '$2y$10$rXCNts2HnyOmqI3IIMV4m.tuIl3EzZSHoNk4qkXWBCKSE.NHPEt6i', 'Jamiu', 'Adepate', '2024-04-11 10:39:12', '2024-04-11 10:39:12', NULL, 'LD866656'),
(55, 'hkakudi.cs@buk.edu.ng', '$2y$10$SK6gv.IurlrW.5Ahb8rW5uq3SMV4sD9mjamzg5tkzC9uB80BmYryy', 'Habeebah', 'Kakudi', '2024-04-11 10:54:55', '2024-04-12 02:40:57', NULL, 'LD588545'),
(56, 'yusuff.taiwo@gmail.com', '$2y$10$4PPEmXBAygaHYLR5be/OSOrv7T8rHC8Hdnuzu6Tboyk9GhJEjoZAK', 'Yusuf', 'Taiwo', '2024-04-12 07:44:38', '2024-04-12 07:45:40', NULL, 'LD936279'),
(209, 'jane45@example.com', '$2y$10$8obswhVbTk1veL/LgBa55uHA.41LQnI8s/jmEo2x51iFw2t/7bMmm', 'John', 'Smith', '2024-04-13 19:13:40', '2024-04-13 19:13:40', NULL, 'LD636753'),
(210, 'jane46@example.com', '$2y$10$bLJjG9LSLEsKLYTptA/sO.CmUJkTvFLlhlEL.2sUH36y3NfCeXgSS', 'Smith', 'Doe', '2024-04-13 19:13:41', '2024-04-13 19:13:41', NULL, 'LD618167'),
(211, 'john47@example.com', '$2y$10$ETzbQAQdge5qYkYy2HF2s.7z5vQXnQKUXkamOc7b59HB67NQAI3qa', 'Jane', 'Smith', '2024-04-13 19:13:42', '2024-04-13 19:13:42', NULL, 'LD227382'),
(212, 'john27@example.com', '$2y$10$wbPWTNJcUszHZZOV8.IPYOC82GzzBOOsfrd.1hpFoW87s7.VIJgYG', 'John', 'Smith', '2024-04-14 09:15:00', '2024-04-14 09:15:00', NULL, 'LD285753'),
(213, 'smith28@example.com', '$2y$10$cGvsl/roX.oua.JewBnwVedey.MrRSP2slSxIqEI3LunBLNd1fZ.G', 'Jane', 'Doe', '2024-04-14 09:15:04', '2024-04-14 09:15:04', NULL, 'LD922852'),
(214, 'john29@example.com', '$2y$10$kUHshwtc6qZetppgm3lZtOuQl3aS/jnLDW3j8CKnlmyC1fKC.KDEi', 'John', 'Smith', '2024-04-14 09:15:05', '2024-04-14 09:15:05', NULL, 'LD710877'),
(215, 'jane30@example.com', '$2y$10$iCu6s5HCVEqHIpv47PhJF.Komm7SzNSxSX59l6LHr6M4lKcnlJ6JW', 'John', 'Smith', '2024-04-14 09:15:05', '2024-04-14 09:30:28', NULL, 'LD289931'),
(216, 'john31@example.com', '$2y$10$/neU3EnTQ8LLdvhjezmdD.qz5bWvvYAOBc42cLkuvJ54.Ec32V2pC', 'Smith', 'Doe', '2024-04-14 09:15:06', '2024-04-14 09:15:06', NULL, 'LD863617'),
(217, 'jane32@example.com', '$2y$10$prSEelbhr5DpTmeZwyvKfeXVesNHf4oX7DK3v.mUnC9BcMV/XYFKe', 'Jane', 'Doe', '2024-04-14 09:15:06', '2024-04-14 09:15:06', NULL, 'LD643276'),
(218, 'smith33@example.com', '$2y$10$RP6uNdRfGBjXLNVeqY4n1uw6M8YQzkuvPyv5OOWaBNP8T5iPC6Sau', 'Jane', 'Smith', '2024-04-14 09:15:07', '2024-04-14 09:15:07', NULL, 'LD512245'),
(219, 'jane34@example.com', '$2y$10$PlS1e7LNMoQbXA8TpZ7NxOM54MCAVcgZj.TJeJhmwO3UPmYiQUwWy', 'Jane', 'Doe', '2024-04-14 09:15:07', '2024-04-14 09:15:07', NULL, 'LD656704'),
(220, 'jane35@example.com', '$2y$10$pwAXtWZdMZDepOY8S0CbaO0ZV7M8r.dXX9a7EIgxR7lvsKMoQYyny', 'Jane', 'Doe', '2024-04-14 09:15:08', '2024-04-14 09:15:08', NULL, 'LD757778'),
(221, 'smith48@example.com', '$2y$10$VVIdxozFQVRn7A6Y5ZIn..XIvQ9q0azzKJIVZhYGP33GxrILN5SzW', 'Jane', 'Doe', '2024-04-14 09:20:48', '2024-04-14 09:20:48', NULL, 'LD087509'),
(222, 'smith49@example.com', '$2y$10$IMnz5yu4AY9mYBAr2bb9Z.W2DWNuE8g29SJ8YJgPilpgymnVOEjmu', 'Jane', 'Doe', '2024-04-14 09:20:49', '2024-04-14 09:20:49', NULL, 'LD128154'),
(223, 'john1@example.com', '$2y$10$xf/CwA0qo3BUvnwMt/MWQeiCgEaPT5umn4XkEcxZXUDRg6oF5Zt8C', 'Jane', 'Doe', '2024-04-14 09:20:49', '2024-04-14 09:20:49', NULL, 'LD547178'),
(224, 'john2@example.com', '$2y$10$WYRihLOT/n9jqs6YPssc6unfba.vyqIL9kPQw9aw5QmVYnDxmMh4W', 'Jane', 'Doe', '2024-04-14 09:20:50', '2024-04-14 09:20:50', NULL, 'LD047143'),
(225, 'john3@example.com', '$2y$10$linTKPIzbwO3QZzGzfz4iOba//JbXsMLm8x1c0eM6gwAnVIHMYz02', 'John', 'Doe', '2024-04-14 09:20:50', '2024-04-14 09:20:50', NULL, 'LD441598'),
(226, 'john4@example.com', '$2y$10$iPB0pDs1U2wdPHxda0RopO2AfB.QDVn.wwcSPVfQKBucPz8WKlhy2', 'Jane', 'Doe', '2024-04-14 09:20:51', '2024-04-14 09:20:51', NULL, 'LD643021'),
(227, 'jane5@example.com', '$2y$10$My0EMbrBtxliDJOLi4LWHulbqrJFi15gvrPgY0SSDdZ.8s0NgzRJy', 'Jane', 'Doe', '2024-04-14 09:20:51', '2024-04-14 09:20:51', NULL, 'LD498190'),
(228, 'john6@example.com', '$2y$10$Yzy0gQHGiyoq2ABvjdqC0uFT0zUKWuSl0NfyQo1mqO19JA7uum9lS', 'Jane', 'Smith', '2024-04-14 09:20:52', '2024-04-14 09:20:52', NULL, 'LD994844'),
(229, 'smith7@example.com', '$2y$10$lU9KYWmHlnljWiO08a5ES.ZBNBFjep9Y6QSn6FUty/VaD0M86QYFi', 'Jane', 'Doe', '2024-04-14 09:20:52', '2024-04-14 09:20:52', NULL, 'LD933469'),
(230, 'jane8@example.com', '$2y$10$nYLhUFmrgFPDfSm2oWvmr.O50zUNZ0O22u7lmVkzZXrs14fRWjfKy', 'Jane', 'Doe', '2024-04-14 09:20:53', '2024-04-14 09:20:53', NULL, 'LD190161'),
(231, 'smith9@example.com', '$2y$10$75nwKesjLRaQKxmlT.IOjeC4znhUUGAkMXJEnPxqvxNOBx99aDO5.', 'John', 'Doe', '2024-04-14 09:20:53', '2024-04-14 09:20:53', NULL, 'LD550313'),
(232, 'john10@example.com', '$2y$10$eB15etK9Vhac9SKLtxNyuuATcXhqU1bmPoxh41Vrvro.07wEAJshO', 'Jane', 'Smith', '2024-04-14 09:20:53', '2024-04-14 09:20:53', NULL, 'LD164324'),
(233, 'john11@example.com', '$2y$10$EiCvoDJuSbBCgGX3s.Dcd..2zLNHuPg.1Nh4.w0YmUUtkIwSUy7Bq', 'Jane', 'Smith', '2024-04-14 09:20:54', '2024-04-14 09:20:54', NULL, 'LD025901'),
(234, 'john12@example.com', '$2y$10$FAJ.NLeOvCLx9G56nZSDHuTO06a3rpEbk2GuCWBkkJJJBRoGsDB4S', 'Smith', 'Doe', '2024-04-14 09:20:54', '2024-04-14 09:20:54', NULL, 'LD507332'),
(235, 'jane13@example.com', '$2y$10$HLmNPNnf6GmPHy2AJGH6S.IXVb32.JVl5qQoEACTuMbHVfxUzxa5y', 'Jane', 'Doe', '2024-04-14 09:20:55', '2024-04-14 09:20:55', NULL, 'LD041923'),
(236, 'jane14@example.com', '$2y$10$IoI4pr4TJ9W.38cnb1huFOnw73Vh3c5fop9tniPsFV/xDNA4dETsq', 'Smith', 'Doe', '2024-04-14 09:20:55', '2024-04-14 09:20:55', NULL, 'LD636053'),
(237, 'jane15@example.com', '$2y$10$IQX0D8hdGa7FqWOUhVuvNuFEToXnFv01Eg1YWCW/vMLON0D1n8fP2', 'Jane', 'Smith', '2024-04-14 09:20:56', '2024-04-14 09:20:56', NULL, 'LD457855'),
(238, 'smith16@example.com', '$2y$10$fHnu/MpwYw42C50Bnn9.tO97Ynp7JmY5A2yV3pot78B3BQFThs7qq', 'Smith', 'Doe', '2024-04-14 09:20:56', '2024-04-14 09:20:56', NULL, 'LD285227'),
(239, 'john17@example.com', '$2y$10$//Y5TbBk5uCr1Jj6rX/M/Od167u6o7Iee2uAxDk122nflDrtm4NO.', 'Smith', 'Doe', '2024-04-14 09:20:57', '2024-04-14 09:20:57', NULL, 'LD019439'),
(240, 'smith18@example.com', '$2y$10$evZT6r6E4hDs2v8qFDzdOu3FAwe9Yym1Tqep4P3gVnnE45pEpYiOG', 'John', 'Smith', '2024-04-14 09:20:57', '2024-04-14 09:20:57', NULL, 'LD155296'),
(241, 'jane19@example.com', '$2y$10$k5DDNE1k62c3X482Ev9amONbyJsiWFwdLRZVwLc/qSB1/MRjKw2hG', 'John', 'Doe', '2024-04-14 09:20:57', '2024-04-14 09:20:57', NULL, 'LD648546'),
(242, 'jane20@example.com', '$2y$10$3nhX3DOZVvYJFzleaKnuK.qFv51oCEZQ6aPT3vx3/0AnT/BUvNxl6', 'Smith', 'Doe', '2024-04-14 09:20:58', '2024-04-14 09:20:58', NULL, 'LD275065'),
(243, 'john21@example.com', '$2y$10$.U1JrrsOH3xuoOWi122W0..VAWLzqHV8O6RwhxgEfTltpFFTcebXW', 'Smith', 'Smith', '2024-04-14 09:20:58', '2024-04-14 09:20:58', NULL, 'LD013990'),
(244, 'jane22@example.com', '$2y$10$sUISaDe0W.IWFTDJPRMFLeptpzFS2flVIvfzFhxBAOgwxl0ZhsD8O', 'John', 'Smith', '2024-04-14 09:20:59', '2024-04-14 09:20:59', NULL, 'LD304461'),
(245, 'jane23@example.com', '$2y$10$Paf7nS/sQLezrqoyiLOf.e6GrsYMjaugfjy0QWv6aS3Bf3CNw3Iay', 'Smith', 'Smith', '2024-04-14 09:20:59', '2024-04-14 09:20:59', NULL, 'LD030941'),
(246, 'jane24@example.com', '$2y$10$w59dqa9rbcyy/28xUXcDc.MElElZkdx8uC6FX3fvHMBxNsjTeH5d2', 'Smith', 'Doe', '2024-04-14 09:21:00', '2024-04-14 09:21:00', NULL, 'LD556524'),
(247, 'jane25@example.com', '$2y$10$Px4nkyodV/XQ3x/KAo4LC.hMpFgJYWM4G7yZJao5IZsJmWosRK6sG', 'John', 'Doe', '2024-04-14 09:21:00', '2024-04-14 09:21:00', NULL, 'LD561889'),
(248, 'jane26@example.com', '$2y$10$JRG9cQK5Rq7LpmzEZYRrIuX6m4In2YkiOToVRoRIPaJjKugiZizAq', 'John', 'Smith', '2024-04-14 09:21:00', '2024-04-14 09:21:00', NULL, 'LD471872'),
(249, 'jane36@example.com', '$2y$10$55X0coUDW6Wt.C4JuzqeduylrZ4469DuMmkmXyyOLjVoqOsRp/Xpq', 'John', 'Doe', '2024-04-14 09:21:01', '2024-04-14 09:21:01', NULL, 'LD679199'),
(250, 'john37@example.com', '$2y$10$LE.WnYO2sVwAVz7EUSWcEOyLfxwq6UD5HBJRTFL17.5dG3JX1yWpu', 'Smith', 'Doe', '2024-04-14 09:21:01', '2024-04-14 09:21:01', NULL, 'LD461755'),
(251, 'jane38@example.com', '$2y$10$R0shj6rwpvYmaHVBQ8z9s.9iBDQkKc19GncJtVEFu1ynhcvaL96Ty', 'John', 'Smith', '2024-04-14 09:21:02', '2024-04-14 09:21:02', NULL, 'LD256845'),
(252, 'smith39@example.com', '$2y$10$Df.0Maxf3wmyS6p9ZTJCn.0jW4f6.VdSAHEOcaHIH63zlHmLUVrfS', 'Smith', 'Doe', '2024-04-14 09:21:02', '2024-04-14 09:21:02', NULL, 'LD328811'),
(253, 'jane40@example.com', '$2y$10$9CWjU2.YqKah63o6IZYOpeS85Rcgz.jHvN9KTuWxWR30Dqx.8f45e', 'John', 'Smith', '2024-04-14 09:21:03', '2024-04-14 09:21:03', NULL, 'LD033429'),
(254, 'john41@example.com', '$2y$10$x6PG/QDlbKOujVYhPMvkpeKWP7bMziOtTzgp.mI/.yqqpoQRvhXdW', 'John', 'Doe', '2024-04-14 09:21:03', '2024-04-14 23:28:05', NULL, 'LD487529'),
(255, 'smith42@example.com', '$2y$10$BGzoe31DJufXL9MLwFhmh.LjYoHYT0vWafBUnk9l.1jWK52sZ4zwW', 'Jane', 'Doe', '2024-04-14 09:21:04', '2024-04-14 09:21:04', NULL, 'LD657045'),
(256, 'smith43@example.com', '$2y$10$b7KiFrb8pW/oS9JGQSAHx.dZJDnSgJ2y3pZAXW0oC0BODFmt6fG3K', 'Jane', 'Smith', '2024-04-14 09:21:04', '2024-04-14 09:21:04', NULL, 'LD247922'),
(257, 'jane44@example.com', '$2y$10$EQ9.LyVYr0QXBL1EGGlgP.6fVNMKqONCX3UAku8NixHoRmtewZQW.', 'Jane', 'Smith', '2024-04-14 09:21:04', '2024-04-14 09:21:04', NULL, 'LD394436'),
(258, 'isa.chamo@buk.edu.ng', '$2y$10$gL2CquHQySrZ75LQ.fQnz.2hJfqdeA9iiURtcDh/kcYzPXAGCY5/6', 'Isa', 'Chamo', '2024-04-14 12:28:06', '2024-04-14 23:27:39', NULL, 'LD576071');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `competency`
--
ALTER TABLE `competency`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `competency_name` (`competency_name`);

--
-- Indexes for table `competency_descriptor`
--
ALTER TABLE `competency_descriptor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `competency_descriptor_competency_id_foreign` (`competency_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_group_id_foreign` (`group_id`);

--
-- Indexes for table `development_cycle`
--
ALTER TABLE `development_cycle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `development_rating`
--
ALTER TABLE `development_rating`
  ADD PRIMARY KEY (`id`),
  ADD KEY `development_rating_employee_id_foreign` (`employee_id`),
  ADD KEY `development_rating_competency_id_foreign` (`competency_id`),
  ADD KEY `development_rating_cycle_id_foreign` (`cycle_id`);

--
-- Indexes for table `division`
--
ALTER TABLE `division`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_logs`
--
ALTER TABLE `email_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_template`
--
ALTER TABLE `email_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_job_id_foreign` (`job_id`);

--
-- Indexes for table `employee_interventions`
--
ALTER TABLE `employee_interventions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_roles`
--
ALTER TABLE `employee_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_roles_employee_id_foreign` (`employee_id`),
  ADD KEY `employee_roles_role_id_foreign` (`role_id`);

--
-- Indexes for table `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_division_id_foreign` (`division_id`);

--
-- Indexes for table `intervention_attendance`
--
ALTER TABLE `intervention_attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `intervention_attendance_intervention_id_foreign` (`intervention_id`),
  ADD KEY `intervention_attendance_employee_id_foreign` (`employee_id`),
  ADD KEY `intervention_attendance_line_manager_id_foreign` (`line_manager_id`);

--
-- Indexes for table `intervention_class`
--
ALTER TABLE `intervention_class`
  ADD PRIMARY KEY (`id`),
  ADD KEY `intervention_class_intervention_id_foreign` (`intervention_id`);

--
-- Indexes for table `intervention_content`
--
ALTER TABLE `intervention_content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `intervention_content_intervention_id_foreign` (`intervention_id`);

--
-- Indexes for table `intervention_type`
--
ALTER TABLE `intervention_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `intervention_vendor`
--
ALTER TABLE `intervention_vendor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_competencies`
--
ALTER TABLE `job_competencies`
  ADD KEY `job_competencies_job_id_foreign` (`job_id`),
  ADD KEY `job_competencies_competency_id_foreign` (`competency_id`);

--
-- Indexes for table `learning_intervention`
--
ALTER TABLE `learning_intervention`
  ADD PRIMARY KEY (`id`),
  ADD KEY `learning_intervention_cycle_id_foreign` (`cycle_id`),
  ADD KEY `learning_intervention_intervention_type_id_foreign` (`intervention_type_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `participant_feedback`
--
ALTER TABLE `participant_feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `participant_feedback_intervention_id_foreign` (`intervention_id`),
  ADD KEY `participant_feedback_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `selected_intervention`
--
ALTER TABLE `selected_intervention`
  ADD PRIMARY KEY (`id`),
  ADD KEY `selected_intervention_intervention_id_foreign` (`intervention_id`),
  ADD KEY `selected_intervention_employee_id_foreign` (`employee_id`),
  ADD KEY `selected_intervention_competency_id_foreign` (`competency_id`),
  ADD KEY `selected_intervention_cycle_id_foreign` (`cycle_id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `unit_department_id_foreign` (`department_id`);

--
-- Indexes for table `unit_competency`
--
ALTER TABLE `unit_competency`
  ADD PRIMARY KEY (`id`),
  ADD KEY `unit_competency_unit_id_foreign` (`unit_id`),
  ADD KEY `unit_competency_competency_id_foreign` (`competency_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `competency`
--
ALTER TABLE `competency`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `competency_descriptor`
--
ALTER TABLE `competency_descriptor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `development_cycle`
--
ALTER TABLE `development_cycle`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `development_rating`
--
ALTER TABLE `development_rating`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `division`
--
ALTER TABLE `division`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `email_logs`
--
ALTER TABLE `email_logs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT for table `email_template`
--
ALTER TABLE `email_template`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `employee_interventions`
--
ALTER TABLE `employee_interventions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `employee_roles`
--
ALTER TABLE `employee_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212;

--
-- AUTO_INCREMENT for table `group`
--
ALTER TABLE `group`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `intervention_attendance`
--
ALTER TABLE `intervention_attendance`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `intervention_class`
--
ALTER TABLE `intervention_class`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `intervention_content`
--
ALTER TABLE `intervention_content`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `intervention_type`
--
ALTER TABLE `intervention_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `intervention_vendor`
--
ALTER TABLE `intervention_vendor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `learning_intervention`
--
ALTER TABLE `learning_intervention`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `participant_feedback`
--
ALTER TABLE `participant_feedback`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `selected_intervention`
--
ALTER TABLE `selected_intervention`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `unit_competency`
--
ALTER TABLE `unit_competency`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=259;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `competency_descriptor`
--
ALTER TABLE `competency_descriptor`
  ADD CONSTRAINT `competency_descriptor_competency_id_foreign` FOREIGN KEY (`competency_id`) REFERENCES `competency` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `department_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `development_rating`
--
ALTER TABLE `development_rating`
  ADD CONSTRAINT `development_rating_competency_id_foreign` FOREIGN KEY (`competency_id`) REFERENCES `competency` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `development_rating_cycle_id_foreign` FOREIGN KEY (`cycle_id`) REFERENCES `development_cycle` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `development_rating_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `job` (`id`);

--
-- Constraints for table `employee_roles`
--
ALTER TABLE `employee_roles`
  ADD CONSTRAINT `employee_roles_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `employee_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `group`
--
ALTER TABLE `group`
  ADD CONSTRAINT `group_division_id_foreign` FOREIGN KEY (`division_id`) REFERENCES `division` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `intervention_attendance`
--
ALTER TABLE `intervention_attendance`
  ADD CONSTRAINT `intervention_attendance_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `intervention_attendance_intervention_id_foreign` FOREIGN KEY (`intervention_id`) REFERENCES `learning_intervention` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `intervention_attendance_line_manager_id_foreign` FOREIGN KEY (`line_manager_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `intervention_class`
--
ALTER TABLE `intervention_class`
  ADD CONSTRAINT `intervention_class_intervention_id_foreign` FOREIGN KEY (`intervention_id`) REFERENCES `learning_intervention` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `intervention_content`
--
ALTER TABLE `intervention_content`
  ADD CONSTRAINT `intervention_content_intervention_id_foreign` FOREIGN KEY (`intervention_id`) REFERENCES `learning_intervention` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `job_competencies`
--
ALTER TABLE `job_competencies`
  ADD CONSTRAINT `job_competencies_competency_id_foreign` FOREIGN KEY (`competency_id`) REFERENCES `competency` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `job_competencies_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `job` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `learning_intervention`
--
ALTER TABLE `learning_intervention`
  ADD CONSTRAINT `learning_intervention_cycle_id_foreign` FOREIGN KEY (`cycle_id`) REFERENCES `development_cycle` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `learning_intervention_intervention_type_id_foreign` FOREIGN KEY (`intervention_type_id`) REFERENCES `intervention_type` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `participant_feedback`
--
ALTER TABLE `participant_feedback`
  ADD CONSTRAINT `participant_feedback_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `participant_feedback_intervention_id_foreign` FOREIGN KEY (`intervention_id`) REFERENCES `learning_intervention` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `selected_intervention`
--
ALTER TABLE `selected_intervention`
  ADD CONSTRAINT `selected_intervention_competency_id_foreign` FOREIGN KEY (`competency_id`) REFERENCES `competency` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `selected_intervention_cycle_id_foreign` FOREIGN KEY (`cycle_id`) REFERENCES `development_cycle` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `selected_intervention_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `selected_intervention_intervention_id_foreign` FOREIGN KEY (`intervention_id`) REFERENCES `learning_intervention` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `unit`
--
ALTER TABLE `unit`
  ADD CONSTRAINT `unit_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `unit_competency`
--
ALTER TABLE `unit_competency`
  ADD CONSTRAINT `unit_competency_competency_id_foreign` FOREIGN KEY (`competency_id`) REFERENCES `competency` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `unit_competency_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
