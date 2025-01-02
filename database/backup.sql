-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2024 at 06:23 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `imsv2`
--
CREATE DATABASE IF NOT EXISTS `imsv2` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `imsv2`;

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `module_id` int(11) DEFAULT NULL,
  `module` varchar(191) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `action` varchar(191) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `module_id`, `module`, `description`, `action`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 3, 'users', '', 'create', 2, '2024-12-04 14:38:45', '2024-12-04 14:38:45'),
(2, 1, 'incidents', '', 'create', 2, '2024-12-04 15:24:41', '2024-12-04 15:24:41'),
(3, 1, 'incidents', 'incident_no changed <br><b>From</b>: INCIDENT1 <br> <b>To</b>: INCIDENT2<br> <br>remarks changed <br><b>From</b>: Illum rem commodo c <br> <b>To</b>: Illum rem commodo c 12 3123<br> <br>', 'update', 2, '2024-12-04 15:24:50', '2024-12-04 15:24:50');

-- --------------------------------------------------------

--
-- Table structure for table `agencies`
--

CREATE TABLE `agencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `agency_name` varchar(191) DEFAULT NULL,
  `contact_no_1` varchar(191) DEFAULT NULL,
  `contact_no_2` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `contact_person` varchar(191) DEFAULT NULL,
  `assigned_to_picklist` bigint(20) UNSIGNED DEFAULT NULL,
  `street_name` varchar(191) DEFAULT NULL,
  `barangays_picklist` bigint(20) UNSIGNED DEFAULT NULL,
  `municipalities_picklist` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0,
  `source` varchar(191) NOT NULL DEFAULT 'crm',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `barangays`
--

CREATE TABLE `barangays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(191) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(191) NOT NULL,
  `owner` varchar(191) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `caller_types`
--

CREATE TABLE `caller_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `caller_types`
--

INSERT INTO `caller_types` (`id`, `label`, `created_at`, `updated_at`) VALUES
(1, 'Prank Caller', NULL, NULL),
(2, 'Relative', NULL, NULL),
(3, 'Reporter', NULL, NULL),
(4, 'Victim', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(191) DEFAULT NULL,
  `lastname` varchar(191) DEFAULT NULL,
  `mobile` varchar(191) DEFAULT NULL,
  `landline` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `created_by` varchar(191) DEFAULT NULL,
  `caller_types_picklist` bigint(20) UNSIGNED DEFAULT NULL,
  `street_name` varchar(191) DEFAULT NULL,
  `barangays_picklist` bigint(20) UNSIGNED DEFAULT NULL,
  `municipalities_picklist` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0,
  `source` varchar(191) NOT NULL DEFAULT 'crm',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `incidents`
--

CREATE TABLE `incidents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `incident_no` varchar(191) DEFAULT NULL,
  `incident_types_picklist` bigint(20) UNSIGNED DEFAULT NULL,
  `time_of_incident` time DEFAULT NULL,
  `date_of_incident` date DEFAULT NULL,
  `incident_statuses_picklist` bigint(20) UNSIGNED DEFAULT NULL,
  `incident_priorities_picklist` bigint(20) UNSIGNED DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `location` varchar(191) DEFAULT NULL,
  `street_name` varchar(191) DEFAULT NULL,
  `nearest_landmark` varchar(191) DEFAULT NULL,
  `coordinates` varchar(191) DEFAULT NULL,
  `caller_firstname` varchar(191) DEFAULT NULL,
  `caller_lastname` varchar(191) DEFAULT NULL,
  `caller_contact` varchar(191) DEFAULT NULL,
  `response_team` varchar(191) DEFAULT NULL,
  `assigned_by` varchar(191) DEFAULT NULL,
  `assigned_team` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`assigned_team`)),
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  `source` varchar(191) NOT NULL DEFAULT 'crm',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `incidents`
--

