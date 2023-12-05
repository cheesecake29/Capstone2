-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2023 at 03:09 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `capstone_two_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `dates` date NOT NULL,
  `hours` varchar(1000) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0 - Pending, 1 - Confirmed, 2 - Cancelled, 3 - Rejected',
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `client_id`, `order_id`, `dates`, `hours`, `status`, `datetime`) VALUES
(142, 14, 39, '2023-12-08', '9am - 10am', 1, '2023-12-03 06:23:19'),
(143, 14, 40, '2023-12-08', '10am - 11am', 1, '2023-12-03 06:23:17'),
(144, 14, 41, '2023-12-14', '10am - 11am', 1, '2023-12-03 06:20:00'),
(145, 14, 42, '2023-12-22', '9am - 10am', 0, '2023-12-03 14:08:02');

-- --------------------------------------------------------

--
-- Table structure for table `brand_list`
--

CREATE TABLE `brand_list` (
  `id` int(30) NOT NULL,
  `category_id` int(30) NOT NULL,
  `category` varchar(250) NOT NULL,
  `name` text NOT NULL,
  `image_path` text NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand_list`
--

INSERT INTO `brand_list` (`id`, `category_id`, `category`, `name`, `image_path`, `delete_flag`, `status`, `date_created`, `date_updated`) VALUES
(8, 10, '', 'Yamaha', '', 0, 1, '2023-10-22 00:36:38', NULL),
(9, 11, '', 'Honda', '', 0, 1, '2023-10-22 23:55:53', NULL),
(10, 11, '', 'Smok', '', 0, 1, '2023-10-23 11:58:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart_list`
--

CREATE TABLE `cart_list` (
  `id` int(30) NOT NULL,
  `client_id` int(30) NOT NULL,
  `product_id` int(30) NOT NULL,
  `variation_id` int(30) NOT NULL COMMENT 'product_variations (id)',
  `quantity` float NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(30) NOT NULL,
  `category` varchar(250) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `status`, `delete_flag`, `date_created`) VALUES
(10, 'Motor Parts', 1, 0, '2023-10-22 00:36:20'),
(11, 'Motor Accessories', 1, 0, '2023-10-22 23:55:35');

-- --------------------------------------------------------

--
-- Table structure for table `client_list`
--

CREATE TABLE `client_list` (
  `id` int(30) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `contact` text NOT NULL,
  `region` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `addressline1` varchar(255) NOT NULL,
  `addressline2` varchar(255) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `verification_code` text NOT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_added` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client_list`
--

INSERT INTO `client_list` (`id`, `firstname`, `lastname`, `contact`, `region`, `province`, `city`, `barangay`, `addressline1`, `addressline2`, `zipcode`, `email`, `password`, `verification_code`, `email_verified_at`, `status`, `delete_flag`, `date_created`, `date_added`) VALUES
(10, 'jizzelle', 'salongcong', '097777777777', '', 'Select Province', 'Bangued', '', 'FIRST MARITIME PLACE', '7458 BAGTIKAN ST SAN ANTONIO VILLAGE', '1203', 'jewellsalongcong09@gmail.com', '363b122c528f54df4a0446b6bab05515', '', NULL, 1, 0, '2023-10-29 02:41:46', '2023-11-06 01:29:33'),
(12, 'jewell', 'salongcong', '097777777777', 'visayas', 'aklan', 'makato', '', 'FIRST MARITIME PLACE', '7458 BAGTIKAN ST SAN ANTONIO VILLAGE', '1203', 'bellachingaling@gmail.com', '2db95e8e1a9267b7a1188556b2013b33', '', NULL, 1, 0, '2023-11-06 01:37:04', '2023-11-09 14:03:11'),
(13, 'Test', 'Last', '', '', '', '', '', '', '', '', 'capstoner2@yopmail.com', '7815696ecbf1c96e6894b779456d330e', '', NULL, 1, 0, '2023-11-09 17:37:47', NULL),
(14, 'John', 'Doe', '+639123456789', '04', '0421', '042106', '', 'N/A', 'N/A', '4114', 'test@email.com', '827ccb0eea8a706c4c34a16891f84e7b', 'f404233e9cd3611370dbd02f6b8730b1', NULL, 1, 0, '2023-11-16 17:52:20', '2023-12-02 12:08:14'),
(50, 'test', 'test', '', '', '', '', '', '', '', '', 'johnbastiandinglasan@gmail.com', '098f6bcd4621d373cade4e832627b4f6', '896661', NULL, 1, 0, '2023-11-22 05:13:08', NULL),
(51, 'test', 'test', '', '', '', '', '', '', '', '', 'jbdinglasan@webfirmament.com', '098f6bcd4621d373cade4e832627b4f6', '455792', NULL, 1, 0, '2023-11-22 05:38:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` int(11) NOT NULL,
  `dates` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mechanics_list`
--

CREATE TABLE `mechanics_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `contact` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mechanics_list`
--

INSERT INTO `mechanics_list` (`id`, `name`, `contact`, `email`, `status`, `date_created`) VALUES
(1, 'Mike Williams', '09123456789', 'mwilliams@sample.com', 1, '2021-09-30 10:26:11'),
(2, 'George Wilson', '09112355799', 'gwilson@gmail.com', 1, '2021-09-30 10:30:58');

-- --------------------------------------------------------

--
-- Table structure for table `meet_up_address`
--

CREATE TABLE `meet_up_address` (
  `id` int(11) NOT NULL,
  `text` varchar(250) NOT NULL,
  `active` int(10) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Meet up address';

--
-- Dumping data for table `meet_up_address`
--

INSERT INTO `meet_up_address` (`id`, `text`, `active`) VALUES
(1, 'DASMARINAS AREA', 1),
(2, 'IMUS AGUINALDO HIGHWAY', 1),
(3, 'BACOOR AGUINALDO HIGHWAY', 1),
(4, 'ZAPOTE PALENGKE', 1),
(5, 'LAS PINAS HOSPITAL', 1),
(6, 'SM SUCAT BUILDING 2', 1),
(7, 'AIRPORT ROAD', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `type` int(11) NOT NULL DEFAULT 1 COMMENT '1=client, 2=admin',
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `client_id`, `description`, `status`, `type`, `order_id`) VALUES
(1, 13, '0', 0, 1, 0),
(2, 13, '0', 0, 1, 0),
(3, 13, 'Your order is confirmed.', 0, 1, 29),
(4, 13, 'Test Last. has placed an order.', 0, 2, 30),
(5, 13, 'Your order is confirmed.', 0, 1, 0),
(6, 14, 'test test  has placed an order.', 0, 2, 31),
(7, 14, 'test test  has placed an order.', 0, 2, 32),
(8, 14, 'test test  has placed an order.', 0, 2, 33),
(9, 14, 'test test  has placed an order.', 0, 2, 34),
(10, 14, 'test test  has placed an order.', 0, 2, 35),
(11, 14, 'Your order Test product was delivered.', 0, 1, 35),
(12, 14, 'Your order Lorem ipum was delivered.', 0, 1, 34),
(13, 14, 'John Doe  has placed an order.', 0, 2, 36),
(14, 14, 'John Doe  has placed an order.', 0, 2, 37),
(15, 14, 'John Doe  has placed an order.', 0, 2, 38),
(16, 14, 'John Doe  has placed an order.', 0, 2, 39),
(17, 14, 'John Doe  has placed an order.', 0, 2, 40),
(18, 14, 'John Doe  has placed an order.', 0, 2, 41),
(19, 14, 'John Doe  has placed an order.', 0, 2, 42);

-- --------------------------------------------------------

--
-- Table structure for table `order_config`
--

CREATE TABLE `order_config` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `value` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `is_all` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(30) NOT NULL,
  `order_id` int(30) NOT NULL,
  `product_id` int(30) NOT NULL,
  `variation_id` int(11) NOT NULL,
  `quantity` float NOT NULL DEFAULT 0,
  `rated` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `variation_id`, `quantity`, `rated`, `date_added`, `date_updated`) VALUES
(36, 33, 46, 51, 1, 0, '2023-11-17 18:13:04', NULL),
(37, 34, 46, 50, 2, 1, '2023-11-17 18:31:20', '2023-11-23 18:19:45'),
(38, 34, 50, 53, 1, 1, '2023-11-17 18:31:20', '2023-11-23 18:19:54'),
(39, 35, 50, 52, 1, 1, '2023-11-17 18:45:26', '2023-11-23 18:18:36'),
(40, 35, 50, 53, 1, 1, '2023-11-17 18:45:26', '2023-11-23 18:19:32'),
(41, 36, 50, 52, 1, 0, '2023-12-02 13:11:22', NULL),
(42, 36, 46, 49, 1, 0, '2023-12-02 13:11:22', NULL),
(43, 37, 50, 53, 1, 0, '2023-12-02 15:22:36', NULL),
(44, 38, 46, 50, 1, 0, '2023-12-02 15:23:48', NULL),
(45, 39, 46, 49, 1, 0, '2023-12-02 15:26:13', NULL),
(46, 40, 50, 53, 1, 0, '2023-12-02 15:29:11', NULL),
(47, 41, 50, 53, 1, 0, '2023-12-02 20:33:40', NULL),
(48, 42, 46, 49, 3, 0, '2023-12-03 22:08:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_list`
--

CREATE TABLE `order_list` (
  `id` int(30) NOT NULL,
  `ref_code` varchar(100) NOT NULL,
  `client_id` int(30) NOT NULL,
  `total_amount` float NOT NULL DEFAULT 0,
  `contact` text NOT NULL,
  `province` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `addressline1` varchar(255) NOT NULL,
  `addressline2` varchar(255) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `order_type` tinyint(4) NOT NULL DEFAULT 1,
  `other_address` varchar(1000) NOT NULL COMMENT 'Pick up / Meet up',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=pending,1 = confirmed, 2 = packed, 3 = for delivery, 4 = on the way, 5= delivered, 6=cancelled',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_list`
--

INSERT INTO `order_list` (`id`, `ref_code`, `client_id`, `total_amount`, `contact`, `province`, `city`, `addressline1`, `addressline2`, `zipcode`, `order_type`, `other_address`, `status`, `date_created`, `date_updated`) VALUES
(33, '202311-00001', 14, 1150, '', '1401', '175301', '', '', '', 3, 'BLK 7 LOT 22 PHASE 2 BRGY. BUROL 1, DASMARINAS CITY, CAVITE', 0, '2023-11-17 18:13:04', '2023-11-17 18:13:04'),
(34, '202311-00002', 14, 2650, '', '1401', '175301', '', '', '', 3, 'BLK 7 LOT 22 PHASE 2 BRGY. BUROL 1, DASMARINAS CITY, CAVITE', 5, '2023-11-17 18:31:20', '2023-11-22 17:59:38'),
(35, '202311-00003', 14, 250, '', '1401', '175301', '', '', '', 3, 'BLK 7 LOT 22 PHASE 2 BRGY. BUROL 1, DASMARINAS CITY, CAVITE', 5, '2023-11-17 18:45:26', '2023-11-22 14:42:40'),
(36, '202312-00001', 14, 1600, '', '0421', '042106', 'N/A', 'N/A', '4114', 3, 'BLK 7 LOT 22 PHASE 2 BRGY. BUROL 1, DASMARINAS CITY, CAVITE', 0, '2023-12-02 13:11:22', '2023-12-02 13:11:22'),
(37, '202312-00002', 14, 150, '', '0421', '042106', 'N/A', 'N/A', '4114', 3, 'BLK 7 LOT 22 PHASE 2 BRGY. BUROL 1, DASMARINAS CITY, CAVITE', 0, '2023-12-02 15:22:36', '2023-12-02 15:22:36'),
(38, '202312-00003', 14, 1250, '', '0421', '042106', 'N/A', 'N/A', '4114', 4, '', 0, '2023-12-02 15:23:48', '2023-12-02 15:23:48'),
(39, '202312-00004', 14, 1500, '', '0421', '042106', 'N/A', 'N/A', '4114', 3, 'BLK 7 LOT 22 PHASE 2 BRGY. BUROL 1, DASMARINAS CITY, CAVITE', 0, '2023-12-02 15:26:13', '2023-12-02 15:26:13'),
(40, '202312-00005', 14, 150, '', '0421', '042106', 'N/A', 'N/A', '4114', 3, 'BLK 7 LOT 22 PHASE 2 BRGY. BUROL 1, DASMARINAS CITY, CAVITE', 0, '2023-12-02 15:29:11', '2023-12-02 15:29:11'),
(41, '202312-00006', 14, 150, '', '0421', '042106', 'N/A', 'N/A', '4114', 3, 'BLK 7 LOT 22 PHASE 2 BRGY. BUROL 1, DASMARINAS CITY, CAVITE', 0, '2023-12-02 20:33:40', '2023-12-02 20:33:40'),
(42, '202312-00007', 14, 4500, '', '0421', '042106', 'N/A', 'N/A', '4114', 3, 'BLK 7 LOT 22 PHASE 2 BRGY. BUROL 1, DASMARINAS CITY, CAVITE', 0, '2023-12-03 22:08:02', '2023-12-03 22:08:02');

-- --------------------------------------------------------

--
-- Table structure for table `product_image_gallery`
--

CREATE TABLE `product_image_gallery` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `is_deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_image_gallery`
--

INSERT INTO `product_image_gallery` (`id`, `product_id`, `image_url`, `is_deleted`) VALUES
(1, 46, 'uploads/product_gallery/46_655dd6dce2abd.png', 0),
(2, 46, 'uploads/product_gallery/46_655dd80aa4c1e.png', 0),
(3, 46, 'uploads/product_gallery/46_655dd82f9824e.png', 0),
(4, 46, 'uploads/product_gallery/46_655dd839bde06.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_list`
--

CREATE TABLE `product_list` (
  `id` int(30) NOT NULL,
  `brand_id` int(30) NOT NULL,
  `category_id` int(30) NOT NULL,
  `name` text NOT NULL,
  `models` text NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL DEFAULT 0,
  `weight` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `image_path` text NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_list`
--

INSERT INTO `product_list` (`id`, `brand_id`, `category_id`, `name`, `models`, `description`, `price`, `weight`, `status`, `image_path`, `delete_flag`, `date_created`, `date_updated`) VALUES
(46, 10, 11, 'Lorem ipum', 'All model', '&lt;p&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;&quot;&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vel semper libero. Vestibulum eu urna bibendum, tempus sapien eu, elementum tellus. Nullam congue, est vel semper porta, libero justo varius massa, vestibulum faucibus arcu augue a nisi. Morbi nec rutrum nunc. Phasellus congue consectetur lectus ac aliquam. Integer nec tellus faucibus, lobortis tortor ullamcorper, laoreet massa. Vivamus a odio sem. Donec at rhoncus urna. Nulla aliquet justo vel pulvinar accumsan. Phasellus at augue commodo, volutpat est sit amet, tristique justo.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;', 1500, '500g and below', 1, 'uploads/products/46.jpg?v=1700211715', 0, '2023-11-15 18:31:10', '2023-11-17 17:22:02'),
(50, 9, 11, 'Test product', 'All', '&lt;p&gt;test only&lt;/p&gt;', 150, '500g and below', 1, 'uploads/products/50.png?v=1700217018', 0, '2023-11-17 18:30:18', '2023-11-17 18:30:18'),
(51, 9, 11, 'test', 'test', '&lt;p&gt;test&lt;/p&gt;', 100, 'select', 1, '', 1, '2023-11-30 19:07:54', '2023-11-30 19:08:01');

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `variation_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `author_email` varchar(255) NOT NULL,
  `author_rate` int(10) NOT NULL,
  `author_comment` varchar(255) NOT NULL,
  `date_created` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_reviews`
--

INSERT INTO `product_reviews` (`id`, `product_id`, `variation_id`, `product_name`, `author_name`, `author_email`, `author_rate`, `author_comment`, `date_created`) VALUES
(1, 50, 52, 'Test product', 'test, test', 'test@email.com', 4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i', '2023-11-23 18:18:36'),
(2, 50, 53, 'Test product', 'test, test', 'test@email.com', 5, 'Vel turpis nunc eget lorem. Duis ut diam quam nulla porttitor massa id. Commodo sed egestas egestas fringilla phasellus faucibus. Augue eget arcu dictum varius duis at consectetur lorem. Sed enim ut sem viverra. Aliquam ultrices sagittis orci a scelerisqu', '2023-11-23 18:19:32'),
(3, 46, 50, 'Lorem ipum', 'test, test', 'test@email.com', 3, 'Proin gravida hendrerit lectus a. Dictum fusce ut placerat orci nulla pellentesque dignissim enim sit. Id aliquet risus feugiat in ante. Rutrum tellus pellentesque eu tincidunt tortor aliquam. Turpis egestas integer eget aliquet nibh praesent tristique ma', '2023-11-23 18:19:45'),
(4, 50, 53, 'Test product', 'test, test', 'test@email.com', 5, 'Tellus mauris a diam maecenas sed enim ut. Semper eget duis at tellus at. Pulvinar mattis nunc sed blandit libero volutpat sed cras ornare. A arcu cursus vitae congue. Magna fringilla urna porttitor rhoncus dolor purus. Id velit ut tortor pretium viverra ', '2023-11-23 18:19:54');

-- --------------------------------------------------------

--
-- Table structure for table `product_variations`
--

CREATE TABLE `product_variations` (
  `id` int(30) NOT NULL COMMENT 'auto inc',
  `product_id` int(30) NOT NULL COMMENT 'product_list (id)',
  `variation_name` varchar(250) NOT NULL COMMENT 'eg: Blue/Red/Green',
  `variation_price` float NOT NULL DEFAULT 0,
  `variation_stock` int(100) NOT NULL,
  `delete_flag` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = false, 1 = true',
  `default_flag` int(10) NOT NULL DEFAULT 0 COMMENT '0 - False / 1 - True',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_variations`
--

INSERT INTO `product_variations` (`id`, `product_id`, `variation_name`, `variation_price`, `variation_stock`, `delete_flag`, `default_flag`, `date_created`, `date_updated`) VALUES
(49, 46, 'Black', 1500, 100, 0, 0, '2023-11-17 17:01:55', NULL),
(50, 46, 'Red', 1250, 87, 0, 0, '2023-11-17 17:01:55', NULL),
(51, 46, 'White', 1150, 93, 0, 0, '2023-11-17 17:01:55', NULL),
(52, 50, 'Small', 100, 10, 0, 0, '2023-11-17 18:30:18', NULL),
(53, 50, 'Large', 150, 20, 0, 0, '2023-11-17 18:30:18', NULL),
(54, 51, 'Default', 100, 1, 1, 0, '2023-11-30 19:07:54', '2023-11-30 19:08:01');

-- --------------------------------------------------------

--
-- Table structure for table `request_meta`
--

CREATE TABLE `request_meta` (
  `request_id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_list`
--

CREATE TABLE `schedule_list` (
  `id` int(30) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_list`
--

CREATE TABLE `service_list` (
  `id` int(30) NOT NULL,
  `service` text NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_list`
--

INSERT INTO `service_list` (`id`, `service`, `description`, `status`, `delete_flag`, `date_created`) VALUES
(1, 'Change Oil', '&lt;p&gt;&lt;span style=&quot;text-align: justify;&quot;&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel sapien lectus. Ut posuere, arcu eget bibendum venenatis, quam diam interdum diam, in viverra leo quam eu mi. Sed bibendum mauris nulla, vel vehicula libero elementum vel. Nam blandit justo justo, dapibus sodales risus consectetur nec. Suspendisse ornare in purus et mollis. Praesent placerat quis lectus at hendrerit. Morbi maximus dolor dolor, a maximus mi congue quis.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;', 1, 1, '2021-09-30 14:11:21'),
(2, 'Overall Checkup', '&lt;p&gt;&lt;span style=&quot;text-align: justify;&quot;&gt;Curabitur nec viverra tellus. Donec quis molestie arcu. Sed et blandit dui, vel vehicula tortor. Vivamus fringilla sit amet nibh fringilla ornare. Etiam iaculis ornare purus id feugiat. Etiam mattis erat ut congue tempor. Nam placerat faucibus libero ultrices posuere. Donec ac tempus nulla.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;', 1, 0, '2021-09-30 14:11:38'),
(3, 'Engine Tune up', '&lt;p&gt;&lt;span style=&quot;text-align: justify;&quot;&gt;Sed ultrices fermentum augue. Duis ultricies arcu vitae lorem accumsan porta. Donec fermentum risus ut tincidunt cursus. Sed varius id dolor et euismod. Vestibulum elit massa, varius nec arcu vel, viverra varius dolor. Etiam fermentum vel lorem vel tincidunt. Ut nec libero pulvinar, malesuada lacus et, tempor diam. Aliquam vitae nisl augue.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;', 1, 0, '2021-09-30 14:12:03'),
(4, 'Tire Replacement', '&lt;p&gt;&lt;span style=&quot;text-align: justify;&quot;&gt;Nullam pretium eu justo ac tincidunt. Vestibulum quis est non felis porttitor pretium. Vivamus nec augue ultrices, condimentum risus vitae, pellentesque turpis. Nullam ornare est sapien, sed semper neque imperdiet suscipit. Sed fermentum eros et felis mollis finibus. In condimentum eleifend magna, non consequat nibh viverra nec. Nulla vel sapien libero. Suspendisse varius nisl nec ornare imperdiet.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;', 1, 0, '2021-09-30 14:12:24');

-- --------------------------------------------------------

--
-- Table structure for table `service_requests`
--

CREATE TABLE `service_requests` (
  `id` int(30) NOT NULL,
  `client_id` int(30) NOT NULL,
  `service_type` text NOT NULL,
  `mechanic_id` int(30) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipping_fee`
--

CREATE TABLE `shipping_fee` (
  `id` int(11) NOT NULL,
  `order_id` int(100) NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_list`
--

CREATE TABLE `stock_list` (
  `id` int(30) NOT NULL,
  `product_id` int(30) NOT NULL,
  `quantity` float NOT NULL DEFAULT 0,
  `type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1= IN, 2= Out',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock_list`
--

INSERT INTO `stock_list` (`id`, `product_id`, `quantity`, `type`, `date_created`) VALUES
(33, 46, 280, 1, '2023-11-15 18:31:10'),
(40, 50, 30, 1, '2023-11-17 18:30:18'),
(41, 51, 1, 1, '2023-11-30 19:07:54');

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(11, 'logo', 'uploads/1698195720_LogoOfficial.png'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/1700735640_rm309-adj-04.jpg'),
(15, 'sysname', '                     Arnold TV Motoshop  \r\n                    '),
(16, 'sys_shortname', '                     ATV Motoshop  \r\n                    '),
(17, 'homename1', '                                          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Pellentesque habitant morbi tristique senectus et.                       \r\n                      \r\n                      \r\n                    '),
(18, 'homedes1', '                                          Turpis massa sed elementum tempus egestas sed. Velit scelerisque in dictum non consectetur                       \r\n                      \r\n                      \r\n                    '),
(19, 'link', 'www.testlink.com.ph');

-- --------------------------------------------------------

--
-- Table structure for table `time_availability`
--

CREATE TABLE `time_availability` (
  `id` int(11) NOT NULL,
  `value` varchar(1000) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `time_availability`
--

INSERT INTO `time_availability` (`id`, `value`, `status`) VALUES
(1, '9am - 10am', 0),
(2, '10am - 11am', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`) VALUES
(1, 'Adminstrator', 'Admin', 'admin', '0192023a7bbd73250516f069df18b500', 'uploads/1624240500_avatar.png', NULL, 1, '2021-01-20 14:02:37', '2021-06-21 09:55:07'),
(6, 'Claire', 'Blake', 'cblake', 'cd74fae0a3adf459f73bbf187607ccea', 'uploads/1632990840_ava.jpg', NULL, 2, '2021-09-30 16:34:02', '2021-09-30 16:35:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clientId` (`client_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `brand_list`
--
ALTER TABLE `brand_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_list`
--
ALTER TABLE `cart_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `variation_id` (`variation_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_list`
--
ALTER TABLE `client_list`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`) USING HASH;

--
-- Indexes for table `mechanics_list`
--
ALTER TABLE `mechanics_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meet_up_address`
--
ALTER TABLE `meet_up_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_config`
--
ALTER TABLE `order_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `variation_id` (`variation_id`);

--
-- Indexes for table `order_list`
--
ALTER TABLE `order_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `product_image_gallery`
--
ALTER TABLE `product_image_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_list`
--
ALTER TABLE `product_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `variation_id` (`variation_id`);

--
-- Indexes for table `product_variations`
--
ALTER TABLE `product_variations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `request_meta`
--
ALTER TABLE `request_meta`
  ADD KEY `request_id` (`request_id`);

--
-- Indexes for table `service_list`
--
ALTER TABLE `service_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_requests`
--
ALTER TABLE `service_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `mechanic_id` (`mechanic_id`);

--
-- Indexes for table `shipping_fee`
--
ALTER TABLE `shipping_fee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_list`
--
ALTER TABLE `stock_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_availability`
--
ALTER TABLE `time_availability`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `brand_list`
--
ALTER TABLE `brand_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cart_list`
--
ALTER TABLE `cart_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `client_list`
--
ALTER TABLE `client_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `mechanics_list`
--
ALTER TABLE `mechanics_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `meet_up_address`
--
ALTER TABLE `meet_up_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `order_config`
--
ALTER TABLE `order_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `order_list`
--
ALTER TABLE `order_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `product_image_gallery`
--
ALTER TABLE `product_image_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_list`
--
ALTER TABLE `product_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_variations`
--
ALTER TABLE `product_variations`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT COMMENT 'auto inc', AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `service_list`
--
ALTER TABLE `service_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `service_requests`
--
ALTER TABLE `service_requests`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `shipping_fee`
--
ALTER TABLE `shipping_fee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_list`
--
ALTER TABLE `stock_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `time_availability`
--
ALTER TABLE `time_availability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_list`
--
ALTER TABLE `cart_list`
  ADD CONSTRAINT `cart_list_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product_list` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_list_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `client_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order_list` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_list`
--
ALTER TABLE `order_list`
  ADD CONSTRAINT `order_list_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_list`
--
ALTER TABLE `product_list`
  ADD CONSTRAINT `product_list_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brand_list` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_list_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_variations`
--
ALTER TABLE `product_variations`
  ADD CONSTRAINT `product_variations_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product_list` (`id`);

--
-- Constraints for table `request_meta`
--
ALTER TABLE `request_meta`
  ADD CONSTRAINT `request_meta_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `service_requests` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `service_requests`
--
ALTER TABLE `service_requests`
  ADD CONSTRAINT `service_requests_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client_list` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `service_requests_ibfk_2` FOREIGN KEY (`mechanic_id`) REFERENCES `mechanics_list` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `stock_list`
--
ALTER TABLE `stock_list`
  ADD CONSTRAINT `stock_list_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product_list` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
