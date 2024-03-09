# ECommerceAPI
PHP API serving MySQL data to ReactJS client. Handles Products, Users, Comments, Cart, and Orders. Tested with Postman. Clean, secure codebase.

--Database Schema
CREATE TABLE `cartdb`.`user_details` (`user_id` INT NOT NULL AUTO_INCREMENT , `email` VARCHAR(151) NOT NULL , `password` VARCHAR(10) NOT NULL , `phone_number` VARCHAR(15) NOT NULL , `firstname` VARCHAR(151) NOT NULL , `secondname` VARCHAR(151) NULL DEFAULT NULL , PRIMARY KEY (`user_id`), UNIQUE `user_email` (`email`(151))) ENGINE = InnoDB;
