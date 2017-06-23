-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 23, 2017 at 11:05 PM
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
(1, 'Broomsticks', 'Means of travel', 1, 1),
(2, 'Books', 'Weapons', 1, 1),
(3, 'Evil wands', 'These are the wands for bad guys', 1, 2),
(4, 'Good wands', 'These are the wands for good guys', 1, 2),
(5, 'Fishes', 'These are my fishes', 1, 5),
(6, 'Cows', 'These are my cows', 1, 5),
(8, 'testing name after editing', 'tesing description after editing', 1, 1),
(12, 'testing name after editing', 'tesing description after editing', 1, 1),
(134, 'CLock', 'Many clocks', 1, 29),
(135, 'testing name', 'tesing description', 1, 3),
(136, 'testing name', 'tesing description', 1, 3),
(137, 'testing name', 'tesing description', 1, 3),
(138, 'testing name', 'tesing description', 1, 3),
(139, 'testing name', 'tesing description', 1, 3),
(140, 'testing name', 'tesing description', 1, 3),
(141, 'testing name', 'tesing description', 1, 3),
(142, 'testing name', 'tesing description', 1, 3),
(143, 'testing name', 'tesing description', 1, 3),
(144, 'testing name', 'tesing description', 1, 3),
(145, 'testing name', 'tesing description', 1, 3),
(146, 'testing name', 'tesing description', 1, 3),
(147, 'testing name', 'tesing description', 1, 3),
(148, 'testing name', 'tesing description', 1, 3),
(149, 'testing name', 'tesing description', 1, 3),
(150, 'testing name', 'tesing description', 1, 3),
(151, 'testing name', 'tesing description', 1, 3),
(152, 'testing name', 'tesing description', 1, 3),
(153, 'testing name', 'tesing description', 1, 3),
(154, 'testing name', 'tesing description', 1, 3),
(155, 'testing name', 'tesing description', 1, 3),
(156, 'testing name', 'tesing description', 1, 3),
(157, 'testing name', 'tesing description', 1, 3),
(158, 'testing name', 'tesing description', 1, 3);

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
  `recovery_hash` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_id`, `client_name`, `client_site_title`, `client_logo`, `client_information`, `client_tax`, `payment_option_paypal`, `payment_option_visa`, `payment_option_mastercard`, `payment_option_ae`, `username`, `password`, `salt`, `client_admin_email`, `recovery_hash`) VALUES
(1, 'Magical Item', 'Quidditch Supplies', '/data/default/logo.png', 'We sale magical items and broom sticks.', 50.00, 1, 1, 1, 1, '7up', 'Password123', '', 'admin@magicalitem.com', NULL),
(2, 'Olivander', 'Olivander\'s finest wands ', '/data/default/logo.png', 'I sale wands for witches and wizards', 13.00, 1, 1, 1, 1, 'wand', 'Password123', '', 'admin@olivander.com', NULL),
(5, 'Brian', 'Brian\'s Beautiful Site', '/data/default/logo.png', 'Its secret', 23.00, 0, 1, 1, 0, 'brian', 'Password123', '', 'admin@brian.com', NULL),
(21, 'Mark Anthony', 'tesing site', '', '', 0.00, 0, 0, 0, 0, 'mavillaflor', '4d9622dbfd993a14c668c984e5ae20b56843d9e1f99f2f946e51d37d3b528c6e', '’ê›IlcVY_Hõ¨|2ˆÀLÕ3ôx”©§î?K1Èœrù', 'Password123@testing.com', NULL),
(22, 'Christopher', 'Group 4 member', '', '', 0.00, 0, 0, 0, 0, 'testingclient', '7a3487f5adcc1ca6f3f47bb358dc5cd11befeb220246ed08ebc85c7ba351058d', 'tŠ”4rr„¬›ÛÑÈ…‘KÄ+»è²=(G¤É', 'admin@testng.com', NULL),
(23, 'Mark Testing', 'mark testing site', '', '', 0.00, 0, 0, 0, 0, 'marktesting', '0b3bc4a1cc1c473901616421ab3fa78ddbc02e492f3ee6867887c2fee7c5bda3', '¸ñ[´É˜G<£`c€<ˆY¸¥\0Íƒm÷LhKg', 'admin@asdasd.com', NULL),
(24, 'Mark Anthony Villaflor', 'Mark Anthony Villaflor', '', 'The ', 13.00, 0, 1, 1, 0, 'mavillaflor1', '4c742d0978af19997e28685e697f8f7aa2f0e2324b73ad9ea1e500c3f9ee2820', 'êñnà>U…>VÍ(Ë=HW&‘(W9oð—~ÕE', 'admin@myseneca.ca', NULL),
(25, 'Quang', 'Hello World', '', 'ass', 0.00, 0, 0, 0, 0, 'nhquang', '0e0ea1caef9c7d0db2b62ca93af827e1d1317b8ce3988e78c37a6690328780d2', 'Eˆ [þPYäÆ]6¬åK;', 'nhquang@myseneca.ca', NULL),
(26, 'mark', 'mark', '', '', 0.00, 0, 0, 0, 0, 'testing', 'a120af836f69e4a6d20ac323a9c4b1d350da659d87762d691dafd781d2591894', '§LÿÑ2-]K’‹ZûøO5Ù¹	8ÀPB£Ãˆ­=¹', 'nhquang@myseneca.ca', NULL),
(27, 'testing2', 'testing2', '', '', 0.00, 0, 0, 0, 0, 'testing2', '396d21583fdfe11f710269d88059df9514ce570e4a503a476fd41fe747202e04', 'Ö¯³–äÃfúQ`\\‡tcÿ\'!ÌÀ8¶n(ì€û5Ô', 'nhquang@myseneca.ca', NULL),
(28, 'Mark Anthony Villaflor', 'Mark Anthony Villaflor2', '', '', 0.00, 0, 0, 0, 0, 'Wecreu123', 'f57ae6707ac8bbc61ccce362d14ce420dc40474af1308f56f0c6f2af7a3c6e1a', '&yŒë	2ÙÌ¹Å¸\',3‚U™!>ðg×˜Â+Ïör×', 'wecreu123@yopmail.com', 'SjaWSyi42prpEBBSvkL5CGeJXKKIr8Ai37f9jcgy9nY95rueHKsj2H0jWUNDfKMeFd7WLiXTepRf47r4LJx2fHef2pJSTayyZe4Ao2H4XkUTCC0uXrZPoCyFw3aSYHyWBUb1iC8r80sLZ3thgKeEjDuhDR6dUYnEvCn1rZKZk4mk5eadskFk6ZWZFYHG0MzHZjV6aALYuPnGuFPszlLt1iGCKaXdVnadAql9fyRm4oh3g1IZWptNfOHRRd6L4p6'),
(29, 'Wecreu001', 'Wecreu001', '', 'Wecreu001', 0.00, 0, 0, 0, 0, 'Wecreu001', 'a9e93f8b849e71883ac2df991ba7a92942ce4d9dd9467102b8b51bc06dab5487', '9§¹Û^á\r¾/iÓ/ž‹­[6I+‡ ŽbŸõ(©', 'Wecreu001@asdasd.com', NULL),
(30, 'Wecreu911', 'Wecreu911', '', '', 0.00, 0, 0, 0, 0, 'Wecreu911', '60779a351eab4bddb752ca028a45831ad3de7c14fdd643eb4913987a8f72f7f7', 'a‰ÀqÈW6ë‡ˆÄT8jd†Y/\'-¢¯ªjÓ[\Z¿ú`', 'admin@wecreu.com', NULL);

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
  `customer_street_address` varchar(300) NOT NULL,
  `customer_city` varchar(100) NOT NULL,
  `customer_state` varchar(100) NOT NULL,
  `customer_country` varchar(100) NOT NULL,
  `customer_email` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `customer_street_address`, `customer_city`, `customer_state`, `customer_country`, `customer_email`) VALUES
