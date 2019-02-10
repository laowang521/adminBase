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

 Date: 10/02/2019 08:27:29
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for ke_user_sign
-- ----------------------------
DROP TABLE IF EXISTS `benben_user_sign`;
CREATE TABLE `benben_user_sign`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED NOT NULL COMMENT '用户ID',
  `sign_count` int(6) UNSIGNED NOT NULL DEFAULT 0 COMMENT '签到次数',
  `sign_counts` int(6) UNSIGNED NOT NULL DEFAULT 0 COMMENT '连续签到次数',
  `add_time` int(11) UNSIGNED NOT NULL COMMENT '签到时间',
  `status` tinyint(1) NULL DEFAULT 1 COMMENT '1正常 2禁用',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '用户签到表-龙大大-190210' ROW_FORMAT = Fixed;

SET FOREIGN_KEY_CHECKS = 1;
