/*
Navicat MySQL Data Transfer

Source Server         : 开发机【192.168.1.80】
Source Server Version : 50546
Source Host           : 192.168.1.80:3306
Source Database       : cron

Target Server Type    : MYSQL
Target Server Version : 50546
File Encoding         : 65001

Date: 2017-05-15 20:27:53
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for t_log
-- ----------------------------
DROP TABLE IF EXISTS `t_log`;
CREATE TABLE `t_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `code` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `result` varchar(255) NOT NULL,
  `addtime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_log
-- ----------------------------
INSERT INTO `t_log` VALUES ('1', '1', '收集用户数据A', '200', '1', '{\"uid\":13392}', '2017-05-15 20:21:50');
INSERT INTO `t_log` VALUES ('2', '2', '测试测试B', '200', '1', '{\"dept\":13,\"name\":\"\\u6280\\u672f\\u90e8\"}', '2017-05-15 20:21:50');
INSERT INTO `t_log` VALUES ('3', '1', '收集用户数据A', '200', '1', '{\"uid\":13392}', '2017-05-15 20:22:10');
INSERT INTO `t_log` VALUES ('4', '1', '收集用户数据A', '200', '1', '{\"uid\":13392}', '2017-05-15 20:22:14');
INSERT INTO `t_log` VALUES ('5', '1', '收集用户数据A', '200', '1', '{\"uid\":13392}', '2017-05-15 20:22:30');
INSERT INTO `t_log` VALUES ('6', '2', '测试测试B', '200', '1', '{\"dept\":13,\"name\":\"\\u6280\\u672f\\u90e8\"}', '2017-05-15 20:22:30');
INSERT INTO `t_log` VALUES ('7', '1', '收集用户数据A', '200', '1', '{\"uid\":13392}', '2017-05-15 20:22:34');
INSERT INTO `t_log` VALUES ('8', '2', '测试测试B', '200', '1', '{\"dept\":13,\"name\":\"\\u6280\\u672f\\u90e8\"}', '2017-05-15 20:22:34');
INSERT INTO `t_log` VALUES ('9', '1', '收集用户数据A', '200', '1', '{\"uid\":13392}', '2017-05-15 20:22:50');
INSERT INTO `t_log` VALUES ('10', '1', '收集用户数据A', '200', '1', '{\"uid\":13392}', '2017-05-15 20:22:54');
INSERT INTO `t_log` VALUES ('11', '1', '收集用户数据A', '200', '1', '{\"uid\":13392}', '2017-05-15 20:23:10');
INSERT INTO `t_log` VALUES ('12', '2', '测试测试B', '200', '1', '{\"dept\":13,\"name\":\"\\u6280\\u672f\\u90e8\"}', '2017-05-15 20:23:10');
INSERT INTO `t_log` VALUES ('13', '1', '收集用户数据A', '200', '1', '{\"uid\":13392}', '2017-05-15 20:23:14');
INSERT INTO `t_log` VALUES ('14', '2', '测试测试B', '200', '1', '{\"dept\":13,\"name\":\"\\u6280\\u672f\\u90e8\"}', '2017-05-15 20:23:14');
INSERT INTO `t_log` VALUES ('15', '1', '收集用户数据A', '200', '1', '{\"uid\":13392}', '2017-05-15 20:23:30');
INSERT INTO `t_log` VALUES ('16', '1', '收集用户数据A', '200', '1', '{\"uid\":13392}', '2017-05-15 20:23:34');
INSERT INTO `t_log` VALUES ('17', '1', '收集用户数据A', '200', '1', '{\"uid\":13392}', '2017-05-15 20:23:50');
INSERT INTO `t_log` VALUES ('18', '2', '测试测试B', '200', '1', '{\"dept\":13,\"name\":\"\\u6280\\u672f\\u90e8\"}', '2017-05-15 20:23:50');
INSERT INTO `t_log` VALUES ('19', '1', '收集用户数据A', '200', '1', '{\"uid\":13392}', '2017-05-15 20:23:54');
INSERT INTO `t_log` VALUES ('20', '2', '测试测试B', '200', '1', '{\"dept\":13,\"name\":\"\\u6280\\u672f\\u90e8\"}', '2017-05-15 20:23:54');
INSERT INTO `t_log` VALUES ('21', '1', '收集用户数据A', '200', '1', '{\"uid\":13392}', '2017-05-15 20:24:10');
INSERT INTO `t_log` VALUES ('22', '1', '收集用户数据A', '200', '1', '{\"uid\":13392}', '2017-05-15 20:24:14');
INSERT INTO `t_log` VALUES ('23', '1', '收集用户数据A', '200', '1', '{\"uid\":13392}', '2017-05-15 20:24:30');
INSERT INTO `t_log` VALUES ('24', '2', '测试测试B', '200', '1', '{\"dept\":13,\"name\":\"\\u6280\\u672f\\u90e8\"}', '2017-05-15 20:24:30');
INSERT INTO `t_log` VALUES ('25', '1', '收集用户数据A', '200', '1', '{\"uid\":13392}', '2017-05-15 20:24:34');
INSERT INTO `t_log` VALUES ('26', '2', '测试测试B', '200', '1', '{\"dept\":13,\"name\":\"\\u6280\\u672f\\u90e8\"}', '2017-05-15 20:24:34');
INSERT INTO `t_log` VALUES ('27', '1', '收集用户数据A', '200', '1', '{\"uid\":13392}', '2017-05-15 20:24:50');
INSERT INTO `t_log` VALUES ('28', '1', '收集用户数据A', '200', '1', '{\"uid\":13392}', '2017-05-15 20:24:54');
INSERT INTO `t_log` VALUES ('29', '1', '收集用户数据A', '200', '1', '{\"uid\":13392}', '2017-05-15 20:25:10');
INSERT INTO `t_log` VALUES ('30', '2', '测试测试B', '200', '1', '{\"dept\":13,\"name\":\"\\u6280\\u672f\\u90e8\"}', '2017-05-15 20:25:10');
INSERT INTO `t_log` VALUES ('31', '1', '收集用户数据A', '200', '1', '{\"uid\":13392}', '2017-05-15 20:25:14');
INSERT INTO `t_log` VALUES ('32', '2', '测试测试B', '200', '1', '{\"dept\":13,\"name\":\"\\u6280\\u672f\\u90e8\"}', '2017-05-15 20:25:14');
INSERT INTO `t_log` VALUES ('33', '1', '收集用户数据A', '200', '1', '{\"uid\":13392}', '2017-05-15 20:25:30');
INSERT INTO `t_log` VALUES ('34', '1', '收集用户数据A', '200', '1', '{\"uid\":13392}', '2017-05-15 20:25:34');
INSERT INTO `t_log` VALUES ('35', '1', '收集用户数据A', '200', '1', '{\"uid\":13392}', '2017-05-15 20:25:50');
INSERT INTO `t_log` VALUES ('36', '2', '测试测试B', '200', '1', '{\"dept\":13,\"name\":\"\\u6280\\u672f\\u90e8\"}', '2017-05-15 20:25:50');
INSERT INTO `t_log` VALUES ('37', '1', '收集用户数据A', '200', '1', '{\"uid\":13392}', '2017-05-15 20:25:54');
INSERT INTO `t_log` VALUES ('38', '2', '测试测试B', '200', '1', '{\"dept\":13,\"name\":\"\\u6280\\u672f\\u90e8\"}', '2017-05-15 20:25:54');
INSERT INTO `t_log` VALUES ('39', '1', '收集用户数据A', '200', '1', '{\"uid\":13392}', '2017-05-15 20:26:10');
INSERT INTO `t_log` VALUES ('40', '1', '收集用户数据A', '200', '1', '{\"uid\":13392}', '2017-05-15 20:26:14');
INSERT INTO `t_log` VALUES ('41', '1', '收集用户数据A', '200', '1', '{\"uid\":13392}', '2017-05-15 20:26:30');
INSERT INTO `t_log` VALUES ('42', '2', '测试测试B', '200', '1', '{\"dept\":13,\"name\":\"\\u6280\\u672f\\u90e8\"}', '2017-05-15 20:26:30');
INSERT INTO `t_log` VALUES ('43', '1', '收集用户数据A', '200', '1', '{\"uid\":13392}', '2017-05-15 20:26:34');
INSERT INTO `t_log` VALUES ('44', '2', '测试测试B', '200', '1', '{\"dept\":13,\"name\":\"\\u6280\\u672f\\u90e8\"}', '2017-05-15 20:26:34');
INSERT INTO `t_log` VALUES ('45', '1', '收集用户数据A', '200', '1', '{\"uid\":13392}', '2017-05-15 20:26:50');
INSERT INTO `t_log` VALUES ('46', '1', '收集用户数据A', '200', '1', '{\"uid\":13392}', '2017-05-15 20:26:54');
INSERT INTO `t_log` VALUES ('47', '1', '收集用户数据A', '200', '1', '{\"uid\":13392}', '2017-05-15 20:27:10');
INSERT INTO `t_log` VALUES ('48', '2', '测试测试B', '200', '1', '{\"dept\":13,\"name\":\"\\u6280\\u672f\\u90e8\"}', '2017-05-15 20:27:10');
INSERT INTO `t_log` VALUES ('49', '1', '收集用户数据A', '200', '1', '{\"uid\":13392}', '2017-05-15 20:27:14');
INSERT INTO `t_log` VALUES ('50', '2', '测试测试B', '200', '1', '{\"dept\":13,\"name\":\"\\u6280\\u672f\\u90e8\"}', '2017-05-15 20:27:14');
INSERT INTO `t_log` VALUES ('51', '1', '收集用户数据A', '200', '1', '{\"uid\":13392}', '2017-05-15 20:27:30');
INSERT INTO `t_log` VALUES ('52', '1', '收集用户数据A', '200', '1', '{\"uid\":13392}', '2017-05-15 20:27:34');
INSERT INTO `t_log` VALUES ('53', '1', '收集用户数据A', '200', '1', '{\"uid\":13392}', '2017-05-15 20:27:50');
INSERT INTO `t_log` VALUES ('54', '2', '测试测试B', '200', '1', '{\"dept\":13,\"name\":\"\\u6280\\u672f\\u90e8\"}', '2017-05-15 20:27:50');

-- ----------------------------
-- Table structure for t_schedule
-- ----------------------------
DROP TABLE IF EXISTS `t_schedule`;
CREATE TABLE `t_schedule` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_title` varchar(255) NOT NULL,
  `s_url` varchar(255) NOT NULL,
  `s_startTime` int(11) NOT NULL,
  `s_endTime` bigint(20) NOT NULL,
  `s_interval` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `s_runTime` datetime DEFAULT NULL COMMENT '定时器运行时间',
  `s_stopTime` datetime DEFAULT NULL COMMENT '定时器停止运行时间',
  `s_timerId` int(11) DEFAULT NULL COMMENT '定时器ID',
  `s_addtime` datetime NOT NULL,
  `s_status` tinyint(4) NOT NULL DEFAULT '1',
  `s_running_state` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_schedule
-- ----------------------------
INSERT INTO `t_schedule` VALUES ('1', '收集用户数据A', 'http://www.yaf.com/index/user', '1430906400', '3155774400', '20', '1', '2017-05-15 20:21:54', '2017-05-15 20:21:15', '1', '2015-05-06 15:22:27', '1', '2');
INSERT INTO `t_schedule` VALUES ('2', '测试测试B', 'http://www.yaf.com/index/dept', '1430906400', '3155774400', '40', '1', '2017-05-15 20:21:54', '2017-05-15 20:21:15', '2', '2015-05-06 15:25:56', '1', '2');

-- ----------------------------
-- Table structure for t_user
-- ----------------------------
DROP TABLE IF EXISTS `t_user`;
CREATE TABLE `t_user` (
  `u_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `u_name` varchar(50) NOT NULL,
  `u_realname` varchar(50) NOT NULL,
  `u_phone` varchar(11) NOT NULL,
  `u_status` tinyint(4) unsigned NOT NULL DEFAULT '1',
  `u_rtxId` int(11) NOT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_user
-- ----------------------------
INSERT INTO `t_user` VALUES ('1', 'moxiaobai', '莫小白', '13509351822', '1', '1142');
