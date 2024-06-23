-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2024 at 11:32 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lottery`
--

-- --------------------------------------------------------

--
-- Table structure for table `additional_details_user`
--

CREATE TABLE `additional_details_user` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pan_number` varchar(255) DEFAULT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `ifsc_code` varchar(255) NOT NULL,
  `verification_document_path` varchar(500) DEFAULT NULL,
  `verification_document_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `additional_details_user`
--

INSERT INTO `additional_details_user` (`id`, `user_id`, `pan_number`, `account_number`, `ifsc_code`, `verification_document_path`, `verification_document_type`) VALUES
(3, 21, 'cktpc3363b', '8468921900', 'PUBJ78541', 'verification_documents/1716923471_invoice.pdf', 'aadhar_card');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lotteries`
--

CREATE TABLE `lotteries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lottery_master_id` bigint(20) UNSIGNED NOT NULL,
  `expires_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lotteries`
--

INSERT INTO `lotteries` (`id`, `lottery_master_id`, `expires_on`, `created_at`, `updated_at`) VALUES
(6, 1, '2024-05-26 18:30:00', '2024-05-25 19:31:54', '2024-05-25 19:31:54'),
(8, 2, '2024-05-29 01:46:00', '2024-05-28 20:42:46', '2024-05-28 20:42:46'),
(10, 1, '2024-05-28 23:30:00', '2024-05-28 21:30:47', '2024-05-28 21:30:47'),
(11, 1, '2024-05-29 07:30:00', '2024-05-28 21:31:11', '2024-05-28 21:31:11');

-- --------------------------------------------------------

--
-- Table structure for table `lottery_master`
--

