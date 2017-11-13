-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Nov 06, 2017 at 12:38 AM
-- Server version: 5.6.36-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `nucleusvision`
--

-- --------------------------------------------------------

--
-- Table structure for table `investors`
--

CREATE TABLE IF NOT EXISTS `investors` (
  `investor_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `nationality` varchar(100) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `residence` varchar(100) NOT NULL,
  `id_type` varchar(100) NOT NULL,
  `id_num` varchar(100) NOT NULL,
  `doc1` varchar(255) NOT NULL,
  `doc2` varchar(255) NOT NULL,
  `thumb1` varchar(255) DEFAULT NULL,
  `thumb2` varchar(255) DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') NOT NULL DEFAULT 'Pending',
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`investor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `investors`
--

INSERT INTO `investors` (`investor_id`, `id`, `email`, `first_name`, `last_name`, `dob`, `nationality`, `gender`, `residence`, `id_type`, `id_num`, `doc1`, `doc2`, `thumb1`, `thumb2`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(3, '0xbb9bc244d798123fde783fcc1c72d3bb8c189413', 'sushmita@bellboi.com', 'Sushmita', 'Sinha', '2017-11-05', 'INDIAN', 'Female', 'UNITED STATES OF AMERICA', 'DRIVING LICENSE', '12345678', 'dfd671776641828689d3832984e592d0-2017-11-06-08-15-38.jpg', 'f48cb8b16b5e611f17dce147f816ca91-2017-11-06-08-15-38.jpg', NULL, NULL, 'Pending', NULL, NULL, '2017-11-06 15:15:38', NULL),
(4, '0xbb9bc244d798123fde783fcc1c72d3bb8c189413', 'satya.lst01@gmail.com', 'John', 'Smith', '1974-11-21', 'AMERICAN', 'Male', 'UNITED STATES OF AMERICA', 'NRIC', '32324', 'a55b901b454842bd56f1e3f5678fe012-2017-11-06-12-51-18.jpg', 'c1e62af238693cfe938eb403b17b341a-2017-11-06-12-51-18.jpg', 'uploads/thumbs/1509952878a55b901b454842bd56f1e3f5678fe012-2017-11-06-12-51-18.jpg', 'uploads/thumbs/1509952878c1e62af238693cfe938eb403b17b341a-2017-11-06-12-51-18.jpg', 'Approved', NULL, NULL, '2017-11-06 19:51:18', '2017-11-06 14:26:31');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_02_11_154328_create_user_logs_table', 1),
('2017_02_22_070427_create_investors_table', 1),
('2017_02_27_060328_create_roles_table', 1),
('2017_02_27_065923_create_role_user_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `role_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`role_id`),
  UNIQUE KEY `roles_role_unique` (`role`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role`) VALUES
(2, 'Admin'),
(1, 'Super'),
(3, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE IF NOT EXISTS `role_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_user_user_id_index` (`user_id`),
  KEY `role_user_role_id_index` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2017-10-27 07:40:09', '2017-10-27 07:40:09');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dt_sales_users` datetime NOT NULL,
  `dt_sales_public` datetime NOT NULL,
  `bonus_percentage` int(11) NOT NULL,
  `no_first_buyers` int(11) NOT NULL,
  `token_price` int(11) NOT NULL,
  `min_amount` int(11) NOT NULL,
  `audit_period_days` int(11) NOT NULL,
  `max_limit` varchar(100) NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `updated_by` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `dt_sales_users`, `dt_sales_public`, `bonus_percentage`, `no_first_buyers`, `token_price`, `min_amount`, `audit_period_days`, `max_limit`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, '2017-10-31 19:28:00', '2017-10-31 19:28:00', 10, 5, 10, 1000, 90, '-', '', '', '2017-10-31 08:29:15', '2017-10-31 08:44:45');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Inactive',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`, `status`, `remember_token`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Nucleus', 'admin@nucleus.vision', '$2y$10$9/iAlrzitygiWbR9nhtjj.81ukUnsxCFEalC3d.ELuCyPqmMEGm4a', 'Active', 'TRjBu4gQKvyWWu8WvwPK0VuP75cAqLk7ENFS915ZKKwG2mHOr4C9ohXb9qop', NULL, NULL, '2017-10-27 07:40:08', '2017-11-06 11:37:17');

-- --------------------------------------------------------

--
-- Table structure for table `user_logs`
--

CREATE TABLE IF NOT EXISTS `user_logs` (
  `user_log_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `login_time` datetime NOT NULL,
  `logout_time` datetime DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`user_log_id`),
  KEY `user_logs_user_id_index` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=46 ;

--
-- Dumping data for table `user_logs`
--

INSERT INTO `user_logs` (`user_log_id`, `user_id`, `login_time`, `logout_time`, `ip_address`) VALUES
(1, 1, '2017-10-27 18:40:44', '2017-10-27 19:45:34', '127.0.0.1'),
(2, 1, '2017-10-27 19:47:23', NULL, '127.0.0.1'),
(3, 1, '2017-10-27 19:59:01', '2017-10-27 20:01:19', '127.0.0.1'),
(4, 1, '2017-10-27 20:01:49', '2017-10-27 20:21:15', '127.0.0.1'),
(5, 1, '2017-10-27 20:27:49', '2017-10-27 20:44:52', '127.0.0.1'),
(6, 1, '2017-10-30 20:00:09', NULL, '127.0.0.1'),
(7, 1, '2017-10-31 14:52:30', '2017-10-31 15:10:35', '127.0.0.1'),
(8, 1, '2017-10-31 15:12:41', NULL, '127.0.0.1'),
(9, 1, '2017-10-31 05:04:56', '2017-10-31 06:33:21', '183.82.122.15'),
(10, 1, '2017-10-31 06:35:29', NULL, '183.82.122.15'),
(11, 1, '2017-10-31 06:48:43', '2017-10-31 07:26:24', '183.82.122.15'),
(12, 1, '2017-10-31 07:26:32', '2017-10-31 07:29:05', '183.82.122.15'),
(13, 1, '2017-10-31 07:29:13', '2017-10-31 07:30:35', '183.82.122.15'),
(14, 1, '2017-10-31 10:47:39', NULL, '70.121.16.237'),
(15, 1, '2017-10-31 18:40:22', '2017-10-31 18:41:31', '157.48.23.61'),
(16, 1, '2017-10-31 18:42:08', NULL, '70.121.16.237'),
(17, 1, '2017-10-31 18:52:29', '2017-10-31 18:54:29', '183.83.194.70'),
(18, 1, '2017-10-31 22:26:22', '2017-10-31 22:29:43', '183.82.122.15'),
(19, 1, '2017-10-31 22:34:38', NULL, '183.82.122.15'),
(20, 1, '2017-11-01 04:41:07', NULL, '183.82.122.15'),
(21, 1, '2017-11-01 04:47:41', NULL, '183.82.122.15'),
(22, 1, '2017-11-01 04:59:39', '2017-11-01 06:49:37', '183.82.122.15'),
(23, 1, '2017-11-01 06:50:29', NULL, '183.82.122.15'),
(24, 1, '2017-11-01 11:10:49', NULL, '183.83.194.70'),
(25, 1, '2017-11-01 19:38:04', '2017-11-01 20:09:01', '183.83.194.70'),
(26, 1, '2017-11-01 22:15:25', NULL, '208.54.86.228'),
(27, 1, '2017-11-01 22:43:50', '2017-11-02 02:10:04', '183.82.122.15'),
(28, 1, '2017-11-02 02:26:25', NULL, '183.82.122.15'),
(29, 1, '2017-11-02 08:58:17', NULL, '106.201.35.206'),
(30, 1, '2017-11-02 18:22:24', '2017-11-02 18:23:17', '183.83.194.70'),
(31, 1, '2017-11-02 18:23:30', '2017-11-02 18:30:55', '183.83.194.70'),
(32, 1, '2017-11-02 21:53:19', NULL, '70.121.16.237'),
(33, 1, '2017-11-02 22:41:18', NULL, '183.82.122.15'),
(34, 1, '2017-11-03 18:24:05', '2017-11-03 18:24:38', '157.48.14.179'),
(35, 1, '2017-11-03 22:22:42', NULL, '183.82.122.15'),
(36, 1, '2017-11-04 05:12:05', NULL, '183.82.122.15'),
(37, 1, '2017-11-04 19:48:29', NULL, '157.48.13.180'),
(38, 1, '2017-11-05 04:47:06', '2017-11-05 04:47:22', '183.83.194.70'),
(39, 1, '2017-11-05 06:55:25', '2017-11-05 06:55:35', '183.83.194.70'),
(40, 1, '2017-11-05 18:48:01', '2017-11-05 18:48:05', '183.83.194.70'),
(41, 1, '2017-11-05 19:42:08', NULL, '70.121.16.237'),
(42, 1, '2017-11-05 19:54:05', '2017-11-05 19:58:02', '183.83.194.70'),
(43, 1, '2017-11-05 20:27:38', '2017-11-05 20:27:56', '183.83.194.70'),
(44, 1, '2017-11-05 21:36:00', '2017-11-05 21:37:17', '157.48.15.207'),
(45, 1, '2017-11-06 00:24:53', NULL, '183.82.122.15');

-- --------------------------------------------------------

--
-- Table structure for table `user_verify`
--

CREATE TABLE IF NOT EXISTS `user_verify` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `token` text NOT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `email_activated` int(11) NOT NULL DEFAULT '0',
  `kyc_completed` int(11) NOT NULL DEFAULT '0',
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `user_verify`
--

INSERT INTO `user_verify` (`id`, `email`, `token`, `activation_code`, `email_activated`, `kyc_completed`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(22, 'sushmita@bellboi.com', 'd1deb18a74ff9e177098f237aad1229d', '8d3d147b1931dfead495d0433d88e83f802ab7af', 1, 1, NULL, NULL, '2017-11-06 15:07:35', NULL),
(25, 'satya.lst01@gmail.com', 'efb20056cb70d042282ac11fc8ec2d77', '31a6053bc17a0ef3b0fa186cce396c208fbd96a3', 1, 1, NULL, NULL, '2017-11-06 19:47:42', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
