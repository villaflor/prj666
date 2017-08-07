-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 06, 2017 at 07:31 AM
-- Server version: 5.7.18
-- PHP Version: 7.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wecreu`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `admin_username` varchar(15) NOT NULL,
  `admin_password` varchar(64) NOT NULL,
  `salt` varchar(32) NOT NULL,
  `admin_email` varchar(150) NOT NULL,
  `recovery_hash` varchar(255) DEFAULT NULL,
  `recovery_expire` datetime DEFAULT NULL,
  `validate_hash` varchar(255) DEFAULT NULL,
  `validate_expire` datetime DEFAULT NULL,
  `validated` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_username`, `admin_password`, `salt`, `admin_email`, `recovery_hash`, `recovery_expire`, `validate_hash`, `validate_expire`, `validated`) VALUES
(1, 'admin911', 'admin911', '826ebf5540b7664d58dc024d9509318920e7c91e0864167dcb9d4fb844a910fe', 'ˆ:Î¢ÑßÞ­Åh,Ý7´\ZuHóËÁEH½HÂyÚ‡', 'admin911@yopmail.com', NULL, NULL, 'osmLVqRwv2BaXKG8rx1V5W35f2CMKH1cWAjwLZooJKm82CiNZgvPHgo0xNKwVjB1m7pHWMlySZUWbZxJCAEoim5jpzuOjQepWdOEVgZLdQO1Gk2ZMhTbZQTTAtVONf1563zB7SW1tCIAiCUO9wgkSfnzGM7TZqq65w5cpGfq1w6L8VKup3ZNr2E2HyqM8XLFcaYYm9RqRmuQpUFBEH43qHVFAZnMY7Uy00crpIJ1WZVzy4sZmSXJcaSybin4ICw', '2017-07-25 07:38:27', 0),
(10, 'wecreu888', 'wecreu888', '50b446a0c68016f48fe826d4ce91ac1cc6a773515dbe28bb8d32c41434c960b9', 'y¥Ç®:õ¤x¦É‡â*ÿ-kcÈ­V|', 'wecreu888@yopmail.com', NULL, NULL, NULL, NULL, 1),
(11, 'Emile Ohan', 'eohan1', '6a8d68faf457404aef2da37dcf8d816fe3e8e8fae32875b060cb633b196dfc33', '[Ï‡ùÐ8(O°¯nÂN<1ˆ¤C\0hä¢rM9Íûf', 'eohan@yopmail.com', NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin_session`
--

CREATE TABLE `admin_session` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `hash` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(30) NOT NULL,
  `category_description` varchar(300) DEFAULT NULL,
  `category_display` tinyint(1) NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_description`, `category_display`, `client_id`) VALUES
