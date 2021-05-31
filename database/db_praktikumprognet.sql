/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 10.4.17-MariaDB : Database - db_praktikum_prognet
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_praktikum_prognet` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_praktikum_prognet`;

/*Table structure for table `admin_notifications` */

DROP TABLE IF EXISTS `admin_notifications`;

CREATE TABLE `admin_notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` int(10) unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `seller_notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`),
  KEY `notifiable_id` (`notifiable_id`),
  CONSTRAINT `admin_notifications_ibfk_1` FOREIGN KEY (`notifiable_id`) REFERENCES `admins` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `admin_notifications` */

/*Table structure for table `admins` */

DROP TABLE IF EXISTS `admins`;

CREATE TABLE `admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sellers_email_unique` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `admins` */

insert  into `admins`(`id`,`username`,`password`,`name`,`profile_image`,`phone`,`remember_token`,`created_at`,`updated_at`) values (1,'admincoba@gmail.com','123456','Admin Coba','def.jpg','01929981',NULL,'2021-05-31 04:13:49',NULL);

/*Table structure for table `carts` */

DROP TABLE IF EXISTS `carts`;

CREATE TABLE `carts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('checkedout','notyet','cancelled') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `carts` */

/*Table structure for table `couriers` */

DROP TABLE IF EXISTS `couriers`;

CREATE TABLE `couriers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `courier` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `couriers` */

insert  into `couriers`(`id`,`courier`,`created_at`,`updated_at`) values (1,'JNE','2021-04-17 20:06:28','2021-04-17 20:06:41'),(3,'Ninja Express','2021-04-18 22:04:50','2021-04-18 22:04:50'),(4,'SiCepat','2021-04-19 08:54:42','2021-04-19 08:54:42'),(5,'POS Indonesia','2021-05-12 12:35:11','2021-05-12 12:35:11'),(6,'J&T Express','2021-05-12 12:35:37','2021-05-12 12:35:37');

/*Table structure for table `discounts` */

DROP TABLE IF EXISTS `discounts`;

CREATE TABLE `discounts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_product` int(10) unsigned DEFAULT NULL,
  `percentage` int(3) DEFAULT NULL,
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_product` (`id_product`),
  CONSTRAINT `discounts_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `discounts` */

insert  into `discounts`(`id`,`id_product`,`percentage`,`start`,`end`,`created_at`,`updated_at`) values (1,4,15,'2021-05-15','2021-05-17','2021-05-14 13:55:12','2021-05-14 14:43:59'),(6,1,2,'2021-05-14','2021-05-15','2021-05-15 00:05:12','2021-05-15 00:05:12'),(7,1,12,'2021-05-14','2021-05-15','2021-05-15 00:08:11','2021-05-15 00:08:11');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_02_15_123603_create_admins_table',1),(4,'2019_02_15_123744_create_sellers_table',1),(5,'2019_02_15_125445_create_products_table',1),(6,'2019_02_15_130341_create_product_images_table',1),(7,'2019_02_15_131114_create_transactions_table',1),(8,'2019_02_15_131132_create_transaction_details_table',1),(9,'2019_02_15_132352_create_product_categories_table',1),(10,'2019_02_15_132701_create_carts_table',1),(11,'2019_02_15_134220_create_wishlists_table',1),(12,'2019_02_16_044815_create_rates_table',1),(13,'2019_02_16_045411_create_product_reviews_table',1),(14,'2019_02_16_062504_create_qna_products_table',1),(15,'2019_02_16_063238_create_shopping_voucers_table',1),(16,'2019_02_16_064643_create_couriers_table',1),(17,'2019_02_16_102028_create_notifications_table',1),(18,'2019_02_16_103007_create_seller_notifications_table',1),(19,'2019_02_16_103024_create_user_notifications_table',1),(20,'2019_08_19_000000_create_failed_jobs_table',2),(21,'2021_04_28_130556_add_deleted_at_to_products_table',2),(22,'2021_05_02_112620_add_deleted_at_to_products_table',3),(23,'2021_05_02_113337_add_deleted_at_to_product_categories_table',4),(24,'2014_10_12_200000_add_two_factor_columns_to_users_table',5),(25,'2019_12_14_000001_create_personal_access_tokens_table',5),(26,'2021_02_28_053154_create_sessions_table',5);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `product_categories` */

DROP TABLE IF EXISTS `product_categories`;

