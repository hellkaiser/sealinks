-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2016 at 08:16 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sealinks`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fax` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `location_id` int(10) UNSIGNED DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `title`, `address`, `phone`, `fax`, `email`, `location_id`) VALUES
(14, 'ewqewqdasdasdasda', 'dasdasdasdasdas', '["01696827101","01696827102"]', '01696827101', 'admin@sealinksvietnam.com', 14),
(15, 'Sea Links Beach Hotel', 'Mui Ne, Phan Thiet, Viet nam', '["+84 062 222 0099"]', '840622220099', 'info@sealinkscity.com', 13);

-- --------------------------------------------------------

--
-- Table structure for table `general`
--

CREATE TABLE `general` (
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `keyword` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `is_index` tinyint(1) NOT NULL DEFAULT '1',
  `lang_sys` varchar(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'vn'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `general`
--

INSERT INTO `general` (`title`, `description`, `keyword`, `is_index`, `lang_sys`) VALUES
('Sea Links City', 'Cung cấp các dịch vụ du lịch tại Bình Thuận', 'du lich, du lich mui ne, du lich binh thuan', 1, 'vn');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `code` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`code`, `name`) VALUES
('en', 'english'),
('vn', 'vietnamese');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(10) UNSIGNED NOT NULL,
  `slug` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `slug`) VALUES
(13, 'sea-links-beach-hotel'),
(14, 'sea-links-golf-country-club');

-- --------------------------------------------------------

--
-- Table structure for table `locations_translate`
--

