-- phpMyAdmin SQL Dump
-- version 4.9.10
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 06, 2022 at 04:29 AM
-- Server version: 8.0.29-0ubuntu0.20.04.3
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `unitedcanada`
--

-- --------------------------------------------------------

--
-- Table structure for table `Categories`
--

CREATE TABLE `Categories` (
  `id` int NOT NULL,
  `parentCategoryID` int NOT NULL DEFAULT '0',
  `categoryName` varchar(255) DEFAULT NULL,
  `categoryDescription` text,
  `categoryImage` varchar(255) DEFAULT NULL,
  `attributesIDs` varchar(255) DEFAULT '0',
  `isActive` int NOT NULL DEFAULT '1',
  `dateAdded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Categories`
--

INSERT INTO `Categories` (`id`, `parentCategoryID`, `categoryName`, `categoryDescription`, `categoryImage`, `attributesIDs`, `isActive`, `dateAdded`) VALUES
(1, 0, 'Hot and Cold Therapies', '', '', '1,2', 0, '2022-05-09 15:05:13'),
(4, 0, 'Safety Gear', '', '', '7,1', 0, '2022-05-19 17:17:19'),
(5, 4, 'Gloves', '', '', '1,2', 0, '2022-05-19 17:18:15'),
(6, 5, 'Vinyl Gloves', '', '', '5,6,2', 0, '2022-05-19 17:18:54'),
(7, 0, 'Medical Supplies', '', '', '7,1', 0, '2022-05-19 19:38:58'),
(8, 7, 'Face Masks', '', '', '7,2', 0, '2022-05-19 19:39:10');

-- --------------------------------------------------------

--
-- Table structure for table `categoryPath`
--

CREATE TABLE `categoryPath` (
  `category_id` int NOT NULL,
  `path_id` int NOT NULL,
  `level` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `categoryPath`
--

INSERT INTO `categoryPath` (`category_id`, `path_id`, `level`) VALUES
(1, 1, 0),
(4, 4, 0),
(5, 4, 0),
(5, 5, 1),
(6, 4, 0),
(6, 5, 1),
(6, 6, 2),
(7, 7, 0),
(8, 7, 0),
(8, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Customers`
--

CREATE TABLE `Customers` (
  `id` int NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `dateadd` date DEFAULT NULL,
  `firstName` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `lastName` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `filedata` varchar(200) DEFAULT NULL,
  `billadd` varchar(200) DEFAULT NULL,
  `shipadd` varchar(200) DEFAULT NULL,
  `lsorder` varchar(200) DEFAULT NULL,
  `totalsp` varchar(200) DEFAULT NULL,
  `avgorder` varchar(200) DEFAULT NULL,
  `lastLogin` datetime DEFAULT CURRENT_TIMESTAMP,
  `dateAdded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `Customers`
--

INSERT INTO `Customers` (`id`, `email`, `dateadd`, `firstName`, `lastName`, `filedata`, `billadd`, `shipadd`, `lsorder`, `totalsp`, `avgorder`, `lastLogin`, `dateAdded`) VALUES
(1, 'kianvp@gmail.com', '1989-11-11', 'George', 'Butterfield', NULL, ' 150 Silver Ave.', ' 240 Shipping St.', '300', '500', '1000', '2022-05-09 04:04:06', '2022-05-09 04:04:06');

-- --------------------------------------------------------

--
-- Table structure for table `DeliveryMethods`
--

CREATE TABLE `DeliveryMethods` (
  `id` int NOT NULL,
  `delivery_method` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `DeliveryMethods`
--

INSERT INTO `DeliveryMethods` (`id`, `delivery_method`) VALUES
(1, 'COD'),
(2, 'Courier');

-- --------------------------------------------------------

--
-- Table structure for table `FulfillStatus`
--

CREATE TABLE `FulfillStatus` (
  `id` int NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `FulfillStatus`
--

INSERT INTO `FulfillStatus` (`id`, `status`) VALUES
(1, 'All'),
(2, 'Unfulfilled'),
(3, 'Unpaid'),
(4, 'Closed (Paid)');

-- --------------------------------------------------------

--
-- Table structure for table `LotNumbers`
--

CREATE TABLE `LotNumbers` (
  `id` int NOT NULL,
  `productID` int NOT NULL,
  `LotNumber` varchar(255) DEFAULT NULL,
  `sku` varchar(150) DEFAULT NULL,
  `quantity` varchar(200) DEFAULT NULL,
  `DateReceived` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `LotNumbers`
--

INSERT INTO `LotNumbers` (`id`, `productID`, `LotNumber`, `sku`, `quantity`, `DateReceived`) VALUES
(1, 1, '123', '123', '1', '2022-05-11 10:04:00'),
(2, 10, '1200', 'UCCURCA4135R', '1200', '2022-05-23 18:20:00'),
(3, 1, '50', '123', '200', '2022-05-27 00:03:00');

-- --------------------------------------------------------

--
-- Table structure for table `Orders`
--

CREATE TABLE `Orders` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `user_type_id` int NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `paymentStatus` int DEFAULT NULL,
  `fulfillStatus` int DEFAULT NULL,
  `numofItems` int DEFAULT NULL,
  `deliveryMethod` int NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `PaymentStatus`
--

CREATE TABLE `PaymentStatus` (
  `id` int NOT NULL,
  `Status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `PaymentStatus`
--

INSERT INTO `PaymentStatus` (`id`, `Status`) VALUES
(1, 'Paid'),
(2, 'Unpaid');

-- --------------------------------------------------------

--
-- Table structure for table `ProductAttributeData`
--

CREATE TABLE `ProductAttributeData` (
  `id` int NOT NULL,
  `categoryId` int NOT NULL,
  `product_id` int NOT NULL,
  `productAttributeID` varchar(255) DEFAULT NULL,
  `attributeValue` varchar(255) DEFAULT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isActive` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ProductAttributeData`
--

INSERT INTO `ProductAttributeData` (`id`, `categoryId`, `product_id`, `productAttributeID`, `attributeValue`, `dateAdded`, `isActive`) VALUES
(1, 1, 1, '1', NULL, '2022-05-30 09:17:09', 1),
(2, 1, 1, '2', NULL, '2022-05-30 09:17:09', 1),
(3, 7, 18, '1', NULL, '2022-05-30 11:48:30', 1),
(4, 7, 18, '7', NULL, '2022-05-30 11:48:30', 1),
(5, 6, 10, '2', NULL, '2022-05-30 12:02:28', 1),
(6, 6, 10, '5', NULL, '2022-05-30 12:02:28', 1),
(7, 6, 10, '6', NULL, '2022-05-30 12:02:28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ProductAttributeData_temp`
--

CREATE TABLE `ProductAttributeData_temp` (
  `id` int NOT NULL,
  `categoryId` int NOT NULL,
  `product_id` int NOT NULL,
  `productAttributeID` varchar(255) DEFAULT NULL,
  `attributeValue` varchar(255) DEFAULT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isActive` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ProductAttributes`
--

CREATE TABLE `ProductAttributes` (
  `id` int NOT NULL,
  `attributeName` varchar(255) DEFAULT NULL,
  `attributeType` varchar(255) DEFAULT NULL,
  `categoryId` varchar(255) DEFAULT NULL,
  `isActive` int NOT NULL DEFAULT '1',
  `dateAdded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ProductAttributes`
--

INSERT INTO `ProductAttributes` (`id`, `attributeName`, `attributeType`, `categoryId`, `isActive`, `dateAdded`) VALUES
(1, 'Color', 'dropdown', NULL, 1, '2022-05-09 15:04:54'),
(2, 'Size', 'textbox', NULL, 1, '2022-05-18 01:48:13'),
(5, 'Hello', 'checkbox', NULL, 1, '2022-05-19 16:48:50'),
(6, 'Shape', 'dropdown', NULL, 1, '2022-05-19 19:26:39'),
(7, 'Amount', 'textbox', NULL, 1, '2022-05-19 19:32:39');

-- --------------------------------------------------------

--
-- Table structure for table `ProductAttributesValues`
--

CREATE TABLE `ProductAttributesValues` (
  `id` int NOT NULL,
  `productAttributeID` int NOT NULL DEFAULT '0',
  `attributeValues` varchar(255) DEFAULT NULL,
  `attributeImage` varchar(255) DEFAULT NULL,
  `isActive` int NOT NULL DEFAULT '1',
  `dateAdded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ProductAttributesValues`
--

INSERT INTO `ProductAttributesValues` (`id`, `productAttributeID`, `attributeValues`, `attributeImage`, `isActive`, `dateAdded`) VALUES
(11, 2, 'Large', '', 1, '2022-05-19 02:34:23'),
(12, 2, 'Medium', '', 1, '2022-05-19 02:34:23'),
(13, 2, 'Small', '', 1, '2022-05-19 02:34:23'),
(14, 3, 'Hello!', '', 1, '2022-05-19 16:48:03'),
(15, 4, 'Hello!', '', 1, '2022-05-19 16:48:29'),
(16, 5, 'Testing', '', 1, '2022-05-19 16:48:50'),
(20, 6, 'Circle', '', 1, '2022-05-19 19:26:39'),
(21, 6, 'Rectangle', '', 1, '2022-05-19 19:26:39'),
(22, 6, 'Triangle', '', 1, '2022-05-19 19:26:39'),
(23, 7, 'Pack of 2', '', 1, '2022-05-19 19:32:39'),
(24, 7, 'Case of 50 ', '', 1, '2022-05-19 19:32:39'),
(25, 1, 'Black', '', 1, '2022-05-20 04:25:38'),
(26, 1, 'Red', '', 1, '2022-05-20 04:25:38'),
(27, 1, 'Blue', '', 1, '2022-05-20 04:25:38'),
(28, 1, 'Pink', '', 1, '2022-05-20 04:25:38');

-- --------------------------------------------------------

--
-- Table structure for table `ProductAttrubuteVariation`
--

CREATE TABLE `ProductAttrubuteVariation` (
  `id` int NOT NULL,
  `product_id` int DEFAULT NULL,
  `attribute_id` int DEFAULT NULL,
  `attribute_value` text,
  `sku` varchar(255) DEFAULT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `msrp` decimal(11,2) DEFAULT NULL,
  `barcode` text,
  `lotNumber` int NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ProductAttrubuteVariation`
--

INSERT INTO `ProductAttrubuteVariation` (`id`, `product_id`, `attribute_id`, `attribute_value`, `sku`, `price`, `msrp`, `barcode`, `lotNumber`, `image`, `created_at`) VALUES
(33, 10, NULL, '{\"1\":\"26\",\"2\":\"78\",\"6\":\"21\",\"7\":\"678\"}', 'Size78', '600.00', '650.00', 'Size78', 0, '', '2022-05-30 12:06:08'),
(34, 18, NULL, '{\"1\":\"28\",\"7\":\"400\"}', 'pink400', '500.00', '550.00', 'Size500', 0, '', '2022-05-30 12:08:03'),
(38, 18, NULL, '{\"1\":\"25\",\"7\":\"78\"}', 'black78', '800.00', '850.00', 'Black78', 0, '', '2022-05-30 12:24:31'),
(39, 10, NULL, '{\"1\":\"27\",\"2\":\"56\",\"6\":\"22\",\"7\":\"67\"}', 'Blue67', '800.00', '850.00', 'Blue67', 0, '', '2022-05-30 12:30:27'),
(40, 1, NULL, '{\"1\":\"27\",\"2\":\"45\"}', 'Blue45', '600.00', '650.00', 'BLUE600', 0, '', '2022-05-30 13:00:30'),
(41, 1, NULL, '{\"1\":\"26\",\"2\":\"12\"}', '12', '120.00', '120.00', '120120', 0, '', '2022-06-03 11:57:17');

-- --------------------------------------------------------

--
-- Table structure for table `ProductAttrubuteVariation_temp`
--

CREATE TABLE `ProductAttrubuteVariation_temp` (
  `id` int NOT NULL,
  `product_id` int DEFAULT NULL,
  `attribute_id` int DEFAULT NULL,
  `attribute_value` text,
  `sku` varchar(255) DEFAULT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `msrp` decimal(11,2) DEFAULT NULL,
  `barcode` text,
  `lotNumber` int NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ProductImages`
--

CREATE TABLE `ProductImages` (
  `id` int NOT NULL,
  `productID` int NOT NULL DEFAULT '0',
  `productImage` varchar(255) DEFAULT NULL,
  `mainImage` varchar(255) DEFAULT NULL,
  `isActive` int NOT NULL DEFAULT '1',
  `dateAdded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ProductImages`
--

INSERT INTO `ProductImages` (`id`, `productID`, `productImage`, `mainImage`, `isActive`, `dateAdded`) VALUES
(1, 1, '1652927511_product.jpeg', '', 1, '2022-05-19 02:31:51'),
(11, 10, '1653889461_product.jpg', '', 1, '2022-05-30 05:44:21'),
(13, 1, '1653915630_product.jpg', '', 1, '2022-05-30 13:00:30');

-- --------------------------------------------------------

--
-- Table structure for table `ProductImages_temp`
--

CREATE TABLE `ProductImages_temp` (
  `id` int NOT NULL,
  `productID` int NOT NULL DEFAULT '0',
  `productImage` varchar(255) DEFAULT NULL,
  `mainImage` varchar(255) DEFAULT NULL,
  `isActive` int NOT NULL DEFAULT '1',
  `dateAdded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ProductImages_temp`
--

INSERT INTO `ProductImages_temp` (`id`, `productID`, `productImage`, `mainImage`, `isActive`, `dateAdded`) VALUES
(2, 12, '1653474137_product.png', '', 1, '2022-05-25 10:22:17'),
(3, 13, '1653485004_product.png', '', 1, '2022-05-25 13:23:24');

-- --------------------------------------------------------

--
-- Table structure for table `ProductInventory`
--

CREATE TABLE `ProductInventory` (
  `id` int NOT NULL,
  `productID` int NOT NULL DEFAULT '0',
  `available` int NOT NULL DEFAULT '0',
  `incoming` int NOT NULL DEFAULT '0' COMMENT 'stock',
  `backordered` int NOT NULL DEFAULT '0',
  `lot_number_id` int DEFAULT NULL,
  `sku` varchar(255) NOT NULL,
  `dateAdded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ProductInventory`
--

INSERT INTO `ProductInventory` (`id`, `productID`, `available`, `incoming`, `backordered`, `lot_number_id`, `sku`, `dateAdded`) VALUES
(1, 1, 5, 10, 0, 1, '123', '2022-05-11 19:19:24'),
(6, 1, 10, 5, 5, 1, '', '2022-05-23 13:36:19');

-- --------------------------------------------------------

--
-- Table structure for table `ProductInventoryData`
--

CREATE TABLE `ProductInventoryData` (
  `id` int NOT NULL,
  `productID` int NOT NULL,
  `incomqty` int NOT NULL,
  `price` varchar(255) NOT NULL,
  `costPrice` int NOT NULL,
  `eta` varchar(255) NOT NULL,
  `dateOrdered` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `warLocation` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ProductInventoryData`
--

INSERT INTO `ProductInventoryData` (`id`, `productID`, `incomqty`, `price`, `costPrice`, `eta`, `warLocation`) VALUES
(61, 1, 45, '56', 678, 'testing', 'surat'),
(62, 1, 67, '400', 500, 'test', 'ahm');

-- --------------------------------------------------------

--
-- Table structure for table `productOptions`
--

CREATE TABLE `productOptions` (
  `productAttributeId` int NOT NULL,
  `productId` int NOT NULL DEFAULT '0',
  `attributeId` int NOT NULL DEFAULT '0',
  `value` text,
  `required` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `productOptionsValues`
--

CREATE TABLE `productOptionsValues` (
  `productOptionValueId` int NOT NULL,
  `productOptionId` int NOT NULL,
  `productId` int NOT NULL,
  `optionId` int NOT NULL,
  `optionValueId` int NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `pricePrefix` varchar(1) NOT NULL,
  `isActive` int NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `ProductPricing`
--

CREATE TABLE `ProductPricing` (
  `id` int NOT NULL,
  `productID` int NOT NULL DEFAULT '0',
  `userID` int NOT NULL DEFAULT '0',
  `price` decimal(15,2) NOT NULL DEFAULT '0.00',
  `discountPercentage` decimal(15,2) NOT NULL DEFAULT '0.00',
  `dateAdded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ProductPricing`
--

INSERT INTO `ProductPricing` (`id`, `productID`, `userID`, `price`, `discountPercentage`, `dateAdded`) VALUES
(1, 1, 2, '19.99', '5.00', '2022-05-19 19:37:38');

-- --------------------------------------------------------

--
-- Table structure for table `Products`
--

CREATE TABLE `Products` (
  `id` int NOT NULL,
  `categoryID` varchar(255) DEFAULT NULL,
  `productAttributeID` int NOT NULL DEFAULT '0',
  `productName` varchar(255) DEFAULT NULL,
  `productDescription` text,
  `productDescription1` text,
  `descriptionTitle1` varchar(100) NOT NULL,
  `descriptionTitle2` varchar(100) NOT NULL,
  `productImage` varchar(255) DEFAULT NULL,
  `supplierCode` varchar(100) NOT NULL,
  `countryofOrigin` varchar(100) NOT NULL,
  `msrp` decimal(15,2) NOT NULL DEFAULT '0.00',
  `size_small_msrp` decimal(15,2) DEFAULT NULL,
  `price` decimal(15,2) NOT NULL DEFAULT '0.00',
  `lotNumber` varchar(255) DEFAULT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `barcodeNumber` varchar(255) DEFAULT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `is_taxable` tinyint(1) NOT NULL DEFAULT '0',
  `is_TrackLotnumber` int NOT NULL DEFAULT '0',
  `manufacturer` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_general_ci DEFAULT NULL,
  `isActive` int NOT NULL DEFAULT '1',
  `dateAdded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Products`
--

INSERT INTO `Products` (`id`, `categoryID`, `productAttributeID`, `productName`, `productDescription`, `productDescription1`, `descriptionTitle1`, `descriptionTitle2`, `productImage`, `supplierCode`, `countryofOrigin`, `msrp`, `size_small_msrp`, `price`, `lotNumber`, `barcode`, `barcodeNumber`, `sku`, `is_taxable`, `is_TrackLotnumber`, `manufacturer`, `isActive`, `dateAdded`) VALUES
(1, '1', 0, 'COLD AND HOT GEL PACK REUSABLE COMPRESS ', 'Rapid Relief Reusable Hot & Cold Compress helps treat everything from sports injuries to headaches to general aches and pains.\r\nThe Contour-Gel molds to the body even when frozen, and is aesthetically recognized by patients as one of the industry standards for relieving pain from bumps and bruises. It is freezable, microwavable and non-toxic.', 'Rapid Relief Reusable Hot & Cold Compress helps treat everything from sports injuries to headaches to general aches and pains.\r\nThe Contour-Gel molds to the body even when frozen, and is aesthetically recognized by patients as one of the industry standards for relieving pain from bumps and bruises. It is freezable, microwavable and non-toxic.', 'Description', 'Description 2', '1652109259_product.jpg', '', '', '0.00', '0.00', '0.00', NULL, '', '', '', 1, 0, 'RAPID AID', 1, '2022-05-09 15:14:19'),
(10, '6', 0, 'BASIC CARE VINYL GLOVES', 'sfsdf', 'dfdsf', 'TEST', 'TESTB', '', '', '', '0.00', '0.00', '0.00', NULL, '', '', '', 1, 0, 'CURAD', 1, '2022-05-19 19:25:31');

-- --------------------------------------------------------

--
-- Table structure for table `Products_temp`
--

CREATE TABLE `Products_temp` (
  `id` int NOT NULL,
  `pid` int NOT NULL,
  `categoryID` varchar(255) DEFAULT NULL,
  `productAttributeID` int NOT NULL DEFAULT '0',
  `productName` varchar(255) DEFAULT NULL,
  `productDescription` text,
  `productDescription1` text,
  `descriptionTitle1` varchar(100) NOT NULL,
  `descriptionTitle2` varchar(100) NOT NULL,
  `productImage` varchar(255) DEFAULT NULL,
  `supplierCode` varchar(100) NOT NULL,
  `countryofOrigin` varchar(100) NOT NULL,
  `msrp` decimal(15,2) NOT NULL DEFAULT '0.00',
  `size_small_msrp` decimal(15,2) DEFAULT NULL,
  `price` decimal(15,2) NOT NULL DEFAULT '0.00',
  `lotNumber` varchar(255) DEFAULT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `barcodeNumber` varchar(255) DEFAULT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `is_taxable` tinyint(1) NOT NULL DEFAULT '0',
  `is_TrackLotnumber` int NOT NULL DEFAULT '0',
  `manufacturer` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_general_ci DEFAULT NULL,
  `isActive` int NOT NULL DEFAULT '1',
  `dateAdded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Products_temp`
--

INSERT INTO `Products_temp` (`id`, `pid`, `categoryID`, `productAttributeID`, `productName`, `productDescription`, `productDescription1`, `descriptionTitle1`, `descriptionTitle2`, `productImage`, `supplierCode`, `countryofOrigin`, `msrp`, `size_small_msrp`, `price`, `lotNumber`, `barcode`, `barcodeNumber`, `sku`, `is_taxable`, `is_TrackLotnumber`, `manufacturer`, `isActive`, `dateAdded`) VALUES
(3, 12, '1', 0, 'testing', 'fdfdfd', 'dfdf', 'Description1', 'Description2', '', '', '', '0.00', '0.00', '0.00', NULL, '', '', '', 0, 0, 'testing456', 1, '2022-05-25 10:22:17'),
(4, 0, '7', 0, 'test234', 'sfdsfs', 'sdfdsf', 'Description1', 'Description2', '', '', '', '0.00', '0.00', '0.00', NULL, '', '', '', 0, 0, 'ewewe', 1, '2022-05-25 13:20:21'),
(6, 13, '7', 0, 'test345', 'sfdsfs', 'sdfdsf', 'Description1', 'Description2', '', '', '', '0.00', '0.00', '0.00', NULL, '', '', '', 0, 0, 'ewewe', 1, '2022-05-25 13:23:24'),
(17, 17, '1', 0, 'Testing', 'TESting ', 'testing', 'Description1', 'Description2', '', '', '', '0.00', '0.00', '0.00', NULL, '', '', '', 0, 0, 'test case', 1, '2022-05-30 05:58:26');

-- --------------------------------------------------------

--
-- Table structure for table `project_options`
--

CREATE TABLE `project_options` (
  `id` int NOT NULL,
  `po_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_general_ci DEFAULT NULL,
  `po_logo` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_general_ci DEFAULT NULL,
  `po_logo_small` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_options`
--

INSERT INTO `project_options` (`id`, `po_name`, `po_logo`, `po_logo_small`) VALUES
(1, 'United Canada', 'logo-big.png', 'logo_small.png');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int NOT NULL,
  `descTitle1` varchar(100) NOT NULL,
  `descTitle2` varchar(100) NOT NULL,
  `dateadded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `descTitle1`, `descTitle2`) VALUES
(1, 'Description', 'Description 2');

-- --------------------------------------------------------

--
-- Table structure for table `SubCategories`
--

CREATE TABLE `SubCategories` (
  `id` int NOT NULL,
  `subCategoryName` varchar(255) DEFAULT NULL,
  `categoryID` int NOT NULL DEFAULT '0',
  `subCategoryImage` varchar(255) DEFAULT NULL,
  `attributesIDs` varchar(255) DEFAULT NULL,
  `isActive` int NOT NULL DEFAULT '1',
  `dateAdded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `SubSubCategories`
--

CREATE TABLE `SubSubCategories` (
  `id` int NOT NULL,
  `subCategoryName` varchar(255) DEFAULT NULL,
  `subCategoryID` int NOT NULL DEFAULT '0',
  `subCategoryImage` varchar(255) DEFAULT NULL,
  `attributesIDs` varchar(255) DEFAULT NULL,
  `isActive` int NOT NULL DEFAULT '1',
  `dateAdded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `id` int NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `pwd` varchar(255) DEFAULT NULL,
  `userTypeID` int NOT NULL DEFAULT '0',
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `profilePic` varchar(255) DEFAULT NULL,
  `isActive` int NOT NULL DEFAULT '1',
  `randomCode` varchar(255) NOT NULL,
  `companyName` varchar(255) NOT NULL,
  `birthDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `billingAddress` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `shippingAddress` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `lastLogin` datetime DEFAULT CURRENT_TIMESTAMP,
  `dateAdded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`id`, `email`, `pwd`, `userTypeID`, `firstName`, `lastName`, `profilePic`, `isActive`, `randomCode`, `companyName`, `birthDate`, `billingAddress`, `shippingAddress`, `lastLogin`, `dateAdded`) VALUES
(1, 'shahid@unitedcanada.ecnet.dev', 'f3224d90c778d5e456b49c75f85dd668', 1, 'Shahid', 'Jumma', NULL, 1, '', '', '2022-06-02 05:57:55', '', '', '2022-06-03 10:12:50', '2021-12-15 11:41:37'),
(2, 'jessica@unitedcanadainc.com', 'ea527706d8a58104b0d7b3119817d706', 1, 'Jessica', 'Portillo', '', 1, '', '', '2022-06-02 05:57:55', '', '', '2022-05-16 03:04:45', '2022-05-06 16:01:52'),
(3, 'kianvp@gmail.com', '3d0ea1118cedb64ed995bf3e6877db2d', 2, 'testacc', 'testingacc', '', 1, '', '', '2022-06-02 05:57:55', '', '', '2022-05-09 03:55:16', '2022-05-09 03:55:16'),
(6, 'lorensmith@gmail.com', '25f9e794323b453885f5181f1b624d0b', 5, 'Loren', 'Smith', NULL, 1, '', '', '2022-06-02 05:57:55', '', '', '2022-05-31 03:45:57', '2022-05-31 15:45:40'),
(7, 'jameswilliams@ymail.com', '25f9e794323b453885f5181f1b624d0b', 5, 'james', 'Smith', '', 1, '', '', '2022-06-02 05:57:55', '', '', '2022-05-31 04:47:19', '2022-05-31 16:33:29'),
(9, 'united@developer.com', '1bbd886460827015e5d605ed44252251', 5, 'United', 'Canada', '', 1, '', '', '2022-06-02 05:57:55', '', '', '2022-05-31 04:58:16', '2022-05-31 16:54:02'),
(10, 'kian@ecnetsolutions.ca', '3d0ea1118cedb64ed995bf3e6877db2d', 5, 'kian', 'kian', NULL, 1, '', '', '2022-06-02 05:57:55', '', '', '2022-05-31 10:28:47', '2022-05-31 22:25:00'),
(13, 'jass@gmail.com', 'd27d320c27c3033b7883347d8beca317', 5, 'jass', 'jass', '1654253662_profile.png   ', 1, 'Zl8Bw5Gq7YrQ9TfC', 'nxsol', '2022-06-30 00:00:00', '102 Shivalik Plaza', '504 Shivalik Plaza', '2022-06-06 04:08:05', '2022-06-01 12:42:17'),
(14, 'support@ecnetsolutions.ca', '3d0ea1118cedb64ed995bf3e6877db2d', 5, 'Kian', 'test2', NULL, 1, '', '', '2022-06-02 05:57:55', '', '', '2022-06-01 09:10:15', '2022-06-01 21:10:11');

-- --------------------------------------------------------

--
-- Table structure for table `UserTypes`
--

CREATE TABLE `UserTypes` (
  `id` int NOT NULL,
  `userTypeName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `UserTypes`
--

INSERT INTO `UserTypes` (`id`, `userTypeName`) VALUES
(1, 'Adminstrator'),
(2, 'Account Manager'),
(3, 'Sales Representative'),
(4, 'Billing Administrator'),
(5, 'Customers');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Categories`
--
ALTER TABLE `Categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categoryPath`
--
ALTER TABLE `categoryPath`
  ADD PRIMARY KEY (`category_id`,`path_id`);

--
-- Indexes for table `Customers`
--
ALTER TABLE `Customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `DeliveryMethods`
--
ALTER TABLE `DeliveryMethods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `FulfillStatus`
--
ALTER TABLE `FulfillStatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `LotNumbers`
--
ALTER TABLE `LotNumbers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `PaymentStatus`
--
ALTER TABLE `PaymentStatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ProductAttributeData`
--
ALTER TABLE `ProductAttributeData`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ProductAttributeData_temp`
--
ALTER TABLE `ProductAttributeData_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ProductAttributes`
--
ALTER TABLE `ProductAttributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ProductAttributesValues`
--
ALTER TABLE `ProductAttributesValues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ProductAttrubuteVariation`
--
ALTER TABLE `ProductAttrubuteVariation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ProductAttrubuteVariation_temp`
--
ALTER TABLE `ProductAttrubuteVariation_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ProductImages`
--
ALTER TABLE `ProductImages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ProductImages_temp`
--
ALTER TABLE `ProductImages_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ProductInventory`
--
ALTER TABLE `ProductInventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ProductInventoryData`
--
ALTER TABLE `ProductInventoryData`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productOptions`
--
ALTER TABLE `productOptions`
  ADD PRIMARY KEY (`productAttributeId`);

--
-- Indexes for table `productOptionsValues`
--
ALTER TABLE `productOptionsValues`
  ADD PRIMARY KEY (`productOptionValueId`);

--
-- Indexes for table `ProductPricing`
--
ALTER TABLE `ProductPricing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Products`
--
ALTER TABLE `Products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Products_temp`
--
ALTER TABLE `Products_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_options`
--
ALTER TABLE `project_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `SubCategories`
--
ALTER TABLE `SubCategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `SubSubCategories`
--
ALTER TABLE `SubSubCategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `UserTypes`
--
ALTER TABLE `UserTypes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Categories`
--
ALTER TABLE `Categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `Customers`
--
ALTER TABLE `Customers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `DeliveryMethods`
--
ALTER TABLE `DeliveryMethods`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `FulfillStatus`
--
ALTER TABLE `FulfillStatus`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `LotNumbers`
--
ALTER TABLE `LotNumbers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Orders`
--
ALTER TABLE `Orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `PaymentStatus`
--
ALTER TABLE `PaymentStatus`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ProductAttributeData`
--
ALTER TABLE `ProductAttributeData`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ProductAttributeData_temp`
--
ALTER TABLE `ProductAttributeData_temp`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ProductAttributes`
--
ALTER TABLE `ProductAttributes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ProductAttributesValues`
--
ALTER TABLE `ProductAttributesValues`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `ProductAttrubuteVariation`
--
ALTER TABLE `ProductAttrubuteVariation`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `ProductAttrubuteVariation_temp`
--
ALTER TABLE `ProductAttrubuteVariation_temp`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ProductImages`
--
ALTER TABLE `ProductImages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ProductImages_temp`
--
ALTER TABLE `ProductImages_temp`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ProductInventory`
--
ALTER TABLE `ProductInventory`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ProductInventoryData`
--
ALTER TABLE `ProductInventoryData`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `productOptions`
--
ALTER TABLE `productOptions`
  MODIFY `productAttributeId` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `productOptionsValues`
--
ALTER TABLE `productOptionsValues`
  MODIFY `productOptionValueId` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ProductPricing`
--
ALTER TABLE `ProductPricing`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Products`
--
ALTER TABLE `Products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `Products_temp`
--
ALTER TABLE `Products_temp`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `project_options`
--
ALTER TABLE `project_options`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `SubCategories`
--
ALTER TABLE `SubCategories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `SubSubCategories`
--
ALTER TABLE `SubSubCategories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `UserTypes`
--
ALTER TABLE `UserTypes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
