-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2026 at 08:49 PM
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
-- Database: `db_bakery`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-admin@bakery.com|127.0.0.1', 'i:1;', 1770318176),
('laravel-cache-admin@bakery.com|127.0.0.1:timer', 'i:1770318176;', 1770318176),
('laravel-cache-kasir@bakery.com|127.0.0.1', 'i:2;', 1770291092),
('laravel-cache-kasir@bakery.com|127.0.0.1:timer', 'i:1770291092;', 1770291092);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `category`, `price`, `stock`, `description`, `image`, `created_at`, `updated_at`) VALUES
(6, 'Roti Bakar Coklat Keju Meses', 'Makanan', 10000.00, 2, 'Aroma yang khas dengan bahan premium', 'menus/sg3ImsmznI5OeaP4iHLQGrZ2DQiEcCISHQdVpM7P.jpg', '2026-02-05 08:29:40', '2026-02-05 19:46:36'),
(7, 'Roti Coklat', 'Makanan', 5000.00, 19, 'Roti Coklat Lumer Di Mulut', 'menus/usXMxRAWBC9YRmu3RH5rsE5MbKabckKImypUXWmS.jpg', '2026-02-05 12:06:04', '2026-02-05 19:46:36'),
(8, 'Roti Keju', 'Makanan', 8000.00, 19, 'Roti Keju Premium', 'menus/u5gwVyt9FwhojwTAExRaSQzpdjGuMXRwJOwAcPKn.jpg', '2026-02-05 12:07:26', '2026-02-05 12:41:01'),
(9, 'Roti Coklat Keju', 'Makanan', 14000.00, 7, 'Roti Coklat Keju Premium', 'menus/o1jCUQ4UtW9nsJuyGRD4ONb4RaluH6IE1RGzzAHf.jpg', '2026-02-05 12:08:02', '2026-02-05 12:41:01'),
(10, 'Kopi Hitam', 'Minuman', 3000.00, 48, 'Kopi Hitam Panas', 'menus/5m7Q8U6YblQsYVwt8XTDzOdbbldXZXkmTnPWfdMF.jpg', '2026-02-05 12:10:59', '2026-02-05 19:46:36'),
(11, 'Kopi Susu', 'Minuman', 8000.00, 18, 'Kopi Susu Premium', 'menus/eUcXNsFMj6KmrSrLVi2NbyuvrjxOjqcJBOrSVzdj.png', '2026-02-05 12:11:38', '2026-02-05 12:41:01');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_02_03_154153_add_role_to_users_table', 2),
(5, '2026_02_03_154346_create_menus_table', 3),
(6, '2026_02_03_154353_create_orders_table', 3),
(7, '2026_02_03_170748_create_order_items_table', 4),
(8, '2026_02_05_110123_add_payment_columns_to_orders_table', 5),
(9, '2026_02_05_120744_add_stock_to_menus_table', 6),
(10, '2026_02_05_132207_create_vouchers_table', 7),
(11, '2026_02_05_165401_create_tables_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payment_code` varchar(255) DEFAULT NULL,
  `customer_name` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `table_number` int(11) NOT NULL,
  `voucher_code` varchar(255) DEFAULT NULL,
  `total_price` int(11) NOT NULL DEFAULT 0,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `transaction_note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `payment_code`, `customer_name`, `phone_number`, `table_number`, `voucher_code`, `total_price`, `status`, `transaction_note`, `created_at`, `updated_at`) VALUES
(8, 'PAY-8XK9W', 'Gab', '081247979122', 1, 'DISKON89', 0, 'completed', 'sukses', '2026-02-05 08:30:20', '2026-02-05 08:32:11'),
(9, 'PAY-NAFZI', 'Gab', '081247979122', 3, NULL, 10000, 'cancelled', NULL, '2026-02-05 08:34:05', '2026-02-05 11:14:23'),
(10, 'PAY-SNIVZ', 'riel', '081247979122', 4, NULL, 10000, 'cancelled', NULL, '2026-02-05 10:58:25', '2026-02-05 11:14:23'),
(11, 'PAY-PUTNY', 'Anda', '081247979122', 2, NULL, 10000, 'completed', 'sukses', '2026-02-05 11:15:46', '2026-02-05 11:17:58'),
(12, 'PAY-C7JI6', 'Gab', '081247979122', 1, NULL, 10000, 'cancelled', NULL, '2026-02-05 11:20:48', '2026-02-05 11:26:09'),
(13, 'PAY-U8EB6', 'Gab', '081247979122', 1, NULL, 10000, 'cancelled', NULL, '2026-02-05 11:32:35', '2026-02-05 11:36:28'),
(14, 'PAY-AF4MJ', 'Dimas', '1212121', 1, NULL, 10000, 'cancelled', NULL, '2026-02-05 11:33:07', '2026-02-05 11:36:28'),
(15, 'PAY-FHK6B', 'Gabriel Salwey', '081247979122', 3, NULL, 91000, 'cancelled', NULL, '2026-02-05 12:30:05', '2026-02-05 12:33:15'),
(16, 'PAY-ATONT', 'Gabriel Salwey', '081247979122', 3, NULL, 51000, 'completed', NULL, '2026-02-05 12:34:00', '2026-02-05 12:36:26'),
(17, 'PAY-B6WGT', 'Gabriel Salwey', '081247979122', 3, NULL, 20000, 'completed', NULL, '2026-02-05 12:34:22', '2026-02-05 12:36:23'),
(18, 'PAY-CBY8W', 'Budi', '081247979122', 5, NULL, 68000, 'cooking', NULL, '2026-02-05 12:41:01', '2026-02-05 12:42:20'),
(19, 'PAY-HYCSO', 'Gab', '081247979122', 1, NULL, 18000, 'unpaid', NULL, '2026-02-05 19:46:36', '2026-02-05 19:46:36');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `menu_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(15, 8, 6, 1, 10000, '2026-02-05 08:30:20', '2026-02-05 08:30:20'),
(16, 9, 6, 1, 10000, '2026-02-05 08:34:05', '2026-02-05 08:34:05'),
(17, 10, 6, 1, 10000, '2026-02-05 10:58:25', '2026-02-05 10:58:25'),
(18, 11, 6, 1, 10000, '2026-02-05 11:15:46', '2026-02-05 11:15:46'),
(19, 12, 6, 1, 10000, '2026-02-05 11:20:48', '2026-02-05 11:20:48'),
(20, 13, 6, 1, 10000, '2026-02-05 11:32:35', '2026-02-05 11:32:35'),
(21, 14, 6, 1, 10000, '2026-02-05 11:33:07', '2026-02-05 11:33:07'),
(22, 15, 6, 2, 10000, '2026-02-05 12:30:05', '2026-02-05 12:30:05'),
(23, 15, 7, 1, 5000, '2026-02-05 12:30:05', '2026-02-05 12:30:05'),
(24, 15, 9, 3, 14000, '2026-02-05 12:30:05', '2026-02-05 12:30:05'),
(25, 15, 11, 3, 8000, '2026-02-05 12:30:05', '2026-02-05 12:30:05'),
(26, 16, 6, 2, 10000, '2026-02-05 12:34:00', '2026-02-05 12:34:00'),
(27, 16, 9, 2, 14000, '2026-02-05 12:34:00', '2026-02-05 12:34:00'),
(28, 16, 10, 1, 3000, '2026-02-05 12:34:00', '2026-02-05 12:34:00'),
(29, 17, 6, 2, 10000, '2026-02-05 12:34:22', '2026-02-05 12:34:22'),
(30, 18, 6, 3, 10000, '2026-02-05 12:41:01', '2026-02-05 12:41:01'),
(31, 18, 8, 1, 8000, '2026-02-05 12:41:01', '2026-02-05 12:41:01'),
(32, 18, 9, 1, 14000, '2026-02-05 12:41:01', '2026-02-05 12:41:01'),
(33, 18, 11, 2, 8000, '2026-02-05 12:41:01', '2026-02-05 12:41:01'),
(34, 19, 6, 1, 10000, '2026-02-05 19:46:36', '2026-02-05 19:46:36'),
(35, 19, 7, 1, 5000, '2026-02-05 19:46:36', '2026-02-05 19:46:36'),
(36, 19, 10, 1, 3000, '2026-02-05 19:46:36', '2026-02-05 19:46:36');

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
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('9kYylRCxb667AH71CCGKJR8p8Mjzd0bNf9Gsmk0t', NULL, '192.168.1.3', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTFl1R2dIa0NoRmZhT09xcUV4bEt0Yzg4YWZoWUVGckxKVDdMVnhqdSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xOTIuMTY4LjEuMjo4MDAwL29yZGVyL3N1Y2Nlc3MvMTgiO3M6NToicm91dGUiO3M6MTM6Im9yZGVyLnN1Y2Nlc3MiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1770320562),
('GpuXb2xlg6tXIdXelxHHw991IptXtqmBfbIOoW9Q', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSEF5OFFOVEhLTEFZZ1ZSdFNmWjk0MEJaUEJOY1Q0VUg4azM4TlBURyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9vcmRlci9zdWNjZXNzLzE5IjtzOjU6InJvdXRlIjtzOjEzOiJvcmRlci5zdWNjZXNzIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1770320796),
('P9Lo4Rw4ZmXWj6hoX5quJOzX7bcqaKmAVQnFQFkJ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS1dmaW5nMEdUb1hnam51TkRTb3NKZ3dwdXpwcHU1blFUZHZWZTlmMyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9fQ==', 1770320813);

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `number` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'available',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`id`, `number`, `status`, `created_at`, `updated_at`) VALUES
(1, '1', 'occupied', '2026-02-05 10:02:36', '2026-02-05 11:50:39'),
(2, '2', 'available', '2026-02-05 10:02:42', '2026-02-05 11:17:03'),
(3, '3', 'occupied', '2026-02-05 10:02:46', '2026-02-05 12:35:27'),
(4, '4', 'available', '2026-02-05 10:02:50', '2026-02-05 11:14:23'),
(5, '5', 'available', '2026-02-05 12:39:06', '2026-02-05 12:41:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'customer',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Bakery', 'admin@gmail.com', NULL, '$2y$12$6ibW1mdEhxOiwlmpZxXG2OGebp.DFoFim6H16QO3G5kYjfmi.mePW', 'admin', NULL, '2026-02-03 08:50:05', '2026-02-03 08:50:05'),
(2, 'Chef Juna', 'chef@gmail.com', NULL, '$2y$12$RlbPeIi/3uV9x.QqXxGMyuYpfRxpwzwwbZADuXBPlNbflLInJbu/q', 'chief', NULL, '2026-02-03 10:28:19', '2026-02-05 03:03:54'),
(4, 'Kasir Andalan', 'kasir@gmail.com', NULL, '$2y$12$LM3XkoI/LZPjT3uu8baiXuiwEPcgL7J3heC2.fL3FVtvgigD/WpKC', 'cashier', NULL, '2026-02-05 03:18:56', '2026-02-05 03:18:56');

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE `vouchers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vouchers`
--

INSERT INTO `vouchers` (`id`, `code`, `amount`, `created_at`, `updated_at`) VALUES
(1, 'DISKON89', 10000, '2026-02-05 08:08:00', '2026-02-05 08:08:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tables_number_unique` (`number`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vouchers_code_unique` (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`),
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