CREATE TABLE `lottery_master` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lottery_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lottery_master`
--

INSERT INTO `lottery_master` (`id`, `lottery_name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Mega Lottery', 'This is mega Lottery', '2024-05-25 16:57:39', '2024-05-25 16:57:39', NULL),
(2, 'Mini Lottery', 'This is Mini Lottery', '2024-05-28 20:41:33', '2024-05-28 20:41:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lottery_numbers`
--

CREATE TABLE `lottery_numbers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lottery_master_id` bigint(20) UNSIGNED NOT NULL,
  `lottery_id` bigint(20) UNSIGNED NOT NULL,
  `number` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lottery_numbers`
--

INSERT INTO `lottery_numbers` (`id`, `lottery_master_id`, `lottery_id`, `number`, `created_at`, `updated_at`) VALUES
(1, 1, 6, 10, '2024-05-25 19:31:54', '2024-05-25 19:31:54'),
(2, 1, 6, 11, '2024-05-25 19:31:54', '2024-05-25 19:31:54'),
(3, 1, 6, 12, '2024-05-25 19:31:54', '2024-05-25 19:31:54'),
(4, 1, 6, 13, '2024-05-25 19:31:54', '2024-05-25 19:31:54'),
(5, 1, 6, 14, '2024-05-25 19:31:54', '2024-05-25 19:31:54'),
(6, 1, 6, 15, '2024-05-25 19:31:54', '2024-05-25 19:31:54'),
(7, 1, 6, 16, '2024-05-25 19:31:55', '2024-05-25 19:31:55'),
(8, 1, 6, 17, '2024-05-25 19:31:55', '2024-05-25 19:31:55'),
(9, 1, 6, 18, '2024-05-25 19:31:55', '2024-05-25 19:31:55'),
(10, 1, 6, 19, '2024-05-25 19:31:55', '2024-05-25 19:31:55'),
(11, 1, 6, 20, '2024-05-25 19:31:55', '2024-05-25 19:31:55'),
(12, 1, 6, 21, '2024-05-25 19:31:55', '2024-05-25 19:31:55'),
(13, 1, 6, 22, '2024-05-25 19:31:55', '2024-05-25 19:31:55'),
(14, 1, 6, 23, '2024-05-25 19:31:55', '2024-05-25 19:31:55'),
(15, 1, 6, 24, '2024-05-25 19:31:55', '2024-05-25 19:31:55'),
(16, 1, 6, 25, '2024-05-25 19:31:55', '2024-05-25 19:31:55'),
(17, 1, 6, 26, '2024-05-25 19:31:55', '2024-05-25 19:31:55'),
(18, 1, 6, 27, '2024-05-25 19:31:55', '2024-05-25 19:31:55'),
(19, 1, 6, 28, '2024-05-25 19:31:55', '2024-05-25 19:31:55'),
(20, 1, 6, 29, '2024-05-25 19:31:55', '2024-05-25 19:31:55'),
(21, 1, 6, 30, '2024-05-25 19:31:55', '2024-05-25 19:31:55'),
(22, 1, 6, 31, '2024-05-25 19:31:55', '2024-05-25 19:31:55'),
(23, 1, 6, 32, '2024-05-25 19:31:55', '2024-05-25 19:31:55'),
(24, 1, 6, 33, '2024-05-25 19:31:55', '2024-05-25 19:31:55'),
(25, 1, 6, 34, '2024-05-25 19:31:55', '2024-05-25 19:31:55'),
(26, 1, 6, 35, '2024-05-25 19:31:55', '2024-05-25 19:31:55'),
(27, 1, 6, 36, '2024-05-25 19:31:55', '2024-05-25 19:31:55'),
(28, 1, 6, 37, '2024-05-25 19:31:55', '2024-05-25 19:31:55'),
(29, 1, 6, 38, '2024-05-25 19:31:55', '2024-05-25 19:31:55'),
(30, 1, 6, 39, '2024-05-25 19:31:55', '2024-05-25 19:31:55'),
(31, 1, 6, 40, '2024-05-25 19:31:55', '2024-05-25 19:31:55'),
(32, 1, 6, 41, '2024-05-25 19:31:55', '2024-05-25 19:31:55'),
(33, 1, 6, 42, '2024-05-25 19:31:55', '2024-05-25 19:31:55'),
(34, 1, 6, 43, '2024-05-25 19:31:55', '2024-05-25 19:31:55'),
(35, 1, 6, 44, '2024-05-25 19:31:55', '2024-05-25 19:31:55'),
(36, 1, 6, 45, '2024-05-25 19:31:55', '2024-05-25 19:31:55'),
(37, 1, 6, 46, '2024-05-25 19:31:55', '2024-05-25 19:31:55'),
(38, 1, 6, 47, '2024-05-25 19:31:55', '2024-05-25 19:31:55'),
(39, 1, 6, 48, '2024-05-25 19:31:55', '2024-05-25 19:31:55'),
(40, 1, 6, 49, '2024-05-25 19:31:55', '2024-05-25 19:31:55'),
(41, 1, 6, 50, '2024-05-25 19:31:55', '2024-05-25 19:31:55'),
(48, 2, 8, 12, '2024-05-28 20:42:46', '2024-05-28 20:42:46'),
(49, 2, 8, 13, '2024-05-28 20:42:46', '2024-05-28 20:42:46'),
(50, 2, 8, 14, '2024-05-28 20:42:46', '2024-05-28 20:42:46'),
(51, 2, 8, 15, '2024-05-28 20:42:46', '2024-05-28 20:42:46'),
(52, 2, 8, 16, '2024-05-28 20:42:46', '2024-05-28 20:42:46'),
(53, 2, 8, 17, '2024-05-28 20:42:46', '2024-05-28 20:42:46'),
(54, 2, 8, 18, '2024-05-28 20:42:46', '2024-05-28 20:42:46'),
(55, 2, 8, 19, '2024-05-28 20:42:46', '2024-05-28 20:42:46'),
(56, 2, 8, 20, '2024-05-28 20:42:46', '2024-05-28 20:42:46'),
(59, 1, 10, 1, '2024-05-28 21:30:47', '2024-05-28 21:30:47'),
(60, 1, 10, 2, '2024-05-28 21:30:47', '2024-05-28 21:30:47'),
(61, 1, 10, 3, '2024-05-28 21:30:47', '2024-05-28 21:30:47'),
(62, 1, 10, 4, '2024-05-28 21:30:47', '2024-05-28 21:30:47'),
(63, 1, 10, 5, '2024-05-28 21:30:47', '2024-05-28 21:30:47'),
(64, 1, 11, 1, '2024-05-28 21:31:11', '2024-05-28 21:31:11'),
(65, 1, 11, 2, '2024-05-28 21:31:11', '2024-05-28 21:31:11'),
(66, 1, 11, 3, '2024-05-28 21:31:11', '2024-05-28 21:31:11'),
(67, 1, 11, 4, '2024-05-28 21:31:11', '2024-05-28 21:31:11'),
(68, 1, 11, 5, '2024-05-28 21:31:11', '2024-05-28 21:31:11');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_05_10_143703_create_permission_tables', 2),
(6, '2024_05_25_184144_create_lottery_master_table', 3),
(7, '2024_05_25_230250_create_lotteries_table', 4),
(8, '2024_05_25_231934_create_lottery_numbers_table', 5),
(9, '2024_05_26_031834_create_user_chosen_numbers_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(6, 'App\\Models\\User', 6),
(7, 'App\\Models\\User', 20),
(7, 'App\\Models\\User', 21);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `lottery_id` int(11) NOT NULL,
  `numbers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`numbers`)),
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `lottery_id`, `numbers`, `created_at`, `updated_at`) VALUES
(2, 21, 6, NULL, '2024-05-28 20:57:49', '2024-05-28 20:57:49'),
(3, 21, 8, NULL, '2024-05-28 21:02:44', '2024-05-28 21:02:44'),
(4, 21, 6, NULL, '2024-05-28 21:04:15', '2024-05-28 21:04:15');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(6, 'superadmin', 'web', NULL, NULL),
(7, 'user', 'web', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `payment_amount` decimal(15,2) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `payment_reference_number` varchar(500) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `order_id`, `payment_status`, `payment_amount`, `payment_mode`, `payment_reference_number`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 2, 'success', '200.00', 'Online', 'riWmpi33Kk', 21, '2024-05-28 20:57:49', '2024-05-28 20:57:49'),
(2, 3, 'success', '200.00', 'Online', 'awa0f7HJAv', 21, '2024-05-28 21:02:44', '2024-05-28 21:02:44'),
(3, 4, 'success', '200.00', 'Online', 'DBAU9TgWrG', 21, '2024-05-28 21:04:15', '2024-05-28 21:04:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `is_otp_verified` tinyint(1) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `otp` varchar(20) DEFAULT NULL,
  `profile_picture` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `mobile`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `date_of_birth`, `is_otp_verified`, `gender`, `otp`, `profile_picture`) VALUES
