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

 Date: 10/02/2019 20:17:59
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for benben_user_follow
-- ----------------------------
DROP TABLE IF EXISTS `benben_user_coupons`;
CREATE TABLE `benben_user_coupons`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NULL DEFAULT NULL COMMENT '用户ID',
  `coupons_id` int(11) NOT NULL DEFAULT 0 COMMENT '优惠券id',
  `get_time` int(11) NULL DEFAULT NULL COMMENT '领取时间',
  `use_time` int(11) NULL DEFAULT NULL COMMENT '使用时间',
  `add_time` int(11) NULL DEFAULT NULL COMMENT '添加时间',
  `update_time` int(11) NULL DEFAULT NULL COMMENT '更新时间',
  `status` int(2) NULL DEFAULT NULL COMMENT '状态',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '用户优惠券表-龙大大-190210' ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
