/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50527
Source Host           : localhost:3306
Source Database       : dongdong

Target Server Type    : MYSQL
Target Server Version : 50527
File Encoding         : 65001

Date: 2015-04-10 17:14:07
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `actions`
-- ----------------------------
DROP TABLE IF EXISTS `actions`;
CREATE TABLE `actions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(32) NOT NULL COMMENT '动作名',
  `value` char(32) NOT NULL COMMENT '请求url中对应的动作部分',
  PRIMARY KEY (`id`),
  UNIQUE KEY `actions_value` (`value`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='系统动作表';

-- ----------------------------
-- Records of actions
-- ----------------------------
INSERT INTO `actions` VALUES ('1', '添加', 'create');
INSERT INTO `actions` VALUES ('2', '更新', 'update');
INSERT INTO `actions` VALUES ('3', '删除', 'destroy');
INSERT INTO `actions` VALUES ('4', '查看', 'index');

-- ----------------------------
-- Table structure for `foundations`
-- ----------------------------
DROP TABLE IF EXISTS `foundations`;
CREATE TABLE `foundations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) NOT NULL COMMENT '模块编号',
  `action_id` int(11) NOT NULL COMMENT '动作编号',
  `module_value` char(32) NOT NULL COMMENT '值，等于module_value/action_value',
  `action_value` char(32) DEFAULT NULL,
  `name` char(32) NOT NULL COMMENT '功能名称',
  `permission_code` int(11) DEFAULT '0' COMMENT '权限码',
  PRIMARY KEY (`id`),
  KEY `functions_module_id` (`module_id`) USING HASH,
  KEY `functions_action_id` (`action_id`) USING HASH
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='系统基础表，描述不同模块的动作与对应的权限';

-- ----------------------------
-- Records of foundations
-- ----------------------------
INSERT INTO `foundations` VALUES ('1', '3', '1', 'group', 'create', '添加分组', '1');
INSERT INTO `foundations` VALUES ('2', '3', '2', 'group', 'update', '修改分组', '2');
INSERT INTO `foundations` VALUES ('3', '3', '3', 'group', 'destroy', '删除分组', '4');
INSERT INTO `foundations` VALUES ('4', '5', '1', 'user', 'create', '添加用户', '8');
INSERT INTO `foundations` VALUES ('5', '5', '2', 'user', 'update', '修改用户', '16');
INSERT INTO `foundations` VALUES ('6', '5', '3', 'user', 'destroy', '删除用户', '32');
INSERT INTO `foundations` VALUES ('7', '6', '1', 'content', 'create', '添加内容模型', '64');
INSERT INTO `foundations` VALUES ('8', '6', '2', 'content', 'update', '修改内容模型', '128');
INSERT INTO `foundations` VALUES ('9', '1', '4', 'module', 'index', '模块管理', '256');

-- ----------------------------
-- Table structure for `groups`
-- ----------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(16) COLLATE utf8_unicode_ci NOT NULL,
  `permission_code` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of groups
-- ----------------------------
INSERT INTO `groups` VALUES ('1', '管理员', '511');
INSERT INTO `groups` VALUES ('2', '内容管理员', '192');
INSERT INTO `groups` VALUES ('3', '财务', '0');

-- ----------------------------
-- Table structure for `menus`
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键自动增长',
  `name` char(32) NOT NULL COMMENT '名称',
  `search_code` char(100) NOT NULL,
  `iconv` char(32) DEFAULT NULL COMMENT '图标',
  `parent_id` int(11) DEFAULT '0' COMMENT '父权菜单',
  `weight` int(11) DEFAULT NULL COMMENT '权重',
  `url` char(32) DEFAULT NULL COMMENT '菜单URL地址',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of menus
-- ----------------------------
INSERT INTO `menus` VALUES ('1', '内容管理', '', '', '0', '23', 'content');
INSERT INTO `menus` VALUES ('2', 'jjjjj', '', 'jjjjj', '1', '2121', 'jjdfjdf');
INSERT INTO `menus` VALUES ('3', '商品', '', 'glyphicon glyphicon-glass', '0', '12', 'goods');

-- ----------------------------
-- Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('2015_03_24_035105_create_groups_table', '1');

-- ----------------------------
-- Table structure for `modules`
-- ----------------------------
DROP TABLE IF EXISTS `modules`;
CREATE TABLE `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(32) NOT NULL COMMENT '模块名',
  `value` char(32) NOT NULL COMMENT '模块的值，用户请求url中的模块部分',
  PRIMARY KEY (`id`),
  UNIQUE KEY `modules_value` (`value`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='系统模块表';

-- ----------------------------
-- Records of modules
-- ----------------------------
INSERT INTO `modules` VALUES ('1', '模块管理', 'module');
INSERT INTO `modules` VALUES ('2', '动作管理', 'action');
INSERT INTO `modules` VALUES ('3', '分组管理', 'group');
INSERT INTO `modules` VALUES ('4', '功能管理', 'foundation');
INSERT INTO `modules` VALUES ('5', '用户管理', 'user');
INSERT INTO `modules` VALUES ('6', '内容管理', 'content');

-- ----------------------------
-- Table structure for `password_resets`
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_name_index` (`name`),
  KEY `users_group_id_index` (`group_id`) USING HASH
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', '1', 'dongdong', 'dongdong@qq.com', '$2y$10$flP1a9.Xw0NrUpOQNIrSCefEKR2xEk2nya1Zdt0d0UISXMnCpvb9.', 'c8pUgIiwDdRb8pMQFWxqKECkABEddhmT19bIzG2A8RufDwg88a7cY2UJvitN', '2015-04-02 09:41:03', '2015-04-07 01:54:55', null);
INSERT INTO `users` VALUES ('2', '3', 'aaaaa', 'aaaa@aa.com', '$2y$10$Yapih1kWhQQ3vU83mU6CZu.sDfCam6JhzWzHQkLlvt.HxQaQOHJgW', null, '2015-04-02 09:41:46', '2015-04-03 05:04:39', '2015-04-03 05:04:39');
