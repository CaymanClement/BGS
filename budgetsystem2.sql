-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2018 at 07:56 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `budgetsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `approvals`
--

CREATE TABLE `approvals` (
  `id` int(10) UNSIGNED NOT NULL,
  `approving_user_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `budget_id` int(10) UNSIGNED NOT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Pending',
  `comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Pending',
  `forward_to` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `approvals`
--

INSERT INTO `approvals` (`id`, `approving_user_id`, `budget_id`, `category`, `status`, `comment`, `forward_to`, `created_at`, `updated_at`) VALUES
(47487, 6556793, 78503, 'Reviewed by:', 'Approved', 'OKAY', 'abdalla.mrisho@crdbbank.com', '2018-09-25 11:50:45', '2018-09-27 08:33:46'),
(47488, 6556794, 78503, 'Recommended for budget by:', 'Approved', 'n', 'ally.kichawelle@crdbbank.com', '2018-09-25 11:50:45', '2018-09-30 17:38:37'),
(47489, 6556795, 78503, 'Recommended for activity by:', 'Approved', 'Ahead', 'arthur.mosha@crdbbank.com', '2018-09-25 11:50:45', '2018-09-26 04:22:08'),
(47490, 6556796, 78503, 'Approved by:', 'Approved', 'Approved ok', '', '2018-09-25 11:50:45', '2018-09-26 04:23:04'),
(47491, 6556793, 78506, 'Reviewed by:', 'Reviewed', 'ok\r\n', 'abdalla.mrisho@crdbbank.com', '2018-09-26 06:46:16', '2018-10-22 06:39:28'),
(47492, 6556794, 78506, 'Recommended for budget by:', 'Recommended', 'Data corrected', 'binoy.swami@crdbbank.com', '2018-09-26 06:46:16', '2018-10-22 05:43:51'),
(47493, 0, 78506, 'Recommended for activity by:', 'Rejected', 'Pending', NULL, '2018-09-26 06:46:16', '2018-10-03 11:47:28'),
(47494, 6556796, 78506, 'Approved by:', 'Approved', 'passed', NULL, '2018-09-26 06:46:16', '2018-10-22 06:45:18'),
(47495, 6556793, 78505, 'Reviewed by:', 'Approved', 'Ck Proceed', 'abdalla.mrisho@crdbbank.com', '2018-09-27 08:16:36', '2018-09-27 09:02:15'),
(47496, 6556794, 78505, 'Recommended for budget by:', 'Approved', 'Go ahead', 'binoy.swami@crdbbank.com', '2018-09-27 08:16:36', '2018-09-27 09:03:32'),
(47497, 6556795, 78505, 'Recommended for activity by:', 'Approved', 'OK', 'arthur.mosha@crdbbank.com', '2018-09-27 08:16:36', '2018-09-27 09:04:20'),
(47498, 6556796, 78505, 'Approved by:', 'Approved', 'Okay', '', '2018-09-27 08:16:36', '2018-09-27 09:05:38'),
(47499, 6556793, 78507, 'Reviewed by:', 'Approved', 'Ok', 'abdalla.mrisho@crdbbank.com', '2018-10-04 09:52:10', '2018-10-04 09:54:59'),
(47500, 6556794, 78507, 'Recommended for budget by:', 'Approved', 'Proceed', 'binoy.swami@crdbbank.com', '2018-10-04 09:52:10', '2018-10-04 09:55:40'),
(47501, 6556795, 78507, 'Recommended for activity by:', 'Approved', 'Proceed', 'arthur.mosha@crdbbank.com', '2018-10-04 09:52:11', '2018-10-04 09:56:28'),
(47502, 6556796, 78507, 'Approved by:', 'Approved', 'OK', '', '2018-10-04 09:52:11', '2018-10-04 09:59:37'),
(47503, 6556793, 78508, 'Reviewed by:', 'Approved', 'ok', 'abdalla.mrisho@crdbbank.com', '2018-10-05 10:57:09', '2018-10-05 11:08:01'),
(47504, 6556794, 78508, 'Recommended for budget by:', 'Approved', 'ok ok', 'binoy.swami@crdbbank.com', '2018-10-05 10:57:09', '2018-10-05 11:10:02'),
(47505, 6556795, 78508, 'Recommended for activity by:', 'Approved', 'the activity plan needs futher reviews', 'arthur.mosha@crdbbank.com', '2018-10-05 10:57:09', '2018-10-05 11:11:09'),
(47506, 6556796, 78508, 'Approved by:', 'Approved', 'okay proceed', '', '2018-10-05 10:57:09', '2018-10-05 11:13:03'),
(47507, 0, 78509, 'Reviewed by:', 'Pending', 'Pending', NULL, '2018-10-07 17:10:32', NULL),
(47508, 0, 78509, 'Recommended for budget by:', 'Pending', 'Pending', NULL, '2018-10-07 17:10:32', NULL),
(47509, 0, 78509, 'Recommended for activity by:', 'Pending', 'Pending', NULL, '2018-10-07 17:10:32', NULL),
(47510, 0, 78509, 'Approved by:', 'Pending', 'Pending', NULL, '2018-10-07 17:10:32', NULL),
(47511, 0, 78510, 'Reviewed by:', 'Pending', 'Pending', NULL, '2018-10-07 17:12:29', NULL),
(47512, 0, 78510, 'Recommended for budget by:', 'Pending', 'Pending', NULL, '2018-10-07 17:12:29', NULL),
(47513, 0, 78510, 'Recommended for activity by:', 'Pending', 'Pending', NULL, '2018-10-07 17:12:30', NULL),
(47514, 0, 78510, 'Approved by:', 'Pending', 'Pending', NULL, '2018-10-07 17:12:30', NULL),
(47515, 0, 78511, 'Reviewed by:', 'Pending', 'Pending', NULL, '2018-10-07 17:13:37', NULL),
(47516, 0, 78511, 'Recommended for budget by:', 'Pending', 'Pending', NULL, '2018-10-07 17:13:37', NULL),
(47517, 0, 78511, 'Recommended for activity by:', 'Pending', 'Pending', NULL, '2018-10-07 17:13:37', NULL),
(47518, 0, 78511, 'Approved by:', 'Pending', 'Pending', NULL, '2018-10-07 17:13:37', NULL),
(47519, 0, 78512, 'Reviewed by:', 'Pending', 'Pending', NULL, '2018-10-07 17:16:32', NULL),
(47520, 0, 78512, 'Recommended for budget by:', 'Pending', 'Pending', NULL, '2018-10-07 17:16:33', NULL),
(47521, 0, 78512, 'Recommended for activity by:', 'Pending', 'Pending', NULL, '2018-10-07 17:16:33', NULL),
(47522, 0, 78512, 'Approved by:', 'Pending', 'Pending', NULL, '2018-10-07 17:16:33', NULL),
(47523, 0, 78513, 'Reviewed by:', 'Pending', 'Pending', NULL, '2018-10-07 17:18:10', NULL),
(47524, 0, 78513, 'Recommended for budget by:', 'Pending', 'Pending', NULL, '2018-10-07 17:18:10', NULL),
(47525, 0, 78513, 'Recommended for activity by:', 'Pending', 'Pending', NULL, '2018-10-07 17:18:10', NULL),
(47526, 0, 78513, 'Approved by:', 'Pending', 'Pending', NULL, '2018-10-07 17:18:10', NULL),
(47527, 0, 78516, 'Reviewed by:', 'Pending', 'Pending', NULL, '2018-10-08 10:10:41', NULL),
(47528, 0, 78516, 'Recommended for budget by:', 'Pending', 'Pending', NULL, '2018-10-08 10:10:41', NULL),
(47529, 0, 78516, 'Recommended for activity by:', 'Pending', 'Pending', NULL, '2018-10-08 10:10:41', NULL),
(47530, 0, 78516, 'Approved by:', 'Pending', 'Pending', NULL, '2018-10-08 10:10:41', NULL),
(47531, 0, 78517, 'Reviewed by:', 'Pending', 'Pending', NULL, '2018-10-08 10:51:08', NULL),
(47532, 0, 78517, 'Recommended for budget by:', 'Pending', 'Pending', NULL, '2018-10-08 10:51:08', NULL),
(47533, 0, 78517, 'Recommended for activity by:', 'Pending', 'Pending', NULL, '2018-10-08 10:51:08', NULL),
(47534, 0, 78517, 'Approved by:', 'Pending', 'Pending', NULL, '2018-10-08 10:51:08', NULL),
(47535, 0, 78518, 'Reviewed by:', 'Pending', 'Pending', NULL, '2018-10-09 05:13:45', NULL),
(47536, 0, 78518, 'Recommended for budget by:', 'Pending', 'Pending', NULL, '2018-10-09 05:13:45', NULL),
(47537, 0, 78518, 'Recommended for activity by:', 'Pending', 'Pending', NULL, '2018-10-09 05:13:45', NULL),
(47538, 0, 78518, 'Approved by:', 'Pending', 'Pending', NULL, '2018-10-09 05:13:45', NULL),
(47539, 6556793, 78519, 'Reviewed by:', 'Approved', 'Ok proceed', 'abdalla.mrisho@crdbbank.com', '2018-10-09 05:54:51', '2018-10-09 08:54:22'),
(47540, 0, 78519, 'Recommended for budget by:', 'Pending', 'Pending', NULL, '2018-10-09 05:54:51', NULL),
(47541, 0, 78519, 'Recommended for activity by:', 'Pending', 'Pending', NULL, '2018-10-09 05:54:51', NULL),
(47542, 0, 78519, 'Approved by:', 'Pending', 'Pending', NULL, '2018-10-09 05:54:52', NULL),
(47543, 6556793, 78520, 'Reviewed by:', 'Approved', 'ok proceed', 'abdalla.mrisho@crdbbank.com', '2018-10-09 08:25:17', '2018-10-09 09:16:02'),
(47544, 6556794, 78520, 'Recommended for budget by:', 'Approved', 'ok', 'binoy.swami@crdbbank.com', '2018-10-09 08:25:17', '2018-10-09 10:54:40'),
(47545, 6556795, 78520, 'Recommended for activity by:', 'Approved', 'Proceed', 'arthur.mosha@crdbbank.com', '2018-10-09 08:25:17', '2018-10-10 02:14:48'),
(47546, 0, 78520, 'Approved by:', 'Pending', 'Pending', NULL, '2018-10-09 08:25:17', NULL),
(47547, 0, 78521, 'Reviewed by:', 'Rejected', 'Pending', NULL, '2018-10-10 04:56:38', '2018-10-22 07:00:34'),
(47548, 0, 78521, 'Recommended for budget by:', 'Rejected', 'Pending', NULL, '2018-10-10 04:56:38', '2018-10-22 07:00:34'),
(47549, 0, 78521, 'Recommended for activity by:', 'Rejected', 'Pending', NULL, '2018-10-10 04:56:38', '2018-10-22 07:00:34'),
(47550, 6556796, 78521, 'Approved by:', 'Rejected', 'The activities are not for this quatre.\r\n', NULL, '2018-10-10 04:56:38', '2018-10-22 07:00:34'),
(47551, 6556793, 78522, 'Reviewed by:', 'Reviewed', 'ok', 'abdalla.mrisho@crdbbank.com', '2018-10-11 06:35:01', '2018-10-22 06:35:46'),
(47552, 6556794, 78522, 'Recommended for budget by:', 'Recommended', 'checked and corrected', 'binoy.swami@crdbbank.com', '2018-10-11 06:35:01', '2018-10-22 06:34:41'),
(47553, 6556795, 78522, 'Recommended for activity by:', 'Recommended', 'ok', 'arthur.mosha@crdbbank.com', '2018-10-11 06:35:01', '2018-10-22 06:32:17'),
(47554, 6556796, 78522, 'Approved by:', 'Returned', 'check', NULL, '2018-10-11 06:35:01', '2018-10-20 07:50:56'),
(47555, 6556793, 78523, 'Reviewed by:', 'Approved', 'Ok', 'abdalla.mrisho@crdbbank.com', '2018-10-11 09:34:26', '2018-10-11 09:38:32'),
(47556, 6556794, 78523, 'Recommended for budget by:', 'Approved', 'OK', 'binoy.swami@crdbbank.com', '2018-10-11 09:34:26', '2018-10-11 09:51:45'),
(47557, 6556795, 78523, 'Recommended for activity by:', 'Approved', 'Proceed', 'arthur.mosha@crdbbank.com', '2018-10-11 09:34:26', '2018-10-11 09:57:00'),
(47558, 6556796, 78523, 'Approved by:', 'Approved', 'OK', '', '2018-10-11 09:34:26', '2018-10-11 09:59:55'),
(47559, 0, 78524, 'Reviewed by:', 'Pending', 'Pending', NULL, '2018-10-16 12:47:14', NULL),
(47560, 0, 78524, 'Recommended for budget by:', 'Pending', 'Pending', NULL, '2018-10-16 12:47:15', NULL),
(47561, 0, 78524, 'Recommended for activity by:', 'Pending', 'Pending', NULL, '2018-10-16 12:47:15', NULL),
(47562, 0, 78524, 'Approved by:', 'Pending', 'Pending', NULL, '2018-10-16 12:47:15', NULL),
(47563, 0, 78525, 'Reviewed by:', 'Pending', 'Pending', NULL, '2018-10-16 12:50:21', NULL),
(47564, 0, 78525, 'Recommended for budget by:', 'Pending', 'Pending', NULL, '2018-10-16 12:50:21', NULL),
(47565, 0, 78525, 'Recommended for activity by:', 'Pending', 'Pending', NULL, '2018-10-16 12:50:21', NULL),
(47566, 0, 78525, 'Approved by:', 'Pending', 'Pending', NULL, '2018-10-16 12:50:21', NULL),
(47567, 0, 78526, 'Reviewed by:', 'Pending', 'Pending', NULL, '2018-10-16 12:55:00', NULL),
(47568, 0, 78526, 'Recommended for budget by:', 'Pending', 'Pending', NULL, '2018-10-16 12:55:00', NULL),
(47569, 0, 78526, 'Recommended for activity by:', 'Pending', 'Pending', NULL, '2018-10-16 12:55:00', NULL),
(47570, 0, 78526, 'Approved by:', 'Pending', 'Pending', NULL, '2018-10-16 12:55:00', NULL),
(47571, 0, 78527, 'Reviewed by:', 'Pending', 'Pending', NULL, '2018-10-17 05:31:38', NULL),
(47572, 0, 78527, 'Recommended for budget by:', 'Pending', 'Pending', NULL, '2018-10-17 05:31:38', NULL),
(47573, 0, 78527, 'Recommended for activity by:', 'Pending', 'Pending', NULL, '2018-10-17 05:31:38', NULL),
(47574, 0, 78527, 'Approved by:', 'Pending', 'Pending', NULL, '2018-10-17 05:31:38', NULL),
(47575, 0, 78528, 'Reviewed by:', 'Pending', 'Pending', NULL, '2018-10-17 05:42:38', NULL),
(47576, 0, 78528, 'Recommended for budget by:', 'Pending', 'Pending', NULL, '2018-10-17 05:42:38', NULL),
(47577, 0, 78528, 'Recommended for activity by:', 'Pending', 'Pending', NULL, '2018-10-17 05:42:38', NULL),
(47578, 0, 78528, 'Approved by:', 'Pending', 'Pending', NULL, '2018-10-17 05:42:38', NULL),
(47579, 0, 78529, 'Reviewed by:', 'Pending', 'Pending', NULL, '2018-10-17 05:44:17', NULL),
(47580, 0, 78529, 'Recommended for budget by:', 'Pending', 'Pending', NULL, '2018-10-17 05:44:17', NULL),
(47581, 0, 78529, 'Recommended for activity by:', 'Pending', 'Pending', NULL, '2018-10-17 05:44:17', NULL),
(47582, 0, 78529, 'Approved by:', 'Pending', 'Pending', NULL, '2018-10-17 05:44:17', NULL),
(47583, 0, 78530, 'Reviewed by:', 'Pending', 'Pending', NULL, '2018-10-17 05:57:04', NULL),
(47584, 0, 78530, 'Recommended for budget by:', 'Pending', 'Pending', NULL, '2018-10-17 05:57:04', NULL),
(47585, 0, 78530, 'Recommended for activity by:', 'Pending', 'Pending', NULL, '2018-10-17 05:57:04', NULL),
(47586, 0, 78530, 'Approved by:', 'Pending', 'Pending', NULL, '2018-10-17 05:57:04', NULL),
(47587, 0, 78531, 'Reviewed by:', 'Pending', 'Pending', NULL, '2018-10-17 06:08:31', NULL),
(47588, 0, 78531, 'Recommended for budget by:', 'Pending', 'Pending', NULL, '2018-10-17 06:08:31', NULL),
(47589, 0, 78531, 'Recommended for activity by:', 'Pending', 'Pending', NULL, '2018-10-17 06:08:31', NULL),
(47590, 0, 78531, 'Approved by:', 'Pending', 'Pending', NULL, '2018-10-17 06:08:31', NULL),
(47591, 0, 78532, 'Reviewed by:', 'Pending', 'Pending', NULL, '2018-10-17 06:52:25', NULL),
(47592, 0, 78532, 'Recommended for budget by:', 'Pending', 'Pending', NULL, '2018-10-17 06:52:25', NULL),
(47593, 0, 78532, 'Recommended for activity by:', 'Pending', 'Pending', NULL, '2018-10-17 06:52:25', NULL),
(47594, 0, 78532, 'Approved by:', 'Pending', 'Pending', NULL, '2018-10-17 06:52:25', NULL),
(47595, 0, 78533, 'Reviewed by:', 'Pending', 'Pending', NULL, '2018-10-17 08:12:41', NULL),
(47596, 0, 78533, 'Recommended for budget by:', 'Pending', 'Pending', NULL, '2018-10-17 08:12:41', NULL),
(47597, 0, 78533, 'Recommended for activity by:', 'Pending', 'Pending', NULL, '2018-10-17 08:12:41', NULL),
(47598, 0, 78533, 'Approved by:', 'Pending', 'Pending', NULL, '2018-10-17 08:12:41', NULL),
(47599, 6556793, 78534, 'Reviewed by:', 'Reviewed', 'Proceed', 'abdalla.mrisho@crdbbank.com', '2018-10-17 10:14:58', '2018-10-18 08:17:07'),
(47600, 6556794, 78534, 'Recommended for budget by:', 'Recommended', 'OK', 'binoy.swami@crdbbank.com', '2018-10-17 10:14:58', '2018-10-18 08:16:16'),
(47601, 6556795, 78534, 'Recommended for activity by:', 'Recommended', 'its ok proceed', 'arthur.mosha@crdbbank.com', '2018-10-17 10:14:58', '2018-10-18 08:17:48'),
(47602, 6556796, 78534, 'Approved by:', 'Approved', 'Ok', NULL, '2018-10-17 10:14:58', '2018-10-18 08:18:30'),
(47603, 0, 78535, 'Reviewed by:', 'Pending', 'Pending', NULL, '2018-10-23 02:55:03', NULL),
(47604, 0, 78535, 'Recommended for budget by:', 'Pending', 'Pending', NULL, '2018-10-23 02:55:03', NULL),
(47605, 0, 78535, 'Recommended for activity by:', 'Pending', 'Pending', NULL, '2018-10-23 02:55:03', NULL),
(47606, 0, 78535, 'Approved by:', 'Pending', 'Pending', NULL, '2018-10-23 02:55:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `approve_record`
--

CREATE TABLE `approve_record` (
  `record_id` int(10) UNSIGNED NOT NULL,
  `budget_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `balance`
