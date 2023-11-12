-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2023 at 12:11 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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
(13, 'Test', 'Last', '', '', '', '', '', '', '', '', 'capstoner2@yopmail.com', '7815696ecbf1c96e6894b779456d330e', '', NULL, 1, 0, '2023-11-09 17:37:47', NULL);

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
(5, 13, 'Your order is confirmed.', 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(30) NOT NULL,
  `order_id` int(30) NOT NULL,
  `product_id` int(30) NOT NULL,
  `quantity` float NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `date_added`) VALUES
(20, 16, 6, 1, '2023-10-31 18:14:23'),
(21, 18, 7, 1, '2023-10-31 18:33:59'),
(22, 20, 9, 1, '2023-10-31 19:05:40'),
(23, 22, 6, 1, '2023-11-02 02:10:46'),
(24, 23, 11, 6, '2023-11-02 10:58:34'),
(25, 24, 7, 1, '2023-11-02 11:17:31'),
(26, 25, 8, 1, '2023-11-02 11:18:45'),
(27, 26, 10, 1, '2023-11-02 11:25:52'),
(28, 27, 9, 1, '2023-11-06 02:17:21'),
(29, 28, 6, 1, '2023-11-06 02:39:39'),
(30, 29, 10, 1, '2023-11-09 21:08:19'),
(31, 30, 9, 2, '2023-11-12 18:38:33');

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
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=pending,1 = packed, 2 = for delivery, 3 = on the way, 4 = delivered, 5=cancelled',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_list`
--

INSERT INTO `order_list` (`id`, `ref_code`, `client_id`, `total_amount`, `contact`, `province`, `city`, `addressline1`, `addressline2`, `zipcode`, `order_type`, `status`, `date_created`, `date_updated`) VALUES
(16, '202310-00001', 10, 300, '', '', '', '', '', '', 1, 0, '2023-10-31 18:14:23', '2023-10-31 18:14:23'),
(17, '202310-00002', 10, 0, '', '', '', '', '', '', 1, 0, '2023-10-31 18:14:23', NULL),
(18, '202310-00003', 10, 1200, '', '', '', '', '', '', 1, 0, '2023-10-31 18:33:59', '2023-10-31 18:33:59'),
(19, '202310-00004', 10, 0, '', '', '', '', '', '', 1, 0, '2023-10-31 18:33:59', NULL),
(20, '202310-00005', 10, 2800, '', '', '', '', '', '', 1, 1, '2023-10-31 19:05:40', '2023-11-02 01:52:00'),
(21, '202310-00006', 10, 0, '', '', '', '', '', '', 1, 0, '2023-10-31 19:05:40', NULL),
(22, '202311-00001', 10, 300, '', '', '', '', '', '', 1, 0, '2023-11-02 02:10:46', '2023-11-02 02:10:46'),
(23, '202311-00002', 10, 33600, '', '', '', '', '', '', 1, 4, '2023-11-02 10:58:34', '2023-11-02 11:00:01'),
(24, '202311-00003', 10, 1200, '', 'Select Province', '', '', '', '', 1, 0, '2023-11-02 11:17:31', '2023-11-02 11:17:31'),
(25, '202311-00004', 10, 2300, '', '', '', 'FIRST MARITIME PLACE', '', '', 1, 0, '2023-11-02 11:18:45', '2023-11-02 11:18:45'),
(26, '202311-00005', 10, 2400, '', '', '', 'FIRST MARITIME PLACE', '', '', 1, 5, '2023-11-02 11:25:52', '2023-11-02 11:26:38'),
(27, '202311-00006', 12, 2800, '', '', '', 'FIRST MARITIME PLACE', '', '', 1, 6, '2023-11-06 02:17:21', '2023-11-06 02:36:06'),
(28, '202311-00007', 12, 300, '', '', '', 'FIRST MARITIME PLACE', '', '', 1, 0, '2023-11-06 02:39:39', '2023-11-06 02:39:39'),
(29, '202311-00008', 13, 2400, '', '', '', 'TEST ADDRESS', '', '', 1, 1, '2023-11-09 21:08:19', '2023-11-11 00:20:30'),
(30, '202311-00009', 13, 5600, '', '', '', '', '', '', 1, 1, '2023-11-12 18:38:33', '2023-11-12 19:08:03');

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
(6, 8, 10, 'Front Fender', 'Mio Soul 125', '&lt;p&gt;&lt;font color=&quot;#000000&quot; face=&quot;Josefin Sans&quot;&gt;&lt;span style=&quot;font-size: 18px;&quot;&gt;Front fender is a motorcycle accessory that is designed to protect the rider and other drivers from debris kicked up by the front wheel. It also has an impact on air drag and speed capabilities.&lt;/span&gt;&lt;/font&gt;&lt;br&gt;&lt;/p&gt;', 300, '500g and below', 1, 'uploads/products/6.png?v=1698284267', 0, '2023-10-22 16:53:47', '2023-11-02 19:05:02'),
(7, 9, 11, 'Mini Driving  Lights Set  Bracket  With Bracket', 'For  Mio i, Mio M3, Mio i 125s, TMX 125, TMX 155, Rusi, Racal, SkyGo', '&lt;p&gt;Driving light bracket sets available for motorcycles that are designed to mount driving lights onto the motorcycle. These bracket sets are made from different materials and are compatible with different motorcycle makes and models.&lt;br&gt;&lt;/p&gt;', 1200, '5kg – 6kg', 1, 'uploads/products/7.png?v=1698284223', 0, '2023-10-22 23:58:55', '2023-10-28 19:24:13'),
(8, 8, 10, 'Mono Rack Bracket', 'Mio i, Mio M3, Mio i 125s, Honda Beat & Click V1/2/3, Mio Soul i125, Honda PCX 150/160, Mio Sporty/Soulty, Mio Gear 125', '&lt;p&gt;Mono rack bracket is a specialized bracket used to attach a top box or luggage carrier to the rear of a motorcycle. It provides a secure and stable mounting point for carrying luggage and is made of heavy-duty and durable materials.&lt;br&gt;&lt;/p&gt;', 2300, '5kg – 6kg', 1, 'uploads/products/8.png?v=1698284212', 0, '2023-10-23 11:46:53', '2023-10-28 19:24:20'),
(9, 8, 11, 'Gas Cap', 'TMX 155', '&lt;p&gt;Gas cap is a motorcycle accessory that covers the opening of the gas tank, providing a secure seal and preventing fuel from spilling or evaporating.&amp;nbsp;&lt;br&gt;&lt;/p&gt;', 2800, '5kg – 6kg', 1, 'uploads/products/9.png?v=1698284257', 0, '2023-10-23 11:55:41', '2023-10-28 19:23:55'),
(10, 9, 10, 'Gas Tank', 'TMX 155', '&lt;p&gt;Gas tank is an essential component of a motorcycle that stores fuel for the engine. Gas tank accessories are available to enhance the functionality and appearance of the gas tank, such as gas caps, fuel sight gauges, and fuel line hoses.&lt;br&gt;&lt;/p&gt;', 2400, '5kg – 6kg', 1, 'uploads/products/10.png?v=1698284236', 0, '2023-10-23 12:01:10', '2023-10-28 19:24:04'),
(11, 9, 10, 'Side Cover', 'For TMX 155 / TMX 125', '&lt;p&gt;Side covers for the TMX 155 and TMX 125 motorcycles are accessories that provide both functional and aesthetic benefits. They are designed to fit specific models, made from durable materials, and can enhance the appearance of the motorcycle.&lt;br&gt;&lt;/p&gt;', 5600, '5kg – 6kg', 1, 'uploads/products/11.png?v=1698284197', 0, '2023-10-23 12:03:22', '2023-10-28 19:24:28');

