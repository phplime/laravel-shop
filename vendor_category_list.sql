-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Nov 27, 2025 at 06:26 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `vendor_category_list`
--

CREATE TABLE `vendor_category_list` (
  `id` int NOT NULL,
  `orders` int DEFAULT '0',
  `vendor_id` int NOT NULL,
  `user_id` int NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `images` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumb` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL,
  `created_at` datetime NOT NULL,
  `is_default` int NOT NULL DEFAULT '0',
  `match_id` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'category_id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendor_category_list`
--

INSERT INTO `vendor_category_list` (`id`, `orders`, `vendor_id`, `user_id`, `slug`, `images`, `thumb`, `icon`, `status`, `created_at`, `is_default`, `match_id`) VALUES
(1, 1, 1, 6, 'pizza', '43', '43', '', 1, '2025-07-02 09:03:15', 0, 'category_id'),
(2, 2, 1, 6, 'cheese-pizza', '13', '13', '', 1, '2025-07-02 09:03:34', 0, 'category_id'),
(4, 1, 7, 12, '', '32', '32', '', 1, '2025-01-12 14:05:16', 0, 'category_id'),
(5, 1, 2, 6, '', '', '', '', 1, '2025-03-21 16:05:24', 0, 'category_id'),
(6, 1, 2, 6, '', '', '', '', 1, '2025-03-21 16:05:37', 0, 'category_id'),
(7, 1, 9, 6, '', '138', '138', '', 1, '2025-07-04 07:26:44', 0, 'category_id'),
(8, 1, 9, 6, '', '139', '139', '', 1, '2025-07-04 07:28:45', 0, 'category_id'),
(9, 1, 10, 13, '', '', '', '', 1, '2025-06-16 10:43:05', 0, 'category_id'),
(10, 8, 1, 6, '', '36', '36', '', 1, '2025-07-02 08:45:41', 0, 'category_id'),
(11, 8, 1, 6, '', '37', '37', '', 1, '2025-07-02 08:47:26', 0, 'category_id'),
(12, 8, 1, 6, '', '38', '38', '', 1, '2025-07-02 08:48:57', 0, 'category_id'),
(13, 8, 1, 6, '', '39', '39', '', 1, '2025-07-02 08:52:32', 0, 'category_id'),
(14, 8, 1, 6, '', '40', '40', '', 1, '2025-07-02 08:54:32', 0, 'category_id'),
(15, 8, 1, 6, '', '41', '41', '', 1, '2025-07-02 08:57:33', 0, 'category_id'),
(16, 8, 1, 6, '', '42', '42', '', 1, '2025-07-02 08:59:05', 0, 'category_id'),
(17, 8, 1, 6, '', '44', '44', '', 1, '2025-07-02 09:06:46', 0, 'category_id'),
(18, 2, 9, 6, '', '140', '140', '', 1, '2025-07-04 07:31:16', 0, 'category_id'),
(19, 2, 9, 6, '', '141', '141', '', 1, '2025-07-04 07:34:28', 0, 'category_id'),
(20, 2, 9, 6, '', '142', '142', '', 1, '2025-07-04 07:36:08', 0, 'category_id'),
(21, 2, 9, 6, '', '143', '143', '', 1, '2025-07-04 07:40:25', 0, 'category_id'),
(22, 2, 9, 6, '', '144', '144', '', 1, '2025-07-04 07:42:51', 0, 'category_id'),
(23, 2, 9, 6, '', '146', '146', '', 1, '2025-07-04 07:46:45', 0, 'category_id'),
(24, 2, 9, 6, '', '147', '147', '', 1, '2025-07-04 07:49:39', 0, 'category_id'),
(25, 2, 9, 6, '', '148', '148', '', 1, '2025-07-04 07:53:16', 0, 'category_id'),
(26, 91, 1, 6, '', '', '', '', 1, '2025-11-15 13:24:48', 0, 'category_id');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `vendor_category_list`
--
ALTER TABLE `vendor_category_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `vendor_category_list`
--
ALTER TABLE `vendor_category_list`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
