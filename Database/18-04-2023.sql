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

-- Dumping structure for table core_shopcart.addresses
CREATE TABLE IF NOT EXISTS `addresses` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL DEFAULT '0',
  `address_line1` varchar(255) NOT NULL DEFAULT '0',
  `address_line2` varchar(255) NOT NULL DEFAULT '0',
  `city` varchar(255) NOT NULL DEFAULT '0',
  `state` varchar(255) NOT NULL DEFAULT '0',
  `country` varchar(255) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_address_user_id` (`user_id`),
  CONSTRAINT `fk_address_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table core_shopcart.addresses: ~5 rows (approximately)
INSERT INTO `addresses` (`id`, `user_id`, `address_line1`, `address_line2`, `city`, `state`, `country`, `status`) VALUES
	(1, 1, 'test line 1', 'TEst line 2', 'Alwar', 'Rajasthan', 'India', 1),
	(2, 1, 'feaf', 'cvxc', 'vsdvs', 'efaf', 'asefsaef', 1),
	(3, 1, 'wet', 'rh', 'fdtj', 'hdftj', 'mdm', 0),
	(4, 1, 'dfmnd', 'dmdf', 'tth', 'dfthdf', 'dfthdth', 0),
	(5, 1, 'xcbxc', 'bxcvb', 'xcvb', 'xcvbx', 'cvbxcb', 0);

-- Dumping structure for table core_shopcart.cart
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `product_id` int unsigned NOT NULL DEFAULT '0',
  `price` float(11,2) unsigned NOT NULL DEFAULT '0.00',
  `qty` int unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table core_shopcart.cart: ~4 rows (approximately)
INSERT INTO `cart` (`id`, `user_id`, `session_id`, `product_id`, `price`, `qty`, `created_at`) VALUES
	(4, 1, '6t1grsokp1j2hk7uti1v0nkv4n', 15, 150.00, 3, '2023-04-11 08:27:00'),
	(6, 1, '3olvkjpapfocrqjbhf9pntcrkp', 237, 142.58, 1, '2023-04-15 08:57:00'),
	(7, 1, '3olvkjpapfocrqjbhf9pntcrkp', 235, 0.62, 3, '2023-04-15 08:57:00'),
	(8, 1, '3olvkjpapfocrqjbhf9pntcrkp', 233, 2.44, 1, '2023-04-15 08:57:00'),
	(9, 1, 'th3214cpbii6g5mf1r2mgqd51r', 236, 464022.47, 10, '2023-04-18 08:52:00');

-- Dumping structure for table core_shopcart.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int unsigned DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table core_shopcart.categories: ~12 rows (approximately)
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

-- Dumping structure for table core_shopcart.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned DEFAULT '0',
  `address_id` int unsigned DEFAULT NULL,
  `amount` float(11,2) unsigned DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `payment_status` enum('paid','unpaid') NOT NULL DEFAULT 'unpaid',
  `order_status` enum('in progress','order placed','in transit','completed') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'in progress',
  PRIMARY KEY (`id`),
  KEY `fk_orders_user_id` (`user_id`),
  KEY `fk_orders_address_id` (`address_id`),
  CONSTRAINT `fk_orders_address_id` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_orders_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table core_shopcart.orders: ~1 rows (approximately)
INSERT INTO `orders` (`id`, `user_id`, `address_id`, `amount`, `created_at`, `payment_status`, `order_status`) VALUES
	(4, 1, 1, 0.00, '2023-04-18', 'unpaid', 'in progress');

-- Dumping structure for table core_shopcart.order_details
CREATE TABLE IF NOT EXISTS `order_details` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int unsigned NOT NULL DEFAULT '0',
  `product_id` int unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '0',
  `price` float(11,2) unsigned NOT NULL DEFAULT '0.00',
  `qty` int unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_order_details_order_id` (`order_id`),
  KEY `fk_order_details_product_id` (`product_id`),
  CONSTRAINT `fk_order_details_order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_order_details_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table core_shopcart.order_details: ~5 rows (approximately)
INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `title`, `price`, `qty`) VALUES
	(6, 4, 15, 'Yi Kunbarrasaurus Zhuchengtitan', 150.00, 3),
	(7, 4, 237, 'Illum non ut eligendi quis.', 142.58, 1),
	(8, 4, 235, 'A repudiandae a aut id.', 0.62, 3),
	(9, 4, 233, 'Ut sed aut porro dolor.', 2.44, 1),
	(10, 4, 236, 'Odio enim quisquam et facere.', 464022.47, 10);

-- Dumping structure for table core_shopcart.products
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
) ENGINE=InnoDB AUTO_INCREMENT=239 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table core_shopcart.products: ~25 rows (approximately)
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
	(15, 'Yi Kunbarrasaurus Zhuchengtitan', 150.00, 'Yi Kunbarrasaurus Zhuchengtitan Citipati Aristosuchus Parasaurolophus Yangchuanosaurus', 'e12ea5171df816e7de10c320a7a8797a642158946afa1.jpg', 4, 1),
	(229, 'Doloribus expedita ut ut.', 582263.81, 'Qui mollitia ex et ipsum et ratione quidem. Atque ea qui sunt ex repudiandae quaerat et. Non ad autem consequuntur. Animi quaerat impedit tenetur qui facere et.', 'noimg.png', 14, 1),
	(230, 'Magni eum ipsa maxime.', 785994.12, 'Aut doloribus voluptatem aut expedita ut ullam. Excepturi voluptatem est ut ratione ad magni non. Odit aut sequi eos non voluptatum hic.', 'noimg.png', 14, 1),
	(231, 'Et porro unde et dicta quis.', 115542.00, 'Fugit debitis ad ut. Et dolores eligendi magnam omnis aut culpa. Aliquam accusamus harum voluptatem culpa eum. Consequatur vitae incidunt sint qui et ut labore. Minima consectetur consectetur tempore in aliquid rerum modi.', 'noimg.png', 14, 1),
	(232, 'Animi optio quia et velit.', 12.36, 'Necessitatibus mollitia deserunt ad nesciunt voluptates sunt sit. Ratione est eos numquam est pariatur magni. Aut et et enim nisi. Et corporis placeat sint dolor. Maxime aspernatur atque nihil. Et exercitationem dolores dolorem.', 'noimg.png', 14, 1),
	(233, 'Ut sed aut porro dolor.', 2.44, 'Libero quia nulla illum quis esse. Et temporibus quis velit est sed dolor inventore. Voluptatibus consequatur quae est repudiandae praesentium earum et. Placeat suscipit fugit consequatur est nihil.', 'noimg.png', 14, 1),
	(234, 'Quia non esse fugit qui qui.', 1.17, 'Totam voluptatem sit sed molestiae. Placeat soluta omnis accusamus. Inventore veniam placeat sapiente ut quae inventore sed dignissimos. At id doloribus a. Aut accusamus omnis sed. Sit illum nihil quo non explicabo consequatur.', 'noimg.png', 14, 1),
	(235, 'A repudiandae a aut id.', 0.62, 'Consequatur aliquid voluptatem ducimus dolore reprehenderit eos. Laudantium fugit rerum repudiandae sunt neque qui aspernatur. Optio provident nesciunt qui natus ad neque. Ab odit quas ut velit eum. Voluptates iusto aliquid at impedit omnis amet ut hic.', 'noimg.png', 14, 1),
	(236, 'Odio enim quisquam et facere.', 464022.47, 'Et animi voluptatum voluptatem facere quia est. Soluta est ducimus doloremque perspiciatis et. Qui accusantium ea voluptatem fugiat aut vel dolores. Culpa aut commodi nobis voluptate.', 'noimg.png', 14, 1),
	(237, 'Illum non ut eligendi quis.', 142.58, 'Quis accusamus distinctio omnis quo nostrum voluptas et tenetur. Molestias omnis ipsum tempora. Autem harum repudiandae mollitia optio nesciunt. Omnis repudiandae facilis est laboriosam est dolor eos vel.', 'noimg.png', 14, 1),
	(238, 'Aut laborum ad nobis quasi.', 5372413.50, 'Sint ut sit id dolore molestiae animi. Eos sequi officiis sint eligendi. Autem excepturi omnis ut distinctio natus. Ut aut quae sit laboriosam sed laboriosam.', 'noimg.png', 14, 1);

-- Dumping structure for table core_shopcart.roles
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
