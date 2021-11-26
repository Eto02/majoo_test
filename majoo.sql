/*
 Navicat Premium Data Transfer

 Source Server         : Localku
 Source Server Type    : MySQL
 Source Server Version : 100417
 Source Host           : 127.0.0.1:3306
 Source Schema         : majoo

 Target Server Type    : MySQL
 Target Server Version : 100417
 File Encoding         : 65001

 Date: 26/11/2021 15:25:07
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- ----------------------------
-- Table structure for mstr_kategori
-- ----------------------------
DROP TABLE IF EXISTS `mstr_kategori`;
CREATE TABLE `mstr_kategori`  (
  `Id_Kategori` int NOT NULL AUTO_INCREMENT,
  `Nama_Kategori` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `Kode_Kategori` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `Created_By` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  `Created_Date` datetime(0) NULL DEFAULT NULL,
  `Modified_By` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  `Modified_Date` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`Id_Kategori`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mstr_kategori
-- ----------------------------
INSERT INTO `mstr_kategori` VALUES (2, 'Makanan', 'MKN', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mstr_kategori` VALUES (4, 'Minuman', 'MNM', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mstr_kategori` VALUES (5, 'Snack', 'SNK', NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for mstr_produk
-- ----------------------------
DROP TABLE IF EXISTS `mstr_produk`;
CREATE TABLE `mstr_produk`  (
  `Id_Produk` int NOT NULL AUTO_INCREMENT,
  `Id_Kategori` int NULL DEFAULT NULL,
  `Nama_Produk` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `Harga_Produk` int NULL DEFAULT NULL,
  `Deskripsi_Produk` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `Foto_Produk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `Created_By` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  `Created_Date` datetime(0) NULL DEFAULT NULL,
  `Modified_By` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  `Modified_Date` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`Id_Produk`) USING BTREE,
  INDEX `Id_Kategori`(`Id_Kategori`) USING BTREE,
  CONSTRAINT `mstr_produk_ibfk_1` FOREIGN KEY (`Id_Kategori`) REFERENCES `mstr_kategori` (`Id_Kategori`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mstr_produk
-- ----------------------------
INSERT INTO `mstr_produk` VALUES (1, NULL, 'SELVIANA', 12, '&lt;strong&gt;sda&lt;/strong&gt;&lt;strong&gt;&lt;/strong&gt;', NULL, NULL, '2021-11-26 00:00:00', NULL, NULL, NULL);
INSERT INTO `mstr_produk` VALUES (2, NULL, 'SELVIANA', 112, '&lt;strong&gt;asdas&lt;/strong&gt;', 'public/upload/foto/2', NULL, '2021-11-26 00:00:00', NULL, NULL, '2021-11-26 07:15:49');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp(0) NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