CREATE TABLE `product_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `product_categories` */

insert  into `product_categories`(`id`,`category_name`,`created_at`,`updated_at`,`deleted_at`) values (1,'Handphone',NULL,NULL,NULL),(2,'Kamera',NULL,NULL,NULL),(3,'TV',NULL,NULL,NULL),(4,'Kulkas',NULL,NULL,NULL),(5,'Laptop',NULL,NULL,NULL),(7,'Oven Listrik','2021-04-19 04:01:10','2021-05-02 19:56:33',NULL),(8,'Kipas Angin Listrik','2021-04-20 17:49:07','2021-05-02 19:54:45',NULL);

/*Table structure for table `product_category_details` */

DROP TABLE IF EXISTS `product_category_details`;

CREATE TABLE `product_category_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `product_category_details_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `product_category_details_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `product_categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

/*Data for the table `product_category_details` */

insert  into `product_category_details`(`id`,`product_id`,`category_id`,`created_at`,`updated_at`,`deleted_at`) values (1,1,1,'2021-04-17 05:33:14','0000-00-00 00:00:00',NULL),(2,1,2,'2021-04-17 05:33:46','0000-00-00 00:00:00',NULL),(3,2,2,'2021-04-17 11:44:08','0000-00-00 00:00:00',NULL),(4,3,5,'2021-04-17 12:27:38','0000-00-00 00:00:00',NULL),(5,8,1,'2021-04-17 22:13:27','2021-04-17 22:13:27',NULL),(6,8,2,'2021-04-17 22:13:28','2021-04-17 22:13:28',NULL),(9,4,3,'2021-04-19 11:58:36','0000-00-00 00:00:00',NULL),(13,5,4,'2021-04-19 11:59:04','0000-00-00 00:00:00',NULL),(14,6,1,'2021-04-19 11:59:30','0000-00-00 00:00:00',NULL),(15,7,1,'2021-04-19 11:59:45','0000-00-00 00:00:00',NULL),(16,10,7,'2021-04-20 13:21:35','2021-04-20 13:21:35',NULL),(19,12,1,'2021-05-03 03:50:04','2021-05-02 19:50:04','2021-05-02 19:50:04'),(25,14,1,'2021-05-03 10:44:56','2021-05-03 10:44:56',NULL),(26,14,2,'2021-05-03 10:44:56','2021-05-03 10:44:56',NULL),(28,11,5,'2021-05-08 20:21:47','2021-05-08 20:21:47',NULL),(29,15,3,'2021-05-08 20:25:53','2021-05-08 20:25:53',NULL),(32,16,8,'2021-05-31 17:50:02','2021-05-31 17:50:02',NULL);

/*Table structure for table `product_images` */

DROP TABLE IF EXISTS `product_images`;

CREATE TABLE `product_images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `image_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `product_images` */

insert  into `product_images`(`id`,`product_id`,`image_name`,`created_at`,`updated_at`,`deleted_at`) values (1,1,'vivoy17.jpg','2021-04-16 03:42:20',NULL,NULL),(2,1,'6079e57f17891-inilah-perbandingan-harga-dan-spesifikasi-vivo-y15-dan-vivo-y17.jpg','2021-04-16 03:42:35','2021-04-17 03:29:03',NULL),(3,2,'canon700d.jpg','2021-04-16 03:42:39','2021-05-15 00:47:24','2021-05-15 00:47:24'),(4,3,'6079f39f7a860-1496191521.jpg','2021-04-16 03:42:49','2021-04-17 04:29:19',NULL),(8,4,'LG_32_in_32LJ500D_L_1.jpg','2021-04-17 04:34:56','2021-04-17 04:34:56',NULL),(9,5,'harga-kulkas-sharp-2-pintu-tanpa-bunga-es.jpg','2021-04-17 12:18:07','2021-04-17 12:18:07',NULL),(10,6,'oppo-reno.jpg','2021-04-17 20:48:26','2021-04-17 20:48:26',NULL),(11,7,'samsung-galaxy-a02s-harga-sejutaan.jpg','2021-04-17 21:34:44','2021-04-17 21:34:44',NULL),(12,8,'OPPO_A15_L_1.jpg','2021-04-17 22:13:27','2021-04-19 03:51:33',NULL),(14,8,'607c91d5b14f8-oppo_oppo_a15_ram_3-32_garansi_resmi_oppo_full03_edf2ytp1.jpg','2021-04-19 12:08:11','2021-04-19 04:08:53',NULL),(15,10,'oven-mito-fantasy-mo-888-1.jpg','2021-04-20 13:21:35','2021-04-20 13:21:35',NULL),(16,11,'Acer-Nitro-5-2.jpg','2021-04-20 13:41:35','2021-04-20 13:41:35',NULL),(17,11,'5faba7e658056.jpg','2021-04-20 13:41:35','2021-04-20 13:41:35',NULL),(18,12,'607ea3251b90d-Acer-Nitro-5-2.jpg','2021-04-20 17:44:37','2021-05-02 19:50:04','2021-05-02 19:50:04'),(20,14,'1778209.jpg','2021-05-03 10:44:56','2021-05-03 10:44:56',NULL),(21,15,'1e407625b1a91fdbe668061da6a684ab.jpg','2021-05-08 20:25:53','2021-05-15 00:46:51','2021-05-15 00:46:51'),(22,15,'4eee6b0bcf6cc9c8bec921a8ab291975.jpg','2021-05-08 20:25:53','2021-05-08 20:25:53',NULL),(23,2,'canon700d.jpg','2021-05-15 01:33:48','2021-05-31 03:53:59',NULL),(24,2,'1620984864_01dfefa0b8c90feee70470811e5c6ad8--the-sun-the-ojays.jpg','2021-05-15 01:34:24','2021-05-31 03:53:44','2021-05-31 03:53:44'),(25,2,'1620984864_1d89faac48d93ca3a2b6137578b880dd.jpg','2021-05-15 01:34:24','2021-05-31 03:53:40','2021-05-31 03:53:40'),(26,4,'1620984977_58c8a7cc3af4731d42e272e59ed3406c.jpg','2021-05-15 01:36:17','2021-05-15 01:36:17',NULL),(27,4,'1620985122_73c13e26b7bab817a0da0939b790e170.jpg','2021-05-15 01:38:42','2021-05-15 01:38:42',NULL),(28,15,'1621026037_soobin.jpg','2021-05-15 13:00:37','2021-05-15 13:00:37',NULL),(29,16,'yeonjun.jpg','2021-05-15 13:50:02','2021-05-15 13:50:02',NULL),(30,16,'1621681835_IMG_20210518_151941.jpg','2021-05-23 03:10:35','2021-05-23 03:12:59','2021-05-23 03:12:59'),(31,16,'1621681880_1905551044_Prabhaisvari Sadhaka_Pemrograman Mobile D_19-5-2021.png','2021-05-23 03:11:20','2021-05-23 03:11:41','2021-05-23 03:11:41'),(32,16,'IMG_20210518_151941.jpg','2021-05-23 03:11:20','2021-05-23 03:16:35',NULL),(33,6,'1622404562_OPPO_Reno5_L_1.jpg','2021-05-31 03:56:02','2021-05-31 03:56:02',NULL);

/*Table structure for table `product_reviews` */

DROP TABLE IF EXISTS `product_reviews`;

CREATE TABLE `product_reviews` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `rate` int(1) NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `rate_id` (`rate`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `product_reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `product_reviews_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `product_reviews` */

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_rate` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stock` int(10) DEFAULT NULL,
  `weight` int(3) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `products` */

insert  into `products`(`id`,`product_name`,`price`,`description`,`product_rate`,`created_at`,`updated_at`,`stock`,`weight`,`deleted_at`) values (1,'Vivo Y17',2000000,'Ini handphone.',NULL,NULL,'2021-04-19 03:52:02',100,140,NULL),(2,'Canon EOS 700D',5000000,'Ini kamera.',NULL,NULL,NULL,50,100,NULL),(3,'Asus TUF A15',14000000,'Ini laptop gaming terbaru.',NULL,'2021-04-17 04:23:05','2021-04-17 05:47:37',30,2300,NULL),(4,'LG Digital Smart LED TV',2450000,'Ini TV LED terbaru.',NULL,'2021-04-17 04:34:56','2021-04-17 05:46:10',15,4000,NULL),(5,'Sharp SJ-F231S',3200000,'Ini kulkas dua pintu.',NULL,'2021-04-17 12:18:07','2021-04-17 12:18:07',40,41000,NULL),(6,'Oppo Reno 5',3500000,'Ini hp Oppo terbaru.',NULL,'2021-04-17 20:48:26','2021-04-17 20:48:26',25,140,NULL),(7,'Samsung A02S',1700000,'Ini hp Samsung terbaru.',NULL,'2021-04-17 21:34:44','2021-04-17 21:34:44',10,140,NULL),(8,'Oppo A15',1299000,'Ini handphone terbaru.',NULL,'2021-04-17 22:13:27','2021-04-20 13:10:09',10,140,NULL),(10,'Electric Oven FANTASY 33L Mito MO-888 MO888',1300000,'Ini oven listrik.',NULL,'2021-04-20 13:21:35','2021-04-20 13:21:35',20,7000,NULL),(11,'ACER Nitro 5 AN515-54-72T8',18550000,'Ini laptop gaming terbaru',NULL,'2021-04-20 13:41:35','2021-05-08 20:21:46',15,1000,NULL),(12,'Laptop Asus',2000000,'ini laptop',NULL,'2021-04-20 17:44:37','2021-05-02 19:50:04',15,1000,'2021-05-02 19:50:04'),(14,'Oppo',5000000,'hape',NULL,'2021-05-03 10:44:56','2021-05-03 10:44:56',100,100,NULL),(15,'TV',300000,'INI TV',NULL,'2021-05-08 20:25:53','2021-05-08 20:25:53',50,100,NULL),(16,'Kipas angin tornado',100000,'ini kipas angin superrrrrrrrrrrrr',NULL,'2021-05-15 13:50:02','2021-05-31 17:50:02',100,100,NULL);

/*Table structure for table `response` */

DROP TABLE IF EXISTS `response`;

CREATE TABLE `response` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `review_id` int(10) unsigned NOT NULL,
  `admin_id` int(10) unsigned NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `review_id` (`review_id`),
  KEY `admin_id` (`admin_id`),
  CONSTRAINT `response_ibfk_1` FOREIGN KEY (`review_id`) REFERENCES `product_reviews` (`id`),
  CONSTRAINT `response_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `response` */