(185, 'Extreme Fish', 'Category 1', 1, 1),
(186, 'Food Fish', 'Category 2', 1, 1),
(187, 'Fun Fish', 'Category 3', 1, 1),
(188, ' Blonde Vanilla Latte', ' Blonde Vanilla Latte', 0, 57),
(189, 'Drinks', 'Drinks', 1, 57),
(190, 'Food', 'Food', 0, 57),
(191, 'Breakfast Sandwiches', 'Breakfast Sandwiches', 1, 57),
(192, 'Wholesome Grains', 'Wholesome Grains', 0, 57),
(193, 'Fruit and Yogurt', 'Fruit and Yogurt', 1, 57),
(194, 'Laptop2', 'Laptop', 1, 60),
(195, 'TV2', 'TV', 1, 60),
(196, 'Desktop2', 'Desktop', 1, 60),
(197, 'Printer2', 'Printer', 1, 60),
(198, 'Tracks', 'tracks we sell!', 1, 75),
(199, 'Props - Trees!', 'trees to put around railway', 1, 75),
(200, 'Props - Buildings! ', 'towns and stations around your railway!', 0, 75),
(201, 'Props - people!', 'passengers and staff using your railway', 1, 75),
(202, 'Engines', 'engines that pull cars', 1, 75),
(203, 'Railcar', 'cars to attach to train', 1, 75),
(205, 'Televisions', 'Here all the televisions', 1, 76),
(206, 'Desktops', 'Here are all the desktops', 1, 76),
(207, 'Printer', 'These are all the printer', 1, 76),
(208, 'Tablet', 'Here are all the tablet.', 1, 76);

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `client_name` varchar(50) NOT NULL,
  `client_site_title` varchar(100) NOT NULL,
  `client_logo` varchar(256) NOT NULL DEFAULT '/data/default/logo.png',
  `client_information` varchar(256) DEFAULT NULL,
  `client_tax` decimal(4,2) UNSIGNED DEFAULT NULL,
  `payment_option_paypal` tinyint(1) NOT NULL DEFAULT '0',
  `payment_option_visa` tinyint(1) NOT NULL DEFAULT '0',
  `payment_option_mastercard` tinyint(1) NOT NULL DEFAULT '0',
  `payment_option_ae` tinyint(1) NOT NULL DEFAULT '0',
  `username` varchar(15) NOT NULL,
  `password` varchar(64) NOT NULL,
  `salt` varchar(32) NOT NULL,
  `client_admin_email` varchar(150) NOT NULL,
  `recovery_hash` varchar(255) DEFAULT NULL,
  `validated` tinyint(1) DEFAULT '0',
  `validate_hash` varchar(255) DEFAULT NULL,
  `reset_password_expire` datetime DEFAULT NULL,
  `validate_email_expire` datetime DEFAULT NULL,
  `phone_number` bigint(10) DEFAULT NULL,
  `last_payment` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_id`, `client_name`, `client_site_title`, `client_logo`, `client_information`, `client_tax`, `payment_option_paypal`, `payment_option_visa`, `payment_option_mastercard`, `payment_option_ae`, `username`, `password`, `salt`, `client_admin_email`, `recovery_hash`, `validated`, `validate_hash`, `reset_password_expire`, `validate_email_expire`, `phone_number`, `last_payment`) VALUES
(1, 'For Green Template', 'Wecreu', '/data/default/wecreu/logo.png', 'We sale magical items and broom sticks.', 50.00, 1, 1, 1, 1, 'Wecreu', 'Password123', '', 'admin@magicalitem.com', NULL, 1, NULL, NULL, NULL, NULL, '2017-06-30 00:00:00'),
(22, 'Christopher', 'Group 4 member', '', '', 0.00, 0, 0, 0, 0, 'testingclient', '7a3487f5adcc1ca6f3f47bb358dc5cd11befeb220246ed08ebc85c7ba351058d', 'tŠ”4rr„¬›ÛÑÈ…‘KÄ+»è²=(G¤É', 'admin@testng.com', NULL, 1, NULL, NULL, NULL, NULL, '2017-07-30 15:40:11'),
(47, 'Christopher Lopez', 'Fruite', '', 'We sell only fruits and vegetables', 0.00, 0, 0, 0, 0, 'TestOne', '4632deb622aada18fff2a113ee3ba4412b317ec840caba56b1a58ad9364ac654', 'ðI\\°\0‰¢ÎÅ×§—c0ªEÀ<$Ü°Ž¢3%‹Â¹', 'yopeyone@gmail.com', NULL, 1, NULL, NULL, NULL, NULL, '2017-07-30 15:40:11'),
(53, 'Emile', 'Test', '', '      ', 0.00, 0, 0, 0, 0, 'emile1', '8e252026c0cbcf73d2e241364924068c9b8de30f0d41bf2ac27a056a127f2e7c', '£’˜ý\r_Ê¾¹Ö\"[´ß¥¯ç4û§|E­ÚŠî@“É', 'emile.ohan@senecacollege.ca', NULL, 1, NULL, NULL, NULL, NULL, '2017-07-30 15:40:11'),
(57, 'Brian', 'StarStar', '../brianred/images/logo.jpg', 'An amazing coffice shop.', 13.00, 0, 1, 0, 0, 'brianred', 'b95396a5849b9a9c6657821c4abfada7c31dee372aa011fd7e574f29b6c6d89f', ' ŠÆ@uèôE†üFœu>ççJHÎF…FÃö[òã~Õ', 'pyang16@myseneca.ca', NULL, 1, NULL, NULL, NULL, NULL, '2017-07-30 15:40:11'),
(59, 'ueditor', 'Dont Delete This Account', '/data/default/logo.png', NULL, NULL, 0, 0, 0, 0, 'ueditor', '', '', '', NULL, 1, NULL, NULL, NULL, NULL, '2017-07-30 15:40:11'),
(60, 'briangrey', 'BITS', '../briangrey/images/logo.jpg', 'Brian\'s IT shop', 8.00, 0, 1, 1, 0, 'briangrey', 'd63d4b3088861b52923383426d0d9cfbe0903a86a29bf3278e48fadeb2d4189b', '-\"{]fÏûáÌä%óÜK¥^*L1CzQ·ð¸ù', 'pyang16@myseneca', NULL, 1, NULL, NULL, NULL, NULL, '2017-07-30 15:40:11'),
(75, 'Owl', 'TrakStor', '../tester/images/logo.jpg', 'this is a test', 50.00, 1, 1, 0, 0, 'tester', '41a11251fc50f97890e56017697acc59e9884534e4d45ea998ebda142280445b', 'Ž<Áé¾£†ëo[RŸ¥¡áo&áã%CÞž «’‡ëBê', 'arsenievao@gmail.com', NULL, 1, NULL, NULL, NULL, NULL, '2017-07-30 15:40:11'),
(76, 'For Demo', 'Demo Site', '', 'This is for final presentation. \r\nUsername: demo101\r\nPassword: password\r\nEmail: demo101@yopmail.com', 13.00, 0, 1, 1, 1, 'demo101', '8e2d89280dd3f1c859f0c1dc053919fd24244e55ca8513daa3d8c520cf9b43bb', 'ë, ë¤In‚ÙbÄ¯o9X-¦mþª®7¾—LŠ7', 'demo101@yopmail.com', NULL, 1, NULL, NULL, NULL, NULL, '2017-08-03 18:01:30'),
(78, 'wecreu', 'wecreu2', '/data/default/logo.png', 'this is to protect wecreu directory from overwriting', NULL, 0, 0, 0, 0, 'phpmyadmin', 'wecreu', 'wecreu', 'wecreu@wecreu.com', NULL, 0, NULL, NULL, NULL, NULL, '2017-08-04 14:47:25');

-- --------------------------------------------------------

--
-- Table structure for table `client_session`
--

CREATE TABLE `client_session` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `hash` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client_session`
--

