-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2022 at 02:28 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hjms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `acc_fiscal_years`
--

CREATE TABLE `acc_fiscal_years` (
  `id` int(100) NOT NULL,
  `fy_start_date` date NOT NULL,
  `fy_end_date` date NOT NULL,
  `fy_year` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8_unicode_ci NOT NULL,
  `company_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `acc_fiscal_years`
--

INSERT INTO `acc_fiscal_years` (`id`, `fy_start_date`, `fy_end_date`, `fy_year`, `status`, `company_id`) VALUES
(1, '2018-01-01', '2021-12-31', '2018-2021', 'inactive', 0),
(2, '2022-01-01', '2022-12-31', '2022', 'active', 0);

-- --------------------------------------------------------

--
-- Table structure for table `hjms_city`
--

CREATE TABLE `hjms_city` (
  `id` int(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `active` tinyint(1) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hjms_hotels`
--

CREATE TABLE `hjms_hotels` (
  `id` int(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` datetime DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hjms_packages`
--

CREATE TABLE `hjms_packages` (
  `id` int(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` datetime DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hjms_package_detail`
--

CREATE TABLE `hjms_package_detail` (
  `id` int(10) NOT NULL,
  `package_id` int(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `city_id` int(10) NOT NULL,
  `nights` int(5) NOT NULL,
  `checkin` date NOT NULL,
  `checkout` date NOT NULL,
  `hotel_id` int(10) NOT NULL,
  `room_type` varchar(20) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hjms_passengers`
--

CREATE TABLE `hjms_passengers` (
  `id` int(255) NOT NULL,
  `user_id` int(20) NOT NULL,
  `first_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `middle_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_no` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax_no` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `passport_no` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cnic` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `passport_issue_date` date DEFAULT NULL,
  `passport_expiry_date` date DEFAULT NULL,
  `father_name` text COLLATE utf8_unicode_ci,
  `description` text COLLATE utf8_unicode_ci,
  `mehram` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `relation` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_id` int(20) NOT NULL,
  `visa_no` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `visa_issue_date` date DEFAULT NULL,
  `visa_status` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `visa_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` datetime DEFAULT NULL,
  `invoiced` tinyint(1) NOT NULL DEFAULT '0',
  `pnr_code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `group_code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `group_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mofa_no` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `moi_no` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hjms_shirkas`
--

CREATE TABLE `hjms_shirkas` (
  `id` int(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` datetime DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `is_default` tinyint(1) NOT NULL,
  `picture` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hjms_transportation_trip`
--

CREATE TABLE `hjms_transportation_trip` (
  `id` int(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` datetime DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hjms_transportation_type`
--

CREATE TABLE `hjms_transportation_type` (
  `id` int(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` datetime DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hjms_users`
--

CREATE TABLE `hjms_users` (
  `id` int(11) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `username` varchar(60) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `user_level` varchar(3) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `email` varchar(60) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hjms_users`
--

INSERT INTO `hjms_users` (`id`, `name`, `username`, `password`, `user_level`, `company`, `email`, `contact`, `address`, `active`, `date_created`) VALUES
(1, 'Admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', '1', 'KARWAN-E-TAIF PVT LTD', 'karwanetaif1@gmail.com', '091-2582552', 'SHOP # B-7,B-8, HANIFULLAH PLAZA CHARSADDA ROAD , OPPOSITE CHARSADDA BUS STAND PESHAWAR', 1, '2022-03-04 05:46:35'),
(2, 'AZAM KHAN', 'AZAM', '21232f297a57a5a743894a0e4a801fc3', '2', NULL, '', '03428276824', '', 1, '2022-03-04 05:46:35'),
(3, 'YARAN E HARAMAN', 'WAQAS', 'ef69fd985816b025914a650d91d607ac', '2', 'YARAN E HARAMAN', '', '03219114124', '', 1, '2022-03-04 05:46:35'),
(4, 'SAFA INTERNATIONAL T', 'SAFA', '4beff4f1ef44c90eab94b70dae07face', '2', 'SAFA INTERNATIONAL TRAVELS AND TOURS', '', '03339596143', '', 1, '2022-03-04 05:46:35'),
(5, 'SPINGHAR TRAVELS AND', 'SPINGHAR', '2aefc34200a294a3cc7db81b43a81873', '2', 'SPINGHAR TRAVELS AND TOURS', 'spinghartravels_tours@hotmail.com', '03339105185', 'UG - 150 DEANS TRADE CENTER PESHAWAR SADDAR', 1, '2022-03-04 05:46:35'),
(6, 'KARWAN-E-MAKKAH', 'KARWAN', 'ca082b1630edb1a5fee2400e4dcfd7ef', '2', 'KARWAN-E-MAKKAH', '', '03139451949', '', 1, '2022-03-04 05:46:35'),
(7, 'ANHAR HAJJ SERVICE', 'ANHAR123', 'b9db42360d8b8dbf03a1f665c8e13516', '2', 'ANHAR HAJJ SERVICE', '', '03339505085', '', 1, '2022-03-04 05:46:35'),
(8, 'EXTREEM TRAVELS', 'EXTREEM', '9a1e22e6fde09e58658401f37a5505bb', '2', 'EXTREEM TRAVELS', '', '', '', 1, '2022-03-04 05:46:35'),
(9, 'AKHTAR', 'AKHTAR', '8176f2f1d661716d5503e8903a33bcc2', '2', 'AKHTAR', '', '', 'MEDINA', 1, '2022-03-04 05:46:35'),
(10, 'MUJEEB', 'MUJEEB SAHIL', '26d3910a0a864d12b9cc4e19e810048c', '2', 'MUJEEB SAHIL', '', '', 'PESHAWAR', 1, '2022-03-04 05:46:35'),
(11, 'BURAQ HAJJ UMRAH', 'BURAQ HAJJ', '7d5118256e8bdd565e54ca09c4e582de', '2', 'BURAQ HAJJ UMRAH', '', '', 'PESHAWAR', 1, '2022-03-04 05:46:35'),
(12, 'DAUDZAI TRAVELS', 'DAUDZAI', '12ae765cccb785ad56b0c7b0ecf42a7a', '2', 'DAUDZAI TRAVELS', '', '', 'PESHAWAR', 1, '2022-03-04 05:46:35'),
(13, 'AL SAIF', 'AL SAIF', 'c53b177789416498f169e625227a0e6d', '2', 'AL SAIF', '', '', 'PESHAWAR', 1, '2022-03-04 05:46:35'),
(14, 'AL KAREEM TRAVEL', 'ALKAREEM', '875b3a5125039c2b2e4b30ab706e2b2f', '2', 'AL KAREEM TRAVEL', '', '', '', 1, '2022-03-04 05:46:35'),
(15, 'AKBAR PURA TRAVELS', 'AKBARPURA', '3c55d1e86e78732be172794d1fbb1e8d', '2', 'AKBAR PURA TRAVELS', '', '', '', 1, '2022-03-04 05:46:35'),
(16, 'ALASAR TRAVEL', 'ALASAR', '97c2b1c059ebc0a1a5673deb881370e3', '2', 'ALASAR TRAVEL', '', '', '', 1, '2022-03-04 05:46:35'),
(17, 'ANSHRAH TRAVEL', 'ANSHRAH', 'bbfb8dcde65209517d7509bc7b48deca', '2', 'ANSHRAH TRAVEL', '', '', '', 1, '2022-03-04 05:46:35'),
(18, 'ARABIAN INTERNATIONA', 'ARABIAN', 'ad8ad0ea65db78a624ee14e84fd77da9', '2', 'ARABIAN INTERNATIONAL TRAVELS', '', '', '', 1, '2022-03-04 05:46:35'),
(19, 'YASEEN HAJJ & UMRAH ', 'YASEEN', '5479495c627f9261ef21bca155f2f7fa', '2', 'YASEEN HAJJ & UMRAH SERVICES PVT LTD', '', '03011117547', 'OFFICE NO.27 1ST FLOOR SHEIKH YASEEN TRADE CENTER UNIVERSITY ROAD PESHAWAR PAKISTAN', 1, '2022-03-04 09:57:31');

-- --------------------------------------------------------

--
-- Table structure for table `hjms_vouchers`
--

CREATE TABLE `hjms_vouchers` (
  `id` int(10) NOT NULL,
  `voucher_no` varchar(20) NOT NULL,
  `company_id` int(255) NOT NULL,
  `voucher_date` date NOT NULL,
  `customer_id` int(10) DEFAULT NULL,
  `employee_id` int(10) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `shirka_id` int(11) DEFAULT NULL,
  `comment` text NOT NULL,
  `description` text,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` datetime DEFAULT NULL,
  `transportation_trip_id` int(10) NOT NULL,
  `transportation_type_id` int(10) NOT NULL,
  `transport_qty` int(11) NOT NULL,
  `ziarat` varchar(10) NOT NULL,
  `remarks` text NOT NULL,
  `makkah_contact_person` varchar(100) DEFAULT NULL,
  `makkah_contact` varchar(100) DEFAULT NULL,
  `madina_contact_person` varchar(100) DEFAULT NULL,
  `madina_contact` varchar(100) DEFAULT NULL,
  `transport_contact_person` varchar(100) DEFAULT NULL,
  `transport_contact` varchar(100) DEFAULT NULL,
  `kt_contact_person` varchar(100) DEFAULT NULL,
  `kt_contact` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hjms_voucher_flight_info`
--

CREATE TABLE `hjms_voucher_flight_info` (
  `id` int(11) NOT NULL,
  `voucher_no` varchar(20) NOT NULL,
  `voucher_id` int(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sector1_to_ksa` varchar(30) DEFAULT NULL,
  `sector2_to_ksa` varchar(30) DEFAULT NULL,
  `flight1_to_ksa` varchar(30) NOT NULL,
  `flight2_to_ksa` varchar(30) NOT NULL,
  `departure_date_to_ksa` date NOT NULL,
  `departure_time_to_ksa` time NOT NULL,
  `arrival_date_to_ksa` date NOT NULL,
  `arrival_time_to_ksa` time NOT NULL,
  `pnr_to_ksa` varchar(50) NOT NULL,
  `sector1_return` varchar(30) NOT NULL,
  `sector2_return` varchar(30) NOT NULL,
  `flight1_return` varchar(30) NOT NULL,
  `flight2_return` varchar(30) NOT NULL,
  `departure_date_return` date NOT NULL,
  `departure_time_return` time NOT NULL,
  `arrival_date_return` date NOT NULL,
  `arrival_time_return` time NOT NULL,
  `pnr_return` varchar(50) NOT NULL,
  `total_nights` int(2) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hjms_voucher_package_detail`
--

CREATE TABLE `hjms_voucher_package_detail` (
  `id` int(10) NOT NULL,
  `voucher_id` int(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `voucher_no` varchar(20) NOT NULL,
  `package_id` int(10) NOT NULL,
  `city_id` int(10) NOT NULL,
  `nights` int(5) NOT NULL,
  `checkin` date NOT NULL,
  `checkout` date NOT NULL,
  `hotel_id` int(10) NOT NULL,
  `room_type` varchar(20) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hjms_voucher_pnr_detail`
--

CREATE TABLE `hjms_voucher_pnr_detail` (
  `id` int(10) NOT NULL,
  `voucher_no` varchar(20) NOT NULL,
  `voucher_id` int(10) NOT NULL DEFAULT '0',
  `passenger_id` int(10) NOT NULL DEFAULT '0',
  `description` varchar(30) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acc_fiscal_years`
--
ALTER TABLE `acc_fiscal_years`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `hjms_city`
--
ALTER TABLE `hjms_city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hjms_hotels`
--
ALTER TABLE `hjms_hotels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hjms_packages`
--
ALTER TABLE `hjms_packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hjms_package_detail`
--
ALTER TABLE `hjms_package_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_id` (`package_id`);

--
-- Indexes for table `hjms_passengers`
--
ALTER TABLE `hjms_passengers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hjms_shirkas`
--
ALTER TABLE `hjms_shirkas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hjms_transportation_trip`
--
ALTER TABLE `hjms_transportation_trip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hjms_transportation_type`
--
ALTER TABLE `hjms_transportation_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hjms_users`
--
ALTER TABLE `hjms_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hjms_vouchers`
--
ALTER TABLE `hjms_vouchers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `voucher_no_2` (`voucher_no`),
  ADD KEY `voucher_no` (`voucher_no`);

--
-- Indexes for table `hjms_voucher_flight_info`
--
ALTER TABLE `hjms_voucher_flight_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `voucher_id` (`voucher_id`),
  ADD KEY `voucher_no` (`voucher_no`);

--
-- Indexes for table `hjms_voucher_package_detail`
--
ALTER TABLE `hjms_voucher_package_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_id` (`package_id`);

--
-- Indexes for table `hjms_voucher_pnr_detail`
--
ALTER TABLE `hjms_voucher_pnr_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `voucher_no` (`voucher_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acc_fiscal_years`
--
ALTER TABLE `acc_fiscal_years`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `hjms_city`
--
ALTER TABLE `hjms_city`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hjms_hotels`
--
ALTER TABLE `hjms_hotels`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hjms_packages`
--
ALTER TABLE `hjms_packages`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hjms_package_detail`
--
ALTER TABLE `hjms_package_detail`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hjms_passengers`
--
ALTER TABLE `hjms_passengers`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hjms_shirkas`
--
ALTER TABLE `hjms_shirkas`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hjms_transportation_trip`
--
ALTER TABLE `hjms_transportation_trip`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hjms_transportation_type`
--
ALTER TABLE `hjms_transportation_type`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hjms_users`
--
ALTER TABLE `hjms_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `hjms_vouchers`
--
ALTER TABLE `hjms_vouchers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hjms_voucher_flight_info`
--
ALTER TABLE `hjms_voucher_flight_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hjms_voucher_package_detail`
--
ALTER TABLE `hjms_voucher_package_detail`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hjms_voucher_pnr_detail`
--
ALTER TABLE `hjms_voucher_pnr_detail`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

CREATE TABLE `hjms_supplier` (
 `id` int(255) NOT NULL AUTO_INCREMENT,

 `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
 `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
 `contact_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
 `status` enum('active','inactive') COLLATE utf8_unicode_ci NOT NULL,
 `posting_type_id` int(100) NOT NULL,
 `currency_id` int(10) DEFAULT '0',
 `op_balance_dr` decimal(10,4) DEFAULT '0.0000',
 `op_balance_cr` decimal(10,4) DEFAULT '0.0000',
 `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 `exchange_rate` decimal(10,0) DEFAULT '0',
 `acc_code` int(11) DEFAULT NULL,
 `isSupplier` tinyint(1) NOT NULL DEFAULT '1',
 `also_customer` tinyint(1) NOT NULL DEFAULT '0',
 `sale_posting_type_id` int(20) DEFAULT NULL,
 PRIMARY KEY (`id`),
 KEY `company_id` (`company_id`),
 KEY `acc_code` (`acc_code`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `hjms_receivings` (
 `receiving_id` int(10) NOT NULL AUTO_INCREMENT,
 `invoice_no` varchar(100) NOT NULL,
 `receiving_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 `employee_id` int(10) NOT NULL DEFAULT '0',
 `user_id` int(100) NOT NULL,
 `payment_acc_code` varchar(100) DEFAULT NULL,
 `comment` text NOT NULL,
 `payment_type` varchar(20) DEFAULT NULL,
 `account` varchar(255) NOT NULL,
 `register_mode` varchar(200) NOT NULL,
 `receiving_date` date NOT NULL,
 `amount_due` double(10,4) NOT NULL,
 `description` text,
 `discount_value` double(10,4) DEFAULT NULL,
 `total_amount` decimal(10,4) NOT NULL,
 `paid` decimal(10,4) NOT NULL,
 
 `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 `total_tax` decimal(10,3) NOT NULL,
 `file` varchar(200) DEFAULT NULL,
 `due_date` date DEFAULT NULL,
 `business_address` text,
 `tax_id` int(11) DEFAULT NULL,
 `tax_rate` decimal(18,2) DEFAULT NULL,
 PRIMARY KEY (`receiving_id`),
 KEY `employee_id` (`employee_id`),
 KEY `invoice_no` (`invoice_no`),
 KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

CREATE TABLE `hjms_receivings_items` (
 `receivings_items_id` int(10) NOT NULL AUTO_INCREMENT,
 `receiving_id` int(10) NOT NULL DEFAULT '0',
 `invoice_no` varchar(100) NOT NULL,
 `item_id` int(10) NOT NULL DEFAULT '0',
 `account_code` varchar(100) DEFAULT NULL,
 `description` varchar(30) DEFAULT NULL,
 `serialnumber` varchar(30) DEFAULT NULL,
 `tax_id` int(10) DEFAULT '0',
 `tax_rate` decimal(10,0) DEFAULT '0',
 PRIMARY KEY (`receivings_items_id`),
 KEY `receiving_id` (`receiving_id`,`invoice_no`,`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;

ALTER TABLE `hjms_passengers` ADD `supplier_id` INT(11) NULL AFTER `moi_no`;
ALTER TABLE `hjms_receivings_items` ADD `visa_supplier_id` INT(11) NULL AFTER `tax_rate`;

ALTER TABLE `hjms_receivings_items` CHANGE `item_cost_price` `visa_cost` DECIMAL(20,3) NULL, CHANGE `item_unit_price` `ticket_cost` DOUBLE(20,3) NULL;
ALTER TABLE `hjms_receivings_items` ADD `hotel_cost` DECIMAL(20,3) NULL AFTER `ticket_cost`, ADD `other_cost` DECIMAL(20,3) NULL AFTER `hotel_cost`;
ALTER TABLE `hjms_receivings_items` ADD `ticket_supplier_id` INT(11) NULL AFTER `visa_supplier_id`;

CREATE TABLE `hjms_supplier_payments` (
 `id` int(100) NOT NULL AUTO_INCREMENT,
 `invoice_no` varchar(100) NOT NULL,
 `supplier_id` int(100) NOT NULL,
 `account_code` varchar(100) NOT NULL,
 `dueTo_acc_code` varchar(100) NOT NULL,
 `ref_account_id` int(20) DEFAULT '0' COMMENT 'its supplier id',
 `debit` double(15,4) NOT NULL,
 `credit` double(15,4) NOT NULL,
 `narration` text,
 `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 `date` date NOT NULL,
 `entry_id` int(20) DEFAULT NULL,
 `due_date` date DEFAULT NULL,
 `user_id` int(11) DEFAULT NULL,
 PRIMARY KEY (`id`),
 KEY `invoice_no` (`invoice_no`,`supplier_id`,`account_code`),
 KEY `ref_account_id` (`ref_account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

ALTER TABLE `hjms_receivings_items` ADD `ticket_pnr` VARCHAR(100) NULL AFTER `hotel_supplier_id`, ADD `ticket_no` VARCHAR(100) NULL AFTER `ticket_pnr`, ADD `paid` DECIMAL(30,2) NULL AFTER `ticket_no`;