/*
 Navicat Premium Data Transfer

 Source Server         : 远程基础库
 Source Server Type    : MySQL
 Source Server Version : 50562
 Source Host           : 122.114.73.130:3306
 Source Schema         : base

 Target Server Type    : MySQL
 Target Server Version : 50562
 File Encoding         : 65001

 Date: 08/02/2019 16:54:42
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for benben_user_follow
-- ----------------------------
DROP TABLE IF EXISTS `benben_user_sign;
CREATE TABLE `benben_user_sign`  (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NULL DEFAULT NULL COMMENT '用户ID',
  `content` text COMMENT '建议内容',
  `add_time` int(11) NULL DEFAULT NULL COMMENT '添加时间',
  `update_time` int(11) NULL DEFAULT NULL COMMENT '更新时间',
  `status` int(2) NULL DEFAULT NULL COMMENT '状态',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '用户建议反馈表-龙大大-190208' ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