INSERT INTO `client_session` (`id`, `client_id`, `hash`) VALUES
(1, 23, '3f98a70752017f524c560f2824f0abdcc1a937c164a0295c63bbb55f6a083a02');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_number` varchar(14) DEFAULT NULL,
  `customer_street_address` varchar(300) NOT NULL,
  `customer_city` varchar(100) NOT NULL,
  `customer_state` varchar(100) NOT NULL,
  `customer_country` varchar(100) NOT NULL,
  `customer_email` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `customer_number`, `customer_street_address`, `customer_city`, `customer_state`, `customer_country`, `customer_email`) VALUES
(1, 'Mark Anthony', NULL, 'The pond road', 'Toronto', 'Ontario', 'Canada', 'mark@myseneca.ca'),
(3, 'Brian Yang', NULL, '32 Kennedy', 'Markham', 'Ontario', 'Canada', 'brian@pying.ca'),
(4, 'Christopher', '437-344-1990', '26 deborah drive', 'toronto ', 'ON', 'Canada', 'lopezc004@gmail.com'),
(5, 'Christopher', '437-344-1990', '26 Deborah Drive', 'Toronto', 'ON', 'Canada', 'lopezc004@gmail.com'),
(8, 'test', '111-111-1111', 'test', 'test', 'test', 'test', 'test@test.com'),
(10, 'tack', '123-456-7890', 'mp', 'mp', 'mp', 'mp', 'kcat@gmail.com'),
(12, '', '', '', '', '', '', ''),
(13, '', '', '', '', '', '', ''),
(14, '', '', '', '', '', '', ''),
(15, 'Christopher', '437-344-1990', '26 Deborah Drive', 'Toronto', 'ON', 'Canada', 'lopezc004@gmail.com'),
(16, '', '', '', '', '', '', ''),
(17, '', '', '', '', '', '', ''),
(18, '', '', '', '', '', '', ''),
(19, '', '', '', '', '', '', ''),
(20, '', '', '', '', '', '', ''),
(21, '', '', '', '', '', '', ''),
(22, 'chris', '111-111-1111', 'chris', 'chris', 'chris', 'chris', 'chris'),
(23, '', '', '', '', '', '', ''),
(24, '', '', '', '', '', '', ''),
(25, '', '', '', '', '', '', ''),
(26, 'test', '111-111-1111', 'test', 'test', 'test', 'test', 'test'),
(27, 'test', '111-111-1111', 'test', 'test', 'test', 'test', 'test'),
(28, 'test', '111-111-1111', 'test', 'test', 'test', 'te4st', 'test'),
(29, 'test ', '111-111-1111', 'test', 'test', 'test', 'test', 'test'),
(30, 'test ', '111-111-1111', 'test', 'test', 'test', 'test', 'test'),
(31, 'jithinpsk@gmail.com', '111-111-1111', 'test', 't', 't', 't', 't'),
(32, 'test', '111-111-1111', 'test', 'testq', 'test', 'test', 'test'),
(33, 'test', '111-111-1111', 'test', 'test', 'tset', 'test', 'test'),
(34, 'test', '111-111-1111', 'test', 't', 't', 't', 't'),
(35, 'rawrawraw', '111-111-1111', 'rawraw', 'e', 'qe', 'e', 'e'),
(36, 'asda', '111-111-1111', 'asdasd', '12', 'qwe', 'qweqw', 'eqwe'),
(37, 'sdsa', '111-111-1111', 'adsa', 'ewqq', 'qweqwe', 'qweqwe', 'qweqwe'),
(38, 'asdasd', '111-111-1111', 'asdasda', 'we', '2323', 'wrwq', 'wrrw'),
(39, 'asdasd', '111-111-1111', 'asdasda', 'we', '2323', 'wrwq', 'wrrw'),
(40, 'asdasd', '111-111-1111', 'asdasda', 'we', '2323', 'wrwq', 'wrrw'),
(41, 'asdasd', '111-111-1111', 'asdasda', 'we', '2323', 'wrwq', 'wrrw'),
(42, 'asdasd', '111-111-1111', 'asdasda', 'we', '2323', 'wrwq', 'wrrw'),
(43, 'asdasd', '111-111-1111', 'asdasda', 'we', '2323', 'wrwq', 'wrrw'),
(44, 'asdasd', '111-111-1111', 'asdasda', 'we', '2323', 'wrwq', 'wrrw'),
(45, 'asdasd', '111-111-1111', 'asdasda', 'we', '2323', 'wrwq', 'wrrw'),
(46, 'asdasd', '111-111-1111', 'asdasda', 'we', '2323', 'wrwq', 'wrrw'),
(47, 'asdasd', '111-111-1111', 'asdasda', 'we', '2323', 'wrwq', 'wrrw'),
(48, 'asdasd', '111-111-1111', 'asdasda', 'we', '2323', 'wrwq', 'wrrw'),
(49, 'asdasd', '111-111-1111', 'asdasda', 'we', '2323', 'wrwq', 'wrrw'),
(50, 'asdasd', '111-111-1111', 'asdasda', 'we', '2323', 'wrwq', 'wrrw'),
(51, 'asdasd', '111-111-1111', 'asdasda', 'we', '2323', 'wrwq', 'wrrw'),
(52, 'asdasd', '111-111-1111', 'asdasda', 'we', '2323', 'wrwq', 'wrrw'),
(53, 'dasdsa', '111-111-1111', 'dsada', 'ewe', 'ewrwer', 'rwerw', 'rwerw'),
(54, 'asdasd', '111-111-1111', 'asdasd', '1', '12', '121', '212'),
(55, 'Brian', '455-222-2222', 'Seneca', 'Torontno', 'Ontario', 'Canada', 'brian@pying.ca'),
(56, 'asfasf', '111-111-1111', 'asfafsaf', 'dsfsdf', 'sdfsdf', 'sdfsdfsd', 'sdfsdfsdfsf'),
(57, 'dolphin', '416-456-7890', '123 Sea Avenue', 'Hamilton', 'BC', 'Antigua', 'oarsenieva@myseneca.ca'),
(58, 'dasd', '111-111-1111', 'asdasd', 'sadas', 'dasdasd', 'asdasdas', 'dasdasd'),
(59, 'dasd', '111-111-1111', 'asdasd', 'sadas', 'dasdasd', 'asdasdas', 'dasdasd'),
(60, 'dasd', '111-111-1111', 'asdasd', 'sadas', 'dasdasd', 'asdasdas', 'dasdasd'),
(61, 'dasd', '111-111-1111', 'asdasd', 'sadas', 'dasdasd', 'asdasdas', 'dasdasd'),
(62, 'dasd', '111-111-1111', 'asdasd', 'sadas', 'dasdasd', 'asdasdas', 'dasdasd'),
(63, 'dasd', '111-111-1111', 'asdasd', 'sadas', 'dasdasd', 'asdasdas', 'dasdasd'),
(64, 'dasd', '111-111-1111', 'asdasd', 'sadas', 'dasdasd', 'asdasdas', 'dasdasd'),
(65, 'dasd', '111-111-1111', 'asdasd', 'sadas', 'dasdasd', 'asdasdas', 'dasdasd'),
(66, 'dsad', '111-111-1111', 'asdasd', 'Toronto', 'ON', 'Canada', 'lopezc004@gmail.com'),
(67, 'dsad', '111-111-1111', 'asdasd', 'Toronto', 'ON', 'Canada', 'lopezc004@gmail.com'),
(68, 'dsad', '111-111-1111', 'asdasd', 'Toronto', 'ON', 'Canada', 'lopezc004@gmail.com'),
(69, 'dsad', '111-111-1111', 'asdasd', 'Toronto', 'ON', 'Canada', 'lopezc004@gmail.com'),
(70, 'asda', '111-111-1111', 'asdasd', 'dasdasd', 'sadasdasd', 'asdasdasasd', 'asda'),
(71, 'asda', '111-111-1111', 'asdasd', 'dasdasd', 'sadasdasd', 'asdasdasasd', 'asda'),
(72, 'asda', '111-111-1111', 'asdasd', 'dasdasd', 'sadasdasd', 'asdasdasasd', 'asda'),
(73, 'asdasdasd', '000-000-0000', 'asdasdasd', 'asdasd', 'asdasd', 'SUN', 'qweqwe'),
(74, '123', '123-123-1234', '123', '123', '123', '123', '123'),
(75, 'sadasd', '111-111-1111', 'asdasd', 'asdas', 'dasdas', 'dasdasd', 'asdasd'),
(76, 'sadasd', '111-111-1111', 'asdasd', 'sdad', 'sdasd', 'asdasdasasdasd', 'asdasd'),
(77, 'sadasd', '111-111-1111', 'dsa', 'sadasdasd', 'asdasdasd', 'asdasdasasd', 'dsa'),
(78, 'asd', '111-111-1111', 'dasd', 'asdas', 'asdasdasd', 'asdasdas', 'asdasd'),
(79, 'asdasd', '111-111-1111', 'asdasda', 'asdas', 'asdasdasd', 'asdasdas', 'asdas'),
(80, 'Christopher', '437-344-1990', '26 Deborah Drive', 'Toronto', 'ON', 'Canada', 'lopezc004@gmail.com'),
(81, 'Christopher', '437-344-1990', '26 Deborah Drive', 'Toronto', 'ON', 'Canada', 'lopezc004@gmail.com'),
(82, 'Christopher', '437-344-1990', '26 Deborah Drive', 'Toronto', 'ON', 'Canada', 'lopezc004@gmail.com'),
(83, 'Christopher', '437-344-1990', '26 Deborah Drive', 'Toronto', 'ON', 'Canada', 'lopezc004@gmail.com'),
(84, 'Christopher', '437-344-1990', '26 Deborah Drive', 'Toronto', 'ON', 'Canada', 'lopezc004@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `good`
--

CREATE TABLE `good` (
  `good_id` bigint(20) UNSIGNED NOT NULL,
  `good_name` varchar(100) NOT NULL,
  `good_image` varchar(256) DEFAULT '/data/default/good.png',
  `good_description` varchar(300) DEFAULT NULL,
  `good_price` decimal(8,2) NOT NULL,
  `good_in_stock` int(6) UNSIGNED NOT NULL DEFAULT '0',
  `good_weight` double(6,2) UNSIGNED NOT NULL,
  `good_taxable` tinyint(1) NOT NULL DEFAULT '1',
  `good_visible` tinyint(1) NOT NULL DEFAULT '1',
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `sale_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `good`
--