INSERT INTO `incidents` (`id`, `incident_no`, `incident_types_picklist`, `time_of_incident`, `date_of_incident`, `incident_statuses_picklist`, `incident_priorities_picklist`, `remarks`, `location`, `street_name`, `nearest_landmark`, `coordinates`, `caller_firstname`, `caller_lastname`, `caller_contact`, `response_team`, `assigned_by`, `assigned_team`, `deleted`, `source`, `created_at`, `updated_at`) VALUES
(1, 'INCIDENT2', NULL, NULL, NULL, NULL, NULL, 'Illum rem commodo c 12 3123', 'Aut culpa facere dol', 'Consectetur corrupti', 'Voluptas amet sit', NULL, 'Praesentium veniam', 'Voluptatem aspernat', 'Facere ratione eveni', NULL, NULL, 'null', 0, 'crm', '2024-12-04 15:24:41', '2024-12-04 15:24:50');

-- --------------------------------------------------------

--
-- Table structure for table `incident_priorities`
--

CREATE TABLE `incident_priorities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `incident_priorities`
--

INSERT INTO `incident_priorities` (`id`, `label`, `created_at`, `updated_at`) VALUES
(1, 'Low', NULL, NULL),
(2, 'Medium', NULL, NULL),
(3, 'High', NULL, NULL),
(4, 'Urgent', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `incident_statuses`
--

CREATE TABLE `incident_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `incident_statuses`
--

INSERT INTO `incident_statuses` (`id`, `label`, `created_at`, `updated_at`) VALUES
(1, 'Open', NULL, NULL),
(2, 'In Progress', NULL, NULL),
(3, 'Completed', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `incident_types`
--

CREATE TABLE `incident_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `incident_types`
--

INSERT INTO `incident_types` (`id`, `label`, `created_at`, `updated_at`) VALUES
(1, 'Animal Accident', NULL, NULL),
(2, 'Assualt', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) NOT NULL,
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
  `id` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL,
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
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_11_19_080909_create_personal_access_tokens_table', 1),
(5, '2024_11_21_024006_create_incident_types_table', 1),
(6, '2024_11_22_040818_create_incident_statuses_table', 1),
(7, '2024_11_22_041526_create_incident_priorities_table', 1),
(8, '2024_11_22_055803_create_incidents_table', 1),
(9, '2024_11_22_141611_create_resources_statuses_table', 1),
(10, '2024_11_22_142421_create_resources_dispatchers_table', 1),
(11, '2024_11_22_142504_create_resources_types_table', 1),
(12, '2024_11_22_142522_create_resources_conditions_table', 1),
(13, '2024_11_22_162152_create_resources_table', 1),
(14, '2024_11_23_134727_create_activity_logs_table', 1),
(15, '2024_12_02_193305_create_municipalities_table', 1),
(16, '2024_12_02_193314_create_barangays_table', 1),
(17, '2024_12_02_193333_create_caller_types_table', 1),
(18, '2024_12_02_193334_create_contacts_table', 1),
(19, '2024_12_03_002242_create_agencies_table', 1),
(20, '2024_12_03_192324_create_responder_types_table', 1),
(21, '2024_12_03_192349_create_responder_statuses_table', 1),
(22, '2024_12_03_192351_create_responders_table', 1),
(23, '2024_12_04_133340_create_pre_plan_classifications_table', 1),
(24, '2024_12_04_133341_create_pre_plans_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `municipalities`
--

CREATE TABLE `municipalities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 2, 'MyApp', '4addebc0c3c396008f961f7bf0904b0a2e9f14a368a8259b5e6b2a0cc03d6230', '{\"expires_at\":\"2024-12-05T14:38:30.349724Z\"}', '2024-12-04 15:32:28', NULL, '2024-12-04 14:38:30', '2024-12-04 15:32:28');

-- --------------------------------------------------------

--
-- Table structure for table `pre_plans`
--

