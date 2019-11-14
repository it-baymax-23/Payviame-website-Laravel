-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2019 at 09:23 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `payvia_quoteinvoice`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2019-09-06 00:30:38', '2019-09-06 00:30:38'),
(2, 2, '2019-09-07 10:16:44', '2019-09-07 10:16:44'),
(3, 17, '2019-09-19 12:38:08', '2019-09-19 12:38:08');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `account_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `business_name` varchar(191) DEFAULT NULL,
  `contact_name` varchar(191) DEFAULT NULL,
  `email_address` varchar(191) DEFAULT NULL,
  `address_detail` text DEFAULT NULL,
  `currency_id` int(10) UNSIGNED DEFAULT 1,
  `hourly_rate` varchar(191) DEFAULT NULL,
  `invoice_language` int(10) DEFAULT 1,
  `invoice_numbering` varchar(191) DEFAULT NULL,
  `invoice_threshold` varchar(191) DEFAULT NULL,
  `monogram_color` varchar(191) DEFAULT '#39D0B9',
  `monogram_name` varchar(191) DEFAULT NULL,
  `client_logo` varchar(191) DEFAULT NULL,
  `client_status` int(2) DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `account_id`, `user_id`, `business_name`, `contact_name`, `email_address`, `address_detail`, `currency_id`, `hourly_rate`, `invoice_language`, `invoice_numbering`, `invoice_threshold`, `monogram_color`, `monogram_name`, `client_logo`, `client_status`, `created_at`, `updated_at`) VALUES
(13, 2, 2, 'aaa', NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, '#39D0B9', 'aa', NULL, 1, '2019-09-23 17:58:58', '2019-09-24 01:56:29'),
(14, 2, 2, 'Super client', NULL, 'superclient@gmail.com', 'Istanbul, Turkey', 1, NULL, 1, NULL, NULL, '#113d33', 'Sc', NULL, 0, '2019-09-23 17:58:58', '2019-09-24 01:56:29'),
(15, 2, 2, 'ccc', NULL, 'ccc@payviame.com', '123city,cm', 1, NULL, 1, NULL, NULL, '#E71F32', 'cc', NULL, 0, '2019-09-23 17:58:58', '2019-09-24 01:56:29'),
(16, 2, 2, 'ddd', NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, '#D77913', 'dd', NULL, 0, '2019-09-23 17:58:58', '2019-09-24 01:56:29'),
(17, 2, 2, 'eee', NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, '#4F39D0', 'ee', NULL, 0, '2019-09-23 17:58:58', '2019-09-24 01:56:29'),
(18, 2, 2, 'eee', NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, '#5DD039', 'ee', NULL, 0, '2019-09-23 17:58:58', '2019-09-24 01:56:29'),
(19, 2, 2, 'fff', NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, '#39D0B9', 'ff', NULL, 0, '2019-09-23 17:58:58', '2019-09-24 01:56:29'),
(20, 2, 2, 'ggg', 'Honald Doe', NULL, NULL, 1, NULL, 1, NULL, NULL, '#39D0B9', 'gg', NULL, 0, '2019-09-23 17:58:58', '2019-09-24 01:56:29'),
(21, 2, 2, 'hhh', NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, '#C8BF00', 'hh', NULL, 0, '2019-09-23 17:58:58', '2019-09-24 01:56:29'),
(22, 2, 2, 'iii', NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, '#39D0B9', 'ii', NULL, 0, '2019-09-23 17:58:58', '2019-09-24 01:56:29'),
(23, 2, 2, 'jjj', NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, '#39D0B9', 'jj', NULL, 0, '2019-09-23 17:58:58', '2019-09-24 01:56:29'),
(24, 2, 2, 'qqq', NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, '#39D0B9', 'qq', NULL, 0, '2019-09-23 17:58:58', '2019-09-24 01:56:29'),
(25, 2, 2, 'qwe', NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, '#39D0B9', 'qw', NULL, 0, '2019-09-23 17:58:58', '2019-09-24 01:56:29'),
(27, 3, 17, 'Adidas', 'Angela Merkel', 'angela@merkel.com', 'Berlin, Germany', 2, NULL, 1, NULL, NULL, '#2FDB1D', 'Ad', NULL, 0, '2019-09-23 17:58:58', '2019-09-24 05:26:53'),
(28, 3, 17, 'Nike', 'Merkel Angela', 'merkel@angela.com', 'Istanbul Turkey', 1, NULL, 1, NULL, NULL, '#DF3C53', 'Ni', NULL, 0, '2019-09-23 17:58:58', '2019-09-24 05:26:42');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(10) UNSIGNED NOT NULL,
  `currency_code` varchar(191) DEFAULT NULL,
  `currency_symbol` varchar(191) DEFAULT NULL,
  `currency_description` varchar(191) DEFAULT NULL,
  `currency_rate` decimal(10,2) DEFAULT 1.00,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `currency_code`, `currency_symbol`, `currency_description`, `currency_rate`, `created_at`, `updated_at`) VALUES
(1, 'EUR', '€', 'Euro', '1.00', '2019-09-23 20:28:00', '2019-09-23 20:28:00'),
(2, 'USD', '$', 'US Dollar', '1.10', '2019-09-23 20:32:35', '2019-09-23 20:41:13'),
(3, 'TRY', '₺', 'Turkish lira', '6.29', '2019-09-23 20:36:38', '2019-09-23 20:36:38'),
(4, 'GBP', '£', 'Pounds sterling', '0.88', '2019-09-23 20:40:07', '2019-09-23 20:40:07');

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `inventory_description` varchar(191) DEFAULT NULL,
  `inventory_price` int(10) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `user_id`, `inventory_description`, `inventory_price`, `created_at`, `updated_at`) VALUES
(1, 2, 'Company Registration Fee (Custom setup on the business registration portal)', 660, '2019-09-19 05:37:57', '2019-09-19 05:37:57'),
(2, 2, 'Company Registration State Fee (0% VAT)', 190, '2019-09-19 05:54:30', '2019-09-19 05:54:30'),
(6, 2, 'Annual Services (Legal address, mailbox and authorized contact person services', 400, '2019-09-19 07:18:14', '2019-09-19 07:18:14'),
(7, 2, 'E-Residency Application State Fee (0% VAT)', 100, '2019-09-19 07:19:17', '2019-09-19 07:19:17'),
(8, 2, 'E-Residency Application Service Fee', 35, '2019-09-19 07:38:55', '2019-09-19 07:38:55'),
(9, 2, 'VAT Number Application Service Fee', 100, '2019-09-19 07:39:33', '2019-09-19 07:39:33'),
(10, 2, 'Sim Card Shipment Fee (incl. the sim card + 3$usd starter credit)', 25, '2019-09-19 07:40:43', '2019-09-19 07:40:43'),
(11, 2, 'Bank Card Shipment Fee', 20, '2019-09-19 07:41:22', '2019-09-19 07:41:22'),
(12, 2, 'Cryptocurrency License Application State Fee (0% VAT)', 345, '2019-09-19 07:42:09', '2019-09-19 07:42:09'),
(13, 2, 'Company Name Change Service Fee', 150, '2019-09-19 07:43:15', '2019-09-19 07:43:15'),
(14, 2, 'Notarized Extract of the Articles of Association in Estonian (incl. the shipment)', 200, '2019-09-19 07:44:40', '2019-09-19 07:44:40'),
(15, 2, 'Notarized Extract of the Articles of Association in English (incl. Est-Eng translation and shipment)', 300, '2019-09-19 15:46:59', '2019-09-19 07:46:59'),
(16, 2, 'Notarized Extract of the Company Registration Document in English or Estonian (incl. the shipment)', 150, '2019-09-19 07:48:40', '2019-09-19 07:48:40'),
(17, 2, 'EORI Number Application Service Fee', 100, '2019-09-19 07:49:18', '2019-09-19 07:49:18'),
(18, 17, 'E-Residency Fee', 30, '2019-09-19 12:58:27', '2019-09-19 12:58:27'),
(19, 17, 'E-Residency Application Fee', 90, '2019-09-19 12:58:41', '2019-09-19 12:58:41'),
(20, 17, 'Company Incorporation', 60, '2019-09-19 12:58:59', '2019-09-19 12:58:59');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED DEFAULT NULL,
  `account_id` int(10) UNSIGNED DEFAULT NULL,
  `currency_id` int(10) UNSIGNED DEFAULT 1,
  `recipient_name` varchar(191) DEFAULT NULL,
  `recipient_address` text DEFAULT NULL,
  `recipient_description` text DEFAULT NULL,
  `invoice_description` text DEFAULT NULL,
  `sum_total` decimal(10,2) DEFAULT 0.00,
  `sub_total` decimal(10,2) DEFAULT 0.00,
  `sum_tax1` decimal(10,2) DEFAULT 0.00,
  `sum_tax2` decimal(10,2) DEFAULT 0.00,
  `invoice_footer` text DEFAULT NULL,
  `date_issued` varchar(191) DEFAULT NULL,
  `payment_due` varchar(191) DEFAULT NULL,
  `paid_at` varchar(191) DEFAULT NULL,
  `status` int(2) DEFAULT 0,
  `attach_pdf` varchar(191) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `client_id`, `account_id`, `currency_id`, `recipient_name`, `recipient_address`, `recipient_description`, `invoice_description`, `sum_total`, `sub_total`, `sum_tax1`, `sum_tax2`, `invoice_footer`, `date_issued`, `payment_due`, `paid_at`, `status`, `attach_pdf`, `created_at`, `updated_at`) VALUES
(1, 14, 2, 1, NULL, 'Istanbul, Turkey', NULL, NULL, NULL, NULL, NULL, NULL, 'IBAN: EE40 7700 7710 0284 2029\r\nBIC/SWIFT: LHVBEE22\r\nAddress: AS LHV Pank, Tartu mnt 2, 10145 Tallinn, Estonia', '2019-09-17', '2019-10-07', NULL, 0, NULL, '2019-09-18 10:45:26', '2019-09-18 10:45:26'),
(4, 14, 2, 1, NULL, 'Istanbul, Turkey', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-09-17', '2019-10-07', NULL, 0, NULL, '2019-09-17 21:22:38', '2019-09-17 21:22:38'),
(5, 28, 3, 1, 'Merkel Angela', NULL, NULL, '[{\"description\":\"E-Residency Fee\",\"quality\":\"10\",\"unit_price\":\"30\",\"tax1\":\"1\",\"tax_val1\":\"60.00\",\"tax2\":\"0\",\"tax_val2\":\"90.00\",\"amount_price\":\"300.00\"},{\"description\":\"Company Incorporation\",\"quality\":\"20\",\"unit_price\":\"60\",\"tax1\":\"0\",\"tax_val1\":\"240.00\",\"tax2\":\"1\",\"tax_val2\":\"360.00\",\"amount_price\":\"1200.00\"}]', '1920.00', '1500.00', '60.00', '360.00', 'Invoice footer mesajıdırç üğişçö', '2019-09-21', '2019-10-04', NULL, 0, 'Merkel Angela_invoice_5.pdf', '2019-09-23 15:54:50', '2019-09-24 17:18:45'),
(6, 27, 3, 1, 'Angela Merkel', NULL, NULL, '[{\"description\":\"test\",\"quality\":\"1\",\"unit_price\":\"160\",\"tax1\":\"0\",\"tax_val1\":\"32.00\",\"tax2\":\"1\",\"tax_val2\":\"48.00\",\"amount_price\":\"160.00\"},{\"description\":\"Company Incorporation\",\"quality\":\"20\",\"unit_price\":\"60\",\"tax1\":\"0\",\"tax_val1\":\"240.00\",\"tax2\":\"1\",\"tax_val2\":\"360.00\",\"amount_price\":\"1200.00\"}]', '1768.00', '1360.00', '0.00', '408.00', 'Invoice footer mesajıdırç üğişçö', '2019-09-22', '2019-10-05', NULL, 1, 'Angela Merkel_invoice_6.pdf', '2019-09-23 15:54:48', '2019-09-24 17:19:03'),
(8, 28, 3, 1, 'Merkel Angela', 'Istanbul Turkey', NULL, NULL, '0.00', '0.00', '0.00', '0.00', NULL, '2019-09-24', '2019-10-08', NULL, 0, 'Merkel Angela_invoice_8.pdf', '2019-09-24 17:12:58', '2019-09-24 17:13:12'),
(9, 27, 3, 2, 'Angela Merkel', 'Berlin, Germany', NULL, NULL, '0.00', '0.00', '0.00', '0.00', NULL, '2019-09-24', '2019-10-08', NULL, 0, 'Angela Merkel_invoice_9.pdf', '2019-09-24 17:15:03', '2019-09-24 17:15:20'),
(10, 28, 3, 1, 'Merkel Angela', 'Istanbul Turkey', NULL, NULL, '0.00', '0.00', '0.00', '0.00', NULL, '2019-09-24', '2019-10-08', NULL, 0, 'Merkel Angela_invoice_10.pdf', '2019-09-24 17:15:19', '2019-09-24 17:15:32'),
(11, 28, 3, 2, 'Merkel Angela', 'Istanbul Turkey', NULL, NULL, '0.00', '0.00', '0.00', '0.00', NULL, '2019-09-24', '2019-10-08', NULL, 0, 'Merkel Angela_invoice_11.pdf', '2019-09-24 17:18:47', '2019-09-24 17:19:14'),
(14, 28, 3, 2, 'Merkel Angela', 'Istanbul Turkey', NULL, '[{\"description\":\"E-Residency Application Fee1\",\"quality\":\"1\",\"unit_price\":\"90\",\"tax1\":\"1\",\"tax_val1\":\"18.00\",\"tax2\":\"1\",\"tax_val2\":\"27.00\",\"amount_price\":\"90.00\"},{\"description\":\"Company Incorporation1\",\"quality\":\"1\",\"unit_price\":\"160\",\"tax1\":\"1\",\"tax_val1\":\"32.00\",\"tax2\":\"1\",\"tax_val2\":\"48.00\",\"amount_price\":\"160.00\"}]', '375.00', '250.00', '50.00', '75.00', NULL, '2019-09-25', '2019-10-09', '2019-09-27', 3, 'Merkel Angela_invoice_14.pdf', '2019-09-25 14:00:45', '2019-09-27 14:54:30'),
(15, 27, 3, 2, 'Angela Merkel', NULL, NULL, '[{\"description\":\"Company register\",\"quality\":\"1\",\"unit_price\":\"1000\",\"tax1\":\"0\",\"tax_val1\":\"200.00\",\"tax2\":\"1\",\"tax_val2\":\"300.00\",\"amount_price\":\"1000.00\"}]', '1300.00', '1000.00', '0.00', '300.00', 'Invoice footer mesajıdırç üğişçö', '2019-09-26', '2019-10-10', NULL, 0, 'Angela Merkel_invoice_15.pdf', '2019-09-26 01:15:18', '2019-09-26 01:15:48');

-- --------------------------------------------------------

--
-- Table structure for table `memberships`
--

CREATE TABLE `memberships` (
  `id` int(10) UNSIGNED NOT NULL,
  `membership_name` varchar(191) DEFAULT NULL,
  `total_user` int(10) DEFAULT NULL,
  `total_client` int(10) DEFAULT NULL,
  `membership_price` int(10) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `memberships`
--

INSERT INTO `memberships` (`id`, `membership_name`, `total_user`, `total_client`, `membership_price`, `created_at`, `updated_at`) VALUES
(1, 'Starter', 1, 20, 8, '2019-09-01 09:58:58', '0000-00-00 00:00:00'),
(2, 'Small Team', 2, 50, 14, '2019-09-01 09:59:15', '0000-00-00 00:00:00'),
(3, 'Medium Team', 4, 100, 22, '2019-09-01 09:59:33', '0000-00-00 00:00:00'),
(4, 'Large Team', 8, 250, 40, '2019-09-01 10:00:01', '0000-00-00 00:00:00'),
(5, 'Enterprise', NULL, NULL, 90, '2019-09-01 10:00:56', '0000-00-00 00:00:00');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_02_14_154912_create_sliders_table', 1),
(4, '2018_02_18_143201_create_categories_table', 1),
(5, '2018_02_19_144026_create_items_table', 1),
(6, '2018_03_06_113535_create_reservations_table', 1),
(7, '2018_03_06_151601_create_contacts_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `currency_id` int(10) UNSIGNED DEFAULT 1,
  `business_name` varchar(191) DEFAULT NULL,
  `contact_name` varchar(191) DEFAULT NULL,
  `company_number` varchar(191) DEFAULT NULL,
  `vat_number` varchar(191) DEFAULT NULL,
  `business_address` text DEFAULT NULL,
  `payment_term` int(10) DEFAULT 14,
  `invoice_footer` text DEFAULT NULL,
  `quote_footer` text DEFAULT NULL,
  `user_avatar` varchar(191) DEFAULT 'frontend/images/avatar.png',
  `company_logo` varchar(191) DEFAULT NULL,
  `lang` varchar(191) NOT NULL DEFAULT 'en',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `currency_id`, `business_name`, `contact_name`, `company_number`, `vat_number`, `business_address`, `payment_term`, `invoice_footer`, `quote_footer`, `user_avatar`, `company_logo`, `lang`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, NULL, NULL, NULL, NULL, 14, NULL, NULL, 'frontend/images/avatar.png', NULL, 'en', '2019-08-31 21:38:56', '2019-09-24 19:31:48'),
(2, 2, NULL, 'IT Company', 'aaaa', '2341543', 'ES123007', 'Lasnemi 4B-1, 113029, Jhon, Boston', 20, 'IBAN: EE40 7700 7710 0284 2029\r\nBIC/SWIFT: LHVBEE22\r\nAddress: AS LHV Pank, Tartu mnt 2, 10145 Tallinn, Estonia', 'IBAN: EE40 7700 7710 0284 2029\r\nBIC/SWIFT: LHVBEE22\r\nAddress: AS LHV Pank, Tartu mnt 2, 10145 Tallinn, Estonia', 'uploads/user_avatar/2019-09-15-5d7dbd06c734b.png', NULL, 'en', '2019-09-19 16:59:20', '2019-09-19 16:59:20'),
(17, 15, 1, NULL, NULL, NULL, NULL, NULL, 14, NULL, NULL, 'frontend/images/avatar.png', NULL, 'en', '2019-09-18 11:41:41', '2019-09-24 16:26:26'),
(18, 17, 2, 'Adelianz OÜ', 'Aşkın Yıldız', '14527107', NULL, 'Harju maakond, Tallinn, Kesklinna linnaosa, Tina tn 21-5, 10126', 14, 'Invoice footer mesajıdırç üğişçö', 'Quote footer mesajıdırç üğişçö', 'frontend/images/avatar.png', NULL, 'en', '2019-09-20 15:53:32', '2019-09-25 01:07:15');

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

CREATE TABLE `quotes` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED DEFAULT NULL,
  `account_id` int(10) UNSIGNED DEFAULT NULL,
  `currency_id` int(10) UNSIGNED DEFAULT 1,
  `recipient_name` varchar(191) DEFAULT NULL,
  `recipient_address` text DEFAULT NULL,
  `recipient_description` text DEFAULT NULL,
  `quote_description` text DEFAULT NULL,
  `sum_total` decimal(10,2) DEFAULT 0.00,
  `sub_total` decimal(10,2) DEFAULT 0.00,
  `sum_tax1` decimal(10,2) DEFAULT 0.00,
  `sum_tax2` decimal(10,2) DEFAULT 0.00,
  `quote_footer` text DEFAULT NULL,
  `date_issued` varchar(191) DEFAULT NULL,
  `accepted_at` varchar(191) DEFAULT NULL,
  `declined_at` varchar(191) DEFAULT NULL,
  `status` int(2) DEFAULT 0,
  `attach_pdf` varchar(191) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quotes`