INSERT INTO `good` (`good_id`, `good_name`, `good_image`, `good_description`, `good_price`, `good_in_stock`, `good_weight`, `good_taxable`, `good_visible`, `category_id`, `sale_id`) VALUES
(453, 'pike fish', 'fish.png', 'long fish', 3.33, 20, 3.33, 1, 1, 186, 1),
(454, 'cod fish', 'fish1.png', 'food', 4.44, 20, 4.44, 1, 1, 186, 1),
(455, 'salmon fish', 'fish2.png', 'travelling fish', 5.55, 20, 5.55, 1, 1, 186, 1),
(456, 'trout fish', 'fish3.png', 'lake fish', 6.55, 20, 6.55, 1, 1, 186, 18),
(457, 'sail fish', 'fish5.png', 'gone with the wind', 7.77, 0, 7.77, 1, 0, 185, 21),
(458, 'sword fish', 'fish4.png', 'armed fish', 8.88, 20, 8.88, 1, 1, 185, 21),
(461, 'Pine tree', 'pinetree.png', 'pine tree for background', 2.50, 300, 0.70, 0, 1, 199, 29),
(462, 'Steam engine', 'steamtrain.PNG', 'steam powered, pulls trains!', 500.99, 1200, 5500.78, 0, 1, 202, 33),
(463, 'Standard Tracks', 'tracks2.PNG', 'tracks for trains to move on', 1.50, 3000, 50.00, 0, 1, 198, 29),
(464, 'Tank car', 'tankcar.PNG', 'car for transporting liquids', 6.78, 300, 50.99, 0, 1, 203, 32),
(466, 'Narrow tracks', 'tracks3.PNG', 'narrow tracks', 3.50, 400, 2.70, 0, 1, 198, NULL),
(467, 'Gondola car', 'gondola.PNG', 'car for carrying coal and sand', 3.50, 400, 2.70, 0, 0, 203, 32),
(471, 'BOXCAR', 'boxcar.PNG', 'transport coal and gravel', 5.99, 200, 5.00, 0, 1, 203, 32),
(477, 'Sony 65&quot; Class LED - 2160P', '140264_l.jpg', 'Smart - 4K Ultra HD TV With High Dynamic Range - Black', 3498.99, 20, 19.99, 1, 1, 195, 31),
(478, 'Aero 14WV7', '139470_1.jpg', '14in qHD 3K IPS I7-7700HQ GTX 1060 DDR4 16GB M2 512GB Win10 Gaming Laptop', 2098.99, 11, 12.00, 1, 1, 194, 30),
(480, 'Feta Wrap', 'aasaadfa.JPG', 'Free Egg White', 1.99, 11111, 2.99, 1, 1, 191, NULL),
(484, 'Sylvania SLED5550-UHD 55&quot; 4K Ultra HD LED Television', 'Sylvania SLED5550-UHD 55.jpg', '55&quot; 4K Ultra HD LED TV\r\nConnections: OPTICAL OUT, YPBPR, AV AUDIO/VIDEO, HDMI, RF\r\n16:9 Aspect Ratio\r\nSlim Design Cabinet\r\nIncludes Full Function Remote Control', 599.99, 13, 41.89, 1, 1, 205, NULL),
(485, 'LG 55UJ6300 55&quot; 4K UHD Smart LED Television (2017)', 'LG 55UJ6300 55.jpg', 'The amazing resolution: with 4k ultra HD, LG offers you the latest in TV resolution technology with 4 times the resolution of full hd. Enjoy your favourite movies and shows in 4k glory', 991.99, 4, 41.89, 1, 1, 205, NULL),
(486, 'Sony XBR55X900E 55-Inch 4K HDR Ultra HD TV (2017 Model)', 'Sony XBR55X900E 55.jpg', '4K X-Reality PRO and Dual Database Processing provides lifelike detail and clarity Precision Full-array dimming and boosting backlight', 1898.00, 2, 57.32, 1, 1, 205, NULL),
(487, 'RCA RTU6549 65&quot; 4K Ultra HD LED Television', 'RCA RTU6549 65.jpg', '65&quot; 4K Ultra HD LED TV\r\nConnections: HDMI, VGA, RF, YPBPR, AV AUDIO/VIDEO, PC AUDIO, HEADPHONE, COAXIAL\r\n16:9 Aspect Ratio\r\nSlim Design Cabinet\r\nIncludes Full Function Remote Control', 949.99, 20, 22.04, 1, 1, 205, NULL),
(488, 'Sylvania SLED5016A 50-Inch 1080p LED HDTV', 'Sylvania SLED5016A 50.jpg', '50-Inch LED HDTV\r\nConnections: HDMI x 3, VGA, YPbPR, AV Audio/Video, PC Audio, Headphone, Coaxial, RF\r\nDigital Capabilities: 480i, 480p, 576i, 576p, 720p, 1080i, 1080p\r\nResolution: 1920 x 1080, 1080P Full HD\r\nIncludes full function remote', 465.62, 3, 26.45, 1, 1, 205, NULL),
(489, 'VIZIO D55-E0 55&quot; 4K Ultra HD Smart Led Television (2017', 'VIZIO D55-E0 55.jpg', '4K Ultra HD Picture: Every scene in breathtaking detail and clarity with over 8 million pixels and 4x the resolution of 1080p Full HD', 748.00, 15, 41.89, 1, 1, 205, NULL),
(490, 'CYBERPOWERPC Gamer Ultra GUA3122ACA', 'CYBERPOWERPC Gamer Ultra GUA3122ACA.jpg', 'System: AMD FX-4300 3.8GHz Quad-Core | AMD 760 chipset | 8GB DDR3 | 1TB HDD | Genuine Windows 10 home 64-bit', 679.00, 1, 28.66, 0, 0, 206, NULL),
(491, 'Acer Predator G3-710-AM11 Gaming PC', 'Acer Predator G3-710-AM11 Gaming PC.jpg', 'Gaming PC Ci5-7400 8GB SDRAM, 1TB HD Windows 10 Home Bilingual', 999.99, 20, 19.84, 1, 1, 206, NULL),
(492, 'HP 8300 Elite Small Form Factor Desktop Computer', 'HP 8300 Elite Small Form Factor Desktop Computer.jpg', '(Intel Core i5-3470 3.2GHz Quad-Core, 8GB RAM, 500GB SATA, USB WIFI, Windows 10 Pro 64-Bit) (Prepared by Skytech)(Certified Refurbished)', 294.99, 1, 19.84, 1, 1, 206, NULL),
(493, 'CYBERPOWERPC Gamer Xtreme GXi10202ACA Desktop Gaming PC', 'CYBERPOWERPC Gamer Xtreme GXi10202ACA Desktop Gaming PC.jpg', 'Gaming PC (Intel i7-7700 3.6GHz, NVIDIA GTX 1060 6GB, 16GB DDR4 RAM, 1TB 7200RPM HDD, 128GB NVMe SSD, Win 10 Home), White', 1643.69, 11, 35.27, 1, 1, 206, NULL),
(494, 'CYBERPOWERPC Gamer Xtreme VR GXiVR8060A2 Desktop Gaming PC', 'CYBERPOWERPC Gamer Xtreme VR GXiVR8060A2 Desktop Gaming PC.jpg', '(Intel i5-7400 3.0GHz, NVIDIA GTX 1060 3GB, 8GB DDR4 RAM, 1TB 7200RPM SATA III HDD, 128GB NVMe M.2 SSD, Win 10 Home), Black', 1199.99, 23, 33.67, 1, 1, 206, NULL),
(495, 'CyberpowerPC Gamer Ultra GUA880 Gaming Desktop', 'CyberpowerPC Gamer Ultra GUA880 Gaming Desktop.jpg', 'AMD FX-4300 Quad Core 3.8GHz, 8GB DDR3 RAM, 1TB HDD, 24X DVD, NVIDIA GT 720 1GB, Windows 10', 649.99, 8, 28.66, 1, 1, 206, NULL),
(496, 'Brother DCP-L2540DW Wireless Monochrome Compact', 'Brother DCP-L2540DW Wireless Monochrome Compact.jpg', 'Wireless Monochrome Compact Laser 3-in-1 Printer with Wireless Networking and Duplex Printing', 132.99, 15, 30.86, 1, 1, 207, NULL),
(497, 'Brother HL-L2360DW Wireless Monochrome Laser Printer', 'Brother HL-L2360DW Wireless Monochrome Laser Printer.jpg', 'Fast black printing - up to 32ppm\r\nAutomatic two-sided printing\r\nProvides built-in wireless 802.11b/g/n, Ethernet interfaces and Wi Fi Direct\r\n250-sheet capacity paper tray that handles letter or legal size paper', 139.99, 29, 26.46, 1, 1, 207, NULL),
(498, 'HP Sprocket Portable Photo Printer', 'HP Sprocket Portable Photo Printer.jpg', 'Live it, love it, print it: printing off social media photos has never been easier from your smartphone\r\nA social on-the-go portable printer: sprocket uses seamless Bluetooth connectivity', 159.99, 11, 0.44, 1, 1, 207, NULL),
(499, 'Canon PIXMA MX492 Inkjet Printer', 'Canon PIXMA MX492 Inkjet Printer.jpg', 'The space-saving small printer fits about anywhere in your home, office or dorm.\r\nAir Print: Print wirelessly and effortlessly from your compatible iPhone, iPad or iPod touch-no drivers needed!', 39.99, 29, 15.43, 1, 1, 207, NULL),
(500, 'HP OfficeJet Pro 8720 Wireless All-in-One Photo Printer', 'HP OfficeJet Pro 8720 Wireless All-in-One Photo Printer.jpg', 'Main functions of this all-in-one color inkjet printer: copy, scan, fax, Wireless printing, Two-sided duplex printing, and more\r\nMobile printing: Print from anywhere using your smartphone or tablet with the free HP ePrint app', 329.99, 13, 24.25, 1, 1, 207, NULL),
(501, 'Samsung Galaxy Tab A 8&quot;', 'Samsung Galaxy Tab A 8.jpg', 'Android 5.0 Lollipop, 8-inch Display\r\nSamsung Quad Core Processor, 1.2 GHz\r\n16 GB Flash Memory, 1.5 GB RAM Memory\r\nmicroSD Card Slot (Up to 128GB)\r\nSupports WIFI only (Does not support 3g, LTE)', 239.99, 8, 1.10, 1, 1, 208, 34),
(502, 'ASUS ZENPAD Z170C-A1-BK 7&quot;', 'ASUS ZENPAD Z170C-A1-BK 7.jpg', '7&quot; IPS Display (1024 x 600) with ASUS TruVivid technology for better visual experience\r\nIntel Atom x3-C3200 Quad-Core, 64bit, 1.2GHz\r\n1G RAM, 16G Onboard Storage, Bluetooth 4.0\r\n2M/0.3M Dual Camera; 1 x microSD Card slot, support up to 64GB SDHC', 129.00, 22, 0.86, 1, 1, 208, 34),
(503, 'Apple iPad mini 4', 'Apple iPad mini 4.jpg', '7.9&quot; Retina Display, 2048 x 1536 Resolution\r\nApple iOS 9, Dual-Core A8 Chip with Quad-Core Graphics\r\n8 MP iSight Camera, 1080p HD Video Recording\r\n128GB Capacity, Wi-Fi (802.11a/b/g/n/ac) + MIMO + Bluetooth 4.2\r\nUp to 10 Hours of Battery Life, 0.65 lbs', 497.90, 6, 1.30, 1, 1, 208, 34),
(504, 'Samsung Galaxy Tab 7&quot; E Lite', 'Samsung Galaxy Tab 7 E Lite.jpg', 'Tablet - Android - 8 GB - 7&quot; TFT (1024 x 600) - microSD slot - cream white', 139.00, 4, 0.93, 1, 1, 208, 34),
(505, 'Samsung Galaxy Tab A 7&quot;', 'Samsung Galaxy Tab A 7.jpg', 'Comfortable to the touch and light in your hands, the Tab A 7.0&quot; is easy to take anywhere.\r\nEnjoy more of your favorite music, photos, movies and games on the go with a microSD card1 that expands your tabletâ€™s memory from 8GB2 to up to an additional 200GB', 179.95, 6, 1.10, 1, 1, 208, 34),
(506, 'NeuTab K1 10.1 Inch Quad Core', 'NeuTab K1 10.1 Inch Quad Core.jpg', 'Comfortable to the touch and light in your hands, the Tab A 7.0&quot; is easy to take anywhere.\r\nEnjoy more of your favorite music, photos, movies and games on the go with a microSD card1 that expands your tabletâ€™s memory from 8GB2 to up to an additional 200GB', 119.99, 12, 0.86, 1, 1, 208, 34),
(507, 'Apple iPad mini 4 Silver', 'Apple iPad mini 4 sil.jpg', '7.9&quot; Retina Display, 2048 x 1536 Resolution\r\nApple iOS 9, Dual-Core A8 Chip with Quad-Core Graphics\r\n8 MP iSight Camera, 1080p HD Video Recording\r\n128GB Capacity, Wi-Fi (802.11a/â€‹b/â€‹g/â€‹n/â€‹ac) + MIMO + Bluetooth 4.2\r\nUp to 10 Hours of Battery Life, 0.65 lbs', 497.94, 3, 1.30, 1, 1, 208, 34);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `invoice_payment_option` varchar(20) DEFAULT NULL,
  `invoice_total_quantity` int(6) UNSIGNED NOT NULL,
  `invoice_price` decimal(8,2) UNSIGNED NOT NULL,
  `invoice_final_price` decimal(8,2) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `customer_id`, `invoice_payment_option`, `invoice_total_quantity`, `invoice_price`, `invoice_final_price`, `status`) VALUES