CREATE TABLE `locations_translate` (
  `id` int(10) UNSIGNED NOT NULL,
  `location_id` int(10) UNSIGNED NOT NULL,
  `lang_code` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `locations_translate`
--

INSERT INTO `locations_translate` (`id`, `location_id`, `lang_code`, `name`) VALUES
(9, 13, 'vn', 'Sea Links Beach Hotel'),
(10, 13, 'en', 'Sea Links Beach Hotel'),
(11, 14, 'vn', 'Sea Links Golf & Country Club'),
(12, 14, 'en', 'Sea Links Golf & Country Club');

-- --------------------------------------------------------

--
-- Table structure for table `location_service`
--

CREATE TABLE `location_service` (
  `id` int(10) UNSIGNED NOT NULL,
  `location_id` int(10) UNSIGNED NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `location_service`
--

INSERT INTO `location_service` (`id`, `location_id`, `service_id`) VALUES
(10, 13, 7),
(11, 14, 8),
(12, 14, 9),
(17, 14, 7);

-- --------------------------------------------------------

--
-- Table structure for table `mail`
--

CREATE TABLE `mail` (
  `driver` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `host` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `port` int(11) NOT NULL DEFAULT '0',
  `encryption` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `address_from` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `name_from` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `mail`
--

INSERT INTO `mail` (`driver`, `host`, `port`, `encryption`, `address_from`, `name_from`, `email`, `password`) VALUES
('smtp', 'smtp.mailgun.org', 587, 'tls', 'admin@sealinksvietnam.com', 'Sea Links City (No-Reply)', 'admin@sealinksvietnam.com', 'maiyeuem');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2016_04_22_011538_create-general', 1),
('2016_04_22_025703_create_mail', 2),
('2016_04_22_071839_create_contact', 3);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL,
  `parent` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `status`, `parent`) VALUES
(7, 1, 0),
(8, 1, 0),
(9, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `services_translate`
--

CREATE TABLE `services_translate` (
  `id` int(10) UNSIGNED NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `lang_code` varchar(2) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `services_translate`
--

INSERT INTO `services_translate` (`id`, `service_id`, `name`, `description`, `lang_code`) VALUES
(8, 7, 'Đặt Phòng', '<p>mô tả của đặt phòng</p>', 'vn'),
(9, 7, 'Accommodation', '<p>accommodation description</p>', 'en'),
(10, 8, 'Golf', '<p>mô tả của golf</p>', 'vn'),
(11, 8, 'Golf-En', '<p>Golf Description</p>', 'en'),
(12, 9, 'F&B', '<p>Mô Tả <small></small>F&amp;B&nbsp;</p>', 'vn'),
(13, 9, 'F&B', '<p>F&amp;B description<br></p>', 'en');

-- --------------------------------------------------------

--
-- Table structure for table `throttle`
--

CREATE TABLE `throttle` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attempts` int(11) NOT NULL DEFAULT '0',
  `suspended` tinyint(1) NOT NULL DEFAULT '0',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `last_attempt_at` timestamp NULL DEFAULT NULL,
  `suspended_at` timestamp NULL DEFAULT NULL,
  `banned_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `throttle`
--

INSERT INTO `throttle` (`id`, `user_id`, `ip_address`, `attempts`, `suspended`, `banned`, `last_attempt_at`, `suspended_at`, `banned_at`) VALUES
(1, 1, '::1', 0, 0, 0, NULL, NULL, NULL),
(2, 13, '::1', 0, 0, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `activation_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activated_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `persist_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reset_password_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `avatar`, `permissions`, `activated`, `activation_code`, `activated_at`, `last_login`, `persist_code`, `reset_password_code`, `first_name`, `last_name`, `created_at`, `updated_at`) VALUES
(1, 'admin@sealinksvietnam.com', '$2y$10$fXYZHZVeB7h4rwi.Yd73QuXk0kBsWoRE4yppkt20AFqN3KStNzXvK', '', '{"superuser":1}', 1, NULL, NULL, '2016-04-24 18:00:46', '$2y$10$dNsKs/Nnkjl9MpdsYOrCm.G2YaSwDtuQ.4a1u4dBbcyZ8KCahJtE6', NULL, 'Admin', 'Sea Links', '2016-04-15 01:13:41', '2016-04-24 18:00:46'),
(13, 'test@sealinksvietnam.com', '$2y$10$rS66fakqV/eFYuXaZMWWreN79vXq7J2flnLafPTrDkJv/ICaGp/aS', '', '{"rule_11":1,"rule_12":1,"rule_17":1}', 1, NULL, NULL, '2016-04-21 21:12:31', '$2y$10$dU1Ln1v0Z27TGW1xYUTeNe/T8OMv5W/uPtTfr.sni.gRxLEONH8Tq', NULL, 'Võ Văn', 'Thọ', '2016-04-19 21:20:22', '2016-04-21 21:12:31');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contacts_location_id_foreign` (`location_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `groups_name_unique` (`name`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations_translate`
--
ALTER TABLE `locations_translate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `locations_translate_location_id_foreign` (`location_id`),
  ADD KEY `locations_translate_lang_code_foreign` (`lang_code`);

--
-- Indexes for table `location_service`
--
ALTER TABLE `location_service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `location_service_location_id_foreign` (`location_id`),
  ADD KEY `location_service_service_id_foreign` (`service_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services_translate`
--
ALTER TABLE `services_translate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `services_translate_service_id_foreign` (`service_id`),
  ADD KEY `services_translate_lang_code_foreign` (`lang_code`);

--
-- Indexes for table `throttle`
--
ALTER TABLE `throttle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `throttle_user_id_index` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_activation_code_index` (`activation_code`),
  ADD KEY `users_reset_password_code_index` (`reset_password_code`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`user_id`,`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `locations_translate`
--
ALTER TABLE `locations_translate`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `location_service`
--
ALTER TABLE `location_service`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `services_translate`
--
ALTER TABLE `services_translate`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `throttle`
--
ALTER TABLE `throttle`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `locations_translate`
--
ALTER TABLE `locations_translate`
  ADD CONSTRAINT `locations_translate_lang_code_foreign` FOREIGN KEY (`lang_code`) REFERENCES `languages` (`code`) ON DELETE CASCADE,
  ADD CONSTRAINT `locations_translate_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `location_service`
--
ALTER TABLE `location_service`
  ADD CONSTRAINT `location_service_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `location_service_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `services_translate`
--
ALTER TABLE `services_translate`
  ADD CONSTRAINT `services_translate_lang_code_foreign` FOREIGN KEY (`lang_code`) REFERENCES `languages` (`code`) ON DELETE CASCADE,
  ADD CONSTRAINT `services_translate_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
