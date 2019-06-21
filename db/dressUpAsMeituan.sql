/*
 Navicat Premium Data Transfer

 Source Server         : qcloud
 Source Server Type    : MySQL
 Source Server Version : 50560
 Source Host           : 118.126.93.163:3306
 Source Schema         : dressUpAsMeituan

 Target Server Type    : MySQL
 Target Server Version : 50560
 File Encoding         : 65001

 Date: 21/06/2019 14:06:33
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for good_price_control
-- ----------------------------
DROP TABLE IF EXISTS `good_price_control`;
CREATE TABLE `good_price_control` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goodId` int(11) NOT NULL,
  `begin_at` datetime DEFAULT NULL,
  `end_at` datetime DEFAULT NULL,
  `valid` int(1) DEFAULT '1',
  `price` decimal(10,2) DEFAULT NULL,
  `type` int(1) DEFAULT '1',
  `incOrDec` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`,`goodId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of good_price_control
-- ----------------------------
BEGIN;
INSERT INTO `good_price_control` VALUES (1, 1, '2019-04-19 22:19:58', '2019-06-09 22:20:03', 1, 0.50, 1, 1);
COMMIT;

-- ----------------------------
-- Table structure for goods
-- ----------------------------
DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shopId` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `describe` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `valid` int(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of goods
-- ----------------------------
BEGIN;
INSERT INTO `goods` VALUES (1, 1, '招牌炸串', '贼好吃', '2019-05-19 15:10:43', 1.00, NULL, 1);
INSERT INTO `goods` VALUES (2, 1, '招牌地沟油', '贼难吃', '2019-05-19 15:10:43', 10.00, NULL, 0);
INSERT INTO `goods` VALUES (3, 2, '麦辣地沟堡', '这还是套餐，你敢信？', '2019-05-19 15:10:43', 35.00, NULL, 0);
INSERT INTO `goods` VALUES (4, 2, '用剩下的手纸', '有人买就赚到', '2019-05-19 15:10:43', 1.00, NULL, 0);
INSERT INTO `goods` VALUES (5, 2, '半袋番茄酱', '寻找有缘人买另外半袋', '2019-05-19 15:10:43', 3.00, NULL, 0);
INSERT INTO `goods` VALUES (6, 3, '皮带', '长征同款，帮煮熟', '2019-05-19 15:10:43', 100.00, NULL, 0);
INSERT INTO `goods` VALUES (7, 1, '鸡胗', '就是鸡的鸡', '2019-05-19 23:05:53', 2.00, '', 0);
INSERT INTO `goods` VALUES (8, 1, '鸡胗', '就是鸡的鸡', '2019-05-19 23:06:40', 2.00, '', 0);
INSERT INTO `goods` VALUES (9, 1, '鸡皮', '贼好吃，没有鸡皮疙瘩', '2019-05-19 23:07:20', 3.00, '', 0);
INSERT INTO `goods` VALUES (10, 3, '麻绳皮带', '更容易入味', '2019-05-19 23:08:13', 0.00, '', 0);
INSERT INTO `goods` VALUES (11, 3, '玻璃丝带', '虽然穷，但煮起来好吃', '2019-05-19 23:10:48', 19.90, '', 0);
INSERT INTO `goods` VALUES (12, 1, '杨艺的头油炸鸡皮', '限量版，杨艺不洗头才有', '2019-05-19 23:13:40', 99.90, '', 0);
INSERT INTO `goods` VALUES (13, 1, '炸鸡脖', '热辣口味', '2019-06-06 14:19:18', 2.00, '', 1);
INSERT INTO `goods` VALUES (14, 1, '炸千叶豆腐', '不油腻', '2019-06-08 07:54:21', 2.00, '', 1);
INSERT INTO `goods` VALUES (15, 1, '炸墨鱼丸', '精品墨鱼丸', '2019-06-08 07:54:53', 2.00, '', 1);
INSERT INTO `goods` VALUES (16, 1, '鸡肉串', '正宗溜达鸡', '2019-06-08 07:55:16', 2.00, '', 1);
INSERT INTO `goods` VALUES (17, 1, '羊肉串', '新鲜的羊肉', '2019-06-08 07:55:48', 2.00, '', 1);
INSERT INTO `goods` VALUES (18, 2, '招牌鸡腿堡', '新鲜鸡腿肉', '2019-06-08 08:07:26', 15.00, '', 1);
INSERT INTO `goods` VALUES (19, 2, '美味蟹黄堡', '深海蟹黄超级好吃', '2019-06-08 08:07:58', 20.00, '', 1);
INSERT INTO `goods` VALUES (20, 2, '肯德基早餐套餐', '一人份', '2019-06-08 08:08:33', 20.00, '', 1);
INSERT INTO `goods` VALUES (21, 2, '肯德基全家桶', '足够一家四口人的量', '2019-06-08 08:09:01', 80.00, '', 1);
INSERT INTO `goods` VALUES (22, 2, '大薯条', '新挖出来的土豆', '2019-06-08 08:09:27', 10.00, '', 1);
INSERT INTO `goods` VALUES (23, 3, '招牌烤肉饭', '农村溜达猪肉', '2019-06-08 08:10:01', 10.00, '', 1);
INSERT INTO `goods` VALUES (24, 3, '飘香鸡排饭', '溜达鸡', '2019-06-08 08:10:31', 10.00, '', 1);
INSERT INTO `goods` VALUES (25, 3, '大凉皮', '秘制酱料', '2019-06-08 08:11:01', 10.00, '', 1);
INSERT INTO `goods` VALUES (26, 5, '菲力牛排', '秘制酱料', '2019-06-08 08:11:33', 58.00, '', 1);
INSERT INTO `goods` VALUES (27, 5, '黑椒牛排', '秘制酱料', '2019-06-08 08:12:11', 86.00, '', 1);
INSERT INTO `goods` VALUES (28, 5, '鲜嫩猪小排', '秘制酱料', '2019-06-08 08:12:30', 38.00, '', 1);
INSERT INTO `goods` VALUES (29, 5, '提拉米苏芝士饼', '进口可可豆', '2019-06-08 08:13:20', 28.00, '', 1);
INSERT INTO `goods` VALUES (30, 6, '创意水果捞', '全都是新摘的水果', '2019-06-08 08:14:03', 25.00, '', 1);
INSERT INTO `goods` VALUES (31, 6, '创意水果捞巨无霸', '一家人的饭后甜品', '2019-06-08 08:14:33', 40.00, '', 1);
INSERT INTO `goods` VALUES (32, 6, '水果捞原料酸奶', '秘制好自己加水果', '2019-06-08 08:15:19', 18.00, '', 1);
INSERT INTO `goods` VALUES (33, 6, '鲜榨橙汁', '新鲜果粒橙', '2019-06-08 08:15:45', 8.00, '', 1);
COMMIT;

-- ----------------------------
-- Table structure for money_log
-- ----------------------------
DROP TABLE IF EXISTS `money_log`;
CREATE TABLE `money_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `money` float(10,2) DEFAULT NULL,
  `afterChange` float(10,2) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `reason` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `valid` int(1) DEFAULT '1',
  PRIMARY KEY (`id`,`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of money_log
-- ----------------------------
BEGIN;
INSERT INTO `money_log` VALUES (1, 1, -11.00, 89.00, '2019-05-19 20:34:13', 'system dis', 1);
INSERT INTO `money_log` VALUES (2, 1, -38.00, 51.00, '2019-05-19 21:18:13', 'system dis', 1);
INSERT INTO `money_log` VALUES (3, 1, 0.00, 123.00, '2019-05-19 23:27:41', 'apply gey money', 1);
INSERT INTO `money_log` VALUES (4, 1, -12.50, 999987.50, '2019-05-19 23:29:04', 'system dis', 1);
INSERT INTO `money_log` VALUES (5, 1, -0.50, 999987.00, '2019-06-06 15:27:59', 'system dis', 1);
INSERT INTO `money_log` VALUES (6, 1, -25.00, 999962.00, '2019-06-08 08:16:46', 'system dis', 1);
INSERT INTO `money_log` VALUES (7, 1, -100.00, 999862.00, '2019-06-08 08:29:12', 'apply gey money', 1);
COMMIT;

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `userid` int(11) NOT NULL,
  `create_at` datetime DEFAULT NULL,
  `ori_price` decimal(10,2) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `addr` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `valid` int(1) DEFAULT '1',
  `status` int(1) DEFAULT '1',
  PRIMARY KEY (`id`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of order
-- ----------------------------
BEGIN;
INSERT INTO `order` VALUES ('order20190519_2056e035de1c6ce274', 1, '2019-05-19 20:34:13', 11.00, 11.00, 'lizongs', '18340800000', 'niubiani', 1, 1);
INSERT INTO `order` VALUES ('order20190519_ab81b6e587eac9f566', 1, '2019-05-19 23:29:04', 13.00, 12.50, '杨主任', '800823823', 'eat_in_shop', 1, 1);
INSERT INTO `order` VALUES ('order20190519_ec7cbe2d8dc7e5218c', 1, '2019-05-19 21:18:13', 38.00, 38.00, 'lizongs', '18340800000', 'niubiani', 1, 1);
INSERT INTO `order` VALUES ('order20190606_ffab91c890d2410419', 1, '2019-06-06 15:27:59', 1.00, 0.50, '杨主任', '800823823', 'eat_in_shop', 1, 1);
INSERT INTO `order` VALUES ('order20190608_96dd6dab71b3a80d77', 1, '2019-06-08 08:16:46', 25.00, 25.00, '杨主任', '800823823', 'eat_in_shop', 1, 1);
COMMIT;

-- ----------------------------
-- Table structure for order_goods
-- ----------------------------
DROP TABLE IF EXISTS `order_goods`;
CREATE TABLE `order_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderId` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `goodId` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `ori_price` decimal(10,2) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `valid` int(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of order_goods
-- ----------------------------
BEGIN;
INSERT INTO `order_goods` VALUES (1, 'order20190519_2056e035de1c6ce274', 1, '2019-05-19 20:34:13', 1.00, 1.00, 1);
INSERT INTO `order_goods` VALUES (2, 'order20190519_2056e035de1c6ce274', 2, '2019-05-19 20:34:13', 10.00, 10.00, 1);
INSERT INTO `order_goods` VALUES (3, 'order20190519_ec7cbe2d8dc7e5218c', 3, '2019-05-19 21:18:13', 35.00, 35.00, 1);
INSERT INTO `order_goods` VALUES (4, 'order20190519_ec7cbe2d8dc7e5218c', 5, '2019-05-19 21:18:13', 3.00, 3.00, 1);
INSERT INTO `order_goods` VALUES (5, 'order20190519_ab81b6e587eac9f566', 1, '2019-05-19 23:29:04', 1.00, 0.50, 1);
INSERT INTO `order_goods` VALUES (6, 'order20190519_ab81b6e587eac9f566', 2, '2019-05-19 23:29:04', 10.00, 10.00, 1);
INSERT INTO `order_goods` VALUES (7, 'order20190519_ab81b6e587eac9f566', 8, '2019-05-19 23:29:04', 2.00, 2.00, 1);
INSERT INTO `order_goods` VALUES (8, 'order20190606_ffab91c890d2410419', 1, '2019-06-06 15:27:59', 1.00, 0.50, 1);
INSERT INTO `order_goods` VALUES (9, 'order20190608_96dd6dab71b3a80d77', 30, '2019-06-08 08:16:46', 25.00, 25.00, 1);
COMMIT;

-- ----------------------------
-- Table structure for shop
-- ----------------------------
DROP TABLE IF EXISTS `shop`;
CREATE TABLE `shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `valid` int(1) DEFAULT '1',
  `notice` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of shop
-- ----------------------------
BEGIN;
INSERT INTO `shop` VALUES (1, '真好吃炸串店', '2019-05-19 15:10:43', 1, '吃过的都说好');
INSERT INTO `shop` VALUES (2, '肯德基真好吃', '2019-05-19 15:10:43', 1, '跟真的一样');
INSERT INTO `shop` VALUES (3, '谁都爱烤肉饭', '2019-05-19 15:10:43', 1, '烤肉饭特别好吃');
INSERT INTO `shop` VALUES (4, '杨艺的热乎被窝', '2019-05-19 21:02:44', 0, '除了杨艺啥都有');
INSERT INTO `shop` VALUES (5, '齐俊楠的rap音乐餐厅', '2019-05-19 21:06:21', 1, '一边听rap一边吃饭反正我是啥都吃不下去');
INSERT INTO `shop` VALUES (6, '水果捞专卖', '2019-06-08 07:53:29', 1, '只做新鲜的水果');
COMMIT;

-- ----------------------------
-- Table structure for token
-- ----------------------------
DROP TABLE IF EXISTS `token`;
CREATE TABLE `token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `userid` int(11) NOT NULL,
  `die_at` datetime DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `valid` int(1) DEFAULT '1',
  PRIMARY KEY (`id`,`token`,`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of token
-- ----------------------------
BEGIN;
INSERT INTO `token` VALUES (1, 'c9fe7d1a0afc7c9fe26cde41288ef030', 1, '2019-05-22 23:37:21', '2019-05-15 23:37:21', 1);
INSERT INTO `token` VALUES (2, '91d88c4dc5787be1cdac362f54a523a8', 1, '2019-05-22 23:37:22', '2019-05-15 23:37:22', 1);
INSERT INTO `token` VALUES (3, 'b80df4ea049bcd4d1a50336bd6ab0940', 1, '2019-05-26 13:10:09', '2019-05-19 13:10:09', 1);
INSERT INTO `token` VALUES (4, 'f8de9d08f5a94ef68f2e89e28a40d1fe', 1, '2019-05-26 13:11:01', '2019-05-19 13:11:01', 1);
INSERT INTO `token` VALUES (5, 'fa688756e1bfc54416e4887afe35ee8a', 1, '2019-05-26 15:06:38', '2019-05-19 15:06:38', 1);
INSERT INTO `token` VALUES (6, 'dd4a530b43edcfbd08197c7880c06ca6', 1, '2019-05-26 20:32:45', '2019-05-19 20:32:45', 1);
INSERT INTO `token` VALUES (7, '4eed1495b2c2d5fe733793387ffa665a', 1, '2019-05-26 21:17:02', '2019-05-19 21:17:02', 1);
INSERT INTO `token` VALUES (8, 'c97d1d8b4b9ad3dd3e9c76272eab8ddf', 1, '2019-05-26 21:17:03', '2019-05-19 21:17:03', 1);
INSERT INTO `token` VALUES (9, '8817755d9df3ff57ef151787f06416dd', 1, '2019-05-26 23:27:07', '2019-05-19 23:27:07', 1);
INSERT INTO `token` VALUES (10, '472adb42bc5c3f312d0eb63dc8bfca00', 1, '2019-05-26 23:46:09', '2019-05-19 23:46:09', 1);
INSERT INTO `token` VALUES (11, 'beeda340c35f0742197d8c45cd771175', 1, '2019-05-27 08:14:54', '2019-05-20 08:14:54', 1);
INSERT INTO `token` VALUES (12, 'f8177d86383d523a2575ae93e569a6c5', 1, '2019-05-27 09:57:49', '2019-05-20 09:57:49', 1);
INSERT INTO `token` VALUES (13, 'd733a59a5f3bd9288a171fce8b91a65f', 1, '2019-05-27 10:07:52', '2019-05-20 10:07:52', 1);
INSERT INTO `token` VALUES (14, '837a283d73b1ebee315f9b1879052bb5', 1, '2019-05-27 10:09:50', '2019-05-20 10:09:50', 1);
INSERT INTO `token` VALUES (15, 'a36274c6427098759f53fbe89f83f0b1', 1, '2019-05-27 10:09:58', '2019-05-20 10:09:58', 1);
INSERT INTO `token` VALUES (16, '509a19d213370a1636dd86d5d51c9ee8', 1, '2019-05-27 10:10:41', '2019-05-20 10:10:41', 1);
INSERT INTO `token` VALUES (17, '1f7ecac0f32ef6cb06a976176199f218', 1, '2019-05-27 10:10:58', '2019-05-20 10:10:58', 1);
INSERT INTO `token` VALUES (18, 'ba1aae51949b099bd318e98e1d27c923', 1, '2019-05-27 10:11:11', '2019-05-20 10:11:11', 1);
INSERT INTO `token` VALUES (19, 'a82488f291d9e4af0e096d05a1cd6cc0', 1, '2019-05-27 10:11:20', '2019-05-20 10:11:20', 1);
INSERT INTO `token` VALUES (20, '8be7132b3c3aec956cdb1cdff6cf6292', 1, '2019-05-27 10:12:04', '2019-05-20 10:12:04', 1);
INSERT INTO `token` VALUES (21, 'a786bfbd6eb295ba21683a208e7d8c8d', 1, '2019-05-27 10:16:12', '2019-05-20 10:16:12', 1);
INSERT INTO `token` VALUES (22, 'd70688dcc2ffb2c8948ef696d35c162f', 1, '2019-05-27 10:16:32', '2019-05-20 10:16:32', 1);
INSERT INTO `token` VALUES (23, '5398513778216954e79c11e4366afb87', 1, '2019-05-27 11:58:08', '2019-05-20 11:58:08', 1);
INSERT INTO `token` VALUES (24, '3679f0437d3cd83fd2cecc657152ff5b', 1, '2019-05-27 12:00:06', '2019-05-20 12:00:06', 1);
INSERT INTO `token` VALUES (25, 'a543ff6204b7550ca4500139ef3eb2a0', 1, '2019-06-02 13:39:40', '2019-05-26 13:39:40', 1);
INSERT INTO `token` VALUES (26, '8e562f5a60b6e3244bb9bc175913231a', 1, '2019-06-02 13:39:41', '2019-05-26 13:39:41', 1);
INSERT INTO `token` VALUES (27, 'a6b211ea94ce543bcb49b9fa3616f05a', 1, '2019-06-02 17:46:49', '2019-05-26 17:46:49', 1);
INSERT INTO `token` VALUES (28, 'a1c0d1787e7d3711d79b414e66291804', 1, '2019-06-04 11:59:06', '2019-05-28 11:59:06', 1);
INSERT INTO `token` VALUES (29, '4edc63a1be84b0e598e7f97f9da2d056', 1, '2019-06-13 14:03:15', '2019-06-06 14:03:15', 1);
INSERT INTO `token` VALUES (30, 'c0bcdb08a4fc269359a8194a7bf60f85', 1, '2019-06-13 14:03:50', '2019-06-06 14:03:50', 1);
INSERT INTO `token` VALUES (31, 'ddc4c874cdb0ac9c458cc1102ace02ce', 1, '2019-06-13 14:05:13', '2019-06-06 14:05:13', 1);
INSERT INTO `token` VALUES (32, 'c4dc3dbd9fae72ec4da9f5415f552cb5', 1, '2019-06-13 14:39:09', '2019-06-06 14:39:09', 1);
INSERT INTO `token` VALUES (33, '73aa10a25caca452c10b5d7e7a9b6473', 1, '2019-06-15 07:52:21', '2019-06-08 07:52:21', 1);
COMMIT;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usr` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pwd` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `valid` int(1) DEFAULT '1',
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `nickname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(10) COLLATE utf8_unicode_ci DEFAULT '1',
  `restMoney` float(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
BEGIN;
INSERT INTO `user` VALUES (1, 'admin', 'd9b1d7db4cd6e70935368a1efb10e377', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '老板啊', 'http://xtzero.me/dressupAsMeituan/api/upload/770361001557934679ban-left.jpg', 'admin', 999862.00);
COMMIT;

-- ----------------------------
-- Table structure for user_addr
-- ----------------------------
DROP TABLE IF EXISTS `user_addr`;
CREATE TABLE `user_addr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `addr` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `valid` int(1) DEFAULT '1',
  `create_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`,`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user_addr
-- ----------------------------
BEGIN;
INSERT INTO `user_addr` VALUES (1, 1, 'niubiani', 'lizongs', '18340800000', 0, '2019-05-15 23:38:40');
INSERT INTO `user_addr` VALUES (2, 1, 'eat_in_shop', '杨主任', '800823823', 1, '2019-05-19 23:28:57');
INSERT INTO `user_addr` VALUES (3, 1, '辽宁科技大学', '陈立新', '15941204698', 1, '2019-06-06 14:41:02');
COMMIT;

-- ----------------------------
-- Table structure for want_get_money
-- ----------------------------
DROP TABLE IF EXISTS `want_get_money`;
CREATE TABLE `want_get_money` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `money` float(10,2) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `valid` int(1) DEFAULT '1',
  PRIMARY KEY (`id`,`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of want_get_money
-- ----------------------------
BEGIN;
INSERT INTO `want_get_money` VALUES (1, 1, NULL, '2019-05-19 23:27:41', 1);
INSERT INTO `want_get_money` VALUES (2, 1, 100.00, '2019-06-08 08:29:12', 1);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