(3, 1, 'Visa', 2, 10101.00, 10101.00, 0),
(5, 3, 'Visa', 5, 1010.11, 1010.11, 0),
(6, 1, NULL, 213, 213.00, 12321.00, 1),
(20, 1, NULL, 3, 104.97, 118.62, 0),
(21, 1, NULL, 1, 4999.99, 5649.99, 0),
(22, 1, NULL, 1, 49.99, 56.49, 0),
(23, 1, NULL, 1, 4999.99, 5649.99, 0),
(24, 1, NULL, 1, 4999.99, 5649.99, 0),
(25, 1, NULL, 1, 4999.99, 5649.99, 0),
(26, 1, NULL, 1, 4999.99, 5649.99, 0),
(27, 1, NULL, 1, 4999.99, 5649.99, 0),
(28, 3, NULL, 1, 4999.99, 5649.99, 0),
(29, 3, NULL, 2, 99.98, 112.98, 0),
(30, 3, NULL, 3, 14.97, 16.92, 0),
(31, 3, NULL, 1, 49.99, 56.49, 0),
(32, 3, NULL, 1, 4999.99, 5649.99, 0),
(33, 3, NULL, 1, 4999.99, 5649.99, 0),
(34, 3, NULL, 79, 2.37, 2.68, 0),
(35, 3, NULL, 1, 0.14, 0.16, 0),
(36, 3, NULL, 4, 11.20, 12.66, 0),
(37, 3, NULL, 5, 150.01, 169.51, 0),
(38, 3, NULL, 1, 49.99, 56.49, 0),
(39, 3, NULL, 1, 49.99, 56.49, 0),
(40, 3, NULL, 1, 4999.00, 5648.87, 0),
(41, 3, NULL, 1, 4999.00, 5648.87, 0),
(42, 3, NULL, 1, 4999.00, 5648.87, 0),
(43, 3, NULL, 1, 4999.00, 5648.87, 0),
(44, 3, NULL, 1, 4999.00, 5648.87, 0),
(45, 3, NULL, 1, 4999.00, 5648.87, 0),
(46, 3, NULL, 1, 4999.00, 5648.87, 0),
(47, 3, NULL, 1, 4999.00, 5648.87, 0),
(48, 3, NULL, 2, 9998.00, 11297.74, 0),
(49, 3, NULL, 4, 199.96, 225.95, 0),
(50, 3, NULL, 2, 99.98, 112.98, 0),
(51, 3, NULL, 2, 99.98, 112.98, 0),
(52, 3, NULL, 1, 49.99, 56.49, 0),
(53, 4, NULL, 1, 49.99, 56.49, 0),
(54, 4, NULL, 1, 49.99, 56.49, 0),
(55, 4, NULL, 1, 49.99, 56.49, 0),
(56, 4, NULL, 11, 549.89, 621.38, 0),
(57, 4, NULL, 101, 5048.99, 5705.36, 0),
(58, 4, NULL, 4, 5071.03, 5730.26, 0),
(59, 4, NULL, 5, 50.00, 56.50, 0),
(60, 4, NULL, 2, 22.04, 24.91, 0),
(61, 4, NULL, 4, 20.26, 22.89, 0),
(62, 4, NULL, 4, 517.05, 584.27, 0),
(63, 4, NULL, 1, 2098.99, 2371.86, 0),
(64, 4, NULL, 21, 93.24, 105.36, 0),
(65, 4, NULL, 2, 5597.98, 6325.72, 0),
(66, 4, NULL, 1, 1.99, 2.25, 0),
(67, 4, NULL, 1, 2098.99, 2371.86, 0),
(68, 4, NULL, 2, 5597.98, 6325.72, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_line`
--

CREATE TABLE `order_line` (
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `order_line_id` bigint(20) UNSIGNED NOT NULL,
  `good_id` bigint(20) UNSIGNED NOT NULL,
  `good_quantity` int(4) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_line`
--

INSERT INTO `order_line` (`invoice_id`, `order_line_id`, `good_id`, `good_quantity`) VALUES
(61, 57, 458, 1),
(61, 58, 454, 2),
(61, 59, 461, 1),
(62, 60, 462, 1),
(62, 61, 461, 1),
(62, 62, 464, 2),
(63, 63, 478, 1),
(64, 64, 454, 21),
(65, 65, 477, 1),
(65, 66, 478, 1),
(66, 67, 480, 1),
(67, 68, 478, 1),
(68, 69, 477, 1),
(68, 70, 478, 1);

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `id` int(11) NOT NULL,
  `page_name` varchar(100) NOT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `page_name`, `client_id`) VALUES
