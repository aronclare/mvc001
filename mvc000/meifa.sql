/*
Navicat MySQL Data Transfer

Source Server         : users
Source Server Version : 50726
Source Host           : localhost:3306
Source Database       : meifa

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2023-10-30 18:40:42
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for article
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `article_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '活动文章主键ID',
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `content` text COMMENT '主要内容',
  `start` varchar(50) DEFAULT NULL COMMENT '活动开始时间',
  `end` varchar(50) DEFAULT NULL COMMENT '活动结束时间',
  `add_time` int(11) unsigned DEFAULT NULL COMMENT '发布日期',
  `intro` text COMMENT '简介',
  `deleted` int(4) NOT NULL DEFAULT '0' COMMENT '删除标记',
  PRIMARY KEY (`article_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of article
-- ----------------------------
INSERT INTO `article` VALUES ('1', '国庆大折扣，七周年回顾新老顾客朋友们', null, '2018年10月一日', '2018年10月7日6:00点截止', null, '最终解释权归本店所有！谢谢您的光临！！', '0');

-- ----------------------------
-- Table structure for codes
-- ----------------------------
DROP TABLE IF EXISTS `codes`;
CREATE TABLE `codes` (
  `code_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '套餐表主键ID',
  `code` varchar(255) DEFAULT NULL COMMENT '代码',
  `user_id` int(10) unsigned DEFAULT NULL COMMENT '所属会员',
  `money` int(255) unsigned DEFAULT NULL COMMENT '代金券金额',
  `status` tinyint(3) unsigned DEFAULT NULL COMMENT '套餐状态0表示未使用1表示已使用',
  PRIMARY KEY (`code_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of codes
-- ----------------------------

-- ----------------------------
-- Table structure for group
-- ----------------------------
DROP TABLE IF EXISTS `group`;
CREATE TABLE `group` (
  `group_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '组ID',
  `name` varchar(255) DEFAULT NULL COMMENT '组名称',
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of group
-- ----------------------------

-- ----------------------------
-- Table structure for history
-- ----------------------------
DROP TABLE IF EXISTS `history`;
CREATE TABLE `history` (
  `history_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '消费记录主键id',
  `user_id` int(10) unsigned DEFAULT NULL COMMENT '会员的id',
  `member_id` int(10) unsigned DEFAULT '1' COMMENT '服务的员工id',
  `type` tinyint(3) unsigned DEFAULT NULL COMMENT '0表是消费1表示充值',
  `amount` int(10) unsigned DEFAULT NULL COMMENT '发生金额',
  `content` varchar(255) DEFAULT NULL COMMENT '发生内容',
  `time` int(10) unsigned DEFAULT NULL COMMENT '消费时间',
  `remainder` int(255) unsigned DEFAULT NULL COMMENT '余额',
  PRIMARY KEY (`history_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of history
-- ----------------------------

-- ----------------------------
-- Table structure for member
-- ----------------------------
DROP TABLE IF EXISTS `member`;
CREATE TABLE `member` (
  `member_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '会员ID',
  `username` varchar(255) DEFAULT NULL COMMENT '用户名',
  `realname` varchar(255) DEFAULT NULL COMMENT '姓名',
  `sex` tinyint(255) unsigned DEFAULT NULL COMMENT '性别0是女1是男',
  `telephone` varchar(255) DEFAULT NULL COMMENT '联系电话',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `money` varchar(255) DEFAULT NULL COMMENT '余额',
  `is_vip` tinyint(3) unsigned DEFAULT NULL COMMENT '是否为vip0不是1表示是',
  `photo` varchar(255) DEFAULT NULL COMMENT '头像',
  `deleted` tinyint(4) NOT NULL DEFAULT '0' COMMENT '删除标记',
  `password` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL COMMENT 'email',
  `group_id` int(10) DEFAULT NULL COMMENT 'group_id',
  `is_admin` tinyint(2) DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of member
-- ----------------------------
INSERT INTO `member` VALUES ('1', '李四', '李四', '1', '123445678', '剪成光头', '200', '1', './Uploads/img_5b8c0d103997c.png', '0', '123456', 'member@gmail.com', '1', '1', null);
INSERT INTO `member` VALUES ('11', null, '王五', '1', '1200000', '光头', '100', '1', './Uploads/img_5b8c0d103997c.png', '0', '123456', 'member@gmail.com', '1', '1', null);
INSERT INTO `member` VALUES ('32', null, '王五', '0', '2345', '郭德纲', '120', '0', './Uploads/img_5b8e4c99b2357_100x100.jpg', '0', '123456', 'member@gmail.com', '1', '1', null);
INSERT INTO `member` VALUES ('36', null, '王五', '0', '2345', '李四', '0', '0', './Uploads/img_5b8e0eeed3ff6_100x100.jpg', '0', '123456', 'member@gmail.com', '1', '1', null);
INSERT INTO `member` VALUES ('37', null, '王五', '1', '082733002828', '笑哈哈', '120', '1', './Uploads/img_5b8e4cdfd790b.jpeg', '0', '123456', 'member@gmail.com', '1', '1', null);
INSERT INTO `member` VALUES ('38', null, '李四', '0', '123456', '傻猪', '11111', '1', './Uploads/img_5b8e4d121ef6d.jpeg', '0', '123456', 'member@gmail.com', '1', '1', null);
INSERT INTO `member` VALUES ('39', null, 'xiaozhu', '1', '13533552828', 'xiaozhukaishile', '20', '0', './Uploads/img_653ded0a6b2a5.jpg', '0', '123456', 'member@gmail.com', '1', '1', null);
INSERT INTO `member` VALUES ('40', null, 'xiaowang', '1', '13533552829', 'sdfgddgdgdg', '30', '0', './Uploads/img_653dee49ced9f.jpg', '0', '123456', 'member@gmail.com', '1', '1', null);

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `order_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '订单列表主键ID',
  `phone` varchar(255) DEFAULT NULL COMMENT '联系电话',
  `realname` varchar(255) DEFAULT NULL COMMENT '姓名',
  `barber` varchar(255) DEFAULT NULL COMMENT '预约美发师',
  `content` varchar(255) DEFAULT NULL COMMENT '备注',
  `amount` varchar(255) DEFAULT NULL COMMENT '发生金额',
  `date` int(255) unsigned DEFAULT NULL COMMENT '预约日期',
  `status` tinyint(3) unsigned DEFAULT NULL COMMENT '0成功1失败',
  `reply` int(10) unsigned DEFAULT NULL COMMENT '回复信息',
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order
-- ----------------------------

-- ----------------------------
-- Table structure for plan
-- ----------------------------
DROP TABLE IF EXISTS `plan`;
CREATE TABLE `plan` (
  `plan_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '套餐表主键ID',
  `name` varchar(255) DEFAULT NULL COMMENT '套餐名称',
  `des` varchar(255) DEFAULT NULL COMMENT '套餐描述',
  `money` int(255) unsigned DEFAULT NULL COMMENT '套餐价格',
  `status` tinyint(3) unsigned DEFAULT NULL COMMENT '套餐状态0表示下线1表示上线',
  `add_time` int(11) DEFAULT NULL COMMENT '添加时间',
  `deleted` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`plan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of plan
-- ----------------------------
INSERT INTO `plan` VALUES ('7', '小王', '吃饭了', '12', '1', '1536113158', '0');
INSERT INTO `plan` VALUES ('10', '小米手机', '王蓉蓉', '500', '1', '1536052141', '0');
INSERT INTO `plan` VALUES ('11', '微软', '驱蚊器二', '2000', '1', '1536052172', '0');
INSERT INTO `plan` VALUES ('12', '22', '驱蚊器二', '112', '0', '1536054781', '0');
INSERT INTO `plan` VALUES ('13', '精品', '爽歪歪', '2000', '0', '1536052249', '0');
INSERT INTO `plan` VALUES ('14', '霸王洗发水', '超级无敌洗发水', '20000', '0', '1536054786', '0');

-- ----------------------------
-- Table structure for post
-- ----------------------------
DROP TABLE IF EXISTS `post`;
CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `cate_id` int(11) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `status` tinyint(2) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `edit_user` varchar(50) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of post
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '员工ID',
  `username` varchar(255) DEFAULT NULL COMMENT '用户名',
  `password` varchar(255) DEFAULT NULL COMMENT '密码',
  `sex` tinyint(255) unsigned DEFAULT NULL COMMENT '性别0是女1是男',
  `telephone` varchar(255) DEFAULT NULL COMMENT '联系电话',
  `last_login_time` timestamp NULL DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL COMMENT '邮箱',
  `last_login_ip` varchar(255) DEFAULT NULL COMMENT '最后登录IP',
  `status` int(2) DEFAULT '1',
  `photo` varchar(255) DEFAULT NULL,
  `thumb_photo` varchar(255) DEFAULT NULL COMMENT '头像',
  `remark` text,
  `create_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `update_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `is_admin` tinyint(3) unsigned DEFAULT NULL COMMENT '是否为管理员0不是1表示是',
  `group_id` tinyint(3) unsigned DEFAULT NULL COMMENT '所属部门',
  `deleted` tinyint(2) NOT NULL DEFAULT '0' COMMENT '删除标记',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '1', '082733002828', '2023-10-30 15:29:48', 'admin@gmail.com', '127.0.0.1', '1', './Uploads/img_653f5d63ecfda.jpg', './Uploads/img_653f5d63ecfda_100x100.jpg', 'werewrwerw', '2023-10-30 15:38:11', '2023-10-30 15:38:11', null, null, '0');

-- ----------------------------
-- Table structure for vip_class
-- ----------------------------
DROP TABLE IF EXISTS `vip_class`;
CREATE TABLE `vip_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class` varchar(255) DEFAULT NULL,
  `sort_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of vip_class
-- ----------------------------
INSERT INTO `vip_class` VALUES ('1', '青铜会员', '1');
INSERT INTO `vip_class` VALUES ('2', '白银会员', '2');
INSERT INTO `vip_class` VALUES ('3', '黄金会员', '3');
INSERT INTO `vip_class` VALUES ('4', '白金会员', '4');
INSERT INTO `vip_class` VALUES ('5', '钻石会员', '5');