/*Table structure for table `sessions` */

DROP TABLE IF EXISTS `sessions`;

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sessions` */

insert  into `sessions`(`id`,`user_id`,`ip_address`,`user_agent`,`payload`,`last_activity`) values ('4U6XVAUDAzkBJ9h9iDyHD71BWcGBGzHhLbptEYsF',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoibmYxdzF0QXBSNTdGVmJ4bkNtaHJVUENYQ0tDTjVMeDQ3aEN6UGJJTCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1622451877),('aRW7Y5pqSO8782D1fr1e4hZBZ5PM1YTOaz1Sf2nO',2,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiOXcyN2pCWUoxQ1FLT0h5UE1GV29hTHE0ZE9WYkNLOTIzcVU5QkpocSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yZWdpc3RlciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMCQ4QXlMLzF5eHltOE80UFdLY3hKemZ1M295dlF3NDl2UXhmblczc0FqTmgydlRyMWludU9paSI7fQ==',1622409154),('bgZuWdvXCcKfhFqws6ULLSVj6WfpavYg3XK02Svt',5,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiOEI4UEYxQllMamM4d040bnljSktaRnpCbU9nQzVZZnp4aVd4SXBlaSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC92ZXJpZnktZW1haWwiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo1O3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTAkRXV1bnphMXlhRlVMT3NSR2gvNHhQZVhBSDcuVVdIQnEwRkF6TEIybnFzTi5MRzdhWElDQTYiO30=',1622411102),('Ed2sYHxsQHBhQGPHXpqfIzBMeBEznX57MjF4cJPq',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiRTRKREY5dlV3MGtTMUYxTFFkYzA3YVJGS2xXNzN3Z0lwQ0VKbXN3cSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1622451339),('eGQqNAzePcqp0wy36cnVqJLuWafJHGcNc9ErurJm',6,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36','YTo2OntzOjY6Il90b2tlbiI7czo0MDoiS2J2UzczVkdtT0hpdlBSSUVnNnd4U1c2eEdsV1NnVU9jVHZ3MDdySCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NjtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEwJGVHaUx0TDlUYS5ZWG1SVnBZTS4vMnVUbzNzTlhtaEdIMUlLTUdnRDd5aFNmenQyajE3Ry9PIjtzOjM6InVybCI7YToxOntzOjg6ImludGVuZGVkIjtzOjI3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4iO319',1622450258),('GuQ99GksBtHxc0LpWqKzPNg7oXMGpnxNcux2koyv',6,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoicVBpeW0zMHpxV1dkQ1U2ZWEzWWMzcTFHMUlCMW9GY0lsSTVUdDNBeiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MToibG9naW5fdXNlcl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjY7fQ==',1622454070),('haBsOMhpq86HfMJ5WHNELzulgLxFdoFm3JKqhMxF',4,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoicGFEcEs4ZFhYYnI0bmRTUFF2Z3JaMmZVaDVsTUg4bjZPM0xvNXgxSCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90ZW1wbGF0ZV91c2VyL2ltYWdlL3N0YXIucG5nIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEwJExBLy5GWlZrS0FBYlRaM3VodzdOQk9aVUhic2xvQVBxUW00aERrOTEwYTNrLlJpYlBPcHdpIjt9',1622411022),('P3gWODk3CtcBOTsL48qRgeZJPap2HwbPkTPq8aRx',6,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSFR5UE1BZXRoNFdMdmdNazB4ZXIyajZXWnRHbW52QlR2YU1qbEtrWCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MToibG9naW5fdXNlcl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjY7fQ==',1622458719),('ZYSMcgMRqFyun3JX93yVfrO61fPgKz402KkQAvvl',3,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZXU3dzltWFJEVFFBdFR4NTlzSzFvQ3M2N1ZVbjFvTW5kN21JYWljNyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC92ZXJpZnktZW1haWwiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTAkQ0hUZ0NmdEZCR2I3bVIvUVdtLzFiLmNTVFp2MG5WOWkwV0FYYi9pcDB6V0VCbVZUbWRPOEsiO30=',1622407322);

/*Table structure for table `transaction_details` */

DROP TABLE IF EXISTS `transaction_details`;

CREATE TABLE `transaction_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `qty` int(11) NOT NULL,
  `discount` int(3) DEFAULT NULL,
  `selling_price` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_transaction` (`transaction_id`),
  KEY `id_product` (`product_id`),
  CONSTRAINT `transaction_details_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`),
  CONSTRAINT `transaction_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `transaction_details` */

