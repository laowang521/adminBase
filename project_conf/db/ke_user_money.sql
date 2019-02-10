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

 Date: 10/02/2019 09:45:03
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for ke_user_money
-- ----------------------------
DROP TABLE IF EXISTS `ke_user_money`;
CREATE TABLE `ke_user_change`  (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NULL DEFAULT NULL COMMENT '用户ID',
  `type` int(2) NULL DEFAULT NULL COMMENT '类型(1.余额,2.积分)',
  `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '标题',
  `change_type` int(2) NULL DEFAULT NULL COMMENT '变动原因类型(1.充值,2.提现,3消费,4,返利,5,退款)',
  `money` decimal(10, 2) NULL DEFAULT NULL COMMENT '变动前金额',
  `next_money` decimal(10, 2) NULL DEFAULT NULL COMMENT '变动后金额',
  `change_money` decimal(10, 2) NULL DEFAULT NULL COMMENT '变化金额',
  `acc_type` varchar(2) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '账户类型(1.微信,2.支付宝,3.订单消费)',
  `account` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '提现账号',
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '备注',
  `add_time` int(11) NULL DEFAULT NULL COMMENT '添加时间',
  `status` int(2) NULL DEFAULT 1 COMMENT '状态',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
