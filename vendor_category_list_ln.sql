-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Nov 27, 2025 at 06:25 AM
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
-- Table structure for table `vendor_category_list_ln`
--

CREATE TABLE `vendor_category_list_ln` (
  `id` int NOT NULL,
  `category_id` int DEFAULT NULL,
  `category_name` varchar(200) DEFAULT NULL,
  `language` varchar(50) NOT NULL DEFAULT 'en'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `vendor_category_list_ln`
--

INSERT INTO `vendor_category_list_ln` (`id`, `category_id`, `category_name`, `language`) VALUES
(1, 2, 'Pizza', 'en'),
(2, 2, 'Pizzas', 'es'),
(3, 1, 'Pasta', 'en'),
(4, 1, 'Pastas', 'es'),
(7, 4, 'Pizza', 'en'),
(8, 4, 'Pizzas', 'es'),
(9, 5, 'Pizza', 'en'),
(10, 5, 'Pizzas', 'es'),
(11, 6, 'Pasta', 'en'),
(12, 6, 'Pastas', 'es'),
(13, 7, 'Phone', 'en'),
(14, 7, 'هاتف', 'ar'),
(15, 7, 'Phone', 'es'),
(16, 8, 'Smart Watch', 'en'),
(17, 8, 'ساعة ذكية', 'ar'),
(18, 8, 'Reloj inteligente', 'es'),
(19, 9, 'Pizza', 'en'),
(20, 9, 'Pizza - ar', 'ar'),
(21, 9, 'Pizza -es', 'es'),
(22, 2, 'بيتزا', 'ar'),
(23, 10, 'burger', 'en'),
(24, 10, 'برجر', 'ar'),
(25, 10, 'burger', 'es'),
(26, 11, 'Fried Chicken', 'en'),
(27, 11, 'دجاج مقلي', 'ar'),
(28, 11, 'Pollo frito', 'es'),
(29, 12, 'Sandwich', 'en'),
(30, 12, 'شطيرة', 'ar'),
(31, 12, 'Sándwich', 'es'),
(32, 13, 'Hot Chicken Entrees', 'en'),
(33, 13, 'أطباق الدجاج الساخنة', 'ar'),
(34, 13, 'Platos principales de pollo picante', 'es'),
(35, 14, 'Zoop Soups', 'en'),
(36, 14, 'حساء زووب', 'ar'),
(37, 14, 'Sopas Zoop', 'es'),
(38, 15, 'Desserts', 'en'),
(39, 15, 'الحلويات', 'ar'),
(40, 15, 'Postres', 'es'),
(41, 16, 'Salads', 'en'),
(42, 16, 'السلطات', 'ar'),
(43, 16, 'Ensaladas', 'es'),
(44, 1, 'المعكرونة', 'ar'),
(45, 17, 'Beverages', 'en'),
(46, 17, 'المشروبات', 'ar'),
(47, 17, 'Bebidas', 'es'),
(48, 18, 'Laptop', 'en'),
(49, 18, 'كمبيوتر محمول', 'ar'),
(50, 18, 'Computadora portátil', 'es'),
(51, 19, 'Desktop', 'en'),
(52, 19, 'سطح المكتب', 'ar'),
(53, 19, 'de oficina', 'es'),
(54, 20, 'Monitor', 'en'),
(55, 20, 'شاشة', 'ar'),
(56, 20, 'Monitor', 'es'),
(57, 21, 'keyboard', 'en'),
(58, 21, 'لوحة المفاتيح', 'ar'),
(59, 21, 'keyboard', 'es'),
(60, 22, 'Mouse', 'en'),
(61, 22, 'الفأر', 'ar'),
(62, 22, 'Ratón', 'es'),
(63, 23, 'Headphone', 'en'),
(64, 23, 'سماعة الرأس', 'ar'),
(65, 23, 'Auricular', 'es'),
(66, 24, 'Earbud', 'en'),
(67, 24, 'سماعة أذن', 'ar'),
(68, 24, 'Auricular', 'es'),
(69, 25, 'TV', 'en'),
(70, 25, 'تلفزيون', 'ar'),
(71, 25, 'televisor', 'es'),
(72, 26, 'Pizza', 'en'),
(73, 26, 'بيتزا', 'ar'),
(74, 26, 'Pizzas', 'es');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `vendor_category_list_ln`
--
ALTER TABLE `vendor_category_list_ln`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `vendor_category_list_ln`
--
ALTER TABLE `vendor_category_list_ln`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
