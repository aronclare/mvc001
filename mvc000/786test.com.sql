/*
Navicat MySQL Data Transfer

Source Server         : users
Source Server Version : 50726
Source Host           : localhost:3306
Source Database       : 786test.com

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2023-10-31 15:46:25
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tp_category
-- ----------------------------
DROP TABLE IF EXISTS `tp_category`;
CREATE TABLE `tp_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL COMMENT '项目名称',
  `short_name` varchar(50) DEFAULT NULL COMMENT '项目副名称',
  `icon_url` varchar(255) DEFAULT NULL COMMENT '图标地址',
  `explain` mediumtext COMMENT '项目简介',
  `explainmb` mediumtext COMMENT '手机版内容',
  `effective_betting` tinyint(1) DEFAULT '0' COMMENT '有效投注',
  `effective_betting_sort` int(11) DEFAULT '0' COMMENT '有效投注排序值（值越大排越前面）',
  `application_date` tinyint(1) DEFAULT '0',
  `application_date_sort` int(11) DEFAULT '0' COMMENT '有效投注排序值（值越大排越前面）',
  `member_name` tinyint(1) DEFAULT '0',
  `member_name_sort` int(11) DEFAULT '0',
  `member_name_repeatability` int(11) DEFAULT '0' COMMENT '会员姓名是否重复',
  `number_participants` tinyint(1) DEFAULT '0',
  `number_participants_sort` int(11) DEFAULT '0',
  `can_win_prizes` tinyint(1) DEFAULT '0',
  `can_win_prizes_sort` int(11) DEFAULT '0',
  `losses` tinyint(1) DEFAULT '0',
  `losses_sort` int(11) DEFAULT '0',
  `contact_qq` tinyint(1) DEFAULT '0',
  `contact_qq_sort` int(11) DEFAULT '0',
  `contact_qq_repeatability` int(11) DEFAULT '0' COMMENT 'qq是否重复',
  `note_the_single_amount` tinyint(1) DEFAULT '0',
  `note_the_single_amount_sort` int(11) DEFAULT '0',
  `apply_for_days` tinyint(1) DEFAULT '0',
  `apply_for_days_sort` int(11) DEFAULT '0',
  `apply_for_customs_number` tinyint(1) DEFAULT '0',
  `apply_for_customs_number_sort` int(11) DEFAULT '0',
  `winner_paid` tinyint(1) DEFAULT '0',
  `winner_paid_sort` int(11) DEFAULT '0',
  `multiple_water` tinyint(1) DEFAULT '0',
  `multiple_water_sort` int(11) DEFAULT '0',
  `game_project` tinyint(1) DEFAULT '0',
  `game_project_sort` int(11) DEFAULT '0',
  `contact_via_mail` tinyint(1) DEFAULT '0',
  `contact_via_mail_sort` int(11) DEFAULT '0',
  `contact_via_mail_repeatability` int(11) DEFAULT '0' COMMENT '邮箱是否重复',
  `note_the_single_code` tinyint(1) DEFAULT '0',
  `note_the_single_code_sort` int(11) DEFAULT '0',
  `quantity_completion` tinyint(1) DEFAULT '0',
  `quantity_completion_sort` int(11) DEFAULT '0',
  `profit_quota` tinyint(1) DEFAULT '0',
  `profit_quota_sort` int(11) DEFAULT '0',
  `application_type` tinyint(1) DEFAULT '0',
  `application_type_sort` int(11) DEFAULT '0',
  `set_bonus` tinyint(1) DEFAULT '0' COMMENT '优惠百分比 0=10% 1=20% 2 =35%',
  `set_bonus_sort` int(11) DEFAULT '0' COMMENT '优惠百分比 0=10% 1=20% 2 =35%',
  `ip_repeatability` int(11) DEFAULT NULL,
  `ip_repeatability_repeat` int(11) DEFAULT '1' COMMENT '设置用户IP可申请的次数',
  `username_repeatability` int(11) DEFAULT NULL,
  `old_username` int(11) DEFAULT '0' COMMENT '老会员',
  `old_username_sort` int(11) DEFAULT '0',
  `old_name` int(11) DEFAULT '0',
  `old_name_sort` int(11) DEFAULT '0',
  `old_phone` int(11) DEFAULT '0',
  `old_phone_sort` int(11) DEFAULT '0',
  `new_username` int(11) DEFAULT '0',
  `new_username_sort` int(11) DEFAULT '0',
  `new_name` varchar(100) DEFAULT '0',
  `new_name_sort` int(11) DEFAULT '0',
  `new_phone` int(11) DEFAULT '0',
  `new_phone_sort` int(11) DEFAULT '0',
  `friends` int(11) DEFAULT '0' COMMENT '邀请好友',
  `friends_sort` int(11) DEFAULT '0' COMMENT '邀请好友排序',
  `referees` int(11) DEFAULT '0' COMMENT '推荐人',
  `referees_sort` int(11) DEFAULT '0' COMMENT '推荐人排序',
  `referral` int(11) DEFAULT '0' COMMENT '被推荐人',
  `referral_sort` int(11) DEFAULT '0' COMMENT '被推荐人排序',
  `sort` int(11) DEFAULT '0' COMMENT '项目排序值(值越大排越前面)',
  `status` int(11) DEFAULT '0' COMMENT '是否显示(0隐藏 1显示）',
  `type` tinyint(3) NOT NULL,
  `fangan1` int(11) NOT NULL,
  `fangan1_sort` int(11) NOT NULL,
  `fangan2` int(11) NOT NULL,
  `fangan2_sort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for tp_member
-- ----------------------------
DROP TABLE IF EXISTS `tp_member`;
CREATE TABLE `tp_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `secert_code` varchar(100) DEFAULT '0' COMMENT '创建/修改用户的时候，这个字段值随机生成10个英文数字更新',
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `create_at` varchar(11) DEFAULT '0',
  `update_at` varchar(11) DEFAULT '0',
  `login_ip` varchar(20) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `type` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `username` (`username`) USING BTREE,
  KEY `password` (`password`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for tp_notice
-- ----------------------------
DROP TABLE IF EXISTS `tp_notice`;
CREATE TABLE `tp_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) DEFAULT NULL COMMENT '公告标题',
  `memo` varchar(255) DEFAULT NULL COMMENT '公告内容',
  `sort` int(11) DEFAULT NULL COMMENT '排序',
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for tp_post
-- ----------------------------
DROP TABLE IF EXISTS `tp_post`;
CREATE TABLE `tp_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `cate_id` int(11) DEFAULT '0' COMMENT '申请项目ID',
  `username` varchar(50) DEFAULT NULL COMMENT '用户名',
  `handsel` decimal(11,2) DEFAULT '0.00' COMMENT '彩金',
  `memo` text COMMENT '备注',
  `status` tinyint(1) DEFAULT '0' COMMENT '状态(0:待审核 1:审核通过 2:审核不通过)',
  `ip` varchar(50) DEFAULT NULL COMMENT '提交IP',
  `ip_repeat_num` varchar(100) DEFAULT '1' COMMENT '用户IP申请次数',
  `edit_user` varchar(50) DEFAULT NULL COMMENT '操作用户名',
  `audit_time` int(11) DEFAULT '0' COMMENT '审核时间',
  `addtime` int(11) DEFAULT '0' COMMENT '申请时间',
  `effective_betting` varchar(100) DEFAULT NULL COMMENT '有效投注',
  `application_date` varchar(100) DEFAULT NULL COMMENT '申请日期',
  `member_name` varchar(100) DEFAULT NULL COMMENT '会员姓名',
  `number_participants` varchar(100) DEFAULT NULL COMMENT '参与人数',
  `can_win_prizes` varchar(100) DEFAULT NULL COMMENT '可获彩金',
  `losses` varchar(100) DEFAULT NULL COMMENT '亏损额度',
  `contact_qq` varchar(100) DEFAULT NULL COMMENT '联系QQ',
  `note_the_single_amount` varchar(100) DEFAULT NULL COMMENT '注单金额',
  `apply_for_days` varchar(100) DEFAULT NULL COMMENT '申请天数',
  `apply_for_customs_number` varchar(100) DEFAULT NULL COMMENT '申请关数',
  `winnerPaid` varchar(100) DEFAULT NULL COMMENT '中奖金额',
  `multiple_water` varchar(100) DEFAULT NULL COMMENT '流水倍数',
  `game_project` varchar(100) DEFAULT NULL COMMENT '游戏项目',
  `contact_via_mail` varchar(200) DEFAULT NULL COMMENT '联系邮箱',
  `note_the_single_code` varchar(100) DEFAULT NULL COMMENT '注单编码',
  `quantity_completion` varchar(100) DEFAULT NULL COMMENT '完成数量',
  `profit_quota` varchar(100) DEFAULT NULL COMMENT '盈利额度',
  `application_type` varchar(100) DEFAULT NULL COMMENT '申请类型',
  `set_bonus` varchar(100) DEFAULT NULL COMMENT '存款优惠（10%，20%，35%）',
  `old_username` varchar(100) DEFAULT NULL,
  `old_name` varchar(100) DEFAULT NULL,
  `old_phone` varchar(100) DEFAULT NULL,
  `new_username` varchar(100) DEFAULT NULL,
  `new_name` varchar(100) DEFAULT NULL,
  `new_phone` varchar(100) DEFAULT NULL,
  `friends` varchar(100) DEFAULT NULL COMMENT '邀请好友',
  `blacklist` varchar(100) DEFAULT '0' COMMENT '黑名单 *（1为禁止 0为正常） ',
  `referral` varchar(255) NOT NULL COMMENT '被推荐人账号',
  PRIMARY KEY (`id`),
  KEY `cate_id` (`cate_id`)
) ENGINE=MyISAM AUTO_INCREMENT=663611 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for tp_system
-- ----------------------------
DROP TABLE IF EXISTS `tp_system`;
CREATE TABLE `tp_system` (
  `id` int(11) NOT NULL DEFAULT '0',
  `refresh` varchar(100) DEFAULT NULL COMMENT '刷新页面的时间',
  `black_text` varchar(100) DEFAULT NULL COMMENT '黑名单提示信息文本',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
