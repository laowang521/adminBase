/*
 Navicat Premium Data Transfer

 Source Server         : 基础数据库
 Source Server Type    : MySQL
 Source Server Version : 50562
 Source Host           : 122.114.73.130:3306
 Source Schema         : base

 Target Server Type    : MySQL
 Target Server Version : 50562
 File Encoding         : 65001

 Date: 02/02/2019 08:00:25
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for benben_user_info
-- ----------------------------
DROP TABLE IF EXISTS `benben_user_info`;
CREATE TABLE `benben_user_info`  (
  `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NULL DEFAULT 0 COMMENT '所属用户',
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '姓名',
  `mobile` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '电话',
  `Province` int(6) DEFAULT 0  COMMENT '省份',
  `city` int(6) DEFAULT 0  COMMENT '城市',
  `district` int(6) DEFAULT 0  COMMENT '县区',
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '详细地址',
  `add_time` int(11) NULL DEFAULT NULL COMMENT '注册时间',
  `update_time` int(11) NULL DEFAULT NULL COMMENT '更新时间',
  `status` tinyint(1) NULL DEFAULT 1 COMMENT '1正常 2禁用',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '用户收货地址表-龙大大-190202' ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
