-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2023 at 09:14 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bragais`
--

-- --------------------------------------------------------

--
-- Table structure for table `development`
--

CREATE TABLE `development` (
  `BatchID` int(11) NOT NULL,
  `ProductID` varchar(255) NOT NULL,
  `Model` varchar(255) NOT NULL,
  `Color` varchar(255) NOT NULL,
  `Size` int(11) NOT NULL,
  `HeelHeight` int(11) NOT NULL,
  `Category` varchar(255) NOT NULL,
  `Price` decimal(10,0) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `LastUpdate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `development`
--

INSERT INTO `development` (`BatchID`, `ProductID`, `Model`, `Color`, `Size`, `HeelHeight`, `Category`, `Price`, `Quantity`, `Status`, `LastUpdate`) VALUES
(1, 'test', 'test', 'test 2', 4, 5, 'asdas', '3123', 52, 'Pending', '0000-00-00'),
(2, 'test', 'test', 'test 2', 4, 5, 'asdas', '3123', 23, 'Pending', '04 26 2323'),
(3, 'Test Shoe 1', 'Matto', 'Nude Pink', 8, 6, 'Pageant', '5500', 23, 'Pending', '04 26 23232323'),
(4, 'test', 'test', 'test 2', 4, 5, 'asdas', '3123', 23, 'Pending', '04 26 23'),
(5, 'testz', 'test', 'test 2', 4, 5, 'asdas', '3123', 23, 'Pending', '0404/2626/23232323'),
(6, 'Product01', 'Test Shoes', 'Color 1', 5, 5, 'Pageant', '2000', 23, 'Pending', '0404/2626/2023202320232023'),
(7, 'Product01', 'Test Shoes', 'Color 1', 5, 5, 'Pageant', '2000', 23, 'Pending', '0404/2626/2023'),
(8, 'test', 'test', 'test 2', 4, 5, 'asdas', '3123', 23232, 'Pending', '04/26/2023');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` varchar(255) NOT NULL,
  `agent_no` varchar(255) DEFAULT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `employee_access` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `agent_no`, `fname`, `lname`, `display_name`, `email`, `password`, `employee_access`) VALUES
('027', '278', 'matto', 'matto', 'matt', 'matt@gmail.com', '$2y$10$mq3steKNJSsS1V9mQrbryOmqef8M7hl9lZsRXOH3fgkKmHOtvQfSW', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `factory_inventory`
--

CREATE TABLE `factory_inventory` (
  `ProductID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Size` int(11) NOT NULL,
  `HeelHeight` int(11) NOT NULL,
  `Category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Price` decimal(10,0) NOT NULL,
  `Stock` int(11) NOT NULL,
  `Status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DateTransferred` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `factory_inventory`
--

INSERT INTO `factory_inventory` (`ProductID`, `Model`, `Color`, `Size`, `HeelHeight`, `Category`, `Price`, `Stock`, `Status`, `DateTransferred`) VALUES
('matto001', 'ewan', 'sda', 21, 3, 'ad', '2', 535185, 'In Department 6', '02/22/2023'),
('Product01', 'Test Shoes', 'Color 1', 5, 5, 'Pageant', '2000', 5, 'For Sale', '02/22/2023'),
('test', 'test', 'test 2', 4, 5, 'asdas', '3123', 23, 'Pending', '02/22/2023'),
('Test Shoe 1', 'Matto', 'Nude Pink', 8, 6, 'Pageant', '5500', 50, 'Pending', '02/22/2023'),
('testmatto', 'tst', 'color 1', 5, 5, 'pageant', '2000', 2, 'Pending', '02/22/2023'),
('testz', 'test', 'test 2', 4, 5, 'asdas', '3123', 23, 'Pending', '02/22/2023'),
('testzd', 'test', 'test 2', 4, 5, 'asdas', '3123', 23, 'Pending', '02/22/2023');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_logs`
--

CREATE TABLE `inventory_logs` (
  `log_id` int(11) NOT NULL,
  `log_action` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `date_logged` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory_logs`
--

INSERT INTO `inventory_logs` (`log_id`, `log_action`, `user`, `date_logged`) VALUES
(1, 'Created New Product test 1', 'Employee #', '2023-03-29'),
(2, 'Logged In', 'Employee #027', '2023-03-29'),
(3, 'Created New Product sdas', 'Employee #', '2023-03-29'),
(4, 'Updated Product matto001', 'Employee #', '2023-03-29'),
(5, 'Updated Product matto001', 'Employee #', '2023-03-29'),
(6, 'Transferred Product matto001 to In Department 3', 'Employee #027', '2023-03-29'),
(7, 'Restocked Item matto001', 'Employee #027', '2023-03-29'),
(8, 'Restocked Item matto001', 'Employee #027', '2023-03-30'),
(9, 'Restocked Item matto001', 'Employee #027', '2023-03-30'),
(10, 'Logged In', 'Employee #027', '2023-03-30'),
(11, 'Logged In', 'Employee #027', '2023-03-30'),
(12, 'Logged In', 'Employee #027', '2023-04-26'),
(13, 'Logged In', 'Employee #027', '2023-04-26'),
(14, 'Created New Product Product01', 'Employee #027', '2023-04-26'),
(15, 'Created New Product test', 'Employee #027', '2023-04-26'),
(16, 'Created New Product test', 'Employee #027', '2023-04-26'),
(17, 'Created New Product test', 'Employee #027', '2023-04-26'),
(18, 'Created New Product Test Shoe 1', 'Employee #027', '2023-04-26'),
(19, 'Created New Product test', 'Employee #027', '2023-04-26'),
(20, 'Created New Product testz', 'Employee #027', '2023-04-26'),
(21, 'Created New Product Product01', 'Employee #027', '2023-04-26'),
(22, 'Created New Product Product01', 'Employee #027', '2023-04-26'),
(23, 'Created New Product test', 'Employee #027', '2023-04-26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `development`
--
ALTER TABLE `development`
  ADD PRIMARY KEY (`BatchID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`),
  ADD UNIQUE KEY `EmployeeID` (`employee_id`),
  ADD UNIQUE KEY `AgentNo` (`agent_no`);

--
-- Indexes for table `factory_inventory`
--
ALTER TABLE `factory_inventory`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `inventory_logs`
--
ALTER TABLE `inventory_logs`
  ADD PRIMARY KEY (`log_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `development`
--
ALTER TABLE `development`
  MODIFY `BatchID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `inventory_logs`
--
ALTER TABLE `inventory_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