/*Table structure for table `transactions` */

DROP TABLE IF EXISTS `transactions`;

CREATE TABLE `transactions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `timeout` datetime NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `regency` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` double(12,2) NOT NULL,
  `shipping_cost` double(12,2) NOT NULL,
  `sub_total` double(12,2) NOT NULL,
  `user_id` int(20) unsigned NOT NULL,
  `courier_id` int(10) unsigned NOT NULL,
  `proof_of_payment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('unverified','verified','delivered','success','expired','canceled') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `courier_id` (`courier_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`courier_id`) REFERENCES `couriers` (`id`),
  CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `transactions` */

/*Table structure for table `user_notifications` */

DROP TABLE IF EXISTS `user_notifications`;

CREATE TABLE `user_notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` int(11) unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`),
  KEY `notifiable_id` (`notifiable_id`),
  CONSTRAINT `user_notifications_ibfk_1` FOREIGN KEY (`notifiable_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `user_notifications` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`profile_image`,`status`,`email_verified_at`,`password`,`two_factor_secret`,`two_factor_recovery_codes`,`remember_token`,`created_at`,`updated_at`) values (1,'usercoba','usercoba@gmail.com','def.jpg','active','2021-05-31 04:14:50','123456',NULL,NULL,NULL,'2021-05-31 04:14:59',NULL),(2,'cobaduluaja','cobaduluaja@gmail.com',NULL,NULL,NULL,'$2y$10$8AyL/1yxym8O4PWKcxJzfu3oyvQw49vQxfnW3sAjNh2vTr1inuOii',NULL,NULL,NULL,'2021-05-30 20:26:16','2021-05-30 20:26:16'),(3,'cobaduluaja','cobaduluaja123@gmail.com',NULL,NULL,NULL,'$2y$10$CHTgCftFBGb7mR/QWm/1b.cSTZv0nV9i0WAXb/ip0zWEBmVTmdO8K',NULL,NULL,NULL,'2021-05-30 20:42:01','2021-05-30 20:42:01'),(4,'cobain','cobain@gmail.com',NULL,NULL,NULL,'$2y$10$LA/.FZVkKAAbTZ3uhw7NBOZUHbsloAPqQm4hDk910a3k.RibPOpwi',NULL,NULL,NULL,'2021-05-30 21:35:32','2021-05-30 21:35:32'),(5,'cobaaja','cobaaja@gmail.com',NULL,NULL,NULL,'$2y$10$Euunza1yaFULOsRGh/4xPeXAH7.UWHBq0FAzLB2nqsN.LG7aXICA6',NULL,NULL,NULL,'2021-05-30 21:45:01','2021-05-30 21:45:01'),(6,'pastibisa','pastibisa@gmail.com',NULL,NULL,'2021-05-31 08:19:05','$2y$10$eGiLtL9Ta.YXmRVpYM./2uTo3sNXmhGH1IKMGgD7yhSfzt2j17G/O',NULL,NULL,NULL,'2021-05-31 08:18:14','2021-05-31 08:19:05');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
