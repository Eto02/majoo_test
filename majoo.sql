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

 Date: 27/11/2021 21:10:35
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
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mstr_kategori
-- ----------------------------
INSERT INTO `mstr_kategori` VALUES (6, 'Hardware', 'HDW', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mstr_kategori` VALUES (7, 'Full Paket', 'FP', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mstr_kategori` VALUES (8, 'Software', 'SFW', NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for mstr_produk
-- ----------------------------
DROP TABLE IF EXISTS `mstr_produk`;
CREATE TABLE `mstr_produk`  (
  `Id_Produk` int(11) NOT NULL AUTO_INCREMENT,
  `Nama_Produk` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `Harga_Produk` int(11) NULL DEFAULT NULL,
  `Deskripsi_Produk` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `Foto_Produk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `Created_By` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  `Created_Date` datetime(0) NULL DEFAULT NULL,
  `Modified_By` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  `Modified_Date` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`Id_Produk`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mstr_produk
-- ----------------------------
INSERT INTO `mstr_produk` VALUES (1, 'Paket Adcance', 1000000, '<div style=\"color:#d4d4d4;background-color:#1e1e1e;font-family:Consolas, \'Courier New\', monospace;font-size:14px;line-height:19px;white-space:pre;\"><div></div><div>&nbsp;&nbsp;Lorem&nbsp;ipsum&nbsp;dolor&nbsp;sit&nbsp;amet&nbsp;consectetur&nbsp;adipisicing&nbsp;elit.&nbsp;Id,&nbsp;totam&nbsp;reprehenderit&nbsp;recusandae&nbsp;debitis&nbsp;odio&nbsp;similique&nbsp;molestiae&nbsp;voluptates&nbsp;natus&nbsp;libero&nbsp;molestias&nbsp;incidunt&nbsp;quaerat&nbsp;doloremque.&nbsp;Dicta,&nbsp;itaque.&nbsp;Hic&nbsp;repellendus&nbsp;nihil&nbsp;ab&nbsp;iusto.</div></div>', 'public/upload/foto/1.png', NULL, '2021-11-26 00:00:00', NULL, NULL, '2021-11-27 04:51:17');
INSERT INTO `mstr_produk` VALUES (4, 'Paket Desktop', 8000000, '<strong><em><span style=\"font-family:\'Comic Sans MS\';\">Paket Desktop</span></em></strong>', 'public/upload/foto/4.png', NULL, '2021-11-26 00:00:00', NULL, NULL, '2021-11-27 03:39:14');
INSERT INTO `mstr_produk` VALUES (9, 'Paket Lifestyle', 5000000, '<strong><em>Paket Lifestyle</em></strong>', 'public/upload/foto/9.png', NULL, '2021-11-27 00:00:00', NULL, NULL, '2021-11-27 07:03:10');
INSERT INTO `mstr_produk` VALUES (10, 'Standart Repo', 250000, '<em><strong>Standart Repo</strong></em>', 'public/upload/foto/10.png', NULL, '2021-11-27 00:00:00', NULL, NULL, '2021-11-27 07:29:52');
INSERT INTO `mstr_produk` VALUES (11, 'Paket Adcance 2', 1000000, 'Paket Adcance 2', 'public/upload/foto/11.png', NULL, '2021-11-27 00:00:00', NULL, NULL, '2021-11-27 07:10:10');
INSERT INTO `mstr_produk` VALUES (16, 'Paket Advance 3', 5000000, 'Paket Advance 3', 'public/upload/foto/16.png', NULL, '2021-11-27 00:00:00', NULL, NULL, '2021-11-27 11:29:17');
INSERT INTO `mstr_produk` VALUES (17, 'Paket Advance 5', 123213, '<table role=\"grid\" style=\"box-sizing:content-box;width:1611.25px;margin:0px;max-width:none;border-spacing:0px;empty-cells:show;border-width:0px;outline:0px;table-layout:fixed;color:#2e2e2e;font-family:-apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\', \'Noto Color Emoji\';font-size:16px;background-color:#ffffff;\"><colgroup style=\"box-sizing:content-box;\"><col style=\"box-sizing:content-box;width:100px;\" /><col style=\"box-sizing:content-box;width:100px;\" /><col style=\"box-sizing:content-box;width:100px;\" /><col style=\"box-sizing:content-box;width:100px;\" /><col style=\"box-sizing:content-box;width:100px;\" /><col style=\"box-sizing:content-box;width:150px;\" /></colgroup><tbody role=\"rowgroup\" style=\"box-sizing:content-box;\"><tr class=\"k-master-row\" data-uid=\"a427831f-6330-475b-b248-7d71867ddef9\" role=\"row\" style=\"box-sizing:content-box;\"><td role=\"gridcell\" style=\"box-sizing:content-box;border-style:solid;border-width:0px;padding:0.4em 0.6em;overflow:hidden;line-height:1.6em;vertical-align:middle;text-overflow:ellipsis;border-color:#d5d5d5;\">Paket Advance 3</td></tr></tbody></table><p>&nbsp;</p>', 'public/upload/foto/17.png', NULL, '2021-11-27 00:00:00', NULL, NULL, '2021-11-27 14:04:22');

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
) ENGINE = InnoDB AUTO_INCREMENT = 85 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of produk_kategori
-- ----------------------------
INSERT INTO `produk_kategori` VALUES (48, 4, 6);
INSERT INTO `produk_kategori` VALUES (54, 1, 6);
INSERT INTO `produk_kategori` VALUES (55, 1, 7);
INSERT INTO `produk_kategori` VALUES (56, 9, 7);
INSERT INTO `produk_kategori` VALUES (57, 9, 8);
INSERT INTO `produk_kategori` VALUES (60, 11, 7);
INSERT INTO `produk_kategori` VALUES (61, 11, 8);
INSERT INTO `produk_kategori` VALUES (62, 10, 6);
INSERT INTO `produk_kategori` VALUES (63, 10, 7);
INSERT INTO `produk_kategori` VALUES (83, 16, 7);
INSERT INTO `produk_kategori` VALUES (84, 17, 6);

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
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (4, 'Tahta', 'shinoa696@gmail.com', NULL, '$2y$10$xt6963ho3U7GyxPZLPlCOOkxodkKbZIHAwKdH6KGGhq2z5yqiqRgW', NULL, '2021-11-27 08:06:40', '2021-11-27 08:06:40');

SET FOREIGN_KEY_CHECKS = 1;