(6, 'Superadmin', 'superadmin@mail.com', NULL, NULL, '$2y$10$q6DSp033hHupXA9UE5wmNebwlGGzdFu09Xn.kRdwovs8mR73ccHzS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 'Ashutosh User', 'ashutosh-user@gmail.com', '8468921900', NULL, '$2y$10$mDuVvi9aIZCzNn6wqKYofes.rteDP13HHqSzU9cQJcWSsecYAejWa', NULL, '2024-05-28 18:38:23', '2024-05-28 19:11:28', '2001-11-11', NULL, NULL, NULL, 'profile_pictures/1716923488_ifci--600.png');

-- --------------------------------------------------------

--
-- Table structure for table `user_chosen_numbers`
--

CREATE TABLE `user_chosen_numbers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `lottery_id` bigint(20) UNSIGNED NOT NULL,
  `lottery_master_id` bigint(20) UNSIGNED NOT NULL,
  `number` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_chosen_numbers`
--

INSERT INTO `user_chosen_numbers` (`id`, `user_id`, `lottery_id`, `lottery_master_id`, `number`, `created_at`, `updated_at`) VALUES
(1, 21, 6, 1, 10, '2024-05-28 20:57:49', '2024-05-28 20:57:49'),
(2, 21, 6, 1, 11, '2024-05-28 20:57:49', '2024-05-28 20:57:49'),
(3, 21, 6, 1, 12, '2024-05-28 20:57:49', '2024-05-28 20:57:49'),
(4, 21, 6, 1, 16, '2024-05-28 20:57:49', '2024-05-28 20:57:49'),
(5, 21, 8, 2, 13, '2024-05-28 21:02:44', '2024-05-28 21:02:44'),
(6, 21, 6, 1, 13, '2024-05-28 21:04:15', '2024-05-28 21:04:15'),
(7, 21, 6, 1, 32, '2024-05-28 21:04:15', '2024-05-28 21:04:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `additional_details_user`
--
ALTER TABLE `additional_details_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `lotteries`
--
ALTER TABLE `lotteries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lotteries_lottery_master_id_foreign` (`lottery_master_id`);

--
-- Indexes for table `lottery_master`
--
ALTER TABLE `lottery_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lottery_numbers`
--
ALTER TABLE `lottery_numbers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lottery_numbers_lottery_master_id_foreign` (`lottery_master_id`),
  ADD KEY `lottery_numbers_lottery_id_foreign` (`lottery_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_chosen_numbers`
--
ALTER TABLE `user_chosen_numbers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_chosen_numbers_user_id_foreign` (`user_id`),
  ADD KEY `user_chosen_numbers_lottery_id_foreign` (`lottery_id`),
  ADD KEY `user_chosen_numbers_lottery_master_id_foreign` (`lottery_master_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `additional_details_user`
--
ALTER TABLE `additional_details_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lotteries`
--
ALTER TABLE `lotteries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `lottery_master`
--
ALTER TABLE `lottery_master`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lottery_numbers`
--
ALTER TABLE `lottery_numbers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user_chosen_numbers`
--
ALTER TABLE `user_chosen_numbers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lotteries`
--
ALTER TABLE `lotteries`
  ADD CONSTRAINT `lotteries_lottery_master_id_foreign` FOREIGN KEY (`lottery_master_id`) REFERENCES `lottery_master` (`id`);

--
-- Constraints for table `lottery_numbers`
--
ALTER TABLE `lottery_numbers`
  ADD CONSTRAINT `lottery_numbers_lottery_id_foreign` FOREIGN KEY (`lottery_id`) REFERENCES `lotteries` (`id`),
  ADD CONSTRAINT `lottery_numbers_lottery_master_id_foreign` FOREIGN KEY (`lottery_master_id`) REFERENCES `lottery_master` (`id`);

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_chosen_numbers`
--
ALTER TABLE `user_chosen_numbers`
  ADD CONSTRAINT `user_chosen_numbers_lottery_id_foreign` FOREIGN KEY (`lottery_id`) REFERENCES `lotteries` (`id`),
  ADD CONSTRAINT `user_chosen_numbers_lottery_master_id_foreign` FOREIGN KEY (`lottery_master_id`) REFERENCES `lottery_master` (`id`),
  ADD CONSTRAINT `user_chosen_numbers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
