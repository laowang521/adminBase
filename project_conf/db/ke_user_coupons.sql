/*
 Navicat Premium Data Transfer

 Source Server         : 普惠万家数据库
 Source Server Type    : MySQL
 Source Server Version : 50558
 Source Host           : 116.255.254.213:3306
 Source Schema         : puzhong

 Target Server Type    : MySQL
 Target Server Version : 50558
 File Encoding         : 65001

 Date: 10/02/2019 20:21:40
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for ke_user_coupons
-- ----------------------------
DROP TABLE IF EXISTS `ke_user_coupons`;
CREATE TABLE `ke_user_coupons`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
 
  `user_id` int(11) NOT NULL DEFAULT 0 COMMENT '用户id',
  `shop_id` int(11) NULL DEFAULT 0 COMMENT '适用的商家id',
  `limit_price` double NULL DEFAULT 0 COMMENT '满',
  `ticket_price` double NULL DEFAULT 0 COMMENT '减',
  
  `status` int(1) NULL DEFAULT 0 COMMENT '-1已过期 0 未使用 1已使用 ',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `uid_cid`(`user_id`, `ticket_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 30 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Fixed;

SET FOREIGN_KEY_CHECKS = 1;
