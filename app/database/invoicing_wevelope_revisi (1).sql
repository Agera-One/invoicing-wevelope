-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 01, 2026 at 08:09 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `invoicing_wevelope_revisi`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(320) NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `business_entity` varchar(255) NOT NULL,
  `sector` varchar(255) NOT NULL,
  `website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `country` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `subdistrict` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `logo` text NOT NULL,
  `signature` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `email`, `phone`, `business_entity`, `sector`, `website`, `description`, `country`, `province`, `city`, `subdistrict`, `address`, `logo`, `signature`) VALUES
(1, 'Red Hat, inc', 'redhat@example.com', '081234567892', 'PT', 'Open Source Software', '', 'Red Hat is an American enterprise software company that provides open-source solutions for operating systems, hybrid cloud infrastructure, container platforms, automation, virtualization, middleware, and enterprise support services', 'United States', 'North Carolina', 'Raleigh', 'Downtown Raleigh', '100 East Davie Street, Raleigh, NC 27601, United States', 'logo_2_1786508251.png', 'signature_2_1786508318.png');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int NOT NULL,
  `customer_code` char(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(320) NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `address` text NOT NULL,
  `company_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `customer_code`, `name`, `email`, `phone`, `address`, `company_id`) VALUES
(1, 'CUST-2026-0001', 'Budi Santoso', 'budi.santoso@example.com', '81234567803', 'Jl. Kenanga No. 8, Surabaya', 1),
(2, 'CUST-2026-0002', 'jesko', 'jesko@example.com', '08127145725435', 'jalan', 1),
(3, 'CUST-2026-0003', 'hanif', 'hanif@example.com', '0813457785433', 'jalan jalan jalan', 1),
(4, 'CUST-2026-0004', 'QQQQQQQQQQQQQQQ', 'dzaki@example.com', '0346578543', 'xetcfygbi', 1),
(5, 'CUST-2026-0005', 'hartono', 'aiocbi@adiuvb', '34567876543', 'esdrtfvyb', 1),
(6, 'CUST-2026-0006', 'Andi Pratama', 'andi.pratama@example.com', '81234567801', 'Jl. Melati No. 12, Bandung', 1),
(7, 'CUST-2026-0007', 'Siti Rahmawati', 'siti.rahmawati@example.com', '81234567802', 'Jl. Mawar No. 25, Jakarta', 1),
(8, 'CUST-2026-0008', 'Rina Wulandari', 'rina.wulandari@example.com', '81234567804', 'Jl. Anggrek No. 17, Yogyakarta', 1),
(9, 'CUST-2026-0009', 'Dimas Saputra', 'dimas.saputra@example.com', '81234567805', 'Jl. Cempaka No. 31, Semarang', 1),
(72, 'CUST-2026-0010', 'jesko', 'jesko@gmail.com', '0986545351673', 'Surabaya', 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int NOT NULL,
  `invoice_code` char(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date` date NOT NULL,
  `due_date` date NOT NULL,
  `company_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `invoice_code`, `date`, `due_date`, `company_id`, `customer_id`, `user_id`) VALUES
(1, 'INV-2026-0001', '2026-07-27', '2026-09-01', 1, 1, 1),
(2, 'INV-2026-0002', '2026-07-30', '2026-09-01', 1, 2, 1),
(3, 'INV-2026-0003', '2026-09-01', '2026-09-08', 1, 72, 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_detail`
--

CREATE TABLE `invoice_detail` (
  `id` int NOT NULL,
  `unit_price` int NOT NULL,
  `quantity` int NOT NULL,
  `amount` bigint NOT NULL,
  `invoice_id` int NOT NULL,
  `item_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `invoice_detail`
--

INSERT INTO `invoice_detail` (`id`, `unit_price`, `quantity`, `amount`, `invoice_id`, `item_id`) VALUES
(1, 500000, 1, 500000, 1, 1),
(18, 900000, 1, 900000, 3, 51);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int NOT NULL,
  `ref_no` varchar(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` bigint NOT NULL,
  `company_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `ref_no`, `name`, `price`, `company_id`) VALUES
(1, 'REF-2026-0001', 'Keyboard Mechanical Fantech', 500000, 1),
(2, 'REF-2026-0002', 'Mouse Logitech M220', 100000, 1),
(3, 'REF-2026-0006', 'Monitor LG 24 Inch', 1850000, 1),
(4, 'REF-2026-0007', 'Monitor Samsung 24 Inch', 2100000, 1),
(5, 'REF-2026-0008', 'Keyboard Logitech K120', 175000, 1),
(6, 'REF-2026-0009', 'Mouse Logitech M331', 325000, 1),
(7, 'REF-2026-0010', 'Webcam Logitech C270', 450000, 1),
(8, 'REF-2026-0011', 'Headset HyperX Cloud Stinger', 850000, 1),
(9, 'REF-2026-0012', 'USB Flashdisk Sandisk 64GB', 125000, 1),
(10, 'REF-2026-0013', 'USB Flashdisk Sandisk 128GB', 210000, 1),
(11, 'REF-2026-0014', 'SSD Kingston NV2 500GB', 750000, 1),
(12, 'REF-2026-0015', 'SSD Samsung 980 500GB', 950000, 1),
(13, 'REF-2026-0016', 'RAM Kingston 8GB DDR4', 350000, 1),
(14, 'REF-2026-0017', 'RAM Kingston 16GB DDR4', 650000, 1),
(15, 'REF-2026-0018', 'RAM Corsair 8GB DDR4', 425000, 1),
(16, 'REF-2026-0019', 'RAM Corsair 16GB DDR4', 725000, 1),
(17, 'REF-2026-0020', 'Power Supply 450W', 550000, 1),
(18, 'REF-2026-0021', 'Power Supply 550W', 700000, 1),
(19, 'REF-2026-0022', 'Power Supply 650W', 850000, 1),
(20, 'REF-2026-0023', 'Casing PC ATX', 650000, 1),
(21, 'REF-2026-0024', 'Casing PC Gaming RGB', 950000, 1),
(22, 'REF-2026-0025', 'Cooling Fan 120mm', 85000, 1),
(23, 'REF-2026-0026', 'CPU Cooler Deepcool', 450000, 1),
(24, 'REF-2026-0027', 'HDMI Cable 2 Meter', 75000, 1),
(25, 'REF-2026-0028', 'DisplayPort Cable 2 Meter', 125000, 1),
(26, 'REF-2026-0029', 'LAN Cable Cat6 5 Meter', 90000, 1),
(27, 'REF-2026-0030', 'LAN Cable Cat6 10 Meter', 150000, 1),
(28, 'REF-2026-0031', 'Router TP-Link Archer C6', 650000, 1),
(29, 'REF-2026-0032', 'Router TP-Link Archer AX10', 950000, 1),
(30, 'REF-2026-0033', 'Switch TP-Link 8 Port', 350000, 1),
(31, 'REF-2026-0034', 'Switch TP-Link 16 Port', 750000, 1),
(32, 'REF-2026-0035', 'Printer Epson L3210', 2350000, 1),
(33, 'REF-2026-0036', 'Printer Canon PIXMA G2020', 2200000, 1),
(34, 'REF-2026-0037', 'Printer HP Ink Tank 315', 1950000, 1),
(35, 'REF-2026-0038', 'Laptop Stand Aluminium', 275000, 1),
(36, 'REF-2026-0039', 'Laptop Stand Adjustable', 350000, 1),
(37, 'REF-2026-0040', 'Mouse Pad Gaming XL', 175000, 1),
(38, 'REF-2026-0041', 'Mouse Pad Gaming XXL', 225000, 1),
(39, 'REF-2026-0042', 'USB Hub 4 Port', 150000, 1),
(40, 'REF-2026-0043', 'USB Hub Type C 6 Port', 325000, 1),
(41, 'REF-2026-0044', 'Bluetooth Speaker JBL', 850000, 1),
(42, 'REF-2026-0045', 'Bluetooth Speaker Anker', 650000, 1),
(43, 'REF-2026-0046', 'Mechanical Keyboard Fantech MK872', 750000, 1),
(44, 'REF-2026-0047', 'Mechanical Keyboard Royal Kludge', 950000, 1),
(45, 'REF-2026-0048', 'Wireless Mouse Fantech', 225000, 1),
(46, 'REF-2026-0049', 'Wireless Mouse Rexus', 185000, 1),
(47, 'REF-2026-0050', 'Gaming Headset Fantech', 550000, 1),
(48, 'REF-2026-0051', 'Gaming Headset Rexus', 475000, 1),
(49, 'REF-2026-0052', 'Keyboard Wireless Logitech', 450000, 1),
(50, 'REF-2026-0053', 'Mouse Wireless Logitech M185', 175000, 1),
(51, 'REF-2026-0055', 'External HDD Toshiba 1TB', 900000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int NOT NULL,
  `payment_code` char(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date` date NOT NULL,
  `amount` bigint NOT NULL,
  `invoice_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `payment_code`, `date`, `amount`, `invoice_id`) VALUES
(43, 'PAY-2026-0001', '2026-09-01', 100000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(320) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `company_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `phone`, `password`, `is_active`, `company_id`) VALUES
(1, 'Administrator', 'admin@gmail.com', '0987654321', '$2y$10$5PTTEgLURBWAjxgM93W8yeflC7quRb68Lg98.2XAF.tTQhbi5i2H6', 1, 1),
(19, 'jesko', 'jesko@gmail.com', '0653565123', '$2y$10$4SZ76WY8wxPDSOBQqFVgYelVLyIb3qLpSRcDVpBS5aM8ffO.zVNPm', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD UNIQUE KEY `phone_UNIQUE` (`phone`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `customer_code` (`customer_code`),
  ADD KEY `fk_customer_company1_idx` (`company_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code_invoice` (`invoice_code`),
  ADD KEY `fk_invoice_company1_idx` (`company_id`),
  ADD KEY `fk_invoice_customer1_idx` (`customer_id`),
  ADD KEY `fk_invoice_user1_idx` (`user_id`);

--
-- Indexes for table `invoice_detail`
--
ALTER TABLE `invoice_detail`
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_invoice_detail_invoice1_idx` (`invoice_id`),
  ADD KEY `fk_invoice_detail_item1_idx` (`item_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ref_no` (`ref_no`) USING BTREE,
  ADD KEY `fk_item_company1_idx` (`company_id`) INVISIBLE;

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payment_code` (`payment_code`),
  ADD KEY `fk_payment_invoice1_idx` (`invoice_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone_UNIQUE` (`phone`),
  ADD KEY `fk_user_company1_idx` (`company_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `invoice_detail`
--
ALTER TABLE `invoice_detail`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `fk_customer_company1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `fk_invoice_company1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_invoice_customer1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_invoice_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `invoice_detail`
--
ALTER TABLE `invoice_detail`
  ADD CONSTRAINT `fk_invoice_detail_invoice1` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_invoice_detail_item1` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `fk_item_company1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `fk_payment_invoice1` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_company1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