-- --------------------------------------------------------

--
-- Table structure for table `product_variations`
--

CREATE TABLE `product_variations` (
  `id` int(30) NOT NULL,
  `product_id` int(30) NOT NULL,
  `color_id` int(30) NOT NULL,
  `delete_flag` tinyint(4) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(9, 6, 5, 1, '2023-10-22 16:54:16'),
(10, 7, 3, 1, '2023-10-22 23:59:34'),
(11, 8, 7, 1, '2023-10-23 11:47:07'),
(12, 9, 6, 1, '2023-10-23 11:56:05'),
(13, 10, 1, 1, '2023-10-23 12:01:22'),
(15, 11, 1, 1, '2023-11-02 11:03:35');

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
(14, 'cover', 'uploads/1643082720_bike-cover-2.jpg'),
(15, 'sysname', '                     Arnold TV Motoshop  \r\n                    '),
(16, 'sys_shortname', '                     ATV Motoshop  \r\n                    ');

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
(6, 'Claire', 'Blake', 'cblake', 'cd74fae0a3adf459f73bbf187607ccea', 'uploads/1632990840_ava.jpg', NULL, 2, '2021-09-30 16:34:02', '2021-09-30 16:35:26'),
(7, 'Test', 'Admin', 'admin2', 'asd', NULL, NULL, 1, '2023-11-09 21:09:54', '2023-11-09 21:10:21');

--
-- Indexes for dumped tables
--

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
  ADD KEY `product_id` (`product_id`);

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
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `order_list`
--
ALTER TABLE `order_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `product_list`
--
ALTER TABLE `product_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_variations`
--
ALTER TABLE `product_variations`
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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand_list`
--
ALTER TABLE `brand_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cart_list`
--
ALTER TABLE `cart_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `client_list`
--
ALTER TABLE `client_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `mechanics_list`
--
ALTER TABLE `mechanics_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `order_list`
--
ALTER TABLE `order_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `product_list`
--
ALTER TABLE `product_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
-- AUTO_INCREMENT for table `stock_list`
--
ALTER TABLE `stock_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