--

CREATE TABLE `balance` (
  `balance_id` int(10) UNSIGNED NOT NULL,
  `budget_id` int(10) UNSIGNED NOT NULL,
  `total_cost` int(255) DEFAULT NULL,
  `actual_cost` int(11) NOT NULL DEFAULT '0',
  `resultant_balance` int(11) NOT NULL DEFAULT '0',
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Created',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `balance`
--

INSERT INTO `balance` (`balance_id`, `budget_id`, `total_cost`, `actual_cost`, `resultant_balance`, `status`, `created_at`, `updated_at`) VALUES
(4, 78503, 595000, 0, 0, 'Created', '2018-09-25 11:50:45', '2018-09-25 11:50:45'),
(5, 78504, 7855002, 0, 33333, 'Created', '2018-09-26 06:46:16', '2018-09-27 06:37:21'),
(6, 78505, 673400, 500000, 173400, 'Created', '2018-09-27 08:16:36', '2018-09-27 10:12:29'),
(7, 78506, 555000, 0, 50000, 'Created', '2018-10-01 05:03:48', '2018-10-17 10:22:44'),
(8, 78507, 1721766, 721766, 1000000, 'Created', '2018-10-04 09:52:11', '2018-10-04 10:08:29'),
(9, 78508, 765000, 500000, 265000, 'Created', '2018-10-05 10:57:09', '2018-10-05 11:17:18'),
(10, 78509, 1109000, 0, 0, 'Created', '2018-10-07 17:10:32', '2018-10-07 17:10:32'),
(11, 78510, 1109000, 0, 0, 'Created', '2018-10-07 17:12:30', '2018-10-07 17:12:30'),
(12, 78511, 1109000, 0, 0, 'Created', '2018-10-07 17:13:37', '2018-10-07 17:13:37'),
(13, 78512, 1702000, 0, 0, 'Created', '2018-10-07 17:16:33', '2018-10-07 17:16:33'),
(14, 78513, 1702000, 0, 0, 'Created', '2018-10-07 17:18:10', '2018-10-07 17:18:10'),
(15, 78516, 5, 0, 0, 'Created', '2018-10-08 10:10:41', '2018-10-08 10:10:41'),
(16, 78517, 1900000, 0, 0, 'Created', '2018-10-08 10:51:08', '2018-10-08 10:51:08'),
(17, 78518, 2506000, 0, 0, 'Created', '2018-10-09 05:13:45', '2018-10-09 05:13:45'),
(18, 78519, 90004, 0, 0, 'Created', '2018-10-09 05:54:52', '2018-10-09 06:48:51'),
(19, 78520, 6000000, 0, 0, 'Created', '2018-10-09 08:25:17', '2018-10-09 08:32:21'),
(20, 78521, 20502000, 0, 0, 'Created', '2018-10-10 04:56:38', '2018-10-10 09:30:02'),
(21, 78522, 7900000, 0, 0, 'Created', '2018-10-11 06:35:01', '2018-10-11 08:18:10'),
(22, 78523, 1955000, 500000, 1455000, 'Created', '2018-10-11 09:34:26', '2018-10-11 10:13:57'),
(23, 78524, 1186000, 0, 0, 'Created', '2018-10-16 12:47:15', '2018-10-16 12:47:15'),
(24, 78525, 1186000, 0, 0, 'Created', '2018-10-16 12:50:21', '2018-10-16 12:50:21'),
(25, 78526, 1186000, 0, 0, 'Created', '2018-10-16 12:55:01', '2018-10-16 12:55:01'),
(26, 78527, 5, 0, 0, 'Created', '2018-10-17 05:31:38', '2018-10-17 05:31:38'),
(27, 78528, 5, 0, 0, 'Created', '2018-10-17 05:42:38', '2018-10-17 05:42:38'),
(28, 78529, 5, 0, 0, 'Created', '2018-10-17 05:44:17', '2018-10-17 05:44:17'),
(29, 78530, 5, 0, 0, 'Created', '2018-10-17 05:57:04', '2018-10-17 05:57:04'),
(30, 78531, 5, 0, 0, 'Created', '2018-10-17 06:08:31', '2018-10-17 06:08:31'),
(31, 78532, 959000, 0, 0, 'Created', '2018-10-17 06:52:25', '2018-10-17 06:52:25'),
(32, 78533, 949000, 0, 0, 'Created', '2018-10-17 08:12:41', '2018-10-17 09:53:25'),
(33, 78534, 1009000, 574000, 435000, 'Created', '2018-10-17 10:14:58', '2018-10-22 09:04:35'),
(34, 78535, 140000, 0, 0, 'Created', '2018-10-23 02:55:03', '2018-10-23 02:55:03');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `branch_id` int(10) UNSIGNED NOT NULL,
  `b_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `b_region` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `b_zone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`branch_id`, `b_name`, `b_region`, `b_zone`, `created_at`, `updated_at`) VALUES
