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

 Date: 10/02/2019 20:40:01
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for ke_goods_ticket
-- ----------------------------
DROP TABLE IF EXISTS `ke_goods_ticket`;
CREATE TABLE `benben_coupons`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT ' ',
  `coupons_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '全品类满减券' COMMENT '优惠券名称',
  `shop_id` int(10) UNSIGNED NULL DEFAULT NULL COMMENT '发放商家',
  `start_time` int(10) NULL DEFAULT NULL COMMENT '发放开始时间',
  `end_time` int(10) UNSIGNED NULL DEFAULT NULL COMMENT '发放截止时间',
  `use_start_time` int(11) NULL DEFAULT NULL COMMENT '开始使用时间',
  `use_end_time` int(10) NULL DEFAULT NULL COMMENT '有效期',
  `limit_price` int(10) NULL DEFAULT 0 COMMENT '满指定额度可用',
  `coupons_price` int(10) UNSIGNED NULL DEFAULT 0 COMMENT '券面抵扣金额',
  `number` int(10) NULL DEFAULT 0 COMMENT '发放数量',
  `stock` int(10) UNSIGNED NULL DEFAULT 0 COMMENT '当前库存',
  `issue_status` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '0 停止发放 1 发放中',
  `add_time` int(10) NULL DEFAULT NULL COMMENT '添加时间',
  `update_time` int(10) NULL DEFAULT NULL COMMENT '更新时间',
  `status` tinyint(1) NULL DEFAULT 0 COMMENT '0 正常 -1已删除',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
