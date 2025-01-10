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


-- Dumping database structure for cicada_1
CREATE DATABASE IF NOT EXISTS `cicada_1` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `cicada_1`;

-- Dumping structure for table cicada_1.brands
CREATE TABLE IF NOT EXISTS `brands` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_status` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `brands_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cicada_1.brands: ~2 rows (approximately)
INSERT INTO `brands` (`id`, `brand_name`, `brand_icon`, `brand_img`, `slug`, `brand_status`, `created_at`, `updated_at`) VALUES
	(5, 'cicada', '1729068397.jpg', '1729068397.jpg', 'cicada', 1, '2024-10-16 03:16:37', '2024-11-26 04:24:53'),
	(9, 'Nike', '1735197323.png', '1735197323.jpg', 'nike', 1, '2024-12-26 01:45:23', '2025-01-10 05:21:10');

-- Dumping structure for table cicada_1.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `brand_id` bigint unsigned DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`),
  KEY `categories_brand_id_foreign` (`brand_id`),
  CONSTRAINT `categories_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cicada_1.categories: ~4 rows (approximately)
INSERT INTO `categories` (`id`, `category_name`, `category_image`, `status`, `brand_id`, `slug`, `created_at`, `updated_at`) VALUES
	(6, 'oversized t shirts', 'oversized_t_shirts_1732616664.jpg', 1, 5, 'oversized-t-shirts', '2024-10-16 05:32:06', '2024-11-26 04:54:24'),
	(10, 'solid t shirts', '1729779172.jpg', 1, 5, 'solid-t-shirts', '2024-10-24 08:42:52', '2024-10-24 08:42:52'),
	(11, 'polos', '1729779274.jpg', 1, 5, 'polos', '2024-10-24 08:44:13', '2024-10-24 08:44:34'),
	(13, 'Running Shoes', 'running_shoes_1736507370.jpg', 1, 9, 'running-shoes', '2025-01-10 05:39:30', '2025-01-10 05:39:30');

