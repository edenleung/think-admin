-- --------------------------------------------------------
-- 主机:                           127.0.0.1
-- 服务器版本:                        5.7.28 - MySQL Community Server (GPL)
-- 服务器OS:                        Linux
-- HeidiSQL 版本:                  10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table think.dept
CREATE TABLE IF NOT EXISTS `dept` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `pid` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table think.dept: ~3 rows (大约)
/*!40000 ALTER TABLE `dept` DISABLE KEYS */;
INSERT INTO `dept` (`id`, `title`, `pid`, `status`, `create_time`, `update_time`) VALUES
	(1, 'Ant Design', 0, 1, 1612940363, 1612940363),
	(2, '深圳分部', 1, 1, 1612940363, 1612940363),
	(3, '设计部', 2, 1, 1612940363, 1612940363),
	(4, '程序部', 2, 1, 1612940363, 1612940363);
/*!40000 ALTER TABLE `dept` ENABLE KEYS */;

-- Dumping structure for table think.menu
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT '路由名称|资源名称',
  `title` varchar(100) NOT NULL COMMENT '菜单名称',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父级标识',
  `type` varchar(6) NOT NULL COMMENT '类别 1 目录 2 菜单',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '状态 1 正常 0 隐藏',
  `path` varchar(100) NOT NULL DEFAULT '' COMMENT 'path',
  `redirect` varchar(100) NOT NULL DEFAULT '' COMMENT 'redirect',
  `component` varchar(100) NOT NULL DEFAULT '' COMMENT 'component',
  `icon` varchar(30) NOT NULL DEFAULT '' COMMENT 'icon',
  `permission` varchar(100) NOT NULL DEFAULT '' COMMENT 'permission',
  `keepAlive` int(11) NOT NULL DEFAULT '0' COMMENT 'keepAlive',
  `hidden` int(11) NOT NULL DEFAULT '0' COMMENT 'hidden',
  `hideChildrenInMenu` int(11) NOT NULL DEFAULT '0' COMMENT 'hideChildrenInMenu',
  `blank` int(11) NOT NULL DEFAULT '0' COMMENT 'blank 1 外部链接 0 默认内部',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `delete_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- Dumping data for table think.menu: ~17 rows (大约)
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`id`, `name`, `title`, `pid`, `type`, `status`, `path`, `redirect`, `component`, `icon`, `permission`, `keepAlive`, `hidden`, `hideChildrenInMenu`, `blank`, `create_time`, `update_time`, `delete_time`) VALUES
	(1, 'Index', '首页', 0, 'path', 1, '/', '/dashboard', 'BasicLayout', 'smile-o', '', 0, 0, 0, 0, 0, 0, 0),
	(2, 'Dashboard', '仪表盘', 1, 'path', 1, '/dashboard', '/dashboard/workplace', 'RouteView', 'smile-o', '', 0, 0, 0, 0, 0, 0, 0),
	(3, 'Analysis', '分析页', 2, 'menu', 1, '/dashboard/analysis', '', 'Analysis', 'smile-o', '', 0, 0, 0, 0, 0, 0, 0),
	(4, 'Workspace', '工作台', 2, 'menu', 1, '/dashboard/workplace', '', 'Workplace', 'smile-o', '', 0, 0, 0, 0, 0, 0, 0),
	(5, 'System', '系统管理', 1, 'path', 1, '/system', '/system/menu', 'PageView', 'smile-o', '', 0, 0, 0, 0, 0, 0, 0),
	(6, 'Menu', '菜单管理', 5, 'menu', 1, '/system/menu', '', 'Menu', 'smile-o', '', 0, 0, 0, 0, 0, 0, 0),
	(7, 'Role', '角色列表', 13, 'menu', 1, '/system/role/list', '', 'Role', 'smile-o', '', 0, 0, 0, 0, 0, 1612859426, 0),
	(8, 'Account', '管理员列表', 17, 'menu', 1, '/system/account/list', '', 'Account', '', '', 0, 0, 0, 0, 0, 1613542292, 0),
	(9, 'Dept', '部门管理', 5, 'menu', 1, '/system/dept', '', 'Dept', 'smile-o', '', 0, 0, 0, 0, 0, 0, 0),
	(11, 'test', 'test', 1, 'menu', 1, '/test', '', 'Analysis', 'smile-o', '', 0, 0, 0, 0, 1612857539, 1612858652, 1612858652),
	(12, 'UpdateRole', '更新角色', 13, 'menu', 1, '/system/role/:id', '', 'RoleForm', '', '', 0, 1, 0, 0, 1612859191, 1612859554, 1612859554),
	(13, 'RoleManage', '角色管理', 5, 'path', 1, '/system/role', '/system/role/list', 'RouteView', 'smile-o', '', 0, 0, 1, 0, 1612859346, 1612859505, 0),
	(14, 'UpdateRole', '更新角色', 13, 'menu', 1, '/system/role/:id/update', '', 'RoleForm', '', '', 0, 1, 0, 0, 1612859649, 1612933655, 0),
	(15, 'CreateRole', '创建角色', 13, 'menu', 1, '/system/role/create', '', 'RoleForm', '', '', 0, 1, 0, 0, 1612889407, 1612889407, 0),
	(16, 'CreateAccount', '创建管理员', 17, 'menu', 1, '/system/account/create', '', 'AccountForm', '', '', 0, 1, 0, 0, 1613542028, 1613542206, 0),
	(17, 'AccountManage', '管理员管理', 5, 'path', 1, '/system/account', '/system/account/list', 'RouteView', 'smile-o', '', 0, 0, 1, 0, 1613542117, 1613542320, 0),
	(18, 'UpdateAccount', '更新管理员', 17, 'menu', 1, '/system/account/:id/update', '', 'AccountForm', '', '', 0, 0, 0, 0, 1613544796, 1613544796, 0);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;

-- Dumping structure for table think.menu_action
CREATE TABLE IF NOT EXISTS `menu_action` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_id` int(11) NOT NULL,
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `delete_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table think.menu_action: ~16 rows (大约)
/*!40000 ALTER TABLE `menu_action` DISABLE KEYS */;
INSERT INTO `menu_action` (`id`, `name`, `title`, `menu_id`, `create_time`, `update_time`, `delete_time`) VALUES
	(1, 'View', '详情', 3, 0, 0, 0),
	(2, 'View', '详情', 4, 0, 0, 0),
	(3, 'View', '详情', 7, 0, 0, 0),
	(4, 'List', '列表', 7, 0, 0, 0),
	(5, 'Create', '创建', 7, 0, 0, 0),
	(6, 'Update', '更新', 7, 0, 0, 0),
	(7, 'Delete', '删除', 7, 0, 0, 0),
	(8, 'List', '列表', 6, 1612938348, 1612938348, 0),
	(9, 'Info', '详情', 6, 1612938363, 1612938363, 0),
	(10, 'Update', '修改', 6, 1612938386, 1612938386, 0),
	(11, 'Delete', '删除', 6, 1612938396, 1612938396, 0),
	(12, 'Save', '保存', 16, 1613542061, 1613542061, 0),
	(13, 'List', '列表', 8, 1613542183, 1613542183, 0),
	(14, 'Save', '保存', 15, 1613546258, 1613546258, 0),
	(15, 'Save', '保存', 14, 1613546271, 1613546271, 0),
	(16, 'Save', '保存', 18, 1613546286, 1613546286, 0);
/*!40000 ALTER TABLE `menu_action` ENABLE KEYS */;

-- Dumping structure for table think.oauth_access_tokens
CREATE TABLE IF NOT EXISTS `oauth_access_tokens` (
  `client_id` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userid` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scope` varchar(4000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) DEFAULT '0',
  `access_token` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expires` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table think.oauth_access_tokens: ~0 rows (大约)
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;

