-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2021 at 04:44 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `postage`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2021_02_24_100434_create_users_table', 1),
(2, '2021_02_27_104201_create_shipments_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shipments`
--

CREATE TABLE `shipments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `deliveryType` enum('byUser','byCompany') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '1-delivery by himself 2-the company will come and take it from user',
  `originAddress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destinationAddress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receiverInformation` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deliveryVehicle` enum('byAir','byRail','byCar') COLLATE utf8mb4_unicode_ci NOT NULL,
  `postalInformation` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipments`
--

INSERT INTO `shipments` (`id`, `user_id`, `deliveryType`, `originAddress`, `destinationAddress`, `receiverInformation`, `deliveryVehicle`, `postalInformation`, `created_at`, `updated_at`) VALUES
(2, 1, 'byUser', '{\"string\":\"\\u0645\\u0633\\u06a9\\u0646 \\u0634\\u0647\\u0631 \\u062a\\u0647\\u0631\\u0627\\u0646 \\u0628\\u0632\\u0631\\u06af\",\"onMap\":{\"long\":\"51.355\",\"lat\":\"35.672\"}}', '{\"string\":\"\\u062f\\u0627\\u062f\\u0633\\u0631\\u0627\\u06cc \\u0645\\u0646\\u0642\\u0637\\u0647 27\",\"onMap\":{\"long\":\"51.366\",\"lat\":\"35.672\"}}', '{\"name\":\"\\u0633\\u0639\\u06cc\\u062f\",\"family\":\"\\u0639\\u0644\\u06cc\\u0632\\u0627\\u062f\\u0647\",\"mobile\":\"0910852554\",\"nationalCode\":\"654165484151\"}', 'byCar', '{\"name\":\"\\u0646\\u0627\\u0645\\u0647\",\"count\":\"1\",\"weight\":\"0.2\",\"volume\":\"10\"}', '2021-03-02 04:27:27', '2021-03-02 04:27:27'),
(3, 1, 'byUser', '{\"string\":\"\\u0645\\u0633\\u06a9\\u0646 \\u0634\\u0647\\u0631 \\u062a\\u0647\\u0631\\u0627\\u0646 \\u0628\\u0632\\u0631\\u06af\",\"state\":\"1\",\"city\":\"32\",\"onMap\":{\"long\":\"51.355\",\"lat\":\"35.672\"}}', '{\"string\":\"\\u062f\\u0627\\u062f\\u0633\\u0631\\u0627\\u06cc \\u0645\\u0646\\u0642\\u0637\\u0647 27\",\"state\":\"8\",\"city\":\"351\",\"onMap\":{\"long\":\"51.366\",\"lat\":\"35.672\"}}', '{\"name\":\"\\u0633\\u0639\\u06cc\\u062f\",\"family\":\"\\u0639\\u0644\\u06cc\\u0632\\u0627\\u062f\\u0647\",\"mobile\":\"0910852554\",\"nationalCode\":\"654165484151\"}', 'byCar', '{\"name\":\"\\u0646\\u0627\\u0645\\u0647\",\"count\":\"1\",\"weight\":\"0.2\",\"volume\":\"10\"}', '2021-03-02 04:28:57', '2021-03-02 04:28:57'),
(4, 1, 'byUser', '{\"string\":\"\\u062a\\u0647\\u0631\\u0627\\u0646 \\u062e\\u06cc\\u0627\\u0628\\u0627\\u0646 \\u06cc\\u06a9\\u0645\",\"state\":\"8\",\"city\":\"349\",\"onMap\":{\"long\":\"51.363\",\"lat\":\"35.671\"}}', '{\"string\":\"\\u0634\\u06cc\\u0631\\u0627\\u0632 \\u062e\\u06cc\\u0627\\u0628\\u0627\\u0646 \\u062f\\u0648\\u0645\",\"state\":\"19\",\"city\":\"838\",\"onMap\":{\"long\":\"51.369\",\"lat\":\"35.676\"}}', '{\"name\":\"\\u0633\\u0639\\u06cc\\u062f\",\"family\":\"\\u0639\\u0644\\u06cc\\u0632\\u0627\\u062f\\u0647\",\"mobile\":\"0910852554\",\"nationalCode\":\"654165484151\"}', 'byCar', '{\"name\":\"\\u0627\\u0633\\u0645 \\u0645\\u062d\\u0635\\u0648\\u0644\",\"count\":\"5\",\"weight\":\"200 \\u06a9\\u06cc\\u0644\\u0648\",\"volume\":\"10\"}', '2021-03-02 07:50:23', '2021-03-02 07:50:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userType` enum('agency','member') COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` int(11) NOT NULL,
  `member_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `family` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agencyInfo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nationalCode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `register_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userType`, `client_id`, `member_id`, `name`, `family`, `agencyInfo`, `mobile`, `nationalCode`, `telephone`, `email`, `password`, `gender`, `birthday`, `address`, `register_date`, `created_at`, `updated_at`) VALUES
(1, 'agency', 4, '477', 'محسن', 'رضایی', '{\"location\":{\"state\":{\"id\":\"8\",\"name\":\"\\u062a\\u0647\\u0631\\u0627\\u0646\"},\"city\":{\"id\":\"349\",\"name\":\"\\u0627\\u0633\\u0644\\u0627\\u0645\\u0634\\u0647\\u0631\"}}}', '09108453606', '95959595844', '09108453606', 'benyaminrmb2@gmail.com', '641b7754e063147020c19b3a13305835139eec0285308718f0c315aadad00cdf1457fbd926d11958244164ca2f99a7d04f3be0e5add256ad0072ac5f8ddd1527', 'Male', '1399-06-10', 'تهران مفتح شمالی خیابان مطهری پلاک 180 واحد 2', NULL, '2021-03-01 08:32:21', '2021-03-02 06:40:19'),
(2, 'agency', 4, '476', 'محمد', 'پورمختار', '{\"location\":{\"state\":{\"id\":\"8\",\"name\":\"\\u062a\\u0647\\u0631\\u0627\\u0646\"},\"city\":{\"id\":\"350\",\"name\":\"\\u0686\\u0647\\u0627\\u0631\\u062f\\u0627\\u0646\\u06af\\u0647\"}}}', '09108453606', '109999898987', '09108453606', 'b.44@yahoo.com', '641b7754e063147020c19b3a13305835139eec0285308718f0c315aadad00cdf1457fbd926d11958244164ca2f99a7d04f3be0e5add256ad0072ac5f8ddd1527', 'Male', '1399-06-10', 'تهران چهار دانگه روبروی پل خاجو پلاک 44', '2021-02-24 14:36:54', '2021-03-01 08:32:52', '2021-03-01 09:20:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipments`
--
ALTER TABLE `shipments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipments_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shipments`
--
ALTER TABLE `shipments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `shipments`
--
ALTER TABLE `shipments`
  ADD CONSTRAINT `shipments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
