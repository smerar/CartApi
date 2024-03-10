-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 10, 2024 at 06:19 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

DROP TABLE IF EXISTS `cart_items`;
CREATE TABLE IF NOT EXISTS `cart_items` (
  `cart_item_id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`cart_item_id`),
  KEY `prod_fk_cart` (`product_id`),
  KEY `user_fk_cart` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE IF NOT EXISTS `order_details` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `total_amount` float DEFAULT '0',
  `user_id` int NOT NULL,
  `order_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `user_fk_order` (`user_id`),
  KEY `status_fk_order` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_id`, `total_amount`, `user_id`, `order_date`, `status`) VALUES
(2, 0, 1, '2024-03-10 13:58:34', 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `order_item_id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `user_id` int NOT NULL,
  `expected_delivery` date NOT NULL,
  PRIMARY KEY (`order_item_id`),
  KEY `user_fk_citem` (`user_id`),
  KEY `product_fk_citem` (`product_id`),
  KEY `order_fk_citem` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `product_id`, `quantity`, `user_id`, `expected_delivery`) VALUES
(1, 2, 4, 1, 3, '2024-03-11');

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

DROP TABLE IF EXISTS `order_status`;
CREATE TABLE IF NOT EXISTS `order_status` (
  `status_id` int NOT NULL AUTO_INCREMENT,
  `status_name` varchar(121) NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`status_id`, `status_name`) VALUES
(1, 'Payment Processing'),
(2, 'Payment Complete'),
(3, 'Order Placed'),
(4, 'Shipped'),
(5, 'Delivered'),
(6, 'Returned'),
(7, 'Cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `description` varchar(151) NOT NULL,
  `image` varchar(151) NOT NULL,
  `pricing` float NOT NULL,
  `shipping_cost` float NOT NULL,
  `no_of_days` int NOT NULL,
  `category` int NOT NULL,
  PRIMARY KEY (`product_id`),
  KEY `cat_fk_prod` (`category`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `description`, `image`, `pricing`, `shipping_cost`, `no_of_days`, `category`) VALUES
(1, 'Apple M1 Macbook', '/image/product1', 2000, 120, 10, 1),
(2, 'Iphone 15s', '/image/product2', 125, 12, 2, 2),
(3, 'Apple watch', '/image/product3', 1234, 12, 1, 3),
(4, 'Iphone 14s', '/image/product4', 400, 11, 1, 2),
(5, 'Apple M2 Macbook', '/image/product5', 3000, 123, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

DROP TABLE IF EXISTS `product_category`;
CREATE TABLE IF NOT EXISTS `product_category` (
  `catid` int NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(121) NOT NULL,
  PRIMARY KEY (`catid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`catid`, `cat_name`) VALUES
(1, 'Laptops'),
(2, 'Phone'),
(3, 'Watch');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_address`
--

DROP TABLE IF EXISTS `shipping_address`;
CREATE TABLE IF NOT EXISTS `shipping_address` (
  `address_id` int NOT NULL AUTO_INCREMENT,
  `aptno` varchar(121) NOT NULL,
  `street` varchar(121) NOT NULL,
  `city` varchar(121) NOT NULL,
  `province` varchar(121) NOT NULL,
  `pincode` varchar(7) NOT NULL,
  `phoneNumber` varchar(13) NOT NULL,
  `name` varchar(151) NOT NULL,
  `user_id` int NOT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`address_id`),
  KEY `user_fk_address` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `shipping_address`
--

INSERT INTO `shipping_address` (`address_id`, `aptno`, `street`, `city`, `province`, `pincode`, `phoneNumber`, `name`, `user_id`, `active`) VALUES
(1, 'B01', 'Sunview', 'Waterloo', 'Ontario', 'N2L 3V8', '2239878338', 'Smera ', 1, 1),
(2, '96', 'Markwood drive', 'Kithcener', 'Ontario', 'N2M 3L8', '2299987345', 'Teena G', 2, 1),
(3, '001', 'Albert Street', 'Waterloo', 'Ontario', 'N2L 3V9', '22466657898', 'Silpha Jackson', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(121) NOT NULL,
  `password` varchar(10) NOT NULL,
  `username` varchar(10) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `email`, `password`, `username`) VALUES
(1, 'smera.rockey3@gmail.com', 'newp', 'aremsr'),
(2, 'smera.professional3@gmail.com', 'smera123', 'smerap'),
(3, 'arems.kuku3@gmail.com', 'aremsk', 'aremsk');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `prod_fk_cart` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `user_fk_cart` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `status_fk_order` FOREIGN KEY (`status`) REFERENCES `order_status` (`status_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `user_fk_order` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_fk_citem` FOREIGN KEY (`order_id`) REFERENCES `order_details` (`order_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `product_fk_citem` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `user_fk_citem` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `cat_fk_prod` FOREIGN KEY (`category`) REFERENCES `product_category` (`catid`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `shipping_address`
--
ALTER TABLE `shipping_address`
  ADD CONSTRAINT `user_fk_address` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
