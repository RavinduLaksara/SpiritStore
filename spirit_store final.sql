-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 18, 2024 at 12:04 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spirit_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `phone` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `phone`, `password`) VALUES
(6, 'Ravindu', 'laksararavindum@gmail.com', '0761971639', '$2y$10$O29f4MxUA3z2cJ9dyEg9xOaO4SvfGxWs7F6mFU36Ajws9JB8PIjyC'),
(7, 'Prageeth', 'prageethek36@gmail.com', '0717892154', '$2y$10$Skf039Sh5VzG5upwTBTGRuYlPLX4PQ99.UYkPexbDO5E92U0mwA.O'),
(8, 'Sanduni', 'sanduniayeshika4@gmail.com', '0769991200', '$2y$10$1DGQzpTMeKFaiHz0GIA/n.VdJT0YQ.E2nm0WcPxrkP54DI04mvpqW'),
(9, 'Jashvanth', 'jashvanth370@gmail.com', '0779430824', '$2y$10$Q9db0I3QJPnTs.bkeVd3Gedew5.U03RaGLaymwLsfc.N8iInHkjUe'),
(10, 'Chamindu', 'chamindudilshan284@gmail.com', '0784444284', '$2y$10$pXbP365d1MAYzdZ3SQvf9unFrwJrVK.xRJWb3RavdyfE.W3LtKeUe');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