(1, 'Mark Anthony', 'The pond road', 'Toronto', 'Ontario', 'Canada', 'mark@myseneca.ca'),
(2, 'Frodo Baggins', '23 Bag End Lane', 'Hobbiton', 'Shire', 'Middle Earth', 'Precious@bagend.com'),
(3, 'Brian Yang', '32 Kennedy', 'Toronto', 'Ontario', 'Canada', 'py@pying.ca');

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
(1, 'Nimbus 3000', '/data/default/good.png', 'goes 3000 km/h totally safe', 49.99, 700, 100.99, 1, 1, 1, NULL),
(2, 'OOP345', '/data/default/good.png', 'Heavy', 71000.01, 300, 2.78, 1, 1, 2, NULL),
(3, 'Elder Wand', '/data/default/good.png', 'The most powerful wand in the universe', 4999.99, 1, 0.01, 1, 1, 3, NULL),
(4, 'Younger Wand', '/data/default/good.png', 'This wand is crappy and weak wand', 4.99, 100, 1.00, 1, 1, 4, NULL),
(5, 'Gold Fish', '/data/default/good.png', 'Its gold', 599.99, 20, 1.60, 1, 1, 5, NULL),
(6, 'Gold Cow', '/data/default/good.png', 'Its gold', 699.99, 99, 500.00, 1, 1, 6, 1),
(7, 'test', 'image', 'description', 40.50, 100, 5.00, 1, 1, 4, 1),
(41, 'Ray', 'images/fish.png', 'A drop of golden sun', 40.50, 100, 5.00, 1, 1, 4, 1),
(55, 'Me', 'images/fish.png', 'A name i call myself', 40.50, 100, 5.00, 1, 1, 4, NULL),
(58, 'Far', 'images/fish.png', 'A long long way to run', 40.50, 100, 5.00, 1, 1, 4, NULL),
(85, 'testgood2', 'images/fish.png', 'test good table 2', 40.50, 100, 5.00, 1, 1, 134, NULL),
(136, 'testgood1', 'images/fish.png', 'test good table 1', 40.50, 100, 5.00, 1, 1, 4, NULL),
(225, 'Doe', 'a female deer', 'test good table 1', 40.50, 100, 5.00, 1, 1, 4, NULL),
(240, 'yodle', 'images/fish.png', 'the yodeling fish', 40.50, 100, 5.00, 1, 1, 134, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `invoice_payment_option` varchar(20) NOT NULL,
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
(4, 2, 'Visa', 2, 10101.01, 10101.01, 0),
(5, 3, 'Visa', 5, 1010.11, 1010.11, 0);

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
(3, 1, 3, 1),
(3, 2, 4, 1),
(4, 3, 1, 1),
(4, 4, 2, 3),
(5, 5, 6, 5),
(5, 6, 5, 10);

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
(1, 'Cheesy Promo 50% ', 'Cheesy Promo 50% off by tomorrow!! Get your cows now! New Cows in stock! Get it while they last! Also, chickens coming for Canada Day!', 50.00, '2017-06-30 00:00:00', '2017-06-09 16:09:42'),
(2, 'Testing', 'This is only a test', 20.00, NULL, NULL),
(3, 'Testing2', 'Testing2', 60.00, '2017-07-18 00:00:00', '2017-06-18 00:00:00'),
(4, 'Testing22', 'Testing22', 80.00, '2017-08-17 00:00:00', '2017-07-17 00:00:00'),
(5, 'Testing222', 'Testing222', 60.00, '2017-09-17 00:00:00', '2017-07-17 00:00:00'),
(6, 'Testing2222', 'Testing2222', 80.00, '2017-09-17 00:00:00', '2017-07-17 00:00:00'),
(7, 'Testing22222', 'Testing22222', 60.00, '2017-10-17 00:00:00', '2017-07-17 00:00:00'),
(8, 'Testing222223', 'Testing222223', 80.00, '2017-09-17 00:00:00', '2017-07-17 00:00:00'),
(9, 'Testing2222233', 'Testing2222233', 80.00, '2017-10-17 00:00:00', '2017-07-17 00:00:00'),
(10, 'Testing22222333', 'Testing22222333', 80.00, '2017-09-17 00:00:00', '2017-07-17 00:00:00'),
(11, 'Testing21', 'Testing21', 80.00, '2017-09-17 00:00:00', '2017-07-17 00:00:00'),
(12, 'Testing211', 'Testing211', 80.00, '2017-09-17 00:00:00', '2017-07-17 00:00:00'),
(13, 'Testing2111', 'Testing2111', 60.00, '2017-10-17 00:00:00', '2017-07-17 00:00:00'),
(14, 'Testing2222111', 'Testing2222111', 80.00, '2017-10-17 00:00:00', '2017-07-17 00:00:00'),
(15, 'Testing2123', 'Testing2123', 80.00, '2017-08-17 00:00:00', '2017-07-17 00:00:00');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`sale_id`),
  ADD UNIQUE KEY `sale_name` (`sale_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;
--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `client_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `client_session`
--
ALTER TABLE `client_session`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `good`
--
ALTER TABLE `good`
  MODIFY `good_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=259;
--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `order_line`
--
ALTER TABLE `order_line`
  MODIFY `order_line_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `sale_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
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