CREATE TABLE `pre_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pre_plan_name` varchar(191) DEFAULT NULL,
  `incident_type` varchar(191) DEFAULT NULL,
  `pre_plan_classifications_picklist` bigint(20) UNSIGNED DEFAULT NULL,
  `initial_assessment` text DEFAULT NULL,
  `response_action` text DEFAULT NULL,
  `classification` text DEFAULT NULL,
  `incident_manager` varchar(191) DEFAULT NULL,
  `incident_responder` varchar(191) DEFAULT NULL,
  `support_staff` varchar(191) DEFAULT NULL,
  `tools_and_equipment` varchar(191) DEFAULT NULL,
  `personnel` varchar(191) DEFAULT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0,
  `source` varchar(191) NOT NULL DEFAULT 'crm',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pre_plan_classifications`
--

CREATE TABLE `pre_plan_classifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pre_plan_classifications`
--

INSERT INTO `pre_plan_classifications` (`id`, `label`, `created_at`, `updated_at`) VALUES
(1, 'Fire Incident', NULL, NULL),
(2, 'Hazardous Material', NULL, NULL),
(3, 'Health Emergency', NULL, NULL),
(4, 'High', NULL, NULL),
(5, 'Low', NULL, NULL),
(6, 'Natural Disaster', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `resources_name` varchar(191) DEFAULT NULL,
  `resources_types_picklist` bigint(20) UNSIGNED DEFAULT NULL,
  `resources_statuses_picklist` bigint(20) UNSIGNED DEFAULT NULL,
  `coordinates` varchar(191) DEFAULT NULL,
  `dispatchers_picklist` bigint(20) UNSIGNED DEFAULT NULL,
  `conditions_picklist` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `contact_info` varchar(191) DEFAULT NULL,
  `date_acquired` date DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `owner` varchar(191) DEFAULT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0,
  `source` varchar(191) NOT NULL DEFAULT 'crm',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resources_conditions`
--

CREATE TABLE `resources_conditions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `resources_conditions`
--

INSERT INTO `resources_conditions` (`id`, `label`, `created_at`, `updated_at`) VALUES
(1, 'Excellent', NULL, NULL),
(2, 'Fair', NULL, NULL),
(3, 'Good', NULL, NULL),
(4, 'New', NULL, NULL),
(5, 'Poor', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `resources_dispatchers`
--

CREATE TABLE `resources_dispatchers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `resources_dispatchers`
--

