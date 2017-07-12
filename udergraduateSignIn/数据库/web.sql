/*
Navicat MySQL Data Transfer

Source Server         : LocalData
Source Server Version : 50524
Source Host           : localhost:3306
Source Database       : web

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2017-07-12 22:35:00
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `account` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nickname` varchar(20) DEFAULT '暂无昵称',
  `name` varchar(20) DEFAULT '未填',
  `sex` varchar(4) DEFAULT '保密',
  `idcard` varchar(20) DEFAULT '未填',
  `birthdate` varchar(256) DEFAULT '未填',
  `address` varchar(256) DEFAULT '未填',
  `school` varchar(50) DEFAULT '未填',
  `institute` varchar(50) DEFAULT '未填',
  `major` varchar(50) DEFAULT '未填',
  `iphone` varchar(15) DEFAULT '未填',
  `QQ` varchar(15) DEFAULT '未填',
  `wchat` varchar(25) DEFAULT '未填',
  PRIMARY KEY (`account`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('20140657021112', '186eaebb5c5db5a11a6d3c8610e93f50', '暂无昵称', '未填', '保密', '未填', '未填', '未填', '未填', '未填', '未填', '13594708333', '未填', '未填');
INSERT INTO `users` VALUES ('20140657021113', '186eaebb5c5db5a11a6d3c8610e93f50', '暂无昵称', '未填', '保密', '未填', '未填', '未填', '未填', '未填', '未填', '13594708333', '未填', '未填');
