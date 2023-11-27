-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20221022.e89ebe179c
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2023 at 08:20 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.30

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
-- Table structure for table `proof_payments`
--

CREATE TABLE `proof_payments` (
  `proof_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `ref_code` varchar(255) NOT NULL,
  `file_url` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `proof_payments`
--

INSERT INTO `proof_payments` (`proof_id`, `customer_name`, `order_id`, `ref_code`, `file_url`, `date`, `status`) VALUES
(1, 'test test', '46', '202311-00010', '', '2023-11-28 02:03:12', '1'),
(2, 'test test', '46', '202311-00010', '', '2023-11-28 02:20:40', '1'),
(3, 'test test', '46', '202311-00010', 'C:/xampp/htdocs/Capstone2/uploads/proof-paymentsbabysitting.jpg', '2023-11-28 02:29:34', '1'),
(4, 'test test', '45', '202311-00009', 'C:/xampp/htdocs/Capstone2/uploads/proof-paymentsCreating-spa-experience-1.jpg', '2023-11-28 02:32:12', '1'),
(5, 'test test', '46', '202311-00010', 'C:/xampp/htdocs/Capstone2/uploads/download.jpeg', '2023-11-28 02:33:55', '1'),
(6, 'test test', '46', '202311-00010', 'C:/xampp/htdocs/Capstone2/uploads/payment-proof/370300812_205702525834554_1865821601485670473_n.png', '2023-11-28 02:35:12', '1'),
(7, 'test test', '46', '202311-00010', 'C:/xampp/htdocs/Capstone2/uploads/payment-proof/Bye-Bye-Scars.jpg', '2023-11-28 02:39:38', '1'),
(8, 'test test', '46', '202311-00010', 'C:/xampp/htdocs/Capstone2/uploads/payment-proof/Creating-spa-experience-5.jpg', '2023-11-28 02:44:10', '1'),
(9, 'test test', '44', '202311-00008', 'C:/xampp/htdocs/Capstone2/uploads/payment-proof/broom.png', '2023-11-28 02:47:05', '1'),
(10, 'test test', '45', '202311-00009', 'C:/xampp/htdocs/Capstone2/uploads/payment-proof/Cleaning-team-with-brooms-and-vacuum-cleaner-[Converted].png', '2023-11-28 02:47:46', '1'),
(11, 'test test', '46', '202311-00010', 'C:/xampp/htdocs/Capstone2/uploads/payment-proof/houseeeee.jpg', '2023-11-28 02:49:11', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `proof_payments`
--
ALTER TABLE `proof_payments`
  ADD PRIMARY KEY (`proof_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `proof_payments`
--
ALTER TABLE `proof_payments`
  MODIFY `proof_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