(9, 'Careers', 60),
(11, 'Openning hours', 57),
(12, 'Map', 57),
(18, 'Railway History page', 75);

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `sale_id` bigint(20) UNSIGNED NOT NULL,
  `sale_name` varchar(30) NOT NULL,
  `sale_description` varchar(150) DEFAULT NULL,
  `discount` decimal(4,2) UNSIGNED NOT NULL,
  `end_date` datetime DEFAULT NULL,
  `start_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`sale_id`, `sale_name`, `sale_description`, `discount`, `end_date`, `start_date`) VALUES
(1, 'Cheesy Promo 50% ', 'Cheesy Promo 50% off by tomorrow!! Get your cows now! New Cows in stock! Get it while they last! Also, chickens coming for Canada Day!!', 50.00, '2017-06-30 00:00:00', '2017-06-09 16:09:42'),
(18, 'sdfsdf', 'sdfsdf', 85.00, '2017-08-21 00:00:00', '2017-07-21 00:00:00'),
(21, 'Demo Sale', 'Demo Sale', 10.00, '2017-07-08 00:00:00', '2017-07-06 00:00:00'),
(29, 'JULY BLOWOUT SALE', 'sale test', 50.00, '2017-08-05 00:00:00', '2017-08-01 00:00:00'),
(30, 'sales', 'desc', 50.00, '2017-09-20 00:00:00', '2017-09-01 00:00:00'),
(31, 'good sale', 'desc', 10.00, '2017-08-04 00:00:00', '2017-08-02 00:00:00'),
(32, 'Cheesy sale', 'This sale celebrates the cheese industry', 30.00, '2017-08-11 00:00:00', '2017-08-07 00:00:00'),
(33, 'August blow out', 'Enjoy great savings, for a limited time', 6.02, '2017-08-12 00:00:00', '2017-08-05 00:00:00'),
(34, 'Back To School Sale', '50% off to all tables in our online store.', 50.00, '2017-09-24 00:00:00', '2017-08-06 00:00:00');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_category_good`
-- (See below for the actual view)
--
CREATE TABLE `v_category_good` (
`good_id` bigint(20) unsigned
,`good_name` varchar(100)
,`good_image` varchar(256)
,`good_description` varchar(300)
,`good_price` decimal(8,2)
,`good_in_stock` int(6) unsigned
,`good_weight` double(6,2) unsigned
,`good_taxable` tinyint(1)
,`good_visible` tinyint(1)
,`sale_id` bigint(20) unsigned
,`category_name` varchar(30)
,`category_description` varchar(300)
,`category_display` tinyint(1)
,`client_id` bigint(20) unsigned
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_orderLine_invoice_customer`
-- (See below for the actual view)
--
CREATE TABLE `v_orderLine_invoice_customer` (
`client_id` bigint(20) unsigned
,`invoice_id` bigint(20) unsigned
,`customer_id` bigint(20) unsigned
,`invoice_payment_option` varchar(20)
,`status` tinyint(1)
,`good_quantity` int(4) unsigned
,`customer_name` varchar(100)
,`customer_number` varchar(14)
,`customer_street_address` varchar(300)
,`customer_city` varchar(100)
,`customer_state` varchar(100)
,`customer_country` varchar(100)
,`customer_email` varchar(150)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_sale_good_category`
-- (See below for the actual view)
--
CREATE TABLE `v_sale_good_category` (
`sale_id` bigint(20) unsigned
,`good_id` bigint(20) unsigned
,`client_id` bigint(20) unsigned
,`sale_name` varchar(30)
,`good_image` varchar(256)
,`good_price` decimal(8,2)
,`sale_description` varchar(150)
,`discount` decimal(4,2) unsigned
,`start_date` datetime
,`end_date` datetime
);

-- --------------------------------------------------------

--
-- Structure for view `v_category_good`
--
DROP TABLE IF EXISTS `v_category_good`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_category_good`  AS  select `g`.`good_id` AS `good_id`,`g`.`good_name` AS `good_name`,`g`.`good_image` AS `good_image`,`g`.`good_description` AS `good_description`,`g`.`good_price` AS `good_price`,`g`.`good_in_stock` AS `good_in_stock`,`g`.`good_weight` AS `good_weight`,`g`.`good_taxable` AS `good_taxable`,`g`.`good_visible` AS `good_visible`,`g`.`sale_id` AS `sale_id`,`c`.`category_name` AS `category_name`,`c`.`category_description` AS `category_description`,`c`.`category_display` AS `category_display`,`c`.`client_id` AS `client_id` from (`good` `g` join `category` `c` on((`g`.`category_id` = `c`.`category_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `v_orderLine_invoice_customer`
--
DROP TABLE IF EXISTS `v_orderLine_invoice_customer`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_orderLine_invoice_customer`  AS  select `category`.`client_id` AS `client_id`,`invoice`.`invoice_id` AS `invoice_id`,`customer`.`customer_id` AS `customer_id`,`invoice`.`invoice_payment_option` AS `invoice_payment_option`,`invoice`.`status` AS `status`,`order_line`.`good_quantity` AS `good_quantity`,`customer`.`customer_name` AS `customer_name`,`customer`.`customer_number` AS `customer_number`,`customer`.`customer_street_address` AS `customer_street_address`,`customer`.`customer_city` AS `customer_city`,`customer`.`customer_state` AS `customer_state`,`customer`.`customer_country` AS `customer_country`,`customer`.`customer_email` AS `customer_email` from ((((`order_line` join `invoice`) join `customer`) join `good`) join `category`) where ((`order_line`.`invoice_id` = `invoice`.`invoice_id`) and (`invoice`.`customer_id` = `customer`.`customer_id`) and (`order_line`.`good_id` = `good`.`good_id`) and (`good`.`category_id` = `category`.`category_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_sale_good_category`
--
DROP TABLE IF EXISTS `v_sale_good_category`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_sale_good_category`  AS  select `sale`.`sale_id` AS `sale_id`,`good`.`good_id` AS `good_id`,`category`.`client_id` AS `client_id`,`sale`.`sale_name` AS `sale_name`,`good`.`good_image` AS `good_image`,`good`.`good_price` AS `good_price`,`sale`.`sale_description` AS `sale_description`,`sale`.`discount` AS `discount`,`sale`.`start_date` AS `start_date`,`sale`.`end_date` AS `end_date` from ((`category` join `good`) join `sale`) where ((`good`.`category_id` = `category`.`category_id`) and (`sale`.`sale_id` = `good`.`sale_id`) and (`category`.`category_display` = 1)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `UNIQUE_USERNAME` (`admin_username`),
  ADD UNIQUE KEY `UNIQUE_EMAIL` (`admin_email`);

--
-- Indexes for table `admin_session`
--
ALTER TABLE `admin_session`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_id` (`category_id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_id`),
  ADD UNIQUE KEY `client_site_title` (`client_site_title`);

--
-- Indexes for table `client_session`
--
ALTER TABLE `client_session`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `good`
--
ALTER TABLE `good`
  ADD PRIMARY KEY (`good_id`),
  ADD UNIQUE KEY `const_good_name` (`good_name`),
  ADD KEY `fk_good_sale_id` (`sale_id`),
  ADD KEY `fk_good_ category_id` (`category_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `fk_invoice_customer_id` (`customer_id`);

--
-- Indexes for table `order_line`
--
ALTER TABLE `order_line`
  ADD PRIMARY KEY (`order_line_id`),
  ADD KEY `fk_order_line_inovice_id` (`invoice_id`),
  ADD KEY `fk_order_line_good_id` (`good_id`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`sale_id`),
  ADD UNIQUE KEY `sale_name` (`sale_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `admin_session`
--
ALTER TABLE `admin_session`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;
--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `client_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
--
-- AUTO_INCREMENT for table `client_session`
--
ALTER TABLE `client_session`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
--
-- AUTO_INCREMENT for table `good`
--
ALTER TABLE `good`
  MODIFY `good_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=508;
--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `order_line`
--
ALTER TABLE `order_line`
  MODIFY `order_line_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `sale_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `good`
--
ALTER TABLE `good`
  ADD CONSTRAINT `fk_good_ category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_good_sale_id` FOREIGN KEY (`sale_id`) REFERENCES `sale` (`sale_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `fk_invoice_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_line`
--
ALTER TABLE `order_line`
  ADD CONSTRAINT `fk_order_line_good_id` FOREIGN KEY (`good_id`) REFERENCES `good` (`good_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_order_line_inovice_id` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`invoice_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
