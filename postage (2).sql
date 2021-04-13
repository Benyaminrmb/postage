-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2021 at 09:19 AM
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
  `agency_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deliveryType` enum('byUser','byCompany') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '1-delivery by himself 2-the company will come and take it from user',
  `originAddress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destinationAddress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receiverInformation` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deliveryVehicle` enum('byAir','byRail','byCar') COLLATE utf8mb4_unicode_ci NOT NULL,
  `postalInformation` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `accessResponse` enum('denied','granted') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'denied',
  `stepStatus` enum('notApproved','onProcess','getProduct','onTheWay','receivedByTheRecipient') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'notApproved',
  `dataResponse` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ordered_at` timestamp NULL DEFAULT NULL,
  `seen_at` timestamp NULL DEFAULT NULL,
  `response_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userType` enum('agency','member') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'member',
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
  `token` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `register_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token_expired_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userType`, `client_id`, `member_id`, `name`, `family`, `agencyInfo`, `mobile`, `nationalCode`, `telephone`, `email`, `password`, `gender`, `birthday`, `address`, `token`, `register_date`, `token_expired_at`, `created_at`, `updated_at`) VALUES
(1, 'member', 4, '742', 'Mr. Orlando Konopelski', 'Weldon Abbott', '{\"location\":{\"state\":{\"id\":\"8\",\"name\":\"\\u062a\\u0647\\u0631\\u0627\\u0646\"},\"city\":{\"id\":\"349\",\"name\":\"\\u0627\\u0633\\u0644\\u0627\\u0645\\u0634\\u0647\\u0631\"}}}', '638', '870', '963', 'rosenbaum.astrid@example.org', '641b7754e063147020c19b3a13305835139eec0285308718f0c315aadad00cdf1457fbd926d11958244164ca2f99a7d04f3be0e5add256ad0072ac5f8ddd1527', 'Male', '2021-03-15 08:57:13', 'agency', '4', '2021-03-15 08:57:13', NULL, '2021-03-15 05:27:13', '2021-03-15 05:27:13'),
(2, 'member', 4, '933', 'Alanna Morissette', 'Guadalupe Little', '{\"location\":{\"state\":{\"id\":\"8\",\"name\":\"\\u062a\\u0647\\u0631\\u0627\\u0646\"},\"city\":{\"id\":\"350\",\"name\":\"\\u0686\\u0647\\u0627\\u0631\\u062f\\u0627\\u0646\\u06af\\u0647\"}}}', '982', '780', '878', 'mante.salma@example.net', '641b7754e063147020c19b3a13305835139eec0285308718f0c315aadad00cdf1457fbd926d11958244164ca2f99a7d04f3be0e5add256ad0072ac5f8ddd1527', 'Male', '2021-03-15 08:57:13', 'agency', '4', '2021-03-15 08:57:13', NULL, '2021-03-15 05:27:14', '2021-03-15 05:27:14'),
(3, 'member', 4, '723', 'Jackson Kling DVM', 'Berneice Heidenreich', '{\"location\":{\"state\":{\"id\":\"8\",\"name\":\"\\u062a\\u0647\\u0631\\u0627\\u0646\"},\"city\":{\"id\":\"349\",\"name\":\"\\u0627\\u0633\\u0644\\u0627\\u0645\\u0634\\u0647\\u0631\"}}}', '737', '589', '502', 'gokeefe@example.org', '641b7754e063147020c19b3a13305835139eec0285308718f0c315aadad00cdf1457fbd926d11958244164ca2f99a7d04f3be0e5add256ad0072ac5f8ddd1527', 'Male', '2021-03-15 08:57:13', 'agency', '4', '2021-03-15 08:57:13', NULL, '2021-03-15 05:27:14', '2021-03-15 05:27:14'),
(4, 'member', 4, '933', 'Florine Jacobson', 'Anita Ondricka', '{\"location\":{\"state\":{\"id\":\"8\",\"name\":\"\\u062a\\u0647\\u0631\\u0627\\u0646\"},\"city\":{\"id\":\"349\",\"name\":\"\\u0627\\u0633\\u0644\\u0627\\u0645\\u0634\\u0647\\u0631\"}}}', '937', '649', '805', 'armstrong.philip@example.org', '641b7754e063147020c19b3a13305835139eec0285308718f0c315aadad00cdf1457fbd926d11958244164ca2f99a7d04f3be0e5add256ad0072ac5f8ddd1527', 'Male', '2021-03-15 08:57:13', 'member', '4', '2021-03-15 08:57:13', NULL, '2021-03-15 05:27:14', '2021-03-15 05:27:14'),
(5, 'agency', 4, '793', 'Carlo Lueilwitz', 'Mr. Kelley Homenick I', '{\"location\":{\"state\":{\"id\":\"8\",\"name\":\"\\u062a\\u0647\\u0631\\u0627\\u0646\"},\"city\":{\"id\":\"349\",\"name\":\"\\u0627\\u0633\\u0644\\u0627\\u0645\\u0634\\u0647\\u0631\"}}}', '576', '752', '849', 'ritchie.carmen@example.org', '641b7754e063147020c19b3a13305835139eec0285308718f0c315aadad00cdf1457fbd926d11958244164ca2f99a7d04f3be0e5add256ad0072ac5f8ddd1527', 'Male', '2021-03-15 08:57:13', 'agency', '4', '2021-03-15 08:57:13', NULL, '2021-03-15 05:27:14', '2021-03-15 05:27:14'),
(6, 'member', 4, '618', 'Mellie Swift III', 'Mrs. Eve Orn V', '{\"location\":{\"state\":{\"id\":\"8\",\"name\":\"\\u062a\\u0647\\u0631\\u0627\\u0646\"},\"city\":{\"id\":\"349\",\"name\":\"\\u0627\\u0633\\u0644\\u0627\\u0645\\u0634\\u0647\\u0631\"}}}', '877', '915', '502', 'matilda.roberts@example.org', '641b7754e063147020c19b3a13305835139eec0285308718f0c315aadad00cdf1457fbd926d11958244164ca2f99a7d04f3be0e5add256ad0072ac5f8ddd1527', 'Male', '2021-03-15 08:57:13', 'agency', '4', '2021-03-15 08:57:13', NULL, '2021-03-15 05:27:14', '2021-03-15 05:27:14'),
(7, 'member', 4, '673', 'Dr. Doyle Fahey', 'Llewellyn Kuhlman', '{\"location\":{\"state\":{\"id\":\"8\",\"name\":\"\\u062a\\u0647\\u0631\\u0627\\u0646\"},\"city\":{\"id\":\"349\",\"name\":\"\\u0627\\u0633\\u0644\\u0627\\u0645\\u0634\\u0647\\u0631\"}}}', '995', '910', '857', 'zhermann@example.net', '641b7754e063147020c19b3a13305835139eec0285308718f0c315aadad00cdf1457fbd926d11958244164ca2f99a7d04f3be0e5add256ad0072ac5f8ddd1527', 'Male', '2021-03-15 08:57:13', 'agency', '4', '2021-03-15 08:57:13', NULL, '2021-03-15 05:27:14', '2021-03-15 05:27:14'),
(8, 'member', 4, '631', 'Gaetano Lehner', 'Mrs. Hildegard Heaney', '{\"location\":{\"state\":{\"id\":\"8\",\"name\":\"\\u062a\\u0647\\u0631\\u0627\\u0646\"},\"city\":{\"id\":\"349\",\"name\":\"\\u0627\\u0633\\u0644\\u0627\\u0645\\u0634\\u0647\\u0631\"}}}', '827', '661', '536', 'hstrosin@example.net', '641b7754e063147020c19b3a13305835139eec0285308718f0c315aadad00cdf1457fbd926d11958244164ca2f99a7d04f3be0e5add256ad0072ac5f8ddd1527', 'Male', '2021-03-15 08:57:13', 'agency', '4', '2021-03-15 08:57:13', NULL, '2021-03-15 05:27:14', '2021-03-15 05:27:14'),
(9, 'member', 4, '736', 'Dr. Blaze Rath', 'Brennon Bernhard', '{\"location\":{\"state\":{\"id\":\"8\",\"name\":\"\\u062a\\u0647\\u0631\\u0627\\u0646\"},\"city\":{\"id\":\"350\",\"name\":\"\\u0686\\u0647\\u0627\\u0631\\u062f\\u0627\\u0646\\u06af\\u0647\"}}}', '830', '764', '887', 'nhills@example.net', '641b7754e063147020c19b3a13305835139eec0285308718f0c315aadad00cdf1457fbd926d11958244164ca2f99a7d04f3be0e5add256ad0072ac5f8ddd1527', 'Male', '2021-03-15 08:57:13', 'member', '4', '2021-03-15 08:57:13', NULL, '2021-03-15 05:27:14', '2021-03-15 05:27:14'),
(10, 'member', 4, '597', 'Darron Romaguera', 'Miss Dortha Kertzmann', '{\"location\":{\"state\":{\"id\":\"8\",\"name\":\"\\u062a\\u0647\\u0631\\u0627\\u0646\"},\"city\":{\"id\":\"350\",\"name\":\"\\u0686\\u0647\\u0627\\u0631\\u062f\\u0627\\u0646\\u06af\\u0647\"}}}', '727', '916', '910', 'xcarter@example.org', '641b7754e063147020c19b3a13305835139eec0285308718f0c315aadad00cdf1457fbd926d11958244164ca2f99a7d04f3be0e5add256ad0072ac5f8ddd1527', 'Male', '2021-03-15 08:57:13', 'member', '4', '2021-03-15 08:57:13', NULL, '2021-03-15 05:27:14', '2021-03-15 05:27:14'),
(11, 'member', 4, '642', 'Edward Ortiz I', 'Mrs. Abbey Crona', '{\"location\":{\"state\":{\"id\":\"8\",\"name\":\"\\u062a\\u0647\\u0631\\u0627\\u0646\"},\"city\":{\"id\":\"349\",\"name\":\"\\u0627\\u0633\\u0644\\u0627\\u0645\\u0634\\u0647\\u0631\"}}}', '872', '840', '796', 'alyce.morar@example.net', '641b7754e063147020c19b3a13305835139eec0285308718f0c315aadad00cdf1457fbd926d11958244164ca2f99a7d04f3be0e5add256ad0072ac5f8ddd1527', 'Male', '2021-03-15 08:57:14', 'agency', '4', '2021-03-15 08:57:14', NULL, '2021-03-15 05:27:14', '2021-03-15 05:27:14'),
(12, 'member', 4, '748', 'Rosalee Daugherty Jr.', 'Cameron Shields', '{\"location\":{\"state\":{\"id\":\"8\",\"name\":\"\\u062a\\u0647\\u0631\\u0627\\u0646\"},\"city\":{\"id\":\"349\",\"name\":\"\\u0627\\u0633\\u0644\\u0627\\u0645\\u0634\\u0647\\u0631\"}}}', '693', '745', '834', 'sschulist@example.net', '641b7754e063147020c19b3a13305835139eec0285308718f0c315aadad00cdf1457fbd926d11958244164ca2f99a7d04f3be0e5add256ad0072ac5f8ddd1527', 'Male', '2021-03-15 08:57:14', 'member', '4', '2021-03-15 08:57:14', NULL, '2021-03-15 05:27:14', '2021-03-15 05:27:14'),
(13, 'member', 4, '569', 'Fannie Crooks Jr.', 'Jo Moen', '{\"location\":{\"state\":{\"id\":\"8\",\"name\":\"\\u062a\\u0647\\u0631\\u0627\\u0646\"},\"city\":{\"id\":\"349\",\"name\":\"\\u0627\\u0633\\u0644\\u0627\\u0645\\u0634\\u0647\\u0631\"}}}', '687', '820', '659', 'janice.torp@example.com', '641b7754e063147020c19b3a13305835139eec0285308718f0c315aadad00cdf1457fbd926d11958244164ca2f99a7d04f3be0e5add256ad0072ac5f8ddd1527', 'Male', '2021-03-15 08:57:14', 'member', '4', '2021-03-15 08:57:14', NULL, '2021-03-15 05:27:14', '2021-03-15 05:27:14'),
(14, 'agency', 4, '890', 'Mrs. Melyna Donnelly', 'Prof. Lambert Lakin DDS', '{\"location\":{\"state\":{\"id\":\"8\",\"name\":\"\\u062a\\u0647\\u0631\\u0627\\u0646\"},\"city\":{\"id\":\"350\",\"name\":\"\\u0686\\u0647\\u0627\\u0631\\u062f\\u0627\\u0646\\u06af\\u0647\"}}}', '989', '506', '593', 'nelda48@example.com', '641b7754e063147020c19b3a13305835139eec0285308718f0c315aadad00cdf1457fbd926d11958244164ca2f99a7d04f3be0e5add256ad0072ac5f8ddd1527', 'Male', '2021-03-15 08:57:14', 'agency', '4', '2021-03-15 08:57:14', NULL, '2021-03-15 05:27:14', '2021-03-15 05:27:14'),
(15, 'member', 4, '754', 'Hal Mosciski', 'Chelsey Hoppe', '{\"location\":{\"state\":{\"id\":\"8\",\"name\":\"\\u062a\\u0647\\u0631\\u0627\\u0646\"},\"city\":{\"id\":\"349\",\"name\":\"\\u0627\\u0633\\u0644\\u0627\\u0645\\u0634\\u0647\\u0631\"}}}', '527', '882', '537', 'bernhard.kuphal@example.net', '641b7754e063147020c19b3a13305835139eec0285308718f0c315aadad00cdf1457fbd926d11958244164ca2f99a7d04f3be0e5add256ad0072ac5f8ddd1527', 'Male', '2021-03-15 08:57:14', 'member', '4', '2021-03-15 08:57:14', NULL, '2021-03-15 05:27:14', '2021-03-15 05:27:14'),
(16, 'member', 4, '826', 'Cloyd Pacocha', 'Alvina Christiansen', '{\"location\":{\"state\":{\"id\":\"8\",\"name\":\"\\u062a\\u0647\\u0631\\u0627\\u0646\"},\"city\":{\"id\":\"350\",\"name\":\"\\u0686\\u0647\\u0627\\u0631\\u062f\\u0627\\u0646\\u06af\\u0647\"}}}', '988', '947', '731', 'bruen.ally@example.net', '641b7754e063147020c19b3a13305835139eec0285308718f0c315aadad00cdf1457fbd926d11958244164ca2f99a7d04f3be0e5add256ad0072ac5f8ddd1527', 'Male', '2021-03-15 08:57:14', 'member', '4', '2021-03-15 08:57:14', NULL, '2021-03-15 05:27:14', '2021-03-15 05:27:14'),
(17, 'member', 4, '613', 'Elmer Gutmann', 'Dr. Eloisa Altenwerth', '{\"location\":{\"state\":{\"id\":\"8\",\"name\":\"\\u062a\\u0647\\u0631\\u0627\\u0646\"},\"city\":{\"id\":\"350\",\"name\":\"\\u0686\\u0647\\u0627\\u0631\\u062f\\u0627\\u0646\\u06af\\u0647\"}}}', '878', '615', '792', 'camille65@example.com', '641b7754e063147020c19b3a13305835139eec0285308718f0c315aadad00cdf1457fbd926d11958244164ca2f99a7d04f3be0e5add256ad0072ac5f8ddd1527', 'Male', '2021-03-15 08:57:14', 'agency', '4', '2021-03-15 08:57:14', NULL, '2021-03-15 05:27:14', '2021-03-15 05:27:14'),
(18, 'member', 4, '894', 'Mr. Shane Jacobi', 'Thalia Hermiston', '{\"location\":{\"state\":{\"id\":\"8\",\"name\":\"\\u062a\\u0647\\u0631\\u0627\\u0646\"},\"city\":{\"id\":\"349\",\"name\":\"\\u0627\\u0633\\u0644\\u0627\\u0645\\u0634\\u0647\\u0631\"}}}', '667', '973', '643', 'ken.braun@example.org', '641b7754e063147020c19b3a13305835139eec0285308718f0c315aadad00cdf1457fbd926d11958244164ca2f99a7d04f3be0e5add256ad0072ac5f8ddd1527', 'Male', '2021-03-15 08:57:15', 'member', '4', '2021-03-15 08:57:15', NULL, '2021-03-15 05:27:15', '2021-03-15 05:27:15'),
(19, 'agency', 4, '622', 'Hailee McGlynn', 'Prof. Dalton Denesik PhD', '{\"location\":{\"state\":{\"id\":\"8\",\"name\":\"\\u062a\\u0647\\u0631\\u0627\\u0646\"},\"city\":{\"id\":\"350\",\"name\":\"\\u0686\\u0647\\u0627\\u0631\\u062f\\u0627\\u0646\\u06af\\u0647\"}}}', '855', '975', '690', 'lucienne.waters@example.net', '641b7754e063147020c19b3a13305835139eec0285308718f0c315aadad00cdf1457fbd926d11958244164ca2f99a7d04f3be0e5add256ad0072ac5f8ddd1527', 'Male', '2021-03-15 08:57:15', 'agency', '4', '2021-03-15 08:57:15', NULL, '2021-03-15 05:27:15', '2021-03-15 05:27:15'),
(20, 'member', 4, '655', 'Alysson Keeling', 'Mr. Rory Steuber', '{\"location\":{\"state\":{\"id\":\"8\",\"name\":\"\\u062a\\u0647\\u0631\\u0627\\u0646\"},\"city\":{\"id\":\"349\",\"name\":\"\\u0627\\u0633\\u0644\\u0627\\u0645\\u0634\\u0647\\u0631\"}}}', '569', '556', '626', 'deontae25@example.com', '641b7754e063147020c19b3a13305835139eec0285308718f0c315aadad00cdf1457fbd926d11958244164ca2f99a7d04f3be0e5add256ad0072ac5f8ddd1527', 'Male', '2021-03-15 08:57:15', 'agency', '4', '2021-03-15 08:57:15', NULL, '2021-03-15 05:27:15', '2021-03-15 05:27:15'),
(21, 'agency', 4, '477', 'benyamin', 'bolhasani', '{\"location\":{\"state\":{\"id\":\"8\",\"name\":\"\\u062a\\u0647\\u0631\\u0627\\u0646\"},\"city\":{\"id\":\"349\",\"name\":\"\\u0627\\u0633\\u0644\\u0627\\u0645\\u0634\\u0647\\u0631\"}}}', '09108453606', '4120748235', '0212612565', 'benyaminrmb2@gmail.com', '641b7754e063147020c19b3a13305835139eec0285308718f0c315aadad00cdf1457fbd926d11958244164ca2f99a7d04f3be0e5add256ad0072ac5f8ddd1527', 'Male', 'benyaminrmb2@gmail.com', 'نهران مولوی خیابان زرگنده پلاک 26', 'b497df409891e1d36cf4d414db83a69248436476519b07d03422746f4e977c1b', NULL, '2021-04-11 10:24:20', '2021-03-15 05:27:27', '2021-04-11 07:24:50'),
(22, 'agency', 4, '995', 'Noah Braun', 'Mr. Bailey Kuvalis', '{\"location\":{\"state\":{\"id\":\"8\",\"name\":\"\\u062a\\u0647\\u0631\\u0627\\u0646\"},\"city\":{\"id\":\"349\",\"name\":\"\\u0627\\u0633\\u0644\\u0627\\u0645\\u0634\\u0647\\u0631\"}}}', '940', '850', '827', 'magdalena.koch@example.org', '641b7754e063147020c19b3a13305835139eec0285308718f0c315aadad00cdf1457fbd926d11958244164ca2f99a7d04f3be0e5add256ad0072ac5f8ddd1527', 'Male', '2021-03-16 07:29:46', 'agency', '4', '2021-03-16 07:29:46', NULL, '2021-03-16 03:59:46', '2021-03-16 03:59:46'),
(23, 'agency', 4, '530', 'Mr. Mason Blanda', 'Ms. Prudence Walter DDS', '{\"location\":{\"state\":{\"id\":\"8\",\"name\":\"\\u062a\\u0647\\u0631\\u0627\\u0646\"},\"city\":{\"id\":\"349\",\"name\":\"\\u0627\\u0633\\u0644\\u0627\\u0645\\u0634\\u0647\\u0631\"}}}', '804', '696', '957', 'kameron.pouros@example.org', '641b7754e063147020c19b3a13305835139eec0285308718f0c315aadad00cdf1457fbd926d11958244164ca2f99a7d04f3be0e5add256ad0072ac5f8ddd1527', 'Male', '2021-03-16 07:29:46', 'agency', '4', '2021-03-16 07:29:46', NULL, '2021-03-16 03:59:46', '2021-03-16 03:59:46'),
(24, 'member', 4, '706', 'Helena Marquardt', 'Samantha Waters DDS', '{\"location\":{\"state\":{\"id\":\"8\",\"name\":\"\\u062a\\u0647\\u0631\\u0627\\u0646\"},\"city\":{\"id\":\"349\",\"name\":\"\\u0627\\u0633\\u0644\\u0627\\u0645\\u0634\\u0647\\u0631\"}}}', '975', '638', '738', 'nconroy@example.org', '641b7754e063147020c19b3a13305835139eec0285308718f0c315aadad00cdf1457fbd926d11958244164ca2f99a7d04f3be0e5add256ad0072ac5f8ddd1527', 'Male', '2021-03-16 07:29:46', 'agency', '4', '2021-03-16 07:29:46', NULL, '2021-03-16 03:59:46', '2021-03-16 03:59:46'),
(25, 'agency', 4, '714', 'Clifford Rohan', 'Miss Shemar Raynor', '', '860', '620', '947', 'korbin.wolff@example.net', '641b7754e063147020c19b3a13305835139eec0285308718f0c315aadad00cdf1457fbd926d11958244164ca2f99a7d04f3be0e5add256ad0072ac5f8ddd1527', 'Male', '2021-03-16 07:29:46', 'agency', '4', '2021-03-16 07:29:46', NULL, '2021-03-16 03:59:46', '2021-03-16 03:59:46'),
(26, 'member', 4, '950', 'Prof. Emma Bechtelar', 'Jerald Monahan V', '{\"location\":{\"state\":{\"id\":\"8\",\"name\":\"\\u062a\\u0647\\u0631\\u0627\\u0646\"},\"city\":{\"id\":\"350\",\"name\":\"\\u0686\\u0647\\u0627\\u0631\\u062f\\u0627\\u0646\\u06af\\u0647\"}}}', '694', '931', '554', 'bart00@example.net', '641b7754e063147020c19b3a13305835139eec0285308718f0c315aadad00cdf1457fbd926d11958244164ca2f99a7d04f3be0e5add256ad0072ac5f8ddd1527', 'Male', '2021-03-16 07:29:46', 'member', '4', '2021-03-16 07:29:46', NULL, '2021-03-16 03:59:46', '2021-03-16 03:59:46'),
(27, 'agency', 4, '731', 'Jonas Kassulke', 'Sid Pollich', '{\"location\":{\"state\":{\"id\":\"8\",\"name\":\"\\u062a\\u0647\\u0631\\u0627\\u0646\"},\"city\":{\"id\":\"350\",\"name\":\"\\u0686\\u0647\\u0627\\u0631\\u062f\\u0627\\u0646\\u06af\\u0647\"}}}', '683', '543', '888', 'stephan.pouros@example.org', '641b7754e063147020c19b3a13305835139eec0285308718f0c315aadad00cdf1457fbd926d11958244164ca2f99a7d04f3be0e5add256ad0072ac5f8ddd1527', 'Male', '2021-03-16 07:29:46', 'member', '4', '2021-03-16 07:29:46', NULL, '2021-03-16 03:59:46', '2021-03-16 03:59:46'),
(28, 'agency', 4, '719', 'Miss Amy Bartell V', 'Darryl Witting', '{\"location\":{\"state\":{\"id\":\"8\",\"name\":\"\\u062a\\u0647\\u0631\\u0627\\u0646\"},\"city\":{\"id\":\"350\",\"name\":\"\\u0686\\u0647\\u0627\\u0631\\u062f\\u0627\\u0646\\u06af\\u0647\"}}}', '990', '837', '770', 'qkeeling@example.net', '641b7754e063147020c19b3a13305835139eec0285308718f0c315aadad00cdf1457fbd926d11958244164ca2f99a7d04f3be0e5add256ad0072ac5f8ddd1527', 'Male', '2021-03-16 07:29:46', 'member', '4', '2021-03-16 07:29:46', NULL, '2021-03-16 03:59:46', '2021-03-16 03:59:46'),
(29, 'member', 4, '916', 'Trent Cartwright', 'Wyatt Homenick', '{\"location\":{\"state\":{\"id\":\"8\",\"name\":\"\\u062a\\u0647\\u0631\\u0627\\u0646\"},\"city\":{\"id\":\"350\",\"name\":\"\\u0686\\u0647\\u0627\\u0631\\u062f\\u0627\\u0646\\u06af\\u0647\"}}}', '899', '563', '706', 'marvin.lew@example.net', '641b7754e063147020c19b3a13305835139eec0285308718f0c315aadad00cdf1457fbd926d11958244164ca2f99a7d04f3be0e5add256ad0072ac5f8ddd1527', 'Male', '2021-03-16 07:29:46', 'agency', '4', '2021-03-16 07:29:46', NULL, '2021-03-16 03:59:46', '2021-03-16 03:59:46'),
(30, 'agency', 4, '667', 'Prof. Lazaro Reynolds MD', 'Miss Alexandrine O\'Conner', '{\"location\":{\"state\":{\"id\":\"8\",\"name\":\"\\u062a\\u0647\\u0631\\u0627\\u0646\"},\"city\":{\"id\":\"350\",\"name\":\"\\u0686\\u0647\\u0627\\u0631\\u062f\\u0627\\u0646\\u06af\\u0647\"}}}', '658', '666', '779', 'vwalsh@example.com', '641b7754e063147020c19b3a13305835139eec0285308718f0c315aadad00cdf1457fbd926d11958244164ca2f99a7d04f3be0e5add256ad0072ac5f8ddd1527', 'Male', '2021-03-16 07:29:46', 'member', '4', '2021-03-16 07:29:46', NULL, '2021-03-16 03:59:47', '2021-03-16 03:59:47'),
(31, 'member', 4, '891', 'Prof. Zoe Hettinger', 'Ms. Katelin O\'Connell V', '{\"location\":{\"state\":{\"id\":\"8\",\"name\":\"\\u062a\\u0647\\u0631\\u0627\\u0646\"},\"city\":{\"id\":\"349\",\"name\":\"\\u0627\\u0633\\u0644\\u0627\\u0645\\u0634\\u0647\\u0631\"}}}', '757', '702', '938', 'wyman.reichel@example.org', '641b7754e063147020c19b3a13305835139eec0285308718f0c315aadad00cdf1457fbd926d11958244164ca2f99a7d04f3be0e5add256ad0072ac5f8ddd1527', 'Male', '2021-03-16 07:29:46', 'member', '4', '2021-03-16 07:29:46', NULL, '2021-03-16 03:59:47', '2021-03-16 03:59:47'),
(32, 'agency', 4, '696', 'Kayleigh Emmerich MD', 'Gladys Zboncak', '{\"location\":{\"state\":{\"id\":\"8\",\"name\":\"\\u062a\\u0647\\u0631\\u0627\\u0646\"},\"city\":{\"id\":\"350\",\"name\":\"\\u0686\\u0647\\u0627\\u0631\\u062f\\u0627\\u0646\\u06af\\u0647\"}}}', '532', '995', '626', 'ahauck@example.net', '641b7754e063147020c19b3a13305835139eec0285308718f0c315aadad00cdf1457fbd926d11958244164ca2f99a7d04f3be0e5add256ad0072ac5f8ddd1527', 'Male', '2021-03-16 07:29:47', 'member', '4', '2021-03-16 07:29:47', NULL, '2021-03-16 03:59:47', '2021-03-16 03:59:47'),
(33, 'agency', 4, '705', 'Prof. Gerard Jaskolski', 'Arlie Senger', '{\"location\":{\"state\":{\"id\":\"8\",\"name\":\"\\u062a\\u0647\\u0631\\u0627\\u0646\"},\"city\":{\"id\":\"349\",\"name\":\"\\u0627\\u0633\\u0644\\u0627\\u0645\\u0634\\u0647\\u0631\"}}}', '902', '737', '982', 'cecile67@example.org', '641b7754e063147020c19b3a13305835139eec0285308718f0c315aadad00cdf1457fbd926d11958244164ca2f99a7d04f3be0e5add256ad0072ac5f8ddd1527', 'Male', '2021-03-16 07:29:47', 'agency', '4', '2021-03-16 07:29:47', NULL, '2021-03-16 03:59:47', '2021-03-16 03:59:47'),
(34, 'member', 4, '936', 'Hosea Casper', 'Ms. Lela Cormier PhD', '{\"location\":{\"state\":{\"id\":\"8\",\"name\":\"\\u062a\\u0647\\u0631\\u0627\\u0646\"},\"city\":{\"id\":\"350\",\"name\":\"\\u0686\\u0647\\u0627\\u0631\\u062f\\u0627\\u0646\\u06af\\u0647\"}}}', '594', '700', '930', 'burdette64@example.org', '641b7754e063147020c19b3a13305835139eec0285308718f0c315aadad00cdf1457fbd926d11958244164ca2f99a7d04f3be0e5add256ad0072ac5f8ddd1527', 'Male', '2021-03-16 07:29:47', 'member', '4', '2021-03-16 07:29:47', NULL, '2021-03-16 03:59:47', '2021-03-16 03:59:47'),
(35, 'agency', 4, '985', 'Doris O\'Reilly MD', 'Else Johns', '{\"location\":{\"state\":{\"id\":\"8\",\"name\":\"\\u062a\\u0647\\u0631\\u0627\\u0646\"},\"city\":{\"id\":\"350\",\"name\":\"\\u0686\\u0647\\u0627\\u0631\\u062f\\u0627\\u0646\\u06af\\u0647\"}}}', '573', '695', '753', 'donnell.tromp@example.net', '641b7754e063147020c19b3a13305835139eec0285308718f0c315aadad00cdf1457fbd926d11958244164ca2f99a7d04f3be0e5add256ad0072ac5f8ddd1527', 'Male', '2021-03-16 07:29:47', 'agency', '4', '2021-03-16 07:29:47', NULL, '2021-03-16 03:59:47', '2021-03-16 03:59:47'),
(36, 'member', 4, '563', 'Amely Stamm II', 'Lukas Gusikowski V', '{\"location\":{\"state\":{\"id\":\"8\",\"name\":\"\\u062a\\u0647\\u0631\\u0627\\u0646\"},\"city\":{\"id\":\"349\",\"name\":\"\\u0627\\u0633\\u0644\\u0627\\u0645\\u0634\\u0647\\u0631\"}}}', '663', '733', '986', 'clark.maggio@example.net', '641b7754e063147020c19b3a13305835139eec0285308718f0c315aadad00cdf1457fbd926d11958244164ca2f99a7d04f3be0e5add256ad0072ac5f8ddd1527', 'Male', '2021-03-16 07:29:48', 'agency', '4', '2021-03-16 07:29:48', NULL, '2021-03-16 03:59:48', '2021-03-16 03:59:48'),
(37, 'agency', 4, '891', 'Braulio Cruickshank I', 'Vena Leuschke', '{\"location\":{\"state\":{\"id\":\"8\",\"name\":\"\\u062a\\u0647\\u0631\\u0627\\u0646\"},\"city\":{\"id\":\"349\",\"name\":\"\\u0627\\u0633\\u0644\\u0627\\u0645\\u0634\\u0647\\u0631\"}}}', '718', '991', '650', 'samson93@example.net', '641b7754e063147020c19b3a13305835139eec0285308718f0c315aadad00cdf1457fbd926d11958244164ca2f99a7d04f3be0e5add256ad0072ac5f8ddd1527', 'Male', '2021-03-16 07:29:48', 'agency', '4', '2021-03-16 07:29:48', NULL, '2021-03-16 03:59:48', '2021-03-16 03:59:48'),
(38, 'member', 4, '871', 'Wanda Tremblay', 'Kennith Mraz Sr.', '{\"location\":{\"state\":{\"id\":\"8\",\"name\":\"\\u062a\\u0647\\u0631\\u0627\\u0646\"},\"city\":{\"id\":\"349\",\"name\":\"\\u0627\\u0633\\u0644\\u0627\\u0645\\u0634\\u0647\\u0631\"}}}', '985', '815', '909', 'neil77@example.net', '641b7754e063147020c19b3a13305835139eec0285308718f0c315aadad00cdf1457fbd926d11958244164ca2f99a7d04f3be0e5add256ad0072ac5f8ddd1527', 'Male', '2021-03-16 07:29:48', 'agency', '4', '2021-03-16 07:29:48', NULL, '2021-03-16 03:59:48', '2021-03-16 03:59:48'),
(39, 'agency', 4, '879', 'Dr. Murray Wilderman IV', 'Ms. Emelie Lind IV', '{\"location\":{\"state\":{\"id\":\"8\",\"name\":\"\\u062a\\u0647\\u0631\\u0627\\u0646\"},\"city\":{\"id\":\"349\",\"name\":\"\\u0627\\u0633\\u0644\\u0627\\u0645\\u0634\\u0647\\u0631\"}}}', '505', '833', '607', 'mcclure.prince@example.net', '641b7754e063147020c19b3a13305835139eec0285308718f0c315aadad00cdf1457fbd926d11958244164ca2f99a7d04f3be0e5add256ad0072ac5f8ddd1527', 'Male', '2021-03-16 07:29:48', 'member', '4', '2021-03-16 07:29:48', NULL, '2021-03-16 03:59:48', '2021-03-16 03:59:48'),
(40, 'member', 4, '588', 'Elise Mitchell', 'Annamae Kshlerin', '{\"location\":{\"state\":{\"id\":\"8\",\"name\":\"\\u062a\\u0647\\u0631\\u0627\\u0646\"},\"city\":{\"id\":\"349\",\"name\":\"\\u0627\\u0633\\u0644\\u0627\\u0645\\u0634\\u0647\\u0631\"}}}', '934', '939', '892', 'duncan11@example.com', '641b7754e063147020c19b3a13305835139eec0285308718f0c315aadad00cdf1457fbd926d11958244164ca2f99a7d04f3be0e5add256ad0072ac5f8ddd1527', 'Male', '2021-03-16 07:29:48', 'member', '4', '2021-03-16 07:29:48', NULL, '2021-03-16 03:59:48', '2021-03-16 03:59:48'),
(41, 'member', 4, '706', 'Emily Dare', 'Mariano Herman', '{\"location\":{\"state\":{\"id\":\"8\",\"name\":\"\\u062a\\u0647\\u0631\\u0627\\u0646\"},\"city\":{\"id\":\"350\",\"name\":\"\\u0686\\u0647\\u0627\\u0631\\u062f\\u0627\\u0646\\u06af\\u0647\"}}}', '686', '903', '617', 'nader.rashad@example.net', '641b7754e063147020c19b3a13305835139eec0285308718f0c315aadad00cdf1457fbd926d11958244164ca2f99a7d04f3be0e5add256ad0072ac5f8ddd1527', 'Male', '2021-03-16 07:29:48', 'agency', '4', '2021-03-16 07:29:48', NULL, '2021-03-16 03:59:48', '2021-03-16 03:59:48'),
(42, 'member', 4, '556', 'Hasan', 'Rezaii', NULL, '09108453606', '1231241231', '09108453606', 'aa@aa.com', '641b7754e063147020c19b3a13305835139eec0285308718f0c315aadad00cdf1457fbd926d11958244164ca2f99a7d04f3be0e5add256ad0072ac5f8ddd1527', 'Male', 'benyaminrmb2@gmail.com', 'yawydaywd aywd aywdaduhauidhawudhau', '09d49be86281691a8b970257cf443c6877a179ce65878ac6915e3bd2971a2080', NULL, '2021-03-16 12:58:05', '2021-03-16 08:40:55', '2021-03-16 09:58:05'),
(43, 'member', 4, '560', 'reza', 'maneshi', NULL, '09108453606', '15219846184', NULL, 'aa@aa2.com', '641b7754e063147020c19b3a13305835139eec0285308718f0c315aadad00cdf1457fbd926d11958244164ca2f99a7d04f3be0e5add256ad0072ac5f8ddd1527', NULL, '', '', '6ff032a0e8d87f00efd50a7b33143f44083880b67b1036245c307034d3da17dd', NULL, '2021-03-16 12:55:13', '2021-03-16 09:55:13', '2021-03-16 09:55:13');

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
  ADD KEY `shipments_user_id_foreign` (`user_id`),
  ADD KEY `shipments_agency_id_foreign` (`agency_id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `shipments`
--
ALTER TABLE `shipments`
  ADD CONSTRAINT `shipments_agency_id_foreign` FOREIGN KEY (`agency_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shipments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
