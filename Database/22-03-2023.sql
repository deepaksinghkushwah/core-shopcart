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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table core_shopcart.categories: ~9 rows (approximately)
INSERT INTO `categories` (`id`, `parent_id`, `title`, `description`, `image`, `status`) VALUES
	(1, 0, 'Electronics', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatem, ullam.', 'noimg.png', 1),
	(2, 0, 'Fashion', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatem, ullam.', 'noimg.png', 1),
	(3, 0, 'Grosery', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatem, ullam.', 'noimg.png', 1),
	(4, 0, 'Automobile', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatem, ullam.', 'noimg.png', 1),
	(6, 0, 'Books', 'test feaf asefas ef a sef ase f ', 'noimg.png', 1),
	(7, 0, 'Loafts', 'Loafts', 'noimg.png', 1),
	(8, 0, 'Sartor', 'Sartor', 'noimg.png', 1),
	(9, 0, 'sfasef', 'asefasef', 'noimg.png', 1),
	(10, 0, 'seaf', 'asefasef', '5b53a5a0012c7f10322fc0063e6f8502641acda940b06.jpg', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table core_shopcart.users: ~0 rows (approximately)
INSERT INTO `users` (`id`, `email`, `password`, `fullname`, `role_id`, `status`) VALUES
	(1, 'admin@localhost.com', 'e10adc3949ba59abbe56e057f20f883e', 'Super Admin', 1, 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