DROP TABLE IF EXISTS `brand`;
CREATE TABLE IF NOT EXISTS `brand` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `descri` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `name`, `descri`) VALUES
(1, 'Rockland', 'Ceylon Arrack Miniature.'),
(2, 'DCSL', 'Ceylon Arrack Miniature.'),
(3, 'Jack Daniels', 'Jack Daniel is a brand of Tennessee whiskey.'),
(4, 'Johnnie Walker', 'Johnnie Walker (Scottish Gaelic: Seonaidh Walker) is a brand of Scotch whisky produced by Diageo in '),
(5, 'Smirnoff', 'Smirnoff No.21 Premium Vodka is the number one best-selling premium vodka in the world with countles'),
(6, 'Carlsberg', 'Established in 1847 by brewer J.C. Jacobsen, the Carlsberg Group is one of the leading brewery group'),
(10, 'Beluga', 'Beluga is a Noble Russian vodka with modern attitude. It is created by true masters in Siberia for t'),
(15, 'Glenfiddich', 'Glenfiddich stands on the hills of Speyside, on the outskirts of the whisky town of Dufftown, Scotla'),
(16, 'Cognac', 'Cognac is a variety of brandy named after the commune of Cognac, France. It is produced in the surrounding wine-growing region in the departments of Charente and Charente-Maritime'),
(17, 'IDL', 'Over the years, International Distillers Limited has emerged as one of Sri Lanka leading corporates and a manufacturer'),
(18, 'Lion', 'Lion Brewery or Lion Brewery (Ceylon) PLC is a predominantly Sri Lankan owned and operated brewery. The company is listed on the Colombo Stock Exchange and its stock is part of the S&P Sri Lanka 20 Index');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `cartID` int NOT NULL AUTO_INCREMENT,
  `customerID` int DEFAULT NULL,
  `total` double NOT NULL,
  PRIMARY KEY (`cartID`),
  KEY `customerID` (`customerID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cartitem`
--

DROP TABLE IF EXISTS `cartitem`;
CREATE TABLE IF NOT EXISTS `cartitem` (
  `itemID` int NOT NULL AUTO_INCREMENT,
  `cartID` int DEFAULT NULL,
  `ProductID` int DEFAULT NULL,
  `Quantity` int NOT NULL,
  `SubTotal` double NOT NULL,
  `storeID` int DEFAULT NULL,
  PRIMARY KEY (`itemID`),
  KEY `cartID` (`cartID`),
  KEY `ProductID` (`ProductID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `descri` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `descri`) VALUES
(1, 'brandy', 'Brandy is a liquor produced by distilling wine. Brandy generally contains 35–60% alcohol by volume and is typically consumed as an after-dinner digestif.'),
(2, 'gin', 'Gin is a distilled alcoholic drink flavoured with juniper berries and other botanical ingredients. Gin originated as a medicinal liquor made by monks and alchemists across Europe.'),
(3, 'vodka', 'Vodka is a clear distilled alcoholic beverage. Different varieties originated in Poland, Russia, and Sweden. Vodka is composed mainly of water and ethanol but sometimes with traces of impurities and flavourings.'),
(4, 'whisky', 'Whisky or whiskey is a type of liquor made from fermented grain mash. Various grains (which may be malted) are used for different varieties, including barley, corn, rye, and wheat. Whisky is typically aged in wooden casks, which are typically made of charred white oak.'),
(9, 'Arrack', 'Taste the island’s finest alcohol, arrack. Featuring a variety of well-known brands from Rockland arrack to VAT 9, we bring you the best Sri Lankan arrack brands. Avoid standing in long queues and shop at our online store for your convenience!'),
(10, 'Beers', 'Beer is one of the oldest and most widely consumed alcoholic drinks in the world, and the third most popular drink overall after water and tea.');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `state` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `city` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `postal_code` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `phone` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `email`, `phone`, `password`, `state`, `city`, `postal_code`) VALUES
(4, 'dinuka', 'dinuka@gmail.com', '0705637732', '$2y$10$rUyAmBVfQZc7W73wZ7OW.OdVVBxADdG0Ap67C4LEmcMUWpvYgWHKK', 'thihagoda', 'matara', '81280');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

DROP TABLE IF EXISTS `orderdetails`;
CREATE TABLE IF NOT EXISTS `orderdetails` (
  `OrderDetailID` int NOT NULL AUTO_INCREMENT,
  `OrderID` int DEFAULT NULL,
  `ProductID` int DEFAULT NULL,
  `Quantity` int NOT NULL,
  `SubTotal` double NOT NULL,
  `storeID` int DEFAULT NULL,
  PRIMARY KEY (`OrderDetailID`),
  KEY `OrderID` (`OrderID`),
  KEY `ProductID` (`ProductID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`OrderDetailID`, `OrderID`, `ProductID`, `Quantity`, `SubTotal`, `storeID`) VALUES
(11, 9, 1, 1, 17500, 1),
(12, 10, 15, 1, 4580, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `OrderID` int NOT NULL AUTO_INCREMENT,
  `CustomerID` int DEFAULT NULL,
  `OrderDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `TotalAmount` double NOT NULL,
  `street` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `city` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`OrderID`),
  KEY `CustomerID` (`CustomerID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `CustomerID`, `OrderDate`, `TotalAmount`, `street`, `city`) VALUES
(9, 4, '2024-11-18 02:19:10', 17500, 'thihagoda', 'matara'),
(10, 4, '2024-11-18 02:23:33', 4580, 'Katuwana', 'Middeniya');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `ProductID` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `Description` text COLLATE utf8mb4_general_ci,
  `BrandID` int DEFAULT NULL,
  `CategoryID` int DEFAULT NULL,
  `Local_Imported` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Country` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ABV` double DEFAULT NULL,
  `photo` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ProductID`),
  KEY `BrandID` (`BrandID`),
  KEY `CategoryID` (`CategoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductID`, `Name`, `Description`, `BrandID`, `CategoryID`, `Local_Imported`, `Country`, `ABV`, `photo`) VALUES
(1, 'Johnnie Walker Black Label', 'Recognized as the benchmark for all other deluxe blends, Johnnie Walker Black Label is a true icon. Created using only whiskies aged for a minimum of 12 years from the four corners of Scotland, Johnnie Walker Black Label has an unmistakably smooth, deep character.', 4, 4, 'Imported', 'Scotland', 40, '../product-images/Johnnie Walker Black Label.jpeg'),
(2, 'DCSL Extra Special', 'DCSL ES Arrack is spiced up with a wonderful blend of natural spices such as Iramasu, Cinnamon & Cardamoms to enhance it’s delicious flavor. This heart warming tipple has no added artificial colors or flavors.', 2, 9, 'local', 'Sri Lanka', 33.5, '../product-images/DCSL Extra Special.jpeg'),
(4, 'Smirnoff Red  750ml', 'Triple distilled and filtered 10 times, the Smirnoff is the world’s best-selling vodka. Crystal clear in colour, the vodka has faint aromas of black pepper and charcoal. On the palate, the vodka has flavours of black pepper and subtle peppermint freshness.\r\n\r\n', 5, 3, 'imported', 'Russia', 40, '../product-images/Smirnoff Vodka.jpg'),
(7, 'CARLSBERG SPECIAL BREW 500ML CAN', 'The international flavors of global brewers Carlsberg, is produced at the Lion Brewery under license, adding further dimensions to the portfolio of products on offer, is available in 8.8%.', 6, 10, 'imported', 'Denmark', 8.8, '../product-images/CARLSBERG SPECIAL BREW 500ML CAN.jpg'),
(10, 'NOBLEWOOD BELUGA NOBLE VODKA 700ML', 'Beluga is a very famous and high-quality vodka from Russia. It has a fancy history and is made with great care. The place where they make it, called the Mariinsk Distillery, was started in 1900 and is in a clean and natural part of Siberia.', 10, 3, 'imported', 'Russia', 40, '../product-images/beluga-noble-vodka-07-liter_1_.jpg'),
(11, 'GLENFIDDICH 21 YRS 700 ML', 'A 21 year old bottling from Glenfiddich, finished in casks used previously to age Caribbean Rum.', 15, 4, 'imported', 'Scotland', 40, '../product-images/glenfiddich-21.jpg'),
(12, 'TWIST ORIGINAL VODKA 750ML', 'TWIST ORIGINAL VODKA from Rockland Distilleries.', 1, 3, 'local', 'Sri Lanka', 38, '../product-images/Twist vodka.jpeg'),
(14, 'KEROFF VODKA 750 ML', 'This is a Charcoal-Filtered Vodka Crafted from an Original Russian recipe by Expert Master Distillers to offer a distinctive pure taste.', 1, 3, 'local', 'Sri Lanka', 40, '../product-images/KEROFF-VODKA-750-ML.jpg'),
(15, 'ROSKAA VODKA 750 ML', 'Roska vodka is a pure distilled vodka with a 38% alcohol by volume (vol). It is available in 375 ml and 750 ml bottles.', 1, 3, 'local', 'Sri Lanka', 38, '../product-images/ROSKAA-VODKA-375-ML.jpg'),
(16, 'Courvoisier VS Cognac', 'The Courvoisier VS Cognac is a signature blend of cognacs aged between three and seven years. This combination of older and younger cognacs gives a delicate and fruity taste and intense aromas of ripe fruits and ring flowers.', 16, 1, 'imported', 'France', 40, '../product-images/Courvoisier VS Cognac.jpeg'),
(17, 'ASCOT LEMON GIN', 'For a gin lover who likes a fruity touch to his or her drink try Ascot Lemon. Carefully created as a wonderfully refreshing alternative to the usual dry gins, this is a drink that is moreish in every way.', 17, 2, 'local', 'Sri Lanka', 39, '../product-images/Lemon-gin.png'),
(18, 'LION STRONG BEER 500ML CAN', 'Undoubtedly the best selling among our mild beers, Lion Lager Beer has a 8.8% alcohol volume and is credited as a great thirst quencher. Golden roasted malt in color with a hint of fruit and caramel flavoring, it is very slightly sweet with less hop notes.', 18, 10, 'local', 'Sri Lanka', 8.8, '../product-images/lion beer.jpg'),
(19, 'Jack Daniels Tennessee Whisky, 750ml', 'Jack Daniel’s Black Label (also known as Old No. 7 or more commonly as JD or simply Jack) is one of the best selling whiskeys in the world. It is the signature brand that defines Tennessee whiskey and is easily distinguishable from every other whiskey produced today.', 3, 4, 'imported', 'United States', 40, '../product-images/Jack Daniels Tennessee Whisky.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

DROP TABLE IF EXISTS `store`;
CREATE TABLE IF NOT EXISTS `store` (
  `store_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `state` varchar(30) DEFAULT NULL,
  `supplier_id` int DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `postal_code` varchar(30) DEFAULT NULL,
  `balance` decimal(10,2) NOT NULL DEFAULT '0.00',
  `commision` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`store_id`),
  KEY `supplier_id` (`supplier_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`store_id`, `name`, `state`, `supplier_id`, `city`, `postal_code`, `balance`, `commision`) VALUES
(1, 'Panadura wine stores', 'keselwatta', 2, 'Panadura', '81500', 22080.00, 2208.00),
(2, 'Best Liquor Store', 'Kandegoda', 4, 'Ambalangoda', '80300', 0.00, 0.00),
(3, 'Matara Wine Stores', 'Kirinda', 5, 'Matara', '81280', 0.00, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `storeproduct`
--

DROP TABLE IF EXISTS `storeproduct`;
CREATE TABLE IF NOT EXISTS `storeproduct` (
  `StoreID` int NOT NULL,
  `ProductID` int NOT NULL,
  `Quantity` int NOT NULL,
  `Price` double NOT NULL,
  PRIMARY KEY (`StoreID`,`ProductID`),
  KEY `ProductID` (`ProductID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `storeproduct`
--

INSERT INTO `storeproduct` (`StoreID`, `ProductID`, `Quantity`, `Price`) VALUES
(1, 1, 12, 17500),
(1, 2, 30, 3600),
(1, 4, 14, 7250),
(1, 14, 28, 5100),
(1, 15, 17, 4580),
(2, 1, 18, 17800),
(2, 2, 43, 3700),
(2, 12, 16, 4600),
(2, 16, 25, 30450),
(2, 17, 18, 5100),
(2, 18, 120, 700),
(2, 19, 38, 22150),
(3, 2, 54, 3600),
(3, 4, 45, 7500),
(3, 7, 88, 720),
(3, 11, 12, 178000);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
CREATE TABLE IF NOT EXISTS `supplier` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `state` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `postal_code` varchar(50) DEFAULT NULL,
  `license_type` varchar(50) DEFAULT NULL,
  `license_no` varchar(50) DEFAULT NULL,
  `approve_status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `name`, `email`, `phone`, `password`, `state`, `city`, `postal_code`, `license_type`, `license_no`, `approve_status`) VALUES
(2, 'Praveen', 'praveen@gmail.com', '0766940529', '$2y$10$O7ANl0cGPsay3yrTgrwYoesQT/tasw5J549o3XnLV9Ku5cel4AVQ6', 'keselwatta', 'panadura', '81500', 'F.L 3', '234562', 'yes'),
(4, 'Tasheen', 'tasheen@gmail.com', '0766940529', '$2y$10$S6Y8MDODr40Lsx1.O47/H.lVUYq3ckjKVcK2tVLeT..JKxlrQN7bG', 'Kandegoda', 'Ambalangoda', '80300', 'F.L 3', '234562', 'yes'),
(5, 'Chamindu', 'chamindu@gmail.com', '0777066940', '$2y$10$69rZ.W7AXwAagFcdCHCtfO2tePxIX3dNK9TpJo51Ye9gdtJOwAM/O', 'Kirinda', 'Matara', '81280', 'F.L 3', '234562', 'yes');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customer` (`id`);

--
-- Constraints for table `cartitem`
--
ALTER TABLE `cartitem`
  ADD CONSTRAINT `cartitem_ibfk_1` FOREIGN KEY (`cartID`) REFERENCES `cart` (`cartID`),
  ADD CONSTRAINT `cartitem_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`);

--
-- Constraints for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `orderdetails_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`),
  ADD CONSTRAINT `orderdetails_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`BrandID`) REFERENCES `brand` (`id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`CategoryID`) REFERENCES `category` (`id`);

--
-- Constraints for table `storeproduct`
--
ALTER TABLE `storeproduct`
  ADD CONSTRAINT `storeproduct_ibfk_1` FOREIGN KEY (`StoreID`) REFERENCES `store` (`id`),
  ADD CONSTRAINT `storeproduct_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