INSERT INTO `resources_dispatchers` (`id`, `label`, `created_at`, `updated_at`) VALUES
(1, 'Makati Fire Dept', NULL, NULL),
(2, 'Makati Rescue Team', NULL, NULL),
(3, 'Pending', NULL, NULL),
(4, 'No', NULL, NULL),
(5, 'Yes', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `resources_statuses`
--

CREATE TABLE `resources_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `resources_statuses`
--

INSERT INTO `resources_statuses` (`id`, `label`, `created_at`, `updated_at`) VALUES
(1, 'Allocated', NULL, NULL),
(2, 'Available', NULL, NULL),
(3, 'Deployed', NULL, NULL),
(4, 'In Service', NULL, NULL),
(5, 'In Transit', NULL, NULL),
(6, 'In Use', NULL, NULL),
(7, 'Out of Service', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `resources_types`
--

CREATE TABLE `resources_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `resources_types`
--

INSERT INTO `resources_types` (`id`, `label`, `created_at`, `updated_at`) VALUES
(1, 'test status', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `responders`
--

CREATE TABLE `responders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `responder_types_picklist` bigint(20) UNSIGNED DEFAULT NULL,
  `firstname` varchar(191) DEFAULT NULL,
  `middlename` varchar(191) DEFAULT NULL,
  `lastname` varchar(191) DEFAULT NULL,
  `contact_no` varchar(191) DEFAULT NULL,
  `email_address` varchar(191) DEFAULT NULL,
  `password` varchar(191) DEFAULT NULL,
  `responder_statuses_picklist` bigint(20) UNSIGNED DEFAULT NULL,
  `assigned_to_picklist` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0,
  `source` varchar(191) NOT NULL DEFAULT 'crm',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `responder_statuses`
--

CREATE TABLE `responder_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `responder_types`
--

CREATE TABLE `responder_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `responder_types`
--

INSERT INTO `responder_types` (`id`, `label`, `created_at`, `updated_at`) VALUES
(1, 'Fire Department', NULL, NULL),
(2, 'Local Enforcement Division (LED)', NULL, NULL),
(3, 'Public Safety', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  `source` varchar(191) NOT NULL DEFAULT 'crm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted`, `source`) VALUES
(1, 'Mark Santos', 'mark@test.com', NULL, '$2y$12$LR5SpxhHXUr72xmDw8czgOZ0LL4QZEs/R6VWFaaJ6O/c0YgD3eAQy', NULL, NULL, NULL, 0, 'crm'),
(2, 'Admin', 'admin@test.com', NULL, '$2y$12$7Skm8fmvYTdmhWjdOxebtOFD8OAcWPUl/vGGxM7kFc3zDwCyUMKFu', NULL, NULL, '2024-12-04 14:39:32', 1, 'crm'),
(3, 'test', 'test', NULL, '$2y$12$qtei6/26OkWBi36yWmqnreKa35zrOB0w5W2sECweDEtn65Mw39IBW', NULL, '2024-12-04 14:38:45', '2024-12-04 14:38:54', 1, 'crm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `agencies`
--
ALTER TABLE `agencies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agencies_assigned_to_picklist_foreign` (`assigned_to_picklist`),
  ADD KEY `agencies_barangays_picklist_foreign` (`barangays_picklist`),
  ADD KEY `agencies_municipalities_picklist_foreign` (`municipalities_picklist`);

--
-- Indexes for table `barangays`
--
ALTER TABLE `barangays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `caller_types`
--
ALTER TABLE `caller_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contacts_caller_types_picklist_foreign` (`caller_types_picklist`),
  ADD KEY `contacts_barangays_picklist_foreign` (`barangays_picklist`),
  ADD KEY `contacts_municipalities_picklist_foreign` (`municipalities_picklist`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `incidents`
--
ALTER TABLE `incidents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `incidents_incident_types_picklist_foreign` (`incident_types_picklist`),
  ADD KEY `incidents_incident_statuses_picklist_foreign` (`incident_statuses_picklist`),
  ADD KEY `incidents_incident_priorities_picklist_foreign` (`incident_priorities_picklist`);

--
-- Indexes for table `incident_priorities`
--
ALTER TABLE `incident_priorities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incident_statuses`
--
ALTER TABLE `incident_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incident_types`
--
ALTER TABLE `incident_types`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `municipalities`
--
ALTER TABLE `municipalities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pre_plans`
--
ALTER TABLE `pre_plans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pre_plans_pre_plan_classifications_picklist_foreign` (`pre_plan_classifications_picklist`);

--
-- Indexes for table `pre_plan_classifications`
--
ALTER TABLE `pre_plan_classifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resources_resources_types_picklist_foreign` (`resources_types_picklist`),
  ADD KEY `resources_resources_statuses_picklist_foreign` (`resources_statuses_picklist`),
  ADD KEY `resources_dispatchers_picklist_foreign` (`dispatchers_picklist`),
  ADD KEY `resources_conditions_picklist_foreign` (`conditions_picklist`);

--
-- Indexes for table `resources_conditions`
--
ALTER TABLE `resources_conditions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resources_dispatchers`
--
ALTER TABLE `resources_dispatchers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resources_statuses`
--
ALTER TABLE `resources_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resources_types`
--
ALTER TABLE `resources_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `responders`
--
ALTER TABLE `responders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `responders_responder_types_picklist_foreign` (`responder_types_picklist`),
  ADD KEY `responders_responder_statuses_picklist_foreign` (`responder_statuses_picklist`),
  ADD KEY `responders_assigned_to_picklist_foreign` (`assigned_to_picklist`);

--
-- Indexes for table `responder_statuses`
--
ALTER TABLE `responder_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `responder_types`
--
ALTER TABLE `responder_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `agencies`
--
ALTER TABLE `agencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `barangays`
--
ALTER TABLE `barangays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `caller_types`
--
ALTER TABLE `caller_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incidents`
--
ALTER TABLE `incidents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `incident_priorities`
--
ALTER TABLE `incident_priorities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `incident_statuses`
--
ALTER TABLE `incident_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `incident_types`
--
ALTER TABLE `incident_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `municipalities`
--
ALTER TABLE `municipalities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pre_plans`
--
ALTER TABLE `pre_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pre_plan_classifications`
--
ALTER TABLE `pre_plan_classifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resources_conditions`
--
ALTER TABLE `resources_conditions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `resources_dispatchers`
--
ALTER TABLE `resources_dispatchers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `resources_statuses`
--
ALTER TABLE `resources_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `resources_types`
--
ALTER TABLE `resources_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `responders`
--
ALTER TABLE `responders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `responder_statuses`
--
ALTER TABLE `responder_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `responder_types`
--
ALTER TABLE `responder_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `agencies`
--
ALTER TABLE `agencies`
  ADD CONSTRAINT `agencies_assigned_to_picklist_foreign` FOREIGN KEY (`assigned_to_picklist`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `agencies_barangays_picklist_foreign` FOREIGN KEY (`barangays_picklist`) REFERENCES `barangays` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `agencies_municipalities_picklist_foreign` FOREIGN KEY (`municipalities_picklist`) REFERENCES `municipalities` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_barangays_picklist_foreign` FOREIGN KEY (`barangays_picklist`) REFERENCES `barangays` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contacts_caller_types_picklist_foreign` FOREIGN KEY (`caller_types_picklist`) REFERENCES `caller_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contacts_municipalities_picklist_foreign` FOREIGN KEY (`municipalities_picklist`) REFERENCES `municipalities` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `incidents`
--
ALTER TABLE `incidents`
  ADD CONSTRAINT `incidents_incident_priorities_picklist_foreign` FOREIGN KEY (`incident_priorities_picklist`) REFERENCES `incident_priorities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `incidents_incident_statuses_picklist_foreign` FOREIGN KEY (`incident_statuses_picklist`) REFERENCES `incident_statuses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `incidents_incident_types_picklist_foreign` FOREIGN KEY (`incident_types_picklist`) REFERENCES `incident_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pre_plans`
--
ALTER TABLE `pre_plans`
  ADD CONSTRAINT `pre_plans_pre_plan_classifications_picklist_foreign` FOREIGN KEY (`pre_plan_classifications_picklist`) REFERENCES `pre_plan_classifications` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `resources`
--
ALTER TABLE `resources`
  ADD CONSTRAINT `resources_conditions_picklist_foreign` FOREIGN KEY (`conditions_picklist`) REFERENCES `resources_conditions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `resources_dispatchers_picklist_foreign` FOREIGN KEY (`dispatchers_picklist`) REFERENCES `resources_dispatchers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `resources_resources_statuses_picklist_foreign` FOREIGN KEY (`resources_statuses_picklist`) REFERENCES `resources_statuses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `resources_resources_types_picklist_foreign` FOREIGN KEY (`resources_types_picklist`) REFERENCES `resources_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `responders`
--
ALTER TABLE `responders`
  ADD CONSTRAINT `responders_assigned_to_picklist_foreign` FOREIGN KEY (`assigned_to_picklist`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `responders_responder_statuses_picklist_foreign` FOREIGN KEY (`responder_statuses_picklist`) REFERENCES `responder_statuses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `responders_responder_types_picklist_foreign` FOREIGN KEY (`responder_types_picklist`) REFERENCES `responder_types` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