(372838, 'Azikiwe', 'Dar es salaam', 'Eastern Zone', '2018-09-19 21:00:00', '2018-09-19 21:00:00'),
(372839, 'Mlimani City', 'Dar es salaam', 'Eastern Zone', '2018-09-19 21:00:00', '2018-09-19 21:00:00'),
(372840, 'Head Quarters', 'Dar es salaam', 'Eastern Zone', '2018-09-23 21:00:00', '2018-09-23 21:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `budget`
--

CREATE TABLE `budget` (
  `budget_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `month` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `place` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quarter` int(20) NOT NULL,
  `market_cost` int(11) NOT NULL,
  `travelling_cost` int(11) NOT NULL,
  `fuel_cost` int(11) NOT NULL,
  `postage_cost` int(11) NOT NULL,
  `fax_cost` int(255) NOT NULL,
  `budget_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `business_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `expected_premium` int(11) NOT NULL,
  `carry_over_balance` int(255) NOT NULL DEFAULT '0',
  `first_approval` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `budget`
--

INSERT INTO `budget` (`budget_id`, `user_id`, `month`, `place`, `quarter`, `market_cost`, `travelling_cost`, `fuel_cost`, `postage_cost`, `fax_cost`, `budget_status`, `business_status`, `description`, `expected_premium`, `carry_over_balance`, `first_approval`, `file_name`, `created_at`, `updated_at`) VALUES
(78503, 6556799, 'October', 'Mwanza', 4, 500000, 50000, 30000, 10000, 5000, 'Approved', 'Settled', 'Meeting', 9000000, 15000, '6556793', 'tetetetet_January_10_2018_.xlsx', '2018-09-25 11:50:45', '2018-09-27 05:44:54'),
(78504, 6556798, 'November', 'Dodoma', 4, 46000, 7600000, 60000, 76000, 73002, 'On Approval', 'Not settled', 'Bzness', 2000000, 15000, '6556793', 'tetetetet_January_10_2018_.xlsx', '2018-09-26 06:41:27', '2018-10-07 06:25:25'),
(78505, 6556798, 'December', 'Morogoro', 1, 250000, 350000, 23400, 45000, 5000, 'Approved', 'Pushed Forward', 'Something serious', 300000000, 15000, '6556793', 'tetetetet_January_10_2018_.xlsx', '2018-09-27 08:16:36', '2018-10-01 06:34:05'),
(78506, 6556798, 'January', 'Mbeya', 1, 450000, 50000, 30000, 15000, 10000, 'Approved', 'Not settled', 'Business Meeting.', 6500000, 173400, '6556793', 'akichawelle_17_10_2018_.xls', '2018-10-01 05:03:47', '2018-10-22 06:45:18'),
(78507, 6556799, 'January', 'Mbeya', 1, 838383, 838383, 30000, 10000, 5000, 'Approved', 'Settled', 'To make sure all expired covers are renewed \r\n', 7000000, 0, '6556793', 'tetetetet_January_10_2018_.xlsx', '2018-10-04 09:52:10', '2018-10-05 10:55:30'),
(78508, 6556799, 'January', 'MOROGORO, SINGIDA', 1, 100000, 600000, 50000, 10000, 5000, 'Approved', 'Settled', 'business purpose', 500000000, 1000000, '6556793', 'tetetetet_January_10_2018_.xlsx', '2018-10-05 10:57:09', '2018-10-07 15:42:26'),
(78509, 6556813, 'January', 'Mbeya', 1, 789000, 80000, 90000, 90000, 60000, 'Approved', 'Settled', 'bzns', 450000, 0, '6556793', 'tetetetet_January_10_2018_.xlsx', '2018-10-07 17:10:32', '2018-10-07 17:10:32'),
(78510, 6556813, 'April', 'Mbeya', 2, 789000, 80000, 90000, 90000, 60000, 'Approved', 'Settled', 'bzns', 450000, 0, '6556793', 'tetetetet_January_10_2018_.xlsx', '2018-10-07 17:12:29', '2018-10-07 17:12:29'),
(78511, 6556813, 'April', 'Mbeya', 2, 789000, 80000, 90000, 90000, 60000, 'Approved', 'Settled', 'bzns', 450000, 0, '6556793', 'tetetetet_January_10_2018_.xlsx', '2018-10-07 17:13:36', '2018-10-07 17:13:36'),
(78512, 6556799, 'February', 'Mbeya', 1, 789000, 780000, 67000, 65000, 1000, 'Approved', 'Settled', 'Bzness', 5000000, 0, '6556793', 'tetetetet_January_10_2018_.xlsx', '2018-10-07 17:16:32', '2018-10-07 17:16:32'),
(78513, 6556799, 'August', 'Dodoma, Iringa', 3, 789000, 780000, 67000, 65000, 1000, 'Approved', 'Settled', 'Bzness', 5000000, 0, '6556793', 'tetetetet_January_10_2018_.xlsx', '2018-10-07 17:18:10', '2018-10-07 17:18:10'),
(78514, 6556813, 'January', 'Mbeya', 1, 1, 1, 1, 1, 1, 'Approved', 'Settled', 'WWW', 111, 0, '6556793', 'tetetetet_January_10_2018_.xlsx', '2018-10-08 09:47:36', '2018-10-08 09:47:36'),
(78515, 6556813, 'January', 'Mbeya', 1, 1, 1, 1, 1, 1, 'Approved', 'Settled', 'WWW', 111, 0, '6556793', 'tetetetet_January_10_2018_.xlsx', '2018-10-08 09:58:09', '2018-10-08 09:58:09'),
(78516, 6556813, 'January', 'Mbeya', 1, 1, 1, 1, 1, 1, 'Approved', 'Settled', 'WWW', 111, 0, '6556793', 'tetetetet_January_10_2018_.xlsx', '2018-10-08 10:10:41', '2018-10-08 10:10:41'),
(78517, 6556813, 'January', 'Tanga', 1, 50000, 30000, 40000, 980000, 800000, 'Approved', 'Settled', 'Bzness', 400000, 0, '6556793', 'tetetetet_January_10_2018_.xlsx', '2018-10-08 10:51:07', '2018-10-08 10:51:07'),
(78518, 6556799, 'January', 'Mbeya', 4, 650000, 50000, 750000, 1000000, 56000, 'Approved', 'Settled', 'rrrrr', 1, 0, 'Ally Kichawelle', 'rsadala_value=_10_2018_.xlsx', '2018-10-09 05:13:45', '2018-10-09 05:13:45'),
(78519, 6556799, 'July', 'Korogwe', 3, 1, 1, 1, 1, 90000, 'Approved', 'Settled', 'Bzness', 1000000, 0, 'Ally Kichawelle', 'rsadala_9_10_2018_.xlsx', '2018-10-09 05:54:51', '2018-10-09 08:54:22'),
(78520, 6556814, 'June', 'Kigoma, Mwanza', 2, 4000000, 900000, 300000, 500000, 300000, 'On Approval', 'Not settled', 'Business meeting', 6005000, 0, 'Ally Kichawelle', 'rrichard_9_10_2018_.csv', '2018-10-09 08:25:17', '2018-10-09 09:16:02'),
(78521, 6556800, 'January', 'Mbeya', 1, 200000, 20000000, 100000, 200000, 2000, 'Rejected by Arthur Mosha', 'Not settled', 'To bring more premium.', 500000000, 0, 'Ally Kichawelle', 'amrisho_10_10_2018_.xlsx', '2018-10-10 04:56:38', '2018-10-22 07:00:34'),
(78522, 6556819, 'March', 'Kigoma, Mwanza', 1, 500000, 5000000, 1500000, 500000, 400000, 'On Approval', 'Not settled', 'To renew covers', 45600000, 0, 'Ally Kichawelle', 'akichawelle_11_10_2018_.xlsx', '2018-10-11 06:35:01', '2018-10-22 06:32:17'),
(78523, 6556799, 'October', 'Zanzibar', 4, 1000000, 60000, 50000, 45000, 800000, 'Approved', 'Settled', 'Business', 500000000, 0, 'Ally Kichawelle', 'amosha_11_10_2018_.xlsx', '2018-10-11 09:34:25', '2018-10-12 09:13:47'),
(78534, 6556799, 'May', 'TANGA, BUKOBA, SONGEA, SHINYANGA', 2, 789000, 80000, 90000, 10000, 40000, 'Approved', 'On Settlement', 'bzness', 55000000, 0, 'Ally Kichawelle', 'rsadala_17_10_2018_.xls', '2018-10-17 10:14:58', '2018-10-22 10:10:54'),
(78535, 6556799, 'February', 'Tabora, Singida, Mtwara', 1, 20000, 9000, 8000, 80000, 23000, 'created', 'Not settled', 'B. meeting', 2000000, 0, 'Ally Kichawelle', 'rsadala_23_10_2018_.xls', '2018-10-23 02:55:03', '2018-10-23 02:55:03');

-- --------------------------------------------------------

--
-- Table structure for table `budget_track`
--

CREATE TABLE `budget_track` (
  `bt_id` int(10) UNSIGNED NOT NULL,
  `budget_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `status_info` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `budget_track`
--

INSERT INTO `budget_track` (`bt_id`, `budget_id`, `user_id`, `status_info`, `comment`, `created_at`, `updated_at`) VALUES
(1, 78506, 6556796, 'Approved', 'ok', '2018-10-12 10:22:19', '2018-10-12 10:22:19'),
(2, 78506, 6556796, 'Approved', 'ok', '2018-10-12 10:29:06', '2018-10-12 10:29:06'),
(3, 78506, 6556796, 'Rejected', 'Approved by mistake. Please start a fresh', '2018-10-12 10:40:42', '2018-10-12 10:40:42'),
(4, 78506, 6556796, 'Rejected', 'Approved by mistake. Please start a fresh', '2018-10-12 10:42:19', '2018-10-12 10:42:19'),
(5, 78506, 6556796, 'Returned to Abdallah Mrisho HFA', 'Check', '2018-10-12 10:54:22', '2018-10-12 10:54:22'),
(6, 78506, 6556796, 'Returned to Ally Kichawelle PFA', 'check', '2018-10-12 11:06:25', '2018-10-12 11:06:25'),
(7, 78506, 6556793, 'Reviewed', 'ok', '2018-10-12 11:10:21', '2018-10-12 11:10:21'),
(8, 78506, 6556793, 'Reviewed', 'Corrected', '2018-10-15 01:51:14', '2018-10-15 01:51:14'),
(9, 78506, 6556793, 'Reviewed', 'Corrected', '2018-10-15 01:51:59', '2018-10-15 01:51:59'),
(10, 78506, 6556796, 'Returned to Abdallah Mrisho HFA', 'Correct details', '2018-10-17 11:52:32', '2018-10-17 11:52:32'),
(11, 78506, 6556796, 'Returned to Binoy Swamy DGM', 'Correct details', '2018-10-17 11:54:15', '2018-10-17 11:54:15'),
(12, 78506, 6556793, 'Reviewed', 'jjj', '2018-10-17 13:23:34', '2018-10-17 13:23:34'),
(13, 78506, 6556796, 'Returned to Abdallah Mrisho HFA', 'Check', '2018-10-17 13:29:50', '2018-10-17 13:29:50'),
(14, 78534, 6556794, 'Recommended', 'OK', '2018-10-18 08:16:17', '2018-10-18 08:16:17'),
(15, 78534, 6556793, 'Reviewed', 'Proceed', '2018-10-18 08:17:07', '2018-10-18 08:17:07'),
(16, 78534, 6556795, 'Recommended', 'its ok proceed', '2018-10-18 08:17:48', '2018-10-18 08:17:48'),
(17, 78534, 6556796, 'Approved', 'Ok', '2018-10-18 08:18:31', '2018-10-18 08:18:31'),
(18, 78506, 6556796, 'Returned to Abdallah Mrisho HFA', 'hhhh', '2018-10-20 06:27:59', '2018-10-20 06:27:59'),
(19, 78522, 6556796, 'Returned to previous Approvers', 'check', '2018-10-20 07:51:56', '2018-10-20 07:51:56'),
(20, 78506, 6556794, 'Recommended', 'Data correced', '2018-10-22 04:12:21', '2018-10-22 04:12:21'),
(21, 78506, 6556794, 'Recommended', 'Data correced', '2018-10-22 04:13:20', '2018-10-22 04:13:20'),
(22, 78506, 6556794, 'Recommended', 'Data correced', '2018-10-22 04:44:04', '2018-10-22 04:44:04'),
(23, 78506, 6556794, 'Recommended', 'Data correced', '2018-10-22 04:48:09', '2018-10-22 04:48:09'),
(24, 78506, 6556794, 'Recommended', 'Data correced', '2018-10-22 04:48:52', '2018-10-22 04:48:52'),
(25, 78506, 6556794, 'Recommended', 'Data corrected', '2018-10-22 05:43:51', '2018-10-22 05:43:51'),
(26, 78506, 6556794, 'Recommended', 'Data corrected', '2018-10-22 05:44:22', '2018-10-22 05:44:22'),
(27, 78506, 6556794, 'Recommended', 'Data corrected', '2018-10-22 05:45:45', '2018-10-22 05:45:45'),
(28, 78506, 6556794, 'Recommended', 'Data corrected', '2018-10-22 05:46:18', '2018-10-22 05:46:18'),
(29, 78506, 6556794, 'Recommended', 'Data corrected', '2018-10-22 05:47:11', '2018-10-22 05:47:11'),
(30, 78522, 6556795, 'Recommended', 'ok', '2018-10-22 06:32:17', '2018-10-22 06:32:17'),
(31, 78522, 6556794, 'Recommended', 'checked and corrected', '2018-10-22 06:34:41', '2018-10-22 06:34:41'),
(32, 78522, 6556793, 'Reviewed', 'ok', '2018-10-22 06:35:46', '2018-10-22 06:35:46'),
(33, 78506, 6556793, 'Reviewed', 'ok\r\n', '2018-10-22 06:39:28', '2018-10-22 06:39:28'),
(34, 78506, 6556796, 'Approved', 'passed', '2018-10-22 06:45:18', '2018-10-22 06:45:18'),
(35, 78521, 6556796, 'Rejected', 'The activities are not for this quatre.\r\n', '2018-10-22 07:00:34', '2018-10-22 07:00:34');

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`name`, `email`, `phone`, `created_at`, `updated_at`) VALUES
('2018-08-03 00:00:00', 'DODOMA', 'To make sure all expired covers vare renewed ', '2018-10-16', '2018-10-16'),
('2018-08-03 00:00:00', 'ZANZIBAR', 'Meeting', '2018-10-16', '2018-10-16'),
('2018-08-04 00:00:00', 'DODOMA', 'To make sure all expired covers vare renewed ', '2018-10-16', '2018-10-16'),
('2018-08-03 00:00:00', 'DODOMA', 'To make sure all expired covers vare renewed ', '2018-10-16', '2018-10-16'),
('2018-08-03 00:00:00', 'ZANZIBAR', 'Meeting', '2018-10-16', '2018-10-16'),
('2018-08-04 00:00:00', 'DODOMA', 'To make sure all expired covers vare renewed ', '2018-10-16', '2018-10-16');

-- --------------------------------------------------------

--
-- Table structure for table `implementation`
--

CREATE TABLE `implementation` (
  `implementation_id` int(10) UNSIGNED NOT NULL,
  `budget_id` int(10) UNSIGNED NOT NULL,
  `date_of_visit` date NOT NULL,
  `activities` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `place` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Pending',
  `expected_premium` int(255) DEFAULT '0',
  `actual_cost` int(255) DEFAULT '0',
  `total_cost` int(255) DEFAULT '0',
  `bgen_date` date NOT NULL,
  `reason` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Not Settled',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `implementation`
--

INSERT INTO `implementation` (`implementation_id`, `budget_id`, `date_of_visit`, `activities`, `place`, `description`, `remarks`, `expected_premium`, `actual_cost`, `total_cost`, `bgen_date`, `reason`, `status`, `created_at`, `updated_at`) VALUES
(23442, 78533, '2018-10-24', '', 'Mbeya', 'meeting with client and solicitation of business Medical, general & Group Life Assuarnce', 'Business was successful', 0, 50000, 0, '2018-10-16', 'Date was extended', 'Settled', '2018-10-14 21:00:00', '2018-10-15 10:21:42'),
(23620, 78534, '2018-02-08', 'Visit Summry Enterprises Ltd, Champanda traders, Transcrop Ltd  and Tawaqal Co.Ltd', 'SUMBAWANGA', 'meeting with clients and solicitation of business', 'done well', 30000000, 50000, 135000, '2018-11-02', 'Sample', 'Settled', '2018-10-17 10:17:14', '2018-10-18 09:11:33'),
(23621, 78534, '2018-03-08', 'Company meeting', 'DAR ES SALAAM', NULL, 'done', NULL, 45000, 0, '2018-10-18', NULL, 'Settled', '2018-10-17 10:17:14', '2018-10-18 08:39:08'),
(23622, 78534, '2018-04-08', 'Follow up on zone renewals ', 'MWANJELWA', 'To make sure all expired covers vare renewed ', 'hello', 200000000, 78000, 0, '2018-10-18', NULL, 'Settled', '2018-10-17 10:17:14', '2018-10-18 08:55:43'),
(23623, 78534, '2018-05-08', 'Follow up on renewals and attending several issues in office ', 'MWANJELWA', 'To make sure all expired covers vare renewed ', 'done', NULL, 100000, 35000, '2018-10-18', NULL, 'Settled', '2018-10-17 10:17:14', '2018-10-18 09:03:52'),
(23624, 78534, '2018-02-08', 'Visit Shanta Mine Gold', 'MKWAJUNI', 'meeting with client and solicitation of business Medical, general & Group Life Assuarnce', 'done', 100000000, 8000, 135000, '2018-10-18', NULL, 'Settled', '2018-10-17 10:17:14', '2018-10-18 09:10:03'),
(23625, 78534, '2018-02-08', 'Visit Ly Hotels, Ntanyinya Filling sttions, Mr.Nsonda and District council', 'CHUNYA', 'meeting with clients and solicitation of business', 'Test', 10000000, 60000, 95000, '2018-10-18', NULL, 'Settled', '2018-10-17 10:17:14', '2018-10-18 08:32:28'),
(23626, 78534, '2018-08-08', 'NANE NANE', 'PUBLIC H/DAY ', NULL, 'ok done', NULL, 7000, 0, '2018-10-18', NULL, 'Settled', '2018-10-17 10:17:14', '2018-10-18 09:04:05'),
(23627, 78534, '2018-09-08', 'Visit Madaraka and Mbeya due water Ltd', 'MWANJELWA', 'meeting with clients and solicitation of business', 'successful', 8000000, 50000, 30000, '2018-10-31', NULL, 'Settled', '2018-10-17 10:17:14', '2018-10-18 09:04:26'),
(23628, 78534, '2018-12-08', 'Visit Songwe Secondary and Marmo Granito', 'MBEYA', 'meeting with clients for renewals and solicitation of business', 'done', 20000000, 50000, 30000, '2018-10-31', NULL, 'Settled', '2018-10-17 10:17:14', '2018-10-18 09:08:40'),
(23629, 78534, '2018-12-08', 'Visit SILVERY MARCUS MLOWE, Hill side hotels, and Tanganyika Wattle Co.Ltd', 'MBALIZI', 'meeting with clients for renewals and solicitation of business', 'ok', 8000000, 9000, 135000, '2018-10-31', NULL, 'Settled', '2018-10-17 10:17:14', '2018-10-18 08:37:14'),
(23630, 78534, '2018-12-08', NULL, 'SUNDAY', NULL, 'done', NULL, 9000, 0, '2018-10-31', NULL, 'Settled', '2018-10-17 10:17:14', '2018-10-18 09:10:20'),
(23631, 78534, '2018-12-08', 'Visit Summry Enterprises Ltd, Champanda traders, Transcrop Ltd  and Tawaqal Co.Ltd', 'SUMBAWANGA', 'meeting with clients and solicitation of business', 'done', 30000000, 40000, 135000, '2018-10-31', NULL, 'Settled', '2018-10-17 10:17:14', '2018-10-18 09:08:58'),
(23632, 78534, '2018-12-08', 'Follow up on branch renewals', 'SUMBAWANGA', 'meeting with clients and solicitation of business', 'done', 20000000, 4000, 130000, '2018-10-31', NULL, 'Settled', '2018-10-17 10:17:15', '2018-10-18 09:09:08'),
(23633, 78534, '2018-12-08', 'MPANDA', 'On Transit ', NULL, 'done', NULL, 9000, 125000, '2018-10-31', NULL, 'Settled', '2018-10-17 10:17:15', '2018-10-18 09:09:20'),
(23634, 78534, '2018-12-08', 'Visit Allyen transporters, AK Money dealers, KMM Contractors', 'MPANDA', 'meeting with clients and solicitation of business', 'done done', 200000000, 50000, 95000, '2018-10-31', NULL, 'Settled', '2018-10-17 10:17:15', '2018-10-18 09:09:41'),
(23635, 78534, '2018-12-08', 'Follow up on branch renewals', 'MPANDA', 'Renewing expired policies', 'done', NULL, 5000, 95000, '2018-10-31', NULL, 'Settled', '2018-10-17 10:17:15', '2018-10-18 09:10:58'),
(23636, 78506, '2018-02-08', 'Visit Summry Enterprises Ltd, Champanda traders, Transcrop Ltd  and Tawaqal Co.Ltd', 'SUMBAWANGA', 'meeting with clients and solicitation of business', 'Pending', 30000000, 0, 135000, '2018-10-18', NULL, 'Not Settled', '2018-10-17 10:24:10', '2018-10-17 10:24:10'),
(23637, 78506, '2018-03-08', 'Company meeting', 'DAR ES SALAAM', NULL, 'Pending', NULL, 0, 0, '2018-10-18', NULL, 'Not Settled', '2018-10-17 10:24:10', '2018-10-17 10:24:10'),
(23638, 78506, '2018-04-08', 'Follow up on zone renewals ', 'MWANJELWA', 'To make sure all expired covers vare renewed ', 'Pending', 200000000, 0, 0, '2018-10-18', NULL, 'Not Settled', '2018-10-17 10:24:10', '2018-10-17 10:24:10'),
(23639, 78506, '2018-05-08', 'Follow up on renewals and attending several issues in office ', 'MWANJELWA', 'To make sure all expired covers vare renewed ', 'Pending', NULL, 0, 35000, '2018-10-18', NULL, 'Not Settled', '2018-10-17 10:24:10', '2018-10-17 10:24:10'),
(23640, 78506, '2018-02-08', 'Visit Shanta Mine Gold', 'MKWAJUNI', 'meeting with client and solicitation of business Medical, general & Group Life Assuarnce', 'Pending', 100000000, 0, 135000, '2018-10-18', NULL, 'Not Settled', '2018-10-17 10:24:10', '2018-10-17 10:24:10'),
(23641, 78506, '2018-02-08', 'Visit Ly Hotels, Ntanyinya Filling sttions, Mr.Nsonda and District council', 'CHUNYA', 'meeting with clients and solicitation of business', 'Pending', 10000000, 0, 95000, '2018-10-18', NULL, 'Not Settled', '2018-10-17 10:24:10', '2018-10-17 10:24:10'),
(23642, 78506, '2018-08-08', 'NANE NANE', 'PUBLIC H/DAY ', NULL, 'Pending', NULL, 0, 0, '2018-10-18', NULL, 'Not Settled', '2018-10-17 10:24:10', '2018-10-17 10:24:10'),
(23643, 78506, '2018-09-08', 'Visit Madaraka and Mbeya due water Ltd', 'MWANJELWA', 'meeting with clients and solicitation of business', 'Pending', 8000000, 0, 30000, '2018-10-31', NULL, 'Not Settled', '2018-10-17 10:24:11', '2018-10-17 10:24:11'),
(23644, 78506, '2018-12-08', 'Visit Songwe Secondary and Marmo Granito', 'MBEYA', 'meeting with clients for renewals and solicitation of business', 'Pending', 20000000, 0, 30000, '2018-10-31', NULL, 'Not Settled', '2018-10-17 10:24:11', '2018-10-17 10:24:11'),
(23645, 78506, '2018-12-08', 'Visit SILVERY MARCUS MLOWE, Hill side hotels, and Tanganyika Wattle Co.Ltd', 'MBALIZI', 'meeting with clients for renewals and solicitation of business', 'Pending', 8000000, 0, 135000, '2018-10-31', NULL, 'Not Settled', '2018-10-17 10:24:11', '2018-10-17 10:24:11'),
(23646, 78506, '2018-12-08', NULL, 'SUNDAY', NULL, 'Pending', NULL, 0, 0, '2018-10-31', NULL, 'Not Settled', '2018-10-17 10:24:11', '2018-10-17 10:24:11'),
(23647, 78506, '2018-12-08', 'Visit Summry Enterprises Ltd, Champanda traders, Transcrop Ltd  and Tawaqal Co.Ltd', 'SUMBAWANGA', 'meeting with clients and solicitation of business', 'Pending', 30000000, 0, 135000, '2018-10-31', NULL, 'Not Settled', '2018-10-17 10:24:11', '2018-10-17 10:24:11'),
(23648, 78506, '2018-12-08', 'Follow up on branch renewals', 'SUMBAWANGA', 'meeting with clients and solicitation of business', 'Pending', 20000000, 0, 130000, '2018-10-31', NULL, 'Not Settled', '2018-10-17 10:24:11', '2018-10-17 10:24:11'),
(23649, 78506, '2018-12-08', 'MPANDA', 'On Transit ', NULL, 'Pending', NULL, 0, 125000, '2018-10-31', NULL, 'Not Settled', '2018-10-17 10:24:11', '2018-10-17 10:24:11'),
(23650, 78506, '2018-12-08', 'Visit Allyen transporters, AK Money dealers, KMM Contractors', 'MPANDA', 'meeting with clients and solicitation of business', 'Pending', 200000000, 0, 95000, '2018-10-31', NULL, 'Not Settled', '2018-10-17 10:24:11', '2018-10-17 10:24:11'),
(23651, 78506, '2018-12-08', 'Follow up on branch renewals', 'MPANDA', 'Renewing expired policies', 'Pending', NULL, 0, 95000, '2018-10-31', NULL, 'Not Settled', '2018-10-17 10:24:11', '2018-10-17 10:24:11');

-- --------------------------------------------------------

--
-- Table structure for table `limits`
--

CREATE TABLE `limits` (
  `limits_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `market_cost` int(11) NOT NULL,
  `travelling_cost` int(11) NOT NULL,
  `fuel_cost` int(11) NOT NULL,
  `postage_cost` int(11) NOT NULL,
  `fax_cost` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `limits`
--

INSERT INTO `limits` (`limits_id`, `user_id`, `market_cost`, `travelling_cost`, `fuel_cost`, `postage_cost`, `fax_cost`, `created_at`, `updated_at`) VALUES
(664738, 6556798, 5000000, 40000000, 3000000, 990000, 2010000, '2018-09-26 21:00:00', '2018-10-17 10:24:10'),
(664739, 6556799, 1032995, 37899995, 2641995, 829995, 164995, '2018-10-07 16:45:06', '2018-10-17 10:17:14'),
(664740, 6556791, 5000000, 40000000, 3000000, 2000000, 1000000, NULL, '2018-10-11 06:26:32'),
(664741, 6556792, 5000000, 40000000, 3000000, 2000000, 1000000, NULL, '2018-10-11 06:26:32'),
(664742, 6556793, 5000000, 40000000, 3000000, 2000000, 1000000, NULL, '2018-10-11 06:26:32'),
(664743, 6556794, 5000000, 40000000, 3000000, 2000000, 1000000, NULL, '2018-10-11 06:26:32'),
(664744, 6556795, 5000000, 40000000, 3000000, 2000000, 1000000, NULL, '2018-10-11 06:26:32'),
(664745, 6556791, 5000000, 40000000, 3000000, 2000000, 1000000, NULL, '2018-10-11 06:26:32'),
(664746, 6556792, 5000000, 40000000, 3000000, 2000000, 1000000, NULL, '2018-10-11 06:26:32'),
(664747, 6556793, 5000000, 40000000, 3000000, 2000000, 1000000, NULL, '2018-10-11 06:26:32'),
(664748, 6556794, 5000000, 40000000, 3000000, 2000000, 1000000, NULL, '2018-10-11 06:26:32'),
(664749, 6556795, 5000000, 40000000, 3000000, 2000000, 1000000, NULL, '2018-10-11 06:26:32'),
(664750, 6556796, 5000000, 40000000, 3000000, 2000000, 1000000, NULL, '2018-10-11 06:26:32'),
(664751, 6556797, 5000000, 40000000, 3000000, 2000000, 1000000, NULL, '2018-10-11 06:26:32'),
(664752, 6556798, 5000000, 40000000, 3000000, 2000000, 1000000, NULL, '2018-10-11 06:26:32'),
(664753, 6556799, 5000000, 40000000, 3000000, 2000000, 1000000, NULL, '2018-10-11 06:26:32'),
(664754, 6556800, 5000000, 40000000, 3000000, 2000000, 1000000, NULL, '2018-10-11 06:26:32'),
(664755, 6556801, 5000000, 40000000, 3000000, 2000000, 1000000, NULL, '2018-10-11 06:26:32'),
(664756, 6556802, 5000000, 40000000, 3000000, 2000000, 1000000, NULL, '2018-10-11 06:26:32'),
(664757, 6556803, 5000000, 40000000, 3000000, 2000000, 1000000, NULL, '2018-10-11 06:26:32'),
(664758, 6556804, 5000000, 40000000, 3000000, 2000000, 1000000, NULL, '2018-10-11 06:26:32'),
(664759, 6556805, 5000000, 40000000, 3000000, 2000000, 1000000, NULL, '2018-10-11 06:26:32'),
(664760, 6556813, 5000000, 40000000, 3000000, 2000000, 1000000, NULL, '2018-10-11 06:26:32'),
(664761, 6556814, 5000000, 40000000, 3000000, 2000000, 1000000, '2018-10-09 08:10:47', '2018-10-11 06:26:32'),
(664762, 6556815, 5000000, 40000000, 3000000, 2000000, 1000000, '2018-10-11 04:29:09', '2018-10-11 06:26:32'),
(664763, 6556817, 5000000, 40000000, 3000000, 2000000, 1000000, '2018-10-11 04:38:40', '2018-10-11 06:26:32'),
(664764, 6556818, 5000000, 40000000, 3000000, 2000000, 1000000, '2018-10-11 04:39:24', '2018-10-11 06:26:32'),
(664765, 6556788, 5000000, 40000000, 3000000, 2000000, 1000000, '2018-10-10 21:00:00', '2018-10-11 06:26:32'),
(664766, 6556819, 4500000, 35000000, 1500000, 1000000, 600000, '2018-10-11 06:28:05', '2018-10-11 08:18:09');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(8, '2014_10_12_000000_create_users_table', 1),
(9, '2014_10_12_100000_create_password_resets_table', 1),
(10, '2018_09_20_070430_create_branches_table', 1),
(14, '2018_09_20_132122_create_budget_table', 2),
(26, '2018_09_21_125459_create_approvals_table', 3),
(27, '2018_09_24_141853_create_balance_table', 4),
(29, '2018_09_25_140311_create_remarks_table', 5),
(30, '2018_09_27_141042_create_limits_table', 6),
(31, '2018_10_01_125917_create_updates_table', 7),
(32, '2018_10_01_144337_create_approve_record_table', 8),
(33, '2018_10_11_051329_create_old_limit_table', 9),
(34, '2018_10_12_083347_create_budget_track_table', 10),
(39, '2018_10_15_043713_create_implementation_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `old_limits`
--

CREATE TABLE `old_limits` (
  `b_limits_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `market_cost` int(11) NOT NULL DEFAULT '0',
  `travelling_cost` int(11) NOT NULL DEFAULT '0',
  `fuel_cost` int(11) NOT NULL DEFAULT '0',
  `postage_cost` int(11) NOT NULL DEFAULT '0',
  `fax_cost` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `old_limits`
--

INSERT INTO `old_limits` (`b_limits_id`, `user_id`, `market_cost`, `travelling_cost`, `fuel_cost`, `postage_cost`, `fax_cost`, `created_at`, `updated_at`) VALUES
(1, 6556818, 0, 0, 0, 0, 0, '2018-10-11 04:39:24', '2018-10-11 06:26:32'),
(2, 6556788, 0, 0, 0, 0, 0, NULL, '2018-10-11 06:26:32'),
(3, 6556788, 0, 0, 0, 0, 0, NULL, '2018-10-11 06:26:32'),
(4, 6556791, 0, 0, 0, 0, 0, NULL, '2018-10-11 06:26:32'),
(5, 6556793, 0, 0, 0, 0, 0, NULL, '2018-10-11 06:26:32'),
(6, 6556794, 0, 0, 0, 0, 0, NULL, '2018-10-11 06:26:32'),
(7, 6556795, 0, 0, 0, 0, 0, NULL, '2018-10-11 06:26:32'),
(8, 6556796, 0, 0, 0, 0, 0, NULL, '2018-10-11 06:26:32'),
(9, 6556798, 5450000, 40050000, 3030000, 1005000, 2020000, NULL, '2018-10-17 10:24:10'),
(10, 6556799, 1821995, 37979995, 2731995, 839995, 204995, NULL, '2018-10-17 10:17:14'),
(11, 6556800, 0, 0, 0, 0, 0, NULL, '2018-10-11 06:26:32'),
(12, 6556801, 0, 0, 0, 0, 0, NULL, '2018-10-11 06:26:32'),
(13, 6556802, 0, 0, 0, 0, 0, NULL, '2018-10-11 06:26:32'),
(14, 6556803, 0, 0, 0, 0, 0, NULL, '2018-10-11 06:26:32'),
(15, 6556804, 0, 0, 0, 0, 0, NULL, '2018-10-11 06:26:32'),
(16, 6556805, 0, 0, 0, 0, 0, NULL, '2018-10-11 06:26:32'),
(17, 6556813, 0, 0, 0, 0, 0, NULL, '2018-10-11 06:26:32'),
(18, 6556814, 0, 0, 0, 0, 0, NULL, '2018-10-11 06:26:32'),
(19, 6556818, 0, 0, 0, 0, 0, NULL, '2018-10-11 06:26:32'),
(20, 6556819, 5000000, 40000000, 3000000, 1500000, 1000000, '2018-10-11 06:28:05', '2018-10-11 08:18:09');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `remarks`
--

CREATE TABLE `remarks` (
  `remark_id` int(10) UNSIGNED NOT NULL,
  `budget_id` int(10) UNSIGNED NOT NULL,
  `actual_cost` int(11) NOT NULL DEFAULT '0',
  `final_remarks` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reviewer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reviewer2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reviewer3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `approved_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remark_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Remark Submitted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `remarks`
--

INSERT INTO `remarks` (`remark_id`, `budget_id`, `actual_cost`, `final_remarks`, `reviewer`, `reviewer2`, `reviewer3`, `approved_by`, `remark_status`, `created_at`, `updated_at`) VALUES
(1, 78503, 590000, 'Completed', 'Binoy Swami', NULL, NULL, 'Binoy Swami', 'Business Settled', '2018-09-26 06:11:17', '2018-09-27 05:44:54'),
(5, 78507, 721766, 'it was okay', 'Binoy Swami', NULL, NULL, 'Binoy Swami', 'Business Settled', '2018-10-04 10:08:29', '2018-10-05 10:55:30'),
(6, 78508, 500000, 'Done done', 'Arthur Mosha', NULL, NULL, NULL, 'Business Settled', '2018-10-05 11:17:18', '2018-10-18 02:35:51'),
(7, 78523, 500000, NULL, 'Arthur Mosha', NULL, NULL, 'Arthur Mosha', 'Business Settled', '2018-10-11 10:13:57', '2018-10-12 09:13:47'),
(8, 78534, 574000, 'Everything was done successfully', 'abdalla.mrisho@crdbbank.com', NULL, NULL, NULL, 'Remark Submitted', '2018-10-22 09:04:35', '2018-10-22 10:10:54');

-- --------------------------------------------------------

--
-- Table structure for table `updates`
--

CREATE TABLE `updates` (
  `updates_id` int(10) UNSIGNED NOT NULL,
  `budget_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `balance` int(255) NOT NULL DEFAULT '0',
  `branch_id_` int(10) UNSIGNED NOT NULL,
  `status` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'created',
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `title`, `balance`, `branch_id_`, `status`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(6556788, 'Mike Smith', 'msmith', 'mike@crd.com', 'Staff', 0, 372838, 'Active', '$2y$10$bP4ke6RKt3uxCBz89ZfajOpfumB5iNYrRUu.8bpKjlZ.OMvmCWI8q', 'Pvjs34IbTVm8Mb6Yhj1UuRFhYJXQCpVW0L9i8DF9EVCXfQcUqSTIlMhrOIEn', '2018-09-19 21:00:00', '2018-10-11 06:31:58'),
(6556791, 'Clement Hillary', 'cmdoe', 'caymanclem@gmail.com', 'System Admin', 0, 372838, 'Active', '$2y$10$udikszhWv.afpO65etZRsOL2D/yN8GEAH/VELZqCZ8y6z1m9UZAym', '4N8pOu4nBXejzos9I7xJwK8Pj7mxd5js9SsocESJnvkZLacwo6lLyOMItYYR', '2018-09-20 09:34:06', '2018-10-19 06:19:48'),
(6556793, 'Ally Kichawelle', 'akichawelle', 'ally.kichawelle@crdbbank.com', 'PFA', 0, 372840, 'Active', '$2y$10$g/yj/tC3GOfS5S29r7tjeer48hgltBZhc0d3On8.Rfp3bsdPqk8eK', '7H1vl1a5gy2cyBhKP7SkwMXULsJD4MPd9tVpTooxNjZ5PPzodAToqSk7Z6hm', '2018-09-24 05:59:23', '2018-10-22 10:23:07'),
(6556794, 'Abdallah Mrisho', 'amrisho', 'abdalla.mrisho@crdbbank.com', 'HFA', 0, 372840, 'Active', '$2y$10$7.ZIZl4pj1cFhph00Wad6.CZEdO1i1gB3elDu9H41nkx/7o6qXVI6', 'DV0DsxGwshW3x8d18XxurczmGhpBHgE1oVjyLeDWs5Nwo4vFOXRieNVumhZV', '2018-09-24 06:02:15', '2018-10-22 10:34:40'),
(6556795, 'Binoy Swamy', 'bswamy', 'binoy.swami@crdbbank.com', 'DGM', 0, 372840, 'Active', '$2y$10$7.ZIZl4pj1cFhph00Wad6.CZEdO1i1gB3elDu9H41nkx/7o6qXVI6', 'PN17N9mTjFJwClI8SFOqpPUBra6qdWYmRaSODbjIKqDljv0Y8pZZA3WvaAVC', '2018-09-24 06:03:35', '2018-10-22 06:33:28'),
(6556796, 'Arthur Mosha', 'amosha', 'arthur.mosha@crdbbank.com', 'GM', 0, 372840, 'Active', '$2y$10$7.ZIZl4pj1cFhph00Wad6.CZEdO1i1gB3elDu9H41nkx/7o6qXVI6', 'q2uE5mP2ZPA9j9YZJynrssYf3n8VpRAjvg8nDbbnElkuJFtaKF9NfuN7tyN7', '2018-09-24 06:09:28', '2018-10-22 08:50:57'),
(6556798, 'Clement Mdoe', 'cmdoe', 'clement.mdoe@crdbbank.com', 'System Admin', 0, 372840, 'Active', 'Ap@12345', 'hqtiDoNTlgVgDkoT3kfJIcPlJuh6xnSIyGLFDqyNRGtObejk1hRhiixDmpHi', '2018-09-24 06:13:01', '2018-10-10 03:50:38'),
(6556799, 'Rasuli Sadala', 'rsadala', 'rasuli.sadala@crdbbank.com', 'Staff', 2175500, 372840, 'Active', '$2y$10$pnJgzsDSXY4ks/zm3HDRbO2GOC0GaXQYtgkFdyJx5YeOSH/IgsfQS', 'k2dNpMxVzlGNXrqXRWDAPljTxgTjZtab5XasKKg5uCv2xf2g1IMnk8Bo5LaA', '2018-09-26 03:06:28', '2018-10-22 10:22:58'),
(6556800, 'John Doe', 'jdoe', 'john.doe@crdb.com', 'Staff', 0, 372838, 'Active', '$2y$10$QC/Tt3qrD42UfekcVDh/q.8oAQKiE2hBn0L1DX6/enFBPCX5WRZ/y', 'aU3IpJ8aNr4twQtjlpnZhEniCESe4KXNOOij8Q3LMZbPcgyNe0zg7jVmKnTG', '2018-10-05 04:26:32', '2018-10-16 12:44:36'),
(6556801, 'Charles Babbage', 'cbabbage', 'charles.babbage@crdb.com', 'System Admin', 0, 372839, 'created', '$2y$10$pkkXVSZXRpWnXADuOhIL2.KqFsFQG2N247i/kziU0Kl6DDWwieIWm', NULL, '2018-10-05 10:27:31', '2018-10-11 05:49:23'),
(6556802, 'Hillary Clinton', 'hclinton', 'hillary.clinton@crdb.com', 'Staff', 0, 372839, 'Active', '$2y$10$ewdG/ZBH0t2NKAa1Ubf9WeV6xmsNtNdjx1oWv79FMJD5E5j5TBhv2', 'gCs4Bzx5QE0PvCNOMNH60axOliKbyomWfaOYsVAYuxHNsdSMbj1rSpc6x5Pf', '2018-10-05 10:29:34', '2018-10-10 04:06:31'),
(6556803, 'Julius Bujulu', 'jbujulu', 'jb@crdbbank.com', 'Staff', 0, 372838, 'created', '$2y$10$DnxrTa4BLus7yP.vVTnDjelAfGbItHI07rUvL5GpmkUlyiVkcoGSa', 'NIGA8cGPwpAhfxVJHyYgyNNwHieUz1kuaHg1pOjq1OYSojTowAhqkzpMbSSy', '2018-10-07 05:12:40', '2018-10-11 05:41:09'),
(6556804, 'Sofia Jones', 'sjones', 's@crdb.com', 'Staff', 0, 372839, 'created', '$2y$10$NBTNK0LAusyM6/6iY0fAmeMS3KXw6WCSBAvn/JS1AEk5QKXp54rZe', NULL, '2018-10-07 05:25:44', '2018-10-07 05:25:44'),
(6556805, 'JJ Paul', 'jjpaul', 'jj@crdb.com', 'Staff', 0, 372839, 'created', '$2y$10$RngT2yXu7Rnf7xFTBJw8/.d7VjnIT/LnIQjbZT6ButVtX8cYq2pm.', NULL, '2018-10-07 05:33:10', '2018-10-07 05:33:10'),
(6556813, 'teteteetet', 'tetetetet', 'tetetet@tyyd.com', 'Staff', 0, 372838, 'created', '$2y$10$5v3QYMQTdokzSmI9RM1NSu5Kap1Gg0DMD0PXd7979UOUfg9SqHxBa', 'b2MbDlMWYHJKVlncHV98TJ5KKHSKrPR7DBTtoxHdasBkmt1b9CSR7dTE3dJi', '2018-10-07 16:45:06', '2018-10-08 11:56:57'),
(6556814, 'Rose Richard', 'rrichard', 'rrichard@crdb.com', 'Staff', 0, 372838, 'created', '$2y$10$y/azSBqYBrQISnAkP2Yfv.ulSWOoRKh98TWYq5yIlDA6cz8/bg07u', 'Jpk2eXwJCDkSWgjQsT6LZnFmWrIo0MCwRiTzGKjePfZtLXTodUgsGwquD9fU', '2018-10-09 08:10:47', '2018-10-09 09:41:34'),
(6556818, 'Justin Bieber', 'jbieber', 'justin@crdb.com', 'Staff', 0, 372838, 'Active', '$2y$10$atOtDqEpKVFeMqpgsZRvhez/G2PQGtMtd.VoV0s53R.N7HxFVBtHq', 'kWNMQxxCdGqLgW4Sueh0x68kJ1PfV2LlfJ2Ee7r1Kjij6ezkQuFXhCgZUI8v', '2018-10-11 04:39:23', '2018-10-12 03:24:35'),
(6556819, 'Simon Peter', 'speter', 'simon.peter@crdb.com', 'Staff', 0, 372838, 'Active', '$2y$10$OBaA80Upb020TVDnlybPheOLspKeMsKEBmzIAcHg4yKz/Sj31470q', 'D3KFIdTkBGWYRhH48XfoTwmZx7MDJqc5L7mS4xKnfwrJMXqNs8T3rEsnp8Xy', '2018-10-11 06:28:05', '2018-10-11 09:18:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `approvals`
--
ALTER TABLE `approvals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `approvals_approval_id_index` (`id`),
  ADD KEY `approvals_approving_user_id_index` (`approving_user_id`),
  ADD KEY `approvals_budget_id_index` (`budget_id`);

--
-- Indexes for table `approve_record`
--
ALTER TABLE `approve_record`
  ADD PRIMARY KEY (`record_id`),
  ADD KEY `approve_record_record_id_index` (`record_id`),
  ADD KEY `approve_record_budget_id_index` (`budget_id`),
  ADD KEY `approve_record_user_id_index` (`user_id`);

--
-- Indexes for table `balance`
--
ALTER TABLE `balance`
  ADD PRIMARY KEY (`balance_id`),
  ADD KEY `balance_balance_id_index` (`balance_id`),
  ADD KEY `balance_budget_id_index` (`budget_id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`branch_id`),
  ADD UNIQUE KEY `branches_b_name_unique` (`b_name`),
  ADD KEY `branches_branch_id_index` (`branch_id`);

--
-- Indexes for table `budget`
--
ALTER TABLE `budget`
  ADD PRIMARY KEY (`budget_id`),
  ADD KEY `budget_budget_id_index` (`budget_id`),
  ADD KEY `budget_user_id_index` (`user_id`);

--
-- Indexes for table `budget_track`
--
ALTER TABLE `budget_track`
  ADD PRIMARY KEY (`bt_id`),
  ADD KEY `budget_track_bt_id_index` (`bt_id`),
  ADD KEY `budget_track_budget_id_index` (`budget_id`),
  ADD KEY `budget_track_user_id_index` (`user_id`);

--
-- Indexes for table `implementation`
--
ALTER TABLE `implementation`
  ADD PRIMARY KEY (`implementation_id`),
  ADD KEY `implementation_implementation_id_index` (`implementation_id`),
  ADD KEY `implementation_budget_id_index` (`budget_id`);

--
-- Indexes for table `limits`
--
ALTER TABLE `limits`
  ADD PRIMARY KEY (`limits_id`),
  ADD KEY `limits_limits_id_index` (`limits_id`),
  ADD KEY `limits_user_id_index` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `old_limits`
--
ALTER TABLE `old_limits`
  ADD PRIMARY KEY (`b_limits_id`),
  ADD KEY `old_limits_b_limits_id_index` (`b_limits_id`),
  ADD KEY `old_limits_user_id_index` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `remarks`
--
ALTER TABLE `remarks`
  ADD PRIMARY KEY (`remark_id`),
  ADD KEY `remarks_id_index` (`remark_id`),
  ADD KEY `remarks_budget_id_index` (`budget_id`);

--
-- Indexes for table `updates`
--
ALTER TABLE `updates`
  ADD PRIMARY KEY (`updates_id`),
  ADD KEY `updates_updates_id_index` (`updates_id`),
  ADD KEY `updates_budget_id_index` (`budget_id`),
  ADD KEY `updates_user_id_index` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_name_unique` (`name`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_id_index` (`id`),
  ADD KEY `users_branch_id__index` (`branch_id_`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `approvals`
--
ALTER TABLE `approvals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47607;
--
-- AUTO_INCREMENT for table `approve_record`
--
ALTER TABLE `approve_record`
  MODIFY `record_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `balance`
--
ALTER TABLE `balance`
  MODIFY `balance_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `branch_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=372841;
--
-- AUTO_INCREMENT for table `budget`
--
ALTER TABLE `budget`
  MODIFY `budget_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78536;
--
-- AUTO_INCREMENT for table `budget_track`
--
ALTER TABLE `budget_track`
  MODIFY `bt_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `implementation`
--
ALTER TABLE `implementation`
  MODIFY `implementation_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23652;
--
-- AUTO_INCREMENT for table `limits`
--
ALTER TABLE `limits`
  MODIFY `limits_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=664767;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `old_limits`
--
ALTER TABLE `old_limits`
  MODIFY `b_limits_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `remarks`
--
ALTER TABLE `remarks`
  MODIFY `remark_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `updates`
--
ALTER TABLE `updates`
  MODIFY `updates_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6556820;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `budget`
--
ALTER TABLE `budget`
  ADD CONSTRAINT `budget_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `old_limits`
--
ALTER TABLE `old_limits`
  ADD CONSTRAINT `old_limits_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`branch_id_`) REFERENCES `branches` (`branch_id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
