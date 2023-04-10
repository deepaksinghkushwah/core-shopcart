-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table core_shopcart.cart
DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `product_id` int unsigned NOT NULL DEFAULT '0',
  `price` float(11,2) unsigned NOT NULL DEFAULT '0.00',
  `qty` int unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table core_shopcart.cart: ~2 rows (approximately)
INSERT INTO `cart` (`id`, `user_id`, `session_id`, `product_id`, `price`, `qty`, `created_at`) VALUES
	(1, 1, '7mdab6jrli41j43bkbgnlnv21t', 15, 150.00, 2, '2023-04-10 08:45:00'),
	(3, 1, '7mdab6jrli41j43bkbgnlnv21t', 1, 10.00, 8, '2023-04-10 08:50:00');

-- Dumping structure for table core_shopcart.categories
DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int unsigned DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table core_shopcart.categories: ~10 rows (approximately)
INSERT INTO `categories` (`id`, `parent_id`, `title`, `description`, `image`, `status`) VALUES
	(1, 0, 'Product one child', 'Product one child', 'noimg.png', 1),
	(2, 0, 'Fashion', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatem, ullam.', 'noimg.png', 1),
	(3, 0, 'Grosery', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatem, ullam.', 'noimg.png', 1),
	(4, 0, 'Automobile', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatem, ullam.', 'noimg.png', 1),
	(6, 0, 'Books', 'test feaf asefas ef a sef ase f ', 'noimg.png', 1),
	(7, 0, 'Loafts', 'Loafts', 'noimg.png', 1),
	(8, 0, 'Sartor', 'Sartor', 'noimg.png', 1),
	(9, 0, 'sfasef', 'asefasef', 'noimg.png', 1),
	(10, 0, 'seaf11', 'asefasef11', '479a4d405355407d027b846693d78646641bf5f4956ba.jpg', 1),
	(11, 0, 'erasef', 'efasefasef', '3b45d7fcd32f33ea9838dfe7c50a213c641ad02c25d0c.jpg', 1),
	(13, 0, 'dsafasefaseaef111', 'asefasefasef', '19ad2b3bed63e2db6df448675358b662641bf66f948c7.jpg', 1),
	(14, 0, 'Product One', 'lorem10', '1b31cc791d1850bb7546feb24fd74308642156ea1ae77.jpg', 1);

-- Dumping structure for table core_shopcart.products
DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `price` float(11,2) DEFAULT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `cat_id` int unsigned DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_products_cat_id` (`cat_id`),
  CONSTRAINT `fk_products_cat_id` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table core_shopcart.products: ~15 rows (approximately)
INSERT INTO `products` (`id`, `title`, `price`, `description`, `image`, `cat_id`, `status`) VALUES
	(1, 'Product one child', 10.00, 'Product one child', 'd90a77bca7a0aee6bf6f52a977c168ae6421571185ec5.jpg', 4, 1),
	(2, 'Yi Kunbarrasaurus Zhuchengtitan', 20.00, 'Yi Kunbarrasaurus Zhuchengtitan Citipati Aristosuchus Parasaurolophus Yangchuanosaurus', 'e12ea5171df816e7de10c320a7a8797a642158946afa1.jpg', 4, 1),
	(3, 'Rugocaudia Nanyangosaurus ', 30.00, 'Rugocaudia Nanyangosaurus Rhabdodon Ankylosaurus Thecodontosaurus Rioarribasaurus Narambuenatitan Tangvayosaurus Lucianovenator Nasutoc', 'fef9bbe0a6ad74fa36de57164e39465f642158a9557c0.jpg', 4, 1),
	(4, 'Rugocaudia Nanyangosaurus ', 40.00, 'Rugocaudia Nanyangosaurus Rhabdodon Ankylosaurus Thecodontosaurus Rioarribasaurus Narambuenatitan Tangvayosaurus Lucianovenator Nasutoc', 'fef9bbe0a6ad74fa36de57164e39465f642158a9557c0.jpg', 4, 1),
	(5, 'Yi Kunbarrasaurus Zhuchengtitan', 50.00, 'Yi Kunbarrasaurus Zhuchengtitan Citipati Aristosuchus Parasaurolophus Yangchuanosaurus', 'e12ea5171df816e7de10c320a7a8797a642158946afa1.jpg', 4, 1),
	(6, 'Product one child', 60.00, 'Product one child', 'd90a77bca7a0aee6bf6f52a977c168ae6421571185ec5.jpg', 4, 1),
	(7, 'Rugocaudia Nanyangosaurus ', 70.00, 'Rugocaudia Nanyangosaurus Rhabdodon Ankylosaurus Thecodontosaurus Rioarribasaurus Narambuenatitan Tangvayosaurus Lucianovenator Nasutoc', 'fef9bbe0a6ad74fa36de57164e39465f642158a9557c0.jpg', 4, 1),
	(8, 'Yi Kunbarrasaurus Zhuchengtitan', 80.00, 'Yi Kunbarrasaurus Zhuchengtitan Citipati Aristosuchus Parasaurolophus Yangchuanosaurus', 'e12ea5171df816e7de10c320a7a8797a642158946afa1.jpg', 4, 1),
	(9, 'Yi Kunbarrasaurus Zhuchengtitan', 90.00, 'Yi Kunbarrasaurus Zhuchengtitan Citipati Aristosuchus Parasaurolophus Yangchuanosaurus', 'e12ea5171df816e7de10c320a7a8797a642158946afa1.jpg', 4, 1),
	(10, 'Yi Kunbarrasaurus Zhuchengtitan', 100.00, 'Yi Kunbarrasaurus Zhuchengtitan Citipati Aristosuchus Parasaurolophus Yangchuanosaurus', 'e12ea5171df816e7de10c320a7a8797a642158946afa1.jpg', 4, 1),
	(11, 'Yi Kunbarrasaurus Zhuchengtitan', 110.00, 'Yi Kunbarrasaurus Zhuchengtitan Citipati Aristosuchus Parasaurolophus Yangchuanosaurus', 'e12ea5171df816e7de10c320a7a8797a642158946afa1.jpg', 4, 1),
	(12, 'Yi Kunbarrasaurus Zhuchengtitan', 120.00, 'Yi Kunbarrasaurus Zhuchengtitan Citipati Aristosuchus Parasaurolophus Yangchuanosaurus', 'e12ea5171df816e7de10c320a7a8797a642158946afa1.jpg', 4, 1),
	(13, 'Yi Kunbarrasaurus Zhuchengtitan', 130.00, 'Yi Kunbarrasaurus Zhuchengtitan Citipati Aristosuchus Parasaurolophus Yangchuanosaurus', 'e12ea5171df816e7de10c320a7a8797a642158946afa1.jpg', 4, 1),
	(14, 'Yi Kunbarrasaurus Zhuchengtitan', 140.00, 'Yi Kunbarrasaurus Zhuchengtitan Citipati Aristosuchus Parasaurolophus Yangchuanosaurus', 'e12ea5171df816e7de10c320a7a8797a642158946afa1.jpg', 4, 1),
	(15, 'Yi Kunbarrasaurus Zhuchengtitan', 150.00, 'Yi Kunbarrasaurus Zhuchengtitan Citipati Aristosuchus Parasaurolophus Yangchuanosaurus', 'e12ea5171df816e7de10c320a7a8797a642158946afa1.jpg', 4, 1);

-- Dumping structure for table core_shopcart.roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table core_shopcart.roles: ~2 rows (approximately)
INSERT INTO `roles` (`id`, `title`) VALUES
	(1, 'Super Admin'),
	(2, 'Registered');

-- Dumping structure for table core_shopcart.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL DEFAULT '0',
  `fullname` varchar(255) NOT NULL DEFAULT '0',
  `role_id` int unsigned DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_users_role_id` (`role_id`) USING BTREE,
  CONSTRAINT `fk_users_role_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table core_shopcart.users: ~0 rows (approximately)
INSERT INTO `users` (`id`, `email`, `password`, `fullname`, `role_id`, `status`) VALUES
	(1, 'admin@localhost.com', 'e10adc3949ba59abbe56e057f20f883e', 'Super Admin', 1, 1),
	(2, 'test1@localhost.com', 'e10adc3949ba59abbe56e057f20f883e', 'TEst One', 2, 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