-- Dumping structure for table think.oauth_auth_codes
CREATE TABLE IF NOT EXISTS `oauth_auth_codes` (
  `client_id` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scope` varchar(4000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) DEFAULT '0',
  `auth_code` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expires` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table think.oauth_auth_codes: ~0 rows (大约)
/*!40000 ALTER TABLE `oauth_auth_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_auth_codes` ENABLE KEYS */;

-- Dumping structure for table think.oauth_clients
CREATE TABLE IF NOT EXISTS `oauth_clients` (
  `client_id` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grant_types` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect_uri` varchar(2000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_secret` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table think.oauth_clients: ~1 rows (大约)
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
INSERT INTO `oauth_clients` (`client_id`, `grant_types`, `name`, `redirect_uri`, `client_secret`) VALUES
	('123456', NULL, 'xiaodi app', 'http://xiaodim.com', NULL);
/*!40000 ALTER TABLE `oauth_clients` ENABLE KEYS */;

-- Dumping structure for table think.oauth_refresh_tokens
CREATE TABLE IF NOT EXISTS `oauth_refresh_tokens` (
  `revoked` tinyint(1) DEFAULT '0',
  `refresh_token` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expires` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table think.oauth_refresh_tokens: ~0 rows (大约)
/*!40000 ALTER TABLE `oauth_refresh_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_refresh_tokens` ENABLE KEYS */;

-- Dumping structure for table think.oauth_scopes
CREATE TABLE IF NOT EXISTS `oauth_scopes` (
  `scope_id` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table think.oauth_scopes: ~0 rows (大约)
/*!40000 ALTER TABLE `oauth_scopes` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_scopes` ENABLE KEYS */;

-- Dumping structure for table think.role
CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `create_time` int(11) DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table think.role: ~1 rows (大约)
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` (`id`, `title`, `status`, `create_time`, `update_time`) VALUES
	(7, '普通超管组', 1, 1612939329, 1613547896),
	(8, '高级管理员', 1, 1613546245, 1613546245);
/*!40000 ALTER TABLE `role` ENABLE KEYS */;

-- Dumping structure for table think.role_action
CREATE TABLE IF NOT EXISTS `role_action` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `menu_action_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table think.role_action: ~23 rows (大约)
/*!40000 ALTER TABLE `role_action` DISABLE KEYS */;
INSERT INTO `role_action` (`id`, `role_id`, `menu_action_id`) VALUES
	(43, 7, 1),
	(44, 7, 2),
	(45, 7, 8),
	(46, 7, 9),
	(47, 7, 3),
	(48, 7, 4),
	(49, 7, 13),
	(81, 8, 1),
	(82, 8, 2),
	(83, 8, 8),
	(84, 8, 9),
	(85, 8, 10),
	(86, 8, 11),
	(87, 8, 3),
	(88, 8, 4),
	(89, 8, 5),
	(90, 8, 6),
	(91, 8, 7),
	(92, 8, 15),
	(93, 8, 14),
	(94, 8, 13),
	(95, 8, 12),
	(96, 8, 16);
/*!40000 ALTER TABLE `role_action` ENABLE KEYS */;

-- Dumping structure for table think.rules
CREATE TABLE IF NOT EXISTS `rules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ptype` varchar(255) DEFAULT NULL,
  `v0` varchar(255) DEFAULT NULL,
  `v1` varchar(255) DEFAULT NULL,
  `v2` varchar(255) DEFAULT NULL,
  `v3` varchar(255) DEFAULT NULL,
  `v4` varchar(255) DEFAULT NULL,
  `v5` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;

-- Dumping data for table think.rules: ~25 rows (大约)
/*!40000 ALTER TABLE `rules` DISABLE KEYS */;
INSERT INTO `rules` (`id`, `ptype`, `v0`, `v1`, `v2`, `v3`, `v4`, `v5`) VALUES
	(8, 'p', '7', 'Analysis', 'View', NULL, NULL, NULL),
	(9, 'p', '7', 'Workspace', 'View', NULL, NULL, NULL),
	(10, 'p', '7', 'Role', 'View', NULL, NULL, NULL),
	(11, 'p', '7', 'Role', 'List', NULL, NULL, NULL),
	(12, 'p', '7', 'Menu', 'List', NULL, NULL, NULL),
	(13, 'p', '7', 'Menu', 'Info', NULL, NULL, NULL),
	(14, 'p', '7', 'Account', 'List', NULL, NULL, NULL),
	(32, 'g', '1234', '7', NULL, NULL, NULL, NULL),
	(33, 'g', '1234', '8', NULL, NULL, NULL, NULL),
	(49, 'p', '8', 'Analysis', 'View', NULL, NULL, NULL),
	(50, 'p', '8', 'Workspace', 'View', NULL, NULL, NULL),
	(51, 'p', '8', 'Role', 'View', NULL, NULL, NULL),
	(52, 'p', '8', 'Role', 'List', NULL, NULL, NULL),
	(53, 'p', '8', 'Role', 'Create', NULL, NULL, NULL),
	(54, 'p', '8', 'Role', 'Update', NULL, NULL, NULL),
	(55, 'p', '8', 'Role', 'Delete', NULL, NULL, NULL),
	(56, 'p', '8', 'Menu', 'List', NULL, NULL, NULL),
	(57, 'p', '8', 'Menu', 'Info', NULL, NULL, NULL),
	(58, 'p', '8', 'Menu', 'Update', NULL, NULL, NULL),
	(59, 'p', '8', 'Menu', 'Delete', NULL, NULL, NULL),
	(60, 'p', '8', 'CreateAccount', 'Save', NULL, NULL, NULL),
	(61, 'p', '8', 'Account', 'List', NULL, NULL, NULL),
	(62, 'p', '8', 'CreateRole', 'Save', NULL, NULL, NULL),
	(63, 'p', '8', 'UpdateRole', 'Save', NULL, NULL, NULL),
	(64, 'p', '8', 'UpdateAccount', 'Save', NULL, NULL, NULL);
/*!40000 ALTER TABLE `rules` ENABLE KEYS */;

-- Dumping structure for table think.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '用户唯一标识（登录名）',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '登录密码',
  `nickname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '昵称',
  `dept_id` int(11) NOT NULL DEFAULT '3' COMMENT '部门标识',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '状态',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '头像',
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '邮箱',
  `allowed_grant_types` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'authorization_code',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `delete_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table think.user: ~3 rows (大约)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `password`, `nickname`, `dept_id`, `status`, `avatar`, `email`, `allowed_grant_types`, `create_time`, `update_time`, `delete_time`) VALUES
	(1, 'admin', '$2y$10$sJD.370QlvbVOII6yNZrv.Rj44q1BICLVFF765U6P50gb079.GrXa', 'admin', 0, 1, 'storage/topic/avatar.png', 'SeratiMa@aliyun.com', 'authorization_code', 1589699902, 1613543684, 0),
	(3, 'test', '$2y$10$QPI203ILGnMlCbC16hWUye8DJRJXIby7EDW2yJE5MrPw6IL3vEb/m', '测试', 4, 1, '', '', 'authorization_code', 1593931035, 1593931035, 0),
	(10, '1234', '$2y$10$sJD.370QlvbVOII6yNZrv.Rj44q1BICLVFF765U6P50gb079.GrXa', '1234', 3, 1, '', '', 'authorization_code', 1613548328, 1613548372, 0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
