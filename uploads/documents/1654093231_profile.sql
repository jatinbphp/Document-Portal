-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 01, 2022 at 09:31 AM
-- Server version: 5.7.37-0ubuntu0.18.04.1
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hseqssco_document`
--

-- --------------------------------------------------------

--
-- Table structure for table `DocumentsManage`
--

CREATE TABLE `DocumentsManage` (
  `id` int(11) NOT NULL,
  `docName` varchar(255) NOT NULL,
  `categoryID` int(11) NOT NULL,
  `subCategoryID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `companyID` int(50) NOT NULL,
  `docFile` varchar(100) NOT NULL,
  `is_user` int(11) NOT NULL DEFAULT '0',
  `isActive` int(11) NOT NULL DEFAULT '0',
  `expireDate` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `dateAdded` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `DocumentsManage`
--

INSERT INTO `DocumentsManage` (`id`, `docName`, `categoryID`, `subCategoryID`, `userID`, `companyID`, `docFile`, `is_user`, `isActive`, `expireDate`, `dateAdded`) VALUES
(1, 'test', 1, 1, 12, 4, '1654005459_profile.xlsx', 0, 1, '2022-05-31 13:57:39.214277', '0000-00-00 00:00:00'),
(2, 'ert', 2, 3, 12, 4, '1654005517_profile.xlsx', 0, 1, '2022-05-31 13:58:37.520098', '0000-00-00 00:00:00'),
(3, 'test123', 1, 1, 12, 4, '1654005612_profile.xlsx', 1, 1, '2022-05-31 14:00:12.951301', '0000-00-00 00:00:00'),
(4, 'erer', 2, 3, 12, 4, '1654005629_profile.xlsx', 1, 1, '2022-05-31 14:00:29.121198', '0000-00-00 00:00:00'),
(5, 'ert', 2, 3, 12, 4, '', 1, 0, '2022-06-03 18:30:00.000000', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `DocumentsManage`
--
ALTER TABLE `DocumentsManage`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `DocumentsManage`
--
ALTER TABLE `DocumentsManage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
