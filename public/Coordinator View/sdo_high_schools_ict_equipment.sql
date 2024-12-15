-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2024 at 04:27 PM
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
-- Database: `sdo_high_schools_ict_equipment`
--

-- --------------------------------------------------------

--
-- Table structure for table `high_schools`
--

CREATE TABLE `high_schools` (
  `school_id` int(11) NOT NULL,
  `school_name` varchar(50) NOT NULL,
  `school_division` varchar(50) NOT NULL,
  `school_type` varchar(50) NOT NULL,
  `school_contact` varchar(50) NOT NULL,
  `school_contact_no` varchar(50) NOT NULL,
  `school_email` varchar(50) NOT NULL,
  `school_district` varchar(50) NOT NULL,
  `school_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `high_schools`
--

INSERT INTO `high_schools` (`school_id`, `school_name`, `school_division`, `school_type`, `school_contact`, `school_contact_no`, `school_email`, `school_district`, `school_added`) VALUES
(123123, 'Tennis National Shool', 'DCS-Valenzuela', 'Private School', 'Felix Kjellberg', 'sdsds', 'dnhs@yahoo.com', 'Congressional I', '2024-04-01 13:11:39'),
(1232134, 'hgfyfgh', 'DCS-Valenzuela', 'Public School', 'Satoru Gojo', '34343435', 'plvregistrar@plv.edu.ph', 'Congressional I', '2024-04-12 03:46:42');

-- --------------------------------------------------------

--
-- Table structure for table `profile_edit_requests`
--

CREATE TABLE `profile_edit_requests` (
  `request_id` int(11) NOT NULL,
  `request_name` varchar(50) NOT NULL,
  `request_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `request_status` varchar(10) NOT NULL,
  `new_username` varchar(50) NOT NULL,
  `new_email` varchar(50) NOT NULL,
  `new_contact` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profile_edit_requests`
--

INSERT INTO `profile_edit_requests` (`request_id`, `request_name`, `request_date`, `request_status`, `new_username`, `new_email`, `new_contact`) VALUES
(11, 'Spider-Maninasal', '2024-03-31 03:52:48', 'Approved', 'Spider-Maninasal', 'ligma', 'e'),
(12, 'jollibee', '2024-03-31 15:05:45', 'Denied', 'jollibee', 'alright', '313131'),
(13, 'Spider-Maninasal', '2024-03-31 15:07:42', 'Approved', 'Spider-Maninasal', 'Avenger@fmail.com', '0'),
(14, 'ds', '2024-03-31 15:08:09', 'Approved', 'ds', '', '0'),
(15, 'Spider-Maninasal', '2024-03-31 15:10:10', 'Approved', 'Spider-Maninasal', 'Avenger@fmail.com', '0'),
(16, 'Spider-Maninasal', '2024-03-31 15:12:04', 'Approved', 'Spider-Maninasal', 'ligma', '0'),
(17, 'Spider-Maninasal', '2024-03-31 15:14:50', 'Approved', 'Spider-Maninasal', 'ligma', '0'),
(18, 'son goku', '2024-03-31 15:16:54', 'Approved', 'son goku', 'ligma', '0'),
(19, 'fdfdf', '2024-03-31 15:24:49', 'Approved', 'fdfdf', '', '0'),
(20, '32232', '2024-03-31 15:38:06', 'Approved', '32232', '', '0'),
(21, '32232', '2024-03-31 15:59:14', 'Approved', '32232', 'sasasa', '0'),
(22, 'joe edmar', '2024-04-01 09:34:17', 'Approved', 'joe edmar', 'sasasa', '0'),
(23, 'joe ', '2024-04-18 07:56:35', 'Approved', 'joe ', 'sasasa', '0'),
(24, 'joe edmar', '2024-04-18 07:57:46', 'Pending', 'joe edmar', 'sasasa', '0');

-- --------------------------------------------------------

--
-- Table structure for table `school_inventory`
--

CREATE TABLE `school_inventory` (
  `item_code` int(5) NOT NULL,
  `school_id` int(11) NOT NULL,
  `item_article` varchar(50) NOT NULL,
  `item_desc` varchar(50) NOT NULL,
  `item_date_acquired` date NOT NULL,
  `item_date_input` timestamp NOT NULL DEFAULT current_timestamp(),
  `item_unit_value` decimal(10,2) NOT NULL,
  `item_quantity` decimal(10,0) NOT NULL,
  `item_total_value` decimal(10,2) NOT NULL,
  `item_funds_source` varchar(50) NOT NULL,
  `item_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school_inventory`
--

INSERT INTO `school_inventory` (`item_code`, `school_id`, `item_article`, `item_desc`, `item_date_acquired`, `item_date_input`, `item_unit_value`, `item_quantity`, `item_total_value`, `item_funds_source`, `item_status`) VALUES
(1298, 123123, 'Drum Set', 'NIKE 10', '2024-04-05', '2024-04-04 13:35:45', 250.00, 3, 0.00, 'DepEd Main', 'Condemned'),
(1306, 123123, 'Drum Set', '', '0000-00-00', '2024-04-16 05:41:46', 0.00, 0, 0.00, 'e', 'Need Repair'),
(1310, 123123, '', '', '0000-00-00', '2024-04-18 07:52:22', 0.00, 0, 0.00, '', 'Working'),
(1311, 1232134, '', '', '0000-00-00', '2024-04-19 01:08:13', 0.00, 0, 0.00, '', 'Working'),
(1312, 1232134, '', '', '0000-00-00', '2024-04-19 01:08:23', 0.00, 0, 0.00, '', 'Need Repair');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_pass` varchar(50) NOT NULL,
  `school_name` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `school_id` int(11) NOT NULL,
  `user_contact` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_pass`, `school_name`, `user_email`, `school_id`, `user_contact`) VALUES
(0, 'joe ', '[value-3]', '[value-4]', 'sasasa', 123213, 0),
(1223, 'fdfdf', '[value-3]', '[value-4]', '', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `high_schools`
--
ALTER TABLE `high_schools`
  ADD PRIMARY KEY (`school_id`);

--
-- Indexes for table `profile_edit_requests`
--
ALTER TABLE `profile_edit_requests`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `school_inventory`
--
ALTER TABLE `school_inventory`
  ADD PRIMARY KEY (`item_code`),
  ADD KEY `fk_school_inventory_school_id` (`school_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `profile_edit_requests`
--
ALTER TABLE `profile_edit_requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `school_inventory`
--
ALTER TABLE `school_inventory`
  MODIFY `item_code` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1313;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `school_inventory`
--
ALTER TABLE `school_inventory`
  ADD CONSTRAINT `fk_school_inventory_school_id` FOREIGN KEY (`school_id`) REFERENCES `high_schools` (`school_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
