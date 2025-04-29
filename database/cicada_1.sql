-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 29, 2025 at 02:30 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cicada_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

use `thestore_cicada_db`;

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `order` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1',
  `view` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `image`, `order`, `status`, `view`, `created_at`, `updated_at`) VALUES
(9, '1736658275.webp', '1', '1', 'mobile', '2025-01-11 23:34:35', '2025-01-11 23:35:36'),
(10, '1745910659.jpg', '1', '1', 'desktop', '2025-04-29 01:40:59', '2025-04-29 01:41:31');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `brand_icon` varchar(255) DEFAULT NULL,
  `brand_img` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `brand_status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand_name`, `brand_icon`, `brand_img`, `slug`, `brand_status`, `created_at`, `updated_at`) VALUES
(5, 'cicada', '1729068397.jpg', '1729068397.jpg', 'cicada', 1, '2024-10-16 03:16:37', '2024-11-26 04:24:53'),
(9, 'Nike', '1735197323.png', '1745916277.jpg', 'nike', 1, '2024-12-26 01:45:23', '2025-04-29 06:58:48');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_image` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_image`, `status`, `brand_id`, `slug`, `created_at`, `updated_at`) VALUES
(6, 'oversized t shirts', 'oversized_t_shirts_1732616664.jpg', 1, 5, 'oversized-t-shirts', '2024-10-16 05:32:06', '2025-04-29 06:31:16'),
(10, 'solid t shirts', 'solid_t_shirts_1745929184.webp', 1, 5, 'solid-t-shirts', '2024-10-24 08:42:52', '2025-04-29 06:49:44'),
(11, 'polos', 'polos_1745929174.webp', 1, 5, 'polos', '2024-10-24 08:44:13', '2025-04-29 06:49:38');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `mobile`, `email`, `message`, `created_at`, `updated_at`) VALUES
(2, 'Sam', '5675675675', 'sam@gmail.com', 'I need a exact deliver date', '2025-01-12 07:29:29', '2025-01-12 07:29:29');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

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
(13, '2024_10_20_105514_create_products_table', 8),
(14, '2025_01_11_100538_create_contacts_table', 9),
(15, '2025_01_11_133100_create_banners_table', 10),
(16, '2025_01_28_082022_create_orders_table', 11),
(17, '2025_01_28_095352_create_orderdetails_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `product_price` int(11) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `quantity` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`id`, `order_id`, `product_id`, `size`, `color`, `product_price`, `product_image`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 114, 'l', 'white', 799, 'http://127.0.0.1:8000/admin-files/products/supima_dark_grey_1729781997.webp', 2, '2025-04-29 03:27:34', '2025-04-29 03:27:34'),
(2, 2, 115, 'l', 'white', 799, 'http://127.0.0.1:8000/admin-files/products/rockstar_tee_chestnut_brown_1729782124.webp', 1, '2025-04-29 03:32:23', '2025-04-29 03:32:23'),
(3, 4, 114, 'l', 'white', 799, 'http://127.0.0.1:8000/admin-files/products/supima_dark_grey_1729781997.webp', 1, '2025-04-29 03:36:54', '2025-04-29 03:36:54');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `pincode` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `message` text DEFAULT NULL,
  `payment_method` varchar(255) NOT NULL,
  `payment_id` mediumtext DEFAULT NULL,
  `total_amount` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '0',
  `user_device` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_id`, `full_name`, `email`, `address`, `city`, `pincode`, `state`, `mobile`, `message`, `payment_method`, `payment_id`, `total_amount`, `status`, `user_device`, `created_at`, `updated_at`) VALUES
(1, 3, 'cicada_1001', 'Monis', 'karidef204@ancewa.com', 'sadsadas,sad asdasd asd', 'chenaiias', '675675', 'sadad asd', '5676576576', NULL, 'NETBANKING', '{\"success\":true,\"code\":\"PAYMENT_SUCCESS\",\"message\":\"Your payment is successful.\",\"data\":{\"merchantId\":\"PGTESTPAYUAT101\",\"merchantTransactionId\":\"681093f69bee8\",\"transactionId\":\"T2504291425190957400459\",\"amount\":100,\"state\":\"COMPLETED\",\"responseCode\":\"SUCCESS\",\"paymentInstrument\":{\"type\":\"NETBANKING\",\"bankTransactionId\":null,\"bankId\":null,\"arn\":\"12131261\"}}}', 1598, '0', 'Desktop', '2024-05-29 03:27:34', '2025-04-29 03:27:34'),
(2, 3, 'cicada_1002', 'monis', 'karidef204@ancewa.com', '34, asdasd a,asd ds', 'chennai', '657567', 'tamil nadu', '8978978987', NULL, 'cod', NULL, 799, '4', 'Desktop', '2025-01-29 03:32:23', '2025-04-29 03:55:13'),
(4, 1, 'cicada_1003', 'sadasd', 'karidef204@ancewa.com', '45d, asdasd', 'asdssad', '768678', 'fsdfds f', '7686787687', NULL, 'cod', NULL, 799, '3', 'Desktop', '2025-04-29 03:36:54', '2025-04-29 03:47:28');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('monis@gmail.com', '$2y$12$eaUO.JmZuGFjpgdnfxz7q.slqHBvvpa0aYZQJ1BNUBL7EQw.wUIfq', '2025-01-11 05:16:10'),
('yatibi5713@evusd.com', '$2y$12$D8p9ggUeBKtZx0UnB3oMUu7TAxu660PQyVlqa61DmzyIMmkd9q/qm', '2024-12-18 05:38:13');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `product_description` text DEFAULT NULL,
  `size` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `gender` enum('male','female','unisex') DEFAULT NULL,
  `actual_price` int(11) NOT NULL,
  `offer_price` int(11) NOT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `color` varchar(255) DEFAULT NULL,
  `main_img` varchar(255) NOT NULL,
  `additional_images` varchar(255) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 1,
  `trending` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `slug`, `product_description`, `size`, `quantity`, `gender`, `actual_price`, `offer_price`, `brand_id`, `category_id`, `color`, `main_img`, `additional_images`, `stock`, `trending`, `status`, `created_at`, `updated_at`) VALUES
(56, 'Eternal Rest Oversized T Shirt', 'eternal-rest-oversized-t-shirt', 'Unisex\r\n220 GSM\r\nFabric : 100% cotton\r\nSoft, Breathable and Oversized Fit', 's,m', 12, NULL, 100, 90, 5, 6, 'black,white', '1729434630.jpg', '1729434630_671514060e48a.jpg,1729434630_671514060e7f5.jpg', 1, 2, 1, '2024-10-20 03:30:30', '2024-10-20 03:40:37'),
(75, 'Squid Game: Survival 456', 'squid-game-survival-456', 'Oversized Polos\r\nShop for Squid Game: Survival 456 Men Oversized Polos at The Souled Store.', 's,m,l,xl,xxl', 5, NULL, 999, 799, 5, 11, 'black,white,green', '1729779776.webp', '1729779776_671a584055361.webp,1729779776_671a584055ba1.webp', 1, 1, 1, '2024-10-24 03:22:56', '2024-10-24 03:54:51'),
(76, 'Spider-Man: Webtastic', 'spider-man-webtastic', 'Official Licensed Spider-Man Oversized Polos Online.\r\n\r\nShop for Spider-man: Webtastic Mens Oversized Rugby Polos Online.', 'l,xl,xxl', 2, NULL, 1199, 1000, 5, 11, 'pink, blue, yellow', '1729779970.webp', '1729779970_671a590290e0b.webp,1729779970_671a590291720.webp', 1, 2, 1, '2024-10-24 03:26:10', '2024-10-24 03:26:10'),
(77, 'Marvel: Superhero Shades', 'marvel-superhero-shades', 'Buy Marvel: Superhero Shades Men Rugby Polos Online', 's,m,l,xl,xxl', 9, NULL, 1299, 799, 5, 11, 'black,white,maroon', 'marvel_superhero_shades_1729780599.webp', 'marvel_superhero_shades_1729780599_671a5b774ed05.webp,marvel_superhero_shades_1729780599_671a5b774f924.webp', 1, 2, 1, '2024-10-24 03:28:32', '2024-10-24 03:36:39'),
(108, 'ISRO: Mission To The Moon', 'isro-mission-to-the-moon', 'Shop for ISRO: Mission To The Moon Zipper Polos at The Souled Store.', 's,m,l,xl', 12, NULL, 1599, 1199, 5, 11, 'black,white,gray', 'isro_mission_to_the_moon_1729780756.webp', 'isro_mission_to_the_moon_1729780756_671a5c14d518b.webp,isro_mission_to_the_moon_1729780756_671a5c14d588f.webp', 1, 2, 1, '2024-10-24 03:39:16', '2024-10-24 03:39:16'),
(109, 'Batman: Justice', 'batman-justice', 'Official Licensed Batman Oversized T-Shirt.\r\n\r\nGotham needs a beacon of hope. Wear it on your chest! Designed for those who appreciate lounging around in style, these tees are a wardrobe essential.', 'm,l,xl', 12, NULL, 999, 799, 5, 6, 'black,white,red', 'batman_justice_1729781241.webp', 'batman_justice_1729781241_671a5df9a022f.webp,batman_justice_1729781241_671a5df9a0a7f.webp', 1, 1, 1, '2024-10-24 03:47:21', '2024-10-24 03:47:21'),
(110, 'Joker: Forever Evil', 'joker-forever-evil', 'Official Licensed Joker Oversized T-Shirt.\r\nMade for those who love the unpredictable. Comfortable, bold, and unapologetically rebellious â?? just like the Joker himself.', 's,m,l,xl', 15, NULL, 1999, 1599, 5, 6, 'black,white', 'joker_forever_evil_1729781376.webp', 'joker_forever_evil_1729781376_671a5e80ddb4d.webp,joker_forever_evil_1729781376_671a5e80de43d.webp', 1, 1, 1, '2024-10-24 03:49:36', '2024-10-24 03:49:36'),
(111, 'Kung Fu Panda: Back Off', 'kung-fu-panda-back-off', 'Official Licensed Kung Fu Panda Oversized T-Shirt.\r\nPerfect for any occasion, from casual outings to chilling at home, these tees are your new go-to\'s.', 's,m', 25, NULL, 999, 1599, 5, 6, 'black,white,gray', 'kung_fu_panda_back_off_1729781497.webp', 'kung_fu_panda_back_off_1729781497_671a5ef9924ac.webp,kung_fu_panda_back_off_1729781497_671a5ef992ad4.webp', 1, 1, 1, '2024-10-24 03:51:37', '2024-10-24 03:51:37'),
(112, 'Doctor Doom: Doomsday', 'doctor-doom-doomsday', 'Official Licensed Dr. Doom Oversized T-Shirt.\r\n\r\nWelcome to the BIGGEST LAUNCH of All Time!\r\n\r\nThe Souled Store is the first brand in India to launch the merch of Marvel\'s biggest Villain!', 's,m,l,xl,xxl', 50, NULL, 999, 1199, 5, 6, 'black,white', 'doctor_doom_doomsday_1729781623.webp', 'doctor_doom_doomsday_1729781623_671a5f7736873.webp,doctor_doom_doomsday_1729781623_671a5f7737447.webp', 1, 1, 1, '2024-10-24 03:53:43', '2024-10-24 03:53:43'),
(114, 'Supima: Dark Grey', 'supima-dark-grey', 'Make long lasting impressions wherever you go with this t-shirt from our Supima Collection that is made to last! Crafted from the world\'s strongest cotton, this t-shirt will surely stand the test of time and help create a number of great looks!', 's,m,l,xl', 3, NULL, 1000, 799, 5, 10, 'black,white,gray', 'supima_dark_grey_1729781997.webp', 'supima_dark_grey_1729781997_671a60ed8e10f.webp,supima_dark_grey_1729781997_671a60ed8ea93.webp', 1, 1, 1, '2024-10-24 03:59:57', '2024-10-24 03:59:57'),
(115, 'Rockstar Tee: Chestnut Brown', 'rockstar-tee-chestnut-brown', 'It\'s a hug! It\'s warmth! Nope, it\'s a Souled Store tee! Designed for those who appreciate lounging around in style, these tees are a wardrobe essential. Perfect for any occasion, from casual outings to chilling at home, these tees are your new go-to\'s.', 's,m,l,xl,xxl', 9, NULL, 999, 799, 5, 10, 'black,white,brown', 'rockstar_tee_chestnut_brown_1729782124.webp', 'rockstar_tee_chestnut_brown_1729782124_671a616cf3065.webp,rockstar_tee_chestnut_brown_1729782124_671a616cf39be.webp', 1, 1, 1, '2024-10-24 04:02:05', '2024-10-24 04:05:54'),
(116, 'Solid: Snow Blue', 'solid-snow-blue', 'Shop for Solid: Snow Blue T-Shirts Online', 's,m,l,xl,xxl', 51, NULL, 999, 799, 5, 10, NULL, 'solid_snow_blue_1729782292.webp', 'solid_snow_blue_1729782292_671a6214f14f2.webp', 1, 0, 0, '2024-10-24 04:04:53', '2025-04-29 06:41:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `mobile`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'leela', 'leelavathi0121@gmail.com', '6867867867', NULL, '$2y$12$UcWvkywiW45RM36F/KplkuQH0HnI6KJtV1HC.t2Ip.DwesERct3dq', 'user', 'gOGscrxcUaVyhskZpTFb5yG2djGSroTvzu0dZYzlOsO75m3SvvcgSwN0e6fP', '2024-10-01 09:14:51', '2024-10-01 09:14:51'),
(2, 'Yash', 'cicada@gmail.com', '9728934689', NULL, '$2y$12$rVhC6lq6WDBFWgBQE6NZz.Xxfz1.bwoLW6mmhwE4JHRGksp2dCBly', 'admin', NULL, '2023-12-18 04:58:52', '2025-04-29 03:16:51'),
(3, 'MoniLee', 'mohnish101998@gmail.com', '6456456883', NULL, '$2y$12$mDd5xjmYj65zyVYfvnqxwuoJxl0X14yvR3MIIjwR3MZWVjDaYO/om', 'user', 'G2JrdXnGMfWAybP6zcUoXTnXWJMtREmDg6hMNSUp1bqEXPY60Bp4GqnJnFJT', '2024-12-18 05:35:24', '2025-04-28 07:27:49'),
(4, 'Monss', 'karidef204@ancewa.com', '4534534534', NULL, '$2y$12$BTcf4rJjmLwPSy.kdLClz.5wh/w5Vh4dmTw63Uh.2tXMk/wroU7.i', 'user', 'ZZrRUr7Gq7gVAqO3GLsKSLGcqxyRzoCPH7cscP7YvHDvOruc8mgMrvfSdgUp', '2025-04-29 01:11:29', '2025-04-29 01:13:28'),
(5, 'manji', 'karidef204s@ancewa.com', '6567567787', NULL, '$2y$12$5w6eZS9N8XBeBq/tG2tXBOypVvkfCAva/QAxj/4UGD23CLxm6P.F.', 'user', NULL, '2025-04-29 01:19:32', '2025-04-29 01:19:32'),
(6, 'samso', 'kasridef204@ancewa.com', '5646565656', NULL, '$2y$12$ZJaXYB4.TZhuOxuYCFJj6ecyXCAE7iwq7Z1FQ1zess8rs6YIGgQKu', 'user', NULL, '2025-04-29 01:24:12', '2025-04-29 01:24:12'),
(7, 'Ashtyn Koelpin', 'lizeth14@example.org', '9339354346', '2025-04-29 06:12:01', '$2y$12$Y7YdnaIjU0N6Kd.1ZmVKAeGfJY2MEaZDSu6EWdQG.0wyvpcT.7Wd6', 'user', 'URscZ4T2Xn', '2024-06-27 11:44:31', '2025-04-29 06:12:02'),
(8, 'Torrey Schowalter', 'lyda70@example.com', '8920501775', '2025-04-29 06:12:02', '$2y$12$Y7YdnaIjU0N6Kd.1ZmVKAeGfJY2MEaZDSu6EWdQG.0wyvpcT.7Wd6', 'user', 'U9qS7nXNDy', '2024-09-09 13:37:45', '2025-04-29 06:12:02'),
(9, 'Della Rohan DVM', 'gdeckow@example.net', '1666080846', '2025-04-29 06:12:02', '$2y$12$Y7YdnaIjU0N6Kd.1ZmVKAeGfJY2MEaZDSu6EWdQG.0wyvpcT.7Wd6', 'user', 'yMw0hbfbG8', '2024-11-16 02:27:43', '2025-04-29 06:12:02'),
(10, 'Ofelia Kulas', 'raymundo.hahn@example.com', '3977269046', '2025-04-29 06:12:02', '$2y$12$Y7YdnaIjU0N6Kd.1ZmVKAeGfJY2MEaZDSu6EWdQG.0wyvpcT.7Wd6', 'user', 'mj5feQS3Nc', '2024-08-22 02:39:02', '2025-04-29 06:12:02'),
(11, 'Friedrich Ritchie', 'flangosh@example.net', '8549507977', '2025-04-29 06:12:02', '$2y$12$Y7YdnaIjU0N6Kd.1ZmVKAeGfJY2MEaZDSu6EWdQG.0wyvpcT.7Wd6', 'user', 'AIyIky0JFr', '2024-07-03 01:52:42', '2025-04-29 06:12:02'),
(12, 'Dominic Stoltenberg', 'juliana04@example.org', '7903516923', '2025-04-29 06:12:02', '$2y$12$Y7YdnaIjU0N6Kd.1ZmVKAeGfJY2MEaZDSu6EWdQG.0wyvpcT.7Wd6', 'user', 'MIVEIJVJef', '2024-09-13 02:05:56', '2025-04-29 06:12:02'),
(13, 'Stella Casper I', 'zachary04@example.org', '0626470200', '2025-04-29 06:12:02', '$2y$12$Y7YdnaIjU0N6Kd.1ZmVKAeGfJY2MEaZDSu6EWdQG.0wyvpcT.7Wd6', 'user', 'arVHlm0B4O', '2024-06-15 02:26:29', '2025-04-29 06:12:02'),
(14, 'Ms. Ramona Wiza PhD', 'timothy55@example.com', '2098122775', '2025-04-29 06:12:02', '$2y$12$Y7YdnaIjU0N6Kd.1ZmVKAeGfJY2MEaZDSu6EWdQG.0wyvpcT.7Wd6', 'user', 'omRATnhchk', '2024-06-14 12:41:59', '2025-04-29 06:12:02'),
(15, 'Prof. Lelia Lang', 'swill@example.net', '1658777351', '2025-04-29 06:12:02', '$2y$12$Y7YdnaIjU0N6Kd.1ZmVKAeGfJY2MEaZDSu6EWdQG.0wyvpcT.7Wd6', 'user', 'aGo7rERp7T', '2024-08-07 20:04:29', '2025-04-29 06:12:02'),
(16, 'Ruthe Koch', 'hosea99@example.org', '3580793580', '2025-04-29 06:12:02', '$2y$12$Y7YdnaIjU0N6Kd.1ZmVKAeGfJY2MEaZDSu6EWdQG.0wyvpcT.7Wd6', 'user', 'rZ8MV9e7bt', '2025-03-31 07:15:56', '2025-04-29 06:12:02'),
(17, 'Mathias Watsica', 'brisa84@example.org', '5371226974', '2025-04-29 06:12:02', '$2y$12$Y7YdnaIjU0N6Kd.1ZmVKAeGfJY2MEaZDSu6EWdQG.0wyvpcT.7Wd6', 'user', 'Z172Dh0MnH', '2025-01-16 17:06:36', '2025-04-29 06:12:02'),
(18, 'Dr. Hailey Doyle MD', 'emerald.kassulke@example.com', '3483507818', '2025-04-29 06:12:02', '$2y$12$Y7YdnaIjU0N6Kd.1ZmVKAeGfJY2MEaZDSu6EWdQG.0wyvpcT.7Wd6', 'user', 'FVZZyOkVCv', '2024-08-01 04:17:27', '2025-04-29 06:12:02'),
(19, 'Prof. Reinhold Dibbert', 'lavina18@example.net', '3102125286', '2025-04-29 06:12:02', '$2y$12$Y7YdnaIjU0N6Kd.1ZmVKAeGfJY2MEaZDSu6EWdQG.0wyvpcT.7Wd6', 'user', 't1WJLJYWQP', '2024-10-10 20:00:13', '2025-04-29 06:12:02'),
(20, 'Larue Rodriguez MD', 'margot73@example.com', '3432627477', '2025-04-29 06:12:02', '$2y$12$Y7YdnaIjU0N6Kd.1ZmVKAeGfJY2MEaZDSu6EWdQG.0wyvpcT.7Wd6', 'user', 'a9JK1pxmWd', '2024-06-13 12:21:49', '2025-04-29 06:12:02'),
(21, 'Prof. Ross Rowe', 'bednar.anastasia@example.net', '2266324226', '2025-04-29 06:12:02', '$2y$12$Y7YdnaIjU0N6Kd.1ZmVKAeGfJY2MEaZDSu6EWdQG.0wyvpcT.7Wd6', 'user', 'Tg58jJ5Bgl', '2024-11-26 09:22:47', '2025-04-29 06:12:02'),
(22, 'Caitlyn Kutch', 'heathcote.americo@example.org', '1971162992', '2025-04-29 06:12:02', '$2y$12$Y7YdnaIjU0N6Kd.1ZmVKAeGfJY2MEaZDSu6EWdQG.0wyvpcT.7Wd6', 'user', 'XHE4ybTZvz', '2025-02-15 08:39:52', '2025-04-29 06:12:02'),
(23, 'Braulio Gleichner', 'clara58@example.com', '4850494021', '2025-04-29 06:12:02', '$2y$12$Y7YdnaIjU0N6Kd.1ZmVKAeGfJY2MEaZDSu6EWdQG.0wyvpcT.7Wd6', 'user', 'osPmOWrl6f', '2024-08-06 01:07:01', '2025-04-29 06:12:02'),
(24, 'Celine Kemmer PhD', 'brendon.romaguera@example.com', '7780177801', '2025-04-29 06:12:02', '$2y$12$Y7YdnaIjU0N6Kd.1ZmVKAeGfJY2MEaZDSu6EWdQG.0wyvpcT.7Wd6', 'user', 'i2H0hhUKJi', '2024-08-13 16:33:55', '2025-04-29 06:12:02'),
(25, 'Nina Hane', 'eliza.walker@example.org', '7260277901', '2025-04-29 06:12:02', '$2y$12$Y7YdnaIjU0N6Kd.1ZmVKAeGfJY2MEaZDSu6EWdQG.0wyvpcT.7Wd6', 'user', 'EmQRTr6RHM', '2024-12-16 17:49:32', '2025-04-29 06:12:02'),
(26, 'Haven Graham', 'fay.stone@example.net', '1270372746', '2025-04-29 06:12:02', '$2y$12$Y7YdnaIjU0N6Kd.1ZmVKAeGfJY2MEaZDSu6EWdQG.0wyvpcT.7Wd6', 'user', 'N7Z6u5nsrF', '2025-01-03 22:00:33', '2025-04-29 06:12:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_slug_unique` (`slug`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderdetails_order_id_foreign` (`order_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `orderdetails_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