--

INSERT INTO `quotes` (`id`, `client_id`, `account_id`, `currency_id`, `recipient_name`, `recipient_address`, `recipient_description`, `quote_description`, `sum_total`, `sub_total`, `sum_tax1`, `sum_tax2`, `quote_footer`, `date_issued`, `accepted_at`, `declined_at`, `status`, `attach_pdf`, `created_at`, `updated_at`) VALUES
(1, 14, 2, 1, 'Mr. Super Client', 'Istanbul, Turkey', NULL, NULL, '1.00', '200.00', NULL, '200.00', 'IBAN: EE40 7700 7710 0284 2029\r\nBIC/SWIFT: LHVBEE22\r\nAddress: AS LHV Pank, Tartu mnt 2, 10145 Tallinn, Estonia', '2019-09-15', NULL, NULL, 0, 'Mr. Super Client_quote_1.pdf', '2019-09-18 20:34:09', '2019-09-24 16:40:17'),
(5, 15, 2, 1, NULL, NULL, NULL, NULL, '0.00', '0.00', NULL, '0.00', NULL, NULL, NULL, NULL, 0, NULL, '2019-09-16 03:27:43', '2019-09-16 03:27:43'),
(6, 16, 2, 1, NULL, NULL, NULL, NULL, '0.00', '0.00', NULL, '0.00', NULL, '2019-09-17', NULL, NULL, 0, NULL, '2019-09-17 02:07:00', '2019-09-17 02:07:00'),
(7, 14, 2, 1, 'Mr. Super Client', 'Istanbul, Turkey', NULL, NULL, '1.00', '200.00', NULL, '200.00', NULL, '2019-09-15', NULL, NULL, 0, NULL, '2019-09-17 21:22:50', '2019-09-17 21:22:50'),
(11, 19, 2, 1, NULL, NULL, NULL, NULL, '0.00', '0.00', NULL, '0.00', NULL, '2019-09-20', NULL, NULL, 0, NULL, '2019-09-20 04:18:35', '2019-09-20 04:18:35'),
(12, 19, 2, 1, NULL, NULL, NULL, NULL, '0.00', '0.00', NULL, '0.00', NULL, '2019-09-20', NULL, NULL, 0, NULL, '2019-09-20 04:21:34', '2019-09-20 04:21:34'),
(13, 27, 3, 1, 'Angela Merkel', 'Berlin Germany', NULL, '[{\"description\":\"E-Residency Fee\",\"quality\":\"10\",\"unit_price\":\"30\",\"tax1\":\"1\",\"tax_val1\":\"60.00\",\"tax2\":\"0\",\"tax_val2\":\"90.00\",\"amount_price\":\"300.00\"},{\"description\":\"E-Residency Application Fee\",\"quality\":\"10\",\"unit_price\":\"90\",\"tax1\":\"0\",\"tax_val1\":\"180.00\",\"tax2\":\"1\",\"tax_val2\":\"270.00\",\"amount_price\":\"900.00\"}]', '1530.00', '1200.00', '60.00', '270.00', 'Quote footer mesajıdırç üğişçö', '2019-09-20', '2019-09-23', NULL, 2, 'Angela Merkel_quote_13.pdf', '2019-09-23 17:06:20', '2019-09-23 09:06:20'),
(14, 27, 3, 1, 'Angela Merkel', 'Berlin Germany', NULL, '[{\"description\":\"E-Residency Fee\",\"quality\":\"10\",\"unit_price\":\"30\",\"tax1\":\"1\",\"tax_val1\":\"60.00\",\"tax2\":\"0\",\"tax_val2\":\"90.00\",\"amount_price\":\"300.00\"},{\"description\":\"E-Residency Application Fee\",\"quality\":\"10\",\"unit_price\":\"90\",\"tax1\":\"0\",\"tax_val1\":\"180.00\",\"tax2\":\"1\",\"tax_val2\":\"270.00\",\"amount_price\":\"900.00\"}]', '1530.00', '1200.00', '60.00', '270.00', NULL, '2019-09-20', NULL, NULL, 0, 'Angela Merkel_quote_14.pdf', '2019-09-22 14:42:43', '2019-09-24 04:07:44'),
(15, 27, 3, 1, 'Angela Merkel', 'Berlin Germany', NULL, '[{\"description\":\"E-Residency Fee\",\"quality\":\"10\",\"unit_price\":\"30\",\"tax1\":\"1\",\"tax_val1\":\"60.00\",\"tax2\":\"0\",\"tax_val2\":\"90.00\",\"amount_price\":\"300.00\"},{\"description\":\"E-Residency Application Fee\",\"quality\":\"10\",\"unit_price\":\"90\",\"tax1\":\"0\",\"tax_val1\":\"180.00\",\"tax2\":\"1\",\"tax_val2\":\"270.00\",\"amount_price\":\"900.00\"}]', '1530.00', '1200.00', '60.00', '270.00', 'Quote footer mesajıdırç üğişçö', '2019-09-20', NULL, NULL, 0, 'Angela Merkel_quote_15.pdf', '2019-09-23 12:45:42', '2019-09-23 04:45:42'),
(16, 28, 3, 1, 'Merkel Angela', 'Istanbul Turkey', NULL, NULL, '0.00', '0.00', '0.00', '0.00', NULL, '2019-09-21', NULL, NULL, 0, 'Merkel Angela_quote_16.pdf', '2019-09-23 16:28:47', '2019-09-23 08:28:47'),
(17, 27, 3, 1, 'Angela Merkel', 'Berlin Germany', NULL, '[{\"description\":\"raww\",\"quality\":\"1\",\"unit_price\":\"1000\",\"tax1\":\"1\",\"tax_val1\":\"200.00\",\"tax2\":\"1\",\"tax_val2\":\"300.00\",\"amount_price\":\"1000.00\"},{\"description\":\"2aeew\",\"quality\":\"1\",\"unit_price\":\"1000\",\"tax1\":\"1\",\"tax_val1\":\"200.00\",\"tax2\":\"1\",\"tax_val2\":\"300.00\",\"amount_price\":\"1000.00\"}]', '3000.00', '2000.00', '400.00', '600.00', 'Quote footer mesajıdırç üğişçö', '2019-09-21', NULL, NULL, 1, 'Angela Merkel_quote_17.pdf', '2019-09-23 03:38:55', '2019-09-22 19:38:55'),
(18, 28, 3, 1, 'Merkel Angela', 'Istanbul Turkey', NULL, NULL, '0.00', '0.00', '0.00', '0.00', NULL, '2019-09-22', NULL, NULL, 0, NULL, '2019-09-22 20:35:19', '2019-09-22 20:35:19'),
(19, 27, 3, 1, 'Angela Merkel', 'Berlin Germany', NULL, NULL, '0.00', '0.00', '0.00', '0.00', NULL, '2019-09-23', NULL, NULL, 0, 'Angela Merkel_quote_19.pdf', '2019-09-23 09:10:37', '2019-09-23 01:10:37'),
(20, 27, 3, 1, 'Angela Merkel', 'Berlin Germany', NULL, NULL, '0.00', '0.00', '0.00', '0.00', NULL, '2019-09-23', NULL, NULL, 0, NULL, '2019-09-23 02:06:18', '2019-09-23 02:06:18'),
(21, 28, 3, 1, 'Merkel Angela', 'Istanbul Turkey', NULL, NULL, '0.00', '0.00', '0.00', '0.00', NULL, '2019-09-23', NULL, '2019-09-23', 3, 'Merkel Angela_quote_21.pdf', '2019-09-23 11:35:57', '2019-09-23 03:35:57'),
(22, 28, 3, 1, 'Merkel Angela', 'Istanbul Turkey', NULL, '[{\"description\":\"sdfd\",\"quality\":\"1\",\"unit_price\":\"110\",\"tax1\":\"1\",\"tax_val1\":\"22.00\",\"tax2\":\"1\",\"tax_val2\":\"33.00\",\"amount_price\":\"110.00\"}]', '165.00', '110.00', '22.00', '33.00', 'Quote footer mesajıdırç üğişçö', '2019-09-23', '2019-09-24', NULL, 2, 'Merkel Angela_quote_22.pdf', '2019-09-23 17:06:30', '2019-09-24 05:22:09'),
(24, 27, 3, 2, 'Angela Merkel', 'Berlin, Germany', NULL, '[{\"description\":\"Company register\",\"quality\":\"1\",\"unit_price\":\"1000\",\"tax1\":\"0\",\"tax_val1\":\"200.00\",\"tax2\":\"1\",\"tax_val2\":\"300.00\",\"amount_price\":\"1000.00\"}]', '1300.00', '1000.00', '0.00', '300.00', 'Quote footer mesajıdırç üğişçö', '2019-09-24', NULL, NULL, 0, 'Angela Merkel_quote_24.pdf', '2019-09-24 17:06:17', '2019-09-24 17:06:49'),
(26, 28, 3, 3, 'Merkel Angela', 'Istanbul Turkey', NULL, '[{\"description\":\"E-Residency Application Fee1\",\"quality\":\"1\",\"unit_price\":\"90\",\"tax1\":\"1\",\"tax_val1\":\"18.00\",\"tax2\":\"1\",\"tax_val2\":\"27.00\",\"amount_price\":\"90.00\"},{\"description\":\"Company Incorporation1\",\"quality\":\"1\",\"unit_price\":\"160\",\"tax1\":\"1\",\"tax_val1\":\"32.00\",\"tax2\":\"1\",\"tax_val2\":\"48.00\",\"amount_price\":\"160.00\"}]', '375.00', '250.00', '50.00', '75.00', 'Quote footer mesajıdırç üğişçö', '2019-09-24', NULL, NULL, 1, 'Merkel Angela_quote_26.pdf', '2019-09-24 17:17:40', '2019-09-25 13:57:29');

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_id` int(10) UNSIGNED DEFAULT NULL,
  `pay_value` int(10) DEFAULT 0,
  `pay_date` date DEFAULT NULL,
  `pay_description` varchar(191) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`id`, `invoice_id`, `pay_value`, `pay_date`, `pay_description`, `created_at`, `updated_at`) VALUES
(1, 6, 20, '2019-09-23', 'Pay1', '2019-09-23 16:52:29', '2019-09-23 16:52:29'),
(2, 14, 375, '2019-09-27', 'Pay1', '2019-09-28 02:24:59', '2019-09-28 02:24:59');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_name` varchar(191) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 'Account Creator', '2019-09-05 23:01:37', '2019-09-05 23:01:37'),
(2, 'Admin', '2019-09-05 23:01:49', '2019-09-05 23:01:49'),
(3, 'User', '2019-09-05 23:02:22', '2019-09-05 23:02:22');

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `tax_description` varchar(191) DEFAULT NULL,
  `tax_percentage` int(10) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `taxes`
