# ECommerceAPI
PHP API serving MySQL data to ReactJS client. Handles Products, Users, Comments, Cart, and Orders. Tested with Postman. Clean, secure codebase.

## Database Schema

 Database: `cartdb`

### Table structure for table `cart`

```
DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `cart_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `updated_at` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`cart_id`),
  KEY `user_FK_cart` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
```

### Table structure for table `cart_items`

```
DROP TABLE IF EXISTS `cart_items`;
CREATE TABLE IF NOT EXISTS `cart_items` (
  `item_id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `cart_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` float NOT NULL,
  `modified_date` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`item_id`),
  UNIQUE KEY `product_id` (`product_id`,`cart_id`),
  KEY `cart_FK_citems` (`cart_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
```


### Table structure for table `comments`

```
DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int NOT NULL AUTO_INCREMENT,
  `product_comment` varchar(500) NOT NULL,
  `product_rating` int NOT NULL,
  `comment_dateTime` datetime NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `user_FK` (`user_id`),
  KEY `product_comment_FK` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
```

### Table structure for table `order_details`
```
DROP TABLE IF EXISTS `order_details`;
CREATE TABLE IF NOT EXISTS `order_details` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `total_amount` float NOT NULL,
  `shipping_price` float NOT NULL,
  `order_date` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `orderStatus_id` int NOT NULL,
  `user_id` int NOT NULL,
  `address_id` int NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `user_FK_orderdet` (`user_id`),
  KEY `status_FK_orderdet` (`orderStatus_id`),
  KEY `address_FK_orderdet` (`address_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
```

### Table structure for table `order_items`
```
DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `orderItem_id` int NOT NULL AUTO_INCREMENT,
  `item_qty` int NOT NULL,
  `item_price` int NOT NULL,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`orderItem_id`),
  KEY `order_FK_items` (`order_id`),
  KEY `product_FK_items` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
```
### Table structure for table `order_status`

```
DROP TABLE IF EXISTS `order_status`;
CREATE TABLE IF NOT EXISTS `order_status` (
  `orderStatus_id` int NOT NULL AUTO_INCREMENT,
  `status_name` varchar(250) NOT NULL,
  PRIMARY KEY (`orderStatus_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
```
### Table structure for table `products`
```
DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `product_name` varchar(151) NOT NULL,
  `category_id` int NOT NULL,
  `product_price` float NOT NULL,
  `product_description` varchar(151) NOT NULL,
  `shipping_cost` float NOT NULL,
  `shipping_days` int NOT NULL,
  PRIMARY KEY (`product_id`),
  KEY `product_category_FK` (`category_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
```
### Table structure for table `product_category`

```
DROP TABLE IF EXISTS `product_category`;
CREATE TABLE IF NOT EXISTS `product_category` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(151) NOT NULL,
  `category_description` varchar(151) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
```
### Table structure for table `product_image`

```
DROP TABLE IF EXISTS `product_image`;
CREATE TABLE IF NOT EXISTS `product_image` (
  `image_id` int NOT NULL AUTO_INCREMENT,
  `image_description` varchar(250) NOT NULL,
  `image` varchar(250) NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`image_id`),
  KEY `product_FK` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
```
### Table structure for table `provinces`
```
DROP TABLE IF EXISTS `provinces`;
CREATE TABLE IF NOT EXISTS `provinces` (
  `pcode` varchar(5) NOT NULL,
  `pname` varchar(151) NOT NULL,
  PRIMARY KEY (`pcode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
```
### Table structure for table `user_address`
```
DROP TABLE IF EXISTS `user_address`;
CREATE TABLE IF NOT EXISTS `user_address` (
  `address_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `hno_apno` varchar(10) NOT NULL,
  `streetName` varchar(151) NOT NULL,
  `city` varchar(151) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `pcode` varchar(5) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `defaultflag` tinyint(1) NOT NULL,
  PRIMARY KEY (`address_id`),
  KEY `province_pcode_FK` (`pcode`),
  KEY `user_details_user_id_FK` (`user_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
```
### Table structure for table `user_details`
```
DROP TABLE IF EXISTS `user_details`;
CREATE TABLE IF NOT EXISTS `user_details` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(151) NOT NULL,
  `password` varchar(10) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `firstname` varchar(151) NOT NULL,
  `secondname` varchar(151) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
```

### Dumping data for table `user_details`

```
INSERT INTO `user_details` (`user_id`, `email`, `password`, `phone_number`, `firstname`, `secondname`) VALUES
(1, 'smera.professional3@gmail.com', 'Smera@123', '2268999683', 'Smera', 'Rockey');
```
### Table structure for table `user_review_images`
```
DROP TABLE IF EXISTS `user_review_images`;
CREATE TABLE IF NOT EXISTS `user_review_images` (
  `review_image_id` int NOT NULL AUTO_INCREMENT,
  `comment_id` int DEFAULT NULL,
  `review_image` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`review_image_id`),
  KEY `comment_FK_revImg` (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
```
### Constraints for dumped tables


#### Constraints for table `cart`

```
ALTER TABLE `cart`
  ADD CONSTRAINT `user_FK_cart` FOREIGN KEY (`user_id`) REFERENCES `user_details` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
```
#### Constraints for table `cart_items`

```
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_FK_citems` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`cart_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `product_FK_citems` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
```
#### Constraints for table `comments`

```
ALTER TABLE `comments`
  ADD CONSTRAINT `product_commentFK` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `user_FK` FOREIGN KEY (`user_id`) REFERENCES `user_details` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
```
#### Constraints for table `order_details`

```
ALTER TABLE `order_details`
  ADD CONSTRAINT `address_FK_orderdet` FOREIGN KEY (`address_id`) REFERENCES `user_address` (`address_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `status_FK_orderdet` FOREIGN KEY (`orderStatus_id`) REFERENCES `order_status` (`orderStatus_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `user_FK_orderdet` FOREIGN KEY (`user_id`) REFERENCES `user_details` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
```

#### Constraints for table `order_items`
```
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_FK_items` FOREIGN KEY (`order_id`) REFERENCES `order_details` (`order_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `product_FK_items` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

```
#### Constraints for table `products`

```
ALTER TABLE `products`
  ADD CONSTRAINT `product_category_cid` FOREIGN KEY (`category_id`) REFERENCES `product_category` (`category_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

```
#### Constraints for table `product_image`

```
ALTER TABLE `product_image`
  ADD CONSTRAINT `product_FK` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
```

#### Constraints for table `user_address`
```
ALTER TABLE `user_address`
  ADD CONSTRAINT `province_pcode_FK` FOREIGN KEY (`pcode`) REFERENCES `provinces` (`pcode`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `user_details_user_id_FK` FOREIGN KEY (`user_id`) REFERENCES `user_details` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
```

## Constraints for table `user_review_images`
```
ALTER TABLE `user_review_images`
  ADD CONSTRAINT `comment_FK_revImg` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`comment_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
```