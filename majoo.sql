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

 Date: 27/11/2021 12:28:05
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
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

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
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of mstr_kategori
-- ----------------------------
INSERT INTO `mstr_kategori` VALUES (6, 'Hardware', 'HDW', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mstr_kategori` VALUES (7, 'Full Paket', 'FP', NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for mstr_produk
-- ----------------------------
DROP TABLE IF EXISTS `mstr_produk`;
CREATE TABLE `mstr_produk`  (
  `Id_Produk` int NOT NULL AUTO_INCREMENT,
  `Nama_Produk` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `Harga_Produk` int NULL DEFAULT NULL,
  `Deskripsi_Produk` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `Foto_Produk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `Created_By` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  `Created_Date` datetime(0) NULL DEFAULT NULL,
  `Modified_By` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  `Modified_Date` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`Id_Produk`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of mstr_produk
-- ----------------------------
INSERT INTO `mstr_produk` VALUES (1, 'Paket Adcance', 1000000, '<div style=\"color:#d4d4d4;background-color:#1e1e1e;font-family:Consolas, \'Courier New\', monospace;font-size:14px;line-height:19px;white-space:pre;\"><div></div><div>&nbsp;&nbsp;Lorem&nbsp;ipsum&nbsp;dolor&nbsp;sit&nbsp;amet&nbsp;consectetur&nbsp;adipisicing&nbsp;elit.&nbsp;Id,&nbsp;totam&nbsp;reprehenderit&nbsp;recusandae&nbsp;debitis&nbsp;odio&nbsp;similique&nbsp;molestiae&nbsp;voluptates&nbsp;natus&nbsp;libero&nbsp;molestias&nbsp;incidunt&nbsp;quaerat&nbsp;doloremque.&nbsp;Dicta,&nbsp;itaque.&nbsp;Hic&nbsp;repellendus&nbsp;nihil&nbsp;ab&nbsp;iusto.</div></div>', 'public/upload/foto/1.png', NULL, '2021-11-26 00:00:00', NULL, NULL, '2021-11-27 04:51:17');
INSERT INTO `mstr_produk` VALUES (4, 'Paket Desktop', 8000000, '<strong><em><span style=\"font-family:\'Comic Sans MS\';\">Paket Desktop</span></em></strong>', 'public/upload/foto/4.png', NULL, '2021-11-26 00:00:00', NULL, NULL, '2021-11-27 03:39:14');
INSERT INTO `mstr_produk` VALUES (9, 'Paket Lifestyle', 5000000, '<strong><em>Paket Lifestyle</em></strong>', 'public/upload/foto/9.png', NULL, '2021-11-27 00:00:00', NULL, NULL, '2021-11-27 02:36:50');
INSERT INTO `mstr_produk` VALUES (10, 'Standart Repo', 250000, '<em><strong>Standart Repo</strong></em>', 'public/upload/foto/10.png', NULL, '2021-11-27 00:00:00', NULL, NULL, '2021-11-27 02:37:49');

-- ----------------------------
-- Table structure for produk_kategori
-- ----------------------------
DROP TABLE IF EXISTS `produk_kategori`;
CREATE TABLE `produk_kategori`  (
  `Id_ProdukKategori` int NOT NULL AUTO_INCREMENT,
  `Id_Produk` int NULL DEFAULT NULL,
  `Id_Kategori` int NULL DEFAULT NULL,
  PRIMARY KEY (`Id_ProdukKategori`) USING BTREE,
  INDEX `Id_Produk`(`Id_Produk`) USING BTREE,
  INDEX `produk_kategori_ibfk_2`(`Id_Kategori`) USING BTREE,
  CONSTRAINT `produk_kategori_ibfk_1` FOREIGN KEY (`Id_Produk`) REFERENCES `mstr_produk` (`Id_Produk`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `produk_kategori_ibfk_2` FOREIGN KEY (`Id_Kategori`) REFERENCES `mstr_kategori` (`Id_Kategori`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 56 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of produk_kategori
-- ----------------------------
INSERT INTO `produk_kategori` VALUES (48, 4, 6);
INSERT INTO `produk_kategori` VALUES (54, 1, 6);
INSERT INTO `produk_kategori` VALUES (55, 1, 7);

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
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Tahta', 'shinoa696@gmail.com', NULL, '$2y$10$0sGozgNMLA4.HSW.KD69T.retpzfXgUYsCm6b/CQugeu0jIG8pJZ2', NULL, '2021-11-26 14:05:12', '2021-11-26 14:05:12');
INSERT INTO `users` VALUES (2, 'Tahata', 'mmikoto89@gmail.com', NULL, '$2y$10$imY3txq34xjr3ndj8SKpz.sGd8AJIKCI8XxQewdQipLeC6HDUGKw2', NULL, '2021-11-27 03:14:12', '2021-11-27 03:14:12');

SET FOREIGN_KEY_CHECKS = 1;
