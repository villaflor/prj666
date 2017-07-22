-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 22, 2017 at 10:10 PM
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
  `admin_id` bigint(20) NOT NULL,
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
(1, 'Broomsticks', 'Means of travel', 1, 2),
(2, 'Weapons', 'Means of defense', 1, 2),
(3, 'Evil wands', 'These are the wands for bad guys', 1, 2),
(4, 'Good wands', 'These are the wands for good guys', 1, 2),
(5, 'Fishes', 'These are my fishes', 1, 5),
(6, 'Cows', 'These are my cows', 1, 41),
(8, 'testing name after editing', 'tesing description after editing', 1, 12),
(12, 'testing name after editing', 'tesing description after editing', 1, 2),
(134, 'CLock', 'Many clocks', 1, 41),
(141, 'testing name', 'tesing description', 1, 3),
(142, 'testing name', 'tesing description', 1, 3),
(152, 'testing name', 'tesing description', 1, 3),
(153, 'testing name', 'tesing description', 1, 3),
(154, 'testing name', 'tesing description', 1, 3),
(155, 'testing name', 'tesing description', 1, 3),
(157, 'testing name', 'tesing description', 1, 3),
(158, 'testing name', 'tesing description', 1, 3),
(159, 'Potions', 'Magic!', 1, 2),
(160, 'Paper', 'Different kinds of paper', 1, 2),
(161, 'Books', 'different kinds of books', 1, 2),
(162, 'Coats', 'different kinds of coats', 1, 2),
(164, 'testing name', 'tesing description', 1, 3),
(165, '', '', 1, 3),
(166, '', 'test', 1, 3),
(167, '', '', 1, 3),
(168, 'ewewe', '', 1, 3),
(169, 'Cows', 'Cows', 1, 3),
(170, 'Fishes1212', 'asdasdasdasd', 1, 3),
(171, 'ertertert', 'ertertert', 1, 3),
(172, 'category_namewerwerwer', 'werwerwer', 1, 3),
(173, 'category_namewerwerwerwer', 'werwerwr', 1, 3),
(174, 'category_namedwdcdced', 'ecedc', 1, 3),
(175, 'category_namewerwerwerwerfgd', 'ewrtertert', 1, 3),
(176, 'ert', 'ewrtertert', 1, 3),
(177, 'qweqweqwe12312', 'qweqweqwe', 1, 3),
(178, 'category_namewrthbv', 'werfv', 1, 3),
(179, 'Desktops', 'These are all of our desktops', 1, 30),
(180, 'Computers', 'These are all of our computers', 0, 30),
(181, 'Laptops', 'There are all of our labtops', 1, 30),
(182, 'Mouse', 'There are all of our computer mouses', 1, 30),
(183, 'Keyboard', 'These are all the keyboards', 1, 30),
(184, 'Webcam', 'Webcams for your computer', 1, 30),
(185, 'Category 1', 'Category 1', 1, 1),
(186, 'Category 2', 'Category 2', 1, 1),
(187, 'Category 3', 'Category 3', 1, 1),
(188, ' Blonde Vanilla Latte', ' Blonde Vanilla Latte', 0, 57),
(189, 'Drinks', 'Drinks', 1, 57),
(190, 'Food', 'Food', 0, 57),
(191, 'Breakfast Sandwiches', 'Breakfast Sandwiches', 1, 57),
(192, 'Wholesome Grains', 'Wholesome Grains', 0, 57),
(193, 'Fruit and Yogurt', 'Fruit and Yogurt', 1, 57),
(194, 'Laptop', 'Laptop', 1, 60),
(195, 'TV', 'TV', 1, 60),
(196, 'Desktop', 'Desktop', 1, 60),
(197, 'Printer', 'Printer', 1, 60);

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
  `validate_email_expire` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_id`, `client_name`, `client_site_title`, `client_logo`, `client_information`, `client_tax`, `payment_option_paypal`, `payment_option_visa`, `payment_option_mastercard`, `payment_option_ae`, `username`, `password`, `salt`, `client_admin_email`, `recovery_hash`, `validated`, `validate_hash`, `reset_password_expire`, `validate_email_expire`) VALUES
(1, 'Template', 'Wecreu', '/data/default/wecreu/logo.png', 'We sale magical items and broom sticks.', 50.00, 1, 1, 1, 1, 'Wecreu', 'Password123', '', 'admin@magicalitem.com', NULL, 1, NULL, NULL, NULL),
(2, 'Olivander', 'Olivander\'s finest wands ', '/data/default/logo.png', 'I sale wands for witches and wizards', 13.00, 1, 1, 1, 1, 'wand', 'Password123', '', 'admin@olivander.com', NULL, 1, NULL, NULL, NULL),
(5, 'Brian', '', '/data/default/logo.png', 'Its secret', 23.00, 0, 1, 1, 0, 'wecreu', '41c8f3fd9abc63d10822504f0d45f569d91761a7868eff9431bc05e2c5a3d53e', 'vÎuy»0sH Ïëå¹·\'IÈE-&ú€ÀjÎBýñ', 'brian@pying.ca', NULL, 1, NULL, NULL, NULL),
(21, 'Mark Anthony', 'tesing site', '', '', 0.00, 0, 0, 0, 0, 'mavillaflor', '4d9622dbfd993a14c668c984e5ae20b56843d9e1f99f2f946e51d37d3b528c6e', '’ê›IlcVY_Hõ¨|2ˆÀLÕ3ôx”©§î?K1Èœrù', 'Password123@testing.com', NULL, 1, NULL, NULL, NULL),
(22, 'Christopher', 'Group 4 member', '', '', 0.00, 0, 0, 0, 0, 'testingclient', '7a3487f5adcc1ca6f3f47bb358dc5cd11befeb220246ed08ebc85c7ba351058d', 'tŠ”4rr„¬›ÛÑÈ…‘KÄ+»è²=(G¤É', 'admin@testng.com', NULL, 1, NULL, NULL, NULL),
(23, 'Mark Testing', 'mark testing site', '', '', 0.00, 0, 0, 0, 0, 'marktesting', '0b3bc4a1cc1c473901616421ab3fa78ddbc02e492f3ee6867887c2fee7c5bda3', '¸ñ[´É˜G<£`c€<ˆY¸¥\0Íƒm÷LhKg', 'admin@asdasd.com', NULL, 1, NULL, NULL, NULL),
(24, 'Mark Anthony Villaflor', 'Mark Anthony Villaflor', '', 'The ', 13.00, 0, 1, 1, 0, 'mavillaflor1', '4c742d0978af19997e28685e697f8f7aa2f0e2324b73ad9ea1e500c3f9ee2820', 'êñnà>U…>VÍ(Ë=HW&‘(W9oð—~ÕE', 'admin@myseneca.ca', NULL, 1, NULL, NULL, NULL),
(25, 'Quang', 'Hello World', '', 'ass', 0.00, 0, 0, 0, 0, 'nhquang', '0e0ea1caef9c7d0db2b62ca93af827e1d1317b8ce3988e78c37a6690328780d2', 'Eˆ [þPYäÆ]6¬åK;', 'nhquang@myseneca.ca', NULL, 1, NULL, NULL, NULL),
(26, 'mark', 'mark', '', '', 0.00, 0, 0, 0, 0, 'testing', 'a120af836f69e4a6d20ac323a9c4b1d350da659d87762d691dafd781d2591894', '§LÿÑ2-]K’‹ZûøO5Ù¹	8ÀPB£Ãˆ­=¹', 'nhquang@myseneca.ca', NULL, 1, NULL, NULL, NULL),
(27, 'testing2', 'testing2', '', '', 0.00, 0, 0, 0, 0, 'testing2', '396d21583fdfe11f710269d88059df9514ce570e4a503a476fd41fe747202e04', 'Ö¯³–äÃfúQ`\\‡tcÿ\'!ÌÀ8¶n(ì€û5Ô', 'nhquang@myseneca.ca', NULL, 1, NULL, NULL, NULL),
(28, 'Mark Anthony Villaflor', 'Mark Anthony Villaflor2', '', '', 0.00, 0, 0, 0, 0, 'Wecreu123', 'f57ae6707ac8bbc61ccce362d14ce420dc40474af1308f56f0c6f2af7a3c6e1a', '&yŒë	2ÙÌ¹Å¸\',3‚U™!>ðg×˜Â+Ïör×', 'wecreu123@yopmail.com', 'SjaWSyi42prpEBBSvkL5CGeJXKKIr8Ai37f9jcgy9nY95rueHKsj2H0jWUNDfKMeFd7WLiXTepRf47r4LJx2fHef2pJSTayyZe4Ao2H4XkUTCC0uXrZPoCyFw3aSYHyWBUb1iC8r80sLZ3thgKeEjDuhDR6dUYnEvCn1rZKZk4mk5eadskFk6ZWZFYHG0MzHZjV6aALYuPnGuFPszlLt1iGCKaXdVnadAql9fyRm4oh3g1IZWptNfOHRRd6L4p6', 1, NULL, NULL, NULL),
(29, 'Wecreu001', 'Wecreu001', '', 'Wecreu001', 0.00, 0, 0, 0, 0, 'Wecreu001', 'a9e93f8b849e71883ac2df991ba7a92942ce4d9dd9467102b8b51bc06dab5487', '9§¹Û^á\r¾/iÓ/ž‹­[6I+‡ ŽbŸõ(©', 'Wecreu001@asdasd.com', NULL, 1, NULL, NULL, NULL),
(30, 'Testing user', 'Wecreu911', '', 'This is only a testing account', 15.00, 0, 1, 1, 1, 'Wecreu911', '60779a351eab4bddb752ca028a45831ad3de7c14fdd643eb4913987a8f72f7f7', 'a‰ÀqÈW6ë‡ˆÄT8jd†Y/\'-¢¯ªjÓ[\Z¿ú`', 'admin@wecreu.com', NULL, 1, NULL, NULL, NULL),
(31, 'test3', 'test3', '', '', 0.00, 0, 0, 0, 0, 'testing3', '5bc7ec6bc4070ebed57f079710f33b47beae88031a6c207d365ff92d49ae9400', '/Åá·lTÞ:hcm/4˜‡¿¾¨ÐÍ‡–håá¹ëè1', 'nhquang@myseneca.ca', NULL, 1, NULL, NULL, NULL),
(32, 'test4', 'test4', '', '', 0.00, 0, 0, 0, 0, 'testing4', '1fef13d761e3730f85ff03d216c9650d5a4c3be8bb1db7f5dd4ee6a801971b3c', '…½ÎoåFA ïS)HÎ®LCÅfBLI·ú_Ÿ1a?­', 'quangpersie1@gmail.com', NULL, 1, NULL, NULL, NULL),
(34, 'test6', 'test6', '', '', 0.00, 0, 0, 0, 0, 'testing6', 'bd34223b55e4e45b2be3fff31f509b2c0b866bb89cdc9fe2aa57fa79ce6736dc', 'à‘ÑWþVFzŽ«¹£@É\nñ˜Œµì#¡jdqŠ', 'the_arsenal2@yahoo.com.vn', NULL, 1, NULL, NULL, NULL),
(35, 'Wecreu912', 'Wecreu912', '', 'Wecreu912', 0.00, 0, 0, 0, 0, 'Wecreu912', '883f9658e5e9786c4d089aacae21561c907658a666b72066fab8c20be9f3b7fa', 'Ü4ÉeÏ\00sÁ²ëÕ].§ÆÐeav)|b»À!h', 'admin@Wecreu912.com', NULL, 1, NULL, NULL, NULL),
(37, 'brian', 'brian', '', 'asjdashd', 13.00, 1, 1, 0, 0, 'briantest', '5d11e7f2663c92981275512f489f27ad19e1c09c91336f81197ff0d1308704a0', '+Ì«@3D‡…Ñ9KÔgE7š‡ÇìgÍÐV·?3É®ÛÉÔ', 'briantest@briantest.com', NULL, 1, NULL, NULL, NULL),
(41, 'Wecreu888', 'Demo', '', 'This is for demo', 0.00, 1, 1, 1, 1, 'Wecreu888', '369ba6aa51bf71207ebd6ae5bd31c3686c91a640a7041b74c9d2176d45a8d0e9', 'Oð²87õ‰*ÈòÐÒè´‡àV™ª8¹ƒ½ÿ×Q„', 'mavillaflor@myseneca.ca', 'pRoKRuld4nM2nuVWNe2iN7wh392LevOcSoMxspp7zartYbJ72yw1sg3XkSQxm6uNQtHbmW6oUV3xkw5CWLObaaxcq6sW93LxKj4IY7BWznG5xtBVhSLBbBN5nAnepf5VMvWq7zDzBXDcP4rf3JeutkODmLBT5Z39YUioJprFYAhLyAbXwhIYQCtc4v8XRvA4HBmrWnERx1LQagoCM7KSKMIVRjGHh8LukHpiVLT9t5LIblHalnOyk0cZx2nX3Uj', 1, NULL, NULL, NULL),
(46, 'testing17', 'testing17', '', '', 0.00, 0, 0, 0, 0, 'testing17', '2ddd25e1f1ded405abfde21abfd5255ce9aca4b03489819b2c6a858d0057bf20', '”?pðÔ/’ýãØ¼JÖû[¦y¥`n#÷…ÜžIjï•', 'testing17@gmail.com', NULL, 1, NULL, NULL, NULL),
(47, 'Christopher Lopez', 'Fruite', '', 'We sell only fruits and vegetables', 0.00, 0, 0, 0, 0, 'TestOne', '4632deb622aada18fff2a113ee3ba4412b317ec840caba56b1a58ad9364ac654', 'ðI\\°\0‰¢ÎÅ×§—c0ªEÀ<$Ü°Ž¢3%‹Â¹', 'yopeyone@gmail.com', NULL, 1, NULL, NULL, NULL),
(48, 'testing20', 'testing20', '', '', 0.00, 0, 0, 0, 0, 'testing20', '6e276a2d84944b0d150195bb2ae183d4bdff2e2be2db63de27718dfcef786fb7', 'žûI‚˜H­b¶ØÂ\'=9Ü­Áë¯XV>Óð…2Æí', 'testing20@gmail.com', NULL, 1, NULL, NULL, NULL),
(49, 'testing1', 'testing1', '', '', 0.00, 0, 0, 0, 0, 'testing1', '97e57cf65005776147dbcc957091518c18453d682a34f072778b2377b26aa27d', '0Ðt6:#¶Â»(^=Jñ§äŒW_æ[ÚNîù	®', 'testing1@gmail.com', NULL, 1, NULL, NULL, NULL),
(50, 'testingQ', 'testingQ', '/data/www/default/testingQ/images//logo.jpg', '', 0.00, 0, 0, 0, 0, 'testingQ', '7e6c3b777b9d5ce8b758e40ebd7d84f8a1613d52e1cbc3dec890fb7bd1d47cd4', 'CkR©,GjñÖ<ÁÆŽðã_Š.—©3;ìK´,', 'testingQ@gmail.com', NULL, 1, NULL, NULL, NULL),
(51, 'testingN', 'testingN', '', '', 0.00, 0, 0, 0, 0, 'testingN', 'd1cfd64d30e8fff8d147328a16e192a7c56dd790100032acecaa80e10efa7c20', '·¤N|Â:ZÕWú›¤.ŸZî©š¤¢‹6qPÔ\\N¸ë ', 'testingN@gmail.com', NULL, 1, NULL, NULL, NULL),
(52, 'testingH', 'testingH', '', '', 0.00, 0, 0, 0, 0, 'testingH', 'c9ae125eb2f28716223b4549efb6de78ebad7fa1c94482063286ef6f7b191160', 'k¾j¹äâËô‡ò¸šîÏ[’3¬Ã{ÚjòZmÏ', 'testingH@gmail.com', NULL, 1, NULL, NULL, NULL),
(53, 'Emile', 'Test', '', '      ', 0.00, 0, 0, 0, 0, 'emile1', '8e252026c0cbcf73d2e241364924068c9b8de30f0d41bf2ac27a056a127f2e7c', '£’˜ý\r_Ê¾¹Ö\"[´ß¥¯ç4û§|E­ÚŠî@“É', 'emile.ohan@senecacollege.ca', NULL, 1, NULL, NULL, NULL),
(54, 'testingY', 'testingY', '', '', 0.00, 0, 0, 0, 0, 'testingY', '4db977a9571c1c2c01fde7f951a0c5c059baae7d29b06c9ce739b674f6e7e4f6', 'º˜w×z…ñû47„áá’=<\nb0W\Z»¨ã÷s³', 'testingY@gmail.com', NULL, 1, NULL, NULL, NULL),
(55, 'testingR', 'testingR', '/data/www/default/testingR/images//logo.jpg', '', 0.00, 0, 0, 0, 0, 'testingR', '8b07d2d6ca0645cb5d46c2b0b51ff69df728b13cca9f8b0c703ee5ed2cd829d7', 'ª3‡)á»1ÖßàÉi8°-d9ªü?Ï©<jHÚ;|Þí', 'testingR@gmail.com', NULL, 1, NULL, NULL, NULL),
(56, 'formati', 'formati', '', 'formati', 13.00, 0, 0, 0, 0, 'formati', '0853f10476988a6da64bdab9e0ad8143116549781f28bbdc969aeaaad9a01f2a', 'å ª‰O­¶ßUÉÀûEUµ”%-µõG²øšÖ¿3©´', 'formati@asd.com', NULL, 1, NULL, NULL, NULL),
(57, 'Brian', 'StarStar', '', 'An amazing coffice shop.', 13.00, 0, 1, 0, 0, 'brianred', 'b95396a5849b9a9c6657821c4abfada7c31dee372aa011fd7e574f29b6c6d89f', ' ŠÆ@uèôE†üFœu>ççJHÎF…FÃö[òã~Õ', 'pyang16@myseneca.ca', NULL, 1, NULL, NULL, NULL),
(59, 'ueditor', 'sdasdasd', '/data/default/logo.png', NULL, NULL, 0, 0, 0, 0, '', '', '', '', NULL, 1, NULL, NULL, NULL),
(60, 'briangrey', 'BITS', '', 'Brian\'s IT shop', 8.00, 0, 1, 1, 0, 'briangrey', 'd63d4b3088861b52923383426d0d9cfbe0903a86a29bf3278e48fadeb2d4189b', '-\"{]fÏûáÌä%óÜK¥^*L1CzQ·ð¸ù', 'pyang16@myseneca', NULL, 1, NULL, NULL, NULL),
(61, 'Filling all fields', 'All', '', 'All', 10.00, 1, 1, 1, 1, 'allfieldsfilled', '5a8a8b65bc608bc321bd73222f407399949cc2842ea04d7d1287876eaa0037fa', '“xƒ£Ú™%MIÖrQ@ÙÜÑ±`\0Šw ®ó', 'admin@admin.com', NULL, 1, NULL, NULL, NULL),
(69, 'testingit', 'testingit', '', '', 0.00, 0, 0, 0, 0, 'testingit', '85fe9205d348f2cf88aa3c70a8753e95c76144108309aea5d7dc42b34304666f', '+ÃŠo¢C×¸¸fŸÖ0ô‡€ü+¬³’B\n/«ÕÆÖ¿', 'testingit@yopmail.com', NULL, 1, NULL, NULL, NULL),
(70, 'testingP', 'testingP', '', 'here is the info', 5.52, 1, 1, 1, 0, 'testingP', '0d89f6d2de620401ab1d914795ba8321ef6595d20eb77b0a55a8b009ceee83df', 'J´ô²8ÒÀ\"ÇvLKÃ®xïpÆÞô¾ßíG/\05', 'testingP123@gmail.com', NULL, 0, NULL, NULL, NULL),
(71, 'Information', 'Information', '', 'Information', 13.00, 1, 1, 0, 0, 'Information', '5a5236d4be502d016699be155461b6c4aa3633738a091de7dd46a922ff382a06', 'tIÌ[Ëûªm5o`ÂÎy\\ò‰˜¼€[ªÉE\rfµ(ƒ¤', 'Information@asd.com', NULL, 0, NULL, NULL, NULL);

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
(35, 'rawrawraw', '111-111-1111', 'rawraw', 'e', 'qe', 'e', 'e');

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
(1, 'Nimbus 3000', '../../../images/PHPMyadmin.PNG', 'goes 3000 km/h totally safe', 49.99, 700, 100.99, 0, 0, 1, 16),
(3, 'Elder Wand', '../../../images/goldcow.PNG', 'The most powerful wand in the universe', 4999.99, 1, 0.01, 0, 1, 1, 16),
(4, 'Younger Wand', '../../../images/Construction.png', 'This wand is crappy and weak wand', 4.99, 0, 1.00, 0, 0, 1, 16),
(5, 'Gold Fish', '../../../images/Flowers.png', 'Its gold', 599.99, 20, 1.60, 0, 0, 5, 16),
(6, 'Gold Cow', '../../../images/goldcow.PNG', 'Its gold', 699.99, 99, 500.00, 0, 0, 1, 16),
(41, 'Ray', 'images/fish.png', 'A drop of golden sun', 40.50, 100, 5.00, 1, 1, 4, 1),
(55, 'Me', 'images/fish.png', 'A name i call myself', 40.50, 100, 5.00, 1, 1, 4, 16),
(58, 'Far', 'images/fish.png', 'A long long way to run', 40.50, 100, 5.00, 1, 1, 4, 16),
(225, 'Doe', 'a female deer', 'test good table 1', 40.50, 100, 5.00, 1, 1, 4, 16),
(259, 'Sword', '../../../images/Computer.PNG', 'fancy weapon', 50.99, 7, 2.00, 0, 0, 1, 16),
(260, 'Mace', '/data/default/good.png', 'scary weapon', 23.00, 0, 23.00, 1, 1, 2, 16),
(261, 'Axe', '/data/default/good.png', 'french weapon', 234.00, 0, 42.00, 1, 1, 2, 16),
(262, 'Spear', '/data/default/good.png', 'common weapon', 34.00, 0, 0.00, 1, 1, 2, 16),
(265, 'Watercolour paper', NULL, 'paper for painting on', 1.00, 40, 2.00, 1, 1, 160, 16),
(266, 'Printing paper', '/data/default/good.png', 'paper for printing documents on', 4.00, 4, 4.00, 1, 1, 160, 16),
(359, 'Battle Axe', '../../../images/101.jpg', 'Testing', 0.14, 15, 66.99, 1, 1, 1, 16),
(375, 'brianaddgood', '../../../images/Instagram.PNG', 'brianaddgooddesc', 1000.00, 12, 1.00, 0, 0, 1, 16),
(409, 'Flowers', '../../../images/Flowers.png', 'Flower test', 0.02, 300, 0.03, 0, 0, 1, 16),
(417, 'Apple Macbook Pro 15', '../../../images/Computer2.PNG', 'Apple Macbook Pro 2017 15 inches screen', 4999.00, 5, 15.00, 0, 0, 181, NULL),
(418, 'Red mouse', '/data/default/good.png', 'is a red mouse', 90.00, 10, 1.00, 1, 1, 182, NULL),
(421, 'Red Keyboard', '/data/default/good.png', 'Search this', 10.00, 10, 10.00, 1, 1, 183, NULL),
(423, 'Blonde Vanilla Latte', '../../../images/1505ec8d423c4d77b5c04911dc4dd925.jpg', 'Blonde Vanilla Latte', 3.00, 999, 1.00, 1, 1, 189, 16),
(424, 'Blonde Almondmilk Vanilla Latte', '../../../images/24d7ca0b7ea74873aabecb365ac0cffd.jpg', 'Blonde Vanilla Latte', 1.00, 999, 1.00, 1, 1, 189, 16),
(425, 'Reduced-Fat Bacon-style Turkey', '../../../images/1dcffe6a5e6943e7b44942d2d6070d91.jpg', 'Reduced-Fat Bacon-style Turkey', 6.99, 999, 1.00, 1, 1, 191, 16),
(426, 'Sausage, Egg &amp; Cheese on English Muffin', '../../../images/bb7757ae41f947918f056a78b11686d9.jpg', 'Sausage, Egg &amp; Cheese on English Muffin', 4.99, 999, 1.00, 1, 1, 191, 16),
(427, 'Deluxe Fruit Blend', '../../../images/16e6abe01e024531b6e946b0b037eca1.jpg', 'Deluxe Fruit Blend', 3.99, 999, 1.00, 1, 1, 193, 16),
(428, 'Peach &amp; Raspberry Yogurt Parfait', '../../../images/990a15e74f2545feb834203f9ecf269f.jpg', 'Peach &amp; Raspberry Yogurt Parfait', 11.99, 999, 1.00, 1, 1, 193, 16),
(429, 'ASUS Rog GX501VI', '../../../images/1.jpg', 'ASUS Rog GX501VI', 3499.99, 300, 15.00, 1, 1, 194, 16);

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
(57, 4, NULL, 101, 5048.99, 5705.36, 0);

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
(5, 5, 6, 5),
(5, 6, 5, 10),
(6, 7, 266, 8),
(20, 9, 4, 1),
(20, 10, 1, 2),
(21, 11, 3, 1),
(22, 12, 1, 1),
(23, 13, 3, 1),
(24, 14, 3, 1),
(25, 15, 3, 1),
(26, 16, 3, 1),
(27, 17, 3, 1),
(28, 18, 3, 1),
(29, 19, 1, 2),
(30, 20, 4, 3),
(31, 21, 1, 1),
(32, 22, 3, 1),
(33, 23, 3, 1),
(35, 25, 359, 1),
(36, 29, 359, 1),
(37, 31, 409, 2),
(38, 32, 1, 1),
(39, 33, 1, 1),
(40, 34, 417, 1),
(41, 35, 417, 1),
(42, 36, 417, 1),
(43, 37, 417, 1),
(44, 38, 417, 1),
(45, 39, 417, 1),
(46, 40, 417, 1),
(47, 41, 417, 1),
(48, 42, 417, 2),
(49, 43, 1, 4),
(50, 44, 1, 2),
(51, 45, 1, 2),
(52, 46, 1, 1),
(53, 47, 1, 1),
(54, 48, 1, 1),
(55, 49, 1, 1),
(56, 50, 1, 11),
(57, 51, 1, 101);

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
(10, 'Contact us', 60),
(11, 'Openning hours', 57),
(12, 'Map', 57);

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
(15, 'Testing2123', 'Testing2123', 80.00, '2017-08-17 00:00:00', '2017-07-17 00:00:00'),
(16, 'No sale', 'Marker for goods not on sale', 0.00, NULL, NULL),
(17, 'testing123123123123', 'testing123123123123', 15.00, '2017-08-21 00:00:00', '2017-07-21 00:00:00'),
(18, 'sdfsdf', 'sdfsdf', 85.00, '2017-08-21 00:00:00', '2017-07-21 00:00:00'),
(19, 'testing78965', 'qweqweqwe', 50.00, '2017-08-21 00:00:00', '2017-07-21 00:00:00'),
(20, 'qweqweqweqweqwe', 'eqweqwe', 75.00, '2017-08-21 00:00:00', '2017-07-21 00:00:00'),
(21, 'Demo Sale', 'Demo Sale', 10.00, '2017-07-08 00:00:00', '2017-07-06 00:00:00'),
(22, 'Test sale', 'This is only a test', 50.00, '2017-08-21 00:00:00', '2017-07-21 00:00:00');

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
  MODIFY `admin_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;
--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `client_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `client_session`
--
ALTER TABLE `client_session`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `good`
--
ALTER TABLE `good`
  MODIFY `good_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=430;
--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `order_line`
--
ALTER TABLE `order_line`
  MODIFY `order_line_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `sale_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
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
