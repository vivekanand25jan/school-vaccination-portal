-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 14, 2025 at 02:28 AM
-- Server version: 5.6.35-log
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bits`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `bannerId` int(11) NOT NULL,
  `bannerName` varchar(200) NOT NULL,
  `writeuptxt` text,
  `bannerOrder` int(11) DEFAULT NULL,
  `bannerStatus` tinyint(1) NOT NULL DEFAULT '1',
  `bannerType` enum('Thumbnail','banner') NOT NULL DEFAULT 'banner'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `chef`
--

CREATE TABLE `chef` (
  `chefId` int(11) NOT NULL,
  `chefName` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `imageName` varchar(250) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `flag` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `drive`
--

CREATE TABLE `drive` (
  `driveId` int(11) NOT NULL,
  `vaccineId` int(11) NOT NULL,
  `drive_name` varchar(100) NOT NULL,
  `drive_start_date` varchar(20) NOT NULL,
  `drive_for_class` int(5) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `flag` tinyint(1) NOT NULL DEFAULT '0',
  `createdDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `drive`
--

INSERT INTO `drive` (`driveId`, `vaccineId`, `drive_name`, `drive_start_date`, `drive_for_class`, `status`, `flag`, `createdDate`) VALUES
(21, 9, 'FORCLASS12COVID2019', '20-05-2025', 12, 1, 0, '2025-05-14 06:13:13'),
(22, 11, 'DRIVEFORCLASS11', '14-05-2025', 11, 1, 0, '2025-05-14 02:03:26');

-- --------------------------------------------------------

--
-- Table structure for table `menucategory`
--

CREATE TABLE `menucategory` (
  `catId` int(11) NOT NULL,
  `catName` varchar(200) DEFAULT NULL,
  `flag` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `menuid` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `nameAr` varchar(200) DEFAULT NULL,
  `categoryId` int(11) DEFAULT NULL,
  `description` text,
  `descriptionAr` text,
  `image` varchar(255) DEFAULT NULL,
  `portion` varchar(100) DEFAULT NULL,
  `price` varchar(50) DEFAULT NULL,
  `addedDate` datetime DEFAULT NULL,
  `showOnhome` int(11) NOT NULL DEFAULT '0',
  `specialMenu` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `flag` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentId` int(11) NOT NULL,
  `student_first_name` varchar(20) NOT NULL,
  `student_last_name` varchar(20) NOT NULL,
  `class` enum('1','2','3','4','5','6','7','8','9','10','11','12') NOT NULL,
  `student_email` varchar(40) NOT NULL,
  `student_roll` varchar(10) NOT NULL,
  `student_gender` enum('M','F') NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `flag` tinyint(1) NOT NULL DEFAULT '0',
  `dateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentId`, `student_first_name`, `student_last_name`, `class`, `student_email`, `student_roll`, `student_gender`, `status`, `flag`, `dateCreated`) VALUES
(10, 'Vivekanand', 'pathak', '12', 'vivekanand.pathak25@gmail.com', 'BITS202401', 'M', 1, 0, '2025-05-14 05:12:08'),
(12, 'Kumar', 'Aditya', '11', 'aditya@gmail.com', 'CSE2025001', 'M', 1, 0, '2025-05-14 02:00:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `userEmail` varchar(100) NOT NULL,
  `userPass` varchar(255) NOT NULL,
  `userGender` enum('M','F') NOT NULL DEFAULT 'M',
  `userRole` varchar(20) NOT NULL,
  `userStatus` tinyint(1) NOT NULL DEFAULT '0',
  `userAddedDate` datetime NOT NULL,
  `userContact` int(11) NOT NULL,
  `picture` varchar(200) NOT NULL DEFAULT 'noimage.png',
  `flag` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `firstName`, `lastName`, `userName`, `userEmail`, `userPass`, `userGender`, `userRole`, `userStatus`, `userAddedDate`, `userContact`, `picture`, `flag`) VALUES
(1, 'Vivekanand', 'Pathak', 'vivekanand25', 'vivekanand.pathak25@gmail.com', 'e6e061838856bf47e1de730719fb2609', 'M', 'Admin', 1, '2020-10-22 11:22:39', 99107864, '2210201110391603351359.jpg', 1),
(2, 'Aditya', 'Kumar', 'aditya14', 'aditya.pathak25@gmail.com', 'aa892c37cdd5d77bee5655e74fd562a2', 'M', 'Manager', 1, '2020-10-17 09:43:00', 123456789, 'noimage.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vaccine`
--

CREATE TABLE `vaccine` (
  `vaccineId` int(11) NOT NULL,
  `vaccine_name` varchar(100) NOT NULL,
  `totalCount` int(5) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `flag` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vaccine`
--

INSERT INTO `vaccine` (`vaccineId`, `vaccine_name`, `totalCount`, `createdDate`, `status`, `flag`) VALUES
(9, 'COVID2019', 9, '2025-05-14 04:10:10', 1, 0),
(11, 'VACCINEFORCLASS11', 29, '2025-05-14 02:01:58', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `vaccine_registration`
--

CREATE TABLE `vaccine_registration` (
  `vaccine_register_id` int(11) NOT NULL,
  `studentId` int(11) NOT NULL,
  `vaccineId` int(11) NOT NULL,
  `driveId` int(11) NOT NULL,
  `flag` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `createdDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vaccine_registration`
--

INSERT INTO `vaccine_registration` (`vaccine_register_id`, `studentId`, `vaccineId`, `driveId`, `flag`, `status`, `createdDate`) VALUES
(20, 12, 11, 22, 0, 1, '2025-05-14 02:06:00'),
(21, 10, 9, 21, 0, 1, '2025-05-14 02:07:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`bannerId`);

--
-- Indexes for table `chef`
--
ALTER TABLE `chef`
  ADD PRIMARY KEY (`chefId`);

--
-- Indexes for table `drive`
--
ALTER TABLE `drive`
  ADD PRIMARY KEY (`driveId`),
  ADD UNIQUE KEY `drivename` (`drive_name`);

--
-- Indexes for table `menucategory`
--
ALTER TABLE `menucategory`
  ADD PRIMARY KEY (`catId`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`menuid`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentId`),
  ADD UNIQUE KEY `roolNumber` (`student_roll`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `username` (`userName`);

--
-- Indexes for table `vaccine`
--
ALTER TABLE `vaccine`
  ADD PRIMARY KEY (`vaccineId`),
  ADD UNIQUE KEY `vaccine_name` (`vaccine_name`);

--
-- Indexes for table `vaccine_registration`
--
ALTER TABLE `vaccine_registration`
  ADD PRIMARY KEY (`vaccine_register_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `bannerId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `chef`
--
ALTER TABLE `chef`
  MODIFY `chefId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `drive`
--
ALTER TABLE `drive`
  MODIFY `driveId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `menucategory`
--
ALTER TABLE `menucategory`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `menuid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `vaccine`
--
ALTER TABLE `vaccine`
  MODIFY `vaccineId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `vaccine_registration`
--
ALTER TABLE `vaccine_registration`
  MODIFY `vaccine_register_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