-- Dumping structure for table cicada_1.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cicada_1.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table cicada_1.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cicada_1.migrations: ~12 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2014_10_12_100000_create_password_resets_table', 1),
	(4, '2019_08_19_000000_create_failed_jobs_table', 1),
	(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(6, '2024_10_14_143043_create_brands_table', 2),
	(7, '2024_10_14_145150_update_brands_table_add_status', 3),
	(8, '2024_10_16_085923_create_categories_table', 4),
	(9, '2024_10_16_100610_add_slug_to_categories_table', 5),
	(10, '2024_10_16_154117_create_products_table', 6),
	(11, '2024_10_20_103744_drop_table_name_table', 7),
	(13, '2024_10_20_105514_create_products_table', 8);

-- Dumping structure for table cicada_1.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cicada_1.password_resets: ~0 rows (approximately)

-- Dumping structure for table cicada_1.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cicada_1.password_reset_tokens: ~0 rows (approximately)
INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
	('yatibi5713@evusd.com', '$2y$12$D8p9ggUeBKtZx0UnB3oMUu7TAxu660PQyVlqa61DmzyIMmkd9q/qm', '2024-12-18 05:38:13');

-- Dumping structure for table cicada_1.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cicada_1.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table cicada_1.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL,
  `gender` enum('male','female','unisex') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `actual_price` int NOT NULL,
  `offer_price` int NOT NULL,
  `brand_id` bigint unsigned DEFAULT NULL,
  `category_id` bigint unsigned NOT NULL,
  `color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `additional_images` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int NOT NULL DEFAULT '1',
  `trending` int NOT NULL DEFAULT '1',
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_brand_id_foreign` (`brand_id`),
  KEY `products_category_id_foreign` (`category_id`),
  CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=141 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cicada_1.products: ~14 rows (approximately)
INSERT INTO `products` (`id`, `product_name`, `slug`, `product_description`, `size`, `quantity`, `gender`, `actual_price`, `offer_price`, `brand_id`, `category_id`, `color`, `main_img`, `additional_images`, `stock`, `trending`, `status`, `created_at`, `updated_at`) VALUES
	(56, 'Eternal Rest Oversized T Shirt', 'eternal-rest-oversized-t-shirt', 'Unisex\r\n220 GSM\r\nFabric : 100% cotton\r\nSoft, Breathable and Oversized Fit', 's,m', 12, NULL, 100, 90, 5, 6, 'black,white', '1729434630.jpg', '1729434630_671514060e48a.jpg,1729434630_671514060e7f5.jpg', 1, 1, 1, '2024-10-20 03:30:30', '2024-10-20 03:40:37'),
	(75, 'Squid Game: Survival 456', 'squid-game-survival-456', 'Oversized Polos\r\nShop for Squid Game: Survival 456 Men Oversized Polos at The Souled Store.', 's,m,l,xl,xxl', 5, NULL, 999, 799, 5, 11, 'black,white,green', '1729779776.webp', '1729779776_671a584055361.webp,1729779776_671a584055ba1.webp', 1, 1, 1, '2024-10-24 03:22:56', '2024-10-24 03:54:51'),
	(76, 'Spider-Man: Webtastic', 'spider-man-webtastic', 'Official Licensed Spider-Man Oversized Polos Online.\r\n\r\nShop for Spider-man: Webtastic Mens Oversized Rugby Polos Online.', 'l,xl,xxl', 2, NULL, 1199, 1000, 5, 11, 'pink, blue, yellow', '1729779970.webp', '1729779970_671a590290e0b.webp,1729779970_671a590291720.webp', 1, 2, 1, '2024-10-24 03:26:10', '2024-10-24 03:26:10'),
	(77, 'Marvel: Superhero Shades', 'marvel-superhero-shades', 'Buy Marvel: Superhero Shades Men Rugby Polos Online', 's,m,l,xl,xxl', 9, NULL, 1299, 799, 5, 11, 'black,white,maroon', 'marvel_superhero_shades_1729780599.webp', 'marvel_superhero_shades_1729780599_671a5b774ed05.webp,marvel_superhero_shades_1729780599_671a5b774f924.webp', 1, 2, 1, '2024-10-24 03:28:32', '2024-10-24 03:36:39'),
	(108, 'ISRO: Mission To The Moon', 'isro-mission-to-the-moon', 'Shop for ISRO: Mission To The Moon Zipper Polos at The Souled Store.', 's,m,l,xl', 12, NULL, 1599, 1199, 5, 11, 'black,white,gray', 'isro_mission_to_the_moon_1729780756.webp', 'isro_mission_to_the_moon_1729780756_671a5c14d518b.webp,isro_mission_to_the_moon_1729780756_671a5c14d588f.webp', 1, 2, 1, '2024-10-24 03:39:16', '2024-10-24 03:39:16'),
	(109, 'Batman: Justice', 'batman-justice', 'Official Licensed Batman Oversized T-Shirt.\r\n\r\nGotham needs a beacon of hope. Wear it on your chest! Designed for those who appreciate lounging around in style, these tees are a wardrobe essential.', 'm,l,xl', 12, NULL, 999, 799, 5, 6, 'black,white,red', 'batman_justice_1729781241.webp', 'batman_justice_1729781241_671a5df9a022f.webp,batman_justice_1729781241_671a5df9a0a7f.webp', 1, 1, 1, '2024-10-24 03:47:21', '2024-10-24 03:47:21'),
	(110, 'Joker: Forever Evil', 'joker-forever-evil', 'Official Licensed Joker Oversized T-Shirt.\r\nMade for those who love the unpredictable. Comfortable, bold, and unapologetically rebellious â?? just like the Joker himself.', 's,m,l,xl', 15, NULL, 1999, 1599, 5, 6, 'black,white', 'joker_forever_evil_1729781376.webp', 'joker_forever_evil_1729781376_671a5e80ddb4d.webp,joker_forever_evil_1729781376_671a5e80de43d.webp', 1, 1, 1, '2024-10-24 03:49:36', '2024-10-24 03:49:36'),
	(111, 'Kung Fu Panda: Back Off', 'kung-fu-panda-back-off', 'Official Licensed Kung Fu Panda Oversized T-Shirt.\r\nPerfect for any occasion, from casual outings to chilling at home, these tees are your new go-to\'s.', 's,m', 25, NULL, 999, 1599, 5, 6, 'black,white,gray', 'kung_fu_panda_back_off_1729781497.webp', 'kung_fu_panda_back_off_1729781497_671a5ef9924ac.webp,kung_fu_panda_back_off_1729781497_671a5ef992ad4.webp', 1, 1, 1, '2024-10-24 03:51:37', '2024-10-24 03:51:37'),
	(112, 'Doctor Doom: Doomsday', 'doctor-doom-doomsday', 'Official Licensed Dr. Doom Oversized T-Shirt.\r\n\r\nWelcome to the BIGGEST LAUNCH of All Time!\r\n\r\nThe Souled Store is the first brand in India to launch the merch of Marvel\'s biggest Villain!', 's,m,l,xl,xxl', 50, NULL, 999, 1199, 5, 6, 'black,white', 'doctor_doom_doomsday_1729781623.webp', 'doctor_doom_doomsday_1729781623_671a5f7736873.webp,doctor_doom_doomsday_1729781623_671a5f7737447.webp', 1, 1, 1, '2024-10-24 03:53:43', '2024-10-24 03:53:43'),
	(113, 'Batman: Bat Signal Tie Dye', 'batman-bat-signal-tie-dye', 'Official Licensed Batman Oversized T-shirt.\r\n\r\nCrime fighting vigilante by night, take off the suit and he is intelligent, a great fighter and a billionaire industrialist by day!', 's,m,l,xl,xxl', 35, NULL, 1999, 1799, 5, 6, 'black,white,gray', 'batman_bat_signal_tie_dye_1729781891.webp', 'batman_bat_signal_tie_dye_1729781891_671a6083b60b8.webp,batman_bat_signal_tie_dye_1729781891_671a6083b67a3.webp', 1, 1, 1, '2024-10-24 03:58:11', '2024-10-24 03:58:11'),
	(114, 'Supima: Dark Grey', 'supima-dark-grey', 'Make long lasting impressions wherever you go with this t-shirt from our Supima Collection that is made to last! Crafted from the world\'s strongest cotton, this t-shirt will surely stand the test of time and help create a number of great looks!', 's,m,l,xl', 3, NULL, 1000, 799, 5, 10, 'black,white,gray', 'supima_dark_grey_1729781997.webp', 'supima_dark_grey_1729781997_671a60ed8e10f.webp,supima_dark_grey_1729781997_671a60ed8ea93.webp', 1, 1, 1, '2024-10-24 03:59:57', '2024-10-24 03:59:57'),
	(115, 'Rockstar Tee: Chestnut Brown', 'rockstar-tee-chestnut-brown', 'It\'s a hug! It\'s warmth! Nope, it\'s a Souled Store tee! Designed for those who appreciate lounging around in style, these tees are a wardrobe essential. Perfect for any occasion, from casual outings to chilling at home, these tees are your new go-to\'s.', 's,m,l,xl,xxl', 9, NULL, 999, 799, 5, 10, 'black,white,brown', 'rockstar_tee_chestnut_brown_1729782124.webp', 'rockstar_tee_chestnut_brown_1729782124_671a616cf3065.webp,rockstar_tee_chestnut_brown_1729782124_671a616cf39be.webp', 1, 1, 1, '2024-10-24 04:02:05', '2024-10-24 04:05:54'),
	(116, 'Solid: Snow Blue', 'solid-snow-blue', 'Shop for Solid: Snow Blue T-Shirts Online', 's,m,l,xl,xxl', 51, NULL, 999, 799, 5, 10, '', 'solid_snow_blue_1729782292.webp', 'solid_snow_blue_1729782292_671a6214f062d.webp,solid_snow_blue_1729782292_671a6214f14f2.webp', 1, 1, 1, '2024-10-24 04:04:53', '2024-10-24 04:05:27'),
	(140, 'Nike Mens Revolution 7 Men\'s Road', 'nike-mens-revolution-7-mens-road', NULL, 'xl', 20, NULL, 999, 599, 9, 13, NULL, 'nike_mens_revolution_7_mens_road_1736507662.jpg', 'nike_mens_revolution_7_mens_road_1736507662_6781010e602a8.jpg', 1, 1, 1, '2025-01-10 05:44:22', '2025-01-10 05:44:22');

-- Dumping structure for table cicada_1.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('user','admin') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cicada_1.users: ~3 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `mobile`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'leela', 'leelavathi0121@gmail.com', '6867867867', NULL, '$2y$12$UcWvkywiW45RM36F/KplkuQH0HnI6KJtV1HC.t2Ip.DwesERct3dq', 'user', 'gOGscrxcUaVyhskZpTFb5yG2djGSroTvzu0dZYzlOsO75m3SvvcgSwN0e6fP', '2024-10-01 09:14:51', '2024-10-01 09:14:51'),
	(2, 'Monis', 'monis@gmail.com', '9728934689', NULL, '$2y$12$cafoolE13b1.FCB3Nzm9/eKsG7YwG3S28Bc/P7J6yERo9aGMaIjPG', 'admin', NULL, '2024-12-18 04:58:52', '2025-01-10 09:01:21'),
	(3, 'MoniLee', 'yatibi5713@evusd.com', '6456456888', NULL, '$2y$12$T2CDyy9JX3GTW2m9iZ5UHO4VYxf/n.vpLD.QeBvkA336Mxdbe5BLS', 'user', NULL, '2024-12-18 05:35:24', '2024-12-18 05:35:24');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
