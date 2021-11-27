/*
 Navicat Premium Data Transfer

 Source Server         : LokalLaptop
 Source Server Type    : MySQL
 Source Server Version : 100419
 Source Host           : localhost:3306
 Source Schema         : majoo

 Target Server Type    : MySQL
 Target Server Version : 100419
 File Encoding         : 65001

 Date: 27/11/2021 09:11:54
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
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
  `Id_Kategori` int(11) NOT NULL AUTO_INCREMENT,
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
  `Id_Produk` int(11) NOT NULL AUTO_INCREMENT,
  `Id_Kategori` int(11) NULL DEFAULT NULL,
  `Nama_Produk` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `Harga_Produk` int(11) NULL DEFAULT NULL,
  `Deskripsi_Produk` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `Foto_Produk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `Created_By` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  `Created_Date` datetime(0) NULL DEFAULT NULL,
  `Modified_By` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  `Modified_Date` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`Id_Produk`) USING BTREE,
  INDEX `Id_Kategori`(`Id_Kategori`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mstr_produk
-- ----------------------------
INSERT INTO `mstr_produk` VALUES (1, NULL, 'Paket Adcance', 1000000, '<strong><em>Paket Advance</em></strong>', 'public/upload/foto/1.png', NULL, '2021-11-26 00:00:00', NULL, NULL, '2021-11-27 01:39:23');
INSERT INTO `mstr_produk` VALUES (4, NULL, 'Paket Desktop', 8000000, '<strong><em><span style=\"font-family:\'Comic Sans MS\';\">asdas</span><span style=\"font-family:\'Andale Mono\';\"></span></em></strong><strong><em></em></strong>', 'public/upload/foto/4.png', NULL, '2021-11-26 00:00:00', NULL, NULL, '2021-11-27 02:01:26');
INSERT INTO `mstr_produk` VALUES (5, NULL, '12321', 123, 'asd', NULL, NULL, '2021-11-26 00:00:00', NULL, NULL, '2021-11-27 01:35:05');
INSERT INTO `mstr_produk` VALUES (6, NULL, '12321', 123, NULL, NULL, NULL, '2021-11-26 00:00:00', NULL, NULL, NULL);
INSERT INTO `mstr_produk` VALUES (8, NULL, '12321', 123, NULL, NULL, NULL, '2021-11-26 00:00:00', NULL, NULL, NULL);

-- ----------------------------
-- Table structure for produk_kategori
-- ----------------------------
DROP TABLE IF EXISTS `produk_kategori`;
CREATE TABLE `produk_kategori`  (
  `Id_ProdukKategori` int(11) NOT NULL AUTO_INCREMENT,
  `Id_Produk` int(11) NULL DEFAULT NULL,
  `Id_Kategori` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`Id_ProdukKategori`) USING BTREE,
  INDEX `Id_Produk`(`Id_Produk`) USING BTREE,
  INDEX `produk_kategori_ibfk_2`(`Id_Kategori`) USING BTREE,
  CONSTRAINT `produk_kategori_ibfk_1` FOREIGN KEY (`Id_Produk`) REFERENCES `mstr_produk` (`Id_Produk`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `produk_kategori_ibfk_2` FOREIGN KEY (`Id_Kategori`) REFERENCES `mstr_kategori` (`Id_Kategori`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 38 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of produk_kategori
-- ----------------------------
INSERT INTO `produk_kategori` VALUES (22, 5, 5);
INSERT INTO `produk_kategori` VALUES (27, 1, 4);
INSERT INTO `produk_kategori` VALUES (37, 4, 5);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp(0) NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Tahta', 'shinoa696@gmail.com', NULL, '$2y$10$0sGozgNMLA4.HSW.KD69T.retpzfXgUYsCm6b/CQugeu0jIG8pJZ2', NULL, '2021-11-26 14:05:12', '2021-11-26 14:05:12');

SET FOREIGN_KEY_CHECKS = 1;
