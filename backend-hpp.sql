/*
 Navicat Premium Data Transfer

 Source Server         : localh
 Source Server Type    : MySQL
 Source Server Version : 100408
 Source Host           : localhost:3306
 Source Schema         : backend-hpp

 Target Server Type    : MySQL
 Target Server Version : 100408
 File Encoding         : 65001

 Date: 06/01/2024 15:48:05
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_reset_tokens_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (8, '2024_01_06_013447_create_transactions_table', 2);

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_reset_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token` ASC) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type` ASC, `tokenable_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for transactions
-- ----------------------------
DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `qty` int NOT NULL,
  `cost` decimal(10, 2) NOT NULL,
  `price` decimal(10, 2) NOT NULL,
  `total_cost` decimal(10, 2) NOT NULL,
  `qty_balance` int NOT NULL,
  `value_balance` decimal(10, 2) NOT NULL,
  `hpp` decimal(10, 4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 57 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transactions
-- ----------------------------
INSERT INTO `transactions` VALUES (4, 'Pembelian', '2021-01-01', 40, 100.00, 100.00, 4000.00, 40, 4000.00, 100.0000, '2024-01-06 06:36:16', '2024-01-06 06:36:16');
INSERT INTO `transactions` VALUES (6, 'Penjualan', '2021-01-01', -1, 112.50, 200.00, -112.50, 39, 4500.00, 115.3846, '2021-05-01 00:00:00', '2024-01-06 08:10:47');
INSERT INTO `transactions` VALUES (33, 'Penjualan', '2021-01-01', -20, 100.00, 200.00, -2000.00, 20, 2000.00, 100.0000, '2024-01-06 07:24:02', '2024-01-06 07:24:02');
INSERT INTO `transactions` VALUES (36, 'Penjualan', '2021-01-01', -10, 100.00, 200.00, -1000.00, 10, 1000.00, 100.0000, '2024-01-06 07:29:13', '2024-01-06 07:29:13');
INSERT INTO `transactions` VALUES (37, 'Pembelian', '2021-01-01', 20, 120.00, 120.00, 2400.00, 30, 3400.00, 113.3333, '2024-01-06 07:29:35', '2024-01-06 07:29:35');
INSERT INTO `transactions` VALUES (38, 'Pembelian', '2021-01-01', 10, 110.00, 110.00, 1100.00, 40, 4500.00, 112.5000, '2024-01-06 07:29:51', '2024-01-06 07:29:51');
INSERT INTO `transactions` VALUES (47, 'Penjualan', '2021-04-01', -5, 112.50, 200.00, -562.50, 35, 3937.50, 112.5000, '2021-05-01 00:00:00', '2024-01-06 12:52:21');
INSERT INTO `transactions` VALUES (48, 'Penjualan', '2021-05-01', -8, 112.50, 200.00, -900.00, 27, 3037.50, 112.5000, '2021-06-01 00:00:00', '2024-01-06 12:52:21');
INSERT INTO `transactions` VALUES (51, 'Pembelian', '2021-01-01', 15, 115.00, 115.00, 1725.00, 42, 4762.50, 113.3929, '2024-01-06 08:16:41', '2024-01-06 08:27:26');
INSERT INTO `transactions` VALUES (52, 'Penjualan', '2021-01-01', -20, 113.35, 200.00, -2267.07, 22, 2493.78, 113.3536, '2024-01-06 08:16:54', '2024-01-06 08:27:26');
INSERT INTO `transactions` VALUES (55, 'Penjualan', '2021-01-01', -15, 113.35, 200.00, -1700.30, 7, 793.48, 113.3537, '2024-01-06 08:29:28', '2024-01-06 08:29:28');
INSERT INTO `transactions` VALUES (56, 'Pembelian', '2021-01-01', 10, 110.00, 110.00, 1100.00, 17, 1893.48, 111.3812, '2024-01-06 08:29:52', '2024-01-06 08:29:52');

-- ----------------------------
-- Table structure for transactions_dummy
-- ----------------------------
DROP TABLE IF EXISTS `transactions_dummy`;
CREATE TABLE `transactions_dummy`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `qty` int NOT NULL,
  `cost` decimal(10, 2) NOT NULL,
  `price` decimal(10, 2) NOT NULL,
  `total_cost` decimal(10, 2) NOT NULL,
  `qty_balance` int NOT NULL,
  `value_balance` decimal(10, 2) NOT NULL,
  `hpp` decimal(10, 4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transactions_dummy
-- ----------------------------
INSERT INTO `transactions_dummy` VALUES (1, 'Pembelian', '2021-01-01', 40, 100.00, 100.00, 4000.00, 40, 4000.00, 100.0000, '2021-01-01 00:00:00', '2024-01-06 12:52:21');
INSERT INTO `transactions_dummy` VALUES (2, 'Penjualan', '2021-01-01', -20, 100.00, 200.00, -2000.00, 20, 2000.00, 100.0000, '2021-02-01 00:00:00', '2024-01-06 12:52:21');
INSERT INTO `transactions_dummy` VALUES (3, 'Penjualan', '2021-02-01', -10, 100.00, 200.00, -1000.00, 10, 1000.00, 100.0000, '2021-02-01 00:00:00', '2024-01-06 12:52:21');
INSERT INTO `transactions_dummy` VALUES (4, 'Pembelian', '2021-03-01', 20, 120.00, 120.00, 2400.00, 30, 3400.00, 113.3333, '2021-03-01 00:00:00', '2024-01-06 12:52:21');
INSERT INTO `transactions_dummy` VALUES (5, 'Pembelian', '2021-03-01', 10, 110.00, 110.00, 1100.00, 40, 4500.00, 112.5000, '2021-04-01 00:00:00', '2024-01-06 12:52:21');
INSERT INTO `transactions_dummy` VALUES (6, 'Penjualan', '2021-04-01', -5, 112.50, 200.00, -562.50, 35, 3937.50, 112.5000, '2021-05-01 00:00:00', '2024-01-06 12:52:21');
INSERT INTO `transactions_dummy` VALUES (7, 'Penjualan', '2021-05-01', -8, 112.50, 200.00, -900.00, 27, 3037.50, 112.5000, '2021-06-01 00:00:00', '2024-01-06 12:52:21');
INSERT INTO `transactions_dummy` VALUES (8, 'Pembelian', '2021-06-01', 15, 115.00, 115.00, 1725.00, 42, 4762.50, 113.3929, '2021-07-01 00:00:00', '2024-01-06 12:52:21');
INSERT INTO `transactions_dummy` VALUES (9, 'Penjualan', '2021-07-01', -20, 113.39, 200.00, -2267.86, 22, 2494.64, 113.3929, '2021-07-01 00:00:00', '2024-01-06 12:52:21');
INSERT INTO `transactions_dummy` VALUES (10, 'Penjualan', '2021-07-01', -15, 113.39, 200.00, -1700.89, 7, 793.75, 113.3929, '2021-07-01 00:00:00', '2024-01-06 12:52:21');
INSERT INTO `transactions_dummy` VALUES (11, 'Pembelian', '2021-08-01', 10, 110.00, 110.00, 1100.00, 17, 1893.75, 111.3971, '2021-08-01 00:00:00', '2024-01-06 12:52:21');
INSERT INTO `transactions_dummy` VALUES (12, 'Penjualan', '2021-09-01', -5, 111.40, 210.00, -556.99, 12, 1336.77, 111.3971, '2021-09-01 00:00:00', '2024-01-06 12:52:21');
INSERT INTO `transactions_dummy` VALUES (13, 'Penjualan', '2021-10-01', -6, 111.40, 210.00, -668.38, 6, 668.38, 111.3971, '2021-10-01 00:00:00', '2024-01-06 12:52:21');
INSERT INTO `transactions_dummy` VALUES (14, 'Pembelian', '2021-11-01', 4, 125.00, 125.00, 500.00, 10, 1168.38, 116.8382, '2021-11-01 00:00:00', '2024-01-06 12:52:21');
INSERT INTO `transactions_dummy` VALUES (15, 'Penjualan', '2021-12-01', -5, 116.84, 210.00, -584.19, 5, 584.19, 116.8382, '2021-12-01 00:00:00', '2024-01-06 12:52:21');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