--

INSERT INTO `taxes` (`id`, `user_id`, `tax_description`, `tax_percentage`, `created_at`, `updated_at`) VALUES
(1, 17, 'Tax1', 20, '2019-09-19 17:47:29', '2019-09-19 17:47:29'),
(2, 17, 'Tax2', 30, '2019-09-19 17:49:04', '2019-09-19 17:49:04'),
(3, 2, 'tax1', 10, '2019-09-19 18:04:50', '2019-09-19 18:04:50');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(10) UNSIGNED NOT NULL,
  `account_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `account_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2019-09-06 00:39:58', '2019-09-06 00:39:58'),
(2, 2, 2, '2019-09-06 02:33:46', '2019-09-06 02:33:46'),
(4, 2, 15, '2019-09-07 10:17:39', '2019-09-07 10:17:39'),
(5, 3, 17, '2019-09-19 12:38:08', '2019-09-19 12:38:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `super_admin` int(10) DEFAULT 0,
  `active` int(10) DEFAULT 0,
  `team_id` int(10) UNSIGNED DEFAULT NULL,
  `role_id` int(10) UNSIGNED DEFAULT 1,
  `membership_id` int(10) UNSIGNED DEFAULT NULL,
  `membership_started` date DEFAULT NULL,
  `membership_expired` date DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `super_admin`, `active`, `team_id`, `role_id`, `membership_id`, `membership_started`, `membership_expired`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@payviame.com', '$2y$10$Zd03u8ij4l.qp67nl3JcguzXftebsYk3AGcIt8tctaZrw60LwGbO2', 1, 1, 1, 1, NULL, NULL, NULL, 'XzybgYwatsq5iDQws0VogcRy5sVVp3XwQyZKwm90JKgpzl27lsT8PQBfbqWw', '2019-08-24 12:32:38', '2019-09-01 16:42:00'),
(2, 'Dolley', 'dolley@payviame.com', '$2y$10$/zJ837uv2Og7w6KPuM5SdOi3t.bkgxL9DWtTdG.5sxuqIpi0F3bWm', 0, 1, 2, 1, 3, NULL, NULL, 'E2mLBejH3h5f7yTHZsHD9KCOX4LvyX5eR4qCIQnqNCDtfNrTMqvRNSm5qrl8', '2019-08-30 14:57:08', '2019-09-15 00:22:44'),
(15, 'Wang', 'wang@payviame.com', '$2y$10$rRWN/8lbkOII74giAFtawuCo8exqI/PdVc.55SdM1djCmunPUHcPK', 0, 0, 4, 3, NULL, NULL, NULL, 'RDiO1UQJormKplGCR0556XbKSIY0meJr6EI4B3kxOrB2VaGZlZlY3CEqRHPl', '2019-09-06 02:33:44', '2019-09-24 16:52:31'),
(17, 'Johny Walker', 'askiny@yahoo.com', '$2y$10$tLMaHf1BdzbJbqzzd8mKFuSg50A37vNTWIeCOdIUZvw1eVYtWhK2a', 0, 1, 5, 1, 4, NULL, NULL, 'eoPUZhaEGeYHWDvmCZ5EjQk4X1FWDR8YC6f1amXm2IMiU3hg2wY81icCRXSd', '2019-09-19 12:38:08', '2019-09-19 12:39:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accounts_user_id_index` (`user_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clients_account_id_index` (`account_id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventories_user_id_foreign` (`user_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_client_id_foreign` (`client_id`);

--
-- Indexes for table `memberships`
--
ALTER TABLE `memberships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profiles_user_id_index` (`user_id`);

--
-- Indexes for table `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quotes_client_id_foreign` (`client_id`);

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `records_invoice_id_foreign` (`invoice_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `taxes_user_id_foreign` (`user_id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teams_account_id_index` (`account_id`),
  ADD KEY `teams_user_id_index` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_team_id_foreign` (`team_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `memberships`
--
ALTER TABLE `memberships`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `quotes`
--
ALTER TABLE `quotes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `inventories`
--
ALTER TABLE `inventories`
  ADD CONSTRAINT `inventories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `quotes`
--
ALTER TABLE `quotes`
  ADD CONSTRAINT `quotes_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `records`
--
ALTER TABLE `records`
  ADD CONSTRAINT `records_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `taxes`
--
ALTER TABLE `taxes`
  ADD CONSTRAINT `taxes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `teams_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `teams_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
