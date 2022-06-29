# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.18-0ubuntu0.16.04.1)
# Database: scotchbox
# Generation Time: 2022-06-28 19:05:54 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table admin
# ------------------------------------------------------------

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8 NOT NULL,
  `password` varchar(200) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*!40000 ALTER TABLE `admin` DISABLE KEYS */;

INSERT INTO `admin` (`id`, `username`, `password`)
VALUES
	(1,'admin','$2a$10$EAH6jSk6wTT4/XAm1nruBewL0Ae5GB8F0CDJyDgjSjD.7fjR6Ef1K');

/*!40000 ALTER TABLE `admin` ENABLE KEYS */;


# Dump of table media
# ------------------------------------------------------------

DROP TABLE IF EXISTS `media`;

CREATE TABLE `media` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `filename` varchar(300) NOT NULL DEFAULT '',
  `media_type` varchar(300) DEFAULT NULL,
  `alt_text` varchar(300) DEFAULT NULL,
  `media_title` varchar(300) DEFAULT NULL,
  `media_description` varchar(500) DEFAULT NULL,
  `publish_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `media` DISABLE KEYS */;

INSERT INTO `media` (`id`, `filename`, `media_type`, `alt_text`, `media_title`, `media_description`, `publish_date`)
VALUES
	(1,'product-8.jpg','image/jpeg',NULL,NULL,NULL,'2022-06-28 18:50:01'),
	(2,'product-9.jpg','image/jpeg',NULL,NULL,NULL,'2022-06-28 18:50:01'),
	(3,'product-7-a.jpg','image/jpeg',NULL,NULL,NULL,'2022-06-28 18:50:01'),
	(4,'product-7.jpg','image/jpeg',NULL,NULL,NULL,'2022-06-28 18:50:01'),
	(5,'product-6.jpg','image/jpeg',NULL,NULL,NULL,'2022-06-28 18:50:01'),
	(6,'product-5.jpg','image/jpeg',NULL,NULL,NULL,'2022-06-28 18:50:01'),
	(7,'product-4.jpg','image/jpeg',NULL,NULL,NULL,'2022-06-28 18:50:01'),
	(8,'product-2.jpg','image/jpeg',NULL,NULL,NULL,'2022-06-28 18:50:01'),
	(9,'product-1.jpg','image/jpeg',NULL,NULL,NULL,'2022-06-28 18:50:01'),
	(10,'product-15.jpg','image/jpeg',NULL,NULL,NULL,'2022-06-28 18:50:09'),
	(11,'product-3.jpg','image/jpeg',NULL,NULL,NULL,'2022-06-28 18:50:09'),
	(12,'product-14.jpg','image/jpeg',NULL,NULL,NULL,'2022-06-28 18:50:09'),
	(13,'product-13.jpg','image/jpeg',NULL,NULL,NULL,'2022-06-28 18:50:09'),
	(14,'product-12.jpg','image/jpeg',NULL,NULL,NULL,'2022-06-28 18:50:09'),
	(15,'product-11.jpg','image/jpeg',NULL,NULL,NULL,'2022-06-28 18:50:09'),
	(16,'product-10.jpg','image/jpeg',NULL,NULL,NULL,'2022-06-28 18:50:09');

/*!40000 ALTER TABLE `media` ENABLE KEYS */;


# Dump of table orders
# ------------------------------------------------------------

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `postal_code` varchar(10) DEFAULT NULL,
  `city` varchar(250) DEFAULT NULL,
  `country` varchar(250) DEFAULT NULL,
  `phone` varchar(250) DEFAULT NULL,
  `order_total` decimal(9,2) DEFAULT NULL,
  `delivery_price` decimal(9,2) DEFAULT NULL,
  `payment_option` varchar(50) DEFAULT NULL,
  `status` varchar(250) DEFAULT 'canceled',
  `create_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table orders_items
# ------------------------------------------------------------

DROP TABLE IF EXISTS `orders_items`;

CREATE TABLE `orders_items` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_sku` varchar(250) DEFAULT NULL,
  `product_name` varchar(250) DEFAULT NULL,
  `product_price` decimal(9,2) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table products
# ------------------------------------------------------------

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `description` longtext,
  `sku` varchar(250) DEFAULT NULL,
  `price` decimal(9,2) DEFAULT NULL,
  `sale_price` decimal(9,2) DEFAULT NULL,
  `featured_image` varchar(11) DEFAULT NULL,
  `gallery_image` text,
  `publish_date` date DEFAULT NULL,
  `status` varchar(20) DEFAULT 'published',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `products` DISABLE KEYS */;

INSERT INTO `products` (`id`, `name`, `description`, `sku`, `price`, `sale_price`, `featured_image`, `gallery_image`, `publish_date`, `status`)
VALUES
	(1,'Križ','Opis proizvoda','0001',89.00,0.00,'9','','2022-06-28','published'),
	(2,'Krila Anđela','Aranžman sa crvenim i bijelim cvjetovima','0002',109.00,99.00,'8','','2022-06-28','published'),
	(3,'Šarena košara','Širina: 50cm\r\nVisina: 30cm','0003',129.00,0.00,'11','[\"7\"]','2022-06-28','published'),
	(4,'Tulipani','','0004',49.99,0.00,'6','','2022-06-28','published'),
	(5,'Velika košara','','0005',259.00,199.00,'5','','2022-06-28','published'),
	(6,'Proljetni aranžman u vazi','','0006',99.00,0.00,'4','','2022-06-28','published');

/*!40000 ALTER TABLE `products` ENABLE KEYS */;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
